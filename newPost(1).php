<!DOCTYPE html>
<html lang="en">
<head>
<title> GoC Home </title> <!-- The name that will stand on the tab -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style2_0.css">
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="cover.css">-->

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--Text Editor-->
<!--<script src="//cdn.ckeditor.com/4.6.1/full/ckeditor.js"></script>-->
<!--<script src="//cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>-->
<script src="//cdn.ckeditor.com/4.6.1/basic/ckeditor.js"></script>
</head>
<body>
<script>
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
		console.log('Logged in.');
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

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1836783593233646',
	  cookie 	 : true,
	  status     : true,
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
	FB.getLoginStatus(function(response) {
	statusChangeCallback(response);
	});
};


  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
   function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
	}
	function logout(){
		FB.logout('auth.accesstoken' ,function(response){	
		window.location.href = 'https://iladid3.ddns.net/';	
	});
	}
	
</script>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">GoC</a>
		</div>
		<form class="navbar-form navbar-right">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search">
				<div class="input-group-btn">
					<button class="btn btn-default" type="submit">
						<i class="glyphicon glyphicon-search"></i>
					</button>
				</div>
			</div>
		</form>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="./home.php"><span class="glyphicon"></span>Home</a></li>
			<li><a href="./info.php"><span class="glyphicon"></span>About</a></li>
			<li><a href="./account.php"><span class="glyphicon glyphicon-user"></span>My Account</a></li>
			<li><a href="./index.php"><span class="glyphicon glyphicon-log-in"></span>Log out</a></li>
		</ul>
	</div>
</nav>
<section>
	<form method="post" action="">
		<textarea class="centering" width="80%" name="editor1"></textarea>
		<script>
			CKEDITOR.replace( 'editor1', 
			{
				fullPage : false
			});
		</script> 
		<input type="file" name="image" value="Image file"/>
		<input type="text" name="figcap" style="padding-top=20%;" placeholder="Figure caption"/><br>
		<button type="submit" id="preview_post" class="btn btn-default">Preview</button> 
	</form>

</section>

</body>
</html> 
