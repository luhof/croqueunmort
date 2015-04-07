<?php

class Corpse extends Model{



/********************************
*								*
*			GETTERS 			*
*								*
********************************/

	/* returns a random id and his place*/
	function getRandCorpseId($finished){

			if($finished == true)
				$finished = "WHERE finished=1";
			else
				$finished = "WHERE finished=0";

			$login = $this->db->prepare("SELECT idCorpse, idPlace FROM ".$this->table." ".$finished."");
			$login->execute();
			$result = $login->fetchAll(PDO::FETCH_ASSOC);

			if($result==NULL) return false;

			$randKey = array_rand($result);
			
			return $result[$randKey];

	}


	function getPanelsByCorpseId($idCorpse){
		$panels = $this->db->prepare("SELECT * FROM ce_panel WHERE idCorpse = :idCorpse");
		$panels->execute(array('idCorpse'=>$idCorpse));
		$result = $panels->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}


	function getPanelById($idPanel){
		$panel = $this->db->prepare("SELECT * FROM ce_panel WHERE idCase = :idPanel");
		$panel->execute(array('idPanel'=>$idPanel));
		$result = $panel->fetch(PDO::FETCH_ASSOC);

		return $result;
	}

	function issetPlaceFromCorpse($idCorpse){
		$corpse = $this->db->prepare("SELECT idPlace FROM ".$this->table." WHERE idCorpse = :idCorpse");
		$corpse->execute(array('idCorpse'=>$idCorpse));
		$result = $corpse->fetch(PDO::FETCH_ASSOC);
		if($result['idPlace']!=NULL){
			return true;
		}
		return false;
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
	function getCorpsesInfo($finished, $number){
		if(!isset($number) || $number == false){
			$numberCond = "";
		}
		else{
			$numberCond = "LIMIT $number";
		}

		$corpsesInfo = $this->db->prepare("SELECT * FROM $this->table WHERE finished = $finished ORDER BY idCorpse DESC $numberCond");
		$corpsesInfo->execute(array());
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
		$corpsesInfo = $this->db->prepare("SELECT * FROM $this->table WHERE finished = true ORDER BY likesCount DESC LIMIT $nb");
		$corpsesInfo->execute();
		$result = $corpsesInfo->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	function getUsersByCorpse($idCorpse){
		$users = $this->db->prepare("SELECT corpse_by FROM $this->table WHERE idCorpse = $idCorpse");
		$users->execute();
		$result = $users->fetch(PDO::FETCH_ASSOC);

		return $result;
	}


/********************************
*								*
*			SETTERS 			*
*								*
********************************/

	function insertNewCorpse(){
		$corpse = $this->db->prepare("INSERT INTO ".$this->table." (idCorpse, finished, img, likesCount, corpse_by) VALUES (NULL, 0, 'default.png', 0, ',')");
		$corpse->execute();
	}

	function setCorpseUrl($idCorpse){
		$url = "corpse_".$idCorpse.".png";
		$corpse = $this->db->prepare("	UPDATE ce_corpse
										SET img = '$url' 
										WHERE idCorpse=$idCorpse;"
									);
		$corpse->execute();
	}

	function insertNewPanel($idCorpse, $step){
		$panel = $this->db->prepare("INSERT INTO ".'ce_panel'." (idCase, step, finished, idCorpse)  VALUES (NULL, $step, 0, $idCorpse)");
		$panel->execute();
	}

	function setPanelValue($type, $idElem, $idPanel){
		$type = 'id'.$type;
		$panel = $this->db->prepare("	UPDATE ce_panel
										SET $type=$idElem
										WHERE idCase=$idPanel;"
									);
		$panel->execute();
	}

	function addUserToCorpseBy($username, $idCorpse){
		
		$users = $this->getUsersByCorpse($idCorpse);
		$users = $users['corpse_by'].$username.",";

		$panel = $this->db->prepare("	UPDATE $this->table
										SET corpse_by='$users'
										WHERE idCorpse=$idCorpse
										LIMIT 1;"
									);
		$panel->execute();
	}

	function setCorpsePlace($idCorpse, $idPlace){
		$panel = $this->db->prepare("	UPDATE ce_corpse
										SET idPlace=$idPlace
										WHERE idCorpse=$idCorpse;"
									);
		$panel->execute();
	}

	function setPanelAsFinished($idPanel){
		$panel = $this->db->prepare("	UPDATE ce_panel
										SET finished=true
										WHERE idCase=$idPanel;"
									);
		$panel->execute();
	}

	function setCorpseAsFinished($idCorpse){
		$corpse = $this->db->prepare("	UPDATE ce_corpse
										SET finished=true
										WHERE idCorpse=$idCorpse;"
									);
		$corpse->execute();
	}


}





?>