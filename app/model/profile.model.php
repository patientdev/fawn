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
				FROM artists 
				WHERE $column = :id LIMIT 1";
		$stmt = $this->con->prepare($sql);
		$stmt->execute(array("id" => $id));
		$result = $stmt->fetchColumn();
		return $result;
	}

	public function set($column, $datum, $id) {
	// Set info about the user

		$sql = "UPDATE 
					artists 
				SET 
					$column = :datum
				WHERE 
					id = :id";
		$stmt = $this->con->prepare($sql);
		$stmt->execute(array("datum" => $datum, "id" => $id));
	}
}

?>