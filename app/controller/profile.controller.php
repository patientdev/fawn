<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";


	$profile = new Profile();

session_start();

// if (!isset($_SESSION["email"])) {
// 	header("Location: /sign-in/");
// }

// else {
// 	$email = $_SESSION["email"];
// 	$password = $profile->gimme("password", $email);
// 	$location = $profile->gimme("location", $email);
// 	$website = $profile->gimme("website", $email);
// }

if ( !empty($_POST) ) {
	foreach ($_POST as $key => $value) {
		$value = $value;
		$column = $key;
		$datum = $value;
		$email = $_SESSION["email"];
		$profile->set($column, $datum, $email);
	}
}

echo $_GET["forger"];

?>