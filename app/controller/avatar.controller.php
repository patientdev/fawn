<?php 
error_reporting(-1);
ini_set('display_errors', 'On');
include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/profile.controller.php";

$profile = new Profile();

$id = $_GET["id"];

$md5filename = $profile->gimme("photo", "id", $id);

// Get the file extension
$extension = end((explode(".", $md5filename)));

$avatar = $_SERVER["DOCUMENT_ROOT"] . "../protected/avatars/" . $id . "/" . $md5filename;


if ( $extension == "jpg" || $extension == "jpeg" ) {
	header("Content-type: image/jpeg");
	$image=imagecreatefromjpeg($avatar);
	imagejpeg($image);
}

else if ( $extension == "png" ) {
	header("Content-type: image/png");
	$image=imagecreatefrompng($avatar);
	imagepng($image);
}

else if ( $extension == "gif" ) {
	header("Content-type: image/gif");
	$image=imagecreatefromgif($avatar);
	imagegif($image);
}


?>