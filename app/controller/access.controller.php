<?php

// include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/access.model.php";

session_start();

// if (!isset($_SESSION["email"])) {
// 	header("Location: /sign-in/");
// }

if ( !empty($_COOKIE["remember"]) ) {

	include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";
	$profile = new Profile();
	
	if ( $_COOKIE["remember"] === 'true' ) {
		$id = $_SESSION["id"];
		$rememberkey = $profile->gimme("remember", "id", $id);
		setcookie("remember", $rememberkey, time() + 5184000, "/");
	}

	else {
		$cookie = $_COOKIE["remember"];
		$_SESSION["id"] = $profile->gimme("id", "remember", $cookie);
	}

}
?>