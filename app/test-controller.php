<?php

	if ( isset($_POST["id"]) ) {
		include $_SERVER["DOCUMENT_ROOT"] . "app/model/sign-up.model.php";

		$signUp = new signUp;

		echo $signUp->notifySlack($_POST["id"]);
	}

?>