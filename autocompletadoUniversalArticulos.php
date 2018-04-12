<?php
include_once('inc/conectar.php');
$search = $_POST['get_articulos'];
$cantidad = $_POST['get_cantidad'];
$ID_ven=$_POST['ID_ven'];
$num_search = strlen($search);

$array = explode(" ", $search);
$CountArray = count($array);

	echo "<div id='recibe_respuesta_insertaMovimiento'>
								</div>";	

	echo "<div id='Contenedor_general_detalles'>";								
		
if ($num_search>=3) // EMPIEZA A BUSCAR A PARTIR DEL SEGUNDO CARACTER 
	{	


		if ($CountArray>=2)  // SI TIENE DOS PALABRAS APLICA EL METODO DE BUSQUEDA CON MATCH O AGAINST
		{
			
	   		$formula2="";
	   		for ($i=0; $i < $CountArray; $i++) 
	   		{ 
	   			$formula=$array[$i];
	   			$formula2=$formula." ".$formula2;
	   		}

	      	$query_articulosA = "SELECT * FROM articulos, sub_categorias, categorias, precios, proveedores WHERE  articulos.ID_sub=sub_categorias.ID_sub AND sub_categorias.ID_cat=categorias.ID_cat AND precios.ID_pre=articulos.ID_pre AND proveedores.ID_pro=articulos.ID_pro AND MATCH (articulos.art_desc) AGAINST ('".$formula2."')";

	      				$queryA=mysql_query($query_articulosA);
						
					
						$num_query_articulosA=mysql_num_rows($queryA);

									
							for ($autocompletadoCountA=0; $autocompletadoCountA < $num_query_articulosA; $autocompletadoCountA++) 
							{ 
								$assoc_query_articulosA=mysql_fetch_assoc($queryA);
								$ID_artA=$assoc_query_articulosA['ID_art'];
									echo "<div class='suggest-element' id='suggestElement".$ID_artA."' style='text-align:left'>
												<button class='btn btn-success' id='articulos' name='articulos' style='height: auto; width: 100%; margin-top: 30px; text-align:center;'>
													<div class='col-md-12'>
														<div class='col-md-2' style='text-align: left'>
															<h4>".$assoc_query_articulosA['art_cod']."</h4>
														</div>	
														<div class='col-md-2'>
															<h4>-</h4>
														</div>	
														<div class='col-md-4'>
															<h4>".$assoc_query_articulosA['art_desc']."</h4>
														</div>	
														<div class='col-md-2'>
															<h4>-</h4>
														</div>	
														<div class='col-md-2' style='text-align: right'>
															<h4>$ ".$assoc_query_articulosA['pre_cant']."</h4>
														</div>	
													</div>		
												</button>
											
							        	</div>
											";

							        echo "<script>
							        	contadorDeClick=0;
							        	$('#suggestElement".$ID_artA."').click(function(){
							        		$('#Contenedor_general_detalles').slideUp(200);	
											var ID_art='".$ID_artA."';
											var cantidad='".$cantidad."';
											
											contadorDeClick = parseInt(contadorDeClick)+parseInt(1);

											var dataString = 'ID_art='+ID_art + '&cantidad='+cantidad;
											
								              $.ajax(
								              {
								                  type: 'POST',
								                  url: 'insertaMovimiento.php',
								                  data: dataString,
								                  success: function(data)
								                   {
								                   
														$('#input_recibe_recibe_respuesta_inseraMovimiento').val(contadorDeClick);
														 $('#ActualizarTablaDetalles').click();
														 $('#get_articulos').val('000000');
                        								 $('#get_articulos').val('');
								                   }
								               });
							        	});
										
							        </script>";
							}		        	

		}
 		else // SI TIENE UNA SOLA PALABRA Y NINGUN ESPACIO UTILIZA EL METODO DE BUSQUEDA LIKE
 		{
 			if (is_numeric($search)) // SI ES SOLO NUMERICO, EN UN FUTURO REEMPLAZAR POR PERILLA QUE CAMBIE DE CODIGO A DESCRIPCION
 			{
 				
 				$query_articulosB = "SELECT * FROM articulos WHERE articulos.art_cod='".$search."'";

 				$queryB=mysql_query($query_articulosB);
						$assoc_query_articulosB=mysql_fetch_assoc($queryB);
						$ID_artB=$assoc_query_articulosB['ID_art'];

 				echo "<script>
							        	contadorDeClick=0;
							        	$(document).ready(function(){
							        		$('#Contenedor_general_detalles').slideUp(200);	
											var ID_art='".$ID_artB."';
											var cantidad='".$cantidad."';

											contadorDeClick = parseInt(contadorDeClick)+parseInt(1);

											var dataString = 'ID_art='+ID_art + '&cantidad='+cantidad;
											
								              $.ajax(
								              {
								                  type: 'POST',
								                  url: 'insertaMovimiento.php',
								                  data: dataString,
								                  success: function(data)
								                   {
								                      $('#recibe_respuesta_insertaMovimiento').fadeIn(1000).html(data);
								                   
														$('#input_recibe_recibe_respuesta_inseraMovimiento').val(contadorDeClick);
														 $('#ActualizarTablaDetalles').click();
														 $('#get_articulos').val('000000');
                        								$('#get_articulos').val('');
								                   }
								               });
							        	});
										
							        </script>";
							        exit();
 			}
 			else // SI TIENE LETRAS
 			{
 				
 				$query_articulosC = ("SELECT * FROM articulos, categorias, sub_categorias, precios WHERE articulos.ID_sub=sub_categorias.ID_sub AND sub_categorias.ID_cat=categorias.ID_cat AND precios.ID_pre=articulos.ID_pre AND (articulos.art_desc like '%".$search."%' OR sub_categorias.sub_desc like '%".$search."%' OR categorias.cat_desc like '%".$search."%' OR articulos.art_cod='".$search."')  ORDER BY art_desc ASC");

 				        $queryC=mysql_query($query_articulosC);
						$num_query_articulosC=mysql_num_rows($queryC);

						
							for ($autocompletadoCountC=0; $autocompletadoCountC < $num_query_articulosC; $autocompletadoCountC++) 
							{ 
								$assoc_query_articulosC=mysql_fetch_assoc($queryC);
								$ID_artC=$assoc_query_articulosC['ID_art'];
									echo "<div class='suggest-element' id='suggest-element".$ID_artC."' style='text-align:left'>
												<button class='btn btn-success' id='articulos' name='articulos' style='height: auto; width: 100%; margin-top: 30px; text-align:center;'>
													<div class='col-md-12'>
														<div class='col-md-2' style='text-align: left'>
															<h4>".$assoc_query_articulosC['art_cod']."</h4>
														</div>	
														<div class='col-md-2'>
															<h4>-</h4>
														</div>	
														<div class='col-md-4'>
															<h4>".$assoc_query_articulosC['art_desc']."</h4>
														</div>	
														<div class='col-md-2'>
															<h4>-</h4>
														</div>	
														<div class='col-md-2' style='text-align: right'>
															<h4>$ ".$assoc_query_articulosC['pre_cant']."</h4>
														</div>	
													</div>		
												</button>
											
											
							        	</div>";

							        echo "<script>
							        	contadorDeClick=0;
							        	$('#suggest-element".$ID_artC."').click(function(){
							        		$('#Contenedor_general_detalles').slideUp(200);	
											var ID_art='".$ID_artC."';
											var cantidad='".$cantidad."';

											contadorDeClick = parseInt(contadorDeClick)+parseInt(1);

											var dataString = 'ID_art='+ID_art + '&cantidad='+cantidad;
											
								              $.ajax(
								              {
								                  type: 'POST',
								                  url: 'insertaMovimiento.php',
								                  data: dataString,
								                  success: function(data)
								                   {
								                      $('#recibe_respuesta_insertaMovimiento').fadeIn(1000).html(data);
								                   
														$('#input_recibe_recibe_respuesta_inseraMovimiento').val(contadorDeClick);
														 $('#ActualizarTablaDetalles').click();
                        								 $('#get_articulos').val('000000');
                        								 $('#get_articulos').val('');
								                   }
								               });

							        	});
										
							        </script>";
								
							}		

 						}	

 			
 				}


				
		
			
						
							
				
			}	

	
//echo "<input type='text' name='input_recibe_respuesta_inseraMovimiento' id='input_recibe_respuesta_inseraMovimiento' value=''>";
echo "</div>";
?>

