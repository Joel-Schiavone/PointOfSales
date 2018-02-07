<?php
include_once('inc/conectar.php');
$search = $_POST['get_articulos'];
$cantidad = $_POST['get_cantidad'];
$ID_ven=$_POST['ID_ven'];
$num_search = strlen($search);

$array = explode(" ", $search);
		$CountArray = count($array);
		if ($CountArray>=2) 
		{
			
	   		$formula2="";
	   		for ($i=0; $i < $CountArray; $i++) 
	   		{ 
	   			$formula=$array[$i];
	   			$formula2=$formula." ".$formula2;
	   		}

	      	$query_articulos = "SELECT * FROM articulos, sub_categorias, categorias, precios, proveedores WHERE  articulos.ID_sub=sub_categorias.ID_sub AND sub_categorias.ID_cat=categorias.ID_cat AND precios.ID_pre=articulos.ID_pre AND proveedores.ID_pro=articulos.ID_pro AND MATCH (articulos.art_desc) AGAINST ('".$formula2."') ";

		}
 		else 
 		{
 			$query_articulos = ("SELECT * FROM articulos, categorias, sub_categorias, precios WHERE articulos.ID_sub=sub_categorias.ID_sub AND sub_categorias.ID_cat=categorias.ID_cat AND precios.ID_pre=articulos.ID_pre AND (articulos.art_desc like '%".$search."%' OR sub_categorias.sub_desc like '%".$search."%' OR categorias.cat_desc like '%".$search."%' OR articulos.art_cod='".$search."')  ORDER BY art_desc ASC");

 		}

	
			$query=mysql_query($query_articulos);
			$num_query_articulos=mysql_num_rows($query);

					for ($autocompletadoCount=0; $autocompletadoCount < $num_query_articulos; $autocompletadoCount++) 
					{ 
						$assoc_query_articulos=mysql_fetch_assoc($query);
						if ($search==$assoc_query_articulos['art_cod'] and $num_search>=3) 
							{

								echo "<script>
								<!--
								location.href='insertaMovimiento.php?ID_art=".$assoc_query_articulos['ID_art']."&mov_cantidad=".$cantidad."';
								//-->
								</script>";
							//	echo "<a href='accionesExclusivas.php?ID_art=".$assoc_query_articulos['ID_art']."&action=insert_movimiento'>";echo $assoc_query_articulos['art_cod'];
							//	echo "</a>";
							}

						else
						{	

								if ($num_search>=3)
								{
								echo "<a href='insertaMovimiento.php?ID_art=".$assoc_query_articulos['ID_art']."&mov_cantidad=".$cantidad."'>

										<div class='suggest-element' id='suggest-element' style='text-align:left'>
												<button class='btn btn-success' id='articulos' name='articulos' style='height: auto; width: 100%; margin-top: 30px; text-align:center;'>
													<div class='col-md-12'>
														<div class='col-md-2' style='text-align: left'>
															<h4>".$assoc_query_articulos['art_cod']."</h4>
														</div>	
														<div class='col-md-2'>
															<h4>-</h4>
														</div>	
														<div class='col-md-4'>
															<h4>".$assoc_query_articulos['art_desc']."</h4>
														</div>	
														<div class='col-md-2'>
															<h4>-</h4>
														</div>	
														<div class='col-md-2' style='text-align: right'>
															<h4>$ ".$assoc_query_articulos['pre_cant']."</h4>
														</div>	
													</div>		
												</button>
											
							        	</div></a>";
							}
					}	
			}	


	


?>

