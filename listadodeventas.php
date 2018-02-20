<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack'] = $_SERVER['REQUEST_URI'];
  $cabecera_comprobantes=new cabecera_comprobantes;
  // $cabecera_comprobantesE=new cabecera_comprobantesE;
  $tipo_comprobantes    = new tipo_comprobantes;
  $tipo_comprobantesE   = new tipo_comprobantesE;
  $comprobantesE        = new comprobantesE;
  $cuentas              = new cuentas;
  $cuentasE             = new cuentasE;
  $clientes             = new clientes;
  $articulosE           = new articulosE;
  $stockE               = new stockE;
  $proveedores          = new proveedores;
  $puntos_de_ventas     = new puntos_de_ventas;
  $sucursales           = new sucursales;
  $FechayHora           = date("Y-m-d H:i:s");
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
  				<h3><i class="material-icons">shopping_cart</i> Ventas<img src='media/loading/cargando4.gif' id='cargandoBoton' style="display: none;" > </h3>
  			</div> 
  		</div> 
</div>



		  <!--////////////////////////////////////// F I L T R A R  C O M P R O B A N T E S ///////////////////////////////////-->

  
<div class="container-fluid">

        <div class='col-md-12' style="text-align: right; margin-bottom:  1%; margin-top:  1%; border-top: 2px solid #333; padding-top: 2%;">
            <div class='col-md-5' style='text-align: left;'>  
                <fieldset>
                  <legend><i class="material-icons">filter_list</i> Filtar por Comprobantes</legend>
                  <div class="form-group">
                    <select class="form-control" id="ID_tceB">
                       <option selected disabled>Seleccionar un tipo de comprobante</option>
                        <option value='0'>TODAS LOS COMPROBANTES</option>
                        <?php 
                          $get_tipo_comprobantesB=$comprobantesE->get_cabecera_comprobantes_listado_ventas_select();
                          $num_get_tipo_comprobantesB=mysql_num_rows($get_tipo_comprobantesB);
                          for ($Countget_tipo_comprobantesB=0; $Countget_tipo_comprobantesB < $num_get_tipo_comprobantesB; $Countget_tipo_comprobantesB++) 
                          { 
                              $assoc_get_tipo_comprobantesB=mysql_fetch_assoc($get_tipo_comprobantesB);
                              $ID_tce=$assoc_get_tipo_comprobantesB['ID_tce'];
                              $tce_desc=$assoc_get_tipo_comprobantesB['tce_desc'];
                              echo "<option value=".$assoc_get_tipo_comprobantesB['ID_tce'].">".$tce_desc."</option>";
                          } 
                        ?>       
                    </select>
                  </div>
                </fieldset>  
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
              <div class='col-md-12' style="text-align: center;" id="suggestionsTable">

        
        </div> 
           
        </div> 

  
        


    
     
 
</div>



<!--Fin: Contenedor principal -->


<!--Fin: Footer -->

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
  var ID_tceB = $('#ID_tceB').val();

  var dataString = 'fecha='+fecha + '&ID_tceB='+ID_tceB;

  $.ajax(
                                              {
                                                  type: 'POST',
                                                  url: 'visorComprobantesVentas.php',
                                                  data: dataString,
                                                  success: function(data)
                                                   {
                                                      $('#suggestionsTable').fadeIn(1000).html(data);
                                                      
                                                   }

                                               });
});

$ ('#ID_tceB').change(function (){
  
  var fecha = $('#reportrange').text();
  var ID_tceB = $('#ID_tceB').val();
  var dataString = 'fecha='+fecha + '&ID_tceB='+ID_tceB;
  $.ajax(
                                              {
                                                  type: 'POST',
                                                  url: 'visorComprobantesVentas.php',
                                                  data: dataString,
                                                  success: function(data)
                                                   {
                                                      $('#suggestionsTable').fadeIn(1000).html(data);
                                                      
                                                   }

                                               });
});

$(document).ready(function(){
  var fecha = $('#reportrange').text();
  var ID_tceB ="0";
  var dataString = 'fecha='+fecha + '&ID_tceB='+ID_tceB;
  $.ajax(
                                              {
                                                  type: 'POST',
                                                  url: 'visorComprobantesVentas.php',
                                                  data: dataString,
                                                  success: function(data)
                                                   {
                                                      $('#suggestionsTable').fadeIn(1000).html(data);
                                                      
                                                   }

                                               });
});
</script>
     
<!--Fin: script -->


<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>

