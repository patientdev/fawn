<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/search.model.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";

$searchOccupation = $_POST["occupation"];
$searchCause = $_POST["cause"];
$searchLocation = $_POST["location"];

function generateResults($searchOccupation, $searchCause, $searchLocation) { 

	$search = new Search;
	$results = $search->results($searchOccupation, $searchCause, $searchLocation);

	list($exact, $differentCause, $differentOccupation) = $results;
	$generatedResults = "";

	$profile = new Profile;

	if ( !empty($exact) ) {
		foreach ( $exact as $id ) {
			$photo = "/app/controller/avatar.controller.php?id=" . $id;
			$name = $profile->gimme("name", "id", $id);
			$occupation = $profile->gimme("occupation", "id", $id);
			$location = $profile->gimme("location", "id", $id);
			$summary = $profile->gimme("summary", "id", $id);

			$exactResult = "<div class=\"result\">";

			// Profile URL
			$exactResult .= "<a href=\"/forger/" . $id . "/\"><span></span></a>";
				
				//Photo
				$exactResult .= "<div class=\"photo\">";
					$exactResult .= "<img src=\"" . $photo . "\">";
				$exactResult .= "</div>";

				$exactResult .= "<div class=\"info\">";

					//Name
					$exactResult .= "<div class=\"name\"><h2>";
						$exactResult .= $name;
					$exactResult .= "</h2></div>";

					//Occupation
					$exactResult .= "<div class=\"occupation\"><h3>";
						$exactResult .= $occupation;
					$exactResult .= "</h3></div>";

					//Location
					$exactResult .= "<div class=\"location\"><h3>";
						$exactResult .= $location;
					$exactResult .= "</h3></div>";

					//Summary
					$exactResult .= "<div class=\"summary\">";
						$exactResult .= $summary;
					$exactResult .= "</div>";

				$exactResult .= "</div>";

			$exactResult .= "</div>";
		}

		$generatedResults .= $exactResult;

	} else { $generatedResults .= "<p id=\"nomatch\">Sorry! No artists match that exact criteria.</p>"; }

	if ( !empty($differentCause) ) {

		foreach ( $differentCause as $id ) {
			$photo = "/app/controller/avatar.controller.php?id=" . $id;
			$name = $profile->gimme("name", "id", $id);
			$occupation = $profile->gimme("occupation", "id", $id);
			$location = $profile->gimme("location", "id", $id);
			$summary = $profile->gimme("summary", "id", $id);

			$differentCauseResult = "<h2>Other Artists in <strong>$searchLocation</strong> interested in <strong>$searchCause</strong></h2><div class=\"result\">";

			// Profile URL
			$differentCauseResult .= "<a href=\"/forger/" . $id . "/\"><span></span></a>";
				
				//Photo
				$differentCauseResult .= "<div class=\"photo\">";
					$differentCauseResult .= "<img src=\"" . $photo . "\">";
				$differentCauseResult .= "</div>";

				$differentCauseResult .= "<div class=\"info\">";

					//Name
					$differentCauseResult .= "<div class=\"name\"><h2>";
						$differentCauseResult .= $name;
					$differentCauseResult .= "</h2></div>";

					//Occupation
					$differentCauseResult .= "<div class=\"occupation\"><h3>";
						$differentCauseResult .= $occupation;
					$differentCauseResult .= "</h3></div>";

					//Location
					$differentCauseResult .= "<div class=\"location\"><h3>";
						$differentCauseResult .= $location;
					$differentCauseResult .= "</h3></div>";

					//Summary
					$differentCauseResult .= "<div class=\"summary\">";
						$differentCauseResult .= $summary;
					$differentCauseResult .= "</div>";

				$differentCauseResult .= "</div>";

			$differentCauseResult .= "</div>";
		}

		$generatedResults .= $differentCauseResult;

	}

	if ( !empty($differentOccupation) ) {

		foreach ( $differentOccupation as $id ) {
			$photo = "/app/controller/avatar.controller.php?id=" . $id;
			$name = $profile->gimme("name", "id", $id);
			$occupation = $profile->gimme("occupation", "id", $id);
			$location = $profile->gimme("location", "id", $id);
			$summary = $profile->gimme("summary", "id", $id);

			$differentOccupationResult = "<h2>Other <strong>${searchOccupation}s</strong> in <strong>$searchLocation</strong></h2><div class=\"result\">";

			// Profile URL
			$differentOccupationResult .= "<a href=\"/forger/" . $id . "/\"><span></span></a>";
				
				//Photo
				$differentOccupationResult .= "<div class=\"photo\">";
					$differentOccupationResult .= "<img src=\"" . $photo . "\">";
				$differentOccupationResult .= "</div>";

				$differentOccupationResult .= "<div class=\"info\">";

					//Name
					$differentOccupationResult .= "<div class=\"name\"><h2>";
						$differentOccupationResult .= $name;
					$differentOccupationResult .= "</h2></div>";

					//Occupation
					$differentOccupationResult .= "<div class=\"occupation\"><h3>";
						$differentOccupationResult .= $occupation;
					$differentOccupationResult .= "</h3></div>";

					//Location
					$differentOccupationResult .= "<div class=\"location\"><h3>";
						$differentOccupationResult .= $location;
					$differentOccupationResult .= "</h3></div>";

					//Summary
					$differentOccupationResult .= "<div class=\"summary\">";
						$differentOccupationResult .= $summary;
					$differentOccupationResult .= "</div>";

				$differentOccupationResult .= "</div>";

			$differentOccupationResult .= "</div>";
		}

		$generatedResults .=  $differentOccupationResult;

	}

	return $generatedResults;

}

?>