<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack']= $_SERVER['REQUEST_URI'];
  $cuentas      = new cuentas;
  $cuentasE     = new cuentasE;
  $cuentas_tipo = new cuentas_tipo;
  $cuentas_movimientosE  = new cuentas_movimientosE;
  $FechayHora         = date("Y-m-d H:i:s");
?>
<!--Fin: Documentos requeridos --> 
<style type="text/css">
	th
	{
	 text-align:center;
	}
</style>
    


    <div class='col-md-12' style="text-align: center;">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
           
          
              <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      <i class="material-icons">compare_arrows</i> Transferencias entre cuentas
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                        <form action="accionesCuentasMovimientos.php" method="POST">
                          <fieldset>
                            <legend>Transferencias</legend>
                             <div class="form-group">
                              <label for="exampleInputEmail1">Cuenta A debitar</label>
                              <select name="ID_cueReceptor" class="form-control"> 
                                                              <?php 
                                                                 $get_cuentasB=$cuentasE->get_cuentas();
                                                                  $num_get_cuentasB=mysql_num_rows($get_cuentasB);
                                                                  for ($CountCuentasB=0; $CountCuentasB < $num_get_cuentasB; $CountCuentasB++) 
                                                                  { 
                                                                      $assoc_get_cuentasB=mysql_fetch_assoc($get_cuentasB);
                                                                      echo "<option value='".$assoc_get_cuentasB['ID_cue']."'>".$assoc_get_cuentasB['cue_desc']."</option>";
                                                                  }
                                                              ?>                     
                              </select>
                            </div>
                           <div class="form-group">
                                <label class="control-label">Importe a Transferir</label>
                                <div class="form-group">
                                  <label class="sr-only" for="Importe">Peso Argentino</label>
                                  <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="text" name="monto" class="form-control" id="Importe" placeholder="Amount">
                                    <div class="input-group-addon">.00</div>
                                  </div>
                                </div>
                            </div>
                          
                            <div class="form-group">
                              <label for="observacion">Obervación</label>
                              <textarea class="form-control" name="observacion" id="observacion" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                              <input hidden type="text" name="action" value="OperacionTransferencia">
                              <label for="exampleInputEmail1">Cuenta de Destino</label>
                              <select name="ID_cueEmisor" class="form-control"> 
                                                              <?php 
                                                                 $get_cuentas=$cuentasE->get_cuentas();
                                                                  $num_get_cuentas=mysql_num_rows($get_cuentas);
                                                                  for ($CountCuentas=0; $CountCuentas < $num_get_cuentas; $CountCuentas++) 
                                                                  { 
                                                                      $assoc_get_cuentas=mysql_fetch_assoc($get_cuentas);
                                                                      echo "<option value='".$assoc_get_cuentas['ID_cue']."'>".$assoc_get_cuentas['cue_desc']."</option>";
                                                                  }
                                                              ?>
                              </select>
                            </div>
                            

                            <button type="submit" class="btn btn-primary"><i class="material-icons">compare_arrows</i> Realizar Transferencia</button>
                          </fieldset>
                        </form>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      <i class="material-icons">next_week</i> Otras Operaciones
                    </a>
                  </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="panel-body">
                    No disponible.
                  </div>
                </div>
              </div>
            </div>
                        
    </div>
</div>
	

<!--Fin: Contenedor principal -->


<!--Fin: Footer -->

<!--Inicio: script -->
    
  

 
<script type="text/javascript">

</script>


     
<!--Fin: script -->

<!--Inicio: Trae Sucursales -->
 

  
<!--Fin: Trae Sucursales -->
<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>
