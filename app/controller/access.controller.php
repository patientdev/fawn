<?php

// include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/access.model.php";

session_start();

if (!isset($_SESSION["email"])) {
	header("Location: /sign-in/");
}

?>