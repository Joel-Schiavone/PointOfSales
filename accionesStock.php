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
    echo '<table class="table table-striped table-hover ">
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
    echo '<table class="table table-striped table-hover ">
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
?>