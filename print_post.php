<?php //session_name('goc'); //session_start(); //$id = session_id();

include 'nav.php';
include 'apiMethods.php';

$userName = $_SESSION['login_user'];

$url = "https://iladid3.ddns.net/api/post";
$res = getExecute($url);
$result = json_decode($res);
$data = $result->data;
?>
<div class="container" style="margin-top:5%">
<main class="centering">
<?php
 $size = sizeof($data);
 $i=0;

 while($i < $size){
  $postUser = $data[$i]->userName;
  $desc = $data[$i]->postDesc;
  $time = $data[$i]->postTime;
  $url = $data[$i]->postLink;
  $id_post = $data[$i]->idPost;
  echo "<div class = 'panel panel-default'>";
  echo "<div class='panel-heading' align='left'>";
  echo $time . " <b>" . $postUser. "</b>";
  echo "<form action='comment.php' method='get' align='right'>";
  echo "<button name='idPost' value='$id_post' class='btn btn-danger' type='submit' style='margin-right:2%;'>   View   </button></a>";
  echo "</form>";
  echo "</div>";
  echo "<div class='panel-body'>";
  if(!empty($url)) {
    echo "<img style='width:30em;  object-fit:contain' src=". $url . ">";
  }
  echo "<p style='align:left;'>".$desc . "</p></div>";
  echo "<div class='panel-footer'>";
  include 'like-button.php';
  echo " </div>";
  echo "</div>"; 
  $i = $i + 1;
 }
?>
