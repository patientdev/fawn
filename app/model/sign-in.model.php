<?php

class signIn {

	function __construct() {
		require_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/db-connect.php";
		$db = new Database;
		$this->con = $db->connect();
	}

	public function passwordVerify($email, $password) {
		include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";
		$profile = new Profile();
		$hash = $profile->gimme("password", $email);

		if (password_verify($password, $hash)) {
			return true;
		} return false;
	}
	
}

?>