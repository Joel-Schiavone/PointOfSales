<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack']= $_SERVER['REQUEST_URI'];
  $articulosE=new articulosE;
  $stockE=new stockE;

?>
<!--Fin: Documentos requeridos -->
<!--Inicio: classes -->

<!--Fin: classes -->	 
<?php

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
				<h3><i class="material-icons">list</i> Listado de Artículos</h3>
			</div> 
		</div> 
		<div class='col-md-12' style="text-align: center;">
			
		<table id="listadoArticulos" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Categoria</th>
                <th>Subcategoria</th>
                <th>Precio de Venta</th>
                <th>Proveedor</th>
                <th>Stock</th>
                <th>Metrica</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Categoria</th>
                <th>Subcategoria</th>
                <th>Precio de Venta</th>
                <th>Proveedor</th>
                <th>Stock</th>
                <th>Metrica</th>
            </tr>
        </tfoot>
        <tbody>
        	<?php 
        		$get_articulosTodosConProveedores=$articulosE->get_articulosTodosConProveedores();
        		$num_get_articulosTodosConProveedores=mysql_num_rows($get_articulosTodosConProveedores);
        		for ($countArticulos=0; $countArticulos < $num_get_articulosTodosConProveedores; $countArticulos++) 
        		{ 
        			$assoc_get_articulosTodosConProveedores=mysql_fetch_assoc($get_articulosTodosConProveedores);
        			$ID_art=$assoc_get_articulosTodosConProveedores['ID_art'];
        			$get_stockBySoloIdArtUltimo=$stockE->get_stockBySoloIdArtUltimo($ID_art);
		        	echo "<tr>";
		                echo "<th>".$assoc_get_articulosTodosConProveedores['art_cod']."</th>";
		                echo "<th>".$assoc_get_articulosTodosConProveedores['art_desc']."</th>";
		                echo "<th>".$assoc_get_articulosTodosConProveedores['cat_desc']."</th>";
		                echo "<th>".$assoc_get_articulosTodosConProveedores['sub_desc']."</th>";
		                echo "<th>".$assoc_get_articulosTodosConProveedores['pre_cant']."</th>";
		                echo "<th>".$assoc_get_articulosTodosConProveedores['pro_desc']."</th>";
		                echo "<th>".$get_stockBySoloIdArtUltimo."</th>";
		                echo "<th>".$assoc_get_articulosTodosConProveedores['art_unidad']."</th>";
		            echo "</tr>";
        		}
        	?>
           
        </tbody>
    </table>
		</div>  
	</div>

	

<!--Fin: Contenedor principal -->


<!--Fin: Footer -->

<!--Inicio: script -->
	 <script type='text/javascript'>

	$(document).ready( function () {
    $('#listadoArticulos').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'print',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                download: 'open'
            }
        ],
        responsive: true,
    	
    });

} );

	 </script>
<!--Fin: script -->

<!--Inicio: Trae Sucursales -->
 

  
<!--Fin: Trae Sucursales -->
<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>
