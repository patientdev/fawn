<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "app/model/facebook.model.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "app/model/sign-up.model.php";

$signUp = new signUp();

if ( $signUp->emailExists($_POST["user"]["email"]) ) {
		$_SESSION["status"] = "It looks like you&rsquo;re already signed&ndash;up. Do you need to <a href=\"\">reset your password</a>?";
		header("Location: /sign-in/");
}

else {

	$facebook = new Facebook;
	$id = $facebook->activate($_POST["user"]);

	$_SESSION["id"] = $id;
}

?>