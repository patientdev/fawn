<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/sign-up.controller.php";

if ( !isset($_SESSION) ) {
	session_start();
}

$styles = "

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

";
include_once $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php";

?>

<script>

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
     // logIn();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1560529120863841',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function logIn() {
    FB.api('/me', function(response) {
      $.post("/app/controller/sign-in.controller.php", { facebook: 'true', response: response }, function( success ) {
        console.log(success);
      });
    });
  }
</script>

<div id="status"></div>

<form method="post" id="sign-up" action="/app/controller/sign-up.controller.php">

<button type="button" id="facebook-login">Sign Up with Facebook</button>
<div>Or with your email:</div>
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

$('#facebook-login').click(function(e) {
  e.preventDefault();
  FB.login(function(response){
    if ( response.status == 'connected') {
      FB.api('/me?fields=id,name,email,picture', function(user) {
        $.post('/app/controller/sign-up.controller.php', { facebook: 'true', user: user }, function(success) {
        window.location.replace('/profile/edit/');
      } );
      })
    }
  });
})


</script>
DOC;

include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; 
?>