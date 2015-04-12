<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";


	$profile = new Profile();

session_start();

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
		$column = "photo";
		$datum = $_FILES["photo"]["name"];

		$target_dir = "app/data/avatars/" . $id . "/";

		$_SESSION["status"] = $_FILES["photo"];

		if ( !is_dir($_SERVER["DOCUMENT_ROOT"] . $target_dir) ) { mkdir($_SERVER["DOCUMENT_ROOT"] . $target_dir); }

		$target_file = $target_dir . basename($datum);
		move_uploaded_file($_FILES["photo"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"] . $target_dir . $datum);

		$profile->set($column, $target_file, $id);
	}

	foreach ($_POST as $key => $value) {
		$column = $key;
		$datum = $value;
		$profile->set($column, $datum, $id);
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

	if ( empty($name )) { header("Location: edit/"); }
}

?>