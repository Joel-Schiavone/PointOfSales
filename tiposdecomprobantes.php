<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack']= $_SERVER['REQUEST_URI'];
  
  $tipo_comprobantes    = new tipo_comprobantes;
  $tipo_comprobantesE   = new tipo_comprobantesE;
  $cuentas_tipo         = new cuentas_tipo;
  $flujo_comprobantes   = new flujo_comprobantes;
?>
<!--Fin: Documentos requeridos --> 
<style type="text/css">
	th
	{
	 text-align:center;
	}
</style>
  
    <!--Inicio Modal nueva cuenta-->                          
                            <div class="modal fade" id="nuevaComprobante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class='material-icons'>add_box</i> NUEVO TIPO DE COMPROBANTE</h4>
                                          </div>
                                          <div class="modal-body">
                                             <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                                <fieldset>
                                                    <legend>Datos del Tipo de comprobante</legend>
                                                        <input hidden type="text" name="action" value="nuevoComprobante">
                                                
                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Título</label>
                                                          <input type="text" class="form-control" name="tce_desc" id="tce_desc" placeholder="Título">
                                                        </div>

                                                        <div class="form-group">
                                                            <label >Tipo</label>
                                                            <select name="ID_fce" class="form-control"> 
                                                               <?php
                                                                  $get_flujo_comprobantesA=$flujo_comprobantes->get_flujo_comprobantes();
                                                                  $num_get_flujo_comprobantesA=mysql_num_rows($get_flujo_comprobantesA);

                                                                  for ($flujoCountA=0; $flujoCountA < $num_get_flujo_comprobantesA; $flujoCountA++) 
                                                                    { 
                                                                      $assoc_get_flujo_comprobantesA=mysql_fetch_assoc($get_flujo_comprobantesA);
                                                                       echo "<option value='".$assoc_get_flujo_comprobantesA['ID_fce']."'>".$assoc_get_flujo_comprobantesA['fce_desc']."</option>";
                                                                    }
                                                                ?>
                                                             </select>
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Acciona sobre Caja</label>
                                                            <br>
                                                            <label class="switch">
                                                            <input type="checkbox" id="tce_movcaja" name="tce_movcaja" value="1">
                                                            <span class="slider round"></span>
                                                          </label>
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Acciona sobre Stock</label>
                                                            <br>
                                                            <label class="switch">
                                                            <input type="checkbox" id="tce_movstock" name="tce_movstock" value="1">
                                                            <span class="slider round"></span>
                                                          </label>
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Predecesor</label>
                                                           <select name="tce_predecesor" class="form-control"> 
                                                              <option value="0">Sin Predecesor</option>
                                                              <?php
                                                                  $get_tipo_comprobantesA=$tipo_comprobantes->get_tipo_comprobantes();
                                                                  $num_get_tipo_comprobantesA=mysql_num_rows($get_tipo_comprobantesA);
                                                                  for ($CountComprobantesA=0; $CountComprobantesA < $num_get_tipo_comprobantesA; $CountComprobantesA++) 
                                                                  { 
                                                                      $assoc_get_tipo_comprobantesA=mysql_fetch_assoc($get_tipo_comprobantesA);
                                                                       echo "<option value='".$assoc_get_tipo_comprobantesA['ID_tce']."'>".$assoc_get_tipo_comprobantesA['tce_desc']."</option>";
                                                                  }    
                                                               ?> 
                                                            </select>      
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Generación independiente</label>
                                                            <br>
                                                            <label class="switch">
                                                            <input type="checkbox" id="tce_fuerzaPredecesor" name="tce_fuerzaPredecesor" value="1">
                                                            <span class="slider round"></span>
                                                          </label>
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Numeración automatica</label>
                                                            <br>
                                                            <label class="switch">
                                                            <input type="checkbox" id="tce_numeracionAutomatica" name="tce_numeracionAutomatica" value="1">
                                                            <span class="slider round"></span>
                                                          </label>
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Detalle de Artículos</label>
                                                            <br>
                                                            <label class="switch">
                                                            <input type="checkbox" id="tce_detalleArticulos" name="tce_detalleArticulos" value="1">
                                                            <span class="slider round"></span>
                                                          </label>
                                                        </div>


                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Abreviación o Letra</label>
                                                          <input type="text" class="form-control" name="tce_letra" id="tce_letra" placeholder="Abreviación o Letra">
                                                        </div>

                                                         <button type="submit" class="btn btn-success"><i class="material-icons">save</i> GUARDAR</button>

                                                </fieldset>        

                                            </form>
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
				<h3><i class="material-icons">description</i> Tipos de Comprobantes <img src=media/loading/cargando4.gif id='cargandoBoton' style="display: none;" > </h3>
			</div> 
		</div> 
        <div class='col-md-12' style="text-align: right; margin-bottom:  1%; margin-top:  1%;">
            <button class='btn btn-success' data-placement='top' data-toggle='modal' data-target='#nuevaComprobante'><i class='material-icons'>add</i> NUEVO COMPROBANTE</button>
        </div> 
		<div class='col-md-12' style="text-align: center;"> 
      
        	<table id="listadoCuentas" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>DESCRIPCIÓN</th>
                        <th>FLUJO</th>
                        <th>ACCIONA SOBRE CAJA</th>
                        <th>ACCIONA SOBRE STOCK</th>
                        <th>PREDECESOR</th>
                        <th>GENERACIÓN INDEPENDÍENTE</th>
                        <th>NUMERACIÓN AUTOMATICA</th>
                        <th>DETALLE DE ARTICULOS</th>
                        <th>ABREVIACIÓN O LETRA</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                    </tr> 
                </thead>
                <tfoot>
                    <tr>
                        <th>DESCRIPCIÓN</th>
                        <th>FLUJO</th>
                        <th>ACCIONA SOBRE CAJA</th>
                        <th>ACCIONA SOBRE STOCK</th>
                        <th>PREDECESOR</th>
                        <th>GENERACIÓN INDEPENDÍENTE</th>
                        <th>NUMERACIÓN AUTOMATICA</th>
                        <th>DETALLE DE ARTICULOS</th>
                        <th>ABREVIACIÓN O LETRA</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $get_tipo_comprobantes=$tipo_comprobantesE->get_tipo_comprobantes();
                        $num_get_tipo_comprobantes=mysql_num_rows($get_tipo_comprobantes);
                        for ($CountComprobantes=0; $CountComprobantes < $num_get_tipo_comprobantes; $CountComprobantes++) 
                        { 
                            $assoc_get_tipo_comprobantes=mysql_fetch_assoc($get_tipo_comprobantes);
                           
                              echo '<div class="modal fade" id="editaComprobante'.$assoc_get_tipo_comprobantes['ID_tce'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="material-icons">mode_edit</i> EDITAR COMPROBANTE</h4>
                                          </div>
                                          <div class="modal-body">
                                             <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                                <fieldset>
                                                    <legend>Datos del Tipo de comprobante</legend>
                                                        <input hidden type="text" name="action" value="editaComprobante">
                                                         <input hidden type="text" name="ID_tce" value="'.$assoc_get_tipo_comprobantes['ID_tce'].'">
                                                  
                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Título</label>
                                                          <input type="text" class="form-control" name="tce_desc" id="tce_desc" value="'.$assoc_get_tipo_comprobantes['tce_desc'].'" placeholder="Título">
                                                        </div>

                                                        <div class="form-group">
                                                            <label >Tipo</label>
                                                            <select name="ID_fce" class="form-control"> 
                                                            <option value="'.$assoc_get_tipo_comprobantes['ID_fce'].'">'.$assoc_get_tipo_comprobantes['fce_desc'].'</option>';
                                                               
                                                                  $get_flujo_comprobantesA=$flujo_comprobantes->get_flujo_comprobantes();
                                                                  $num_get_flujo_comprobantesA=mysql_num_rows($get_flujo_comprobantesA);

                                                                  for ($flujoCountA=0; $flujoCountA < $num_get_flujo_comprobantesA; $flujoCountA++) 
                                                                    { 
                                                                      $assoc_get_flujo_comprobantesA=mysql_fetch_assoc($get_flujo_comprobantesA);
                                                                       echo "<option value='".$assoc_get_flujo_comprobantesA['ID_fce']."'>".$assoc_get_flujo_comprobantesA['fce_desc']."</option>";
                                                                    }
                                                                
                                                            echo '</select>
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Acciona sobre Caja</label>
                                                            <br>
                                                            <label class="switch">';
                                                            if ($assoc_get_tipo_comprobantes['tce_movcaja']==1) 
                                                            {
                                                              echo '<input type="checkbox" id="tce_movcaja" name="tce_movcaja" value="1" checked>';
                                                            }
                                                            else
                                                            {
                                                              echo '<input type="checkbox" id="tce_movcaja" name="tce_movcaja" value="1">';
                                                            }  
                                                            echo '<span class="slider round"></span>
                                                          </label>
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Acciona sobre Stock</label>
                                                            <br>
                                                            <label class="switch">';
                                                            if ($assoc_get_tipo_comprobantes['tce_movstock']==1) 
                                                            {
                                                              echo '<input type="checkbox" id="tce_movstock" name="tce_movstock" value="1" checked>';
                                                            }
                                                            else
                                                            {
                                                              echo '<input type="checkbox" id="tce_movstock" name="tce_movstock" value="1">';
                                                            }  
                                                            echo '
                                                            <span class="slider round"></span>
                                                          </label>
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Predecesor</label>
                                                           <select name="tce_predecesor" class="form-control">'
                                                             ;
                                                                $get_tipo_comprobantesById=$tipo_comprobantes->get_tipo_comprobantesById($assoc_get_tipo_comprobantes['tce_predecesor']);
                                                                $assoc_get_tipo_comprobantesById=mysql_fetch_assoc($get_tipo_comprobantesById);
                                                              echo '<option value="'.$assoc_get_tipo_comprobantesById['ID_tce'].'">'.$assoc_get_tipo_comprobantesById['tce_desc'].'</option>
                                                               <option value="0">Sin Predecesor</option>';
                                                                  $get_tipo_comprobantesA=$tipo_comprobantes->get_tipo_comprobantes();
                                                                  $num_get_tipo_comprobantesA=mysql_num_rows($get_tipo_comprobantesA);
                                                                  for ($CountComprobantesA=0; $CountComprobantesA < $num_get_tipo_comprobantesA; $CountComprobantesA++) 
                                                                  { 
                                                                      $assoc_get_tipo_comprobantesA=mysql_fetch_assoc($get_tipo_comprobantesA);
                                                                       echo "<option value='".$assoc_get_tipo_comprobantesA['ID_tce']."'>".$assoc_get_tipo_comprobantesA['tce_desc']."</option>";
                                                                  }  
                                                           echo '</select>      
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Generación independiente</label>
                                                            <br>
                                                            <label class="switch">';
                                                            if ($assoc_get_tipo_comprobantes['tce_fuerzaPredecesor']==1) 
                                                            {
                                                              echo '<input type="checkbox" id="tce_fuerzaPredecesor" name="tce_fuerzaPredecesor" value="1" checked>';
                                                            }
                                                            else
                                                            {
                                                              echo '<input type="checkbox" id="tce_fuerzaPredecesor" name="tce_fuerzaPredecesor" value="1">';
                                                            }  
                                                            echo '
                                                            <span class="slider round"></span>
                                                          </label>
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Numeración automatica</label>
                                                            <br>
                                                            <label class="switch">';
                                                            if ($assoc_get_tipo_comprobantes['tce_numeracionAutomatica']==1) 
                                                            {
                                                              echo '<input type="checkbox" id="tce_numeracionAutomatica" name="tce_numeracionAutomatica" value="1" checked>';
                                                            }
                                                            else
                                                            {
                                                              echo '<input type="checkbox" id="tce_numeracionAutomatica" name="tce_numeracionAutomatica" value="1">';
                                                            }  
                                                            echo '
                                                            <span class="slider round"></span>
                                                          </label>
                                                        </div>

                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Detalle de Artículos</label>
                                                            <br>
                                                            <label class="switch">';
                                                            if ($assoc_get_tipo_comprobantes['tce_detalleArticulos']==1) 
                                                            {
                                                              echo '<input type="checkbox" id="tce_detalleArticulos" name="tce_detalleArticulos" value="1" checked>';
                                                            }
                                                            else
                                                            {
                                                              echo '<input type="checkbox" id="tce_detalleArticulos" name="tce_detalleArticulos" value="1">';
                                                            }  
                                                            echo '
                                                            <span class="slider round"></span>
                                                          </label>
                                                        </div>


                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Abreviación o Letra</label>
                                                          <input type="text" class="form-control" name="tce_letra" id="tce_letra" value="'.$assoc_get_tipo_comprobantes['tce_letra'].'" placeholder="Abreviación o Letra">
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
                            echo '<div class="modal fade" id="eliminaComprobante'.$assoc_get_tipo_comprobantes['ID_tce'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document" style="width:90%;">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="material-icons">delete_forever</i> ELIMINAR REGISTRO </h4>
                                          </div>
                                          <div class="modal-body">
                                              <div class="alert alert-danger" role="alert">
                                                            <h5><i class="material-icons">warning</i> CUIDADO !!!</h5>
                                                            <p> Usted esta a punto de eliminar el registro '.$assoc_get_tipo_comprobantes['tce_desc'].' y junto a el todos los registros asociados</p>
                                                        </div>      
                                            </div>
                                          <div class="modal-footer">
                                            <a href="accionesExclusivas.php?ID_tce='.$assoc_get_tipo_comprobantes['ID_tce'].'&action=dropComprobante"><button class="btn btn-success">Eliminar registro !</button></a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>';
                                /* Fin Modal elimina cuenta */

                            echo "<tr>";
                                echo "<th>".$assoc_get_tipo_comprobantes['tce_desc']."</th>";
                                echo "<th>".$assoc_get_tipo_comprobantes['fce_desc']."</th>";
                                echo  "<th>";
                                          if ($assoc_get_tipo_comprobantes['tce_movcaja']==1) 
                                          {
                                           echo "<i class='material-icons'>done_all</i>"; 
                                          }
                                          else
                                          {
                                            echo "<i class='material-icons'>cancel</i>"; 
                                          }  
                                      "</th>";
                                  echo  "<th>";
                                          if ($assoc_get_tipo_comprobantes['tce_movstock']==1) 
                                          {
                                           echo "<i class='material-icons'>done_all</i>"; 
                                          }
                                          else
                                          {
                                            echo "<i class='material-icons'>cancel</i>"; 
                                          }  
                                      "</th>";      
                              
                                echo "<th>";
                                          $get_tipo_comprobantesB=$tipo_comprobantes->get_tipo_comprobantesById($assoc_get_tipo_comprobantes['tce_predecesor']);
                                          $assoc_get_tipo_comprobantesB=mysql_fetch_assoc($get_tipo_comprobantesB);
                                          echo $assoc_get_tipo_comprobantesB['tce_desc'];
                                            
                                    "</th>";
                                echo  "<th>";
                                          if ($assoc_get_tipo_comprobantes['tce_fuerzaPredecesor']==1) 
                                          {
                                           echo "<i class='material-icons'>done_all</i>"; 
                                          }
                                          else
                                          {
                                            echo "<i class='material-icons'>cancel</i>"; 
                                          }  
                                      "</th>";
                                       echo  "<th>";
                                          if ($assoc_get_tipo_comprobantes['tce_numeracionAutomatica']==1) 
                                          {
                                           echo "<i class='material-icons'>done_all</i>"; 
                                          }
                                          else
                                          {
                                            echo "<i class='material-icons'>cancel</i>"; 
                                          }  
                                      "</th>";
                                 echo "<th>";
                                         if ($assoc_get_tipo_comprobantes['tce_detalleArticulos']==1) 
                                          {
                                           echo "<i class='material-icons'>done_all</i>"; 
                                          }
                                          else
                                          {
                                            echo "<i class='material-icons'>cancel</i>"; 
                                          }  
                                    "</th>";

                                 echo "<th>".$assoc_get_tipo_comprobantes['tce_letra']."</th>";
                            
                                echo "<th><button data-toggle='modal' title='Modificar datos de la cuenta' data-placement='top' data-target='#editaComprobante".$assoc_get_tipo_comprobantes['ID_tce']."' class='btn btn-primary'><i class='material-icons'>mode_edit</i></button></th>";
                                echo "<th><button data-toggle='modal' title='Eliminar Comprobante' data-placement='top' data-target='#eliminaComprobante".$assoc_get_tipo_comprobantes['ID_tce']."' class='btn btn-danger'><i class='material-icons'>delete_forever</i></button></th>";
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
