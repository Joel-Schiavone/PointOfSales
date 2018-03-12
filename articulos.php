<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 

    $_SESSION['actionsBack']= $_SERVER['REQUEST_URI'];
?>
<!--Fin: Documentos requeridos -->
<!--Inicio: classes -->
<!--Fin: classes -->


<style type="text/css">
	#botonesTituloTabla
	{
		font-size:70%;
		text-align: center;
	}
</style>

<?php
  $articulosE  				= 	new articulosE;
  $get_articulosTodos 		=	$articulosE->get_articulosTodos();
  $num_get_articulosTodos 	=	mysql_num_rows($get_articulosTodos);
  $categorias 				= 	new categorias;
  $categoriasE 				= 	new categoriasE;
  $sub_categoriasE 			=	new sub_categoriasE;
  $proveedoresE 			=	new proveedoresE;
  $proveedores 				=	new proveedores;
  $sub_categorias 			=	new sub_categorias;

    /* Inicio Modal Agregar Categoria */                          
    echo '<div class="modal fade" id="categorias" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nueva Categoria</h4>
                  </div>
                  <div class="modal-body">
                  	<form class="form-horizontal" action="accionesExclusivas.php" method="POST">
					  <fieldset>
					    <legend>Nueva Categoria</legend>
					    <div class="form-group">
					      <div class="col-lg-12">
					        <input type="text" class="form-control" id="cat_desc" name="cat_desc" placeholder="Ingrese el Nombre de la Nueva Categoria" required>
					      </div>
					    </div> 
						<div class="form-group">
						      <div class="col-lg-12">
						        <input type="text" class="form-control" id="sub_desc" name="sub_desc" placeholder="Ingrese el Nombre de la Nueva Subcategoria" required>
						      </div>
					      </div> 
					      <div class="form-group">
					      <div class="col-lg-12">
					        <input hidden type="text" name="action" value="insert_categorias">
						        <button type="submit" class="btn btn-success" style="width:96%; margin:2%;">
						        	<i class="material-icons">save</i> Guardar Nueva Categoria
						        </button>
					      </div>
					    </div>
					   </fieldset> 
					 </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>';
        /* Fin Modal Agregar Categoria */

            /* Inicio Modal Agregar Subcategoria */                          
    echo '<div class="modal fade" id="subcategorias" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nueva Subcategorias</h4>
                  </div>
                  <div class="modal-body">
                   	<form class="form-horizontal" action="accionesExclusivas.php" method="POST">
					  <fieldset>
					    <legend>Nueva Subcategoria</legend>
					    <div class="form-group">
					      <div class="col-lg-12">
					        <input type="text" class="form-control" id="sub_desc" name="sub_desc" placeholder="Ingrese el Nombre de la Nueva Subcategoria">
					      </div>
					      </div> 
					      <div class="form-group">
						      <div class="col-lg-12">
						        <select class="form-control" id="ID_cat" name="ID_cat">';
						        	$get_categorias = $categorias->get_categorias();
  									$num_get_categorias = mysql_num_rows($get_categorias);

									  for ($Cat=0; $Cat < $num_get_categorias; $Cat++)
									  { 
									  	 $assoc_get_categorias = mysql_fetch_assoc($get_categorias);
									  	echo "<option value='".$assoc_get_categorias['ID_cat']."'>".$assoc_get_categorias['cat_desc']."</option>";
									  }
									  
						 		 echo '</select>
						      </div>
					     </div> 
					      <div class="form-group">
						      <div class="col-lg-12">
						        <input hidden type="text" name="action" value="insert_sub_categorias">
							        <button type="submit" class="btn btn-success" style="width:96%; margin:2%;">
							        	<i class="material-icons">save</i> Guardar Nueva Subcategoria
							        </button>
						      </div>
					    </div>
					   </fieldset> 
					 </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>';
        /* Fin Modal Agregar Subcategoria */

            /* Inicio Modal Agregar Proveedores */                          
    echo '<div class="modal fade" id="proveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nuevo Proveedor</h4>
                  </div>
                  <div class="modal-body">

                   	<form class="form-horizontal" action="acciones.php" method="POST">
					  <fieldset>
					    <legend>Datos del Proveedor Nuevo</legend>
					     <div class="form-group">
					      <div class="col-lg-12">
					        <input type="text" class="form-control" id="pro_desc" name="pro_desc" placeholder="Ingrese el Nombre del Proveedor">
					      </div>
					      </div> 
					    <div class="form-group">
					      <div class="col-lg-12">
					        <input type="text" class="form-control" id="pro_tel" name="pro_tel" placeholder="Ingrese el Numero de Telefono del Proveedor">
					      </div>
					      </div> 
					       <div class="form-group">
						      <div class="col-lg-12">
						        <input type="text" class="form-control" id="pro_dir" name="pro_dir" placeholder="Ingrese la Dirección del Proveedor">
						      </div>
					      </div> 
					      <div class="form-group">
					      <div class="col-lg-12">
					        <input hidden type="text" name="action" value="insert_proveedores">
						        <button type="submit" class="btn btn-success" style="width:96%; margin:2%;">
						        	<i class="material-icons">save</i> Guardar Nuevo Proveedor
						        </button>
					      </div>
					    </div>
					   </fieldset> 
					 </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  
                  </div>
                </div>
              </div>
            </div>
          </div>';
        /* Fin Modal Agregar Proveedores */


            /* Inicio Modal Agregar Articulo */                          
    echo '<div class="modal fade" id="nuevoArticulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nuevo Articulo</h4>
                  </div>
                  <div class="modal-body">
                  <div class="container-fluid">
                   	<form class="form-horizontal" action="accionesExclusivas.php" method="POST">
					  <fieldset>
					    <legend>Datos del Articulo Nuevo</legend>
					     <div class="form-group">
					     	 <label for="Subcategoria" class="control-label">Subcategoria</label>
					       	<select name="ID_sub" class="form-control">';
					       		$get_categoriasYsub=$categoriasE->get_categoriasYsub();
								$num_get_categoriasYsub=mysql_num_rows($get_categoriasYsub);
								for ($countCatYsub=0; $countCatYsub < $num_get_categoriasYsub; $countCatYsub++) 
								{ 
									$assoc_get_categoriasYsub=mysql_fetch_assoc($get_categoriasYsub);
									echo "<option value='".$assoc_get_categoriasYsub['ID_sub']."'>".$assoc_get_categoriasYsub['cat_desc']." - ".$assoc_get_categoriasYsub['sub_desc']."</option>";
								} 
					echo '</select>
					      </div> 
					          <div class="form-group">
					     	 <label for="Proveedor" class="control-label">Proveedor</label>
					       	<select name="ID_pro" class="form-control">';
					       		$get_proveedores = $proveedores->get_proveedores();
  								$num_get_proveedores = mysql_num_rows($get_proveedores);

 								for ($countSubprovee=0; $countSubprovee < $num_get_proveedores; $countSubprovee++) 
 								{ 
 									  $assoc_get_proveedores = mysql_fetch_assoc($get_proveedores);
 									 echo "<option value='".$assoc_get_proveedores['ID_pro']."'>".$assoc_get_proveedores['pro_desc']."</option>";	
 								}
								 
					echo '</select>
					      </div> 

					        <div class="form-group">
					        	 <label for="art_desc" class="control-label">Descripción</label>
								    <input type="text" name="art_desc" id="art_desc" placeholder="Nombre del Articulo" class="form-control">
								  </div>

						<div class="form-group">
					     	 <label for="art_unidad" class="control-label">Sistema Métrico</label>
					       	<select name="art_unidad" class="form-control">';
 								echo "<option value='U.'>Unidad</option>";
 								echo "<option value='G.'>Gramo</option>";
 								echo "<option value='L.'>Litro</option>";
							echo '</select>
					      </div> 

					        <div class="form-group">
					        	 <label for="pre_neto" class="control-label">Precio de Costo</label>
					        	 <div class="input-group">
								    <span class="input-group-addon">$</span>
								    <input type="text" name="pre_neto" id="pre_neto" placeholder="00.00" class="form-control">
								  </div>
					      </div> 
					        <div class="form-group">
					        	 <label for="pre_porcan" class="control-label">Porcentaje de venta</label>
					        	 <div class="input-group">
								    <span class="input-group-addon">%</span>
								    <input type="text" name="pre_porcan" placeholder="0" class="form-control" id="pre_porcan">
								 </div>
							</div>
						 <div class="form-group">
					        	 <label for="pre_iva" class="control-label">Iva</label>
					        	 <div class="input-group">
								    <span class="input-group-addon">%</span>
								    <input type="text" name="pre_iva"  placeholder="0" class="form-control" id="pre_iva">
								  </div>
					      </div> 
					       <div class="form-group">
					        	  <label for="pre_cant" class="control-label">Precio de Venta</label>
					        	 <div class="input-group">
								    <span class="input-group-addon">$</span>
								    <input type="text" name="pre_cant" id="pre_cant" placeholder="00.00" class="form-control">
								  </div>
					      </div> 

					     				 <div class="form-group has-success" id="contenedorCodigo">
							               <label for="art_cod" class="control-label" id="labelA" style="display:block; text-align: left;">Código del Articulo <i class="material-icons">done</i></label>
							                 <label for="art_cod" class="control-label" id="labelB" style="display:none; text-align: left;">Código del Articulo <i class="material-icons">clear</i> Duplicado</label>
							                    <input type="text" name="art_cod" id="CodigoArticulo" placeholder="Código del Articulo" class="form-control">
							                  
										   </div>

							                <div class="form-group">
							                <div class="col-lg-12">
							                  <input hidden type="text" name="action" value="insert_articulo">
							                    <button type="submit" class="btn btn-success" id="NuevoArticuloBoton" style="width:96%; margin:2%; display:block;">
							                      <i class="material-icons">save</i> Guardar Nuevo Articulo
							                    </button>
							                </div>
							              </div>
												      	  
					   </fieldset> 
					 </form>

                  </div>
                   </div> 
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
              </div>
            </div>
          </div>';
        /* Fin Modal Agregar Articulo */


            /* Inicio Modal Advertencia para ver todos los articulos*/                          
    echo '<div class="modal fade" id="VerTodo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Listar todos los articulos </h4>
                  </div>
                  <div class="modal-body">
                  		<div class="alert alert-dismissible alert-warning">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <h4><ATENCIÓN!</p></h4>
							  <h4><p>¿Está seguro que desea listar la totalidad de Artículos?</p></h4>
							  <p> Listar todos los articulos puede tardar varios minutos inclusive puede llegar a tildar su navegador</p>
							</div>

						        <button class="btn btn-success" style="width:96%; margin:2%;" name="ListarTodo" id="ListarTodo">
						        	<i class="material-icons">list</i> SI, LISTAR TODO AHORA !
						        </button>

						        <img src="media/loading/cargando4.gif" id="cargandoBoton" style="display: none;" >';

						        echo "<script> $('#ListarTodo').click(function()
						            {
						            
						              var VerTodo = 'VerTodo';   
						             
						              var dataString = 'get_articulos='+VerTodo;

						               $.ajax(
						              {
						                  type: 'POST',
						                  url: 'autocompletadoUniversalArticulosTabla.php',
						                  data: dataString,
						                  success: function(data)
						                   {
						                      $('#suggestions').fadeIn(1000).html(data);
						                   }
						               });
						             
						           });</script>";
                  echo "</div>
                  <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>";
        /* Fin  Modal Advertencia para ver todos los articulos*/      
?>
<!--Inicio: Contenedor principal -->

<div class="container-fluid">
		<img src="media/loading/cargando4.gif" id="cargandoBoton" style="display: none;" >
	<div class="col-md-12" style="margin: 1%;">
		<div class="col-md-6">	
			<a class="btn btn-success"  data-placement="top" title="Presione para ingresar un nuevo articulo"   data-toggle="modal" data-target="#nuevoArticulo"><i class='material-icons'>add</i> Ingresar nuevo articulo</a>
		</div>
		<div class="col-md-6">	
			<div class="alert alert-info alert-dismissable">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
	 			<i class="material-icons">shopping_cart</i> Actualmente Existen <?php echo $num_get_articulosTodos;?> Articulos 
			</div>
		</div>
	</div>
    	
    	 <div class="col-md-12" style="text-align: center; margin-bottom: 2%;">
    		<div class="col-md-6">
				<input type="search" name="get_articulos" id="get_articulos" class="form-control" placeholder="Buscar Articulo" autofocus="autofocus">
			</div>	
				<div class="col-md-3">	
					<button class="btn btn-primary" id="VerTodo"  data-placement="top" title="Presione para Ver la totalidad de los articulos"  data-toggle="modal" data-target="#VerTodo"><i class="material-icons">list</i> VER TODO</button>
			</div>
			<div class="col-md-3">	
				<select name="filtroCategorias" id="filtroCategorias" class="form-control">
					<option selected disabled>FILTRAR POR SUBCATEGORIA</option>
					<?php
						$get_categoriasYsub=$categoriasE->get_categoriasYsub();
						$num_get_categoriasYsub=mysql_num_rows($get_categoriasYsub);
						for ($countCatYsub=0; $countCatYsub < $num_get_categoriasYsub; $countCatYsub++) 
						{ 
							$assoc_get_categoriasYsub=mysql_fetch_assoc($get_categoriasYsub);
							echo "<option value='".$assoc_get_categoriasYsub['sub_desc']."'>".$assoc_get_categoriasYsub['cat_desc']." - ".$assoc_get_categoriasYsub['sub_desc']."</option>";
						}
					?>
				</select>
			</div>	
			
		</div>		
		 <div class="col-md-12">
    	<?php 
    	   echo '<div class="table-responsive">';
		        echo '<table class="table table-condensed table-hover table-striped table-bordered">';
		        echo '<thead>';
		           echo '<tr id="cabeceraTabla">';
		            echo '<th id="bloqueTabla">';
		                    
		            echo '</th>';
		            echo '<th id="bloqueTabla">';
		                    echo '<p class="btn btn-info disabled" id="botonesTituloTabla"><i class="material-icons">loyalty</i> Código</p>';
		            echo '</th>';
		              echo '<th id="bloqueTabla">';
		                    echo '<p class="btn btn-info disabled" id="botonesTituloTabla"><i class="material-icons">description</i> Descripción</p>';
		            echo '</th>';
		            echo '<th id="bloqueTabla">';
		                    echo '<button class="btn btn-success" data-placement="top" title="Presione para ingresar una nueva categoria"   data-toggle="modal" data-target="#categorias" id="botonesTituloTabla"><i class="material-icons" 
		                     >add</i> Categoria</button>';
		            echo '</th>';
			            echo '<th id="bloqueTabla">';
			                    echo '<button class="btn btn-success" data-placement="top" title="Presione para ingresar una nueva Subcategoria"   data-toggle="modal" data-target="#subcategorias" id="botonesTituloTabla"><i class="material-icons" 
			                     >add</i> Subcategoria</button>';
			            echo '</th>';
		            echo '<th id="bloqueTabla">';
		                    echo '<p class="btn btn-info disabled" colspan="2" id="botonesTituloTabla"><i class="material-icons">attach_money</i> P. Venta</p>';
		            echo '</th>';
		             echo '<th id="bloqueTabla">';
		                    echo '<p class="btn btn-info disabled" id="botonesTituloTabla"><i class="material-icons">trending_up</i> % Venta</p>';
		            echo '</th>';
		              echo '<th id="bloqueTabla">';
		                    echo '<p class="btn btn-info disabled" id="botonesTituloTabla"><i class="material-icons">trending_up</i> % IVA</p>';
		            echo '</th>';
		            echo '<th id="bloqueTabla">';
		                    echo '<p class="btn btn-info disabled" id="botonesTituloTabla"><i class="material-icons">attach_money</i> P. Costo</p>';
		            echo '</th>';
		            echo '<th id="bloqueTabla">';
		                    echo '<button class="btn btn-success" data-placement="top" title="Presione para ingresar una nueva Proveedor"   data-toggle="modal" data-target="#proveedor" id="botonesTituloTabla"><i class="material-icons" 
		                     >add</i> Prov.</button>';
		            echo '</th>';
		          
		            echo '<th id="bloqueTabla">';
		                    echo '<p class="btn btn-info disabled" id="botonesTituloTabla" id="botonesTituloTabla"><i class="material-icons"> loyalty</i> Metrica</p>';
		            echo '</th>';
					echo '<th id="bloqueTabla" colspan="2">';
		                    echo '<p class="btn btn-info disabled" id="botonesTituloTabla" id="botonesTituloTabla"><i class="material-icons"> settings</i> Acciones</p>';
		            echo '</th>';
		          echo '</tr>';
		         echo '</thead>';
	  			 echo '<tbody id="suggestions" class="suggestions">';
       			 			
       			 echo '</tbody>';
       			 echo '<tfoot>';
		    	  echo '<tr id="cabeceraTabla">';
		    	 	echo '<th id="bloqueTabla">';
		                    
		            echo '</th>';
		            echo '<th id="bloqueTabla">';
		                     echo '<p class="btn btn-info disabled" id="botonesTituloTabla"><i class="material-icons">loyalty</i> Código</p>';
		            echo '</th>';
		              echo '<th id="bloqueTabla">';
		                    echo '<p class="btn btn-info disabled" id="botonesTituloTabla"><i class="material-icons">description</i> Descripción</p>';
		            echo '</th>';
		            echo '<th id="bloqueTabla">';
		                    echo '<a class="btn btn-success" id="botonesTituloTabla"><i class="material-icons">add</i> Categoria</a>';
		            echo '</th>';
		            echo '<th id="bloqueTabla">';
		                    echo '<a class="btn btn-success" id="botonesTituloTabla"><i class="material-icons">add</i> Subcategoria</a>';
		            echo '</th>';
		            echo '<th id="bloqueTabla">';
		                    echo '<p class="btn btn-info disabled" id="botonesTituloTabla"><i class="material-icons">attach_money</i> P. Venta</p>';
		            echo '</th>';
		             echo '<th id="bloqueTabla">';
		                    echo '<p class="btn btn-info disabled" id="botonesTituloTabla"><i class="material-icons">trending_up</i> % Venta</p>';
		            echo '</th>';
		               echo '<th id="bloqueTabla">';
		                    echo '<p class="btn btn-info disabled" id="botonesTituloTabla"><i class="material-icons">trending_up</i> % IVA</p>';
		            echo '</th>';
		            echo '<th id="bloqueTabla">';
		                    echo '<p class="btn btn-info disabled" id="botonesTituloTabla"><i class="material-icons">attach_money</i> P. Costo</p>';
		            echo '</th>';
		            echo '<th id="bloqueTabla">';
		                    echo '<a class="btn btn-success" id="botonesTituloTabla"><i class="material-icons">add</i> Prov.</a>';
		            echo '</th>';
		            echo '<th id="bloqueTabla">';
		                    echo '<p class="btn btn-info disabled" id="botonesTituloTabla"><i class="material-icons"> loyalty</i> Metrica</p>';
		            echo '</th>';
					echo '<th id="bloqueTabla" colspan="2">';
		                    echo '<p class="btn btn-info disabled" id="botonesTituloTabla"	><i class="material-icons"> settings</i> Acciones</p>';
		            echo '</th>';
		           echo '</tr>';
		    	 echo '</tfoot>';
		    	echo '</table>';
		      echo '</div>';
		      	?>
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
	          $('#get_articulos').keyup(function()
	            {
	              var get_articulos = $(this).val();   
	             
	              var dataString = 'get_articulos='+get_articulos ;
	              $.ajax(
	              {
	                  type: 'POST',
	                  url: 'autocompletadoUniversalArticulosTabla.php',
	                  data: dataString,
	                  success: function(data)
	                   {
	                      $('#suggestions').fadeIn(1000).html(data);
	                   }
	               });
	           });


	          $('#CodigoArticulo').keyup(function()
	            {
	              var CodigoArticulo = $(this).val();      
	              var dataString = 'CodigoArticulo='+CodigoArticulo;
	              $.ajax(
	              {
	                  type: 'POST',
	                  url: 'verificadorDeCodDuplicado.php',
	                  data: dataString,
	                  success: function(datas)
	                   {
		                   	if(datas==0)
		                   	{
		                   		 $("#contenedorCodigo").removeClass("form-group has-error");
		                   		 $("#contenedorCodigo").addClass("form-group has-success");
		                   		 $("#labelB").css("display", "none");
		                   		 $("#labelA").css("display", "block");
		                   		 $("#NuevoArticuloBoton").css("display", "block");
		                   	}
		                   	else
		                   	{
		                   		 $("#contenedorCodigo").removeClass("form-group has-success");
		                   		 $("#contenedorCodigo").addClass("form-group has-error");
		                   		 $("#labelA").css("display", "none");
		                   		 $("#labelB").css("display", "block");
		                   		 $("#NuevoArticuloBoton").css("display", "none");
		                   	}	
	                     
	                   	}
	                   
	               });
	           });

	            $('#filtroCategorias').change(function()
	            {
	            	$('#filtroCategorias').css('display: none')
	              var filtroCategorias = $(this).val();   
	             	
	              var dataString = 'get_articulos='+filtroCategorias;

	               $.ajax(
	              {
	                  type: 'POST',
	                  url: 'autocompletadoUniversalArticulosTabla.php',
	                  data: dataString,
	                  success: function(data)
	                   {
	                      $('#suggestions').fadeIn(1000).html(data);
	                      $('#filtroCategorias').fadeIn(1000);
	                   }
	               });
	             
	           });



	        
	         

	          $('#pre_porcan').keyup(function(){
	  			var pre_neto  		= $('#pre_neto').val();
	          	var pre_porcan 		= $('#pre_porcan').val();
	          	var pre_iva  		= $('#pre_iva').val();
	          	var pre_porcanBB	= (pre_iva*pre_neto)/100;
	          	var netoMasIva  	= parseInt(pre_neto)+parseInt(pre_porcanBB);
	          	var totalA  		= (netoMasIva*pre_porcan)/100;
	          	var totalB  		= parseInt(totalA)+parseInt(netoMasIva);
	          	$('#pre_cant').val(totalB);

	          });

	          $('#pre_neto').keyup(function(){
	            var pre_neto  		= $('#pre_neto').val();
	          	var pre_porcan 	= $('#pre_porcan').val();
	          	var pre_iva  		= $('#pre_iva').val();
	          	var pre_porcanBB	= (pre_iva*pre_neto)/100;
	          	var netoMasIva  	= parseInt(pre_neto)+parseInt(pre_porcanBB);
	          	var totalA  		= (netoMasIva*pre_porcan)/100;
	          	var totalB  		= parseInt(totalA)+parseInt(netoMasIva);
	          	$('#pre_cant').val(totalB);
	          });

	          	$('#pre_iva').keyup(function(){
	           	var pre_neto  		= $('#pre_neto').val();
	          	var pre_porcan 	= $('#pre_porcan').val();
	          	var pre_iva  		= $('#pre_iva').val();
	          	var pre_porcanBB	= (pre_iva*pre_neto)/100;
	          	var netoMasIva  	= parseInt(pre_neto)+parseInt(pre_porcanBB);
	          	var totalA  		= (netoMasIva*pre_porcan)/100;
	          	var totalB  		= parseInt(totalA)+parseInt(netoMasIva);
	          	$('#pre_cant').val(totalB);
	          });

	        
	  </script>      
<!--Fin: script -->

<!--Inicio: Trae Sucursales -->
 

  
<!--Fin: Trae Sucursales -->
