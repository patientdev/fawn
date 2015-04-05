<?php

class signIn {

	function __construct() {
		require_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/db-connect.php";
		$db = new Database;
		$this->con = $db->connect();
	}

	public function passwordMatch($email, $password) {
		$password = crypt($password . microtime().rand());
		$stmt = $this->con->prepare("SELECT * FROM artists WHERE email = '$email' AND password = '$password' LIMIT 1");
		$stmt->execute();
		$result = $stmt->fetch();

		if ( $result["password"] === $password ) {
			return true;
		}

		else return false;
	}
	
}

?>