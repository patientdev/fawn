<?php 

session_start();

$styles = "

h2 {
	margin-top: 20px;
	margin-bottom: 0;
	font-weight: 600;
	letter-spacing: 14px;
	font-size: 1.6em;
	text-align: center;
}

hr {
	width: 70%;
	margin: 40px auto;
	border: 1px solid #ccc;
}

form {
	text-align: center;
	width: 400px;
	margin: 0 auto 40px auto;
}

input:focus {
	outline: none;
}

input[type=\"text\"], input[type=\"password\"] {
	background-color: rgba(235, 232, 232, 1);
	padding: 20px;
	color: black;
	font-size: 1.2em;
	font-weight: 100;
	font-style: italic;
	letter-spacing: 6px;
	margin: 0;
	text-align: center;
	width: 100%;
	border: none;
	margin-bottom: 5px;
	font-family: Raleway;
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

button {
	background-color: rgba(125, 164, 221, 1);
	font-weight: 500;
	letter-spacing: 8px;
	position: relative;
	border: none;
	font-size: 1.2em;
	padding: 20px;
	color: white;
	border: none;
	text-transform: uppercase;
	text-decoration: none;
	width: 100%;
	margin-bottom: 20px;
}

#options:after {
	content: \"\";
	display: block;
	clear: both;
	overflow: visible;
	margin: 20px 0;
}

#forgot-password {
	float: right;
	color: #555;
	width: 50%;
	padding: 0;
	font-size: 0.9em;
	text-decoration: underline;
	letter-spacing: 3px;
	text-align: right;
}

label {
	width: 50%;
	float: left;
	letter-spacing: 5px;
	font-size: 0.9em;
	color: #555;
	text-align: left;
}

input[type=\"checkbox\"] {
	display: none;
}

input[type=\"checkbox\"] + span {
	width: auto;
	border: 2px solid #555;
	border-radius: 0;
	height: 20px;
	width: 20px;
	display: inline-block;
	vertical-align: bottom;
	text-align: center;
	line-height: 1em;
	font-weight: bold;
}

#sign-up {
	clear: both;
	border: 2px solid limegreen;
	padding: 10px;
	text-align: center;
	width: 400px;
	margin: auto;
}

#dont-have-an-account {
	letter-spacing: 5px;
	font-style: italic;
	font-weight: 100;
}

#sign-up-here {
	font-weight: 400;
	color: black;
	text-decoration: underline;
	font-size: 1em;
	letter-spacing: 3px;
}

";
include $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php";

 ?>

<header>

	<div id="heart">
		<h1><a href="/">Forger</a></h1>
	</div>

</header>

<div id="content">

<div id="status"><?php echo $_SESSION["status"]; ?></div>

<h2>Sign In Below</h2>

<hr>

<form name="sign-in" id="sign-in" method="post" action="/app/controller/sign-in.controller.php">
<p><input type="text" name="email" placeholder="Your Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email'"></p>
<p><input type="password" name="password" placeholder="Your Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Password'"></p>
<p><button type="submit">Sign In</button></p>

<div id="options">
	<label id="checkbox"><input type="checkbox"><span></span> Remember Me</label>
	<a href="" id="forgot-password">Forgot Password</a>
</div>

</form>

<div id="sign-up">
<p id="dont-have-an-account">Don&rsquo;t have an account?</p>
<p><a href="" id="sign-up-here">Sign up here.</a></p>
</div>

</div>

<?php 

session_destroy();

include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>