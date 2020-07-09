<?php 
include_once('inc/conectar.php');
include_once('inc/classes.php');
include_once('inc/classesExclusivas.php');
include_once('modulos/header.php');
/*
require('librerias/fpdf/fpdf.php'); 

$posicion               = "P"; // P = vertical / L = horizontal
$formato                = "A4"; // puede ser A5, A3, etc.
$tipografia             = "Arial"; // puede ser Times, Courier, Symbol y ZapfDingbats
$decoracion             = "B"; // I = cursiva / U = subrrayado
$tamaño_texto           = 16;
$numeracion_pagina      = 1;
$tipo_de_impresion      = "recibe el nombre de la configuracion para aplicar la configuracion de la base de datos";

$contenido   = $_GET['contenido'];
$contenidoA = substr($contenido,1);
$contenidoB = substr($contenidoA,0,-1);
$contenidoNuevo = str_replace("\"","'",$contenidoB);
$contenidoNuevoB = "<h1>hola guachin</h1>";

$pdf = new FPDF($posicion,'mm',$formato);
$pdf->AddPage();
$pdf->SetFont($tipografia,$decoracion,$tamaño_texto);
$pdf->Cell(40,10,$contenidoNuevoB);



$pdf->Output();
*/

 ob_start(); 


$_SESSION['actionsBack']    = $_SERVER['REQUEST_URI'];
$cabecera_comprobantes      = new cabecera_comprobantes;
$cabecera_comprobantes      = new cabecera_comprobantes;
$cabecera_comprobantesE     = new cabecera_comprobantesE;
$tipo_comprobantesE         = new tipo_comprobantesE;
$cuentas_movimientos        = new cuentas_movimientos;
$cuentasE                   = new cuentasE;
$preciosE                   = new preciosE;
$puntos_de_ventas           = new puntos_de_ventas;
$stockE                     = new stockE;
$stock                      = new stock;
$articulos                  = new articulos;
$sucursales                 = new sucursales;
$detalle_comprobantes       = new detalle_comprobantes;
$puntos_de_ventasE          = new puntos_de_ventasE;
$comprobantesE              = new comprobantesE;
$comprobantes_datos         = new comprobantes_datos;
$comprobantes_datosE        = new comprobantes_datosE;
$detalle_comprobantesE      = new detalle_comprobantesE;
$proveedores                = new proveedores;
$paramentros                = new paramentros;
$precios                    = new precios;
$FechayHora                 = date("Y-m-d H:i:s");
$ID_cte_Original            = $_GET['ID_cte'];

//Traer DATOS DE CABECERA del comprobante 
    $get_cabecera_comprobantesById          =   $cabecera_comprobantes->get_cabecera_comprobantesById($ID_cte_Original);
    $assoc_get_cabecera_comprobantesById    =   mysql_fetch_assoc($get_cabecera_comprobantesById);
    $cte_numero_anterior                    =   $assoc_get_cabecera_comprobantesById['cte_numero'];
    $ID_tce_anterior                        =   $assoc_get_cabecera_comprobantesById['ID_tce'];
    $ID_caj_anterior                        =   $assoc_get_cabecera_comprobantesById['ID_caj'];
    $cte_monto_anterior                     =   $assoc_get_cabecera_comprobantesById['cte_monto'];
    $cte_asociacion_anterior                =   $assoc_get_cabecera_comprobantesById['cte_asociacion'];
    $cte_fec_anterior                       =   $assoc_get_cabecera_comprobantesById['cte_fec'];
    $cte_retencion_anterior                 =   $assoc_get_cabecera_comprobantesById['cte_retencion'];
    $cte_metrica_descuento_anterior         =   $assoc_get_cabecera_comprobantesById['cte_metrica_descuento'];

    //Trae DATOS DEL COMPROBANTE 
    $get_comprobantes_datosOriginalB        =   $comprobantes_datosE->get_comprobantes_datosOriginal($ID_cte_Original);
    $assoc_get_comprobantes_datosOriginalB  =   mysql_fetch_assoc($get_comprobantes_datosOriginalB);
    $ID_pdv_anterior                        =   $assoc_get_comprobantes_datosOriginalB['ID_pdv'];

    //Trae TIPO DE COMPROBANTE 
    $get_tipo_comprobantesByIdB             =   $tipo_comprobantesE->get_tipo_comprobantesById($ID_tce_anterior);
    $assoc_get_tipo_comprobantesByIdB       =   mysql_fetch_assoc($get_tipo_comprobantesByIdB);
    $tce_numeracionAutomatica_anterior      =   $assoc_get_tipo_comprobantesByIdB['tce_numeracionAutomatica'];
    $tce_movstock_anterior                  =   $assoc_get_tipo_comprobantesByIdB['tce_movstock'];
    $fec_stock_anterior                     =   $assoc_get_tipo_comprobantesByIdB['fec_stock'];
    $tce_detalleArticulos_anterior          =   $assoc_get_tipo_comprobantesByIdB['tce_detalleArticulos'];
    $tce_movcaja_anterior                   =   $assoc_get_tipo_comprobantesByIdB['tce_movcaja'];
    $tce_desc_anterior                      =   $assoc_get_tipo_comprobantesByIdB['tce_desc'];
    $fec_caja_anterior                      =   $assoc_get_tipo_comprobantesByIdB['fec_caja'];
    $fce_asociacion_anterior                =   $assoc_get_tipo_comprobantesByIdB['fce_asociacion'];
    $tce_letra_anterior                     =   $assoc_get_tipo_comprobantesByIdB['tce_letra'];
    $tce_desc_anterior                      =   $assoc_get_tipo_comprobantesByIdB['tce_desc'];

    //trae parametros
      $ID_par=1;
      $get_paramentrosById=$paramentros->get_paramentrosById($ID_par);
      $assoc_get_paramentrosById=mysql_fetch_assoc($get_paramentrosById);

    //trae proveedores 
      $get_proveedoresById=$proveedores->get_proveedoresById($cte_asociacion_anterior);
      $assoc_get_proveedoresById=mysql_fetch_assoc($get_proveedoresById);



    if ($tce_numeracionAutomatica_anterior==1) 
    {
           //Trae PUNTO DE VENTA anterior
            $get_puntos_de_ventasById       =   $puntos_de_ventas->get_puntos_de_ventasById($ID_pdv_anterior);
            $assoc_get_puntos_de_ventasById =   mysql_fetch_assoc($get_puntos_de_ventasById);
            $pdv_puntoVenta_anterior        =   $assoc_get_puntos_de_ventasById['pdv_puntoVenta'];
            $pdv_numeracion_anterior        =   $assoc_get_puntos_de_ventasById['pdv_numeracion'];
            $pdv_cai_anterior               =   $assoc_get_puntos_de_ventasById['pdv_cai'];
            $pdv_fecVencimiento_anterior    =   $assoc_get_puntos_de_ventasById['pdv_fecVencimiento'];
    }       


    if ($fce_asociacion_anterior=="proveedores") 
    {
      $nombre=$assoc_get_proveedoresById['pro_desc'];
      $direccion=$assoc_get_proveedoresById['pro_dir']." - ".$assoc_get_proveedoresById['pro_provincia']." - ".$assoc_get_proveedoresById['pro_localidad'];
      $telefono=$assoc_get_proveedoresById['pro_tel'];
      $cuit="";
      $nombreB=$assoc_get_paramentrosById['par_razonSocial'];
      $direccionB=$assoc_get_paramentrosById['par_direccion'];
      $telefonoB=$assoc_get_paramentrosById['par_telefono'];
      $cuitB=$assoc_get_paramentrosById['par_cuil'];
    }
    else
    {
      $nombre       = $assoc_get_paramentrosById['par_razonSocial'];
      $direccion    = $assoc_get_paramentrosById['par_direccion'];
      $telefono     = $assoc_get_paramentrosById['par_telefono'];
      $cuit         = $assoc_get_paramentrosById['par_cuil'];
      $nombreB      = $assoc_get_proveedoresById['pro_desc'];
      $direccionB   = $assoc_get_proveedoresById['pro_dir']." - ".$assoc_get_proveedoresById['pro_provincia']." - ".$assoc_get_proveedoresById['pro_localidad'];
      $telefonoB    = $assoc_get_proveedoresById['pro_tel'];
       $cuitB       = "";
    }  


                    echo "<div class='container-fluid' style='text-align:center; margin-top:2%;'>";
                 
                       echo "<div class='col-md-9 center-block' style='text-align:center;'>";
                            echo "<div class='center-block' style='width:595px; height:842px; border:2px solid #000; padding:2%;' id='contenido'>";
                                echo "<div class='col-md-12' style='border:1px solid #000; height:150px;' id='cabeceraA'>";
                                    echo "<div class='col-md-5' style='height:100%;' id='cabeceraA1'>";
                                            echo "<p><h3>".$nombre."</h3></p>";    
                                            echo "<p><h5>".$direccion."</h5></p>";  
                                            echo "<p><h5>".$telefono."</h5></p>";  
                                    echo "</div>"; 
                                    echo "<div class='col-md-2' style='id='cabeceraA2'>";
                                      echo "<div class='center-block' style='border:1px solid #333; height:20%; width:40%; text-align:center' id='cabeceraA21'>";
                                          echo "<strong>".$tce_letra_anterior."</strong>";
                                      echo "</div>";
                                    echo "</div>";
                                    echo "<div class='col-md-5' style='height:100%;' id='cabeceraA3'>";
                                      echo "<p><h4>".$tce_desc_anterior."</h4></p>";
                                      echo "<p><h4>Nº ".$cte_numero_anterior."</h4></p>";
                                      echo "<p>FECHA: ".$cte_fec_anterior."</p>";
                                    echo "</div>";
                                echo "</div>"; 
                                echo "<div class='col-md-12' style='border:1px solid #000; height:100px; margin-top:1%;' id='cabeceraB'>";
                                   echo "<div class='col-md-6' id='cabeceraB1'>";
                                      echo "<p>Sr/es: ".$nombreB."</p>";
                                      echo "<p>direccionB</p>";
                                   echo "</div>";
                                   echo "<div class='col-md-6' id='cabeceraB2'>";
                                      echo "Cuit: ".$cuitB;  
                                   echo "</div>";
                                echo "</div>"; 
                                echo "<div class='col-md-12' style='border:1px solid #000; height:400px; margin-top:1%;' id='cuerpo'>";
                                 
                                          //Si tenia detalle de articulos
                                          if ($tce_detalleArticulos_anterior) 
                                          {

                                             echo '<table id="listadoComprobantes" class="table table-responsive table-striped" cellspacing="0" style="font-size:10px;">';
                                              echo '<thead>';
                                                  echo '<tr>';
                                                      echo '<th>CANT.</th>';
                                                      echo '<th>CÓDIGO</th>';
                                                      echo '<th>DESCRIPCIÓN</th>';
                                                      echo '<th>PRECIO UNITARIO</th>';
                                                      echo '<th>DESCUENTO</th>';
                                                      echo '<th>RETENCIÓN</th>';
                                                      echo '<th>TOTAL</th>';
                                                  echo '</tr>';
                                              echo '</thead>';
                                          echo '<tbody>';
                                              //busca articulo por articulo y vuelve atras el proceso, si incremento stock ahora lo descuenta y viceversa
                                              $get_detalle_comprobantesByIdB           =   $detalle_comprobantesE->get_detalle_comprobantesById($ID_cte_Original);
                                              $num_get_detalle_comprobantesByIdB       =   mysql_num_rows($get_detalle_comprobantesByIdB);

                                              for ($countdetalleanterior=0; $countdetalleanterior < $num_get_detalle_comprobantesByIdB; $countdetalleanterior++) 
                                              { 
                                                  $assoc_get_detalle_comprobantesByIdB = mysql_fetch_assoc($get_detalle_comprobantesByIdB);
                                                  $ID_artB                    = $assoc_get_detalle_comprobantesByIdB['ID_art'];
                                                  $ID_sucB                    = $assoc_get_detalle_comprobantesByIdB['ID_suc'];
                                                  $sto_cantB                  = $assoc_get_detalle_comprobantesByIdB['dte_cantidad'];  
                                                  $dte_descuentoB             = $assoc_get_detalle_comprobantesByIdB['dte_descuento'];  
                                                  $dte_metricaB               = $assoc_get_detalle_comprobantesByIdB['dte_metrica']; 
                                                  $dte_ivaB                   = $assoc_get_detalle_comprobantesByIdB['dte_iva']; 
                                                  $dte_montoB                   = $assoc_get_detalle_comprobantesByIdB['dte_monto'];
                                                  //Trae descripcion del articulo
                                                   $get_articulosByIdB        = $articulos->get_articulosById($ID_artB);
                                                   @$assoc_get_articulosByIdB = mysql_fetch_assoc($get_articulosByIdB);
                                                   $art_descB                 = $assoc_get_articulosByIdB['art_desc'];
                                                   $art_codB                  = $assoc_get_articulosByIdB['art_cod'];
                                                   $ID_preB                   = $assoc_get_articulosByIdB['ID_pre'];

                                                   $get_preciosById=$precios->get_preciosById($ID_preB);
                                                   $assoc_get_preciosById=mysql_fetch_assoc($get_preciosById);
                                                   $pre_cantB=$assoc_get_preciosById['pre_cant'];

                                                   if ($dte_metricaB==1) 
                                                   {
                                                     $metrica="%";
                                                   }
                                                   else
                                                   {
                                                    $metrica="$";
                                                   } 

                                                  echo '<tr>';
                                                      echo '<th>'.$sto_cantB.'</th>';
                                                      echo '<th>'.$art_codB.'</th>';
                                                      echo '<th>'.$art_descB.'</th>';
                                                      echo '<th>$ '.$pre_cantB.'</th>';
                                                      echo '<th>'.$metrica.' '.$dte_descuentoB.' </th>';
                                                      echo '<th>'.$dte_ivaB.'%</th>';
                                                      echo '<th> <p style="white-space:nowrap;"> $ '.$dte_montoB.' </p> </th>';
                                                  echo '</tr>';
                                               }
                                       
                                          echo '</tbody>';
                                  echo '</table>';
                                  }
                                echo "</div>"; 
                                 if ($cte_metrica_descuento_anterior==1) 
                                                   {
                                                     $metricaB="%";
                                                   }
                                                   else
                                                   {
                                                    $metricaB="$";
                                                   } 
                                echo "<div class='col-md-12' style='border:1px solid #000; height:100px; margin-top:1%; text-align:right' id='finalA'>";
                                  echo "<p><h5>DESCUENTO: ".$metricaB." ".$cte_retencion_anterior."</h5></p>";  
                                  echo "<p><h4>TOTAL: $".$cte_monto_anterior."</h4></p>";
                                echo "</div>"; 
                                echo "<div class='col-md-12' style='border:1px solid #000; height:30px; margin-top:1%;' id='finalB'>";
                                     echo '<p>CAI Nº: '.$pdv_cai_anterior ;
                                     echo ' - FECHA DE VTO: '.$pdv_fecVencimiento_anterior.'</p>';
                                echo "</div>"; 
                            echo "</div>";    
                        echo "</div>";
                     echo "</div>";   
  ?>
 





<?php
require_once("librerias/dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "ejemplo".time().'.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>

