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



	<div class="container-fluid">

		<div class="col-md-6">
			<div class="panel panel-primary">
			  <div class="panel-heading">
			    <h3 class="panel-title"><i class="material-icons">list</i> LISTADO DE STOCK DE ARTICULOS</h3>
			  </div>
			  <div class="panel-body">
			  		<div class="col-md-12" style="margin-bottom: 2%;">
			  			<!--<div class="col-md-3">	
						  	<button class="btn btn-success" id="TraerTodosLosArticulos" disabled>
						  		<p><i class="material-icons">list</i> LISTAR TODO </p>
								<p> <img src=media/loading/cargando4.gif id='cargandoBoton' style="display: none; width: 50%; height: auto;" > </p>
							</button>
						</div>	-->
						<div class="col-md-12">	

							<div class="form-group"  id="Cuadro">
										  
										  <div class="input-group">
										 
										 	<select name="filtroCategorias" id="filtroCategorias"class="selectpicker" data-live-search="true">
										 		<option selected disabled>FILTRAR POR SUBCATEGORIA</option>
														<?php
																$get_categoriasYsub=$categoriasE->get_categoriasYsub();
																$num_get_categoriasYsub=mysql_num_rows($get_categoriasYsub);
																for ($countCatYsub=0; $countCatYsub < $num_get_categoriasYsub; $countCatYsub++) 
																{ 
																	$assoc_get_categoriasYsub=mysql_fetch_assoc($get_categoriasYsub);
																	echo "<option value='".$assoc_get_categoriasYsub['ID_sub']."'>".$assoc_get_categoriasYsub['cat_desc']." - ".$assoc_get_categoriasYsub['sub_desc']."</option>";
																}
														?>
										 	</select>
										 </div>
									</div>	

							
							
						</div>	
								
						<div class="col-md-3">	
						</div>
						<div class="col-md-3">	
						</div>
					</div>
					<div class="col-md-12">	
						 <div id='listarStockArticulos' class='col-md-12' style='display:none'>
						</div>		
					</div>
				</div>
			</div>
		</div>

		<!--////////////////////////////////////////////////////////////////A R T I C U L O S  P O R  S U C U R S A L-->

		<div class="col-md-6">
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title"><i class="material-icons">assessment</i> STOCK DE ARTICULO POR SUCURSAL</h3>
		  </div>
		  <div class="panel-body">
								
							  <div class="col-md-12">
								<input type="text" name="get_articulos" id="get_articulos" class="form-control" placeholder="Buscar Articulo" autofocus="autofocus">
								<div id='suggestions' class='suggestions'></div>
							  </div>

						<?php 
							if (@$_GET['ID_art'])
							{
								$ID_art=$_GET['ID_art'];

								$get_articulosById = $articulos->get_articulosById($ID_art);
								$assoc_get_articulosById = mysql_fetch_assoc($get_articulosById);

								echo "<div class='col-md-12'>";
									echo "<div class='alert alert-info alert-dismissable' style='margin-top: 1%;'>";
									echo "<i class='material-icons'>shopping_cart</i> Estas viendo el Stock por sucursal del Articulo: ".$assoc_get_articulosById['art_desc'];
									echo "</div>";
								echo "</div>";
									
							}
						?>

						 <div class="col-md-12" >
						 	<?php
						 		$get_sucursales=$sucursalesE->get_sucursales();
						 		$num_get_sucursales=mysql_num_rows($get_sucursales);
						 		$delay=0;
						 		for ($countSuc=0; $countSuc < $num_get_sucursales; $countSuc++) 
						 		{ 
						 			$assoc_get_sucursales=mysql_fetch_assoc($get_sucursales);
						 			$ID_suc=$assoc_get_sucursales['ID_suc'];

						 			@$get_stockByIdArtUltimo=$stockE->get_stockByIdArtUltimo($ID_art, $ID_suc);
						 			@$assoc_get_stockByIdArtUltimo=mysql_fetch_assoc($get_stockByIdArtUltimo);
						 			@$num_get_stockByIdArtUltimo=mysql_num_rows($get_stockByIdArtUltimo);

						 			
						 			
						 			echo "<div class='col-md-1'>"; 
						 			echo "</div>";
						 			echo "<div class='col-md-5' style='text_align:center; margin-top:4%; border-top:5px solid #099; border-bottom:5px solid #099; border-radius: 20px 20px 20px 20px; padding:2%;'>";
						 				echo "<div class='alert alert-info alert-dismissable' style='text-align:center; font-size:120%; display:none;' id='sucursalStock".$ID_suc."'>";
							 				echo "<strong><i class='material-icons'>store</i> ".$assoc_get_sucursales['suc_desc']."<strong>";	
							 			echo "</div>";
							 			echo "<div class='col-md-12' style='display:none; text-align:center;' id='contenidoStock".$ID_suc."'>";	
								 			echo "<div class='col-md-3'>";	
								 				echo "<img src='".$assoc_get_sucursales['suc_icono']."' style='width:130%;'>";
								 			echo "</div>";	
								 			echo "<div class='col-md-1'>"; 
						 					echo "</div>";
								 			echo "<div class='col-md-7' style='text-align:center;'>";	
								 				if ($num_get_stockByIdArtUltimo==0)
								 				{
								 					echo "<p style='font-size:350%; color:#099;'> 0 U.</p>";	
								 					$boton="disabled";
								 				}
								 				else
								 				{	

											    /* Inicio Modal Exportar Stock */                          
											    echo '<div class="modal fade" id="exportar'.$ID_suc.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											            <div class="modal-dialog" role="document">
											              <div class="modal-content">
											                 <div class="modal-header">
											                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											                    <h4 class="modal-title" id="myModalLabel">Exportar Stock</h4>
											                  </div>
											                  <div class="modal-body">
											                    <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
											                    <div class="form-group">
											                      <label for="pto_asig">Ingrese Cantidad</label>
											                      <input type="number" name="cantidad" placeholder="Cantidad Maxima Permitida: '.$assoc_get_stockByIdArtUltimo['sto_total'].'" class="form-control"  max="'.$assoc_get_stockByIdArtUltimo['sto_total'].'" required>
											                    </div>';
											                    echo '<div class="form-group"> 
											                     	<label for="ID_sucB">Seleccione Destinatario</label> 
											                     	<select name="ID_sucB" class="form-control">';
												                      	$get_sucursalesB=$sucursalesE->get_sucursales();
																 		$num_get_sucursalesB=mysql_num_rows($get_sucursalesB);
																 		for ($countSucB=0; $countSucB < $num_get_sucursalesB; $countSucB++) 
																 		{ 
																 			$assoc_get_sucursalesB=mysql_fetch_assoc($get_sucursalesB);
																 			$ID_sucB=$assoc_get_sucursalesB['ID_suc'];
																 			$suc_descB=$assoc_get_sucursalesB['suc_desc'];

																 			echo "<option value='".$ID_sucB."'>".$suc_descB."</option>";

																 		}	
															  	echo "<select>";	
															  echo '</div>
											                     <input hidden type="text" name="action" value="exportarStock">
											                     <input hidden type="text" name="ID_art" value="'.$ID_art.'">
											                     <input hidden type="text" name="ID_suc" value="'.$ID_suc.'">
											                    
											                  </div>
											                  <div class="modal-footer">
											                    <button class="btn btn-success" type="submit" style="width:100%;"><i class="material-icons" style="vertical-align: middle">backup</i> Enviar</button>
											                  </div>
											                    </form>
											                </div>
											              </div>
											            </div>';
											     /* Fin Modal Exportar Stock */

											       /* Inicio Modal Quitar Mercaderia */                   
											    echo '<div class="modal fade" id="quitar'.$ID_suc.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											            <div class="modal-dialog" role="document">
											              <div class="modal-content">
											                 <div class="modal-header">
											                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											                    <h4 class="modal-title" id="myModalLabel">Quitar Stock</h4>
											                  </div>
											                  <div class="modal-body">
											                    <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
											                    <div class="form-group">
											                      <label for="pto_asig">Ingrese Cantidad</label>
											                      <input type="number" name="cantidad" placeholder="Cantidad Maxima Permitida: '.$assoc_get_stockByIdArtUltimo['sto_total'].'" class="form-control"  max="'.$assoc_get_stockByIdArtUltimo['sto_total'].'" required>
											                    </div>
											                    <div class="form-group"> 
											                     	<label for="ID_sucB">Detalle el motivo</label> 
											                     	<textarea name="sto_desc" placeholder="Descripción del motivo por la quita de mercaderia"></textarea>
															  	</div>
											                     <input hidden type="text" name="action" value="quitarStock">
											                     <input hidden type="text" name="ID_art" value="'.$ID_art.'">
											                     <input hidden type="text" name="ID_suc" value="'.$ID_suc.'">
											                    
											                  </div>
											                  <div class="modal-footer">
											                    <button class="btn btn-success" type="submit" style="width:100%;"><i class="material-icons" style="vertical-align: middle">backup</i> Enviar</button>
											                  </div>
											                    </form>
											                </div>
											              </div>
											            </div>';
											     /* Fin Modal Quitar Mercaderia */

								 					echo "<p style='font-size:350%; color:#099;'> " . $assoc_get_stockByIdArtUltimo['sto_total'] . " " . $assoc_get_articulosById['art_unidad'] . "</p>";
								 					$boton="";	
								 				}	
								 			echo "</div>";	
								 			echo "<div class='col-md-1'>"; 
						 					echo "</div>";
								 		echo "</div>";
								 	  	echo "<div class='col-md-12' style='text-align:center; margin-top:5%;'>"; 
							      			echo "<div class='col-md-6'>";
							      				echo "<button ".$boton." class='btn btn-success' data-toggle='modal' title='Enviar mercaderia a otra sucursal' data-placement='top' data-target='#exportar".$ID_suc."' style='width:90%;'><strong><i class='material-icons'>unarchive</i> Exportar</strong></button>";
							      			echo "</div>"; 
							      			echo "<div class='col-md-6'>";
							      				echo "<button ".$boton." class='btn btn-danger'  data-toggle='modal' title='Quitar mercaderia manualmente y con motivo' data-placement='top' data-target='#quitar".$ID_suc."' style='width:100%;'><strong><i class='material-icons'>report</i> Quitar</strong></button>";
							      			echo "</div>"; 
						 		  		echo "</div>";  		
						 			echo "</div>";
						 			echo "<div class='col-md-1'>"; 
						 			echo "</div>";
						 			$delay=300+$delay;
						 			echo "<script>
							          $('#contenidoStock".$ID_suc."').delay(".$delay.").toggle('slow');
							          $('#sucursalStock".$ID_suc."').delay(".$delay.").toggle('slow');</script>";
						 		}
						 	?>
						 </div>
		  </div>
		</div>			 
</div>

</div>
<!--Fin: Contenedor principal -->

<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>

<!--Fin: Footer -->

<!--Inicio: script -->
	 <script type='text/javascript'>

			    $('#filtroCategorias').change(function()
	            {

	              $('#filtroCategorias').css('display: none')
	              var ID_sub = $('#filtroCategorias').val();   
	              var action = "listarArticulosPorCategoria"; 
	              var dataString = 'ID_sub='+ID_sub + '&action='+action;

	               $.ajax(
	              {
	                  type: 'POST',
	                  url: 'accionesStock.php',
	                  data: dataString,
	                  success: function(data)
	                   {
	                       $('#listarStockArticulos').fadeIn(1000).html(data);
	                   }
	               });
	             
	           });

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

	          $("#TraerTodosLosArticulos").click(function(){
	          	var action = "listarArticulos";   
	            var dataString = 'action='+action;
	          	$.ajax(
	              {
	                  type: 'POST',
	                  url: 'accionesStock.php',
	                  data: dataString,
	                  success: function(data)
	                   {
	                      $('#listarStockArticulos').fadeIn(1000).html(data);
	                   }
	               });

	          });

	         
			  // tu elemento que quieres activar.
			  var cargandoBoton = $("#cargandoBoton");

			  // evento ajax start
			  $(data).ajaxStart(function() {
			    cargandoBoton.show();
			  });

			  // evento ajax stop
			$(data).ajaxSuccess(function() {
			    cargandoBoton.hide();
			  });
			
	  </script>     

	
<!--Fin: script -->

<!--Inicio: Trae Sucursales -->
 

  
<!--Fin: Trae Sucursales -->
