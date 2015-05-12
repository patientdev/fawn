<?php

if ( !isset($_SESSION) ) {
	session_start();
}


if ( isset($_SESSION["id"]) ) {
	$id = $_SESSION["id"];
}

if ( isset($_SESSION["id"]) && !empty($_SESSION["id"]) && $_SERVER["REQUEST_URI"] === "/sign-in/" )  {
	header("Location: /profile/");
}

if ( !isset($_SESSION["id"]) && $_SERVER["REQUEST_URI"] === "/profile/") {
	header("Location: /sign-in/");
}

else if ( !empty($_COOKIE["remember"]) ) {

	include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";
	$profile = new Profile();

	$_SESSION["id"] = $profile->gimme("id", "remember", $_COOKIE["remember"]);

	if ( $_SERVER["REQUEST_URI"] === "/sign-in/" && !empty($_SESSION["id"]) ) {
		header("Location: /profile/");
	}

}

function showStatus() {
	if ( !empty($_SESSION["status"]) ) {
		return "<div id=\"status\">" . $_SESSION["status"] . "</div>";
		unset($_SESSION["status"]);
	}

	else { return false; }
}
?>