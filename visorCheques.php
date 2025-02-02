	<!--Inicio: Documentos requeridos -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<?php
  include_once('inc/conectar.php');
  include_once('inc/classes.php');
  include_once('inc/classesExclusivas.php');
  $_SESSION['actionsBack']= $_SERVER['REQUEST_URI'];
  $bancos     = new bancos;
  $chequesE   = new chequesE;
  $cuentas    = new cuentas;
 
  $fecha = $_POST['fecha'];

  if($fecha=="0")
  {
    $fecDesde=0;
    $fecHasta=0;
  }
  else
  {
    $reciveFecha=$_POST['fecha'];
    $fechaSinEspacios=str_replace(" ","",$reciveFecha);
    $fechaSinEspacios2=substr($fechaSinEspacios, 4);
    $fechaDividida=explode("-",$fechaSinEspacios2);

    $fechaInicio=$fechaDividida[0];
    $fechaInicioCambioDeSignos=str_replace( "/" , "-" ,$fechaInicio);
    $fechaInicioFormateda=date("Y-m-d",strtotime($fechaInicioCambioDeSignos));
    $fecDesde=$fechaInicioFormateda;

    $fechafin=$fechaDividida[1];
    $fechafinCambioDeSignos=str_replace( "/" , "-" ,$fechafin);
    $fechaFinFormateda=date("Y-m-d",strtotime($fechafinCambioDeSignos));
    $fecHasta=$fechaFinFormateda;
  }  


  if ($_POST['ID_banB']=='0') 
  { 
    $ID_ban = "";
  }
  else
  {
    $ID_ban = "AND cheques.ID_ban=".$_POST['ID_banB'];
  }  
  if ($_POST['che_libradorB']=='0') 
  {
     $che_librador = "";
  }
  else
  {
    $che_librador = "AND che_librador='". $_POST['che_libradorB']."'";
  }  
  if ($_POST['che_tipoB']=='0') 
  {
   
    $che_tipo = "";
  }
  else
  {
     $che_tipo = "AND che_tipo='". $_POST['che_tipoB']."'";
  }  

  if ($_POST['che_estadoB']=='0') 
  {
   
    $che_estado = "";
  }
  else
  {
     $che_estado = "AND che_estado='". $_POST['che_estadoB']."'";
  }  
  if ($_POST['ID_che']=='0') 
  {
    $ID_che = "";
  }
  else
  {
     $ID_che = "AND cheques.ID_che='". $_POST['ID_che']."'";
  }  

?>
            <table id="listadoCheques" class="table table-striped table-bordered" cellspacing="0" style="cursor: pointer;">
                <thead>
                    <tr>
                        <th>ESTADO</th>
                        <th>FECHA</th>
                        <th>PROCEDENCIA</th>
                        <th>Nº</th>
                        <th>TIPO</th>
                        <th>BANCO</th>
                        <th>LIBRADOR</th>
                        <th>BENEFICIARIO</th>
                        <th>CUENTA DETERMINADA</th>
                        <th>MONTO</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ESTADO</th>
                        <th>FECHA</th>
                        <th>PROCEDENCIA</th>
                        <th>Nº</th>
                        <th>TIPO</th>
                        <th>BANCO</th>
                        <th>LIBRADOR</th>
                        <th>BENEFICIARIO</th>
                        <th>CUENTA DETERMINADA</th>
                        <th>MONTO</th>
                    </tr>
                </tfoot>
                <tbody>
                  <?php 


                  if ($ID_che!='') 
                          {
                            $sql_cheques='SELECT * FROM cheques, bancos, cuentas WHERE cheques.ID_cue=cuentas.ID_cue AND cheques.ID_ban=bancos.ID_ban '.$ID_che.'';
                          }
                          else
                          {
                             $sql_cheques='SELECT * FROM cheques, bancos, cuentas WHERE cheques.ID_cue=cuentas.ID_cue AND cheques.ID_ban=bancos.ID_ban AND che_fecha BETWEEN "'.$fecDesde.'" AND "'.$fecHasta.'" '.$ID_ban.' '.$che_librador.' '.$che_tipo.' '.$che_estado.' ORDER BY che_fecha DESC';
                          } 
                     $get_chequesE =mysql_query($sql_cheques);
                    //$get_chequesE=$chequesE->get_chequesFiltrosE($fecDesde, $fecHasta, $ID_ban, $che_librador, $che_tipo, $ID_che);
                    $num_get_chequesE=mysql_num_rows($get_chequesE);
                    for ($countCheques=0; $countCheques < $num_get_chequesE; $countCheques++) 
                    { 
                      $assoc_get_chequesE=mysql_fetch_assoc($get_chequesE);

                      if ($assoc_get_chequesE['che_tipo']) 
                      {
                          
                      }

                      if ($assoc_get_chequesE['che_estado']=="EN CARTERA") 
                      {
                       $class="success";
                      }
                      if ($assoc_get_chequesE['che_estado']=="COBRADO") 
                      {
                       $class="info";
                      }         
                      if ($assoc_get_chequesE['che_estado']=="UTILIZADO") 
                      {
                       $class="info";
                      }  
                      if ($assoc_get_chequesE['che_estado']=="DEBITADO") 
                      {
                       $class="info";
                      } 
                       if ($assoc_get_chequesE['che_estado']=="EMITIDO") 
                      {
                       $class="warning";
                      } 
                      /* Inicio Modal modificar cheque */                          
                        echo '<div class="modal fade" id="VerCheque'.$assoc_get_chequesE['ID_che'].'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                                <div class="modal-dialog modal-lg" role="document" >
                                  <div class="modal-content">
                                     <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><div class="alert alert-dismissible alert-'.$class.'" style="text-align: center;">
                                          <h3><i class="material-icons">list</i> CHEQUE 
                                          '.$assoc_get_chequesE['che_procedencia'].'
                                          <select name="che_procedencia" id="che_procedencia'.$assoc_get_chequesE['ID_che'].'" style="display:none">
                                            <option value="'.$assoc_get_chequesE['che_procedencia'].'" selected>'.$assoc_get_chequesE['che_procedencia'].'</option>';
                                            if($assoc_get_chequesE['che_procedencia']=="TERCERO")
                                            {
                                              echo "<option value='PROPIO'>PROPIO</option>";
                                            }
                                            else
                                            {
                                              echo "<option value='TERCERO'>TERCERO</option>";
                                            }

                                         echo '</select>
                                           '.$assoc_get_chequesE['che_estado'].'';
                                         

                                           echo '<select name="che_estadoC" id="che_estadoC'.$assoc_get_chequesE['ID_che'].'" style="display:none">
                                             <option value="'.$assoc_get_chequesE['che_estado'].'" selected>'.$assoc_get_chequesE['che_estado'].'</option>';
                                           
                                                echo "<option value='EN CARTERA'>EN CARTERA</option>";
                                                echo "<option value='COBRADO'>COBRADO</option>";
                                                echo "<option value='UTILIZADO'>UTILIZADO</option>";  
                                           
                                                echo '</select>';
                                       
                                            echo '<select  name="che_estadoD" id="che_estadoD'.$assoc_get_chequesE['ID_che'].'"  style="display:none">
                                             <option value="'.$assoc_get_chequesE['che_estado'].'" selected>'.$assoc_get_chequesE['che_estado'].'</option>';
                                           
                                                echo "<option value='EMITIDO'>EMITIDO</option>";
                                                echo "<option value='DEBITADO'>DEBITADO</option>";

                                            echo '</select>';

                                       

                                           echo 'Nº '.$assoc_get_chequesE['che_num'].'
                                           </h3>
                                        </div> </h4>

                                      </div>
                                      <div class="modal-body" style="text-align:center;">
                                      <div class="col-md-12" id="editarCartel'.$assoc_get_chequesE['ID_che'].'" style="display:none;">


                                    </div>
                                      <input hidden type="text" name="action" value="modificarCheque">
                                      <input hidden type="text" name="ID_che'.$assoc_get_chequesE['ID_che'].'" id="Input_ID_che'.$assoc_get_chequesE['ID_che'].'" value="'.$assoc_get_chequesE['ID_che'].'">
  
                                          <div class="col-md-12" style="border: 2px solid #333; text-align:center;">
                                           <div class="col-md-12" style="margin-top:10px;">
                                              <div class="col-md-4">
                                                <img src="'.$assoc_get_chequesE['ban_logo'].'" style="width:160px;" id="ID_ban'.$assoc_get_chequesE['ID_che'].'">
                                                  <div class="form-group" id="Edit_ID_ban'.$assoc_get_chequesE['ID_che'].'" style="display: none">
                                                   <label class="control-label"><i class="material-icons">account_balance</i> BANCO</label>
                                                    <select class="form-control" id="Input_ID_ban'.$assoc_get_chequesE['ID_che'].'" name="ID_ban">
                                                    <option selected value="'.$assoc_get_chequesE['ID_ban'].'">'.$assoc_get_chequesE['ban_desc'].'</option>';
                                                      $get_bancos=$bancos->get_bancos();
                                                      $num_get_bancos=mysql_num_rows($get_bancos);
                                                      for ($countBancos=0; $countBancos < $num_get_bancos; $countBancos++) 
                                                      { 
                                                        $assoc_get_bancos=mysql_fetch_assoc($get_bancos);
                                                        echo "<option value='".$assoc_get_bancos['ID_ban']."'>".$assoc_get_bancos['ban_desc']."</option>";
                                                      }
                                              echo '</select>
                                              </div>
                                              </div>
                                              <div class="col-md-4">
                                                <H3 id="che_fecha'.$assoc_get_chequesE['ID_che'].'">'.$assoc_get_chequesE['che_fecha'].'</H3>
                                                 <div class="form-group" id="Edit_che_fecha'.$assoc_get_chequesE['ID_che'].'" style="display:none">
                                                  <label for="librador"><i class="material-icons">date_range</i> FECHA</label>
                                                  <input type="date" class="form-control" id="Input_che_fecha'.$assoc_get_chequesE['ID_che'].'" name="che_fecha" value="'.$assoc_get_chequesE['che_fecha'].'">
                                                </div>
                                              </div>
                                              <div class="col-md-4">
                                                   <H3 id="che_num'.$assoc_get_chequesE['ID_che'].'">Nº '.$assoc_get_chequesE['che_num'].'</H3>
                                                   <div class="form-group" id="Edit_che_num'.$assoc_get_chequesE['ID_che'].'" style="display:none">
                                                        <label for="che_num" class="control-label" id="labelA" style="display:block; text-align: left;">NUMERO <i class="material-icons">done</i></label>
                                                        <label for="che_num" class="control-label" id="labelB" style="display:none; text-align: left;">NUMERO <i class="material-icons">clear</i> Duplicado</label>
                                                        <input type="text" class="form-control" id="Input_che_num'.$assoc_get_chequesE['ID_che'].'" name="che_num" placeholder="" value="'.$assoc_get_chequesE['che_num'].'" required>';

                                                        //VALIDA QUE EL CODIGO NO SE DUPLIQUE
                                                        echo '<script>$("#Input_che_num'.$assoc_get_chequesE['ID_che'].'").keyup(function()
                                                          {
                                                            var che_num = $("#Input_che_num'.$assoc_get_chequesE['ID_che'].'").val();      
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
                                                                       $("#Edit_che_num'.$assoc_get_chequesE['ID_che'].'").removeClass("form-group has-error");
                                                                       $("#Edit_che_num'.$assoc_get_chequesE['ID_che'].'").addClass("form-group has-success");
                                                                       $("#labelB").css("display", "none");
                                                                       $("#labelA").css("display", "block");
                                                                       $("#salvar'.$assoc_get_chequesE['ID_che'].'").css("display", "block");
                                                                    }
                                                                    else
                                                                    {
                                                                       $("#Edit_che_num'.$assoc_get_chequesE['ID_che'].'").removeClass("form-group has-success");
                                                                       $("#Edit_che_num'.$assoc_get_chequesE['ID_che'].'").addClass("form-group has-error");
                                                                       $("#labelA").css("display", "none");
                                                                       $("#labelB").css("display", "block");
                                                                       $("#salvar'.$assoc_get_chequesE['ID_che'].'").css("display", "none");
                                                                    } 
                                                                   
                                                                  }
                                                                 
                                                             });
                                                         });</script>
                                                    </div>
                                              </div>
                                            </div>  
                                            <div class="col-md-12" style="text-align:left; margin-top:10px; border-bottom: 1px solid #000;">
                                              <H4 id="che_beneficiario'.$assoc_get_chequesE['ID_che'].'"><strong>PAGUESE A:</strong> &nbsp&nbsp&nbsp&nbsp';

                                              if($assoc_get_chequesE['che_tipo']=="AL BENEFICIARIO" OR $assoc_get_chequesE['che_tipo']=="DE CAJA" OR $assoc_get_chequesE['che_tipo']=="DE VENTANILLA")
                                              {
                                                echo $assoc_get_chequesE['che_beneficiario'];
                                              }
                                              if ($assoc_get_chequesE['che_tipo']=="DE VIAJERO" OR $assoc_get_chequesE['che_tipo']=="A LA ORDEN") 
                                              {
                                                echo "A LA ORDEN";
                                              }

                                          echo '</H4>

                                          <div class="form-group" style="display:none;" id="Edit_che_beneficiario'.$assoc_get_chequesE['ID_che'].'">
                                            <label for="librador"><i class="material-icons">face</i> BENEFICIARIO</label>
                                            <input type="text" class="form-control" id="Input_che_beneficiario'.$assoc_get_chequesE['ID_che'].'" name="che_beneficiario">
                                          </div>

                                            </div>
                                            <div class="col-md-12" style="text-align:left; margin-top:5px; border-bottom: 1px solid #000;">
                                              <H4 id="che_importe'.$assoc_get_chequesE['ID_che'].'"><strong>LA SUMA DE:</strong> &nbsp&nbsp&nbsp&nbsp$ '.$assoc_get_chequesE['che_importe'].'</H4>
                                                 <div class="form-group" id="Edit_che_importe'.$assoc_get_chequesE['ID_che'].'" style="display:none;">
                                                      <label class="control-label"><i class="material-icons">monetization_on</i> IMPORTE</label>
                                                      <div class="input-group">
                                                        <span class="input-group-addon">$</span>
                                                      <input type="text" name="che_importe" id="Input_che_importe'.$assoc_get_chequesE['ID_che'].'" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="00.00" value="'.$assoc_get_chequesE['che_importe'].'" required>
                                                  </div>
                                                </div>
                                            </div>
                                             <div class="col-md-12" style="text-align:right; margin-top:20px; border-bottom: 1px solid #000;">
                                             <div class="col-md-4" style="border: 2px solid #000;">';
                                              echo '<h5 id="che_tipo'.$assoc_get_chequesE['ID_che'].'" >'.$assoc_get_chequesE['che_tipo'].'</h5>';

                                          echo '<div class="form-group" id="Edit_che_tipo'.$assoc_get_chequesE['ID_che'].'" style="display:none">
                                                 <label class="control-label"><i class="material-icons">bookmark_border</i> TIPO</label>
                                                  <select class="form-control" id="Select_che_tipo'.$assoc_get_chequesE['ID_che'].'" name="che_tipo">
                                                    <option selected value="'.$assoc_get_chequesE['che_tipo'].'">'.$assoc_get_chequesE['che_tipo'].'</option>
                                                    <option value="CRUZADOS">CRUZADOS</option>
                                                    <option value="CERTIFICADO">CERTIFICADO</option>
                                                    <option value="AL BENEFICIARIO">AL BENEFICIARIO</option>
                                                    <option value="DE CAJA">DE CAJA</option>
                                                    <option value="DE VENTANILLA">DE VENTANILLA</option>
                                                    <option value="DE VIAJERO">DE VIAJERO</option>
                                                    <option value="A LA ORDEN">A LA ORDEN</option>
                                                  </select>
                                                </div>'; 
                                            echo '</div>
                                              <div class="col-md-8">
                                                <H3 id="che_librador'.$assoc_get_chequesE['ID_che'].'">'.$assoc_get_chequesE['che_librador'].'</H3>
                                                <div class="form-group" id="Edit_che_librador'.$assoc_get_chequesE['ID_che'].'" style="display:none;">
                                                  <label for="librador"><i class="material-icons">account_circle</i> LIBRADOR</label>
                                                  <input type="text" class="form-control" id="Input_che_librador'.$assoc_get_chequesE['ID_che'].'" name="che_librador" placeholder="Librador" value="'.$assoc_get_chequesE['che_librador'].'" required>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                       </div>
                                      <br><br><br><br><br><br><br><br>
                                      <br><br><br><br><br><br><br><br><br><br>
  
                                      <div class="alert alert-dismissible alert-info" style="text-align: center;">
                                         <i class="material-icons">account_balance_wallet</i> CUENTA PREDETERMINADA: '.$assoc_get_chequesE['cue_desc'].'
                                         <select hidden id="ID_cue'.$assoc_get_chequesE['ID_che'].'">
                                         <option value="'.$assoc_get_chequesE['ID_cue'].'">'.$assoc_get_chequesE['cue_desc'].'</option>';
                                        $get_cuentas=$cuentas->get_cuentas();
                                        $num_get_cuentas=mysql_num_rows($get_cuentas);
                                        for ($countCuentas=0; $countCuentas < $num_get_cuentas; $countCuentas++) 
                                        { 
                                          $assoc_get_cuentas=mysql_fetch_assoc($get_cuentas);
                                          echo "<option value='".$assoc_get_cuentas['ID_cue']."'>".$assoc_get_cuentas['cue_desc']."</option>";
                                        }
                                  echo '</select>
                                        </div> 
                                      
                                      <div class="modal-footer">
                                           <div class="col-md-12" style="text-align:center; margin-top:10px;">
                                           <div class="col-md-6">
                                              <button class="btn btn-primary" id="editar'.$assoc_get_chequesE['ID_che'].'"><i class="material-icons">edit</i></button> 
                                              <button class="btn btn-primary" id="ver'.$assoc_get_chequesE['ID_che'].'" style="display:none"><i class="material-icons">visibility</i></button>    
                                              <button class="btn btn-success" id="salvar'.$assoc_get_chequesE['ID_che'].'" style="display:none"><i class="material-icons">save</i>GUARDAR CAMBIOS</button>   
                                            
                                           </div> 
                                           <div class="col-md-6">
                                              <button id="borrado'.$assoc_get_chequesE['ID_che'].'" class="btn btn-danger"><i class="material-icons">delete_forever</i></button>   

                                              <div class="alert alert-dismissible alert-warning" id="alertaBorrado'.$assoc_get_chequesE['ID_che'].'" style="display:none">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <h4 class="alert-heading">CUIDADO!</h4>
                                              <p class="mb-0">¿Estas seguro que deseas eliminar este registro?</p>
                                              <button class="btn btn-success" id="borradoCasiSi'.$assoc_get_chequesE['ID_che'].'"><i class="material-icons">done_all</i> Si</button>
                                              <button class="btn btn-danger" id="borradoCasiNo'.$assoc_get_chequesE['ID_che'].'"><i class="material-icons">cancel</i> No</button>
                                            </div>   

                                             <div class="alert alert-dismissible alert-warning" id="alertaConsulta'.$assoc_get_chequesE['ID_che'].'" style="display:none">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <h4 class="alert-heading">CUIDADO!</h4>
                                              <p class="mb-0">¿Deseas contrarestar el movimiento que este cheque genero en las cuentas? Tenga en consideracion que la siguiente accion no contrarestara los movimientos que puedieran haberse generado en la cuentas por la configuración de descuentos o acreditaciones automáticas</p>
                                              <button class="btn btn-success" id="borradoSiDefinitivo'.$assoc_get_chequesE['ID_che'].'"><i class="material-icons">done_all</i> Si</button>
                                              <button class="btn btn-danger" id="borradoNoDefinitivo'.$assoc_get_chequesE['ID_che'].'"><i class="material-icons">cancel</i> No</button>
                                            </div>   

                                             <div class="alert alert-dismissible alert-warning" id="borradoCartel'.$assoc_get_chequesE['ID_che'].'" style="display:none">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <h4 class="alert-heading">Registro eliminado correctamente</h4>
                                            </div>  

                                           </div> 
                                        </div>
                                    </div>
                                  </div>
                                </div>';
                            /* Fin Modal nuevo cheque */

                       echo"<tr class='".$class."' data-toggle='modal' data-placement='top' data-target='#VerCheque".$assoc_get_chequesE['ID_che']."'>";
                          echo"<th>".$assoc_get_chequesE['che_estado']."</th>";
                          echo"<th>".$assoc_get_chequesE['che_fecha']."</th>";
                          echo"<th>".$assoc_get_chequesE['che_procedencia']."</th>";
                          echo"<th>".$assoc_get_chequesE['che_num']."</th>";
                          echo"<th>".$assoc_get_chequesE['che_tipo']."</th>";
                          echo"<th><img src='".$assoc_get_chequesE['ban_logo']."' style='width:80px;'></th>";
                          echo"<th>".$assoc_get_chequesE['che_librador']."</th>";
                          echo"<th>".$assoc_get_chequesE['che_beneficiario']."</th>";
                          echo"<th>".$assoc_get_chequesE['cue_desc']."</th>";
                          echo"<th>$ ".$assoc_get_chequesE['che_importe']."</th>";
                         
                      echo "</tr>";

                      echo '<script>

                          $("#borrado'.$assoc_get_chequesE['ID_che'].'").click(function(){
                            $("#borrado'.$assoc_get_chequesE['ID_che'].'").fadeOut(100);
                            $("#alertaBorrado'.$assoc_get_chequesE['ID_che'].'").fadeIn(100);
                          });

                         
                           $("#borradoCasiNo'.$assoc_get_chequesE['ID_che'].'").click(function(){
                            $("#borrado'.$assoc_get_chequesE['ID_che'].'").fadeIn(100);
                            $("#alertaBorrado'.$assoc_get_chequesE['ID_che'].'").fadeOut(100);
                            $("#alertaConsulta'.$assoc_get_chequesE['ID_che'].'").fadeOut(100);
                          });
                          
                          $("#borradoCasiSi'.$assoc_get_chequesE['ID_che'].'").click(function(){
                              $("#alertaBorrado'.$assoc_get_chequesE['ID_che'].'").fadeOut(100);
                              $("#alertaConsulta'.$assoc_get_chequesE['ID_che'].'").fadeIn(100);
                             });


                            $ ("#borradoSiDefinitivo'.$assoc_get_chequesE['ID_che'].'").click(function(){
                                  
                                    var ID_che             = '.$assoc_get_chequesE['ID_che'].';
                                    var action             = "EliminaCheque";
                                    var mueveCuenta        = "si";
                                
                                var dataString = "&ID_che="+ID_che 
                                + "&action="+action
                                + "&mueveCuenta="+mueveCuenta;

                                        $.ajax({
                                                  type: "POST",
                                                  url: "accionesCheques.php",
                                                  data: dataString,
                                                  success: function(data)
                                                   {
                                                      $("#borradoCartel'.$assoc_get_chequesE['ID_che'].'").fadeIn(1000).html(data);

                                                   }

                                                }) 


                              });

                                        $ ("#borradoNoDefinitivo'.$assoc_get_chequesE['ID_che'].'").click(function(){
                                  
                                    var ID_che             = '.$assoc_get_chequesE['ID_che'].';
                                    var action             = "EliminaCheque";
                                    var mueveCuenta        = "no";
                                
                                var dataString = "&ID_che="+ID_che 
                                + "&action="+action
                                + "&mueveCuenta="+mueveCuenta;

                                        $.ajax({
                                                  type: "POST",
                                                  url: "accionesCheques.php",
                                                  data: dataString,
                                                  success: function(data)
                                                   {
                                                      $("#borradoCartel'.$assoc_get_chequesE['ID_che'].'").fadeIn(1000).html(data);

                                                   }

                                                }) 


                              });




                        $("#editar'.$assoc_get_chequesE['ID_che'].'").click(function(){
                        $("#Edit_ID_ban'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                        $("#ID_ban'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                        $("#che_fecha'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                        $("#Edit_che_fecha'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                        $("#che_num'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                        $("#Edit_che_num'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                        $("#che_importe'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                        $("#Edit_che_importe'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                        $("#che_tipo'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                        $("#Edit_che_tipo'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                        $("#che_librador'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                        $("#Edit_che_librador'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                        $("#che_procedencia'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                          
                          var procedencia = $("#che_procedencia'.$assoc_get_chequesE['ID_che'].'").val();
                          if(procedencia=="TERCERO")
                          {
                             $("#che_estadoC'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                              $("#che_estadoD'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                          } 
                          else
                          {
                            $("#che_estadoC'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                              $("#che_estadoD'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                          }  

                       
                        $("#ID_cue'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                        $("#editar'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                        $("#ver'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                        $("#salvar'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);

                 

                      });

                         $("#che_procedencia'.$assoc_get_chequesE['ID_che'].'").change(function(){
                          var procedencia = $("#che_procedencia'.$assoc_get_chequesE['ID_che'].'").val();
                          if(procedencia=="TERCERO")
                          {
                             $("#che_estadoC'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                              $("#che_estadoD'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                          } 
                          else
                          {
                            $("#che_estadoC'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                              $("#che_estadoD'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                          }  
  
                        });

                      $("#ver'.$assoc_get_chequesE['ID_che'].'").click(function(){
                        $("#Edit_ID_ban'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                        $("#ID_ban'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                        $("#che_fecha'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                        $("#Edit_che_fecha'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                        $("#che_num'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                        $("#Edit_che_num'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                        $("#che_importe'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                        $("#Edit_che_importe'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                        $("#che_tipo'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                        $("#Edit_che_tipo'.$assoc_get_chequesE['ID_che'].'").fadeOut(500); 
                        $("#che_librador'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                        $("#Edit_che_librador'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);  

                        $("#che_procedencia'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                        
                        $("#che_estadoC'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                        $("#che_estadoD'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                        $("#ID_cue'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);

                        $("#editar'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                        $("#ver'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                        $("#salvar'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                      });

                        $(document).ready(function(){$("#Select_che_tipo'.$assoc_get_chequesE['ID_che'].'").change(function(){
                          var che_tipo = $("#Select_che_tipo'.$assoc_get_chequesE['ID_che'].'").val();
                            if (che_tipo=="AL BENEFICIARIO" || che_tipo=="DE CAJA" || che_tipo=="DE VENTANILLA") 
                            {
                              $("#Edit_che_beneficiario'.$assoc_get_chequesE['ID_che'].'").fadeIn(500);
                              $("#che_beneficiario'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                            }
                            if (che_tipo=="CRUZADOS" || che_tipo=="CERTIFICADO" || che_tipo=="DE VIAJERO" || che_tipo=="A LA ORDEN")
                             {
                              $("#Edit_che_beneficiario'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                              $("#che_beneficiario'.$assoc_get_chequesE['ID_che'].'").fadeOut(500);
                             }   
                        });
                      });


                                $ ("#salvar'.$assoc_get_chequesE['ID_che'].'").click(function (){
                                
                                    var ID_che             =$("#Input_ID_che'.$assoc_get_chequesE['ID_che'].'").val();
                                    var action             ="modificarCheque";
                                    var ID_ban             =$("#Input_ID_ban'.$assoc_get_chequesE['ID_che'].'").val();
                                    var che_fecha          =$("#Input_che_fecha'.$assoc_get_chequesE['ID_che'].'").val();
                                    var che_num            =$("#Input_che_num'.$assoc_get_chequesE['ID_che'].'").val();
                                    var che_beneficiario   =$("#Input_che_beneficiario'.$assoc_get_chequesE['ID_che'].'").val();
                                    var che_importe        =$("#Input_che_importe'.$assoc_get_chequesE['ID_che'].'").val();
                                    var che_tipo           =$("#Select_che_tipo'.$assoc_get_chequesE['ID_che'].'").val();
                                    var che_librador       =$("#Input_che_librador'.$assoc_get_chequesE['ID_che'].'").val();
                                    var che_procedencia    =$("#che_procedencia'.$assoc_get_chequesE['ID_che'].'").val();
                                    var che_estadoC        =$("#che_estadoC'.$assoc_get_chequesE['ID_che'].'").val();
                                    var che_estadoD        =$("#che_estadoD'.$assoc_get_chequesE['ID_che'].'").val();
                                    var ID_cue             =$("#ID_cue'.$assoc_get_chequesE['ID_che'].'").val();

                                    if(che_procedencia=="TERCERO")
                                    {
                                      var che_estado=che_estadoC;
                                    }
                                    else
                                    {
                                      var che_estado=che_estadoD;
                                    }  


    
                                var dataString = "&ID_che="+ID_che 
                                + "&action="+action 
                                + "&ID_ban="+ID_ban 
                                + "&che_fecha="+che_fecha 
                                + "&che_num="+che_num 
                                + "&che_beneficiario="+che_beneficiario 
                                + "&che_importe="+che_importe 
                                + "&che_tipo="+che_tipo 
                                + "&che_librador="+che_librador
                                + "&che_procedencia="+che_procedencia
                                + "&che_estado="+che_estado
                                + "&ID_cue="+ID_cue;

                                $.ajax(
                                              {
                                                  type: "POST",
                                                  url: "accionesCheques.php",
                                                  data: dataString,
                                                  success: function(data)
                                                   {
                                                      $("#editarCartel'.$assoc_get_chequesE['ID_che'].'").fadeIn(1000).html(data);

                                                      
                                                   }

                                               }) });
</script>';
                    }
                  ?>  
                </tbody>
           </table>
           
            <script type='text/javascript'>

             


    $(document).ready( function () {
    $('#listadoCheques').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'print',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                download: 'open'
            }
        ],
        responsive: true,
    });
    });



                         


     </script>
  