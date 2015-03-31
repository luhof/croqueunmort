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

		}


	}

?>