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
		$favoriteCorpses = $this->db->prepare("SELECT * FROM :table NATURAL JOIN ce_likes WHERE idUser = :idUser ORDER BY idCorpse DESC");
		$favoriteCorpses->execute(array('idUser'=>$idUser));
		$result = $favoriteCorpses->fetch(PDO::FETCH_ASSOC);

		return $result;
	}

	/* Get all informations about a few corpses depending on their status (finished or on going) */
	function getCorpsesInfo($finished){
		$corpsesInfo = $this->db->prepare("SELECT * FROM :table WHERE finished = :finished ORDER BY idCorpse DESC");
		$corpsesInfo->execute(array('table'=>$this->table, 'finished'=>$finished));
		$result = $corpsesInfo->fetch(PDO::FETCH_ASSOC);

		return $result;
	}

	/* Get all informations about a corpse by its id */
	function getCorpseInfo($idCorpse){
		$corpseInfo = $this->db->prepare("SELECT * FROM :table WHERE idCorpse = :idCorpse");
		$corpseInfo->execute(array('table'=>$this->table, 'idCorpse'=>$idCorpse));
		$result = $corpseInfo->fetch(PDO::FETCH_ASSOC);

		return $result;
	}

	/* Get the x more liked corpses */
	function getBestCorpses($nb){
		$corpsesInfo = $this->db->prepare("SELECT * FROM :table WHERE finished = true ORDER BY likesCount DESC LIMIT :nb");
		$corpsesInfo->execute(array('table'=>$this->table, 'nb'=>$nb));
		$result = $corpsesInfo->fetch(PDO::FETCH_ASSOC);

		return $result;
	}

}

?>