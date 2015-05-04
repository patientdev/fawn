<?php

	include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/access.controller.php";
	include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";

	$profile = new Profile;

	$id = $_SESSION["id"];
	
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