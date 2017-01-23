<?php

function getExecute($url) {

 $ch = curl_init($url);

 curl_setopt($ch, CURLOPT_HEADER, 0);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

 $response = curl_exec($ch);
 curl_close($ch);

 $reponse = json_decode($response);

 return $response;

}

function postExecute($url, $data) {

 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_HEADER, 0);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_POST, 1);
 $query = http_build_query($data, '', '&');
 curl_setopt($ch, CURLOPT_POSTFIELDS, $query);

 $response = curl_exec($ch);
 curl_close($ch);
 $response = json_decode($response);

 return $response;

}

function putExecute($url, $data) {

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
  $query = http_build_query($data, '', '&');
  curl_setopt($ch, CURLOPT_POSTFIELDS, $query);

  $response = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($response);

  return $response;

}

?>
