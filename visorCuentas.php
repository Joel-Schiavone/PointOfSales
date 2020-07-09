	<!--Inicio: Documentos requeridos -->
 <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<!--<script src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>-->

<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>    

<?php
include_once('inc/conectar.php');
include_once('inc/classes.php');
include_once('inc/classesExclusivas.php');
  $_SESSION['actionsBack']= $_SERVER['REQUEST_URI'];
  $cuentas      = new cuentas;
  $cuentasE     = new cuentasE;
  $cuentas_tipo = new cuentas_tipo;
  $cuentas_movimientosE  = new cuentas_movimientosE;
 
  $ID_cue=$_POST['ID_cue'];

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
  $FechayHora             = date("Y-m-d H:i:s");
 ?>

      <table id="listadoCuentas" class="table table-striped table-bordered" cellspacing="0" width="100%">

     
                <thead>
                    <tr>
                        <th>CUENTA</th>
                        <th>FECHA</th>
                        <th>MOVIMIENTO</th>
                        <th>DÉBITO</th>
                        <th>CRÉDITO</th>
                        <th>DETALLE</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>CUENTA</th>
                        <th>FECHA</th>
                        <th>MOVIMIENTO</th>
                        <th>DÉBITO</th>
                        <th>CRÉDITO</th>
                        <th>DETALLE</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php

                      if ($_POST['extra']=='acreditacionesPendiente') 
                      {
                        $get_cuentas=$cuentas_movimientosE->get_cuentas_movimientosByFechaPendientes();
                      }
                      else
                      {
                          if ($ID_cue==0) 
                        {
                          $get_cuentas=$cuentas_movimientosE->get_cuentas_movimientosByFecha($fecDesde, $fecHasta);
                        }
                        else
                        {
                          $get_cuentas=$cuentas_movimientosE->get_cuentas_movimientosByIdCueByFecha($ID_cue, $fecDesde, $fecHasta);
                        }  
                      }  
                      
                          
                          $num_get_cuentas=mysql_num_rows($get_cuentas);
                          for ($CountCuentas=0; $CountCuentas < $num_get_cuentas; $CountCuentas++) 
                          { 
                              $assoc_get_cuentas=mysql_fetch_assoc($get_cuentas);
                              $ID_cue=$assoc_get_cuentas['ID_cue'];
                              $ID_mcs=$assoc_get_cuentas['ID_mcs'];

                              if ($assoc_get_cuentas['mdc_fecDisponibilidad']<=$FechayHora) 
                              {
                                $mdc_fecDisponibilidad="";
                              }
                              else
                              {
                                $mdc_fecDisponibilidad="El monto estara disponible el dia".$assoc_get_cuentas['mdc_fecDisponibilidad'];
                              }  

                              if ($assoc_get_cuentas['mcs_debito']==0) 
                              {
                                $optionSelected=1;
                                $optionDesc="Cédito";
                                $monto=$assoc_get_cuentas['mcs_credito'];
                              }
                              else
                              {
                                $optionSelected=2;
                                $optionDesc="Débito";
                                $monto=$assoc_get_cuentas['mcs_debito'];
                              }  

                              $fechaNuevaEditable=strftime('%Y-%m-%dT%H:%M:%S', strtotime($assoc_get_cuentas['mcd_fec']));

                             /* Inicio Modal modioficaCuenta */         
                                           
                            echo '<div class="modal fade" id="editaMovimientoCuenta'.$ID_mcs.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="material-icons">mode_edit</i> Modificar Movimiento de la cuenta</h4>
                                          </div>
                                          <div class="modal-body">
                                              <form id="CreateForm'.$ID_mcs.'" name="CreateForm'.$ID_mcs.'" action="accionesCuentasMovimientos.php" method="post">
                                              
                                                    <legend>Datos del movimiento</legend>
                                                        <input hidden type="text" name="action" value="editarMovimiento" form="CreateForm'.$ID_mcs.'">
                                                        <input hidden type="text" name="ID_mcs" value="'.$ID_mcs.'" form="CreateForm'.$ID_mcs.'"> 

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Cuenta</label>

                                                            <select name="ID_cue" class="form-control"  form="CreateForm'.$ID_mcs.'">
                                                                  <option value="'.$assoc_get_cuentas['ID_cue'].'">'.$assoc_get_cuentas['cue_desc'].'</option>';
                                                                  $get_cuentasB=$cuentasE->get_cuentas();
                                                                  $num_get_cuentasB=mysql_num_rows($get_cuentasB);
                                                                  for ($CountCuentasB=0; $CountCuentasB < $num_get_cuentasB; $CountCuentasB++) 
                                                                  { 
                                                                      $assoc_get_cuentasB=mysql_fetch_assoc($get_cuentasB);
                                                                      echo "<option value='".$assoc_get_cuentasB['ID_cue']."'>".$assoc_get_cuentasB['cue_desc']."</option>";
                                                                  }
                                                              
                                                                
                                                            echo '</select>
                                                        </div>
                                                        
                                                        
                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Fecha</label>
                                                          <input type="datetime-local" class="form-control" name="mcd_fec" id="mcd_fec'.$ID_mcs.'" value="'.$fechaNuevaEditable.'" form="CreateForm'.$ID_mcs.'">
                                                        </div>


                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Descripción</label>
                                                          <input type="text" class="form-control" name="mcs_movimiento" id="mcs_movimiento'.$ID_mcs.'" placeholder="Descripción del Movimiento" value="'.$assoc_get_cuentas['mcs_movimiento'].'" form="CreateForm'.$ID_mcs.'">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Tipo de Movimiento</label>
                                                            <select name="tipoMovimeinto" class="form-control" form="CreateForm'.$ID_mcs.'"> 
                                                                <option value="'.$optionSelected.'">'.$optionDesc.'</option>';
                                                                if ($optionSelected==1) 
                                                                {
                                                                  echo '<option value="2">Débito</option>';
                                                                }
                                                                else
                                                                {
                                                                  echo '<option value="1">Cédito</option>';
                                                                }  
                                                                
                                                             echo '</select>
                                                        </div>
                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Monto</label>
                                                          <input type="text" class="form-control" id="monto'.$ID_mcs.'" name="monto" placeholder="00.00" value="'.$monto.'" form="CreateForm'.$ID_mcs.'">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Observación</label>
                                                          <textarea class="form-control" name="mcs_desc" id="mcs_desc'.$ID_mcs.'" form="CreateForm'.$ID_mcs.'">'. $assoc_get_cuentas['mcs_desc'].' '.$mdc_fecDisponibilidad.'</textarea>
                                                        </div>

                                                         <button type="submit" class="btn btn-success" form="CreateForm'.$ID_mcs.'"><i class="material-icons">save</i> GUARDAR</button>

                                                       

                                            </form>
                                          </div>
                                          <div class="modal-footer">
                                            
                                          </div>
                                        </div>
                                      </div>
                                    </div>';
                                /* Fin Modal modioficaCuenta */


                                   /* Inicio Modal elimina cuenta */                       
                            echo '<div class="modal fade" id="eliminaCuenta'.$ID_mcs.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document" style="width:90%;">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="material-icons">delete_forever</i> ELIMINAR REGISTRO</h4>
                                          </div>
                                          <div class="modal-body">
                                              <div class="alert alert-danger" role="alert">
                                                            <h5><i class="material-icons">warning</i> CUIDADO !!!</h5>
                                                            <p> Usted esta a punto de eliminar el registro</p>
                                                           
                                                           
                                                        </div>      
                                            </div>
                                          <div class="modal-footer">
                                            <a href="accionesCuentasMovimientos.php?ID_mcs='.$assoc_get_cuentas['ID_mcs'].'&action=dropMovimientos"><button class="btn btn-success">Eliminar registro !</button></a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>';
                                /* Fin Modal elimina cuenta */ 

                            echo "<tr>";
                                echo "<th>".$assoc_get_cuentas['cue_desc']."</th>";
                                echo "<th>".$assoc_get_cuentas['mcd_fec']."</th>";
                                echo "<th>".$assoc_get_cuentas['mcs_movimiento']."</th>";
                                echo "<th>$ ".$assoc_get_cuentas['mcs_debito']."</th>";
                                echo "<th>$ ".$assoc_get_cuentas['mcs_credito']."</th>";
                                echo "<th>".$assoc_get_cuentas['mcs_desc']."</th>";
                            
                                echo "<th><button data-toggle='modal' title='Modificar datos de la cuenta' data-placement='top' data-target='#editaMovimientoCuenta".$ID_mcs."' class='btn btn-primary'><i class='material-icons'>mode_edit</i></button></th>";
                                echo "<th><button data-toggle='modal' title='Eliminar Cuenta' data-placement='top' data-target='#eliminaCuenta".$ID_mcs."' class='btn btn-danger'><i class='material-icons'>delete_forever</i></button></th>";
                            echo "</tr>";
                        }

                     ?>

                </tbody>
            </table>

          <script type='text/javascript'>

                $(document).ready( function () {
                $('#listadoCuentas').DataTable({
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
                 