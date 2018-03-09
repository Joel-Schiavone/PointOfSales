<!--Inicio: Documentos requeridos -->
<?php
	   include_once("inc/requerido.php"); 
     include_once("inc/validacion.php"); 
  	 $ID_usu                      = $_SESSION['ID_usu'];
  	 $_SESSION['PUESTO']          = $_GET['PUESTO'];
  	 $cajaE=new cajaE;	 
	   $get_caja_UltimaByUsu        = $cajaE->get_caja_UltimaByUsu($ID_usu);
	   $assoc_get_caja_UltimaByUsu  = mysql_fetch_assoc($get_caja_UltimaByUsu);
     $puestos                     = new puestos;
     $get_puestosById             = $puestos->get_puestosById($_SESSION['PUESTO']);
     $assoc_get_puestosById       = mysql_fetch_assoc($get_puestosById);



?>
<!--Fin: Documentos requeridos -->
<!--Inicio: classes -->

<!--Fin: classes -->
<!--Inicio: Contenedor principal -->
<div class="container-fluid">
  <!--Inicio: contenedor superior--> 	
  <div class="col-md-12">
  <?php 
  	if ($assoc_get_caja_UltimaByUsu['caj_horac']=='00:00:00')
  	{
  		echo '<div class="col-md-12" style="text-align: center">
  		<a href="cajaSuc.php" class="btn btn-success"><i class="material-icons">exit_to_app</i> Continuar con la caja actual</a>
	  	</div>';
  	}
  	else
  	{
  		echo '<div class="form-group">
		  <label class="control-label">Caja Inicial</label>
		  	 <form action="accionesExclusivas.php" method="POST">
		   		<input hidden type="text" name="action" value="insert_caja">
          <input hidden type="text" name="ID_suc" value="'.$assoc_get_puestosById['ID_suc'].'">
			 	 <div class="input-group">
				    <span class="input-group-addon">$</span>
				    <input type="text" name="caj_inicio" class="form-control">
				    <span class="input-group-btn">
				      <button type="submit" class="btn btn-default" type="button">Comenzar</button>
				    </span>
			  	</div>
		      </form>
  		</div>';
  	}	
  	
?>
   <!--Fin: contenedor medio-->
  </div>
<!--Fin: Contenedor principal -->
<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>
<!--Fin: Footer -->
