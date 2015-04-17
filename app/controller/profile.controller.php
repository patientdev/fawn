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
	
	if ( !empty($_FILES["photo"]["name"]) ) {

		// Put into user's photo column
		$column = "photo";

		// Get the filename
		$datum = $_FILES["photo"]["name"];

		// Put into this directory based on users ID #
		$target_dir = "app/data/avatars/" . $id . "/";

		// Debug info
		$_SESSION["status"] = $_FILES["photo"];

		// Create the target_dir if it doesn't exist
		if ( !is_dir($_SERVER["DOCUMENT_ROOT"] . $target_dir) ) { mkdir($_SERVER["DOCUMENT_ROOT"] . $target_dir); }

		// Name it 
		$target_file = "/" . $target_dir . basename($datum);

		// Copy it from tmp to destination directory
		move_uploaded_file($_FILES["photo"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"] . $target_dir . $datum);

		// Put the IMG path in the database
		$profile->set($column, $target_file, $id);
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