<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/search.controller.php";

$styles = <<< CSS

#content {
	padding: 0;
}

#search-button {
	display: none; 
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

#results {
	padding: 0 40px;
}

#results h2 {
	font-weight: normal;
	text-align: center;
}

#results h2 strong {
	text-transform: uppercase;
	letter-spacing: 3px;
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
}

.result img {
	-webkit-transition: -webkit-transform .4s ease-out;
}

.result:hover img {
	-webkit-transform: scale(1.2);
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

.name h3 {
	font-size: 1.7em;
	line-height: 1em;
	font-weight: 700;
	letter-spacing: 10px;
	text-transform: uppercase;
	display: inline-block;
	margin-top: 0;
	margin-bottom: 30px;
}

.info h4 {
	font-size: 1.1em;
	text-transform: uppercase;
	font-weight: 400;
	letter-spacing: 8px;
	margin-top: 0;
}

.occupation h4 {
	margin-bottom: 5px;
}

.location h4 {
	margin-top: 0;
	margin-bottom: 30px;
	font-weight: 300;
}

.drop-down h5 {
	overflow: hidden;
}

.drop-down h5:after {
	position: absolute;
	top: 0; right: 0;
	padding: 15px 15px 12px 18px;
}

#nomatch {
	text-align: center;
	padding: 40px 0;

}

@media only screen and (max-width: 840px) {

	#search {
	position: relative;
	font-size: 1em;
	margin-top: 0;
	text-align: center;
	white-space: normal;
	padding: 20px 0;
	clear: both;
	display: none;
}

	#search-wrapper {
		margin-bottom: 0;
		padding: 10px 0 0 0;
	}

	#search h3, #sentence p {
	font-size: 1.2em;
	letter-spacing: 3px;
	font-weight: 300;
	margin-bottom: 20px;
	color: white;
}

	#sentence p {
	display: block;
	margin: 10px 0;
}

	.drop-down {
	width: 240px;
}

	.drop-down h5 {
		font-size: 1em;
		width: 100%;
		position: relative;
		padding: 10px 0 10px 60px;
	}

	.drop-down li {
		font-size: 1em;
	}

	.drop-down h5:before {
		position: absolute;
		left: 0; top: 0;
		padding: 10px 15px 10px 22px;
	}

	#search-button {
		display: block;
		text-align: center;
		padding: 0 10px 10px 10px;
	}

	#search-button:after {
		content: "";
		clear: both;
		display: block;
	}

	#search-button h2 {
		display: inline-block;
		float: left;
		margin: 0;
		padding: 5px 0;
		color: white;
		font-weight: 400;
	}

	#search-button button {
		float: right;
	}

	#search-wrapper {
	}

	#results img {
		width: 60px;
}

	.result {
		margin: auto;
		padding: 20px;
	}

	.photo {
		margin-right: 0;
		margin: 0;
		display: block;
		width: 100%;
		height: 60px;
		text-align: center;
	}

	.info {
		font-size: .9em;
		white-space: normal;
		display: block;
		width: 100%;
		text-align: center;
	}

	.name h3 {
		font-size: 1.2em;
		letter-spacing: 3px;
		margin: 10px 0 20px 0;
	}

	#results {
		padding: 0;
	}

	#results h2 {
		line-height: 1em;
		padding: 0 10px;
		margin-bottom: 0;
	}

}

CSS;

include $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php"; ?>

<div id="search-wrapper">

<div id="search-button">
	<h2>Search Results</h2>
	<button>Search</button>
</div>

<div id="search">
		<h3>I&rsquo;m searching for a...</h3>

		<div id="sentence">
			<div class="drop-down" id="search-occupation" tabindex="1">
				<h5>Occupation</h5>
				<ul>
					<li class="option">Photographer</li>
					<li class="option">Writer</li>
					<li class="option">Web Developer</li>
					<li class="option">Dancer</li>
					<li class="option">Actor</li>
					<li class="option">Musician</li>
					<li class="option">Visual Artist</li>
					<li class="option">Poet</li>
					<li class="option">Sculptor</li>
					<li class="option">Art Therapist</li>
					<li class="option">Arts Educator</li>
					<li class="option">Painter</li>
					<li class="option">Performance Artist</li>
					<li class="option">Graphic Designer</li>
					<li class="option">Filmmaker</li>
					<li class="option">Illustrator</li>
					<li class="option">Printmaker</li>
					<li class="option">Metal Artist</li>
					<li class="option">Glass Artist</li>
					<li class="option">Textile Artist</li>
				</ul>
			</div>

			<p>who supports</p>

			<div class="drop-down" id="search-cause" tabindex="2">
				<h5>Cause</h5>
				<ul>
					<li class="option">Animal Rights</li>
					<li class="option">Disease (HIV/Aids, etc)</li>
					<li class="option">Education</li>
					<li class="option">Environmental/Preservation</li>
					<li class="option">Food/Water Access</li>
					<li class="option">Gender Equality</li>
					<li class="option">Human Trafficking</li>
					<li class="option">International Relations</li>
					<li class="option">LGBT Rights</li>
					<li class="option">Poverty</li>
					<li class="option">Race Relations</li>
					<li class="option">Religious Freedom</li>
					<li class="option">Sustainability</li>
					<li class="option">World Peace</li>
				</ul>
			</div>

			<p>in</p>

			<div class="drop-down" id="search-location" tabindex="3">
				<h5>Location</h5>
				<ul>
					<li class="option">Bangkok</li>
					<li class="option">Bangladesh</li>
					<li class="option">Berlin</li>
					<li class="option">Boston</li>
					<li class="option">Cairo</li>
					<li class="option">Cape Town</li>
					<li class="option">Chicago</li>
					<li class="option">Copenhagen</li>
					<li class="option">Denver</li>
					<li class="option">Dublin</li>
					<li class="option">Hong Kong</li>
					<li class="option">London</li>
					<li class="option">Los Angeles</li>
					<li class="option">Madrid</li>
					<li class="option">Mexico City</li>
					<li class="option">Miami</li>
					<li class="option">Milan</li>
					<li class="option">Montreal</li>
					<li class="option">Moscow</li>
					<li class="option">Mumbai</li>
					<li class="option">New York</li>
					<li class="option">Paris</li>
					<li class="option">Portland</li>
					<li class="option">Prague</li>
					<li class="option">San Fransisco</li>
					<li class="option">Sao Paolo</li>
					<li class="option">Seattle</li>
					<li class="option">Stockholm</li>
					<li class="option">Sydney</li>
					<li class="option">Tokyo</li>
					<li class="option">Toronto</li>
				</ul>
			</div>
		</div>
	</div>

</div>

<div id="results">

<?php echo generateResults($searchOccupation, $searchCause, $searchLocation); ?>

</div>

</div>


<?php 

$foot = <<<JAVASCRIPT
	
	<script>
	$('#search-button button').click(function() {
		$('#search').toggle();
	})
	</script>

JAVASCRIPT;

include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>