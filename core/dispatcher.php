<?php

class Dispatcher{

	var $request;

	function __construct(){
		$this->request = new Request();
		ROUTER::parse($this->request->url, $this->request);
		
		if(!$this->loadController()){
			$this->error('There is no controller :(');
		}

		$controller = $this->loadController();

		if(!in_array($this->request->action, get_class_methods($controller))){
			$this->error('Controller missing function "'.$this->request->action.'"');
		}
		
		call_user_func_array(array($controller, $this->request->action), $this->request->params);
		
		$controller->render($this->request->action);
	}

	function loadController(){

		$name = ucfirst($this->request->controller.'Controller');
		$file = ROOT.DS.'controller'.DS.$name.'.php';
		if(file_exists($file)){
			require_once $file;
			return new $name($this->request);
		}
		else{
			return false;
		}


	}


	function error($msg){
		$controller = new Controller($this->request);
		$controller->set('msg', $msg);
		$controller->render('/errors/404');
		die();
	}

}

?>