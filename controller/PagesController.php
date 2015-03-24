<?php

	class PagesController extends Controller{




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