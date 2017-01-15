<?php

function mkdir_func($path) {
  echo $path;
  if(mkdir($path, 0700, true)) {
	return true;
  } else {
	return false;
  }

}

?>
