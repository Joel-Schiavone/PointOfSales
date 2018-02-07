<?php
include_once("inc/requeridoSinCarga.php"); 
$cajaE= new cajaE;
$usuarios= new usuarios;
$sucursales= new sucursales;
$adjuntosE= new adjuntosE;
$venta_detalleE= new venta_detalleE;
$ventas_canceladasE= new ventas_canceladasE;

if ($_POST['fechaDesde']) 
{
	$fechaDesde= " AND caj_fec BETWEEN CAST('".$_POST['fechaDesde']."' AS DATE)";
}
else
{
	$fechaDesde="";
}
if ($_POST['fechaHasta']) 
{
	$fechaHasta= " AND CAST('".$_POST['fechaHasta']."' AS DATE)"; 
}
else
{
	$fechaHasta="";
}
if ($_POST['validados']=="si" or $_POST['criticas']=="si") 
{
	if ($_POST['validados']=="si" AND $_POST['criticas']=="si") 
	{
		$validados=" AND (ID_control='1' or ID_control='2')";
	}
	elseif($_POST['validados']=="si" AND $_POST['criticas']!="si")
	{
		$validados=" AND ID_control='1'";
	}
	elseif($_POST['validados']!="si" AND $_POST['criticas']=="si")
	{
		$validados=" AND ID_control='2'";
	}
}
else
{
	$validados="";
}

if ($_POST['abiertas']=="si" or $_POST['cerradas']=="si") 
{

	if ($_POST['abiertas']=="si" AND $_POST['cerradas']=="si") 
	{

		$estado="";
	}
	elseif($_POST['abiertas']=="si" AND $_POST['cerradas']!="si")
	{
		$estado=" AND caj_horac='00:00:00' ";
	}
	elseif($_POST['abiertas']!="si" AND $_POST['cerradas']=="si")
	{
		$estado=" AND caj_horac!='00:00:00'";
	}
}

else
{
	$estado="";
}

if ($_POST['ID_usu']!='null') 
{
	$ID_usu= " AND ID_usu='".$_POST['ID_usu']."'"; 
}
else
{
	$ID_usu="";
}


  //echo "SELECT * FROM caja WHERE caj_horaa!='00:00:00' ".@$fechaDesde." ".@$fechaHasta." ".@$validados." ".@$ID_usu." ".@$estado."";

  $sql="SELECT * FROM caja WHERE caj_horaa!='00:00:00'  ".@$fechaDesde." ".@$fechaHasta."  ".@$validados." ".@$ID_usu." ".@$estado."";
  $result_stock=mysql_query($sql);
  $num_result_stock=mysql_num_rows($result_stock);   

  for ($countCajas=0; $countCajas < $num_result_stock; $countCajas++) 
  { 
  	$assoc_result_stock=mysql_fetch_assoc($result_stock);   
  	$ID_usu=$assoc_result_stock['ID_usu'];
  	$ID_caj=$assoc_result_stock['ID_caj'];

  	$get_usuariosById=$usuarios->get_usuariosById($ID_usu);
  	$assoc_get_usuariosById=mysql_fetch_assoc($get_usuariosById);
    
    //Calcula totales, sobrantes y faltantes
    $ingresos=$assoc_result_stock['cja_vta']+$assoc_result_stock['cja_vtad']+$assoc_result_stock['cja_vct']+$assoc_result_stock['cja_vef'];
	$EnCaja=$assoc_result_stock['cja_vef']+$assoc_result_stock['caj_inicio'];
    $egresos=$assoc_result_stock['caj_cierre'];
    $totales=$assoc_result_stock['caj_vne'];
    $diferencia=$assoc_result_stock['caj_efectivoReal']-$EnCaja;
     if ($diferencia==0) 
    {
    	$diferenciaTexto="EXACTA";
    	$diferenciaColor="default";
    }
    elseif ($diferencia>=1) 
    {
    	$diferenciaTexto="SOBRANTE";
    	$diferenciaColor="success";
    }
    else
    {
    	$diferenciaTexto="FALTENTE";
    	$diferenciaColor="danger";
    }	

    //Indica si esta abierta o cerrada
    if ($assoc_result_stock['caj_horac']=='00:00:00') 
    {
    	$estadoTexto="ABIERTA";
    	$estadoColor="success";
    	$estadoIcono="<i class='material-icons'>flag</i>";
    }
    else
    {
    	$estadoTexto="CERRADA";
    	$estadoColor="danger";	
    	$estadoIcono="<i class='material-icons'>block</i>";
    }	

    //Busca sucursal
    $ID_suc=$assoc_result_stock['ID_suc'];
	$get_sucursalesById=$sucursales->get_sucursalesById($ID_suc);
	$assoc_get_sucursalesById=mysql_fetch_assoc($get_sucursalesById);

	//Trae adjuntos 
	$adj_ID_rel=$assoc_result_stock['ID_caj'];
	$adj_tablaRel='caja';
	$get_adjuntosBYId_Rel=$adjuntosE->get_adjuntosBYId_Rel($adj_ID_rel, $adj_tablaRel);
	$num_get_adjuntosBYId_Rel=mysql_num_rows($get_adjuntosBYId_Rel);

	//Busca los pagos con cta cte de cada caja
	$get_venta_detalleByIdCajYIdFpoCTACTE=$venta_detalleE->get_venta_detalleByIdCajYClientes($ID_caj);
	$num_get_venta_detalleByIdCajYIdFpoCTACTE=mysql_num_rows($get_venta_detalleByIdCajYIdFpoCTACTE);

	//Busca los pagos con tarjetas de credito de cada caja
	$ID_fpoCREDITO=3;
	$get_venta_detalleByIdCajYIdFpoCREDITO=$venta_detalleE->get_venta_detalleByIdCajYIdFpo($ID_caj, $ID_fpoCREDITO);
	$num_get_venta_detalleByIdCajYIdFpoCREDITO=mysql_num_rows($get_venta_detalleByIdCajYIdFpoCREDITO);

	//Busca los pagos con tarjetas de debito de cada caja
	$ID_fpoDEBITO=4;
	$get_venta_detalleByIdCajYIdFpoDEBITO=$venta_detalleE->get_venta_detalleByIdCajYIdFpo($ID_caj, $ID_fpoDEBITO);
	$num_get_venta_detalleByIdCajYIdFpoDEBITO=mysql_num_rows($get_venta_detalleByIdCajYIdFpoDEBITO);

	//Busca los movimientos cancelados de cada caja
	$get_venta_canceladasByIdCaj=$ventas_canceladasE->get_venta_canceladasByIdCaj($ID_caj);
	$num_get_venta_canceladasByIdCaj=mysql_num_rows($get_venta_canceladasByIdCaj);

          /* Inicio Modal Ingresos tarjeta creditos */                     
    echo '<div class="modal fade" id="modalDetallesDeIngresosTarjetaCreditos'.$ID_caj.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="material-icons">credit_card</i> DETALLES DE VENTAS: TARJETAS DE CREDITO</h4>
                  </div>
                  <div class="modal-body"><div class="container-fluid">';
		
		                   		for ($countTarjetasCredito=0; $countTarjetasCredito < $num_get_venta_detalleByIdCajYIdFpoCREDITO; $countTarjetasCredito++) 
		                   		{ 
		                   			$assoc_get_venta_detalleByIdCajYIdFpoCREDITO=mysql_fetch_assoc($get_venta_detalleByIdCajYIdFpoCREDITO);
		                   			echo "<div class='col-md-12'>
				                   			<div class='panel panel-default'>
						  						<div class='panel-body'>
					                   					<div class='col-md-3'>";
					                   					echo " <img src='".$assoc_get_venta_detalleByIdCajYIdFpoCREDITO['tar_logo']."' style='width:100%;'>";
						                   				echo "</div>";
						                   			echo "<div class='col-md-9' style='text-align:left;'>";
						                   				echo "<p><i class='material-icons'>chevron_right</i> PLAN: ".$assoc_get_venta_detalleByIdCajYIdFpoCREDITO['tarjeta_pla_desc']."</p>";
						                   				echo "<p><i class='material-icons'>chevron_right</i> CUOTAS: ".$assoc_get_venta_detalleByIdCajYIdFpoCREDITO['tarjeta_pla_cant']."</p>";
						                   				echo "<p><i class='material-icons'>chevron_right</i> RECARGO: % ".$assoc_get_venta_detalleByIdCajYIdFpoCREDITO['tarjeta_pla_recargo']."</p>";
						                   				echo "<p><i class='material-icons'>chevron_right</i> COBROS REALIZADOS: ".$assoc_get_venta_detalleByIdCajYIdFpoCREDITO['cantidad_de_ventas']."</p>";
						                   				echo "<p><i class='material-icons'>chevron_right</i> MONTO TOTAL COBRADO: $ ".$assoc_get_venta_detalleByIdCajYIdFpoCREDITO['suma_monto']."</p>";
						                   			echo "</div>
						                   			</div>
				                   			</div>
		                   				</div>";
		                   		}	

	              	 		echo ' </div>
          		 </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>';
        /* Fin Modal Ingresos tarjeta creditos*/

            /* Inicio Modal Ingresos tarjeta debito*/                          
    echo '<div class="modal fade" id="modalDetallesDeIngresosTarjetaDebitos'.$ID_caj.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="material-icons">credit_card</i> DETALLES DE VENTAS: TARJETAS DE DEBITO</h4>
                  </div>
                  <div class="modal-body">
                  	<div class="container-fluid">';
					
		                   		for ($countTarjetasDEBITO=0; $countTarjetasDEBITO < $num_get_venta_detalleByIdCajYIdFpoDEBITO; $countTarjetasDEBITO++) 
		                   		{ 
		                   			$assoc_get_venta_detalleByIdCajYIdFpoDEBITO=mysql_fetch_assoc($get_venta_detalleByIdCajYIdFpoDEBITO);
		                   			echo "<div class='col-md-12'>
				                   			<div class='panel panel-default'>
						  						<div class='panel-body'>
					                   					<div class='col-md-3'>";
					                   					echo " <img src='".$assoc_get_venta_detalleByIdCajYIdFpoDEBITO['tar_logo']."' style='width:100%;'>";
						                   				echo "</div>";
						                   			echo "<div class='col-md-9' style='text-align:left;'>";
						                   				echo "<p><i class='material-icons'>chevron_right</i> PLAN: ".$assoc_get_venta_detalleByIdCajYIdFpoDEBITO['tarjeta_pla_desc']."</p>";
						                   				echo "<p><i class='material-icons'>chevron_right</i> CUOTAS: ".$assoc_get_venta_detalleByIdCajYIdFpoDEBITO['tarjeta_pla_cant']."</p>";
						                   				echo "<p><i class='material-icons'>chevron_right</i> RECARGO: % ".$assoc_get_venta_detalleByIdCajYIdFpoDEBITO['tarjeta_pla_recargo']."</p>";
						                   				echo "<p><i class='material-icons'>chevron_right</i> COBROS REALIZADOS: ".$assoc_get_venta_detalleByIdCajYIdFpoDEBITO['cantidad_de_ventas']."</p>";
						                   				echo "<p><i class='material-icons'>chevron_right</i> MONTO TOTAL COBRADO: $ ".$assoc_get_venta_detalleByIdCajYIdFpoDEBITO['suma_monto']."</p>";
						                   			echo "</div>
						                   			</div>
				                   			</div>
		                   				</div>";
		                   		}	

	              	 		echo '</div>
          		 </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>';
        /* Fin Modal Ingresos tarjeta debito*/


            /* Inicio Modal Ingresos cuenta corriente*/                          
    echo '<div class="modal fade" id="modalDetallesDeIngresosCuentaCorriente'.$ID_caj.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="material-icons">note</i> DETALLES DE VENTAS: CUENTAS CORRIENTES</h4>
                  </div>
                  <div class="modal-body">
                 	<div class="container-fluid">';
					
		                   		for ($countTarjetasCTACTE=0; $countTarjetasCTACTE < $num_get_venta_detalleByIdCajYIdFpoCTACTE; $countTarjetasCTACTE++) 
		                   		{ 
		                   			$assoc_get_venta_detalleByIdCajYIdFpoCTACTE=mysql_fetch_assoc($get_venta_detalleByIdCajYIdFpoCTACTE);
		                   			echo "<div class='col-md-12'>
				                   			<div class='panel panel-default'>
						  						<div class='panel-body'>
					                   					<div class='col-md-3'>";
					                   					echo "<p><i class='material-icons' style='width:100%;'>account_circle</i></p>";
					                   					echo "<p>".$assoc_get_venta_detalleByIdCajYIdFpoCTACTE['cli_apellido']." ".$assoc_get_venta_detalleByIdCajYIdFpoCTACTE['cli_nombre']."</p>";
						                   				echo "</div>";
						                   			echo "<div class='col-md-9' style='text-align:left;'>";
						                   				echo "<p><i class='material-icons'>chevron_right</i> COBROS REALIZADOS: ".$assoc_get_venta_detalleByIdCajYIdFpoCTACTE['cantidad_de_ventas']."</p>";
						                   				echo "<p><i class='material-icons'>chevron_right</i> MONTO TOTAL COBRADO: $ ".$assoc_get_venta_detalleByIdCajYIdFpoCTACTE['suma_monto']."</p>";
						                   			echo "</div>
						                   			</div>
				                   			</div>
		                   				</div>";
		                   		}	

	              	 		echo '</div>
          		 </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>';
        /* Fin Modal Ingresos cuenta corriente*/



	    /* Inicio Modal imprimir Informe */                          
    echo '<div class="modal fade" id="modalImprimirInforme'.$ID_caj.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">IMPRIMIR INFORME DE CAJA</h4>
                  </div>
                  <div class="modal-body">
                    <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                   	
						
                    </form>
          		 </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>';
        /* Fin Modal Imprimir informe */


	    /* Inicio Modal validar */                          
    echo '<div class="modal fade" id="modalValidar'.$ID_caj.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">VALIDAR CAJA</h4>
                  </div>
                  <div class="modal-body">
                  <div class="container-fluid">
                    <div class="alert alert-dismissible alert-warning" id="alertaValidacion'.$ID_caj.'">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <h4>Cuidado!</h4>
					  <p>¿Estás seguro que desea validar esta caja?</p>
					  <p><button id="validar'.$ID_caj.'" class="btn btn-success"><i class="material-icons">done_all</i> SI, VALIDAR</p>
					</div>
					<div class="alert alert-dismissible alert-success" id="alertaValidada'.$ID_caj.'" style="display:none;">
					  <button type="button" class="close" data-dismiss="alert" >&times;</button> <img src=media/loading/cargando4.gif id="cargandoBotonValidar'.$ID_caj.'" style="display: none;" > 
					  <h4>Bien echo!</h4>
					  <p>Se validó correctamente la caja</p>
					</div>
          		 </div>
          		   </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>';

            echo '<script>
						$("#validar'.$ID_caj.'").click(function(){
							  var action=  "validarCaja";   
							  var ID_caj= "'.$ID_caj.'"; 
							  var ID_control= "1";
							   var dataString = "ID_caj="+ID_caj + "&action="+action + "&ID_control="+ID_control;
										              
										              $.ajax(
										              {
										                  type: "POST",
										                  url: "accionesExclusivas.php",
										                  data: dataString,
										                  success: function(dataValidar)
										                   {
										                      $("#control01'.$ID_caj.'").css("display", "none");
										                      $("#control02'.$ID_caj.'").css("display", "none");
										                      $("#control21'.$ID_caj.'").css("display", "none");
															  $("#alertaValidacion'.$ID_caj.'").css("display", "none");
															  $("#alertaValidada'.$ID_caj.'").fadeIn(500);
															  $("#cartelDeValidacionwarning'.$ID_caj.'").css("display", "none");
				  											  $("#cartelDeValidaciondanger'.$ID_caj.'").css("display", "none");
				 											  $("#cartelDeValidacionSuccess'.$ID_caj.'").fadeIn(500);
										                   }

										               });
						});


													  var cargandoBotonValidar'.$ID_caj.' = $("#cargandoBotonValidar'.$ID_caj.'");

													
													  $(dataValidar).ajaxStart(function() {
													    cargandoBotonValidar'.$ID_caj.'.show();
													  });

													  
													$(dataValidar).ajaxSuccess(function() {
													    cargandoBotonValidar'.$ID_caj.'.hide();
													  });
            		</script>';
        /* Fin Modal validar */


	    /* Inicio Modal critica */                          
    echo '<div class="modal fade" id="modalCriticia'.$ID_caj.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">CAJA CRITICA</h4>
                  </div>
                  <div class="modal-body">
                     <div class="container-fluid">
                    <div class="alert alert-dismissible alert-warning" id="alertandoCritica'.$ID_caj.'">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <h4>Cuidado!</h4>
					  <p>¿Estás seguro que desea marcar esta caja como critica?</p>
					  <p><button id="critica'.$ID_caj.'" class="btn btn-success"><i class="material-icons">done_all</i> SI, MARCAR</p>
					</div>
					<div class="alert alert-dismissible alert-success" id="alertaCritica'.$ID_caj.'" style="display:none;">
					  <button type="button" class="close" data-dismiss="alert" >&times;</button> <img src=media/loading/cargando4.gif id="cargandoBotonCritica'.$ID_caj.'" style="display: none;" > 
					  <h4>Bien echo!</h4>
					  <p>La caja se marcó como critica correctamente</p>
					</div>
          		 </div>
          		 </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>';
        /* Fin Modal critica */   

          echo '<script>
						$("#critica'.$ID_caj.'").click(function(){
							  var action=  "validarCaja";   
							  var ID_caj= "'.$ID_caj.'"; 
							  var ID_control= "2";
							   var dataString = "ID_caj="+ID_caj + "&action="+action + "&ID_control="+ID_control;
										              
										              $.ajax(
										              {
										                  type: "POST",
										                  url: "accionesExclusivas.php",
										                  data: dataString,
										                  success: function(dataValidar)
										                   {
										                      $("#control01'.$ID_caj.'").css("display", "block");
										                      $("#control02'.$ID_caj.'").css("display", "none");
										                      $("#control21'.$ID_caj.'").css("display", "none");
															  $("#alertandoCritica'.$ID_caj.'").css("display", "none");
															  $("#alertaCritica'.$ID_caj.'").fadeIn(500);
															  $("#cartelDeValidacionwarning'.$ID_caj.'").fadeIn(500);
				  											  $("#cartelDeValidaciondanger'.$ID_caj.'").css("display", "none");
				 											  $("#cartelDeValidacionSuccess'.$ID_caj.'").css("display", "none");
										                   }

										               });
						});


													  var cargandoBotonValidar'.$ID_caj.' = $("#cargandoBotonValidar'.$ID_caj.'");

													
													  $(dataValidar).ajaxStart(function() {
													    cargandoBotonValidar'.$ID_caj.'.show();
													  });

													  
													$(dataValidar).ajaxSuccess(function() {
													    cargandoBotonValidar'.$ID_caj.'.hide();
													  });
            		</script>';
        /* Fin Modal validar */


	    /* Inicio Modal movimientos eliminados */                          
    echo '<div class="modal fade" id="modalMovimientosEliminados'.$ID_caj.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">MOVIMIENTOS ELIMINADOS</h4>
                  </div>
                  <div class="modal-body">
                   		
                   				<div class="container-fluid">';
					
		                   		for ($countVentasCanceladas=0; $countVentasCanceladas < $num_get_venta_canceladasByIdCaj; $countVentasCanceladas++) 
		                   		{ 
		                   			$assoc_get_venta_canceladasByIdCaj=mysql_fetch_assoc($get_venta_canceladasByIdCaj);
		                   			echo "<div class='col-md-12'>
				                   			<div class='panel panel-default'>
						  						<div class='panel-body'>
					                   					<div class='col-md-3'>";
					                   					echo "<p>".$assoc_get_venta_canceladasByIdCaj['art_desc']."</p>";
						                   				echo "</div>";
						                   			echo "<div class='col-md-9' style='text-align:left;'>";
						                   				echo "<p><i class='material-icons'>chevron_right</i> Cancelaciones: ".$assoc_get_venta_canceladasByIdCaj['CantidadDeCancelaciones']."</p>";
						                   					echo "<p><i class='material-icons'>chevron_right</i> Codigo: ".$assoc_get_venta_canceladasByIdCaj['art_cod']."</p>";
						                   			echo "</div>
						                   			</div>
				                   			</div>
		                   				</div>";
		                   		}	

	              	 	
          		 echo'</div></div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>';
        /* Fin Modal movimientos eliminados */

  echo "<div class='container'>
  			<div class='col-md-12'>
	  			<div class='panel panel-default'>
				  <div class='panel-heading'  style='min-height:50px;'>
				   
				    		<h3 class='panel-title'>
						    	<div class='col-md-12'>
						    		<div class='col-md-4'>
										<i class='material-icons'>account_circle</i> ".$assoc_get_usuariosById['usu_nombre']." ".$assoc_get_usuariosById['usu_apellido']."
						    		</div>
						    		<div class='col-md-4'>
										<p class='text-".$estadoColor."'>".$estadoIcono." ".$estadoTexto."</p>
						    		</div>
						    		<div class='col-md-4'>
										<i class='material-icons'>store</i> ".$assoc_get_sucursalesById['suc_desc']."
						    		</div>
						    	</div>
					    	</h3>
				    
				  </div>


				  <div class='panel-body'>";
				  	if ($assoc_result_stock['ID_control']==0) 
				  	   {	
				  		echo "<div class='alert alert-dismissible alert-warning' id='cartelDeValidacionwarning".$ID_caj."'>
								  <button type='button' class='close' data-dismiss='alert'>&times;</button>
								  <h4>Pendiente!</h4>
								  <p>Caja pendiente de validación</p>
								</div>";
						}	
						if ($assoc_result_stock['ID_control']==2) 
				  	   {	
				  		echo "<div class='alert alert-dismissible alert-danger' id='cartelDeValidaciondanger".$ID_caj."'>
								  <button type='button' class='close' data-dismiss='alert'>&times;</button>
								  <h4>Atención!</h4>
								  <p>Caja Critica</p>
								</div>";
						}
						if ($assoc_result_stock['ID_control']==1) 
				  	   {	
				  		echo "<div class='alert alert-dismissible alert-success' id='cartelDeValidacionSuccess".$ID_caj."'>
								  <button type='button' class='close' data-dismiss='alert'>&times;</button>
								  <h4>Validada</h4>
								  <p>Caja validada correctamente</p>
								</div>";
						}	
	

					echo "<div class='panel panel-default'>
	  						<div class='panel-body'>
							    <div class='col-md-12'>
									
								    	<div class='col-md-12' style:'text-align:center'>
								    		<i class='material-icons'>date_range</i> ".$assoc_result_stock['caj_fec']."
								    	</div>
								    	<div class='col-md-3'>
								    		 ".$assoc_result_stock['caj_horaa']." HS.
								    	</div>
										<div class='col-md-1' style='text-align:right'>
								    		<p><i class='material-icons'>schedule</i></p>
								    		<p style='font-size:50%; text-align:right'> <strong> APERTURA</strong> </P>
								    	</div>	
								    	<div class='col-md-4' style='margin-left:-30px; margin-right:-35px;'>
								    		<div style='vertical-align:bottom; border-bottom:3px solid #333; width:100%; height:15px;'></div>
								    	</div>
										<div class='col-md-1'>
								    		<p><i class='material-icons' style='text-align:left'>watch_later</i></p>
								    		<p style='font-size:50%; text-align:center'><strong>CIERRE</strong> </P>
								    	</div>
								    	<div class='col-md-3'>
								    		  ".$assoc_result_stock['caj_horac']." HS.
								    	</div>
							    </div>
							</div>
						</div>
						<div class='panel panel-default'>
	  						<div class='panel-body'>
							      <div class='col-md-12' style='text-align:left; font-size:70%;'>
							
								     	<div class='col-md-3' style='border:2px solid #007E33;'>
											<p style='font-size:150%; font-weight: bold; border-bottom: 1px solid #007E33;  text-align:center;'><i class='material-icons'>details</i> DETALLES DE VENTAS</p>
											<p style='text-align:left; width:100%; font-size:100%;'><i class='material-icons'>chevron_right</i> CAJA INICIAL: $ ".$assoc_result_stock['caj_inicio'] . "  </p>
											<p style='text-align:left; width:100%; font-size:100%;'><i class='material-icons'>chevron_right</i> EFECTIVO: $ ".$assoc_result_stock['cja_vef']." </p>
											<p style='text-align:left;'><button class='btn btn-default' style='text-align:left; width:100%; font-size:100%;' data-toggle='modal' title='Ver detalles de ventas con tarjeta de crédito' data-target='#modalDetallesDeIngresosTarjetaCreditos".$ID_caj."'><i class='material-icons'>chevron_right</i> <i class='material-icons'>visibility</i> TARJETA DE CREDITO: $ ".$assoc_result_stock['cja_vta']."  </button> </p>
											<p style='text-align:left;'><button class='btn btn-default' style='text-align:left; width:100%; font-size:100%;' data-toggle='modal' title='Ver detalles de ventas con tarjeta de debito' data-target='#modalDetallesDeIngresosTarjetaDebitos".$ID_caj."'><i class='material-icons'>chevron_right</i> <i class='material-icons'>visibility</i> TARJETA DE DEBITO: $ ".$assoc_result_stock['cja_vtad']." </button> </p>
											<p style='text-align:left;'><button class='btn btn-default' style='text-align:left; width:100%; font-size:100%;' data-toggle='modal' title='Ver detalles de ventas con cuentas corrientes' data-target='#modalDetallesDeIngresosCuentaCorriente".$ID_caj."'><i class='material-icons'>chevron_right</i> <i class='material-icons'>visibility</i> CTA. CTE.: $ ".$assoc_result_stock['cja_vct']." </button> </p>
									
												<div class='col-md-12' style='border:1px solid #007E33;'>
															
																<p style='font-size:150%; font-weight: bold; border-bottom: 1px solid #007E33;'><i class='material-icons'>monetization_on</i> VENTA BRUTA</p>
																
																	<div class='col-md-2' style='font-size:250%; font-weight: bold;'>
																		<i class='material-icons'>arrow_upward</i>
																	</div>
																	<div class='col-md-10' style='font-size:250%; font-weight: bold;'>
																		$ ".$ingresos."	
																	</div>
																

												     		</div>

								     	</div>
								     	<div class='col-md-6'>
									     			
											     			<div class='col-md-12' style='text-align:center; font-weight: bold;'>
													     		
													     		<div class='col-md-12'>
														     		<div class='panel panel-default'>
		  																	<div class='panel-body'>
		  																		<p style='font-size:150%; font-weight: bold;  border-bottom: 1px solid #CCC;'>EFECTIVO EN CAJA</p>
		  																		<div class='col-md-6'>
															     					<p style='font-size:90%; font-weight: bold; border-bottom: 1px solid #CCC;'>CALCULO DEL SISTEMA</p>
															     					<p style='font-size:300%; font-weight: bold; '> $ ".$EnCaja." </p>
															     				</div>	
															     				<div class='col-md-6'>
															     					<p style='font-size:90%; font-weight: bold; border-bottom: 1px solid #CCC;'>CALCULO DEL USUARIO</p>
															     					<p style='font-size:300%; font-weight: bold; '> $ ".$assoc_result_stock['caj_efectivoReal']." </p>
															     				</div>	
															     				<p style='font-size:100%; height: 100%; font-size:150%;' class='text-".$diferenciaColor."'>$ ".$diferencia." ".$diferenciaTexto."</p>
														     				</div>
														     		</div>
														     	</div>	

														     	<div class='col-md-12'>
													     			<div class='panel panel-default'>
	  																	<div class='panel-body'>
													     					<p style='font-size:200%; font-weight: bold; border-bottom: 1px solid #CCC;'>GANANCIA NETA</p>
													     					<p style='font-size:300%; font-weight: bold; '>$ ".$totales." </p>
													     				</div>
													     			</div>		
													     		</div>

												  	</div>   	
								     	</div>
								     	<div class='col-md-3' style='border:2px solid #CC0000;'>
											<p style='font-size:150%; font-weight: bold; border-bottom: 1px solid #CC0000;'><i class='material-icons'>details</i> DETALLES DE GASTOS</p>";
													for ($countAdjuntos=0; $countAdjuntos < $num_get_adjuntosBYId_Rel; $countAdjuntos++) 
													{ 
														$assoc_get_adjuntosBYId_Rel=mysql_fetch_assoc($get_adjuntosBYId_Rel);
														$ID_adj=$assoc_get_adjuntosBYId_Rel['ID_adj'];
													    /* Inicio Modal Egresos*/                          
												   	 echo '<div class="modal fade bd-example-modal-lg" id="modalDetallesDeEgresos'.$ID_caj.''.$ID_adj.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
												            <div class="modal-dialog modal-lg" role="document">
												              <div class="modal-content">
												                 <div class="modal-header">
												                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												                    <h4 class="modal-title" id="myModalLabel">DETALLES DE EGRESOS: COMPROBANTE Nº '.$assoc_get_adjuntosBYId_Rel['ID_adj'].'</h4>
												                  </div>
												                  <div class="modal-body" style="text-align:center">
												                  <div class="container-fluid">
												                    <div class="col-md-12">
													                     <h4>'.$assoc_get_adjuntosBYId_Rel['adj_desc'].'</h4>
													                 </div>
													                 <div class="col-md-12">
																		 <img src="'.$assoc_get_adjuntosBYId_Rel['adj_ruta'].'" style="width:100%;">	
																	 </div>	 
												                  </div>  
												          		 </div>
												                  <div class="modal-footer">
												                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
												                  </div>
												                </div>
												              </div>
												            </div>';
												        /* Fin Modal Egresos */

														echo "<p style='text-align:left;'><button class='btn btn-default' style='text-align:left; width:100%; font-size:100%;' data-toggle='modal' title='Ver Adjunto' data-target='#modalDetallesDeEgresos".$ID_caj."".$ID_adj."' ><i class='material-icons'>chevron_right</i> <i class='material-icons'>attach_file</i> COMPROBANTE Nº ".$assoc_get_adjuntosBYId_Rel['ID_adj']." </button> </p>";
													}

													echo "<div class='col-md-12' style='border:1px solid #CC0000;'>
																<p style='font-size:150%; font-weight: bold; border-bottom: 1px solid #CC0000;'><i class='material-icons'>monetization_on</i> GASTO</p>

																	<div class='col-md-10' style='font-size:250%; font-weight: bold;'>
																		$ ".$egresos."	
																	</div>
																	<div class='col-md-2' style='font-size:250%; font-weight: bold;'>
																		<i class='material-icons'>arrow_downward</i>
																	</div>
												     		</div>
								     </div>
								     
							     </div>

						</div>
								     	
					</div>	
					<div class='panel panel-default'>
	  						<div class='panel-body'>
								<div class='col-md-12'>";

								if ($assoc_result_stock['ID_control']==0) 
				  	  			 {	

								     		echo "<div class='col-md-3' style='text-align:center;' id='control01".$ID_caj."'>
								     				<button class='btn-success' style='width:90%;' data-toggle='modal' title='Validar caja' data-target='#modalValidar".$ID_caj."'><i class='material-icons'>done_all</i> Marcar como Validada</button>
										     		</div>
										     		<div class='col-md-3' style='text-align:center;' id='control02".$ID_caj."'>
										     			<button class='btn-warning' style='width:90%;' data-toggle='modal' title='Marca esta caja como critica' data-target='#modalCriticia".$ID_caj."'><i class='material-icons'>warning</i> Marcar como Critica</button>
										     		</div>";
								 }  
								 if ($assoc_result_stock['ID_control']==2) 
				  	  			 {  
				  	  			 	echo "<div class='col-md-6' style='text-align:center;' id='control21".$ID_caj."'>
								     				<button class='btn-success' style='width:90%;' data-toggle='modal' title='Validar caja' data-target='#modalValidar".$ID_caj."'><i class='material-icons'>done_all</i> Marcar como Validada</button>
										     		</div>";
										     		
				  	  			 }  	
				  	  			  if ($assoc_result_stock['ID_control']==1) 
				  	  			 {  
				  	  			 	echo "<div class='col-md-6' style='text-align:center;'></div>";
										     		
				  	  			 }  		
								     echo "<div class='col-md-3' style='text-align:center;'>
								     			<button class='btn-info' style='width:90%;' data-toggle='modal' title='Imprimir informe' data-target='#modalImprimirInforme".$ID_caj."'><i class='material-icons'>print</i> Imprimir Informe</button>
								     		</div>
								     		<div class='col-md-3' style='text-align:center;'>
								     			<button class='btn-danger' style='width:90%;' data-toggle='modal' title='Ver los movimientos eliminados' data-target='#modalMovimientosEliminados".$ID_caj."'><i class='material-icons'>delete_sweep</i> Movimientos Eliminados</button>
								     		</div>
								     		
								     	</div>
								     </div>
								</div>			

								<div class='col-md-12' style='text-align:right;'>";
								     			 echo "CAJA Nº ".$assoc_result_stock['ID_caj']."
								     		</div>			
				  </div>
				</div>
			</div>	
		</div>";	

		   
  }

 
		 
?>

