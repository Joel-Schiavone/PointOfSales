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
  $proveedores            = new proveedores;
  $clientes               = new clientes;
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
                          $get_comprobantes=$comprobantesE->get_comprobantesByFecha($fecDesde, $fecHasta);
                        }
                        else
                        {
                          $get_comprobantes=$comprobantesE->get_comprobantesByIdCueByFecha($ID_tceB, $fecDesde, $fecHasta);
                        }  
                        if ($get_comprobantes) 
                        {
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
                              $ID_asociado=$assoc_get_comprobantes['cte_asociacion'];
                              $ID_fce = $assoc_get_comprobantes['ID_fce'];
                              if ($ID_fce==1) //flujo compras
                              {
                                $ID_pro=$ID_asociado;
                                $get_proveedoresById=$proveedores->get_proveedoresById($ID_pro);
                                $assoc_get_proveedoresById=mysql_fetch_assoc($get_proveedoresById);
                                $cliente_proveedor=$assoc_get_proveedoresById['pro_desc'];
                              }

                              if ($ID_fce==2) //flujo ventas
                              {
                                $ID_cli=$ID_asociado;
                                $get_clientesById=$clientes->get_clientesById($ID_cli);
                                $assoc_get_clientesById=mysql_fetch_assoc($get_clientesById);
                                $cliente_proveedor=$assoc_get_clientesById['cli_apellido']." ".$assoc_get_clientesById['cli_apellido'];
                              }

                              

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
                                        echo '<th>'.$cliente_proveedor.'</th>';
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
              