<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack']= $_SERVER['REQUEST_URI'];
  
  $tipo_comprobantes    = new tipo_comprobantes;
  $tipo_comprobantesE   = new tipo_comprobantesE;
  $puntos_de_ventasE    = new puntos_de_ventasE;
  $puntos_de_ventas     = new puntos_de_ventas;
?>
<!--Fin: Documentos requeridos --> 
<style type="text/css">
	th
	{
	 text-align:center;
	}
</style>
  
      


                            <!--Inicio Modal nueva cuenta-->                          
                            <div class="modal fade" id="nuevoPuntoVenta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class='material-icons'>add_box</i> NUEVO PUENTO DE VENTA</h4>
                                          </div>
                                          <div class="modal-body">
                                             <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                                <fieldset>
                                                    <legend>Datos del Punto de Venta</legend>
                                                        <input hidden type="text" name="action" value="nuevoPuntoDeVenta">
                                                
                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Comprobante Numeración</label>
                                                          <input type="number" class="form-control" name="pdv_numeracion" id="pdv_numeracion" placeholder="Comprobante Numeración">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Punto de Venta</label>
                                                          <input type="text" class="form-control" id="pdv_puntoVenta" name="pdv_puntoVenta" placeholder="Punto de Venta">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">CAI</label>
                                                          <input type="number" class="form-control" id="pdv_cai" name="pdv_cai" placeholder="CAI">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Fecha de Vencimiento</label>
                                                          <input type="datetime-local" class="form-control" id="pdv_fecVencimiento" name="pdv_fecVencimiento">
                                                        </div>
        
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Tipo de Comprobante</label>
                                                            <select name="ID_tce" class="form-control"> 
                                                                <?php
                                                                  $get_tipo_comprobantes=$tipo_comprobantesE->get_tipo_comprobantesConNumeracion();
                                                                  $num_get_tipo_comprobantes=mysql_num_rows($get_tipo_comprobantes);
                                                                    for ($countget_tipo_comprobantes=0; $countget_tipo_comprobantes < $num_get_tipo_comprobantes; $countget_tipo_comprobantes++) 
                                                                    { 
                                                                      $assoc_get_tipo_comprobantes=mysql_fetch_assoc($get_tipo_comprobantes);
                                                                       echo "<option value='".$assoc_get_tipo_comprobantes['ID_tce']."'>".$assoc_get_tipo_comprobantes['tce_desc']."</option>";
                                                                    }
                                                                ?>
                                                             </select>
                                                        </div>


                                                         <button type="submit" class="btn btn-success"><i class="material-icons">save</i> GUARDAR</button>

                                                </fieldset>        

                                            </form>
                                           </div>
                                            </div>
                                          <div class="modal-footer">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                <!--Fin Modal nueva cuenta-->
	<div class="container-fluid">


		<div class='col-md-12' style="text-align: center;">
			<div class="alert alert-dismissible alert-info">
				<h3><i class="material-icons">confirmation_number</i> Puntos de Ventas<img src=media/loading/cargando4.gif id='cargandoBoton' style="display: none;" > </h3>
			</div> 
		</div> 
        <div class='col-md-12' style="text-align: right; margin-bottom:  1%; margin-top:  1%;">
            <button class='btn btn-success' data-placement='top' data-toggle='modal' data-target='#nuevoPuntoVenta'><i class='material-icons'>add</i> NUEVO PUNTO DE VENTA</button>
        </div> 
		<div class='col-md-12' style="text-align: center;"> 
      
        	<table id="listadoCuentas" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>NUMERACIÓN DE COMPROBANTE</th>
                        <th>PUNTO DE VENTA</th>
                        <th>CAI</th>
                        <th>VENCIMIENTO</th>
                        <th>TIPO DE COMPROBANTE</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                    </tr> 
                </thead>
                <tfoot>
                    <tr>
                        <th>NUMERACIÓN DE COMPROBANTE</th>
                        <th>PUNTO DE VENTA</th>
                        <th>CAI</th>
                        <th>VENCIMIENTO</th>
                        <th>TIPO DE COMPROBANTE</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $get_puntos_de_ventas=$puntos_de_ventasE->get_puntos_de_ventas();
                        $num_get_puntos_de_ventas=mysql_num_rows($get_puntos_de_ventas);
                        for ($Countget_puntos_de_ventas=0; $Countget_puntos_de_ventas < $num_get_puntos_de_ventas; $Countget_puntos_de_ventas++) 
                        { 
                            $assoc_get_puntos_de_ventas=mysql_fetch_assoc($get_puntos_de_ventas);
                            $pdv_fecVencimiento=strftime('%Y-%m-%dT%H:%M:%S', strtotime($assoc_get_puntos_de_ventas['pdv_fecVencimiento']));
                              echo '<div class="modal fade" id="editaPuntoVenta'.$assoc_get_puntos_de_ventas['ID_pdv'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="material-icons">mode_edit</i> EDITAR PUNTO DE VENTA</h4>
                                          </div> 
                                          <div class="modal-body">
                                             <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                                <fieldset>
                                                    <legend>Datos del Punto de Venta</legend>
                                                        <input hidden type="text" name="action" value="editaPuntoDeVenta">
                                                         <input hidden type="text" name="ID_pdv" value="'.$assoc_get_puntos_de_ventas['ID_pdv'].'">
                                                  
                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Comprobante Numeración</label>
                                                          <input type="number" class="form-control" name="pdv_numeracion" id="pdv_numeracion" placeholder="Comprobante Numeración" value="'.$assoc_get_puntos_de_ventas['pdv_numeracion'].'">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Punto de Venta</label>
                                                          <input type="datetime-local" class="form-control" id="pdv_puntoVenta" name="pdv_puntoVenta" placeholder="Punto de Venta" value="'.$assoc_get_puntos_de_ventas['pdv_puntoVenta'].'">
                                                        </div>
                                                        
                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">CAI</label>
                                                          <input type="number" class="form-control" id="pdv_cai" name="pdv_cai" placeholder="CAI" value="'.$assoc_get_puntos_de_ventas['pdv_cai'].'">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Fecha de Vencimiento</label>
                                                          <input type="datatime-local" class="form-control" id="pdv_fecVencimiento" name="pdv_fecVencimiento" value="'.$pdv_fecVencimiento.'">
                                                        </div>
        
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Tipo de Comprobante</label>
                                                            <select name="ID_tce" class="form-control">
                                                            <option value="'.$assoc_get_puntos_de_ventas['ID_tce'].'">'.$assoc_get_puntos_de_ventas['tce_desc'].'</option>';
                                                                  $get_tipo_comprobantes=$tipo_comprobantesE->get_tipo_comprobantesConNumeracion();
                                                                  $num_get_tipo_comprobantes=mysql_num_rows($get_tipo_comprobantes);
                                                                    for ($countget_tipo_comprobantes=0; $countget_tipo_comprobantes < $num_get_tipo_comprobantes; $countget_tipo_comprobantes++) 
                                                                    { 
                                                                      $assoc_get_tipo_comprobantes=mysql_fetch_assoc($get_tipo_comprobantes);
                                                                       echo "<option value='".$assoc_get_tipo_comprobantes['ID_tce']."'>".$assoc_get_tipo_comprobantes["tce_desc"]."</option>";
                                                                    }
                                                                
                                                            echo '</select>
                                                        </div>

                                                         <button type="submit" class="btn btn-success"><i class="material-icons">save</i> GUARDAR</button>

                                                </fieldset>        

                                            </form>
                                            </div>
                                          <div class="modal-footer">
                                          </div>
                                        </div>
                                      </div>
                                    </div>';


                                   /* Inicio Modal elimina cuenta */                          
                            echo '<div class="modal fade" id="eliminaPuntoVenta'.$assoc_get_puntos_de_ventas['ID_pdv'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document" style="width:90%;">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="material-icons">delete_forever</i> ELIMINAR REGISTRO </h4>
                                          </div>
                                          <div class="modal-body">
                                              <div class="alert alert-danger" role="alert">
                                                            <h5><i class="material-icons">warning</i> CUIDADO !!!</h5>
                                                            <p> Usted esta a punto de eliminar el registro '.$assoc_get_puntos_de_ventas['pdv_puntoVenta'].'</p>
                                                        </div>      
                                            </div>
                                          <div class="modal-footer">
                                            <a href="accionesExclusivas.php?ID_pdv='.$assoc_get_puntos_de_ventas['ID_pdv'].'&action=dropPuntoVenta"><button class="btn btn-success">Eliminar registro !</button></a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>';
                                /* Fin Modal elimina cuenta */

                            echo "<tr>";
                                echo "<th>".$assoc_get_puntos_de_ventas['pdv_numeracion']."</th>";
                                echo "<th>".$assoc_get_puntos_de_ventas['pdv_puntoVenta']."</th>";
                                echo "<th>".$assoc_get_puntos_de_ventas['pdv_cai']."</th>";
                                echo "<th>".$assoc_get_puntos_de_ventas['pdv_fecVencimiento']."</th>";
                                echo "<th>".$assoc_get_puntos_de_ventas['tce_desc']."</th>";
                                
                            
                                echo "<th><button data-toggle='modal' title='Modificar datos de la cuenta' data-placement='top' data-target='#editaPuntoVenta".$assoc_get_puntos_de_ventas['ID_pdv']."' class='btn btn-primary'><i class='material-icons'>mode_edit</i></button></th>";
                                echo "<th><button data-toggle='modal' title='Eliminar Comprobante' data-placement='top' data-target='#eliminaPuntoVenta".$assoc_get_puntos_de_ventas['ID_pdv']."' class='btn btn-danger'><i class='material-icons'>delete_forever</i></button></th>";
                            echo "</tr>";
                        }
                     ?>
                </tbody>
            </table>
        </div>  
    </div>

	

<!--Fin: Contenedor principal -->


<!--Fin: Footer -->

<!--Inicio: script -->
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
  


     
<!--Fin: script -->

<!--Inicio: Trae Sucursales -->
 

  
<!--Fin: Trae Sucursales -->
<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>
