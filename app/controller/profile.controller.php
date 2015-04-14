<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";


	$profile = new Profile();

session_start();

// if (!isset($_SESSION["email"])) {
// 	header("Location: /sign-in/");
// }

// else {
// 	$email = $_SESSION["email"];
// 	$password = $profile->gimme("password", "email", $email);
// 	$location = $profile->gimme("location", "email", $email);
// 	$website = $profile->gimme("website", "email", $email);
// }

if ( !empty($_POST) ) {
	
	$id = $_SESSION["id"];

	if ( !empty($_POST["jcrop-x"]) ) {
		$targ_w = $targ_h = 255;
		$jpeg_quality = 90;

		$src = $_SERVER["DOCUMENT_ROOT"] . $profile->gimme("photo", "id", $id);
		$img_r = imagecreatefromjpeg($src);
		$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

		$target_dir = "app/data/avatars/" . $id . "/";
		$target_file = $target_dir . "jcropped.jpg";

		imagecopyresampled($dst_r,$img_r,0,0,$_POST['jcrop-x'],$_POST['jcrop-y'],
		    $targ_w,$targ_h,$_POST['jcrop-w'],$_POST['jcrop-h']);

		imagejpeg($dst_r, $_SERVER["DOCUMENT_ROOT"] . $_SERVER["DOCUMENT_ROOT"] . $target_dir . "/jcropped.jpg", $jpeg_quality);

		$profile->set($column, $target_file, $id);
	}
	
	if ( !empty($_FILES["photo"]["name"]) ) {
		$column = "photo";
		$datum = $_FILES["photo"]["name"];

		$target_dir = "app/data/avatars/" . $id . "/";

		$_SESSION["status"] = $_FILES["photo"];

		if ( !is_dir($_SERVER["DOCUMENT_ROOT"] . $target_dir) ) { mkdir($_SERVER["DOCUMENT_ROOT"] . $target_dir); }

		$target_file = $target_dir . basename($datum);
		move_uploaded_file($_FILES["photo"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"] . $target_dir . $datum);

		$profile->set($column, $target_file, $id);
	}

	foreach ($_POST as $key => $value) {
		if ( !empty($value) ) {
			$column = $key;
			$datum = $value;
			$profile->set($column, $datum, $id);
		}
	}

	header("Location: /profile/");
}

if ( isset($_SESSION["id"]) ) {

	$id = intval($_SESSION["id"]);

	$name = $profile->gimme("name", "id", $id);
	$location = $profile->gimme("location", "id", $id);
	$website = $profile->gimme("website", "id", $id);
	$occupation = $profile->gimme("occupation", "id", $id);
	$about = $profile->gimme("about", "id", $id);
	$summary = $profile->gimme("summary", "id", $id);
	$currentprojects = $profile->gimme("currentprojects", "id", $id);
	$photo = $profile->gimme("photo", "id", $id);

	if ( empty($name) && $_SERVER["REQUEST_URI"] != "/profile/edit/") { header("Location: edit/"); }
}

?>