<?php

class Profile {

	public function __construct() {
		require_once $_SERVER["DOCUMENT_ROOT"] . "../protected/db-connect.php";
		$db = new Database;
		$this->con = $db->connect();
	}

	public function gimme($datum, $email) {
	// Gimme the info about the user that I ask for

		$sql = "SELECT `$datum`
				FROM `artists` 
				WHERE `email` = '$email' LIMIT 1";
		$stmt = $this->con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}

	public function set($column, $datum, $email) {
	// Set info about the user
		
		$sql = "SELECT id
				FROM artists
				WHERE email = :email";
		$stmt = $this->con->prepare($sql);
		$stmt->bindValue(":email", $email);
		$stmt->execute();
		$id = $stmt->fetchColumn();

		$sql = "UPDATE 
					artists 
				SET 
					$column = $datum
				WHERE 
					email = $email";
		$stmt = $this->con->prepare($sql);
		$stmt->execute();

		$_SESSION[$column] = $datum;

		return true;

	}
}

?>