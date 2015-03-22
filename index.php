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

<content>

<div id="who-we-are">

	<h3>Who We Are</h3>
	<h4>Forger: A Worldwide Network (FAWN)</h4>

	<p>A united team of passionate individuals using creativity and artistic expression to propel humanity forward, and to empower others to make THE difference they want to make!</p>

	<p class="call-to-action"><a href="/team/">Meet Our Team</a></p>

</div>

<div id="what-were-up-to">

	<h3>What We&rsquo;re Up To</h3>

	<p>We&rsquo;ve created Forger: A Worldwide Network (FAWN) as a space for artists and social activists around the world to connect and collaborate &mdash; via a simple web&ndash;based platform.</p>

	<p>FAWN is a network for communication and collaboration among individuals, as well as businesses and organizations to accomplish their missions through impactful artistic statements.</p>

	<p>At FAWN, we&rsquo;re creating opportunities to build community, both online and offline, that will foster inspiration, beginnings, partnerships, and more!</p>

	<p class="call-to-action"><a href="/join/">Join Our Network</a></p>

</div>

</content>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>