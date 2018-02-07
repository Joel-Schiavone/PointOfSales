<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack'] = $_SERVER['REQUEST_URI'];
  
  $sucursalesE             = new sucursalesE;
  $sucursales              = new sucursales;
  $tipo_comprobantes       = new tipo_comprobantes;
  $tipo_comprobantesE      = new tipo_comprobantesE;
  $puntos_de_ventasE       = new puntos_de_ventasE;
  $puntos_de_ventas        = new puntos_de_ventas;
  $cuentas                 = new cuentas;
  $cuentasE                = new cuentasE;
  $puestos                 = new puestos;
  $puestosE                = new puestosE;
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
                                            <h4 class="modal-title" id="myModalLabel"><i class='material-icons'>add_box</i> NUEVO PUESTOS DE TRABAJO</h4>
                                          </div>
                                          <div class="modal-body">
                                             <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                                <fieldset>
                                                    <legend>Datos del Puesto de Trabajo</legend>
                                                        <input hidden type="text" name="action" value="nuevoPuesto">
                                                
                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Sucursal</label>
                                                             <select name="ID_suc" class="form-control"> 
                                                                <?php
                                                                  $get_sucursales=$sucursales->get_sucursales();
                                                                  $num_get_sucursales=mysql_num_rows($get_sucursales);
                                                                    for ($countget_sucursales=0; $countget_sucursales < $num_get_sucursales; $countget_sucursales++) 
                                                                    { 
                                                                      $assoc_get_sucursales=mysql_fetch_assoc($get_sucursales);
                                                                       echo "<option value='".$assoc_get_sucursales['ID_suc']."'>".$assoc_get_sucursales['suc_desc']."</option>";
                                                                    }
                                                                ?>
                                                             </select>

                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Puesto</label>
                                                          <input type="text" class="form-control" id="pue_desc" name="pue_desc" placeholder="Puesto">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Punto de Venta</label>
                                                             <select name="ID_pdv" class="form-control"> 
                                                                <?php
                                                                  $get_puntos_de_ventas=$puntos_de_ventas->get_puntos_de_ventas();
                                                                  $num_get_puntos_de_ventas=mysql_num_rows($get_puntos_de_ventas);
                                                                    for ($countget_puntos_de_ventas=0; $countget_puntos_de_ventas < $num_get_puntos_de_ventas; $countget_puntos_de_ventas++) 
                                                                    { 
                                                                      $assoc_get_puntos_de_ventas=mysql_fetch_assoc($get_puntos_de_ventas);
                                                                       echo "<option value='".$assoc_get_puntos_de_ventas['ID_pdv']."'>".$assoc_get_puntos_de_ventas['pdv_puntoVenta']."</option>";
                                                                    }
                                                                ?>
                                                             </select>

                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Cuenta</label>
                                                             <select name="ID_cue" class="form-control"> 
                                                                <?php
                                                                  $get_cuentas=$cuentas->get_cuentas();
                                                                  $num_get_cuentas=mysql_num_rows($get_cuentas);
                                                                    for ($countget_cuentas=0; $countget_cuentas < $num_get_cuentas; $countget_cuentas++) 
                                                                    { 
                                                                      $assoc_get_cuentas=mysql_fetch_assoc($get_cuentas);
                                                                       echo "<option value='".$assoc_get_cuentas['ID_cue']."'>".$assoc_get_cuentas['cue_desc']."</option>";
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
				<h3><i class="material-icons">local_gas_station</i> Puestos de Trabajo<img src=media/loading/cargando4.gif id='cargandoBoton' style="display: none;" > </h3>
			</div> 
		</div> 
        <div class='col-md-12' style="text-align: right; margin-bottom:  1%; margin-top:  1%;">
            <button class='btn btn-success' data-placement='top' data-toggle='modal' data-target='#nuevoPuntoVenta'><i class='material-icons'>add</i> NUEVO PUESTO DE TRABAJO</button>
        </div> 
		<div class='col-md-12' style="text-align: center;"> 
      
        	<table id="listadoCuentas" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>SUCURSAL</th>
                        <th>PUESTO</th>
                        <th>PUNTO DE VENTA</th>
                        <th>CUENTA</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                    </tr> 
                </thead>
                <tfoot>
                    <tr>
                        <th>SUCURSAL</th>
                        <th>PUESTO</th>
                        <th>PUNTO DE VENTA</th>
                        <th>CUENTA</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $get_puestos=$puestosE->get_puestos();
                        $num_get_puestos=mysql_num_rows($get_puestos);
                        for ($Countget_puestos=0; $Countget_puestos < $num_get_puestos; $Countget_puestos++) 
                        { 
                            $assoc_get_puestos=mysql_fetch_assoc($get_puestos);
                            
                              echo '<div class="modal fade" id="editaPuesto'.$assoc_get_puestos['ID_pue'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="material-icons">mode_edit</i> EDITAR PUESTO DE TRABAJO</h4>
                                          </div> 
                                          <div class="modal-body">
                                             <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                                <fieldset>
                                                    <legend>Datos del Punto de Venta</legend>
                                                        <input hidden type="text" name="action" value="editaPuesto">
                                                         <input hidden type="text" name="ID_pue" value="'.$assoc_get_puestos['ID_pue'].'">
                                                  
                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Sucursal</label>
                                                             <select name="ID_suc" class="form-control"> 
                                                              <option value="'.$assoc_get_puestos['ID_suc'].'">'.$assoc_get_puestos['suc_desc'].'</option>';
                                                                  $get_sucursalesB=$sucursales->get_sucursales();
                                                                  $num_get_sucursalesB=mysql_num_rows($get_sucursalesB);
                                                                    for ($countget_sucursalesB=0; $countget_sucursalesB < $num_get_sucursalesB; $countget_sucursalesB++) 
                                                                    { 
                                                                      $assoc_get_sucursalesB=mysql_fetch_assoc($get_sucursalesB);
                                                                       echo "<option value='".$assoc_get_sucursalesB['ID_suc']."'>".$assoc_get_sucursalesB['suc_desc']."</option>";
                                                                    }
                                                                
                                                             echo '</select>

                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Puesto</label>
                                                          <input type="text" class="form-control" id="pue_desc" name="pue_desc" placeholder="Puesto" value="'.$assoc_get_puestos['pue_desc'].'">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Punto de Venta</label>
                                                             <select name="ID_pdv" class="form-control"> 
                                                              <option value="'.$assoc_get_puestos['ID_pdv'].'">'.$assoc_get_puestos['pdv_puntoVenta'].'</option>';
                                                                  $get_puntos_de_ventasB=$puntos_de_ventas->get_puntos_de_ventas();
                                                                  $num_get_puntos_de_ventasB=mysql_num_rows($get_puntos_de_ventasB);
                                                                    for ($countget_puntos_de_ventasB=0; $countget_puntos_de_ventasB < $num_get_puntos_de_ventasB; $countget_puntos_de_ventasB++) 
                                                                    { 
                                                                      $assoc_get_puntos_de_ventasB=mysql_fetch_assoc($get_puntos_de_ventasB);
                                                                       echo "<option value='".$assoc_get_puntos_de_ventasB['ID_pdv']."'>".$assoc_get_puntos_de_ventasB['pdv_puntoVenta']."</option>";
                                                                    }
                                                                
                                                             echo '</select>

                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Cuenta</label>
                                                             <select name="ID_cue" class="form-control"> 
                                                              <option value="'.$assoc_get_puestos['ID_cue'].'">'.$assoc_get_puestos['cue_desc'].'</option>';
                                                                  $get_cuentasB=$cuentas->get_cuentas();
                                                                  $num_get_cuentasB=mysql_num_rows($get_cuentasB);
                                                                    for ($countget_cuentasB=0; $countget_cuentasB < $num_get_cuentasB; $countget_cuentasB++) 
                                                                    { 
                                                                      $assoc_get_cuentasB=mysql_fetch_assoc($get_cuentasB);
                                                                       echo "<option value='".$assoc_get_cuentasB['ID_cue']."'>".$assoc_get_cuentasB['cue_desc']."</option>";
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
                            echo '<div class="modal fade" id="eliminaPuestoTrabajo'.$assoc_get_puestos['ID_pue'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document" style="width:90%;">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="material-icons">delete_forever</i> ELIMINAR REGISTRO </h4>
                                          </div>
                                          <div class="modal-body">
                                              <div class="alert alert-danger" role="alert">
                                                            <h5><i class="material-icons">warning</i> CUIDADO !!!</h5>
                                                            <p> Usted esta a punto de eliminar el registro '.$assoc_get_puestos['pue_desc'].'</p>
                                                        </div>      
                                            </div>
                                          <div class="modal-footer">
                                            <a href="accionesExclusivas.php?ID_pue='.$assoc_get_puestos['ID_pue'].'&action=dropPuestoVenta"><button class="btn btn-success">Eliminar registro !</button></a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>';
                                /* Fin Modal elimina cuenta */

                            echo "<tr>";
                                echo "<th>".$assoc_get_puestos['suc_desc']."</th>";
                                echo "<th>".$assoc_get_puestos['pue_desc']."</th>";
                                echo "<th>".$assoc_get_puestos['pdv_puntoVenta']."</th>";
                                echo "<th>".$assoc_get_puestos['cue_desc']."</th>";
                            
                                echo "<th><button data-toggle='modal' title='Modificar datos del puesto de trabajo' data-placement='top' data-target='#editaPuesto".$assoc_get_puestos['ID_pue']."' class='btn btn-primary'><i class='material-icons'>mode_edit</i></button></th>";
                                echo "<th><button data-toggle='modal' title='Eliminar Puesto de trabajo' data-placement='top' data-target='#eliminaPuestoTrabajo".$assoc_get_puestos['ID_pue']."' class='btn btn-danger'><i class='material-icons'>delete_forever</i></button></th>";
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
