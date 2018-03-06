<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack'] = $_SERVER['REQUEST_URI'];
  // $cabecera_comprobantesE=new cabecera_comprobantesE;
  $bancos     = new bancos;
  $chequesE   = new chequesE;
  $cuentas    = new cuentas;  
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

                           <div class="form-group has-success" id="contenedorCodigo">
                             <label for="che_num" class="control-label" id="labelA" style="display:block; text-align: left;">NUMERO <i class="material-icons">done</i></label>
                               <label for="che_num" class="control-label" id="labelB" style="display:none; text-align: left;">NUMERO <i class="material-icons">clear</i> Duplicado</label>
                                  <input type="text" class="form-control" id="che_num" name="che_num" placeholder="" required>
                                
                       </div>';

                              //VALIDA QUE EL CODIGO NO SE DUPLIQUE
                              echo '<script>$("#che_num").keyup(function()
                                {
                                  var che_num = $(this).val();      
                                  var action = "validaCodigoDeCheuqeDuplicado";
                                  var dataString = "che_num="+che_num + "&action="+action;

                                  $.ajax(
                                  {
                                      type: "POST",
                                      url: "accionesCheques.php",
                                      data: dataString,
                                      success: function(datas)
                                       {
                                          if(datas==0)
                                          {
                                             $("#contenedorCodigo").removeClass("form-group has-error");
                                             $("#contenedorCodigo").addClass("form-group has-success");
                                             $("#labelB").css("display", "none");
                                             $("#labelA").css("display", "block");
                                             $("#botonGuardarNuevoCheque").css("display", "block");
                                          }
                                          else
                                          {
                                             $("#contenedorCodigo").removeClass("form-group has-success");
                                             $("#contenedorCodigo").addClass("form-group has-error");
                                             $("#labelA").css("display", "none");
                                             $("#labelB").css("display", "block");
                                             $("#botonGuardarNuevoCheque").css("display", "none");
                                          } 
                                         
                                        }
                                       
                                   });
                               });</script>';



                      echo '<div class="form-group">
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

                                  <label class="control-label"><i class="material-icons">folder_shared</i> PROCEDENCIA</label>
                                    <div class="form-group">
                                      <select class="form-control" id="che_procedencia" name="che_procedencia">
                                      <option value="TERCERO">TERCERO</option>
                                        <option value="PROPIO">PROPIO</option>
                                      </select>
                                    </div>


                                    <div class="form-group" id="cuenta" style="display:none;">
                                     <label class="control-label"><i class="material-icons">account_balance_wallet</i> CUENTA</label>
                                      <select class="form-control" id="ID_cue" name="ID_cue">';
                                       $get_cuentas=$cuentas->get_cuentas();
                                        $num_get_cuentas=mysql_num_rows($get_cuentas);
                                        for ($countCuentas=0; $countCuentas < $num_get_cuentas; $countCuentas++) 
                                        { 
                                          $assoc_get_cuentas=mysql_fetch_assoc($get_cuentas);
                                          echo "<option value='".$assoc_get_cuentas['ID_cue']."'>".$assoc_get_cuentas['cue_desc']."</option>";
                                        }
                                  echo '</select>
                                    </div>          

                                  
                                    <div class="form-group" id="select_che_estado_propio" style="display:none;">
                                    <label class="control-label"><i class="material-icons">assistant_photo</i> ESTADO</label>
                                      <select class="form-control" id="che_estado_propio" name="che_estado_propio">
                                        <option value="DEBITADO">DEBITADO</option>
                                        <option value="EMITIDO">EMITIDO</option>
                                      </select>
                                    </div>  


                                    <div class="form-group" id="select_che_estado_tercero">
                                    <label class="control-label"><i class="material-icons">assistant_photo</i> ESTADO</label>
                                      <select class="form-control" id="che_estado_tercero" name="che_estado_tercero">
                                        <option value="EN CARTERA">EN CARTERA</option>
                                        <option value="COBRADO">COBRADO</option>
                                        <option value="UTILIZADO">UTILIZADO</option>
                                      </select>
                                    </div>  

                          <div class="form-group">
                            <button class="btn btn-success" type="submit" id="botonGuardarNuevoCheque"><i class="material-icons">save</i> Guardar</button>
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

  $(document).ready(function(){
        $('#che_procedencia').change(function(){

        var che_procedencia = $('#che_procedencia').val();
          if (che_procedencia=="PROPIO") 
          {
            $('#cuenta').fadeIn(500);
            $('#select_che_estado_propio').fadeIn(500);
            $('#select_che_estado_tercero').fadeOut(500);
          }
          else
         {
           $('#cuenta').fadeOut(500);
           $('#select_che_estado_tercero').fadeIn(500);
           $('#select_che_estado_propio').fadeOut(500);           
         }   
      })
  });

</script>




      <!--////////////////////////////////////// I N I C I O  N U E V O   C O M P R O B A N T E ///////////////////////////////////-->
    <div class="container-fluid"> 


             

          <div class='col-md-12' style="text-align: right; margin-bottom:  1%; margin-top:  1%;">

            
            <div class='col-md-2' style='text-align: left;'>  
                <fieldset>
                  <legend><i class="material-icons">filter_list</i> Filtar por Tipo</legend>
                  <div class="form-group">
                    <select class="form-control" id="che_tipoB">
                       <option disabled>Seleccionar un tipo de Cheque</option>
                        <option value='0'>Todos los Tipos</option>
                         <option value="CRUZADOS">CRUZADOS</option>
                         <option value="CERTIFICADO">CERTIFICADO</option>
                         <option value="AL BENEFICIARIO">AL BENEFICIARIO</option>
                         <option value="DE CAJA">DE CAJA</option>
                         <option value="DE VENTANILLA">DE VENTANILLA</option>
                         <option value="DE VIAJERO">DE VIAJERO</option>
                         <option value="A LA ORDEN">A LA ORDEN</option>
                    </select>
                  </div>
                </fieldset>  
            </div>
             <div class='col-md-2' style='text-align: left;'>  
                <fieldset>
                  <legend><i class="material-icons">filter_list</i> Filtar por Estado</legend>
                  <div class="form-group">
                    <select class="form-control" id="che_estadoB">
                       <option disabled>Seleccionar un estado de Cheque</option>
                        <option value='0'>Todos los Estados</option>
                         <option value="EN CARTERA">EN CARTERA</option>
                         <option value="COBRADO">COBRADO</option>
                         <option value="UTILIZADO">UTILIZADO</option>
                         <option value="DEBITADO">DEBITADO</option>
                         <option value="EMITIDO">EMITIDO</option>
                    </select>
                  </div>
                </fieldset>  
            </div>
            <div class='col-md-2' style='text-align: left;'>  
                <fieldset>
                  <legend><i class="material-icons">filter_list</i> Filtar por Banco</legend>
                  <div class="form-group">
                    <select class="form-control" id="ID_banB">
                       <option disabled>Seleccionar Banco</option>
                        <option value='0'>Todos los Bancos</option>
                          <?php 
                                $get_bancosC=$bancos->get_bancos();
                                $num_get_bancosC=mysql_num_rows($get_bancosC);
                                for ($countBancosC=0; $countBancosC < $num_get_bancosC; $countBancosC++) 
                                { 
                                  $assoc_get_bancosC=mysql_fetch_assoc($get_bancosC);
                                  echo "<option value='".$assoc_get_bancosC['ID_ban']."'>".$assoc_get_bancosC['ban_desc']."</option>";
                                }
                          ?>
                    </select>
                  </div>
                </fieldset>  
            </div>
           <div class='col-md-2' style='text-align: left;'>  
                <fieldset>
                  <legend><i class="material-icons">filter_list</i> Filtar por Librador</legend>
                  <div class="form-group">
                    <select class="form-control" id="che_libradorB">
                       <option disabled>Seleccionar Librador</option>
                        <option value='0'>Todos los libredores</option>
                          <?php
                          $get_chequesEC=$chequesE->get_chequesELibrador();
                          $num_get_chequesEC=mysql_num_rows($get_chequesEC);
                          for ($countChequesC=0; $countChequesC < $num_get_chequesEC; $countChequesC++) 
                          { 
                            $assoc_get_chequesEC=mysql_fetch_assoc($get_chequesEC);
                            echo "<option>".$assoc_get_chequesEC['che_librador']."</option>";
                          }
                        ?>
                    </select>
                  </div>
                </fieldset>  
            </div>

            <div class='col-md-2' style='text-align: left;'>  
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

             <div class='col-md-2' style='text-align: right;'>  
                <button class='btn btn-success' id='nuevoCheque'  data-toggle='modal' title='Agregar Articulo' data-placement='top' data-target='#NuevoCheque'><i class='material-icons'>add</i> NUEVO CHEQUE</button>
              </div> 

          </div> 

   <div class='col-md-12' style="text-align: center;" id="suggestionsTable">
   </div> 
            
 </div> 
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
  var che_tipoB = $('#che_tipoB').val();
  var ID_banB = $('#ID_banB').val();
  var che_libradorB = $('#che_libradorB').val();
  var ID_che = '0';
  var che_estadoB= $('#che_estadoB').val();
  var dataString = 'fecha='+fecha + '&che_tipoB='+che_tipoB + '&ID_banB='+ID_banB + '&che_libradorB='+che_libradorB + '&ID_che='+ID_che + '&che_estadoB='+che_estadoB;

  $.ajax(
                                              {
                                                  type: 'POST',
                                                  url: 'visorCheques.php',
                                                  data: dataString,
                                                  success: function(data)
                                                   {
                                                      $('#suggestionsTable').fadeIn(1000).html(data);
                                                      
                                                   }

                                               });
});



$("#che_tipoB").change(function (){
  var fecha = $('#reportrange').text();
  var che_tipoB = $('#che_tipoB').val();
  var ID_banB = $('#ID_banB').val();
  var che_libradorB = $('#che_libradorB').val();
  var ID_che = '0';
  var che_estadoB= $('#che_estadoB').val();
  var dataString = 'fecha='+fecha + '&che_tipoB='+che_tipoB + '&ID_banB='+ID_banB + '&che_libradorB='+che_libradorB + '&ID_che='+ID_che + '&che_estadoB='+che_estadoB;
  
  $.ajax(
                                              {
                                                  type: 'POST',
                                                  url: 'visorCheques.php',
                                                  data: dataString,
                                                  success: function(data)
                                                   {
                                                      $('#suggestionsTable').fadeIn(1000).html(data);
                                                      
                                                   }

                                               });
});

$("#ID_banB").change(function (){
  var fecha = $('#reportrange').text();
  var che_tipoB = $('#che_tipoB').val();
  var ID_banB = $('#ID_banB').val();
  var che_libradorB = $('#che_libradorB').val();
  var ID_che = '0';
  var che_estadoB= $('#che_estadoB').val();
  var dataString = 'fecha='+fecha + '&che_tipoB='+che_tipoB + '&ID_banB='+ID_banB + '&che_libradorB='+che_libradorB + '&ID_che='+ID_che + '&che_estadoB='+che_estadoB;
  
  $.ajax(
                                              {
                                                  type: 'POST',
                                                  url: 'visorCheques.php',
                                                  data: dataString,
                                                  success: function(data)
                                                   {
                                                      $('#suggestionsTable').fadeIn(1000).html(data);
                                                      
                                                   }

                                               });
});

$("#che_libradorB").change(function (){
  var fecha = $('#reportrange').text();
  var che_tipoB = $('#che_tipoB').val();
  var ID_banB = $('#ID_banB').val();
  var che_libradorB = $('#che_libradorB').val();
  var ID_che = '0';
  var che_estadoB= $('#che_estadoB').val();
  var dataString = 'fecha='+fecha + '&che_tipoB='+che_tipoB + '&ID_banB='+ID_banB + '&che_libradorB='+che_libradorB + '&ID_che='+ID_che + '&che_estadoB='+che_estadoB;
  
  $.ajax(
                                              {
                                                  type: 'POST',
                                                  url: 'visorCheques.php',
                                                  data: dataString,
                                                  success: function(data)
                                                   {
                                                      $('#suggestionsTable').fadeIn(1000).html(data);
                                                      
                                                   }

                                               });
});


$("#che_estadoB").change(function (){
  var fecha = $('#reportrange').text();
  var che_tipoB = $('#che_tipoB').val();
  var ID_banB = $('#ID_banB').val();
  var che_libradorB = $('#che_libradorB').val();
  var ID_che = '0';
  var che_estadoB= $('#che_estadoB').val();
  var dataString = 'fecha='+fecha + '&che_tipoB='+che_tipoB + '&ID_banB='+ID_banB + '&che_libradorB='+che_libradorB + '&ID_che='+ID_che + '&che_estadoB='+che_estadoB;
  
  $.ajax(
                                              {
                                                  type: 'POST',
                                                  url: 'visorCheques.php',
                                                  data: dataString,
                                                  success: function(data)
                                                   {
                                                      $('#suggestionsTable').fadeIn(1000).html(data);
                                                      
                                                   }

                                               });
});





</script>


    


<!--Inicio: Footer -->
<?php




if (@$_GET['ID_che']) 
{
  echo "<a href='cheques.php'><button class='btn btn-info'><i class='material-icons'>refresh</i></button></a>";
    $ID_che=$_GET['ID_che'];
    echo "<script>$(document).ready(function (){
      var ID_che = '".$ID_che."';
      var fecha = '0';
      var che_tipoB = '0';
      var ID_banB = '0';
      var che_libradorB = '0';
      var che_libradorB = '0';
      var che_estadoB = '0';
      var dataString = 'fecha='+fecha + '&che_tipoB='+che_tipoB + '&ID_banB='+ID_banB + '&che_libradorB='+che_libradorB + '&ID_che='+ID_che + '&che_estadoB='+che_estadoB;
   
      $.ajax(
                                                  {
                                                      type: 'POST',
                                                      url: 'visorCheques.php',
                                                      data: dataString,
                                                      success: function(data)
                                                       {
                                                          $('#suggestionsTable').fadeIn(1000).html(data);
                                                       }

                                                   });
    });</script>";

}
else
{
  echo "<script>$(document).ready(function (){
  var fecha = $('#reportrange').text();
  var che_tipoB = $('#che_tipoB').val();
  var ID_banB = $('#ID_banB').val();
  var che_libradorB = $('#che_libradorB').val();
  var che_libradorB = $('#che_libradorB').val();
  var ID_che = '0';
  var che_estadoB= $('#che_estadoB').val();
  var dataString = 'fecha='+fecha + '&che_tipoB='+che_tipoB + '&ID_banB='+ID_banB + '&che_libradorB='+che_libradorB + '&ID_che='+ID_che + '&che_estadoB='+che_estadoB;
  $.ajax(
                                              {
                                                  type: 'POST',
                                                  url: 'visorCheques.php',
                                                  data: dataString,
                                                  success: function(data)
                                                   {
                                                      $('#suggestionsTable').fadeIn(1000).html(data);
                                                      
                                                   }

                                               });
});</script>";
}


	include("modulos/footer.php"); 
?>

