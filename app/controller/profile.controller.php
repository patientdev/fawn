<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/access.controller.php";
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

	// Photo upload
	if ( !empty($_FILES) ) {

		// Put into user's photo column
		$column = "photo";

		// Get the filename
		$filename = $_FILES["photo"]["name"];

		// Get the extension
		$extension = "." . end((explode(".", $filename)));

		// Garble the filename
		$md5filename = md5($datum) . $extension;

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

	if ( !empty($_POST["jcrop-x"]) ) {
		$x = $_POST["jcrop-x"];
		$y = $_POST["jcrop-y"];
		$x2 = $_POST["jcrop-x2"];
		$y2 = $_POST["jcrop-y2"];
		$h = $_POST["jcrop-h"];
		$w = $_POST["jcrop-w"];

		$targ_w = $targ_h = 250;

		$src = $_SERVER["DOCUMENT_ROOT"] . "../protected/avatars/" > $id . "/" . $profile->gimme("photo", "id", $id);

		$extension = ((end(explode(".", $src))));
		$uncroppedImage;

		if ( $extension == "jpg" || $extension == "jpeg" ) {
			$uncroppedImage = imagecreatefromjpeg($src);
		}

		else if ( $extension == "png" ) {
			$uncroppedImage = imagecreatefrompng($src);
		}

		else if ( $extension == "gif" ) {
			$uncroppedImage = imagecreatefromgif($src);
		}

		$croppedImage = ImageCreateTrueColor( $targ_w, $targ_h );
		imagecopyresampled($croppedImage, $uncroppedImage, 0, 0, $x, $y, $targ_w, $targ_h, $w, $h);

		$target_dir = $_SERVER["DOCUMENT_ROOT"] . "../protected/avatars/" . $id . "/";

		if ( $extension == "jpg" || $extension == "jpeg" ) {
			imagejpeg($croppedImage, $src, 0);
		}

		else if ( $extension == "png" ) {
			imagepng($croppedImage, $src, 0);
		}

		else if ( $extension == "gif" ) {
			imagejpeg($croppedImage, $src, 0);
		}

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
	$photo = "/app/controller/avatar.controller.php?id=" . $id;

	if ( empty($name) && $_SERVER["REQUEST_URI"] != "/profile/edit/") { header("Location: /profile/edit/"); }
}

?>