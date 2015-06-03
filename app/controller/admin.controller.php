<?php
	
include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/access.controller.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "app/model/admin.model.php";

	$admin = new Admin;

	if ( $admin->isAdmin($id) ) {

		$newUsers = $admin->newUsers();

		$results = newUserResults($newUsers);

	}

	if ( !empty($_POST) && $admin->isAdmin($id) ) {

		$userIds = $_POST["userIds"];

		if ( $admin->deleteUsers($userIds) ) {
			echo "Buhleted!";
		}

		else { echo "wut went wrong"; }
	}

	function newUserResults($newUsers) {
		
		$result = "<form method=\"POST\" action=\"/app/controller/admin.controller.php\"><table align=center>";

		foreach ( $newUsers as $user ) {
			if ( $user["admin"] === NULL ) {
				$photo = "/app/controller/avatar.controller.php?id=" . $user["id"];
				$name =  $user["name"] . "<br>";
				$email = $user["email"];
				$occupation = $user["occupation"];
				$location = $user["location"];
				$summary = $user["summary"];

				$result .= "<tr class=\"result\"><td><input type=\"checkbox\" name=\"userIds[]\" value=\"" . $user["id"] . "\"></td>";

				// Profile URL
				$result .= "<td><a href=\"/forger/" . $user["id"] . "/\" target=\"_blank\"><span></span></a>";
					
				$result .= "<div class=\"photo\"><img src=\"" . $photo . "\"></div>";
				$result .= "<div class=\"info\">" . $name . $email . "</div>";

				$result .= "</td></tr>";
			}
		}

		$result .= "</table><p><button>Delete Users</button></p></form>";

		return $result;
	}
?>