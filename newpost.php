<!DOCTYPE html>
<html lang="en">
<head>
<title> GoC Home </title> <!-- The name that will stand on the tab -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style2_0.css">
<!--<link rel="stylesheet" href="onoffswitch-question.css">--><!-- For a question button-->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="cover.css">-->

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--Text Editor-->
<!--<script src="//cdn.ckeditor.com/4.6.1/full/ckeditor.js"></script>-->
<!--<script src="//cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>-->
<script src="//cdn.ckeditor.com/4.6.1/basic/ckeditor.js"></script>
<link rel="stylesheet" href="onoffswitch-question.css">
</head>
<body>
<?php

session_name('goc');
session_start();
$id = session_id();
$error = "";
$postDesc ="";

include 'nav.php';
include 'newpost_function.php';

?>
<div class="container" style="margin-top:5%">
<section>
	<!--<form>
		 <div class="onoffswitch">
			<input type="checkbox"  name="onoffswitch-question" class="onoffswitch-question" id="question-onoff" checked>
			<label class="onoffswitch-label" for="onoffswitch-question">
				<span class="onoffswitch-inner"></span>
				<span class="onoffswitch-switch"></span>
			</label>
		     </div>
	</form>--> <!--Question button if we want to add it now -->
	<form method="post" enctype="multipart/form-data">
		<textarea class="centering" width="80%" name="editor1" <?php echo "value=". $postDesc.">"; ?> </textarea>
		<script>
			CKEDITOR.replace( 'editor1', 
			{
				fullPage : false
			});
		</script> 
		<br><input type="file" name="image" id="image" value="Image file"/> <!--<br> <input type="text" name="tag" id="tag" value="Add a tag"> <br>-->
		<br><input type="submit" id="preview_post" name="new-post" class="form-control" style="background-color:lightgray;" value=" Submit ">
	</form>
	<?php echo $error; ?>

</section>
</div>
</body>
</html> 
