<?php
 $server = "iladid3.ddns.net:22"; //mysql server on my raspberry. 
 $user = 'goc';
 $pass = "1QazXsw2";
 $db = "goc_DB";
 
 $conn = new mysqli($server,$user,$pass,$db);
 
 if($conn->connect_error){
	die("Connection failed: . $conn->connect_error");
 }
 echo "Connection successfully";

?>