<?php 


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

";

$script = "
$('button').click(function(e) {
	e.preventDevault();
	$.ajax()
})
";
include_once $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/includes/db.php";

$email = $_POST["email"];

$result = $dbh->prepare("SELECT firstname FROM artists WHERE email = :email");
$result->bindParam(':email', $email);
$result->execute();
$email_exists = ($result->rowCount() > 0) ? true : false;

if($email_exists) {
    $error = "<div class=\"error\"><p>This email address is already signed&ndash;up.</p> <p>Would you like your password emailed to you?</p></div>";
} else {
	$password = crypt($_POST["password"], 'igltt4t5');

	$sql = "INSERT INTO artists (email, password) values(:email, :password)";
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(':email', $email);
	$stmt->bindValue(':password', $password);
	$stmt->execute();
}

$dbh = null;


?>



<header>

	<div id="heart">
		<h1><a href="/">Forger</a></h1>
	</div>

</header>

<content>

<form method="post" action="<?=$_SERVER['PHP_SELF']?>">

<input type="email" id="email" name="email" placeholder="Email address">
<input type="password" id="password" name="password" placeholder="Password">


<button>Submit</button>
</form>

</content>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>