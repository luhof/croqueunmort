<?php

class User extends Model{

	function registerUser(){

		$login = $_POST['login'];
		$password = $_POST['password'];
		$email = $_POST['e-mail'];
		$salt = "ichbindusel";
		$password = $password.$salt;
		$password = md5($password);

		try{
			$this->db->beginTransaction();


			$registration1 = $this->db->prepare('INSERT INTO '.$this->table.' (username) VALUES (:login)');
			$registration2 = $this->db->prepare('INSERT INTO '.$this->table2.' (email, pwd, create_time) VALUES (:email, :pwd, CURDATE())');

			$registration1->execute(array(':login'=>$login));
			$registration2->execute(array(':email'=>$email, ':pwd'=>$password));

			$this->db->commit();
		}
		catch(Exception $e){
			$db->rollback();
			echo "erreur : ".$e->getMessage()."<br/>";
			exit();
		}

		return true;
		
	}

}

?>