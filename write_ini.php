<?php

function write_to_pass($username, $password) {

  $filename = "/var/www/html/Files/pass.ini";
  $string = $username." = ".$password."\n";

  if(!$file = fopen($filename, 'a')) {
     return false;
  } else {

    if(fwrite($file, $string) == FALSE) {
    	return false;
    } else {
        return true;
    }
    fclose($file);
  }

}

?>
