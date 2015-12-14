<?php

class Search {

	public function __construct() {
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../protected/db-connect.php";
		$db = new Database;
		$this->con = $db->connect();
	}

	public function results($occupation, $cause, $location) {

		$results = $exact = $differentCause = $differentOccupation = $locationOnly = array();

		$sql = "SELECT id, occupation, cause, location
				FROM artists 
				WHERE location = :location";
		$stmt = $this->con->prepare($sql);
		$stmt->execute(array("location" => $location));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		foreach ( $result as $user ) {
			if ( $user["occupation"] == $occupation && $user["cause"] == $cause ) {
				array_push($exact, $user["id"]);
			}

			if ( $user["cause"] != $cause && $user["occupation"] == $occupation ) {
				array_push($differentCause, $user["id"]);
			}

			if ( $user["occupation"] != $occupation && $user["cause"] == $cause ) {
				array_push($differentOccupation, $user["id"]);
			}

			if ( $user["occupation"] != $occupation && $user["cause"] != $cause ) {
				array_push($locationOnly, $user["id"]);
			}
		}

		array_push($results, $exact, $differentCause, $differentOccupation, $locationOnly);

		return $results;
	}

}

?>