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

			$registration1 = $this->db->prepare("INSERT INTO $this->table (username) VALUES (:login)");
			$registration2 = $this->db->prepare("INSERT INTO $this->table2 (email, pwd, since) VALUES (:email, :pwd, CURDATE())");

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

		$login = $this->db->prepare("SELECT * FROM $this->table2 NATURAL JOIN $this->table WHERE idUser = :idUser AND pwd = :pwd");
		$login->execute(array('idUser'=>$idUser, 'pwd'=>$password));
		$result = $login->fetch(PDO::FETCH_ASSOC);

		if($result!=NULL){
			//session_start();
			$_SESSION['idUser'] = $result['idUser'];
			$_SESSION['username'] = $result['username'];
			header('location: '.SERVER.DS.'');
		}

		else return "password";
	}

	function getIDByUserName($login){
		$login1 = $this->db->prepare("SELECT idUser FROM $this->table WHERE username = :login");
		$login1->execute(array('login'=>$login));
		$result = $login1->fetch(PDO::FETCH_ASSOC);

		if(!$result) return false;

		else return $result['idUser'];
	}

	/* Get profile informations by user id */
	function getUserInfo($idUser){
		$info = $this->db->prepare("SELECT avatar, DATE_FORMAT(since, '%d/%m/%Y') AS 'since', favoriteCorpse FROM $this->table2 WHERE idUser = $idUser");
		$info->execute(array());
		$results = $info->fetch(PDO::FETCH_ASSOC);

		return $results;
	}

}

?>