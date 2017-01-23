<?php
include 'apiMethods.php';

$url = "http://iladid.ddns.net/api/comment/" . $id_post;
$res2 = getExecute($url);
$rest = json_decode($res2);
$data = $rest->data;

$user = $data[0]->userName;
echo $user;

/*
$size = sizeof($data);
$i = 0;

while($i < $size) {
  $comment = $data[$i]->comment;
  echo $comment;
}*/

?>

