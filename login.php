<?php
/*	$login = $_POST['login'];
	$user = $_POST['user'];
	if($login != ''){
			$_SESSION['log-in'] = $login;
			$_SESSION['user']= $user;
	} */
include 'apiMethods.php';

if(isset($_POST['login-submit'])){

  $sessPath = ini_get('session.save.path');
  $sessName = ini_get('session.name');

  $admin = false;
  if(isset($_POST['username']) && isset($_POST['password']) && ($_POST['password']!='')){
	$user = $_POST['username'];
	$pass = $_POST['password'];
        //$url = "https://iladid3.ddns.net/api/user/". $user;
	//$result = getExecute($url);
        //$result = json_decode($result);
	//$status = $result->status;
	//if($status === 200){
	//    $data = $result->data;
	//    $hash = $data[0]->password;
       $pass_ini = parse_ini_file("Files/pass.ini");
       $hash = $pass_ini[$user];
       if(isset($hash)) {
	    if(password_verify($pass, $hash)){
	    	session_regenerate_id(true);
	    	$_SESSION['login_user']= $user;
                $_SESSION['login'] = 'login';
	    	header('location: home.php');
	    } else{
	    	$error = "Invalid password. Please try again.";
	    }
	} else{
	  $error = "Invalid username. Please try again.";
	}
 } else{
   $error = "Please enter an username and password to login.";
 }

}
?>

