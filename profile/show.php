<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/model/profile.model.php";

$profile = new Profile();

$forger = intval($_GET["forger"]);

$username = $profile->gimme("name", "id", $forger);
$userlocation = $profile->gimme("location", "id", $forger);
$userwebsite = $profile->gimme("website", "id", $forger);
$useroccupation = $profile->gimme("occupation", "id", $forger);
$userabout = $profile->gimme("about", "id", $forger);
$usersummary = $profile->gimme("summary", "id", $forger);
$usercurrentprojects = $profile->gimme("currentprojects", "id", $forger);
$userphoto = "/app/controller/avatar.controller.php?id=" . $forger;

$styles = "

#profile {
	width: 60%; min-width: 715px;
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
	width: 225px;
	height: 225px;
	background-color: transparent;
	border-radius: 50%;
	text-align: center;
	display: inline-block;
	float: left;
	margin-right: 60px;
}

#profile-photo img {
	width: 225px;
	border-radius: 50%;
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

#profile-summary div{
	clear: both;
	font-weight: 600;
	font-size: 1.4em;
	line-height: 1.4em;
	letter-spacing: 3px;
	font-style: italic;
	width: 80%; margin: auto;
	text-align: center;

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
	clear: both;
}

";
include_once $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php";
?>

<div id="profile">

	<?php 
	if ( $forger == intval(basename($_SERVER['REQUEST_URI'])) ) { ?>
		<div id="profile-edit">
			&#x270e; <button type="button" id="edit">Edit Your Profile</button>
		</div>
	<?php } ?>

	<div id="profile-photo">
		<?php if(!empty($userphoto)) { ?>
			<h3><?php echo "<img src=\"" . $userphoto . "\">"; ?></h3>
		<?php } else { ?>
			<?php } ?>
	</div>

	<div id="info">
			<div id="profile-name">
				<?php if(!empty($username)) { ?>
					<h2 class="saved"><?php echo $username ?></h2>
				<?php } else { ?>
				<?php } ?>
			</div>

			<div id="profile-occupation">
				<?php if(!empty($useroccupation)) { ?>
					<h3 class="saved"><?php echo $useroccupation ?></h3>
				<?php } else { ?>
				<?php } ?>
			</div>

			<div id="profile-location">
				<?php if(!empty($userlocation)) { ?>
					<h3 class="saved"><?php echo $userlocation ?></h3>
				<?php } else { ?>
				<?php } ?>
			</div>

			<div id="profile-website">
				<?php if(!empty($userwebsite)) { ?>
					<h3><a href="http://<?php echo $userwebsite ?>" target="_blank"><?php echo $userwebsite ?></a></h3>
				<?php } ?>
			</div>
		</div>

		<div style="clear: both;"></div>

		<div id="profile-summary">
			<?php if(!empty($usersummary)) { ?>
				<div><?php echo $usersummary; ?></div>
			<?php } else { ?>
			<?php } ?>
		</div>

		<div id="profile-about">
			<?php if(!empty($userabout)) { ?>
				<h3 class="saved">About</h3>
				<div class="saved"><?php echo $userabout; ?></div>
			<?php } else { ?>
			<?php } ?>
		</div>

		<div id="profile-currentprojects">
			<?php if(!empty($usercurrentprojects)) { ?>
				<h3 class="saved">Current Projects</h3>
				<div class="saved"><?php echo $usercurrentprojects ?></div>
			<?php } else { ?>
			<?php } ?>
		</div>

	</div>

</div>


<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>