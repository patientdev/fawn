<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/profile.controller.php";

$styles = "

#profile {
	width: 850px;
	margin: 40px auto;
	position: relative;
	padding-top: 40px;
	overflow: visible;
}

#profile-edit {
	position: absolute;
	top: 0; right: 60px;
}

#profile-photo {
	width: 200px;
	height: 200px;
	background-color: #ccc;
	border-radius: 50%;
	text-align: center;
	display: inline-block;
	float: left;
	margin-right: 60px;
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
	font-weight: 100;
	font-family: Raleway;
}

:-moz-placeholder { /* Firefox 18- */
	color: black;  
	font-weight: 100;
	font-family: Raleway;
}

::-moz-placeholder {  /* Firefox 19+ */
	color: black;  
	font-weight: 100;
	font-family: Raleway;
}

:-ms-input-placeholder {  
	color: black; 
	font-weight: 100; 
	font-family: Raleway;
}

h3 {
	text-align: left;
	font-size: 1em;
	font-weight: 600;
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
	height: 6em;
}

#about, #current-projects {
	height: 10em;
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

#profile-occupation h3 {
	text-transform: uppercase;
	font-weight: 600;
	letter-spacing: 8px;
	font-size: 1.2em;
	margin-bottom: 10px;
	margin-top: 0;
	display: inline-block;
}

#profile-location {
	margin-top: 0;
}

#profile-location h3 {
	text-transform: uppercase;
	font-weight: 400;
	font-size: 1.1em;
	letter-spacing: 8px;
	display: inline-block;
	margin-bottom: 40px;
	margin-top: 0;
}

#profile-website h3 {
	text-transform: lowercase;
	font-size: 1.1em;
	letter-spacing: 8px;
	font-weight: 400;
	border-bottom: 1px solid black;
	display: inline-block;
	margin-top: 0;
}

#profile-summary {
	clear: both;
	margin-top: 60px;
}

#profile-summary div.saved {
	  font-size: 1.4em;
	  font-weight: bold;
	  letter-spacing: 5px;
	  font-style: italic;
	  width: 600px; margin: auto;
	  line-height: 1.6em;
	  text-align: center;
}

#profile-about p, #profile-currentprojects p {
	text-align: left;
}

#profile-about h3, #profile-summary h3, #profile-currentprojects h3 {
	border-bottom: 1px solid black;
	padding-bottom: 25px;
	font-size: 1.2em;
	font-weight: bold;
	margin-bottom: 30px;
}

#profile-summary, #profile-about, #profile-currentprojects {
	margin-bottom: 60px;
}

#save {
	display: none;
}

div.saved {
  font-size: 1.1em;
  font-weight: 400;
  letter-spacing: 3px;
  line-height: 1.4em;
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

<form id="profile" method="post" action="">

<div id="profile-edit">
	<button type="button" id="edit" class="saved">Edit your profile</button>
	<button type="button" id="save" class="editing">Save your profile</button>
</div>

<div id="profile-photo"><span>Upload<br> Profile<br> Photo</span></div>
<div id="info">
	<div id="profile-name">
		<?php if(!empty($name)) { ?>
			<h2 class="saved"><?php echo $name ?></h2>
			<style>
				#profile-name-input.editing { display: none; }
			</style>
		<?php } else { ?>
			<h2 class="saved"></h2>
		<?php } ?>
	
		<input id="profile-name-input" type="text" name="name" placeholder="First and Last Name" class="editing">
	</div>

	<div id="profile-occupation">
		<?php if(!empty($occupation)) { ?>
			<h3 class="saved"><?php echo $occupation ?></h3>
			<style>
				#profile-occupation-input.editing { display: none; }
			</style>
		<?php } else { ?>
			<h3 class="saved"></h3>
		<?php } ?>

		<input id="profile-occupation-input" type="text" name="occupation" placeholder="Occupation" class="editing">
	</div>

	<div id="profile-location">
		<?php if(!empty($location)) { ?>
			<h3 class="saved"><?php echo $location ?></h3>
			<style>
				#profile-location-input.editing { display: none; }
			</style>
		<?php } else { ?>
			<h3 class="saved"></h3>
		<?php } ?>

		<input id="profile-location-input" type="text" name="location" placeholder="Location" class="editing">
	</div>

	<div id="profile-website">
		<?php if(!empty($website)) { ?>
			<h3 class="saved"><?php echo $website ?></h3>
			<style>
				#profile-website-input.editing { display: none; }
			</style>
		<?php } else { ?>
			<h3 class="saved"></h3>
		<?php } ?>

		<input id="profile-website-input" type="text" name="website" placeholder="Website" class="editing">
	</div>
</div>

<div style="clear: both;"></div>

<div id="profile-summary">
	<?php if(!empty($summary)) { ?>
		<div class="saved"><?php echo $summary ?></div>
		<style>
			#profile-summary .editing { display: none; }
		</style>
	<?php } else { ?>
		<div class="saved"></div>
	<?php } ?>
	<h3 class="editing">Summary</h3>
	<textarea id="summary" name="summary" placeholder="How would you describe yourself in a few words?" class="editing"></textarea>
</div>

<div id="profile-about">
	<?php if(!empty($about)) { ?>
		<h3 class="saved">About</h3>
		<div class="saved"><?php echo $about; ?></div>
		<style>
			#profile-about .editing { display: none; }
		</style>
	<?php } else { ?>
		<h3 class="saved"></h3>
		<div class="saved"></div>
	<?php } ?>

	<h3 class="editing">About</h3>
	<textarea id="about" name="about" placeholder="Use this section to tell everyone about your experience, background, skills, and goals." class="editing"></textarea>
</div>

<div id="profile-currentprojects">
	<?php if(!empty($currentprojects)) { ?>
		<h3 class="saved">Current Projects</h3>
		<div class="saved"><?php echo $currentprojects ?></div>
		<style>
			#profile-currentprojects .editing { display: none; }
		</style>
	<?php } else { ?>
		<div class="saved"></div>
	<?php } ?>

	<h3 class="editing">Current Projects</h3>
	<textarea id="current-projects" name="currentprojects" placeholder="What are you currently working on? Do you have any ideas for projects you&rsquo;d like to start or see happen?" class="editing"></textarea>
</div>

</form>

</div>

<?php 

$foot = <<<'JS'
<script>
	$('#edit').click(function(e){ 
		e.preventDefault();
		$('.saved').hide();
		$('.editing').show();
	});

	$('#save').click(function(e){ 
		e.preventDefault();
		$('.saved').show();
		$('.editing').hide();


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
	});
</script>
JS;


include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>