<?php
include_once("inc/requerido.php"); 
include_once("inc/validacion.php"); 
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

$get_cabecera_comprobantesById          =   $cabecera_comprobantes->get_cabecera_comprobantesById($ID_cte_Original);
$assoc_get_cabecera_comprobantesById    =   mysql_fetch_assoc($get_cabecera_comprobantesById);
$cte_asociado                           =   $assoc_get_cabecera_comprobantesById['cte_asociado'];
$cte_numero                             =   $assoc_get_cabecera_comprobantesById['cte_numero'];

                    echo "<div class='container-fluid' style='text-align:center; margin-top:2%;'>";
                  
                        echo "<div class='col-md-9 center-block' style='text-align:center;'>";

                            //CARTEL 
                            echo "<div class='col-md-12' style='text-align: center;'>
                                    <div class='alert alert-dismissible alert-info'>
                                      <h3><i class='material-icons'>visibility</i> Comprobante ".$cte_numero."  <img src=media/loading/cargando4.gif id='cargandoBoton' style='display: none;'></h3>
                                    </div>
                                  </div>";

                            //BOTONERA
                            echo "<div class='col-md-12' style='text-align: center; margin-bottom:1%; margin-top: 1%;'>";?>
                                      <button class='btn btn-primary' onclick="printDiv('areaImprimir')" id='imprimir'><i class='material-icons'>print</i> IMPRIMIR </button>
                                     <?php echo "<button class='btn btn-primary' id='eliminarComprobante' disabled><i class='material-icons'>mail</i> ENVIAR POR EMAIL </button>
                                         <a href='modifComprobantes.php?ID_cte=".$ID_cte_Original."'><button class='btn btn-info' id='eliminarComprobante'><i class='material-icons'>edit</i> MODIFICAR </button></a>
                                         <a href='eliminaComprobantes.php?ID_cte=".$ID_cte_Original."'><button class='btn btn-danger' id='eliminarComprobante'><i class='material-icons'>delete_forever</i> ELIMINAR</button></a>
                                  </div>";

                            //MOSTRADOR DE COMPROBANTE PRINCIPAL
                            echo "<div id='muestraComprobantePrincipal' style='display:none;'></div>";

                        echo "</div>";

                        //MUESTRA COMPROBANTE PRINCIPAL-->
                                        echo '<script>
                                                $(document).ready(function(){
                                                  var ID_cte = '.$ID_cte_Original.';
                                                  var medidaDeComprobante = "1";

                                                  var dataString = "medidaDeComprobante="+medidaDeComprobante + "&ID_cte="+ID_cte;
                                                  $.ajax(
                                                                                            {
                                                                                                type: "POST",
                                                                                                url: "verComprobantesMuestra.php",
                                                                                                data: dataString,
                                                                                                success: function(data)
                                                                                                 {
                                                                                                    $("#muestraComprobantePrincipal").fadeIn(1000).html(data);
                                                                                                 }

                                                                                             });

                                                });
                                              </script>';

                        //INICIO DE RELACIONADOS
                        echo "<div class='col-md-3 center-block' style='text-align:center;'>";

                            echo "<div class='alert alert-dismissible alert-info'>
                                <h3><i class='material-icons'>link</i> Relacionados </h3>";
                            echo "</div>";



                            $ID_cte_OriginalB = $ID_cte_Original;

                            

                             $get_cabecera_comprobantesB=$cabecera_comprobantes->get_cabecera_comprobantes();
                              $num_get_cabecera_comprobantesB=mysql_num_rows($get_cabecera_comprobantesB);

                              //echo $ID_cte_OriginalB;
                              
                              //echo "<br>";
                            $salir="no";
                            while ($salir=="no")
                            {
                             
                              for ($aa=0; $aa < $num_get_cabecera_comprobantesB; $aa++) 
                              { 
                                $assoc_get_cabecera_comprobantesB=mysql_fetch_assoc($get_cabecera_comprobantesB);

                                 $ID_cte_recorridoB=$assoc_get_cabecera_comprobantesB['ID_cte'];
                                 
                                 $cte_asociado_recorridoB=$assoc_get_cabecera_comprobantesB['cte_asociado'];
                            

                                 if ($ID_cte_OriginalB==$cte_asociado_recorridoB) 
                                {
                                  $ID_cte_recorridoB;
                                   
                                  $ID_cte_OriginalB=$ID_cte_recorridoB;
                                  $salir="no";


                                    //MOSTRADOR DE COMPROBANTE ANTERIOR
                                        echo "<div style='width: 100%; border:2px solid #333;'>
                                               
                                                  <h5 class='card-title'><i class='material-icons'>query_builder</i> ANTERIORES</h5><a href='verComprobantes.php?ID_cte=".$ID_cte_recorridoB."'><div id='muestraComprobanteAnterior".$ID_cte_recorridoB."' style='display:none'></div></a></div>";


                                       //MUESTRA COMPROBANTE ANTERIOR-->
                                        echo '<script>
                                                $(document).ready(function(){
                                                  var ID_cteB'.$ID_cte_recorridoB.' = '.$ID_cte_recorridoB.';
                                                  var medidaDeComprobanteB'.$ID_cte_recorridoB.' = "2";

                                                  var dataStringB'.$ID_cte_recorridoB.' = "medidaDeComprobanteB="+medidaDeComprobanteB'.$ID_cte_recorridoB.' + "&ID_cteB="+ID_cteB'.$ID_cte_recorridoB.';
                                                  $.ajax(
                                                                                            {
                                                                                                type: "POST",
                                                                                                url: "verComprobantesAsociados.php",
                                                                                                data: dataStringB'.$ID_cte_recorridoB.',
                                                                                                success: function(data)
                                                                                                 {
                                                                                                    $("#muestraComprobanteAnterior'.$ID_cte_recorridoB.'").fadeIn(1000).html(data);
                                                                                                 }

                                                                                             });

                                                });
                                              </script>';

                                              echo '<i class="material-icons" style="font-size:30px; margin-top:5%;">arrow_downward</i>';
                                   break;

                                }
                                else
                                {
                                  $salir="si";
                                }  

                              } 
                               
                             }  
                   
                                      






                                       //MOSTRADOR DE COMPROBANTE ACTUAL
                                        echo "<div style='width: 100%; border:2px solid #333;'>
                                               
                                                  <h5 class='card-title'><i class='material-icons'>query_builder</i> ACTUAL</h5>
                                                  <p class='card-text'><a href='verComprobantes.php?ID_cte=".$ID_cte_Original."'><div id='muestraComprobanteAnterior".$ID_cte_Original."' style='display:none'></div></a></p>
                                          
                                              </div> ";


                                       //MUESTRA COMPROBANTE ACTUAL-->
                                        echo '<script>
                                                $(document).ready(function(){
                                                  var ID_cteB'.$ID_cte_Original.' = '.$ID_cte_Original.';
                                                  var medidaDeComprobanteB'.$ID_cte_Original.' = "2";

                                                  var dataStringB'.$ID_cte_Original.' = "medidaDeComprobanteB="+medidaDeComprobanteB'.$ID_cte_Original.' + "&ID_cteB="+ID_cteB'.$ID_cte_Original.';
                                                  $.ajax(
                                                                                            {
                                                                                                type: "POST",
                                                                                                url: "verComprobantesAsociados.php",
                                                                                                data: dataStringB'.$ID_cte_Original.',
                                                                                                success: function(data)
                                                                                                 {
                                                                                                    $("#muestraComprobanteAnterior'.$ID_cte_Original.'").fadeIn(1000).html(data);
                                                                                                 }

                                                                                             });

                                                });
                                              </script>';



                 

                            $cte_asociadoB = $cte_asociado;
                            while ($cte_asociadoB!=0) 
                            {
                              //TRAE TODOS LOS COMPROBANTES
                              $get_cabecera_comprobantes=$cabecera_comprobantes->get_cabecera_comprobantes();
                              $num_get_cabecera_comprobantes=mysql_num_rows($get_cabecera_comprobantes);

                              for ($i=0; $i < $num_get_cabecera_comprobantes; $i++) 
                              { 
                                $assoc_get_cabecera_comprobantes=mysql_fetch_assoc($get_cabecera_comprobantes);
                                $ID_cte_recorrido=$assoc_get_cabecera_comprobantes['ID_cte'];
                                $cte_asociado_recorrido=$assoc_get_cabecera_comprobantes['cte_asociado'];

                                if ($cte_asociadoB==$ID_cte_recorrido) 
                                {
                                   $get_cabecera_comprobantesById=$cabecera_comprobantes->get_cabecera_comprobantesById($cte_asociado_recorrido);
                                   $assoc_get_cabecera_comprobantesById=mysql_fetch_assoc($get_cabecera_comprobantesById);
                                   echo '<i class="material-icons" style="font-size:30px; margin-top:5%;">arrow_downward</i>';

                                      //MOSTRADOR DE COMPROBANTE ANTERIOR
                                        echo "<div style='width: 100%; border:2px solid #333;'>
                                               
                                                  <h5 class='card-title'><i class='material-icons'>query_builder</i> POSTERIORES</h5><a href='verComprobantes.php?ID_cte=".$ID_cte_recorrido."'><div id='muestraComprobanteAnterior".$ID_cte_recorrido."' style='display:none'></div></a></div>";


                                       //MUESTRA COMPROBANTE ANTERIOR-->
                                        echo '<script>
                                                $(document).ready(function(){
                                                  var ID_cteB = '.$ID_cte_recorrido.';
                                                  var medidaDeComprobanteB = "2";

                                                  var dataStringB = "medidaDeComprobanteB="+medidaDeComprobanteB + "&ID_cteB="+ID_cteB;
                                                  $.ajax(
                                                                                            {
                                                                                                type: "POST",
                                                                                                url: "verComprobantesAsociados.php",
                                                                                                data: dataStringB,
                                                                                                success: function(data)
                                                                                                 {
                                                                                                    $("#muestraComprobanteAnterior'.$ID_cte_recorrido.'").fadeIn(1000).html(data);
                                                                                                 }

                                                                                             });

                                                });
                                              </script>';

                                   $ID_cte_nuevo=$assoc_get_cabecera_comprobantesById['ID_cte'];
                                   
                                   $cte_assoc_nuevo=$assoc_get_cabecera_comprobantesById['cte_asociado'];
                                   $cte_asociadoB=$ID_cte_nuevo;

                                   break;
                                }
                              }
                            }


                            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            ////////////////////////////////////////////COMIENZO COMPROBANTES RELACIONADOS ANTERIORES///////////////////
                            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                     /*  
                                  
                                $ID_cte_Original_anterior=$cte_asociado;
                                $cte_asociado_anterior=$cte_asociado;
                                     $get_cabecera_comprobantesByIdcte_asociado=$cabecera_comprobantesE->get_cabecera_comprobantesById($ID_cte_Original_anterior);
                                      
                                      $assoc_get_cabecera_comprobantesByIdcte_asociado=mysql_fetch_assoc($get_cabecera_comprobantesByIdcte_asociado);
                                while ($cte_asociado_anterior>=1) 
                                  {
                                     $ID_cte_Original_anterior=$cte_asociado_anterior;
                                         $get_cabecera_comprobantesByIdcte_asociado=$cabecera_comprobantesE->get_cabecera_comprobantesById($cte_asociado_anterior);
                                      
                                      $assoc_get_cabecera_comprobantesByIdcte_asociado=mysql_fetch_assoc($get_cabecera_comprobantesByIdcte_asociado);
                                        $cte_asociado_anterior=$assoc_get_cabecera_comprobantesByIdcte_asociado['cte_asociado'];
                                      $ID_cte_Original_anterior=$assoc_get_cabecera_comprobantesByIdcte_asociado['ID_cte']; 
                                     
                                        //MOSTRADOR DE COMPROBANTE ANTERIOR
                                        echo "<div id='muestraComprobanteAnterior' style='display:none'></div>";


                                       //MUESTRA COMPROBANTE ANTERIOR-->
                                        echo '<script>
                                                $(document).ready(function(){
                                                  var ID_cteB = '.$ID_cte_Original_anterior.';
                                                  var medidaDeComprobanteB = "2";

                                                  var dataStringB = "medidaDeComprobanteB="+medidaDeComprobanteB + "&ID_cteB="+ID_cteB;
                                                  $.ajax(
                                                                                            {
                                                                                                type: "POST",
                                                                                                url: "verComprobantesAsociados.php",
                                                                                                data: dataStringB,
                                                                                                success: function(data)
                                                                                                 {
                                                                                                    $("#muestraComprobanteAnterior").fadeIn(1000).html(data);
                                                                                                 }

                                                                                             });

                                                });
                                              </script>';
                                               echo '<i class="material-icons" style="font-size:30px; margin-top:5%;">arrow_downward</i>';
  
                                   
                                       
                                    }   
                                      
                                    
                                  
                            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            ////////////////////////////////////////////COMIENZO COMPROBANTES ACTUALES////////////////////////////////
                            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                               

                                        echo "<H1>COMPROBANTE ACTUAL</H1>";


                            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            ////////////////////////////////////////////COMIENZO COMPROBANTES RELACIONADOS POSTERIORES//////////////////
      /*

                                $ID_cte_Original_atras=$ID_cte_Original;
                           
                                while ($ID_cte_Original_atras) 
                                     {
                                        $ID_cte_Original_atras=$ID_cte_Original_atras;

                                        $get_cabecera_comprobantesByIdcte_asociado_atras=$cabecera_comprobantesE->get_cabecera_comprobantesByIdcte_asociadoAtras($ID_cte_Original_atras);
                                      
                                        $assoc_get_cabecera_comprobantesByIdcte_asociado_atras=mysql_fetch_assoc($get_cabecera_comprobantesByIdcte_asociado_atras);
                                        $cte_asociado_anteriorB_atras=$assoc_get_cabecera_comprobantesByIdcte_asociado_atras['cte_asociado'];
                                        $ID_cte_Original_atras=$assoc_get_cabecera_comprobantesByIdcte_asociado_atras['ID_cte']; 
                        
                                        echo '<i class="material-icons" style="font-size:30px; margin-top:5%;">arrow_upward</i>';

                                        //MOSTRADOR DE COMPROBANTE PRINCIPAL
                                        echo "<div id='muestraComprobantePosterior' style='display:none'></div>";
                                  
                                      }

*/

                    echo "</div>";
                     echo "</div>";   
  ?>
 
   

<style type="text/css">
  th
  {
    text-align: center;
  }


</style>
<script type="text/javascript">
function printDiv(areaImprimir) {
     var contenido= document.getElementById(areaImprimir).innerHTML;
     var contenidoOriginal= document.body.innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     document.body.innerHTML = contenidoOriginal;
}
</script>




<!--Inicio: Footer -->
<?php
  include("modulos/footer.php"); 
?>


