<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/sign-up.controller.php";

$styles = <<<CSS

h2 {
  text-align: center;
  text-transform: uppercase;
  letter-spacing: 5px;
  padding-bottom: 20px;
  border-bottom: 2px solid #ccc;
}

form {
	width: 40%;
	margin: 40px auto;
}

form div {
  font-size: 1.4em;
  letter-spacing: 6px;
  text-align: center;
  margin-bottom: 20px;
  margin-top: 30px;
}

input[type="email"], input[type="password"] {
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

#sign-up button, #facebook-login {
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

button#facebook-login {
  background-color: #3b5998;
  background-color: rgba(59, 89, 152, 1);
}

button:hover {
  cursor: pointer;
}

@media only screen and (max-width: 840px) {

  #sign-up button, #facebook-login {
    font-size: .8em;
    letter-spacing: 3px;
    margin: 10px 0;
  }

  form {
    width: 90%;
    margin: 20px auto;
  }

  form div {
    font-size: 1.2em;
    margin: 20px 0 20px 0;
  }

  input[type="email"], input[type="password"] {
    font-size: 1em;
    letter-spacing: 3px;
  }

}

CSS;

$title = "FAWN :: Join Us";
include_once $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php";

?>

<form method="post" id="sign-up" action="/app/controller/sign-up.controller.php">

<h2>Sign Up</h2>

<input type="email" id="email" name="email" placeholder="Email address">
<input type="password" id="password" name="password" placeholder="Password">
<input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password">

<button type="submit" id="join-us-submit">Submit</button>
</form>

</div>

<?php 

$foot = <<<'DOC'
<script>

$('#join-us-submit').click(function(e) {
  e.preventDefault();
  if ($('#password').val() !== $('#confirm-password').val() ) {
    $('#content').append('<p>Whoops! Please retry confirming your password.</p>');
  }

  else $('#sign-up').submit();
})

</script>
DOC;

include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; 
?>