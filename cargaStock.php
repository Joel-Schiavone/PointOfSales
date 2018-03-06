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
<form action='accionesExclusivas.php' method='POST'>
 
</div>
<div class="container-fluid">
		  			<div class='col-md-12' style="text-align: center; border-bottom: 1px solid #333; margin-top: 2%; margin-bottom: 2%;">
		  				<div class='col-md-6'>
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

							<div class="form-group">
								<label class="control-label" for="focusedInput"><i class="material-icons">find_in_page</i> Código de Factura </label>
								<input class="form-control" type="text" name="fac_num" id="fac_num"  placeholder="Código de Factura">
							</div>
		  				</div>
		  				<div class='col-md-6'>
							<div id='datosDeFactura' style="display: none;">
							</div>
						</div>	
					</div>		
					<div class='col-md-12' style="text-align: center; margin-top: 2%;">
						
							 	<div class='col-md-3'>	
									 <div class="form-group">
									 	<input type="number" name="cantidad" id='cantidad' class="form-control" placeholder="Cantidad">
									 </div>
							</div>
							<div class='col-md-3'>		 
									 <div class="form-group">
									 	<input type="text" name="costo" id='costo' class="form-control" placeholder="Costo">
									 </div>
							</div>
							<div class='col-md-3'>
									 <div class="form-group">
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
									 		<
									 	</select>
									 </div>
							</div>
							<div class='col-md-3'>
									 <div class="form-group">
									 	<button type="button" class="button btn-success" style="width: 100%;"  id="ejecutarCarga"><i class="material-icons">file_upload</i></button>
									 </div>
							</div>
					
					</div>
	

			   
	</div>
	</form>	
	 /<div id='suggestions' class='suggestions'></div>
	
<!--Fin: Contenedor principal -->

<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>

<!--Fin: Footer -->

<!--Inicio: script -->
	 <script type='text/javascript'>
	          $('#ejecutarCarga').click(function()
	            {
	              var cantidad = $('#cantidad').val();   
	              var costo = $('#costo').val(); 
	              var codigoArticulo = $('#codigoArticulo').val(); 
	              var ID_suc = $('#ID_suc').val(); 
	              var fac_num = $('#fac_num').val(); 
	              var action = "cargarArticulo"; 
	              var dataString = 'cantidad='+cantidad + '&costo='+costo + '&codigoArticulo='+codigoArticulo + '&action='+action + '&ID_suc='+ID_suc + '&fac_num='+fac_num;
	              $.ajax(
	              {
	                  type: 'POST',
	                  url: 'accionesExclusivas.php',
	                  data: dataString,
	                  success: function(data)
	                   {
	                      $('#suggestions').fadeIn(1000).html(data);
	                   }
	               });
	           });



          $('#fac_num').keyup(function()
            { 
              var codigo = $('#fac_num').val();
              var action = 'ListaFacturasPorCodigo';
              var dataString = 'codigo='+codigo + '&action='+action;
              $.ajax(
              {
                  type: 'POST',
                  url: 'accionesExclusivas.php',
                  data: dataString,
                  success: function(data)
                   {
                      $('#datosDeFactura').fadeIn(1000).html(data);
                   }
               });
           });

	</script>
