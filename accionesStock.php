<?php
session_start();
include_once('inc/conectar.php');
include_once('inc/classes.php');
include_once('inc/classesExclusivas.php');
$ID_usu             = $_SESSION['ID_usu'];
$usu_usuario        = $_SESSION['usu_usuario'];
$usu_clave          = $_SESSION['usu_clave'];
$usu_tipo           = $_SESSION['usu_tipo'];
$fechaDeHoy         = date("Y-m-d");
$HoraDeHoy          = date("H:i:s");
$FechayHora         = date("Y-m-d H:i:s");
$sucursales         = new sucursales;
$sucursalesE        = new sucursalesE;
$articulosE         = new articulosE;
$articulos          = new articulos;
$mensajes           = new mensajes;
$stockE             = new stockE;
$stock              = new stock;
$preciosE           = new preciosE;
$precios            = new precios;
@$action            = $_POST['action'];
@$atras             = $_SESSION['actionsBack'];
?>
 <!-- Inicio: Estilos Generales-->
  <link href="css/generales.css" rel="stylesheet"> 
 <!-- Fin: Estilos Generales-->
 <style type="text/css">
   td
   {
    text-align: center;
   }
   th
   {
    text-align: center;
   }
 </style>
<?php
  if($action=="listarArticulos")
  {
    echo '<table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th><i class="material-icons">receipt</i> Código</th>
                <th><i class="material-icons">loyalty</i> Artículo</th>
                <th><i class="material-icons">storage</i> Stock</th>
              </tr>
            </thead>
            <tbody>';
    $get_stock=$stockE->get_stock();
    $num_listarArticulos=mysql_num_rows($get_stock);
    for ($countArticulos=0; $countArticulos < $num_listarArticulos; $countArticulos++) 
    { 
       $assoc_listarArticulos=mysql_fetch_assoc($get_stock);
       $ID_art=$assoc_listarArticulos['ID_art'];
       $get_stockBySoloIdArtUltimo=$stockE->get_stockBySoloIdArtUltimo($ID_art);
       $assoc_get_stockBySoloIdArtUltimo=mysql_fetch_assoc($get_stockBySoloIdArtUltimo);

    echo '<tr>
            <td>'.$assoc_listarArticulos['art_cod'].'</td>
            <td>'.$assoc_listarArticulos['art_desc'].'</td>
            <td>'.$assoc_get_stockBySoloIdArtUltimo['sto_total'].'</td>
          </tr>';
    
  
    }
   echo '</tbody>
          </table> ';

  }
  if($action=="listarArticulosPorCategoria")
  {
    $ID_sub=$_POST['ID_sub'];
    echo '<table id="listadoArticulosStock" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th><i class="material-icons">receipt</i> Código</th>
                <th><i class="material-icons">loyalty</i> Artículo</th>
                <th><i class="material-icons">storage</i> Stock</th>
              </tr>
            </thead>
            <tbody>';
    $get_stockByIdSub=$stockE->get_stockByIdSub($ID_sub);
    $num_get_stockByIdSub=mysql_num_rows($get_stockByIdSub);
    for ($countArticulos=0; $countArticulos < $num_get_stockByIdSub; $countArticulos++) 
    { 
       $assoc_listarArticulos=mysql_fetch_assoc($get_stockByIdSub);
       $ID_art=$assoc_listarArticulos['ID_art'];
       $sto_total= $get_stockBySoloIdArtUltimo=$stockE->get_stockBySoloIdArtUltimo($ID_art);


    echo '<tr>
            <td>'.$assoc_listarArticulos['art_cod'].'</td>
            <td>'.$assoc_listarArticulos['art_desc'].'</td>
            <td>'.$sto_total.'</td>
          </tr>';
    
  
    }


   echo '</tbody>
          </table> ';


   echo "<script type='text/javascript'>

  $(document).ready( function () {
    $('#listadoArticulosStock').DataTable({
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

   </script>";

  }


  if ($action=='cargarArticulo')
  {
    $cantidad             = $_POST['cantidad'];
    $codigo               = $_POST['codigoArticulo'];
    $ID_suc               = $_POST['ID_suc'];
    $pre_neto             = $_POST['pre_neto'];
    $pre_porcan           = $_POST['pre_porcan'];
    $pre_iva              = $_POST['pre_iva'];
    $pre_cant             = $_POST['pre_cant'];
    
    $get_articulosByartCod=$articulosE->get_articulosByartCod($codigo);
    $assoc_get_articulosByartCod=mysql_fetch_assoc($get_articulosByartCod);

    //INICIO: REVISA PRECIOS 

    if ($pre_cant==0 or $pre_cant=="")
    {
    }
    else
    {
      if ($assoc_get_articulosByartCod['pre_cant']!=$pre_cant)    
      { 
        //se inserta un mensaje nuvo para la impresion de un cartel de presio

        $men_asunto     ="Nuevo cartel de precio generado por el sistema pendiente de impresión";
        $men_desc       =$assoc_get_articulosByartCod['art_desc'];
        $men_categoria  =1;
        $men_visto      =0;
        $men_fec        =$FechayHora;
        $men_id_rel     =$assoc_get_articulosByartCod['ID_art'];
        $men_tabla_rel  ="articulos";

        $insert_mensajes = $mensajes->insert_mensajes($men_asunto, $men_desc, $men_categoria, $men_visto, $men_fec, $men_id_rel, $men_tabla_rel);

        //se modifica el precio cant de la tabla precios
        $ID_pre      = $assoc_get_articulosByartCod['ID_pre'];
        $pre_fec     = $fechaDeHoy;
        $update_preciosById=$preciosE->update_preciosById($ID_pre, $pre_cant, $pre_iva, $pre_neto, $pre_fec, $pre_porcan);
      }
    }

    //INICIO: Inserto nuevo registro en la tabla de movimientos de Stock
    $sto_mov            = 1; // 1=Ingreso de stock / 2=Egreso de stock
    $ID_art             = $assoc_get_articulosByartCod['ID_art'];
    $sto_desc           = "Ingreso manual de Stock";
    $sto_fec            = $FechayHora;
    $ID_suc             = $_POST['ID_suc'];
    //$ID_usu           = ;
    $sto_cant           = $cantidad;

    //calcula Stock total para guardarlo en la columna sto_total
      //Para ello trae todos los movimientos de stock por articulo y sucursal dentro de un for suma los sto_mov 1, resta los sto_mov 2 y luego resta los totales.
    $get_stockByIdArtUltimo        = $stockE->get_stockByIdArtUltimo($ID_art, $ID_suc);
    @$num_get_stockByIdArtUltimo    = mysql_num_rows($get_stockByIdArtUltimo);

    if ($num_get_stockByIdArtUltimo==0) 
    {
     $sto_total=$cantidad;
    }
    else
    {
      $assoc_get_stockByIdArtUltimo   = mysql_fetch_assoc($get_stockByIdArtUltimo);
      $ID_art                         = $assoc_get_stockByIdArtUltimo['ID_art'];
      $ID_suc                         = $assoc_get_stockByIdArtUltimo['ID_suc'];
      
      if ($sto_mov==2) 
      {
          $sto_total            = $assoc_get_stockByIdArtUltimo['sto_total']-$sto_cant;
      }
      else
      {
          $sto_total            = $assoc_get_stockByIdArtUltimo['sto_total']+$sto_cant;
      }  
     
    }  
    
   
   //CAMBIAR EL SIMBOLO SEGUN sto_mov

    $insert_stock         = $stock->insert_stock($sto_mov, $ID_art, $sto_desc, $sto_fec, $ID_suc, $ID_usu, $sto_cant, $sto_total);

    //FIN: Inserto nuevo registro en la tabla de movimientos de Stock



    $get_stockByFecBetween=$stockE->get_stockByIdSucUltimos10($ID_suc);
    $num_get_stockByFecBetween=mysql_num_rows($get_stockByFecBetween);

    echo '
    <table class="table table-condensed table-hover table-striped"  id="tablaTotal">
              <thead>
                <tr>
                   <th>
                    <i class="material-icons">swap_vertical_circle</i> Ingreso/Egreso
                   </th>
                    <th>
                    <i class="material-icons">date_range</i> Fecha y Hora
                   </th>
                   <th>
                    <i class="material-icons">store</i> Sucursal
                   </th>
                   <th>
                    <i class="material-icons">accessibility</i> Usuario
                   </th>
                   <th>
                    <i class="material-icons">shopping_basket</i> Articulo
                   </th>
                   <th>
                    <i class="material-icons">description</i> Detalle
                   </th>
                   <th>
                    <i class="material-icons">find_in_page</i> Cantidad
                   </th>
                   <th>
                    <i class="material-icons">settings_system_daydream</i> Stock Total
                   </th>
                </tr>  
              </thead>
              <tbody style="text-align: center;">';
                for ($countStock=0; $countStock < $num_get_stockByFecBetween; $countStock++) 
                 { 
                    $assoc_get_stockByFecBetween=mysql_fetch_assoc($get_stockByFecBetween);
                    $sto_mov=$assoc_get_stockByFecBetween['sto_mov'];
                    if ($sto_mov==2) 
                    {
                       $colorFila = "danger";  
                       $logoFila = "<i class='material-icons'>thumb_down</i>";;
                    }
                    else
                    {
                       $colorFila = "success";  
                       $logoFila = "<i class='material-icons'>thumb_up</i>";
                    }  
                    
                    echo "<tr class='".$colorFila."'>";
                       echo "<th>";
                        echo $logoFila;
                      echo "</th>";
                      echo "<th>";
                        echo $assoc_get_stockByFecBetween['sto_fec'];
                      echo "</th>";
                      echo "<th>";
                         echo "<img src='".$assoc_get_stockByFecBetween['suc_icono']."' style='width:20%;'>";
                      echo "</th>";
                      echo "<th>";
                        echo $assoc_get_stockByFecBetween['usu_nombre']." ".$assoc_get_stockByFecBetween['usu_apellido'];
                      echo "</th>";
                      echo "<th>";
                        echo $assoc_get_stockByFecBetween['art_desc'];
                      echo "</th>";
                      echo "<th>";
                        echo $assoc_get_stockByFecBetween['sto_desc'];
                      echo "</th>";
                      echo "<th>";
                        echo $assoc_get_stockByFecBetween['sto_cant'];
                      echo "</th>";
                       echo "<th>";
                        echo $assoc_get_stockByFecBetween['sto_total'];
                      echo "</th>";
                    echo "</tr>";
                  }
           echo '       
              </tbody>
              <tfoot >  
                <tr>
                   <th>
                    <i class="material-icons">swap_vertical_circle</i> Ingreso/Egreso
                   </th>
                    <th>
                    <i class="material-icons">date_range</i> Fecha y Hora
                   </th>
                   <th>
                    <i class="material-icons">store</i> Sucursal
                   </th>
                   <th>
                    <i class="material-icons">accessibility</i> Usuario
                   </th>
                   <th>
                    <i class="material-icons">shopping_basket</i> Articulo
                   </th>
                   <th>
                    <i class="material-icons">description</i> Detalle
                   </th>
                   <th>
                    <i class="material-icons">find_in_page</i> Cantidad
                   </th>
                   <th>
                    <i class="material-icons">settings_system_daydream</i> Stock Total
                   </th>
                </tr>  
            <tfoot>  
         </table> 
    <div class="alert alert-dismissible alert-warning">
        <h5><i class="material-icons">warning</i> Solo estas viendo los ultimos 5 movimientos de Stock  </h5>
      </div> ';

 }

 if ($action=="mostrarStockPorSucursal") 
 {
   
   $ID_art = $_POST['ID_art'];

               
                $get_articulosById = $articulos->get_articulosById($ID_art);
                $assoc_get_articulosById = mysql_fetch_assoc($get_articulosById);

                echo "<div class='col-md-12'>";
                  echo "<div class='alert alert-info alert-dismissable' style='margin-top: 1%;'>";
                  echo "<i class='material-icons'>shopping_cart</i> Estas viendo el Stock por sucursal del Articulo: ".$assoc_get_articulosById['art_desc']."";
                  echo "</div>";
                echo "</div>";
                  
              

                $get_sucursales=$sucursalesE->get_sucursales();
                $num_get_sucursales=mysql_num_rows($get_sucursales);
                $delay=0;
                for ($countSuc=0; $countSuc < $num_get_sucursales; $countSuc++) 
                { 
                  $assoc_get_sucursales=mysql_fetch_assoc($get_sucursales);
                  $ID_suc=$assoc_get_sucursales['ID_suc'];

                  @$get_stockByIdArtUltimo=$stockE->get_stockByIdArtUltimo($ID_art, $ID_suc);
                  @$assoc_get_stockByIdArtUltimo=mysql_fetch_assoc($get_stockByIdArtUltimo);
                  @$num_get_stockByIdArtUltimo=mysql_num_rows($get_stockByIdArtUltimo);

                  
                  
                  echo "<div class='col-md-1'>"; 
                  echo "</div>";
                  echo "<div class='col-md-12' style='text_align:center; margin-top:4%; border-top:5px solid #099; border-bottom:5px solid #099; border-radius: 20px 20px 20px 20px; padding:2%;'>";
                    echo "<div class='alert alert-info alert-dismissable' style='text-align:center; font-size:120%; display:none;' id='sucursalStock".$ID_suc."'>";
                      echo "<strong><i class='material-icons'>store</i> ".$assoc_get_sucursales['suc_desc']."<strong>"; 
                    echo "</div>";
                    echo "<div class='col-md-12' style='display:none; text-align:center;' id='contenidoStock".$ID_suc."'>"; 
                      echo "<div class='col-md-3'>";  
                        echo "<img src='".$assoc_get_sucursales['suc_icono']."' style='width:130%;'>";
                      echo "</div>";  
                      echo "<div class='col-md-1'>"; 
                      echo "</div>";
                      echo "<div class='col-md-7' style='text-align:center;'>"; 
                        if ($num_get_stockByIdArtUltimo==0)
                        {
                          echo "<p style='font-size:350%; color:#099;'> 0 U.</p>";  
                          $boton="disabled";
                        }
                        else
                        { 



                           /* Fin Modal Exportar Stock */

                             /* Inicio Modal Quitar Mercaderia */                   
                          echo '<div class="modal fade" id="quitar'.$ID_suc.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title" id="myModalLabel">Quitar Stock</h4>
                                        </div>
                                        <div class="modal-body">
                                          <form action="accionesExclusivas.php" method="post" enctype="multipart/form-data">
                                          <div class="form-group">
                                            <label for="pto_asig">Ingrese Cantidad</label>
                                            <input type="number" name="cantidad" placeholder="Cantidad Maxima Permitida: '.$assoc_get_stockByIdArtUltimo['sto_total'].'" class="form-control"  max="'.$assoc_get_stockByIdArtUltimo['sto_total'].'" required>
                                          </div>
                                          <div class="form-group"> 
                                            <label for="ID_sucB">Detalle el motivo</label> 
                                            <textarea name="sto_desc" placeholder="Descripción del motivo por la quita de mercaderia"></textarea>
                                  </div>
                                           <input hidden type="text" name="action" value="quitarStock">
                                           <input hidden type="text" name="ID_art" value="'.$ID_art.'">
                                           <input hidden type="text" name="ID_suc" value="'.$ID_suc.'">
                                          
                                        </div>
                                        <div class="modal-footer">
                                          <button class="btn btn-success" type="submit" style="width:100%;"><i class="material-icons" style="vertical-align: middle">backup</i> Enviar</button>
                                        </div>
                                          </form>
                                      </div>
                                    </div>
                                  </div>';
                           /* Fin Modal Quitar Mercaderia */

                          echo "<input id='muestraValorDeStock".$ID_art."".$ID_suc."' name='muestraValorDeStock".$ID_suc."' style='font-size:350%; color:#099; border:0px;' value='" . $assoc_get_stockByIdArtUltimo['sto_total'] . " " . $assoc_get_articulosById['art_unidad'] . "'>";
                          $boton="";  


                          /* Inicio Modal Exportar Stock */                          
                          echo '<div class="col-md-12" id="exportarCuadro'.$ID_suc.'" style="display:none; border:1px solid #000; font-size:10px;">
                                      <h4>Exportar Stock</h4>
                                          <div class="form-group">
                                              <label for="pto_asig">Ingrese Cantidad</label>
                                              <input type="number" name="cantidad" id="cantidad'.$ID_art.''.$ID_suc.'"  placeholder="Cantidad Maxima Permitida: '.$assoc_get_stockByIdArtUltimo['sto_total'].'" class="form-control"  max="'.$assoc_get_stockByIdArtUltimo['sto_total'].'" value="" required>
                                          </div>';
                                          echo '<div class="form-group"> 
                                              <label for="ID_sucB">Seleccione Destinatario</label> 
                                              <select name="ID_sucB" id="ID_sucB'.$ID_art.''.$ID_suc.'" class="form-control">';
                                                $get_sucursalesB=$sucursalesE->get_sucursales();
                                                $num_get_sucursalesB=mysql_num_rows($get_sucursalesB);
                                                for ($countSucB=0; $countSucB < $num_get_sucursalesB; $countSucB++) 
                                                { 
                                                  $assoc_get_sucursalesB=mysql_fetch_assoc($get_sucursalesB);
                                                  $ID_sucB=$assoc_get_sucursalesB['ID_suc'];
                                                  $suc_descB=$assoc_get_sucursalesB['suc_desc'];

                                                  echo "<option value='".$ID_sucB."'>".$suc_descB."</option>";

                                                } 
                                      echo "<select>";  
                                      echo ' <input hidden type="text" name="action" value="exportarStock">
                                            <input hidden type="text" name="ID_suc" id="ID_suc'.$ID_art.''.$ID_suc.'" value="'.$ID_suc.'">
                                            <br><br>
                                            <button class="btn btn-success" type="button" id="Botonenviar'.$ID_art.''.$ID_suc.'" style="width:100%;"><i class="material-icons" style="vertical-align: middle">backup</i> Enviar</button>
                                          </div>
                                    </div>';


                                     echo "<div id='muestraRespuestaExportarStock".$ID_art."".$ID_suc."'></div>";

                                      echo "<script>
                                              $('#Botonenviar".$ID_art."".$ID_suc."').click(function()
                                                  {

                                                       var ID_art           = '".$ID_art."';
                                                       var cantidad         = $('#cantidad".$ID_art."".$ID_suc."');
                                                       console.log(cantidad);
                                                       var ID_suc           = $('#ID_suc".$ID_art."".$ID_suc."');
                                                       var ID_sucB          = $('#ID_sucB".$ID_art."".$ID_suc."');  
                                                       var action           = 'exportarStock'; 
                                                   
                                                      
                                                      var dataString = 'ID_art='+ID_art 
                                                      + '&cantidad='+cantidad
                                                      + '&ID_suc='+ID_suc
                                                      + '&ID_sucB='+ID_sucB
                                                      + '&action='+action;
                                                    
                                                    alert(dataString);

                                                     $.ajax(
                                                    {
                                                        type: 'POST',
                                                        url: 'accionesStock.php',
                                                        data: dataString,
                                                        success: function(data)
                                                         {
                                                             $('#muestraRespuestaExportarStock".$ID_art."".$ID_suc."').fadeIn(1000).html(data);
                                                             var nuevoValorStock = $('#nuevoValorStockPorSuc".$ID_art."".$ID_suc."').val();
                                                            $('#muestraValorDeStock".$ID_art."".$ID_suc."').val(nuevoValorStock);
                                                         }
                                                     });
                                                   
                                                 });

                                      </script>";    


                        } 
                      echo "</div>";  
                      echo "<div class='col-md-1'>"; 
                      echo "</div>";
                    echo "</div>";
                      echo "<div class='col-md-12' style='text-align:center; margin-top:5%;'>"; 
                          echo "<div class='col-md-6'>";
                            echo "<button ".$boton." class='btn btn-success'  title='Enviar mercaderia a otra sucursal' id='exportar".$ID_suc."' style='width:90%;'><strong><i class='material-icons'>unarchive</i> Exportar</strong></button>";
                          echo "</div>"; 
                          echo "<div class='col-md-6'>";
                            echo "<button ".$boton." class='btn btn-danger'  data-toggle='modal' title='Quitar mercaderia manualmente y con motivo' data-placement='top' data-target='#quitar".$ID_suc."' style='width:100%;'><strong><i class='material-icons'>report</i> Quitar</strong></button>";
                          echo "</div>"; 
                      echo "</div>";      
                  echo "</div>";
                  echo "<div class='col-md-1'>"; 
                  echo "</div>";
                  $delay=300+$delay;
                  echo "<script>
                        $('#contenidoStock".$ID_suc."').delay(".$delay.").toggle('slow');
                        $('#sucursalStock".$ID_suc."').delay(".$delay.").toggle('slow');</script>";

                        echo "<script>$('#exportar".$ID_suc."').click(function(){
                          $('#exportarCuadro".$ID_suc."').fadeIn(500);
                        });</script>";


                }
              
 }

    if ($action=='exportarStock')
  {
     $ID_art           = $_POST['ID_art'];
     $cantidad         = $_POST['cantidad'];
     $ID_suc           = $_POST['ID_suc'];
     $ID_sucB          = $_POST['ID_sucB'];

     //INICIO: Inserto nuevo registro en la tabla de movimientos de Stock

    $sto_movA            = 2; // 1=Ingreso de stock / 2=Egreso de stock
    //$ID_art            = ;
    $sto_descA           = "Se Exporto mercaderia de una sucursal a otra";
    $sto_fecA            = $FechayHora;
    $ID_sucA             = $ID_suc;
    //$ID_usu            = ;
    $sto_cantA           = $cantidad;

    //calcula Stock total para guardarlo en la columna sto_total
      //Para ello trae todos los movimientos de stock por articulo y sucursal dentro de un for suma los sto_mov 1, resta los sto_mov 2 y luego resta los totales.
    $get_stockByIdArtUltimoA        = $stockE->get_stockByIdArtUltimo($ID_art, $ID_suc);
    $assoc_get_stockByIdArtUltimoA  = mysql_fetch_assoc($get_stockByIdArtUltimoA);
    $ID_artA                         = $assoc_get_stockByIdArtUltimoA['ID_art'];
    $ID_sucA                         = $assoc_get_stockByIdArtUltimoA['ID_suc'];

    if ($sto_movA==2) 
    {
        $sto_totalA            = $assoc_get_stockByIdArtUltimoA['sto_total']-$sto_cantA;
    }
    else
    {
        $sto_totalA            = $assoc_get_stockByIdArtUltimoA['sto_total']+$sto_cantA;
    }  

   //CAMBIAR EL SIMBOLO SEGUN sto_mov

    $insert_stockA         = $stock->insert_stock($sto_movA, $ID_art, $sto_descA, $sto_fecA, $ID_sucA, $ID_usu, $sto_cantA, $sto_totalA);

    //FIN: Inserto nuevo registro en la tabla de movimientos de Stock

         //INICIO: Inserto nuevo registro en la tabla de movimientos de Stock

    $sto_movB            = 1; // 1=Ingreso de stock / 2=Egreso de stock
    //$ID_art            = ;
    $sto_descB           = "Se Importo mercaderia desde una sucursal a otra";
    $sto_fecB            = $FechayHora;
    $ID_sucB             = $ID_sucB;
    //$ID_usu            = ;
    $sto_cantB           = $cantidad;

    //calcula Stock total para guardarlo en la columna sto_total
      //Para ello trae todos los movimientos de stock por articulo y sucursal dentro de un for suma los sto_mov 1, resta los sto_mov 2 y luego resta los totales.
    $get_stockByIdArtUltimoB        = $stockE->get_stockByIdArtUltimo($ID_artA, $ID_sucB);
    $assoc_get_stockByIdArtUltimoB  = mysql_fetch_assoc($get_stockByIdArtUltimoB);

    if ($sto_movB==2) 
    {
        $sto_totalB            = $assoc_get_stockByIdArtUltimoB['sto_total']-$sto_cantB;
    }
    else
    {
        $sto_totalB            = $assoc_get_stockByIdArtUltimoB['sto_total']+$sto_cantB;
    }  

   //CAMBIAR EL SIMBOLO SEGUN sto_mov

    $insert_stockB         = $stock->insert_stock($sto_movB, $ID_art, $sto_descB, $sto_fecB, $ID_sucB, $ID_usu, $sto_cantB, $sto_totalB);

    //FIN: Inserto nuevo registro en la tabla de movimientos de Stock
      
    echo "<input hidden type='text' id='nuevoValorStockPorSuc".$ID_art."".$ID_suc."' name='nuevoValorStockPorSuc' value='".$sto_totalB."'>";
    
  }
?>