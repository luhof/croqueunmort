<?php

	if(!isset($_SESSION)){
		session_start();
	}

	class CorpseController extends Controller{

		function continuecorpse(){
			$this->loadModel('Corpse');
			$this->Corpse->getRandCorpseId();
		}


		function create(){
			if(!isset($_SESSION['idUser']) && !isset($_SESSION['username'])){
				header('location: '.SERVER.DS.'user-login');
			}
			$this->createPanel();

		}

		function createPanel(){
			$this->loadModel('Corpse');
			//select which element to add (here random)
			$arrayOfElems = array(
				'Place',
				'Character',
				'Object',
				'Action'
				);

			$elemType = $arrayOfElems[rand(0,3)];
			//select corresponding stuff (3 random)
			$elems 	= $this->Corpse->getRandItemId($elemType, 3);
			//get more info on each element

			foreach($elems as &$element){
				$element = $element['id'.$elemType];
				$element = $this->Corpse->getElemInfosById($elemType, $element);
			}

			$this->set('elemType', 	$elemType);
			$this->set('elems', $elems);
		}

		/* Separate all ids of users who participed in a corpse*/
		function separateAuthors($corpse){
			$authors = explode(",", $corpse['corpse_by']);
			return $authors;
		}

		/* Get the finished or on going corpses a user participated in */
		function getCorpsesFromUser($idUser, $finished){
			$corpses = $this->Corpse->getCorpsesInfo($finished);
			$corpsesFromUser = array();

			foreach($corpses as $corpse){
				$corpse['corpse_by'] = separateAuthors($corpse);

				if(in_array($idUser, $corpse[corpse_by])){
					array_push($corpseFromUser, $corpse);
				}
			}

			return $corpsesFromUser;
		}

	}

?>