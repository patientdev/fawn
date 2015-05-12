<?php

class Search {

	public function __construct() {
		require_once $_SERVER["DOCUMENT_ROOT"] . "../protected/db-connect.php";
		$db = new Database;
		$this->con = $db->connect();
	}

	public function exact($occupation, $cause, $location) {

		$sql = "SELECT id
				FROM artists 
				WHERE (occupation = :occupation AND cause = :cause AND location = :location)";
		$stmt = $this->con->prepare($sql);
		$stmt->execute(array("occupation" => $occupation, "location" => $location, "cause" => $cause));
		$result = $stmt->fetch();
		return $result;

	}

	public function differentCause($occupation, $location) {

		$sql = "SELECT id
				FROM artists 
				WHERE (occupation = :occupation AND location = :location)";
		$stmt = $this->con->prepare($sql);
		$stmt->execute(array("occupation" => $occupation, "location" => $location));
		$result = $stmt->fetch();
		return $result;

	}

	public function differentOccupation($cause, $location) {

		$sql = "SELECT id
				FROM artists 
				WHERE (cause = :cause AND location = :location)";
		$stmt = $this->con->prepare($sql);
		$stmt->execute(array("cause" => $cause, "location" => $location));
		$result = $stmt->fetch();
		return $result;

	}

}

?>