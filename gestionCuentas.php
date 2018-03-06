<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack']= $_SERVER['REQUEST_URI'];
  $cuentas      = new cuentas;
  $cuentasE     = new cuentasE;
  $cuentas_tipo = new cuentas_tipo;
  $cuentas_tipoE= new cuentas_tipoE;
  $cuentas_impuestosE  = new cuentas_impuestosE;
?>
<!--Fin: Documentos requeridos --> 
<style type="text/css">
	th
	{
	 text-align:center;
	}
</style>
    

                            <!--Inicio Modal nueva cuenta-->                          
                            <div class="modal fade" id="nuevaCuenta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class='material-icons'>add_box</i> NUEVA CUENTA</h4>
                                          </div>
                                          <div class="modal-body">
                                             <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                                <fieldset>
                                                    <legend>Datos de la cuenta</legend>
                                                        <input hidden type="text" name="action" value="nuevaCuenta">
                                                
                                            <div class="form-group has-success" id="contenedorCodigo">
                                                  <label for="che_num" class="control-label" id="labelA" style="display:block; text-align: left;">Título<i class="material-icons">done</i> Disponible</label>
                                                  <label for="che_num" class="control-label" id="labelB" style="display:none; text-align: left;">Título<i class="material-icons">clear</i> Duplicado</label>
                                                  <input type="text" class="form-control" name="cue_desc" id="cue_desc" placeholder="Título">
                                             </div>

                                                   <script>$("#cue_desc").keyup(function()
                                                      {
                                                        var cue_desc = $(this).val();      
                                                        var action = "validaNombreDeCuentaDuplicado";
                                                        var dataString = "cue_desc="+cue_desc + "&action="+action;

                                                        $.ajax(
                                                        {
                                                            type: "POST",
                                                            url: "accionesCuentasMovimientos.php",
                                                            data: dataString,
                                                            success: function(datas)
                                                             {
                                                                if(datas==0)
                                                                {
                                                                   $("#contenedorCodigo").removeClass("form-group has-error");
                                                                   $("#contenedorCodigo").addClass("form-group has-success");
                                                                   $("#labelB").css("display", "none");
                                                                   $("#labelA").css("display", "block");
                                                                   $("#botonGuardarNuevaCuenta").css("display", "block");
                                                                }
                                                                else
                                                                {
                                                                   $("#contenedorCodigo").removeClass("form-group has-success");
                                                                   $("#contenedorCodigo").addClass("form-group has-error");
                                                                   $("#labelA").css("display", "none");
                                                                   $("#labelB").css("display", "block");
                                                                   $("#botonGuardarNuevaCuenta").css("display", "none");
                                                                } 
                                                               
                                                              }
                                                             
                                                         });
                                                     });</script>



                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Tipo</label>
                                                            <select name="ID_ctp" class="form-control"> 
                                                                <?php
                                                                  $get_cuentas_tipoB=$cuentas_tipoE->get_cuentas_tipoE();
                                                                  $num_get_cuentas_tipoB=mysql_num_rows($get_cuentas_tipoB);
                                                                    for ($countTiposDeCuentasB=0; $countTiposDeCuentasB < $num_get_cuentas_tipoB; $countTiposDeCuentasB++) 
                                                                    { 
                                                                      $assoc_get_cuentas_tipoB=mysql_fetch_assoc($get_cuentas_tipoB);
                                                                       echo "<option value='".$assoc_get_cuentas_tipoB['ID_ctp']."'>".$assoc_get_cuentas_tipoB['ctp_desc']."</option>";
                                                                    }
                                                                ?>
                                                             </select>
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Dirección</label>
                                                          <input type="text" class="form-control" id="cue_direccion" name="cue_direccion" placeholder="Dirección">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Sucursal</label>
                                                          <input type="text" class="form-control" id="cue_sucursal" name="cue_sucursal" placeholder="Sucursal">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">CBU</label>
                                                          <input type="text" class="form-control" id="cue_cbu" name="cue_cbu" placeholder="CBU">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">CUIT</label>
                                                          <input type="text" class="form-control" id="cue_cuit" name="cue_cuit" placeholder="CUIT">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Número</label>
                                                          <input type="text" class="form-control" id="cue_num" name="cue_num" placeholder="Número">
                                                        </div>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Moneda</label>
                                                          <select name="cue_moneda" class="form-control">
                                                            <option value="Peso Argentino">Peso Argentino</option>
                                                            <option value="Dolar">Dolar</option>
                                                            <option value="Euro">Euro</option>
                                                          </select>
                                                        </div>


                                                         <button type="submit" class="btn btn-success" id="botonGuardarNuevaCuenta"><i class="material-icons">save</i> GUARDAR</button>

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
		
        <div class='col-md-12' style="text-align: right; margin-bottom:  1%; margin-top:  1%;">
            <button class='btn btn-success' data-placement='top' data-toggle='modal' data-target='#nuevaCuenta'><i class='material-icons'>add</i> NUEVA CUENTA</button>
        </div> 
		<div class='col-md-12' style="text-align: center;">

        	<table id="listadoCuentas" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                      <th></th>
                        <th>DESCRIPCIÓN</th>
                        <th>TIPO</th>
                        <th>DIRECCIÓN</th>
                        <th>SUCURSAL</th>
                        <th>CBU</th>
                        <th>CUIT</th>
                        <th>NÚMERO</th>
                        <th>MONEDA</th>
                        <th>VER DESCUENTOS</th>
                        <th>NUEVO DESCUENTO</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                      <th></th>
                        <th>DESCRIPCIÓN</th>
                        <th>TIPO</th>
                        <th>DIRECCIÓN</th>
                        <th>SUCURSAL</th>
                        <th>CBU</th>
                        <th>CUIT</th>
                        <th>NÚMERO</th>
                        <th>MONEDA</th>
                        <th>VER DESCUENTOS</th>
                        <th>NUEVO DESCUENTO</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                        
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $get_cuentas=$cuentasE->get_cuentas();
                        $num_get_cuentas=mysql_num_rows($get_cuentas);
                        for ($CountCuentas=0; $CountCuentas < $num_get_cuentas; $CountCuentas++) 
                        { 
                            $assoc_get_cuentas=mysql_fetch_assoc($get_cuentas);

                            $get_cuentas_tipo=$cuentas_tipoE->get_cuentas_tipoE();
                            $num_get_cuentas_tipo=mysql_num_rows($get_cuentas_tipo);

                            $get_cuentas_impuestosById=$cuentas_impuestosE->get_cuentas_impuestosById($assoc_get_cuentas['ID_cue']);
                            $num_get_cuentas_impuestosById=mysql_num_rows($get_cuentas_impuestosById);

                             echo "<tr>";
                                echo "<th>";

                            /* Inicio Modal ver descuentos*/                          
                            echo '<div class="modal fade bd-example-modal-lg" id="verDescuentos'.$assoc_get_cuentas['ID_cue'].'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" >
                                    <div class="modal-dialog modal-lg" role="document" style="width:90%;">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="material-icons">list</i> LISTADO DE DESCUENTOS AUTOMÁTICOS</h4>
                                          </div>
                                          <div class="modal-body">
                                           <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                                      <fieldset>
                                                      <legend>Datos del descuento automatizado</legend>
                                                <table id="listadoDescuentos'.$assoc_get_cuentas['ID_cue'].'" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>DETALLE</th>
                                                            <th>EVENTO</th>
                                                            <th>MÉTRICA</th>
                                                            <th>VALOR</th>
                                                            <th>EDITAR</th>
                                                            <th>ELIMINAR</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>DETALLE</th>
                                                            <th>EVENTO</th>
                                                            <th>MÉTRICA</th>
                                                            <th>VALOR</th>
                                                            <th>EDITAR</th>
                                                            <th>ELIMINAR</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>';
                                                      for ($CountImpuestos=0; $CountImpuestos < $num_get_cuentas_impuestosById; $CountImpuestos++) 
                                                      { 
                                                         $assoc_get_cuentas_impuestosById=mysql_fetch_assoc($get_cuentas_impuestosById);
                                                         if ($assoc_get_cuentas_impuestosById['cti_credOdeb']==1) 
                                                         {
                                                           $cti_credOdebX="Se aplica el descuento cuando se produce un INGRESO de dinero en la cuenta";
                                                           $cti_credOdebXX=1;
                                                         }
                                                         else
                                                         {
                                                            $cti_credOdebX="Se aplica el descuento cuando se produce un EGRESO de dinero en la cuenta";
                                                            $cti_credOdebXX=0;
                                                         }  
                                                         if ($assoc_get_cuentas_impuestosById['cti_monto']>=1) 
                                                         {
                                                           $valor=$assoc_get_cuentas_impuestosById['cti_monto'];
                                                           $metrica="Monto $";
                                                         }
                                                         else
                                                         {
                                                            $valor=$assoc_get_cuentas_impuestosById['cti_porcentaje'];
                                                             $metrica="Porcentaje %";
                                                         }  
                                                     
                                                       echo '<input hidden type="text" name="action" value="EditarDescuento">
                                                       <input hidden type="text" name="ID_cue" value="'.$assoc_get_cuentas['ID_cue'].'">
                                                        <input hidden type="text" name="ID_cti" value="'.$assoc_get_cuentas_impuestosById['ID_cti'].'">
                                                         <tr> ';
                                                            echo '<th><input type="text" class="form-control" name="cti_desc" value="'.$assoc_get_cuentas_impuestosById['cti_desc'].'"></th>'; 
                                                            echo '<th>
                                                                        <select name="cti_credOdeb"  class="selectpicker show-tick">
                                                                          <option value="'.$cti_credOdebXX.'" selected>'.$cti_credOdebX.'</option>';
                                                                          if($cti_credOdebXX==0)
                                                                           {
                                                                            echo '<option value="1">Aplicar descuento cuando se produzca un INGRESO de dinero en la cuenta '.$assoc_get_cuentas['cue_desc'].'</option>';
                                                                           } 
                                                                           else
                                                                           {
                                                                             echo '<option value="0">Aplicar descuento cuando se produzca un EGRESO de dinero en la cuenta '.$assoc_get_cuentas['cue_desc'].'</option>';
                                                                           }
                                                                         
                                                                       echo '</select>
                                                                </th>';
                                                            echo '<th>
                                                                      <select name="cti_metrica"  class="selectpicker show-tick">
                                                                          <option value="'.$metrica.'" selected>'.$metrica.'</option>';
                                                                          if($metrica=="Monto $")
                                                                           {
                                                                            echo '<option value="0">Porcentaje %</option>';
                                                                           } 
                                                                           else
                                                                           {
                                                                              echo '<option value="1">Monto $</option>';
                                                                           }
                                                                         
                                                                       echo '</select>
                                                                       </th>';
                                                            echo '<th><input type="number" class="form-control" name="cti_monto" id="cti_monto" placeholder="Valor" value="'.$valor.'"></th>';
                                                            echo '<th><button type="submit" class="btn btn-primary"><i class="material-icons">mode_edit</i></button></th>';
                                                            echo '</form>';
                                                            echo '<th><a href="accionesExclusivas.php?action=dropImpuesto&ID_cti='.$assoc_get_cuentas_impuestosById['ID_cti'].'"><button type="button" class="btn btn-danger"><i class="material-icons">delete_forever</i></button></a></th>';
                                                          echo '</tr>';
                                                      }
                                                         
                                                echo '</tbody>      
                                              </table>  ';    


                                               echo "  <script type='text/javascript'>
                                                    $(document).ready( function () {
                                                    $('#listadoDescuentos".$assoc_get_cuentas['ID_cue']."').DataTable({
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

                                                     </script>";
                                    echo '</div>
                                          <div class="modal-footer">
                                          </div>
                                        </div>
                                      </div>
                                    </div>';
                                /* Fin Modal ver descuentos*/


                            /* Inicio Modal Insertar descuento */                          
                            echo '<div class="modal fade" id="nuevoDescuento'.$assoc_get_cuentas['ID_cue'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document" style="width:90%;">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="material-icons">add_box</i> NUEVO DESCUENTO</h4>
                                          </div>
                                          <div class="modal-body">
                                            <div class="alert alert-dismissible alert-info">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <strong><i class="material-icons">info</i> </strong> Complete el formulario para incorporar un descuento automático a la cuenta '.$assoc_get_cuentas['cue_desc'].', cada vez que ingrese o egrese saldo.
                                            </div>
                                            <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                               <fieldset>
                                                      <legend>Datos del descuento automatizado</legend>

                                                       <input hidden type="text" name="action" value="nuevoDescuento">
                                                       <input hidden type="text" name="ID_cue" value="'.$assoc_get_cuentas['ID_cue'].'">

                                                          <div class="form-group">
                                                            <label for="exampleInputEmail1">Detalle</label>
                                                            <input type="text" class="form-control" name="cti_desc" id="cti_desc" placeholder="Detalle">
                                                          </div>

                                                          <div class="form-group">
                                                            <label for="exampleInputEmail1">Evento Desencadenador</label>
                                                              <select name="cti_credOdeb" class="form-control">
                                                                <option value="1">Aplicar descuento cuando se produzca un INGRESO de dinero en la cuenta '.$assoc_get_cuentas['cue_desc'].'</option>
                                                                <option value="0">Aplicar descuento cuando se produzca un EGRESO de dinero en la cuenta '.$assoc_get_cuentas['cue_desc'].'</option>
                                                              </select>
                                                          </div>

                                                           <div class="form-group">
                                                            <label for="exampleInputEmail1">Métrica </label>
                                                              <select name="metrica" class="form-control">
                                                                <option value="0">Porcentaje %</option>
                                                                <option value="1">Monto Fijo $</option>
                                                              </select>
                                                          </div>

                                                           <div class="form-group">
                                                            <label for="exampleInputEmail1">Valor</label>
                                                            <input type="number" class="form-control" name="cti_monto" id="cti_monto" placeholder="Valor">
                                                          </div>

                                                          <button type="submit" class="btn btn-success"><i class="material-icons">save</i> GUARDAR</button>

                                               </fieldset>     
                                            </form>         

                                          </div>
                                          <div class="modal-footer">
                                          </div>
                                            </form>
                                        </div>
                                      </div>
                                    </div>';
                                /* Fin Modal Insertar descuento */

                            /* Inicio Modal modioficaCuenta */                          
                            echo '<div class="modal fade" id="editaCuenta'.$assoc_get_cuentas['ID_cue'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">MODIFICAR CUENTA</h4>
                                          </div>
                                          <div class="modal-body">
                                            <form  action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                                <fieldset>
                                                    <legend>Datos de la cuenta</legend>
                                                        <input hidden type="text" name="action" value="editarCuenta">
                                                        <input hidden type="text" name="ID_cue" value="'.$assoc_get_cuentas['ID_cue'].'">
                                                
                                                        <div class="form-group has-success" id="contenedorCodigo'.$assoc_get_cuentas['ID_cue'].'">
                                                              <label for="che_num" class="control-label" id="labelA'.$assoc_get_cuentas['ID_cue'].'" style="display:block; text-align: left;">Título<i class="material-icons">done</i> Disponible</label>
                                                              <label for="che_num" class="control-label" id="labelB'.$assoc_get_cuentas['ID_cue'].'" style="display:none; text-align: left;">Título<i class="material-icons">clear</i> Duplicado</label>
                                                              <input style="width:100%;" type="text" class="form-control" name="cue_desc" id="cue_desc'.$assoc_get_cuentas['ID_cue'].'" placeholder="Título" value="'.$assoc_get_cuentas['cue_desc'].'">
                                                         </div>

                                                               <script>$("#cue_desc'.$assoc_get_cuentas['ID_cue'].'").keyup(function()
                                                                  {
                                                                    var cue_desc = $("#cue_desc'.$assoc_get_cuentas['ID_cue'].'").val();      
                                                                    var action = "validaNombreDeCuentaDuplicado";
                                                                    var dataString = "cue_desc="+cue_desc + "&action="+action;

                                                                    $.ajax(
                                                                    {
                                                                        type: "POST",
                                                                        url: "accionesCuentasMovimientos.php",
                                                                        data: dataString,
                                                                        success: function(datas)
                                                                         {
                                                                            if(datas==0)
                                                                            {
                                                                               $("#contenedorCodigo'.$assoc_get_cuentas['ID_cue'].'").removeClass("form-group has-error");
                                                                               $("#contenedorCodigo'.$assoc_get_cuentas['ID_cue'].'").addClass("form-group has-success");
                                                                               $("#labelB'.$assoc_get_cuentas['ID_cue'].'").css("display", "none");
                                                                               $("#labelA'.$assoc_get_cuentas['ID_cue'].'").css("display", "block");
                                                                               $("#GuardarCambiosCuentas'.$assoc_get_cuentas['ID_cue'].'").css("display", "block");
                                                                            }
                                                                            else
                                                                            {
                                                                               $("#contenedorCodigo'.$assoc_get_cuentas['ID_cue'].'").removeClass("form-group has-success");
                                                                               $("#contenedorCodigo'.$assoc_get_cuentas['ID_cue'].'").addClass("form-group has-error");
                                                                               $("#labelA'.$assoc_get_cuentas['ID_cue'].'").css("display", "none");
                                                                               $("#labelB'.$assoc_get_cuentas['ID_cue'].'").css("display", "block");
                                                                               $("#GuardarCambiosCuentas'.$assoc_get_cuentas['ID_cue'].'").css("display", "none");
                                                                            } 
                                                                           
                                                                          }
                                                                         
                                                                     });
                                                                 });</script><br><br>

  
            
                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Tipo</label>
                                                          <select style="width:100%;" name="ID_ctp" class="form-control"> ';

                                                          for ($countTiposDeCuentas=0; $countTiposDeCuentas < $num_get_cuentas_tipo; $countTiposDeCuentas++) 
                                                          { 
                                                            $assoc_get_cuentas_tipo=mysql_fetch_assoc($get_cuentas_tipo);

                                                             echo "<option value='".$assoc_get_cuentas_tipo['ID_ctp']."'>".$assoc_get_cuentas_tipo['ctp_desc']."</option>";
                                                          }

                                                            echo '</select>
                                                        </div>
                                                        <br><br>

                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Dirección</label>
                                                          <input style="width:100%;" type="text" class="form-control" id="cue_direccion" name="cue_direccion" placeholder="Dirección" value="'.$assoc_get_cuentas['cue_dirección'].'">
                                                        </div>
                                                        <br><br>


  
                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Sucursal</label>
                                                          <input style="width:100%;" type="text" class="form-control" id="cue_sucursal" name="cue_sucursal" placeholder="Sucursal" value="'.$assoc_get_cuentas['cue_suc'].'">
                                                        </div>
                                                        <br><br>



                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">CBU</label>
                                                          <input style="width:100%;" type="text" class="form-control" id="cue_cbu" name="cue_cbu" placeholder="CBU" value="'.$assoc_get_cuentas['cue_cbu'].'">
                                                        </div>
                                                        <br><br>



                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">CUIT</label>
                                                          <input style="width:100%;" type="text" class="form-control" id="cue_cuit" name="cue_cuit" placeholder="CUIT" value="'.$assoc_get_cuentas['cue_cuit'].'">
                                                        </div>
                                                        <br><br>



                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Número</label>
                                                          <input style="width:100%;" type="text" class="form-control" id="cue_num" name="cue_num" placeholder="Número" value="'.$assoc_get_cuentas['cue_num'].'">
                                                        </div>
                                                        <br><br>



                                                         <div class="form-group">
                                                          <label for="exampleInputEmail1">Moneda</label>
                                                          <select style="width:100%;" name="cue_moneda" class="form-control">
                                                           <option value="'.$assoc_get_cuentas['cue_moneda'].'">'.$assoc_get_cuentas['cue_moneda'].'</option>
                                                            <option value="Peso Argentino">Peso Argentino</option>
                                                            <option value="Dolar">Dolar</option>
                                                            <option value="Euro">Euro</option>
                                                          </select>
                                                        </div>
                                                        <br><br>




                                                         <button type="submit" class="btn btn-success" id="GuardarCambiosCuentas'.$assoc_get_cuentas['ID_cue'].'"><i class="material-icons">save</i> GUARDAR</button>
                                                        <br><br>


                                                </fieldset>        

                                            </form>
                                          </div>
                                          <div class="modal-footer">
                                            
                                          </div>
                                            </form>
                                        </div>
                                      </div>
                                    </div>';
                                /* Fin Modal modioficaCuenta */


                                   /* Inicio Modal elimina cuenta */                          
                            echo '<div class="modal fade" id="eliminaCuenta'.$assoc_get_cuentas['ID_cue'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document" style="width:90%;">
                                      <div class="modal-content">
                                         <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="material-icons">delete_forever</i> ELIMINAR REGISTRO</h4>
                                          </div>
                                          <div class="modal-body">
                                              <div class="alert alert-danger" role="alert">
                                                            <h5><i class="material-icons">warning</i> CUIDADO !!!</h5>
                                                            <p> Usted esta a punto de eliminar el registro '.$assoc_get_cuentas['cue_desc'].' y junto a el todos los registros asociados</p>
                                                           
                                                           
                                                        </div>      
                                            </div>
                                          <div class="modal-footer">
                                            <a href="accionesExclusivas.php?ID_cue='.$assoc_get_cuentas['ID_cue'].'&action=dropCuenta"><button class="btn btn-success">Eliminar registro !</button></a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>';
                                /* Fin Modal elimina cuenta */

                            echo "</th>";
                                echo "<th>".$assoc_get_cuentas['cue_desc']."</th>";
                                echo "<th>".$assoc_get_cuentas['ctp_desc']."</th>";
                                echo "<th>".$assoc_get_cuentas['cue_direccion']."</th>";
                                echo "<th>".$assoc_get_cuentas['cue_sucursal']."</th>";
                                echo "<th>".$assoc_get_cuentas['cue_cbu']."</th>";
                                echo "<th>".$assoc_get_cuentas['cue_cuit']."</th>";
                                echo "<th>".$assoc_get_cuentas['cue_num']."</th>";
                                echo "<th>".$assoc_get_cuentas['cue_moneda']."</th>";
                                echo "<th><button data-toggle='modal' title='Ver descuentos Automatizados' data-placement='top' data-target='#verDescuentos".$assoc_get_cuentas['ID_cue']."' class='btn btn-info'><i class='material-icons'>visibility</i></button></th>";
                                echo "<th><button data-toggle='modal' title='Ingresar nuevo descuento automatizado' data-placement='top' data-target='#nuevoDescuento".$assoc_get_cuentas['ID_cue']."' class='btn btn-success'><i class='material-icons'>add</i></button></th>";
                                echo "<th><button data-toggle='modal' title='Modificar datos de la cuenta' data-placement='top' data-target='#editaCuenta".$assoc_get_cuentas['ID_cue']."' class='btn btn-primary'><i class='material-icons'>mode_edit</i></button></th>";
                                echo "<th><button data-toggle='modal' title='Eliminar Cuenta' data-placement='top' data-target='#eliminaCuenta".$assoc_get_cuentas['ID_cue']."' class='btn btn-danger'><i class='material-icons'>delete_forever</i></button></th>";
                            echo "</tr>";
                        }
                     ?>
                </tbody>
            </table>
        </div>  
    </div>

	

<!--Fin: Contenedor principal -->


<!--Fin: Footer -->

<!--Inicio: script -->
     <script type='text/javascript'>

    $(document).ready( function () {
    $('#listadoCuentas').DataTable({
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
  


     
<!--Fin: script -->

<!--Inicio: Trae Sucursales -->
 

  
<!--Fin: Trae Sucursales -->
<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>
