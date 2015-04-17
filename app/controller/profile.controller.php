<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";


	$profile = new Profile();

if ( !isset($_SESSION) ) {
	session_start();
}

// if (!isset($_SESSION["email"])) {
// 	header("Location: /sign-in/");
// }

// else {
// 	$email = $_SESSION["email"];
// 	$password = $profile->gimme("password", "email", $email);
// 	$location = $profile->gimme("location", "email", $email);
// 	$website = $profile->gimme("website", "email", $email);
// }

if ( !empty($_POST) ) {
	
	$id = $_SESSION["id"];

	if ( !empty($_POST["jcrop-x"]) ) {
		include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/photo-upload.controller.php";
	}

	// Unset all the jcrop values. They don't need to go in the database.
	unset($_POST["jcrop-x"]);
	unset($_POST["jcrop-y"]);
	unset($_POST["jcrop-x2"]);
	unset($_POST["jcrop-y2"]);
	unset($_POST["jcrop-h"]);
	unset($_POST["jcrop-w"]);

	foreach ($_POST as $key => $value) {
		if ( !empty($value) ) {
			$column = $key;
			$datum = $value;
			$profile->set($column, $datum, $id);
		}
	}

	header("Location: /profile/");
}

if ( isset($_SESSION["id"]) ) {

	$id = intval($_SESSION["id"]);

	$name = $profile->gimme("name", "id", $id);
	$location = $profile->gimme("location", "id", $id);
	$website = $profile->gimme("website", "id", $id);
	$occupation = $profile->gimme("occupation", "id", $id);
	$about = $profile->gimme("about", "id", $id);
	$summary = $profile->gimme("summary", "id", $id);
	$currentprojects = $profile->gimme("currentprojects", "id", $id);
	$photo = $profile->gimme("photo", "id", $id);

	if ( empty($name) && $_SERVER["REQUEST_URI"] != "/profile/edit/") { header("Location: /profile/edit/"); }
}

?>