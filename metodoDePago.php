<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack'] 	= $_SERVER['REQUEST_URI'];
  $cuentasE 				= new cuentasE;
  $chequesE 				= new chequesE;
  $cheques 					= new cheques;
  $bancos 					= new bancos;
  $mov_cajaE          = new mov_cajaE;
  $cajaE              = new cajaE;
  $ventaE             = new ventaE;
  $tipos_pagos        = new tipos_pagos;
  $tipos_pagosE       = new tipos_pagosE;
  $tarjetas           = new tarjetas;
  $tarjetasE           = new tarjetasE;
  $tarjetas_planesE   = new tarjetas_planesE;
  $usuariosE          = new usuariosE;
  $tarjetas_planes    = new tarjetas_planes;
  $tarjetas_planesE   = new tarjetas_planesE;
  $venta_detalle      = new venta_detalle;
  $venta_detalleE     = new venta_detalleE;
  $puestosE           = new puestosE;
  $monto 					= 150;
  $ID_fce 					= 1;
  $FechayHora 				= date("Y-m-d H:i:s");

		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    //////////////////////////////////I N I C I O   F L U J O   C O M P R A/////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////

		    		if ($ID_fce==1) 
		    		{
		    			echo '<div class="container-fluid">';
						  		echo '<div class="col-md-12" style="text-align: center;">';
						  			echo '<div class="alert alert-dismissible alert-info">';
						  				echo '<h3><i class="material-icons">explore</i> Método de Pago</h3>';
						  			echo '</div>';
						  		echo '</div>';
						echo '</div>';
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
										    echo '<select class="form-control" id="cuentaSeleccionada">';
										    		$get_cuentas=$cuentasE->get_cuentas();
										    		$num_get_cuentas=mysql_num_rows($get_cuentas);
										    		for ($cuentCuentas=0; $cuentCuentas < $num_get_cuentas; $cuentCuentas++) 
										    		{ 
										    			$assoc_get_cuentas=mysql_fetch_assoc($get_cuentas);
										    			echo "<option value='".$assoc_get_cuentas['cue_desc']."'>".$assoc_get_cuentas['cue_desc']." / ".$assoc_get_cuentas['ctp_desc']."</option>";
										    		}	
										    echo '</select>';
										  echo '</div>';
									echo '</div>';
									echo "<hr>";
		    					echo "<div class='col-md-6'>";

		    							echo '<div class="panel panel-success" id="opcionEfectivo">';
										  echo '<div class="panel-heading">';
										    echo '<h2 class="panel-title"><strong><i class="material-icons">monetization_on</i> COMPLETAR EL MONTO A DEBITAR</strong></h2>';
										  echo '</div>';
										  echo '<div class="panel-body">';
										  			echo '<div class="form-group">';
													  echo '<div class="input-group">';
													    echo '<span class="input-group-addon">$</span>';
													    echo '<input type="text" class="form-control" id="totalEfectivo" placeholder="00.00" value="00.00">';
													  echo '</div>';
													echo '</div>';
													 echo '<button class="btn btn-primary" id="botonEfectivo"><i class="material-icons">unarchive</i> AGREGAR AL TOTAL</button>';
										  echo '</div>';
										  echo '<div id="suggestionsTableEfectivo">';
										  echo '</div>';
										  echo '</div>';

			    						echo '<div class="panel panel-success" id="opcionCheques" style="display:none">';
										  echo '<div class="panel-heading">';
										    echo '<h2 class="panel-title"><strong><i class="material-icons">style</i> SELECCIONAR CHEQUES EN CARTERA</strong></h2>';
										  echo '</div>';

										  echo '<div class="panel-body">';

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
						                                                	<input type="text" class="form-control" id="estadoChequeSeleccion'.$assoc_get_chequesE['ID_che'].'" value="Disponible" style="border: 0px; text-align: center; font-weight:bold;">
						                                              	</div>
						                                              	<div class="col-md-4">
						                                                	<p id="che_librador'.$assoc_get_chequesE['ID_che'].'">'.$assoc_get_chequesE['che_librador'].'</p>
						                                              	</div>
						                                            </div>
						                                            <div id="suggestionsTableCheque">
						                                            </div>;
						                                          </div>';


				    								echo "</div>";

				    								/*echo "<script>
														 $('#ChequeSeleccion".$assoc_get_chequesE['ID_che']."').click(function(){
														 		var ID_che             ='".$ID_che."';
															    var ID_ban             ='".$assoc_get_chequesE['ID_ban']."';
															    var che_fecha          ='".$assoc_get_chequesE['che_fecha']."';
															    var che_num            ='".$assoc_get_chequesE['che_num']."';
															    var che_beneficiario   ='".$assoc_get_chequesE['che_beneficiario']."';
															    var che_importe        ='".$assoc_get_chequesE['che_importe']."';
															    var che_tipo           ='".$assoc_get_chequesE['che_tipo']."';
															    var che_librador       ='".$assoc_get_chequesE['che_librador']."';
															    var che_procedencia    ='".$assoc_get_chequesE['che_procedencia']."';
															    var che_estado         ='Utilizado';
															    var ID_cue             ='".$assoc_get_chequesE['ID_cue']."';
															    var action 			   ='modificarCheque';
															    var metodoDePago 	   ='si';

																	 	var montoTotal = $('#montoTotal').val();
																	 	var sumatoria = parseInt(montoTotal) + parseInt(che_importe);
																	 	$('#montoTotal').val(sumatoria);
																	 	var cuentaSeleccionadaC = 'CHEQUE DE TERCERO -Nº '+che_num;
																	 	var cuentaSeleccionada = $('#cuentaSeleccionada').val();
																	 	$('#MontoNuevo').append( '<div class='alert alert-dismissible alert-warning'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>' + cuentaSeleccionadaC+ '</strong> $ '+che_importe+'<br> Cuenta a Debitar: ' +cuentaSeleccionada+'</div>');


																	 	 var dataString = 'action='+action 
																	      + '&ID_che='+ID_che 
																	      + '&ID_ban='+ID_ban
																	      + '&che_fecha='+che_fecha 
																	      + '&che_num='+che_num 
																	      + '&che_beneficiario='+che_beneficiario
																	      + '&che_importe='+che_importe
																	      + '&che_tipo='+che_tipo
																	      + '&che_librador='+che_librador
																	      + '&che_procedencia='+che_procedencia
																	      + '&che_estado='+che_estado
																	      + '&ID_cue='+ID_cue
																	      + '&metodoDePago='+metodoDePago;
																			$.ajax(
							                                                  {
							                                                      type: 'POST',
							                                                      url: 'accionesCheques.php',
							                                                      data: dataString,
							                                                      success: function(dataB)
							                                                       {
							                                                          $('#suggestionsTableCheque').fadeIn(1000).html(dataB);
							                                                       }

							                                                   });

														 });
		</script>";*/

				    								echo "<script>
														$('#ChequeSeleccion".$assoc_get_chequesE['ID_che']."').click(function(){

															var estadoChequeSeleccion = $('#estadoChequeSeleccion".$assoc_get_chequesE['ID_che']."').val();
															if(estadoChequeSeleccion=='Disponible')
															{

																var che_importe = '".$assoc_get_chequesE['che_importe']."';

															 	var montoTotal = $('#montoTotal').val();

															 	var sumatoria = parseInt(montoTotal) + parseInt(che_importe);

															 	$('#montoTotal').val(sumatoria);

															 	$('#estadoChequeSeleccion".$assoc_get_chequesE['ID_che']."').val('Seleccionado');

																$('#ChequeSeleccion".$assoc_get_chequesE['ID_che']."').css('background-color', '#AAECCA');

																var cuentaSeleccionada = $('#cuentaSeleccionada').val();

															 	$('#MontoNuevo').append('<div class=\'alert alert-dismissible alert-warning\' id=\'divCheque".$assoc_get_chequesE['ID_che']."\'><strong> CHEQUE DE TERCERO </strong> $ ".$assoc_get_chequesE['che_importe']."<input hidden type=\'text\' name=\'ID_che".$assoc_get_chequesE['ID_che']."\' id=\'ID_che".$assoc_get_chequesE['ID_che']."\' vaule=\'".$assoc_get_chequesE['ID_che']."\'> <button type=\'button\' id=\'CancelarChequeTercero".$assoc_get_chequesE['ID_che']."\'>&times;</button></div>');
	
																var ID_che             ='".$ID_che."';
															    var ID_ban             ='".$assoc_get_chequesE['ID_ban']."';
															    var che_fecha          ='".$assoc_get_chequesE['che_fecha']."';
															    var che_num            ='".$assoc_get_chequesE['che_num']."';
															    var che_beneficiario   ='".$assoc_get_chequesE['che_beneficiario']."';
															    var che_importe        ='".$assoc_get_chequesE['che_importe']."';
															    var che_tipo           ='".$assoc_get_chequesE['che_tipo']."';
															    var che_librador       ='".$assoc_get_chequesE['che_librador']."';
															    var che_procedencia    ='".$assoc_get_chequesE['che_procedencia']."';
															    var che_estado         ='UTILIZADO';
															    var ID_cue             ='".$assoc_get_chequesE['ID_cue']."';
															    var action 			   ='modificarCheque';
															    var metodoDePago 	   ='si';

															    	 var dataString = 'action='+action 
																	      + '&ID_che='+ID_che 
																	      + '&ID_ban='+ID_ban
																	      + '&che_fecha='+che_fecha 
																	      + '&che_num='+che_num 
																	      + '&che_beneficiario='+che_beneficiario
																	      + '&che_importe='+che_importe
																	      + '&che_tipo='+che_tipo
																	      + '&che_librador='+che_librador
																	      + '&che_procedencia='+che_procedencia
																	      + '&che_estado='+che_estado
																	      + '&ID_cue='+ID_cue
																	      + '&metodoDePago='+metodoDePago;
																			$.ajax(
							                                                  {
							                                                      type: 'POST',
							                                                      url: 'accionesCheques.php',
							                                                      data: dataString,
							                                                      success: function(dataB)
							                                                       {
							                                                          $('#suggestionsTableCheque').fadeIn(1000).html(dataB);
							                                                       }

							                                                   });

															}
															if(estadoChequeSeleccion=='Seleccionado')
															{
																				var che_importe = ".$assoc_get_chequesE['che_importe'].";
																 	var montoTotal = $('#montoTotal').val();
																 	var sumatoria = parseInt(montoTotal) - parseInt(che_importe);
																 	$('#montoTotal').val(sumatoria);

																 	$('#ChequeSeleccion".$assoc_get_chequesE['ID_che']."').css('background-color', '#fff');

																 	var ID_che             ='".$ID_che."';
																    var ID_ban             ='".$assoc_get_chequesE['ID_ban']."';
																    var che_fecha          ='".$assoc_get_chequesE['che_fecha']."';
																    var che_num            ='".$assoc_get_chequesE['che_num']."';
																    var che_beneficiario   ='".$assoc_get_chequesE['che_beneficiario']."';
																    var che_importe        ='".$assoc_get_chequesE['che_importe']."';
																    var che_tipo           ='".$assoc_get_chequesE['che_tipo']."';
																    var che_librador       ='".$assoc_get_chequesE['che_librador']."';
																    var che_procedencia    ='".$assoc_get_chequesE['che_procedencia']."';
																    var che_estado         ='EN CARTERA';
																    var ID_cue             ='".$assoc_get_chequesE['ID_cue']."';
																    var action 			   ='modificarCheque';
																    var metodoDePago 	   ='si';

																    	 var dataString = 'action='+action 
																		      + '&ID_che='+ID_che 
																		      + '&ID_ban='+ID_ban
																		      + '&che_fecha='+che_fecha 
																		      + '&che_num='+che_num 
																		      + '&che_beneficiario='+che_beneficiario
																		      + '&che_importe='+che_importe
																		      + '&che_tipo='+che_tipo
																		      + '&che_librador='+che_librador
																		      + '&che_procedencia='+che_procedencia
																		      + '&che_estado='+che_estado
																		      + '&ID_cue='+ID_cue
																		      + '&metodoDePago='+metodoDePago;
																				$.ajax(
								                                                  {
								                                                      type: 'POST',
								                                                      url: 'accionesCheques.php',
								                                                      data: dataString,
								                                                      success: function(dataB)
								                                                       {
								                                                          $('#suggestionsTableCheque').fadeIn(1000).html(dataB);
								                                                       }

								                                                   });

								                                                   $('#divCheque".$assoc_get_chequesE['ID_che']."').remove();
															}

														$('#CancelarChequeTercero".$assoc_get_chequesE['ID_che']."').click(function(){

																	var che_importe = ".$assoc_get_chequesE['che_importe'].";
																 	var montoTotal = $('#montoTotal').val();
																 	var sumatoria = parseInt(montoTotal) - parseInt(che_importe);
																 	$('#montoTotal').val(sumatoria);

																 	$('#ChequeSeleccion".$assoc_get_chequesE['ID_che']."').css('background-color', '#fff');

																 	var ID_che             ='".$ID_che."';
																    var ID_ban             ='".$assoc_get_chequesE['ID_ban']."';
																    var che_fecha          ='".$assoc_get_chequesE['che_fecha']."';
																    var che_num            ='".$assoc_get_chequesE['che_num']."';
																    var che_beneficiario   ='".$assoc_get_chequesE['che_beneficiario']."';
																    var che_importe        ='".$assoc_get_chequesE['che_importe']."';
																    var che_tipo           ='".$assoc_get_chequesE['che_tipo']."';
																    var che_librador       ='".$assoc_get_chequesE['che_librador']."';
																    var che_procedencia    ='".$assoc_get_chequesE['che_procedencia']."';
																    var che_estado         ='EN CARTERA';
																    var ID_cue             ='".$assoc_get_chequesE['ID_cue']."';
																    var action 			   ='modificarCheque';
																    var metodoDePago 	   ='si';

																    	 var dataString = 'action='+action 
																		      + '&ID_che='+ID_che 
																		      + '&ID_ban='+ID_ban
																		      + '&che_fecha='+che_fecha 
																		      + '&che_num='+che_num 
																		      + '&che_beneficiario='+che_beneficiario
																		      + '&che_importe='+che_importe
																		      + '&che_tipo='+che_tipo
																		      + '&che_librador='+che_librador
																		      + '&che_procedencia='+che_procedencia
																		      + '&che_estado='+che_estado
																		      + '&ID_cue='+ID_cue
																		      + '&metodoDePago='+metodoDePago;
																				$.ajax(
								                                                  {
								                                                      type: 'POST',
								                                                      url: 'accionesCheques.php',
								                                                      data: dataString,
								                                                      success: function(dataB)
								                                                       {
								                                                          $('#suggestionsTableCheque').fadeIn(1000).html(dataB);
								                                                       }

								                                                   });

								                                                   $('#divCheque".$assoc_get_chequesE['ID_che']."').remove();
					
															});

															
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
										    echo '<fieldset>
							                        <input hidden name="action" value="nuevoCheque" type="text">
							                            <label class="control-label"><i class="material-icons">account_balance</i> BANCO</label>
							                            <div class="form-group">
							                              <select class="form-control" id="ID_ban" name="ID_ban" required>';
							                                $get_bancosH=$bancos->get_bancos();
							                                $num_get_bancosH=mysql_num_rows($get_bancosH);
							                                for ($countBancosH=0; $countBancosH < $num_get_bancosH; $countBancosH++) 
							                                { 
							                                  $assoc_get_bancosH=mysql_fetch_assoc($get_bancosH);
							                                  echo "<option value='".$assoc_get_bancosH['ID_ban']."'>".$assoc_get_bancosH['ban_desc']."</option>";
							                                }
							                        echo '</select></div>

							                           <div class="form-group">
							                              <label class="control-label"><i class="material-icons">monetization_on</i> IMPORTE</label>
							                              <div class="input-group">
							                                <span class="input-group-addon">$</span>
							                              <input type="text" name="che_importe" id="che_importe_nuevo" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="00.00" required>
							                          </div>
							                        </div>

							                         <div class="form-group">
							                            <label for="che_num "><i class="material-icons">fingerprint</i> NUMERO</label>
							                            <input type="text" class="form-control" id="che_num" name="che_num" placeholder="" required>
							                          </div>

							                          <div class="form-group">
							                            <label for="librador"><i class="material-icons">account_circle</i> LIBRADOR</label>
							                            <input type="text" class="form-control" id="librador" name="che_librador" placeholder="Librador" required>
							                          </div>

							                                  <label class="control-label"><i class="material-icons">bookmark_border</i> TIPO</label>
							                                    <div class="form-group">
							                                      <select class="form-control" id="che_tipo" name="che_tipo">
							                                        <option value="CRUZADOS">CRUZADOS</option>
							                                        <option value="CERTIFICADO">CERTIFICADO</option>
							                                        <option value="AL BENEFICIARIO">AL BENEFICIARIO</option>
							                                        <option value="DE CAJA">DE CAJA</option>
							                                        <option value="DE VENTANILLA">DE VENTANILLA</option>
							                                        <option value="DE VIAJERO">DE VIAJERO</option>
							                                        <option value="A LA ORDEN">A LA ORDEN</option>
							                                      </select>
							                                    </div>  

							                        <div class="form-group" style="display:none;" id="beneficiario">
							                            <label for="librador"><i class="material-icons">face</i> BENEFICIARIO</label>
							                            <input type="text" class="form-control" id="che_beneficiario" name="che_beneficiario">
							                          </div>

							                            <div class="form-group">
							                            <label for="librador"><i class="material-icons">date_range</i> FECHA</label>
							                            <input type="date" class="form-control" id="fecha" name="che_fecha">
							                          </div>

							                          <div class="form-group">
							                            <button class="btn btn-primary" id="botonChequeNuevo"><i class="material-icons">unarchive</i> AGREGAR AL TOTAL</button>';
										  echo '</div></fieldset></div>';

										  echo "<div id='suggestionsChequeNuevoCompra'>";
										  echo "</div>";
										echo '</div>';
		    					echo "</div>";
		    				echo "</div>";
		    				echo '</div>'; 
		    				echo '</div>';

		    				echo "<div class='col-md-3'>";
		    						echo "<div class='col-md-12' style='text-align:center'>";
		    							echo '<div class="panel panel-primary">';
										  echo '<div class="panel-heading">';
										    echo '<h2 class="panel-title"><strong><i class="material-icons">monetization_on</i> MONTO TOTAL A PAGAR: $ '.$monto.' </strong> </h2>';
										  echo '</div>';
										  echo '<div class="panel-body">';
										  		echo '<div class="form-group">';
													  echo '<div class="input-group">';
													    echo '<span class="input-group-addon">$</span>';
													     echo '<input class="form-control" type="text" id="montoTotal" value="00:00" placeholder="00.00">';
													  echo '</div>';
													echo '</div>';
										    echo "<div id='MontoNuevo'></div>";
										  echo '</div>';
										  echo '<a href="comprobantes.php"><button style="margin:2%;" class="btn btn-success"><i class="material-icons">done_all</i> Finalizar Pago</button></a>';
										echo '</div>';

									echo "</div>";
							echo "</div>";		
		    			echo "</div>";

		    			echo "</div>";	
		    		}

		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    //////////////////////////////////I N I C I O   F L U J O   V E N T A  /////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////

		    		elseif ($ID_fce==2) 
		    		{
		    			/*
		    			echo '<div class="container-fluid">';
						  		echo '<div class="col-md-12" style="text-align: center;">';
						  			echo '<div class="alert alert-dismissible alert-info">';
						  				echo '<h3><i class="material-icons">explore</i> Método de Cobro</h3>';
						  			echo '</div>';
						  		echo '</div>';
						echo '</div>';

						echo "<div class='container-fluid'>";
						echo "<div class='col-md-12'>";

							// INICIO DIV IZQUIERDA METODOS DE PAGOS
		    					echo "<div class='col-md-9'>";

		    							// INICIO DE TARJETA CABECERA
		    							echo '<div class="panel panel-primary">';

		    									//  TITULO DE CABECERA DE TARJETA
												  echo '<div class="panel-heading">';
												    echo '<h2 class="panel-title"><strong><i class="material-icons">touch_app</i> SELECCIONE CUENTAS PARA ACREDITAR</strong></h2>';
												  echo '</div>';

											// INICIO DE CUERPO DE TARJETA  
										 	echo '<div class="panel-body">';

										 		// CUADRO SELECTOR DE CUENTAS
		    									echo '<div class="form-group" style="margin:3%">';
										 			 echo '<div class="input-group">';
														    echo '<span class="input-group-addon"><i class="material-icons" style="font-size: 15px;">account_balance_wallet</i> CUENTA</span>';
														    echo '<select class="form-control" id="cuentaSeleccionadaH">';
														    		$get_cuentasH=$cuentasE->get_cuentas();
														    		$num_get_cuentasH=mysql_num_rows($get_cuentasH);
														    		for ($cuentCuentasH=0; $cuentCuentasH < $num_get_cuentasH; $cuentCuentasH++) 
														    		{ 
														    			$assoc_get_cuentasH=mysql_fetch_assoc($get_cuentasH);
														    			echo "<option value='".$assoc_get_cuentasH['cue_desc']."'>".$assoc_get_cuentasH['cue_desc']." / ".$assoc_get_cuentasH['ctp_desc']."</option>";
														    		}	
														    echo '</select>';
										  			echo '</div>';
												echo '</div>';

											echo "<hr>";

											// CUADRO DE MONTO A COBRAR EN EFECTIVO
											echo "<div class='col-md-6'>";
		    										echo '<div class="panel panel-success" id="opcionEfectivoH">';
											  				echo '<div class="panel-heading">';
															    echo '<h2 class="panel-title"><strong><i class="material-icons">monetization_on</i> COMPLETAR EL MONTO A ACREDITAR</strong></h2>';
															echo '</div>';
													  		echo '<div class="panel-body">';
													  				echo '<div class="form-group">';
																  			echo '<div class="input-group">';
																				    echo '<span class="input-group-addon">$</span>';
																				    echo '<input type="text" class="form-control" id="totalEfectivoH" placeholder="00.00" value="00.00">';
																  			echo '</div>';
																	echo '</div>';
														 			echo '<button class="btn btn-primary" id="botonEfectivoH"><i class="material-icons">unarchive</i> AGREGAR AL TOTAL</button>';
															 		echo '<div id="suggestionsTableEfectivoH">';
																	echo '</div>';
											  				echo '</div>';
										  			echo '</div>';
										  echo '</div>';

										// INICIO FORMULARIO PARA ACEPTAR CHEQUES	
										echo "<div class='col-md-6' id='recibirChequeDeTercero' style='display:none'>";
				    						echo '<div class="panel panel-success">';
												  echo '<div class="panel-heading">';
												    echo '<h2 class="panel-title"><strong><i class="material-icons">add_box</i> RECIBIR CHEQUE</strong></h2>';
												  echo '</div>';
												  echo '<div class="panel-body">';
												    echo '<fieldset>
									                        <input hidden name="action" value="nuevoCheque" type="text">
									                            <label class="control-label"><i class="material-icons">account_balance</i> BANCO</label>
									                            <div class="form-group">
									                              <select class="form-control" id="ID_ban" name="ID_ban" required>';
									                                $get_bancos=$bancos->get_bancos();
									                                $num_get_bancos=mysql_num_rows($get_bancos);
									                                for ($countBancos=0; $countBancos < $num_get_bancos; $countBancos++) 
									                                { 
									                                  $assoc_get_bancos=mysql_fetch_assoc($get_bancos);
									                                  echo "<option value='".$assoc_get_bancos['ID_ban']."'>".$assoc_get_bancos['ban_desc']."</option>";
									                                }
									                        echo '</select></div>

									                           <div class="form-group">
									                              <label class="control-label"><i class="material-icons">monetization_on</i> IMPORTE</label>
									                              <div class="input-group">
									                                <span class="input-group-addon">$</span>
									                              <input type="text" name="che_importe" id="che_importe_nuevoH" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="00.00" required>
									                          </div>
									                        </div>

									                         <div class="form-group">
									                            <label for="che_num "><i class="material-icons">fingerprint</i> NUMERO</label>
									                            <input type="text" class="form-control" id="che_num" name="che_num" placeholder="" required>
									                          </div>

									                          <div class="form-group">
									                            <label for="librador"><i class="material-icons">account_circle</i> LIBRADOR</label>
									                            <input type="text" class="form-control" id="librador" name="che_librador" placeholder="Librador" required>
									                          </div>

									                                  <label class="control-label"><i class="material-icons">bookmark_border</i> TIPO</label>
									                                    <div class="form-group">
									                                      <select class="form-control" id="che_tipo" name="che_tipo">
									                                        <option value="CRUZADOS">CRUZADOS</option>
									                                        <option value="CERTIFICADO">CERTIFICADO</option>
									                                        <option value="AL BENEFICIARIO">AL BENEFICIARIO</option>
									                                        <option value="DE CAJA">DE CAJA</option>
									                                        <option value="DE VENTANILLA">DE VENTANILLA</option>
									                                        <option value="DE VIAJERO">DE VIAJERO</option>
									                                        <option value="A LA ORDEN">A LA ORDEN</option>
									                                      </select>
									                                    </div>  

									                        <div class="form-group" style="display:none;" id="beneficiario">
									                            <label for="librador"><i class="material-icons">face</i> BENEFICIARIO</label>
									                            <input type="text" class="form-control" id="che_beneficiario" name="che_beneficiario">
									                          </div>

									                            <div class="form-group">
									                            <label for="librador"><i class="material-icons">date_range</i> FECHA</label>
									                            <input type="date" class="form-control" id="fecha" name="che_fecha">
									                          </div>

									                          <div class="form-group">
									                            <button class="btn btn-primary" id="botonChequeNuevoH"><i class="material-icons">unarchive</i> AGREGAR AL TOTAL</button>';
												 			 echo '</div>
												  			</fieldset>';
															echo "<div id='suggestionsTableH'>";
															echo "</div>";
															echo '</div>
														</div>';
				    						echo "</div>";		

									// FIN TARJETA CUERPO	  
									echo '</div>';	

								// FIN TARJETA 	  
									echo '</div>';

								// FIN DIV IZQUIERDA METODOS DE PAGOS	
								echo '</div>';	  	

							    // INICIO DE TOTALES, CUADRO DE LA DERECHA FUERA DE LA TARJETA
								echo "<div class='col-md-3'>";
		    						echo "<div class='col-md-12' style='text-align:center'>";
		    							echo '<div class="panel panel-primary">';
										  echo '<div class="panel-heading">';
										    echo '<h2 class="panel-title"><strong><i class="material-icons">monetization_on</i> MONTO TOTAL A COBRAR: $ '.$monto.' </strong> </h2>';
										  echo '</div>';
										  echo '<div class="panel-body">';
										  		echo '<div class="form-group">';
													  echo '<div class="input-group">';
													    echo '<span class="input-group-addon">$</span>';
													     echo '<input class="form-control" type="text" id="montoTotalH" value="00.00" placeholder="00.00" readonly>';
													  echo '</div>';
													echo '</div>';
										    echo "<div id='MontoNuevoH'></div>";
										  echo '</div>';
										  echo '<a href="comprobantes.php"><button style="margin:2%;" class="btn btn-success"><i class="material-icons">done_all</i> Finalizar Pago</button></a>';
										echo '</div>';

									echo "</div>";
							echo "</div>";		
		    			echo "</div>";
						echo '</div>';			*/
		    		}
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ///////////////////////////// 	  I N I C I O   O T R O  F L U J O   ///////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    		else 
		    		{
		    			//echo '<div class="alert alert-dismissible alert-danger">';
  							//echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
  							//echo 'Error al intentar colocar un monto que no corresponda a ningun flujo configurado. ';
						//echo '</div>';

						echo '<div class="container-fluid">';
						  		echo '<div class="col-md-12" style="text-align: center;">';
						  			echo '<div class="alert alert-dismissible alert-info">';
						  				echo '<h3><i class="material-icons">explore</i> Método de Cobro</h3>';
						  			echo '</div>';
						  		echo '</div>';
						echo '</div>';

						echo '<div class="container-fluid">';

							echo "<div class='col-md-12'>";

							// INICIO DIV IZQUIERDA METODOS DE PAGOS
		    					echo "<div class='col-md-9'>";

		    							// INICIO DE TARJETA CABECERA
		    							echo '<div class="panel panel-primary">';

		    									//  TITULO DE CABECERA DE TARJETA
												  echo '<div class="panel-heading">';
												    echo '<h2 class="panel-title"><strong><i class="material-icons">touch_app</i> FORMA DE PAGO </strong></h2>'; 
												  echo '</div>'; 

												// INICIO DE CUERPO DE TARJETA  
										 		echo '<div class="panel-body">';
										 			
										 			echo '<div id="suggestionsTarjeta" style="display:none"></div>';
										 		
								                		// CUADRO SELECTOR DE CUENTAS
		    									echo '<div class="form-group" style="margin:3%">';

										 			 echo '<div class="input-group">';
														    echo '<span class="input-group-addon"><i class="material-icons" style="font-size: 15px;">attach_money</i></span>
														      <select class="form-control" name="FormaDePago" id="FormaDePago">';
									                              $get_tipos_pagos=$tipos_pagosE->get_tipos_pagos();
									                              $num_get_tipos_pagos=mysql_num_rows($get_tipos_pagos);
									                              for ($Countnum_get_tipos_pagos=0; $Countnum_get_tipos_pagos < $num_get_tipos_pagos; $Countnum_get_tipos_pagos++)
									                              { 
									                                   $assoc_get_tipos_pagos=mysql_fetch_assoc($get_tipos_pagos);

									                                   if ($assoc_get_tipos_pagos['fpo_selected']==1) 
									                                   {
									                                    $selected="selected";
									                                    $ID_selected=$assoc_get_tipos_pagos['ID_fpo'];
									                                   }
									                                   else
									                                   {
									                                    $selected="";
									                                   } 

									                                   echo "<option value='".$assoc_get_tipos_pagos['ID_fpo']."' ".$selected.">".$assoc_get_tipos_pagos['ID_desc']."</option>";
									                              }

									                            echo '<option value="5">PAGOS ELECTRONICOS</option>
									                            <option value="6">CHEQUE</option>
									                          </select>';
										  			echo '</div>';

											echo "<hr>";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
										  	//////////////////////// CUADRO DE MONTO A COBRAR EN EFECTIVO FLUJO VENTA ///////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
											echo "<div class='col-md-12' id='montoAcobrar' style='display:none'>";
		    										
											  				echo '<div class="form-group">';
																  			echo '<div class="input-group">';
																				    echo '<span class="input-group-addon">$</span>';
																				    echo '<input type="text" class="form-control" id="totalEfectivoH" placeholder="00.00" value="">';
																  			echo '</div>';
																	echo '</div>';

													  		echo '<div class="form-group">';
													  			 echo '<div class="input-group">';
																    echo '<span class="input-group-addon"><i class="material-icons" style="font-size: 15px;">account_balance_wallet</i> CUENTA</span>';
																    echo '<select class="form-control" id="cuentaSeleccionadaHH">';
																    		$get_cuentasH=$cuentasE->get_cuentasSinCheque();
																    		$num_get_cuentasH=mysql_num_rows($get_cuentasH);
																    		for ($cuentCuentasH=0; $cuentCuentasH < $num_get_cuentasH; $cuentCuentasH++) 
																    		{ 
																    			$assoc_get_cuentasH=mysql_fetch_assoc($get_cuentasH);
																    			echo "<option value='".$assoc_get_cuentasH['cue_desc']."'>".$assoc_get_cuentasH['cue_desc']." / ".$assoc_get_cuentasH['ctp_desc']."</option>";
																    		}	
																		    echo '</select>';
												  				echo '</div>';
												  			echo '</div>';	

													  				
														 		
															 		echo '<div id="suggestionsTableEfectivoH">';
																	echo '</div>';
										  echo '</div>';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
										  	//////////////////////// CUADRO CTA CTE FLUJO VENTA ///////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
											echo "<div class='col-md-12' id='ctactecuadro' style='display:none'>";
															echo '<div class="form-group">';
																	echo '<div class="input-group">';
																				    echo '<span class="input-group-addon">$</span>';
																				    echo '<input type="text" class="form-control" id="totalctacte" placeholder="00.00" value="">';
																  			echo '</div>';
																	echo '</div>';
																
		    									
														 			echo '<div class="form-group">';
																  			echo '<div class="input-group">';
																				    echo '<span class="input-group-addon"><i class="material-icons" style="font-size:14px;">accessibility</i> <strong> CLIENTES </strong></span>';
																				    echo '<input type="text" class="form-control" id="buscarCliente" placeholder="Ingrese nombre del cliente" value="">';
																  			echo '</div>';
																  	echo '</div>';

																  			echo '<div class="col-md-12"  id="suggestionsClientes">';
																  			echo '</div>';

																  			
											  				
										echo '</div>';		


										


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
										  	//////////////////////// INICIO FORMULARIO PARA ACEPTAR CHEQUES	FLUJO VENTA ///////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
										echo "<div class='col-md-12' id='recibirChequeDeTercero' style='display:none'>";
												    echo '<fieldset>
									                        <input hidden name="action" value="nuevoCheque" type="text">
									                            <label class="control-label"><i class="material-icons">account_balance</i> BANCO</label>
									                            <div class="form-group">
									                              <select class="form-control" id="ID_ban" name="ID_ban" required>';
									                                $get_bancos=$bancos->get_bancos();
									                                $num_get_bancos=mysql_num_rows($get_bancos);
									                                for ($countBancos=0; $countBancos < $num_get_bancos; $countBancos++) 
									                                { 
									                                  $assoc_get_bancos=mysql_fetch_assoc($get_bancos);
									                                  echo "<option value='".$assoc_get_bancos['ID_ban']."'>".$assoc_get_bancos['ban_desc']."</option>";
									                                }
									                        echo '</select></div>

									                           <div class="form-group">
									                              <label class="control-label"><i class="material-icons">monetization_on</i> IMPORTE</label>
									                              <div class="input-group">
									                                <span class="input-group-addon">$</span>
									                              <input type="text" name="che_importe" id="che_importe_nuevoH" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="00.00" required>
									                          </div>
									                        </div>

									                         <div class="form-group">
									                            <label for="che_num "><i class="material-icons">fingerprint</i> NUMERO</label>
									                            <input type="text" class="form-control" id="che_num" name="che_num" placeholder="" required>
									                          </div>

									                          <div class="form-group">
									                            <label for="librador"><i class="material-icons">account_circle</i> LIBRADOR</label>
									                            <input type="text" class="form-control" id="librador" name="che_librador" placeholder="Librador" required>
									                          </div>

									                                  <label class="control-label"><i class="material-icons">bookmark_border</i> TIPO</label>
									                                    <div class="form-group">
									                                      <select class="form-control" id="che_tipo" name="che_tipo">
									                                        <option value="CRUZADOS">CRUZADOS</option>
									                                        <option value="CERTIFICADO">CERTIFICADO</option>
									                                        <option value="AL BENEFICIARIO">AL BENEFICIARIO</option>
									                                        <option value="DE CAJA">DE CAJA</option>
									                                        <option value="DE VENTANILLA">DE VENTANILLA</option>
									                                        <option value="DE VIAJERO">DE VIAJERO</option>
									                                        <option value="A LA ORDEN">A LA ORDEN</option>
									                                      </select>
									                                    </div>  

									                        <div class="form-group" style="display:none;" id="beneficiario">
									                            <label for="librador"><i class="material-icons">face</i> BENEFICIARIO</label>
									                            <input type="text" class="form-control" id="che_beneficiario" name="che_beneficiario">
									                          </div>

									                            <div class="form-group">
									                            <label for="librador"><i class="material-icons">date_range</i> FECHA</label>
									                            <input type="date" class="form-control" id="fecha" name="che_fecha">
									                          </div>

									                          <div class="form-group">
									                            <button class="btn btn-primary" id="botonChequeNuevoH"><i class="material-icons">unarchive</i> AGREGAR AL TOTAL</button>';
												 			 echo '</div>
												  			</fieldset>';
															echo "<div id='suggestionsTableH'>";
															echo "</div>";
				    						echo "</div>";		

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
										  	//////////////////////// PAGOS ELECTRONICOS	FLUJO VENTA ///////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////				    						
				    						  echo '<div class="alert alert-dismissible alert-info" id="pagosElectronicos" style="display:none;">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong><H4>DISPONIBLES PROXIMAMENTE !</H4></strong>
                                          	</div>';


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
										  	//////////////////////// CREDITOS FLUJO VENTA ///////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                          	 echo '<div class="col-md-12" id="TarjetasDiv" style="display:none;">'; 

                                          	  			echo '<div class="form-group">
									                             
									                              <div class="input-group">
									                                <span class="input-group-addon">$</span>
									                              <input type="text" name="che_importe_tarjetaH" id="che_importe_tarjetaH" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="00.00" required>
									                          </div>
									                        </div>';


                                                            $get_tarjetas = $tarjetasE->get_tarjetas(); 
                                                            $num_get_tarjetas = mysql_num_rows($get_tarjetas); 
                                                            for ($tarjetasCount=0; $tarjetasCount < $num_get_tarjetas; $tarjetasCount++) 
                                                            { 
                                                               $assoc_get_tarjetas = mysql_fetch_assoc($get_tarjetas);  
                                                               $ImagenTarjeta=$assoc_get_tarjetas['tar_logo']; 
                                                              
                                                            	
                                                                echo "<div class='col-md-6' style='padding:2%;' id='MuestraTarjetas'>";
                                                              	echo '<div class="panel panel-info" id="MuestraPlanes'.$assoc_get_tarjetas['ID_tar'].' style="display:none;">';
																	  echo '<div class="panel-heading" style="cursor:pointer" id="headingTrjetas'.$assoc_get_tarjetas['ID_tar'].'">';
																	    echo '<h2 class="panel-title"><img src="'.$ImagenTarjeta.'" style="width:10%;" id="tarjeta'.$assoc_get_tarjetas['ID_tar'].'"> <i class="material-icons">keyboard_arrow_right</i> '.$assoc_get_tarjetas['cue_desc'].'</h2>';
																	  echo '</div>';
																	  echo '<div class="panel-body" style="display:none" id="bodyTrjetas'.$assoc_get_tarjetas['ID_tar'].'">';

                                                                        $ID_tar=$assoc_get_tarjetas['ID_tar']; 
                                                                        $cue_desc=$assoc_get_tarjetas['cue_desc']; 
                                                                          echo "<br>"; 
                                                                             /*
                                                                             echo $get_tarjetas_planesById = $tarjetas_planesE->get_tarjetas_planesById($ID_tar, $ven_total);
                                                                              */

                                                                             $getPlanesTarjetasByIdTar=$tarjetas_planesE->getPlanesTarjetasByIdTar($ID_tar);
                                                                             $num_getPlanesTarjetasByIdTar=mysql_num_rows($getPlanesTarjetasByIdTar);

                                                                             for ($countPlanes=0; $countPlanes <  $num_getPlanesTarjetasByIdTar; $countPlanes++) 
                                                                             { 
                                                                               $assoc_result_tarjetas_planes=mysql_fetch_assoc($getPlanesTarjetasByIdTar);
                                                                               
                                                                                $pla_cant=$assoc_result_tarjetas_planes['pla_cant'];
                                                                                $recargo=$assoc_result_tarjetas_planes['pla_recargo'];
                                                                                $ID_pla=$assoc_result_tarjetas_planes['ID_pla'];
                                                                                
                                                                                echo "<input hidden type='text' id='pla_cant".$ID_pla."' value='".$pla_cant."'>";
                                                                                echo "<input hidden type='text' id='recargo".$ID_pla."' value='".$recargo."'>";
                                                                                echo "<input hidden type='text' id='ID_pla".$ID_pla."' value='".$ID_pla."'>";

                                                                                 echo "<div class='col-md-12' style='text-align:left;'>";
                                                                                 echo '<div class="form-group" style="text-align:center;">
															                              <label class="control-label"><h4>
															                              <input class="custom-control custom-checkbox" type="radio" name="ID_pla" id="ID_pla'.$assoc_get_tarjetas['ID_tar'].''.$assoc_result_tarjetas_planes['ID_pla'].'" value="'.$assoc_result_tarjetas_planes['ID_pla'].'">
                                                                                    '.$assoc_result_tarjetas_planes['pla_desc'].' (Recargo: '.$assoc_result_tarjetas_planes['pla_recargo'].'%)</h4></label>
															                              </div>';


						                                          	  			echo '<div class="form-group">
															                              <label class="control-label"><i class="material-icons">monetization_on</i> INTERESES</label>
															                              <div class="input-group">
															                                <span class="input-group-addon">$</span>
															                              <input readonly type="text" id="recargoEfectivo'.$ID_pla.'" placeholder="COLOQUE UN IMPORTE PARA QUE EL SISTEMA PUEDA CALCULAR INTERESES" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="00.00" required>
															                          </div>
															                        </div>';

															                        echo '<div class="form-group">
															                              <label class="control-label"><i class="material-icons">monetization_on</i> VALOR DE LA CUOTA</label>
															                              <div class="input-group">
															                                <span class="input-group-addon">$</span>
															                              <input readonly type="text" id="valorCuota'.$ID_pla.'" placeholder="COLOQUE UN IMPORTE PARA QUE EL SISTEMA PUEDA CALCULAR LAS CUOTAS"  class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="00.00" required>
															                          </div>
															                        </div>';

															                         echo '<div class="form-group">
															                              <label class="control-label"><i class="material-icons">monetization_on</i> TOTAL A PAGAR</label>
															                              <div class="input-group">
															                                <span class="input-group-addon">$</span>
															                              <input  readonly type="text" id="valorTotal'.$ID_pla.'" placeholder="COLOQUE UN IMPORTE PARA QUE EL SISTEMA PUEDA CALCULAR EL TOTAL"  class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="00.00" required>
															                          </div>
															                        </div><hr>';

                                                                                echo "</div>"; 

                                                                                echo "<script>
																					$('#che_importe_tarjetaH').keyup(function(){
																						var importe  		= 	$('#che_importe_tarjetaH').val();
																						var pla_cant 		=	'".$assoc_result_tarjetas_planes['pla_cant']."';
					                                                                    var recargo  		=	'".$assoc_result_tarjetas_planes['pla_recargo']."';
					                                                                    var ID_pla 			=	'".$assoc_result_tarjetas_planes['ID_pla']."';	

																						var pagoTotalA 		= (parseInt(importe)*parseInt(recargo))/100;
					                                                                    var pagoTotal    	= parseInt(pagoTotalA)+parseInt(importe);
																						var valorDeCuota    = parseInt(pagoTotal)/parseInt(pla_cant);
																							
																						$('#recargoEfectivo".$ID_pla."').val(pagoTotalA);
																						$('#valorTotal".$ID_pla."').val(pagoTotal);
																						$('#valorCuota".$ID_pla."').val(valorDeCuota);
																						
																					});</script>";

																					 echo "<script>
																							 $('#ID_pla".$assoc_get_tarjetas['ID_tar']."".$assoc_result_tarjetas_planes['ID_pla']."').click(function(){
																							 			
																								 	var totalTarjeta = $('#valorTotal".$ID_pla."').val();
																								 	
																								 	var montoTotal = $('#montoTotalH').val();
																								 
																								 	var sumatoriaD = parseInt(montoTotal) + parseInt(totalTarjeta);
	
																								 	$('#montoTotalH').val(sumatoriaD);

																								 	var cuentaSeleccionada = '".$cue_desc."';
																								 		
																									$('#MontoNuevoH').append('<div class=\'alert alert-dismissible alert-success\' id=\'tarjetaDiv".$ID_pla."\'><strong><img src=\'".$ImagenTarjeta."\' style=\'width:10%;\'> ".$cue_desc."</strong> $ '+sumatoriaD+' <button type=\'button\' id=\'eliminartarjeta".$ID_pla."\'>&times;</button></div>');	
				    
																							        $('#botonEfectivo').prop('disabled', false);

																									var mcs_movimiento 	='COBRO DE COMPROBANTE CON TARJETA ".$assoc_get_tarjetas['tar_desc']."';
																								    var mcs_desc 		= '".$assoc_result_tarjetas_planes['pla_desc']."';
																								    var mcd_fec 		= '".$FechayHora."';
																								    var monto 			= sumatoriaD;
																								    var tipoMovimeinto 	= 1; 
																								    var action 			= 'nuevoMovimiento';

																								    var mdc_fecDisponibilidad = '".$assoc_result_tarjetas_planes['plan_tiempoAcre']."';
	
																								    var dataStringF = 'action='+action 
																								      + '&mcs_movimiento='+mcs_movimiento 
																								      + '&mcs_desc='+mcs_desc
																								      + '&mcd_fec='+mcd_fec 
																								      + '&cuentaSeleccionada='+cuentaSeleccionada 
																								      + '&monto='+monto
																								      + '&tipoMovimeinto='+tipoMovimeinto
																								      + '&mdc_fecDisponibilidad='+mdc_fecDisponibilidad;
	
																								      $.ajax(
																								            {
																								              type: 'POST',
																								              url: 'accionesCuentasMovimientos.php',
																								              data: dataStringF,
																								              success: function(dataF)
																								              {
																								                $('#suggestionsTarjeta').fadeIn(1000).html(dataF);

																								                 var ID_mcsE = $('#RespuestaIdMovCuenta').val();
																											      $('#MontoNuevoH').append('<input hidden type=\'text\' name=\'RespuestaIdMovCuenta".$ID_pla."\' id=\'RespuestaIdMovCuenta".$ID_pla."\' value='+ID_mcsE+'>');	
																								              }
																								            });


	
																								     $('#eliminartarjeta".$ID_pla."').click(function(){
																								      	$('#tarjetaDiv".$ID_pla."').remove();
																								    	var montoTotalDD = $('#montoTotalH').val();
																										var sumatoriaDD = parseInt(montoTotalDD) - parseInt(totalTarjeta);
																										$('#montoTotalH').val(sumatoriaDD);
																										$('#tarjetaDiv".$ID_pla."').remove();

																										var ID_mcsE 			= $('#RespuestaIdMovCuenta".$ID_pla."').val();
																										var cuentaSeleccionadaE = cuentaSeleccionada;
																										var tipoMovimientoE 	= '1';
																								        var actionE 			= 'eliminaMovimiento';
	
																								    	var dataStringE = 'action='+actionE 
																								      	+ '&ID_mcs='+ID_mcsE
																								      	+ '&cuentaSeleccionada='+cuentaSeleccionadaE
																								      	+ '&tipoMovimiento='+tipoMovimientoE;

	
																								      		$.ajax(
																								            {
																								              type: 'POST',
																								              url: 'accionesCuentasMovimientos.php',
																								              data: dataStringE,
																								              success: function(dataE)
																								              {
																								                
																								              }
																								            });


																								           var contador = $('#ContadorImpuestos').val();

																									

																											});				 	
																							});


																						</script>";

                                                                             }


                                                                             echo '<br><br><div id="EfectivoTarjeta'.$assoc_result_tarjetas_planes['ID_tar'].'" style="display:none; margin:3%;" class="input-group">
                                                                              <span class="input-group-addon">Monto En Efectivo $</span>
                                                                              <input type="text" name="efectivo" placeholder="00.00" class="form-control">
                                                                          
                                                                            </div>';

                                                                             echo '<input hidden type="text" name="ID_tar" id="ID_tar" value="'.$assoc_get_tarjetas['ID_tar'].'">';
                                                                              
                                                                   echo "</div></div>";  

                                                               echo "<script>
                                                               $('#headingTrjetas".$assoc_get_tarjetas['ID_tar']."').click(function(){
                                                                $('#bodyTrjetas".$assoc_get_tarjetas['ID_tar']."').toggle('slow');
                                                               });

																
                                                               </script>";



                                                                 echo "</div>";
                                                            }

                                                              
                                                  echo '</div>'; 



												// FIN TARJETA CUERPO	  
												echo '</div>';	

										// FIN TARJETA 	  
										echo '</div>';

								echo '</div>';

							echo '</div>';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
										  	//////////////////////// INICIO DE TOTALES, CUADRO DE LA DERECHA FUERA DE LA TARJETA FLUJO VENTAS ///////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////							
								echo "<div class='col-md-3'>";
		    						echo "<div class='col-md-12' style='text-align:center'>";
		    							echo '<div class="panel panel-primary">';
										  echo '<div class="panel-heading">';
										    echo '<h2 class="panel-title"><strong><i class="material-icons">monetization_on</i> MONTO TOTAL A COBRAR: $ '.$monto.' </strong> </h2>';
										  echo '</div>';
										  echo '<div class="panel-body">';
										  		echo '<div class="form-group">';
													  echo '<div class="input-group">';
													    echo '<span class="input-group-addon">$</span>';
													     echo '<input class="form-control" type="text" id="montoTotalH" value="00.00" placeholder="00.00" readonly>';
													  echo '</div>';
													echo '</div>';
										    echo "<div id='MontoNuevoH'></div>";
										  echo '</div>';
										  echo '<a href="comprobantes.php"><button style="margin:2%;" class="btn btn-success"><i class="material-icons">done_all</i> Finalizar Pago</button></a>';
										echo '</div>';

									echo "</div>";
							echo "</div>";		

						echo '</div>';			
										    		}	


		    		?>

	  
		    <!--////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    /////////////////////I N I C I O   S C R I P T  F L U J O   V E N T A  /////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////-->
	
	<script type="text/javascript">

	

		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
										  	//////////////////////// SCRIPT CHEQUE FLUJO VENTA ///////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	 $(document).ready(function(){
        $('#che_tipo').change(function(){

        var che_tipo = $('#che_tipo').val();
          if (che_tipo=="AL BENEFICIARIO" || che_tipo=="DE CAJA" || che_tipo=="DE VENTANILLA") 
          {
            $('#beneficiario').fadeIn(500);
          }
          else
          {
            $('#beneficiario').fadeOut(500);
          }   
      })
  });

	 $('#cuentaSeleccionada').change(function(){
	 	var cuentaSeleccionada = $('#cuentaSeleccionada').val();
	 	if(cuentaSeleccionada=="CHEQUE EN CARTERA")
	 	{
	 		$('#opcionCheques').fadeIn(500);
	 		$('#opcionEfectivo').fadeOut(500);
	 	}
	 	else
	 	{
	 		$('#opcionEfectivo').fadeIn(500);
	 		$('#opcionCheques').fadeOut(500);
	 	}	
	 });
		 $('#botonChequeNuevoH').click(function(){
	 	//SUMA MONTO DEL CHEQUE NUEVO AL TOTAL
	 	var che_importe = $('#che_importe_nuevoH').val();
	 	var montoTotal = $('#montoTotalH').val();
	 	var sumatoria = parseInt(montoTotal) + parseInt(che_importe);
	 	$('#montoTotalH').val(sumatoria);
	 	var cuentaSeleccionadaBX = "CHEQUE DE TERCERO Nº"+$('#che_num').val();
	 	var cuentaSeleccionadaX = "CHEQUE EN CARTERA";
	 	var che_num = $('#che_num').val();
	 		 	//ejecuta replace para quitar todos los espacios del nombre de la cuenta y asi poder utilizarlo posteriormente como identificador de los div que se agregaran con la cuenta y el monto, el identificador se construira con la operatoria y el nombre de cuenta ejemplo: efecitvoBancoGalicia	
     	var cuentaSeleccionadaCX = cuentaSeleccionadaX.replace(/ /g,'');


	 		 // GUARDA CHEQUE EN LA TABLA DE CHEQUES COMO PROPIO DEBITADO
	 		  var action = "nuevoCheque";
		      var fecha = $('#fecha').val();
		      var che_tipo = $('#che_tipo').val();
		      var ID_ban = $('#ID_ban').val();
		      var che_librador = $('#librador').val();
		      var che_estado = "EN CARTERA";
		      var che_beneficiario = $('#beneficiario').val();
		      var che_procedencia = "TERCERO";
		      var dataString = 'action='+action 
		      + '&cuentaSeleccionada='+cuentaSeleccionadaX 
		      + '&che_importe='+che_importe
		      + '&che_fecha='+fecha 
		      + '&che_tipo='+che_tipo 
		      + '&ID_ban='+ID_ban
		      + '&che_librador='+che_librador
		      + '&che_estado_tercero='+che_estado
		      + '&che_procedencia='+che_procedencia
		      + '&che_num='+che_num
		      + '&che_beneficiario='+che_beneficiario;
		      $.ajax(
		                                                  {
		                                                      type: 'POST',
		                                                      url: 'accionesCheques.php',
		                                                      data: dataString,
		                                                      success: function(data)
		                                                       {
		                                                          $('#suggestionsTableH').fadeIn(1000).html(data);
		                                                          var chequeAeliminar = $('#chequeeliminar').val();
		                                                          $("#MontoNuevoH").append( "<input hidden type='text' name='cheque"+che_num+"Eliminado' id='cheque"+che_num+"Eliminado' value='"+chequeAeliminar+"'>");
		                                                          var cuentaeliminar = $('#cuentaeliminar').val();
		                                                          $("#MontoNuevoH").append( "<input hidden type='text' name='cuenta"+che_num+"Eliminado' id='cuenta"+che_num+"Eliminado' value='"+cuentaeliminar+"'>");

	 	
		                                                       }

		                                                   });



     	$("#MontoNuevoH").append( "<div class='alert alert-dismissible alert-warning' id='nuevoChequeH"+che_num+"'><strong>" + cuentaSeleccionadaBX + "</strong> $ "+che_importe+"<br> Cuenta a Acreditar: " +cuentaSeleccionadaX+" <input hidden type='text' name='cuentaBXX"+che_num+"' id='cuentaBXX"+che_num+"' value='"+cuentaSeleccionadaX+"'><input hidden type='text' name='montoBXX"+che_num+"' id='montoBXX"+che_num+"' value='"+che_importe+"'><input hidden type='text' name='che_numXX"+che_num+"' id='che_numXX"+che_num+"' value='"+che_num+"'><button type='button' id='eliminarNuevoChequeH"+che_num+"'>&times;</button></div>");
	 	
		      	//dentro de la misma funcion se encuentra la posibilidad de volver atras el proceso presionando el boton con la x
		      	 $('#eliminarNuevoChequeH'+che_num).click(function(){
		      	 		var che_importeXX = che_importe;
		      	 		//descuenta del total que se muestra con la sumatorio el monto que anteriormente habia agregado
		    			var montoTotalBX = $('#montoTotalH').val();
					 	var sumatoriaB = parseInt(montoTotalBX) - parseInt(che_importeXX);
					 	$('#montoTotalH').val(sumatoriaB);

					 	//prepara las variables para ejecutar atravez de ajax la accion nuevoMovimiento de la pagina accionesCuentasMovimientos.php donde agregara un detalle con debe o con haber dependiendo del tipo de movimiento
		      	 		var ID_cheXX 				= $('#cheque'+che_num+'Eliminado').val();
		      	 		var opcionVolverXX  		= "no";
    					var opcionBorrarCuentaXX  	= "si";
    					var cuentaSeleccionadaXX 	= cuentaSeleccionadaX;
    					var tipoMovimientoXX 		= 1;
    					var actionXX 				= "borrarCheque";
    					var ID_mcsXX				= $('#cuenta'+che_num+'Eliminado').val();

				 	 	var dataStringXX = 'action='+actionXX 
				 	 	+ '&ID_che='+ID_cheXX 
					    + '&opcionVolver='+opcionVolverXX 
					    + '&opcionBorrarCuenta='+opcionBorrarCuentaXX 
					    + '&cuentaSeleccionada='+cuentaSeleccionadaXX 
					    + '&ID_mcs='+ID_mcsXX 
					    + '&tipoMovimiento='+tipoMovimientoXX;

				      	$.ajax(
				                                                  {
				                                                      type: 'POST',
				                                                      url: 'accionesCheques.php',
				                                                      data: dataStringXX,
				                                                      success: function(dataH)
				                                                       {
				                                                       
				                                                       }

				                                                   });

				      	$('#nuevoChequeH'+che_num).remove();
				 });

	 });

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
										  	//////////////////////// SCRIPT EFECTIVO FLUJO VENTA ///////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	


	//AL PRESIONAR EL BOTON DE AGREGAR AL TOTAL EL EFECTIVO
	 $('#cuentaSeleccionadaHH').change(function(){
	 	//trae monto en efectivo puesto
	 	var totalEfectivo = $('#totalEfectivoH').val();
	 	//trae monto total de sumatoria
	 	var montoTotal = $('#montoTotalH').val();
	 	//suma ambos monstos
	 	var sumatoria = parseInt(montoTotal) + parseInt(totalEfectivo);
	 	//coloca el resultado en el monto total de la sumatoria
	 	$('#montoTotalH').val(sumatoria);
	 	//trae la cuenta seleccionada
	 	var cuentaSeleccionada = $('#cuentaSeleccionadaHH').val();
	 		
	 	//ejecuta replace para quitar todos los espacios del nombre de la cuenta y asi poder utilizarlo posteriormente como identificador de los div que se agregaran con la cuenta y el monto, el identificador se construira con la operatoria y el nombre de cuenta ejemplo: efecitvoBancoGalicia	
	 	var cuentaSeleccionadaB = cuentaSeleccionada;
     	var cuentaSeleccionadaC = cuentaSeleccionadaB.replace(/ /g,'');

     	

     	//quita del selector de cuentas la opcion de la cuenta seleccionada
		$("#cuentaSeleccionadaHH option[value='"+cuentaSeleccionada+"']").each(function() {
		    $(this).remove();
		});

		//agrega a los resultados un div nuevo con el detalle y el monto y la posibiliad de volver el proceso atras
	 	$( "#MontoNuevoH" ).append( "<div class='alert alert-dismissible alert-success' id='efectivoH"+cuentaSeleccionadaC+"'><strong>" + cuentaSeleccionada + "</strong> $ "+totalEfectivo+" <button type='button' id='eliminarEfectivoH"+cuentaSeleccionadaC+"'>&times;</button></div>");


	 		//prepara las variables para ejecutar atravez de ajax la accion nuevoMovimiento de la pagina accionesCuentasMovimientos.php donde agregara un detalle con debe o con haber dependiendo del tipo de movimiento
			var mcs_movimiento 	="COBRO DE COMPROBANTE EN EFECTIVO";
		    var mcs_desc 		="";
		    var mcd_fec 		="<?php echo $FechayHora;?>";
		    var monto 			=totalEfectivo;
		    var tipoMovimeinto 	=1; //Acredita
		    var action 			="nuevoMovimiento";

		    var dataStringPX = 'action='+action 
		      + '&mcs_movimiento='+mcs_movimiento 
		      + '&mcs_desc='+mcs_desc
		      + '&mcd_fec='+mcd_fec 
		      + '&cuentaSeleccionada='+cuentaSeleccionada 
		      + '&monto='+monto
		      + '&tipoMovimeinto='+tipoMovimeinto;		    

		      $.ajax(
		                                                  {
																				    
		                                                      type: 'POST',
		                                                      url: 'accionesCuentasMovimientos.php',
		                                                      data: dataStringPX,
		                                                      success: function(dataPX)
		                                                       {
		                                                          $('#suggestionsTableEfectivoH').fadeIn(1000).html(dataPX);
		                                                           var ID_mcsPPXX = $('#RespuestaIdMovCuenta').val();
																   $( "#MontoNuevoH" ).append( "<input hidden type='text' name='RespuestaIdMovCuentaEfectivo"+cuentaSeleccionadaC+"' id='RespuestaIdMovCuentaEfectivo"+cuentaSeleccionadaC+"' value='"+ID_mcsPPXX+"'>");
		                                                       }

		                                                   });

		
		      	 		      //dentro de la misma funcion se encuentra la posibilidad de volver atras el proceso presionando el boton con la x
							 $('#eliminarEfectivoH'+cuentaSeleccionadaC).click(function(){
							  //prepara las variables para ejecutar atravez de ajax la accion nuevoMovimiento de la pagina accionesCuentasMovimientos.php donde agregara un detalle con debe o con haber dependiendo del tipo de movimiento
																		      	 	
							//descuenta del total que se muestra con la sumatorio el monto que anteriormente habia agregado
								var montoTotalB = $('#montoTotalH').val();
								var sumatoriaB = parseInt(montoTotalB)-parseInt(monto);
								$('#montoTotalH').val(sumatoriaB);

								var ID_mcsPX = $('#RespuestaIdMovCuentaEfectivo'+cuentaSeleccionadaC).val();
								var ID_cuePX = 2;
								var actionPX = "eliminaMovimiento";
								var tipoMovimientoPX = 1;

								var dataStringPX = 'action='+actionPX 
								+ '&ID_cue='+ID_cuePX 
								+ '&ID_mcs='+ID_mcsPX
								+ '&tipoMovimiento='+tipoMovimientoPX;
																		
								$('#efectivoH'+cuentaSeleccionadaC).remove();

								$.ajax(
									{
										type: 'POST',
										url: 'accionesCuentasMovimientos.php',
										data: dataStringPX,
										success: function(dataPX)
										{
																				                                                       	
										}

									});
							});

	 });

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
										  	//////////////////////// SCRIPT CTA CTE FLUJO VENTA ///////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






$('#buscarCliente').keyup(function(){
		var buscarClienteP = $('#buscarCliente').val();
		var actionP = "listarClientes";
		var dataStringP = 'action='+actionP + '&buscarCliente='+buscarClienteP;

				      	$.ajax(
				                                                  {
				                                                      type: 'POST',
				                                                      url: 'accionesCtaCte.php',
				                                                      data: dataStringP,
				                                                      success: function(dataP)
				                                                       {
				                                                         $('#suggestionsClientes').fadeIn(100).html(dataP);
				                                                       		$('#mostradorDeDatosDeCliente').click(function(){
																				var clienteSeleccionadoB = $('#clienteSeleccionadoB').val();
																				
																				$('#MontoNuevoH').append('<input hidden type="text" id="clienteSeleccionadoC" name="clienteSeleccionadoC" value='+clienteSeleccionadoB+'>');	

																				//trae monto en efectivo puesto
																			 	var totalctacte = $('#totalctacte').val();
																			 	//trae monto total de sumatoria
																			 	var montoTotal = $('#montoTotalH').val();
																			 	//suma ambos monstos
																			 	var sumatoria = parseInt(montoTotal) + parseInt(totalctacte);
																			 	//coloca el resultado en el monto total de la sumatoria
																			 	$('#montoTotalH').val(sumatoria);
																			 	//trae la cuenta seleccionada
																			 	var cuentaSeleccionada = "MOROSOS";  

																			 	var ID_cli=clienteSeleccionadoB;

																			 	var nombreDeCliente = $('#clienteNombre').val();

																				//agrega a los resultados un div nuevo con el detalle y el monto y la posibiliad de volver el proceso atras 

																			 	$( "#MontoNuevoH").append( "<div class='alert alert-dismissible alert-success' id='ctacte"+ID_cli+"'><strong> CUENTA MOROSOS: "+nombreDeCliente+" </strong> $ "+totalctacte+" <button type='button' id='eliminarctacte"+ID_cli+"'>&times;</button></div>");

																			 	//prepara las variables para ejecutar atravez de ajax la accion nuevoMovimiento de la pagina accionesCuentasMovimientos.php donde agregara un detalle con debe o con haber dependiendo del tipo de movimiento
																				var mcs_movimiento 	="COBRO DE COMPROBANTE EN CTA CTE DE " + nombreDeCliente;
																			    var mcs_desc 		="";
																			    var mcd_fec 		="<?php echo $FechayHora;?>";
																			    var monto 			=totalctacte;
																			    var tipoMovimeinto 	=1; //Acredita
																			    var action 			="nuevoMovimiento";

																			    var dataString = 'action='+action 
																			      + '&mcs_movimiento='+mcs_movimiento 
																			      + '&mcs_desc='+mcs_desc
																			      + '&mcd_fec='+mcd_fec 
																			      + '&cuentaSeleccionada='+cuentaSeleccionada 
																			      + '&monto='+monto
																			      + '&tipoMovimeinto='+tipoMovimeinto;

																			      $.ajax(
																			                                                  {
																			                                                      type: 'POST',
																			                                                      url: 'accionesCuentasMovimientos.php',
																			                                                      data: dataString,
																			                                                      success: function(dataPP)
																			                                                       {
																			                                                           $('#suggestionsClientes').fadeIn(100).html(dataPP); 
																			                                                           var ID_mcsPP = $('#RespuestaIdMovCuenta').val();
																			                                                           $( "#MontoNuevoH" ).append( "<input hidden type='text' name='RespuestaIdMovCuentaCtaCte"+ID_cli+"' id='RespuestaIdMovCuentaCtaCte"+ID_cli+"' value='"+ID_mcsPP+"'>");
																			                                                       }

																			                                                   });
																			      //dentro de la misma funcion se encuentra la posibilidad de volver atras el proceso presionando el boton con la x
																			       $('#eliminarctacte'+ID_cli).click(function(){
																		      	 	//prepara las variables para ejecutar atravez de ajax la accion nuevoMovimiento de la pagina accionesCuentasMovimientos.php donde agregara un detalle con debe o con haber dependiendo del tipo de movimiento
																		      	 	
																		    			//descuenta del total que se muestra con la sumatorio el monto que anteriormente habia agregado
																		    			var montoTotalB = $('#montoTotalH').val();
																					 	var sumatoriaB = parseInt(montoTotalB)-parseInt(monto);
																					 	$('#montoTotalH').val(sumatoriaB);

																					 	var ID_mcsPPP = $('#RespuestaIdMovCuentaCtaCte'+ID_cli).val();
																					 	var ID_cuePPP = 2;
																					 	var actionPPP = "eliminaMovimiento";
																					 	var tipoMovimientoPPP = 1;


																				 	 	var dataStringPPP = 'action='+actionPPP 
																		      			+ '&ID_cue='+ID_cuePPP 
																		      			+ '&ID_mcs='+ID_mcsPPP
																		      			+ '&tipoMovimiento='+tipoMovimientoPPP;
																		
																		      			$('#ctacte'+ID_cli).remove();
																				      	$.ajax(
																				                                                  {
																				                                                      type: 'POST',
																				                                                      url: 'accionesCuentasMovimientos.php',
																				                                                      data: dataStringPPP,
																				                                                      success: function(dataPPP)
																				                                                       {
																				                                                       	
																				                                                       }

																				                                                   });
																				 });
																			});	

																			
																		      	
				                                                       }

				                                                   });


});

	



/*

	

		//AL PRESIONAR EL BOTON DE AGREGAR AL TOTAL EL MONTO
	 $('#botonMontoCtaCte').click(function(){
	 	//trae monto en efectivo puesto
	 	var totalctacte = $('#totalctacte').val();
	 	//trae monto total de sumatoria
	 	var montoTotal = $('#montoTotalH').val();
	 	//suma ambos monstos
	 	var sumatoria = parseInt(montoTotal) + parseInt(totalctacte);
	 	//coloca el resultado en el monto total de la sumatoria
	 	$('#montoTotalH').val(sumatoria);
	 	//trae la cuenta seleccionada
	 	var cuentaSeleccionada = "MOROSOS";  

	 	var ID_cli=$('#ID_cli').val();

	 	var cli_nombre=$('#cli_nombre').val();
	 	
		//agrega a los resultados un div nuevo con el detalle y el monto y la posibiliad de volver el proceso atras
	 	$( "#MontoNuevoH" ).append( "<div class='alert alert-dismissible alert-success' id='ctacte"+ID_cli+"'><strong> CUENTA MOROSOS </strong> $ "+totalctacte+" <button type='button' id='eliminarctacte"+ID_cli+"'>&times;</button></div>");


	 		//prepara las variables para ejecutar atravez de ajax la accion nuevoMovimiento de la pagina accionesCuentasMovimientos.php donde agregara un detalle con debe o con haber dependiendo del tipo de movimiento
			var mcs_movimiento 	="COBRO DE COMPROBANTE EN CTA CTE DE " + cli_nombre;
		    var mcs_desc 		="";
		    var mcd_fec 		="<?php echo $FechayHora;?>";
		    var monto 			=totalctacte;
		    var tipoMovimeinto 	=1; //Acredita
		    var action 			="nuevoMovimiento";

		    var dataString = 'action='+action 
		      + '&mcs_movimiento='+mcs_movimiento 
		      + '&mcs_desc='+mcs_desc
		      + '&mcd_fec='+mcd_fec 
		      + '&cuentaSeleccionada='+cuentaSeleccionada 
		      + '&monto='+monto
		      + '&tipoMovimeinto='+tipoMovimeinto;

		      $.ajax(
		                                                  {
		                                                      type: 'POST',
		                                                      url: 'accionesCuentasMovimientos.php',
		                                                      data: dataString,
		                                                      success: function(dataPP)
		                                                       {
		                                                           $('#suggestionsClientes').fadeIn(100).html(dataPP); 
		                                                           var ID_mcsPP = $('#RespuestaIdMovCuenta').val();
		                                                           $( "#MontoNuevoH" ).append( "<input type='text' name='RespuestaIdMovCuentaCtaCte"+ID_cli+"' id='RespuestaIdMovCuentaCtaCte"+ID_cli+"' value='"+ID_mcsPP+"'>");
		                                                       }

		                                                   });

		      	
		      	//dentro de la misma funcion se encuentra la posibilidad de volver atras el proceso presionando el boton con la x
		      	 $('#eliminarctacte'+ID_cli).click(function(){
		      	 	//prepara las variables para ejecutar atravez de ajax la accion nuevoMovimiento de la pagina accionesCuentasMovimientos.php donde agregara un detalle con debe o con haber dependiendo del tipo de movimiento
		      	 	
		    			//descuenta del total que se muestra con la sumatorio el monto que anteriormente habia agregado
		    			var montoTotalB = $('#montoTotalH').val();
					 	var sumatoriaB = parseInt(montoTotalB)-parseInt(monto);
					 	$('#montoTotalH').val(sumatoriaB);

					 	var ID_mcsPPP = $('#RespuestaIdMovCuentaCtaCte'+ID_cli).val();
					 	var ID_cuePPP = 2;
					 	var actionPPP = "eliminaMovimiento";
					 	var tipoMovimientoPP = 1;


				 	 	var dataStringPPP = 'action='+actionPPP 
		      			+ '&ID_cue='+ID_cuePPP 
		      			+ '&ID_mcs='+ID_mcsPPP
		      			+ '&tipoMovimiento='+tipoMovimientoPPP;
		
		      			$('#ctacte'+ID_cli).remove();
				      	$.ajax(
				                                                  {
				                                                      type: 'POST',
				                                                      url: 'accionesCuentasMovimientos.php',
				                                                      data: dataStringPPP,
				                                                      success: function(dataPPP)
				                                                       {
				                                                       	
				                                                       }

				                                                   });
				 });

	 });

*/
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
										  	//////////////////////// SCRIPT OCULTA Y MUESTRA FORMAS DE COBRO FLUJO VENTAS///////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



		$(document).ready(function(){
			 					var valorDeFormaDePago = $("#FormaDePago").val();
                                        if(valorDeFormaDePago==1)
                                        {
                                          $('#montoAcobrar').fadeIn(500);
                                        }
                                        else
                                        {
                                          $('#montoAcobrar').fadeOut(500);
                                        }  
                                      });
									$("#FormaDePago").change(function(){
                                        var valorDeFormaDePago = $("#FormaDePago").val();
                                        if(valorDeFormaDePago==1)
                                        {
                                          $('#montoAcobrar').fadeIn(100);
                                        }
                                        else
                                        {
                                          $('#montoAcobrar').fadeOut(100);
                                        }   

                                         if(valorDeFormaDePago==2)
                                        {
                                          $('#ctactecuadro').fadeIn(100);
                                        }
                                        else
                                        {
                                          $('#ctactecuadro').fadeOut(100);
                                        }   
                                     
                                        if(valorDeFormaDePago==6)
                                        {
                                          $("#recibirChequeDeTercero").fadeIn(100);
                                        }
                                        else
                                        {
                                          $("#recibirChequeDeTercero").fadeOut(100);
                                        }     

                                        if(valorDeFormaDePago==5)
                                        {
                                          $("#pagosElectronicos").fadeIn(100);
                                        }
                                        else
                                        {
                                          $("#pagosElectronicos").fadeOut(100);
                                        }   

                                        if(valorDeFormaDePago==3)
                                        {
                                          $("#TarjetasDiv").fadeIn(100);
                                        }
                                        else
                                        {
                                          $("#TarjetasDiv").fadeOut(100);
                                        }                                  

                                      });
	
		
	</script>

	


		<!--////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    //////////////////// I N I C I O   S C R I P T  F L U J O   C O M P R A ////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////-->

<script type="text/javascript">

	 $(document).ready(function(){
        $('#che_tipo').change(function(){

        var che_tipo = $('#che_tipo').val();
          if (che_tipo=="AL BENEFICIARIO" || che_tipo=="DE CAJA" || che_tipo=="DE VENTANILLA") 
          {
            $('#beneficiario').fadeIn(500);
          }
          else
          {
            $('#beneficiario').fadeOut(500);
          }   
      })
  });

	 $('#cuentaSeleccionada').change(function(){
	 	var cuentaSeleccionada = $('#cuentaSeleccionada').val();
	 	if(cuentaSeleccionada=="CHEQUE EN CARTERA")
	 	{
	 		$('#opcionCheques').fadeIn(500);
	 		$('#opcionEfectivo').fadeOut(500);
	 	}
	 	else
	 	{
	 		$('#opcionEfectivo').fadeIn(500);
	 		$('#opcionCheques').fadeOut(500);
	 	}	
	 });

	 //AL PRESIONAR EL BOTON DE AGREGAR AL TOTAL EL EFECTIVO
	 $('#botonEfectivo').click(function(){
	 	//trae monto en efectivo puesto
	 	var totalEfectivo = $('#totalEfectivo').val();
	 	//trae monto total de sumatoria
	 	var montoTotal = $('#montoTotal').val();
	 	//suma ambos monstos
	 	var sumatoria = parseInt(montoTotal) + parseInt(totalEfectivo);
	 	//coloca el resultado en el monto total de la sumatoria
	 	$('#montoTotal').val(sumatoria);
	 	//trae la cuenta seleccionada
	 	var cuentaSeleccionada = $('#cuentaSeleccionada').val();
	 		
	 	//ejecuta replace para quitar todos los espacios del nombre de la cuenta y asi poder utilizarlo posteriormente como identificador de los div que se agregaran con la cuenta y el monto, el identificador se construira con la operatoria y el nombre de cuenta ejemplo: efecitvoBancoGalicia	
	 	var cuentaSeleccionadaB = cuentaSeleccionada;
     	var cuentaSeleccionadaC = cuentaSeleccionadaB.replace(/ /g,'');

     	//quita del selector de cuentas la opcion de la cuenta seleccionada
		$("#cuentaSeleccionada option[value='"+cuentaSeleccionada+"']").each(function() {
		    $(this).remove();
		});

		//agrega a los resultados un div nuevo con el detalle y el monto y la posibiliad de volver el proceso atras
	 	$( "#MontoNuevo" ).append( "<div class='alert alert-dismissible alert-success' id='efectivo"+cuentaSeleccionadaC+"'><strong>" + cuentaSeleccionada + "</strong> $ "+totalEfectivo+" <input hidden type='text' name='cuentaB' id='cuentaB' value='"+cuentaSeleccionada+"'><input hidden type='text' name='montoB' id='montoB' value='"+totalEfectivo+"'><input hidden type='text' name='actionB' id='actionB' value='volverAtrasMetodoDePago'><button type='button' id='eliminarEfectivo"+cuentaSeleccionadaC+"'>&times;</button></div>");


	 		//prepara las variables para ejecutar atravez de ajax la accion nuevoMovimiento de la pagina accionesCuentasMovimientos.php donde agregara un detalle con debe o con haber dependiendo del tipo de movimiento
			var mcs_movimiento 	="PAGO DE COMPROBANTE EN EFECTIVO";
		    var mcs_desc 		="";
		    var mcd_fec 		="<?php echo $FechayHora;?>";
		    var monto 			=totalEfectivo;
		    var tipoMovimeinto 	=2; //Debita
		    var action 			="nuevoMovimiento";

		    var dataString = 'action='+action 
		      + '&mcs_movimiento='+mcs_movimiento 
		      + '&mcs_desc='+mcs_desc
		      + '&mcd_fec='+mcd_fec 
		      + '&cuentaSeleccionada='+cuentaSeleccionada 
		      + '&monto='+monto
		      + '&tipoMovimeinto='+tipoMovimeinto;

		      $.ajax(
		                                                  {
		                                                      type: 'POST',
		                                                      url: 'accionesCuentasMovimientos.php',
		                                                      data: dataString,
		                                                      success: function(dataC)
		                                                       {
		                                                          $('#suggestionsTableEfectivo').fadeIn(1000).html(dataC);
		                                                       }

		                                                   });

		      	
		      	//dentro de la misma funcion se encuentra la posibilidad de volver atras el proceso presionando el boton con la x
		      	 $('#eliminarEfectivo'+cuentaSeleccionadaC).click(function(){
		      	 	//prepara las variables para ejecutar atravez de ajax la accion nuevoMovimiento de la pagina accionesCuentasMovimientos.php donde agregara un detalle con debe o con haber dependiendo del tipo de movimiento
		      	 		var cuentaB 		= $('#cuentaB').val();
					    var montoB 			= $('#montoB').val();
					    var actionB 		= "nuevoMovimiento";
					    var mcs_movimientoB = "ELIMINACIÓN DE PAGO DE COMPROBANTE EN EFECTIVO";
					    var mcs_descB 		= "";
		    			var mcd_fecB 		= "<?php echo $FechayHora;?>";
		    			var tipoMovimeintoB = 1;

		    			//descuenta del total que se muestra con la sumatorio el monto que anteriormente habia agregado
		    			var montoTotalB = $('#montoTotal').val();
					 	var sumatoriaB = parseInt(montoTotalB) - parseInt(montoB);
					 	$('#montoTotal').val(sumatoriaB);


				 	 	var dataStringB = 'action='+actionB 
		      			+ '&mcs_movimiento='+mcs_movimientoB 
		      			+ '&mcs_desc='+mcs_descB
		      			+ '&mcd_fec='+mcd_fecB 
		      			+ '&cuentaSeleccionada='+cuentaB 
		      			+ '&monto='+montoB
		      			+ '&tipoMovimeinto='+tipoMovimeintoB;
		
		      			$('#efectivo'+cuentaSeleccionadaC).remove();
				      	$.ajax(
				                                                  {
				                                                      type: 'POST',
				                                                      url: 'accionesCuentasMovimientos.php',
				                                                      data: dataStringB,
				                                                      success: function(dataD)
				                                                       {
				                                                       	//vuelve a agregar a las opciones del selector de cuentas la cuenta que anteriormente habia quitado
				                                                          $('#cuentaSeleccionada').append($('<option>', {
																				    value: cuentaSeleccionada,
																				    text: cuentaSeleccionada
																				}));

				                                                          
				                                                       }

				                                                   });
				 });

	 });

	 $('#botonChequeNuevo').click(function(){
	 	//SUMA MONTO DEL CHEQUE NUEVO AL TOTAL
	 	var che_importe = $('#che_importe_nuevo').val();
	 	var montoTotal = $('#montoTotal').val();
	 	var sumatoria = parseInt(montoTotal) + parseInt(che_importe);
	 	$('#montoTotal').val(sumatoria);
	 	var cuentaSeleccionadaBX = "CHEQUE PROPIO -Nº"+$('#che_num').val();
	 	var cuentaSeleccionadaX = $('#cuentaSeleccionada').val();

	 		 	//ejecuta replace para quitar todos los espacios del nombre de la cuenta y asi poder utilizarlo posteriormente como identificador de los div que se agregaran con la cuenta y el monto, el identificador se construira con la operatoria y el nombre de cuenta ejemplo: efecitvoBancoGalicia	
     	var cuentaSeleccionadaCX = cuentaSeleccionadaX.replace(/ /g,'');



	 		 // GUARDA CHEQUE EN LA TABLA DE CHEQUES COMO PROPIO DEBITADO
	 		  var action = "nuevoCheque";
		      var fecha = $('#fecha').val();
		      var che_tipo = $('#che_tipo').val();
		      var ID_ban = $('#ID_ban').val();
		      var che_librador = $('#librador').val();
		      var che_estado = "DEBITADO";
		      var che_procedencia = "PROPIO";
		      var che_num = $('#che_num').val()
		      var che_beneficiario = $('#beneficiario').val()
		      var dataString = 'action='+action 
		      + '&cuentaSeleccionada='+cuentaSeleccionadaX 
		      + '&che_importe='+che_importe
		      + '&che_fecha='+fecha 
		      + '&che_tipo='+che_tipo 
		      + '&ID_ban='+ID_ban
		      + '&che_librador='+che_librador
		      + '&che_estado_propio='+che_estado
		      + '&che_procedencia='+che_procedencia
		      + '&che_num='+che_num
		      + '&che_beneficiario='+che_beneficiario;
		      $.ajax(
		                                                  {
		                                                      type: 'POST',
		                                                      url: 'accionesCheques.php',
		                                                      data: dataString,
		                                                      success: function(data)
		                                                       {
		                                                          	 $('#suggestionsChequeNuevoCompra').fadeIn(100).html(data); 
				                                                      	 var ID_mcsD = $('#RespuestaIdMovCuenta').val();
				                                                      	 var ID_cheD = $('#chequeeliminar').val();	
																		$( "#MontoNuevo" ).append( "<input hidden type='text' name='RespuestaIdMovCuentaChequeNuevoCompra"+che_num+"' id='RespuestaIdMovCuentaChequeNuevoCompra"+che_num+"' value='"+ID_mcsD+"'><input  hidden type='text' name='chequeeliminar"+che_num+"' id='chequeeliminar"+che_num+"' value='"+ID_cheD+"'>");	
		                                                       }

		                                                   });



     	$( "#MontoNuevo" ).append( "<div class='alert alert-dismissible alert-warning' id='nuevoCheque"+cuentaSeleccionadaCX+"'><strong>" + cuentaSeleccionadaBX + "</strong> $ "+che_importe+"<br> Cuenta a Debitar: " +cuentaSeleccionadaX+" <input hidden type='text' name='cuentaBXX"+che_num+"' id='cuentaBXX"+che_num+"' value='"+cuentaSeleccionadaX+"'><input hidden type='text' name='montoBXX"+che_num+"' id='montoBXX"+che_num+"' value='"+che_importe+"'><input hidden type='text' name='che_numXX"+che_num+"' id='che_numXX"+che_num+"' value='"+che_num+"'><button type='button' id='eliminarNuevoCheque"+cuentaSeleccionadaCX+"'>&times;</button></div>");
	 	
		      	//dentro de la misma funcion se encuentra la posibilidad de volver atras el proceso presionando el boton con la x
		      	 $('#eliminarNuevoCheque'+cuentaSeleccionadaCX).click(function(){
		      	 	//prepara las variables para ejecutar atravez de ajax la accion nuevoMovimiento de la pagina accionesCuentasMovimientos.php donde agregara un detalle con debe o con haber dependiendo del tipo de movimiento
		      	 	    var ID_cheXX 				= $('#chequeeliminar'+che_num).val();
		      	 		var opcionVolverXX  		= "no";
    					var opcionBorrarCuentaXX  	= "si";
    					var cuentaSeleccionadaXX 	= cuentaSeleccionadaX;
    					var tipoMovimientoXX 		= 1;
    					var actionXX 				= "borrarCheque";
    					var ID_mcsXX				= $('#RespuestaIdMovCuentaChequeNuevoCompra'+che_num).val();

				 	 	var dataStringXX = 'action='+actionXX 
				 	 	+ '&ID_che='+ID_cheXX 
					    + '&opcionVolver='+opcionVolverXX 
					    + '&opcionBorrarCuenta='+opcionBorrarCuentaXX 
					    + '&cuentaSeleccionada='+cuentaSeleccionadaXX
					    + '&ID_mcs='+ID_mcsXX 
					    + '&tipoMovimiento='+tipoMovimientoXX;

				      	$.ajax(
				                                                  {
				                                                      type: 'POST',
				                                                      url: 'accionesCheques.php',
				                                                      data: dataStringXX,
				                                                      success: function(data)
				                                                       {
				                                                       
				                                                       }

				                                                   });


				      	$('#nuevoCheque'+cuentaSeleccionadaCX).remove();
				 });

	 });

	
</script>

  <!--////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    /////////////////////I N I C I O   S C R I P T  F L U J O   V E N T A  VIEJO/////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////-->


		    



<!-- SCRIPT DE EFECTIVO EN FLUJO COMPRAS -->
<!--<script>
	//AL PRESIONAR EL BOTON DE AGREGAR AL TOTAL EL EFECTIVO
	 $('#botonEfectivoH').click(function(){
	 	//trae monto en efectivo puesto
	 	var totalEfectivo = $('#totalEfectivoH').val();
	 	//trae monto total de sumatoria
	 	var montoTotal = $('#montoTotalH').val();
	 	//suma ambos monstos
	 	var sumatoria = parseInt(montoTotal) + parseInt(totalEfectivo);
	 	//coloca el resultado en el monto total de la sumatoria
	 	$('#montoTotalH').val(sumatoria);
	 	//trae la cuenta seleccionada
	 	var cuentaSeleccionada = $('#cuentaSeleccionadaH').val();
	 		
	 	//ejecuta replace para quitar todos los espacios del nombre de la cuenta y asi poder utilizarlo posteriormente como identificador de los div que se agregaran con la cuenta y el monto, el identificador se construira con la operatoria y el nombre de cuenta ejemplo: efecitvoBancoGalicia	
	 	var cuentaSeleccionadaB = cuentaSeleccionada;
     	var cuentaSeleccionadaC = cuentaSeleccionadaB.replace(/ /g,'');

     	//quita del selector de cuentas la opcion de la cuenta seleccionada
		$("#cuentaSeleccionadaH option[value='"+cuentaSeleccionada+"']").each(function() {
		    $(this).remove();
		});

		//agrega a los resultados un div nuevo con el detalle y el monto y la posibiliad de volver el proceso atras
	 	$( "#MontoNuevoH" ).append( "<div class='alert alert-dismissible alert-success' id='efectivoH"+cuentaSeleccionadaC+"'><strong>" + cuentaSeleccionada + "</strong> $ "+totalEfectivo+" <input hidden type='text' name='cuentaBH' id='cuentaBH' value='"+cuentaSeleccionada+"'><input hidden type='text' name='montoBH"+cuentaSeleccionadaC+"' id='montoBH"+cuentaSeleccionadaC+"' value='"+totalEfectivo+"'><input hidden type='text' name='actionBH' id='actionBH' value='volverAtrasMetodoDePago'><button type='button' id='eliminarEfectivoH"+cuentaSeleccionadaC+"'>&times;</button></div>");


	 		//prepara las variables para ejecutar atravez de ajax la accion nuevoMovimiento de la pagina accionesCuentasMovimientos.php donde agregara un detalle con debe o con haber dependiendo del tipo de movimiento
			var mcs_movimiento 	="COBRO DE COMPROBANTE EN EFECTIVO";
		    var mcs_desc 		="";
		    var mcd_fec 		="<?php echo $FechayHora;?>";
		    var monto 			=totalEfectivo;
		    var tipoMovimeinto 	=1; //Acredita
		    var action 			="nuevoMovimiento";

		    var dataString = 'action='+action 
		      + '&mcs_movimiento='+mcs_movimiento 
		      + '&mcs_desc='+mcs_desc
		      + '&mcd_fec='+mcd_fec 
		      + '&cuentaSeleccionada='+cuentaSeleccionada 
		      + '&monto='+monto
		      + '&tipoMovimeinto='+tipoMovimeinto;

		      $.ajax(
		                                                  {
		                                                      type: 'POST',
		                                                      url: 'accionesCuentasMovimientos.php',
		                                                      data: dataString,
		                                                      success: function(dataC)
		                                                       {
		                                                          $('#suggestionsTableEfectivo').fadeIn(1000).html(dataC);
		                                                       }

		                                                   });

		      	
		      	//dentro de la misma funcion se encuentra la posibilidad de volver atras el proceso presionando el boton con la x
		      	 $('#eliminarEfectivoH'+cuentaSeleccionadaC).click(function(){
		      	 	//prepara las variables para ejecutar atravez de ajax la accion nuevoMovimiento de la pagina accionesCuentasMovimientos.php donde agregara un detalle con debe o con haber dependiendo del tipo de movimiento
		      	 		var cuentaB 		= $('#cuentaBH').val();
					    var montoB 			= $('#montoBH'+cuentaSeleccionadaC).val();
					    var actionB 		= "nuevoMovimiento";
					    var mcs_movimientoB = "ELIMINACIÓN DE COBRO DE COMPROBANTE EN EFECTIVO";
					    var mcs_descB 		= "";
		    			var mcd_fecB 		= "<?php echo $FechayHora;?>";
		    			var tipoMovimeintoB = 2;

		    			//descuenta del total que se muestra con la sumatorio el monto que anteriormente habia agregado
		    			var montoTotalB = $('#montoTotalH').val();
					 	var sumatoriaB = parseInt(montoTotalB)-parseInt(montoB);
					 	$('#montoTotalH').val(sumatoriaB);


				 	 	var dataStringB = 'action='+actionB 
		      			+ '&mcs_movimiento='+mcs_movimientoB 
		      			+ '&mcs_desc='+mcs_descB
		      			+ '&mcd_fec='+mcd_fecB 
		      			+ '&cuentaSeleccionada='+cuentaB 
		      			+ '&monto='+montoB
		      			+ '&tipoMovimeinto='+tipoMovimeintoB;
		
		      			$('#efectivoH'+cuentaSeleccionadaC).remove();
				      	$.ajax(
				                                                  {
				                                                      type: 'POST',
				                                                      url: 'accionesCuentasMovimientos.php',
				                                                      data: dataStringB,
				                                                      success: function(dataH)
				                                                       {
				                                                       	//vuelve a agregar a las opciones del selector de cuentas la cuenta que anteriormente habia quitado
				                                                          $('#cuentaSeleccionadaH').append($('<option>', {
																				    value: cuentaSeleccionada,
																				    text: cuentaSeleccionada
																				}));

				                                                          
				                                                       }

				                                                   });
				 });

	 });

</script>		    


<script type="text/javascript">

	$('#cuentaSeleccionadaH').change(function(){
	 	var cuentaSeleccionada = $('#cuentaSeleccionadaH').val();
	 	if(cuentaSeleccionada=="CHEQUE EN CARTERA")
	 	{
	 		$('#recibirChequeDeTercero').fadeIn(500);
	 		$('#opcionEfectivoH').fadeOut(500);
	 	}
	 	else
	 	{
	 		$('#opcionEfectivoH').fadeIn(500);
	 		$('#recibirChequeDeTercero').fadeOut(500);
	 	}	
	 });


	 $('#botonChequeNuevoH').click(function(){
	 	//SUMA MONTO DEL CHEQUE NUEVO AL TOTAL
	 	var che_importe = $('#che_importe_nuevoH').val();
	 	var montoTotal = $('#montoTotalH').val();
	 	var sumatoria = parseInt(montoTotal) + parseInt(che_importe);
	 	$('#montoTotalH').val(sumatoria);
	 	var cuentaSeleccionadaBX = "CHEQUE DE TERCERO Nº"+$('#che_num').val();
	 	var cuentaSeleccionadaX = $('#cuentaSeleccionadaH').val();

	 		 	//ejecuta replace para quitar todos los espacios del nombre de la cuenta y asi poder utilizarlo posteriormente como identificador de los div que se agregaran con la cuenta y el monto, el identificador se construira con la operatoria y el nombre de cuenta ejemplo: efecitvoBancoGalicia	
     	var cuentaSeleccionadaCX = cuentaSeleccionadaX.replace(/ /g,'');


	 		 // GUARDA CHEQUE EN LA TABLA DE CHEQUES COMO PROPIO DEBITADO
	 		  var action = "nuevoCheque";
		      var fecha = $('#fecha').val();
		      var che_tipo = $('#che_tipo').val();
		      var ID_ban = $('#ID_ban').val();
		      var che_librador = $('#librador').val();
		      var che_estado = "EN CARTERA";
		      var che_procedencia = "TERCERO";
		      var che_num = $('#che_num').val()
		      var che_beneficiario = $('#beneficiario').val()
		      var dataString = 'action='+action 
		      + '&cuentaSeleccionada='+cuentaSeleccionadaX 
		      + '&che_importe='+che_importe
		      + '&che_fecha='+fecha 
		      + '&che_tipo='+che_tipo 
		      + '&ID_ban='+ID_ban
		      + '&che_librador='+che_librador
		      + '&che_estado_tercero='+che_estado
		      + '&che_procedencia='+che_procedencia
		      + '&che_num='+che_num
		      + '&che_beneficiario='+che_beneficiario;
		      $.ajax(
		                                                  {
		                                                      type: 'POST',
		                                                      url: 'accionesCheques.php',
		                                                      data: dataString,
		                                                      success: function(data)
		                                                       {
		                                                          $('#suggestionsTableH').fadeIn(1000).html(data);
		                                                       }

		                                                   });



     	$( "#MontoNuevoH" ).append( "<div class='alert alert-dismissible alert-warning' id='nuevoChequeH"+cuentaSeleccionadaCX+"'><strong>" + cuentaSeleccionadaBX + "</strong> $ "+che_importe+"<br> Cuenta a Acreditar: " +cuentaSeleccionadaX+" <input hidden type='text' name='cuentaBXX"+che_num+"' id='cuentaBXX"+che_num+"' value='"+cuentaSeleccionadaX+"'><input hidden type='text' name='montoBXX"+che_num+"' id='montoBXX"+che_num+"' value='"+che_importe+"'><input hidden type='text' name='che_numXX"+che_num+"' id='che_numXX"+che_num+"' value='"+che_num+"'><button type='button' id='eliminarNuevoChequeH"+cuentaSeleccionadaCX+"'>&times;</button></div>");
	 	
		      	//dentro de la misma funcion se encuentra la posibilidad de volver atras el proceso presionando el boton con la x
		      	 $('#eliminarNuevoChequeH'+cuentaSeleccionadaCX).click(function(){
		      	 	//prepara las variables para ejecutar atravez de ajax la accion nuevoMovimiento de la pagina accionesCuentasMovimientos.php donde agregara un detalle con debe o con haber dependiendo del tipo de movimiento
		      	 	      var actionXX = "borrarChequeCarteraPorcheNumYDescontarCuenta";
					      var che_numXX = $('#che_numXX'+che_num).val();
					      var che_importeXX = $('#montoBXX'+che_num).val();
					      var cuentaSeleccionadaXX = $('#cuentaBXX'+che_num).val();

		    			//descuenta del total que se muestra con la sumatorio el monto que anteriormente habia agregado
		    			var montoTotalBX = $('#montoTotalH').val();
					 	var sumatoriaB = parseInt(montoTotalBX) - parseInt(che_importeXX);
					 	$('#montoTotalH').val(sumatoriaB);

				 	 	  var dataStringXX = 'action='+actionXX 
					      + '&cuentaSeleccionada='+cuentaSeleccionadaXX 
					      + '&che_importe='+che_importeXX
					      + '&che_num='+che_numXX;


				      	$.ajax(
				                                                  {
				                                                      type: 'POST',
				                                                      url: 'accionesCheques.php',
				                                                      data: dataStringXX,
				                                                      success: function(dataH)
				                                                       {
				                                                       
				                                                       }

				                                                   });

				      	$('#nuevoChequeH'+cuentaSeleccionadaCX).remove();
				 });

	 });

</script>-->

  <!--////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    /////////////////////I N I C I O   S C R I P T  O T R O F L U J O //////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////
		    ////////////////////////////////////////////////////////////////////////////////////////////////-->