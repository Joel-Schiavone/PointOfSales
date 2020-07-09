<?php 
include_once('inc/conectar.php');
include_once('inc/classes.php');
include_once('inc/classesExclusivas.php');
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
$ID_caj=$_POST['ID_caj'];   
   $get_venta_UltimaByIdCaja =$ventaE->get_venta_UltimaByIdCaja($ID_caj);
          $assoc_get_venta_UltimaByIdCaja=mysql_fetch_assoc($get_venta_UltimaByIdCaja);
          $ID_ven    = $assoc_get_venta_UltimaByIdCaja['ID_ven'];
           $descuento=$assoc_get_venta_UltimaByIdCaja['ven_descuento'];
 $get_mov_caja=$mov_cajaE->get_mov_caja($ID_caj, $ID_ven);
             @$num_get_mov_caja=mysql_num_rows($get_mov_caja);


        if ($num_get_mov_caja>=1) 
        {
          ?>
            <div class="col-md-12" style="border-bottom:2px solid #333;">
              <form action='accionesExclusivas.php' method='POST'>
                  <!--Accion-->
                  <input hidden type="text" name="action" value="InsertMovimientosVentas">
                   <!--Total de la venta-->
                  <input hidden type="text" name="VentaTotal" value="<?php echo $assoc_get_venta_UltimaByIdCaja['ven_total'];?>">
                  <!--ID de la venta-->
                  <input hidden type="text" name="ID_ven" value="<?php echo $ID_ven;?>">


                <!--Remodifica el maximo permitido segun el restando que va quedando en el input-->
                <?php 
                      $get_venta_detalleSumatoria=$venta_detalleE->get_venta_detalleSumatoria($ID_ven);
                      $assoc_get_venta_detalleSumatoria=mysql_fetch_assoc($get_venta_detalleSumatoria);
                      if ($assoc_get_venta_detalleSumatoria['resto']!=NULL) 
                      {
                        
                        $resto=$assoc_get_venta_UltimaByIdCaja['ven_total']-$assoc_get_venta_detalleSumatoria['resto'];
                      }
                      else
                      {
                        $resto=$assoc_get_venta_UltimaByIdCaja['ven_total'];
                      }  
                ?>
  

                <div id="montoApagarInput" class="col-md-6">
                    <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">$</span>
                            <input type="number" id='montoTotal' name='montoTotal' class='form-control' min="1" max="<?php echo $resto;?>" value="<?php echo $assoc_get_venta_UltimaByIdCaja['ven_total'];?>" step=".01" style="width:100%;">
                        </div>
                      </div>
                </div>  

                 <div id="montoApagarSelect" class="col-md-6">
                          <select class='form-control' name='FormaDePago' id='FormaDePago'>
                            <?php
                              $get_tipos_pagos=$tipos_pagosE->get_tipos_pagos();
                              $num_get_tipos_pagos=mysql_num_rows($get_tipos_pagos);
                              for ($Countnum_get_tipos_pagos=0; $Countnum_get_tipos_pagos < $num_get_tipos_pagos; $Countnum_get_tipos_pagos++)
                              { 
                                   $assoc_get_tipos_pagos=mysql_fetch_assoc($get_tipos_pagos);

                                   //Aplicar selected prederterminado en select (revisar columna fpo_selected de tabla tipos_pagos)
                                   if ($assoc_get_tipos_pagos['fpo_selected']==1) 
                                   {
                                    $selected="selected";
                                    $ID_selected=$assoc_get_tipos_pagos['ID_fpo'];
                                   }
                                   else
                                   {
                                    $selected="";
                                   } 

                                   echo "<option value='".$assoc_get_tipos_pagos['ID_fpo']."' ".$selected.">".$assoc_get_tipos_pagos['ID_desc']."</option>";
                              }

                               
                            ?>
                            <option value="5">PAGOS ELECTRONICOS</option>
                          </select>
                </div>     
             
                <div id="detalleDeVenta" class="col-md-12" style="font-size: 13px;">
                  <?php

                    $get_venta_detalleById=$venta_detalleE->get_venta_detalleById($ID_ven);
                    $num_get_venta_detalleById=mysql_num_rows($get_venta_detalleById);
                    $sumaDeDetallesDeVenta=0;
                    for ($countDetalleDeVenta=0; $countDetalleDeVenta < $num_get_venta_detalleById; $countDetalleDeVenta++) 
                    { 
                      $assoc_get_venta_detalleById=mysql_fetch_assoc($get_venta_detalleById);
                      $ID_vde=$assoc_get_venta_detalleById['ID_vde'];
                      $montoTotalConInteresA=($assoc_get_venta_detalleById['fpo_monto']*$assoc_get_venta_detalleById['tarjeta_pla_recargo'])/100;
                      $montoTotalConInteres=$assoc_get_venta_detalleById['fpo_monto']+$montoTotalConInteresA;
                       echo '<div id="detalleDeVentaIcono'.$ID_vde.'" class="col-md-2">';
                        echo "<p class='text-danger'><i class='material-icons'>". $assoc_get_venta_detalleById['fpo_icono'] ."</i></p>";
                      echo '</div>';  
                      echo '<div id="detalleDeVentaTipo'.$ID_vde.'" class="col-md-4">';
                        echo "<p class='text-danger'>". $assoc_get_venta_detalleById['ID_desc'] ."</p>";
                      echo '</div>';  
                      echo '<div id="detalleDeVentaMonto'.$ID_vde.'" class="col-md-4">';
                        echo "<p class='text-danger'>$ ".$montoTotalConInteres."</p>";
                      echo '</div>';  
                      echo '<div id="detalleDeVentaEliminar'.$ID_vde.'" class="col-md-2" style="cursor:pointer">';
                        echo '<a href="accionesExclusivas.php?action=EliminarDetalleDeVenta&ID_vde='.$ID_vde.'&ID_fpo='.$assoc_get_venta_detalleById['ID_fpo'].'&fpo_monto='.$assoc_get_venta_detalleById['fpo_monto'].'&vde_IDasociado='.$assoc_get_venta_detalleById['vde_IDasociado'].'"><p class="text-danger"><i class="material-icons">delete_forever</i></p></a>';
                       echo '</div>'; 
                         $sumaDeDetallesDeVenta=$sumaDeDetallesDeVenta+$assoc_get_venta_detalleById['fpo_monto'];
                    }

                  ?>
                </div>

  

          <div id="montoApagarSelect" class="col-md-12">

                       
            <?php
                          $totaSinDecimales=round($resto);

                            //EFECTIVO
                              echo '<div id="DivFormaDePago1" class="col-md-12" style="display: none;">';
                                  echo "<br>";
                                    echo  "EFECTIVO";
                                    echo  '<div class="form-group">
                                            <label class="control-label" style="font-size:13px; text-align:left">Calculador de Cambio</label>
                                            <div class="input-group">
                                              <span class="input-group-addon">$</span>
                                              <input type="number" id="CalcularVuelto" name="CalcularVuelto" class="form-control" min="1" value="" step=".01" style="width:100%;">
                                            </div>
                                          </div>';
                                    echo "<div id='suggestionsA1' style='dsplay:none'></div>";
                                    echo "<br>";
                              echo '</div>';

                            //CTA CTE
                              echo '<div id="DivFormaDePago2" class="col-md-12" style="display: none;">';
                                    echo "<br>";
                                    echo  "CUENTA CORRIENTE";
                                    echo '<div class="col-md-12" id="ContenidoB1"> 
                                     <div class="col-md-12"> 
                                        <input type="text" name="get_clientes" id="get_clientes" class="form-control" placeholder="Buscar Clientes" autofocus="autofocus">
                                         <input  hidden type="text" name="ven_totalClientes" id="ven_totalClientes"  value="'.$assoc_get_venta_UltimaByIdCaja['ven_total'].'">
                                         <input  hidden type="text" name="ID_venClientes" id="ID_venClientes" value="<?php echo $ID_ven;?>">
                                          <input  hidden type="text" name="ID_cajClientes" id="ID_cajClientes" value="<?php echo $ID_caj;?>">

                                        <div id="suggestionsClientes" class="suggestions"></div>
                                     </div> 
                             
                                     </div> '; 
                                    echo "<br>";
                              echo '</div>';

                             //CREDITO
                              echo '<div id="DivFormaDePago3" class="col-md-12" style="display: none;">';
                                    echo "<br>";
                                    echo  "CRÉDITO Y DÉBITO";
                                    echo "<br>";
                                    echo '<div class="col-md-12" id="ContenidoC1"> 

                                                      
                                                       <div class="col-md-12">'; 
                                                            $get_tarjetas = $tarjetas->get_tarjetas();
                                                            $num_get_tarjetas = mysql_num_rows($get_tarjetas);
                                                            $ven_total=$resto;
                                                            for ($tarjetasCount=0; $tarjetasCount < $num_get_tarjetas; $tarjetasCount++) 
                                                            { 
                                                               $assoc_get_tarjetas = mysql_fetch_assoc($get_tarjetas); 
                                                               $ImagenTarjeta=$assoc_get_tarjetas['tar_logo'];
                                                              echo "<div class='col-md-6' style='padding:2%;' id='MuestraTarjetas'>";
                                                                 echo "<img src='".$ImagenTarjeta."' style='width:80%;' id='tarjeta".$assoc_get_tarjetas['ID_tar']."'>"; 
                                                              echo "</div>"; 

                                                                  echo "<div class='col-md-12' id='MuestraPlanes".$assoc_get_tarjetas['ID_tar']."' style='display:none; padding:2%;'>"; 
                                                                        $ID_tar=$assoc_get_tarjetas['ID_tar']; 
                                                                          echo "<br>";
                                                                             /*
                                                                             echo $get_tarjetas_planesById = $tarjetas_planesE->get_tarjetas_planesById($ID_tar, $ven_total);
                                                                              */

                                                                             $getPlanesTarjetasByIdTar=$tarjetas_planesE->getPlanesTarjetasByIdTar($ID_tar);
                                                                             $num_getPlanesTarjetasByIdTar=mysql_num_rows($getPlanesTarjetasByIdTar);

                                                                             for ($countPlanes=0; $countPlanes <  $num_getPlanesTarjetasByIdTar; $countPlanes++) 
                                                                             { 
                                                                               $assoc_result_tarjetas_planes=mysql_fetch_assoc($getPlanesTarjetasByIdTar);
                                                                                $ven_total=$ven_total;
                                                                                $pla_cant=$assoc_result_tarjetas_planes['pla_cant'];
                                                                                $recargo=$assoc_result_tarjetas_planes['pla_recargo'];
                                                                                $ID_pla=$assoc_result_tarjetas_planes['ID_pla'];
                                                                                $totalConInteresA=($ven_total*$recargo)/100;
                                                                                $totalConInteres=$ven_total+$totalConInteresA;
                                                                                $totalConInteres=number_format($totalConInteres,2);
                                                                                $valorDeCuotas=$totalConInteres/$pla_cant;
                                                                                $valorDeCuotas=number_format($valorDeCuotas,2);
                                                                                 echo "<div class='col-md-12' style='text-align:left;'>";
                                                                                echo "<p><input type='radio' name='ID_pla' value='".$assoc_result_tarjetas_planes['ID_pla']."'>
                                                                                    ".$assoc_result_tarjetas_planes['pla_desc']." (".$assoc_result_tarjetas_planes['pla_recargo']."%) </p>
                                                                                    <p><h6> Cuotas de $ ".$valorDeCuotas." <h6></p>
                                                                                    <p><h6> Total: $ ".$totalConInteres." <h6></p><hr>";
                                                                                echo "</div>"; 
                                                                             }
                                                                             echo '<br><br><div id="EfectivoTarjeta'.$assoc_result_tarjetas_planes['ID_tar'].'" style="display:none; margin:3%;" class="input-group">
                                                                              <span class="input-group-addon">Monto En Efectivo $</span>
                                                                              <input type="text" name="efectivo" placeholder="00.00" class="form-control">
                                                                          
                                                                            </div>';

                                                                              echo '<input hidden type="text" name="ven_totalTarjeta" id="ven_totalTarjeta"  value="'.$totalConInteres.'">';
                                                                             echo '<input hidden type="text" name="ID_tar" id="ID_tar" value="'.$assoc_get_tarjetas['ID_tar'].'">';
                                                                              
                                                                   echo "</div>";  

                                                               echo "<script>
                                                               $('#tarjeta".$assoc_get_tarjetas['ID_tar']."').click(function(){
                                                                $('#MuestraPlanes".$assoc_get_tarjetas['ID_tar']."').toggle('slow');
                                                               });
                                                               </script>";

                                                            }
                                                  echo '</div> 
                                               
                                                       </div>'; 
                              echo '</div>';  

                            

                              //DEBITO
                              echo '<div id="DivFormaDePago5" class="col-md-12" style="display: none;">';
                                    echo "<br>";
                                    echo  "PAGOS ELECTRONICOS";
                                    echo "<br>";
                                    echo '<div class="alert alert-dismissible alert-info">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong><H4>DISPONIBLES PROXIMAMENTE !</H4></strong>
                                          </div>';
                              echo '</div>';   

                               echo '<script>
                                      $("#FormaDePago").change(function(){
                                        var valorDeFormaDePago = $("#FormaDePago").val();
                                        if(valorDeFormaDePago==1)
                                        {
                                          $("#DivFormaDePago1").fadeIn(500);
                                        }
                                        else
                                        {
                                          $("#DivFormaDePago1").fadeOut(500);
                                        }   

                                        if(valorDeFormaDePago==2)
                                        {
                                          $("#DivFormaDePago2").fadeIn(500);
                                        }
                                        else
                                        {
                                          $("#DivFormaDePago2").fadeOut(500);
                                        }   

                                        if(valorDeFormaDePago==3)
                                        {

                                          $("#DivFormaDePago3").fadeIn(500);
                                            $("#montoTotal").attr("readonly", "readonly");
                                        }
                                        else
                                        {
                                          $("#DivFormaDePago3").fadeOut(500);
                                           $("#montoTotal").removeAttr("readonly", "readonly");
                                        }   

                                        if(valorDeFormaDePago==4)
                                        {
                                          $("#DivFormaDePago4").fadeIn(500);
                                        }
                                        else
                                        {
                                          $("#DivFormaDePago4").fadeOut(500);
                                           
                                        }   

                                        if(valorDeFormaDePago==5)
                                        {
                                          $("#DivFormaDePago5").fadeIn(500);

                                        }
                                        else
                                        {
                                          $("#DivFormaDePago5").fadeOut(500);
                                        }                                           

                                      });
                              </script>';
                          
                                 
                          //SELECCIONADO
                          //Aplicar selected prederterminado en el contenido (revisar columna fpo_selected de tabla tipos_pagos)
                                    echo '<script>
                                            $(document).ready(function(){
                                              var valorDeFormaDePago = '.$ID_selected.';
                                                $("#DivFormaDePago'.$ID_selected.'").fadeIn(500);
                                            });
                                          </script>';  

                           //replicar valor de pago en calculador de vuelto
                                    echo '<script>
                                           $("#montoTotal").keyup(function(){
                                              var montoTotal=$("#montoTotal").val();
                                              $("#CalcularVuelto").val(montoTotal);
                                            });
                                          </script>';  


                            //Cambia el nombre del boton COBRO TOTAL a COBRO PARCIAL SI EL MONTO ES MENOR AL TOTAL DE LA VENTA     
                             echo '<script>
                                            $("#montoTotal").keyup(function(){
                                              var montoTotal = $("#montoTotal").val();
                                             if (montoTotal>="'.$resto.'" || montoTotal>="'.$totaSinDecimales.'") 
                                             {
                                              var textoDeBoton = $("#textoDeBoton").val();
                                              $("#textoDeBoton").text("COBRO TOTAL");
                                             }
                                             else
                                            {
                                              $("#textoDeBoton").text("COBRO PARCIAL");
                                            }
                                      });
                               </script>';

                              //Calcula y muestra el vuelto si la seleccion de pago es Efectivo
                                  echo "<script>$('#CalcularVuelto').keyup(function(){
                                      var MontoEfectivo =$('#CalcularVuelto').val();
                                      var ven_total = ".$resto.";
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
                                    }); </script>";
                                       echo "<script>$('#montoTotal').keyup(function(){
                                      var MontoEfectivo =$('#montoTotal').val();
                                      var ven_total = ".$resto.";
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
                                    }); </script>";
                                    if ($sumaDeDetallesDeVenta<=$assoc_get_venta_UltimaByIdCaja['ven_total']) 
                        {
                          //Aparece boton guardar venta y desaparece casilla de monto
                          if ($sumaDeDetallesDeVenta==$assoc_get_venta_UltimaByIdCaja['ven_total'])
                          {
                            echo "<script> $(document).ready(function(){
                                                $('#botonGuardarVenta').fadeIn(500);
                                                $('#montoTotal').fadeOut(500);
                                                $('#DivFormaDePago".$ID_selected."').fadeOut(500);
                                                $('#montoApagarSelectBoton').fadeOut(500);
                                              });</script>";
                          }
                          //coloca resto para alcanzar el total de la compra 
                          else
                          {
                             $restoDeDetallesDeVentas=$assoc_get_venta_UltimaByIdCaja['ven_total']-$sumaDeDetallesDeVenta;
                                echo "<script>
                                          $(document).ready(function(){
                                            $('#montoTotal').val(".$restoDeDetallesDeVentas.");
                                            $('#CalcularVuelto').val(".$restoDeDetallesDeVentas.");
                                            this.max = ".$restoDeDetallesDeVentas.";
                                          });
                                </script>";
                          } 
                         
                        }  

                        ?>
  
                      </div>

                   <div id="montoApagarSelectBoton" class="col-md-12" style="margin-top: 5%; ">
                    <div class="form-group">
                         <button type="submit" class="btn btn-success" id="cobroTotal"><p id="textoDeBoton">COBRO TOTAL</p></button>
                      </div>
                </div>
              </form>
            </div>    
           
              <br>
            <div class='col-md-12' style="border-top:2px solid #333;">
              <br>
              <?php 
                 
                  

                echo "<a href='accionesExclusivas.php?ID_ven=".$ID_ven."&action=CerrarVenta&ID_caj=".$ID_caj."&ven_descuento=".$descuento."&ID_pla=".$ID_pla."'>
                        <button class='btn btn-warning' id='botonGuardarVenta' style='display: none;'>
                            <i class='material-icons'>save</i> 
                            GUARDAR VENTA
                        </button>
                    </a>";
              ?>
            </div>
            <?php
      } 
      else
      {
        echo '<div class="well">
                <i class="material-icons">sentiment_neutral</i> Aguardando ventas
              </div>';
      }



?>

<script>
      $(document).keydown(function(tecla){ 
    if (tecla.keyCode == 40) { 
           $('#FormaDePago').attr('size',$('#FormaDePago option').length);
            $('#FormaDePago').focus().select();
    }   

     });   


    $(document).keydown(function(tecla){ 
      if (tecla.keyCode == 120) { 
            $('#botonGuardarVenta').click();
      }   
     });   


    $(document).keydown(function(tecla){ 
      if (tecla.keyCode == 119) { 
            $('#cobroTotal').click();
      }   
     });   

    $('#FormaDePago').change(function() {
      $( "select option:selected" ).each(function() {
       var formaPago = $('#FormaDePago').val();
       if(formaPago==1)
       {
        $('#montoTotal').focus();
       }
        if(formaPago==2)
       {
        $('#montoTotal').focus();
       }
        if(formaPago==3)
       {
        $('#montoTotal').focus();
       }
              if(formaPago==5)
       {
        $('#montoTotal').focus();
       }
    });
  })

$('#montoTotal').keypress(function(){
  $('#CalcularVuelto').fadeOut(500);
});


$('#get_clientes').keyup(function()
            {
              var get_clientes = $(this).val();   
              
              var action = 'Get_clientes';
              var ven_totalClientes = $('input:text[name=ven_totalClientes]').val();
              var ID_venClientes = $('input:text[name=ID_venClientes]').val();
              var ID_cajClientes = $('input:text[name=ID_cajClientes]').val();
              
              var dataString = 'get_clientes='+get_clientes + '&action='+action + '&ven_totalClientes='+ven_totalClientes + '&ID_venClientes='+ID_venClientes + '&ID_caj='+ID_cajClientes;
              $.ajax(
              {
                  type: 'POST',
                  url: 'accionesExclusivas.php',
                  data: dataString,
                  success: function(data)
                   {
                      $('#suggestionsClientes').fadeIn(1000).html(data);
                   }
               });
           }); 

      /*   $(document).keydown(function(tecla){ 
    if (tecla.keyCode == 118) { 
         $('#ContenidoA1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                  $('#ContenidoB1').css('display', 'none');
                  $( "#CalcularVuelto" ).focus();
    } 
    if (tecla.keyCode == 119) { 
         $('#ContenidoB1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                   $('#ContenidoA1').css('display', 'none');
                   $( "#get_clientes" ).focus();
    } 
     if (tecla.keyCode == 120) { 
         $('#ContenidoC1').toggle('slow');
                  $('#ContenidoA').toggle('slow');
                  $( "#radioTrjeta" ).focus();
    } 
 

   
   
});*/
</script>