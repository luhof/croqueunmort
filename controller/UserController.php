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

		/* Show user profile by its username */
		function showProfile($login){
			$this->loadModel('User');
			$idUser = $this->User->getIDByUserName($login);
			
			$userInfo = $this->User->getUserInfo($idUser);
			$userInfo['userName'] = $login;


			$userInfo['nbFinised']['idCorpse, corpse_by']

			$this->loadModel('Corpse');
			$userInfo['nbFinised'] = $resultsFC;
			$userInfo['nbOnGoing'] = $resultsOGC;
			$tableau['listcopse'] = $this->corpse->getcorpsebyuser($iduser)

			$userInfo['nbFavorite'] = count($this->Corpse->getFavoriteCorpses($idUser));
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



	}

?>