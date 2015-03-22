<?php

class Model{

	static $connections = array();

	public $conf = 'default';
	public $table = false;
	public $db;

	public function __construct(){

		$conf = Conf::$dataBases[$this->conf];

		if(isset(Model::$connections[$this->conf])){
			$this->db = Model::$conecctions[$this->conf];
			return true;
		}

		try{
			$pdo = new PDO('mysql:host='.$conf['host'].';dbname='.$conf['database'].';',
				$conf['login'], $conf['password'],
				array(PDO::MYSQL_ATTR_INIT_COMMAND	=>	'SET NAMES utf8')
			);
			
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

			Model::$connections[$this->conf] = $pdo;
			$this->db = $pdo;
		}
		catch(PDOException $e){
			if(Conf::$debug > 1){
				die($e->getMessage());
			}
			else{
				die("failed to connect to database :(");
			}
		}
		
		if($this->table === false){
			$this->table = 'ce_'.strtolower(get_class($this));
		}

	}

	public function find($req){

		$sql = 'SELECT * FROM '.$this->table.' as '.get_class($this).' ';
		
		//construction condition
		if(isset($req['conditions'])){
			$sql .= 'WHERE ';
			if(!is_array($req['conditions'])){
				$sql .= $req['conditions'];
			}
			else{
				$cond = array();
				foreach($req['conditions'] as $k=>$v){
					if(!is_numeric($v)){
						$v = '"'.mysql_real_escape_string($v).'"';
					}
					$cond[] = "$k=$v";
				}
				$sql .= implode(' AND ', $cond);
			}


		}
		$pre = $this->db->prepare($sql);
		$pre->execute();
		
		return $pre->fetchAll(PDO::FETCH_OBJ);
	}

	public function findFirst($req){
		return current($this->find($req));
	}
}

?>