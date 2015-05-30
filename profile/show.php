<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "app/model/profile.model.php";

	$profile = new Profile;

	$forgerId = intval($_GET["forger"]);

	$forgerName = $profile->gimme("name", "id", $forgerId);
	$forgerLocation = $profile->gimme("location", "id", $forgerId);
	$forgerCause = $profile->gimme("cause", "id", $forgerId);
	$forgerWebsite = $profile->gimme("website", "id", $forgerId);
	$forgerOccupation = $profile->gimme("occupation", "id", $forgerId);
	$forgerAbout = $profile->gimme("about", "id", $forgerId);
	$forgerSummary = $profile->gimme("summary", "id", $forgerId);
	$forgerCurrentprojects = $profile->gimme("currentprojects", "id", $forgerId);

	$forgerPhoto = "/app/controller/avatar.controller.php?id=" . $forgerId;

$styles = <<<CSS

#profile {
	width: 60%; min-width: 960px;
	margin: auto;
	position: relative;
	overflow: visible;
	padding-top: 40px;
}

#profile-edit {
	position: absolute;
	top: 0; right: 60px;
	color: #777;
}

#edit {
	border: none;
	background-color: transparent;
	font-style: italic;
	font-size: .9em;
	letter-spacing: 1px;
	padding: 0;
}

#edit:hover {
	border-bottom: 1px solid #777;
	cursor: pointer;
}

#profile-photo {
	background-color: transparent;
	text-align: center;
	display: inline-block;
	float: left;
	margin-right: 60px;  
	width: 225px;
	height: 225px;
	overflow: hidden;
	border-radius: 50%;
}

#profile-photo img {
	max-width: 225px;
}

#info {	
	width: 60%;
	display: inline-block;
	text-align: left;
	white-space: nowrap;
	padding-top: 10px;
}

#info:after {
	display: block;
	content: \"\";
	clear: both;
}

#profile-name h2 {
	font-size: 2em;
	line-height: 1em;
	font-weight: 700;
	letter-spacing: 10px;
	text-transform: uppercase;
	display: block;
	margin-top: 0;
	margin-bottom: 40px;
}

#profile-occupation h3 {
	margin-bottom: 10px;
}

#profile-location h3 {
	margin-top: 0;
	margin-bottom: 40px;
	font-weight: 200;
}

h3 {
	font-size: 1.1em;
	text-transform: uppercase;
	font-weight: 600;
	letter-spacing: 8px;
	margin-top: 0;
}

#profile-location {
	margin-top: 0;
}

#profile-website a {
	color: black;
	font-weight: 200;
	letter-spacing: 8px;
	text-transform: lowercase;
	text-decoration: none;
	border-bottom: 1px solid black;
}

#profile-summary {
	font-weight: 600;
	font-size: 1.4em;
	line-height: 1.4em;
	letter-spacing: 3px;
	font-style: italic;
	min-width: 80%; margin: auto;
	text-align: center;
	clear: both;

}

#profile-about h3, #profile-currentprojects h3 {
	font-size: 1.4em;
	padding-bottom: 20px;
	border-bottom: 1px solid black;
}

#profile-about {
	margin: 60px 0;
}

#profile-about, #profile-currentprojects {
	text-align: left;
	letter-spacing: 2px;
	line-height: 1.6em;
}

#profile-summary, #profile-about, #profile-currentprojects {
	margin: 60px 0;
}

@media only screen and (max-width: 840px) {

	#profile {
		width: 90%;
		min-width: 0;
		padding-top: 0;
	}

	#profile-edit {
		position: relative;
		width: 100%;
		text-align: center;
		right: 0;
		margin: 20px 0;
	}

	#profile-name {
		margin-bottom: 30px;
	}

	#profile-name h2 {
		font-size: 1.2em;
		line-height: 1em;
		font-weight: 700;
		letter-spacing: 5px;
		text-transform: uppercase;
		text-align: center;
		display: block;
		margin: 0;
	}

	#profile-photo {
		width: 150px;
		height: 150px;
		border-radius: 50%;
		display: block;
		float: none;
		height: auto;
		margin-bottom: 20px;
	}

	#profile-photo h3 {
		margin: 0;
	}

	#profile-photo img {
		width: 150px;
	}

	#info {
		display: block;
		width: 100%;
		margin: 20px 0;
		text-align: center;
	}

	#info h3 {
		margin-bottom: 0;
	}

	#profile-occupation {
		font-size: .8em;
	}

	#profile-location {
		margin-bottom: 20px;
		font-size: .8em;
	}

	#profile-website {
		font-size: .6em;
	}

	#profile-summary {
		margin-top: 0;
		font-size: .8em;
	}

	#profile-summary, #profile-about, #profile-currentprojects {
		margin: 30px 0;
	}

	textarea {
		margin: 0;
	}

	h3 {
		line-height: 1.4em;
		letter-spacing: 5px;
	}
}

CSS;

$title = "FAWN :: {$forgerName}&rsquo;s profile";
include_once $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php";
?>

<div id="status"></div>

<div id="profile">

<div id="profile-photo">
	<?php if(!empty($forgerPhoto)) { ?>
		<h3><img src="<?php echo $forgerPhoto; ?>"></h3>
	<?php } ?>
</div>
<div id="info">
	<div id="profile-name">
		<?php if(!empty($forgerName)) { ?>
			<h2><?php echo $forgerName ?></h2>
		<?php } ?>
	</div>

	<div id="profile-occupation">
		<?php if(!empty($forgerOccupation)) { ?>
			<h3><?php echo $forgerOccupation ?></h3>
		<?php } ?>
	</div>

	<div id="profile-location">
		<?php if(!empty($forgerLocation)) { ?>
			<h3><?php echo $forgerLocation ?></h3>
		<?php } ?>
	</div>

	<div id="profile-website">
		<?php if(!empty($forgerWebsite)) { ?>
			<h3><a href="http://<?php echo $forgerWebsite ?>" target="_blank"><?php echo $forgerWebsite ?></a></h3>
		<?php } ?>
	</div>
</div>

<div id="profile-summary">
	<?php if(!empty($forgerSummary)) { ?>
		<?php echo $forgerSummary ?>
	<?php } ?>
</div>

<div id="profile-about">
	<?php if(!empty($forgerAbout)) { ?>
		<h3>About</h3>
		<?php echo nl2br($forgerAbout); ?>
	<?php } ?>
</div>

<div id="profile-currentprojects">
	<?php if(!empty($forgerCurrentprojects)) { ?>
		<h3>Current Projects</h3>
		<?php echo nl2br($forgerCurrentprojects); ?>
	<?php } ?>
</div>

</div>

</div>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>