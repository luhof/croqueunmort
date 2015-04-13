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
				$this->set('success', 'Vous êtes bien inscrit ! Vous pouvez vous loguer.');
				$this->render("login");
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
			header('location: '.SERVER);
			
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
			
			$profile['corpses'] = $this->getCorpsesFromUser($profile['username'], 1, false);
			//print_r($profile['corpses']);

			//foreach($profile['corpses'] as $corpse){
				//print_r($corpse);
				//$corpse['corpse_by'] = $this->separateAuthors($corpse['corpse_by']);
			//}
			// Give dat shit to the view
			$this->set('profile', $profile);

		}

		function edit(){
			if(!isset($_SESSION['idUser']) && !isset($_SESSION['username']))
				$this->e404('Cette page ne vous est pas accessible, arrêtez d\'essayer de créer un bug dans la matrice è_é');
			
			$this->loadModel('User');
			$this->User->createSecondTable('userinfo');

			// Show some profile informations
			$profile = $this->User->getUserInfo($_SESSION['idUser']);
			$profile['avatar'] = IMAGES.'avatars/'.$profile['avatar'];
			$this->set('profile', $profile);

			// In case of validation of form
			if(isset($_POST["edit"])){

				if($_FILES['avatar']['error'] == 4 && empty($_POST['currentPassword']) && empty($_POST['password']) && empty($_POST['passwordConfirm']) && empty($_POST['e-mail'])){
					$this->set('error', 'Si on veut modifier son profil, il faudrait peut-être spéficier ce que l\'on veut modifier...');
					return;
				}


				// New avatar
				if($_FILES['avatar']['error'] == 0){

					// Extension test
					$validExtensions = array('jpg', 'jpeg', 'gif', 'png');
					$uploadedExtension = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
					if (!in_array($uploadedExtension, $validExtensions)){
						$this->set('error', 'Les extensions valides pour un avatar sont .jpg, .jpeg, .gif, .png (vous devriez le savoir quand même hein).');
						return;
					}
					
					// Size test
					$avatarSize = getimagesize($_FILES['avatar']['tmp_name']);
					if ($avatarSize[0] > 200 || $avatarSize[1] > 200){
						$this->set('error', 'L\'avatar est trop grand, il doit faire au maximum 200*200 pixels.');
						return;
					}

					// Alright
					$avatar = WEBROOT.DS.'images'.DS.'avatars'.DS.'avatar-'.$_SESSION['idUser'];
					if(move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar))
						$this->User->editProfile($_SESSION['idUser'], "avatar", 'avatar-'.$_SESSION['idUser']);
				}
				// Transfer error
				else if($_FILES['avatar']['error'] != 0 && $_FILES['avatar']['error'] != 4){
					$this->set('error', 'Il y a eu une erreur lors du transfert, ainsi va la vie.');
					return;
				}


				// New password
				if(!empty($_POST['currentPassword']) && !empty($_POST['password']) && !empty($_POST['passwordConfirm'])){
					// Wrong confirmation
					if($_POST['password'] != $_POST['passwordConfirm']){
						$this->set('error', 'Le nouveau mot de passe et la confirmation ne correspondent pas loulou.');
						return;
					}

					// Wrong old password
					$givenPassword = md5($_POST['currentPassword']."ichbindusel");
					$currentPassword = $this->User->getPassword($_SESSION['idUser']);
					if($givenPassword != $currentPassword){
						$this->set('error', 'Le mot de passe actuel n\'est pas le bon !');
						return;
					}

					// Alright
					$newPassword = md5($_POST['password']."ichbindusel");
					$this->User->editProfile($_SESSION['idUser'], "pwd", $newPassword);
				}
				// Empty password field (here comes the biggest test EVER youhou)
				else if((!empty($_POST['currentPassword']) && empty($_POST['password']) && empty($_POST['passwordConfirm'])) ||
					(!empty($_POST['currentPassword']) && !empty($_POST['password']) && empty($_POST['passwordConfirm'])) ||
					(!empty($_POST['currentPassword']) && empty($_POST['password']) && !empty($_POST['passwordConfirm'])) ||
					(empty($_POST['currentPassword']) && !empty($_POST['password']) && !empty($_POST['passwordConfirm'])) ||
					(empty($_POST['currentPassword']) && !empty($_POST['password']) && empty($_POST['passwordConfirm'])) ||
					(empty($_POST['currentPassword']) && empty($_POST['password']) && !empty($_POST['passwordConfirm']))){
					$this->set('error', 'Il faut remplir tous les champs relatifs au mot de passe pour pouvoir en changer.');
					return;
				}


				// New e-mail
				if(!empty($_POST['e-mail'])){
					if(!filter_var($_POST['e-mail'], FILTER_VALIDATE_EMAIL)){
    					$this->set('error', 'L\'e-mail entré n\'est pas valide');
    					return;
    				}
    				$this->User->editProfile($_SESSION['idUser'], "email", $_POST['e-mail']);
				}

				// Success message
				$this->set('success', 'Votre profil a bien été modifié \o');
			}

			// Show some profile informations
			$profile = $this->User->getUserInfo($_SESSION['idUser']);
			$profile['avatar'] = IMAGES.'avatars/'.$profile['avatar'];
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
						"label"	=>	'Confirmez le mot de passe',
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
						"label"	=>	'Mot de passe',
						"name" => "password",			"type"	=> "password"),
					array(
						"label"	=>	'',
						"name" => "",			"type"	=> "submit"),
					);
					break;

				case "edit":
					$params = array(	
					array(
						"label"	=> 'Nouvel avatar (200*200 px)',
						"name" => "avatar",			"type"	=> "file"),
					array(
						"label"	=>	'Mot de passe actuel',
						"name" => "currentPassword",			"type"	=> "password"),
					array(
						"label"	=>	'Nouveau mot de passe',
						"name" => "password",			"type"	=> "password"),
					array(
						"label"	=>	'Confirmez le nouveau mot de passe',
						"name" => "passwordConfirm",	"type"	=> "password"),
					array(
						"label"	=>	'Nouvelle adresse e-mail',
						"name" => "e-mail",			"type"	=> "email"),
					array(
						"label"	=>	'',
						"name" => "edit",			"type"	=> "submit"),
					);
					break;

			}
			
			$this->set('form', $params);
			
		}

		/* Separate all ids of users who participed in a corpse*/
		function separateAuthors($corpse){
			$this->loadModel('User');
			$authors = explode(",", $corpse);
			$authors = array_unique($authors);
			$authors = array_diff($authors, array(NULL));
			
			foreach ($authors as &$author){
				$author = array(
					'name'	=>$author,
					'id'	=>$this->User->getIdByUserName($author)
				);
			}
			//print_r($authors);
			return $authors;
		}

		/* Get the finished or on going corpses a user participated in */
		function getCorpsesFromUser($username, $finished){
			$corpses = $this->Corpse->getCorpsesInfo($finished, false);
			$corpsesFromUser = array();
			
			foreach($corpses as $corpse){
				$corpse_by_names = array();
				$corpse['corpse_by'] = $this->separateAuthors($corpse['corpse_by']);
				foreach($corpse['corpse_by'] as $corpseBy){
					array_push($corpse_by_names, $corpseBy['name']);
				}
				if(in_array($username, $corpse_by_names))
				array_push($corpsesFromUser, $corpse);
				
				
				
			}
		

			return $corpsesFromUser;
		}

	}

?>