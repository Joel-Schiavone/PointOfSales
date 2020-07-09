<?php 
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
   $_SESSION['actionsBack']= $_SERVER['REQUEST_URI'];
   $usuariosE= new usuariosE;
   $paramentros= new paramentros;
?>
		<div class='container-fluid' style="text-align: center;">
			
			
				<div class='container' style="text-align: center;">

					<form action="accionesParametros.php" method="POST">

				   
						<input hidden name="action" type="text" value="modificarParametros">
						<?php 
							$ID_par=1;
							$get_paramentrosById=$paramentros->get_paramentrosById($ID_par);
							$assoc_get_paramentrosById=mysql_fetch_assoc($get_paramentrosById);
							$par_razonSocial			=$assoc_get_paramentrosById['par_razonSocial'];
							$par_cuil					=$assoc_get_paramentrosById['par_cuil'];
							$par_telefono				=$assoc_get_paramentrosById['par_telefono'];
							$par_direccion				=$assoc_get_paramentrosById['par_direccion'];
							$par_iva					=$assoc_get_paramentrosById['par_iva'];
							$par_ganancia				=$assoc_get_paramentrosById['par_ganancia'];

						?>

							<div class="form-group">
							  <label class="control-label" for="focusedInput">Razon Social</label>
							  <input class="form-control" name="par_razonSocial" id="par_razonSocial" type="text" value="<?php echo $par_razonSocial?>">
							</div>

							<div class="form-group">
							  <label class="control-label" for="focusedInput">Cuil</label>
							  <input class="form-control" name="par_cuil" id="par_cuil" type="text" value="<?php echo $par_cuil?>">
							</div>

							<div class="form-group">
							  <label class="control-label" for="focusedInput">Dirección</label>
							  <input class="form-control" name="par_direccion" id="par_direccion" type="text" value="<?php echo $par_direccion?>">
							</div>


							<div class="form-group">
							  <label class="control-label" for="focusedInput">Teléfono</label>
							  <input class="form-control" name="par_telefono" id="par_telefono" type="text" value="<?php echo $par_telefono?>">
							</div>

							<div class="form-group">
							  <label class="control-label" for="focusedInput">IVA</label>
							  <input class="form-control" name="par_iva" id="par_iva" type="text" value="<?php echo $par_iva?>">
							</div>
	
							<div class="form-group">
							  <label class="control-label" for="focusedInput">Ganancia</label>
							  <input class="form-control" name="par_ganancia" id="par_ganancia" type="text" value="<?php echo $par_ganancia?>">
							</div>

							<div class="form-group">
							  <button class='btn btn-success'><i class='material-icons'>save</i> Guardar Cambios</button>
							</div>
				
					</form>
				</div>		

	</div>	

<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>
