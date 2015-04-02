<?php

	if(!isset($_SESSION)){
		session_start();
	}

	class CorpsesController extends Controller{

		function top($nb){
			$this->loadModel('Corpse');
			$bestCorpses = $this->Corpse->getBestCorpses($nb);
		}

	}

?>