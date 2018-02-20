<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack'] = $_SERVER['REQUEST_URI'];
  $cuentasE = new cuentasE;
  $monto=150;
?>  

<div class="container-fluid">
  		<div class='col-md-12' style="text-align: center;">
  			<div class="alert alert-dismissible alert-info">
  				<h3><i class="material-icons">explore</i> Metodos de Pago para el Monto de $<?php echo $monto;?><img src='media/loading/cargando4.gif' id='cargandoBoton' style="display: none;" ></h3>
  			</div> 
  		</div> 
</div>

<div class="container">
	<div class="form-group">
		  <div class="input-group">
		    <span class="input-group-addon"><i class="material-icons" style="font-size: 15px;">account_balance_wallet</i> CUENTA</span>
		    <select class="form-control">
		    	<?php 
		    		$get_cuentas=$cuentasE->get_cuentas();
		    		$num_get_cuentas=mysql_num_rows($get_cuentas);
		    		for ($cuentCuentas=0; $cuentCuentas < $num_get_cuentas; $cuentCuentas++) 
		    		{ 
		    			$assoc_get_cuentas=mysql_fetch_assoc($get_cuentas);
		    			echo "<option value='".$assoc_get_cuentas['ID_cue']."'>".$assoc_get_cuentas['cue_desc']." / ".$assoc_get_cuentas['ctp_desc']."</option>";
		    		}
		    	?>
		    	
		    </select>
		  </div>
	</div>
</div>