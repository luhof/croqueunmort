<?php

	if(!isset($_SESSION)){
		session_start();
	}

	class ViewController extends Controller{
		
		/* set values to display */
		function id($val){

			if(empty($val)){
				$params = $this->request->params;

				if(count($params)<1 || empty($params[0])){
					$this->error('Pas de cadavre entré en paramètre !');
					exit();
				}

				$idCorpse = $params[0];
			}
			else{
				$idCorpse = $val;
			}
			

			$this->loadModel('Corpse');
			$corpse = $this->Corpse->getCorpseInfo($idCorpse);

			if(empty($corpse) || !$corpse['finished']){
				$this->error('Pas de cadavre existant (ou fini) avec cette id');
				exit();
			}

			$corpse_by = $this->separateAuthors($corpse['corpse_by']);

			$this->set('idCorpse',	$corpse['idCorpse']);
			$this->set('img',		"./images/corpses/".$corpse['img']);
			$this->set('corpse_by', $corpse_by);
			$this->set('likesCount',$corpse['likesCount']);


		}

		function random(){
			$this->loadModel('Corpse');
			$randId = $this->Corpse->getRandCorpseId(true);		$this->id($randId['idCorpse']);
		}

		/* sets an array of corpse */
		function last(){
			$corpseArray = array();
			$this->loadModel('Corpse');

			$corpseArray = $this->Corpse->getCorpsesInfo(1, 5);

			foreach($corpseArray as &$corpse){
				$corpse['corpse_by'] = $this->separateAuthors($corpse['corpse_by']);
			}



			$this->set('corpseArray', $corpseArray);

		}

		function best(){
			$corpseArray = array();
			$this->loadModel('Corpse');

			$corpseArray = $this->Corpse->getBestCorpses(5);

			foreach($corpseArray as &$corpse){
				$corpse['corpse_by'] = $this->separateAuthors($corpse['corpse_by']);
			}

			$this->set('corpseArray', $corpseArray);

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
			return $authors;
		}

		/* Get the finished or on going corpses a user participated in */
		function getCorpsesFromUser($idUser, $finished){
			$corpses = $this->Corpse->getCorpsesInfo($finished);
			$corpsesFromUser = array();

			foreach($corpses as $corpse){
				$corpse['corpse_by'] = separateAuthors($corpse);

				if(in_array($idUser, $corpse['corpse_by'])){
					array_push($corpseFromUser, $corpse);
				}
			}

			foreach($corpseArray as &$corpse){
				$corpse['corpse_by'] = $this->separateAuthors($corpse['corpse_by']);
			}


			return $corpsesFromUser;
		}




	}

?>