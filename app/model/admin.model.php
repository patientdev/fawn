<?php

class Admin {

	public function __construct() {
		require_once $_SERVER["DOCUMENT_ROOT"] . "../protected/db-connect.php";
		$db = new Database;
		$this->con = $db->connect();
	}


	public function isAdmin($id) {

		$stmt = $this->con->prepare("SELECT id FROM artists WHERE id = :id AND admin = TRUE LIMIT 1");
		$stmt->execute(array("id" => $id));
		$result = $stmt->fetch();

		if ( $id = $_SESSION["id"] ) { return true; }
		else return false;

	}

	public function newUsers() {
		$stmt = $this->con->prepare("SELECT * FROM artists");
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

}

?>