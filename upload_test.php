<?php
$target_dir = "Images/";
$target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENTION);

if(isset($_POST["upload"]))
{
	$check = getimagesize($_FILES['imageUpload']['tmp_name']);
	if($check !== false)
	{
		echo " FILE is an image - " . $check["mime"]. ".";
		$uploadOk = 1;
	}else
	{
		echo "File is not an image";
	}

}
?>
