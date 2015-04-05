<?php

class Profile {

	public function __construct() {
		require_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/db-connect.php";
		$db = new Database;
		$this->con = $db->connect();
	}

	public function gimme($datum, $email) {
	// Gimme the info about the user that I ask for

		$sql = "SELECT `password`
				FROM `artists` 
				WHERE `email` = `shane@shanecav.net` LIMIT 1";
		$stmt = $this->con->prepare($sql);
		$stmt->bindValue(":datum", $datum);
		$stmt->bindValue(":email", $email);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		echo $result;
	}

	public function set($column, $datum, $email) {
	// Set info about the user
		
		$sql = "SELECT id
				FROM artists
				WHERE email = :email";
		$stmt = $this->con->prepare($sql);
		$stmt->bindValue(":email", $email);
		$stmt->execute();
		$result = $stmt->fetch();
		$id = $result["id"];

		$sql = "UPDATE 
					artists 
				SET 
					$column = $datum
				WHERE 
					email = $email";
		$stmt = $this->con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch();
		echo "blah";
		

	}
}

?>