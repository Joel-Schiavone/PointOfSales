<?php
session_start();
include_once('inc/conectar.php');
include_once('inc/classes.php');
include_once('inc/classesExclusivas.php');

$ID_usu                 = $_SESSION['ID_usu'];
$usu_usuario            = $_SESSION['usu_usuario'];
$usu_clave              = $_SESSION['usu_clave'];
$usu_tipo               = $_SESSION['usu_tipo'];
$fechaDeHoy             = date("Y-m-d");
$HoraDeHoy              = date("H:i:s");
$FechayHora             = date("Y-m-d H:i:s");
$action                 = $_POST['action'];
@$atras                 = $_SESSION['actionsBack'];
$articulosE             = new articulosE;

  if($action=="TraeArticuloPorCodigo")
  {
    $art_cod=$_POST['art_cod'];
    $get_articulosByartCod=$articulosE->get_articulosByartCod($art_cod);
    $assoc_get_articulosByartCod=mysql_fetch_assoc($get_articulosByartCod);
    echo "<input hidden id='pre_cant' name='pre_cant' value='".$assoc_get_articulosByartCod['pre_cant']."'>";
    echo "<input hidden id='pre_neto' name='pre_neto' value='".$assoc_get_articulosByartCod['pre_neto']."'>";
    echo "<input hidden id='pre_iva' name='pre_iva' value='".$assoc_get_articulosByartCod['pre_iva']."'>";
    echo "<input hidden id='pre_porcan' name='pre_porcan' value='".$assoc_get_articulosByartCod['pre_porcan']."'>";
  }


?>