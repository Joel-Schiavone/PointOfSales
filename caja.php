<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requeridoSinCarga.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack']= $_SERVER['REQUEST_URI'];
?>
<!--Fin: Documentos requeridos -->
<!--Inicio: classes -->

<!--Fin: classes -->	 
<?php

 $sucursalesE = new sucursalesE;
 $cajaE   	  = 	new cajaE;

 $get_sucursales=$sucursalesE->get_sucursales();
 $num_get_sucursales=mysql_num_rows($get_sucursales);


?>

<style type="text/css">
	th
	{
	 text-align:center;
	}
</style>
	
	<div class="container-fluid">
		<!--Contenedor de Tesoreria central general-->
		<div class='col-md-12' style="text-align: center;">
			<div class="alert alert-dismissible alert-info">
				<h3><i class="material-icons">flag</i> Cajas en Tiempo Real <img src=media/loading/cargando4.gif id='cargandoBoton' style="display: none;" > </h3>
			</div> 
		
		</div> 

		<div id="capa">
			
		</div>

										<script type='text/javascript'>
										          $(document).ready(function() {
										          			setInterval(function() {
										             
										                 	$("#capa").load('totalesDeCaja.php');
										                  
										           
										                 
														  }, 6000);

										          			    });
                                            </script>


		<!--Inicio: Cargando sucursales-->
			<div class='col-md-12' id='CuentaRegresiva' style="margin: 5%; text-align: center;">
				<div class='col-md-6'>
					<img src=media/loading/cargando4.gif id='cargandoBoton' style="text-align: right;">  Cargando Contenido, Por favor Aguarde. 	
				</div>
				<div class='col-md-6' id='Contador' style="text-align: left; font-size: 80%;">
				
				</div>
			</div>
		<!--Fin: Cargando Sucursales-->


		<!--Contenedor de Tesoreria central por caja-->
		<?php

			for ($countSuc=0; $countSuc < $num_get_sucursales; $countSuc++) 
			{ 
			$assoc_get_sucursales=mysql_fetch_assoc($get_sucursales);
			$ID_suc=$assoc_get_sucursales['ID_suc'];

											//Trae el modal de los datos de caja que deberia traer adentro pero por cuestiones de refresco de esa pagina lo trae aca para que no se salga cada ves que la pagina actualiza
											$get_caja_abiertaPorSucB 		=	$cajaE->get_caja_abiertaPorSuc($ID_suc);
											$num_get_caja_abiertaPorSucB 	= mysql_num_rows($get_caja_abiertaPorSucB);
											for ($countCajasB=0; $countCajasB < $num_get_caja_abiertaPorSucB; $countCajasB++) 
											{ 
												$assoc_get_caja_abiertaPorSucB			=	mysql_fetch_assoc($get_caja_abiertaPorSucB);
												$ID_cajB 								=	$assoc_get_caja_abiertaPorSucB['ID_caj'];
													$totalPorSucB									=	$assoc_get_caja_abiertaPorSucB['cja_vef']+$assoc_get_caja_abiertaPorSucB['cja_vta']+$assoc_get_caja_abiertaPorSucB['cja_vtad']+$assoc_get_caja_abiertaPorSucB['cja_vct'];

												  /* Inicio Modal Detalles de Cajas */                          
												    echo '<div class="modal fade" id="DetallesCaja'.$ID_cajB.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												            <div class="modal-dialog" role="document">
												              <div class="modal-content">
												                 <div class="modal-header">
												                    <a href="caja.php"><button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button></a>
												                    <h4 class="modal-title" id="myModalLabel">Datos de Caja</h4>
												                  </div>
												                  <div class="modal-body">
												                  			<div class="col-md-12" style="text-align: center;">
																	    			<div class="col-md-9" style="text-align: left;">
																	    				<i class="material-icons">assignment_ind</i> Usuario: 
																	    			</div>		
																	    			<div class="col-md-3" style="text-align: right;">	
																	    				'.$assoc_get_caja_abiertaPorSucB['usu_nombre'].' '.$assoc_get_caja_abiertaPorSucB['usu_apellido'].'
																	    			</div>	
																    			</div>	
																    			<div class="col-md-12" style="text-align: center;">
																	    			<div class="col-md-9" style="text-align: left;">
																	    				<i class="material-icons">date_range</i> Fecha de Caja: 
																	    			</div>		
																	    			<div class="col-md-3" style="text-align: right;">	
																	    				'.$assoc_get_caja_abiertaPorSucB['caj_fec'].'
																	    			</div>	
																    			</div>	
																    			<div class="col-md-12" style="text-align: center;">
																	    			<div class="col-md-9" style="text-align: left;">
																	    				<i class="material-icons">access_time</i> Hora de Apertura: 
																	    			</div>		
																	    			<div class="col-md-3" style="text-align: right;">	
																	    				'.$assoc_get_caja_abiertaPorSucB['caj_horaa'].'
																	    			</div>	
																    			</div>	
												                    		<div class="col-md-12" style="text-align: center;">
																	    			<div class="col-md-9" style="text-align: left;">
																	    				<i class="material-icons">monetization_on</i> Ventas en Efectivo: 
																	    			</div>		
																	    			<div class="col-md-3" style="text-align: right;">	
																	    				$'.$assoc_get_caja_abiertaPorSucB['cja_vef'].'
																	    			</div>	
																    			</div>	

																    			<div class="col-md-12" style="text-align: center;">
																	    			<div class="col-md-9" style="text-align: left;">
																	    			<i class="material-icons">monetization_on</i> Ventas con Tarjetas de Credito: 
																	    			</div>	
																	    			<div class="col-md-3" style="text-align: right;">	
																	    				$'.$assoc_get_caja_abiertaPorSucB['cja_vta'].'
																	    			</div>	
																    			</div>	

																    			<div class="col-md-12" style="text-align: center;">
																	    			<div class="col-md-9" style="text-align: left;">
																	    				<i class="material-icons">monetization_on</i> Ventas con Tarjetas de Debito: 
																	    			</div>	
																	    			<div class="col-md-3" style="text-align: right;">	
																	    				$'.$assoc_get_caja_abiertaPorSucB['cja_vtad'].'
																	    			</div>	
																    			</div>	

																    			<div class="col-md-12" style="text-align: center;">
																	    			<div class="col-md-9" style="text-align: left;">
																	    				<i class="material-icons">monetization_on</i> Ventas con Cuentas Corrientes: 
																	    			</div>	
																	    			<div class="col-md-3" style="text-align: right;">	
																	    				$'.$assoc_get_caja_abiertaPorSucB['cja_vct'].'
																	    			</div>
																    			</div>	

																    			<div class="col-md-12" style="text-align: center;">
																	    			<div class="col-md-9" style="text-align: left;">
																	    				<i class="material-icons">monetization_on</i> Ventas Netas: 
																	    			</div>	
																	    			<div class="col-md-3" style="text-align: right;">	
																	    				$'.$assoc_get_caja_abiertaPorSucB['caj_vne'].'
																	    			</div>
																	    		</div>


																	    		<div class="col-md-12" style="text-align: center;">
																			    			<div class="col-md-6" style="text-align: left;">
																			    				<h5><strong>  Total de Ventas: </strong></h5>
																			    			</div>	
																			    			<div class="col-md-6" style="text-align: right;">	
																			    				<h5><strong> $ '.$totalPorSucB.' </strong></h5>
																			    			</div>	
											    								</div>	
												                  </div>
												                  <div class="modal-footer">
												                    <button class="btn btn-info" type="button" style="width:20%;" disabled><i class="material-icons" style="vertical-align: middle">print</i></button>
												                  </div>
												                    </form>
												                </div>
												              </div>
												            </div>';
												        /* Fin Modal Detalles de Cajas */

												    }

				
								echo "<script type='text/javascript'>
										          $(document).ready(function() {
										          			setInterval(function() {
										              var ID_suc".$ID_suc."= '".$ID_suc."';   
										              var suc_desc".$ID_suc."= '".$assoc_get_sucursales['suc_desc']."';
										              var suc_icono".$ID_suc."= '".$assoc_get_sucursales['suc_icono']."';
										               var CantSuc".$ID_suc."= '".$num_get_sucursales."';
										              var dataString".$ID_suc." = 'ID_suc='+ID_suc".$ID_suc." + '&suc_desc='+suc_desc".$ID_suc." + '&suc_icono='+suc_icono".$ID_suc." + '&CantSuc='+CantSuc".$ID_suc.";
										              $.ajax(
										              {
										                  type: 'POST',
										                  url: 'cajaPorSucursal.php',
										                  data: dataString".$ID_suc.",
										                  success: function(data)
										                   {
										                      $('#suggestions".$ID_suc."').fadeIn(1000).html(data);
										                   }

										               });
										                 
														  }, 6000);
										               
										           });
                                            </script>";
						echo "<div id='suggestions".$ID_suc."' style='display:none'></div>";
			
 			}

 			?>

 			<!--Oculta el cargando contenido despues de 5 segundos-->
 			<script type="text/javascript">
 				   $(document).ready(function() {
 				   		$('#CuentaRegresiva').delay(5000).fadeOut(1000);
 				   	 });
 			</script>

 			<!--Actualiza por completo la pantalla luego de un minuto-->
 			<script type="text/javascript">
 				setTimeout('document.location.reload()',90000);
 			</script>

 			<!--Inicio Cuenta hacia atras -->
 				<script type="text/javascript">
 					jQuery.fn.countDown = function(settings,to) {
				        settings = jQuery.extend({
				                startFontSize: "15px",
				                endFontSize: "12px",
				                duration: 500,
				                startNumber: 10,
				                endNumber: 0,
				                callBack: function() { }
				        }, settings);
				        return this.each(function() {
				                
				                //¿Dónde empezamos?
				                if(!to && to != settings.endNumber) { to = settings.startNumber; }
				                
				                //Establecemos la cuenta atrás con el numero inicial
				                jQuery(this).text(to).css("fontSize",settings.startFontSize);
				                
				                //lo recorremos
				                jQuery(this).animate({
				                        fontSize: settings.endFontSize
				                }, settings.duration, "", function() {
				                        if(to > settings.endNumber + 1) {
				                                jQuery(this).css("fontSize", settings.startFontSize).text(to - 1).countDown(settings, to - 1);
				                        }
				                        else {
				                                settings.callBack(this);
				                        }
				                });
				                                
				        });
				};

							jQuery("#Contador").countDown({
							        startNumber: 10,
							        callBack: function(me) {
							                jQuery(me).text("¡Completado! Contenido cargado correctamente").css("color", "#090");
							        }
							});
				 				</script>

 			<!--Fin Cuenta Hacia atras-->
 			


	
<!--Fin: Contenedor principal -->

<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>

<!--Fin: Footer -->



<!--Inicio: Trae Sucursales -->
 

  
<!--Fin: Trae Sucursales -->
