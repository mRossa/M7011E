<?php
include("config.php");
session_name('GoC');
session_start();
if(session_destroy()){
	if($_SESSION['login'] === "FB"){
		?>
		<script>
		FB.logout('auth.accesstoken' ,function(response){	
		window.location.href = 'https://iladid3.ddns.net/';	
		</script><?php
		header("location: index.php");
	}
	else if($_SESSION['login'] === "IN"){
		header("location: index.php");
	}
	else{?>
		<script>
			var auth2 = gapi.auth2.getAuthInstance();
			auth2.signOut().then(function () {
				console.log('User signed out.');
			}
		</script><?php
		header("location: index.php");
	}
}
?>