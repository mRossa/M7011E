<?php
 include('config.php');
 
 //private $username = $_SESSION('username');
 
 function login(){
	 $username = $_POST('username');
	 $password = $_POST('password');
	 $sql = "SELECT password FROM User WHERE userName = '$username'";
	 if(checkQuery($sql)){
		 if($row["password"] === "$password"){
			echo "You are logged in.";
		}else{
			echo "wrong password.";
		}
	 }else{
		 echo "Cant find your account.";
	 }
 }
 function newUser(){
    $username = $_POST('username');
	$pass = $_POST('password');
	$fname = $_GET('firstName');
	$lname = $_GET('lastName');
	$email = $_GET('email');
	$storage = iladid.ddns.net:8000\owncloud\'$username';	
	$mysql_U = 'INSERT INTO Users(UserName) VALUES ("$username")';
	$mysql_User = 'INSERT INTO User(userName,password,firstName,lastName,email, storageLink) VALUES ("$username", "$pass", "$fname", "$lname", "$email", "$storage")';
	if(!checkQuery($mysql_U)){
		echo "Something went wrong, could not add to Users.";
	}
	else{
		echo "User added in Users."
		if(!checkQuery($mysql_User)){
			echo "Could not add User in User";
		}
	}
	
 } 
 function newPassword(){
  $username = $_POST('username');
  $pass = $_POSY('password');
  $newpass = $_POST('new_pass');
  $lastpass  = "SELECT password WHERE username = $username FROM User";
  if(checkQuery($lastpass)){
	if("$lastpass" === "$pass"){
		$sql = "UPDATE User SET password='$newpass' WHERE username = '$username'";
		if(!checkQuery($sql)){
			echo "Can't add the new password."; 
		}
	}
  }else{
	  echo "Wrong password.";
  }
 }
 function updateUser(){
	 $username = $_POST('username');
	 $fname = $_GET('firstName');
	 $lname = $_GET('lastName');
	 $email = $_GET('email');
	 $sql = "UPDATE User SET firstName = $fname, lastName = $lname, email = $email WHERE userName = $username";
	 if(!checkQuery()){
		 echo "Could not update your information."
	 }
  }
 function deleteUser(){
	  $username = $_POST('username');
	  $sql = "DELETE FROM User WHERE userName = '$username'";
	  if(checkQuery($sql)){
		  $sql_U = "DELETE FROM Users WHERE UserName = '$username'"
		  if(!checkQuery($sql_U)){
			  echo "Could not delete the user from users.";
		  }
	  }else{
		  echo "Could not delete the user.";
	  }
  }
 function follow(){
	 
 }
 
 function newPost(){
	  $username = $_POST('username');
	  $desc = $_GET('description');
	  $link = $_GET('link');
	  $cat = $_GET('category');
	  $subcat = $_GET('subcate');
	  $sql = "INSERT INTO Post(userName, postDesc, postLink, category, subCategory) VALUES ('$username','$desc','$link','$cat','$subcat')";
	  if(!checkQuery($sql)){
		  echo "Something is wrong with your post.";
	  }else{
		  $post_id = $conn->insert_id;
		  $question = $_GET('question');
		  if($question === 'true'){
			  $sql = "INSERT INTO Question(idPost, questionState) VALUES ($post_id, $question)";
			  if(!checkQuery($sql)){
				  echo "It didnt work to create a new question in the database";
			  }
		  }
	  }
 }
 function editPost(){ 
	  $post_id = $_GET('post_id'); // "SELECT idPost FROM Post where username = '$username'";
	  $username = $_POST('username');
	  $desc = $_GET('description');
	  $link = $_GET('link');
	  $cat = $_GET('category');
	  $subcat = $_GET('subcate');
	  $sql = "UPDATE Post SET postDesc = '$desc', postLink = '$link', category = '$cat', subCategory = '$subcat' WHERE userName = '$username', idPost = $post_id";
	  if(!checkQuery($sql)){
		  echo "It did not work to edit your post.";
	  }else{
		  $question = $_GET('question');
		  if($question === 'true'){
			  $sql = "SELECT questionState WHERE idPost = $post_id";
			  if(checkQuery($sql)){
				  $sql = "UPDATE Question SET questionState = $question";
				  if(!checkQuery($sql)){
					  echo "Could not update question";					  
				  }
			  }
			  else{
				  $sql = "INSERT INTO Question(idPost, questionState) VALUES ($post_id, $question)";
				  if(!checkQuery($sql)){
					  echo "It didnt work to create a new question in the database";
				  }
			  }
		  }
	  }
 }
 function deletePost(){
	  $post_id = $_GET('post_id');
	  $username = $_POST('username');
	  $question = $_GET('question');
	  $like = $conn->"SELECT * FROM Like WHERE idPost = $post_id";
	  $comment = $conn->"SELECT * FROM Comment WHERE idComment = $post_id";
	  
	  if($like != 0 || $like != NULL){
		  $sql = "DELETE FROM Like WHERE idPost = $post_id";
		  if(!checkQuery($sql)){
			  echo "Could not delete from like."; 
		  }else{
			$like = 0;
		  }
	  }if($question === 'true'){
		  $sql = "DELETE FROM Question WHERE idPost = $post_id";
		  if(!checkQuery($sql)){
			  echo "Could not delete from question."; 
		  }else{
			  $question = 'false';
		  }	
	  }
	  else if($like = 0 || $like == NULL && $question = 'false'){
		 /*$sql = "DELETE FROM Post WHERE userName = '$username', idPost = $post_id";// might be deletPostOnly($username, $post_id);
		 if(!checkQuery('$sql')){
				echo "Could not delete this post";
		 }*/
		 if(deletPostOnly($username, $post_id)){
			 if($comment != 0 || $comment != NULL){//something might be wrong here, I dont know. 
				   $sql = "DELETE FROM Comment WHERE idComment = $post_id";
				   if(!checkQuery($sql)){
						echo "Could not delete the comment.";
					}
			 }
		 }else{
			 echo "Could not delete the post";
		 }
	  }else{
		  echo "Something went wrong while trying to delete your post."
	  }
 }
 function addComment(){
	 newPost();
	 $id_post = $_GET('post_id');
	 $id_comment = $conn->insert_id;
	 $sql = "INSERT INTO Comment(idComment, idPost) VALUES($id_comment, $id_post)";
	 if(!checkQuery($sql)){
		 echo "Could not add your comment.";
	 }
 }
 function likePost(){
	 $id_post = $_GET('post_id');
	 $user = $_POST('username');
	 $sql = "INSERT INTO Like(idPost, userName) VALUES ('$id_post', '$user')";
	 if(!checkQuery($sql)){
		echo "You can't like that post."
	 }
 }
 
 function String[] getCategories(){
	 
 }
 function String[] getSubCategories(){
	
}

 private function boolean deletePostOnly(username,id){
	$username = username;
	$post_id = id;
	$sql = "DELETE FROM Post WHERE userName = '$username', idPost = $post_id";
	if(!checkQuery('$sql')){
		echo "Could not delete this post";
		return false;
	}
	return true;
 }
 private function boolean isQuestion(post){
	 $id_post = post;
	 $sql = "SELECT questionState FROM Question WHERE idPost = '$id_post'";
	 if(checkQuery($sql)){
		 if($sql === 'true'){
			 echo "It is a question";
			 return true;
		 }
		 else{
			 echo "It is not a question";
			 return false;
		 }
	 }
 }
 private function boolean checkQuery(sql_code){
		if($conn->query(sql_code)){
			echo "ERROR: ". sql_code . "<br>". $conn->error;
			return false;
		}
		echo "success";
		return true;
 }
 
 $conn->close();
?>