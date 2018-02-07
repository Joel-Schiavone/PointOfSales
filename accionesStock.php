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
$stockE             = new stockE;
$stock              = new stock;
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
?>