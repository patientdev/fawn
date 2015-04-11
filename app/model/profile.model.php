<?php

class Profile {

	public function __construct() {
		require_once $_SERVER["DOCUMENT_ROOT"] . "../protected/db-connect.php";
		$db = new Database;
		$this->con = $db->connect();
	}

	public function gimme($datum, $column, $id) {
	// Gimme the info about the user that I ask for

		$sql = "SELECT $datum
				FROM `artists` 
				WHERE $column = '$id' LIMIT 1";
		$stmt = $this->con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return nl2br($result);
	}

	public function set($column, $datum, $id) {
	// Set info about the user
		
		$sql = "SELECT id
				FROM artists
				WHERE id = '$id'";
		$stmt = $this->con->prepare($sql);
		$stmt->execute();
		$id = $stmt->fetchColumn();

		$sql = "UPDATE 
					artists 
				SET 
					$column = '$datum'
				WHERE 
					id = '$id'";
		$stmt = $this->con->prepare($sql);
		$stmt->execute();

		return true;
	}
}

?>