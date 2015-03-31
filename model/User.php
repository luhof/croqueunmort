<?php

class User extends Model{

	function registerUser(){

		$login = $_POST['login'];
		$login = strtolower($login);
		$password = $_POST['password'];
		$email = $_POST['e-mail'];
		$salt = "ichbindusel";
		$password = $password.$salt;
		$password = md5($password);

		//here insert if login doesn't exist !!

		try{
			$this->db->beginTransaction();

			$registration1 = $this->db->prepare('INSERT INTO '.$this->table.' (username) VALUES (:login)');
			$registration2 = $this->db->prepare('INSERT INTO '.$this->table2.' (email, pwd, create_time) VALUES (:email, :pwd, CURDATE())');

			$registration1->execute(array('login'=>$login));
			$registration2->execute(array('email'=>$email, 'pwd'=>$password));

			$this->db->commit();
		}
		catch(Exception $e){
			$db->rollback();
			echo "erreur : ".$e->getMessage()."<br/>";
			exit();
		}

		return true;
		
	}

	function login(){

		$login = $_POST['login'];
		$password = $_POST['password'];
		$salt = "ichbindusel";
		$password = $password.$salt;
		$password = md5($password);

		//get ID by username
		$idUser = $this->getIDByUserName($login);

		if(!$idUser) return "user";

		try{
			$login = $this->db->prepare("SELECT * FROM ".$this->table2." NATURAL JOIN ".$this->table." WHERE idUser = :idUser AND pwd = '".$password."'");
			$login->execute(array('idUser'=>$idUser));
			$result = $login->fetch(PDO::FETCH_ASSOC);
		}
		catch(Exception $e){
			$this->db->rollback();
			echo "erreur with query";
			exit();
		}

		if($result!=NULL){
			//session_start();
			$_SESSION['idUser'] = $result['idUser'];
			$_SESSION['username'] = $result['username'];
			header('location: '.SERVER.DS.'');
		}

		else return "password";

	}

	function getIDByUserName($login){
		try{
			$login1 = $this->db->prepare("SELECT idUser FROM ".$this->table." WHERE username = '".$login."'");
			$login1->execute(array());
			$result = $login1->fetch(PDO::FETCH_ASSOC);
		}
		catch(Exception $e){
			$this->db->rollback();
			echo "erreur with query";
			exit();
		}

		if(!$result){
			return false;
		}

		else{
			return $result['idUser'];
		}
	}


	function getUserInfo($idUser){
		$info = $this->db->prepare("SELECT avatar, create_time, favoriteCorpse FROM ce_userinfo WHERE idUser = :idUser");
		$info->execute(array('idUser'=>$idUser));
		$results = $info->fetch(PDO::FETCH_ASSOC);

		$finishedCorpses = $this->db->prepare("SELECT idCorpse, corpse_by FROM ce_corpse WHERE finished = TRUE");
		$finishedCorpses->execute();
		$resultsFC = $finishedCorpses->fetchAll(PDO::FETCH_ASSOC);

		$onGoingCorpses = $this->db->prepare("SELECT idCorpse, corpse_by FROM ce_corpse WHERE finished = FALSE");
		$onGoingCorpses->execute();
		$resultsOGC = $onGoingCorpses->fetchAll(PDO::FETCH_ASSOC);

		$favoriteCorpses = $this->db->prepare("SELECT COUNT(idCorpses) FROM ce_likes WHERE idUser = :idUser");
		$favoriteCorpses->execute(array('idUser' => $idUser));
		$nbFavorite = $favoriteCorpses->fetch(PDO::FETCH_ASSOC);

		if($result!=NULL){
			$userInfo['avatar'] = $results['avatar'];
			$userInfo['since'] = $results['create_time'];

			$userInfo['nbFinised'] = $resultsFC;
			$userInfo['nbOnGoing'] = $resultsOGC;
			$userInfo['nbFavorite'] = $nbFavorite[0];

			$userInfo['favoriteCorpse'] = $results['favoriteCorpse'];

			return $userInfo;
		}
	}

}

?>