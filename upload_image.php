<?php

$name = $_SESSION["login_user"];
$dir = "Images/".$name."/";
$file = $dir . basename($_FILES["image"]["name"]);
$message = 1;
$file_type = pathinfo($file,PATHINFO_EXTENSION);

$check = getimagesize($_FILES["image"]["tmp_name"]);
if(!$check) {
 $error = "Can only upload images!";
 $message = 0;
}

$hav_wh = strrpos($file, " ");
if($hav_wh){
 $error = "No whitespace in the filename";
 $message = 0;
}

if(file_exists($target_file)) {
  $error = "Image already exist, change name or upload something else";
  $message = 0;
}

if($_FILES["image"]["size"] > 100000) {
  $error ="Image too large";
  $message = 0;
}

if(($file_type != "jpg") and ($file_type != "png") and ($file_type != "jpeg") and ($file_type != "gif")) {
  $error = "No supported format: ". $file;
  $message = 0;
}

if($message == 0) {
  //$error = "Can't upload image";
} else {
  if(move_uploaded_file($_FILES["image"]["tmp_name"], $file)) {
    $error = "The file" .$file. "has been uploaded";
  } else {
    $error = "Sorry, there was an error";
  }
}

?>
