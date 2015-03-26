<?php

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

			if(($_POST['password'] != $_POST['passwordConfirm'])){
				$this->set('error', 'Le mot de passe et la confirmation ne correspondent pas !!');
				$correct = false;
			}

			if($correct){
				$this->loadModel('User');
				$this->User->createSecondTable('userinfo');
				$this->User->registerUser();
			}
		}

		function login(){
			
		}

		function setForm($type){

			switch($type){
				
				case 1:
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

				case 2:
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