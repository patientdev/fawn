<?php 

$styles = "

h2 {
	margin: 60px 0;
	font-weight: 600;
	letter-spacing: 14px;
	text-align: center;
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
	border: 1px solid black;
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

p {
	width: 100%;
}
";
include $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php"; ?>


<content>

<h2>Meet Our Team</h2>

<div id="team">

<div class="teammate">

	<div class="teammate-image">
		<img src="img/lydia.jpg">
	</div>

	<div class="teammate-info">
		<span class="teammate-name">Lydia Billings</span>
		<span class="teammate-job">Team Leader</span>
	</div>

</div>

<div class="teammate">

	<div class="teammate-image">

	</div>

	<div class="teammate-info">
		<span class="teammate-name">Shane Cavanaugh</span>
		<span class="teammate-job">Web Development</span>
	</div>

</div>

<div class="teammate">

	<div class="teammate-image">
		<img src="img/gayle.jpg">
	</div>

	<div class="teammate-info">
		<span class="teammate-name">Gayle Damiano</span>
		<span class="teammate-job">Partner Outreach</span>
	</div>

</div>

<div class="teammate">

	<div class="teammate-image">

	</div>

	<div class="teammate-info">
		<span class="teammate-name">Evie Cheung</span>
		<span class="teammate-job">Design</span>
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
	</div>

</div>

</div>

</content>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>