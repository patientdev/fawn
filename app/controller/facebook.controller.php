<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "app/model/facebook.model.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "app/model/sign-up.model.php";

$signUp = new signUp();

if ( $signUp->emailExists($_POST["user"]["email"]) ) {
		include_once $_SERVER["DOCUMENT_ROOT"] . "app/model/profile.model.php";
		$profile = new Profile;

		$_SESSION["id"] = $profile->gimme("id", "email", $_POST["user"]["email"]);
}

else {

	$facebook = new Facebook;
	$id = $facebook->activate($_POST["user"]);

	$_SESSION["id"] = $id;
}

?>