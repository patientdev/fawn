<?php 

$styles = "";
include $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php"; ?>

<header>

<div id="top-bar">
	<div id="heart"><a href="/">Forger</a></div>
	<div id="actions">
		<button id="sign-in-button">Sign In</button>
		<button id="join-us-button">Join Us</button>
	</div>
</div>

<div id="headline">
	<h1>A Worldwide Network</h1>
	<h2>Elevating Creativity That Makes A Difference</h2>
</div>

<div id="search">
	<h3>I&rsquo;m searching for a...</h3>
	<div id="selection">
		<select>
			<option value="" class="option-selected" disabled selected>Occupation</option>
		</select>
		<p>who<br> supports</p>
		<select>
			<option value="" class="option-selected" disabled selected>Cause</option>
		</select>
		<p>in</p>
		<select>
			<option value="" class="option-selected" disabled selected>Location</option>
		</select>
	</div>
</div>
</header>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>