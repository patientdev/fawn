<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/profile.controller.php";

$head = "<link rel=\"stylesheet\" href=\"/css/jquery.Jcrop.min.css\" media=\"screen\">";

$styles = "

#profile {
	width: 60%; min-width: 715px;
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
	height: 225px;
	background-color: transparent;
	border-radius: 50%;
	text-align: center;
	display: inline-block;
	float: left;
	margin-right: 60px;
}

#profile-photo img {
	width: 225px;
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
	white-space: nowrap;
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

#info input {
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

";
include_once $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php";
?>

<div id="status"></div>

<form id="profile" name="profile-edit" method="post" action="/app/controller/profile.controller.php" class="editing" enctype="multipart/form-data">

<div id="profile-edit">
	&#x2713; <button type="submit" id="save">Save your profile</button>
</div>

<div id="profile-photo">
	<?php if(!empty($photo)) { ?>
		<h3><?php echo "<img src=\"" . $photo . "\" id=\"jcrop\">"; ?></h3>
		<input type="hidden" name="jcrop-x" id="jcrop-x">
		<input type="hidden" name="jcrop-y" id="jcrop-y">
		<input type="hidden" name="jcrop-x2" id="jcrop-x2">
		<input type="hidden" name="jcrop-y2" id="jcrop-y2">
		<input type="hidden" name="jcrop-w" id="jcrop-w">
		<input type="hidden" name="jcrop-h" id="jcrop-h">

	<?php } ?>
	<div id="profile-photo-input">
		<?php if ( !empty($photo) ) { ?>
			<h3>Change Photo</h3>
		<?php } else { ?> 
			<h3>Change Photo</h3>
		<?php } ?>
		<input type="file" name="photo" id="photo-input">
	</div>
</div>

<div id="info">

	<div id="profile-name">
		<input id="profile-name-input" type="text" name="name" placeholder="First and Last Name" class="editing" value="<?php echo $name; ?>">
	</div>

	<div id="profile-occupation">
		<input id="profile-occupation-input" type="text" name="occupation" placeholder="Occupation" class="editing" value="<?php echo $occupation; ?>">
	</div>

	<div id="profile-location">
		<input id="profile-location-input" type="text" name="location" placeholder="Location" class="editing" value="<?php echo $location; ?>">
	</div>

	<div id="profile-website">
		<input id="profile-website-input" type="text" name="website" placeholder="Website" class="editing" value="<?php echo $website; ?>">
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

$foot .= <<<'JS'

<script>
	$(function() {
		function giveCoords(c) {
			$('#jcrop-y').val(c.y);
			$('#jcrop-x').val(c.x);
			$('#jcrop-y2').val(c.y2);
			$('#jcrop-x2').val(c.x2);
			$('#jcrop-w').val(c.w);
			$('#jcrop-h').val(c.h);
		}

		$('#jcrop').Jcrop({
			onChange: giveCoords,
			aspectRatio: 1
		});
	});


	$('#photo-input').change(function() {

		// Get photo object
		photo = $(this)[0].files[0];
		reader = new FileReader();
		reader.onload = imageIsLoaded;
		reader.readAsDataURL(photo);
		function imageIsLoaded(e) {
			if ( photo.size < 2000000 ) {
				$('#profile-photo img').attr('src', e.target.result).css({ 'height': '225px', 'width': '225px' });
				$('.jcrop-holder').css({ 'height': '225px', 'width': '225px' });
			}
			else { console.log("Photo too big"); }
		}
		var imagefile = photo.type;
		var match= ["image/jpeg","image/png","image/jpg"];
		if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))) { return false; }
	})

</script>
JS;


include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>