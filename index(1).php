<?php

include 'statusCodeMessage.php';
include 'requestProcess.php';

//$request = $_SERVER['REQUEST_URI'];
//$request_method = $_SERVER['REQUEST_METHOD'];

//$request = ltrim($request, '/');
//$info = explode('/', $request);
//$data =  $request . ' ' . $request_method;
//header("HTTP/1.1 200 OK");
//$response['status'] = 200;
//$response['status_message'] = "OK";
//$response['data'] = $data;

//$json_response = json_encode($response);
//echo $json_response;
//echo sizeof($info) . "\n";
//echo $info[0] . ' ';
//if($info[1] == '') { echo " It is empty"; }

$response = RequestProcess::process();
echo $response;


?>
