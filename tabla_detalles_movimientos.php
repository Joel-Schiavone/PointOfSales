<?php 
session_start();
include_once('inc/conectar.php');
include_once('inc/classes.php');
include_once('inc/classesExclusivas.php');
  $mov_cajaE          = new mov_cajaE;
  $cajaE              = new cajaE;
  $ventaE             = new ventaE;
  $tipos_pagos        = new tipos_pagos;
  $tipos_pagosE       = new tipos_pagosE;
  $tarjetas           = new tarjetas;
  $tarjetas_planesE   = new tarjetas_planesE;
  $usuariosE          = new usuariosE;
  $tarjetas_planes    = new tarjetas_planes;
  $tarjetas_planesE   = new tarjetas_planesE;
  $venta_detalle      = new venta_detalle;
  $venta_detalleE     = new venta_detalleE;
  $puestosE           = new puestosE;
   //Trae la ultima caja abierta por usuario 
$ID_caj=$_POST['ID_caj'];   
   $get_venta_UltimaByIdCaja =$ventaE->get_venta_UltimaByIdCaja($ID_caj);
          $assoc_get_venta_UltimaByIdCaja=mysql_fetch_assoc($get_venta_UltimaByIdCaja);
          $ID_ven    = $assoc_get_venta_UltimaByIdCaja['ID_ven'];
           $descuento=$assoc_get_venta_UltimaByIdCaja['ven_descuento'];
 $get_mov_caja=$mov_cajaE->get_mov_caja($ID_caj, $ID_ven);
             @$num_get_mov_caja=mysql_num_rows($get_mov_caja);

             echo '<div class="col-md-12" style="font-size:10px; ">';
                   echo '<div class="col-md-1">';
                    echo 'CANTIDAD';
                   echo '</div>';
                    echo '<div class="col-md-4">';
                    echo 'DESCRIPCIÓN';
                   echo '</div>';
                    echo '<div class="col-md-1">';
                    echo 'NETO';
                   echo '</div>';
                    echo '<div class="col-md-1">';
                   echo 'SUB-TOTAL';
                   echo '</div>';
                    echo '<div class="col-md-1">';
                    echo 'ALICUOTA';
                   echo '</div>';
                    echo '<div class="col-md-1">';
                    echo 'DESCUENTO';
                   echo '</div>';
                     echo '<div class="col-md-1">';
                        echo 'TOTAL';
                   echo '</div>';
                   echo '<div class="col-md-1">';
                      echo 'ELIMINAR';
                    echo '</div>';       
                   echo '<div class="col-md-1">';       
                      echo 'DESCUENTO';
                   echo '</div>';
                echo '</div>';    

             for ($CountMov=0; $CountMov < $num_get_mov_caja; $CountMov++) 
             { 
               $assoc_get_mov_caja=mysql_fetch_assoc($get_mov_caja);
                   /* Inicio Modal Descuento por movimiento*/                          
                  echo '<div class="modal fade" id="botonDescuento'.$assoc_get_mov_caja['ID_mov'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                               <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" id="myModalLabel">Descuento de movimiento</h4>
                                </div>
                                <div class="modal-body">';

                                  if ($_SESSION['usu_descuento']=='1') 
                                  {
                                    $display='block';
                                     $displayB='none';
                                  }
                                  else 
                                  {
                                    $display='none';
                                    $displayB='block';
                                  }

                                  echo "<div style='display:".$displayB."'>
                                   <div class='form-group'>
                                      <label for='pto_asig'>Se requiere Clave de Administrador </label>
                                       <div class='input-group'>
                                       <span class='input-group-addon'><i class='material-icons'>vpn_key</i></span>
                                      <input type='password' class='form-control' id='llaveAdmin".$assoc_get_mov_caja['ID_mov']."' name='llaveAdmin".$assoc_get_mov_caja['ID_mov']."' placeholder='Se requiere Clave de Administrador'></input>
                                      </div>
                                      </div> 
                                   <div class='form-group'>
                                  <button class='btn btn-success' id='confimaLlave".$assoc_get_mov_caja['ID_mov']."'><i class='material-icons'>done</i> Confirmar</button>
                                    </div>
                                  </div>";

                               echo ' <div id="cartelClaveCorrecta'.$assoc_get_mov_caja['ID_mov'].'" class="alert alert-dismissible alert-success" style="display:none;">
                                                                <i class="material-icons">done_all</i> Autorizado
                                                              </div>
                                     <div id="cartelErrorClave'.$assoc_get_mov_caja['ID_mov'].'" class="alert alert-dismissible alert-danger" style="display:none;">
                                                                <i class="material-icons">error_outline</i> Clave incorrecta
                                                            </div>';
                                echo ' <div id="formularioDescuentos'.$assoc_get_mov_caja['ID_mov'].'" style="display:'.$display.';">
                                    
                                    <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <label for="pto_asig">Ingrese en porcentaje el descuento que desea aplicar a este movimiento </label>
                                       <div class="input-group">
                                       <span class="input-group-addon">%</span>
                                      <input type="text" name="mov_descuento" placeholder="0" class="form-control">
                                      </div>
                                      <input hidden type="text" name="action" value="aplicarDescuentoMovimiento">
                                      <input hidden type="text" name="ID_mov" value="'.$assoc_get_mov_caja['ID_mov'].'">
                                      <input hidden type="text" name="mov_cantidad" value="'.$assoc_get_mov_caja['mov_cantidad'].'">
                                         <input hidden type="text" name="ID_ven" value="'.$ID_ven.'">
                                    </div>
                                       <button class="btn btn-success" type="submit" style="width:100%;"><i class="material-icons">get_app</i> Aplicar</button>
                                </div>
                                  </form>
                                  </div>';

                                     echo "<script>
                                          $('#confimaLlave".$assoc_get_mov_caja['ID_mov']."').click(function(){
                                               var usu_clave =$('#llaveAdmin".$assoc_get_mov_caja['ID_mov']."').val();
                                                  var dataString = 'usu_clave='+usu_clave;
                                              $.ajax(
                                              {
                                                  type: 'POST',
                                                  url: 'verificadorDeClaveAdmin.php',
                                                  data: dataString,
                                                  success: function(datas)
                                                   {

                                                      if(datas==1)
                                                        {
                                                             $('#cartelClaveCorrecta".$assoc_get_mov_caja['ID_mov']."').fadeIn(1000);  
                                                            $('#formularioDescuentos".$assoc_get_mov_caja['ID_mov']."').fadeIn(1000)('display', 'block');    
                                                             $('#cartelErrorClave".$assoc_get_mov_caja['ID_mov']."').fadeOut(1000);               
                                                        }            
                                                        else 
                                                        {
                                                          $('#cartelErrorClave".$assoc_get_mov_caja['ID_mov']."').fadeIn(1000);
                                                            $('#cartelClaveCorrecta".$assoc_get_mov_caja['ID_mov']."').fadeOut(1000);  
                                                        }  

                                                   }
                                               });
                                           });
                                        </script>";
                               echo '</div>
                                <div class="modal-footer">
                              </div>
                            </div>
                          </div>';
                      /* Fin Modal Descuento por movimiento */


               echo '<div class="col-md-12" id="recuadrosB">';
                   echo '<div class="col-md-1">';
                    echo  $assoc_get_mov_caja['mov_cantidad'] . $assoc_get_mov_caja['art_unidad'];
                   echo '</div>';
                    echo '<div class="col-md-4">';
                    echo $assoc_get_mov_caja['art_desc'];
                   echo '</div>';
                    echo '<div class="col-md-1">';
                    echo  "$".$assoc_get_mov_caja['pre_cant'];
                   echo '</div>';
                    echo '<div class="col-md-1">';
                     echo  "$".$assoc_get_mov_caja['multiplicacion'];
                   echo '</div>';
                    echo '<div class="col-md-1">';
                      echo  "%".$assoc_get_mov_caja['pre_iva'];
                   echo '</div>';
                    echo '<div class="col-md-1">';
                   echo  "%".$assoc_get_mov_caja['mov_descuento'];
                   echo '</div>';
                     echo '<div class="col-md-1">';
                    echo  "$".$assoc_get_mov_caja['mov_sal'];
                   echo '</div>';
                   echo '<div class="col-md-1">';
                    echo '<a href="accionesExclusivas.php?ID_caj='.$ID_caj.'&ID_ven='.$ID_ven.'&ID_art='.$assoc_get_mov_caja['ID_art'].'&action=drop_movimiento&ven_total='.$assoc_get_venta_UltimaByIdCaja['ven_total'].'&multiplicacion='.$assoc_get_mov_caja['mov_sal'].'&mov_cantidad='.$assoc_get_mov_caja['mov_cantidad'].'"><button class="btn btn-danger" id="botonEliminar">
                            <i class="material-icons">delete_forever</i>
                          </button></a>'; 
                    echo '</div>';       
                   echo '<div class="col-md-1">';       
                    echo '<button class="btn btn-info" id="botonDescuento'.$assoc_get_mov_caja['ID_mov'].'" data-toggle="modal" title="APLICAR DESCUENTO" data-placement="top" data-target="#botonDescuento'.$assoc_get_mov_caja['ID_mov'].'">
                            <i class="material-icons">local_offer</i>
                          </button>';    

                   echo '</div>';
                echo '</div>';    

             }
          ?>  
  			</div>
  			<!--Fin: Articulos vendidos detalle-->
<?php
           /* Inicio Modal Descuento por VENTA*/                          
                  echo '<div class="modal fade" id="botonDescuentoVenta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                               <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" id="myModalLabel">Descuento de Venta</h4>
                                </div>
                                <div class="modal-body">';

                                  if ($_SESSION['usu_descuento']=='1') 
                                  {
                                    $displayV='block';
                                     $displayBV='none';
                                  }
                                  else 
                                  {
                                    $displayV='none';
                                    $displayBV='block';
                                  }

                                  echo "<div style='display:".$displayBV."'>
                                   <div class='form-group'>
                                      <label for='pto_asig'>Se requiere Clave de Administrador </label>
                                       <div class='input-group'>
                                       <span class='input-group-addon'><i class='material-icons'>vpn_key</i></span>
                                      <input type='password' class='form-control' id='llaveAdminVenta' name='llaveAdminVenta' placeholder='Se requiere Clave de Administrador'></input>
                                      </div>
                                      </div> 
                                   <div class='form-group'>
                                  <button class='btn btn-success' id='confimaLlaveVenta'><i class='material-icons'>done</i> Confirmar</button>
                                    </div>
                                  </div>";

                               echo ' <div id="cartelClaveCorrectaVenta" class="alert alert-dismissible alert-success" style="display:none;">
                                                                <i class="material-icons">done_all</i> Autorizado
                                                              </div>
                                     <div id="cartelErrorClaveVenta" class="alert alert-dismissible alert-danger" style="display:none;">
                                                                <i class="material-icons">error_outline</i> Clave incorrecta
                                                            </div>';
                                echo ' <div id="formularioDescuentosVenta" style="display:'.$displayV.';">
                                    
                                    <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <label for="pto_asig">Ingrese en porcentaje el descuento que desea aplicar a esta venta </label>
                                       <div class="input-group">
                                       <span class="input-group-addon">%</span>
                                      <input type="text" name="ven_descuento" placeholder="0" class="form-control">
                                      </div>
                                      <input hidden type="text" name="action" value="aplicarDescuentoVenta">
                                      <input hidden type="text" name="ID_ven" value="'.$ID_ven.'">
                                    </div>
                                       <button class="btn btn-success" type="submit" style="width:100%;"><i class="material-icons">get_app</i> Aplicar</button>
                                </div>
                                  </form>
                                  </div>';

                                     echo "<script>
                                          $('#confimaLlaveVenta').click(function(){
                                               var usu_clave =$('#llaveAdminVenta').val();
                                                  var dataString = 'usu_clave='+usu_clave;
                                              $.ajax(
                                              {
                                                  type: 'POST',
                                                  url: 'verificadorDeClaveAdmin.php',
                                                  data: dataString,
                                                  success: function(datasB)
                                                   {
                                                      if(datasB==1)
                                                        {
                                                             $('#cartelClaveCorrectaVenta').fadeIn(1000);  
                                                            $('#formularioDescuentosVenta').fadeIn(1000)('display', 'block');    
                                                             $('#cartelErrorClaveVenta').fadeOut(1000);               
                                                        }            
                                                        else 
                                                        {
                                                          $('#cartelErrorClaveVenta').fadeIn(1000);
                                                            $('#cartelClaveCorrectaVenta').fadeOut(1000);  
                                                        }  
                                                   }
                                               });
                                           });
                                        </script>";
                               echo '</div>
                                <div class="modal-footer">
                              </div>
                            </div>
                          </div>';
                      /* Fin Modal Descuento por VENTA */
?>
