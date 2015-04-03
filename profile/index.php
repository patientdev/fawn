<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/access.controller.php";

session_start();


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

";
include_once $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php";
?>



<header>

	<div id="heart">
		<h1><a href="/">Forger</a></h1>
	</div>

</header>

<div id="content">

<div id="status"></div>

<form id="profile" method="post" action="">

<div id="profile-photo">Upload Profile Photo</div>
<div id="info">
	<div><input type="text" name="name" placeholder="First and Last Name"> </div>

	<div><input type="text" name="location" placeholder="Location"></div>

	<div><input type="email" name="email" placeholder="Email"></div>

	<div><input type="website" name="email" placeholder="Website"></div>
</div>

<h3>Summary</h3>
<textarea id="summary" name="summary" placeholder="How would you describe yourself in a few words?"></textarea>

<h3>About</h3>
<textarea id="about" name="about" placeholder="Use this section to tell everyone about your experience, background, skills, and goals."></textarea>

<h3>Current Projects</h3>
<textarea id="current-projects" name="current-projects" placeholder="What are you currently working on? Do you have any ideas for projects you&rsquo;d like to start or see happen?"></textarea>




<button>Submit</button>
</form>

</div>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>