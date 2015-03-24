<?php

	class PagesController extends Controller{


		function login(){
			
			if(isset($_POST['type'])&&!empty($_POST['type'])){
				$type = $_POST['type'];
				if($type=="login"){
					echo "asked for login";
				}
				else if($type=="register"){
					echo "asked for registration";
				}
				else{
					echo "wtf did you asked ?";
				}
			}
			
			//redirects if already logged
			//if($_SESSION['MACHIN']){}
		}


		//if $type==1 prints login form
		//if $type==2 prints register form
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


		//see 1 user with ID
		function view($id){
			$this->loadModel('User');
			$users = $this->User->findFirst(array(
				'conditions'	=> array('idUser'=>$id)
			));
			if(empty($users)){
				$this->e404('User introuvable');
			}
			$this->set('users', $users);
		}


		//creates menu with all users
		function getUsers(){
			$this->loadModel('User');
			return $this->User->find(array());
		}

		function top(){
			//$this->loadModel('Corpse');
			$this->set('array_of_best', 'array of best');
		}

		function last(){

		}




	}

?>