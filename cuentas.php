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
    



                            <!--Inicio Modal nueva cuenta-->                          
                            <div class="modal fade" id="nuevoMovimiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class='material-icons'>add_box</i> NUEVO MOVIMIENTO</h4>
                                          </div>
                                          <div class="modal-body">
                                             <form action="accionesCuentasMovimientos.php" method="post" enctype="multipart/form-data">
                                                <fieldset>
                                                    <legend>Datos del movimiento</legend>
                                                        <input hidden type="text" name="action" value="nuevoMovimiento">
                                                          
                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Cuenta</label>
                                                            <select name="ID_cue" class="form-control"> 
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
                                                        
                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Fecha</label>
                                                          <input type="datetime-local" class="form-control" name="mcd_fec" id="mcd_fec" value="<?php echo $FechayHora;?>" placeholder="<?php echo $FechayHora;?>" required>
                                                        </div>


                                                        <div class="form-group">
                                                          <label for="exampleInputEmail1">Descripción</label>
                                                          <input type="text" class="form-control" name="mcs_movimiento" id="mcs_movimiento" placeholder="Descripción del Movimiento" value="INGRESO MANUAL DE MOVIMIENTO DE CUENTA - USUARIO: <?php echo $_SESSION['usu_nombre']." ".$_SESSION['usu_apellido'];?>" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Tipo de Movimiento</label>
                                                            <select name="tipoMovimeinto" class="form-control"> 
                                                                <option value="1">Cédito</option>
                                                                <option value="2">Débito</option>
                                                             </select>
                                                        </div>
  

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Monto</label>
                                                          <input type="text" class="form-control" id="monto" name="monto" placeholder="00.00">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Observación</label>
                                                          <textarea class="form-control" name="mcs_desc" id="mcs_desc"></textarea>
                                                        </div>

                                                         <button type="submit" class="btn btn-success"><i class="material-icons">save</i> GUARDAR</button>

                                                </fieldset>        

                                            </form>
                                           </div>
                                            </div>
                                          <div class="modal-footer">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                <!--Fin Modal nueva cuenta-->

	<div class="container-fluid">
		<div class='col-md-12' style="text-align: center;">
			<div class="alert alert-dismissible alert-info">
				<h3><i class="material-icons">account_balance_wallet</i> Movimientos de cuentas <img src=media/loading/cargando4.gif id='cargandoBoton' style="display: none;" > </h3>
			</div> 
		</div> 


<div class="container-fluid">
  <?php 
     $get_cuentasBB=$cuentasE->get_cuentas();
     $num_get_cuentasBB=mysql_num_rows($get_cuentasBB);
     for ($CountCuentasBB=0; $CountCuentasBB < $num_get_cuentasBB; $CountCuentasBB++) 
      { 
         $assoc_get_cuentasBB=mysql_fetch_assoc($get_cuentasBB);
         $ID_cueBB=$assoc_get_cuentasBB['ID_cue'];

         $traeSaldo=$cuentas_movimientosE->traeSaldo($ID_cueBB);
         $assoc_traeSaldo=mysql_fetch_assoc($traeSaldo);
          echo '<div class="col-md-2" style="text-align:center; font-size:100%;"><div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><i class="material-icons">account_balance_wallet</i> '.$assoc_get_cuentasBB['cue_desc'].' <br> SALDO: $ '.$assoc_traeSaldo['saldo'].'</strong>
          </div></div>';
      }
    
  ?>
</div>  

        <div class='col-md-12' style="text-align: right; margin-bottom:  1%; margin-top:  1%;">
            <div class='col-md-5' style='text-align: left;'>  
                <fieldset>
                  <legend><i class="material-icons">filter_list</i> Filtar por Cuentas</legend>
                  <div class="form-group">
                    <select class="form-control" id="ID_cue">
                       <option selected disabled>Seleccionar una cuenta</option>
                      <option value='0'>TODAS LAS CUENTAS</option>
                      <?php 
                        $get_cuentas=$cuentasE->get_cuentas();
                        $num_get_cuentas=mysql_num_rows($get_cuentas);
                        for ($CountCuentas=0; $CountCuentas < $num_get_cuentas; $CountCuentas++) 
                        { 
                            $assoc_get_cuentas=mysql_fetch_assoc($get_cuentas);
                            $ID_cue=$assoc_get_cuentas['ID_cue'];
                            $traeSaldo=$cuentas_movimientosE->traeSaldo($ID_cue);
                            $assoc_traeSaldo=mysql_fetch_assoc($traeSaldo);
                            $saldo=$assoc_traeSaldo['saldo'];
                            echo "<option value=".$assoc_get_cuentas['ID_cue'].">".$assoc_get_cuentas['cue_desc']." - SALDO: $".$saldo."</option>";
                        } 
                      ?>       
                    </select>
                  </div>
                </fieldset>  
                <script type="text/javascript">
                  $(document).ready(function() {
                      $('#filtrarPorCuenta').change(function(){
                        var ID_cue=$('#filtrarPorCuenta').val();
                          document.location.href = "cuentas.php?ID_cue=" + ID_cue;
                      });
                  });
                  </script>
            </div>
            <div class='col-md-5' style='text-align: left;'>  
                <fieldset>
                  <legend><i class="material-icons">filter_list</i> Filtar por Fechas</legend>
                  <div class="form-group">

                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                            <span></span> <b class="caret"></b>
                    </div>
                  </div>  
                </fieldset>  
             
            </div>
            <div class='col-md-2'>
              <button class='btn btn-success' data-placement='top' data-toggle='modal' data-target='#nuevoMovimiento'><i class='material-icons'>add</i> NUEVO MOVIMIENTO</button>
            </div>  
        </div> 
		<div class='col-md-12' style="text-align: center;" id="suggestions">

        
        </div>  
    </div>

	

<!--Fin: Contenedor principal -->


<!--Fin: Footer -->

<!--Inicio: script -->
    
  

 
<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Hoy': [moment(), moment()],
           'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
           'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
           'Este Mes': [moment().startOf('month'), moment().endOf('month')],
           'Ultimo Mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
    
});

$ ('#reportrange').on('apply.daterangepicker', function (){
  var fecha = $('#reportrange').text();
  var ID_cue = $('#ID_cue').val();

  var dataString = 'fecha='+fecha + '&ID_cue='+ID_cue;

  $.ajax(
                                              {
                                                  type: 'POST',
                                                  url: 'visorCuentas.php',
                                                  data: dataString,
                                                  success: function(data)
                                                   {
                                                      $('#suggestions').fadeIn(1000).html(data);
                                                      
                                                   }

                                               });
});

$ ('#ID_cue').change(function (){
  var fecha = $('#reportrange').text();
  var ID_cue = $('#ID_cue').val();
  var dataString = 'fecha='+fecha + '&ID_cue='+ID_cue;
  $.ajax(
                                              {
                                                  type: 'POST',
                                                  url: 'visorCuentas.php',
                                                  data: dataString,
                                                  success: function(data)
                                                   {
                                                      $('#suggestions').fadeIn(1000).html(data);
                                                      
                                                   }

                                               });
});

$(document).ready(function(){
   var fecha = $('#reportrange').text();
  var ID_cue ="0";
  var dataString = 'fecha='+fecha + '&ID_cue='+ID_cue;
  $.ajax(
                                              {
                                                  type: 'POST',
                                                  url: 'visorCuentas.php',
                                                  data: dataString,
                                                  success: function(data)
                                                   {
                                                      $('#suggestions').fadeIn(1000).html(data);
                                                      
                                                   }

                                               });
});
</script>


     
<!--Fin: script -->

<!--Inicio: Trae Sucursales -->
 

  
<!--Fin: Trae Sucursales -->
<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>
