<?php 
 	include_once('inc/conectar.php');
include_once('inc/classes.php');
include_once('inc/classesExclusivas.php');

  	$cajaE   						= 	new cajaE;
  	$ventaE  						= 	new ventaE;
  	$mov_cajaE  					= 	new mov_cajaE;
	$ID_suc 						=	$_POST['ID_suc'];
	$suc_desc 						=	$_POST['suc_desc'];
	$suc_icono 						=	$_POST['suc_icono'];

	$get_caja_abiertaPorSuc 		=	$cajaE->get_caja_abiertaPorSuc($ID_suc);
	$num_get_caja_abiertaPorSuc 	= mysql_num_rows($get_caja_abiertaPorSuc);
	
 	$get_caja_abiertaTotal 			=	$cajaE->get_caja_abiertaTotal($ID_suc);
	$assoc_get_caja_abiertaTotal 	= mysql_fetch_assoc($get_caja_abiertaTotal);
 	
 	$total 									=	$assoc_get_caja_abiertaTotal['cja_vef']+$assoc_get_caja_abiertaTotal['cja_vta']+$assoc_get_caja_abiertaTotal['cja_vtad']+$assoc_get_caja_abiertaTotal['cja_vct'];



				 		echo '<div class="col-md-6" style="text-align: center; font-size:80%;">
								<div class="panel panel-primary">
								  <div class="panel-heading">
								    <h3 class="panel-title">'.$suc_desc.'</h3>
								  </div>
								  <div class="panel-body">
									<div class="col-md-12" style="text-align: center;">
										<div class="col-md-4" style="text-align: center;">
											<img src="'.$suc_icono.'" style="width:100%;">';
											
											for ($countCajas=0; $countCajas < $num_get_caja_abiertaPorSuc; $countCajas++) 
											{ 
												$assoc_get_caja_abiertaPorSuc			=	mysql_fetch_assoc($get_caja_abiertaPorSuc);
												$ID_caj 								=	$assoc_get_caja_abiertaPorSuc['ID_caj'];
												$usu_nombre 							=	$assoc_get_caja_abiertaPorSuc['usu_nombre'];
												$usu_apellido 							=	$assoc_get_caja_abiertaPorSuc['usu_apellido'];

												 echo "<button class='btn btn-info' data-toggle='modal' title='Ver detalles de la caja' data-placement='top' data-target='#DetallesCaja".$ID_caj."' style='margin-top:4%; margin-bottom:4%; width:100%;'>";
														echo "<i class='material-icons'>folder_shared</i> Caja - ".$usu_nombre." ".$usu_apellido."";
													echo "</button>";

													
												
											}
										echo '</div>';

							

									echo '<div class="col-md-8" style="text-align: center;">
													
													<div class="col-md-12" style="text-align: center;">
										    			<div class="col-md-9" style="text-align: left;">
										    				<i class="material-icons">monetization_on</i> Ventas en Efectivo: 
										    			</div>		
										    			<div class="col-md-3" style="text-align: right;">	
										    				$'.$assoc_get_caja_abiertaTotal['cja_vef'].'
										    			</div>	
									    			</div>	

									    			<div class="col-md-12" style="text-align: center;">
										    			<div class="col-md-9" style="text-align: left;">
										    			<i class="material-icons">monetization_on</i> Ventas con Tarjetas de Credito: 
										    			</div>	
										    			<div class="col-md-3" style="text-align: right;">	
										    				$'.$assoc_get_caja_abiertaTotal['cja_vta'].'
										    			</div>	
									    			</div>	

									    			<div class="col-md-12" style="text-align: center;">
										    			<div class="col-md-9" style="text-align: left;">
										    				<i class="material-icons">monetization_on</i> Ventas con Tarjetas de Debito: 
										    			</div>	
										    			<div class="col-md-3" style="text-align: right;">	
										    				$'.$assoc_get_caja_abiertaTotal['cja_vtad'].'
										    			</div>	
									    			</div>	

									    			<div class="col-md-12" style="text-align: center;">
										    			<div class="col-md-9" style="text-align: left;">
										    				<i class="material-icons">monetization_on</i> Ventas con Cuentas Corrientes: 
										    			</div>	
										    			<div class="col-md-3" style="text-align: right;">	
										    				$'.$assoc_get_caja_abiertaTotal['cja_vct'].'
										    			</div>
									    			</div>	

									    			<div class="col-md-12" style="text-align: center;">
										    			<div class="col-md-9" style="text-align: left;">
										    				<i class="material-icons">monetization_on</i> Ventas Netas: 
										    			</div>	
										    			<div class="col-md-3" style="text-align: right;">	
										    				$'.$assoc_get_caja_abiertaTotal['caj_vne'].'
										    			</div>
										    		</div>


										    		<div class="col-md-12" style="text-align: center;">
												    			<div class="col-md-6" style="text-align: left;">
												    				<h5><strong>  Total de Ventas: </strong></h5>
												    			</div>	
												    			<div class="col-md-6" style="text-align: right;">	
												    				<h5><strong> $ '.$total.' </strong></h5>
												    			</div>	
											    		</div>	

											    		<div class="col-md-12" style="height: 120px; margin: 5%; text-align:center">

											    		 <div id="chart_div'.$ID_suc.'" style="width: 400px; height: 120px; text-align:center"></div>

											    		 </div>	
										  </div>


										 

										</div> 	
										<div class="col-md-12" style="text-align: left;">
										<hr>
										<h5><strong><i class="material-icons" style="vertical-align: middle;">turned_in_not</i> ULTIMAS VENTAS:</strong></h5>
										</div>';

														
									


									 	//Trae ultmas 2 ventas finalizadas
										$get_ventaByIdcaj=$ventaE->get_ventaByIdcajUltimosTres($ID_caj);
									 	$num_get_ventaByIdcaj=mysql_num_rows($get_ventaByIdcaj);
									 				
									 	for ($CountVentas=0; $CountVentas < $num_get_ventaByIdcaj; $CountVentas++) 
									 	{ 
									 			
									 		$assoc_get_ventaByIdcaj=mysql_fetch_assoc($get_ventaByIdcaj);
									 		$ID_ven=$assoc_get_ventaByIdcaj['ID_ven'];

									 		//trae la hora del ultimo movimiento cerrado para ponerle horario a la venta
									 		$get_mov_cajaByIdVenUltimo=$mov_cajaE->get_mov_cajaByIdVenUltimo($ID_ven);
									 		$assoc_get_mov_cajaByIdVenUltimo=mysql_fetch_assoc($get_mov_cajaByIdVenUltimo);
									 		$horaDeUltimoMov=$assoc_get_mov_cajaByIdVenUltimo['mov_hora'];
									 		
									 		if ($CountVentas==0) 
									 		{
									 			if($assoc_get_ventaByIdcaj['ven_total']=="0.00")
									 			{
									 				$OcultaUltmaVentaInactiva="display:none";
									 				$TextoVenta="Venta Finalizada";
										 			$colorVenta="info";
										 			$horaVenta="";
										 			$FormaPagoVenta="";
									 			}
									 			else
									 			{
									 				$OcultaUltmaVentaInactiva="";
									 				$TextoVenta="Vendiendo Ahora";
									 				$colorVenta="success";
									 				$horaVenta="EN PROCESO";
									 				$FormaPagoVenta="EN PROCESO";
									 			}	
									 			
									 		}
									 			else
									 			{
									 				$OcultaUltmaVentaInactiva="";
										 			$TextoVenta="Venta Finalizada";
										 			$colorVenta="info";
										 			$horaVenta=$horaDeUltimoMov;
										 			$FormaPagoVenta=$assoc_get_ventaByIdcaj['ID_desc'];
									 			}

									 		$get_mov_caja=$mov_cajaE->get_mov_caja($ID_caj, $ID_ven);
										  	$num_get_mov_caja=mysql_num_rows($get_mov_caja);

														
									 		echo '<div class="col-md-12" style="text-align: center; margin-top: 2%; font-size: 80%; '.$OcultaUltmaVentaInactiva.'">
										<div class="panel panel-'.$colorVenta.'">
										  <div class="panel-heading">
										    <h3 class="panel-title"><i class="material-icons" style="vertical-align: middle;">receipt</i> '.$TextoVenta.' - Nº '.$assoc_get_ventaByIdcaj['ID_ven'].'</h3>
										  </div>
										  <div class="panel-body">
										  	<div class="col-md-12" style="text-align: center;">
										  		<div class="col-md-4" style="text-align: center;">
											  		<div class="alert alert-dismissible alert-'.$colorVenta.'">
											  			<i class="material-icons" style="vertical-align: middle;">query_builder</i> '.$horaVenta.'
											  		</div>
										  		</div>
										  		<div class="col-md-4" style="text-align: center;">
											  		<div class="alert alert-dismissible alert-'.$colorVenta.'">
											  			<i class="material-icons" style="vertical-align: middle;">credit_card</i> '.$FormaPagoVenta.'
											  		</div>
										  		</div>
										  		<div class="col-md-4" style="text-align: center;">
											  		<div class="alert alert-dismissible alert-'.$colorVenta.'">
											  			<i class="material-icons" style="vertical-align: middle;">monetization_on</i> $ '.$assoc_get_ventaByIdcaj['ven_total'].'
											  		</div>
										  		</div>
										  	</div>';
										  	echo '<table class="table table-striped table-hover ">
													  <thead>
													    <tr>
													      <th>Cantidad</th>
													      <th>Detalle</th>
													      <th>Sub Total</th>
													      <th>Total</th>
													    </tr>
													  </thead>
													  <tbody>';
										 



										  	for ($movCount=0; $movCount < $num_get_mov_caja; $movCount++) 
										  	{
										  	 	$assoc_get_mov_caja=mysql_fetch_assoc($get_mov_caja);
													    echo '<tr>';
													      echo '<td>'.$assoc_get_mov_caja['mov_cantidad'].'</td>';
													      echo '<td>'.$assoc_get_mov_caja['art_desc'].'</td>';
													      echo '<td>'.$assoc_get_mov_caja['pre_cant'].'</td>';
													      echo '<td>'.$assoc_get_mov_caja['multiplicacion'].'</td>';
													    echo '</tr>';
													
										  	}
										echo '</tbody>
													</table> ';

							echo '</div>
									</div>
									</div>
								';




				 	}
						


						


 				 	echo '

				</div>
			</div> 	
		</div> ';

 	
		?>
	