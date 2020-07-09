<!--Inicio: Documentos requeridos -->
<?php
	include_once("inc/requeridoSinCarga.php"); 
  include_once("inc/validacion.php"); 

  $mov_cajaE          = new mov_cajaE;
  $cajaE              = new cajaE;
  $ventaE             = new ventaE;
  $tipos_pagos        = new tipos_pagos;
  $tipos_pagosE       = new tipos_pagosE;
  $tarjetas           = new tarjetas;
  $tarjetas_planesE   = new tarjetas_planesE;
  $usuariosE          = new usuariosE;
  $tarjetas_planes    = new tarjetas_planes;
  $tarjetas_planesE   = new tarjetas_planesE;
  $venta_detalle      = new venta_detalle;
  $venta_detalleE     = new venta_detalleE;
  $puestosE           = new puestosE;
   //Trae la ultima caja abierta por usuario 
          $get_caja_UltimaByUsu =$cajaE->get_caja_UltimaByUsu($ID_usu);
          $assoc_get_caja_UltimaByUsu=mysql_fetch_assoc($get_caja_UltimaByUsu);
          $ID_caj=$assoc_get_caja_UltimaByUsu['ID_caj'];
          $get_venta_UltimaByIdCaja =$ventaE->get_venta_UltimaByIdCaja($ID_caj);
          $assoc_get_venta_UltimaByIdCaja=mysql_fetch_assoc($get_venta_UltimaByIdCaja);
          $ID_ven    = $assoc_get_venta_UltimaByIdCaja['ID_ven'];

  $ID_pue=$_SESSION['PUESTO'];
  $get_puestosByIdB=$puestosE->get_puestosByIdB($ID_pue);
  $assoc_get_puestosByIdB=mysql_fetch_assoc($get_puestosByIdB);
?>
<!--Fin: Documentos requeridos -->
<!--Inicio: classes -->
<style type="text/css">
  .no-borderDanger {
    border: 0;
    box-shadow: none; /* You may want to include this as bootstrap applies these styles too */
    width: 10%;
    background-color: #f2dede;
    text-align: center; 
}
.no-borderSuccess{
    border: 0;
    box-shadow: none; /* You may want to include this as bootstrap applies these styles too */
    width: 10%;
    background-color: #dff0d8;
    text-align: center; 
}
</style>
<!--Fin: classes -->
<!--Inicio: Contenedor principal -->
<div class="container-fluid" id="NoImprimir">

     
  <!--Inicio: contenedor superior--> 	
   <div class="col-md-12">
        <i class="material-icons">account_circle</i> Usuario: <?php echo $_SESSION['usu_nombre']." ".$_SESSION['usu_apellido'];?> -
        <i class="material-icons">print</i> Punto de venta: <?php echo $assoc_get_puestosByIdB['pdv_puntoVenta']; ?> -
        <i class="material-icons">store</i> Sucursal: <?php echo $assoc_get_puestosByIdB['suc_desc']; ?> -
        <i class="material-icons">account_balance_wallet</i> Cuenta Efectivo: <?php echo $assoc_get_puestosByIdB['cue_desc']; ?> -
        <i class="material-icons">shopping_cart</i> Puesto: <?php echo $assoc_get_puestosByIdB['pue_desc']; ?>
   </div>   
  <div class="col-md-12" id="recuadros">
      <!--Inicio: Input Cantidad--> 
      <div class="col-md-1">
       <input type="text" name="get_cantidad" id="get_cantidad" class="form-control" value="1">
       <input hidden type="text" name="ID_ven" id="ID_ven" value="<?php echo $ID_ven;?>">
      </div>
      <!--Fin: Input Cantidad-->
      
  		<!--Inicio: Barra buscadora--> 
	  	<div class="col-md-5" >
	  		<input type="text" name="get_articulos" id="get_articulos" class="form-control" placeholder="Buscar Articulo" autofocus="autofocus">
        <div id='suggestions' class='suggestions' style="max-height: 300px; overflow-y: scroll;"></div>

          <input hidden type="text" name="input_recibe_recibe_respuesta_inseraMovimiento" id="input_recibe_recibe_respuesta_inseraMovimiento" value="">
	  	</div>
	  	<!--Fin: Barra buscadora--> 
	  
	  	<!--Inicio: Boton cerrar caja-->
	  	<div class="col-md-2" >
        <button class="btn btn-primary" data-toggle='modal' title='Cerrar Caja' data-placement='top' data-target='#CerrarCaja'><i class="material-icons">swap_vert</i> Cerrar Caja</button>
	  	</div>
	  	<!--Fin: Input Cantidad-->
      <!--Inicio: Boton cerrar caja-->
      <div class="col-md-4" >
        <button class="btn btn-primary" title='Imprimir Venta Anterior' id="habilitarImpresion"><i class="material-icons">print</i></button>
        <button class="btn btn-danger" title='Cerrar Impresion' id="CerrarImpresion" style="display:none"><i class="material-icons">cancel</i></button>
            </script>

  <?php 

       echo '<div class="col-md-12" style="display:none" id="selectorDeImpresionDeTicket">';
                      //Inicio: Contenedor Invisible para imprimir 
                       echo '<div class="container-fluid" id="VentaPenultima" >
                             <div class="col-md-12">';
                                $get_venta_penultimaByIdCaja        =   $ventaE->get_venta_penultimaByIdCaja($ID_caj);
                                $assoc_get_venta_penultimaByIdCaja  =   mysql_fetch_assoc($get_venta_penultimaByIdCaja);
                                $ID_venPenultima                    =   $assoc_get_venta_penultimaByIdCaja['ID_ven'];
                                $get_mov_cajaByIdVen                =   $mov_cajaE->get_mov_caja($ID_caj, $ID_venPenultima);
                                $num_get_mov_cajaById               =   mysql_num_rows($get_mov_cajaByIdVen);
                                $totalSuma                          =   0;
                                $precioFinalParaImpresion           =   0;
                                echo "<table class='table table-striped table-hover' border='0' style='text-align:center; width=100%;'>";
                                  echo "<tr>";
                                    echo "<td>";
                                      echo "<strong>Cant.</strong>";
                                    echo "</td>";
                                    echo "<td>";
                                      echo "<strong>Articulo</strong>";
                                    echo "</td>";
                                    echo "<td>";
                                      echo "<strong>Precio</strong>";
                                    echo "</td>";
                                    echo "<td>";
                                      echo "<strong>Subtotal</strong>";
                                    echo "</td>";
                                  echo "</tr>";
                                for ($countMovi=0; $countMovi < $num_get_mov_cajaById; $countMovi++) 
                                { 
                                  $assoc_get_mov_cajaById           =   mysql_fetch_assoc($get_mov_cajaByIdVen);
                                  $precioFinalParaImpresionA = ($assoc_get_mov_cajaById['pre_cant']*$assoc_get_mov_cajaById['pre_iva'])/100;
                                  $precioFinalParaImpresion  = $assoc_get_mov_cajaById['pre_cant']+$precioFinalParaImpresionA;
                                  echo "<tr>";
                                      echo "<td>";
                                       echo $assoc_get_mov_cajaById['mov_cantidad'];
                                      echo "</td>";
                                      echo "<td>";
                                        echo $assoc_get_mov_cajaById['art_desc'];
                                      echo "</td>";
                                       echo "<td>";
                                        echo "$".$precioFinalParaImpresion;
                                      echo "</td>";
                                      echo "<td>";
                                        echo "$".$assoc_get_mov_cajaById['mov_sal'];
                                      echo "</td>";
                                  echo "</tr>";
                                  $totalSuma = $assoc_get_mov_cajaById['mov_sal']+$totalSuma;
                                  echo "<br>";
                                }
                                echo "</table>";

                                echo '<a href="impresion_TiketDeCaja.php?ID_ven='.$ID_venPenultima.'&ID_caj='.$ID_caj.'" target="_blank"><button class="btn btn-success" title="Imprimir" ><i class="material-icons">print</i></button></a>';

                                 echo "<hr>";
                                echo "<H4 style='text-align:right; margin-right:2%;'>TOTAL: $".$totalSuma."</H4>";

                            echo "</div>
                            </div>";

                              echo '<div class="container-fluid" id="VentaAntePenultima" style="display:none">
                             <div class="col-md-12">';
                                @$get_venta_AntepenultimaByIdCaja        =   $ventaE->get_venta_AntepenultimaByIdCaja($ID_caj);
                                @$assoc_get_venta_AntepenultimaByIdCaja  =   mysql_fetch_assoc($get_venta_AntepenultimaByIdCaja);
                                @$ID_venAntePenultima                    =   $assoc_get_venta_AntepenultimaByIdCaja['ID_ven'];
                                @$get_mov_cajaByIdVenB                   =   $mov_cajaE->get_mov_caja($ID_caj, $ID_venAntePenultima);
                                @$num_get_mov_cajaByIdB                  =   mysql_num_rows($get_mov_cajaByIdVenB);
                                @$totalSumaB                             =   0;
                                $precioFinalParaImpresionA               =   0;
                                echo "<table class='table table-striped table-hover' border='0' style='text-align:center; width=100%;'>";
                                  echo "<tr>";
                                    echo "<td>";
                                      echo "<strong>Cant.</strong>";
                                    echo "</td>";
                                    echo "<td>";
                                      echo "<strong>Articulo</strong>";
                                    echo "</td>";
                                    echo "<td>";
                                      echo "<strong>Precio</strong>";
                                    echo "</td>";
                                    echo "<td>";
                                      echo "<strong>Subtotal</strong>";
                                    echo "</td>";
                                  echo "</tr>";
                                for ($countMoviB=0; $countMoviB < $num_get_mov_cajaByIdB; $countMoviB++) 
                                { 
                                  $assoc_get_mov_cajaByIdB           =   mysql_fetch_assoc($get_mov_cajaByIdVenB);
                                   $precioFinalParaImpresionAA = ($assoc_get_mov_cajaById['pre_cant']*$assoc_get_mov_cajaById['pre_iva'])/100;
                                  $precioFinalParaImpresionA  = $assoc_get_mov_cajaById['pre_cant']+$precioFinalParaImpresionAA;
                                  echo "<tr>";
                                      echo "<td>";
                                       echo $assoc_get_mov_cajaByIdB['mov_cantidad'];
                                      echo "</td>";
                                      echo "<td>";
                                        echo $assoc_get_mov_cajaByIdB['art_desc'];
                                      echo "</td>";
                                       echo "<td>";
                                        echo "$".$precioFinalParaImpresionA;
                                      echo "</td>";
                                      echo "<td>";
                                        echo "$".$assoc_get_mov_cajaByIdB['mov_sal'];
                                      echo "</td>";
                                  echo "</tr>";
                                  $totalSumaB = $assoc_get_mov_cajaByIdB['mov_sal']+$totalSumaB;

                                  echo "<br>";
                                }
                                echo "</table>";

                                 echo '<a href="impresion_TiketDeCaja.php?ID_ven='.$ID_venAntePenultima.'&ID_caj='.$ID_caj.'" target="_blank"><button class="btn btn-success" title="Imprimir" ><i class="material-icons">print</i></button></a>';

                                 echo "<hr>";
                                echo "<H4 style='text-align:right; margin-right:2%;'>TOTAL: $".$totalSumaB."</H4>";

                            echo "</div>
                            </div>";
                  
                                if ($num_get_mov_cajaByIdB!=0)
                      {
                        echo '<button class="btn btn-primary" title="Una venta mas Atras" id="otraVenta" style="float:left"><i class="material-icons">arrow_back</i> Venta anterior</button>';

                         echo '<button class="btn btn-primary" title="Una venta mas Atras" id="VuelveVenta" style="float:left; display:none"><i class="material-icons">arrow_forward</i> Venta Siguiente</button>';
                     }
                             //Fin: Contenedor Invisible para imprimir  

                      
              echo '</div>';
                     
                 

                  
                            echo "<script>
                            $('#habilitarImpresion').click(function(){
                              $('#selectorDeImpresionDeTicket').toggle('fast');
                              $('#CerrarImpresion').toggle('fast');
                              $('#habilitarImpresion').toggle('fast');
                            });

                            $('#CerrarImpresion').click(function(){
                              $('#selectorDeImpresionDeTicket').toggle('fast');
                              $('#CerrarImpresion').toggle('fast');
                              $('#habilitarImpresion').toggle('fast');
                            });

                            $('#otraVenta').click(function(){
                              $('#VentaPenultima').toggle('slow');
                              $('#VentaAntePenultima').toggle('slow');
                              $('#VuelveVenta').toggle('slow');
                              $('#otraVenta').toggle('slow');
                            });
                             $('#VuelveVenta').click(function(){
                              $('#VentaPenultima').toggle('slow');
                              $('#VentaAntePenultima').toggle('slow');
                              $('#VuelveVenta').toggle('slow');
                              $('#otraVenta').toggle('slow');
                            });
                            </script>";


  ?>
  

      </div>
      <!--Inicio: Boton cerrar caja-->
      
    

  </div>
  <!--Fin: contenedor superior-->
  <!--Inicio: contenedor medio-->  
  <div class="col-md-12" id="recuadros">
  		<!--Inicio: Articulos vendidos--> 
  		<div class="col-md-8">
  			<!--Inicio: Articulos vendidos detalle--> 
  			<div class="col-md-12">
          <?php
         
    /* Inicio Modal Cierre Caja */                          
    echo '<div class="modal fade" id="CerrarCaja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Cerrar Caja</h4>
                  </div>
                  <div class="modal-body">
                    <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="pto_asig">Ingrese Gatos</label>
                      <input type="text" name="caj_cierre" placeholder="00.00" class="form-control">
                      <input hidden type="text" name="action" value="cerrarCaja">
                      <input hidden type="text" name="ID_caj" value="'.$ID_caj.'">
                    </div>

                       <div class="form-group">
                          <label>Adjunte Comprobantes de Gastos</label>
                         
                                  <input class="form-control" name="adj_ruta[]" type="file" multiple>
                             
                        
                      </div>

                    
                    <div class="form-group">
                      <label for="pto_asig">Ingrese Efectivo</label>
                      <input type="text" name="caj_efectivo" id="caj_efectivo" placeholder="00.00" class="form-control" required>
                    </div>';

                    $get_caja_totalEfectivo=$cajaE->get_caja_totalEfectivo($ID_caj);
                    $assoc_get_caja_totalEfectivo=mysql_fetch_assoc($get_caja_totalEfectivo);
                    $totalEfectivo=$assoc_get_caja_totalEfectivo['TotalEfectivo'];

                    if ($_SESSION['usu_sobrantes']==1)
                    {
                      echo '<div class="alert alert-dismissible alert-info">
                              <strong><i class="material-icons">attach_money</i> Efectivo que deberia haber en caja $'.$totalEfectivo.'</strong>
                            </div>';

                             echo '<div id="sobrante" class="alert alert-dismissible alert-success" style="display:none">
                              <strong><i class="material-icons">thumb_up</i> Se registran $ <input type="text" class="no-borderSuccess" id="inputsobrante"> Sobrantes en caja</strong>
                            </div>';

                            echo '<div id="faltante" class="alert alert-dismissible alert-danger" style="display:none">
                              <strong><i class="material-icons">thumb_down</i> Se registran $ <input type="text" class="no-borderDanger" id="inputfaltante">Faltantes en caja</strong>
                            </div>';

                              echo '<div id="cero" class="alert alert-dismissible alert-warning" style="display:none">
                              <strong><i class="material-icons">thumb_up</i>Felicidades! La caja no registra faltantes ni sobrantes. </strong>
                            </div>';

                            echo "<script>
                                    $('#caj_efectivo').keyup(function(){
                                      var efectivoReal=$('#caj_efectivo').val();
                                      var totalEfectivo=".$totalEfectivo.";
                                      var restaEfectivoCaja=efectivoReal-totalEfectivo;
                                      if(restaEfectivoCaja==0)
                                      {
                                        $('#cero').fadeIn('500');
                                      }
                                      else
                                      {
                                        $('#cero').fadeOut('500');
                                      } 
                                        if(restaEfectivoCaja>=1)
                                      {
                                        $('#sobrante').fadeIn('500');
                                        $('#inputsobrante').val(restaEfectivoCaja);
                                      }
                                      else
                                      {
                                        $('#sobrante').fadeOut('500');
                                      }  
                                        if(restaEfectivoCaja<=-1)
                                      {
                                        $('#faltante').fadeIn('500');
                                        $('#inputfaltante').val(restaEfectivoCaja);
                                      }
                                      else
                                      {
                                        $('#faltante').fadeOut('500');
                                      }    
                                    });
                              </script>";
                    }


                    
            echo '</div>
                  <div class="modal-footer">
                    <button class="btn btn-success" type="submit" style="width:100%;"><i class="material-icons" style="vertical-align: middle">assignment_ind</i> Cerrar</button>
                  </div>
                    </form>
                </div>
              </div>
            </div>';
        /* Fin Modal Cierre Caja */




  echo '<div id="respuesta_tabla_detalles_movimientos"></div>';



?>

</div>

  			<!--Inicio: Articulos vendidos totales--> 
  			<div class="col-md-12" id="recuadrosC">
  			   <div id="respuesta_tabla_totales_movimientos"></div>
        </div>
  			<!--Fin: Articulos vendidos totales--> 

        <buttom style='margin:1%;' class='btn btn-primary btn-sm' id='ActualizarTablaDetalles'><i class='material-icons' style='font-size:12px;'>refresh</i></buttom>

      
    <div id='referencias' style="text-align: left; width: 50%;">
      <ul>
        <li>Flecha abajo: Posiciona el cursor sobre el selector de formas de pago</li>
        <li>Barra: presiona botón</li>
        <li>Ctrl: Posiciona el cursor sobre el buscador de artículos</li>
        <li>Shift: Posiciona el cursor sobre la cantidad de artículos</li> 
        <li>F8: Cobro total o parcial</li> 
        <li>F9: Guardar venta</li> 
      </ul>
    </div>


	  	</div>
	  	<!--Fin: Articulos vendidos--> 
	  	<!--Inicio: cuadro de acciones-->
     
	  	<div class="col-md-4" id="recuadrosC">
          <div id="respuesta_tabla_pagos_movimientos"></div>
      </div>
    
   <!--Fin: contenedor medio-->
  </div>
<!--Fin: Contenedor principal -->

<script>
    
          $('#get_articulos').keyup(function()
            {
              
              var get_articulos = $(this).val();   
              var get_cantidad = $('input:text[name=get_cantidad]').val();
              var ID_ven = $('input:text[name=ID_ven]').val();
              var dataString = 'get_articulos='+get_articulos + '&get_cantidad='+get_cantidad + '&ID_ven='+ID_ven;
              $.ajax(
              {
                  type: 'POST',
                  url: 'autocompletadoUniversalArticulos.php',
                  data: dataString,
                  success: function(data)
                   {
                      $('#suggestions').fadeIn(1000).html(data);
                      
                     
                   }
               });
           });



</script>


<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 

 

  echo "<script>
          $(document).ready(function()
            {
              var ID_caj = '".$ID_caj."';  
              var dataString = 'ID_caj='+ID_caj ;

              $.ajax(
              {
                  type: 'POST',
                  url: 'tabla_detalles_movimientos.php',
                  data: dataString,
                  success: function(data)
                   {
                      $('#respuesta_tabla_detalles_movimientos').fadeIn(1000).html(data);
                      
                   }
               });

                 $.ajax(
              {
                  type: 'POST',
                  url: 'tabla_totales_movimientos.php',
                  data: dataString,
                  success: function(data)
                   {
                      $('#respuesta_tabla_totales_movimientos').fadeIn(1000).html(data);
                      
                   }
               });
                $.ajax(
              {
                  type: 'POST',
                  url: 'tabla_pagos_movimientos.php',
                  data: dataString,
                  success: function(data)
                   {
                      $('#respuesta_tabla_pagos_movimientos').fadeIn(1000).html(data);
                      
                   }
               });
           });

  </script>";

 echo "<script>
          $('#ActualizarTablaDetalles').click(function()
            {
              var ID_caj = '".$ID_caj."';  
              
              var dataString = 'ID_caj='+ID_caj ;
              $.ajax(
              {
                  type: 'POST',
                  url: 'tabla_detalles_movimientos.php',
                  data: dataString,
                  success: function(data)
                   {
                      $('#respuesta_tabla_detalles_movimientos').fadeIn(1000).html(data);
                      
                   }
               });
                 $.ajax(
              {
                  type: 'POST',
                  url: 'tabla_totales_movimientos.php',
                  data: dataString,
                  success: function(data)
                   {
                      $('#respuesta_tabla_totales_movimientos').fadeIn(1000).html(data);
                      
                   }
               });
                   $.ajax(
              {
                  type: 'POST',
                  url: 'tabla_pagos_movimientos.php',
                  data: dataString,
                  success: function(data)
                   {
                      $('#respuesta_tabla_pagos_movimientos').fadeIn(1000).html(data);
                      
                   }
               });
           });

  </script>";
?>
<!--Fin: Footer -->
<!--Inicio: script -->



 <script type='text/javascript'>

      


            


                $('#tipoDePago1').click(function(){
                  $('#ContenidoA1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                });

                $('#tipoDePago2').click(function(){
                  $('#ContenidoB1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                });

                $('#tipoDePago3').click(function(){
                  $('#ContenidoC1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                });

                $('#VolverAprincipal').click(function(){
                  $('#ContenidoA1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                });

                 $('#VolverAprincipalB').click(function(){
                  $('#ContenidoB1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                });

                   $('#VolverAprincipalC').click(function(){
                  $('#ContenidoC1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                });
                

       


             $('#fomularioEfectivo').keyup(function(){
            var MontoEfectivo = $('input:text[name=MontoEfectivo]').val();
            var ven_total = $('input:text[name=ven_total]').val();
            var action = 'Efectivo';
            var dataString = 'MontoEfectivo='+MontoEfectivo + '&action='+action + '&ven_total='+ven_total;
            $.ajax({
              url: 'accionesExclusivas.php',
              type: 'POST',
              data: dataString,
                   success: function(data)
                   {
                      $('#suggestionsA1').fadeIn(2000).html(data);
                   }
            })
            .done(function(){
               $('#finalizarVentaEfectivo').fadeIn(3000);
            })
            .fail(function(){
              
            })
            .always(function(){
                
            })
          });


  $( "#get_cantidad" ).blur(function() {
   
       var get_cantidad = $('input:text[name=get_cantidad]').val();
        if (get_cantidad>=2) {

        }
        else
         {
            $("#get_cantidad").val( "1" );
         } 
   
  });
  

 
    $('#file-es').fileinput({
        showUpload: false,
        overwriteInitial: false,
        showDownload: false,
        showZoom: false,
        showDrag: false,
        theme: 'fa',
        language: 'es',
        uploadUrl: '#',
        allowedFileExtensions: ['jpg', 'png', 'gif']
         
    });
     $(document).keydown(function(tecla){ 
    if (tecla.keyCode == 16) { 
                  $( "#get_cantidad" ).focus();
                  $("#get_cantidad").val("");
    } 


       if (tecla.keyCode == 17) { 
                  $( "#get_articulos" ).focus();
    }  });
 </script> 





      <!--////////////////////////////////////// F I N  N U E V O   C O M P R O B A N T E ///////////////////////////////////-->
<!--Fin: script -->