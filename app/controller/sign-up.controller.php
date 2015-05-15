<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/sign-up.model.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";

$signUp = new signUp();


if (isset($_POST["email"]) && isset($_POST["password"])) {

	$email = $_POST["email"];
	$hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

	if ( $signUp->emailExists($email) ) {
		$_SESSION["status"] = "It looks like you&rsquo;re already signed&ndash;up. Do you need to <a href=\"\">reset your password</a>?";
		header("Location: /join-us/");
	}

	else { 
		$signUp->confirmEmail($email, $hash); 
		$_SESSION["status"] = "Great! You&rsquo;re all signed&ndash;up. We&rsquo;ve sent you an email with a link to click so that we can confirm your email address."; 
		header("Location: /join-us/");
	}
}

else if ( isset($_GET["confirm"])) {
	$email = $signUp->activateUser($_GET["confirm"]);
	if ( $email === null ) {
		$_SESSION["status"] = "We received an unknown confirmation key somehow.";
		header("Location: /join-us/");
	}

	else {
		include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";
		$profile = new Profile();
		$_SESSION["id"] = $profile->gimme("id", "email", $email);
		$_SESSION["status"] = "Great! You&rsquo;re all set. Please fill out your profile so people can find you and learn more about you.";
		header("Location: /profile/edit/");
	}
}

else if ( isset($_SESSION["id"]) && !empty($_SESSION["id"]) ) {
	header("Location: /profile/");
}



?>