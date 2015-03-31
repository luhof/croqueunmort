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
			$places 	= $this->Corpse->getRandItemId('Place', 2);
			$characters = $this->Corpse->getRandItemId('Character', 2);
			$objects	= $this->Corpse->getRandItemId('Object', 2);
			$actions	= $this->Corpse->getRandItemId('Action', 2);

		}


	}

?>