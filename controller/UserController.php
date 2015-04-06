<?php
	if(!isset($_SESSION)){
		session_start();
	}

	class UserController extends Controller{


		function register(){


			$correct = true;

			if(!isset($_POST['login']) || !isset($_POST['e-mail']) || !isset($_POST['password']) || !isset($_POST['passwordConfirm'])){
				$correct = false;
				$this->set('error', 'Merci de remplir tous les champs, sot !');
			}

			if(empty($_POST['login']) || empty($_POST['e-mail']) || empty($_POST['password']) || empty($_POST['passwordConfirm'])){
				$correct = false;
				$this->set('error', 'Merci de remplir tous les champs, sot !');
			}

			if($correct == true && (($_POST['password'] != $_POST['passwordConfirm']))){
				$this->set('error', 'Le mot de passe et la confirmation ne correspondent pas !!');
				$correct = false;
			}

			$this->loadModel('User');
			if(($this->User->getIDByUserName($_POST['login']))){
				$this->set('error', 'Le pseudo choisi est déjà pris, dommage !');
				$correct = false;
			}

			if (!filter_var($_POST['e-mail'], FILTER_VALIDATE_EMAIL)) {
    			$this->set('error', 'L\'e-mail entré n\'est pas valide');
    			$correct = false;
			}



			if($correct){
				$this->User->createSecondTable('userinfo');
				$this->User->registerUser();
			}

			else{
				$this->render('login');
			}
		}

		function login(){

		}

		function signin(){
			// creating a session if log successful
			$correct = true;

			if(!isset($_POST['login']) || !isset($_POST['password']) || empty($_POST['login']) || empty($_POST['password'])){
				$correct = false;
				$this->set('error', 'Merci de remplir tous les champs, sot !');
			}

			$this->loadModel('User');
			$this->User->createSecondTable('userinfo');
			//tries to log and creates a session if it works
			$logged = $this->User->login();
			
			if($logged == "user"){
				$this->set('error', "Utilisateur inconnu !");
				$this->render('login');
			}
			else if($logged == "password"){
				$this->set('error', "Mauvais mot de passe !");
				$this->render('login');				
			}


		}

		function disconnect(){
			//destroys all session !!

			session_unset();
			session_destroy();
			header('location: '.SERVER.DS.'');
			
		}

		/* Show user profile by its id */
		function profile($idUser){
			$this->loadModel('User');

			// Get the username if valide id
			$user = $this->User->findFirst(array('conditions'	=> array('idUser'=>$idUser)));
			if(empty($user))
				$this->e404('Cet utilisateur est malheureusement introuvable :(');
			
			$this->User->createSecondTable('userinfo');
			
			// Get profile informations
			$profile = $this->User->getUserInfo($idUser);
			// Make informations pretty
			$profile['idUser'] = $idUser;
			$profile['username'] = $user->username;
			$profile['avatar'] = IMAGES.'avatars/'.$profile['avatar'];

			$this->loadModel('Corpse');

			//we don't work with panels here bro
			//need to redo this

			/*
			// Get informations about his favorite corpse if exists
			if($profile['favoriteCorpse'] != 0){
				$favoriteCorpse = $this->Corpse->getCorpseInfo($profile['favoriteCorpse']);
				$favoriteCorpse['panel1'] = IMAGES.'panels/'.$favoriteCorpse['panel1'];
				$favoriteCorpse['panel2'] = IMAGES.'panels/'.$favoriteCorpse['panel2'];
				$favoriteCorpse['panel3'] = IMAGES.'panels/'.$favoriteCorpse['panel3'];

				$this->set('favoriteCorpse', $favoriteCorpse);
			}
			*/

			// Get statistics about user
			$profile['nbFinished'] = count($this->getCorpsesFromUser($profile['username'], 1, false));
			$profile['nbOnGoing'] = count($this->getCorpsesFromUser($profile['username'], 0, false));
			$profile['nbFavorite'] = count($this->Corpse->getFavoriteCorpses($idUser));

			// Give dat shit to the view
			$this->set('profile', $profile);
		}

		function setForm($type){

			switch($type){
				
				case "register":
					$params = array(	
					array(
						"label"	=> 'Nom d\'utilisateur',
						"name" => "login",			"type"	=> "text"),
					array(
						"label"	=>	'Mot de Passe',
						"name" => "password",			"type"	=> "password"),
					array(
						"label"	=>	'Confirmez le Mot de Passe',
						"name" => "passwordConfirm",	"type"	=> "password"),
					array(
						"label"	=>	'Adresse e-mail',
						"name" => "e-mail",			"type"	=> "email"),
					array(
						"label"	=>	'',
						"name" => "",			"type"	=> "submit"),
					);
					break;

				case "login":
					$params = array(	
					array(
						"label"	=> 'Nom d\'utilisateur',
						"name" => "login",			"type"	=> "text"),
					array(
						"label"	=>	'Mot de Passe',
						"name" => "password",			"type"	=> "password"),
					array(
						"label"	=>	'',
						"name" => "",			"type"	=> "submit"),
					);
					break;

			}
			
			$this->set('form', $params);
			
		}

		/* Separate all ids of users who participed in a corpse*/
		function separateAuthors($corpse){
			$authors = explode(",", $corpse['corpse_by']);
			return $authors;
		}

		/* Get the finished or on going corpses a user participated in */
		function getCorpsesFromUser($username, $finished){
			$corpses = $this->Corpse->getCorpsesInfo($finished, false);
			$corpsesFromUser = array();

			foreach($corpses as $corpse){
				$corpse['corpse_by'] = $this->separateAuthors($corpse);

				if(in_array($username, $corpse['corpse_by']))
					array_push($corpsesFromUser, $corpse);
			}

			return $corpsesFromUser;
		}

	}

?>