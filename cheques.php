<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack'] = $_SERVER['REQUEST_URI'];
  // $cabecera_comprobantesE=new cabecera_comprobantesE;
  $bancos     = new bancos;
  $FechayHora = date("Y-m-d H:i:s");
  if (@$_GET['nuevo']=='si') 
  {
    echo "<script>
      $(document).ready(function(){
      $('#nuevoComprobanteBoton').click();
      });
    </script>";
  }
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
  			<div class="alert alert-dismissible alert-info">
  				<h3><i class="material-icons">style</i> Cheques<img src='media/loading/cargando4.gif' id='cargandoBoton' style="display: none;"> </h3>
  			</div> 
  		</div> 
</div>


<?php 

 /* Inicio Modal nuevo cheque */                          
    echo '<div class="modal fade" id="NuevoCheque" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
            <div class="modal-dialog modal-lg" role="document" style="width:80%;">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><div class="alert alert-dismissible alert-info" style="text-align: center;">
                      <h3><i class="material-icons">list</i> FORMULARIO DE ALTA DE CHEQUE</h3>
                    </div> </h4>
                  </div>
                  <div class="modal-body" style="text-align:center;">
                  <form action="accionesCheques.php" method="post" enctype="multipart/form-data" >
                        <fieldset>
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
                            <button class="btn btn-success" type="submit"><i class="material-icons">save</i> Guardar</button>
                            </form>
                          </div>
                   </div>
                  <div class="modal-footer">
                      
                  </div>
                </div>
              </div>
            </div>';
        /* Fin Modal nuevo cheque */
      echo " <button id='btnRecorrer' style='margin:2%; display:none;'><i class='material-icons'>refresh</i></button>";
                                          
?>

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
</script>

      <!--////////////////////////////////////// I N I C I O  N U E V O   C O M P R O B A N T E ///////////////////////////////////-->
     
          <div class='col-md-12' style="text-align: right; margin-bottom:  1%; margin-top:  1%;">
              <button class='btn btn-success' id='nuevoCheque'  data-toggle='modal' title='Agregar Articulo' data-placement='top' data-target='#NuevoCheque'><i class='material-icons'>add</i> NUEVO CHEQUE</button>
          </div> 

<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>

