<?php 
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
   $_SESSION['actionsBack']= $_SERVER['REQUEST_URI'];
   $proveedores= new proveedores;
?>

 <!--Inicio Modal nueva factura -->
    	<div class="modal fade" id="NuevaFactura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="material-icons">add_box</i>Cargar Nueva Factura</h4>
                  </div>
                  <div class="modal-body" >
                  	<form action='accionesExclusivas.php' method="POST">
                  		<input hidden type="text" name="action" value="cargarFactura">
                  		<div class="form-group">
							  <label class="control-label" for="focusedInput"><i class="material-icons">local_shipping</i> Proveedores</label>
							  <select class="form-control" name="ID_pro" id="ID_pro">
					    			<option selected disabled>Seleccione un Proveedor</option>
					    			<?php
					    				$get_proveedoresB=$proveedores->get_proveedores();
					    				$num_get_proveedoresB=mysql_num_rows($get_proveedoresB);
					    				for ($countproveedoresB=0; $countproveedoresB < $num_get_proveedoresB; $countproveedoresB++) 
					    				{ 
					    					$assoc_get_proveedoresB=mysql_fetch_assoc($get_proveedoresB);
					    					echo '<option value="'.$assoc_get_proveedoresB['ID_pro'].'">'.$assoc_get_proveedoresB['pro_desc'].'</option>';
					    				}
					    			?>
					    		</select>
							</div>

							<div class="form-group">
							  <label class="control-label" for="focusedInput"><i class="material-icons">find_in_page</i> Código de Factura</label>
							 	<input class="form-control" type="text" name="fac_cod" id="fac_cod" placeholder="Código de Factura">	
							</div>

							<div class="form-group">
							  <label class="control-label" for="focusedInput"><i class="material-icons">find_in_page</i> Numero de Seie</label>
							 	<input class="form-control" type="text" name="fac_serie" id="fac_serie" placeholder="Numero de Seie">	
							</div>

							<div class="form-group">
							  <label class="control-label" for="focusedInput"><i class="material-icons">date_range</i> Fecha</label>
							 	<input class="form-control" type="date" name="fac_fecha" id="fac_fecha">	
							</div>

							<div class="form-group">
							  <label class="control-label" for="focusedInput"><i class="material-icons">monetization_on</i> Monto Total</label>
							 	<input class="form-control" type="text" name="fac_total" id="fac_total">	
							</div>


							<div class="form-group">
								<button class="btn btn-success" type="submit" style="width:100%;"><i class="material-icons" style="vertical-align: middle">save</i> Guardar</button>
							</div>
                  	</form>
                  </div>
                  <div class="modal-footer">
                  </div>
                </div>
              </div>
            </div>	
   <!--Fin Modal nueva factura -->

		<div class='col-md-12' style="text-align: center;">
			
				<div class='col-md-12'>
					<div class="alert alert-dismissible alert-info">
						<h3><i class="material-icons">description</i> Facturas de Compras <img src=media/loading/cargando4.gif id='cargandoBoton' style="display: none;" >  </h3>
					</div> 
				</div>	
				<div class='col-md-12' style="margin-top:2%; margin-bottom:2%;">
					<button class="btn btn-success" data-toggle='modal' title='Nueva Factura' data-placement='top' data-target='#NuevaFactura'><i class="material-icons">add_box</i> Cargar Nueva Factura</button>
				</div>
				<div class='col-md-12'>
							<div class="col-md-2">
								<div class="form-group">
								  <label class="control-label" for="focusedInput"><i class="material-icons">date_range</i> Fecha Desde</label>
								  	<input type="date" name="fechaDesde" id="fechaDesde" class="form-control" >
								</div>
						    </div>	
					    	<div class="col-md-2">
								<div class="form-group">
								  <label class="control-label" for="focusedInput"><i class="material-icons">date_range</i> Fecha Hasta</label>
								  	<input type="date" name="fechaHasta" id="fechaHasta" class="form-control" >
								</div>
					    	</div>	
					    	<div class="col-md-3">
							<div class="form-group">
							  <label class="control-label" for="focusedInput"><i class="material-icons">local_shipping</i> Proveedores</label>
							  <select class="form-control" name="ID_pro" id="ID_pro">

					    			<option value="" selected disabled>Seleccione un Proveedor</option>
					    			<option value="null">Ninguno</option>

					    			<?php
					    				$get_proveedores=$proveedores->get_proveedores();
					    				$num_get_proveedores=mysql_num_rows($get_proveedores);
					    				for ($countproveedores=0; $countproveedores < $num_get_proveedores; $countproveedores++) 
					    				{ 
					    					$assoc_get_proveedores=mysql_fetch_assoc($get_proveedores);
					    					echo '<option value="'.$assoc_get_proveedores['ID_pro'].'">'.$assoc_get_proveedores['pro_desc'].'</option>';
					    				}
					    			?>

					    		</select>

							</div>
					    </div>	
					    <div class="col-md-3">
								<div class="form-group">
								  <label class="control-label" for="focusedInput"><i class="material-icons">find_in_page</i> Codigo</label>
								  	<input type="text" name="codigo" id="codigo" class="form-control" >
								</div>
					    	</div>	
					    <div class='col-md-1'  style=' margin-top: 1%; text-align: center;'>
					    	<div class="form-group">
							 <button class='btn btn-success' name='buscar' id='buscar'><i class="material-icons">search</i> Buscar</button>
							</div>
						</div>	
					<div class='col-md-1'  style=' margin-top: 1%; text-align: center;'>
						<div class="form-group">
							<a href="facturasCompras.php"><i class="material-icons">refresh</i></a>
						</div>
					</div>		
				</div> 

			


				<div id="suggestions">
					
				</div>
		
	</div> 

										<script>
										          $('#buscar').click(function() {
										             var fechaDesde=  $('#fechaDesde').val();   
										              var fechaHasta= $('#fechaHasta').val(); 
										              var codigo= $('#codigo').val();  
										              var action='ListaFacturas'; 
										              var ID_pro= $('select[name=ID_pro]').val(); 
										              var dataString = 'fechaDesde='+fechaDesde + '&fechaHasta='+fechaHasta + '&ID_pro='+ID_pro  + '&action='+action + '&codigo='+codigo;
										              
										              $.ajax(
										              {
										                  type: 'POST',
										                  url: 'accionesExclusivas.php',
										                  data: dataString,
										                  success: function(data)
										                   {
										                      $('#suggestions').html(data);
										                   }

										               });
										                 
										           });
                                            </script>