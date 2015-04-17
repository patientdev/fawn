<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/access.controller.php";

$styles = "

h2 {
	margin: 20px 0 60px 0;
	font-weight: bold;
	text-transform: uppercase;
	letter-spacing: 14px;
	text-align: center;
	font-size: 2em;
}

#team {
	width: 70%;
	margin: auto;
}

.teammate {
	width: 33%;
	display: inline-block;
	text-align: center;
	margin-bottom: 40px;
}

.teammate-image img {
	width: 200px;
	height: 200px;
	border-radius: 50%;
	margin: 0 auto 20px auto;
}

.teammate-info span {
	display: block;
	margin-bottom: 10px;
	text-transform: uppercase;
	letter-spacing: 6px;
}

.teammate-name {
	font-weight: 700;
	font-size: 0.9em;
}

.teammate-job {
	font-weight: 400;
	font-size: 0.9em;
}

.teammate-website a {
	color: black;
	font-size: 0.8em;
	text-decoration: underline;
}

p {
	width: 100%;
}
";
include $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php"; ?>



<h2>Meet Our Team</h2>

<div id="team">

<div class="teammate">

	<div class="teammate-image">
		<img src="img/lydia.jpg">
	</div>

	<div class="teammate-info">
		<span class="teammate-name">Lydia Billings</span>
		<span class="teammate-job">Team Leader</span>
		<span class="teammate-website"><a href="http://lydiabillings.com">lydiabillings.com</a></span>
	</div>

</div>

<div class="teammate">

	<div class="teammate-image">
		<img src="img/shane.jpg">
	</div>

	<div class="teammate-info">
		<span class="teammate-name">Shane Cavanaugh</span>
		<span class="teammate-job">Web Development</span>
		<span class="teammate-website"><a href="http://shanecav.net">shanecav.net</a></span>
	</div>

</div>

<div class="teammate">

	<div class="teammate-image">
		<img src="img/gayle.jpg">
	</div>

	<div class="teammate-info">
		<span class="teammate-name">Gayle Damiano</span>
		<span class="teammate-job">Partner Outreach</span>
		<span class="teammate-website"><a href="http://YourHappinessMatters.org">YourHappinessMatters.org</a></span>
	</div>

</div>

<div class="teammate">

	<div class="teammate-image">
		<img src="img/evie.jpg">
	</div>

	<div class="teammate-info">
		<span class="teammate-name">Evie Cheung</span>
		<span class="teammate-job">Design</span>
		<span class="teammate-website"><a href="http://www.eviecheung.com">www.eviecheung.com</a></span>
	</div>

</div>

<div class="teammate">

	<div class="teammate-image">

	</div>

	<div class="teammate-info">
		<span class="teammate-name">Samantha Addeo</span>
		<span class="teammate-job">Partner Outreach</span>
	</div>

</div>

<div class="teammate">

	<div class="teammate-image">
		<img src="img/meghan.jpg">
	</div>

	<div class="teammate-info">
		<span class="teammate-name">Megan Jordan</span>
		<span class="teammate-job">Admin Guru</span>
		<span class="teammate-website"><a href="http://meghanjordan.com">meghanjordan.com</a></span>
	</div>

</div>

</div>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>