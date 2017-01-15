<!DOCTYPE html> 
<html lang="en"> 
<head> 
<title> My Account </title> 
<?php include('head.php');
session_name('goc'); 
session_start(); 
$id = session_id(); 
?> 
</head> 
<body> 
<div class="container" style="margin-top=5%"> 
<?php 
include('nav.php'); 
include('apiMethods.php'); 
$userName = $_SESSION['login_user']; 
$url ="https://iladid3.ddns.net/api/user/" .$userName;
$res = getExecute($url); 
$result = json_decode($res); 
$data = $result->data; 
$name =$data[0]->name; 
$email = $data[0]->email;  
?>
<main class="centering"> 
<h3 style="centering">blablablabla</h3> 
<h2> Your Account </h2>
Name : <?php if(empty($name)){echo $userName;}else{ echo $name;} ?><br> 
Email : <?php if(empty($email)){echo "You are currently logged in with fb.";}else{ echo $email;} ?><br> 
<h3 style="centering">Your latest posts</h3> 
<?php 
$urlP ="https://iladid3.ddns.net/api/post/" .$userName;
$resP = getExecute($urlP);
$resultP = json_decode($resP);
$dataP = $resultP->data;
$i = 0; 
$size = sizeof($dataP); 
//echo " " .$size; 
if($size !== 0){
 while($i < $size){
  $desc = $dataP[$i]->postDesc;
  $time = $dataP[$i]->postTime;
  $link = $dataP[$i]->postLink;
  $idPost = $dataP[$i]->idPost;
  echo "<div class='panel panel-default'>";
  echo "<div class='panel-heading' align='left'>";
  echo $time;
  echo "<form action='comment.php' metod='get' align='right'>";
  echo "<button name='idPost' value='$idPost' class='btn btn-danger' type='submit' style='margin-right:2%'> View </button>";
  echo "</form>";
  echo "</div>";
  echo "<div class='panel-body'>";
  if(!empty($link)){
	echo "<img style='width:20em;' src=". $link.">";
  }
  echo "<p style='align:left;'>".$desc. "</p></div>";
  echo "</div>";
  $i = $i +1;
 }
}else{
 echo "You have not posted any post yet. ";
}
?>
</main>
</div>
</body>
</html>
