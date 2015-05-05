<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";


	$profile = new Profile();

if ( !empty($_POST) && $_SERVER['REQUEST_URI'] != "/search/" ) {
	
	$id = $_SESSION["id"];

	if ( !empty($_FILES["photo"]["name"]) ) { 
		include_once $_SERVER["DOCUMENT_ROOT"] . "app/model/avatar.model.php";

		$avatar = new Avatar;

		$avatar->save($_FILES["photo"], $id); 
	}

	if ( isset($_POST["jcrop-x"]) ) {
		$jcrop[] = [$_POST["jcrop-x"], $_POST["jcrop-y"], $_POST["jcrop-x2"], $_POST["jcrop-y2"], $_POST["jcrop-w"], $_POST["jcrop-h"]];

		include_once $_SERVER["DOCUMENT_ROOT"] . "app/model/avatar.model.php";

		$avatar = new Avatar;

		$avatar->crop($jcrop, $id);
	}

	foreach ($_POST as $key => $value) {
		if ( !empty($value) && $key != "photo" ) {
		$_SESSION["debug"] = "blah";

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

	include_once $_SERVER["DOCUMENT_ROOT"] . "app/model/avatar.model.php";
	$avatar = new Avatar;
	$photo = "/app/controller/avatar.controller.php?id=" . $id;

	if ( empty($name) && $_SERVER["REQUEST_URI"] != "/profile/edit/") { header("Location: /profile/edit/"); }
}

?>