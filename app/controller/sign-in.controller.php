<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/sign-in.model.php";

$signIn = new signIn();

$email = $_POST["email"];
$password = $_POST["password"];
$remember = $_POST["remember"];

if ( !empty($_POST["facebook"]) ) {
	
}

else {

	if ($signIn->passwordVerify($email, $password)) {
		
		include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";
		$profile = new Profile();

		$_SESSION["id"] = intval($profile->gimme("id", "email", $email));
		
		if ( $remember === "on") {
			$rememberkey = md5(microtime().rand());
			$profile->set("remember", $rememberkey, $_SESSION["id"]);
			setcookie("remember", $rememberkey, time() + 5184000, "/");
		}

	$_SESSION["debug"] = "blah";
		header("Location: /profile/");
	}

	else if ( isset($_POST["response"]) ) {
	}

	else {
		$_SESSION["status"] = "Sorry! You&rsquo;re login information wasn&rsquo;t recognized. Please try again.";
		header("Location: /sign-in");
	}
}