<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";


	$profile = new Profile();

if ( !isset($_SESSION) ) {
	session_start();
}

if ( !empty($_POST) ) {
	
	$id = $_SESSION["id"];

	// Photo upload
	if ( !empty($_FILES["photo"]["name"]) ) {

		// Put into user's photo column
		$column = "photo";

		// Get the filename
		$filename = $_FILES["photo"]["name"];

		$_SESSION["status"] = $_FILES;

		// Get the extension
		$extension = "." . end((explode(".", $filename)));

		// Garble the filename
		$md5filename = md5($filename) . $extension;

		// Put into this directory based on users ID #
		$target_dir = $_SERVER["DOCUMENT_ROOT"] . "../protected/avatars/" . $id . "/";

		// Create the target_dir if it doesn't exist
		if ( !is_dir($target_dir) ) { mkdir($target_dir); }

		// Delete whatevers int there
		$files = glob($_SERVER["DOCUMENT_ROOT"] . "../protected/avatars/" . $id . "/*"); // get all file names
		foreach($files as $file){ // iterate files
		  if(is_file($file))
		    unlink($file); // delete file
		}

		// Name it 
		$target_file = "/" . $target_dir . $md5filename;

		// Copy it from tmp to destination directory
		move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir . $md5filename);

		// Put the IMG path in the database
		$profile->set($column, $md5filename, $id);
	}

	foreach ($_POST as $key => $value) {
		if ( !empty($value) && $key != "photo" ) {
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
	$photo = "/app/controller/avatar.controller.php?id=" . $id;

	if ( empty($name) && $_SERVER["REQUEST_URI"] != "/profile/edit/") { header("Location: /profile/edit/"); }
}

?>