<?php 
error_reporting(-1);
ini_set('display_errors', 'On');

if ( isset($_GET["id"]) ) {
	include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/profile.controller.php";

	$profile = new Profile();

	$id = $_GET["id"];

	$photo = $profile->gimme("photo", "id", $id);

	// Get the file extension
	$extension = end((explode(".", $photo)));

	$avatar = $_SERVER["DOCUMENT_ROOT"] . "../protected/avatars/" . $id . "/" . $photo;

	if ( $extension == "jpg" || $extension == "jpeg" ) {
		header("Content-type: image/jpeg");
	}

	else if ( $extension == "png" ) {
		header("Content-type: image/png");
	}

	else if ( $extension == "gif" ) {
		header("Content-type: image/gif");
	}

	readfile($avatar);

}

if ( isset($_POST["jcrop-x"]) ) {
	
}

?>