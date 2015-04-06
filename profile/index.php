<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/profile.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/access.controller.php";

session_start();

if ( isset($_SESSION["email"]) ) {
	$profile = new Profile();
	$email = $_SESSION["email"];
	$password = $profile->gimme("password", $email);
	$name = ((empty($_SESSION["name"]) || !isset($_SESSION["name"])) ? $profile->gimme("name", $email) : $_SESSION["name"]);
	$location = ((empty($_SESSION["location"]) || !isset($_SESSION["location"])) ? $profile->gimme("location", $email) : $_SESSION["location"]);
	$website = ((empty($_SESSION["website"]) || !isset($_SESSION["website"])) ? $profile->gimme("website", $email) : $_SESSION["website"]);
	$occupation = ((empty($_SESSION["occupation"]) || !isset($_SESSION["occupation"])) ? $profile->gimme("occupation", $email) : $_SESSION["occupation"]);
	$about = ((empty($_SESSION["about"]) || !isset($_SESSION["about"])) ? $profile->gimme("about", $email) : $_SESSION["about"]);
	$summary = ((empty($_SESSION["summary"]) || !isset($_SESSION["summary"])) ? $profile->gimme("summary", $email) : $_SESSION["summary"]);
	$currentprojects = ((empty($_SESSION["currentprojects"]) || !isset($_SESSION["currentprojects"])) ? $profile->gimme("currentprojects", $email) : $_SESSION["currentprojects"]);
}


$styles = "

form {
	width: 850px;
	margin: 40px auto;
}
#profile-photo {
	width: 200px;
	height: 200px;
	background-color: #ccc;
	border-radius: 50%;
	text-align: center;
	display: inline-block;
	float: left;
	margin-right: 20px;
}

#info {
	width: 600px;
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

#profile-name span {
	font-size: 2em;
	font-weight: 700;
	letter-spacing: 15px;
	text-transform: uppercase;
	margin-bottom: 40px;
	display: block;
}

#profile-occupation span {
	text-transform: uppercase;
	font-weight: 600;
	letter-spacing: 8px;
	font-size: 1.2em;
	margin-bottom: 5px;
	display: inline-block;
}

#profile-location {
	margin-top: 0;
}

#profile-location span {
	text-transform: uppercase;
	font-weight: 400;
	font-size: 1.1em;
	letter-spacing: 8px;
	display: inline-block;
	margin-bottom: 30px;
}

#profile-website span {
	text-transfor: lowercase;
	letter-spacing: 8px;
	font-weight: 100;
	border-bottom: 1px solid black;
}

#profile-summary {
	clear: both;
	margin-top: 60px;
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

<div id="status"><?php echo $_SESSION["status"]; ?></div>

<form id="profile" method="post" action="">

<div id="profile-photo"><span>Upload<br> Profile<br> Photo</span></div>
<div id="info">
	<div id="profile-name">

		<?php if (!empty($name)) { echo "<span>" . $name . "</span>"; } else echo '<input id="profile-name-input" type="text" name="name" placeholder="First and Last Name">' ?>
	</div>

	<div id="profile-occupation">
		<?php if (!empty($occupation)) { echo "<span>" . $occupation . "</span>"; } else echo '<input id="profile-occupation-input" type="text" name="occupation" placeholder="Occupation">' ?>
	</div>

	<div id="profile-location">
		<?php if (!empty($location)) { echo "<span>" . $location . "</span>"; } else echo '<input id="profile-name-input" type="text" name="location" placeholder="Location">' ?>
	</div>

	<div id="profile-website">
		<?php if (!empty($website)) { echo "<span>" . $website . "</span>"; } else echo '<input id="profile-name-input" type="text" name="website" placeholder="Website">' ?>
	</div>
</div>

<div style="clear: both;"></div>

<div id="profile-summary">
	<h3>Summary</h3>
	<?php if (!empty($summary)) { echo "<span>" . $summary . "</span>"; } else echo '<textarea id="summary" name="summary" placeholder="How would you describe yourself in a few words?"></textarea>' ?>
</div>

<div id="profile-about">
	<h3>About</h3>
	<?php if (!empty($about)) { echo "<p>" . str_replace("\n\n", "</p><p>", $about) . "</p>"; } else echo '<textarea id="about" name="about" placeholder="Use this section to tell everyone about your experience, background, skills, and goals."></textarea>' ?>
</div>

<div id="profile-currentprojects">
	<h3>Current Projects</h3>
	<?php if (!empty($currentprojects)) { echo "<p>" . str_replace("\n\n", "</p><p>", $currentprojects) . "</p>"; } else echo '<textarea id="current-projects" name="currentprojects" placeholder="What are you currently working on? Do you have any ideas for projects you&rsquo;d like to start or see happen?"></textarea>' ?>
</div>

</form>

</div>

<?php 

$foot = <<<'JS'
<script>
	$('#profile input, #profile textarea').blur(function() {
		$input = $(this);
		$name = $input.attr('name');
		$val = $input.val().replace('\n\n', '</p><p>');
		jsonObject = {};
		jsonObject[$name] = $val;
		$.post('/app/controller/profile.controller.php', jsonObject, function(msg) {
			console.log(msg);
			$input.parent('div').html("<span>" + $val + "</span>");
		});	
	});
</script>
JS;


include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>