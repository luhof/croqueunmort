<?php

	class PagesController extends Controller{

		/*function view($name){
			$this->set(array(
				"phrase"	=> "salut",
				"nom"		=> "machin"	 	

			));
			
			$this->render('index');
		}*/


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

		function index(){
			$this->render('index');
		}

		function top(){
			$this->render('top');
		}




	}

?>