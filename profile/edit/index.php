<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/profile.controller.php";


$head = "<link rel=\"stylesheet\" href=\"/css/jquery.Jcrop.min.css\" media=\"screen\">";

$styles = <<<CSS

#profile {
	width: 60%; min-width: 960px;
	margin: auto;
	position: relative;
	overflow: visible;
	padding-top: 40px;
}

#profile-edit {
	position: absolute;
	top: 0; right: 60px;
	color: #777;

}

#save {
	border: none;
	background-color: transparent;
	font-style: italic;
	font-size: .9em;	
	letter-spacing: 1px;
	padding: 0;
}

#save:hover {
	border-bottom: 1px solid #777;
	cursor: pointer;
}

#profile-photo {
	width: 225px;
	background-color: transparent;
	border-radius: 50%;
	text-align: center;
	display: inline-block;
	float: left;
	margin-right: 60px;
}

#profile-photo img {
	max-width: 225px;
}

#profile-photo input {
    cursor: pointer;
    height: 100%;
    position:absolute;
    top: 0;
    right: 0;
    z-index: 99;
    /*This makes the button huge. If you want a bigger button, increase the font size*/
    font-size:50px;
    /*Opacity settings for all browsers*/
    opacity: 0;
    -moz-opacity: 0;
    filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0)
}

#profile-photo-input {
	overflow: hidden;
	background-color: rgba(125, 164, 221, 1);
	position: relative;
	color: white;
	font-size: .8em;
	padding: 20px 40px;
}

#profile-photo-input h3 { margin: 0;}

#info {
	width: 60%;
	display: inline-block;
	text-align: left;
}

input {
	border: 1px solid black;
	padding: 15px;
	font-family: Raleway;
	font-size: 0.9em;
	letter-spacing: 3px;
	width: 100%;
	font-style: italic;
}


::-webkit-input-placeholder {
	color: black;
	font-weight: 200;
	font-family: Raleway;
}

:-moz-placeholder { /* Firefox 18- */
	color: black;  
	font-weight: 200;
	font-family: Raleway;
}

::-moz-placeholder {  /* Firefox 19+ */
	color: black;  
	font-weight: 200;
	font-family: Raleway;
}

:-ms-input-placeholder {  
	color: black; 
	font-weight: 200; 
	font-family: Raleway;
}

textarea {
	width: 100%;
	font-size: 0.9em;
	padding: 15px;
	letter-spacing: 3px;
	font-style: italic;
	line-height: 1.6em;
	border: 2px solid #ccc;
	margin-bottom: 40px;
}

#summary {
	height: 8em;
}

#about, #current-projects {
	height: 15em;
}

#info > div {
	margin-bottom: 30px;
}

#profile-name h2 {
	font-size: 2em;
	font-weight: 700;
	letter-spacing: 15px;
	text-transform: uppercase;
	margin-bottom: 40px;
	display: block;
	margin-top: 0;
	margin-bottom: 40px;
}

h3 {
	font-size: 1.3em;
	text-transform: uppercase;
	font-weight: 600;
	letter-spacing: 8px;
	margin-bottom: 20px;
	margin-top: 0;
	display: inline-block;
}

#profile-location {
	margin-top: 0;
}

#profile-summary {
	clear: both;
	margin-top: 60px;
}

#profile-about p, #profile-currentprojects p {
	text-align: left;
}

#profile-summary, #profile-about, #profile-currentprojects {
	margin-bottom: 60px;
}

.jcrop-holder > div > div {
	border-radius: 50%;
}

.drop-down {
	border: 1px solid #777;
}

.drop-down ul {
	border: 1px solid #777;
	padding: 0 1px;
}

.drop-down li {
	font-size: 0.9em;
}

.drop-down h5 {
	font-size: 0.9em;
	max-width: 100%;
	padding: 9px 10px 9px 0px;
}

.drop-down h5:before {
  padding: 15px 15px 15px 22px;
  margin-right: 20px;
}

.drop-down-input { display: none; }

input.other { width: 50%; padding: 5px 15px;}

@media only screen and (max-width: 840px) {

	#profile {
		width: 90%;
		min-width: 0;
		padding-top: 0;
	}

	#profile-edit {
		position: relative;
		width: 100%;
		text-align: center;
		right: 0;
		margin: 20px 0;
}

	#profile-photo {
		width: 100%;
		display: block;
		float: none;
		height: auto;
		margin-bottom: 20px;
	}

	#profile-photo h3 {
		margin: 0;
}

	#profile-photo img {
		width: 200px;
	}

	#info {
		display: block;
		width: 100%;
		margin: 20px 0;
	}

	#info > div {
		margin-bottom: 10px;
	}

	#info input {
		width: 100%;
}

	.drop-down {
		width: 100%;
	}

	.drop-down h5:after {
		position: absolute;
		right: 0; top: 0;
		padding: 15px 15px 12px 22px;
	}

	#profile-summary {
		margin-top: 0;
	}

	#profile-summary, #profile-about, #profile-currentprojects {
		margin-bottom: 30px;
	}

	textarea {
		margin: 0;
	}

	h3 {
		line-height: 1.4em;
		letter-spacing: 5px;
	}

	input.other { margin-top: 10px; }

	#about {
		padding: 0;
	}
}

CSS;
include_once $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php";
?>

<form id="profile" name="profile-edit" method="post" action="/app/controller/profile.controller.php" class="editing" enctype="multipart/form-data">

<div id="profile-edit">
	&#x2713; <button type="submit" id="save">Save your profile</button>
</div>

<div id="profile-photo">
	<?php if(!empty($photo)) { ?>
		<h3><img src="<?php echo $photo; ?>" id="jcrop"></h3>
	<?php } ?>
		<input type="hidden" name="jcrop-y" id="jcrop-y">
		<input type="hidden" name="jcrop-x" id="jcrop-x">
		<input type="hidden" name="jcrop-w" id="jcrop-w">
		<input type="hidden" name="jcrop-h" id="jcrop-h">
	<div id="profile-photo-input">
		<?php if ( !empty($photo) ) { ?>
			<h3>Update Photo</h3>
		<?php } else { ?> 
			<h3>Change Photo</h3>
		<?php } ?>
		<input type="file" name="photo" id="photo-input">
	</div>
</div>

<div id="info">

	<div id="profile-name">
		<input id="profile-name-input" type="text" name="name" placeholder="First and Last Name" class="editing" value="<?php echo $name; ?>" tabindex="0">
	</div>

	<div id="profile-occupation">
		<div class="drop-down" tabindex="0">
			<h5><?php if ( !empty($occupation) ) { echo $occupation; } else echo "Occupation"; ?></h5>
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
				<li class="option other">Other...</li>
			</ul>

		<input class="drop-down-input" type="text" name="occupation" placeholder="Occupation" value="<?php echo $occupation; ?>">

		</div>

		<br><input type="text" name="otheroccupations" class="other" placeholder="Other Occupations..." value="<?php echo $otheroccupations; ?>">
	</div>

	<div id="profile-location">
		<div class="drop-down" tabindex="0">
			<h5><?php if ( !empty($location) ) { echo $location; } else echo "Location"; ?></h5>
			<ul>
				<li class="option">New York</li>
				<li class="option">Miami</li>
				<li class="option">Denver</li>
				<li class="option">San Fransisco</li>
				<li class="option">Boston</li>
				<li class="option">Berlin</li>
				<li class="option">Portland</li>
				<li class="option">Los Angeles</li>
				<li class="option">Chicago</li>
				<li class="option">Madrid</li>
				<li class="option">Prague</li>
				<li class="option">Paris</li>
				<li class="option">London</li>
				<li class="option">Seattle</li>
				<li class="option">Mumbai</li>
				<li class="option">Milan</li>
				<li class="option">Sydney</li>
				<li class="option">Hong Kong</li>
				<li class="option">Tokyo</li>
				<li class="option">Cape Town</li>
				<li class="option">Montreal</li>
				<li class="option">Toronto</li>
				<li class="option">Mexico City</li>
				<li class="option">Sao Paolo</li>
				<li class="option">Cairo</li>
				<li class="option">Dublin</li>
				<li class="option">Copenhagen</li>
				<li class="option">Stockholm</li>
				<li class="option">Bangladesh</li>
				<li class="option">Bangkok</li>
				<li class="option">Moscow</li>
				<li class="option other">Other</li>
			</ul>

		<input class="drop-down-input" type="text" name="location" placeholder="Location" class="editing" value="<?php echo $location; ?>">

		</div>

		<br><input type="text" name="otherlocations" class="other" placeholder="Other Locations..." value="<?php echo $otherlocations; ?>">

	</div>

	<div id="profile-cause">
		<div class="drop-down" tabindex="">
			<h5><?php if ( !empty($cause) ) { echo $cause; } else echo "Cause"; ?></h5>
			<ul>
				<li class="option">Gender Equality</li>
				<li class="option">LGBT Rights</li>
				<li class="option">Race Relations</li>
				<li class="option">Environmental/Preservation</li>
				<li class="option">International Relations</li>
				<li class="option">Animal Rights</li>
				<li class="option">Food/Water Access</li>
				<li class="option">Poverty</li>
				<li class="option">Disease (HIV/Aids, etc)</li>
				<li class="option">Religious Freedom</li>
				<li class="option">Education</li>
				<li class="option">Sustainability</li>
				<li class="option">World Peace</li>
				<li class="option">Human Trafficking</li>
				<li class="option other">Other...</li>
			</ul>

		<input class="drop-down-input" type="text" name="cause" placeholder="Cause" class="editing" value="<?php echo $cause; ?>">

		</div>

		<br><input type="text" name="othercauses" class="other" placeholder="Other Causes..." value="<?php echo $othercauses; ?>">

	</div>

	<div id="profile-website">
		<input id="profile-website-input" type="text" name="website" placeholder="Website" class="editing" value="<?php echo $website; ?>" tabindex="0">
	</div>
</div>

<div style="clear: both;"></div>

<div id="profile-summary">
	<h3 class="editing">Summary</h3>
	<textarea id="summary" name="summary" placeholder="How would you describe yourself in a few words?" class="editing"><?php echo $summary; ?></textarea>
</div>

<div id="profile-about">
	<h3 class="editing">About</h3>
	<textarea id="about" name="about" placeholder="Use this section to tell everyone about your experience, background, skills, and goals." class="editing"><?php echo $about; ?></textarea>
</div>

<div id="profile-currentprojects">
	<h3 class="editing">Current Projects</h3>
	<textarea id="current-projects" name="currentprojects" placeholder="What are you currently working on? Do you have any ideas for projects you&rsquo;d like to start or see happen?" class="editing"><?php echo $currentprojects; ?></textarea>
</div>

</form>

</div>

<?php 

$foot = "<script src=\"/js/jquery.Jcrop.min.js\"></script>";

$foot .= <<<JS

<script>
	$(function() {

				function giveCoords(c) {
				$('#jcrop-y').val(c.y);
				$('#jcrop-x').val(c.x);
				$('#jcrop-w').val(c.w);
				$('#jcrop-h').val(c.h);
			}

		$('#photo-input').change(function() {

				// Get photo object
				photo = $(this)[0].files[0];
				reader = new FileReader();
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(photo);
				function imageIsLoaded(e) {
					if ( photo.size < 500000 ) {
						if ( $('#profile-photo img').length > 0 ) {
							$('#profile-photo img').attr('src', e.target.result).css({ 'width': '225px' });
						}
						else {
							$('#profile-photo').prepend('<h3><img src="' + e.target.result + '"></h3>');
							$('#profile-photo img').attr('src', e.target.result).css({ 'width': '225px' });
						}

						if ( $('#menu').css('display') === 'none' ) {
							$('#profile-photo img').Jcrop({
								'onChange': giveCoords,
								'aspectRatio': 1,
								'setSelect': [0,0,225,225]
							});
						}
					}
					else { console.log("Photo too big"); }
				}
				var imagefile = photo.type;
				var match= ["image/jpeg","image/png","image/jpg"];
				if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))) { return false; }
			})
	});

</script>
JS;


include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>