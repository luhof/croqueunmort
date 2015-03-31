<?php

class Corpse extends Model{

	function getRandCorpseId(){
			$login = $this->db->prepare("SELECT idCorpse FROM ".$this->table."");
			$login->execute();
			$result = $login->fetch(PDO::FETCH_ASSOC);
			echo "un corps au pif : ";
			print_r($result);
		
	}

	//THAT FUCKER ONLY TAKES THE FIRST ONE I HATE IT.
	//fuck

	//fuck fuck fuck

	//really, fuck.
	function getRandItemId($type, $number){
		$table = "ce_".strtolower($type);
		$idName = "id".$type;

		$result = $this->db->prepare("SELECT ".$idName." FROM ".$table);
		$result->execute();
		$result = $result->fetch(PDO::FETCH_NUM);
		echo count($result);
		print_r($result);

	}

}

?>