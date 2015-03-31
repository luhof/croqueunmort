<?php

class Corpse extends Model{

	function getRandCorpseId(){
			$login = $this->db->prepare("SELECT idCorpse FROM ".$this->table."");
			$login->execute();
			$result = $login->fetchAll(PDO::FETCH_ASSOC);
			echo "un corps au pif : ";
			print_r($result);
		
	}

	function getRandItemId($type, $number){
		$table = "ce_".strtolower($type);
		$idName = "id".$type;

		$result = $this->db->prepare("SELECT ".$idName." FROM ".$table);
		$result->execute();
		$result = $result->fetchAll(PDO::FETCH_ASSOC);
		echo count($result);
		print_r($result);

	}

}

?>