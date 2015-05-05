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

#search select {
	width: 100%;
	border: none;
	border-radius: 0;
	height: 50px;
	background-color: white;
	font-size: 1.1em;
	font-style: italic;
	letter-spacing: 4px;
	background-color: rgba(240, 240, 240, 1);
	font-weight: 200;
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

CSS;
include $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php"; ?>

<div id="intro">

	<div id="headline">
		<h2>A Worldwide Network</h2>
		<h3>Elevating Creativity That Makes A Difference</h3>
	</div>

	<div id="search">
		<h3>I&rsquo;m searching for a...</h3>

		<div id="sentence">
			<div class="drop-down" id="search-occupation">
				<h5>Occupation</h5>
				<ul>
					<li class="option">Photographer</li>
					<li class="option">Musician</li>
					<li class="option">Graphic Designer</li>
					<li class="option">Web developer</li>
				</ul>
			</div>

			<p>who supports</p>

			<div class="drop-down" id="search-cause">
				<h5>Cause</h5>
				<ul>
					<li class="option">Conservation</li>
					<li class="option">Local Food</li>
					<li class="option">Local Culture</li>
				</ul>
			</div>

			<p>in</p>

			<div class="drop-down" id="search-location">
				<h5>Location</h5>
				<ul>
					<li class="option">Ithaca, NY</li>
					<li class="option">New York, New York</li>
					<li class="option">Bhangra, India</li>
				</ul>
			</div>
		</div>
	</div>

</div>

<div id="about">

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

		<p class="call-to-action"><a href="/join-us/">Join Our Network</a></p>

	</div>

</div>

</div>

<?php 

$foot = <<<'JS'

<script>
//Parallax
$(window).scroll(function() {

	$parallax = 0;
	$windowScroll = $(window).scrollTop();

	if ( $windowScroll <= 0 ) { $parallax = 0; }
	else { $parallax = $windowScroll/3; }

	$('body').css('background-position', '0 ' + $parallax + 'px');

})

//Drop-down search
$('.drop-down li').click(function() {
	
	//Auto-submit search with selected parameters
	if ( $('#search-occupation h5').text() != 'Occupation' && $('#search-cause h5').text() != 'Cause' && $('#search-location h5').text() != 'Location') {
		
		$occupation = $('#search-occupation h5').text();
		$cause =  $('#search-cause h5').text();
		$location =  $('#search-location h5').text();
		$('<form action="/search/" method="POST">' + 
    		'<input type="hidden" name="occupation" value="' + $occupation + '">' +'<input type="hidden" name="cause" value="' + $cause + '">' +'<input type="hidden" name="location" value="' + $location + '">' +
    		'</form>').submit();
	}
});
</script>

JS;


include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>