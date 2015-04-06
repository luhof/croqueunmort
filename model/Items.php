<?php

class Items extends Model{

	function getPlaceUrlById($idPlace){

		$place = $this->db->prepare("SELECT * FROM ce_place WHERE idPlace = $idPlace");
		$place->execute();
		$result = $place->fetch(PDO::FETCH_ASSOC);
		return $result['url'];
	
	}

	function getElemsIdByPanel($idPanel){

		$panel = $this->db->prepare("SELECT idCharacter, idAction, idObject FROM ce_panel WHERE idCase = $idPanel");
		$panel->execute();
		$result = $panel->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	function getElemNameById($type, $id){
		$table = "ce_".strtolower($type);
		$idElem = "id".$type;
		$elem = $this->db->prepare("SELECT url FROM $table WHERE $idElem = $id;
			");
		$elem->execute();
		$result = $elem->fetch(PDO::FETCH_ASSOC);
		return $result;
	}


}


?>