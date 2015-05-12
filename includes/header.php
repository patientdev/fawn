<?php $debug = false; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Forger: A Worldwide Network</title>
        <meta name="description" content="Elevating Creativity That Makes A Difference">

		<link href='http://fonts.googleapis.com/css?family=Raleway:200,300,400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="/css/fawn.css" media="screen">
		<link rel="stylesheet" href="/css/mobile.css" media="only screen and (max-width: 840px)">

		<?php if (isset($styles)) { echo "<style>$styles</style>"; } ?>
		<?php if (isset($head)) { echo $head; } ?>

		<?php // include $_SERVER["DOCUMENT_ROOT"] . "/js/analytics.js" ?>
	</head>
	<body>

	<?php if ( $debug === true ) { 
		ini_set('display_errors', 'On');
		error_reporting(E_ALL); 
		?>
		
		<div id="debug"><?php echo var_dump($_SESSION); ?></div> 
	
	<?php } ?>

	<header>
		<div id="logo">
			<h1><a href="/"><img src="/img/fawn-logo-transparent.png"></a></h1>
		</div>

		<div id="actions">
			<div id="menu">
				<button>Menu</button>
			</div>
			<?php if ( isset($_SESSION["id"]) ) { 
				include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/profile.controller.php"; ?>
				<a href="/profile/signout" id="sign-in-button">Sign&ndash;Out</a>
				<a href="/profile" id="sign-in-button">Profile <img src="<?php echo $photo; ?>"></a>
			<?php } else { ?>
				<a href="/sign-in" id="sign-in-button">Sign In</a>
				<a href="/join-us" id="join-us-button">Join Us</a>
			<?php } ?>
		</div>

		<div id="menu-options">
			<div>
				<?php if ( isset($_SESSION["id"]) ) { 
					include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/profile.controller.php"; ?>
					<a href="/profile" id="sign-in-button"><img src="<?php echo $photo; ?>"> Profile</a>
					<a href="/profile/signout" id="sign-in-button">Sign&ndash;Out</a>
				<?php } else { ?>
					<a href="/sign-in" id="sign-in-button">Sign In</a>
					<a href="/join-us" id="join-us-button">Join Us</a>
				<?php } ?>
			</div>
		</div>
	</header>

	<div id="content">

	<?php if ( isset($_SESSION["status"]) ) { echo $_SESSION["status"]; unset($_SESSION["status"]); } ?>
