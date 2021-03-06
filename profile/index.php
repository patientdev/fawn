<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/profile.controller.php";

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
	border-radius: 50%;
	width: 225px;
	height: 225px;
	overflow: hidden;
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
		width: 100%;
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


$title = "FAWN :: Profile";
include_once $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php";
?>

<div id="status"></div>

<div id="profile">

<div id="profile-edit">
	&#x270e; <button type="button" id="edit">Edit Your Profile</button>
</div>

<div id="profile-photo">
	<?php if(!empty($photo)) { ?>
		<h3><img src="<?php echo $photo; ?>"></h3>
	<?php } ?>
</div>
<div id="info">
	<div id="profile-name">
		<?php if(!empty($name)) { ?>
			<h2><?php echo $name ?></h2>
		<?php } ?>
	</div>

	<div id="profile-occupation">
		<?php if(!empty($occupation)) { ?>
			<h3><?php echo $occupation ?></h3>
		<?php } ?>
	</div>

	<div id="profile-location">
		<?php if(!empty($location)) { ?>
			<h3><?php echo $location ?></h3>
		<?php } ?>
	</div>

	<div id="profile-website">
		<?php if(!empty($website)) { ?>
			<h3><a href="http://<?php echo $website ?>" target="_blank"><?php echo $website ?></a></h3>
		<?php } ?>
	</div>
</div>

<div id="profile-summary">
	<?php if(!empty($summary)) { ?>
		<?php echo $summary ?>
	<?php } ?>
</div>

<div id="profile-about">
	<?php if(!empty($about)) { ?>
		<h3>About</h3>
		<?php echo nl2br($about); ?>
	<?php } ?>
</div>

<div id="profile-currentprojects">
	<?php if(!empty($currentprojects)) { ?>
		<h3>Current Projects</h3>
		<?php echo nl2br($currentprojects); ?>
	<?php } ?>
</div>

</div>

</div>

<?php 

$foot = <<<'JS'
<script>
	$('#edit').click(function(e){ 
		e.preventDefault();
		window.location.href = "edit/";
	});
</script>
JS;


include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>