<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/profile.controller.php";

session_start();


$styles = "

#profile {
	width: 850px;
	margin: 40px auto;
	position: relative;
	padding-top: 40px;
	overflow: visible;
}

#profile-edit {
	position: absolute;
	top: 0; right: 60px;
}

#profile-photo {
	width: 200px;
	height: 200px;
	background-color: #ccc;
	border-radius: 50%;
	text-align: center;
	display: inline-block;
	float: left;
	margin-right: 60px;
}

#info {
	width: 500px;
	display: inline-block;
	text-align: left;
	white-space: nowrap;
}

input {
	border: 1px solid black;
	padding: 15px;
	font-family: Raleway;
	font-size: 0.9em;
	letter-spacing: 3px;
	width: 100%;
	font-style: italic;
}


::-webkit-input-placeholder {
	color: black;
	font-weight: 100;
	font-family: Raleway;
}

:-moz-placeholder { /* Firefox 18- */
	color: black;  
	font-weight: 100;
	font-family: Raleway;
}

::-moz-placeholder {  /* Firefox 19+ */
	color: black;  
	font-weight: 100;
	font-family: Raleway;
}

:-ms-input-placeholder {  
	color: black; 
	font-weight: 100; 
	font-family: Raleway;
}

h3 {
	text-align: left;
	font-size: 1em;
	font-weight: 600;
}

textarea {
	width: 100%;
	font-size: 0.9em;
	padding: 15px;
	letter-spacing: 3px;
	font-style: italic;
	line-height: 1.6em;
	border: 2px solid #ccc;
	margin-bottom: 40px;
}

#summary {
	height: 6em;
}

#about, #current-projects {
	height: 10em;
}

#info input {
	margin-bottom: 30px;
}

#profile-name h2 {
	font-size: 2em;
	font-weight: 700;
	letter-spacing: 15px;
	text-transform: uppercase;
	margin-bottom: 40px;
	display: block;
	margin-top: 0;
	margin-bottom: 40px;
}

#profile-occupation h3 {
	text-transform: uppercase;
	font-weight: 600;
	letter-spacing: 8px;
	font-size: 1.2em;
	margin-bottom: 10px;
	margin-top: 0;
	display: inline-block;
}

#profile-location {
	margin-top: 0;
}

#profile-location h3 {
	text-transform: uppercase;
	font-weight: 400;
	font-size: 1.1em;
	letter-spacing: 8px;
	display: inline-block;
	margin-bottom: 40px;
	margin-top: 0;
}

#profile-website h3 {
	text-transform: lowercase;
	font-size: 1.1em;
	letter-spacing: 8px;
	font-weight: 400;
	border-bottom: 1px solid black;
	display: inline-block;
	margin-top: 0;
}

#profile-summary {
	clear: both;
	margin-top: 60px;
}

#profile-summary div {
	  font-size: 1.4em;
	  font-weight: bold;
	  letter-spacing: 5px;
	  font-style: italic;
	  width: 600px; margin: auto;
	  line-height: 1.6em;
	  text-align: center;
}

#profile-about p, #profile-currentprojects p {
	text-align: left;
}

#profile-about h3, #profile-summary h3, #profile-currentprojects h3 {
	border-bottom: 1px solid black;
	padding-bottom: 25px;
	font-size: 1.2em;
	font-weight: bold;
	margin-bottom: 30px;
}

#profile-summary, #profile-about, #profile-currentprojects {
	margin-bottom: 60px;
}

#save {
	display: none;
}

div.saved {
  font-size: 1.1em;
  font-weight: 400;
  letter-spacing: 3px;
  line-height: 1.4em;
}

";
include_once $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php";
?>



<header>

	<div id="heart">
		<h1><a href="/">Forger</a></h1>
	</div>

</header>

<div id="content">

<div id="profile">

<div id="profile-photo"><span>Upload<br> Profile<br> Photo</span></div>
<div id="info">
	<div id="profile-name">
		<?php if(!empty($name)) { ?>
			<h2 class="saved"><?php echo $name ?></h2>
		<?php } else { ?>
		<?php } ?>
	</div>

	<div id="profile-occupation">
		<?php if(!empty($occupation)) { ?>
			<h3 class="saved"><?php echo $occupation ?></h3>
		<?php } else { ?>
		<?php } ?>
	</div>

	<div id="profile-location">
		<?php if(!empty($location)) { ?>
			<h3 class="saved"><?php echo $location ?></h3>
		<?php } else { ?>
		<?php } ?>
	</div>

	<div id="profile-website">
		<?php if(!empty($website)) { ?>
			<h3 class="saved"><?php echo $website ?></h3>
		<?php } else { ?>
		<?php } ?>
	</div>
</div>

<div style="clear: both;"></div>

<div id="profile-summary">
	<?php if(!empty($summary)) { ?>
		<div><?php echo $summary; ?></div>
	<?php } else { ?>
	<?php } ?>
</div>

<div id="profile-about">
	<?php if(!empty($about)) { ?>
		<h3 class="saved">About</h3>
		<div class="saved"><?php echo $about; ?></div>
	<?php } else { ?>
	<?php } ?>
</div>

<div id="profile-currentprojects">
	<?php if(!empty($currentprojects)) { ?>
		<h3 class="saved">Current Projects</h3>
		<div class="saved"><?php echo $currentprojects ?></div>
	<?php } else { ?>
	<?php } ?>
</div>

</div>

</div>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>