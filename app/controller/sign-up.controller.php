<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/access.controller.php";
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

		// Send the user an email to confirm their email address
		$signUp->mailConfirmation($email);

		// Go ahead and get them signed-up and set their identifying number
		$_SESSION["id"] = $signUp->insertArtist($email, $hash);

		// Let them know to check for the confirmation email
		$_SESSION["status"] = "Great! You&rsquo;re all signed&ndash;up. We&rsquo;ve sent you an email with a link to click so that we can confirm your email address. <i>Be sure and double check your spam folder</i> :)"; 

		// Kick them to edit their profile
		header("Location: /profile/edit/");
	}
}

else if ( isset($_GET["confirm"])) {
	$email = $signUp->confirmEmail($_GET["confirm"]);
	if ( $email === null ) {
		$_SESSION["status"] = "We received an unknown confirmation key somehow.";
		header("Location: /join-us/");
	}

	else {
		include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";
		$profile = new Profile();
		$_SESSION["id"] = $profile->gimme("id", "email", $email);
		$_SESSION["status"] = "Thanks for confirming your email.";
		header("Location: /profile/");
	}
}

else if ( isset($_SESSION["id"]) && !empty($_SESSION["id"]) ) {
	header("Location: /profile/");
}



?>