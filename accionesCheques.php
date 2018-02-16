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
$cheques            = new cheques;

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
  if($action=="nuevoCheque")
  {
    $che_num              = $_POST['che_num']; 
    $ID_ban               = $_POST['ID_ban'];
    $che_importe          = $_POST['che_importe'];
    $che_librador         = $_POST['che_librador'];
    $che_tipo             = $_POST['che_tipo'];
    $che_fecha            = $_POST['che_fecha'];
    $che_beneficiario     = $_POST['che_beneficiario'];

    $insert_cheques=$cheques->insert_cheques($che_num, $ID_ban, $che_importe, $che_librador, $che_tipo, $che_fecha, $che_beneficiario);
    //REDIRECCIONA
                                echo '<script type="text/javascript">
                                window.location.assign("cheques.php?M=6");
                                </script>';
  }
?>