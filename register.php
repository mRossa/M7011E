<!DOCTYPE html>
<html lang="en">
<head>
<title> GoC Register </title> <!-- The name that will stand on the tab -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="cover.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
 session_name('goc');
 session_start();
 $id = session_id();

	$error = "";
	$login = $uname = $pword = "";
	$name = $email = "";
	$nameval = $emailval = $userval = "";

	require('register_function.php');
?>
<div class="site-wrapper">
	<div class="site-wrapper-inner">
		<div class ="cover-container">
			<div class="inner cover">
			 <form class="form-horizontal" method ="post" action="">
				<?php echo $error; ?>
				<div class="form-group">
				  <label class="control-label col-sm-4" for="name">*Name</label>
				  <div class="col-sm-4">
					<input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo $nameval ?>">
				  </div>
				</div>
				 <div class="form-group">
				  <label class="control-label col-sm-4" for="email">*Email</label>
				  <div class="col-sm-4">
					<input type="email" class="form-control" id="email" name="email" placeholder="Name@example.com" value="<?php echo $emailval ?>">
				  </div>
				  </div>
				<div class="form-group">
				  <label class="control-label col-sm-4" for="username">*Username</label>
				  <div class="col-sm-4">
					<input type="text" class="form-control" name="username" id="username" placeholder="Min 6 characters long" value="<?php echo $userval ?>">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-4" for="password">*Password</label>
				  <div class="col-sm-4">
					<input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
				  </div>
				</div>
				<div class="form-group">
				  <div class="col-sm-offset-4 col-sm-4">
				  <input name="reg-submit" type="submit" class="form-control" value=" Register ">
				  </div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-4">
						<a href="./index.php" id="register">Login</a>
					</div>
				</div>
			  </form>
		  </div>
		</div>
	</div>
</div>
</body>
</html>
<!--
//<?php
	
				//"password"=>$password,
				//"firstName"=>$fname,
				//"lastName"=>$lname,
				//"email"=>$email,
				//"storageLink"=> "https://iladid3.ddns.net/owncloud/$username" ,
				//"trustWorthy" => 100; );
	//$res=postExecute($info);
//?>	$info=array("userName"=>$username,
<div class="form-group has-success has-feedback">
      <label class="col-sm-2 control-label" for="inputSuccess">Input with success and glyphicon</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputSuccess">
        <span class="glyphicon glyphicon-ok form-control-feedback"></span>
      </div>
    </div>
    <div class="form-group has-warning has-feedback">
      <label class="col-sm-2 control-label" for="inputWarning">Input with warning and glyphicon</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputWarning">
        <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
      </div>
    </div>
    <div class="form-group has-error has-feedback">
      <label class="col-sm-2 control-label" for="inputError">Input with error and glyphicon</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputError">
        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
      </div>
    </div>
  </form>
  -->
