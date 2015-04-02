<?php 

include('Mail.php');
include_once $_SERVER["DOCUMENT_ROOT"] . "app/connect.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "app/model/sign-up.php";

session_start();

$result = $db->prepare("SELECT firstname FROM artists WHERE email = :email");
$result->bindParam(':email', $email);
$result->execute();
$email_exists = ($result->rowCount() > 0) ? true : false;

if($email_exists) {
	header("Location: /join-us/?error");
} else {
	$email = $_POST["email"];
	$password = crypt($_POST["password"], microtime().rand());

	$signUp = new signUp;

	$signUp->confirmEmail($email);
	$signUp->insertArtist($email, $password);

	header("Location: /join-us/?success");
}

$db = null;

?>