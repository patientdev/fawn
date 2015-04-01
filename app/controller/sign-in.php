<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/connect.php";

$email = $_POST["email"];
$password = $_POST["password"];

// See if password is correct
$result = $db->prepare("SELECT password FROM artists WHERE email = :email");
$result->bindParam(':email', $email);
$result->execute();
$correct_pass = ($result->rowCount() > 0) ? true : false;

if ($correct_pass) {

	session_start();

	$_SESSION["email"] = $email;
	$_SESSION["password"] = $password;

	header("Location: /profile/");

} else {

}

$db = null;

?>