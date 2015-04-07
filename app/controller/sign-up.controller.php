<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/sign-up.model.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";

session_start();

$signUp = new signUp();

if (isset($_POST["email"]) && isset($_POST["password"])) {

	$email = $_POST["email"];
	$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

	if ( $signUp->emailExists($email) ) {
		$_SESSION["status"] = "It looks like you&rsquo;re already signed&ndash;up. Do you need to <a href=\"\">reset your password</a>?";
		header("Location: /join-us/");
	}

	else { 
		$signUp->confirmEmail($email); 
		$signUp->insertArtist($email, $password);
		$_SESSION["status"] = "Great! You&rsquo;re all signed&ndash;up. We&rsquo;ve sent you an email with a link to click so that we can confirm your email address."; 
		$_SESSION["email"] = $email;
		header("Location: /profile/");
	}
}

else if ( isset($_GET["confirm"])) {
	$_SESSION["email"] = $signUp->activateUser($_GET["confirm"]);
	if ( $_SESSION["email"] === null ) {
		$_SESSION["status"] = "We received an unknown confirmation key somehow.";
		header("Location: /sign-in/");
	}

	else {
		$profile = new Profile();
		include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";
		$_SESSION["email"] = $profile->email;
		$_SESSION["password"] = $profile->password;
	}
}



?>