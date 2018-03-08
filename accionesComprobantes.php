<?php
session_start();
include_once('inc/conectar.php');
include_once('inc/classes.php');
include_once('inc/classesExclusivas.php');
$ID_usu                  = $_SESSION['ID_usu'];
$usu_usuario             = $_SESSION['usu_usuario'];
$usu_clave               = $_SESSION['usu_clave'];
$usu_tipo                = $_SESSION['usu_tipo'];
$fechaDeHoy              = date("Y-m-d");
$HoraDeHoy               = date("H:i:s");
$FechayHora              = date("Y-m-d H:i:s");
@$action                 = $_POST['action'];
@$atras                  = $_SESSION['actionsBack'];

$cabecera_comprobantes = new cabecera_comprobantes;
$cabecera_comprobantesE = new cabecera_comprobantesE;
$tipo_comprobantesE    = new tipo_comprobantesE;
$cuentas_movimientos   = new cuentas_movimientos;
$cuentasE              = new cuentasE;
$preciosE              = new preciosE;
$puntos_de_ventas      = new puntos_de_ventas;
$stockE                = new stockE;
$stock                 = new stock;
$articulos             = new articulos;
$sucursales            = new sucursales;
$detalle_comprobantes  = new detalle_comprobantes;
$puntos_de_ventasE     = new puntos_de_ventasE;
$comprobantesE         = new comprobantesE;
$comprobantes_datos    = new comprobantes_datos;
$comprobantes_datosE   = new comprobantes_datosE;
$detalle_comprobantesE = new detalle_comprobantesE;
$bancos                = new bancos;
$articulosE            = new articulosE;
$mensajes              = new mensajes;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////  C R E A C I O N  ///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



  if ($action=="cambiaPreciosInstantaneamente") 
  {
    $ID_pre     = $_POST['ID_pre'];
    $pre_neto   = $_POST['pre_neto'];
    $pre_porcan = $_POST['pre_porcan'];
    $pre_cant   = $_POST['pre_cant'];
    $pre_fec    = $fechaDeHoy;
    $pre_iva    = $_POST['pre_iva'];
    $ID_art     = $_POST['ID_art'];
    $costo      = $pre_neto;
            //ENVIA NOTIFICACION CON CARTEL PARA IMPRIMIR

             $get_articulosByartCod=$articulosE->get_articulosById($ID_art);
             $assoc_get_articulosByartCod=mysql_fetch_assoc($get_articulosByartCod);

            //INICIO: REVISA PRECIOS 

            if ($pre_cant==0 or $pre_cant=="")
            {
            }
            else
            {
              if ($assoc_get_articulosByartCod['pre_cant']!=$pre_cant) 
              { 
                //se inserta un mensaje nuevo para la impresion de un cartel de precio

                $men_asunto     ="Nuevo cartel de precio generado por el sistema pendiente de impresión";
                $men_desc       =$assoc_get_articulosByartCod['art_desc'];
                $men_categoria  =1;
                $men_visto      =0;
                $men_fec        =$FechayHora;
                $men_id_rel     =$assoc_get_articulosByartCod['ID_art'];
                $men_tabla_rel  ="articulos";

                $insert_mensajes = $mensajes->insert_mensajes($men_asunto, $men_desc, $men_categoria, $men_visto, $men_fec, $men_id_rel, $men_tabla_rel);

                //se modifica el precio cant de la tabla precios
              
                $update_preciosById=$preciosE->update_preciosById($ID_pre, $pre_cant, $pre_iva, $pre_neto, $pre_fec, $pre_porcan);

                            echo '<div class="alert alert-success alert-dismissable" style="margin-bottom:-2px;">
                                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                                      <i class="material-icons">thumb_up</i> Se modifico el precio de un articulo
                                    </div>';
              }

            }

            
  }  

  if($action=="nuevoComprobante")
  { 
    //Recibe numero de cai
    $cai=$_POST['cai'];
    //Recibe fecha de vencimiento de cai
    $vto=$_POST['vto'];
    //Recibe el total neto del comprobante (sin iva, sumatoria de precios de los articulos por la cantidad)
    $totalneto=$_POST['totalneto'];
    //Recibe el total gravado (suma de las diferencias de precio por el iva)
    $totalgrabado=$_POST['totalgrabado'];
    //Recibe el subtotal (sumatoria de precio de articulos mas iva por cantidad)
    $subtotal=$_POST['subtotal'];
    //Recibe monto de descuento del total
    $cte_retencion=$_POST['retenciones'];
    //Recibe valor total (resta entre subtotal y descuento gral que se denomina retenciones)
    $cte_monto=$_POST['total'];
    //Recibe el tipo de comprobante
    $ID_tce=$_POST['ID_tce'];
    //Recibe el comprobante asociado
    $cte_asociado=$_POST['ID_asociado'];
    //Recibe el ID de caja
    $ID_caja=$_POST['ID_caja'];
    //Recibe el condicionador monto y porcentaje del descuento general
    $descuentoGeneral=$_POST['descuentoGeneral'];
    //Recibe ID de cliente o proveedor dependiendo de su relacion con el flujo de compra o venta
    if ($_POST['ID_cli']) 
    {
        $cte_asociacion=$_POST['ID_cli'];
    }
    else
    {
        $cte_asociacion=$_POST['ID_pro'];
    }    
    //Recibe fecha del comprobante
     $cte_fec=$_POST['cte_fec'];

    //TRAE DATOS DEL TIPO DE COMPROBANTE PARA VERIFICAR SI MUEVE CAJA Y STOCK

        $get_tipo_comprobantesById=$tipo_comprobantesE->get_tipo_comprobantesById($ID_tce);
        $assoc_get_tipo_comprobantesById=mysql_fetch_assoc($get_tipo_comprobantesById);
        $fec_caja=$assoc_get_tipo_comprobantesById['fec_caja'];
        $fec_stock=$assoc_get_tipo_comprobantesById['fec_stock'];
        $tce_movcaja=$assoc_get_tipo_comprobantesById['tce_movcaja'];
        $tce_movstock=$assoc_get_tipo_comprobantesById['tce_movstock'];
        $tce_detalleArticulos=$assoc_get_tipo_comprobantesById['tce_detalleArticulos'];
        $tce_numeracionAutomatica=$assoc_get_tipo_comprobantesById['tce_numeracionAutomatica'];

        //si tiene numeracion automatica incrementa el numero de la misma para insertarlo 
         if ($tce_numeracionAutomatica==1) 
         {
             //Recibe el punto de venta
             $ID_pdv = $_POST['numeracionDeComprobante'];

             //Busca con el punto de venta la numeracion, lo hace en esta etapa para no repetir numeracion con otro usuario que pudiese estar utilizando el sistema en la misma accion   
             $get_puntos_de_ventasById=$puntos_de_ventas->get_puntos_de_ventasById($ID_pdv);   
             @$assoc_get_puntos_de_ventasById=mysql_fetch_assoc($get_puntos_de_ventasById);
             @$numeracionDeComprobante = $assoc_get_puntos_de_ventasById['pdv_puntoVenta'].($assoc_get_puntos_de_ventasById['pdv_numeracion']+1);

             $pdv_numeracion=$assoc_get_puntos_de_ventasById['pdv_numeracion']+1;
             $update_puntos_de_ventasById=$puntos_de_ventasE->update_puntos_de_ventasById($ID_pdv, $pdv_numeracion);
         }
         else
         {
            $numeracionDeComprobante = $_POST['numeracionManuelInput'];
            $ID_pdv = 0;
         } 

    //INSERT A LA CABECERA DEL COMPROBANTE cabecera_comprobante

    $insert_cabecera_comprobantes=$cabecera_comprobantes->insert_cabecera_comprobantes($ID_tce, $cte_asociado, $cte_monto, $cte_asociacion, $ID_caja, $numeracionDeComprobante, $totalneto, $cte_retencion, $cte_fec, $descuentoGeneral);


    //TRAE DETALLES DE LA CUENTA PARA ARMAR EL MENSAJE 
       // $get_cuentasById=$cuentasE->get_cuentasById($ID_caja);
       // $assoc_get_cuentasById=mysql_fetch_assoc($get_cuentasById);

    //SI MUEVE CAJA 

        /*if ($tce_movcaja==1) 
        {
            $mcs_movimiento=$assoc_get_tipo_comprobantesById['tce_desc']." - ".$numeracionDeComprobante;
            $ID_cue=$ID_caja;
            $mcd_fec=$FechayHora;
            $mcs_desc="";
            $mdc_fecDisponibilidad=$FechayHora;
             //SI SUMA EN CAJA INCREMENTA EL SALDO EN LA CUENTA
             if ($fec_caja==1) 
             {
                $mcs_credito=$cte_monto;
                $mcs_debito=0;
                $mesnaje_caja="acreditaron";
             }
             //SI RESTA EN CAJA DESCUENTA EL SALDO EN LA CUENTA 
             else
             {
                $mcs_credito=0;
                $mcs_debito=$cte_monto;
                $mesnaje_caja="debitaron";
             }

             $insert_cuentas_movimientos=$cuentas_movimientos->insert_cuentas_movimientos($mcs_movimiento, $mcs_debito, $mcs_credito, $ID_cue, $mcd_fec, $mcs_desc, $mdc_fecDisponibilidad);

             //AGREGA CONTENIDO A LA ALERTA
             $MensajeDeAlertaCuenta='<li style="font-size: 15px;">Se '.$mesnaje_caja.' $'.$cte_monto.' a la cuenta '.$assoc_get_cuentasById['ctp_desc'].'-'.$assoc_get_cuentasById['cue_desc'].' </li>';
             
        }*/

        //TRAE SUCURSAL, PARA ELLO TOMA EL ID DEL TIPO DE COMPROBANTE Y BUSCA TODOS LOS PUNTOS DE VENTAS QUE CONTENGAN ESE TIPO DE COMPROBANTE, LUEGO BUSCA TODOS LOS PUESTOS QUE CONTENGAN ESE PUNTO DE VENTA Y ESA CUENTA.

    $descuentoPorUnidad=json_decode($_POST['descuentoPorUnidad']);
    $countC = count($descuentoPorUnidad);
/*
    //Recibe el descuento de cada articulo
    $descuentoPorUnidad=json_decode($_POST['descuentoPorUnidad']);
    $countC = count($descuentoPorUnidad);
    for ($iii = 0; $iii <= $countC; $iii++) 
    {
       $descuentoPorUnidad[$iii];
    }

    //Recibe la condicion monto o porcentaje de cada articulo 
    $metricaDescuento=json_decode($_POST['metricaDescuento']);
    $countD = count($metricaDescuento);
    for ($iiii = 0; $iiii <= $countD; $iiii++) 
    {
      $metricaDescuento[$iiii];
    }
*/
                                        $get_comprobantes_ultimo=$comprobantesE->get_comprobantes_ultimo();
                                      $assoc_get_comprobantes_ultimo=mysql_fetch_assoc($get_comprobantes_ultimo);
                                      $ID_cte=$assoc_get_comprobantes_ultimo['ID_cte'];


    if ($tce_movstock==1) 
                {
                    $MensajeDeAlertaStock="";
                     for ($istock=0; $istock <$countC; $istock++) 
                        { 
                           //SI MUEVE STOCK 
                   
                            $sto_mov='3';
                            //Recibe el ID de cada articulo
                            $ID_art=json_decode($_POST['ID_art']);
                           @$ID_art=$ID_art[$istock];
                            
                            $get_articulosById=$articulos->get_articulosById($ID_art);
                            @$assoc_get_articulosById=mysql_fetch_assoc($get_articulosById);


                            @$sto_fec=$FechayHora;
                              //Recibe El id de sucursal que se le coloco a cada articulo
                            $ID_suc=json_decode($_POST['ID_suc']);
                            @$ID_suc=$ID_suc[$istock];
                            
                            $get_sucursalesById=$sucursales->get_sucursalesById($ID_suc);
                            @$assoc_get_sucursalesById=mysql_fetch_assoc($get_sucursalesById);

                            //Recibe la cantidad de cada articulo
                            $arrayName=json_decode($_POST['array']);
                            @$sto_cant=$arrayName[$istock];
                              
                            $get_stockByIdArtUltimo=$stockE->get_stockByIdArtUltimo($ID_art, $ID_suc);
                            @$assoc_get_stockByIdArtUltimo=mysql_fetch_assoc($get_stockByIdArtUltimo);
                            

                            //SI SUMA STOCK INCREMENTA EN LA TABLA STOCK 
                             if ($fec_stock==1) 
                             {
                                $sto_desc='Se agregaron '.$sto_cant.' '.$assoc_get_articulosById['art_desc'].' al stock de la sucursal '.$assoc_get_sucursalesById['suc_desc'];
                                $sto_total=$assoc_get_stockByIdArtUltimo['sto_total']+$sto_cant;

                             }
                            //SI RESTA STOCK DESCUENTO EL ARTICULO DEL STOCK
                            else
                             {

                                $sto_desc='Se descontó '.$sto_cant.' '.$assoc_get_articulosById['art_desc'].' al stock de la sucursal '.$assoc_get_sucursalesById['suc_desc'];
                                 $sto_total=$assoc_get_stockByIdArtUltimo['sto_total']-$sto_cant;
                             }

                             $insert_stock=$stock->insert_stock($sto_mov, $ID_art, $sto_desc, $sto_fec, $ID_suc, $ID_usu, $sto_cant, $sto_total);

                             //AGREGA CONTENIDO A LA ALERTA
                             $MensajeDeAlertaStock= '<li style="font-size: 15px;">'.$sto_desc.'</li>'.$MensajeDeAlertaStock;

                             //SI EL TIPO DE COMPROBANTE TIENE DETALLE 

                              if ($tce_detalleArticulos) 
                              {
                                      //INSERT A DETALLES DE COMPROBANTES detalle_comprobantes

                                      $metricaDescuento=json_decode($_POST['metricaDescuento']);
                                      $descuentoPorUnidad=json_decode($_POST['descuentoPorUnidad']);

                                      $get_preciosYarticulosByID_art=$preciosE->get_preciosYarticulosByID_art($ID_art);
                                      @$assoc_get_preciosYarticulosByID_art=mysql_fetch_assoc($get_preciosYarticulosByID_art);
                                      $pre_cant       = $assoc_get_preciosYarticulosByID_art['pre_cant'];
                                      $pre_iva        = $assoc_get_preciosYarticulosByID_art['pre_iva'];

                                      $dte_cantidad   = $sto_cant;
                                      $dte_monto      = $pre_cant*$sto_cant; 
                                      $dte_iva        = $pre_iva;
                                      $dte_metrica    = $metricaDescuento[$istock];
                                      $dte_descuento  = $descuentoPorUnidad[$istock];

                                     
                                      $insert_detalle_comprobantes=$detalle_comprobantes->insert_detalle_comprobantes($ID_cte, $ID_art, $dte_cantidad, $dte_monto, $dte_iva, $dte_metrica, $dte_descuento, $ID_suc);
                                      
                              }

                        }

                    


            }
               // TRAE CABECERA INSERTADA PARA INSERTAR DATOS DEL COMPROBANTES, TABLA QUE REGISTRA SI ES COPIA O ORIGINAL, USUARIO, FECHA Y PDV
              
                 

                      //INSERTA EN LA TABLA DATOS DE COMPROBANTES ORIGINAL
                        //$ID_cte       = $ID_cte;
                        //$ID_usu       = $ID_usu;
                        $cpd_fecha      = $FechayHora;
                        //$ID_pdv         = $ID_pdv;
                        $cpd_original   = 0;
                        $cpd_copia      = 0;
                        $insert_comprobantes_datos=$comprobantes_datos->insert_comprobantes_datos($ID_cte, $ID_usu, $cpd_fecha, $ID_pdv, $cpd_original, $cpd_copia);
                        $CREADOMODIFICADO="CREADO";
                         
                    
        if ($tce_movcaja==1) 
        {
            $monto=$cte_monto;
            if ($fec_caja==1) 
            {
            //$cte_monto=$cte_monto;  
            $ID_fce = 2;
            }
             else
            {
             $ID_fce = 1;
            }
                  //REDIRECCIONA
                                echo '<script type="text/javascript">
                                window.location.assign("metodoDePago.php?ID_fce='.$ID_fce.'&monto='.$monto.'");
                               </script>';

         }             

                 echo '<div class="container-fluid" id="contenedorDeAlerta">';
                             echo '<div class="alert alert-success">';
                              echo "<h4><i class='material-icons'>thumb_up</i> COMPROBANTE ".$assoc_get_tipo_comprobantesById['tce_desc']." - ".$numeracionDeComprobante." ".$CREADOMODIFICADO." CORRECTAMENTE </h4><hr>";
                                echo "<ul>".@$MensajeDeAlertaCuenta.@$MensajeDeAlertaStock."</ul>";
                                    

                                    $get_cuentasById=$cuentasE->get_cuentasById($ID_caja);
                                    $assoc_get_cuentasById=mysql_fetch_assoc($get_cuentasById);
                                    if($assoc_get_cuentasById['ID_ctp']==4)
                                    {
                                       echo "<hr><ul><a href='cheques.php'><button class='btn btn-success'>CARGAR CHEQUES</button></a></ul><br>";

                                       echo "<ul><a href='comprobantes.php'><button class='btn btn-success'>CONTINUAR CARGANDO COMPROBANTES</button></a></ul>";
                                    }    

                              echo '</div>';
                             echo '</div>';


            
          }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////  M O D I F I C A C I O N  ///////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


  if($action=="modificacionComprobante")
  { 
    //Recibe ID_cte
    $ID_cte_Original=$_POST['ID_cte_Original'];

    //Traer DATOS DE CABECERA del comprobante anterior
    $get_cabecera_comprobantesById          =   $cabecera_comprobantes->get_cabecera_comprobantesById($ID_cte_Original);
    $assoc_get_cabecera_comprobantesById    =   mysql_fetch_assoc($get_cabecera_comprobantesById);
    $cte_numero_anterior                    =   $assoc_get_cabecera_comprobantesById['cte_numero'];
    $ID_tce_anterior                        =   $assoc_get_cabecera_comprobantesById['ID_tce'];
    $ID_caj_anterior                        =   $assoc_get_cabecera_comprobantesById['ID_caj'];
    $cte_monto_anterior                     =   $assoc_get_cabecera_comprobantesById['cte_monto'];

    //Trae DATOS DEL COMPROBANTE anterior
    $get_comprobantes_datosOriginalB        =   $comprobantes_datosE->get_comprobantes_datosOriginal($ID_cte_Original);
    $assoc_get_comprobantes_datosOriginalB  =   mysql_fetch_assoc($get_comprobantes_datosOriginalB);
    $ID_pdv_anterior                        =   $assoc_get_comprobantes_datosOriginalB['ID_pdv'];

    //Trae TIPO DE COMPROBANTE anterior
    $get_tipo_comprobantesByIdB             =   $tipo_comprobantesE->get_tipo_comprobantesById($ID_tce_anterior);
    $assoc_get_tipo_comprobantesByIdB       =   mysql_fetch_assoc($get_tipo_comprobantesByIdB);
    $tce_numeracionAutomatica_anterior      =   $assoc_get_tipo_comprobantesByIdB['tce_numeracionAutomatica'];
    $tce_movstock_anterior                  =   $assoc_get_tipo_comprobantesByIdB['tce_movstock'];
    $fec_stock_anterior                     =   $assoc_get_tipo_comprobantesByIdB['fec_stock'];
    $tce_detalleArticulos_anterior          =   $assoc_get_tipo_comprobantesByIdB['tce_detalleArticulos'];
    $tce_movcaja_anterior                   =   $assoc_get_tipo_comprobantesByIdB['tce_movcaja'];
    $tce_desc_anterior                      =   $assoc_get_tipo_comprobantesByIdB['tce_desc'];
    $fec_caja_anterior                      =   $assoc_get_tipo_comprobantesByIdB['fec_caja'];

    if ($tce_numeracionAutomatica_anterior==1) 
    {
           //Trae PUNTO DE VENTA anterior
            $get_puntos_de_ventasById       =   $puntos_de_ventas->get_puntos_de_ventasById($ID_pdv_anterior);
            $assoc_get_puntos_de_ventasById =   mysql_fetch_assoc($get_puntos_de_ventasById);
            $pdv_puntoVenta_anterior        =   $assoc_get_puntos_de_ventasById['pdv_puntoVenta'];
            $pdv_numeracion_anterior        =   $assoc_get_puntos_de_ventasById['pdv_numeracion'];
    }       


      //Si movia caja el comprbante anterior
       if ($tce_movcaja_anterior==1) 
        {
           
            $ID_cue_anterior                =   $ID_caj_anterior;
            $mcd_fec_anterior               =   $FechayHora;
            $mcs_desc_anterior              =    "";
            $mdc_fecDisponibilidad          =   $FechayHora;
             //Si incremento el saldo en la cuenta entonces ahora lo descuenta
             if ($fec_caja_anterior==1) 
             {
                $mcs_debito_anterior=$cte_monto_anterior;
                $mcs_credito_anterior=0;
                $mesnaje_caja_anterior="se debitó por modificación";
             }
             //Si desconto saldo en la cuenta entonces ahora lo suma
             else
             {
                $mcs_debito_anterior=0;
                $mcs_credito_anterior=$cte_monto_anterior;
                $mesnaje_caja_anterior="se acreditó por modificación";
             }

              $mcs_movimiento_anterior        =   $tce_desc_anterior." - ".$cte_numero_anterior." - ".$mesnaje_caja_anterior;

             $insert_cuentas_movimientos_anterior=$cuentas_movimientos->insert_cuentas_movimientos($mcs_movimiento_anterior, $mcs_debito_anterior, $mcs_credito_anterior, $ID_cue_anterior, $mcd_fec_anterior, $mcs_desc_anterior, $mdc_fecDisponibilidad);

        }



    //Si tenia detalle de articulos
    if ($tce_detalleArticulos_anterior) 
    {
        //busca articulo por articulo y vuelve atras el proceso, si incremento stock ahora lo descuenta y viceversa
        $get_detalle_comprobantesByIdB           =   $detalle_comprobantesE->get_detalle_comprobantesById($ID_cte_Original);
        $num_get_detalle_comprobantesByIdB       =   mysql_num_rows($get_detalle_comprobantesByIdB);

        for ($countdetalleanterior=0; $countdetalleanterior < $num_get_detalle_comprobantesByIdB; $countdetalleanterior++) 
        { 
            $assoc_get_detalle_comprobantesByIdB = mysql_fetch_assoc($get_detalle_comprobantesByIdB);
            $ID_artB                    = $assoc_get_detalle_comprobantesByIdB['ID_art'];
            $ID_sucB                    = $assoc_get_detalle_comprobantesByIdB['ID_suc'];
            $sto_cantB                  = $assoc_get_detalle_comprobantesByIdB['dte_cantidad'];  

            //Trae sucursal del articulo
            $get_sucursalesByIdB        = $sucursales->get_sucursalesById($ID_sucB);
            @$assoc_get_sucursalesByIdB = mysql_fetch_assoc($get_sucursalesByIdB);

            //Trae descripcion del articulo
             $get_articulosByIdB        = $articulos->get_articulosById($ID_artB);
             @$assoc_get_articulosByIdB = mysql_fetch_assoc($get_articulosByIdB);
             $art_descB                 = $assoc_get_articulosByIdB['art_desc'];

            //si muevio stock vuelve el proceso atras 
             if ($tce_movstock_anterior==1) 
             {
                $sto_fecB   = $FechayHora;

                            //trae ultimo valor de stock para calcular cuanto queda el total
                            $get_stockByIdArtUltimoB=$stockE->get_stockByIdArtUltimo($ID_artB, $ID_sucB);
                            @$assoc_get_stockByIdArtUltimoB=mysql_fetch_assoc($get_stockByIdArtUltimoB);


                
                                //Si sumo stock entonces resta lo que antes sumo 
                                 if ($fec_stock_anterior==1) 
                                 {
                                    $sto_movB=2;
                                    $sto_descB='Se descontó '.$sto_cantB.' '.$art_descB.' al stock de la sucursal '.$assoc_get_sucursalesByIdB['suc_desc'].' por la modificación del comprobante '.$cte_numero_anterior;
                                    $sto_totalB=$assoc_get_stockByIdArtUltimoB['sto_total']+$sto_cantB;

                                 }
                                //Si Resto stock, entonces suma la que antes resto
                                else
                                 {
                                    $sto_movB=1;
                                    $sto_descB='Se Agrego '.$sto_cantB.' '.$art_descB.' al stock de la sucursal '.$assoc_get_sucursalesByIdB['suc_desc'].' por la modificación del comprobante '.$cte_numero_anterior;
                                     $sto_totalB=$assoc_get_stockByIdArtUltimoB['sto_total']-$sto_cantB;
                                 }

                                  $insert_stockB=$stock->insert_stock($sto_movB, $ID_artB, $sto_descB, $sto_fecB, $ID_sucB, $ID_usu, $sto_cantB, $sto_totalB);
            }
        }  
    }

  
    
 

    //Recibe numero de cai
    $cai=$_POST['cai'];
    //Recibe fecha de vencimiento de cai
    $vto=$_POST['vto'];
    //Recibe el total neto del comprobante (sin iva, sumatoria de precios de los articulos por la cantidad)
    $totalneto=$_POST['totalneto'];
    //Recibe el total gravado (suma de las diferencias de precio por el iva)
    $totalgrabado=$_POST['totalgrabado'];
    //Recibe el subtotal (sumatoria de precio de articulos mas iva por cantidad)
    $subtotal=$_POST['subtotal'];
    //Recibe monto de descuento del total
    $cte_retencion=$_POST['retenciones'];
    //Recibe valor total (resta entre subtotal y descuento gral que se denomina retenciones)
    $cte_monto=$_POST['total'];
    //Recibe el tipo de comprobante
    $ID_tce=$_POST['ID_tce'];
    //Recibe el comprobante asociado
    $cte_asociado=$_POST['ID_asociado'];
    //Recibe el ID de caja
    $ID_caja=$_POST['ID_caja'];
    //Recibe el condicionador monto y porcentaje del descuento general
    $descuentoGeneral=$_POST['descuentoGeneral'];
    //Recibe ID de cliente o proveedor dependiendo de su relacion con el flujo de compra o venta
    if ($_POST['ID_cli']) 
    {
        $cte_asociacion=$_POST['ID_cli'];
    }
    else
    {
        $cte_asociacion=$_POST['ID_pro'];
    }    
    //Recibe fecha del comprobante
     $cte_fec=$_POST['cte_fec'];

    //TRAE DATOS DEL TIPO DE COMPROBANTE PARA VERIFICAR SI MUEVE CAJA Y STOCK

        $get_tipo_comprobantesById=$tipo_comprobantesE->get_tipo_comprobantesById($ID_tce);
        $assoc_get_tipo_comprobantesById=mysql_fetch_assoc($get_tipo_comprobantesById);
        $fec_caja=$assoc_get_tipo_comprobantesById['fec_caja'];
        $fec_stock=$assoc_get_tipo_comprobantesById['fec_stock'];
        $tce_movcaja=$assoc_get_tipo_comprobantesById['tce_movcaja'];
        $tce_movstock=$assoc_get_tipo_comprobantesById['tce_movstock'];
        $tce_detalleArticulos=$assoc_get_tipo_comprobantesById['tce_detalleArticulos'];
        $tce_numeracionAutomatica=$assoc_get_tipo_comprobantesById['tce_numeracionAutomatica'];

        //si tiene numeracion automatica incrementa el numero de la misma para insertarlo 
         if ($tce_numeracionAutomatica==1) 
         {
            //Recibe el punto de venta
            $ID_pdv = $_POST['numeracionDeComprobante'];

            //Si el punto del venta es el mismo que el anterior no incrementa el valor de la numeracion sino que lo mantiene porque se entiende que es una modificacion y no un presupuesto nuvo
            if ($ID_pdv==$ID_pdv_anterior) 
            {
               $numeracionDeComprobante=$cte_numero_anterior;
            }
            //En caso de que el punto de venta haya cambiando el sistema entendera que debe incrementar la ultima numeracion del codigo de punto de venta
            else
            {
                 //Busca con el punto de venta la numeracion, lo hace en esta etapa para no repetir numeracion con otro usuario que pudiese estar utilizando el sistema en la misma accion   
                 $get_puntos_de_ventasById=$puntos_de_ventas->get_puntos_de_ventasById($ID_pdv);   
                 @$assoc_get_puntos_de_ventasById=mysql_fetch_assoc($get_puntos_de_ventasById);
                 @$numeracionDeComprobante = $assoc_get_puntos_de_ventasById['pdv_puntoVenta'].($assoc_get_puntos_de_ventasById['pdv_numeracion']+1);
                 $pdv_numeracion=$assoc_get_puntos_de_ventasById['pdv_numeracion']+1;
                 $update_puntos_de_ventasById=$puntos_de_ventasE->update_puntos_de_ventasById($ID_pdv, $pdv_numeracion);
            }    

          

         }
         else
         {
            $numeracionDeComprobante = $_POST['numeracionManuelInput'];
            $ID_pdv = 0;
         } 

    //INSERT A LA CABECERA DEL COMPROBANTE cabecera_comprobante

    $insert_cabecera_comprobantes=$cabecera_comprobantes->insert_cabecera_comprobantes($ID_tce, $cte_asociado, $cte_monto, $cte_asociacion, $ID_caja, $numeracionDeComprobante, $totalneto, $cte_retencion, $cte_fec, $descuentoGeneral);


    //TRAE DETALLES DE LA CUENTA PARA ARMAR EL MENSAJE 
        $get_cuentasById=$cuentasE->get_cuentasById($ID_caja);
        $assoc_get_cuentasById=mysql_fetch_assoc($get_cuentasById);

    //SI MUEVE CAJA 

        if ($tce_movcaja==1) 
        {
            $mcs_movimiento=$assoc_get_tipo_comprobantesById['tce_desc']." - ".$numeracionDeComprobante;
            $ID_cue=$ID_caja;
            $mcd_fec=$FechayHora;
            $mcs_desc="";
            $mdc_fecDisponibilidad=$FechayHora;
             //SI SUMA EN CAJA INCREMENTA EL SALDO EN LA CUENTA
             if ($fec_caja==1) 
             {
                $mcs_credito=$cte_monto;
                $mcs_debito=0;
                $mesnaje_caja="acreditaron";
             }
             //SI RESTA EN CAJA DESCUENTA EL SALDO EN LA CUENTA 
             else
             {
                $mcs_credito=0;
                $mcs_debito=$cte_monto;
                $mesnaje_caja="debitaron";
             }

             $insert_cuentas_movimientos=$cuentas_movimientos->insert_cuentas_movimientos($mcs_movimiento, $mcs_debito, $mcs_credito, $ID_cue, $mcd_fec, $mcs_desc,$mdc_fecDisponibilidad);

             //AGREGA CONTENIDO A LA ALERTA
             $MensajeDeAlertaCuenta='<li style="font-size: 15px;">Se '.$mesnaje_caja.' $'.$cte_monto.' a la cuenta '.$assoc_get_cuentasById['ctp_desc'].'-'.$assoc_get_cuentasById['cue_desc'].' </li>';
             
        }

        //TRAE SUCURSAL, PARA ELLO TOMA EL ID DEL TIPO DE COMPROBANTE Y BUSCA TODOS LOS PUNTOS DE VENTAS QUE CONTENGAN ESE TIPO DE COMPROBANTE, LUEGO BUSCA TODOS LOS PUESTOS QUE CONTENGAN ESE PUNTO DE VENTA Y ESA CUENTA.


    
  
     
        
    $descuentoPorUnidad=json_decode($_POST['descuentoPorUnidad']);
    $countC = count($descuentoPorUnidad);
/*
    //Recibe el descuento de cada articulo
    $descuentoPorUnidad=json_decode($_POST['descuentoPorUnidad']);
    $countC = count($descuentoPorUnidad);
    for ($iii = 0; $iii <= $countC; $iii++) 
    {
       $descuentoPorUnidad[$iii];
    }

    //Recibe la condicion monto o porcentaje de cada articulo 
    $metricaDescuento=json_decode($_POST['metricaDescuento']);
    $countD = count($metricaDescuento);
    for ($iiii = 0; $iiii <= $countD; $iiii++) 
    {
      $metricaDescuento[$iiii];
    }
*/


   $get_comprobantes_ultimo=$comprobantesE->get_comprobantes_ultimo();
                                      $assoc_get_comprobantes_ultimo=mysql_fetch_assoc($get_comprobantes_ultimo);
                                      $ID_cte=$assoc_get_comprobantes_ultimo['ID_cte'];


    if ($tce_movstock==1) 
                {
                    $MensajeDeAlertaStock="";
                     for ($istock=0; $istock <$countC; $istock++) 
                        { 
                           //SI MUEVE STOCK 
                   
                            $sto_mov='3';
                            //Recibe el ID de cada articulo
                            $ID_art=json_decode($_POST['ID_art']);
                           @$ID_art=$ID_art[$istock];
                            
                            $get_articulosById=$articulos->get_articulosById($ID_art);
                            @$assoc_get_articulosById=mysql_fetch_assoc($get_articulosById);


                            @$sto_fec=$FechayHora;
                              //Recibe El id de sucursal que se le coloco a cada articulo
                            $ID_suc=json_decode($_POST['ID_suc']);
                            @$ID_suc=$ID_suc[$istock];
                            
                            $get_sucursalesById=$sucursales->get_sucursalesById($ID_suc);
                            @$assoc_get_sucursalesById=mysql_fetch_assoc($get_sucursalesById);

                            //Recibe la cantidad de cada articulo
                            $arrayName=json_decode($_POST['array']);
                            @$sto_cant=$arrayName[$istock];
                              
                            $get_stockByIdArtUltimo=$stockE->get_stockByIdArtUltimo($ID_art, $ID_suc);
                            @$assoc_get_stockByIdArtUltimo=mysql_fetch_assoc($get_stockByIdArtUltimo);
                            

                            //SI SUMA STOCK INCREMENTA EN LA TABLA STOCK 
                             if ($fec_stock==1) 
                             {
                                $sto_desc='Se agregaron '.$sto_cant.' '.$assoc_get_articulosById['art_desc'].' al stock de la sucursal '.$assoc_get_sucursalesById['suc_desc'];
                                $sto_total=$assoc_get_stockByIdArtUltimo['sto_total']+$sto_cant;

                             }
                            //SI RESTA STOCK DESCUENTO EL ARTICULO DEL STOCK
                            else
                             {

                                $sto_desc='Se descontó '.$sto_cant.' '.$assoc_get_articulosById['art_desc'].' al stock de la sucursal '.$assoc_get_sucursalesById['suc_desc'];
                                 $sto_total=$assoc_get_stockByIdArtUltimo['sto_total']-$sto_cant;
                             }

                             $insert_stock=$stock->insert_stock($sto_mov, $ID_art, $sto_desc, $sto_fec, $ID_suc, $ID_usu, $sto_cant, $sto_total);

                             //AGREGA CONTENIDO A LA ALERTA
                             $MensajeDeAlertaStock= '<li style="font-size: 15px;">'.$sto_desc.'</li>'.$MensajeDeAlertaStock;

                             //SI EL TIPO DE COMPROBANTE TIENE DETALLE 

                              if ($tce_detalleArticulos) 
                              {
                                      //INSERT A DETALLES DE COMPROBANTES detalle_comprobantes

                                      $metricaDescuento=json_decode($_POST['metricaDescuento']);
                                      $descuentoPorUnidad=json_decode($_POST['descuentoPorUnidad']);

                                      $get_preciosYarticulosByID_art=$preciosE->get_preciosYarticulosByID_art($ID_art);
                                      @$assoc_get_preciosYarticulosByID_art=mysql_fetch_assoc($get_preciosYarticulosByID_art);
                                      $pre_cant       = $assoc_get_preciosYarticulosByID_art['pre_cant'];
                                      $pre_iva        = $assoc_get_preciosYarticulosByID_art['pre_iva'];

                                      $dte_cantidad   = $sto_cant;
                                      $dte_monto      = $pre_cant*$sto_cant; 
                                      $dte_iva        = $pre_iva;
                                      $dte_metrica    = $metricaDescuento[$istock];
                                      $dte_descuento  = $descuentoPorUnidad[$istock];

                                      
                                      $insert_detalle_comprobantes=$detalle_comprobantes->insert_detalle_comprobantes($ID_cte, $ID_art, $dte_cantidad, $dte_monto, $dte_iva, $dte_metrica, $dte_descuento, $ID_suc);
                                      
                              }

                        }

                    


            }
               // TRAE CABECERA INSERTADA PARA INSERTAR DATOS DEL COMPROBANTES, TABLA QUE REGISTRA SI ES COPIA O ORIGINAL, USUARIO, FECHA Y PDV
              
               

                    //BUSCA EL ID DE DATOS DE COMPROBANTES (ID_cpd) DE LA FILA QUE CONTENGA EL ID_CTE RECIBIDO
                               $sql_traeID_cte                = 'SELECT ID_cpd, cpd_original FROM comprobantes_datos WHERE ID_cte='.$ID_cte_Original.'';
                               $result_sql_traeID_cte         = mysql_query($sql_traeID_cte);
                               $assoc_result_sql_traeID_cte   = mysql_fetch_assoc($result_sql_traeID_cte);
                               $ID_cpd                        = $assoc_result_sql_traeID_cte['ID_cpd'];
                               $cpd_original                  = $assoc_result_sql_traeID_cte['cpd_original'];
                               //VERIFICA SI TIENE CERO EN EL CPD_ORIGINAL

                                $cpd_fecha                    = $FechayHora;

                                //SI TIENE CERO EN EL CPD ORGINAL PROCEDE A EJECUTAR LA FUNCION PARA TRAER EL MAYOR DE LAS MODIFICACIONES
                                  if ($cpd_original==0) 
                                  {
                                     $sql_comprobantes_datos      = 'SELECT cpd_copia, ID_cpd, cpd_original FROM comprobantes_datos WHERE cpd_original='.$ID_cpd.' order by cpd_copia DESC limit 0,1'; 
                                    $result_comprobantes_datos    = mysql_query($sql_comprobantes_datos);
                                    $num_result_comprobantes_datos = mysql_num_rows($result_comprobantes_datos);
                                    $assoc_result_comprobantes_datos = mysql_fetch_assoc($result_comprobantes_datos);

                                    if ($num_result_comprobantes_datos>=1) 
                                    {
                                      $cpd_original_nuevo = $ID_cpd;
                                      $cpd_copia          = $assoc_result_comprobantes_datos['cpd_copia']+1;
                                    }
                                    else
                                    {
                                      $cpd_original_nuevo = $ID_cpd;
                                      $cpd_copia    = 1;
                                    }  
                                  }
                                  else
                                  {
                                    $sql_comprobantes_datos      = 'SELECT cpd_copia, ID_cpd, cpd_original FROM comprobantes_datos WHERE cpd_original='.$cpd_original.' order by cpd_copia DESC limit 0,1'; 
                                    $result_comprobantes_datos    = mysql_query($sql_comprobantes_datos);
                                    $num_result_comprobantes_datos = mysql_num_rows($result_comprobantes_datos);
                                    $assoc_result_comprobantes_datos = mysql_fetch_assoc($result_comprobantes_datos);

                                      $cpd_original_nuevo = $assoc_result_comprobantes_datos['cpd_original'];
                                      $cpd_copia          = $assoc_result_comprobantes_datos['cpd_copia']+1;

                                      
                                  } 


                    
                        //INSERTA EN LA TABLA DATOS DE COMPROBANTES MODIFICACION

                      
                        $insert_comprobantes_datos=$comprobantes_datos->insert_comprobantes_datos($ID_cte, $ID_usu, $cpd_fecha, $ID_pdv, $cpd_original_nuevo, $cpd_copia);
                        $CREADOMODIFICADO="MODIFICADO";
                         
                 
                        echo '<div class="container-fluid" id="contenedorDeAlerta">';
                             echo '<div class="alert alert-success">';
                              echo "<h4><i class='material-icons'>thumb_up</i> COMPROBANTE  ".$assoc_get_tipo_comprobantesById['tce_desc']." - ".$numeracionDeComprobante." ".$CREADOMODIFICADO." CORRECTAMENTE </h4><hr>";
                                echo "<ul>".@$MensajeDeAlertaCuenta.@$MensajeDeAlertaStock."</ul>";
                              echo '</div>';
                             echo '</div>';

                               //REDIRECCIONA
                                echo '<script type="text/javascript">
                                window.location.assign("modifComprobantes.php?ID_cte='.$ID_cte.'");
                                </script>';
            
          }



?>