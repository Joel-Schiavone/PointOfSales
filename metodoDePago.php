<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack'] = $_SERVER['REQUEST_URI'];
  $cuentasE = new cuentasE;
  $chequesE = new chequesE;
  $cheques 	= new cheques;
  $bancos 	= new bancos;
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
										  echo '</div>';

			    						echo '<div class="panel panel-success" id="opcionCheques" style="display:none">';
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
											 echo '<button class="btn btn-primary" type="submit"><i class="material-icons">unarchive</i> AGREGAR AL TOTAL</button>';
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
						                                                	<input type="text" class="form-control" id="estadoChequeSeleccion'.$assoc_get_chequesE['ID_che'].'" value="Disponible" style="border: 0px; text-align: center; font-weight:bold;">
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
							                              <input type="text" name="che_importe" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="00.00" required>
							                          </div>
							                        </div>

							                         <div class="form-group">
							                            <label for="che_num "><i class="material-icons">fingerprint</i> NUMERO</label>
							                            <input type="text" class="form-control" id="che_num " name="che_num" placeholder="" required>
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
							                            <button class="btn btn-primary" type="submit"><i class="material-icons">unarchive</i> AGREGAR AL TOTAL</button>
							                            </fieldset>';
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
										  		echo '<div class="form-group">';
													  echo '<div class="input-group">';
													    echo '<span class="input-group-addon">$</span>';
													     echo '<input class="form-control" type="text" id="montoTotal" value="00:00" placeholder="00.00">';
													  echo '</div>';
													echo '</div>';
										    echo "<div id='MontoNuevo'></div>";
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

	 $('#botonEfectivo').click(function(){
	 	var totalEfectivo = $('#totalEfectivo').val();
	 	var montoTotal = $('#montoTotal').val();
	 	var sumatoria = parseInt(montoTotal) + parseInt(totalEfectivo);
	 	$('#montoTotal').val(sumatoria);
	 	var cuentaSeleccionada = $('#cuentaSeleccionada').val();
	 	$( "#MontoNuevo" ).append( "<div class='alert alert-dismissible alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>" + cuentaSeleccionada + "</strong> $ "+totalEfectivo);
	 });

</script>