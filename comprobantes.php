<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php"); 
  $_SESSION['actionsBack'] = $_SERVER['REQUEST_URI'];
  $cabecera_comprobantes=new cabecera_comprobantes;
  // $cabecera_comprobantesE=new cabecera_comprobantesE;
  $tipo_comprobantes    = new tipo_comprobantes;
  $tipo_comprobantesE   = new tipo_comprobantesE;
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
  				<h3><i class="material-icons">style</i> Comprobantes<img src='media/loading/cargando4.gif' id='cargandoBoton' style="display: none;" > </h3>
  			</div> 
  		</div> 
</div>


<?php 

 /* Inicio Modal Cierre Caja */                          
    echo '<div class="modal fade" id="BuscaArticulos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document" style="width:80%;">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><div class="alert alert-dismissible alert-info" style="text-align: center;">
                      <h3><i class="material-icons">list</i> Listado de Artículos</h3>
                    </div> </h4>
                  </div>
                  <div class="modal-body" style="text-align:center;">
                      
                         <div class="form-group">
                              <label class="control-label" for="focusedInput"><i class="material-icons">store</i> Sucursal</label>
                              <select name="ID_suc" id="ID_suc"  class="selectpicker" data-live-search="true" required>';
                                      
                                        $get_sucursales=$sucursales->get_sucursales();
                                        $num_get_sucursales=mysql_num_rows($get_sucursales);
                                        for ($countget_sucursales=0; $countget_sucursales < $num_get_sucursales; $countget_sucursales++) 
                                        { 
                                          $assoc_get_sucursales=mysql_fetch_assoc($get_sucursales);
                                          echo "<option value='".$assoc_get_sucursales['ID_suc']."'>".$assoc_get_sucursales['suc_desc']."</option>";
                                        }

                            echo '</select> 
                          </div>   

                      <table id="listadoArticulos" class="table table-responsive table-striped table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Categoria</th>
                                    <th>Subcategoria</th>
                                    <th>Precio de Venta</th>
                                    <th>Proveedor</th>
                                    <th>Stock</th>
                                    <th>Metrica</th>
                                    <th>IVA</th>
                                    <th>Agregar al Comprobante</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Categoria</th>
                                    <th>Subcategoria</th>
                                    <th>Precio de Venta</th>
                                    <th>Proveedor</th>
                                    <th>Stock</th>
                                    <th>Metrica</th>
                                    <th>IVA</th>
                                    <th>Agregar al Comprobante</th>
                                </tr>
                            </tfoot>
                            <tbody>';
                                $get_articulosTodosConProveedores=$articulosE->get_articulosTodosConProveedores();
                                $num_get_articulosTodosConProveedores=mysql_num_rows($get_articulosTodosConProveedores);
                                echo "<script> importe_total = 0; </script>";
                                echo "<script> importe_neto = 0; </script>";
                                echo "<script> importe_grabado= 0; </script>";
                                echo "<script> pre_cantNuevaB  = 0; </script>";
                                echo "<script> pre_cantNuevaC = 0; </script>";
                                for ($countArticulos=0; $countArticulos < $num_get_articulosTodosConProveedores; $countArticulos++) 
                                { 
                                  $assoc_get_articulosTodosConProveedores=mysql_fetch_assoc($get_articulosTodosConProveedores);
                                  $ID_art=$assoc_get_articulosTodosConProveedores["ID_art"];
                                  $get_stockBySoloIdArtUltimo=$stockE->get_stockBySoloIdArtUltimo($ID_art);

                                  echo "<tr>";
                                        echo "<th>".$assoc_get_articulosTodosConProveedores["art_cod"]."</th>";
                                        echo "<th>".$assoc_get_articulosTodosConProveedores["art_desc"]."</th>";
                                        echo "<th>".$assoc_get_articulosTodosConProveedores["cat_desc"]."</th>";
                                        echo "<th>".$assoc_get_articulosTodosConProveedores["sub_desc"]."</th>";
                                        echo "<th>".$assoc_get_articulosTodosConProveedores["pre_cant"]."</th>";
                                        echo "<th>".$assoc_get_articulosTodosConProveedores["pro_desc"]."</th>";
                                        echo "<th>".$get_stockBySoloIdArtUltimo."</th>";
                                        echo "<th>".$assoc_get_articulosTodosConProveedores["art_unidad"]."</th>";
                                        echo "<th>".$assoc_get_articulosTodosConProveedores["pre_iva"]."</th>";
                                        echo "<th style='text-align:left; font-size:17px'>
                                        <input class='form-control' style='width:70px; float:left; border: 0px; background-color:none; font-size: 17px;' type='number' id='IngresaCantidad".$ID_art."' name='IngresaCantidad".$ID_art."' value='1' placeholder='Cantidad' required> ".$assoc_get_articulosTodosConProveedores["art_unidad"]."
                                        <button id='agregaArticulo".$ID_art."' class='btn btn-success' style='float:right;'><i class='material-icons'>add_box</i></button>
                                            <i class='material-icons' id='articuloConfirmado".$ID_art."' style='display:none;'>done_all</i>
                                        <button class='btn btn-danger' id='eliminarFila".$ID_art."' style='display:none;'><i class='material-icons'>delete_forever</i></button></th>"; 
                                    echo "</tr>"; 

                                    echo "<script>
                                        $('#agregaArticulo".$ID_art."').click(function(){
                                          
                                            $('#articulosDelComprobante').append('<tr id=\'fila".$ID_art."\'><td><input hidden type=\'text\' id=\'".$ID_art."\' name=\'ID_art\' class=\'CodigoID_art\' value=\'".$ID_art."\'> <input style=\'width:70px; float:left; border: 0px; background-color:none; font-size: 17px;\' type=\'text\' readonly id=\'Cantidad".$ID_art."\' name=\'cantidad\' class=\'cantidad\' value=\'1\' placeholder=\'Cantidad\' required>".$assoc_get_articulosTodosConProveedores["art_unidad"]."  </td><td style=\'text-align:center\'>".$assoc_get_articulosTodosConProveedores["art_cod"]."  </td><td style=\'text-align:center\'>  ".$assoc_get_articulosTodosConProveedores["art_desc"]." </td><td style=\'text-align:center\'>  $ <input type=\'text\' id=\'precio".$ID_art."\' name=\'precio\' style=\'width:70px; float:right; border: 0px; background-color:none; font-size: 17px;\' value=\'".$assoc_get_articulosTodosConProveedores["pre_cant"]."\' readonly></td><td style=\'text-align:center\'><input type=\'text\' id=\'descuento".$ID_art."\' name=\'descuento".$ID_art."\' class=\'descuentoPorUnidad\' value=\'0\' style=\'width:70px; float:right; border: 0px; background-color:none; font-size: 17px;\'><select id=\'metricaDescuento".$ID_art."\' class=\'metricaDescuento\'><option value=\'1\'>%</option><option value=\'2\'>$</option></select></td><td style=\'text-align:center\'> <input type=\'text\' id=\'pre_iva".$ID_art."\' name=\'pre_iva".$ID_art."\' value=\'".$assoc_get_articulosTodosConProveedores["pre_iva"]."\' style=\'width:70px; float:left; border: 0px; background-color:none; font-size: 17px;\' readonly> % </td><td style=\'text-align:center\' id=\'precioTotal".$ID_art."\'> </td><td style=\'text-align:center\'> <input type=\'text\' id=\'ID_sucIngresado".$ID_art."\' name=\'ID_sucIngresado".$ID_art."\' style=\'width:70px; float:right; border: 0px; background-color:none; font-size: 17px;\' class=\'ID_sucIngresado\' value=\'\' readonly></td><td style=\'text-align:center\'><button class=\'btn btn-danger\' id=\'eliminarFilaB".$ID_art."\'><i class=\'material-icons\'>delete_forever</i></button></td></tr>');
                                              var ID_suc".$ID_art." = $('#ID_suc').val();
                                              $('#ID_sucIngresado".$ID_art."').val(ID_suc".$ID_art.");

                                              $('#agregaArticulo".$ID_art."').fadeOut(100);
                                              $('#articuloConfirmado".$ID_art."').fadeIn(100);
                                              $('#eliminarFila".$ID_art."').fadeIn(100);
                                              $('#IngresaCantidad".$ID_art."').attr('readonly','readonly');
                                              var cantidad = $('#IngresaCantidad".$ID_art."').val();
                                              var pre_cant = ".$assoc_get_articulosTodosConProveedores["pre_cant"].";
                                              var pre_cantNuevaB = pre_cant*cantidad;
                                              var pre_cantNuevaC = (pre_cantNuevaB*".$assoc_get_articulosTodosConProveedores["pre_iva"].")/100;
                                              var pre_cantNueva  = pre_cantNuevaC+pre_cantNuevaB;
                                              var metrica = $('#metricaDescuento".$ID_art."').val();
                                                 $('#precioTotal".$ID_art."').text(pre_cantNueva);
                                                 $('#Cantidad".$ID_art."').val(cantidad);
                                                  $('#precio".$ID_art."').each(
                                                function(index, value) { 

                                                  importe_total = importe_total + pre_cantNueva;
                                                  importe_neto = importe_neto + pre_cantNuevaB;
                                                  importe_grabado =  importe_grabado + pre_cantNuevaC;
                                                  
                                                }
                                              );
                                              $('#subtotal').val(importe_total);
                                              $('#total').val(importe_total);
                                              $('#totalneto').val(importe_neto);
                                              $('#totalgrabado').val(importe_grabado);
                                               $('#btnRecorrer').click();
                                              $('#descuento".$ID_art."').blur(function(){
                                                   var descuento = $('#descuento".$ID_art."').val();
                                                   
                                                    if (descuento>=1) 
                                                    {

                                                    }
                                                    else
                                                     {
                                                        var cantidad = $('#IngresaCantidad".$ID_art."').val();
                                                        var pre_cant = ".$assoc_get_articulosTodosConProveedores["pre_cant"].";
                                                        var pre_cantNuevaB = pre_cant*cantidad;
                                                         var pre_cantNuevaC = (pre_cantNuevaB*".$assoc_get_articulosTodosConProveedores["pre_iva"].")/100;
                                                        var pre_cantNueva  = pre_cantNuevaC+pre_cantNuevaB;
                                                        $('#descuento".$ID_art."').val('0');
                                                         $('#precioTotal".$ID_art."').text(pre_cantNueva);
                                                         $('#Cantidad".$ID_art."').val(cantidad);

                                                        var descuentoEnCero=$('#descuento".$ID_art."').val();
                                                        if(descuentoEnCero==0)
                                                        {

                                                         
                                                        }
                                                      
                                                      }   
                                                    
                                               });

                                                  
                                                 $('#descuento".$ID_art."').keyup(function()
                                                { 
                                                   var descuento= $('#descuento".$ID_art."').val();
                                                   var pre_cant = ".$assoc_get_articulosTodosConProveedores["pre_cant"].";
                                                   var cantidad = $('#IngresaCantidad".$ID_art."').val();
                                                   var pre_cantNuevaB = pre_cant*cantidad;
                                                   var pre_cantNuevaC = (pre_cantNuevaB*".$assoc_get_articulosTodosConProveedores["pre_iva"].")/100;
                                                   var pre_cantNueva  = pre_cantNuevaC+pre_cantNuevaB;
                                                   var metrica = $('#metricaDescuento".$ID_art."').val();
  
                                                   if(metrica=='1')
                                                   {
                                                    var pre_cantNuevaMasDescuentoA = (parseFloat(pre_cantNueva))*(parseFloat(descuento))/100;
                                                    var pre_cantNuevaMasDescuento = (parseFloat(pre_cantNueva))-(parseFloat(pre_cantNuevaMasDescuentoA));
                                                   }
                                                   else
                                                   {
                                                    var pre_cantNuevaMasDescuento = (parseFloat(pre_cantNueva))-(parseFloat(descuento));
                                                   } 
                                                      $('#btnRecorrer').click();
                                                      
                                                      $('#precioTotal".$ID_art."').text(pre_cantNuevaMasDescuento);
                                                      $('#Cantidad".$ID_art."').val(cantidad);
                                                     
                                              });

                                            
                                               $('#metricaDescuento".$ID_art."').change(function(){
                                                
                                                     var descuento= $('#descuento".$ID_art."').val();
                                                   var pre_cant = ".$assoc_get_articulosTodosConProveedores["pre_cant"].";
                                                   var cantidad = $('#IngresaCantidad".$ID_art."').val();
                                                   var pre_cantNuevaB = pre_cant*cantidad;
                                                    var pre_cantNuevaC = (pre_cantNuevaB*".$assoc_get_articulosTodosConProveedores["pre_iva"].")/100;
                                              var pre_cantNueva  = pre_cantNuevaC+pre_cantNuevaB;
                                                   var metrica = $('#metricaDescuento".$ID_art."').val();

                                                   if(metrica=='1')
                                                   {
                                                    var pre_cantNuevaMasDescuentoA = (parseFloat(pre_cantNueva))*(parseFloat(descuento))/100;
                                                    var pre_cantNuevaMasDescuento = (parseFloat(pre_cantNueva))-(parseFloat(pre_cantNuevaMasDescuentoA));
                                                   }
                                                   else
                                                   {
                                                    var pre_cantNuevaMasDescuento = (parseFloat(pre_cantNueva))-(parseFloat(descuento));
                                                   } 

                                                      $('#precioTotal".$ID_art."').text(pre_cantNuevaMasDescuento);
                                                      $('#Cantidad".$ID_art."').val(cantidad);
                                                      
                                                      $('#btnRecorrer').click();
                                                      
                                              });
                                                    
                                        
                                            $('#eliminarFilaB".$ID_art."').click(function(){
                                                $('#fila".$ID_art."').remove();
                                                $('#agregaArticulo".$ID_art."').fadeIn(100);
                                                $('#articuloConfirmado".$ID_art."').fadeOut(100);
                                                $('#eliminarFila".$ID_art."').fadeOut(100);
                                                $('#IngresaCantidad".$ID_art."').removeAttr('readonly');

                                                var cantidad = $('#IngresaCantidad".$ID_art."').val();
                                                var pre_cant = ".$assoc_get_articulosTodosConProveedores["pre_cant"].";
                                                var pre_cantNuevaB = pre_cant*cantidad;
                                                var pre_cantNuevaC = (pre_cantNuevaB*".$assoc_get_articulosTodosConProveedores["pre_iva"].")/100;
                                                var pre_cantNueva  = pre_cantNuevaC+pre_cantNuevaB;

                                                importe_total = importe_total - pre_cantNueva;
                                                importe_neto = importe_neto - pre_cantNuevaB;
                                                importe_grabado =  importe_grabado - pre_cantNuevaC;

                                                $('#subtotal').val(importe_total);
                                                $('#totalneto').val(importe_neto);
                                                $('#totalgrabado').val(importe_grabado);
                                                
                                                $('#btnRecorrer').click();
                                            });
                                              
                                        });

                                    </script>";

                              
                                     //CUANDO SE PRESIONA EL BOTON VERDE PARA CARGAR ARTICULOS SE CALCULAN LOS TOTALES
                                    echo "<script>
                                                  $('#agregaArticulo".$ID_art."').click(function() {
                                                      $('#subtotal').each(
                                                        function(index, value) {
                                                          var subtotal = $('#subtotal').val();
                                                          var retenciones = $('#retenciones').val();
                                                          importe_neto = importe_neto + pre_cantNuevaB;
                                                          importe_grabado =  importe_grabado + pre_cantNuevaC;
                                                          $('#totalneto').val(importe_neto);
                                                          $('#totalgrabado').val(importe_grabado);
                                                        }
                                                      );
                                                       $('#btnRecorrer').click();
                                                    });
                                        </script>";


                                       echo "<script>
                                            $('#eliminarFila".$ID_art."').click(function(){
                                                $('#fila".$ID_art."').remove();
                                                $('#agregaArticulo".$ID_art."').fadeIn(100);
                                                $('#articuloConfirmado".$ID_art."').fadeOut(100);
                                                $('#eliminarFila".$ID_art."').fadeOut(100);
                                                $('#IngresaCantidad".$ID_art."').removeAttr('readonly');

                                                var cantidad = $('#IngresaCantidad".$ID_art."').val();
                                                var pre_cant = ".$assoc_get_articulosTodosConProveedores["pre_cant"].";
                                                var pre_cantNuevaB = pre_cant*cantidad;
                                                var pre_cantNuevaC = (pre_cantNuevaB*".$assoc_get_articulosTodosConProveedores["pre_iva"].")/100;
                                                var pre_cantNueva  = pre_cantNuevaC+pre_cantNuevaB;

                                                importe_total = importe_total - pre_cantNueva;
                                                importe_neto = importe_neto - pre_cantNuevaB;
                                                importe_grabado =  importe_grabado - pre_cantNuevaC;

                                                $('#subtotal').val(importe_total);
                                                $('#totalneto').val(importe_neto);
                                                $('#totalgrabado').val(importe_grabado);
                                                $('#btnRecorrer').click();   
                                            });
                                            </script>";
                                          
                                }
                               
                           echo '</tbody>
                        </table>
                    
                   </div>
                  <div class="modal-footer">
                      
                  </div>
                </div>
              </div>
            </div>';
        /* Fin Modal Cierre Caja */
      echo " <button id='btnRecorrer' style='margin:2%; display:none;'><i class='material-icons'>refresh</i></button>";
    
                 
                                          
?>

  


      <!--////////////////////////////////////// I N I C I O  N U E V O   C O M P R O B A N T E ///////////////////////////////////-->
     
          <div class='col-md-12' style="text-align: right; margin-bottom:  1%; margin-top:  1%;">
              <button class='btn btn-success' id='nuevoComprobanteBoton'><i class='material-icons'>add</i> NUEVO COMPROBANTE</button>
                <button class='btn btn-success' id='guardarNuevoComprobante' style="display: none;"><i class='material-icons'>save</i> GUARDAR Y APLICAR</button>
              <a href='comprobantes.php?nuevo=si'><button class='btn btn-success' id='nuevoComprobanteBotonB' style="display: none;"><i class='material-icons'>add</i> NUEVO COMPROBANTE</button></a>
          </div> 





          
          <div class='col-md-12'  id="CartelCargado" style="display: none; font-size: 12px;">
                 <p  style="text-align: right;"  id="CartelCargadoID"> 
                  <i class="material-icons"  id='cerrarCartelCargado' style="cursor: pointer; margin-bottom: -2%;">cancel</i>
                  </p> 
          </div>
    
    <div class="container" style="display: none;" id="nuevoComprobanteVisor">
        <div class='col-md-12' style="border: 1px solid #000; padding: 1%;"> 

         

              <div class="alert alert-dismissible alert-info">
                 <p  style="text-align: right;"> 
                  <i class="material-icons"  id='cerrarNuevoComprobante' style="cursor: pointer; margin-bottom: -2%;">cancel</i>
                  </p> 
                      <h3 style="text-align: center;"><i class="material-icons">add_box</i> Comprobante nuevo</h3>
                    </div> 

            <!--CABEZA COMPROBANTE-->
            <div class='col-md-12' style="border-bottom: 1px solid #000"> 
                  
               <div class='col-md-3'> 
                  <div class="form-group">
                      <label class="control-label" for="focusedInput"><i class="material-icons">description</i> Tipo de Comprobante </label>
                      <select name="ID_tce"  id='ID_tce'  class="selectpicker" data-live-search="true" required>
                         <option selected disabled>Seleccione Tipo</option>
                              <?php
                                $get_tipo_comprobantes=$tipo_comprobantes->get_tipo_comprobantes();
                                $num_get_tipo_comprobantes=mysql_num_rows($get_tipo_comprobantes);
                                for ($countget_tipo_comprobantes=0; $countget_tipo_comprobantes < $num_get_tipo_comprobantes; $countget_tipo_comprobantes++) 
                                { 
                                  $assoc_get_tipo_comprobantes=mysql_fetch_assoc($get_tipo_comprobantes);
                                  $tce_desc=$assoc_get_tipo_comprobantes['tce_desc'];
                                  $ID_tce=$assoc_get_tipo_comprobantes['ID_tce'];
                                  echo "<option value='".$ID_tce."'>".$tce_desc."</option>";
                                }
                              ?>
                      </select> 
                  </div>   
              </div>
              
               <div class='col-md-3'> 
                  <div class="form-group">
                    <label class="control-label" for="focusedInput"><i class="material-icons">receipt</i> Comprobante Asociado </label>
                    <select name="ID_asociado"  id='ID_asociado'  class="selectpicker" data-live-search="true" required>
                        <option value='0'>Ninguno</option>
                              <?php  
                                $get_cabecera_comprobantes=$cabecera_comprobantes->get_cabecera_comprobantes();
                                $num_get_cabecera_comprobantes=mysql_num_rows($get_cabecera_comprobantes);
                                for ($countaget_cabecera_comprobantes=0; $countaget_cabecera_comprobantes < $num_get_cabecera_comprobantes; $countaget_cabecera_comprobantes++) 
                                { 
                                  $assoc_get_cabecera_comprobantes=mysql_fetch_assoc($get_cabecera_comprobantes);
                                  $cte_numero=$assoc_get_cabecera_comprobantes['cte_numero'];
                                  $ID_cte=$assoc_get_cabecera_comprobantes['ID_cte'];
                                  echo "<option value='".$ID_cte."'>".$cte_numero."</option>";
                                }
                              ?>
                      </select> 
                  </div>   
              </div>

                  <!--Script que toma el tipo de comprobante seleccionado para buscar si tiene numeracion automatica o no-->
                          <script type="text/javascript">
                            $("#ID_tce").change(function(){
                               var ID_tce = $("#ID_tce option:selected").val();
                                var dataString = 'ID_tce='+ID_tce;
                                  $.ajax(
                                  { 
                                      type: 'POST',
                                      url: 'BuscaNumeracionDeComprobante.php',
                                      data: dataString,
                                      success: function(data)
                                       {  
                                          var reultadoData              = $.trim(data);
                                          var NumeroComprobante         = reultadoData.split('/')[0];
                                          var ID_fce                    = reultadoData.split('/')[1];
                                          var tce_movcaja               = reultadoData.split('/')[2];
                                          var tce_movstock              = reultadoData.split('/')[3];
                                          var tce_predecesor            = reultadoData.split('/')[4];
                                          var tce_fuerzaPredecesor      = reultadoData.split('/')[5];
                                          var tce_numeracionAutomatica  = reultadoData.split('/')[6];
                                          var tce_detalleArticulos      = reultadoData.split('/')[7];
                                          var tce_letra                 = reultadoData.split('/')[8];
                                          var pdv_cai                   = reultadoData.split('/')[9];
                                          var pdv_fecVencimiento        = reultadoData.split('/')[10];

                                          
                                            if(tce_movcaja==0)
                                           {
                                             $('#buscaCuenta').fadeOut(100);
                                           }
                                           else
                                           {
                                             $('#buscaCuenta').fadeIn(100);
                                           } 

                                           if(tce_detalleArticulos==0)
                                           {
                                             $('#AgregarDetallealComprobante').fadeOut(100);
                                           }
                                           else
                                           {
                                             $('#AgregarDetallealComprobante').fadeIn(100);
                                           } 

                                           if(tce_numeracionAutomatica==0)
                                           {
                                              $('#MuestranumeracionDeComprobante').fadeOut(100);
                                              $('#NumeracionManual').fadeIn(100);
                                           }
                                           else
                                           {
                                              $('#NumeracionManual').fadeOut(100);
                                              $('#MuestranumeracionDeComprobante').fadeIn(100);
                                           } 

                                        
                                           if(ID_fce==2)
                                           {
                                             $('#buscaCliente').fadeIn(500);
                                             $('#buscaProveedor').fadeOut(500);
                                           } 
                                          else
                                          {
                                             $('#buscaCliente').fadeOut(500);
                                             $('#buscaProveedor').fadeIn(500);
                                          }  



                                           if(pdv_cai==0)
                                           {
                                              $('#cai').val("");
                                              $('#tieneCai').fadeOut(100);
                                              $('#vto').val("");
                                           }
                                           else
                                           {
                                              $('#cai').val(pdv_cai);
                                              $('#tieneCai').fadeIn(100);
                                              $('#vto').val(pdv_fecVencimiento);

                                           } 


                                       }


                                   })
                            });
                          </script>
        
                <div class='col-md-3' id='NumeracionManual' style="display: none;">   
                    <div class="form-group">
                    <label class="control-label" for="focusedInput"><i class="material-icons">assistant_photo</i> Numeración </label>
                    <input type="text" name="numeracionManuelInput" id="numeracionManuelInput" class="form-control">
                                       </div>   
              </div>


               <div class='col-md-3' id='MuestranumeracionDeComprobante' style="display: none;">   
                    <div class="form-group">
                    <label class="control-label" for="focusedInput"><i class="material-icons">assistant_photo</i> Punto de Venta </label>
                    <select name="tce_numeracionAutomatica" id="numeracionDeComprobante" class="selectpicker" data-live-search="true">
                        <?php
                                  $get_puntos_de_ventasByIdID_tce=$puntos_de_ventas->get_puntos_de_ventas();
                                  $num_get_puntos_de_ventasByIdID_tce=mysql_num_rows($get_puntos_de_ventasByIdID_tce);
                                  for ($countget_puntos_de_ventasByIdID_tce=0; $countget_puntos_de_ventasByIdID_tce < $num_get_puntos_de_ventasByIdID_tce; $countget_puntos_de_ventasByIdID_tce++) 
                                  { 
                                    $assoc_get_puntos_de_ventasByIdID_tce=mysql_fetch_assoc($get_puntos_de_ventasByIdID_tce);
                                    $pdv_puntoVenta=$assoc_get_puntos_de_ventasByIdID_tce['pdv_puntoVenta'];
                                    $ID_pdv=$assoc_get_puntos_de_ventasByIdID_tce['ID_pdv'];

                                    echo "<option value='".$ID_pdv."'>".$pdv_puntoVenta."</option>";
                                  }
                                ?>
                    </select>
                  </div>   
              </div>

               <div class='col-md-3' id='buscaCuenta' style="display: none;"> 
                  <div class="form-group">
                        <label class="control-label" for="focusedInput"><i class="material-icons">account_balance_wallet</i> Cuenta </label>
                        <select name="ID_caja"  id='ID_caja'  class="selectpicker" data-live-search="true" required>
                          <option value='0'>Ninguno</option>
                                <?php
                                  $get_cuentasB=$cuentas->get_cuentas();
                                  $num_get_cuentasB=mysql_num_rows($get_cuentasB);
                                  for ($countaget_cuentasB=0; $countaget_cuentasB < $num_get_cuentasB; $countaget_cuentasB++) 
                                  { 
                                    $assoc_get_cuentasB=mysql_fetch_assoc($get_cuentasB);
                                    $ID_cue=$assoc_get_cuentasB['ID_cue'];
                                    $cue_desc=$assoc_get_cuentasB['cue_desc'];
                                    echo "<option value='".$ID_cue."'>".$cue_desc."</option>";
                                  }
                                ?>
                        </select> 
                  </div>   
              </div>

              <?php 

              echo "<div class='col-md-3' id='FechaComprobante'> 
                            <div class='form-group'>
                                  <label class='control-label' for='focusedInput'><i class='material-icons'>date_range</i> Fecha </label>
                                  <input type='datetime-local' class='form-control' name='cte_fec' id='cte_fec' value='".$FechayHora."' placeholder='".$FechayHora."' required>
                                   
                            </div>   
                        </div>";

               
                    echo "<div class='col-md-3' id='buscaCliente' style='display: none;'> 
                            <div class='form-group'>
                                  <label class='control-label' for='focusedInput'><i class='material-icons'>account_circle</i> Clientes </label>
                                  <select name='ID_cli'  id='ID_cli'  class='selectpicker' data-live-search='true' required>
                                    <option value='0'>Ninguno</option>";
                                            $get_clientes=$clientes->get_clientes();
                                            $num_get_clientes=mysql_num_rows($get_clientes);
                                            for ($countaget_clientes=0; $countaget_clientes < $num_get_clientes; $countaget_clientes++) 
                                            { 
                                              $assoc_get_clientes=mysql_fetch_assoc($get_clientes);
                                              $ID_clie=$assoc_get_clientes['ID_cli'];
                                              $cli_nombre=$assoc_get_clientes['cli_nombre'];
                                              $cli_apellido=$assoc_get_clientes['cli_apellido'];
                                              echo "<option value='".$ID_clie."'>".$cli_apellido." ".$cli_nombre."</option>";
                                            }
                             echo "</select> 
                            </div>   
                        </div>";
                
                     echo "<div class='col-md-3' id='buscaProveedor' style='display: none;'> 
                            <div class='form-group'>
                                  <label class='control-label' for='focusedInput'><i class='material-icons'>account_circle</i> Proveedor </label>
                                    <select name='ID_pro'  id='ID_pro'  class='selectpicker' data-live-search='true' required>
                                      <option value='0'>Ninguno</option>";
                                              $get_proveedores=$proveedores->get_proveedores();
                                              $num_get_proveedor=mysql_num_rows($get_proveedores);
                                              for ($countaget_proveedor=0; $countaget_proveedor < $num_get_proveedor; $countaget_proveedor++) 
                                              { 
                                                $assoc_get_proveedor=mysql_fetch_assoc($get_proveedores);
                                                $ID_pro=$assoc_get_proveedor['ID_pro'];
                                                $pro_desc=$assoc_get_proveedor['pro_desc'];
                                                echo "<option value='".$ID_pro."'>".$pro_desc."</option>";
                                              }
                                  echo "</select> 
                            </div>   
                        </div>";   
                  
                ?>

            </div> 

            <!--CUERPO COMPROBANTE-->
            <div class='col-md-12' id="AgregarDetallealComprobante" style="border-bottom: 1px solid #000; display: none;"> 

               
                 <button id="AgregarArticulosalComprobante" style="margin: 2%; " class="btn btn-primary" data-toggle='modal' title='Agregar Articulo' data-placement='top' data-target='#BuscaArticulos'><i class="material-icons">add_box</i> Agregar Articulos al Comprobante</button> 
      
                        <table class="table table-responsive table-striped" cellspacing="0" style="font-size: 17px;" id="tabla">
                            <thead>
                                <tr>
                                        <th>CANTIDAD</th>
                                        <th>CÓDIGO</th>
                                        <th>DESCRIPCIÓN</th>
                                        <th>UNIDAD</th>
                                        <th>DESCUENTO</th>
                                        <th>ALICUOTA</th>
                                        <th>TOTAL</th>
                                        <th>SUCURSAL</th>
                                        <th>ELIMINAR</th>
                                       
                                </tr>
                            </thead>
                            <tbody id='articulosDelComprobante'>
                             
                            </tbody>
                        </table>      
                  
            </div>   

            <!--FOOTER COMPROBANTE-->
            <div class='col-md-12'> 
               <div class='col-md-5' style="border: 1px solid #000; margin: 2%; display: none; float: left;" id="tieneCai">
                  <p style=" font-size: 17px;" >CAI Nº: <input  style='border: 0px; background-color:none; font-size: 17px;' type="text" name="cai" value="" id="cai"></p>
                  <p style=" font-size: 17px;" >FECHA DE VTO: <input  style=' border: 0px; background-color:none; font-size: 17px;' type="text" name="vto" value="" id="vto"></p>
              </div>
              <div class='col-md-2'>
                
              </div> 
                <div class='col-md-5' style="border: 1px solid #000; margin: 2%; float: right;">
                    <div class='col-md-12' style="font-size: 17px; margin-top: 2%; ">
                       <div class='col-md-7' style="text-align: left;">
                        TOTAL NETO: 
                      </div>
                       <div class='col-md-5' style="text-align: right;">
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                          <div class="input-group">
                            <div class="input-group-addon">$</div>
                           <input   class='form-control' type="text" name="totalneto" value="" id="totalneto">
                          </div>
                        </div> 

                      </div>
                    </div> 
                     <div class='col-md-12' style="font-size: 17px;"> 
                       <div class='col-md-7' style="text-align: left; ">
                        TOTAL GRABADO:
                      </div>
                       <div class='col-md-5' style="text-align: right;">

                        <div class="form-group">
                          <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                          <div class="input-group">
                            <div class="input-group-addon">$</div>
                           <input  class='form-control' type="text" name="totalgrabado" value="0" id="totalgrabado" placeholder="TOTAL GRABADO">
                          </div>
                        </div> 
                           
                      </div>
                    </div>   
                   <div class='col-md-12' style="font-size: 17px;">
                     <div class='col-md-7' style="text-align: left;">
                      SUB-TOTAL GRAL:
                    </div>
                     <div class='col-md-5' style="text-align: right;">

                       <div class="form-group">
                          <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                          <div class="input-group">
                            <div class="input-group-addon">$</div>
                          <input class='form-control' type="text" name="subtotal" value="" id="subtotal">
                          </div>
                        </div>
                        
                    </div>
                   </div>  
                   <div class='col-md-12' style="font-size: 17px;">
                     <div class='col-md-7' style="text-align: left;">
                      DESCUENTO: 
                    </div> 
                    
                     <div class='col-md-5' style="text-align: right;">
                         
                          <div class="form-group">
                          <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                          <div class="input-group">
                            <div class="input-group-addon"><select id='descuentoGeneral' class="custom-select"><option value='1'>%</option><option value='2'>$</option></select> </div>
                            <input class='form-control' type="text" name="retenciones" value="0" id="retenciones">
                          </div>
                        </div>
                        
                    </div>
                   </div>  
                   <div class='col-md-12' style="font-size: 20px;">
                     <div class='col-md-7' style="text-align: left;">
                     TOTAL GRAL:
                    </div>
                     <div class='col-md-5' style="text-align: right;">
                     
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                          <div class="input-group">
                            <div class="input-group-addon">$</div>
                           <input class='form-control' type="text" name="total" value="" id="total">
                          </div>
                        </div>

                    </div>
                   </div>  
              </div> 

            </div> 
  
        </div>

   </div>



        <script type="text/javascript">

                 $('#subtotal').change(function(){
                  var subtotal = $('#subtotal').val();
                        var subtotalNumbre =  parseFloat(subtotal);
                     $('#total').val(subtotalNumbre);
                     });

               $('#subtotal').keyup(function(){
                  var subtotal = $('#subtotal').val();
                        var subtotalNumbre =  parseFloat(subtotal);
                     $('#total').val(subtotalNumbre);
                   });

             
              $('#total').blur(function(){
                 var subtotal = $('#subtotal').val();
                        var subtotalNumbre =  parseFloat(subtotal);
                        if (subtotalNumbre>=0) 
                         {
                           
                         }
                         else
                         {
                          $('#total').val(subtotalNumbre);
                         } 
                     
                                            });

   $('#subtotal').keyup(function(){
                 var subtotal = $('#subtotal').val();
                  var retencionesB = $('#retenciones').val();
                  var descuentoGeneral = $('#descuentoGeneral').val();
                  if(descuentoGeneral=='1'){
                                                    var retencionesA = (parseFloat(subtotal))*(parseFloat(retencionesB))/100;
                                                    var retencionesB = (parseFloat(subtotal))-(parseFloat(retencionesA));
                                                   }
                                                   else{
                                                    var retencionesB = (parseFloat(subtotal))-(parseFloat(retencionesB));
                                                   } 
                  $('#total').val(retencionesB);
              });

              $('#retenciones').blur(function(){
                var retenciones = $('#retenciones').val();
                 if (retenciones>=0) 
                 {
                   
                 }
                 else
                 {
                  $('#retenciones').val('0');
                 } 
                                           });

           

              $('#retenciones').keyup(function(){
                  var subtotal = $('#subtotal').val();
                   var retencionesB = $('#retenciones').val();
                   var descuentoGeneral = $('#descuentoGeneral').val();
                  if(descuentoGeneral=='1'){
                                                    var retencionesA = (parseFloat(subtotal))*(parseFloat(retencionesB))/100;
                                                    var retencionesB = (parseFloat(subtotal))-(parseFloat(retencionesA));
                                                   }
                                                   else{
                                                    var retencionesB = (parseFloat(subtotal))-(parseFloat(retencionesB));
                                                   } 
                  $('#total').val(retencionesB);
              });

              $('#descuentoGeneral').change(function(){
                
                  var subtotal = $('#subtotal').val();
                  var retencionesB = $('#retenciones').val();
                  var descuentoGeneral = $('#descuentoGeneral').val();
                  if(descuentoGeneral=='1'){
                                                    var retencionesA = (parseFloat(subtotal))*(parseFloat(retencionesB))/100;
                                                    var retencionesB = (parseFloat(subtotal))-(parseFloat(retencionesA));
                                                   }
                                                   else{
                                                    var retencionesB = (parseFloat(subtotal))-(parseFloat(retencionesB));
                                                   } 
                  $('#total').val(retencionesB);
              });



              $('#nuevoComprobanteBoton').click(function(){
                $('#nuevoComprobanteVisor').toggle('fast');
                $('#guardarNuevoComprobante').fadeIn(500);
                $('#nuevoComprobanteBoton').fadeOut(500);
              });
              
                  $(document).ready( function () {
                  $('#listadoArticulos').DataTable({
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

              } );

                    $('#btnRecorrer').click(function(){
                                var importe_total='0';
                                     $('table tr td:nth-child(7)').each(function(){
                                      var sumatoria = $(this).text();
                                        importe_total = (parseFloat(importe_total)) + (parseFloat(sumatoria));

            
                                                         });  

                                                          $('#subtotal').val(importe_total); 
                                                           retencionesB = $('#retenciones').val();
                                                         
                                                          subtotalMasRetenciones = (parseFloat(retencionesB)) + (parseFloat(importe_total));

                                                          $('#total').val(subtotalMasRetenciones);
                                                          
                                                          var importe_total='0';

                               });

                          $('#cerrarNuevoComprobante').click(function(){
                          $('#nuevoComprobanteVisor').fadeOut(500);
                          $('#guardarNuevoComprobante').fadeOut(500);
                          $('#nuevoComprobanteBotonB').fadeIn(500);
                       });


                          $('#cerrarCartelCargado').click(function(){
                          $('#nuevoComprobanteVisor').fadeOut(500);
                          $('#guardarNuevoComprobante').fadeOut(500);
                          $('#cerrarCartelCargado').fadeOut(500);
                          $('#nuevoComprobanteBoton').fadeIn(500);
                       });

                          $('#guardarNuevoComprobante').click(function(){
                          $('#guardarNuevoComprobante').fadeOut(500);
                          $('#nuevoComprobanteBotonB').fadeIn(500);
                          $('#cerrarNuevoComprobante').click();
                       });
            
            
                        
                </script>

                                     <?php 
                                    
                                      echo "<script>$('#guardarNuevoComprobante').click(function(){
                                                  
                                                  var arrayB = [];
                                                  $('.cantidad').each(function()
                                                  {
                                                    arrayB.push($(this).val());
                                                  });
                                                  var array = JSON.stringify(arrayB);

                                                    var arrayC = [];
                                                  $('.CodigoID_art').each(function()
                                                  {
                                                    arrayC.push($(this).val());
                                                  });
                                                  var ID_art = JSON.stringify(arrayC);

                                                    var arrayD = [];
                                                  $('.descuentoPorUnidad').each(function()
                                                  {
                                                    arrayD.push($(this).val());
                                                  });
                                                  var descuentoPorUnidad = JSON.stringify(arrayD);

                                                    var arrayE = [];
                                                  $('.metricaDescuento').each(function()
                                                  {
                                                    arrayE.push($(this).val());
                                                  });
                                                  var metricaDescuento = JSON.stringify(arrayE);

                                                    var arrayF = [];
                                                  $('.ID_sucIngresado').each(function()
                                                  {
                                                    arrayF.push($(this).val());
                                                  });
                                                  var ID_suc = JSON.stringify(arrayF);

                                                  var  numeracionDeComprobante =$('#numeracionDeComprobante').val();
                                                  var  cai =$('#cai').val();
                                                  var  vto =$('#vto').val();
                                                  var  totalneto =$('#totalneto').val();
                                                  var  totalgrabado =$('#totalgrabado').val();
                                                  var  subtotal =$('#subtotal').val();
                                                  var  retenciones =$('#retenciones').val();
                                                  var  total =$('#total').val();
                                                  var  ID_tce =$('#ID_tce').val();
                                                  var  ID_asociado =$('#ID_asociado').val();
                                                  var  ID_caja =$('#ID_caja').val();
                                                  var  descuentoGeneral =$('#descuentoGeneral').val();
                                                  var  action ='nuevoComprobante';
                                                  var   ID_cli=$('#ID_cli').val();
                                                  var   ID_pro=$('#ID_pro').val();
                                                  var   cte_fec=$('#cte_fec').val();
                                                  var   numeracionManuelInput=$('#numeracionManuelInput').val();

                                                  var dataString = 'numeracionDeComprobante='+numeracionDeComprobante + '&action='+action
                                                  + '&cai='+cai
                                                  + '&vto='+vto
                                                  + '&totalneto='+totalneto
                                                  + '&totalgrabado='+totalgrabado
                                                  + '&subtotal='+subtotal
                                                  + '&retenciones='+retenciones
                                                  + '&total='+total
                                                  + '&ID_tce='+ID_tce
                                                  + '&ID_asociado='+ID_asociado
                                                  + '&ID_caja='+ID_caja
                                                  + '&descuentoGeneral='+descuentoGeneral
                                                  + '&array='+array
                                                  + '&ID_art='+ID_art
                                                  + '&descuentoPorUnidad='+descuentoPorUnidad
                                                  + '&metricaDescuento='+metricaDescuento
                                                  + '&ID_suc='+ID_suc
                                                  + '&ID_cli='+ID_cli
                                                  + '&ID_pro='+ID_pro
                                                  + '&cte_fec='+cte_fec
                                                  + '&numeracionManuelInput='+numeracionManuelInput;

                                              $.ajax(
                                              { 
                                                  type: 'POST',
                                                  url: 'accionesComprobantes.php',
                                                  data: dataString,
                                                  success: function(data)
                                                   {

                                                      $('#CartelCargado').fadeIn(1000).html(data); 
                                                      $('#CartelCargadoID').fadeIn(1000);

                                                   }
                                               });
                                           });
                                        </script>";


    
   ?>

		  <!--////////////////////////////////////// F I N  N U E V O   C O M P R O B A N T E ///////////////////////////////////-->

  
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
                          $get_tipo_comprobantesB=$tipo_comprobantes->get_tipo_comprobantes();
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
                                                  url: 'visorComprobantes.php',
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
                                                  url: 'visorComprobantes.php',
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
                                                  url: 'visorComprobantes.php',
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

