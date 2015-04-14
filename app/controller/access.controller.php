<?php

if ( !isset($_SESSION) ) {
	session_start();
}

// if (!isset($_SESSION["email"])) {
// 	header("Location: /sign-in/");
// }


if ( isset($_SESSION["id"]) && !empty($_SESSION["id"]) && $_SERVER["REQUEST_URI"] === "/sign-in/" )  {
	header("Location: /profile/");
}

else if ( !empty($_COOKIE["remember"]) ) {

	include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";
	$profile = new Profile();

	$_SESSION["id"] = $profile->gimme("id", "remember", $_COOKIE["remember"]);

	if ( $_SERVER["REQUEST_URI"] === "/sign-in/" && !empty($_SESSION["id"]) ) {
		header("Location: /profile/");
	}

}
?>