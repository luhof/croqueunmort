<?php

class Corpse extends Model{



/********************************
*								*
*			GETTERS 			*
*								*
********************************/


	function getRandCorpseId(){
			$login = $this->db->prepare("SELECT idCorpse FROM ".$this->table."");
			$login->execute();
			$result = $login->fetchAll(PDO::FETCH_ASSOC);
			echo "un corps au pif : ";
			print_r($result);
	}

	/* returns an array of random items with determined type and size*/
	function getRandItemId($type, $number){
		$table = "ce_".strtolower($type);
		$idName = "id".$type;

		$result = $this->db->prepare("SELECT ".$idName." FROM ".$table);
		$result->execute();
		$result = $result->fetchAll(PDO::FETCH_ASSOC);

		$randKeys = array_rand($result, $number);

		for($i=0; $i<$number; $i++){
			$resultArr[$i] = $result[$randKeys[$i]];
		}
		
		return $resultArr;
	}

	/* returns an array filled with informations from id*/
	function getElemInfosById($type, $id){
		$table = "ce_".strtolower($type);
		$idName = "id".$type;

		//didn't managed to make a nice and clean request...
		//YET TO BE FIXED
		$elemInfos = $this->db->prepare("SELECT * FROM ".$table." WHERE ".$idName." = ".$id);
		$elemInfos->execute();
		$result = $elemInfos->fetch(PDO::FETCH_ASSOC);

		return $result;
	}

	/* Get corpses a user liked by its ID */
	function getFavoriteCorpses($idUser){
		$favoriteCorpses = $this->db->prepare("SELECT * FROM $this->table NATURAL JOIN ce_likes WHERE idUser = :idUser ORDER BY idCorpse DESC");
		$favoriteCorpses->execute(array('idUser'=>$idUser));
		$result = $favoriteCorpses->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	/* Get all informations about a few corpses depending on their status (finished or on going) */
	function getCorpsesInfo($finished){
		$corpsesInfo = $this->db->prepare("SELECT * FROM $this->table WHERE finished = :finished ORDER BY idCorpse DESC");
		$corpsesInfo->execute(array('finished'=>$finished));
		$result = $corpsesInfo->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	/* Get all informations about a corpse by its id */
	function getCorpseInfo($idCorpse){
		$corpseInfo = $this->db->prepare("SELECT * FROM $this->table WHERE idCorpse = :idCorpse");
		$corpseInfo->execute(array('idCorpse'=>$idCorpse));
		$result = $corpseInfo->fetch(PDO::FETCH_ASSOC);

		return $result;
	}

	/* Get the x more liked corpses */
	function getBestCorpses($nb){
		$corpsesInfo = $this->db->prepare("SELECT * FROM $this->table WHERE finished = true ORDER BY likesCount DESC LIMIT :nb");
		$corpsesInfo->execute(array('nb'=>$nb));
		$result = $corpsesInfo->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}


/********************************
*								*
*			SETTERS 			*
*								*
********************************/

	function insertNewCorpse(){
		$corpse = $this->db->prepare("INSERT INTO ".$this->table." VALUES (NULL, 0, NULL, NULL, 0, NULL)");
		$corpse->execute();

		return $corpse;
	}

	function insertNewPanel($idCorpse, $step){
		$panel = $this->db->prepare("INSERT INTO ce_panel VALUES (NULL, $step, 0, $idCorpse, NULL, NULL, NULL");
		$panel->execute();

		return $panel;
	}


}





?>