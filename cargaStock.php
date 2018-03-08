<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack']= $_SERVER['REQUEST_URI'];
?>
<!--Fin: Documentos requeridos -->
<!--Inicio: classes -->

<!--Fin: classes -->	 
<?php
  $articulosE  				= 	new articulosE;
  $articulos  				= 	new articulos;
  $get_articulosTodos 		=	$articulosE->get_articulosTodos();
  $num_get_articulosTodos 	=	mysql_num_rows($get_articulosTodos);
  $categorias 				= 	new categorias;
  $categoriasE 				= 	new categoriasE;
  $sub_categoriasE 			=	new sub_categoriasE;
  $proveedoresE 			=	new proveedoresE;
  $sucursalesE 				=	new sucursalesE;
  $stockE 					=   new stockE;
?>

<style type="text/css">
	th
	{
	 text-align:center;
	}
</style>
 		
		<div id="div_respuesta"></div>

		<div class="container-fluid">
		  			<div class='col-md-12' style="text-align: center; margin-top: 2%; margin-bottom: 2%;">
		  
		  						<div class="form-group">
									<label class="control-label" for="focusedInput"><i class="material-icons">store</i> Seleccione Sucursal </label>
									<select name="ID_suc"  class="form-control" id='ID_suc' required>
											
														<?php
															$get_sucursales=$sucursalesE->get_sucursales();
													 		$num_get_sucursales=mysql_num_rows($get_sucursales);
													 		for ($countSuc=0; $countSuc < $num_get_sucursales; $countSuc++) 
													 		{ 
													 			$assoc_get_sucursales=mysql_fetch_assoc($get_sucursales);
													 			$ID_suc=$assoc_get_sucursales['ID_suc'];
													 			$suc_desc=$assoc_get_sucursales['suc_desc'];
													 			echo "<option value='".$ID_suc."'>".$suc_desc."</option>";
															}
														?>
										</select>	
								</div>
		  				
					</div>		

					<div class='col-md-12' style="text-align: center; margin-top: 2%;">

								<div class='col-md-5'>

									<div class="form-group"  id="Cuadro">
										  <label class="control-label">Articulo</label>
										  <div class="input-group">
										 
										 	<select name="codigoArticulo" id="codigoArticulo" class="selectpicker" data-live-search="true">
										 		<option selected disabled></option>
										 		<?php 
										 			$get_articulosTodos=$articulosE->get_articulosTodos();
										 			$num_get_articulosTodos=mysql_num_rows($get_articulosTodos);
										 			for ($countArticulos=0; $countArticulos < $num_get_articulosTodos; $countArticulos++) 
										 			{ 
										 				$assoc_get_articulosTodos=mysql_fetch_assoc($get_articulosTodos);
										 				echo "<option value='".$assoc_get_articulosTodos['art_cod']."'>".$assoc_get_articulosTodos['art_cod']." - ".$assoc_get_articulosTodos['art_desc']."</option>";
										 			}
										 		?>
										 	</select>
										 </div>
									</div>	

								</div>
							 <div class='col-md-1'>	

									 <div class="form-group"  id="cantidad_Cuadro">
									  <label class="control-label">Cantidad</label>
									  <div class="input-group">
									    <span class="input-group-addon">Nº</span>
									    <input type="number" name="cantidad" id='cantidad' class="form-control" placeholder="Cantidad">
									  </div>
									</div>

							</div>
							<div class='col-md-1'>

									<div class="form-group" id="pre_neto_Cuadro" style="display: none;">
									  <label class="control-label">Precio de Costo</label>
									  <div class="input-group">
									    <span class="input-group-addon">$</span>
									    <input type="text" class="form-control" name="pre_neto_Recibidor" id="pre_neto_Recibidor" value="" >
									  </div>
									</div>

							</div>
							<div class='col-md-1'>

									<div class="form-group"  id="pre_porcan_Cuadro" style="display: none;">
									  <label class="control-label">% Venta</label>
									  <div class="input-group">
									    <span class="input-group-addon">%</span>
									    <input type="text" class="form-control" name="pre_porcan_Recibidor" id="pre_porcan_Recibidor" value="" >
									  </div>
									</div>

							</div>
							<div class='col-md-1'>

											<div class="form-group" id="pre_iva_Cuadro" style="display: none;">
												  <label class="control-label">% IVA</label>
												  <div class="input-group">
												    <span class="input-group-addon">%</span>
												    <input type="text" class="form-control" name="pre_iva_Recibidor" id="pre_iva_Recibidor" value="" >
												  </div>
												</div>

							</div>
							<div class='col-md-1'>	
										

										    <div class="form-group" id="pre_cant_Cuadro" style="display: none;">
											  <label class="control-label">Precio de Venta</label>
											  <div class="input-group">
											    <span class="input-group-addon">$</span>
											    <input type="text" class="form-control" name="pre_cant_Recibidor" id="pre_cant_Recibidor"  value="" readonly>
											  </div>
											</div>

											
							</div>
							<div class='col-md-2' id="boton_Cuadro" style="display: none;">
									<br>
									 <div class="form-group">
									 	<button type="button" class="button btn-success" style="width: 100%;"  id="ejecutarCarga"><i class="material-icons">file_upload</i> Guardar</button>
									 </div>
							</div>
					
				</div>
	

			   
	</div>
	<hr>
	 <div id='suggestions' class='suggestions'></div>
	
<!--Fin: Contenedor principal -->

<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>

<!--Fin: Footer -->

<!--Inicio: script -->

<script>
										$('#codigoArticulo').change(function(){
											var codigoArticulo 	= $('#codigoArticulo').val();
											var action 			= "TraeArticuloPorCodigo";
											var dataString = 'art_cod='+codigoArticulo + '&action='+action;

													  $.ajax(
			                                              {
			                                                  type: 'POST',
			                                                  url: 'accionesArticulos.php',
			                                                  data: dataString,
			                                                  success: function(data)
			                                                   {
			                                                      $('#div_respuesta').fadeIn(100).html(data);

			                                                      $('#pre_neto_Cuadro').fadeIn(100);
			                                                      $('#pre_porcan_Cuadro').fadeIn(100);
			                                                      $('#pre_iva_Cuadro').fadeIn(100);
			                                                      $('#pre_cant_Cuadro').fadeIn(100);
			                                                      $('#boton_Cuadro').fadeIn(100);

			                                                      var pre_neto=$('#pre_neto').val();
			                                                      $('#pre_neto_Recibidor').val(pre_neto);

			                                                      var pre_porcan=$('#pre_cant').val();
			                                                      $('#pre_porcan_Recibidor').val(pre_porcan);

			                                                      var pre_iva=$('#pre_iva').val();
			                                                      $('#pre_iva_Recibidor').val(pre_iva);

			                                                      var pre_cant=$('#pre_cant').val();
			                                                      $('#pre_cant_Recibidor').val(pre_cant);
			                                                   }

			                                               });
										});



				$('#pre_neto_Recibidor').keyup(function()
				{
					var pre_neto=$('#pre_neto_Recibidor').val();
					var pre_porcan=$('#pre_porcan_Recibidor').val();
					var pre_iva=$('#pre_iva_Recibidor').val();

					var pre_netoA = (parseInt(pre_neto)*parseInt(pre_porcan))/100;
					var pre_netoB = (parseInt(pre_neto)+parseInt(pre_netoA));
					var pre_netoC = (parseInt(pre_netoB)*parseInt(pre_iva))/100;
					var pre_netoD = (parseInt(pre_netoB)+parseInt(pre_netoC));
					
					$('#pre_cant_Recibidor').val(pre_netoD);	

				});

				$('#pre_porcan_Recibidor').keyup(function()
				{
					var pre_neto=$('#pre_neto_Recibidor').val();
					var pre_porcan=$('#pre_porcan_Recibidor').val();
					var pre_iva=$('#pre_iva_Recibidor').val();

					var pre_netoA = (parseInt(pre_neto)*parseInt(pre_porcan))/100;
					var pre_netoB = (parseInt(pre_neto)+parseInt(pre_netoA));
					var pre_netoC = (parseInt(pre_netoB)*parseInt(pre_iva))/100;
					var pre_netoD = (parseInt(pre_netoB)+parseInt(pre_netoC));
					
					$('#pre_cant_Recibidor').val(pre_netoD);	

				});


				$('#pre_iva_Recibidor').keyup(function()
				{
					var pre_neto=$('#pre_neto_Recibidor').val();
					var pre_porcan=$('#pre_porcan_Recibidor').val();
					var pre_iva=$('#pre_iva_Recibidor').val();

					var pre_netoA = (parseInt(pre_neto)*parseInt(pre_porcan))/100;
					var pre_netoB = (parseInt(pre_neto)+parseInt(pre_netoA));
					var pre_netoC = (parseInt(pre_netoB)*parseInt(pre_iva))/100;
					var pre_netoD = (parseInt(pre_netoB)+parseInt(pre_netoC));
					
					$('#pre_cant_Recibidor').val(pre_netoD);	

				});


	          $('#ejecutarCarga').click(function()
	            {
	              var cantidad = $('#cantidad').val();
	              var pre_neto=$('#pre_neto_Recibidor').val();
				  var pre_porcan=$('#pre_porcan_Recibidor').val();
				  var pre_iva=$('#pre_iva_Recibidor').val();  
	              var pre_cant = $('#pre_cant_Recibidor').val(); 
	              var codigoArticulo = $('#codigoArticulo').val(); 
	              var ID_suc = $('#ID_suc').val();  
	              var action = "cargarArticulo"; 
	              var dataString = 'cantidad='+cantidad
	               + '&codigoArticulo='+codigoArticulo
	               + '&action='+action
	               + '&pre_neto='+pre_neto 
	               + '&pre_porcan='+pre_porcan 
	               + '&pre_iva='+pre_iva 
	               + '&pre_cant='+pre_cant
	               + '&ID_suc='+ID_suc;

	              $.ajax(
	              {
	                  type: 'POST',
	                  url: 'accionesStock.php',
	                  data: dataString,
	                  success: function(data)
	                   {
	                      $('#suggestions').fadeIn(1000).html(data);
	                   }
	               });
	           });



        

	</script>
