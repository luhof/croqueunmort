<?php

	if(!isset($_SESSION)){
		session_start();
	}

	class CorpseController extends Controller{

		function continueCorpse(){
			if(!isset($_SESSION['idUser']) && !isset($_SESSION['username'])){
				$this->set('error', 'Vous devez être authentifié pour continuer un cadavre');
				$this->render('login');
			}
		}


		function create(){
			if(!isset($_SESSION['idUser']) && !isset($_SESSION['username'])){
				$this->set('error', 'Vous devez être authentifié pour créer un cadavre');
				$this->render('login');
			}

		}


	}

?>