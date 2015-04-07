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
	foreach ($_POST as $key => $value) {
		$value = $value;
		$column = $key;
		$datum = $value;
		$email = $_SESSION["email"];
		$profile->set($column, $datum, "email", $email);
	}
}

if ( isset($_GET["forger"]) ) {

	$id = intval($_GET["forger"]);

	$hash = $profile->gimme("hash", "id", $id);

	$name = $profile->gimme("name", "id", $id);
	$location = $profile->gimme("location", "id", $id);
	$website = $profile->gimme("website", "id", $id);
	$occupation = $profile->gimme("occupation", "id", $id);
	$about = $profile->gimme("about", "id", $id);
	$summary = $profile->gimme("summary", "id", $id);
	$currentprojects = $profile->gimme("currentprojects", "id", $id);
}

if ( isset($_SESSION["email"]) ) {

	$email = $_SESSION["email"];
	$hash = $profile->gimme("hash", "email", $email);

	$name = $profile->gimme("name", "email", $email);
	$location = $profile->gimme("location", "email", $email);
	$website = $profile->gimme("website", "email", $email);
	$occupation = $profile->gimme("occupation", "email", $email);
	$about = $profile->gimme("about", "email", $email);
	$summary = $profile->gimme("summary", "email", $email);
	$currentprojects = $profile->gimme("currentprojects", "email", $email);
}

?>