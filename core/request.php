<?php

class Request{

	public $url;

	function __construct(){

		if(isset($_SERVER['PATH_INFO'])){
			$this->url = $_SERVER['PATH_INFO'];
		}
		else{
			$this->url = '/pages';
		}

	
	}

}

?>