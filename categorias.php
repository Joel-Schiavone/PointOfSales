  <!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php");
  $categoriasE= new categoriasE;
  $sub_categoriasE= new sub_categoriasE;
  $categorias= new categorias;
  $sub_categorias= new sub_categorias;
  $_SESSION['actionsBack']= $_SERVER['REQUEST_URI'];
 ?>



<div class='container'>
	<div class='row'>
		<div class='col-md-12'>
			<div class='col-md-6'>
			<p><h3>CATEGORIAS</h3></p>
				<div class="table-responsive">
			       <table class="table table-condensed table-hover table-striped">
			       	<thead>
			          	<tr id="cabeceraTabla">
			           		<th id="bloqueTabla">
			           		Nº
			         		</th>
			           		<th id="bloqueTabla">
			           		Descripción
			         		</th>
			         		<th id="bloqueTabla" colspan="3">
			           		Acciones
			         		</th>
			         	</tr>
			         </thead>
		  			 <tbody>
		  			 <form class="form-horizontal" action="acciones.php" method="POST">
		  			 <tr>
				          <th style='text-align:center;'>
				            0
				          </th>
				          <th style='text-align:center;'>
				          <input type='text' class='form-control' name='cat_desc' placeholder='Nueva Categoria'>
				          </th>
				           <th style='text-align:center;' colspan='3'>
				            <input hidden type="text" name="action" value="insert_categorias">
				               <button class="btn btn-success" type='submit' data-placement="top" title="AgregaNuevaCategoria" style="width: 100%;"><i class="material-icons">add</i> Agregar</button>
				           </th>
				        </tr>
			    	</form>
		  			 	<?php 
		  			 		$get_categorias = $categorias->get_categorias();
							  $num_get_categorias = mysql_num_rows($get_categorias);
							  	for ($categoriasCount=0; $categoriasCount < $num_get_categorias; $categoriasCount++) 
							  	{ 
							  		$assoc_get_categorias = mysql_fetch_assoc($get_categorias);
							  		$ID_cat=$assoc_get_categorias['ID_cat'];

											/* Inicio Modal Agregar Categoria */                          
										    echo '<div class="modal fade" id="eliminar'.$assoc_get_categorias['ID_cat'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										            <div class="modal-dialog" role="document">
										              <div class="modal-content">
										                 <div class="modal-header">
										                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										                    <h4 class="modal-title" id="myModalLabel">Eliminar Categoría</h4>
										                  </div>
										                  <div class="modal-body">';

										                  	$get_sub_categoriasByIdCat=$sub_categoriasE->get_sub_categoriasByIdCat($ID_cat);
										                  	$num_get_sub_categoriasByIdCat=mysql_num_rows($get_sub_categoriasByIdCat);
										                  	if ($num_get_sub_categoriasByIdCat!=0)
										                  	{
										                  		echo '<div class="alert alert-dismissible alert-danger">
																		  <h4>Cuidado!</h4>
																		  <p>Para lograr eliminar esta categoría, primero elimine las subcategorías asociadas</p>
																		</div>';
										                  	}
										                  	else
										                  	{
										                  			echo '<div class="alert alert-dismissible alert-warning">
																		  <h4>Cuidado!</h4>
																		  <p>Esta seguro que desea eliminar esta categoría ?</p>
																		</div>';
										                  		echo "<a href='accionesExclusivas.php?action=eliminarCategoria&ID_cat=".$assoc_get_categorias['ID_cat']."'><button class='btn btn-danger'><i class='material-icons'>delete_forever</i> Eliminar Categoria</button></a>";
										                  	}	
										                   		

										                  echo '</div>
										                  <div class="modal-footer">
										                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
										                  
										                  </div>
										                </div>
										              </div>
										            </div>
										          </div>';
										        /* Fin Modal Agregar Categoria */


				       			 	echo "<tr>";
				       			 	echo '<form class="form-horizontal" action="accionesExclusivas.php" method="POST">';
						           		echo "<th style='text-align:center;'>";
						           			echo $assoc_get_categorias['ID_cat'];
						         		echo "</th>";
						           		echo "<th style='text-align:center;'>";
						           			echo "<input type='text' class='form-control' name='cat_desc' id='cat_desc".$assoc_get_categorias['ID_cat']."' value='".$assoc_get_categorias['cat_desc']."'>";
						           			  echo '<input hidden type="text" name="action" value="update_categorias">';
                   							  echo '<input hidden type="text" name="ID_cat" value="'.$assoc_get_categorias['ID_cat'].'">';
						         		echo "</th>";
						         		echo "<th style='text-align:center;'>";
						           			echo '<button type="submit" class="btn btn-primary"  data-placement="top" title="Guardar Modificación"><i class="material-icons">edit</i><i class="material-icons">save</i></button>';
						         		echo "</th>";
						         		echo "</form>";
						         		echo "<th style='text-align:center;'>";
						           			echo '<button class="btn btn-danger"  data-placement="top" title="Presione para eliminar la categoria"   data-toggle="modal" data-target="#eliminar'.$assoc_get_categorias['ID_cat'].'" ><i class="material-icons">delete_forever</i></button>';
						         		echo "</th>";
						         		echo "<th style='text-align:center;'>";
						           			echo '<a class="btn btn-info"  data-placement="top" title="Ver Sub Categorias" id="verSubCategorias'.$assoc_get_categorias['ID_cat'].'"><i class="material-icons">layers</i> Ver Sub Categorias</a>';
						         		echo "</th>";
						           echo "</tr>";

						           echo "<script>$('#verSubCategorias".$assoc_get_categorias['ID_cat']."').click(function(){

						           		 	var ID_cat = '".$assoc_get_categorias['ID_cat']."';   
	             							var action = 'muestraSubCategorias'; 
								              var dataString = 'ID_cat='+ID_cat + '&action='+action;
								              $.ajax(
								              {
								                  type: 'POST',
								                  url: 'accionesExclusivas.php',
								                  data: dataString,
								                  success: function(data)
								                   {
								                      $('#suggestions').fadeIn(100).html(data);
								                      $('#nombreDeSubcategoriaSeleccionada').fadeIn(100);
								                      var nombreDeSubcategoriaSeleccionada = $('#cat_desc".$assoc_get_categorias['ID_cat']."').val();
								                      $('#nombreDeSubcategoriaSeleccionada').val(nombreDeSubcategoriaSeleccionada);
								                   }
								               });
						           });</script>";
							  	}
							    
			           	?>
	       			 </tbody>
	       			 <tfoot>
			    	  	<tr id="cabeceraTabla">
			           		<th id="bloqueTabla">
			           		Nº
			         		</th>
			           		<th id="bloqueTabla">
			           		Descripción
			         		</th>
			         			<th id="bloqueTabla" colspan="3">
			           		Acciones
			         		</th>
			           	</tr>
			    	 </tfoot>
			    	</table>
			      </div>	
				</div>
			<div class='col-md-6'>
			<p><h3>SUB CATEGORIAS <input id="nombreDeSubcategoriaSeleccionada" name="nombreDeSubcategoriaSeleccionada" value="" style="border: 0px; display: none;"></h3></p>

				<div class="table-responsive" id="suggestions" class="suggestions">
			       
			      </div>	
				</div>
		</div>		
	</div>
</div>


<?php
	include("modulos/footer.php"); 
?>
<!--Fin: Footer -->

