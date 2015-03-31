<?php

class Corpse extends Model{

	function getRandCorpseId(){
			$login = $this->db->prepare("SELECT idCorpse FROM ".$this->table."");
			$login->execute();
			$result = $login->fetch(PDO::FETCH_ASSOC);
			echo "un corps au pif : ";
			print_r($result);
		
	}

}

?>