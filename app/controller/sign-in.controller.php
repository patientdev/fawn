<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/sign-in.model.php";

session_start();

$signIn = new signIn();


$email = $_POST["email"];
$password = $_POST["password"];

if ($signIn->passwordVerify($email, $password)) {
	$_SESSION["email"] = $email;
	$_SESSION["password"] = $password;
	header("Location: /profile/");
}

else header("Location: /");