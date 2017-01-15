<?php

class Request {

  public static function requestReceived () {

    //get the url, first step, need data to process, first part is api
    $request = $_SERVER['REQUEST_URI'];
    $request = ltrim($request, '/');
    $info = explode('/', $request); // $info[0] will alway be api

    if($info[1] == '') {
	sendResponse(400, '', 'text/html');
	exit;
    }

    $request_method = $_SERVER['REQUEST_METHOD'];

    $responseObj = new RequestData();
    $data = array(); // store data

    //process the data
    switch($request_method) {

	case 'get':
          $data = "Test string here";
	  // get user information here, user request
	  break;
    }

    $responseObj->setMethod($request_method);
    $responseObj->setRequestVars($data);

    if(isset($data['data'])) {

    	$responseObj->setData(json_decode($data['data']));

    }

    return $responseObj;

  }

  public static function sendResponse ($status = 200, $body = '', $content_type='text/html') {

 //    header("HTTP/1.1 $status $status_message");
 //    $response['status']=$status;
 //    $response['status_message']=$status_message;
 //     $response['data']=$data;

     include 'statusCodeMessage.php';
     $status_message = getMessage($status);

     $status_header = 'HTTP/1.1 ' . $status . ' ' . $status_message;
     header($status_header);
     header('Content-type: ' . $content_type);

     if($body != '') {

	echo $body;
	exit;
    } else {
     	$message = '';

	switch($status) {
	  case 404:
	    $message = 'The request URL '. $_SERVER['REQUEST:URI] . ' was not found.';
	    break;
	}

	$body = $status . ' ' . $message;
	echo $body;
	exit;
    }

  }

}

?>
