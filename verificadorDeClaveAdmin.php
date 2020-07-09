<?php
include_once('inc/conectar.php');
include_once('inc/classes.php');
include_once('inc/classesExclusivas.php');
$usuariosE=new usuariosE;
$usu_clave=$_POST['usu_clave'];
$get_clavesAdmin=$usuariosE->get_clavesAdmin($usu_clave);
$num_get_clavesAdmin=mysql_num_rows($get_clavesAdmin);
$assoc_get_clavesAdmin=mysql_fetch_assoc($get_clavesAdmin);
$apellido=$assoc_get_clavesAdmin['usu_apellido'];
$nombre=$assoc_get_clavesAdmin['usu_nombre'];
echo $num_get_clavesAdmin;
?>