<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/sign-in.model.php";

session_start();

$signIn = new signIn();

$email = $_POST["email"];
$password = $_POST["password"];
$remember = $_POST["remember"];

if ($signIn->passwordVerify($email, $password)) {
	
	include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";
	$profile = new Profile();

	$_SESSION["id"] = intval($profile->gimme("id", "email", $email));
	
	if ( $remember === "on") {
		$rememberkey = md5(microtime().rand());
		$profile->set("remember", $rememberkey, $_SESSION["id"]);
		setcookie("remember", $rememberkey, time() + 5184000, "/");
	}

	header("Location: /profile/");
}

else {
	$_SESSION["status"] = "Sorry! You&rsquo;re login information wasn&rsquo;t recognized. Please try again.";
	header("Location: /sign-in");
}