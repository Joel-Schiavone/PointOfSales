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
@$action                = $_POST['action'];
@$atras                 = $_SESSION['actionsBack'];
$cuentas_movimientos    = new cuentas_movimientos;
$cuentas_movimientosE   = new cuentas_movimientosE;
$cuentasE               = new cuentasE;
$cuentas_impuestosE     = new cuentas_impuestosE;
$cuentas_impuestos      = new cuentas_impuestos;
?>
 <!-- Inicio: Estilos Generales-->
  <link href="css/generales.css" rel="stylesheet"> 
 <!-- Fin: Estilos Generales-->

<?php
  if($action=="nuevoMovimiento")
  {
    $ID_cue       = $_POST['ID_cue'];


    //BUSCA IMPUESTOS DE LA CUENTA PARA INSERTAR MOVIMIENTOS NUEVOS
    $get_cuentas_impuestosById=$cuentas_impuestosE->get_cuentas_impuestosById($ID_cue);
    $num_get_cuentas_impuestosById=mysql_num_rows($get_cuentas_impuestosById);
    for ($insertaImpuestos=0; $insertaImpuestos < $num_get_cuentas_impuestosById; $insertaImpuestos++) 
    { 
      $assoc_get_cuentas_impuestosById=mysql_fetch_assoc($get_cuentas_impuestosById);
      //PREPARA LAS VARIABLE PARA INSERTAR EL MOVIMIENTOS TANTO LAS DE CREDITO COMO LAS DE DEBITO
      $mcs_movimientoImpuesto=$assoc_get_cuentas_impuestosById['cti_desc'];
      $ID_cueImpuesto=$ID_cue;
      $mcd_fecImpuesto=$_POST['mcd_fec'];
      $mcs_descImpuesto="DESCUENTO AUTOMATIZADO POR EL USUARIO";
       $mcs_creditoImpuesto=0;
        //PARA DETERMINAR SI SE LE APLICA AL MONTO UN PORCENTAJE O SE DEBE REGISTRAR UN MONTON FIJO SE EJECUTA EL SIGUIENTE CONDICIONAL
        if ($assoc_get_cuentas_impuestosById['cti_monto']==0) 
        {
          $montoTotalImpuestoA=($_POST['monto']*$assoc_get_cuentas_impuestosById['cti_porcentaje'])/100;
          $mcs_debitoImpuesto=$montoTotalImpuestoA;
        }
        else
        {
          $mcs_debitoImpuesto=$assoc_get_cuentas_impuestosById['cti_monto'];
        }  
        
      //PARA DEFINIR SI ES DEBITO O CREDITO EJECUTA LA SIGUIENTE FUNCION
      if ($_POST['tipoMovimeinto']==1 AND $assoc_get_cuentas_impuestosById['cti_credOdeb']==1) 
      {
        //SE INSERTA EL MOVIMIENTO ASOCIADO A LA CUENTA
        $insert_cuentas_movimientosB   = $cuentas_movimientos->insert_cuentas_movimientos($mcs_movimientoImpuesto, $mcs_debitoImpuesto, $mcs_creditoImpuesto, $ID_cueImpuesto, $mcd_fecImpuesto, $mcs_descImpuesto);
      }
      if ($_POST['tipoMovimeinto']==2 AND $assoc_get_cuentas_impuestosById['cti_credOdeb']==0) 
      {
        //SE INSERTA EL MOVIMIENTO ASOCIADO A LA CUENTA
        $insert_cuentas_movimientosB   = $cuentas_movimientos->insert_cuentas_movimientos($mcs_movimientoImpuesto, $mcs_debitoImpuesto, $mcs_creditoImpuesto, $ID_cueImpuesto, $mcd_fecImpuesto, $mcs_descImpuesto);
      }
    }

    if ($_POST['tipoMovimeinto']==1) 
    {
      $mcs_credito=$_POST['monto'];
      $mcs_debito=0;
    }
    else
    {
      $mcs_credito=0;
      $mcs_debito=$_POST['monto'];
    } 

    $mcs_movimiento               = $_POST['mcs_movimiento'];
    $mcs_desc                     = $_POST['mcs_desc'];
    $mcd_fec                      = $_POST['mcd_fec'];
    
    $insert_cuentas_movimientos   = $cuentas_movimientos->insert_cuentas_movimientos($mcs_movimiento, $mcs_debito, $mcs_credito, $ID_cue, $mcd_fec, $mcs_desc);

    //REDIRECCIONA
        echo '<script type="text/javascript">
        window.location.assign("cuentas.php?M=6");
        </script>';

  }

  if($action=="editarMovimiento")
  {
    $ID_mcs  = $_POST['ID_mcs'];
    $ID_cue  = $_POST['ID_cue'];
    if ($_POST['tipoMovimeinto']==1) 
    {
      $mcs_credito=$_POST['monto'];
      $mcs_debito=0;
    }
    else
    {
      $mcs_credito=0;
      $mcs_debito=$_POST['monto'];
    } 

    $mcs_movimiento               = $_POST['mcs_movimiento'];
    $mcs_desc                     = $_POST['mcs_desc'];
    $mcd_fec                      = $_POST['mcd_fec'];
    
    $update_cuentas_movimientosById=$cuentas_movimientos->update_cuentas_movimientosById($ID_mcs, $mcs_movimiento, $mcs_debito, $mcs_credito, $ID_cue, $mcd_fec, $mcs_desc);

    //REDIRECCIONA
        echo '<script type="text/javascript">
        window.location.assign("cuentas.php?M=10");
        </script>';

  }

  if (@$_GET['action']=="dropMovimientos") 
  {
    $ID_mcs  = $_GET['ID_mcs'];

    $drop_cuentas_movimientosById=$cuentas_movimientos->drop_cuentas_movimientosById($ID_mcs);

    echo '<script type="text/javascript">
        window.location.assign("cuentas.php?M=8");
        </script>';  
  }

  if($action=="OperacionTransferencia")
  {
    $ID_cueEmisor         = $_POST['ID_cueEmisor'];

    //BUSCA DATOS DE LA CUENTA PARA EL DETALLE DEL MOVIMIENTO DE LA TRANSFERENCIA
    $get_cuentasByIdEmisor=$cuentasE->get_cuentasById($ID_cueEmisor);
    $assoc_get_cuentasByIdEmisor=mysql_fetch_assoc($get_cuentasByIdEmisor);
      
      //BUSCA IMPUESTOS DE LA CUENTA PARA INSERTAR MOVIMIENTOS NUEVOS
    $get_cuentas_impuestosById=$cuentas_impuestosE->get_cuentas_impuestosById($ID_cueEmisor);
    $num_get_cuentas_impuestosById=mysql_num_rows($get_cuentas_impuestosById);
    for ($insertaImpuestos=0; $insertaImpuestos < $num_get_cuentas_impuestosById; $insertaImpuestos++) 
    { 
      $assoc_get_cuentas_impuestosById=mysql_fetch_assoc($get_cuentas_impuestosById);
      //PREPARA LAS VARIABLE PARA INSERTAR EL MOVIMIENTOS TANTO LAS DE CREDITO COMO LAS DE DEBITO
      $mcs_movimientoImpuesto=$assoc_get_cuentas_impuestosById['cti_desc'];
      $ID_cueImpuesto=$ID_cueEmisor;
      $mcd_fecImpuesto=$FechayHora;
      $mcs_descImpuesto="DESCUENTO AUTOMATIZADO POR EL USUARIO";
       $mcs_creditoImpuesto=0;
       $mcs_descImpuesto="";
        //PARA DETERMINAR SI SE LE APLICA AL MONTO UN PORCENTAJE O SE DEBE REGISTRAR UN MONTON FIJO SE EJECUTA EL SIGUIENTE CONDICIONAL
        if ($assoc_get_cuentas_impuestosById['cti_monto']==0) 
        {
          $montoTotalImpuestoA=($_POST['monto']*$assoc_get_cuentas_impuestosById['cti_porcentaje'])/100;
          $mcs_debitoImpuesto=$montoTotalImpuestoA;
        }
        else
        {
          $mcs_debitoImpuesto=$assoc_get_cuentas_impuestosById['cti_monto'];
        }  
        
      if ($assoc_get_cuentas_impuestosById['cti_credOdeb']==0) 
      {
        //SE INSERTA EL MOVIMIENTO ASOCIADO A LA CUENTA
        $insert_cuentas_movimientosB   = $cuentas_movimientos->insert_cuentas_movimientos($mcs_movimientoImpuesto, $mcs_debitoImpuesto, $mcs_creditoImpuesto, $ID_cueImpuesto, $mcd_fecImpuesto, $mcs_descImpuesto);
      }
    }

    $mcs_creditoEmisor=$_POST['monto'];
    $mcs_debitoEmisor=0;
    
    $mcs_movimientoEmisor               = "TRANSFERENCIA DE CUENTA<br> 
                                      <ul>
                                      <li>CUENTA ORIGEN: ".$assoc_get_cuentasByIdEmisor['cue_desc']."</li>
                                      <li>TIPO DE CUENTA: ".$assoc_get_cuentasByIdEmisor['ctp_desc']."</li>
                                      <li>NUMERO DE CUENTA: ".$assoc_get_cuentasByIdEmisor['cue_num']."</li>
                                      <li>USUARIO: ".$_SESSION['usu_apellido']." ".$_SESSION['usu_nombre']."</li>
                                      </ul>
                                     ";
    $mcs_descEmisor                     = $_POST['observacion'];
    $mcd_fecEmisor                      = $FechayHora;
    
    $insert_cuentas_movimientosEmisor   = $cuentas_movimientos->insert_cuentas_movimientos($mcs_movimientoEmisor, $mcs_debitoEmisor, $mcs_creditoEmisor, $ID_cueEmisor, $mcd_fecEmisor, $mcs_descEmisor);

     $ID_cueReceptor         = $_POST['ID_cueReceptor'];

        //BUSCA IMPUESTOS DE LA CUENTA PARA INSERTAR MOVIMIENTOS NUEVOS
    $get_cuentas_impuestosByIdB=$cuentas_impuestosE->get_cuentas_impuestosById($ID_cueReceptor);
    $num_get_cuentas_impuestosByIdB=mysql_num_rows($get_cuentas_impuestosByIdB);
    for ($insertaImpuestosB=0; $insertaImpuestosB < $num_get_cuentas_impuestosByIdB; $insertaImpuestosB++) 
    { 
      $assoc_get_cuentas_impuestosByIdB=mysql_fetch_assoc($get_cuentas_impuestosByIdB);
      //PREPARA LAS VARIABLE PARA INSERTAR EL MOVIMIENTOS TANTO LAS DE CREDITO COMO LAS DE DEBITO
      $mcs_movimientoImpuestoB=$assoc_get_cuentas_impuestosByIdB['cti_desc'];
      $ID_cueImpuestoB=$ID_cueReceptor;
      $mcd_fecImpuestoB=$FechayHora;
      $mcs_descImpuestB="DESCUENTO AUTOMATIZADO POR EL USUARIO";
       $mcs_creditoImpuestoB=0;
       $mcs_descImpuestoB="";
        //PARA DETERMINAR SI SE LE APLICA AL MONTO UN PORCENTAJE O SE DEBE REGISTRAR UN MONTON FIJO SE EJECUTA EL SIGUIENTE CONDICIONAL
        if ($assoc_get_cuentas_impuestosByIdB['cti_monto']==0) 
        {
          $montoTotalImpuestoAB=($_POST['monto']*$assoc_get_cuentas_impuestosByIdB['cti_porcentaje'])/100;
          $mcs_debitoImpuestoB=$montoTotalImpuestoAB;
        }
        else
        {
          $mcs_debitoImpuestoB=$assoc_get_cuentas_impuestosByIdB['cti_monto'];
        }  
        
      //PARA DEFINIR SI ES DEBITO O CREDITO EJECUTA LA SIGUIENTE FUNCION
      if ($assoc_get_cuentas_impuestosByIdB['cti_credOdeb']==1) 
      {
        //SE INSERTA EL MOVIMIENTO ASOCIADO A LA CUENTA
        $insert_cuentas_movimientosBB   = $cuentas_movimientos->insert_cuentas_movimientos($mcs_movimientoImpuestoB, $mcs_debitoImpuestoB, $mcs_creditoImpuestoB, $ID_cueImpuestoB, $mcd_fecImpuestoB, $mcs_descImpuestoB);
      }
     
    }

    //BUSCA DATOS DE LA CUENTA PARA EL DETALLE DEL MOVIMIENTO DE LA TRANSFERENCIA
    $get_cuentasByIdReceptor=$cuentasE->get_cuentasById($ID_cueReceptor);
    $assoc_get_cuentasByIdReceptor=mysql_fetch_assoc($get_cuentasByIdReceptor);
      
    $mcs_creditoReceptor=0;
    $mcs_debitoReceptor=$_POST['monto'];
    
    $mcs_movimientoReceptor           = "TRANSFERENCIA DE CUENTA<br> 
                                      <ul>
                                      <li>CUENTA DESTINO: ".$assoc_get_cuentasByIdReceptor['cue_desc']."</li>
                                      <li>TIPO DE CUENTA: ".$assoc_get_cuentasByIdReceptor['ctp_desc']."</li>
                                      <li>NUMERO DE CUENTA: ".$assoc_get_cuentasByIdReceptor['cue_num']."</li>
                                      <li>USUARIO: ".$_SESSION['usu_apellido']." ".$_SESSION['usu_nombre']."</li>
                                      </ul>
                                     ";
    $mcs_descReceptor                     = $_POST['observacion'];
    $mcd_fecReceptor                      = $FechayHora;
    
    $insert_cuentas_movimientosReceptor   = $cuentas_movimientos->insert_cuentas_movimientos($mcs_movimientoReceptor, $mcs_debitoReceptor, $mcs_creditoReceptor, $ID_cueReceptor, $mcd_fecReceptor, $mcs_descReceptor);

    //REDIRECCIONA
        echo '<script type="text/javascript">
        window.location.assign("operacionesDeCuentas.php?M=17");
        </script>';

  }
?>