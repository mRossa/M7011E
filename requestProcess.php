<?php
class RequestProcess {

  public function __construct() {
     include 'statusCodeMessage.php';
  }

  public static function process() {
    $method = $_SERVER['REQUEST_METHOD'];
    $url = $_SERVER['REQUEST_URI'];
    $url = ltrim($url, '/');
    $info = explode('/', $url); // index 0 is api

    if($info[1] == '') {
      RequestProcess::sendResponse(400, '', 'text/html');
      exit;
    }

    switch($method) {
        case 'PUT':
	  $fp = fopen("php://input", 'r');
          $data = stream_get_contents($fp);
	  parse_str($data, $data);
	  $size = sizeof($data);
	  $table = ucfirst($info[1]);
          RequestProcess::changeTable($info, $data);
	  break;
    	case 'GET':
	  RequestProcess::getUser($info);
          break;
      	case 'POST':
          $fp = fopen("php://input", 'r');
          $data = stream_get_contents($fp);
	  parse_str($data, $data);
          $size = sizeof($data);
          $table = ucfirst($info[1]);
          if($size == 5){ // Should change to an variable, easy to change
	    RequestProcess::newUser($info, $data);
       	  } elseif($table ==='Post') {
	    RequestProcess::newPost($info, $data);
          } elseif($table ==='Comment') {
	    RequestProcess::newComment($info, $data);
	  } else {
            RequestProcess::sendResponse(400, $table, 'text/html');
            exit;
	  }
          fclose($fp);
	  break;
    }
  }


  public static function sendResponse ($status = 200, $data = '', $content_type = 'text/html') {

    $status_message = getMessage($status);
    header("HTTP/1.1 $status $status_message");
    header('Content-type: ' . $content_type);

    $response['status'] = $status;
    $response['status_message'] = $status_message;
    $response['data'] = $data;

    $json_response = json_encode($response);
    echo $json_response;

  }

  private function changeTable($info, $data) {
    $config = parse_ini_file('config.ini');
    $conn = new mysqli($config['server'],$config['user'],$config['pass'],$config['db']);
    $table = ucfirst($info[1]);
    if($table === 'Post') {
	$idPost = $data['idPost'];
	$sql = "UPDATE Post SET likes = likes + 1 WHERE idPost = $idPost";
    } elseif($table === 'User') {
	$email = $data['email'];
        $name = $data['name'];
        $userName = $data['userName'];
        $sql = "UPDATE User SET email='$email',name='$name' WHERE userName='$userName'"; 
    }

    if(mysqli_query($conn, $sql)) {
	RequestProcess::sendResponse(200, '', 'text/html');
    } else {
	$error = mysqli_error($conn);
        RequestProcess::sendResponse(500, $error, 'text/html');
    }
    mysqli_close($conn);
  }

  private function newPost($info, $data) {

    $config = parse_ini_file('config.ini');
    $conn = new mysqli($config['server'],$config['user'],$config['pass'],$config['db']);
    if($conn->connect_error) { die('Unable to connect to database'); }

    $userName = $data['userName'];
    $postDesc = $data['postDesc'];
    $postLink = $data['postLink'];

    if($userName == '') {
	RequestProcess::sendResponse(400, $data, 'text/html');
	exit;
    }
    $sql = "INSERT INTO Post (idPost,userName,postDesc,postLink,postTime) VALUES (NULL,'$userName','$postDesc','$postLink',NOW())";
    if(mysqli_query($conn, $sql)) {
	RequestProcess::sendResponse(200,'','text/html');
    } else {
	$error = mysqli_error($conn);
	RequestProcess::sendResponse(500, $error, 'text/html');
    }
    mysqli_close($conn);
  }

  private function getUser($info) {

    $config = parse_ini_file('config.ini');
//    if($conn->connect_error) { sendResponse(404,'', 'text/html'); }
    $conn = new mysqli($config['server'],$config['user'],$config['pass'],$config['db']);
    if($conn->connect_error) { die('Unable to connect to database'); }

    $table = ucfirst($info[1]);
    $size = sizeof($info);
    if($size > 2) {
      $index = $info[2];
      $length = strlen($index);
      $isEmail = strpos($index, '@');
      /*if(($length < 6) && !($isEmail) && ($table === 'User')) {
      } elseif(($length < 6) && !($isEmail) && ($table === 'Post')) {
      	$sql = "SELECT * FROM Post WHERE idPost=$index";
      } */
      if(($length < 6) && !($isEmail) && ($table ==='User')) {
        $sql = "SELECT UserName FROM Users WHERE (idUser=$index)";
        $sql = "SELECT userName,name,email FROM User WHERE (userName=($sql))";
      } elseif(($length < 6) && !($isEmail) && ($table === 'Post')) {
	$sql = "SELECT * FROM Post WHERE idPost=$index";
      } elseif (($length < 6) && !($isEmail) && ($table === 'Comment')) {
	$sql = "SELECT * FROM Comment WHERE idPost=$index ORDER BY time DESC";
      } elseif (($length < 6) && !($isEmail) && ($table === 'Users')) {
	$sql = "SELECT * FROM Users WHERE idUser=$index";
      } elseif($isEmail){
        $sql = "SELECT userName,name,email FROM User WHERE email='$index'";
      } elseif($table === 'User') {
        $sql = "SELECT userName,name,email FROM User WHERE userName='$index'";
      } elseif($table === 'Post') {
	$sql = "SELECT * FROM Post WHERE userName='$index' ORDER BY postTime DESC";
      } else {
	$sql = "SELECT * FROM $table";
      }
    } else {
      if($table === 'Post') {
	$sql = "SELECT * FROM Post ORDER BY postTime DESC";
      }elseif($table === 'User') {
	$sql = "SELECT userName,name,email FROM User";
      } else {
        $sql = "SELECT * FROM $table";
      }
    }
    if(mysqli_query($conn, $sql)) {
	$query = mysqli_query($conn, $sql);
        $data = array();
        while($i = mysqli_fetch_assoc($query)) {
       	  $data[] = $i;
	}
        RequestProcess::sendResponse(200, $data, 'text/html');
    } else {
	$error = myqsli_error($conn);
	RequestProcess::sendResponse(500, $error, 'text/html');
    }

    mysqli_close($conn);
  }

  private function newUser($info, $data) {

    $config = parse_ini_file('config.ini');
    $conn = new mysqli($config['server'],$config['user'],$config['pass'],$config['db']);
    if($conn->connect_error) { die('Unable to connect to database'); }

    $table = ucfirst($info[1]);
    $size = count($data);
    $userName = $data['userName'];
    //$password = $data['password'];
    $name = $data['name'];
    $email = $data['email'];
    $storlink = $data['storageLink'];
    $trust = $data['trustWorthy'];

    if($data['UserName'] == 'NULL') {
	RequestProcess::sendResponse(400, '', 'text/html');
        exit;
    }
    $sql = "INSERT INTO Users (idUser,UserName) VALUES (NULL,'$userName')";
    $sql2 = "INSERT INTO User (userName, name, email, storagelink, trustWorthy) VALUES ('$userName', '$name', '$email', '$storlink', '$trust')";
    $test = "SELECT UserName FROM Users WHERE (UserName=$userName)";
    $data = mysqli_query($conn, $test);
    if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
   	  RequestProcess::sendResponse(200, '', 'text/html');
    } else {
        $error = mysqli_error($conn);
   	RequestProcess::sendResponse(500, $error, 'text/html');
    }
    mysqli_close($conn);
  }

  private function newComment($info, $data) {

    $config = parse_ini_file('config.ini');
    $conn = new mysqli($config['server'],$config['user'],$config['pass'],$config['db']);
    if($conn->connect_error) {die('Unable to connect to database'); }

    $idPost = $data['idPost'];
    $comment = $data['comment'];
    $post_uname = $data['post_uname'];
    $uname = $data['uname'];

    $sql = "INSERT INTO Comment (idComment,idPost,comment,userName,time) VALUES (NULL, (SELECT idPost FROM Post WHERE userName='$post_uname' AND idPost=$idPost),'$comment',(SELECT userName FROM User WHERE userName='$uname'),NOW())";

    if(mysqli_query($conn, $sql)) {
	RequestProcess::sendResponse(200,'','text/html');
    } else {
	$error = mysqli_error($conn);
	RequestProcess::sendResponse(500,$error,'text/html');
    }
    mysqli_close($conn);
  }

  private function deleteUser($info) {



  }

}

?>
