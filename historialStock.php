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

	<div class="container-fluid">
		<div class='col-md-12' style="text-align: center;">
			<div class="alert alert-dismissible alert-info">
				<h3><i class="material-icons">history</i> Hitorial de Movimientos de Stock  <img src=media/loading/cargando4.gif id='cargandoBoton' style="display: none;" > </h3>
			</div> 
		</div> 
		<div class='col-md-12' style="text-align: center;">
			<form action='accionesExclusivas.php' method='POST'>
				<div class='col-md-4'>
						 <div class="form-group">
						 	<label>Fecha Desde:</label>
						 	<input type="date" name="fechaDesde" id='fechaDesde' class="form-control">
						 </div>
				</div>
				<div class='col-md-4'>		 
						 <div class="form-group">
						 	<label>Fecha Hasta:</label>
						 	<input type="date" name="fechaHasta" id='fechaHasta' class="form-control">
						 </div>
				</div>
				<div class='col-md-4'>		  
						 <div class="form-group">
							 <label>Sucursal</label>
							 	<select name="ID_suc" class="form-control" id='buscadorSucursal'>
							 		<option value='0'>Todas</option>
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
			</form>	
			</div>
			   
	</div>

	 <div id="mostradorTabla" style="display: none;"></div>

<!--Fin: Contenedor principal -->

<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>

<!--Fin: Footer -->

<!--Inicio: script -->
	 <script type='text/javascript'>
	          $('#get_articulos').keyup(function()
	            {
	              var get_articulos = $(this).val();   
	             
	              var dataString = 'get_articulos='+get_articulos;
	              $.ajax(
	              {
	                  type: 'POST',
	                  url: 'autocompletadoUniversalArticulosStock.php',
	                  data: dataString,
	                  success: function(data)
	                   {
	                      $('#suggestions').fadeIn(1000).html(data);
	                   }
	               });
	           });


                                                  $(document).ready(function(){
                                                     $("#buscadorSucursal").change(function () {
                                                         $("#buscadorSucursal option:selected").each(function() {
						                                		var fechaDesde = $("#fechaDesde").val();
						                                		var fechaHasta = $("#fechaHasta").val();
						                                		var ID_suc = $('select[name=ID_suc]').val();
						                                		var action = "tablaDeSucursales";
             													 var dataString = "fechaDesde="+fechaDesde + "&fechaHasta="+fechaHasta + "&ID_suc="+ID_suc + "&action="+action ;
													              $.ajax(
													              {
													                  type: "POST",
													                  url: "accionesExclusivas.php",
													                  data: dataString,
													                  success: function(data)
													                   {
													                   	$('#mostradorTabla').fadeIn('1000').html(data);

													                   }
													             });
													       });
													   });
												});  

                                            </script>
<!--Fin: script -->

<!--Inicio: Trae Sucursales -->
 

  
<!--Fin: Trae Sucursales -->
