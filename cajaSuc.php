<!--Inicio: Documentos requeridos -->
<?php
	include_once("inc/requeridoSinCarga.php"); 
  include_once("inc/validacion.php"); 
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
          $get_caja_UltimaByUsu =$cajaE->get_caja_UltimaByUsu($ID_usu);
          $assoc_get_caja_UltimaByUsu=mysql_fetch_assoc($get_caja_UltimaByUsu);
          $ID_caj=$assoc_get_caja_UltimaByUsu['ID_caj'];
          $get_venta_UltimaByIdCaja =$ventaE->get_venta_UltimaByIdCaja($ID_caj);
          $assoc_get_venta_UltimaByIdCaja=mysql_fetch_assoc($get_venta_UltimaByIdCaja);
          $ID_ven    = $assoc_get_venta_UltimaByIdCaja['ID_ven'];

  $ID_pue=$_SESSION['PUESTO'];
  $get_puestosByIdB=$puestosE->get_puestosByIdB($ID_pue);
  $assoc_get_puestosByIdB=mysql_fetch_assoc($get_puestosByIdB);
?>
<!--Fin: Documentos requeridos -->
<!--Inicio: classes -->
<style type="text/css">
  .no-borderDanger {
    border: 0;
    box-shadow: none; /* You may want to include this as bootstrap applies these styles too */
    width: 10%;
    background-color: #f2dede;
    text-align: center; 
}
.no-borderSuccess{
    border: 0;
    box-shadow: none; /* You may want to include this as bootstrap applies these styles too */
    width: 10%;
    background-color: #dff0d8;
    text-align: center; 
}
</style>
<!--Fin: classes -->
<!--Inicio: Contenedor principal -->
<div class="container-fluid" id="NoImprimir">

  <!--Inicio: contenedor superior--> 	
   <div class="col-md-12">
        <i class="material-icons">account_circle</i> Usuario: <?php echo $_SESSION['usu_nombre']." ".$_SESSION['usu_apellido'];?> -
        <i class="material-icons">print</i> Punto de venta: <?php echo $assoc_get_puestosByIdB['pdv_puntoVenta']; ?> -
        <i class="material-icons">store</i> Sucursal: <?php echo $assoc_get_puestosByIdB['suc_desc']; ?> -
        <i class="material-icons">account_balance_wallet</i> Cuenta Efectivo: <?php echo $assoc_get_puestosByIdB['cue_desc']; ?> -
        <i class="material-icons">shopping_cart</i> Puesto: <?php echo $assoc_get_puestosByIdB['pue_desc']; ?>
   </div>   
  <div class="col-md-12" id="recuadros">
      <!--Inicio: Input Cantidad--> 
      <div class="col-md-1">
       <input type="text" name="get_cantidad" id="get_cantidad" class="form-control" value="1">
       <input hidden type="text" name="ID_ven" id="ID_ven" value="<?php echo $ID_ven;?>">
      </div>
      <!--Fin: Input Cantidad-->
      
  		<!--Inicio: Barra buscadora--> 
	  	<div class="col-md-8" >
	  		<input type="text" name="get_articulos" id="get_articulos" class="form-control" placeholder="Buscar Articulo" autofocus="autofocus">
        <div id='suggestions' class='suggestions'></div>
	  	</div>
	  	<!--Fin: Barra buscadora--> 
	  
	  	<!--Inicio: Boton cerrar caja-->
	  	<div class="col-md-2" >
        <button class="btn btn-primary" data-toggle='modal' title='Cerrar Caja' data-placement='top' data-target='#CerrarCaja'><i class="material-icons">swap_vert</i> Cerrar Caja</button>
	  	</div>
	  	<!--Fin: Input Cantidad-->
      <!--Inicio: Boton cerrar caja-->
      <div class="col-md-1" >
        <button class="btn btn-primary" title='Imprimir Venta Anterior' data-toggle='modal'  data-placement='top' data-target='#ImprimirAnterior'><i class="material-icons">print</i></button>
            </script>
      </div>
      <!--Inicio: Boton cerrar caja-->
      
    

  </div>
  <!--Fin: contenedor superior-->
  <!--Inicio: contenedor medio-->  
  <div class="col-md-12" id="recuadros">
  		<!--Inicio: Articulos vendidos--> 
  		<div class="col-md-8">
  			<!--Inicio: Articulos vendidos detalle--> 
  			<div class="col-md-12">
          <?php
         
    /* Inicio Modal Cierre Caja */                          
    echo '<div class="modal fade" id="CerrarCaja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Cerrar Caja</h4>
                  </div>
                  <div class="modal-body">
                    <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="pto_asig">Ingrese Gatos</label>
                      <input type="text" name="caj_cierre" placeholder="00.00" class="form-control">
                      <input hidden type="text" name="action" value="cerrarCaja">
                      <input hidden type="text" name="ID_caj" value="'.$ID_caj.'">
                    </div>

                       <div class="form-group">
                          <label>Adjunte Comprobantes de Gastos</label>
                         
                                  <input class="form-control" name="adj_ruta[]" type="file" multiple>
                             
                        
                      </div>

                    
                    <div class="form-group">
                      <label for="pto_asig">Ingrese Efectivo</label>
                      <input type="text" name="caj_efectivo" id="caj_efectivo" placeholder="00.00" class="form-control" required>
                    </div>';

                    $get_caja_totalEfectivo=$cajaE->get_caja_totalEfectivo($ID_caj);
                    $assoc_get_caja_totalEfectivo=mysql_fetch_assoc($get_caja_totalEfectivo);
                    $totalEfectivo=$assoc_get_caja_totalEfectivo['TotalEfectivo'];

                    if ($_SESSION['usu_sobrantes']==1)
                    {
                      echo '<div class="alert alert-dismissible alert-info">
                              <strong><i class="material-icons">attach_money</i> Efectivo que deberia haber en caja $'.$totalEfectivo.'</strong>
                            </div>';

                             echo '<div id="sobrante" class="alert alert-dismissible alert-success" style="display:none">
                              <strong><i class="material-icons">thumb_up</i> Se registran $ <input type="text" class="no-borderSuccess" id="inputsobrante"> Sobrantes en caja</strong>
                            </div>';

                            echo '<div id="faltante" class="alert alert-dismissible alert-danger" style="display:none">
                              <strong><i class="material-icons">thumb_down</i> Se registran $ <input type="text" class="no-borderDanger" id="inputfaltante">Faltantes en caja</strong>
                            </div>';

                              echo '<div id="cero" class="alert alert-dismissible alert-warning" style="display:none">
                              <strong><i class="material-icons">thumb_up</i>Felicidades! La caja no registra faltantes ni sobrantes. </strong>
                            </div>';

                            echo "<script>
                                    $('#caj_efectivo').keyup(function(){
                                      var efectivoReal=$('#caj_efectivo').val();
                                      var totalEfectivo=".$totalEfectivo.";
                                      var restaEfectivoCaja=efectivoReal-totalEfectivo;
                                      if(restaEfectivoCaja==0)
                                      {
                                        $('#cero').fadeIn('500');
                                      }
                                      else
                                      {
                                        $('#cero').fadeOut('500');
                                      } 
                                        if(restaEfectivoCaja>=1)
                                      {
                                        $('#sobrante').fadeIn('500');
                                        $('#inputsobrante').val(restaEfectivoCaja);
                                      }
                                      else
                                      {
                                        $('#sobrante').fadeOut('500');
                                      }  
                                        if(restaEfectivoCaja<=-1)
                                      {
                                        $('#faltante').fadeIn('500');
                                        $('#inputfaltante').val(restaEfectivoCaja);
                                      }
                                      else
                                      {
                                        $('#faltante').fadeOut('500');
                                      }    
                                    });
                              </script>";
                    }


                    
            echo '</div>
                  <div class="modal-footer">
                    <button class="btn btn-success" type="submit" style="width:100%;"><i class="material-icons" style="vertical-align: middle">assignment_ind</i> Cerrar</button>
                  </div>
                    </form>
                </div>
              </div>
            </div>';
        /* Fin Modal Cierre Caja */

            $get_mov_caja=$mov_cajaE->get_mov_caja($ID_caj, $ID_ven);
             @$num_get_mov_caja=mysql_num_rows($get_mov_caja);

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
                    echo '<div class="col-md-2">';
                    echo  "$".$assoc_get_mov_caja['pre_cant'];
                   echo '</div>';
                    echo '<div class="col-md-1">';
                    echo  "$".$assoc_get_mov_caja['multiplicacion'];
                   echo '</div>';
                    echo '<div class="col-md-1">';
                   echo  "%".$assoc_get_mov_caja['mov_descuento'];
                   echo '</div>';
                     echo '<div class="col-md-1">';
                    echo  "$".$assoc_get_mov_caja['mov_sal'];
                   echo '</div>';
                   echo '<div class="col-md-1">';
                    echo '<a href="accionesExclusivas.php?ID_caj='.$ID_caj.'&ID_ven='.$ID_ven.'&ID_art='.$assoc_get_mov_caja['ID_art'].'&action=drop_movimiento&ven_total='.$assoc_get_venta_UltimaByIdCaja['ven_total'].'&multiplicacion='.$assoc_get_mov_caja['multiplicacion'].'&mov_cantidad='.$assoc_get_mov_caja['mov_cantidad'].'"><button class="btn btn-danger" id="botonEliminar">
                            <i class="material-icons">delete_forever</i>
                          </button></a>'; 
                    echo '</div>';       
                   echo '<div class="col-md-1">';       
                    echo '<button class="btn btn-info" id="botonDescuento'.$assoc_get_mov_caja['ID_mov'].'" data-toggle="modal" title="Cerrar Caja" data-placement="top" data-target="#botonDescuento'.$assoc_get_mov_caja['ID_mov'].'">
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

  			<!--Inicio: Articulos vendidos totales--> 
  			<div class="col-md-12" id="recuadrosC">
  				<!--Inicio: Articulos vendidos total--> 
  				<div class="col-md-4" style="text-align: left; border-right: 1px solid #000">
          TOTAL: 
  				</div>
  				<!--Fin: Articulos vendidos total-->
  				<!--Inicio: Articulos vendidos monto total-->
  				<div class="col-md-2" style="text-align: center;">
            <?php 
              //sin descuento
              $get_mov_cajaByIdVenZ = $mov_cajaE->get_mov_cajaByIdVen($ID_ven);
              $num_get_mov_cajaByIdVenZ = mysql_num_rows($get_mov_cajaByIdVenZ);
              $totalSinDescuentoAZ=0;
              for ($countZ=0; $countZ < $num_get_mov_cajaByIdVenZ; $countZ++) 
              { 
                $assoc_get_mov_cajaByIdVenZ = mysql_fetch_assoc($get_mov_cajaByIdVenZ);
                $totalSinDescuentoAZ=$assoc_get_mov_cajaByIdVenZ['mov_sal']+$totalSinDescuentoAZ;
              }
                  echo "$ ".$totalSinDescuentoAZ; 
               
            ?>
  				</div>
          <div class="col-md-2" style="text-align: center;">
            <?php 
              echo "% ".$assoc_get_venta_UltimaByIdCaja['ven_descuento']; 
                $descuento=$assoc_get_venta_UltimaByIdCaja['ven_descuento'];
            ?>
          </div>
            <div class="col-md-2" style="text-align: center;">
            <?php 
              echo "$ ".$assoc_get_venta_UltimaByIdCaja['ven_total']; 
            ?>
          </div>
          <div class="col-md-2" style="text-align: center;">
           <button class="btn btn-primary" d="botonDescuentoVenta" data-toggle="modal" title="Aplicar descuento al total de la venta" data-placement="top" data-target="#botonDescuentoVenta">
               <i class="material-icons">local_offer</i>
             </button>      
  				<!--Fin: Articulos vendidos monto total-->
  			</div>
        </div>
  			<!--Fin: Articulos vendidos totales--> 
	  	</div>
	  	<!--Fin: Articulos vendidos--> 
	  	<!--Inicio: cuadro de acciones-->
     
	  	<div class="col-md-4" id="recuadrosC">
         <?php 
        if ($totalSinDescuentoAZ!=0) 
        {
          ?>
            <div class="col-md-12" style="border-bottom:2px solid #333;">
              <form action='accionesExclusivas.php' method='POST'>
                  <!--Accion-->
                  <input hidden type="text" name="action" value="InsertMovimientosVentas">
                   <!--Total de la venta-->
                  <input hidden type="text" name="VentaTotal" value="<?php echo $assoc_get_venta_UltimaByIdCaja['ven_total'];?>">
                  <!--ID de la venta-->
                  <input hidden type="text" name="ID_ven" value="<?php echo $ID_ven;?>">


                <!--Remodifica el maximo permitido segun el restando que va quedando en el input-->
                <?php 
                      $get_venta_detalleSumatoria=$venta_detalleE->get_venta_detalleSumatoria($ID_ven);
                      $assoc_get_venta_detalleSumatoria=mysql_fetch_assoc($get_venta_detalleSumatoria);
                      if ($assoc_get_venta_detalleSumatoria['resto']!=NULL) 
                      {
                        
                        $resto=$assoc_get_venta_UltimaByIdCaja['ven_total']-$assoc_get_venta_detalleSumatoria['resto'];
                      }
                      else
                      {
                        $resto=$assoc_get_venta_UltimaByIdCaja['ven_total'];
                      }  
                ?>
  

                <div id="montoApagarInput" class="col-md-6">
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">$</span>
                            <input type="number" id='montoTotal' name='montoTotal' class='form-control' min="1" max="<?php echo $resto;?>" value="<?php echo $assoc_get_venta_UltimaByIdCaja['ven_total'];?>" step=".01" style="width:100%;">
                        </div>
                      </div>
                </div>  

                 <div id="montoApagarSelect" class="col-md-6">
                          <select class='form-control' name='FormaDePago' id='FormaDePago'>
                            <?php
                              $get_tipos_pagos=$tipos_pagosE->get_tipos_pagos();
                              $num_get_tipos_pagos=mysql_num_rows($get_tipos_pagos);
                              for ($Countnum_get_tipos_pagos=0; $Countnum_get_tipos_pagos < $num_get_tipos_pagos; $Countnum_get_tipos_pagos++)
                              { 
                                   $assoc_get_tipos_pagos=mysql_fetch_assoc($get_tipos_pagos);

                                   //Aplicar selected prederterminado en select (revisar columna fpo_selected de tabla tipos_pagos)
                                   if ($assoc_get_tipos_pagos['fpo_selected']==1) 
                                   {
                                    $selected="selected";
                                    $ID_selected=$assoc_get_tipos_pagos['ID_fpo'];
                                   }
                                   else
                                   {
                                    $selected="";
                                   } 

                                   echo "<option value='".$assoc_get_tipos_pagos['ID_fpo']."' ".$selected.">".$assoc_get_tipos_pagos['ID_desc']."</option>";
                              }

                               
                            ?>
                            <option value="5">PAGOS ELECTRONICOS</option>
                          </select>
                </div>     
             
                <div id="detalleDeVenta" class="col-md-12" style="font-size: 13px;">
                  <?php

                    $get_venta_detalleById=$venta_detalleE->get_venta_detalleById($ID_ven);
                    $num_get_venta_detalleById=mysql_num_rows($get_venta_detalleById);
                    $sumaDeDetallesDeVenta=0;
                    for ($countDetalleDeVenta=0; $countDetalleDeVenta < $num_get_venta_detalleById; $countDetalleDeVenta++) 
                    { 
                      $assoc_get_venta_detalleById=mysql_fetch_assoc($get_venta_detalleById);
                      $ID_vde=$assoc_get_venta_detalleById['ID_vde'];
                      $montoTotalConInteresA=($assoc_get_venta_detalleById['fpo_monto']*$assoc_get_venta_detalleById['tarjeta_pla_recargo'])/100;
                      $montoTotalConInteres=$assoc_get_venta_detalleById['fpo_monto']+$montoTotalConInteresA;
                       echo '<div id="detalleDeVentaIcono'.$ID_vde.'" class="col-md-2">';
                        echo "<p class='text-danger'><i class='material-icons'>". $assoc_get_venta_detalleById['fpo_icono'] ."</i></p>";
                      echo '</div>';  
                      echo '<div id="detalleDeVentaTipo'.$ID_vde.'" class="col-md-4">';
                        echo "<p class='text-danger'>". $assoc_get_venta_detalleById['ID_desc'] ."</p>";
                      echo '</div>';  
                      echo '<div id="detalleDeVentaMonto'.$ID_vde.'" class="col-md-4">';
                        echo "<p class='text-danger'>$ ".$montoTotalConInteres."</p>";
                      echo '</div>';  
                      echo '<div id="detalleDeVentaEliminar'.$ID_vde.'" class="col-md-2" style="cursor:pointer">';
                        echo '<a href="accionesExclusivas.php?action=EliminarDetalleDeVenta&ID_vde='.$ID_vde.'&ID_fpo='.$assoc_get_venta_detalleById['ID_fpo'].'&fpo_monto='.$assoc_get_venta_detalleById['fpo_monto'].'&vde_IDasociado='.$assoc_get_venta_detalleById['vde_IDasociado'].'"><p class="text-danger"><i class="material-icons">delete_forever</i></p></a>';
                       echo '</div>'; 
                         $sumaDeDetallesDeVenta=$sumaDeDetallesDeVenta+$assoc_get_venta_detalleById['fpo_monto'];
                    }

                  ?>
                </div>

  

          <div id="montoApagarSelect" class="col-md-12">

                       
            <?php
                          $totaSinDecimales=round($resto);

                            //EFECTIVO
                              echo '<div id="DivFormaDePago1" class="col-md-12" style="display: none;">';
                                  echo "<br>";
                                    echo  "EFECTIVO";
                                    echo  '<div class="form-group">
                                            <label class="control-label" style="font-size:13px; text-align:left">Calculador de Cambio</label>
                                            <div class="input-group">
                                              <span class="input-group-addon">$</span>
                                              <input type="number" id="CalcularVuelto" name="CalcularVuelto" class="form-control" min="1" value="" step=".01" style="width:100%;">
                                            </div>
                                          </div>';
                                    echo "<div id='suggestionsA1' style='dsplay:none'></div>";
                                    echo "<br>";
                              echo '</div>';

                            //CTA CTE
                              echo '<div id="DivFormaDePago2" class="col-md-12" style="display: none;">';
                                    echo "<br>";
                                    echo  "CUENTA CORRIENTE";
                                    echo '<div class="col-md-12" id="ContenidoB1"> 
                                     <div class="col-md-12"> 
                                        <input type="text" name="get_clientes" id="get_clientes" class="form-control" placeholder="Buscar Clientes" autofocus="autofocus">
                                         <input  hidden type="text" name="ven_totalClientes" id="ven_totalClientes"  value="'.$assoc_get_venta_UltimaByIdCaja['ven_total'].'">
                                         <input  hidden type="text" name="ID_venClientes" id="ID_venClientes" value="<?php echo $ID_ven;?>">
                                          <input  hidden type="text" name="ID_cajClientes" id="ID_cajClientes" value="<?php echo $ID_caj;?>">

                                        <div id="suggestionsClientes" class="suggestions"></div>
                                     </div> 
                             
                                     </div> '; 
                                    echo "<br>";
                              echo '</div>';

                             //CREDITO
                              echo '<div id="DivFormaDePago3" class="col-md-12" style="display: none;">';
                                    echo "<br>";
                                    echo  "CRÉDITO Y DÉBITO";
                                    echo "<br>";
                                    echo '<div class="col-md-12" id="ContenidoC1"> 

                                                      
                                                       <div class="col-md-12">'; 
                                                            $get_tarjetas = $tarjetas->get_tarjetas();
                                                            $num_get_tarjetas = mysql_num_rows($get_tarjetas);
                                                            $ven_total=$resto;
                                                            for ($tarjetasCount=0; $tarjetasCount < $num_get_tarjetas; $tarjetasCount++) 
                                                            { 
                                                               $assoc_get_tarjetas = mysql_fetch_assoc($get_tarjetas); 
                                                               $ImagenTarjeta=$assoc_get_tarjetas['tar_logo'];
                                                              echo "<div class='col-md-6' style='padding:2%;' id='MuestraTarjetas'>";
                                                                 echo "<img src='".$ImagenTarjeta."' style='width:80%;' id='tarjeta".$assoc_get_tarjetas['ID_tar']."'>"; 
                                                              echo "</div>"; 

                                                                  echo "<div class='col-md-12' id='MuestraPlanes".$assoc_get_tarjetas['ID_tar']."' style='display:none; padding:2%;'>"; 
                                                                        $ID_tar=$assoc_get_tarjetas['ID_tar']; 
                                                                          echo "<br>";
                                                                             /*
                                                                             echo $get_tarjetas_planesById = $tarjetas_planesE->get_tarjetas_planesById($ID_tar, $ven_total);
                                                                              */

                                                                             $getPlanesTarjetasByIdTar=$tarjetas_planesE->getPlanesTarjetasByIdTar($ID_tar);
                                                                             $num_getPlanesTarjetasByIdTar=mysql_num_rows($getPlanesTarjetasByIdTar);

                                                                             for ($countPlanes=0; $countPlanes <  $num_getPlanesTarjetasByIdTar; $countPlanes++) 
                                                                             { 
                                                                               $assoc_result_tarjetas_planes=mysql_fetch_assoc($getPlanesTarjetasByIdTar);
                                                                                $ven_total=$ven_total;
                                                                                $pla_cant=$assoc_result_tarjetas_planes['pla_cant'];
                                                                                $recargo=$assoc_result_tarjetas_planes['pla_recargo'];
                                                                                $ID_pla=$assoc_result_tarjetas_planes['ID_pla'];
                                                                                $totalConInteresA=($ven_total*$recargo)/100;
                                                                                $totalConInteres=$ven_total+$totalConInteresA;
                                                                                $totalConInteres=number_format($totalConInteres,2);
                                                                                $valorDeCuotas=$totalConInteres/$pla_cant;
                                                                                $valorDeCuotas=number_format($valorDeCuotas,2);
                                                                                 echo "<div class='col-md-12' style='text-align:left;'>";
                                                                                echo "<p><input type='radio' name='ID_pla' value='".$assoc_result_tarjetas_planes['ID_pla']."'>
                                                                                    ".$assoc_result_tarjetas_planes['pla_desc']." (".$assoc_result_tarjetas_planes['pla_recargo']."%) </p>
                                                                                    <p><h6> Cuotas de $ ".$valorDeCuotas." <h6></p>
                                                                                    <p><h6> Total: $ ".$totalConInteres." <h6></p><hr>";
                                                                                echo "</div>"; 
                                                                             }
                                                                             echo '<br><br><div id="EfectivoTarjeta'.$assoc_result_tarjetas_planes['ID_tar'].'" style="display:none; margin:3%;" class="input-group">
                                                                              <span class="input-group-addon">Monto En Efectivo $</span>
                                                                              <input type="text" name="efectivo" placeholder="00.00" class="form-control">
                                                                          
                                                                            </div>';

                                                                              echo '<input hidden type="text" name="ven_totalTarjeta" id="ven_totalTarjeta"  value="'.$totalConInteres.'">';
                                                                             echo '<input hidden type="text" name="ID_tar" id="ID_tar" value="'.$assoc_get_tarjetas['ID_tar'].'">';
                                                                              
                                                                   echo "</div>";  

                                                               echo "<script>
                                                               $('#tarjeta".$assoc_get_tarjetas['ID_tar']."').click(function(){
                                                                $('#MuestraPlanes".$assoc_get_tarjetas['ID_tar']."').toggle('slow');
                                                               });
                                                               </script>";

                                                            }
                                                  echo '</div> 
                                               
                                                       </div>'; 
                              echo '</div>';  

                            

                              //DEBITO
                              echo '<div id="DivFormaDePago5" class="col-md-12" style="display: none;">';
                                    echo "<br>";
                                    echo  "PAGOS ELECTRONICOS";
                                    echo "<br>";
                                    echo '<div class="alert alert-dismissible alert-info">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong><H4>DISPONIBLES PROXIMAMENTE !</H4></strong>
                                          </div>';
                              echo '</div>';   

                               echo '<script>
                                      $("#FormaDePago").change(function(){
                                        var valorDeFormaDePago = $("#FormaDePago").val();
                                        if(valorDeFormaDePago==1)
                                        {
                                          $("#DivFormaDePago1").fadeIn(500);
                                        }
                                        else
                                        {
                                          $("#DivFormaDePago1").fadeOut(500);
                                        }   

                                        if(valorDeFormaDePago==2)
                                        {
                                          $("#DivFormaDePago2").fadeIn(500);
                                        }
                                        else
                                        {
                                          $("#DivFormaDePago2").fadeOut(500);
                                        }   

                                        if(valorDeFormaDePago==3)
                                        {

                                          $("#DivFormaDePago3").fadeIn(500);
                                            $("#montoTotal").attr("readonly", "readonly");
                                        }
                                        else
                                        {
                                          $("#DivFormaDePago3").fadeOut(500);
                                           $("#montoTotal").removeAttr("readonly", "readonly");
                                        }   

                                        if(valorDeFormaDePago==4)
                                        {
                                          $("#DivFormaDePago4").fadeIn(500);
                                        }
                                        else
                                        {
                                          $("#DivFormaDePago4").fadeOut(500);
                                           
                                        }   

                                        if(valorDeFormaDePago==5)
                                        {
                                          $("#DivFormaDePago5").fadeIn(500);

                                        }
                                        else
                                        {
                                          $("#DivFormaDePago5").fadeOut(500);
                                        }                                           

                                      });
                              </script>';
                          
                                 
                          //SELECCIONADO
                          //Aplicar selected prederterminado en el contenido (revisar columna fpo_selected de tabla tipos_pagos)
                                    echo '<script>
                                            $(document).ready(function(){
                                              var valorDeFormaDePago = '.$ID_selected.';
                                                $("#DivFormaDePago'.$ID_selected.'").fadeIn(500);
                                            });
                                          </script>';  

                           //replicar valor de pago en calculador de vuelto
                                    echo '<script>
                                           $("#montoTotal").keyup(function(){
                                              var montoTotal=$("#montoTotal").val();
                                              $("#CalcularVuelto").val(montoTotal);
                                            });
                                          </script>';  


                            //Cambia el nombre del boton COBRO TOTAL a COBRO PARCIAL SI EL MONTO ES MENOR AL TOTAL DE LA VENTA     
                             echo '<script>
                                            $("#montoTotal").keyup(function(){
                                              var montoTotal = $("#montoTotal").val();
                                             if (montoTotal>="'.$resto.'" || montoTotal>="'.$totaSinDecimales.'") 
                                             {
                                              var textoDeBoton = $("#textoDeBoton").val();
                                              $("#textoDeBoton").text("COBRO TOTAL");
                                             }
                                             else
                                            {
                                              $("#textoDeBoton").text("COBRO PARCIAL");
                                            }
                                      });
                               </script>';

                              //Calcula y muestra el vuelto si la seleccion de pago es Efectivo
                                  echo "<script>$('#CalcularVuelto').keyup(function(){
                                      var MontoEfectivo =$('#CalcularVuelto').val();
                                      var ven_total = ".$resto.";
                                      var action = 'Efectivo';
                                      var dataString = 'MontoEfectivo='+MontoEfectivo + '&action='+action + '&ven_total='+ven_total;
                                      $.ajax({
                                        url: 'accionesExclusivas.php',
                                        type: 'POST',
                                        data: dataString,
                                             success: function(data)
                                             {
                                                $('#suggestionsA1').fadeIn(2000).html(data);
                                             }
                                              })
                                              .done(function(){
                                                 $('#finalizarVentaEfectivo').fadeIn(3000);
                                              })
                                              .fail(function(){
                                                
                                              })
                                              .always(function(){
                                                  
                                              })
                                    }); </script>";
                                       echo "<script>$('#montoTotal').keyup(function(){
                                      var MontoEfectivo =$('#montoTotal').val();
                                      var ven_total = ".$resto.";
                                      var action = 'Efectivo';
                                      var dataString = 'MontoEfectivo='+MontoEfectivo + '&action='+action + '&ven_total='+ven_total;
                                      $.ajax({
                                        url: 'accionesExclusivas.php',
                                        type: 'POST',
                                        data: dataString,
                                             success: function(data)
                                             {
                                                $('#suggestionsA1').fadeIn(2000).html(data);
                                             }
                                              })
                                              .done(function(){
                                                 $('#finalizarVentaEfectivo').fadeIn(3000);
                                              })
                                              .fail(function(){
                                                
                                              })
                                              .always(function(){
                                                  
                                              })
                                    }); </script>";
                                    if ($sumaDeDetallesDeVenta<=$assoc_get_venta_UltimaByIdCaja['ven_total']) 
                        {
                          //Aparece boton guardar venta y desaparece casilla de monto
                          if ($sumaDeDetallesDeVenta==$assoc_get_venta_UltimaByIdCaja['ven_total'])
                          {
                            echo "<script> $(document).ready(function(){
                                                $('#botonGuardarVenta').fadeIn(500);
                                                $('#montoTotal').fadeOut(500);
                                                $('#DivFormaDePago".$ID_selected."').fadeOut(500);
                                                $('#montoApagarSelectBoton').fadeOut(500);
                                              });</script>";
                          }
                          //coloca resto para alcanzar el total de la compra 
                          else
                          {
                             $restoDeDetallesDeVentas=$assoc_get_venta_UltimaByIdCaja['ven_total']-$sumaDeDetallesDeVenta;
                                echo "<script>
                                          $(document).ready(function(){
                                            $('#montoTotal').val(".$restoDeDetallesDeVentas.");
                                            $('#CalcularVuelto').val(".$restoDeDetallesDeVentas.");
                                            this.max = ".$restoDeDetallesDeVentas.";
                                          });
                                </script>";
                          } 
                         
                        }  

                        ?>
  
                      </div>

                   <div id="montoApagarSelectBoton" class="col-md-12" style="margin-top: 5%; ">
                    <div class="form-group">
                         <button type="submit" class="btn btn-success"><p id="textoDeBoton">COBRO TOTAL</p></button>
                      </div>
                </div>
              </form>
            </div>    
           
              <br>
            <div class='col-md-12' style="border-top:2px solid #333;">
              <br>
              <?php 
                 
                  

                echo "<a href='accionesExclusivas.php?ID_ven=".$ID_ven."&action=CerrarVenta&ID_caj=".$ID_caj."&ven_descuento=".$descuento."&ID_pla=".$ID_pla."'>
                        <button class='btn btn-warning' id='botonGuardarVenta' style='display: none;'>
                            <i class='material-icons'>save</i> 
                            GUARDAR VENTA
                        </button>
                    </a>";
              ?>
            </div>
            <?php
      } 
      else
      {
        echo '<div class="well">
                <i class="material-icons">sentiment_neutral</i> Aguardando ventas
              </div>';
      }
      ?>
      </div>
    
   <!--Fin: contenedor medio-->
  </div>
<!--Fin: Contenedor principal -->
<?php
/* Inicio Modal Imprimir */                          
    echo '<div class="modal fade" id="ImprimirAnterior" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 
                  <div class="modal-body">';
                      //Inicio: Contenedor Invisible para imprimir 
                       echo '<div class="container-fluid" id="VentaPenultima">
                             <div class="col-md-12">';
                                $get_venta_penultimaByIdCaja        =   $ventaE->get_venta_penultimaByIdCaja($ID_caj);
                                $assoc_get_venta_penultimaByIdCaja  =   mysql_fetch_assoc($get_venta_penultimaByIdCaja);
                                $ID_venPenultima                    =   $assoc_get_venta_penultimaByIdCaja['ID_ven'];
                                $get_mov_cajaByIdVen                =   $mov_cajaE->get_mov_caja($ID_caj, $ID_venPenultima);
                                $num_get_mov_cajaById               =   mysql_num_rows($get_mov_cajaByIdVen);
                                $totalSuma                          =   0;
                                echo "<table class='table table-striped table-hover' border='0' style='text-align:center; width=100%;'>";
                                  echo "<tr>";
                                    echo "<td>";
                                      echo "<strong>Cant.</strong>";
                                    echo "</td>";
                                    echo "<td>";
                                      echo "<strong>Articulo</strong>";
                                    echo "</td>";
                                    echo "<td>";
                                      echo "<strong>Precio</strong>";
                                    echo "</td>";
                                    echo "<td>";
                                      echo "<strong>Subtotal</strong>";
                                    echo "</td>";
                                  echo "</tr>";
                                for ($countMovi=0; $countMovi < $num_get_mov_cajaById; $countMovi++) 
                                { 
                                  $assoc_get_mov_cajaById           =   mysql_fetch_assoc($get_mov_cajaByIdVen);

                                  echo "<tr>";
                                      echo "<td>";
                                       echo $assoc_get_mov_cajaById['mov_cantidad'];
                                      echo "</td>";
                                      echo "<td>";
                                        echo $assoc_get_mov_cajaById['art_desc'];
                                      echo "</td>";
                                       echo "<td>";
                                        echo "$".$assoc_get_mov_cajaById['pre_cant'];
                                      echo "</td>";
                                      echo "<td>";
                                        echo "$".$assoc_get_mov_cajaById['multiplicacion'];
                                      echo "</td>";
                                  echo "</tr>";
                                  $totalSuma = $assoc_get_mov_cajaById['multiplicacion']+$totalSuma;
                                  echo "<br>";
                                }
                                echo "</table>";

                                 echo "<hr>";
                                echo "<H4 style='text-align:right; margin-right:2%;'>TOTAL: $".$totalSuma."</H4>";

                            echo "</div>
                            </div>";

                              echo '<div class="container-fluid" id="VentaAntePenultima" style="display:none">
                             <div class="col-md-12">';
                                @$get_venta_AntepenultimaByIdCaja        =   $ventaE->get_venta_AntepenultimaByIdCaja($ID_caj);
                                @$assoc_get_venta_AntepenultimaByIdCaja  =   mysql_fetch_assoc($get_venta_AntepenultimaByIdCaja);
                                @$ID_venAntePenultima                    =   $assoc_get_venta_AntepenultimaByIdCaja['ID_ven'];
                                @$get_mov_cajaByIdVenB                   =   $mov_cajaE->get_mov_caja($ID_caj, $ID_venAntePenultima);
                                @$num_get_mov_cajaByIdB                  =   mysql_num_rows($get_mov_cajaByIdVenB);
                                @$totalSumaB                             =   0;
                                echo "<table class='table table-striped table-hover' border='0' style='text-align:center; width=100%;'>";
                                  echo "<tr>";
                                    echo "<td>";
                                      echo "<strong>Cant.</strong>";
                                    echo "</td>";
                                    echo "<td>";
                                      echo "<strong>Articulo</strong>";
                                    echo "</td>";
                                    echo "<td>";
                                      echo "<strong>Precio</strong>";
                                    echo "</td>";
                                    echo "<td>";
                                      echo "<strong>Subtotal</strong>";
                                    echo "</td>";
                                  echo "</tr>";
                                for ($countMoviB=0; $countMoviB < $num_get_mov_cajaByIdB; $countMoviB++) 
                                { 
                                  $assoc_get_mov_cajaByIdB           =   mysql_fetch_assoc($get_mov_cajaByIdVenB);

                                  echo "<tr>";
                                      echo "<td>";
                                       echo $assoc_get_mov_cajaByIdB['mov_cantidad'];
                                      echo "</td>";
                                      echo "<td>";
                                        echo $assoc_get_mov_cajaByIdB['art_desc'];
                                      echo "</td>";
                                       echo "<td>";
                                        echo "$".$assoc_get_mov_cajaByIdB['pre_cant'];
                                      echo "</td>";
                                      echo "<td>";
                                        echo "$".$assoc_get_mov_cajaByIdB['multiplicacion'];
                                      echo "</td>";
                                  echo "</tr>";
                                  $totalSumaB = $assoc_get_mov_cajaByIdB['multiplicacion']+$totalSumaB;
                                  echo "<br>";
                                }
                                echo "</table>";

                                 echo "<hr>";
                                echo "<H4 style='text-align:right; margin-right:2%;'>TOTAL: $".$totalSumaB."</H4>";

                            echo "</div>
                            </div>";


                             //Fin: Contenedor Invisible para imprimir  
              echo '</div>
                  <div class="modal-footer">';
                     
                     if ($num_get_mov_cajaByIdB!=0)
                      {
                        echo '<button class="btn btn-primary" title="Una venta mas Atras" id="otraVenta" style="float:left"><i class="material-icons">arrow_back</i> Venta anterior</button>';

                         echo '<button class="btn btn-primary" title="Una venta mas Atras" id="VuelveVenta" style="float:left; display:none"><i class="material-icons">arrow_forward</i> Venta Siguiente</button>';
                     }

                    echo '<button class="btn btn-success" title="Imprimir Venta Anterior" id="NoImprimir" value="Imprimir" onclick="javascript:window.print()"><i class="material-icons">print</i></button>';
                            echo "<script>
                            $('#otraVenta').click(function(){
                              $('#VentaPenultima').toggle('slow');
                              $('#VentaAntePenultima').toggle('slow');
                              $('#VuelveVenta').toggle('slow');
                              $('#otraVenta').toggle('slow');
                            });
                             $('#VuelveVenta').click(function(){
                              $('#VentaPenultima').toggle('slow');
                              $('#VentaAntePenultima').toggle('slow');
                              $('#VuelveVenta').toggle('slow');
                              $('#otraVenta').toggle('slow');
                            });
                            </script>";
            echo '</div>
                </div>
              </div>
            </div>';
        /* Fin Modal Imprimir */
?>

<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>
<!--Fin: Footer -->
<!--Inicio: script -->

 <script type='text/javascript'>


          $('#get_articulos').keyup(function()
            {
              var get_articulos = $(this).val();   
              var get_cantidad = $('input:text[name=get_cantidad]').val();
              var ID_ven = $('input:text[name=ID_ven]').val();
              var dataString = 'get_articulos='+get_articulos + '&get_cantidad='+get_cantidad + '&ID_ven='+ID_ven;
              $.ajax(
              {
                  type: 'POST',
                  url: 'autocompletadoUniversalArticulos.php',
                  data: dataString,
                  success: function(data)
                   {
                      $('#suggestions').fadeIn(1000).html(data);
                   }
               });
           });

            $('#get_clientes').keyup(function()
            {
              var get_clientes = $(this).val();   
              
              var action = 'Get_clientes';
              var ven_totalClientes = $('input:text[name=ven_totalClientes]').val();
              var ID_venClientes = $('input:text[name=ID_venClientes]').val();
              var ID_cajClientes = $('input:text[name=ID_cajClientes]').val();
              
              var dataString = 'get_clientes='+get_clientes + '&action='+action + '&ven_totalClientes='+ven_totalClientes + '&ID_venClientes='+ID_venClientes + '&ID_caj='+ID_cajClientes;
              $.ajax(
              {
                  type: 'POST',
                  url: 'accionesExclusivas.php',
                  data: dataString,
                  success: function(data)
                   {
                      $('#suggestionsClientes').fadeIn(1000).html(data);
                   }
               });
           }); 


                $('#tipoDePago1').click(function(){
                  $('#ContenidoA1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                });

                $('#tipoDePago2').click(function(){
                  $('#ContenidoB1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                });

                $('#tipoDePago3').click(function(){
                  $('#ContenidoC1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                });

                $('#VolverAprincipal').click(function(){
                  $('#ContenidoA1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                });

                 $('#VolverAprincipalB').click(function(){
                  $('#ContenidoB1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                });

                   $('#VolverAprincipalC').click(function(){
                  $('#ContenidoC1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                });
                

       


             $('#fomularioEfectivo').keyup(function(){
            var MontoEfectivo = $('input:text[name=MontoEfectivo]').val();
            var ven_total = $('input:text[name=ven_total]').val();
            var action = 'Efectivo';
            var dataString = 'MontoEfectivo='+MontoEfectivo + '&action='+action + '&ven_total='+ven_total;
            $.ajax({
              url: 'accionesExclusivas.php',
              type: 'POST',
              data: dataString,
                   success: function(data)
                   {
                      $('#suggestionsA1').fadeIn(2000).html(data);
                   }
            })
            .done(function(){
               $('#finalizarVentaEfectivo').fadeIn(3000);
            })
            .fail(function(){
              
            })
            .always(function(){
                
            })
          });

        
         $(document).keydown(function(tecla){ 
    if (tecla.keyCode == 118) { 
         $('#ContenidoA1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                  $('#ContenidoB1').css('display', 'none');
                  $( "#CalcularVuelto" ).focus();
    } 
    if (tecla.keyCode == 119) { 
         $('#ContenidoB1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                   $('#ContenidoA1').css('display', 'none');
                   $( "#get_clientes" ).focus();
    } 
     if (tecla.keyCode == 120) { 
         $('#ContenidoC1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                  $( "#radioTrjeta" ).focus();
    } 
     if (tecla.keyCode == 16) { 
                  $( "#get_cantidad" ).focus();
                  $("#get_cantidad").val("");
    } 


       if (tecla.keyCode == 17) { 
                  $( "#get_articulos" ).focus();
    } 

   
   
});


  $( "#get_cantidad" ).blur(function() {
   
       var get_cantidad = $('input:text[name=get_cantidad]').val();
        if (get_cantidad>=2) {

        }
        else
         {
            $("#get_cantidad").val( "1" );
         } 
   
  });
  

 
    $('#file-es').fileinput({
        showUpload: false,
        overwriteInitial: false,
        showDownload: false,
        showZoom: false,
        showDrag: false,
        theme: 'fa',
        language: 'es',
        uploadUrl: '#',
        allowedFileExtensions: ['jpg', 'png', 'gif']
         
    });

 </script> 





<!--Fin: script -->