	<!--Inicio: Documentos requeridos -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<?php
  include_once('inc/conectar.php');
  include_once('inc/classes.php');
  include_once('inc/classesExclusivas.php');
  $_SESSION['actionsBack']= $_SERVER['REQUEST_URI'];
  $comprobantesE          = new comprobantesE;
  $comprobantes_datosE    = new comprobantes_datosE;
  $detalle_comprobantesE  = new detalle_comprobantesE;
  $ID_tceB=$_POST['ID_tceB'];

  $reciveFecha=$_POST['fecha'];
  $fechaSinEspacios=str_replace(" ","",$reciveFecha);
  $fechaSinEspacios2=substr($fechaSinEspacios, 4);
  $fechaDividida=explode("-",$fechaSinEspacios2);

  $fechaInicio=$fechaDividida[0];
  $fechaInicioCambioDeSignos=str_replace( "/" , "-" ,$fechaInicio);
  $fechaInicioFormateda=date("Y-m-d",strtotime($fechaInicioCambioDeSignos));
  $fecDesde=$fechaInicioFormateda . " 00:00:00";

  $fechafin=$fechaDividida[1];
  $fechafinCambioDeSignos=str_replace( "/" , "-" ,$fechafin);
  $fechaFinFormateda=date("Y-m-d",strtotime($fechafinCambioDeSignos));
  $fecHasta=$fechaFinFormateda . " 23:59:59";

                        if ($ID_tceB==0) 
                        {
                          $get_comprobantes=$comprobantesE->get_cabecera_comprobantes_listado_compras($fecDesde, $fecHasta);
                          $get_comprobantesB=$comprobantesE->get_cabecera_comprobantes_listado_compras_totales($fecDesde, $fecHasta);
                        }
                        else
                        {
                          $get_comprobantes=$comprobantesE->get_cabecera_comprobantes_listado_compras_ID_tceB($ID_tceB, $fecDesde, $fecHasta);
                          $get_comprobantesB=$comprobantesE->get_cabecera_comprobantes_listado_compras_ID_tceB_totales($ID_tceB, $fecDesde, $fecHasta);
                        }  
                        if ($get_comprobantes) 
                        {
                          $num_get_comprobantesB=mysql_num_rows($get_comprobantesB);
                         
                          $total_sin_descuento_porcentaje = 0 ;
                          $total_sin_descuento_monto      = 0 ;   
                          $total_descuento_porcentaje     = 0 ;
                          $total_descuento_monto          = 0 ; 
                          $grabado_total                  = 0 ;
                          for ($countTotalesPorTipo=0; $countTotalesPorTipo < $num_get_comprobantesB; $countTotalesPorTipo++) 
                          { 
                            $assoc_get_comprobantesB=mysql_fetch_assoc($get_comprobantesB);
                            $ID_tceC=$assoc_get_comprobantesB['ID_cte'];
                            if ($assoc_get_comprobantesB['tce_detalleArticulos']==1) 
                            {  
                                $get_detalle_comprobantesById=$detalle_comprobantesE->get_detalle_comprobantesById($ID_tceC);
                                $num_get_detalle_comprobantesById=mysql_num_rows($get_detalle_comprobantesById);
                                for ($countDetallesComprobantes=0; $countDetallesComprobantes < $num_get_detalle_comprobantesById; $countDetallesComprobantes++) 
                                { 
                                   $assoc_get_detalle_comprobantesById=mysql_fetch_assoc($get_detalle_comprobantesById);
                                   $dte_iva=$assoc_get_detalle_comprobantesById['dte_iva'];
                                   $dte_monto=$assoc_get_detalle_comprobantesById['dte_monto'];
                                   $grabado=($dte_monto*$dte_iva)/100;
                                   $grabado_total=$grabado+$grabado_total;
                                }
                            }

                            if ($assoc_get_comprobantesB['cte_metrica_descuento']==1) 
                            {
                              $descuentoPorcentaje    = ($assoc_get_comprobantesB['cte_retencion']*$assoc_get_comprobantesB['cte_monto'])/100;
                              $descuentoPorcentajeB   = $assoc_get_comprobantesB['cte_monto']+$descuentoPorcentaje;
                              $total_descuento_porcentaje = $descuentoPorcentaje+$total_descuento_porcentaje;
                              $total_sin_descuento_porcentaje=$total_sin_descuento_porcentaje+$descuentoPorcentajeB; 
                            }
                            else
                            {
                              $descuentoMontoB    = $assoc_get_comprobantesB['cte_monto']+$assoc_get_comprobantesB['cte_retencion'];
                              $total_sin_descuento_monto=$total_sin_descuento_monto+$descuentoMontoB; 
                              $total_descuento_monto = $descuentoMontoB+$total_descuento_monto;
                            }  
                            
                          }  

                         
                           $num_get_comprobantes=mysql_num_rows($get_comprobantes);
                         echo '<table id="listadoComprobantes" class="table table-responsive table-striped table-bordered" cellspacing="0">';
                            echo '<thead>';
                                echo '<tr>';
                                    echo '<th>FECHA</th>';
                                    echo '<th>NÚMERO</th>';
                                    echo '<th>TIPO</th>';
                                    echo '<th>CLIENTE/PROVEEDOR</th>';
                                    echo '<th>MONTO</th>';
                                    echo '<th>ESTADO</th>';
                                    echo '<th>VER</th>';
                                    echo '<th>EDITAR</th>';
                                    echo '<th>ELIMINAR</th>';
                                echo '</tr>';
                            echo '</thead>';
                            echo '<tfoot>';
                                echo '<tr>';
                                    echo '<th>FECHA</th>';
                                    echo '<th>NÚMERO</th>';
                                    echo '<th>TIPO</th>';
                                    echo '<th>CLIENTE/PROVEEDOR</th>';
                                    echo '<th>MONTO</th>';
                                    echo '<th>ESTADO</th>';
                                    echo '<th>VER</th>';
                                    echo '<th>EDITAR</th>';
                                    echo '<th>ELIMINAR</th>';
                                echo '</tr>';
                            echo '</tfoot>';
                            echo '<tbody>';
                        

                          for ($Countget_comprobantes=0; $Countget_comprobantes < $num_get_comprobantes; $Countget_comprobantes++) 
                          { 
                              $assoc_get_comprobantes=mysql_fetch_assoc($get_comprobantes);
                              $ID_cte=$assoc_get_comprobantes['ID_cte'];

                              //BUSCA EL ID DE DATOS DE COMPROBANTES (ID_cpd) DE LA FILA QUE CONTENGA EL ID_CTE RECIBIDO
                               $sql_traeID_cte                = 'SELECT ID_cpd, cpd_original FROM comprobantes_datos WHERE ID_cte='.$ID_cte.'';
                               $result_sql_traeID_cte         = mysql_query($sql_traeID_cte);
                               $assoc_result_sql_traeID_cte   = mysql_fetch_assoc($result_sql_traeID_cte);
                               $ID_cpd                        = $assoc_result_sql_traeID_cte['ID_cpd'];
                               $cpd_original                  = $assoc_result_sql_traeID_cte['cpd_original'];
                               //VERIFICA SI TIENE CERO EN EL CPD_ORIGINAL
                               

                                  //SI TIENE CERO EN EL CPD ORGINAL PROCEDE A EJECUTAR LA FUNCION PARA TRAER EL MAYOR DE LAS MODIFICACIONES
                                  if ($cpd_original==0) 
                                  {
                                     $sql_comprobantes_datos       = 'SELECT cpd_copia, ID_cpd FROM comprobantes_datos WHERE cpd_original='.$ID_cpd.' order by cpd_copia DESC limit 0,1'; 
                                    $result_comprobantes_datos     = mysql_query($sql_comprobantes_datos);
                                    @$num_result_comprobantes_datos = mysql_num_rows($result_comprobantes_datos);
                                    if ($num_result_comprobantes_datos>=1) 
                                    {
                              
                                    }
                                    else
                                    {
                                      echo '<tr>';
                                        echo '<th>'.$assoc_get_comprobantes['cte_fec'].'</th>';
                                        echo '<th>'.$assoc_get_comprobantes['cte_numero'].'</th>';
                                        echo '<th>'.$assoc_get_comprobantes['tce_desc'].'</th>';
                                        echo '<th>'.$assoc_get_comprobantes['cte_asociacion'].'</th>';
                                        echo '<th>$ '.$assoc_get_comprobantes['cte_monto'].'</th>';
                                        echo '<th>ORIGINAL</th>';
                                        echo '<th><a href="verComprobantes.php?ID_cte='.$ID_cte.'" target="_blank"><button class="btn btn-info"><i class="material-icons">visibility</i></button></a></th>';
                                        echo '<th><a href="modifComprobantes.php?ID_cte='.$ID_cte.'"><button class="btn btn-primary"><i class="material-icons">edit</i></button></a></th>';
                                        echo '<th><a href="eliminaComprobantes.php?ID_cte='.$ID_cte.'"><button class="btn btn-danger"><i class="material-icons">delete_forever</i></button></a></th>';
                                     echo '</tr>';
                                    }  
                                  }
                                  else
                                  {
                                      $sql_comprobantes_datos   = 'SELECT cpd_copia, ID_cpd FROM comprobantes_datos WHERE cpd_original='.$cpd_original.' order by cpd_copia DESC limit 0,1'; 
                                     $result_comprobantes_datos = mysql_query($sql_comprobantes_datos);
                                      $assoc_result_comprobantes_datos = mysql_fetch_assoc($result_comprobantes_datos);
                                    if ($assoc_result_comprobantes_datos['ID_cpd']==$ID_cpd) 
                                    {
                                        echo '<tr>';
                                        echo '<th>'.$assoc_get_comprobantes['cte_fec'].' - '.$ID_cpd.'</th>';
                                        echo '<th>'.$assoc_get_comprobantes['cte_numero'].'</th>';
                                        echo '<th>'.$assoc_get_comprobantes['tce_desc'].'</th>';
                                        echo '<th>'.$assoc_get_comprobantes['cte_asociacion'].'</th>';
                                        echo '<th>$ '.$assoc_get_comprobantes['cte_monto'].'</th>';
                                        echo '<th> MODIFICADO '.$assoc_result_comprobantes_datos['cpd_copia'].' VECES</th>';
                                        echo '<th><a href="verComprobantes.php?ID_cte='.$ID_cte.'" target="_blank"><button class="btn btn-info"><i class="material-icons">visibility</i></button></a></th>';
                                        echo '<th><a href="modifComprobantes.php?ID_cte='.$ID_cte.'"><button class="btn btn-primary"><i class="material-icons">edit</i></button></a></th>';
                                        echo '<th><a href="eliminaComprobantes.php?ID_cte='.$ID_cte.'"><button class="btn btn-danger"><i class="material-icons">delete_forever</i></button></th>';
                                        echo '</tr>';
                                    }
                                    else
                                    {
                                       
                                    }  

                                      
                                  } 



                         } 

                           echo '</tbody>';
                       echo '</table>';

                       //echo "TOTAL SIN DESCUENTO PORCENTAJE: $". $total_sin_descuento_porcentaje;
                       //echo "<br>";
                       //echo "TOTAL SIN DESCUENTO MONTO: $". $total_sin_descuento_monto;
                       //echo "<br>";
                       
                       $total_sin_descuentos=$total_sin_descuento_porcentaje+$total_sin_descuento_monto;
                      
                       $total_descuentos_en_pesos=$total_descuento_porcentaje+$total_descuento_monto;
                   
                       $total_resto=$total_sin_descuentos-$total_descuentos_en_pesos;

                   echo '<div class="alert alert-dismissible alert-info">
                          <h4><strong>TOTAL GRABADO:</strong> $ '.$grabado_total.'</h4>
                        </div>';     
                             
                  echo '<div class="alert alert-dismissible alert-success">
                          <h4><strong>TOTAL COMPRADO:</strong> $ '.$total_sin_descuentos.'</h4>
                        </div>';     
                       
                  echo '<div class="alert alert-dismissible alert-danger">
                          <h4><strong>TOTAL DESCUENTOS:</strong> $ '.$total_descuentos_en_pesos.'</h4>
                        </div>';

                  echo '<div class="alert alert-dismissible alert-success">
                          <h3><strong>TOTAL:</strong> $ '.$total_resto.'</h3>
                        </div>';

                                }
                          else
                          {
                          echo '<div class="alert alert-dismissible alert-warning">
                                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                                  <h4 class="alert-heading"><i class="material-icons">sentiment_dissatisfied</i>
                                  No se encontraron Registros</h4>
                                </div>';
                          }

?>
              <script type='text/javascript'>

                $(document).ready( function () {
                $('#listadoComprobantes').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'print',
                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            download: 'open'
                        }
                    ],
                    responsive: true,
                   
                });
                });

                 </script>
              