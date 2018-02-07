<?php
	$link = mysql_connect("localhost", "root", "");
	
	if (!$link) {
    die('No se puede conectar a la base de datos: ' . mysql_error());
	}
	mysql_set_charset('utf8',$link);
	mysql_select_db("supermercados",$link);	
?>	
