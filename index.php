<!DOCTYPE html>
<html lang="en">
<head>
<title> GoC Login </title> <!-- The name that will stand on the tab -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="cover.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--Google sign in 
<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="227961369743-naigal13qlk530r28k3de83iltklu8a3.apps.googleusercontent.com">
-->
</head>
<body>
<?php
	session_name('goc');
	session_start();
	$id = session_id();
	$_SESSION['facebook_access_token']="";
        $error="";
	require('login.php');

?>

<div class="site-wrapper">
	<div class="site-wrapper-inner">
		<div class ="cover-container">
			<div class="inner cover">
			 <form class="form-horizontal" method="post" action="">
			   <span><?php echo $error; ?></span>
			   <div class="form-group">
				 <div class="col-sm-offset-3 col-sm-4">
					<label class="control-label" for="username">Username</label>
				 </div>
				</div>
				<div class="form-group">
				  <div class="col-sm-offset-4 col-sm-4">
					<input name="username" type="username" class="form-control" id="username" placeholder="Enter username">
				  </div>
				</div>
				<div class="form-group">
				 <div class="col-sm-offset-3 col-sm-4">
					<label class="control-label" for="username">Password</label>
				 </div>
				</div>
				<div class="form-group">
				  <div class="col-sm-offset-4 col-sm-4">          
					<input name="password" type="password" class="form-control" id="password" placeholder="Enter password">
				  </div>
				</div>
				<div class="form-group">        
				  <!-- <div class="col-sm-offset-4 col-sm-4">
					<div class="checkbox">
					  <label><input type="checkbox">Remember me</label>
					</div>
				  </div> -->
				</div>
				<div class="form-group">
				  <div class="col-sm-offset-4 col-sm-4">
					<!--<button type="submit" id="login-submit" class="btn btn-default">Log in</button>-->
					<input name="login-submit" type="submit" class="form-control" value=" Login ">
				  </div>
				</div>
			    <div class="form-group">
					<div class="col-sm-offset-4 col-sm-4">
						<a href="./register.php">Register now</a>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-4">
						or as a guest through
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-4">
					<!--<div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="true"></div>-->
					<?php include('login_fb.php'); ?>
					</div>
				</div>
				<!--<div class="form-group">
					<div class="col-sm-offset-4 col-sm-4">
						<div class="g-signin2" data-onsuccess="onSignIn" style="margin-left:19%;margin-top:7%;"></div>					
					</div>					
				</div>
				-->
			  </form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
