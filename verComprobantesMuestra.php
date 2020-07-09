<?php
include_once('inc/conectar.php');
include_once('inc/classes.php');
include_once('inc/classesExclusivas.php');
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
$clientes                   = new clientes;
$FechayHora                 = date("Y-m-d H:i:s");
$ID_cte_Original            = $_POST['ID_cte'];

$medidaDeComprobante        = $_POST['medidaDeComprobante']; // 1 = grande / 2 = mediano

    ?>

    <style> 

    #areaImprimir
    {
      width:595px;
      height:auto;
      border:2px solid #000;
      padding:2%;
      margin-top: 13%;
      overflow:auto;
    }
    #cabeceraA
    {
      border:1px solid #000;
      height:110px;
    }
    #cabeceraA1
    {
      width:45%;
      height:100%;
      float:left;
      text-align:center;
      padding-top:2%;
    }
    #cabeceraA3
    {
      width:45%;
      height:100%;
      float:right;
      text-align:center;
      padding-top:2%;
    } 
    #cabeceraA2
    {
      width:10%;
      height:100%;
      float:right;
      text-align:center;
      padding-top:-2%;
    }
    #cabeceraA21
    {
      border:1px solid #333;
      height:30px;
      width:30px;
      text-align:center;
    }
    #cabeceraB
    {
      border:1px solid #000;
      height:100px;
      margin-top:1%;
    }
    #cuerpo
    {
      border:1px solid #000;
      height:auto;
      margin-top:1%;
    }
    #listadoComprobantes
    {
      font-size:10px;
    }
    #finalA
    {
      border:1px solid #000;
      height:100px;
      margin-top:1%;
      text-align:right;
    }
    #finalB
    {
      border:1px solid #000;
      height:30px;
      margin-top:1%;
    } 
    #p6
    {
    }
    #p10
    {
    }
    #p15
    {
    }
    th
    {
      text-align: center;
    }</style>

    <?php



//Traer DATOS DE CABECERA del comprobante 
    $get_cabecera_comprobantesById          =   $cabecera_comprobantes->get_cabecera_comprobantesById($ID_cte_Original);
    $assoc_get_cabecera_comprobantesById    =   mysql_fetch_assoc($get_cabecera_comprobantesById);
    $cte_numero_anterior                    =   $assoc_get_cabecera_comprobantesById['cte_numero'];
    $ID_tce_anterior                        =   $assoc_get_cabecera_comprobantesById['ID_tce'];
    $ID_caj_anterior                        =   $assoc_get_cabecera_comprobantesById['ID_caj'];
    $cte_monto_anterior                     =   $assoc_get_cabecera_comprobantesById['cte_monto'];
    $cte_asociado_anterior                  =   $assoc_get_cabecera_comprobantesById['cte_asociado'];
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
          //trae proveedores 
      $get_proveedoresById=$proveedores->get_proveedoresById($cte_asociacion_anterior);
      $assoc_get_proveedoresById=mysql_fetch_assoc($get_proveedoresById);
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
          //trae proveedores 
      $get_clientesById=$clientes->get_clientesById($cte_asociacion_anterior);
      $assoc_get_clientesById=mysql_fetch_assoc($get_clientesById);
      $nombre       = $assoc_get_paramentrosById['par_razonSocial'];
      $direccion    = $assoc_get_paramentrosById['par_direccion'];
      $telefono     = $assoc_get_paramentrosById['par_telefono'];
      $cuit         = $assoc_get_paramentrosById['par_cuil'];
      $nombreB      = $assoc_get_clientesById['cli_apellido']." ".$assoc_get_clientesById['cli_nombre'];
      $direccionB   = $assoc_get_clientesById['cli_direccion'];
      $telefonoB    = $assoc_get_clientesById['cli_telefono'];
       $cuitB       = "";
    }  


                     


                            //INICIO COMPROBANTE
                            echo "<div class='center-block' id='areaImprimir'>";

                              //CABECERA
                                echo "<div class='col-md-12'  id='cabeceraA'>";
                                   
                                    echo "<div  id='cabeceraA1'>";
                                            echo "<p id='p10'>".$nombre."</p>";    
                                            echo "<p id='p6'>".$direccion."</p>";  
                                            echo "<p id='p6'>".$telefono."</p>";  
                                    echo "</div>";


                                    echo "<div id='cabeceraA3'>";
                                      echo "<p id='p10'>".$tce_desc_anterior."</p>";
                                      echo "<p id='p10'>Nº ".$cte_numero_anterior."</p>";
                                      echo "<p id='p10'>FECHA: ".$cte_fec_anterior."</p>";
                                    echo "</div>";

                                    echo "<div id='cabeceraA2'>";
                                      echo "<div class='center-block' id='cabeceraA21'>";
                                          echo "<strong>".$tce_letra_anterior."</strong>";
                                      echo "</div>";
                                    echo "</div>";

                                echo "</div>"; 


                                //CABECERA 2
                                echo "<div class='col-md-12' id='cabeceraB'>";

                                   echo "<div class='col-md-6' id='cabeceraB1'>";
                                      echo "<p id='p10'>Sr/es: ".$nombreB."</p>";
                                      echo "<p id='p10'>".$direccionB."</p>";
                                   echo "</div>";

                                   echo "<div class='col-md-6' id='cabeceraB2'>";
                                      echo "Cuit: ".$cuitB;  
                                   echo "</div>";

                                echo "</div>"; 

                                //CUERPO
                                echo "<div class='col-md-12' id='cuerpo'>";
                                 
                                          //Si tenia detalle de articulos
                                          if ($tce_detalleArticulos_anterior) 
                                          {

                                             echo '<table id="listadoComprobantes" class="table table-responsive table-striped" cellspacing="0">';
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

                                //FOOTER                   
                                echo "<div class='col-md-12' id='finalA'>";
                                  echo "<p id='p10'>DESCUENTO: ".$metricaB." ".$cte_retencion_anterior."</p>";  
                                  echo "<p id='p15'>TOTAL: $".$cte_monto_anterior."</p>";
                                echo "</div>"; 

                                //FOOTER 2
                                echo "<div class='col-md-12' id='finalB'>";
                                     echo '<p id="p10">CAI Nº: '.@$pdv_cai_anterior ;
                                     echo ' - FECHA DE VTO: '.@$pdv_fecVencimiento_anterior.'</p>';
                                echo "</div>"; 


                            echo "</div>";  

                      


  ?>
 
   


