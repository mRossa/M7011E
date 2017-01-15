<?php
include 'apiMethods.php';
$userName = $_SESSION['login_user'];
$url = "https://iladid3.ddns.net/api/post/" . $userName; 
$res = getExecute($url);
$result = json_decode($res);
$data = $result->data;
$size = sizeof($data);
$i=0;
echo $size;
while($i < $size){
  $desc =  $data[$i]->postDesc;
  $time =  $data[$i]->postTime;
  $url  =  $data[$i]->postLink;
  echo "<div class='panel panel-default'>";
  echo "<div class='panel-heading'>" .time. "</div>";
  echo "<div class='panel-body'>";
  if(!empty){
	echo "<img style='width:20em;' src=" . url .">"; 
  }
  echo $desc. "</div>";
  echo "</div>";
  $i = $i +1;
}
?>
