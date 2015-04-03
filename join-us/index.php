<?php 

session_start();

$styles = "

form {
	width: 40%;
	margin: 40px auto;
}

input[type=\"email\"], input[type=\"password\"] {
	background-color: rgba(235, 232, 232, 1);
	padding: 20px;
	color: black;
	font-size: 1.2em;
	font-weight: 100;
	font-style: italic;
	letter-spacing: 6px;
	text-align: center;
	width: 100%;
	border: none;
	margin-bottom: 5px;
	font-family: Raleway;
	margin-bottom: 20px;
}

input:focus {
	outline: none;
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

#sign-up button {
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

";
include_once $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php";

?>



<header>

	<div id="heart">
		<h1><a href="/">Forger</a></h1>
	</div>

</header>

<div id="content">

<?php if ( isset($_SESSION["status"])) { ?>
	<p><?php echo $_SESSION["status"]; ?></p>
<?php } ?>

<form method="post" id="sign-up" action="/app/controller/sign-up.php">

<input type="email" id="email" name="email" placeholder="Email address">
<input type="password" id="password" name="password" placeholder="Password">
<input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password">

<button>Submit</button>
</form>

</div>

<?php 

$foot = <<<'DOC'
<script>

$('#sign-up button').click(function(e) {
	e.preventDefault();
	if ($('#password').val() !== $('#confirm-password').val() ) {
		$('#content').append('<p>Whoops! Please retry confirming your password.</p>');
	}

	else $('#sign-up').submit();
})
</script>
DOC;

include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; 

session_destroy();

?>