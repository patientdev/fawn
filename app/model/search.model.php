<?php

class Search {

	public function __construct() {
		require_once $_SERVER["DOCUMENT_ROOT"] . "../protected/db-connect.php";
		$db = new Database;
		$this->con = $db->connect();
	}

	public function results($occupation, $location) {

		$sql = "SELECT id
				FROM artists 
				WHERE (occupation = :occupation AND location = :location)";
		$stmt = $this->con->prepare($sql);
		$stmt->execute(array("occupation" => $occupation, "location" => $location));
		$result = $stmt->fetch();
		return $result;
	}

}

?>