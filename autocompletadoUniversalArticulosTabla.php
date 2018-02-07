
<?php
include_once('inc/conectar.php');
include_once('inc/classes.php');
include_once('inc/classesExclusivas.php');
$search  			= mysql_real_escape_string($_POST['get_articulos']);
$articulosE 		= new articulosE;
$categorias 		= new categorias;
$categoriasE 		= new categoriasE;
$sub_categoriasE	= new sub_categoriasE;
$proveedoresE		= new proveedoresE;
$num_search 		= strlen($search);

if ($num_search>=3 or $search=="VerTodo")
 {
 	
 	 if ($search=="VerTodo") 
 	{
 		$get_articulos=$articulosE->get_articulosTodos();
 	}
 	else
 	{
 		$array = explode(" ", $search);
		$CountArray = count($array);
		if ($CountArray>=2) 
		{
			
				$get_articulos=$articulosE->get_articulosByArray($array);
			
			
		}
 		else 
 		{
 			$get_articulos=$articulosE->get_articulos($search);
 		}
 	}	
  		 $num_get_articulos=mysql_num_rows($get_articulos);
		    for ($countArticulos=0; $countArticulos < $num_get_articulos; $countArticulos++) 
		    { 
		    		$assoc_get_articulos=mysql_fetch_assoc($get_articulos);
		    		$ID_art=$assoc_get_articulos['ID_art'];

		    			 echo '<tr>';
		    			   	echo '<th id="contenidoTabla">';
								/* Inicio Modal Eliminar*/                          
							 	echo '<div class="modal fade" id="eliminar'.$ID_art.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									    <div class="modal-dialog" role="document">
									        <div class="modal-content">
									            <div class="modal-header">
									                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									                	<span aria-hidden="true">
									                		&times;
									                	</span>
									                </button>
									                <h4 class="modal-title" id="myModalLabel">Eliminar Articulo</h4>
									            </div>
									            <div class="modal-body">
									                
									                    <div class="alert alert-danger" role="alert">
									                      	<h5><i class="material-icons">warning</i> CUIDADO !!!</h5>
									                      	<p> Usted esta a punto de eliminar el articulo '.$assoc_get_articulos['art_desc'].' y junto a el todos los movimientos de cajas anteriores que contengan una venta con este articulo asociado, los montos de las cajas finales no se modificaran pero los movimientos de dicha caja quedaran vacios.</p>
									                     	<input hidden type="text" name="ID_art" value="'.$assoc_get_articulos['ID_art'].'">
									                     	<input hidden type="text" name="ID_pre" value="'.$assoc_get_articulos['ID_pre'].'">
									                     	<input hidden type="text" name="action" value="dropArticulo">
									                      	<p><h4> Estás seguro?</h4></p>
									                      	<a href="accionesExclusivas.php?ID_art='.$assoc_get_articulos['ID_art'].'&ID_pre='.$assoc_get_articulos['ID_pre'].'&action=dropArticulo"><button class="btn btn-success">Si, estoy seguro, Eliminar registro !</button></a>
									                    </div>  	
									                </form>    
									            </div>
									             <div class="modal-footer">
									                <button type="button" class="btn btn-default" data-dismiss="modal">
									                	Cerrar
									                </button>
									            </div>
									        </div> 
									    </div>
									</div>';
									        /* Fin Modal Eliminar */
							echo '</th>';		        
		    			  	echo '<th id="contenidoTabla"> ';
		    			  	 echo '<form action="accionesExclusivas.php" method="POST">';
		                      		$art_cod=$assoc_get_articulos['art_cod'];
		                       		$ID_art=$assoc_get_articulos['ID_art'];
		                       		echo '<input hidden type="text" name="ID_art'.$ID_art.'" id="ID_art'.$ID_art.'" value="'.$ID_art.'">';
		                        	echo '<input hidden type="text" name="action" value="updateArticulo">';
									echo '<input style="width:150px;"  type="text" class="form-control" id="'.$art_cod.'" name="art_cod'.$ID_art.'" value="'.$art_cod.'" readonly>';
		                    echo '</th>';
		                      echo '<th id="contenidoTabla">';
		                      		$art_desc="".$assoc_get_articulos['art_desc']."";
		                      		echo '<span><input type="text" style="width:380px;" class="form-control"  id="art_desc'.$ID_art.'" name="art_desc'.$ID_art.'" value="'.htmlspecialchars($art_desc).'"></input></span>';
		                     echo '</th>';
		                    echo '<th id="contenidoTabla">';
		                     		$ID_cat=$assoc_get_articulos['ID_cat'];
		                      		$cat_desc=$assoc_get_articulos['cat_desc'];
		                       		echo '<select style="width:150px;" class="form-control" id="ID_cat'.$ID_art.'" name="ID_cat'.$ID_art.'">
		                       				<option value='.$ID_cat.' selected>'.$cat_desc.'</option>';
								        	$get_categoriasById = $categoriasE->get_categoriasById($ID_cat);
		  									$num_get_categoriasById = mysql_num_rows($get_categoriasById);
		  									echo "<option value='".$ID_cat."'>".$cat_desc."</option>";
											for ($CatById=0; $CatById < $num_get_categoriasById; $CatById++)
											  { 
											  	 $assoc_get_categoriasById = mysql_fetch_assoc($get_categoriasById);
											  	echo "<option value='".$assoc_get_categoriasById['ID_cat']."'>". $assoc_get_categoriasById['cat_desc']."</option>";
											  }
						    		echo '</select>';
						    		echo '<script language="javascript">
								                $(document).ready(function(){
								                   $("#ID_cat'.$ID_art.'").change(function () {
								                           $("#ID_cat'.$ID_art.' option:selected").each(function () {
								                            elegido'.$ID_art.'=$(this).val();
								                            $.post("combosDependientesCatSubCat.php", { elegido: elegido'.$ID_art.' }, function(data){
								                            $("#ID_sub'.$ID_art.'").html(data);
								                            });            
								                        });
								                   })
								                });
								              </script>';
		                     echo '</th>';
		                     echo '<th id="contenidoTabla">';
		                      		$ID_sub=$assoc_get_articulos['ID_sub'];
		                      		$sub_desc=$assoc_get_articulos['sub_desc'];
		                        	echo '<select style="width:150px;" class="form-control" id="ID_sub'.$ID_art.'" name="ID_sub'.$ID_art.'">
		                        			<option value='.$ID_sub.' selected>'.$sub_desc.'</option>';
								        /*	$get_';sub_categoriasById = $sub_categoriasE->get_sub_categoriasById($ID_sub);
		  									$num_get_sub_categoriasById = mysql_num_rows($get_sub_categoriasById);
		  									echo "<option value='".$ID_sub."'>".$sub_desc."</option>";
											  for ($subCatById=0; $subCatById < $num_get_sub_categoriasById; $subCatById++)
											  { 
											  	 $assoc_get_sub_categoriasById = mysql_fetch_assoc($get_sub_categoriasById);
											  	echo "<option value='".$assoc_get_sub_categoriasById['ID_sub']."'>". $assoc_get_sub_categoriasById['sub_desc']."</option>";
											  }*/
						    		echo '</select>';

		                     echo '</th>';


		                     echo '<th id="contenidoTabla">';
				                      		$ID_pre=$assoc_get_articulos['ID_pre'];
				                     		$pre_cant=$assoc_get_articulos['pre_cant'];
				                      		$pre_cantAB = explode(".",$pre_cant);
				                      		$pre_cantA=$pre_cantAB['0'];
				                      		$pre_cantB=$pre_cantAB['1'];
				                     		echo '<input hidden type="text" name="ID_pre'.$ID_art.'" id="ID_pre'.$ID_art.'" value="'.$ID_pre.'">';
				                     		echo '<input style="width:100px; float:left" type="text" name="pre_cantA'.$ID_art.'" id="pre_cantA'.$ID_art.'" class="form-control" value="'.$pre_cantAB['0'].'">
		                     		 </th>';
		                     		 echo '<th id="contenidoTabla">
		                     					<input style="width:100px; float:right" type="text" name="pre_cantB'.$ID_art.'" id="pre_cantB'.$ID_art.'" class="form-control" value="'.$pre_cantAB['1'].'">';
		                      			echo '</th>';
		                      echo '<th id="contenidoTabla">';
		                      		$pre_poresp=$assoc_get_articulos['pre_porcan'];
		                     		echo '<input style="width:100px;" type="text" name="pre_porcan'.$ID_art.'" id="pre_porcan'.$ID_art.'" class="form-control" value="'.$pre_poresp.'">';
		                     echo '</th>';
		                     echo '<th id="contenidoTabla">';
		                      		$pre_neto=$assoc_get_articulos['pre_neto'];
		                      		$pre_netoAB = explode(".",$pre_neto);
		                      		$pre_netoA=$pre_netoAB['0'];
		                      		$pre_netoB=$pre_netoAB['1'];
		                     		echo '<input type="text" name="pre_netoA'.$ID_art.'" id="pre_netoA'.$ID_art.'"class="form-control" value="'.$pre_netoAB['0'].'" style="width:100px; float:left">
		                     		  </th>';
		                     		echo '<th id="contenidoTabla">';
		                     		echo '<input type="text" name="pre_netoB'.$ID_art.'" id="pre_netoB'.$ID_art.'" class="form-control" value="'.$pre_netoAB['1'].'" style="width:100px; float:right">';
		                     echo '</th>';

		                     	echo "<script>
										$(document).ready(function(){
								          $('#pre_porcan".$ID_art."').keyup(function(){
								          	var pre_netoA   = $('#pre_netoA".$ID_art."').val();
								          	var pre_netoB  = $('#pre_netoB".$ID_art."').val();
								          	var pre_neto   = pre_netoA+'.'+pre_netoB;
								          	var pre_porcant = $('#pre_porcan".$ID_art."').val();
								          	var totalA     = (pre_neto*pre_porcant)/100;
								          	var totalB      = parseInt(totalA)+parseInt(pre_neto);

								          	$('#pre_cantA".$ID_art."').slideUp( 300 );
  											$('#pre_cantA".$ID_art."').fadeIn( 400 );

								          	$('#pre_cantA".$ID_art."').val(totalB);
							          		});

							          		$('#pre_netoA".$ID_art."').keyup(function(){
									          	var pre_neto = $('#pre_netoA".$ID_art."').val();
									          	var pre_porcant = $('#pre_porcan".$ID_art."').val();
									          	var totalA = (pre_neto*pre_porcant)/100;
									          	var totalB = parseInt(totalA)+parseInt(pre_neto);

									          		$('#pre_cantA".$ID_art."').slideUp( 300 );
  													$('#pre_cantA".$ID_art."').fadeIn( 400 );


									          	$('#pre_cantA".$ID_art."').val(totalB);

									          });
										});
							          </script>";



		                     echo '<th id="contenidoTabla">';
		                         	$ID_pro=$assoc_get_articulos['ID_pro'];
		                        	$pro_desc=$assoc_get_articulos['pro_desc'];
		                          	echo '<select style="width:100px;"  class="form-control" id="ID_pro'.$ID_art.'" name="ID_pro'.$ID_art.'">';
								        	$get_proveedoresById = $proveedoresE->get_proveedoresById($ID_pro);
		  									$num_get_proveedoresById = mysql_num_rows($get_proveedoresById);
		  									echo "<option value='".$ID_pro."'>".$pro_desc."</option>";
											  for ($provById=0; $provById < $num_get_proveedoresById; $provById++)
											  { 
											  	 $assoc_get_proveedoresById = mysql_fetch_assoc($get_proveedoresById);
											  	echo "<option value='".$assoc_get_proveedoresById['ID_pro']."'>".$assoc_get_proveedoresById['pro_desc']."</option>";
											  }
						    		echo '</select>';
		                     echo '</th>';
		                   	
		                     echo '<th id="contenidoTabla">';
		                      		$art_unidad=$assoc_get_articulos['art_unidad'];
		                         	echo '<select style="width:100px;" class="form-control" id="art_unidad'.$ID_art.'" name="art_unidad'.$ID_art.'">';
											echo "<option value='".$art_unidad."'>". $art_unidad."</option>";
											if ($art_unidad=='U.')
											{
												echo "<option value='G.'>G.</option>";
											}
											else
											{
												echo "<option value='U.'>U.</option>";
											}	
						    		echo '</select>';
		                     echo '</th>';
		                     echo '<th id="contenidoTabla">';

		                         /*<a href="accionesExclusivas.php?ID_art='.$ID_art.'&art_cod='.$art_cod.'&ID_cat='.$ID_cat.'&ID_sub='.$ID_sub.'&ID_pre='.$ID_pre.'&pre_cantA='.$pre_cantA.'&pre_cantB='.$pre_cantB.'&pre_netoA='.$pre_netoA.'&pre_netoB='.$pre_netoB.'&ID_pro='.$ID_pro.'&art_desc='.$art_desc.'&art_unidad='.$art_unidad.'&action=updateArticulo">*/

		                         
		                        echo '<button class="btn btn-primary" type="submit" id="updateArticulos'.$ID_art.'" Value="Guardar"><i class="material-icons">edit</i></button>'; 
		                        
		                     echo '<script language="javascript">
								                $(document).ready(function(){
								                   $("#updateArticulos'.$ID_art.'").click(function () {
								                        ID_art'.$ID_art.'	 =	$("input:text[name=ID_art'.$ID_art.']").val();
								                        updateArticulo 		 =	"updateArticulo";
								                        art_cod'.$ID_art.' 	 =	$("input:text[name=art_cod'.$ID_art.']").val();
								                        ID_cat'.$ID_art.' 	 =	$("#ID_cat'.$ID_art.' option:selected").val();
								                        ID_sub'.$ID_art.'  	 =	$("#ID_sub'.$ID_art.' option:selected").val();
								                        ID_pre'.$ID_art.'	 =	$("input:text[name=ID_pre'.$ID_art.']").val();
								                        pre_porcan'.$ID_art.'	 =	$("input:text[name=pre_porcan'.$ID_art.']").val();
								                        pre_cantA'.$ID_art.' =	$("input:text[name=pre_cantA'.$ID_art.']").val();
								                        pre_cantB'.$ID_art.' =	$("input:text[name=pre_cantB'.$ID_art.']").val();
								                        pre_netoA'.$ID_art.' =	$("input:text[name=pre_netoA'.$ID_art.']").val();
								                        pre_netoB'.$ID_art.' =	$("input:text[name=pre_netoB'.$ID_art.']").val();
								                        ID_pro'.$ID_art.'	 = $("#ID_pro'.$ID_art.' option:selected").val();
								                        art_desc'.$ID_art.'	 =	$("input:text[name=art_desc'.$ID_art.']").val();
								                        art_unidad'.$ID_art.'=	$("#art_unidad'.$ID_art.' option:selected").val();
								                            $.post("accionesExclusivas.php", { ID_art: ID_art'.$ID_art.', action: updateArticulo, art_cod: art_cod'.$ID_art.', ID_cat: ID_cat'.$ID_art.', ID_sub: ID_sub'.$ID_art.', ID_pre: ID_pre'.$ID_art.' , pre_porcan: pre_porcan'.$ID_art.', pre_cantA: pre_cantA'.$ID_art.', pre_cantB: pre_cantB'.$ID_art.', pre_netoA: pre_netoA'.$ID_art.', pre_netoB: pre_netoB'.$ID_art.', ID_pro: ID_pro'.$ID_art.', art_desc: art_desc'.$ID_art.', art_unidad: art_unidad'.$ID_art.'}, function(data){
								                            $("#respuesta'.$ID_art.'").html(data);     
								                        });
								                   })
								                });
								              </script>';
		                    
		                     
		                     echo '<th id="contenidoTabla">';
		                         	echo '<button  class="btn btn-danger" data-placement="top" title="Presione para eliminar el articulo"   data-toggle="modal" data-target="#eliminar'.$ID_art.'"><i class="material-icons">delete_forever</i></button>';
		                         
		                     echo '</th>';
		           echo '</tr>';
		           echo '<tr>';
		            echo '<th id="contenidoTabla" colspan="11">';
		                      echo '<div id="respuesta'.$ID_art.'" name="respuesta'.$ID_art.'"></div>';
		                       echo '</th>';
					echo '</tr>';		                       
		           /*
						echo "<script type='text/javascript'>
						          $('#updateArticulos".$ID_art."').click(function()
						            {
						            	alert('esta funcionando');
						              var pre_netoB".$ID_art."=$('input:text[name=pre_netoB".$ID_art."]').val();
						               $.post('accionesExclusivas.php', {pre_netoB: pre_netoB, action".$ID_art.": 'updateArticulo'});
						           });
						  </script>";     
					*/		      
			
		  }
		    		
    
	}

?>