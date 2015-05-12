<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "app/model/admin.model.php";

	$admin = new Admin;

	if ( $admin->isAdmin($id) ) {

		$newUsers = $admin->newUsers();

		$results = newUserResults($newUsers);

	}

	function newUserResults($newUsers) {
		
		$result = "<table align=center>";

		foreach ( $newUsers as $user ) {
			$photo = "/app/controller/avatar.controller.php?id=" . $user["id"];
			$name = $user["name"];
			$occupation = $user["occupation"];
			$location = $user["location"];
			$summary = $user["summary"];

			$result .= "<tr class=\"result\"><td><input type=\"checkbox\" name=\"id[]\" value=\"" . $user["id"] . "\"></td>";

			// Profile URL
			$result .= "<td><a href=\"/forger/" . $user["id"] . "/\"><span></span></a>";
				
			$result .= "<img src=\"" . $photo . "\"> ";
			$result .= $name;

			$result .= "</td></tr>";
		}

		$result .= "</table>";

		return $result;
	}
?>