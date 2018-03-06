<?php 
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
   $_SESSION['actionsBack']= $_SERVER['REQUEST_URI'];
   $usuariosE= new usuariosE;
?>
		<div class='col-md-12' style="text-align: center;">
			
			
				
				<div class='col-md-12'>
						<div class="col-md-6">
							<div class="form-group">
							  <label class="control-label" for="focusedInput"><i class="material-icons">date_range</i> Fecha Desde</label>
							  	<input type="date" name="fechaDesde" id="fechaDesde" class="form-control" >
							</div>
					    </div>	
					    	<div class="col-md-6">
							<div class="form-group">
							  <label class="control-label" for="focusedInput"><i class="material-icons">date_range</i> Fecha Hasta</label>
							  	<input type="date" name="fechaHasta" id="fechaHasta" class="form-control" >
							</div>
					    </div>	
					   	<div class="col-md-6">
							<div class="form-group">
								<div class='col-md-3'>
								  	<label class="control-label" for="focusedInput"><i class="material-icons">done_all</i> Validados</label><br>
							  		<label class="switch">
									  <input type="checkbox" id="validados" name="validados" value="si" checked>
									  <span class="slider round"></span>
									</label>
								</div>
								<div class='col-md-3'>
								  	<label class="control-label" for="focusedInput"><i class="material-icons">done_all</i> Criticas</label><br>
							  		<label class="switch">
									  <input type="checkbox" id="criticas" name="criticas" value="si" checked>
									  <span class="slider round"></span>
									</label>
								</div>
								<div class='col-md-3'>
								  	<label class="control-label" for="focusedInput"><i class="material-icons">done_all</i> Abiertas</label><br>
							  		<label class="switch">
									  <input type="checkbox" id="abiertas" name="abiertas" value="si" checked>
									  <span class="slider round"></span>
									</label>
								</div>
								<div class='col-md-3'>
								  	<label class="control-label" for="focusedInput"><i class="material-icons">done_all</i> Cerradas</label><br>
							  		<label class="switch">
									  <input type="checkbox" id="cerradas" name="cerradas" value="si" checked>
									  <span class="slider round"></span>
									</label>
								</div>
							</div>
					    </div>	
					    	<div class="col-md-6">
							<div class="form-group">
							  <label class="control-label" for="focusedInput"><i class="material-icons">face</i> Usuarios</label>
							  <select class="form-control" name="ID_usu" id="ID_usu">

					    			<option value="ID_usu" selected disabled>Seleccione un Usuario</option>

					    			<?php
					    				$get_usuarios=$usuariosE->get_usuarios();
					    				$num_get_usuarios=mysql_num_rows($get_usuarios);
					    				for ($countUsuarios=0; $countUsuarios < $num_get_usuarios; $countUsuarios++) 
					    				{ 
					    					$assoc_get_usuarios=mysql_fetch_assoc($get_usuarios);
					    					echo '<option value="'.$assoc_get_usuarios['ID_usu'].'">'.$assoc_get_usuarios['usu_apellido'].' '.$assoc_get_usuarios['usu_nombre'].'</option>';
					    				}
					    			?>

					    		</select>


							</div>
					    </div>	
				</div> 

				<div class='col-md-12'>
				 <buttom class='btn btn-success' name='buscar' id='buscar' style='width: 100%; margin-top: 2%; margin-bottom: 2%;'><i class="material-icons">search</i> Buscar</buttom> <img src=media/loading/cargando4.gif id='cargandoBotonBuscar' style="display: none; width: 50%; height: auto;" >
				</div>


				<div id="suggestions">
					
				</div>
		
	</div> 

										<script>
										          $('#buscar').click(function() {
										             var fechaDesde=  $('#fechaDesde').val();   
										              var fechaHasta= $('#fechaHasta').val(); 
										              var validados= $('input:checkbox[name=validados]:checked').val();  
										              var criticas= $('input:checkbox[name=criticas]:checked').val();  

										              var abiertas= $('input:checkbox[name=abiertas]:checked').val();  
										              var cerradas= $('input:checkbox[name=cerradas]:checked').val();  

										              var ID_usu= $('select[name=ID_usu]').val(); 
										              var dataString = 'fechaDesde='+fechaDesde + '&fechaHasta='+fechaHasta + '&validados='+validados + '&ID_usu='+ID_usu + '&criticas='+criticas + '&abiertas='+abiertas + '&cerradas='+cerradas;



										              
										              $.ajax(
										              {
										                  type: 'POST',
										                  url: 'buscadorDeCajas.php',
										                  data: dataString,
										                  success: function(data)
										                   {
										                      $('#suggestions').html(data);
										                   }

										               });
										                 
										           });

										            // tu elemento que quieres activar.
													  var cargandoBotonBuscar = $("#cargandoBotonBuscar");

													  // evento ajax start
													  $(data).ajaxStart(function() {
													    cargandoBotonBuscar.show();
													  });

													  // evento ajax stop
													$(data).ajaxSuccess(function() {
													    cargandoBotonBuscar.hide();
													  });

													 // tu elemento que quieres activar.
			

                                            </script>


<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>
