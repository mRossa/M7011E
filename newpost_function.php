<?php
include 'apiMethods.php';

if(isset($_POST['new-post'])) {

  $userName = $_SESSION['login_user'];
  $image = 0;
  $desc = 0;
  $postDesc = $_POST['editor1'];
  //$postDesc = str_replace('>','', $postDesc);

  if($_FILES["image"]["error"] == 0) {
    $image = 1;
    include 'upload_image.php';
    $postLink = $file;
    $postLink = str_replace(" ", "", $postLink);
    if($message == 0) {
      goto end;
    }
  }
  if($_FILES["image"]["error"] == 1){
	$error = "To large file, please upload something under 1MB."; 
  }
  if(!empty($_POST['editor1'])){
    $postDesc = $_POST['editor1'];
    $desc = 1;
  } else {
    $postDesc = " ";
  }

  if(($desc == 1) || ($image == 1)) {

    $url = "https://iladid3.ddns.net/api/post";
    //$postDesc = $_POST['editor1'];
    //$postLink = $_POST['image'];

    $data = array("userName" => $userName,
		"postDesc" => $postDesc,
		"postLink" => $postLink,);

    $response = postExecute($url, $data);
    $status = $response->status;
    if($status === 200){
	header('Location: ./home.php');
    } else {
	 $error = "Something went wrong :(";
    }
  } else {
	$error = "You have to post something. ";
  }
  end:
}
?>
