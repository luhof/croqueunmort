<?php

	class Controller{

		public $request;
		private $vars		= array();
		public $layout 		= 'default';
		private $rendered 	= false;


		function __construct($request = null){
			if($request){
				$this->request = $request;				
			}
		}


		//renders a view where $view -> file to render
		public function render($view){
			
			
			if($this->rendered) return false;

			extract($this->vars);
			//check if starts with '/' (error)
			if(strpos($view, '/')===0){
				$view = ROOT.DS.'view'.$view.'.php';
			}
			else if($view == 'index'){
				$view = ROOT.DS.'view'.DS.$view.'.php';
			}
			else{
				$view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
			}
			
			ob_start();
			require $view;
			$contentLayout = ob_get_clean();
			require ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php';
		
			$this->rendered = true;
		}

		//passe des variables à la vue
		public function set($key, $value=null){
			if(is_array($key)){
				$this->vars += $key;
			}
			else{
				$this->vars[$key] = $value;
			}
		}
		
		function loadControllerByName($name){
			$file = ROOT.DS.'controller'.DS.$name.'.php';
			if(file_exists($file)){
				require_once $file;
				return new $name($this->request);
			}
			else{
				return false;
			}
		}



		function loadModel($name){
			$file = ROOT.DS.'Model'.DS.$name.'.php';
			require_once($file);
			if(!isset($this->$name)){
				$this->$name = new $name();
			}
			
		}

		function e404($msg){
			$this->set('msg', $msg);
			$this->render('/errors/404');

			die();
		}

		function eUnauthorized($msg){
			$this->set('msg', $msg);
			$this->render('/errors/unauthorized');

			die();
		}

		function error($msg){
			$this->set('msg', $msg);
			$this->render('/errors/default');

			die();
		}

		//appeler un controlleur depuis une vue
		function request($controller, $action){
			$controller .= 'Controller';
			require_once ROOT.DS.'controller'.DS.$controller.'.php';
			$c = new $controller();
			return $c->$action();

		}



	}

?>