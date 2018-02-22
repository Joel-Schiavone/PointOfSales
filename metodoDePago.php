<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack'] = $_SERVER['REQUEST_URI'];
  $cuentasE = new cuentasE;
  $chequesE = new chequesE;
  $cheques = new cheques;
  $monto=150;
  $ID_fce=1;
?>  

<div class="container-fluid">
  		<div class='col-md-12' style="text-align: center;">
  			<div class="alert alert-dismissible alert-info">
  				<h3><i class="material-icons">explore</i> Método de Pago <img src='media/loading/cargando4.gif' id='cargandoBoton' style="display: none;" ></h3>
  			</div> 
  		</div> 
</div>

    		
		    <?php 
		    		//SI EL FLUJO ES COMPRAS
		    		if ($ID_fce==1) 
		    		{

		    			echo "<div class='container-fluid'>";
		    				
		    				echo "<div class='col-md-9'>";
		    					echo '<div class="panel panel-primary">';
										  echo '<div class="panel-heading">';
										    echo '<h2 class="panel-title"><strong><i class="material-icons">touch_app</i> SELECCIONE CUENTAS PARA DEBITAR</strong></h2>';
										  echo '</div>';

										  echo '<div class="panel-body">';	
		    						echo '<div class="form-group" style="margin:3%">';
										  echo '<div class="input-group">';
										    echo '<span class="input-group-addon"><i class="material-icons" style="font-size: 15px;">account_balance_wallet</i> CUENTA</span>';
										    echo '<select class="form-control">';
										    		$get_cuentas=$cuentasE->get_cuentas();
										    		$num_get_cuentas=mysql_num_rows($get_cuentas);
										    		for ($cuentCuentas=0; $cuentCuentas < $num_get_cuentas; $cuentCuentas++) 
										    		{ 
										    			$assoc_get_cuentas=mysql_fetch_assoc($get_cuentas);
										    			echo "<option value='".$assoc_get_cuentas['ID_cue']."'>".$assoc_get_cuentas['cue_desc']." / ".$assoc_get_cuentas['ctp_desc']."</option>";
										    		}	
										    echo '</select>';
										  echo '</div>';
									echo '</div>';
									echo "<hr>";
		    					echo "<div class='col-md-6'>";

			    						echo '<div class="panel panel-success">';
										  echo '<div class="panel-heading">';
										    echo '<h2 class="panel-title"><strong><i class="material-icons">style</i> SELECCIONAR CHEQUES EN CARTERA</strong></h2>';
										  echo '</div>';

										  echo '<div class="panel-body">';

										  echo "<div class='col-md-12' id='mostrarCheque' style='margin-top:2%;'>";
										  echo "<div class='col-md-12' id='mostrarCheque' style='margin-top:2%;'>";
										 	echo '<div class="form-group">';
											  echo '<label class="control-label">Monto Total en Cheques seleccionados</label>';
											  echo '<div class="input-group">';
											    echo '<span class="input-group-addon">$</span>';
											    echo '<input type="text" class="form-control" id="totalCheque" placeholder="00.00" value="00.00">';
											  echo '</div>';
											echo '</div>';
											echo '</div>';
											echo '</div>';

										    	$get_chequesByProcedenciaTerceros=$chequesE->get_chequesByProcedenciaTercerosEnCartera();
				    							$num_get_chequesByProcedenciaTerceros=mysql_num_rows($get_chequesByProcedenciaTerceros);
				    							for ($countCheques=0; $countCheques < $num_get_chequesByProcedenciaTerceros; $countCheques++) 
				    							{ 
				    								$assoc_get_chequesByProcedenciaTerceros=mysql_fetch_assoc($get_chequesByProcedenciaTerceros);
				    								$ID_che=$assoc_get_chequesByProcedenciaTerceros['ID_che'];
				    								echo "<div class='col-md-12' id='mostrarCheque' style='margin-top:3%;'>";
				    											
							    								$get_chequesEById=$chequesE->get_chequesEById($ID_che);
																$assoc_get_chequesE=mysql_fetch_assoc($get_chequesEById);
																/* Inicio Modal nuevo cheque */                          
			                        					echo '<div class="col-md-12" id="ChequeSeleccion'.$assoc_get_chequesE['ID_che'].'" style="border: 2px solid #333; text-align:center; font-size:12px; cursor:pointer;">

						                                           <div class="col-md-12" style="margin-top:5px; ">
							                                              <div class="col-md-4">
							                                                <img src="'.$assoc_get_chequesE['ban_logo'].'" style="width:70px;" id="ID_ban'.$assoc_get_chequesE['ID_che'].'">
							                                              </div>
							                                              <div class="col-md-4">
							                                                <p id="che_fecha'.$assoc_get_chequesE['ID_che'].'">'.$assoc_get_chequesE['che_fecha'].'</p>
							                                                
							                                              </div>
							                                              <div class="col-md-4">
							                                                   <p id="che_num'.$assoc_get_chequesE['ID_che'].'">Nº '.$assoc_get_chequesE['che_num'].'</p>
							                                                   
							                                              </div>
						                                            </div>  

						                                            <div class="col-md-12" style="text-align:left; margin-top:5px; border-bottom: 1px solid #000;">
								                                              <p id="che_beneficiario'.$assoc_get_chequesE['ID_che'].'"><strong>PAGUESE A:</strong> &nbsp&nbsp&nbsp&nbsp';

									                                              if($assoc_get_chequesE['che_tipo']=="AL BENEFICIARIO" OR $assoc_get_chequesE['che_tipo']=="DE CAJA" OR $assoc_get_chequesE['che_tipo']=="DE VENTANILLA")
									                                              {
									                                                echo $assoc_get_chequesE['che_beneficiario'];
									                                              }
									                                              if ($assoc_get_chequesE['che_tipo']=="DE VIAJERO" OR $assoc_get_chequesE['che_tipo']=="A LA ORDEN") 
									                                              {
									                                                echo "A LA ORDEN";
									                                              }

								                                          echo '</p>
						                                            </div>
						                                            <div class="col-md-12" style="text-align:left; margin-top:5px; border-bottom: 1px solid #000;">
						                                              <p id="che_importe'.$assoc_get_chequesE['ID_che'].'"><strong>LA SUMA DE:</strong> &nbsp&nbsp&nbsp&nbsp$ '.$assoc_get_chequesE['che_importe'].'</p>
						                                                
						                                            </div>
						                                             <div class="col-md-12" style="text-align:right; margin-top:20px; border-bottom: 1px solid #000;">
						                                             	<div class="col-md-4" style="border: 1px solid #000;">';
						                                              		echo '<p id="che_tipo'.$assoc_get_chequesE['ID_che'].'" >'.$assoc_get_chequesE['che_tipo'].'</p>';
						                                            	echo '</div>
						                                            		<div class="col-md-4">
						                                                	<input type="text" class="form-control" id="estadoChequeSeleccion'.$assoc_get_chequesE['ID_che'].'" value="Disponible">
						                                              	</div>
						                                              	<div class="col-md-4">
						                                                	<p id="che_librador'.$assoc_get_chequesE['ID_che'].'">'.$assoc_get_chequesE['che_librador'].'</p>
						                                              	</div>
						                                            </div>
						                                          </div>';


				    								echo "</div>";

				    								echo "<script>
														$('#ChequeSeleccion".$assoc_get_chequesE['ID_che']."').click(function(){

															var estadoChequeSeleccion = $('#estadoChequeSeleccion".$assoc_get_chequesE['ID_che']."').val();
															if(estadoChequeSeleccion=='Disponible')
															{
																var che_importe = '".$assoc_get_chequesE['che_importe']."';
																var totalCheque = $('#totalCheque').val();
																var suma = parseInt(totalCheque) + parseInt(che_importe);
																$('#totalCheque').val(suma);
																$('#estadoChequeSeleccion".$assoc_get_chequesE['ID_che']."').val('Seleccionado');
																$('#ChequeSeleccion".$assoc_get_chequesE['ID_che']."').css('background-color', '#AAECCA');
															}
															if(estadoChequeSeleccion=='Seleccionado')
															{
																var che_importe = '".$assoc_get_chequesE['che_importe']."';
																var totalCheque = $('#totalCheque').val();
																var suma = parseInt(totalCheque) - parseInt(che_importe);
																$('#totalCheque').val(suma);
																$('#estadoChequeSeleccion".$assoc_get_chequesE['ID_che']."').val('Disponible');
																$('#ChequeSeleccion".$assoc_get_chequesE['ID_che']."').css('background-color', '#fff');
															}
															
														});
				    								</script>";
				    							}
										  echo '</div>';
										echo '</div>';

		    						echo "</div>";
		    					echo "<div class='col-md-6'>";
		    						echo '<div class="panel panel-success">';
										  echo '<div class="panel-heading">';
										    echo '<h2 class="panel-title"><strong><i class="material-icons">add_box</i> EMITIR NUEVO CHEQUE</strong></h2>';
										  echo '</div>';
										  echo '<div class="panel-body">';
										    	echo "FORMULARIO";
										  echo '</div>';
										echo '</div>';
		    					echo "</div>";
		    				echo "</div>";
		    				echo '</div>';
		    				echo '</div>';


		    				echo "<div class='col-md-3'>";
		    						echo "<div class='col-md-12'>";
		    							echo '<div class="panel panel-primary">';
										  echo '<div class="panel-heading">';
										    echo '<h2 class="panel-title"><strong><i class="material-icons">monetization_on</i> MONTO TOTAL A PAGAR: $ '.$monto.' </strong> </h2>';
										  echo '</div>';
										  echo '<div class="panel-body">';
										    echo 'Por el momento no se genero ningun debito en sus cuentas';
										  echo '</div>';
										echo '</div>';
									echo "</div>";
							echo "</div>";		
		    			echo "</div>";

		    			echo "</div>";	
		    		}
		    		//SI EL FLUJO ES VENTAS
		    		elseif ($ID_fce==2) 
		    		{
		    			
		    		}
		    		//SI EL FLUJO ES OTRO
		    		else 
		    		{
		    			echo '<div class="alert alert-dismissible alert-danger">';
  							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
  							echo 'Error al intentanr colocar un monto que no corresponda a ningun flujo configurado. ';
						echo '</div>';
		    		}
		    	?>


		    	
		    </select>
		  </div>
	</div>
</div>