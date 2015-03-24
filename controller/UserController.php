<?php

	class UserController extends Controller{


		function register(){

			if(!isset($_POST['login']) && !isset($_POST['e-mail']) && !isset($_POST['password'])){
				return false;
			}
			if(empty($_POST['login']) && empty($_POST['e-mail']) && empty($_POST['password'])){
				return false;
			}
			$this->loadModel('User');
			$this->User->createSecondTable('userinfo');

			$this->User->registerUser();
		}

		function login(){
			
		}

		function setForm($type){
			$params = array(
				array("name" => "login",	"type"	=> "text"),
				array("name" => "password",	"type"	=> "password"),
				array("name" => "e-mail",	"type"	=> "email"),
				array("name" => "type",		"type"	=>"hidden",	"value" =>	$type),
				array("name" =>	"", 		"type"	=> "submit")
			);
			$this->set('form', $params);
			
			
		}



	}

?>