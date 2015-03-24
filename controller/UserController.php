<?php

	class UserController extends Controller{


		function register(){
			
			print_r($_POST);

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