<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/connect.php";

session_start();

$_SESSION["email"] = $_POST["email"];
$email = $_SESSION["email"];

$result = $db->prepare("SELECT firstname FROM artists WHERE email = :email");
$result->bindParam(':email', $email);
$result->execute();
$email_exists = ($result->rowCount() > 0) ? true : false;

if($email_exists) {
	header("Location: /join-us/?error");
} else {
	$_SESSION["password"] = crypt($_POST["password"], 'igltt4t5');

	$sql = "INSERT INTO artists (email, password) values(:email, :password)";
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':email', $email);
	$stmt->bindValue(':password', $password);
	$stmt->execute();

	header("Location: /join-us/?success");
}

$db = null;

?>