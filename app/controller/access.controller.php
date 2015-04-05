<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/access.model.php";

session_start();

$email = isset($_POST['email']) ? $_POST['email'] : $_SESSION['email'];
$password = isset($_POST['password']) ? $_POST['password'] : $_SESSION['password'];

$gatekeeper = new Gatekeeper;

if (isset($email)) {

	if ($gatekeeper->checksOut($email, $password)) {
		$_SESSION["email"] = $email;
		$_SESSION["password"] = $password;
	}

}

else ;

?>