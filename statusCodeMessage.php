<?php

function getMessage($status) {

  $codes = parse_ini_file("statusCodes.ini");

  return (isset($codes[$status])) ? $codes[$status] : '';

}

?>
