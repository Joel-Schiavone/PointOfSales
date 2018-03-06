<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack'] = $_SERVER['REQUEST_URI'];
  
  $tarjetasE             = new tarjetasE;
  $tarjetas              = new tarjetas;
  $cuentasE             = new cuentasE;
  $cuentas              = new cuentas;
 
?>
<!--Fin: Documentos requeridos --> 
<style type="text/css">
	th
	{
	 text-align:center;
	}
</style>
                            <!--Inicio Modal nueva cuenta-->                          
                            <div class="modal fade" id="nuevaTarjeta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class='material-icons'>add_box</i> NUEVA TARJETA</h4>
                                          </div>
                                          <div class="modal-body">
                                             <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                                <fieldset>
                                                    <legend>Datos de la Tarjeta</legend>
                                                        <input hidden type="text" name="action" value="nuevaTarjeta">
                                                
                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Nombre</label>
                                                          <input type="text" class="form-control" id="tar_desc" name="tar_desc" placeholder="Nombre de Tarjeta">
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Tipo</label>
                                                          <select class="form-control" name='tar_tipo'>
                                                             <option value='1'>Cédito</option> 
                                                             <option value='2'>Débito</option> 
                                                          </select>
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Cuenta en la que se acrédita</label>
                                                           <select name="tar_cue" class="form-control"> 
                                                                <?php
                                                                  $get_cuentas=$cuentasE->get_cuentas();
                                                                  $num_get_cuentas=mysql_num_rows($get_cuentas);
                                                                    for ($countget_cuentas=0; $countget_cuentas < $num_get_cuentas; $countget_cuentas++) 
                                                                    { 
                                                                      $assoc_get_cuentas=mysql_fetch_assoc($get_cuentas);
                                                                       echo "<option value='".$assoc_get_cuentas['ID_cue']."'>".$assoc_get_cuentas['cue_desc']."</option>";
                                                                    }
                                                                ?>
                                                             </select>
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Imágen</label>
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
            <button class='btn btn-success' data-placement='top' data-toggle='modal' data-target='#nuevaTarjeta'><i class='material-icons'>add</i> NUEVA TARJETA </button>
        </div> 
		<div class='col-md-12' style="text-align: center;"> 
      
        	<table id="listadoCuentas" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>TIPO</th>
                        <th>CUENTA</th>
                        <th>IMAGEN</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                    </tr> 
                </thead>
                <tfoot>
                    <tr>
                       <th>NOMBRE</th>
                        <th>TIPO</th>
                        <th>CUENTA</th>
                        <th>IMAGEN</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $get_tarjetas=$tarjetasE->get_tarjetas();
                        $num_get_tarjetas=mysql_num_rows($get_tarjetas);
                        for ($Countget_tarjetas=0; $Countget_tarjetas < $num_get_tarjetas; $Countget_tarjetas++) 
                        { 
                            $assoc_get_tarjetas=mysql_fetch_assoc($get_tarjetas);
                            
                            if ($assoc_get_tarjetas['tar_tipo']==1) 
                            {
                              $TipoTarjeta="Crédito";
                            }
                            else
                            {
                              $TipoTarjeta="Débito";
                            }  
                              echo '<div class="modal fade" id="editaTarjeta'.$assoc_get_tarjetas['ID_tar'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="material-icons">mode_edit</i> EDITAR TARJETAS</h4>
                                          </div> 
                                          <div class="modal-body">
                                             <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                                <fieldset>
                                                    <legend>Datos del Punto de Venta</legend>
                                                        <input hidden type="text" name="action" value="editaTarjeta">
                                                         <input hidden type="text" name="ID_tar" value="'.$assoc_get_tarjetas['ID_tar'].'">
                                                         <input hidden type="text" name="tar_logo" value="'.$assoc_get_tarjetas['tar_logo'].'">
                                                        
                                                       <div class="form-group">
                                                          <label for="exampleInputEmail1">Nombre</label>
                                                          <input type="text" class="form-control" id="tar_desc" name="tar_desc" placeholder="Nombre de Tarjeta" value="'.$assoc_get_tarjetas['tar_desc'].'">
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Tipo</label>
                                                          <select class="form-control" name="tar_tipo">';
                                                                if ($assoc_get_tarjetas['tar_tipo']==1) 
                                                                {
                                                                 echo '<option value="1" selected>Cédito</option>'; 
                                                                 echo '<option value="2">Débito</option>';
                                                                }
                                                                else
                                                                {
                                                                 echo '<option value="2" selected>Débito</option>'; 
                                                                 echo '<option value="1">Cédito</option>';
                                                                }  
                                                      echo '</select>
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Cuenta en la que se acrédita</label>
                                                           <select name="tar_cue" class="form-control">
                                                           <option value="'.$assoc_get_tarjetas['tar_cue'].'">'.$assoc_get_tarjetas['cue_desc'].'</option>'; 

                                                                    $get_cuentasB=$cuentas->get_cuentas();
                                                                    $num_get_cuentasB=mysql_num_rows($get_cuentasB);
                                                                    for ($countget_cuentasB=0; $countget_cuentasB < $num_get_cuentasB; $countget_cuentasB++) 
                                                                    { 
                                                                      $assoc_get_cuentasB=mysql_fetch_assoc($get_cuentasB);
                                                                       echo "<option value='".$assoc_get_cuentasB['ID_cue']."'>".$assoc_get_cuentasB['cue_desc']."</option>";
                                                                    }
                                                             echo '</select>
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Imágen</label>
                                                          <img src="'.$assoc_get_tarjetas['tar_logo'].'">
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
                            echo '<div class="modal fade" id="eliminaTarjeta'.$assoc_get_tarjetas['ID_tar'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document" style="width:90%;">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="material-icons">delete_forever</i> ELIMINAR TARJETA </h4>
                                          </div>
                                          <div class="modal-body">
                                              <div class="alert alert-danger" role="alert">
                                                            <h5><i class="material-icons">warning</i> CUIDADO !!!</h5>
                                                            <p> Usted esta a punto de eliminar el registro '.$assoc_get_tarjetas['tar_desc'].'</p>
                                                        </div>      
                                            </div>
                                          <div class="modal-footer">
                                            <a href="accionesExclusivas.php?ID_tar='.$assoc_get_tarjetas['ID_tar'].'&action=dropTarjetas"><button class="btn btn-success">Eliminar registro !</button></a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>';
                                /* Fin Modal elimina cuenta */

                            echo "<tr>";
                                echo "<th>".$assoc_get_tarjetas['tar_desc']."</th>";
                                echo "<th>".$TipoTarjeta."</th>";
                                echo "<th>".$assoc_get_tarjetas['cue_desc']."</th>";
                                echo "<th><img src='".$assoc_get_tarjetas['tar_logo']."'></th>";
                            
                                echo "<th><button data-toggle='modal' title='Modificar datos de la Tarjeta' data-placement='top' data-target='#editaTarjeta".$assoc_get_tarjetas['ID_tar']."' class='btn btn-primary'><i class='material-icons'>mode_edit</i></button></th>";
                                echo "<th><button data-toggle='modal' title='Eliminar Tarjeta' data-placement='top' data-target='#eliminaTarjeta".$assoc_get_tarjetas['ID_tar']."' class='btn btn-danger'><i class='material-icons'>delete_forever</i></button></th>";
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
