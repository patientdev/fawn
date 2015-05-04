<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/avatar.model.php";

$avatar = new Avatar;

$photo = $_GET["photo"];

if ( isset($_GET["id"]) ) { $avatar->show($_GET["id"]); }

if ( isset($_POST["jcrop-x"]) ) {
	
}

?>