<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/access.controller.php";

$styles = <<<CSS
body {
	background-image: url(/img/header-background.jpg);
	background-size: 110%;
	background-color: transparent;
	background-repeat: no-repeat;
	-webkit-transition: background-position 0s linear;
	webkit-transform: translate3d(0, 0, 0);
}

header {
	background-color: transparent;
}

#join-us-button {
	border: 4px solid rgba(125, 164, 221, 1);
	background-color: transparent;
}

#content {
	padding-top: 0;
	top: 0;
}

#intro {
	height: 100vh;
	color: white;
	position: relative;
	padding-top: 150px;
}

#search {
	position: absolute;
	top: 50%;
	width: 100%;
	text-align: center;
	margin-top: 120px;
	padding: 50px 0;
	background-color: rgba(255, 255, 255, 0.35);
	border-top: 2px solid rgba(0, 0, 0, 0.5);
	border-bottom: 2px solid rgba(0, 0, 0, 0.5);
	overflow: visible;
	white-space: nowrap;
}

#search h3 {
	letter-spacing: 9px;
	font-size: 1.8em;
	margin-top: 0; margin-bottom: 40px;
}

#search p {
	display: inline-block;
	margin: 0 30px;
	font-size: 1.4em;
	font-style: italic;
	letter-spacing: 4px;
	line-height: 1.3em;
}

#who-we-are {
	background-color: white;
}

#who-we-are h3, #what-were-up-to h3, #who-we-are h4 {
	text-align: center;
}

#who-we-are h3, #what-were-up-to h3 {
	font-size: 1.8em;
	text-transform: uppercase;
	font-weight: bold;
	letter-spacing: 5px;
}

#who-we-are .call-to-action, #what-were-up-to .call-to-action {
	text-align: center;
	width: 100%;
	display: block;
}

#who-we-are .call-to-action a, #what-were-up-to .call-to-action a {
	padding: 15px 35px;
	background-color: rgba(125, 164, 221, 1);
	font-weight: 400;
	letter-spacing: 4px;
	color: white;
	text-decoration: none;
	font-size: 1.2em;
}

#who-we-are, #what-were-up-to {
	padding: 40px 0;
}

#who-we-are p, #what-were-up-to p {
	letter-spacing: 4px;
	line-height: 1.8em;
	margin: 40px auto;
}

#what-were-up-to p {
	width: 50%; 
	display: inline-block;
	vertical-align: middle;
}

#who-we-are p {
	text-align: center;
	width: 45%;
}

#headline {
	text-align: center;
}

#headline h2 {
	text-transform: uppercase;
	letter-spacing: 9px;
	font-weight: 700;
	font-size: 3em;
	margin-bottom: 30px;
}

#headline h3 {
	font-size: 1.4em;
	font-weight: 400;
	text-transform: uppercase;
	letter-spacing: 5px;
}

footer {
	top: 0;
}

#what-were-up-to img {
	width: 400px;
}

.front-image {
	display: inline-block;
	vertical-align: middle;
}

.row {
	width: 70%;
	margin: 80px auto;
}

.row:nth-of-type(odd) .front-image {
	margin-left: 40px;
}

.row:nth-of-type(even) .front-image {
	margin-right: 40px;
}

@media only screen and (max-width: 840px) {
	#intro {
		height: auto;
		top: 0;
		padding-top: 0;
	}
	
	#headline h2 {
	font-size: 1.4em;
	font-weight: 500;
	letter-spacing: 3px;
	line-height: 1.6em;
}	
	#headline h3 { display: none; }

	#search {
	position: relative;
	background-color: #296EBC;
	font-size: 1em;
	margin-top: 0;
	text-align: center;
	white-space: normal;
	padding: 20px 0;
}

	#search h3, #sentence p {
	font-size: 1.2em;
	letter-spacing: 3px;
	font-weight: 300;
	margin-bottom: 20px;
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

	#about {
		text-align: center;
	}

	#about p {
		width: 100%;
	}

	#about h3 {
		padding: 0 10px;
		line-height: 1.2em;
	}

	#who-we-are, #what-were-up-to {
		padding: 10px;
	}

	#what-were-up-to {
		text-align: center;
	}

	#what-were-up-to img {
		width: 200px;
	}

	#what-were-up-to p {
		display: block;
	}

	.front-image {
		display: none;
	}

	.row {
		width: 100%;
		padding: 0 20px;
		margin: 0;
	}

}

CSS;
include $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php"; ?>

<div id="intro">

	<div id="headline">
		<h2>A Worldwide Network</h2>
		<h3>Elevating Creativity That Makes A Difference</h3>
	</div>

	<form id="search">
		<h3>I&rsquo;m searching for a...</h3>

		<div id="sentence">
			<div class="drop-down" id="search-occupation" tabindex="1">
				<h5>Occupation</h5>
				<ul>
					<li class="option">Actor</li>
					<li class="option">Architect</li>
					<li class="option">Art Therapist</li>	
					<li class="option">Arts Educator</li>	
					<li class="option">Dancer</li>	
					<li class="option">Filmmaker</li>
					<li class="option">Glass Artist</li>
					<li class="option">Graphic Designer</li>
					<li class="option">Illustrator</li>
					<li class="option">Metal Artist</li>
					<li class="option">Musician</li>
					<li class="option">Painter</li>
					<li class="option">Performance Artist</li>
					<li class="option">Photographer</li>
					<li class="option">Poet</li>
					<li class="option">Printmaker</li>
					<li class="option">Sculptor</li>
					<li class="option">Textile Artist</li>
					<li class="option">Visual Artist</li>
					<li class="option">Web Developer</li>
					<li class="option">Writer</li>
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
					<li class="option">Argentina</li>
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
	</form>

</div>

<div id="about">

	<div id="who-we-are">
		<h3>Who We Are</h3>
		<h4>Forging A Worldwide Network (FAWN)</h4>

		<p>A united team of passionate individuals using creativity and artistic expression to propel humanity forward, and to empower others to make THE difference they want to make!</p>

		<p class="call-to-action"><a href="/team/">Meet Our Team</a></p>

	</div>

	<div id="what-were-up-to">

		<h3>What We&rsquo;re Up To</h3>

		<div class="row">
			<p>We&rsquo;ve created Forging A Worldwide Network (FAWN) as a space for artists and social activists around the world to connect and collaborate &mdash; via a simple web&ndash;based platform.</p>
			<div class="front-image"><img src="/img/front1.jpg"></div>
		</div>

		<div class="row">
			<div class="front-image"><img src="/img/front2.jpg"></div>
			<p>FAWN is a network for communication and collaboration among individuals, as well as businesses and organizations to accomplish their missions through impactful artistic statements.</p>
		</div>

		<div class="row">
			<p>At FAWN, we&rsquo;re creating opportunities to build community, both online and offline, that will foster inspiration, beginnings, partnerships, and more!</p>
			<div class="front-image"><img src="/img/front3.jpg"></div>
		</div>

		<p class="call-to-action"><a href="/join-us/">Join Our Network</a></p>

	</div>

</div>

</div>

<?php 

$foot = <<<JAVASCRIPT

<script>
//Parallax
$(window).scroll(function() {

	parallax = 0;
	windowScroll = $(window).scrollTop();

	if ( windowScroll <= 0 ) { parallax = 0; }
	else { parallax = windowScroll/3; }

	$('body').css('background-position', '0 ' + parallax + 'px');

})
</script>

JAVASCRIPT;


include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>