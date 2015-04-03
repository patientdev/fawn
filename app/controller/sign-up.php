<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/sign-up.php";

session_start();

$signUp = new signUp();

if (!isset($_GET["confirm"])) {

	$email = $_POST["email"];
	$password = crypt($_POST["password"] . microtime().rand());

	if ( $signUp->emailExists($email) ) {
		$_SESSION["status"] = "It looks like you&rsquo;re already signed&ndash;up. Would you like to <a href=\"\">reset your password</a>?";
		header("Location: /join-us/");
	}

	else { 
		$signUp->confirmEmail($email); 
		$signUp->insertArtist($email, $password);
		$_SESSION["status"] = "Great! You&rsquo;re all signed&ndash;up. We&rsquo;ve sent you an email with a link to click so that we can confirm your email address."; 
		header("Location: /profile/");
	}
}

else if ( isset($_GET["confirm"])) {
	$_SESSION["email"] = $signUp->activateUser($_GET["confirm"]);
	header("Location: /profile/");
}



?>