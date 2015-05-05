<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/avatar.model.php";

$avatar = new Avatar;

if ( isset($_GET["id"]) ) { $avatar->show($_GET["id"]); }

?>