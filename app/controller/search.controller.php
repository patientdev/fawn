<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/search.model.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";

$search = new Search;
$profile = new Profile;

$occupation = $_POST["occupation"];
$cause = $_POST["cause"];
$location = $_POST["location"];

$results = $search->results($occupation, $location);

foreach ( $results as $key => $id ) {
	$photo = "/app/controller/avatar.controller.php?id=" . $id;
	$name = $profile->gimme("name", "id", $id);
	$occupation = $profile->gimme("occupation", "id", $id);
	$location = $profile->gimme("location", "id", $id);
	$summary = $profile->gimme("summary", "id", $id);

	$result = "<div class=\"result\">";
		
		//Photo
		$result .= "<div class=\"photo\">";
			$result .= "<img src=\"" . $photo . "\">";
		$result .= "</div>";

		$result .= "<div class=\"info\">";

			//Name
			$result .= "<div class=\"name\"><h2>";
				$result .= $name;
			$result .= "</h2></div>";

			//Occupation
			$result .= "<div class=\"occupation\"><h3>";
				$result .= $occupation;
			$result .= "</h3></div>";

			//Location
			$result .= "<div class=\"location\"><h3>";
				$result .= $location;
			$result .= "</h3></div>";

			//Summary
			$result .= "<div class=\"summary\">";
				$result .= $summary;
			$result .= "</div>";

		$result .= "</div>";

	$result .= "</div>";
}

?>