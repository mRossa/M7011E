<!DOCTYPE html>
<html lang="en">
<head>
<title>Change Information</title>
<?php
include('head.php'); 
session_name('goc');
session_start();
$id=session_id();
$userName = $_SESSION['login_user']; 
?>
</head>
<body>
<div class="container" style="margin-top:5%">

<?php
//echo $userName;
include('nav.php');
include('apiMethods.php');

$url = "https://iladid3.ddns.net/api/user/" .$userName;
$res = getExecute($url);
$result = json_decode($res);
//print_r($res);
$data = $result->data;
$name = $data[0]->name;
$email = $data[0]->email;
$error = "";
?>
<main style="centering">
<h3> Change your information </h3>
<?php echo $error; ?>
<form method="post">
	<input type="text" id="ChangeName" name="ChangeName" placeHolder="Name" value="<?php echo $name;?>" ><br>
	<input type="text" id="ChangeEmail" name="ChangeEmail" placeHolder="Email" value="<?php echo $email;?>"><br>
	<button type="submit" class="btn btn-danger" name="change-submit">Change</button>
</form>
<?php
//include 'register_function.php';
if(isset($_POST['change-submit'])){
	if(empty($_POST['ChangeName']) or empty($_POST['ChangeEmail'])){
		$error = "You must fill in all the information";
	}
	else{
		$nameval = $_POST['ChangeName'];
	 	$emailval = $_POST['ChangeEmail'];
		$url = "https://iladid3.ddns.net/api/user/" .$emailval;
		$result = getExecute($url);
		$res = json_decode($result);
		$data = $res->data;
		
		if(!empty($data) and $email!=$emailval){
			echo "empty";
			$error = "Email already taken/registered";
		}
		/*else{
			$emailval = string_input($emailval);
		}*/
		if($error ==  ""){
			$data = array("name" =>  $nameval,
			  	      "email" =>  $emailval,
				      "userName"=>$userName,);
			$response = putExecute($url, $data);
			print_r($response);
			$status = $response->status;
			if($status === 200 ){
				echo  "yeah";
				header("Location: ./my_account.php");
			}else{
				echo "again";
				$error = "Something went wrong";
			}
		}
		else{
		     $error =  "you have to change both name and email if you want to change something";
		}
	}
}
?>
</main>
</div>
</body>
</html>
