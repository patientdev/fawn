<?php

class Gatekeeper {

	function __construct() {
		require_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/db-connect.php";
		$db = new Database;
		$this->con = $db->connect();
	}

	public function checksOut($email, $password) {
		$password = password_hash($password, PASSWORD_DEFAULT);
		$stmt = $this->con->prepare("SELECT email FROM artists WHERE email = '$email' AND password = '$password' LIMIT 1");
		$stmt->execute();
		$result = $stmt->fetch();

		if ( $result["email"] === $email) {
			return true;
		}	

		else return false;
	}
}

?>