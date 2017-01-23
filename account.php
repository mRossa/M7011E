<!DOCTYPE html>
<html lang="en">
<head>
<title> Account </title> <!-- The name that will stand on the tab -->
<?php
session_name('goc');
session_start();

include('head.php');
include('nav.php');
include('apiMethods.php');

$error;
$name = $_GET['name'];
$userName = $_SESSION['login_user'];

$url = "https://iladid3.ddns.net/api/post/$name";
$res = getExecute($url);
$result= json_decode($res);
$data = $result->data;
$size = sizeof($data);
?>
</head>
<body>
<div class="container" style="margin-top:5%">
<main class="centering">

<h3> $name </h3>
<?php
include 'comment_function.php';
$i = 0;
while($i < $size){
 $id_post = $data[i]->idPost;
 $desc = $data[i]->postDesc;
 $time = $data[i]->postTime;
 $link = $data[i]->postLink;
 echo "<div class='panel panel-default'>";
 echo "<div class='panel-heading'>" .$time;
 echo "<form action='comment.php' method='get' align='right'>";
 echo "<button name='idPost' value=$id_post class='btn btn-danger' type='submit' style='margin-right:2%;'> View </button></form>";
 echo "</div>";
 echo "<div class='panel-body'>";
 if(!empty($link)){
	echo "<img style='width:20em;' src=" .$url .">";
 }
 echo $desc. "</div>";
 echo "<div class='panel-footer'><form method='post'>";
 include 'like-button.php';
 echo "<div class='form-group'>";
 echo "<textarea name='text' class='form-controll' row='1' id='comment' placeholder='Write a comment'></textarea>";
 echo "<input class='btn btn-danger' type='submit' name='comment_desc' value='Comment'>";
 print_r($error);
 echo "</div>";
 echo "</form>";
 echo "</div>";
 $i= $i +1;
}
?>

</main>
</body>
</html>
<!--<a href="#" onclick="signOut();">Sign out</a>
<script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
</script>To log out from google.-->
