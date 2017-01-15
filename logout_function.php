<?php

session_name('goc');
session_start();

$user = $_SESSION['login_user'];
$login = $_SESSION['login'];

if(session_destroy()) { // Destroying All data of Sessions

	if($_SESSION['login'] === 'fb'){

		$_SESSION['facebook_access_token'] = NULL;
		header("location: index.php");
	}
	else{
		header("location: index.php");
	}
} else {

	echo "Something went wrong, try again later";
	
}

?>