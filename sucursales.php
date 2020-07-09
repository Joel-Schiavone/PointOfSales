<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack'] = $_SERVER['REQUEST_URI'];
  
  $sucursalesE             = new sucursalesE;
  $sucursales              = new sucursales;
 
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
                                            <h4 class="modal-title" id="myModalLabel"><i class='material-icons'>add_box</i> NUEVA SUCURSAL</h4>
                                          </div>
                                          <div class="modal-body">
                                             <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                                <fieldset>
                                                    <legend>Datos de la Sucursal</legend>
                                                        <input hidden type="text" name="action" value="nuevaSucursal">
                                                
                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Nombre de Sucursal</label>
                                                          <input type="text" class="form-control" id="suc_desc" name="suc_desc" placeholder="Nombre de Sucursal">
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Dirección</label>
                                                          <input type="text" class="form-control" id="suc_dir" name="suc_dir" placeholder="Dirección">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Teléfono</label>
                                                          <input type="text" class="form-control" id="suc_tel" name="suc_tel" placeholder="Teléfono">
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Icono</label>
                                                          <input type="file" accept="image/png, image/jpeg" class="form-control" id="adj_ruta" name="adj_ruta">
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

	
        <div class='col-md-12' style="text-align: right; margin-bottom:  1%; margin-top:  1%;">
            <button class='btn btn-success' data-placement='top' data-toggle='modal' data-target='#nuevoPuntoVenta'><i class='material-icons'>add</i> NUEVA SUCURSAL</button>
        </div> 
		<div class='col-md-12' style="text-align: center;"> 
      
        	<table id="listadoCuentas" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>DIRECCIÓN</th>
                        <th>TELÉFONO</th>
                        <th>ICONO</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                    </tr> 
                </thead>
                <tfoot>
                    <tr>
                        <th>NOMBRE</th>
                        <th>DIRECCIÓN</th>
                        <th>TELÉFONO</th>
                        <th>ICONO</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $get_sucursales=$sucursales->get_sucursales();
                        $num_get_sucursales=mysql_num_rows($get_sucursales);
                        for ($Countget_sucursales=0; $Countget_sucursales < $num_get_sucursales; $Countget_sucursales++) 
                        { 
                            $assoc_get_sucursales=mysql_fetch_assoc($get_sucursales);
                            
                              echo '<div class="modal fade" id="editaSucursal'.$assoc_get_sucursales['ID_suc'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="material-icons">mode_edit</i> EDITAR SUCURSAL</h4>
                                          </div> 
                                          <div class="modal-body">
                                             <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                                <fieldset>
                                                    <legend>Datos del Punto de Venta</legend>
                                                        <input hidden type="text" name="action" value="editaSucursal">
                                                         <input hidden type="text" name="ID_suc" value="'.$assoc_get_sucursales['ID_suc'].'">
                                                         <input hidden type="text" name="suc_icono" value="'.$assoc_get_sucursales['suc_icono'].'">
                                                        
                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Nombre de Sucursal</label>
                                                          <input type="text" class="form-control" id="suc_desc" name="suc_desc" placeholder="Nombre de Sucursal" value="'.$assoc_get_sucursales['suc_desc'].'">
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Dirección</label>
                                                          <input type="text" class="form-control" id="suc_dir" name="suc_dir" placeholder="Dirección" value="'.$assoc_get_sucursales['suc_dir'].'">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Teléfono</label>
                                                          <input type="text" class="form-control" id="suc_tel" name="suc_tel" placeholder="Teléfono" value="'.$assoc_get_sucursales['suc_tel'].'">
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Icono</label>
                                                          <img src="'.$assoc_get_sucursales['suc_icono'].'">
                                                          <input type="file" accept="image/png, image/jpeg" class="form-control" id="adj_ruta" name="adj_ruta">
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
                            echo '<div class="modal fade" id="eliminaSucursal'.$assoc_get_sucursales['ID_suc'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document" style="width:90%;">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="material-icons">delete_forever</i> ELIMINAR SUCURSAL </h4>
                                          </div>
                                          <div class="modal-body">
                                              <div class="alert alert-danger" role="alert">
                                                            <h5><i class="material-icons">warning</i> CUIDADO !!!</h5>
                                                            <p> Usted esta a punto de eliminar el registro '.$assoc_get_sucursales['suc_desc'].'</p>
                                                        </div>      
                                            </div>
                                          <div class="modal-footer">
                                            <a href="accionesExclusivas.php?ID_suc='.$assoc_get_sucursales['ID_suc'].'&action=dropSucursales"><button class="btn btn-success">Eliminar registro !</button></a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>';
                                /* Fin Modal elimina cuenta */

                            echo "<tr>";
                                echo "<th>".$assoc_get_sucursales['suc_desc']."</th>";
                                echo "<th>".$assoc_get_sucursales['suc_dir']."</th>";
                                echo "<th>".$assoc_get_sucursales['suc_tel']."</th>";
                                echo "<th><img src='".$assoc_get_sucursales['suc_icono']."'></th>";
                            
                                echo "<th><button data-toggle='modal' title='Modificar datos de la sucursal' data-placement='top' data-target='#editaSucursal".$assoc_get_sucursales['ID_suc']."' class='btn btn-primary'><i class='material-icons'>mode_edit</i></button></th>";
                                echo "<th><button data-toggle='modal' title='Eliminar Sucursal' data-placement='top' data-target='#eliminaSucursal".$assoc_get_sucursales['ID_suc']."' class='btn btn-danger'><i class='material-icons'>delete_forever</i></button></th>";
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
