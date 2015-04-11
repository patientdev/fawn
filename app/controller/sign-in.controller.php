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
	
	if ( $remember == 'on') {
		$rememberkey = md5(microtime().rand());
		$profile->set("remember", $rememberkey, $email);
	}

	$_SESSION["id"] = $profile->gimme("id", "email", $email);

	header("Location: /profile/");
}

else {
	$_SESSION["status"] = "Sorry! You&rsquo;re login information wasn&rsquo;t recognized. Please try again.";
	header("Location: /sign-in");
}