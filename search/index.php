<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/search.controller.php";


$styles = <<< CSS

#content {
	padding: 0;
}

#search-wrapper {
	padding: 40px 0;
	background-image: url(/img/header-background.jpg);
	background-position: 10% 50%; 
	margin-bottom: 10px;
}

#search {
	text-align: center;
	padding: 40px 0;
	background-color: rgba(255, 255, 255, 0.5);
	border-top: 2px solid rgba(0, 0, 0, 0.5);
	border-bottom: 2px solid rgba(0, 0, 0, 0.5);
	overflow: visible;
	white-space: nowrap;
}

#search h3 {
	letter-spacing: 9px;
	font-size: 1.4em;
	margin-top: 0; margin-bottom: 40px;
}

#search select {
	width: 100%;
	border: none;
	border-radius: 0;
	height: 50px;
	background-color: white;
	font-size: 1em;
	font-style: italic;
	letter-spacing: 4px;
	background-color: rgba(240, 240, 240, 1);
	font-weight: 300;
}

#search p {
	display: inline-block;
	margin: 0 30px;
	font-size: 1.1em;
	font-style: italic;
	letter-spacing: 4px;
	line-height: 1.3em;
}

.drop-down {
	background-color: white;
	display: inline-block;
	position: relative;
}

.drop-down:hover {
	cursor: pointer;
}

.drop-down h5 {
	display: inline-block;
	background-color: rgba(255, 255, 255, 1);
	padding: 14px 0 13px 15px;
	color: black;
	font-size: 1.1em;
	font-weight: 400;
	font-style: italic;
	letter-spacing: 8px;
	margin: 0;
}

.drop-down h5:after {
	content: "\\25BE";
	font-style: normal;
	padding: 13px 15px 12px 22px;
	margin-left: 10px;
	background-color: rgba(235, 235, 235, 1);
	color: rgba(137, 137, 137, 1);
}

.drop-down ul {
	display: none;
	list-style-type: none;
	padding: 0;
	margin: 0;
	border-top: 2px solid rgba(235, 235, 235, 1);
	position: absolute;
	width: 100%;
}

.drop-down li {
	font-style: normal;
	padding: 15px 15px 15px 22px;
	background-color: rgba(255, 255, 255, 1);
	color: black;
	text-align: left;
	font-size: 1.2em;
	line-height: 1.4em;
	border-bottom: 2px solid rgba(235, 235, 235, 1);
}

.drop-down li:hover {
	background-color: rgba(125, 164, 221, 1);
	color: white;
}

#results {
	padding: 0 40px;
}

.result {
	padding: 40px 10%;
	border-bottom: 1px solid black;
	text-align: center;
	position: relative;
}

.result:after {
	content: "";
	display: block;
	clear: both;
}

.result a span {
	position:absolute; 
	width:100%;
	height:100%;
	top:0;
	left: 0;

	/* edit: added z-index */
	z-index: 1;

	/* edit: fixes overlap error in IE7/8, 
	 make sure you have an empty gif */
	background-image: url('empty.gif');
}

.photo {
	width: 150px;
	height: 150px;
	background-color: transparent;
	border-radius: 50%;
	text-align: center;
	display: inline-block;
	margin-right: 60px;
	vertical-align: middle;
}

.photo img {
	width: 150px;
	border-radius: 50%;
}

.info {	
	width: 50%;
	display: inline-block;
	text-align: left;
	white-space: nowrap;
	padding-top: 10px;
	vertical-align: middle;
}

.name h2 {
	font-size: 1.7em;
	line-height: 1em;
	font-weight: 700;
	letter-spacing: 10px;
	text-transform: uppercase;
	display: inline-block;
	margin-top: 0;
	margin-bottom: 30px;
}

.info h3 {
	font-size: 1.1em;
	text-transform: uppercase;
	font-weight: 400;
	letter-spacing: 8px;
	margin-top: 0;
}

.occupation h3 {
	margin-bottom: 5px;
}

.location h3 {
	margin-top: 0;
	margin-bottom: 30px;
	font-weight: 300;
}

.summary {
	font-weight: 300;
	letter-spacing: 3px;
	line-height: 1.2em;
	width: 400px;
	white-space: pre-wrap;
}
CSS;

include $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php"; ?>

<div id="search-wrapper">

<div id="search">
		<h3>I&rsquo;m searching for a...</h3>

		<div id="sentence">
			<div class="drop-down" id="search-occupation">
				<h5><?php echo $occupation; ?></h5>
				<ul>
					<li class="option">Photographer</li>
					<li class="option">Musician</li>
					<li class="option">Graphic Designer</li>
					<li class="option">Web developer</li>
				</ul>
			</div>

			<p>who supports</p>

			<div class="drop-down" id="search-cause">
				<h5><?php echo $cause; ?></h5>
				<ul>
					<li class="option">Conservation</li>
					<li class="option">Local Food</li>
					<li class="option">Local Culture</li>
				</ul>
			</div>

			<p>in</p>

			<div class="drop-down" id="search-location">
				<h5><?php echo $location; ?></h5>
				<ul>
					<li class="option">Ithaca, NY</li>
					<li class="option">New York, New York</li>
					<li class="option">Bhangra, India</li>
				</ul>
			</div>
		</div>

		<!-- <div class="drop-down">
			<h5>Cause</h5>
		</div>
		<div class="drop-down">
			<h5>Location</h5>
		</div> -->
	</div>

</div>

<div id="results">

<?php echo $result; ?>

</div>


<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>