<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/avatar.model.php";

$avatar = new Avatar;

$photo = $_GET["photo"];

echo $avatar->open($photo);

?>