<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/access.controller.php";

include $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php"; ?>

<header>

<div id="top-bar">
	<div id="heart"><a href="/">Forger</a></div>
	<div id="actions">
		<a id="sign-in-button">Sign In</a>
		<a id="join-us-button">Join Us</a>
	</div>
</div>

<h2>Search Results</h2>

<p><?php echo $_POST["occupation"]; ?></p>
<p><?php echo $_POST["cause"]; ?></p>
<p><?php echo $_POST["location"]; ?></p>

</header>

<content>



</content>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>