<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/profile.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/access.controller.php";

session_start();

if ( isset($_SESSION["email"]) ) {
	$profile = new Profile();
	$email = $_SESSION["email"];
	$password = $profile->gimme("password", $email);
	$name = (!isset($_SESSION["name"]) ? $profile->gimme("name", $email) : $_SESSION["name"]);
	$location = (!isset($_SESSION["location"]) ? $profile->gimme("location", $email) : $_SESSION["location"]);
	$website = (!isset($_SESSION["website"]) ? $profile->gimme("website", $email) : $_SESSION["website"]);
}


$styles = "

form {
	width: 50%;
	margin: 40px auto;
}
#profile-photo {
	width: 150px;
	height: 150px;
	background-color: #ccc;
	border-radius: 50%;
	text-align: center;
	display: inline-block;
	float: left;
}

#info {
	width: 400px;
	display: inline-block;
	text-align: left;
}

#info div {
	margin-bottom: 20px;
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

#info div span {
	padding: 15px;
	margin: 0;
	letter-spacing: 3px;
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

		<?php if (isset($name)) { echo "<span>" . $name . "</span>"; } else echo '<input id="profile-name-input" type="text" name="name" placeholder="First and Last Name">' ?>
	</div>

	<div id="profile-email">
		<?php if (isset($email)) { echo "<span>" . $email . "</span>"; } else echo '<input id="profile-name-input" type="text" name="email" placeholder="Email">' ?>
	</div>

	<div id="profile-location">
		<?php if (isset($location)) { echo "<span>" . $location . "</span>"; } else echo '<input id="profile-name-input" type="text" name="location" placeholder="Location">' ?>
	</div>

	<div id="profile-website">
		<?php if (isset($website)) { echo "<span>" . $website . "</span>"; } else echo '<input id="profile-name-input" type="text" name="website" placeholder="Website">' ?>
	</div>
</div>

<h3>Summary</h3>
<textarea id="summary" name="summary" placeholder="How would you describe yourself in a few words?"></textarea>

<h3>About</h3>
<textarea id="about" name="about" placeholder="Use this section to tell everyone about your experience, background, skills, and goals."></textarea>

<h3>Current Projects</h3>
<textarea id="current-projects" name="current-projects" placeholder="What are you currently working on? Do you have any ideas for projects you&rsquo;d like to start or see happen?"></textarea>

</form>

</div>

<?php 

$foot = <<<'JS'
<script>
	$('#profile input').blur(function() {
		$input = $(this);
		$name = $input.attr('name');
		$val = $input.val();
		jsonObject = {};
		jsonObject[$name] = $val;
		$.post('/app/controller/profile.controller.php', jsonObject, function(msg) {
			console.log(msg);
			$input.parent('div').html("<p>" + $val + "</p>");
		});	
	});
</script>
JS;


include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>