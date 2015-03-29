<?php
test
$user = "shanecav";
$pass = "nLD&9fURP9yN8";

try {
	$db = new PDO('mysql:host=forger.db;dbname=forgers', $user, $pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die('A database error was encountered.');
}

?>