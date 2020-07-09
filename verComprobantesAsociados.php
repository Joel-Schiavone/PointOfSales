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
$ID_cte_OriginalB            = $_POST['ID_cteB'];


?>

<style type="text/css">

    #areaImprimirB
    {
      width:297px;
      height:auto;
      border:2px solid #000;
      padding:2%;
      margin-top: 13%;
      overflow: auto;
    }
    #cabeceraAB
    {
      border:1px solid #000;
      height:55px;
    }
    #cabeceraA1B
    {
      width:45%;
      height:100%;
      float:left;
      text-align:center;
      padding-top:2%;
    }
    #cabeceraA3B
    {
      width:45%;
      height:100%;
      float:right;
      text-align:center;
      padding-top:2%;
    } 
    #cabeceraA2B
    {
      width:10%;
      height:100%;
      float:right;
      text-align:center;
      padding-top:-2%;
    }
    #cabeceraA21B
    {
      border:1px solid #333;
      height:20px;
      width:20px;
      text-align:center;
        font-size:10px;
    }
    #cabeceraBB
    {
      border:1px solid #000;
      height:50px;
      margin-top:1%;
    }
    #cuerpoB
    {
      border:1px solid #000;
      height:auto;
      margin-top:1%;
      overflow: visible;
    }
    #listadoComprobantesB
    {
      font-size:10px;
    }
    #finalAB
    {
      border:1px solid #000;
      height:50px;
      margin-top:1%;
      text-align:right;
    }
    #finalBB
    {
      border:1px solid #000;
      height:15px;
      margin-top:1%;
    } 
    #p6B
    {
      font-size: 6px;
    }
    #p10B
    {
      font-size: 10px;
    }
    #p15B
    {
      font-size: 15px;
    }
    #thmedianoTitulo
    {
      text-align: center;
      font-size: 4px;
    }
     #thmedianoTexto
    {
      text-align: center;
      font-size: 4px;
    }
    #cabeceraB2B
    {
       font-size: 6px;
    }

  
</style>
<?php
//Traer DATOS DE CABECERA del comprobante 
    $get_cabecera_comprobantesByIdB          =   $cabecera_comprobantes->get_cabecera_comprobantesById($ID_cte_OriginalB);
    $assoc_get_cabecera_comprobantesByIdB    =   mysql_fetch_assoc($get_cabecera_comprobantesByIdB);
    $cte_numero_anteriorB                    =   $assoc_get_cabecera_comprobantesByIdB['cte_numero'];
    $ID_tce_anteriorB                        =   $assoc_get_cabecera_comprobantesByIdB['ID_tce'];
    $ID_caj_anteriorB                        =   $assoc_get_cabecera_comprobantesByIdB['ID_caj'];
    $cte_monto_anteriorB                     =   $assoc_get_cabecera_comprobantesByIdB['cte_monto'];
    $cte_asociado_anteriorB                  =   $assoc_get_cabecera_comprobantesByIdB['cte_asociado'];
    $cte_asociacion_anteriorB                =   $assoc_get_cabecera_comprobantesByIdB['cte_asociacion'];
    $cte_fec_anteriorB                       =   $assoc_get_cabecera_comprobantesByIdB['cte_fec'];
    $cte_retencion_anteriorB                 =   $assoc_get_cabecera_comprobantesByIdB['cte_retencion'];
    $cte_metrica_descuento_anteriorB         =   $assoc_get_cabecera_comprobantesByIdB['cte_metrica_descuento'];

    //Trae DATOS DEL COMPROBANTE 
    $get_comprobantes_datosOriginalBB        =   $comprobantes_datosE->get_comprobantes_datosOriginal($ID_cte_OriginalB);
    $assoc_get_comprobantes_datosOriginalBB  =   mysql_fetch_assoc($get_comprobantes_datosOriginalBB);
    $ID_pdv_anteriorB                        =   $assoc_get_comprobantes_datosOriginalBB['ID_pdv'];

    //Trae TIPO DE COMPROBANTE 
    $get_tipo_comprobantesByIdBB             =   $tipo_comprobantesE->get_tipo_comprobantesById($ID_tce_anteriorB);
    $assoc_get_tipo_comprobantesByIdBB       =   mysql_fetch_assoc($get_tipo_comprobantesByIdBB);
    $tce_numeracionAutomatica_anteriorB      =   $assoc_get_tipo_comprobantesByIdBB['tce_numeracionAutomatica'];
    $tce_movstock_anteriorB                  =   $assoc_get_tipo_comprobantesByIdBB['tce_movstock'];
    $fec_stock_anteriorB                     =   $assoc_get_tipo_comprobantesByIdBB['fec_stock'];
    $tce_detalleArticulos_anteriorB          =   $assoc_get_tipo_comprobantesByIdBB['tce_detalleArticulos'];
    $tce_movcaja_anteriorB                   =   $assoc_get_tipo_comprobantesByIdBB['tce_movcaja'];
    $tce_desc_anteriorB                      =   $assoc_get_tipo_comprobantesByIdBB['tce_desc'];
    $fec_caja_anteriorB                      =   $assoc_get_tipo_comprobantesByIdBB['fec_caja'];
    $fce_asociacion_anteriorB                =   $assoc_get_tipo_comprobantesByIdBB['fce_asociacion'];
    $tce_letra_anteriorB                     =   $assoc_get_tipo_comprobantesByIdBB['tce_letra'];
    $tce_desc_anteriorB                      =   $assoc_get_tipo_comprobantesByIdBB['tce_desc'];

    //trae parametros
      $ID_parB=1;
      $get_paramentrosByIdB=$paramentros->get_paramentrosById($ID_parB);
      $assoc_get_paramentrosByIdB=mysql_fetch_assoc($get_paramentrosByIdB);

    //trae proveedores 
      $get_proveedoresByIdB=$proveedores->get_proveedoresById($cte_asociacion_anteriorB);
      $assoc_get_proveedoresByIdB=mysql_fetch_assoc($get_proveedoresByIdB);



    if ($tce_numeracionAutomatica_anteriorB==1) 
    {
           //Trae PUNTO DE VENTA anterior
            $get_puntos_de_ventasByIdB       =   $puntos_de_ventas->get_puntos_de_ventasById($ID_pdv_anteriorB);
            $assoc_get_puntos_de_ventasByIdB =   mysql_fetch_assoc($get_puntos_de_ventasByIdB);
            $pdv_puntoVenta_anteriorB        =   $assoc_get_puntos_de_ventasByIdB['pdv_puntoVenta'];
            $pdv_numeracion_anteriorB        =   $assoc_get_puntos_de_ventasByIdB['pdv_numeracion'];
            $pdv_cai_anteriorB               =   $assoc_get_puntos_de_ventasByIdB['pdv_cai'];
            $pdv_fecVencimiento_anteriorB    =   $assoc_get_puntos_de_ventasByIdB['pdv_fecVencimiento'];
    }       


    if ($fce_asociacion_anteriorB=="proveedores") 
    {
          //trae proveedores 
      $get_proveedoresById=$proveedores->get_proveedoresById($cte_asociacion_anteriorB);
      $assoc_get_proveedoresById=mysql_fetch_assoc($get_proveedoresById);
      $nombreBX=$assoc_get_proveedoresById['pro_desc'];
      $direccionBX=$assoc_get_proveedoresById['pro_dir']." - ".$assoc_get_proveedoresById['pro_provincia']." - ".$assoc_get_proveedoresById['pro_localidad'];
      $telefonoBX=$assoc_get_proveedoresById['pro_tel'];
      $cuit="";
      $nombreBB=$assoc_get_paramentrosByIdB['par_razonSocial'];
      $direccionB=$assoc_get_paramentrosByIdB['par_direccion'];
      $telefonoB=$assoc_get_paramentrosByIdB['par_telefono'];
      $cuitBB=$assoc_get_paramentrosByIdB['par_cuil'];
    }
    else
    {
          //trae proveedores 
      $get_clientesById=$clientes->get_clientesById($cte_asociacion_anteriorB);
      $assoc_get_clientesById=mysql_fetch_assoc($get_clientesById);
      $nombreBX       = $assoc_get_paramentrosByIdB['par_razonSocial'];
      $direccionBX    = $assoc_get_paramentrosByIdB['par_direccion'];
      $telefonoBX     = $assoc_get_paramentrosByIdB['par_telefono'];
      $cuit         = $assoc_get_paramentrosByIdB['par_cuil'];
      $nombreBB      = $assoc_get_clientesById['cli_apellido']." ".$assoc_get_clientesById['cli_nombre'];
      $direccionB   = $assoc_get_clientesById['cli_direccion'];
      $telefonoB    = $assoc_get_clientesById['cli_telefono'];
       $cuitBB       = "";
    }  

                     

                            //INICIO COMPROBANTE
                            echo "<div class='center-block' id='areaImprimirB'>";

                              //CABECERA
                                echo "<div class='col-md-12'  id='cabeceraAB'>";
                                   
                                    echo "<div  id='cabeceraA1B'>";
                                            echo "<p id='p10B'>".$nombreBX."</p>";    
                                            echo "<p id='p6B'>".$direccionBX."</p>";  
                                            echo "<p id='p6B'>".$telefonoBX."</p>";  
                                    echo "</div>";


                                    echo "<div id='cabeceraA3B'>";
                                      echo "<p id='p6B'>".$tce_desc_anteriorB."</p>";
                                      echo "<p id='p6B'>Nº ".$cte_numero_anteriorB."</p>";
                                      echo "<p id='p6B'>FECHA: ".$cte_fec_anteriorB."</p>";
                                    echo "</div>";

                                    echo "<div id='cabeceraA2B'>";
                                      echo "<div class='center-block' id='cabeceraA21B'>";
                                          echo "<strong>".$tce_letra_anteriorB."</strong>";
                                      echo "</div>";
                                    echo "</div>";

                                echo "</div>"; 


                                //CABECERA 2
                                echo "<div class='col-md-12' id='cabeceraBB'>";

                                   echo "<div class='col-md-6' id='cabeceraB1B'>";
                                      echo "<p id='p10B'>Sr/es: ".$nombreBB."</p>";
                                      echo "<p id='p10B'>direccionB</p>";
                                   echo "</div>";

                                   echo "<div class='col-md-6' id='cabeceraB2B'>";
                                      echo "Cuit: ".$cuitBB;  
                                   echo "</div>";

                                echo "</div>"; 

                                //CUERPO
                                echo "<div class='col-md-12' id='cuerpoB'>";
                                 
                                          //Si tenia detalle de articulos
                                          if ($tce_detalleArticulos_anteriorB) 
                                          {

                                             echo '<table id="listadoComprobantesB" class="table table-responsive table-striped" cellspacing="0">';
                                              echo '<thead>';
                                                  echo '<tr>';
                                                      echo '<th id="thmedianoTitulo">CANT.</th>';
                                                      echo '<th id="thmedianoTitulo">CÓDIGO</th>';
                                                      echo '<th id="thmedianoTitulo">DESCRIPCIÓN</th>';
                                                      echo '<th id="thmedianoTitulo">PRECIO UNITARIO</th>';
                                                      echo '<th id="thmedianoTitulo">DESCUENTO</th>';
                                                      echo '<th id="thmedianoTitulo">RETENCIÓN</th>';
                                                      echo '<th id="thmedianoTitulo">TOTAL</th>';
                                                  echo '</tr>';
                                              echo '</thead>';
                                          echo '<tbody>';
                                              //busca articulo por articulo y vuelve atras el proceso, si incremento stock ahora lo descuenta y viceversa
                                              $get_detalle_comprobantesByIdBB           =   $detalle_comprobantesE->get_detalle_comprobantesById($ID_cte_OriginalB);
                                              $num_get_detalle_comprobantesByIdBB       =   mysql_num_rows($get_detalle_comprobantesByIdBB);

                                              for ($countdetalleanteriorB=0; $countdetalleanteriorB < $num_get_detalle_comprobantesByIdBB; $countdetalleanteriorB++) 
                                              { 
                                                  $assoc_get_detalle_comprobantesByIdBB = mysql_fetch_assoc($get_detalle_comprobantesByIdBB);
                                                  $ID_artBB                    = $assoc_get_detalle_comprobantesByIdBB['ID_art'];
                                                  $ID_sucBB                    = $assoc_get_detalle_comprobantesByIdBB['ID_suc'];
                                                  $sto_cantBB                  = $assoc_get_detalle_comprobantesByIdBB['dte_cantidad'];  
                                                  $dte_descuentoBB             = $assoc_get_detalle_comprobantesByIdBB['dte_descuento'];  
                                                  $dte_metricaBB               = $assoc_get_detalle_comprobantesByIdBB['dte_metrica']; 
                                                  $dte_ivaBB                    = $assoc_get_detalle_comprobantesByIdBB['dte_iva']; 
                                                  $dte_montoBB                   = $assoc_get_detalle_comprobantesByIdBB['dte_monto'];
                                                  //Trae descripcion del articulo
                                                   $get_articulosByIdBB        = $articulos->get_articulosById($ID_artBB);
                                                   @$assoc_get_articulosByIdBB = mysql_fetch_assoc($get_articulosByIdBB);
                                                   $art_descBB                 = $assoc_get_articulosByIdBB['art_desc'];
                                                   $art_codBB                  = $assoc_get_articulosByIdBB['art_cod'];
                                                   $ID_preBB                   = $assoc_get_articulosByIdBB['ID_pre'];

                                                   $get_preciosByIdB=$precios->get_preciosById($ID_preBB);
                                                   $assoc_get_preciosByIdB=mysql_fetch_assoc($get_preciosByIdB);
                                                   $pre_cantBB=$assoc_get_preciosByIdB['pre_cant'];

                                                   if ($dte_metricaBB==1) 
                                                   {
                                                     $metricaB="%";
                                                   }
                                                   else
                                                   {
                                                    $metricaB="$";
                                                   } 

                                                  echo '<tr>';
                                                      echo '<th id="thmedianoTexto">'.$sto_cantBB.'</th>';
                                                      echo '<th id="thmedianoTexto">'.$art_codBB.'</th>';
                                                      echo '<th id="thmedianoTexto">'.$art_descBB.'</th>';
                                                      echo '<th id="thmedianoTexto">$ '.$pre_cantBB.'</th>';
                                                      echo '<th id="thmedianoTexto">'.$metricaB.' '.$dte_descuentoBB.' </th>';
                                                      echo '<th id="thmedianoTexto">'.$dte_ivaBB.'%</th>';
                                                      echo '<th id="thmedianoTexto"> <p style="white-space:nowrap;"> $ '.$dte_montoBB.' </p> </th>';
                                                  echo '</tr>';
                                               }
                                       
                                          echo '</tbody>';
                                  echo '</table>';
                                  }
                                echo "</div>"; 
                                 if ($cte_metrica_descuento_anteriorB==1) 
                                                   {
                                                     $metricaBB="%";
                                                   }
                                                   else
                                                   {
                                                    $metricaBB="$";
                                                   } 

                                //FOOTER                   
                                echo "<div class='col-md-12' id='finalAB'>";
                                  echo "<p id='p6B'>DESCUENTO: ".$metricaBB." ".$cte_retencion_anteriorB."</p>";  
                                  echo "<p id='p10B'>TOTAL: $".$cte_monto_anteriorB."</p>";
                                echo "</div>"; 

                                //FOOTER 2
                                echo "<div class='col-md-12' id='finalBB'>";
                                if (@$pdv_cai_anteriorB) 
                                {
                                  
                                     echo '<p id="p6B">CAI Nº: '.$pdv_cai_anteriorB;
                                     echo ' - FECHA DE VTO: '.$pdv_fecVencimiento_anteriorB.'</p>';
                                }
                                echo "</div>"; 


                            echo "</div>";  

                      


  ?>
 
   


