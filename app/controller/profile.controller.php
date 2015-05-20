<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";


	$profile = new Profile();

if ( !empty($_POST) && $_SERVER['REQUEST_URI'] != "/search/" ) {
	
	$id = $_SESSION["id"];

	if ( !empty($_FILES["photo"]["name"]) ) { 
		include_once $_SERVER["DOCUMENT_ROOT"] . "app/model/avatar.model.php";

		$avatar = new Avatar;

		$avatar->save($_FILES["photo"], $id); 
	}

	if ( isset($_POST["jcrop-x"]) && $_POST["jcrop-x2"] != 0 ) {

		// Create array to hold jcrop values
		$jcrop = array();

		// Push incoming jcrop values to jcrop[]
		array_push($jcrop, $_POST["jcrop-x"], $_POST["jcrop-y"], $_POST["jcrop-x2"], $_POST["jcrop-y2"]);

		// Get Avatar class so we can crop
		include_once $_SERVER["DOCUMENT_ROOT"] . "app/model/avatar.model.php";
		$avatar = new Avatar;

		$avatar->crop($jcrop, $id);
	}

	unset($_POST["jcrop-x"]);
	unset($_POST["jcrop-y"]);
	unset($_POST["jcrop-x2"]);
	unset($_POST["jcrop-y2"]);

	foreach ($_POST as $key => $value) {

		// Convert array variables to ,-concatenated strings
		if ( is_array($value) ) { $value = implode(",", $value); }

		if ( $key != "photo" ) {

			// Remove "http://" from website value
			if ( $key == "website" ) { $value = str_replace("http://", "", $value); }

			$column = $key;
			$datum = $value;
			$profile->set($column, $datum, $id);
		}
	}

	header("Location: /profile/");
}

if ( isset($_SESSION["id"]) ) {

	$id = intval($_SESSION["id"]);

	$name = $profile->gimme("name", "id", $id);
	$location = $profile->gimme("location", "id", $id);
	$otherlocations = $profile->gimme("otherlocations", "id", $id);
	$cause = $profile->gimme("cause", "id", $id);
	$othercauses = $profile->gimme("othercauses", "id", $id);
	$website = $profile->gimme("website", "id", $id);
	$occupation = $profile->gimme("occupation", "id", $id);
	$otheroccupations = $profile->gimme("otheroccupations", "id", $id);
	$about = $profile->gimme("about", "id", $id);
	$summary = $profile->gimme("summary", "id", $id);
	$currentprojects = $profile->gimme("currentprojects", "id", $id);

	include_once $_SERVER["DOCUMENT_ROOT"] . "app/model/avatar.model.php";
	$avatar = new Avatar;
	$photo = "/app/controller/avatar.controller.php?id=" . $id;
}

function generateDropDowns($list, $title) {

	$array = [];

	$array = explode(",", $list);

	$dropDowns = "";
	$dropDownList = "";
	$dropDownItems = "";
	$dropDown = "";

	if ( $title = "cause") {
		$dropDownItems = <<<HTML
<ul>
	<li class="option">Gender Equality</li>
	<li class="option">LGBT Rights</li>
	<li class="option">Race Relations</li>
	<li class="option">Environmental/Preservation</li>
	<li class="option">International Relations</li>
	<li class="option">Animal Rights</li>
	<li class="option">Food/Water Access</li>
	<li class="option">Poverty</li>
	<li class="option">Disease (HIV/Aids, etc)</li>
	<li class="option">Religious Freedom</li>
	<li class="option">Education</li>
	<li class="option">Sustainability</li>
	<li class="option">World Peace</li>
	<li class="option">Human Trafficking</li>
	<li class="option other">Other...</li>
</ul>
HTML;					
	}

	else if ( $title = "location" ) {
		$dropDownItems = <<<HTML
<ul>
	<li class="option">New York</li>
	<li class="option">Miami</li>
	<li class="option">Denver</li>
	<li class="option">San Fransisco</li>
	<li class="option">Boston</li>
	<li class="option">Berlin</li>
	<li class="option">Portland</li>
	<li class="option">Los Angeles</li>
	<li class="option">Chicago</li>
	<li class="option">Madrid</li>
	<li class="option">Prague</li>
	<li class="option">Paris</li>
	<li class="option">London</li>
	<li class="option">Seattle</li>
	<li class="option">Mumbai</li>
	<li class="option">Milan</li>
	<li class="option">Sydney</li>
	<li class="option">Hong Kong</li>
	<li class="option">Tokyo</li>
	<li class="option">Cape Town</li>
	<li class="option">Montreal</li>
	<li class="option">Toronto</li>
	<li class="option">Mexico City</li>
	<li class="option">Sao Paolo</li>
	<li class="option">Cairo</li>
	<li class="option">Dublin</li>
	<li class="option">Copenhagen</li>
	<li class="option">Stockholm</li>
	<li class="option">Bangladesh</li>
	<li class="option">Bangkok</li>
	<li class="option">Moscow</li>
	<li class="option other">Other</li>
</ul>
HTML;	
	}

	else if ( $title = "occupation" ) {
		$dropDownItems = <<<HTML
<ul>
	<li class="option">Photographer</li>
	<li class="option">Writer</li>
	<li class="option">Web Developer</li>
	<li class="option">Dancer</li>
	<li class="option">Actor</li>
	<li class="option">Musician</li>
	<li class="option">Visual Artist</li>
	<li class="option">Poet</li>
	<li class="option">Sculptor</li>
	<li class="option">Art Therapist</li>
	<li class="option">Arts Educator</li>
	<li class="option">Painter</li>
	<li class="option">Performance Artist</li>
	<li class="option">Graphic Designer</li>
	<li class="option">Filmmaker</li>
	<li class="option">Illustrator</li>
	<li class="option">Printmaker</li>
	<li class="option">Metal Artist</li>
	<li class="option">Glass Artist</li>
	<li class="option">Textile Artist</li>
	<li class="option other">Other...</li>
</ul>
HTML;	
	}

	if ( !empty($array) ) {

		foreach ( $array as $key => $value ) {
			$dropDown = <<<HTML
								<div class="drop-down" tabindex="">
								<h5>$value</h5>
								$dropDownList = <ul>$dropDownItems</ul>;

								<input class="drop-down-input" type="text" name="$title\[\]" placeholder="ucword($title)" class="editing" value="$value">

								</div>
HTML;
			$dropDowns .= $dropDown;
	}

return var_dump($array);

}

?>