<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack'] = $_SERVER['REQUEST_URI'];
  
  $tarjetasE             = new tarjetasE;
  $tarjetas              = new tarjetas;
  $tarjetas_planesE      = new tarjetas_planesE;
  $tarjetas_planes       = new tarjetas_planes;
 
?>
<!--Fin: Documentos requeridos --> 
<style type="text/css">
	th
	{
	 text-align:center;
	}
</style>
                            <!--Inicio Modal nueva cuenta-->                          
                            <div class="modal fade" id="nuevaTarjetaPlan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class='material-icons'>add_box</i> NUEVO PLAN DE TARJETA</h4>
                                          </div>
                                          <div class="modal-body">
                                             <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                                <fieldset>
                                                    <legend>Datos del Plan de Tarjeta</legend>
                                                        <input hidden type="text" name="action" value="nuevoPlanTarjeta">

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Tarjeta</label>
                                                          <select name="ID_tar" class="form-control"> 
                                                                <?php
                                                                  $get_tarjetas=$tarjetas->get_tarjetas();
                                                                  $num_get_tarjetas=mysql_num_rows($get_tarjetas);
                                                                    for ($countget_tarjetas=0; $countget_tarjetas < $num_get_tarjetas; $countget_tarjetas++) 
                                                                    { 
                                                                      $assoc_get_tarjetas=mysql_fetch_assoc($get_tarjetas);
                                                                      if ($assoc_get_tarjetas['tar_tipo']==1) 
                                                                      {
                                                                        $tarjetaTipo="Cédito";
                                                                      }
                                                                      else
                                                                      {
                                                                        $tarjetaTipo="Débito";
                                                                      }  
                                                                       echo "<option value='".$assoc_get_tarjetas['ID_tar']."'>".$assoc_get_tarjetas['tar_desc']." - ".$tarjetaTipo." </option>";
                                                                    }
                                                                ?>
                                                             </select>
                                                        </div>

                                                           <div class="form-group">
                                                          <label for="exampleInputEmail1">Tiempo de Acreditación (Expresado en Días)</label>
                                                           <div class="input-group">
                                                              <input type="number" class="form-control" id="plan_tiempoAcre" name="plan_tiempoAcre" placeholder="Tiempo de Acreditación">
                                                              <div class="input-group-addon">Días</div>
                                                           </div>

                                                        </div>

                                                
                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Nombre</label>
                                                          <input type="text" class="form-control" id="pla_desc" name="pla_desc" placeholder="Nombre del plan de la Tarjeta">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Cantidad de Cuotas</label>
                                                          <input type="number" class="form-control" id="pla_cant" name="pla_cant" placeholder="Cantidad de Cuotas">
                                                        </div>

                                                              
                                                        <div class="form-group">
                                                          <label class="control-label">Interes</label>
                                                          <div class="input-group">
                                                            <div class="input-group-addon">%</div>
                                                            <input type="number" class="form-control" id="pla_recargo" name="pla_recargo" placeholder="Interes">
                                                          </div>
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
				<h3><i class="material-icons">card_membership</i> Planes de Tarjetas de Crédito/Débito<img src=media/loading/cargando4.gif id='cargandoBoton' style="display: none;" > </h3>
			</div> 
		</div> 
        <div class='col-md-12' style="text-align: right; margin-bottom:  1%; margin-top:  1%;">
            <button class='btn btn-success' data-placement='top' data-toggle='modal' data-target='#nuevaTarjetaPlan'><i class='material-icons'>add</i> NUEVO PLAN DE TARJETA </button>
        </div> 
		<div class='col-md-12' style="text-align: center;"> 
      
        	<table id="listadoCuentas" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>TARJETA</th>
                        <th>NOMBRE DE PLAN</th>
                        <th>CANTIDAD DE CUOTAS</th>
                        <th>INTERES</th>
                        <th>TIEMPO DE ACREDITACIÓN (Nº de Días)</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                    </tr> 
                </thead>
                <tfoot>
                    <tr>
                        <th>TARJETA</th>
                        <th>NOMBRE DE PLAN</th>
                        <th>CANTIDAD DE CUOTAS</th>
                        <th>INTERES</th>
                        <th>TIEMPO DE ACREDITACIÓN (Nº de Días)</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php 
                        $get_tarjetas_planes=$tarjetas_planesE->get_tarjetas_planes();
                        $num_get_tarjetas=mysql_num_rows($get_tarjetas_planes);
                        for ($Countget_tarjetas=0; $Countget_tarjetas < $num_get_tarjetas; $Countget_tarjetas++) 
                        { 
                            $assoc_get_tarjetas=mysql_fetch_assoc($get_tarjetas_planes);
                            
                              echo '<div class="modal fade" id="editaTarjetaPlan'.$assoc_get_tarjetas['ID_pla'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                                        <input hidden type="text" name="action" value="editaTarjetaPlan">
                                                         <input hidden type="text" name="ID_pla" value="'.$assoc_get_tarjetas['ID_pla'].'">
                                                        
                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Tarjeta</label>
                                                          <select name="ID_tar" class="form-control">
                                                          <option value="'.$assoc_get_tarjetas['ID_tar'].'">'.$assoc_get_tarjetas['tar_desc'].'</option>';
                                                                  $get_tarjetasB=$tarjetas->get_tarjetas();
                                                                  $num_get_tarjetasB=mysql_num_rows($get_tarjetasB);
                                                                  for ($countget_tarjetasB=0; $countget_tarjetasB < $num_get_tarjetasB; $countget_tarjetasB++) 
                                                                    { 
                                                                      $assoc_get_tarjetasB=mysql_fetch_assoc($get_tarjetasB);
                                                                       if ($assoc_get_tarjetasB['tar_tipo']==1) 
                                                                      {
                                                                        $tarjetaTipoB="Cédito";
                                                                      }
                                                                      else
                                                                      {
                                                                        $tarjetaTipoB="Débito";
                                                                      }  
                                                                       echo "<option value='".$assoc_get_tarjetasB['ID_tar']."'>".$assoc_get_tarjetasB['tar_desc']." - ".$tarjetaTipoB."</option>";
                                                                    } 
                                                            echo '</select>
                                                        </div>

                                                           <div class="form-group">
                                                          <label for="exampleInputEmail1">Tiempo de Acreditación (Expresado en Días)</label>
                                                           <div class="input-group">
                                                              <input type="number" class="form-control" id="plan_tiempoAcre" name="plan_tiempoAcre" placeholder="Tiempo de Acreditación" value="'.$assoc_get_tarjetas['plan_tiempoAcre'].'">
                                                              <div class="input-group-addon">Días</div>
                                                           </div>

                                                        </div>

                                                
                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Nombre</label>
                                                          <input type="text" class="form-control" id="pla_desc" name="pla_desc" placeholder="Nombre del plan de la Tarjeta" value="'.$assoc_get_tarjetas['pla_desc'].'">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Cantidad de Cuotas</label>
                                                          <input type="number" class="form-control" id="pla_cant" name="pla_cant" placeholder="Cantidad de Cuotas" value="'.$assoc_get_tarjetas['pla_cant'].'">
                                                        </div>

                                                              
                                                        <div class="form-group">
                                                          <label class="control-label">Interes</label>
                                                          <div class="input-group">
                                                            <div class="input-group-addon">%</div>
                                                            <input type="number" class="form-control" id="pla_recargo" name="pla_recargo" placeholder="Interes" value="'.$assoc_get_tarjetas['pla_recargo'].'">
                                                          </div>
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
                            echo '<div class="modal fade" id="eliminaTarjetaPlan'.$assoc_get_tarjetas['ID_pla'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document" style="width:90%;">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="material-icons">delete_forever</i> ELIMINAR PLAN DE TARJETA </h4>
                                          </div>
                                          <div class="modal-body">
                                              <div class="alert alert-danger" role="alert">
                                                            <h5><i class="material-icons">warning</i> CUIDADO !!!</h5>
                                                            <p> Usted esta a punto de eliminar el registro '.$assoc_get_tarjetas['pla_desc'].'</p>
                                                        </div>      
                                            </div>
                                          <div class="modal-footer">
                                            <a href="accionesExclusivas.php?ID_pla='.$assoc_get_tarjetas['ID_pla'].'&action=dropTarjetasPlan"><button class="btn btn-success">Eliminar registro !</button></a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>';
                                /* Fin Modal elimina cuenta */

                            echo "<tr>";
                                echo "<th><img src='".$assoc_get_tarjetas['tar_logo']."'></th>";
                                echo "<th>".$assoc_get_tarjetas['pla_desc']."</th>";
                                echo "<th>".$assoc_get_tarjetas['pla_cant']." Cuotas</th>";
                                echo "<th>".$assoc_get_tarjetas['pla_recargo']." %</th>";
                                echo "<th>".$assoc_get_tarjetas['plan_tiempoAcre']." Días</th>";
                                echo "<th><button data-toggle='modal' title='Modificar datos del plan de la tarjeta' data-placement='top' data-target='#editaTarjetaPlan".$assoc_get_tarjetas['ID_pla']."' class='btn btn-primary'><i class='material-icons'>mode_edit</i></button></th>";
                                echo "<th><button data-toggle='modal' title='Eliminar el plan de la tarjeta' data-placement='top' data-target='#eliminaTarjetaPlan".$assoc_get_tarjetas['ID_pla']."' class='btn btn-danger'><i class='material-icons'>delete_forever</i></button></th>";
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
