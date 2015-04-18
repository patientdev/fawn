<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/access.controller.php";

session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
setcookie("remember",'',0,'/');
session_regenerate_id(true);

header("Location: /");

?>