<?php

if ( !isset($_SESSION) ) {
	session_start();
}

	include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";

	$profile = new Profile;

	$id = $_SESSION["id"];

	echo var_dump($_FILES);
	
	if ( !empty($_POST["photo"]) ) {

		// Put into user's photo column
		$column = "photo";

		// Get the filename
		$datum = $_POST["photo"];

		// Put into this directory based on users ID #
		$target_dir = "app/data/avatars/" . $id . "/";

		// Debug info
		$_SESSION["status"] = $_POST["photo"];

		// Create the target_dir if it doesn't exist
		if ( !is_dir($_SERVER["DOCUMENT_ROOT"] . $target_dir) ) { mkdir($_SERVER["DOCUMENT_ROOT"] . $target_dir); }

		// Name it 
		$target_file = "/" . $target_dir . basename($datum);

		// Copy it from tmp to destination directory
		move_uploaded_file($_FILES["photo"], $_SERVER["DOCUMENT_ROOT"] . $target_dir . $datum);

		// Put the IMG path in the database
		$profile->set($column, $target_file, $id);
	}
	
	if ( !empty($_POST["jcrop-x"]) ) {

		// Get jcrop values
		$x = $_POST["jcrop-x"];
		$y = $_POST["jcrop-y"];
		$x2 = $_POST["jcrop-x2"];
		$y2 = $_POST["jcrop-y2"];
		$w = $_POST["jcrop-w"];
		$h = $_POST["jcrop-h"];

		// Create photo object from image file path in database
		$photo = imagecreatefromstring( file_get_contents($profile->gimme("photo", "id", $id)) );

		// 


	}

	?>