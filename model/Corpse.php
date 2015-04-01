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

	/* Get corpses a user liked by its ID */
	function getFavoriteCorpses($idUser){
		$favoriteCorpses = $this->db->prepare("SELECT idCorpse FROM ce_likes WHERE idUser = :idUser");
		$favoriteCorpses->execute(array('idUser'=>$idUser));
		$result = $favoriteCorpses->fetch(PDO::FETCH_NUM);

		return $result;
	}

	/* Get all finished corpses */
	function getFinishedCorpses(){
		$finishedCorpses = $this->db->prepare("SELECT idCorpse FROM :table WHERE finished = TRUE");
		$finishedCorpses->execute(array('table'=>$this->table));
		$result = $finishedCorpses->fetch(PDO::FETCH_NUM);

		return $result;
	}

	/* Get all on going corpses */
	function getOnGoingCorpses(){
		$onGoingCorpses = $this->db->prepare("SELECT idCorpse FROM :table WHERE finished = FALSE");
		$onGoingCorpses->execute(array('table'=>$this->table));
		$result = $onGoingCorpses->fetch(PDO::FETCH_NUM);

		return $result;
	}

}

?>