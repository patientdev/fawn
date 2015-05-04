<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";


	$profile = new Profile();

if ( !isset($_SESSION) ) {
	session_start();
}

if ( !empty($_POST) && $_SERVER['REQUEST_URI'] != "/search/" ) {
	
	$id = $_SESSION["id"];

	// Photo upload
	if ( !empty($_FILES["photo"]["name"]) ) {

		$tmp = $_FILES["photo"]["tmp_name"];

		// Put into user's photo column
		$column = "photo";

		// Get the filename
		$filename = $_FILES["photo"]["name"];

		// Get the extension
		$extension = "." . end((explode(".", $filename)));

		// Garble the filename
		$md5filename = md5($filename) . $extension;

		// Put into this directory based on users ID #
		$target_dir = $_SERVER["DOCUMENT_ROOT"] . "../protected/avatars/" . $id . "/";

		// Create the target_dir if it doesn't exist
		if ( !is_dir($target_dir) ) { mkdir($target_dir); }

		// Delete whatevers in there
		$files = glob($_SERVER["DOCUMENT_ROOT"] . "../protected/avatars/" . $id . "/*"); // get all file names
		foreach($files as $file){ // iterate files
		  if(is_file($file))
		    unlink($file); // delete file
		}

		// Copy it from tmp to destination directory
		move_uploaded_file($tmp, $target_dir . $md5filename);

		if ( isset($_POST["jcrop-x"]) ) {

			// Get jcrop values
			$x = intval($_POST["jcrop-x"]);
			$y = intval($_POST["jcrop-y"]);
			$w = intval($_POST["jcrop-w"]);
			$h = intval($_POST["jcrop-h"]);

			// Get file path
			$path = $target_dir . $md5filename;

			// Create photo object from image file path
			$photo = imagecreatefromjpeg($path);

			// Get width and height of incoming photo
			$size = getimagesize($path);
			$width = $size[0];
			$height = $size[1];

			// Now we need to get multipliers for the width and height so we can convert the jcrop selection to the actual size of the image
			$multipler = $width/225;

			// Create destination photo object
			$croppedPhoto = ImageCreateTrueColor( 225, 225 );

			imagecopyresampled($croppedPhoto, $photo, 0, 0, ($x * $multipler), ($y * $multipler), 225, 225, ($w * $multipler), ($h * $multipler));

			imagejpeg($croppedPhoto, $path, 90);

		}

		// Put the IMG filename in the database
		$profile->set($column, $md5filename, $id);
	}

	unset($_POST["jcrop-x"]);
	unset($_POST["jcrop-y"]);
	unset($_POST["jcrop-x2"]);
	unset($_POST["jcrop-y2"]);
	unset($_POST["jcrop-w"]);
	unset($_POST["jcrop-h"]);

	foreach ($_POST as $key => $value) {
		if ( !empty($value) && $key != "photo" ) {

			// Remove "http://" from website value
			if ( $key == "website" ) { $value = str_replace("http://", "", $value); }

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
	$photo = ( !empty($profile->gimme("photo", "id", $id)) ) ? "<img src=\"/app/controller/avatar.controller.php?id=" . $id . "\">" : "";

	if ( empty($name) && $_SERVER["REQUEST_URI"] != "/profile/edit/") { header("Location: /profile/edit/"); }
}

?>