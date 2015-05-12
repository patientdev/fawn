<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/search.model.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";

$search = new Search;

$occupation = $_POST["occupation"];
$cause = $_POST["cause"];
$location = $_POST["location"];

$exact = $search->exact($occupation, $cause, $location);
$differentCause = $search->differentCause($occupation, $location);
$differentOccupation = $search->differentOccupation($cause, $location);

if ( !empty($exact) ) { $exactResults = exactResults( $exact ); } 
else { $exact = "No results."; }

if ( !empty($differentCause) ) { $differentCauseResults = differentCause( $differentCause ); } 
else { $exact = "No results."; }

if ( !empty($differentOccupation) ) { $differentOccupationResults = differentOccupation( $differentOccupation ); } 
else { $exact = "No results."; }

function exactResults($results) { 

	$profile = new Profile;

	foreach ( $results as $id ) {
		$photo = "/app/controller/avatar.controller.php?id=" . $id;
		$name = $profile->gimme("name", "id", $id);
		$occupation = $profile->gimme("occupation", "id", $id);
		$location = $profile->gimme("location", "id", $id);
		$summary = $profile->gimme("summary", "id", $id);

		$result = "<div class=\"result\">";

		// Profile URL
		$result .= "<a href=\"/forger/" . $id . "/\"><span></span></a>";
			
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

	return $result;
}

function differentOccupation($results) {
	
	$profile = new Profile;

	foreach ( $results as $id ) {
		$photo = "/app/controller/avatar.controller.php?id=" . $id;
		$name = $profile->gimme("name", "id", $id);
		$occupation = $profile->gimme("occupation", "id", $id);
		$location = $profile->gimme("location", "id", $id);
		$summary = $profile->gimme("summary", "id", $id);

		$result = "<div class=\"result\">";

		// Profile URL
		$result .= "<a href=\"/forger/" . $id . "/\"><span></span></a>";
			
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

	return $result;
}

function differentCause($results) { 
	
	$profile = new Profile;

	foreach ( $results as $id ) {
		$photo = "/app/controller/avatar.controller.php?id=" . $id;
		$name = $profile->gimme("name", "id", $id);
		$occupation = $profile->gimme("occupation", "id", $id);
		$location = $profile->gimme("location", "id", $id);
		$summary = $profile->gimme("summary", "id", $id);

		$result = "<div class=\"result\">";

		// Profile URL
		$result .= "<a href=\"/forger/" . $id . "/\"><span></span></a>";
			
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

	return $result;
}

?>