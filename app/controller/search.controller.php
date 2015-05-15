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
					$exactResult .= "<div class=\"name\"><h3>";
						$exactResult .= $name;
					$exactResult .= "</h3></div>";

					//Occupation
					$exactResult .= "<div class=\"occupation\"><h4>";
						$exactResult .= $occupation;
					$exactResult .= "</h4></div>";

					//Location
					$exactResult .= "<div class=\"location\"><h4>";
						$exactResult .= $location;
					$exactResult .= "</h4></div>";

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

		$differentCauseResult = "<h2>Other artists in <strong>$searchLocation</strong> who support in <strong>$searchCause</strong></h2>";

		foreach ( $differentCause as $id ) {
			$photo = "/app/controller/avatar.controller.php?id=" . $id;
			$name = $profile->gimme("name", "id", $id);
			$occupation = $profile->gimme("occupation", "id", $id);
			$location = $profile->gimme("location", "id", $id);
			$summary = $profile->gimme("summary", "id", $id);

			// Profile URL
			$differentCauseResult .= "<div class=\"result\"><a href=\"/forger/" . $id . "/\"><span></span></a>";
				
				//Photo
				$differentCauseResult .= "<div class=\"photo\">";
					$differentCauseResult .= "<img src=\"" . $photo . "\">";
				$differentCauseResult .= "</div>";

				$differentCauseResult .= "<div class=\"info\">";

					//Name
					$differentCauseResult .= "<div class=\"name\"><h3>";
						$differentCauseResult .= $name;
					$differentCauseResult .= "</h3></div>";

					//Occupation
					$differentCauseResult .= "<div class=\"occupation\"><h4>";
						$differentCauseResult .= $occupation;
					$differentCauseResult .= "</h4></div>";

					//Location
					$differentCauseResult .= "<div class=\"location\"><h4>";
						$differentCauseResult .= $location;
					$differentCauseResult .= "</h4></div>";

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

		$differentOccupationResult = "<h2>Other artists in <strong>$searchLocation</strong></h2>";

		foreach ( $differentOccupation as $id ) {
			$photo = "/app/controller/avatar.controller.php?id=" . $id;
			$name = $profile->gimme("name", "id", $id);
			$occupation = $profile->gimme("occupation", "id", $id);
			$location = $profile->gimme("location", "id", $id);
			$summary = $profile->gimme("summary", "id", $id);

			// Profile URL
			$differentOccupationResult .= "<div class=\"result\"><a href=\"/forger/" . $id . "/\"><span></span></a>";
				
				//Photo
				$differentOccupationResult .= "<div class=\"photo\">";
					$differentOccupationResult .= "<img src=\"" . $photo . "\">";
				$differentOccupationResult .= "</div>";

				$differentOccupationResult .= "<div class=\"info\">";

					//Name
					$differentOccupationResult .= "<div class=\"name\"><h3>";
						$differentOccupationResult .= $name;
					$differentOccupationResult .= "</h3></div>";

					//Occupation
					$differentOccupationResult .= "<div class=\"occupation\"><h4>";
						$differentOccupationResult .= $occupation;
					$differentOccupationResult .= "</h4></div>";

					//Location
					$differentOccupationResult .= "<div class=\"location\"><h4>";
						$differentOccupationResult .= $location;
					$differentOccupationResult .= "</h4></div>";

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