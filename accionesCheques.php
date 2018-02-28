<?php
session_start();
include_once('inc/conectar.php');
include_once('inc/classes.php');
include_once('inc/classesExclusivas.php');

$ID_usu                 = $_SESSION['ID_usu'];
$usu_usuario            = $_SESSION['usu_usuario'];
$usu_clave              = $_SESSION['usu_clave'];
$usu_tipo               = $_SESSION['usu_tipo'];
$cuentas                = new cuentas;
$cuentasE               = new cuentasE;
$fechaDeHoy             = date("Y-m-d");
$HoraDeHoy              = date("H:i:s");
$FechayHora             = date("Y-m-d H:i:s");
$action                 = $_POST['action'];
@$atras                 = $_SESSION['actionsBack'];
$cheques                = new cheques;
$chequesE               = new chequesE;
$cuentas_movimientosE   = new cuentas_movimientosE;
$cuentas_movimientos    = new cuentas_movimientos;
$cuentas_impuestosE     = new cuentas_impuestosE;
$cuentas_impuestos      = new cuentas_impuestos;
?>

<?php

  if($action=="borrarCheque")
  {
    
    $ID_che               = $_POST['ID_che'];
   
    $drop_chequesById=$cheques->drop_chequesById($ID_che);
    //REDIRECCIONA
                                echo '<script type="text/javascript">
                                window.location.assign("cheques.php?M=8");
                                </script>';
  }

    if($action=="borrarChequeDebitadoPorcheNumYDescontarCuenta")
  {
    
    $che_num               = $_POST['che_num'];
    $che_importe           = $_POST['che_importe'];
    $cue_desc              = $_POST['cuentaSeleccionada'];
    $tipoMovimeinto        =1;
                
               
    //A CONTINUACION COPIO LA ACCION NUEVOMOVIMIENTO DE ACCIONESCUENTASMOVIMIENTOS PORQUE NO ENCUENTRO FORMA DE ENLAZARLA

          $cue_desc               = $_POST['cuentaSeleccionada'];
          $get_cuentasByDesc      = $cuentasE->get_cuentasByDesc($cue_desc);
          $assoc_get_cuentasByDesc= mysql_fetch_assoc($get_cuentasByDesc);
          $ID_cue                 = $assoc_get_cuentasByDesc['ID_cue'];

          //BUSCA IMPUESTOS DE LA CUENTA PARA INSERTAR MOVIMIENTOS NUEVOS
    $get_cuentas_impuestosById=$cuentas_impuestosE->get_cuentas_impuestosById($ID_cue);
    $num_get_cuentas_impuestosById=mysql_num_rows($get_cuentas_impuestosById);
    for ($insertaImpuestos=0; $insertaImpuestos < $num_get_cuentas_impuestosById; $insertaImpuestos++) 
    { 
      $assoc_get_cuentas_impuestosById=mysql_fetch_assoc($get_cuentas_impuestosById);
      //PREPARA LAS VARIABLE PARA INSERTAR EL MOVIMIENTOS TANTO LAS DE CREDITO COMO LAS DE DEBITO
      $mcs_movimientoImpuesto=$assoc_get_cuentas_impuestosById['cti_desc'];
      $ID_cueImpuesto=$ID_cue;
      $mcd_fecImpuesto=$fechaDeHoy;
      $mcs_descImpuesto="DESCUENTO AUTOMATIZADO POR EL USUARIO";
       $mcs_creditoImpuesto=0;
        //PARA DETERMINAR SI SE LE APLICA AL MONTO UN PORCENTAJE O SE DEBE REGISTRAR UN MONTON FIJO SE EJECUTA EL SIGUIENTE CONDICIONAL
        if ($assoc_get_cuentas_impuestosById['cti_monto']==0) 
        {
          $montoTotalImpuestoA=($_POST['che_importe']*$assoc_get_cuentas_impuestosById['cti_porcentaje'])/100;
          $mcs_debitoImpuesto=$montoTotalImpuestoA;
        }
        else
        {
          $mcs_debitoImpuesto=$assoc_get_cuentas_impuestosById['cti_monto'];
        }  
        
      //PARA DEFINIR SI ES DEBITO O CREDITO EJECUTA LA SIGUIENTE FUNCION
      if ($tipoMovimeinto==1 AND $assoc_get_cuentas_impuestosById['cti_credOdeb']==1) 
      {
        //SE INSERTA EL MOVIMIENTO ASOCIADO A LA CUENTA
        $insert_cuentas_movimientosB   = $cuentas_movimientos->insert_cuentas_movimientos($mcs_movimientoImpuesto, $mcs_debitoImpuesto, $mcs_creditoImpuesto, $ID_cueImpuesto, $mcd_fecImpuesto, $mcs_descImpuesto);
      }
      if ($tipoMovimeinto==2 AND $assoc_get_cuentas_impuestosById['cti_credOdeb']==0) 
      {
        //SE INSERTA EL MOVIMIENTO ASOCIADO A LA CUENTA
        $insert_cuentas_movimientosB   = $cuentas_movimientos->insert_cuentas_movimientos($mcs_movimientoImpuesto, $mcs_debitoImpuesto, $mcs_creditoImpuesto, $ID_cueImpuesto, $mcd_fecImpuesto, $mcs_descImpuesto);
      }
    }

    if ($tipoMovimeinto==1) 
    {
      $mcs_credito=$che_importe;
      $mcs_debito=0;
    }
    else
    {
      $mcs_credito=0;
      $mcs_debito=$che_importe;
    } 

       $mcs_movimiento     = 'ELIMINACIÓN DE CHEQUE EMITIDO Y DEBITADO';
                $mcs_desc           = '';
                $mcd_fec            = $fechaDeHoy;
                $tipoMovimeinto     = 2;


    $insert_cuentas_movimientos   = $cuentas_movimientos->insert_cuentas_movimientos($mcs_movimiento, $mcs_debito, $mcs_credito, $ID_cue, $mcd_fec, $mcs_desc);

    
    $drop_chequesByche_num=$chequesE->drop_chequesByche_num($che_num);
                          
  }


  if($action=="borrarChequeCarteraPorcheNumYDescontarCuenta")
  {
    
    $che_num               = $_POST['che_num'];
    $che_importe           = $_POST['che_importe'];
    $cue_desc              = $_POST['cuentaSeleccionada'];
    $tipoMovimeinto        = 2;
    $ID_cue                = 1;
      
    $mcs_credito=0;
    $mcs_debito=$che_importe;
    
    $mcs_movimiento     = 'ELIMINACIÓN DE CHEQUE DE TERCERO CREADO EN CARTERA';
    $mcs_desc           = '';
    $mcd_fec            = $fechaDeHoy;
    $tipoMovimeinto     = 2;

    $insert_cuentas_movimientos   = $cuentas_movimientos->insert_cuentas_movimientos($mcs_movimiento, $mcs_debito, $mcs_credito, $ID_cue, $mcd_fec, $mcs_desc);

    
    $drop_chequesByche_num=$chequesE->drop_chequesByche_num($che_num);
                          
  }
  
  if($action=="nuevoCheque")
  {
    $che_num              = $_POST['che_num']; 
    $ID_ban               = $_POST['ID_ban'];
    $che_importe          = $_POST['che_importe'];
    $che_librador         = $_POST['che_librador'];
    $che_tipo             = $_POST['che_tipo'];
    $che_fecha            = $_POST['che_fecha'];
    $che_beneficiario     = $_POST['che_beneficiario'];
    $che_procedencia      = $_POST['che_procedencia'];
    
    if ($che_procedencia=="PROPIO") 
    {
      $che_estado         = $_POST['che_estado_propio'];

        if ($_POST['cuentaSeleccionada']) 
        {
          echo $cue_desc               = $_POST['cuentaSeleccionada'];
          $get_cuentasByDesc      = $cuentasE->get_cuentasByDesc($cue_desc);
          $assoc_get_cuentasByDesc= mysql_fetch_assoc($get_cuentasByDesc);
          $ID_cue                 = $assoc_get_cuentasByDesc['ID_cue'];
        }            
        else
        {
          $ID_cue                 = $_POST['ID_cue'];
        }  
      
    }
    else
    {
      $che_estado                 = $_POST['che_estado_tercero'];
      $ID_cue                     = 1;
    }  
    
    //TRAE DATOS DE CUENTA MEDIANTE EL ID DE CUENTA SI ESTE EXISTE
 
      $get_cuentasById        = $cuentas->get_cuentasById($ID_cue);
      $assoc_get_cuentasById  = mysql_fetch_assoc($get_cuentasById);

      $cue_desc         = $assoc_get_cuentasById['cue_desc'];
      $ID_ctp           = $assoc_get_cuentasById['ID_ctp'];
      $cue_direccion    = $assoc_get_cuentasById['cue_direccion'];
      $cue_sucursal     = $assoc_get_cuentasById['cue_sucursal'];
      $cue_cbu          = $assoc_get_cuentasById['cue_cbu'];
      $cue_cuit         = $assoc_get_cuentasById['cue_cuit'];
      $cue_num          = $assoc_get_cuentasById['cue_num'];
      $cue_moneda       = $assoc_get_cuentasById['cue_moneda'];

      //$traeSaldo        = $cuentas->traeSaldo($ID_cue);
      //$assoc_traeSaldo  = mysql_fetch_assoc($traeSaldo);
      //$saldoNegativo    = $assoc_traeSaldo['saldo']-$che_importe;
      //$saldoPositivo    = $assoc_traeSaldo['saldo']+$che_importe;

      $mcs_movimiento   = "CHEQUE ".$che_librador." ".$che_procedencia." ".$che_estado." ".$che_tipo." ".$che_fecha." ";
      $mcd_fec          = $fechaDeHoy;

      $mcs_desc         = "";
    
     
    //SI EL ESTADO ES DEBITADO RESTA EL MONTO A LA CUENTA DE ID_CUE
    if ($che_estado=="DEBITADO") 
    {
      
      $mcs_debito       = $che_importe;
      $mcs_credito      = 0;

      $insert_cuentas_movimientos=$cuentas_movimientos->insert_cuentas_movimientos($mcs_movimiento, $mcs_debito, $mcs_credito, $ID_cue, $mcd_fec, $mcs_desc);
    }

    //SI EL ESTADO ES EN CARTERA AGREGA EL MONTO A LA CUENTA CHEQUES EN CARTERA
    if ($che_estado=="EN CARTERA") 
    {
      $mcs_debito       = 0;
      $mcs_credito      = $che_importe;
      $ID_cue           = 1;
      $insert_cuentas_movimientos=$cuentas_movimientos->insert_cuentas_movimientos($mcs_movimiento, $mcs_debito, $mcs_credito, $ID_cue, $mcd_fec, $mcs_desc);
    }

    //SI EL ESTADO ES COBRADO RESTA EN LA CUENTA CHEQUES EN CARTERA Y SUMA EN LA CUENTA DE ID_CUE
    if ($che_estado=="COBRADO") 
    {
      //RESTA DE LA CUENTA CHEQUE EN CARTERA
      $mcs_debito       = $che_importe;
      $mcs_credito      = 0;
      $insert_cuentas_movimientos=$cuentas_movimientos->insert_cuentas_movimientos($mcs_movimiento, $mcs_debito, $mcs_credito, 1, $mcd_fec, $mcs_desc);

      //SUMA EN LA CUENTA DE ID_CUE
      $mcs_debitoB       = 0;
      $mcs_creditoB      = $che_importe;
      $insert_cuentas_movimientosB=$cuentas_movimientos->insert_cuentas_movimientos($mcs_movimiento, $mcs_debitoB, $mcs_creditoB, $ID_cue, $mcd_fec, $mcs_desc);
    }

    //SI EL ESTADO ES UTILIZADO RESTA EN LA CUENTA CHEQUES EN CARTERA
    if ($che_estado=="UTILIZADO") 
    {
      //RESTA DE LA CUENTA CHEQUE EN CARTERA
      $mcs_debito       = $che_importe;
      $mcs_credito      = 0;
      $insert_cuentas_movimientos=$cuentas_movimientos->insert_cuentas_movimientos($mcs_movimiento, $mcs_debito, $mcs_credito, 1, $mcd_fec, $mcs_desc);
    }

    //SI EL ESTADO ES EMITIDO, NO HACE NADA

    $insert_cheques=$cheques->insert_cheques($che_num, $ID_ban, $che_importe, $che_librador, $che_tipo, $che_fecha, $che_beneficiario, $ID_cue, $che_procedencia, $che_estado);
    
    if ($_POST['cuentaSeleccionada']) 
    {
      echo '<div class="alert alert-dismissible alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong><i class="material-icons">done_all</i> El cheque fue creado correctamente</strong>
            </div>';
    }      
    else
    {
                            //REDIRECCIONA
                                echo '<script type="text/javascript">
                                window.location.assign("cheques.php?M=6");
                                </script>';
    }  

                              
  }

  if($action=="modificarCheque")
  {
    $ID_che             =$_POST['ID_che'];
    $ID_ban             =$_POST['ID_ban'];
    $che_fecha          =$_POST['che_fecha'];
    $che_num            =$_POST['che_num'];
    $che_beneficiario   =$_POST['che_beneficiario'];
    $che_importe        =$_POST['che_importe'];
    $che_tipo           =$_POST['che_tipo'];
    $che_librador       =$_POST['che_librador'];
    $che_procedencia    =$_POST['che_procedencia'];
    $che_estado         =$_POST['che_estado'];
    $ID_cue             =$_POST['ID_cue'];


    //BUSCA EL CHEQUE A MODIFICAR PARA VER SI CAMBIO DE ESTADO 
    $get_chequesById=$cheques->get_chequesById($ID_che);
    $assoc_get_chequesById=mysql_fetch_assoc($get_chequesById);
    //realiza compraracion 
    if ($assoc_get_chequesById['che_estado']==$che_estado) 
    {
         
        //MODIFICA LA TABLA DE CHEQUES
        $update_chequesById=$cheques->update_chequesById($ID_che, $che_num, $ID_ban, $che_importe, $che_librador, $che_tipo, $che_fecha, $che_beneficiario, $ID_cue, $che_procedencia, $che_estado);
    }
    else
    {
    //TRAE DATOS DE CUENTA MEDIANTE EL ID DE CUENTA SI ESTE EXISTE
 
      $get_cuentasById        = $cuentas->get_cuentasById($ID_cue);
      $assoc_get_cuentasById  = mysql_fetch_assoc($get_cuentasById);

      $cue_desc         = $assoc_get_cuentasById['cue_desc'];
      $ID_ctp           = $assoc_get_cuentasById['ID_ctp'];
      $cue_direccion    = $assoc_get_cuentasById['cue_direccion'];
      $cue_sucursal     = $assoc_get_cuentasById['cue_sucursal'];
      $cue_cbu          = $assoc_get_cuentasById['cue_cbu'];
      $cue_cuit         = $assoc_get_cuentasById['cue_cuit'];
      $cue_num          = $assoc_get_cuentasById['cue_num'];
      $cue_moneda       = $assoc_get_cuentasById['cue_moneda'];

      //$traeSaldo        = $cuentas->traeSaldo($ID_cue);
      //$assoc_traeSaldo  = mysql_fetch_assoc($traeSaldo);
      //$saldoNegativo    = $assoc_traeSaldo['saldo']-$che_importe;
      //$saldoPositivo    = $assoc_traeSaldo['saldo']+$che_importe;

      $mcs_movimiento   = "CHEQUE ".$che_librador." ".$che_procedencia." ".$che_estado." ".$che_tipo." ".$che_fecha." ";
      $mcd_fec          = $fechaDeHoy;

      $mcs_desc         = "";
    
     
    //SI EL ESTADO ES DEBITADO RESTA EL MONTO A LA CUENTA DE ID_CUE
    if ($che_estado=="DEBITADO") 
    {
      
      $mcs_debito       = $che_importe;
      $mcs_credito      = 0;

      $insert_cuentas_movimientos=$cuentas_movimientos->insert_cuentas_movimientos($mcs_movimiento, $mcs_debito, $mcs_credito, $ID_cue, $mcd_fec, $mcs_desc);
    }

    //SI EL ESTADO ES EN CARTERA AGREGA EL MONTO A LA CUENTA CHEQUES EN CARTERA
    if ($che_estado=="EN CARTERA") 
    {
      $mcs_debito       = 0;
      $mcs_credito      = $che_importe;
      $ID_cue           = 1;
      $insert_cuentas_movimientos=$cuentas_movimientos->insert_cuentas_movimientos($mcs_movimiento, $mcs_debito, $mcs_credito, $ID_cue, $mcd_fec, $mcs_desc);
    }

    //SI EL ESTADO ES COBRADO RESTA EN LA CUENTA CHEQUES EN CARTERA Y SUMA EN LA CUENTA DE ID_CUE
    if ($che_estado=="COBRADO") 
    {
      //RESTA DE LA CUENTA CHEQUE EN CARTERA
      $mcs_debito       = $che_importe;
      $mcs_credito      = 0;
      $insert_cuentas_movimientos=$cuentas_movimientos->insert_cuentas_movimientos($mcs_movimiento, $mcs_debito, $mcs_credito, 1, $mcd_fec, $mcs_desc);

      //SUMA EN LA CUENTA DE ID_CUE
      $mcs_debitoB       = 0;
      $mcs_creditoB      = $che_importe;
      $insert_cuentas_movimientosB=$cuentas_movimientos->insert_cuentas_movimientos($mcs_movimiento, $mcs_debitoB, $mcs_creditoB, $ID_cue, $mcd_fec, $mcs_desc);
    }

    //SI EL ESTADO ES UTILIZADO RESTA EN LA CUENTA CHEQUES EN CARTERA
    if ($che_estado=="UTILIZADO") 
    {
      //RESTA DE LA CUENTA CHEQUE EN CARTERA
      $mcs_debito       = $che_importe;
      $mcs_credito      = 0;
      $insert_cuentas_movimientos=$cuentas_movimientos->insert_cuentas_movimientos($mcs_movimiento, $mcs_debito, $mcs_credito, 1, $mcd_fec, $mcs_desc);
    }

    //SI EL ESTADO ES EMITIDO, NO HACE NADA
    
    //MODIFICA LA TABLA DE CHEQUES
    $update_chequesById=$cheques->update_chequesById($ID_che, $che_num, $ID_ban, $che_importe, $che_librador, $che_tipo, $che_fecha, $che_beneficiario, $ID_cue, $che_procedencia, $che_estado);
      
    }  

        if ($_POST['metodoDePago']=='si') 
    {
      
    }      
    else
    {
                              //REDIRECCIONA
                                echo '<script type="text/javascript">
                                window.location.assign("cheques.php?M=10&ID_che='.$ID_che.'");
                               </script>';

    }  
    

  }
?>