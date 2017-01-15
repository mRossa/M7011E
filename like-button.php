<?php
	//echo "<span class='likebtn-wrapper' data-theme='custom' data-icon_1='thmb7-u' data-icon_d='thmb7-d' data-icon_1_c='#16d811' data-icon_d_c='#f50226' data-label_c ='#5d4344' data-label_c_v='#736c6c' data-white_label='true'></span>";
	//echo "$id_post = $_GET['idPost']";
	echo "<span class='likebtn-wrapper' data-theme='greenred' data-white_label = 'true' data-identifier=$id_post></span>";
	echo "<script>(function(d,e,s){";
	echo "if(d.getElementById('likebtn_wjs'))";
	echo "{return;}";
	echo "a=d.createElement(e);";
	echo "m=d.getElementsByTagName(e)[0];";
	echo "a.async=1;";
	echo "a.id = 'likebtn_wjs';";
	echo "a.src = s;";
	echo "m.parentNode.insertBefore(a,m)})";
	echo "(document, 'script', '//w.likebtn.com/js/w/widget.js');";
	echo "</script>";
?>
