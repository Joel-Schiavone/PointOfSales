<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack'] = $_SERVER['REQUEST_URI'];
  $cabecera_comprobantes=new cabecera_comprobantes;
  // $cabecera_comprobantesE=new cabecera_comprobantesE;
  $tipo_comprobantes    = new tipo_comprobantes;
  $tipo_comprobantesE   = new tipo_comprobantesE;
  $cuentas              = new cuentas;
  $cuentasE             = new cuentasE;
  $clientes             = new clientes;
  $articulosE           = new articulosE;
  $stockE               = new stockE;
  $proveedores          = new proveedores;
  $puntos_de_ventas     = new puntos_de_ventas;
  $sucursales           = new sucursales;
  $comprobantesE        = new comprobantesE;
  $detalle_comprobantesE= new detalle_comprobantesE;
  $comprobantes_datosE  = new comprobantes_datosE;
  $puntos_de_ventasE    = new puntos_de_ventasE;
  $FechayHora           = date("Y-m-d H:i:s");
?>
<!--Fin: Documentos requeridos --> 
<style type="text/css">
	th
	{
	 text-align:center;
	}

  p
  {
    text-align: left;
     font-size: 25px;
  }
</style>

                       
<div class="container-fluid">
  		<div class='col-md-12' style="text-align: center;">
  			<div class="alert alert-dismissible alert-danger">
  				<h3> ¿ Eliminar Comprobante ?<img src=media/loading/cargando4.gif id='cargandoBoton' style="display: none;" > </h3>
            <br>
                <button class='btn btn-danger' id='eliminarComprobante'><i class='material-icons'>delete_forever</i> ELIMINAR</button>
        
  			</div> 
  		</div> 
</div>

          
