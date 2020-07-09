<?php 
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
   $_SESSION['actionsBack']= $_SERVER['REQUEST_URI'];
   $usuariosE= new usuariosE;
   $mensajesE= new mensajesE;
 	?>

  <div class='container-fluid'>
	
		 <div class="card text-white bg-default" style="overflow:hidden; ">
  				<div class="card-body">
				    <blockquote class="card-blockquote">
				      <p><strong>BUZON DE ENTRADA</strong></p>
				     <!--<div class='col-md-12' style='margin:2%; cursor:pointer;'  id='eliminados'><p class='text-danger'><i class='material-icons'>delete_forever</i> Ver Eliminados</p><hr></div>
				     <div class='col-md-12' style='margin:2%; display:none; cursor:pointer;' id='recibidos'><p class='text-success'><i class='material-icons'>move_to_inbox</i> Ver Recibidos</p><hr></div>-->
				     <br><br>
		 	<div class='col-md-3'>
							<?php

							   $get_mensajes=$mensajesE->get_mensajes();
							   $num_get_mensajes=mysql_num_rows($get_mensajes);
							   for ($countmensajes=0; $countmensajes < $num_get_mensajes; $countmensajes++)
							   { 

							   	$assoc_get_mensajes=mysql_fetch_assoc($get_mensajes);
							   	$ID_men=$assoc_get_mensajes['ID_men'];
							   	if ($assoc_get_mensajes['men_visto']==0) 
							   	{
							   		$mail="mail";
							   		$colorMensaje="success";
							   	}
							   	else
							   	{
							   		$mail="drafts";
							   		$colorMensaje="info";
							   	}	

									echo "<div class='col-md-12' style='text-align: left;'>";
											echo "<div class='col-md-12'>";
												echo "<div class='alert alert-dismissible alert-".$colorMensaje."' style='font-size: 15px; cursor:pointer;' id='Mensaje".$assoc_get_mensajes['ID_men']."'>";
													echo "<i class='material-icons'>".$mail."</i> Mensaje: ".$assoc_get_mensajes['men_asunto']."";
												echo "</div>";
											echo "</div>";
									echo "</div>";

																echo "<script>
																          $('#Mensaje".$assoc_get_mensajes['ID_men']."').click(function(){
																              var ID_men= '".$ID_men."';   
																              var dataString = 'ID_men='+ID_men;

																              $.ajax(
																              {
																                  type: 'POST',
																                  url: 'visorMensaje.php',
																                  data: dataString,
																                  success: function(data)
																                   {
																                      $('#suggestions').fadeIn(1000).html(data);
																                      $('#Mensaje".$assoc_get_mensajes['ID_men']."').removeClass('alert alert-dismissible alert-success');
																                      $('#Mensaje".$assoc_get_mensajes['ID_men']."').addClass('alert alert-dismissible alert-info');

																                   }

																               });
																               });   
																				
						                                            </script>";


								}	
								?>
				
		  </div>
		  <div class='col-md-9' id='suggestions'>	
					
		  </div>	
		 </blockquote>
  		</div>
	</div>
  </div>

	<?php 
	include("modulos/footer.php"); 
?>
