<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/access.controller.php";

$styles = <<<CSS

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

input[type="email"], input[type="password"] {
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
  font-size: 1em;
  letter-spacing: 5px;
}

@media only screen and (max-width: 840px) {

	h2 {
		font-size: 1.2em;
		letter-spacing: 3px;
	}

	hr {
		margin: 20px auto; 
	}

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

  #options label {
  	display: block;
  	width: 100%;
  	text-align: center;
  	float: none;
  	margin-bottom: 20px;
	}

	#options a {
	display: block;
	text-align: center;
	width: 100%;
	float: none;
}

	#sign-up {
	width: 100%;
	border-left: none;
	border-right: none;
}

}

CSS;
include $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php";

 ?>

<h2>Sign In Below</h2>

<hr>
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

<form name="sign-in" id="sign-in" method="post" action="/app/controller/sign-in.controller.php">

<button type="button" id="facebook-login">Sign In with Facebook</button>

<p><input type="email" name="email" placeholder="Your Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email'"></p>
<p><input type="password" name="password" placeholder="Your Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Password'"></p>
<p><button type="submit">Sign In</button></p>

<div id="options">
	<label id="checkbox"><input name="remember" type="checkbox"><span></span> Remember Me</label>
	<a href="" id="forgot-password">Forgot Password</a>
</div>

</form>

<div id="sign-up">
<p id="dont-have-an-account">Don&rsquo;t have an account?</p>
<p><a href="/join-us/" id="sign-up-here">Sign up here.</a></p>
</div>

</div>

<?php 

session_destroy();

$foot = <<<JS
<script>

$(function() {
	if ( $.cookie('remember') ) {
		$('#checkbox input').attr('checked', '');
		$('#checkbox span').html('&#x2713;');
	}

	$('#facebook-login').click(function(e) {
	  e.preventDefault();
	  FB.login(function(response){
	    if ( response.status == 'connected') {
	      FB.api('/me?fields=id,name,email,picture', function(user) {
	        $.post('/app/controller/facebook.controller.php', { user: user }, function(success) {
	        console.log(success);
	        window.location.replace('/profile/');
	      } );
	      })
	    }

	    else if ( response.status == 'not_authorized') {
	      FB.api('/me?fields=id,name,email,picture', function(user) {
	        $.post('/app/controller/facebook.controller.php', { user: user }, function(success) {
	        console.log(success);
	        window.location.replace('/profile/edit/');
	      } );
	      })
	    }
	  });
	})

	$('#checkbox').click(function(e) {
		e.preventDefault();
		checked = typeof $('input', this).attr('checked') === 'undefined' ? false : true;
		if (!checked && $.cookie('remember')) {
			$.removeCookie('remember', { expires: 60, path: '/'});
			$('input', this).removeAttr('checked'); 
			$('span', this).html('');
		}

		else { 
			$('input', this).attr('checked', '');
			$('span', this).html('&#x2713;');
		}
	});

});
</script>
JS;

include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>