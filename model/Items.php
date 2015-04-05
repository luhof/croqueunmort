<?php

class Items extends Model{

	function getPlaceUrlById($idPlace){

		$place = $this->db->prepare("SELECT * FROM ce_place WHERE idPlace = $idPlace");
		$place->execute();
		$result = $place->fetch(PDO::FETCH_ASSOC);
		print_r($result);
		return $result['url'];
	
	}

	function getCharacterUrlById($idCharacter){

	}

	function getActionUrlById($idAction){

	}

	function getObjectUrlById($idObject){

	}


}


?>