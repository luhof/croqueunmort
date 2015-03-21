<?php

	class PagesController extends Controller{

		/*function view($name){
			$this->set(array(
				"phrase"	=> "salut",
				"nom"		=> "machin"	 	

			));
			
			$this->render('index');
		}*/

		function index(){
			$this->render('index');
		}

		function top(){
			$this->render('top');
		}


	}

?>