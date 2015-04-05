<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/access.model.php";

session_start();

$gatekeeper = new Gatekeeper;

$email = $_POST["email"];
$password = $_POST["password"];

if ($gatekeeper->checksOut($email, $password)) {
		$_SESSION["email"] = $email;
		$_SESSION["password"] = crypt($password, microtime().rand());
		header("Location: /profile/");	
}

else { header("Location: /"); }


?>