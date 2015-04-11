<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/profile.controller.php";

$styles = "

#profile {
	width: 70%;
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
	font-size: .9em;	letter-spacing: 1px;
	padding: 0;
}

#save:hover {
	border-bottom: 1px solid #777;
	cursor: pointer;
}

#profile-photo {
	width: 225px;
	height: 225px;
	background-color: #ccc;
	border-radius: 50%;
	text-align: center;
	display: inline-block;
	float: left;
	margin-right: 60px;
}

#profile-photo input {
	display: none;
}

#profile-photo button {
	border: 0;
	padding: 0;
	background-color: transparent;
	font-size: 1.2em;
	font-weight: 200;
}

#info {
	width: 500px;
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

";
include_once $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php";
?>



<header>

	<div id="heart">
		<h1><a href="/">Forger</a></h1>
	</div>

</header>

<div id="content">

<div id="status"><?php echo print_r($_SESSION); ?></div>

<form id="profile" method="post" action="" class="editing">

<div id="profile-edit">
	&#x2713; <button type="button" id="save">Save your profile</button>
</div>

<div id="profile-photo">
	<button>Upload Photo</button>
	<input type="file" name="profilephoto"></div>
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

$foot = <<<'JS'
<script>

	$('#profile-photo button').click(function() {
		$('#profile-photo input').click();
	});

	$('#save').click(function(e){ 
		e.preventDefault();

		$('#profile input, #profile textarea').each(function() {
			$input = $(this);
			$parent = $(this).parent('div');
			$name = $input.attr('name');
			$val = $input.val();
			console.log($input);
			jsonObject = {};
			jsonObject[$name] = $val;

			if ( $val == '') {
				return false;
			}

			else {
				$.post('/app/controller/profile.controller.php', jsonObject, function(msg) {
					console.log(msg);
				}).done(function() {

					$input.toggle();

					if ($parent.attr('id') === 'profile-name') {
						console.log('guh');
						$parent.children('h2.saved').html($val);
						$parent.children('.saved').show();
					}

					else if ($parent.attr('id') === 'profile-occupation' || $parent.attr('id') === 'profile-location' || $parent.attr('id') === 'profile-website')  { 
						$parent.children('h3.saved').html($val.replace(/(?:\r\n|\r|\n)/g, '<br>'));
						$parent.children('.saved').show();

					}

					else if ($parent.attr('id') === 'profile-about' || $parent.attr('id') === 'profile-summary' || $parent.attr('id') === 'profile-currentprojects') { 
						$parent.children('div.saved').html($val.replace(/(?:\r\n|\r|\n)/g, '<br>'));
						$parent.children('h3.editing').hide();
						$parent.children('h3.saved').show();
						$parent.children('div.saved').show();
					}
				});
			}	
		});

		window.location.href = "/profile/";

	});
</script>
JS;


include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>