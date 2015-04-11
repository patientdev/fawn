<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/sign-in.model.php";

session_start();

$signIn = new signIn();


$email = $_POST["email"];
$password = $_POST["password"];
$remember = $_COOKIE["remember"];

if ($signIn->passwordVerify($email, $password)) {
	$_SESSION["email"] = $email;
	if ( $_COOKIE["remember"] === 'true') {
		$_COOKIE["remember"] = $email;
	}
	header("Location: /profile/");
}

else {
	$_SESSION["status"] = "Sorry! You&rsquo;re login information wasn&rsquo;t recognized. Please try again.";
	header("Location: /sign-in");
}