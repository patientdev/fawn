<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/profile.controller.php";

$profile = new Profile();

$id = $_GET["id"];

$avatar = $profile->gimme("photo", "id", $id);

header("Content-type: image/jpeg");

$image=imagecreatefromjpeg($avatar);
imagejpeg($image);

?>