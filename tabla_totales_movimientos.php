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
?>
        <!--Inicio: Articulos vendidos total--> 
          <div class="col-md-2" style="text-align: left; border-right: 1px solid #000">
          TOTAL: 
          </div>
          <!--Fin: Articulos vendidos total-->
          
          <!--COLOCA EN EL TOTAL EL PRECIO NETO QUE ES EL PRECIO SIN IVA-->
          <div class="col-md-2" style="text-align: center;">
            <?php 
              $get_mov_cajaByIdVenXX                =   $mov_cajaE->get_mov_caja($ID_caj, $ID_ven);
              $num_get_mov_cajaByIdXX               =   mysql_num_rows($get_mov_cajaByIdVenXX);
              $ven_totalSinIva=0;
              $totalSinDescuentoAZ=0;
              for ($CountPrecioNeto=0; $CountPrecioNeto < $num_get_mov_cajaByIdXX; $CountPrecioNeto++) 
              { 
                $assoc_get_mov_cajaByIdXX           =   mysql_fetch_assoc($get_mov_cajaByIdVenXX);
                $totalSinDescuentoAZ                = $totalSinDescuentoAZ+$assoc_get_mov_cajaByIdXX['mov_sal'];
                $ven_totalSinIva                    = $ven_totalSinIva+$assoc_get_mov_cajaByIdXX['precioSinIva'];
              }
              echo "$ ". $ven_totalSinIva;
              echo "<p style='font-size:9px;'>GRABADO</p>";
            ?>
          </div>

          <!--Inicio: Articulos vendidos monto total-->
          <div class="col-md-2" style="text-align: center;">
            <?php 
              //sin descuento
                  echo "$ ".$totalSinDescuentoAZ; 
                  echo "<p style='font-size:9px;'>SUBTOTAL</p>";
            ?>
          </div>
          <div class="col-md-2" style="text-align: center;">
            <?php 
              echo "% ".$assoc_get_venta_UltimaByIdCaja['ven_descuento']; 
                $descuento=$assoc_get_venta_UltimaByIdCaja['ven_descuento'];
                echo "<p style='font-size:9px;'>DESCUENTO</p>";
            ?>
          </div>
            <div class="col-md-2" style="text-align: center;">
            <?php 
              echo "$ ".$assoc_get_venta_UltimaByIdCaja['ven_total'];
              echo "<p style='font-size:9px;'>FINAL</p>"; 
            ?>
          </div>
          <div class="col-md-2" style="text-align: center;">
           <button class="btn btn-primary" d="botonDescuentoVenta" data-toggle="modal" title="Aplicar descuento al total de la venta" data-placement="top" data-target="#botonDescuentoVenta">
               <i class="material-icons">local_offer</i>
             </button>      
          <!--Fin: Articulos vendidos monto total-->
        </div>

