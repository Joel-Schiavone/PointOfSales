<?php
include_once("inc/requeridoSinCarga.php"); 
	$cajaE= new cajaE;
	$get_caja_abiertasTotales=$cajaE->get_caja_abiertasTotales();
	$assoc_get_caja_abiertasTotales=mysql_fetch_assoc($get_caja_abiertasTotales);
	$totalSucursales=$assoc_get_caja_abiertasTotales['efectivo']+$assoc_get_caja_abiertasTotales['credito']+$assoc_get_caja_abiertasTotales['debito']+$assoc_get_caja_abiertasTotales['corriente'];
	echo '<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title"><strong><i class="material-icons" style="vertical-align: middle;">pie_chart</i> TOTALES DE CAJAS ABIERTAS</strong></h3>
				  </div>
				  <div class="panel-body">
				    	<div class="col-md-12" style="text-align: center;">
				    		<div class="col-md-2" style="text-align: center;">
				    		 	<i class="material-icons" style="font-size: 1200%;">account_balance</i>
				    		</div>	
				    		<div class="col-md-6" style="text-align: center;">
				    			
					    		<div class="col-md-12" style="text-align: center;">
					    			<div class="col-md-6" style="text-align: left;">
					    				<i class="material-icons">monetization_on</i> Ventas en Efectivo: 
					    			</div>	
					    			<div class="col-md-6" style="text-align: center;">	
					    				$ '.$assoc_get_caja_abiertasTotales['efectivo'].'
					    			</div>	
				    			</div>	

				    			<div class="col-md-12" style="text-align: center;">
					    			<div class="col-md-6" style="text-align: left;">
					    			<i class="material-icons">monetization_on</i> Ventas con Tarjetas de Credito: 
					    			</div>	
					    			<div class="col-md-6" style="text-align: center;">	
					    					$ '.$assoc_get_caja_abiertasTotales['credito'].'
					    			</div>	
				    			</div>	

				    			<div class="col-md-12" style="text-align: center;">
					    			<div class="col-md-6" style="text-align: left;">
					    				<i class="material-icons">monetization_on</i> Ventas con Tarjetas de Debito: 
					    			</div>	
					    			<div class="col-md-" style="text-align: center;">	
					    					$ '.$assoc_get_caja_abiertasTotales['debito'].'
					    			</div>	
				    			</div>	

				    			<div class="col-md-12" style="text-align: center;">
					    			<div class="col-md-6" style="text-align: left;">
					    				<i class="material-icons">monetization_on</i> Ventas con Cuentas Corrientes: 
					    			</div>	
					    			<div class="col-md-6" style="text-align: center;">	
					    					$ '.$assoc_get_caja_abiertasTotales['corriente'].'
					    			</div>
				    			</div>	

				    			<div class="col-md-12" style="text-align: center;">
					    			<div class="col-md-6" style="text-align: left;">
					    				<i class="material-icons">monetization_on</i> Ventas Netas: 
					    			</div>	
					    			<div class="col-md-6" style="text-align: center;">	
					    					$ '.$assoc_get_caja_abiertasTotales['neto'].'
					    			</div>
					    		</div>

					    		

					    			<div class="col-md-12 success" style="text-align: center;">
							    			<div class="col-md-6" style="text-align: left;">
							    				<h3><strong>  Total de Ventas: </strong></h3>
							    			</div>	
							    			<div class="col-md-6" style="text-align: center;">	
							    				<h3><strong> $ '.$totalSucursales.' </strong></h3>
							    			</div>	
						    		</div>
					    	</div>	

				    		<div class="col-md-4" style="text-align: center;">
				    			
							    <script type="text/javascript">
										google.charts.load("current", {"packages":["corechart"]});
										      google.charts.setOnLoadCallback(drawChart);

										      function drawChart() {

										        var data = google.visualization.arrayToDataTable([
										          ["Task", "Formas de Pago"],
										          ["Efectivo",      		'.$assoc_get_caja_abiertasTotales['efectivo'].'],
										          ["Tar. Credito",  		'.$assoc_get_caja_abiertasTotales['credito'].'],
										          ["Tar. Debito", 		'.$assoc_get_caja_abiertasTotales['debito'].'],
										          ["Cta. Cte.",    	'.$assoc_get_caja_abiertasTotales['corriente'].']
										        ]);

										        var options = {
										          title: "Formas de Pago"
										        };

										        var chart = new google.visualization.PieChart(document.getElementById("piechart"));

										        chart.draw(data, options);
										      }
							    </script>

 									   <div id="piechart" style="width: 100%; height: auto;"></div>
				    		</div>	
				    	</div>	
				  </div>
			</div>';
			?>