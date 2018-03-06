<?php
session_start();
include_once('inc/conectar.php');
include_once('inc/classes.php');
include_once('inc/classesExclusivas.php');
$ID_usu             = $_SESSION['ID_usu'];
$usu_usuario        = $_SESSION['usu_usuario'];
$usu_clave          = $_SESSION['usu_clave'];
$usu_tipo           = $_SESSION['usu_tipo'];
$fechaDeHoy         = date("Y-m-d");
$HoraDeHoy          = date("H:i:s");
$FechayHora         = date("Y-m-d H:i:s");
@$action            = $_POST['action'];
@$atras             = $_SESSION['actionsBack'];
$paramentros         = new paramentros;
?>
 <!-- Inicio: Estilos Generales-->
  <link href="css/generales.css" rel="stylesheet"> 
 <!-- Fin: Estilos Generales-->
 <style type="text/css">
   td
   {
    text-align: center;
   }
   th
   {
    text-align: center;
   }
 </style>
<?php
  if($action=="modificarParametros")
  {
    $ID_par               =1;
    $par_razonSocial      =$_POST['par_razonSocial'];
    $par_cuil             =$_POST['par_cuil'];
    $par_telefono         =$_POST['par_telefono'];
    $par_direccion        =$_POST['par_direccion'];
    $par_iva              =$_POST['par_iva'];
    $par_ganancia         =$_POST['par_ganancia'];
    $ID_par               =1;
    $update_paramentrosById=$paramentros->update_paramentrosById($ID_par, $par_razonSocial, $par_cuil, $par_telefono, $par_direccion, $par_iva, $par_ganancia);

    //REDIRECCIONA
        echo '<script type="text/javascript">
        window.location.assign("'.$atras.'?M=6");
        </script>';

  }
?>