<?php
	$link = mysql_connect("localhost", "joel", "C0c0dril0");
	if (!$link) {
    die('No se puede conectar a la base de datos: ' . mysql_error());
	}
	mysql_set_charset('utf8',$link);
	mysql_select_db("joel_joel_supermercado2018",$link);	
?>	
