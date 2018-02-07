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
$caja               = new caja;
$cajaE              = new cajaE;
$ventaE             = new ventaE;
$venta              = new venta;
$mov_caja           = new mov_caja;
$mov_cajaE          = new mov_cajaE;
$ventas_canceladas  = new ventas_canceladas;
$clientesE          = new clientesE;
$cuenta_cteE        = new cuenta_cteE;
$cuenta_cte         = new cuenta_cte;
$preciosE           = new preciosE;
$precios            = new precios;
$usuariosE          = new usuariosE;
$usuarios           = new usuarios;
$permisos           = new permisos;
$permisosE          = new permisosE;
$clientes           = new clientes;
$stockE             = new stockE;
$stock              = new stock;
$mensajes           = new mensajes;
$mensajesE          = new mensajesE;
$sub_categoriasE    = new sub_categoriasE;
$sub_categorias     = new sub_categorias;
$categoriasE        = new categoriasE;
$categorias         = new categorias;
$proveedores        = new proveedores;
$venta_detalle      = new venta_detalle;
$venta_detalleE     = new venta_detalleE;
$tarjetas_planes    = new tarjetas_planes;
$tarjetas_planesE   = new tarjetas_planesE;
$tarjetas           = new tarjetas;
$tarjetasE          = new tarjetasE;
$adjuntos           = new adjuntos;
$especiales         = new especiales;
$facturas_de_compras= new facturas_de_compras;
$cuentas            = new cuentas;
$cuentasE           = new cuentasE;
$cuentas_movimientosE= new cuentas_movimientosE;
$cuentas_movimientos= new cuentas_movimientos;
$cuentas_impuestos  = new cuentas_impuestos;
$tipo_comprobantes  = new tipo_comprobantes;
$tipo_comprobantesE = new tipo_comprobantesE;
$puntos_de_ventasE  = new puntos_de_ventasE;
$puntos_de_ventas   = new puntos_de_ventas;
$puestos            = new puestos;
$puestosE           = new puestosE;
$cuentas_impuestosE = new cuentas_impuestosE;
$cuentas_impuestos  = new cuentas_impuestos;
@$action            = $_POST['action'];
@$atras             = $_SESSION['actionsBack'];
?>


 <!-- Inicio: Estilos Generales-->
  <link href="css/generales.css" rel="stylesheet"> 
 <!-- Fin: Estilos Generales-->
<?php


if ($action=='insert_caja')
{
$insert_caja = $caja->insert_caja($ID_control, $ID_usu, $caj_fec, $caj_horaa, $caj_horac, $cja_vta, $cja_vct, $cja_vef, $caj_inicio, $caj_cierre, $caj_vne, $ID_suc);

 //REDIRECCIONA
       echo '<script type="text/javascript">
       window.location.assign("cajaSuc.php?M=6");
      </script>';
}

if ($action=='validarCaja')
{
  $ID_caj=$_POST['ID_caj'];
  $ID_control=$_POST['ID_control'];
  $update_cajaControl=$cajaE->update_cajaControl($ID_caj, $ID_control);

}
if ($action=='editaTarjetaPlan')
{
  $ID_pla             =   $_POST['ID_pla'];
  $pla_desc           =   $_POST['pla_desc'];
  $pla_cant           =   $_POST['pla_cant'];
  $ID_tar             =   $_POST['ID_tar'];
  $plan_tiempoAcre    =   $_POST['plan_tiempoAcre'];
  $pla_recargo        =   $_POST['pla_recargo'];
  $ID_fpo             =   3;

  $update_tarjetas_planesById=$tarjetas_planes->update_tarjetas_planesById($ID_pla, $pla_desc, $pla_cant, $ID_tar, $plan_tiempoAcre, $ID_fpo, $pla_recargo);

      //REDIRECCIONA
     echo '<script type="text/javascript">
      window.location.assign("tarjetasPlanes.php?M=10");
     </script>';
}
if ($action=='nuevoPlanTarjeta')
{
  $pla_desc           =   $_POST['pla_desc'];
  $pla_cant           =   $_POST['pla_cant'];
  $ID_tar             =   $_POST['ID_tar'];
  $plan_tiempoAcre     =   $_POST['plan_tiempoAcre'];
  $pla_recargo        =   $_POST['pla_recargo'];
  $ID_fpo             =   3;

  $insert_tarjetas_planes=$tarjetas_planes->insert_tarjetas_planes($pla_desc, $pla_cant, $ID_tar, $plan_tiempoAcre, $ID_fpo, $pla_recargo);

      //REDIRECCIONA
       echo '<script type="text/javascript">
       window.location.assign("tarjetasPlanes.php?M=6");
      </script>';
}


if ($action=='nuevoPuesto')
{
  $ID_suc             =   $_POST['ID_suc'];
  $pue_desc           =   $_POST['pue_desc'];
  $ID_pdv             =   $_POST['ID_pdv'];
  $ID_cue             =   $_POST['ID_cue'];
  
  $insert_puestos=$puestos->insert_puestos($ID_suc, $pue_desc, $ID_pdv, $ID_cue);

      //REDIRECCIONA
       echo '<script type="text/javascript">
       window.location.assign("puestos.php?M=6");
      </script>';
}
if ($action=='nuevoComprobante')
{

  $tce_desc                  =   $_POST['tce_desc'];
  $ID_fce                    =   $_POST['ID_fce'];
  @$tce_movcaja              =   $_POST['tce_movcaja'];
  @$tce_movstock             =   $_POST['tce_movstock'];
  @$tce_predecesor           =   $_POST['tce_predecesor'];
  @$tce_fuerzaPredecesor     =   $_POST['tce_fuerzaPredecesor'];
  @$tce_numeracionAutomatica =   $_POST['tce_numeracionAutomatica'];
  @$tce_detalleArticulos     =   $_POST['tce_detalleArticulos'];
  $tce_letra                 =   $_POST['tce_letra'];

  $insert_tipo_comprobantes=$tipo_comprobantes->insert_tipo_comprobantes($ID_fce, $tce_desc, $tce_movcaja, $tce_movstock, $tce_predecesor, $tce_fuerzaPredecesor, $tce_numeracionAutomatica, $tce_detalleArticulos, $tce_letra);

      //REDIRECCIONA
       echo '<script type="text/javascript">
       window.location.assign("tiposdecomprobantes.php?M=6");
      </script>';
}

if ($action=='nuevaTarjeta')
{

  $tar_desc                   =   $_POST['tar_desc'];
  $tar_cue                    =   $_POST['tar_cue'];
  $tar_tipo                   =   $_POST['tar_tipo'];
              
  $tmpFilePath                =   $_FILES['adj_ruta']['tmp_name'];
  $shortname                  =   $_FILES['adj_ruta']['name'];
  $generateRandomString       =   $especiales->generateRandomString();
  $extension                  =   end(explode(".", $_FILES['adj_ruta']['name']));
  $adj_ruta                   =   "media/tarjetas/".$generateRandomString.".".$extension;

  //Abrir foto original
  if ( $_FILES['adj_ruta']['type'] == 'image/jpeg') 
  {
    $original = imagecreatefromjpeg($tmpFilePath);
  }
  else if( $_FILES['adj_ruta']['type'] == 'image/png' )
  {
    $original = imagecreatefrompng($tmpFilePath);
  }
  else
  {
    die('No se pudo generar la imagen');
  }  
  
  //ancho foto original
  $ancho_original=imagesx($original);
  //alto foto original
  $alto_original=imagesy($original);

  //Crear un lienzo vacio 
  $ancho_copia=190;
  $alto_copia=round($ancho_copia * $alto_original / $ancho_original);
  $copia=imagecreatetruecolor($ancho_copia, $alto_copia);

  //Pego en el lienzo la imagen original pasandole 12 parametos
    // 1-2 Original y copia 
    // 3-4 destino y original 
    // 5-6 eje x_y pegado, 0, 0
    // 7-8 eje x_y original, 0, 0
    // 9-10 ancho-alto pegado
    // 11-12 ancho-alto original 
  imagecopyresampled($copia, $original, 0, 0, 0, 0, $ancho_copia, $alto_copia, $ancho_original, $alto_original);

  //Gruadar Imagen
  imagejpeg($copia, $adj_ruta, 100);

  /*
  move_uploaded_file($tmpFilePath, $adj_ruta);
  */

  $tar_logo                  =   $adj_ruta;
 
  $insert_tarjetas=$tarjetas->insert_tarjetas($tar_desc, $tar_cue, $tar_logo, $tar_tipo);

      //REDIRECCIONA
       echo '<script type="text/javascript">
       window.location.assign("tarjetas.php?M=6");
      </script>';
}

if ($action=='editaTarjeta')
{
  $ID_tar                     =   $_POST['ID_tar'];
  $tar_desc                   =   $_POST['tar_desc'];
  $tar_cue                    =   $_POST['tar_cue'];
  $tar_tipo                   =   $_POST['tar_tipo']; 
  if ($_FILES['adj_ruta']['tmp_name']) 
  {
  $tmpFilePath                =   $_FILES['adj_ruta']['tmp_name'];
  $shortname                  =   $_FILES['adj_ruta']['name'];
  $generateRandomString       =   $especiales->generateRandomString();
  $extension                  =   end(explode(".", $_FILES['adj_ruta']['name']));
  $adj_ruta                   =   "media/tarjetas/".$generateRandomString.".".$extension;

  //Abrir foto original
  if ( $_FILES['adj_ruta']['type'] == 'image/jpeg') 
  {
    $original = imagecreatefromjpeg($tmpFilePath);
  }
  else if( $_FILES['adj_ruta']['type'] == 'image/png' )
  {
    $original = imagecreatefrompng($tmpFilePath);
  }
  else
  {
    die('No se pudo generar la imagen');
  }  
  
  //ancho foto original
  $ancho_original=imagesx($original);
  //alto foto original
  $alto_original=imagesy($original);

  //Crear un lienzo vacio 
  $ancho_copia=250;
  $alto_copia=round($ancho_copia * $alto_original / $ancho_original);
  $copia=imagecreatetruecolor($ancho_copia, $alto_copia);

  //Pego en el lienzo la imagen original pasandole 12 parametos
    // 1-2 Original y copia 
    // 3-4 destino y original 
    // 5-6 eje x_y pegado, 0, 0
    // 7-8 eje x_y original, 0, 0
    // 9-10 ancho-alto pegado
    // 11-12 ancho-alto original 
  imagecopyresampled($copia, $original, 0, 0, 0, 0, $ancho_copia, $alto_copia, $ancho_original, $alto_original);

  //Gruadar Imagen
  imagejpeg($copia, $adj_ruta, 100);

  /*
  move_uploaded_file($tmpFilePath, $adj_ruta);
  */

    $tar_logo                  =   $adj_ruta;
  }
  else
  {
    $tar_logo                  =   $_POST['tar_logo']; 
  }  

  $update_tarjetasById=$tarjetas->update_tarjetasById($ID_tar, $tar_desc, $tar_cue, $tar_logo, $tar_tipo);

      //REDIRECCIONA
     echo '<script type="text/javascript">
      window.location.assign("tarjetas.php?M=10");
     </script>';
}


if ($action=='nuevaSucursal')
{

  $suc_desc                   =   $_POST['suc_desc'];
  $suc_dir                    =   $_POST['suc_dir'];
  $suc_tel                    =   $_POST['suc_tel'];
  $suc_color                  =   0;
  $suc_url                    =   0;                    
  $tmpFilePath                =   $_FILES['adj_ruta']['tmp_name'];
  $shortname                  =   $_FILES['adj_ruta']['name'];
  $generateRandomString       =   $especiales->generateRandomString();
  $extension                  =   end(explode(".", $_FILES['adj_ruta']['name']));
  $adj_ruta                   =   "media/sucursales/".$generateRandomString.".".$extension;

  //Abrir foto original
  if ( $_FILES['adj_ruta']['type'] == 'image/jpeg') 
  {
    $original = imagecreatefromjpeg($tmpFilePath);
  }
  else if( $_FILES['adj_ruta']['type'] == 'image/png' )
  {
    $original = imagecreatefrompng($tmpFilePath);
  }
  else
  {
    die('No se pudo generar la imagen');
  }  
  
  //ancho foto original
  $ancho_original=imagesx($original);
  //alto foto original
  $alto_original=imagesy($original);

  //Crear un lienzo vacio 
  $ancho_copia=250;
  $alto_copia=round($ancho_copia * $alto_original / $ancho_original);
  $copia=imagecreatetruecolor($ancho_copia, $alto_copia);

  //Pego en el lienzo la imagen original pasandole 12 parametos
    // 1-2 Original y copia 
    // 3-4 destino y original 
    // 5-6 eje x_y pegado, 0, 0
    // 7-8 eje x_y original, 0, 0
    // 9-10 ancho-alto pegado
    // 11-12 ancho-alto original 
  imagecopyresampled($copia, $original, 0, 0, 0, 0, $ancho_copia, $alto_copia, $ancho_original, $alto_original);

  //Gruadar Imagen
  imagejpeg($copia, $adj_ruta, 100);

  /*
  move_uploaded_file($tmpFilePath, $adj_ruta);
  */

  $suc_icono                  =   $adj_ruta;
 
  $insert_sucursales=$sucursales->insert_sucursales($suc_desc, $suc_dir, $suc_tel, $suc_color, $suc_icono, $suc_url);

      //REDIRECCIONA
       echo '<script type="text/javascript">
       window.location.assign("sucursales.php?M=6");
      </script>';
}


if ($action=='editaSucursal')
{
  $ID_suc                     =   $_POST['ID_suc'];
  $suc_desc                   =   $_POST['suc_desc'];
  $suc_dir                    =   $_POST['suc_dir'];
  $suc_tel                    =   $_POST['suc_tel'];
  $suc_color                  =   0;
  $suc_url                    =   0;    
  if ($_FILES['adj_ruta']['tmp_name']) 
  {
  $tmpFilePath                =   $_FILES['adj_ruta']['tmp_name'];
  $shortname                  =   $_FILES['adj_ruta']['name'];
  $generateRandomString       =   $especiales->generateRandomString();
  $extension                  =   end(explode(".", $_FILES['adj_ruta']['name']));
  $adj_ruta                   =   "media/sucursales/".$generateRandomString.".".$extension;

  //Abrir foto original
  if ( $_FILES['adj_ruta']['type'] == 'image/jpeg') 
  {
    $original = imagecreatefromjpeg($tmpFilePath);
  }
  else if( $_FILES['adj_ruta']['type'] == 'image/png' )
  {
    $original = imagecreatefrompng($tmpFilePath);
  }
  else
  {
    die('No se pudo generar la imagen');
  }  
  
  //ancho foto original
  $ancho_original=imagesx($original);
  //alto foto original
  $alto_original=imagesy($original);

  //Crear un lienzo vacio 
  $ancho_copia=250;
  $alto_copia=round($ancho_copia * $alto_original / $ancho_original);
  $copia=imagecreatetruecolor($ancho_copia, $alto_copia);

  //Pego en el lienzo la imagen original pasandole 12 parametos
    // 1-2 Original y copia 
    // 3-4 destino y original 
    // 5-6 eje x_y pegado, 0, 0
    // 7-8 eje x_y original, 0, 0
    // 9-10 ancho-alto pegado
    // 11-12 ancho-alto original 
  imagecopyresampled($copia, $original, 0, 0, 0, 0, $ancho_copia, $alto_copia, $ancho_original, $alto_original);

  //Gruadar Imagen
  imagejpeg($copia, $adj_ruta, 100);

  /*
  move_uploaded_file($tmpFilePath, $adj_ruta);
  */

  $suc_icono                  =   $adj_ruta;
  }
  else
  {
    $suc_icono                =   $_POST['suc_icono']; 
  }  

  $update_sucursalesById=$sucursales->update_sucursalesById($ID_suc, $suc_desc, $suc_dir, $suc_tel, $suc_color, $suc_icono, $suc_url);

      //REDIRECCIONA
     echo '<script type="text/javascript">
      window.location.assign("sucursales.php?M=10");
     </script>';
}



if ($action=='editaPuesto')
{
  $ID_pue             =   $_POST['ID_pue'];
  $ID_suc             =   $_POST['ID_suc'];
  $pue_desc           =   $_POST['pue_desc'];
  $ID_pdv             =   $_POST['ID_pdv'];
  $ID_cue             =   $_POST['ID_cue'];

  $update_puestosById=$puestos->update_puestosById($ID_pue, $ID_suc, $pue_desc, $ID_pdv, $ID_cue);

      //REDIRECCIONA
     echo '<script type="text/javascript">
      window.location.assign("puestos.php?M=10");
     </script>';
}
if ($action=='editaComprobante')
{
  $ID_tce               =   $_POST['ID_tce'];
  $tce_desc                  =   $_POST['tce_desc'];
  $ID_fce                    =   $_POST['ID_fce'];
  @$tce_movcaja              =   $_POST['tce_movcaja'];
  @$tce_movstock             =   $_POST['tce_movstock'];
  @$tce_predecesor           =   $_POST['tce_predecesor'];
  @$tce_fuerzaPredecesor     =   $_POST['tce_fuerzaPredecesor'];
  @$tce_numeracionAutomatica =   $_POST['tce_numeracionAutomatica'];
  @$tce_detalleArticulos     =   $_POST['tce_detalleArticulos'];
  $tce_letra                 =   $_POST['tce_letra'];

  $update_tipo_comprobantesById=$tipo_comprobantes->update_tipo_comprobantesById($ID_tce, $ID_fce, $tce_desc, $tce_movcaja, $tce_movstock, $tce_predecesor, $tce_fuerzaPredecesor, $tce_numeracionAutomatica, $tce_detalleArticulos, $tce_letra);


      //REDIRECCIONA
     echo '<script type="text/javascript">
      window.location.assign("tiposdecomprobantes.php?M=10");
     </script>';
}


 if (@$_GET['action']=='dropComprobante')
  {
     $ID_tce          =$_GET['ID_tce'];

     $drop_tipo_comprobantesById=$tipo_comprobantes->drop_tipo_comprobantesById($ID_tce);
    
      echo '<script type="text/javascript">
      window.location.assign("tiposdecomprobantes.php?M=8");
      </script>';
    
  }

  if (@$_GET['action']=='dropTarjetas')
  {
     $ID_tar          =$_GET['ID_tar'];

     //trae puestos 
     $getPlanesTarjetasByIdTar=$tarjetas_planesE->getPlanesTarjetasByIdTar($ID_tar);
     $num_getPlanesTarjetasByIdTar=mysql_num_rows($getPlanesTarjetasByIdTar);

     if ($num_getPlanesTarjetasByIdTar==0) 
     {
       $drop_tarjetasById=$tarjetas->drop_tarjetasById($ID_tar);
     }
     else
     {
      echo   '<div class="alert alert-danger" role="alert">
                <h5><i class="material-icons">thumb_down</i>
                <p> La tarjeta tiene planes asociados, elimine los planes para poder eliminar la tarjeta</p></h5>
             </div>';
     } 
     

      echo '<script type="text/javascript">
      window.location.assign("tarjetas.php?M=8");
      </script>';
    
  }

   if (@$_GET['action']=='dropTarjetasPlan')
  {
     $ID_pla          =$_GET['ID_pla'];

   
     $drop_tarjetas_planesById=$tarjetas_planes->drop_tarjetas_planesById($ID_pla);
   
     
      echo '<script type="text/javascript">
      window.location.assign("tarjetasPlanes.php?M=8");
      </script>';
    
  }

  if (@$_GET['action']=='dropSucursales')
  {
     $ID_suc          =$_GET['ID_suc'];

     //trae puestos 
     $get_puestosById=$puestosE->get_puestosById($ID_suc);
     $num_get_puestosById=mysql_num_rows($get_puestosById);

     if ($num_get_puestosById==0) 
     {
       $drop_sucursalesById=$sucursales->drop_sucursalesById($ID_suc);
     }
     else
     {
      echo   '<div class="alert alert-danger" role="alert">
                <h5><i class="material-icons">thumb_down</i>
                <p> La sucrusal tiene puestos asociados, elimine los puestos para poder eliminar la sucursal</p></h5>
             </div>';
     } 
     

      echo '<script type="text/javascript">
      window.location.assign("sucursales.php?M=8");
      </script>';
    
  }

  if (@$_GET['action']=='dropPuestoVenta')
  {
     $ID_pue          =$_GET['ID_pue'];

     $drop_puestosById=$puestos->drop_puestosById($ID_pue);
    
      echo '<script type="text/javascript">
      window.location.assign("puestos.php?M=8");
      </script>';
    
  }

  if (@$_GET['action']=='dropPuntoVenta')
  {
     $ID_pdv          =$_GET['ID_pdv'];

     $drop_puntos_de_ventasById=$puntos_de_ventas->drop_puntos_de_ventasById($ID_pdv);
    
      echo '<script type="text/javascript">
      window.location.assign("puntosDeVentas.php?M=8");
      </script>';
    
  }

if ($action=='cargarFactura')
{
  $ID_pro     =$_POST['ID_pro'];
  $fac_num    =$_POST['fac_cod'];
  $fac_serie  =$_POST['fac_serie'];
  $fac_fecha  =$_POST['fac_fecha'];
  $fac_total  =$_POST['fac_total'];

  $insert_facturas_de_compras=$facturas_de_compras->insert_facturas_de_compras($ID_pro, $fac_num, $fac_serie, $fac_fecha, $fac_total);

        //REDIRECCIONA
        echo '<script type="text/javascript">
        window.location.assign("facturasCompras.php?M=6");
        </script>';

}
if ($action=='ListaFacturasPorCodigo')
{
      if ($_POST['codigo']) 
      {
    
            $codigo  = " AND (facturas_de_compras.fac_serie LIKE '%".$_POST['codigo']."%' OR facturas_de_compras.fac_num LIKE '%".$_POST['codigo']."%')";
            
            $sql="SELECT * FROM facturas_de_compras, proveedores where facturas_de_compras.ID_pro=proveedores.ID_pro  ".$codigo." ORDER BY facturas_de_compras.fac_fecha DESC";

            $result_sql=mysql_query($sql);
            $num_result_sql=mysql_num_rows($result_sql);
            if ($num_result_sql==0) 
            {
              echo '<div class="alert alert-dismissible alert-warning">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <h4><i class="material-icons">sentiment_dissatisfied</i> No se ecnontraron resultados</h4>
                  </div>';
            }
            else
            {
              for ($count=0; $count < $num_result_sql; $count++) 
              { 
                $assoc_result_sql=mysql_fetch_assoc($result_sql);
                echo '<div class="col-md-12">
                        <div class="panel panel-primary">
                          <div class="panel-heading">
                            <h3 class="panel-title"><i class="material-icons">description</i> Factura Nº '.$assoc_result_sql['ID_pro'].'</h3>
                          </div>
                          <div class="panel-body" style="text-align:left;">
                            <p><i class="material-icons">local_shipping</i> Proveedor: '.$assoc_result_sql['pro_desc'].'</p>
                            <p><i class="material-icons">find_in_page</i> Codigo: '.$assoc_result_sql['fac_num'].'</p>
                            <p><i class="material-icons">find_in_page</i> Serie: '.$assoc_result_sql['fac_serie'].'</p>
                            <p><i class="material-icons">date_range</i> Fecha: '.$assoc_result_sql['fac_fecha'].'</p>
                            <p><i class="material-icons">monetization_on</i> Monto: $'.$assoc_result_sql['fac_total'].'</p>
                          </div>
                        </div>
                      </div>';
              }
            }  
        }


}
if ($action=='ListaFacturas')
{
      if ($_POST['ID_pro']!='null') 
      {
        $ID_pro  = "facturas_de_compras.ID_pro=".$_POST['ID_pro'];
      }
      else
      {
        $ID_pro  = "";
      }  
      if($_POST['codigo'])
      {
        if ($_POST['ID_pro']!='null') 
        {
          $codigo  = " AND (facturas_de_compras.fac_serie LIKE '%".$_POST['codigo']."%' OR facturas_de_compras.fac_num LIKE '%".$_POST['codigo']."%')";
        }
        else
        {
          $codigo  = "(facturas_de_compras.fac_serie LIKE '%".$_POST['codigo']."%' OR facturas_de_compras.fac_num LIKE '%".$_POST['codigo']."%')";
        }  
      }
      else
      {
        $codigo  = "";
      }  
      if ($_POST['fechaDesde'] AND $_POST['fechaHasta']) 
      {
        if ($_POST['ID_pro']!='null' OR $_POST['codigo']) 
        {

          $fecha  = "AND fac_fecha BETWEEN CAST('" . $_POST['fechaDesde'] . "' AS DATE) AND CAST('" .$_POST['fechaHasta']. "' AS DATE)";
        }
        else
        {
          $fecha  = "fac_fecha BETWEEN CAST('" . $_POST['fechaDesde'] . "' AS DATE) AND CAST('" .$_POST['fechaHasta']. "' AS DATE)";
        }  
      }
      else
      {
        $fecha   = "";
      }  
      
     //echo "SELECT * FROM facturas_de_compras, proveedores where facturas_de_compras.ID_pro=proveedores.ID_pro AND ".$ID_pro." ".$codigo." ".$fecha." ORDER BY fac_fecha DESC";
      $sql="SELECT * FROM facturas_de_compras, proveedores where facturas_de_compras.ID_pro=proveedores.ID_pro AND ".$ID_pro." ".$codigo." ".$fecha." ORDER BY facturas_de_compras.fac_fecha DESC";
      $result_sql=mysql_query($sql);
      $num_result_sql=mysql_num_rows($result_sql);
      if ($num_result_sql==0) 
      {
        echo '<div class="alert alert-dismissible alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4><i class="material-icons">sentiment_dissatisfied</i> No se ecnontraron resultados</h4>
            </div>';
      }
      else
      {
        for ($count=0; $count < $num_result_sql; $count++) 
        { 
          $assoc_result_sql=mysql_fetch_assoc($result_sql);
          echo '<div class="col-md-3">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h3 class="panel-title"><i class="material-icons">description</i> Factura Nº '.$assoc_result_sql['ID_pro'].'</h3>
                    </div>
                    <div class="panel-body" style="text-align:left;">
                      <p><i class="material-icons">local_shipping</i> Proveedor: '.$assoc_result_sql['pro_desc'].'</p>
                      <p><i class="material-icons">find_in_page</i> Codigo: '.$assoc_result_sql['fac_num'].'</p>
                      <p><i class="material-icons">find_in_page</i> Serie: '.$assoc_result_sql['fac_serie'].'</p>
                      <p><i class="material-icons">date_range</i> Fecha: '.$assoc_result_sql['fac_fecha'].'</p>
                      <p><i class="material-icons">monetization_on</i> Monto: $'.$assoc_result_sql['fac_total'].'</p>
                    </div>
                  </div>
                </div>';
        }
      }  
      


}

if (@$_GET['action']=='CerrarVenta')
  {
       $ID_ven = $_GET['ID_ven'];
       $ID_caj = $_GET['ID_caj'];
       $ven_descuento = $_GET['ven_descuento'];
       @$ID_pla   = $_GET['ID_pla'];

   
       //////////////////////TRAE LOS DATOS DE LA CAJA PARA POSTERIORMENTE SUMARLOS//////////////////////////////
       /**/    
       /**/    $get_cajaById          =   $caja->get_cajaById($ID_caj);
       /**/    $assoc_get_cajaById    =   mysql_fetch_assoc($get_cajaById);
       /**/    $ANTERIORMENTE_cja_vta =   $assoc_get_cajaById['cja_vta'];
       /**/    $ANTERIORMENTE_cja_vtad=   $assoc_get_cajaById['cja_vtad'];
       /**/    $ANTERIORMENTE_cja_vct =   $assoc_get_cajaById['cja_vct'];
       /**/    $ANTERIORMENTE_cja_vef =   $assoc_get_cajaById['cja_vef'];
       /**/    $ANTERIORMENTE_caj_vne =   $assoc_get_cajaById['caj_vne'];
       /**/
       /**////////////////////DATOS REUTILIZABLES EN LA MODIFICACION
       /**/
       /**/       $ID_control         =   $assoc_get_cajaById['ID_control'];
       /**/       $ID_usu             =   $assoc_get_cajaById['ID_usu'];
       /**/       $caj_fec            =   $assoc_get_cajaById['caj_fec'];
       /**/       $caj_horaa          =   $assoc_get_cajaById['caj_horaa'];
       /**/       $caj_horac          =   $assoc_get_cajaById['caj_horac'];
       /**/       $caj_inicio         =   $assoc_get_cajaById['caj_inicio'];
       /**/       $caj_cierre         =   $assoc_get_cajaById['caj_cierre'];
       /**/       $ID_suc             =   $assoc_get_cajaById['ID_suc'];
       /**/
       ///////////////////////////////////////////////////////////////////////////////////////////////////////////

        //TRAE TODOS LOS DETALLES DE VENTA DE ESTA VENTA

          $get_venta_detalleById=$venta_detalleE->get_venta_detalleById($ID_ven);
          $num_get_venta_detalleById=mysql_num_rows($get_venta_detalleById);
          $cja_vefXX=0;
          $cja_vctXX=0;
          $cja_vtaXX=0;
          $cja_vtadXX=0;
          $ventaTotal=0;
                  $cja_vta=$ANTERIORMENTE_cja_vta;
                  $cja_vtad=$ANTERIORMENTE_cja_vtad;
                  $cja_vct=$ANTERIORMENTE_cja_vct ;
                  $cja_vef=$ANTERIORMENTE_cja_vef;

          //////////////////////////////////TRAE EL NETO//////////////////////////////////////////
         /**/   $get_mov_caja_netos          =   $mov_cajaE->get_mov_caja_netos($ID_ven, $ID_caj);
         /**/   $assoc_get_mov_caja_netos    =   mysql_fetch_assoc($get_mov_caja_netos);
         /**/   $caj_vneA                     =   $assoc_get_mov_caja_netos['neto'];
         /**/   $caj_vne                      =   $caj_vneA+$ANTERIORMENTE_caj_vne;
         /**/
         //////////////////////////////////////////////////////////////////////////////////////////////
       

      for ($countDetalleDeVenta=0; $countDetalleDeVenta < $num_get_venta_detalleById; $countDetalleDeVenta++) 
      { 

        $assoc_get_venta_detalleById=mysql_fetch_assoc($get_venta_detalleById);
        $fpo_monto=$assoc_get_venta_detalleById['fpo_monto'];
        $ID_fpo=$assoc_get_venta_detalleById['ID_fpo'];
        $vde_IDasociado=$assoc_get_venta_detalleById['vde_IDasociado'];

      
          //SI LA FORMA DE PAGO ES EFECTIVO

           //MODIFICA LA CAJA EN EFECTIVO Y EN VENTA NETA Y EN TOTAL 

            if ($ID_fpo==1) // EJECUTA SI ES EFECTIVO /////////////////////////////////////
            {
             $cja_vef=$ANTERIORMENTE_cja_vef+$fpo_monto;
             $ven_fpo1=1;
              //GURDA LA SUMATORIA 
              $ventaTotal=$ventaTotal+$fpo_monto;
               $ANTERIORMENTE_cja_vta;
                $mcs_movimiento               = "Venta en efectivo realizada atravez del punto de venta"; 

                  
                    //////////////////////TRAE PUESTO DE TRABAJO PARA INSERTAR LOS TOTALES EN LAS CUENTAS PREDETERMINADAS ////
                     $ID_pue=$_SESSION['PUESTO']; 
                     $get_puestosById=$puestos->get_puestosById($ID_pue);
                     $assoc_get_puestosById=mysql_fetch_assoc($get_puestosById);
                     $ID_cue=$assoc_get_puestosById['ID_cue'];
            }
          

        //SI LA FORMA DE PAGO ES CTA CTE

           //MODIFICA LA CAJA EN CTA CTE Y EN VENTA NETA Y EN TOTAL  

            if ($ID_fpo==2) // EJECUTA SI ES CTA CTE /////////////////////////////////////
            {
             $cja_vct=$ANTERIORMENTE_cja_vct+$fpo_monto;
             $ven_fpo2=2;
              //GURDA LA SUMATORIA 

              $ventaTotal=$ventaTotal+$fpo_monto;
             $mcs_movimiento               = "Venta en Cta Cte realizada atravez del punto de venta";

             //////////////////////TRAE PUESTO DE TRABAJO PARA INSERTAR LOS TOTALES EN LAS CUENTAS PREDETERMINADAS ////
                     $ID_pue=$_SESSION['PUESTO']; 
                     $get_puestosByIdB=$puestos->get_puestosById($ID_pue);
                     $assoc_get_puestosByIdB=mysql_fetch_assoc($get_puestosByIdB);
                     $ID_cue=$assoc_get_puestosByIdB['ID_cue'];

            }
            

        //SI LA FORMA DE PAGO ES CREDITO 

          //MODIFICA LA CAJA EN CREDITO Y EN VENTA NETA Y EN TOTAL

            if ($ID_fpo==3) // EJECUTA SI ES TARJETA /////////////////////////////////////
            {

                $get_tarjetas_planesById=$tarjetas_planes->get_tarjetas_planesById($ID_pla);
                $assoc_get_tarjetas_planesById=mysql_fetch_assoc($get_tarjetas_planesById);
                $pla_recargo=$assoc_get_tarjetas_planesById['pla_recargo'];
                $fpo_montoA=($fpo_monto*$pla_recargo)/100;
                $fpo_monto=$fpo_monto+$fpo_montoA;
                $ID_tar=$assoc_get_tarjetas_planesById['ID_tar'];
                $get_tarjetasById=$tarjetas-> get_tarjetasById($ID_tar);
                $assoc_get_tarjetasById=mysql_fetch_assoc($get_tarjetasById);
                $ID_cue=$assoc_get_tarjetasById['tar_cue'];

             $cja_vta=$ANTERIORMENTE_cja_vta+$fpo_monto;
             $ven_fpo3=3;
              //GURDA LA SUMATORIA 
              $ventaTotal=$ventaTotal+$fpo_monto;
              $mcs_movimiento               = "Venta con tarjeta de Crédito realizada atravez del punto de venta";


            }
                  

      //SI LA FORMA DE PAGO ES DEBITO

        //MODIFICA LA CAJA EN DEBITO Y EN VENTA NETA Y EN TOTAL
         
            if ($ID_fpo==4) // EJECUTA SI ES DEBITO /////////////////////////////////////
            {

               $get_tarjetas_planesByIdB=$tarjetas_planes->get_tarjetas_planesById($ID_pla);
                $assoc_get_tarjetas_planesByIdB=mysql_fetch_assoc($get_tarjetas_planesByIdB);
                $pla_recargoB=$assoc_get_tarjetas_planesByIdB['pla_recargo'];
                $fpo_montoAB=($fpo_monto*$pla_recargoB)/100;
                $fpo_monto=$fpo_monto+$fpo_montoAB;
                $ID_tarB=$assoc_get_tarjetas_planesByIdB['ID_tar'];
                $get_tarjetasByIdB=$tarjetas->get_tarjetasById($ID_tarB);
                $assoc_get_tarjetasByIdB=mysql_fetch_assoc($get_tarjetasByIdB);
                $ID_cue=$assoc_get_tarjetasByIdB['tar_cue'];

              $cja_vtad=$ANTERIORMENTE_cja_vtad+$fpo_monto;
              $ven_fpo4=4;
              //GURDA LA SUMATORIA 
              $ventaTotal=$ventaTotal+$fpo_monto;
              $mcs_movimiento               = "Venta con tarjeta de Débito realizada atravez del punto de venta";

            }




             //BUSCA IMPUESTOS DE LA CUENTA PARA INSERTAR MOVIMIENTOS NUEVOS
                      $get_cuentas_impuestosById=$cuentas_impuestosE->get_cuentas_impuestosById($ID_cue);
                      $num_get_cuentas_impuestosById=mysql_num_rows($get_cuentas_impuestosById);
                      for ($insertaImpuestos=0; $insertaImpuestos < $num_get_cuentas_impuestosById; $insertaImpuestos++) 
                      { 
                        $assoc_get_cuentas_impuestosById=mysql_fetch_assoc($get_cuentas_impuestosById);
                        //PREPARA LAS VARIABLE PARA INSERTAR EL MOVIMIENTOS TANTO LAS DE CREDITO COMO LAS DE DEBITO
                        $mcs_movimientoImpuesto=$assoc_get_cuentas_impuestosById['cti_desc'];
                        $ID_cueImpuesto=$ID_cue;
                        $mcd_fecImpuesto=$FechayHora;
                        $mcs_descImpuesto="DESCUENTO AUTOMATIZADO POR EL USUARIO";
                        $mcs_creditoImpuesto=0;
                          //PARA DETERMINAR SI SE LE APLICA AL MONTO UN PORCENTAJE O SE DEBE REGISTRAR UN MONTON FIJO SE EJECUTA EL SIGUIENTE CONDICIONAL
                          if ($assoc_get_cuentas_impuestosById['cti_monto']==0) 
                          {
                            $montoTotalImpuestoA=($fpo_monto*$assoc_get_cuentas_impuestosById['cti_porcentaje'])/100;
                            $mcs_debitoImpuesto=$montoTotalImpuestoA;
                          }
                          else
                          {
                            $mcs_debitoImpuesto=$assoc_get_cuentas_impuestosById['cti_monto'];
                          }  
                          
                        //PARA DEFINIR SI ES DEBITO O CREDITO EJECUTA LA SIGUIENTE FUNCION
                       
                          //SE INSERTA EL MOVIMIENTO ASOCIADO A LA CUENTA
                          $insert_cuentas_movimientosB   = $cuentas_movimientos->insert_cuentas_movimientos($mcs_movimientoImpuesto, $mcs_debitoImpuesto, $mcs_creditoImpuesto, $ID_cueImpuesto, $mcd_fecImpuesto, $mcs_descImpuesto);
                        
                       
                      }

                     
                        $mcs_credito=$fpo_monto;
                        $mcs_debito=0;
                    

                      
                      $mcs_desc                     = "";
                      $mcd_fec                      = $FechayHora;
                      
                      $insert_cuentas_movimientos   = $cuentas_movimientos->insert_cuentas_movimientos($mcs_movimiento, $mcs_debito, $mcs_credito, $ID_cue, $mcd_fec, $mcs_desc);




          //MODIFICA DATOS DE CAJA
        $caj_efectivoReal=0;
        $update_cajaById=$caja->update_cajaById($ID_caj, $ID_control, $ID_usu, $caj_fec, $caj_horaa, $caj_horac, $cja_vta, $cja_vtad, $cja_vct, $cja_vef, $caj_inicio, $caj_cierre, $caj_vne, $ID_suc, $caj_efectivoReal);

      } 

   

         
      ///////MODIFICA EN VENTAS EL TOTAL CON LA SUMATORIA Y SI TIENE DESCUENTO SE LO APLICA ANTES DE MODIFICARLO, EN FORMA DE PAGO CONCATENA LAS FORMAS DE PAGO
      //// 
      //// if ($ven_descuento!=0) 
      ////  {
      ////    $ventaTotalA=($ventaTotal*$ven_descuento)/100;
      ////    $ventaTotalB=$ventaTotal-$ventaTotalA;
      ////  }
      ////  else
      ////  {
      ////    $ventaTotalB=$ventaTotal;
      ////  }  
      /**/    
      /**/    $ven_total=$ventaTotal;
      /**/        if (@$ven_fpo1!="") 
      /**/        {
      /**/         @$ven_fpo1="1";
      /**/        }
      /**/        else
      /**/        {
      /**/         @$ven_fpo1="";
      /**/        }  
      /**/        if (@$ven_fpo2!="") 
      /**/        {
      /**/         @$ven_fpo2=", 2";
      /**/        }
      /**/        else
      /**/        {
      /**/         @$ven_fpo2=""; 
      /**/        }  
      /**/        if (@$ven_fpo3!="") 
      /**/        {
      /**/         @$ven_fpo3=", 3";
      /**/        }
      /**/        else
      /**/        {
      /**/         @$ven_fpo3=""; 
      /**/        }  
      /**/        if (@$ven_fpo4!="") 
      /**/        {
      /**/         @$ven_fpo4=", 4";
      /**/        }
      /**/        else
      /**/        {
      /**/         @$ven_fpo4="";
      /**/        }  
      /**/        $ven_fpo=@$ven_fpo1."".@$ven_fpo2."".@$ven_fpo3."".@$ven_fpo4;
      /**/        $update_ventaById=$venta->update_ventaById($ID_ven, $ven_total, $ven_fpo, $ID_caj, $ven_descuento);
      /**/
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////
          




      //INSERTA NUEVA VENTA 
      $ven_total=0;
      $ven_fpo=1;
      $ven_descuento=0;
      $insert_venta=$venta->insert_venta($ven_total, $ven_fpo, $ID_caj, $ven_descuento);
    
      //REDIRECCIONA
       echo '<script type="text/javascript">
       window.location.assign("cajaSuc.php");
      </script>';
  }  

if ($action=='InsertMovimientosVentas')
  {
    $VentaTotal         = $_POST['VentaTotal'];
    $fpo_monto          = $_POST['montoTotal'];
    $FormaDePago        = $_POST['FormaDePago'];
    $ID_ven             = $_POST['ID_ven'];
 
    $ID_fpo=$FormaDePago; 
    if ($ID_fpo==1)
    {
      $vde_IDasociado   = 0;
      $tarjeta_ID_pla                 = 0;
      $tarjeta_pla_desc               = 0;
      $tarjeta_pla_cant               = 0;
      $tarjeta_pla_recargo            = 0;
    }
    if ($ID_fpo==2) 
    {
        $ID_cli           = $_POST['ID_cli'];
        $ID_cte           = $_POST['ID_cte'];
        $monto            = $fpo_monto;
        $vde_IDasociado   = $_POST['ID_cte'];
        //TRAER CTA CTE POR ID
         $get_cuenta_cteById = $cuenta_cte->get_cuenta_cteById($ID_cte);
         $assoc_get_cuenta_cteById = mysql_fetch_assoc($get_cuenta_cteById);
         $montoB=$assoc_get_cuenta_cteById['cte_monto'];
         $ID_cli=$assoc_get_cuenta_cteById['ID_cli'];
         $get_clientesById=$clientes->get_clientesById($ID_cli);
         $assoc_get_clientesById=mysql_fetch_assoc($get_clientesById);
         $cliente_nombre=$assoc_get_clientesById['cli_nombre'];
         $cliente_apellido=$assoc_get_clientesById['cli_apellido'];
        //MODIFICAR CTA CTE 

         $tarjeta_ID_pla                 = 0;
         $tarjeta_pla_desc               = $cliente_apellido." ".$cliente_nombre; // se utiliza el campo donde se colaca la descripcion de la tarjeta de credito para colocar el nombre y apellido del cliente en el caso de ser cuenta cte, es un detalle que no modifica al funcionamiento pero hace redundante la informacion. 
         $tarjeta_pla_cant               = 0;
         $tarjeta_pla_recargo            = 0;


        $cte_fec=$fechaDeHoy;
        $cte_monto=$monto+$montoB;
        $cte_tipo=1;
        $ID_fpo=2;

        $update_cuenta_cte = $cuenta_cteE->update_cuenta_cteById($ID_cte, $ID_cli, $cte_fec, $cte_monto, $cte_tipo, $ID_fpo);
    }
    if ($ID_fpo==3)
    {
                $monto                          = $fpo_monto;
                $ID_pla                         = $_POST['ID_pla'];
                $get_tarjetas_planesById        = $tarjetas_planesE->get_tarjetas_planesByIdtarjetas($ID_pla);
                $assoc_get_tarjetas_planesById  = mysql_fetch_assoc($get_tarjetas_planesById);
                $tar_tipo                       = $assoc_get_tarjetas_planesById['tar_tipo'];
                $tarjeta_ID_pla                 = $assoc_get_tarjetas_planesById['ID_pla'];
                $ID_tar                         = $assoc_get_tarjetas_planesById['ID_tar'];
                $tarjeta_pla_desc               = $assoc_get_tarjetas_planesById['pla_desc'];
                $tarjeta_pla_cant               = $assoc_get_tarjetas_planesById['pla_cant'];
                $tarjeta_pla_recargo            = $assoc_get_tarjetas_planesById['pla_recargo'];

                if ($tar_tipo==1) 
                {
                  $ID_fpo=3;
                  $vde_IDasociado   =$ID_tar;
                }
                 if ($tar_tipo==2) 
                {
                  $ID_fpo=4;
                  $vde_IDasociado   =$ID_tar;
                }
                
                //MODIFICAR CAJA , VENTA EN CTA Y VENTA TOTAL 
    }

    //verifica si ya esxiste un pago para esta venta con esta forma de pago para modificarlo en vez de sumarlo
    $get_venta_detalleByIdVenYfdp=$venta_detalleE->get_venta_detalleByIdVenYfdp($ID_ven, $FormaDePago);
    $num_get_venta_detalleByIdVenYfdp=mysql_num_rows($get_venta_detalleByIdVenYfdp);
        
        //Si existe una coincidencia modifica el detalle de la venta actual
        if ($num_get_venta_detalleByIdVenYfdp==1) 
        {
          $assoc_get_venta_detalleByIdVenYfdp=mysql_fetch_assoc($get_venta_detalleByIdVenYfdp);
          $fpo_monto=$fpo_monto+$assoc_get_venta_detalleByIdVenYfdp['fpo_monto'];
          $ID_vde=$assoc_get_venta_detalleByIdVenYfdp['ID_vde'];
          $update_venta_detalleById=$venta_detalle->update_venta_detalleById($ID_vde, $ID_ven, $ID_fpo, $fpo_monto, $vde_IDasociado, $tarjeta_ID_pla, $tarjeta_pla_desc, $tarjeta_pla_cant, $tarjeta_pla_recargo);
        }
        //si no existe una coincidencia inserta un nuevo registro
        else
        {
           $insert_venta_detalle=$venta_detalle->insert_venta_detalle($ID_ven, $ID_fpo, $fpo_monto, $vde_IDasociado, $tarjeta_ID_pla, $tarjeta_pla_desc, $tarjeta_pla_cant, $tarjeta_pla_recargo);
        }  

     
echo '<script type="text/javascript">    
window.location.assign("cajaSuc.php");
   </script>';
  } 
if ($action=='aplicarDescuentoVenta')
  {
    $ID_ven = $_POST['ID_ven'];
      $ven_descuento = $_POST['ven_descuento'];
      $get_mov_cajaByIdVen = $mov_cajaE->get_mov_cajaByIdVen($ID_ven);
      $num_get_mov_cajaByIdVen = mysql_num_rows($get_mov_cajaByIdVen);
      $ven_totalA=0;
      for ($count=0; $count < $num_get_mov_cajaByIdVen; $count++) 
      { 
        $assoc_get_mov_cajaByIdVen = mysql_fetch_assoc($get_mov_cajaByIdVen);
        $ven_totalA=$assoc_get_mov_cajaByIdVen['mov_sal']+$ven_totalA;
      }

    $ven_totalB=($ven_totalA*$ven_descuento)/100;
    $ven_total=$ven_totalA-$ven_totalB;
    $update_ventaByIdDescuento=$ventaE->update_ventaByIdDescuento($ID_ven, $ven_total, $ven_descuento);
    echo '<script type="text/javascript">
    window.location.assign("cajaSuc.php?");
    </script>';
  }   
if ($action=='aplicarDescuentoMovimiento')
  {
    $ID_mov = $_POST['ID_mov'];
    $ID_ven = $_POST['ID_ven'];
    $mov_cantidad = $_POST['mov_cantidad'];
    $mov_descuento = $_POST['mov_descuento'];

    $get_mov_cajaById = $mov_cajaE->get_mov_cajaByIdpre_cant($ID_mov);
    $assoc_get_mov_cajaById=mysql_fetch_assoc($get_mov_cajaById);
    $precioVentaAnterior=$assoc_get_mov_cajaById['pre_cant'];
    $mov_salAnterior=$assoc_get_mov_cajaById['mov_sal'];
    $multiplicador=$mov_cantidad*$precioVentaAnterior;

    $nuevoPrecio=($multiplicador*$mov_descuento)/100;
     $mov_sal=$multiplicador-$nuevoPrecio;
     //MODIFICO LA TABLA DE USUARIOS
      $update_mov_cajaById = $mov_cajaE->update_mov_cajaDescuento($ID_mov, $mov_sal, $mov_descuento);

      $get_mov_cajaByIdVen = $mov_cajaE->get_mov_cajaByIdVen($ID_ven);
      $num_get_mov_cajaByIdVen = mysql_num_rows($get_mov_cajaByIdVen);
      $ven_total=0;
      for ($count=0; $count < $num_get_mov_cajaByIdVen; $count++) 
      { 
        $assoc_get_mov_cajaByIdVen = mysql_fetch_assoc($get_mov_cajaByIdVen);
        $ven_total=$assoc_get_mov_cajaByIdVen['mov_sal']+$ven_total;
      }


      $update_ventaByIdSoloTotal=$ventaE->update_ventaByIdSoloTotal($ID_ven, $ven_total);

       echo '<script type="text/javascript">
     window.location.assign("cajaSuc.php?");
     </script>';
    
   }    

if ($action=='editarCliente')
  {
    $ID_cli                    = $_POST['ID_cli'];
    $cli_nombre                = $_POST['cli_nombre'];
    $cli_apellido              = $_POST['cli_apellido'];
    $cli_telefono              = $_POST['cli_telefono'];
    $cli_direccion             = $_POST['cli_direccion'];
    $ID_suc                    = $_POST['ID_suc'];    
    $cli_mail                  = $_POST['cli_mail'];
   
     //MODIFICO LA TABLA DE USUARIOS
      $update_clientes = $clientes->update_clientesById($ID_cli, $cli_nombre, $cli_apellido, $cli_telefono, $cli_direccion, $ID_suc, $cli_mail);

       echo '<script type="text/javascript">
        window.location.assign("modifClientes.php?ID_cli='.$ID_cli.'&M=9");
        </script>';
    
   } 

if ($action=='altaProveedor')
  {

    $pro_desc             =  $_POST['pro_desc'];
    $pro_tel              =  $_POST['pro_tel'];
    $pro_codPostal        =  $_POST['pro_codPostal'];
    $pro_provincia        =  $_POST['pro_provincia'];
    $pro_localidad        =  $_POST['pro_localidad'];
    $pro_dir              =  $_POST['pro_dir'];
    $pro_cuit             =  $_POST['pro_cuit'];
    $pro_catIva           =  $_POST['pro_catIva'];
    $pro_tipo             =  $_POST['pro_tipo'];
    $pro_suss             =  $_POST['pro_suss'];
    $pro_ganancias        =  $_POST['pro_ganancias'];
    $pro_iibb             =  $_POST['pro_iibb'];
    $pro_iva              =  $_POST['pro_iva'];
    $pro_nroIibb          =  $_POST['pro_nroIibb'];
    $pro_acumPagosDelMes  =  $_POST['pro_acumPagosDelMes'];
    $pro_retDelMes        =  $_POST['pro_retDelMes'];
    $pro_condicionPago    =  $_POST['pro_condicionPago'];

    $insert_proveedores=$proveedores->insert_proveedores($pro_desc, $pro_tel, $pro_dir, $pro_codPostal, $pro_provincia, $pro_localidad, $pro_cuit, $pro_catIva, $pro_tipo, $pro_suss, $pro_ganancias, $pro_iibb, $pro_iva, $pro_acumPagosDelMes, $pro_retDelMes, $pro_condicionPago, $pro_nroIibb);


       echo '<script type="text/javascript">
        window.location.assign("proveedores.php?M=6");
        </script>';
  }

  if ($action=='editarProveedor')
  {
    $ID_pro               =  $_POST['ID_pro'];
    $pro_desc             =  $_POST['pro_desc'];
    $pro_tel              =  $_POST['pro_tel'];
    $pro_codPostal        =  $_POST['pro_codPostal'];
    $pro_provincia        =  $_POST['pro_provincia'];
    $pro_localidad        =  $_POST['pro_localidad'];
    $pro_dir              =  $_POST['pro_dir'];
    $pro_cuit             =  $_POST['pro_cuit'];
    $pro_catIva           =  $_POST['pro_catIva'];
    $pro_tipo             =  $_POST['pro_tipo'];
    $pro_suss             =  $_POST['pro_suss'];
    $pro_ganancias        =  $_POST['pro_ganancias'];
    $pro_iibb             =  $_POST['pro_iibb'];
    $pro_iva              =  $_POST['pro_iva'];
    $pro_nroIibb          =  $_POST['pro_nroIibb'];
    $pro_acumPagosDelMes  =  $_POST['pro_acumPagosDelMes'];
    $pro_retDelMes        =  $_POST['pro_retDelMes'];
    $pro_condicionPago    =  $_POST['pro_condicionPago'];

       $update_proveedoresById=$proveedores->update_proveedoresById($ID_pro, $pro_desc, $pro_tel, $pro_dir, $pro_codPostal, $pro_provincia, $pro_localidad, $pro_cuit, $pro_catIva, $pro_tipo, $pro_suss, $pro_ganancias, $pro_iibb, $pro_iva, $pro_acumPagosDelMes, $pro_retDelMes, $pro_condicionPago, $pro_nroIibb);


      echo '<script type="text/javascript">
        window.location.assign("proveedores.php?M=10");
        </script>';
  }


if($action=='eliminarSubYTransferir')
{
  $ID_sub         =  $_POST['ID_sub'];
  $ID_subNuevo   =  $_POST['ID_subNuevo'];

       $get_articulosByIdSub=$articulosE->get_articulosByIdSub($ID_sub);
       $num_get_articulosByIdSub=mysql_num_rows($get_articulosByIdSub);
       for ($countSubcategorias=0; $countSubcategorias < $num_get_articulosByIdSub; $countSubcategorias++) 
       { 
          $assoc_get_articulosByIdSub=mysql_fetch_assoc($get_articulosByIdSub);
          $ID_art=$assoc_get_articulosByIdSub['ID_art'];
          $transfiereArticulos=$articulosE->transfiereArticulos($ID_art, $ID_subNuevo);
       }

         $drop_sub_categoriasById=$sub_categorias->drop_sub_categoriasById($ID_sub);

           echo '<script type="text/javascript">
        window.location.assign("categorias.php?M=8");
        </script>';

}

  if (@$_GET['action']=='eliminarSubCategoria')
  {

      $ID_sub   =  $_GET['ID_sub'];

       $get_articulosByIdSub=$articulosE->get_articulosByIdSub($ID_sub);
       $num_get_articulosByIdSub=mysql_num_rows($get_articulosByIdSub);
       for ($countSubcategorias=0; $countSubcategorias < $num_get_articulosByIdSub; $countSubcategorias++) 
       { 
          $assoc_get_articulosByIdSub=mysql_fetch_assoc($get_articulosByIdSub);
          $ID_art=$assoc_get_articulosByIdSub['ID_art'];
          $drop_articulosById=$articulos->drop_articulosById($ID_art);
       }
    
       $drop_sub_categoriasById=$sub_categorias->drop_sub_categoriasById($ID_sub);

       echo '<script type="text/javascript">
        window.location.assign("categorias.php?M=8");
        </script>';
  }

    if (@$_GET['action']=='eliminarCategoria')
  {

       $ID_cat               =  $_GET['ID_cat'];
    
       $drop_categoriasById=$categorias->drop_categoriasById($ID_cat);

       echo '<script type="text/javascript">
        window.location.assign("categorias.php?M=8");
        </script>';
  }

  if (@$_GET['action']=='EliminarDetalleDeVenta')
  { 

       $ID_vde               =  $_GET['ID_vde'];
       $ID_fpo               =  $_GET['ID_fpo'];
       $fpo_monto            =  $_GET['fpo_monto'];
       $vde_IDasociado       =  $_GET['vde_IDasociado'];
        if ($ID_fpo==2) 
        {
         $monto            = $fpo_monto;
         $ID_cte           = $vde_IDasociado;
          //TRAER CTA CTE POR ID
           $get_cuenta_cteById = $cuenta_cte->get_cuenta_cteById($ID_cte);
           $assoc_get_cuenta_cteById = mysql_fetch_assoc($get_cuenta_cteById);
           $montoB=$assoc_get_cuenta_cteById['cte_monto'];
           $ID_cli=$assoc_get_cuenta_cteById['ID_cli'];
          //MODIFICAR CTA CTE 

          $cte_fec=$fechaDeHoy;
          $cte_monto=$montoB-$monto;
          $cte_tipo=1;
          $ID_fpo=2;

          $update_cuenta_cte = $cuenta_cteE->update_cuenta_cteById($ID_cte, $ID_cli, $cte_fec, $cte_monto, $cte_tipo, $ID_fpo);
        }


       $drop_venta_detalleById=$venta_detalle->drop_venta_detalleById($ID_vde);

       echo '<script type="text/javascript">
        window.location.assign("cajaSuc.php?M=8");
        </script>';
  }


    if (@$_GET['action']=='BorrarProveedor')
  {

        $ID_pro               =  $_GET['ID_pro'];
    
        $drop_proveedoresById=$proveedores->drop_proveedoresById($ID_pro);

        echo '<script type="text/javascript">
        window.location.assign("proveedores.php?M=8");
        </script>';
  }


 
if ($action=='editarUsuario')
  {
    $ID_usu                   = $_POST['ID_usu'];
    $usu_nombre               = $_POST['usu_nombre'];
    $usu_apellido             = $_POST['usu_apellido'];
    $usu_usuario              = $_POST['usu_usuario'];
    $usu_clave                = $_POST['usu_clave'];
    $usu_tipo                 = $_POST['usu_tipo'];

    

    if (@$_POST['sobrantes']==1) 
    {
      $usu_sobrantes               = 1;
    }
    else
   {
    $usu_sobrantes                 = 0;
   }   

    if (@$_POST['descuentos']==1) 
    {
      $usu_descuento                = 1;
    }
    else
   {
      $usu_descuento                 = 0;
   }   
   
    //TRAIGO EL TIPO DE USUARIO ANTES DE SER MODIFICADO PARA COMPARARLOS
    $get_usuariosById = $usuarios->get_usuariosById($ID_usu);
    $assoc_get_usuariosById = mysql_fetch_assoc($get_usuariosById);
    $usu_tipo_anterior=$assoc_get_usuariosById['usu_tipo'];

     //MODIFICO LA TABLA DE USUARIOS
      $update_usuarios = $usuarios->update_usuariosById($ID_usu, $usu_nombre, $usu_apellido, $usu_usuario, $usu_clave, $usu_tipo, $usu_descuento, $usu_sobrantes);

      //COMPARO EL TIPO DE USUARIO ENVIADO POR EL FORMULARIO CON EL TIPO DE USUARIO SALVADO ANTERIORMENTE, SI COINCIDEN REDIRECCIONO, EN CASO CONTRARIO EJECUTO EL PROCESO DE QUITAR LOS PERMISOS ANTIGUOS Y ASIGNAR NUEVOS
      if ($usu_tipo_anterior!=$usu_tipo)
      {
         //TRAIGO TODOS LOS PERMISOS CREADOS PARA ESTE USUARIO
          $get_permisosE =$permisosE->get_permisosE($ID_usu);
          $num_get_permisos = mysql_num_rows($get_permisosE);

          //ELIMINO TODOS LOS PERMISOS DE ESTE USUARIO
          for ($countPermisos=0; $countPermisos < $num_get_permisos; $countPermisos++) 
          { 
            $assoc_get_permisos = mysql_fetch_assoc($get_permisosE);
            $ID_per=$assoc_get_permisos['ID_per'];
            $drop_permisos = $permisos->drop_permisosById($ID_per);
          }

          //INSERTO NUEVOS PERMISOS SEGUN EL TIPO DE USUARIO QUE SE HAYA SELECCIONADO
          if ($usu_tipo=='1') 
          {
           $ID_mod='1';
          }
          if ($usu_tipo=='3') 
          {
           $ID_modE='1';
           $ID_mod='3';
           $ID_modC='4';
           $ID_modD='6';

           $ID_modJ='7';
           $ID_modF='8';
           $ID_modG='9';
           $ID_modH='10';
           $ID_modI='11';
           $ID_modK='12';

           $insert_permisosC  = $permisos->insert_permisos($ID_usu, $ID_modC);
           $insert_permisosD  = $permisos->insert_permisos($ID_usu, $ID_modD);
           $insert_permisosE  = $permisos->insert_permisos($ID_usu, $ID_modE);

           $insert_permisosJ  = $permisos->insert_permisos($ID_usu, $ID_modJ);
           $insert_permisosF  = $permisos->insert_permisos($ID_usu, $ID_modF);
           $insert_permisosG  = $permisos->insert_permisos($ID_usu, $ID_modG);
           $insert_permisosH  = $permisos->insert_permisos($ID_usu, $ID_modH);
           $insert_permisosI  = $permisos->insert_permisos($ID_usu, $ID_modI);
           $insert_permisosK  = $permisos->insert_permisos($ID_usu, $ID_modK);
          }
            $insert_permisos  = $permisos->insert_permisos($ID_usu, $ID_mod);
            $ID_modB='5';
            $insert_permisosB = $permisos->insert_permisos($ID_usu, $ID_modB);
       
      } 

       echo '<script type="text/javascript">
        window.location.assign("modifUsuarios.php?M=10&ID_usu='.$ID_usu.'");
        </script>';
    
   } 

if (@$_GET['action']=='EliminarUsuario')
  {
  
    $ID_usu = $_GET['ID_usu'];

    //ELIMINO LOS DATOS DEL USUARIO
    $drop_usuarios = $usuarios->drop_usuariosById($ID_usu);

      //TRAIGO TODOS LOS PERMISOS CREADOS PARA ESTE USUARIO
      $get_permisosE =$permisosE->get_permisosE($ID_usu);
      $num_get_permisos = mysql_num_rows($get_permisosE);

          //ELIMINO TODOS LOS PERMISOS DE ESTE USUARIO
          for ($countPermisos=0; $countPermisos < $num_get_permisos; $countPermisos++) 
          { 
            $assoc_get_permisos = mysql_fetch_assoc($get_permisosE);
            $ID_per=$assoc_get_permisos['ID_per'];
            $drop_permisos = $permisos->drop_permisosById($ID_per);
          }

           echo '<script type="text/javascript">
       window.location.assign("usuarios.php?&M=8");
       </script>';
 } 

if (@$_GET['action']=='EliminarClientes')
  {
  
    $ID_cli = $_GET['ID_cli'];

    //ELIMINO LOS DATOS DEL USUARIO
    $drop_clientes = $clientes->drop_clientesById($ID_cli);

           echo '<script type="text/javascript">
       window.location.assign("usuarios.php?&M=9");
       </script>';
 } 

if ($action=='nuevoCliente')
  {
    $cli_nombre                = $_POST['cli_nombre'];
    $cli_apellido              = $_POST['cli_apellido'];
    $cli_telefono              = $_POST['cli_telefono'];
    $cli_direccion             = $_POST['cli_direccion'];
    $ID_suc                    = $_POST['ID_suc'];    
    $cli_mail                  = $_POST['cli_mail'];
    $cte_fec                   = $fechaDeHoy;
    $cte_tipo                  =  1;
    $ID_fpo                    =  2;
    $cte_monto                 =  '00.00';

    $insert_clientes = $clientes->insert_clientes($cli_nombre, $cli_apellido, $cli_telefono, $cli_direccion, $ID_suc, $cli_mail);

    $get_ultimoCliente=$clientesE->get_ultimoCliente();
    $assoc_get_ultimoCliente=mysql_fetch_assoc($get_ultimoCliente);
    $ID_cli=$assoc_get_ultimoCliente['ID_cli'];
    
    $insert_cuenta_cte = $cuenta_cte->insert_cuenta_cte($ID_cli, $cte_fec, $cte_monto, $cte_tipo, $ID_fpo);
       echo '<script type="text/javascript">
             window.location.assign("usuarios.php?&M=7");
             </script>';
    
  } 

if ($action=='nuevoUsuario')
  {
    $usu_nombre               = $_POST['usu_nombre'];
    $usu_apellido             = $_POST['usu_apellido'];
    $usu_usuario              = $_POST['usu_usuario'];
    $usu_clave                = $_POST['usu_clave'];
    $usu_tipo                 = $_POST['usu_tipo'];
   
    $insert_usuarios = $usuarios->insert_usuarios($usu_nombre, $usu_apellido, $usu_usuario, $usu_clave, $usu_tipo);

    //TRAIGO EL TIPO DE USUARIO POR ID USU Y GUARDO EL TIPO EN UNA VARIABLE
     $get_usuariosUsuariosUltimo         = $usuariosE->get_usuariosUsuariosUltimo();
     $assoc_get_usuariosUsuariosUltimo   = mysql_fetch_assoc($get_usuariosUsuariosUltimo);
     $ID_usu                             = $assoc_get_usuariosUsuariosUltimo['ID_usu'];
     $usu_tipo                           = $assoc_get_usuariosUsuariosUltimo['usu_tipo'];

           //INSERTO NUEVOS PERMISOS SEGUN EL TIPO DE USUARIO QUE SE HAYA SELECCIONADO
          if ($usu_tipo=='1') 
          {
           $ID_mod='1';
          }
          if ($usu_tipo=='3') 
          {
           
           $ID_modE='1';
           $ID_mod='3';
           $ID_modC='4';
           $ID_modD='6';

           $ID_modJ='7';
           $ID_modF='8';
           $ID_modG='9';
           $ID_modH='10';
           $ID_modI='11';
           $ID_modK='12';
           $insert_permisosC  = $permisos->insert_permisos($ID_usu, $ID_modC);
           $insert_permisosD  = $permisos->insert_permisos($ID_usu, $ID_modD);
           $insert_permisosE  = $permisos->insert_permisos($ID_usu, $ID_modE);

           $insert_permisosJ  = $permisos->insert_permisos($ID_usu, $ID_modJ);
           $insert_permisosF  = $permisos->insert_permisos($ID_usu, $ID_modF);
           $insert_permisosG  = $permisos->insert_permisos($ID_usu, $ID_modG);
           $insert_permisosH  = $permisos->insert_permisos($ID_usu, $ID_modH);
           $insert_permisosI  = $permisos->insert_permisos($ID_usu, $ID_modI);
           $insert_permisosK  = $permisos->insert_permisos($ID_usu, $ID_modK);
          }
            $insert_permisos  = $permisos->insert_permisos($ID_usu, $ID_mod);
            $ID_modB='5';
            $insert_permisosB = $permisos->insert_permisos($ID_usu, $ID_modB);
     

       echo '<script type="text/javascript">
             window.location.assign("usuarios.php?&M=6");
             </script>';
    
  } 

if ($action=='Get_usuarios')
  {
    $clientes     = $_POST['get_clientes'];
    $volver       = $_POST['volver'];
    $SoloClientes = $_POST['SoloClientes'];
    $SoloUsuarios = $_POST['SoloUsuarios'];
    $num_search   = strlen($clientes);

   
 


      echo "<table class='table table-condensed table-hover table-striped' style='text-align: center;'>";
                echo "<thead>";
                  echo "<tr>";
                    echo "<th style='text-align: center;'>Tipo</th>";
                    echo "<th style='text-align: center;'>Nombre</th>";
                    echo "<th style='text-align: center;'>Direccion</th>";
                    echo "<th style='text-align: center;'>Telefono</th>";
                    echo "<th style='text-align: center;'>usuario</th>";
                    echo "<th style='text-align: center;'>Clave</th>";
                    echo "<th style='text-align: center;'>Permisos</th>";
                    echo "<th style='text-align: center;'>Sucursal</th>";
                    echo "<th style='text-align: center;'>Email</th>";
                    echo "<th style='text-align: center;'>Habilitado a realizar Descuentos</th>";
                    echo "<th style='text-align: center;'>Habilitado a visualizar Sobrantes</th>";
                    echo "<th style='text-align: center;' colspan='2'>Configurar</th>";
                  echo "</tr>";
               echo " </thead>";
               echo " <tbody>";


                if (!$SoloClientes AND !$SoloUsuarios) 
                {
                  
                 $get_usuariosUsuariosYclientes=$usuariosE->get_usuariosUsuariosYclientes($clientes);
                 $num_get_usuariosUsuariosYclientes=mysql_num_rows($get_usuariosUsuariosYclientes);

                      for ($CountUsuarios=0; $CountUsuarios < $num_get_usuariosUsuarios; $CountUsuarios++) 
                        { 
                          if ($num_search>=2)
                          {
                              $assoc_usuarios=mysql_fetch_assoc($get_usuariosUsuarios);

                                if ($assoc_usuarios['usu_tipo']==1) 
                                {
                                  $Tipo="Cajero";
                                }
                                if ($assoc_usuarios['usu_tipo']==2) 
                                {
                                  $Tipo="Indefinido";
                                }
                                if ($assoc_usuarios['usu_tipo']==3) 
                                {
                                  $Tipo="Administrador";
                                }

                                if ($assoc_usuarios['usu_descuento']==1) 
                                {
                                  $Descuento="Si";
                                }
                                 if ($assoc_usuarios['usu_descuento']==0) 
                                {
                                  $Descuento="No";
                                }

                                 if ($assoc_usuarios['usu_sobrante']==1) 
                                {
                                  $Sobrante="Si";
                                }
                                 if ($assoc_usuarios['usu_sobrante']==0) 
                                {
                                  $Sobrante="No";
                                }

                                echo "<tr class='success'>";
                                 echo "<th style='text-align: center;'>Usuario</th>";
                                echo "<th style='text-align: center;'>".$assoc_usuarios['usu_nombre']." ".$assoc_usuarios['usu_apellido']."</th>";
                                echo "<th style='text-align: center;'></th>";
                                echo "<th style='text-align: center;'></th>";
                                echo "<th style='text-align: center;'>".$assoc_usuarios['usu_usuario']."</th>";
                                echo "<th style='text-align: center;'>".$assoc_usuarios['usu_clave']."</th>";
                                echo "<th style='text-align: center;'>".$Tipo."</th>";
                                echo "<th style='text-align: center;'></th>";
                                echo "<th style='text-align: center;'></th>";

                                echo "<th style='text-align: center;'>".$Descuento."</th>";
                                echo "<th style='text-align: center;'>".$Sobrante."</th>";
                                echo "<th style='text-align: center;' ><a href='modifUsuarios.php?ID_usu=".$assoc_usuarios['ID_usu']."'><button class='btn btn-primary'  data-toggle='modal' title='Confirma modificaciones' data-placement='top' data-target='#editar".$assoc_usuarios['ID_usu']."'><i class='material-icons'>edit</i></button></a></th>";
                                echo "<th style='text-align: center;'><a href='accionesExclusivas.php?ID_usu=".$assoc_usuarios['ID_usu']."&action=EliminarUsuario'><button class='btn btn-danger'><i class='material-icons'>delete_forever</i></button></a></th>";
                                echo "</tr>";
                             }          
                        }   
                    
                        for ($CountClientes=0; $CountClientes < $num_get_usuariosClientes; $CountClientes++)
                        { 
                            if ($num_search>=2)
                            {
                                $assoc_Clientes=mysql_fetch_assoc($get_usuariosClientes);

                                echo "<tr class='info'>";
                                 echo "<th style='text-align: center;'>Cliente</th>";
                                    echo "<th style='text-align: center;'>
                                            ".$assoc_Clientes['cli_nombre']." ".$assoc_Clientes['cli_apellido']."
                                          </th>";
                                    echo "<th style='text-align: center;'>".$assoc_Clientes['cli_direccion']."</th>";
                                    echo "<th style='text-align: center;'>".$assoc_Clientes['cli_telefono']."</th>";
                                    echo "<th style='text-align: center;'></th>";
                                    echo "<th style='text-align: center;'></th>";

                                    echo "<th style='text-align: center;'>".$assoc_Clientes['ID_suc']."</th>";

                                    echo "<th style='text-align: center;'>".$assoc_Clientes['cli_mail']."</th>";
                                    echo "<th style='text-align: center;'></th>";
                                    echo "<th style='text-align: center;'></th>";
                                    echo "<th style='text-align: center;' ><a href='modifClientes.php?ID_cli=".$assoc_Clientes['ID_cli']."'><button class='btn btn-primary'  data-toggle='modal' title='Confirma modificaciones' data-placement='top' data-target='#editar".$assoc_Clientes['ID_cli']."'><i class='material-icons'>edit</i></button></a></th>";
                                    echo "<th style='text-align: center;'><a href='accionesExclusivas.php?ID_cli=".$assoc_Clientes['ID_cli']."&action=EliminarClientes'><button class='btn btn-danger'><i class='material-icons'>delete_forever</i></button></a></th>";
                                 echo "</tr>";
                             }          
                          } 

                }

               if ($SoloUsuarios=="si") 
                {
                   $get_usuariosUsuarios=$usuariosE->get_usuariosUsuarios($clientes);
                    $num_get_usuariosUsuarios=mysql_num_rows($get_usuariosUsuarios);

                  for ($CountUsuarios=0; $CountUsuarios < $num_get_usuariosUsuarios; $CountUsuarios++) 
                    { 
                      if ($num_search>=2)
                      {
                          $assoc_usuariosB=mysql_fetch_assoc($get_usuariosUsuarios);

                          if ($assoc_usuariosB['usu_tipo']==1) 
                          {
                            $Tipo="Cajero";
                          }
                          if ($assoc_usuariosB['usu_tipo']==2) 
                          {
                            $Tipo="Indefinido";
                          }
                          if ($assoc_usuariosB['usu_tipo']==3) 
                          {
                            $Tipo="Administrador";
                          }

                             if ($assoc_usuariosB['usu_descuento']==1) 
                                {
                                  $DescuentoB="Si";
                                }
                                 if ($assoc_usuariosB['usu_descuento']==0) 
                                {
                                  $DescuentoB="No";
                                }

                                if ($assoc_usuariosB['usu_sobrantes']==1) 
                                {
                                  $SobranteB="Si";
                                }
                                 if ($assoc_usuariosB['usu_sobrantes']==0) 
                                {
                                  $SobranteB="No";
                                }

                         

                            echo "<tr class='success'>";
                             echo "<th style='text-align: center;'>Usuario</th>";
                            echo "<th style='text-align: center;'>".$assoc_usuariosB['usu_nombre']." ".$assoc_usuariosB['usu_apellido']."</th>";
                            echo "<th style='text-align: center;'></th>";
                            echo "<th style='text-align: center;'></th>";
                            echo "<th style='text-align: center;'>".$assoc_usuariosB['usu_usuario']."</th>";
                            echo "<th style='text-align: center;'>".$assoc_usuariosB['usu_clave']."</th>";
                            echo "<th style='text-align: center;'>".$Tipo."</th>";
                            echo "<th style='text-align: center;'></th>";
                            echo "<th style='text-align: center;'></th>";
                            echo "<th style='text-align: center;'>".$DescuentoB."</th>";
                             echo "<th style='text-align: center;'>".$SobranteB."</th>";
                            echo "<th style='text-align: center;' ><a href='modifUsuarios.php?ID_usu=".$assoc_usuariosB['ID_usu']."'><button class='btn btn-primary'  data-toggle='modal' title='Confirma modificaciones' data-placement='top' data-target='#editar".$assoc_usuariosB['ID_usu']."'><i class='material-icons'>edit</i></button></a></th>";
                            echo "<th style='text-align: center;'><a href='accionesExclusivas.php?ID_usu=".$assoc_usuariosB['ID_usu']."&action=EliminarUsuario'><button class='btn btn-danger'><i class='material-icons'>delete_forever</i></button></a></th>";
                            echo "</tr>";
                         }          
                    }       

                }  
                if ($SoloClientes=="si") 
                  {
                        $get_usuariosClientesB=$usuariosE->get_usuariosClientes($clientes);
                        $num_get_usuariosClientesB=mysql_num_rows($get_usuariosClientesB);

                    for ($CountClientes=0; $CountClientes < $num_get_usuariosClientesB; $CountClientes++)
                    { 
                        if ($num_search>=2)
                        {
                            $assoc_Clientes=mysql_fetch_assoc($get_usuariosClientesB);

                            echo "<tr class='info'>";
                             echo "<th style='text-align: center;'>Cliente</th>";
                                echo "<th style='text-align: center;'>
                                        ".$assoc_Clientes['cli_nombre']." ".$assoc_Clientes['cli_apellido']."
                                      </th>";
                                echo "<th style='text-align: center;'>".$assoc_Clientes['cli_direccion']."</th>";
                                echo "<th style='text-align: center;'>".$assoc_Clientes['cli_telefono']."</th>";
                                echo "<th style='text-align: center;'></th>";
                                echo "<th style='text-align: center;'></th>";
                                 echo "<th style='text-align: center;'></th>";

                                echo "<th style='text-align: center;'>".$assoc_Clientes['ID_suc']."</th>";

                                echo "<th style='text-align: center;'>".$assoc_Clientes['cli_mail']."</th>";
                                echo "<th style='text-align: center;'></th>";
                                echo "<th style='text-align: center;'></th>";
                                echo "<th style='text-align: center;' ><a href='modifClientes.php?ID_cli=".$assoc_Clientes['ID_cli']."'><button class='btn btn-primary'  data-toggle='modal' title='Confirma modificaciones' data-placement='top' data-target='#editar".$assoc_Clientes['ID_cli']."'><i class='material-icons'>edit</i></button></a></th>";
                                echo "<th style='text-align: center;'><a href='accionesExclusivas.php?ID_cli=".$assoc_Clientes['ID_cli']."&action=EliminarClientes'><button class='btn btn-danger'><i class='material-icons'>delete_forever</i></button></a></th>";
                             echo "</tr>";
                         }          
                      } 
                     }
                      echo " </tbody>";
                          echo " <tfoot>";
                            echo "<tr>";
                              echo "<th style='text-align: center;'>Tipo</th>";
                              echo "<th style='text-align: center;'>Nombre</th>";
                              echo "<th style='text-align: center;'>Direccion</th>";
                              echo "<th style='text-align: center;'>Telefono</th>";
                              echo "<th style='text-align: center;'>usuario</th>";
                              echo "<th style='text-align: center;'>Clave</th>";
                              echo "<th style='text-align: center;'>Permisos</th>";
                              echo "<th style='text-align: center;'>Sucursal</th>";
                              echo "<th style='text-align: center;'>Email</th>";
                              echo "<th style='text-align: center;'>Habilitado a realizar Descuentos</th>";
                              echo "<th style='text-align: center;'>Habilitado a visualizar Sobrantes</th>";
                              echo "<th style='text-align: center;' colspan='2'>Configurar</th>";
                            echo "</tr>";
                          echo "</tfoot>";
                    echo "</table>";
  } 





if ($action=='get_sucursalesExclusiva')
{
  $get_sucursales = $sucursales->get_sucursales();
  $num_get_sucursales = mysql_num_rows($get_sucursales);
  echo '<div class="col-md-2" ></div>';
for ($action_get_sucursales=0; $action_get_sucursales< $num_get_sucursales; $action_get_sucursales++)
    {
      $assoc_get_sucursales = mysql_fetch_assoc($get_sucursales);

      $ID_suc=$assoc_get_sucursales['ID_suc'];
      $suc_desc=$assoc_get_sucursales['suc_desc'];
      $suc_icono=$assoc_get_sucursales['suc_icono'];
      $suc_url=$assoc_get_sucursales['suc_url'];
      echo '<a href="'.$suc_url.'" ><div class="col-md-2" id="linkSucursales">';       
      echo "<img src='".$suc_icono."' style='width:100%;'>";
      echo "<p id='descripcionSucursal'>".$suc_desc."</p>";
      echo '</div></a>';     
       
    }
    echo '<div class="col-md-2" ></div>';
}

if ($action=='get_sucursalesItem')
{
  $get_sucursales = $sucursales->get_sucursales();
  $num_get_sucursales = mysql_num_rows($get_sucursales);

for ($action_get_sucursales=0; $action_get_sucursales< $num_get_sucursales; $action_get_sucursales++)
    {
      $assoc_get_sucursales = mysql_fetch_assoc($get_sucursales);

      $ID_suc=$assoc_get_sucursales['ID_suc'];
      $suc_desc=$assoc_get_sucursales['suc_desc'];
      $suc_icono=$assoc_get_sucursales['suc_icono'];
      $suc_url=$assoc_get_sucursales['suc_url'];
     
 
      if ($_SERVER['REQUEST_URI']==$suc_url) 
      {
        $active="active";
      }
      else
      {
        $active="";
      }


      echo '<li class="'.$active.'"><a href="'.$suc_url.'"><img src="'.$suc_icono.'" style="width:30%;">'.$suc_desc.'</a></li>'; 

     
       
    }
}

if ($action=='insert_caja')
{
$ID_control=0;
$ID_usu=$ID_usu;
$caj_fec=$fechaDeHoy;
$caj_horaa=$HoraDeHoy;
$caj_horac='00:00:00';
$cja_vta=0;
$cja_vtad=0;
$cja_vct=0;
$cja_vef=0;
$caj_inicio=$_POST['caj_inicio'];
$caj_cierre=0;
$caj_vne=0;
$ID_suc=$_POST['ID_suc'];
$caj_efectivoReal=0;
  //Inserta caja nueva
  $insert_caja = $caja->insert_caja($ID_control, $ID_usu, $caj_fec, $caj_horaa, $caj_horac, $cja_vta, $cja_vtad, $cja_vct, $cja_vef, $caj_inicio, $caj_cierre, $caj_vne, $ID_suc, $caj_efectivoReal);

   //Trae ID de caja nueva
  $get_caja_UltimaByUsu=$cajaE->get_caja_UltimaByUsu($ID_usu);
  $assoc_get_caja_UltimaByUsu=mysql_fetch_assoc($get_caja_UltimaByUsu);
  $ID_caj=$assoc_get_caja_UltimaByUsu['ID_caj'];
  $ven_total=0;
  $ven_fpo=1;
  //Inserta nueva venta
  $insert_venta=$venta->insert_venta($ven_total, $ven_fpo, $ID_caj);
  echo '<script type="text/javascript">
  window.location.assign("cajaSuc.php?M=3");
  </script>';
  //header('Location: cajaSuc.php?M=3');
}

if (@$_GET['action']=='drop_movimiento')
{
    //Trae variebles
    $ID_ven           = $_GET['ID_ven'];
    $ID_art           = $_GET['ID_art'];
    $ven_total        = $_GET['ven_total'];
    $multiplicacion   = $_GET['multiplicacion'];  
    $mov_cantidad     = $_GET['mov_cantidad'];
    $resto            = $ven_total-$multiplicacion;  
    //elimina los movimientos que forman el grupo de un articulo
    $drop_mov_cajaById = $mov_cajaE->drop_mov_cajaById($ID_ven, $ID_art);
    //restan el total del grupo del total de la venta
    $update_ventaByIdMonto = $ventaE->update_ventaByIdMonto($ID_ven, $resto);
    //Inserta en tabla de movimientos cancelados
    @$ID_caj=$_GET['ID_caj'];
    @$ID_art=$_GET['ID_art'];
    $insert_ventas_canceladas=$ventas_canceladas->insert_ventas_canceladas($ID_caj, $ID_art);

     //INICIO: Inserto nuevo registro en la tabla de movimientos de Stock

    //Traigo los datos de la caja
    $get_cajaById       = $caja->get_cajaById($ID_caj);
    $assoc_get_cajaById = mysql_fetch_assoc($get_cajaById);

    $sto_mov            = 1; // 1=Ingreso de stock / 2=Egreso de stock
    //$ID_art           = ;
    $sto_desc           = " " . $_SESSION['usu_nombre'] . " " . $_SESSION['usu_apellido'] . " Elimino un movimiento";
    $sto_fec            = $FechayHora;
    $ID_suc             = $assoc_get_cajaById['ID_suc'];
    //$ID_usu           = ;
    $sto_cant           = $mov_cantidad;

    //calcula Stock total para guardarlo en la columna sto_total
      //Para ello trae todos los movimientos de stock por articulo y sucursal dentro de un for suma los sto_mov 1, resta los sto_mov 2 y luego resta los totales.
    $get_stockByIdArtUltimo        = $stockE->get_stockByIdArtUltimo($ID_art, $ID_suc);
    $assoc_get_stockByIdArtUltimo  = mysql_fetch_assoc($get_stockByIdArtUltimo);

    if ($sto_mov==2) 
    {
        $sto_total            = $assoc_get_stockByIdArtUltimo['sto_total']-$sto_cant;
    }
    else
    {
        $sto_total            = $assoc_get_stockByIdArtUltimo['sto_total']+$sto_cant;
    }  

   //CAMBIAR EL SIMBOLO SEGUN sto_mov

    $insert_stock         = $stock->insert_stock($sto_mov, $ID_art, $sto_desc, $sto_fec, $ID_suc, $ID_usu, $sto_cant, $sto_total);

    //FIN: Inserto nuevo registro en la tabla de movimientos de Stock

echo '<script type="text/javascript">
window.location.assign("cajaSuc.php");
</script>';
  //header('Location: cajaSuc.php');  
}


if ($action=='Efectivo')
{
  $MontoEfectivo=$_POST['MontoEfectivo'];
  $ven_total=$_POST['ven_total'];
  $total=$MontoEfectivo-$ven_total;
  

  if ($total>=0)
   {
   
    echo '<div class="alert alert-warning alert-dismissable" style="margin:4%; font-size: 150%;">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
     <p> <i class="material-icons">swap_horiz</i> Su vuelto es:</p><p style="font-size: 200%;">$'.$total.'</p> 
  </div>';

  }
}
  if ($action=='cerrarVentaEfectivo')
  {

    $cja_vefA=$_POST['ven_totalFin'];
    $ID_ven=$_POST['ID_ven'];
    //Trae la ultima caja abierta por usuario 
    $get_caja_UltimaByUsu =$cajaE->get_caja_UltimaByUsu($ID_usu);
    $assoc_get_caja_UltimaByUsu=mysql_fetch_assoc($get_caja_UltimaByUsu);
    
    $ID_caj=$assoc_get_caja_UltimaByUsu['ID_caj'];
    $cja_vefB=$assoc_get_caja_UltimaByUsu['cja_vef'];
    $caj_vneB=$assoc_get_caja_UltimaByUsu['caj_vne'];

    $get_mov_caja_netos=$mov_cajaE->get_mov_caja_netos($ID_ven, $ID_caj);
    $assoc_get_mov_caja_netos=mysql_fetch_assoc($get_mov_caja_netos);
    $caj_vneA=$assoc_get_mov_caja_netos['neto'];

    //Suma los montos 
    $cja_vef=$cja_vefA+$cja_vefB;
    $caj_vne=$caj_vneB+$caj_vneA;

    //Modifica los montos en la caja solo los montos en efectivo y los totales
    $update_cajaE = $cajaE->update_caja($ID_caj, $cja_vef, $caj_vne);

    //Inserta nueva Venta
    $ven_total=0;
    $ven_fpo=1; // Tipo de venta en Efectivo 
    $insert_venta = $venta->insert_venta($ven_total, $ven_fpo, $ID_caj); 

    echo '<script type="text/javascript">
    window.location.assign("cajaSuc.php?M=4");
    </script>';
    //header('Location: cajaSuc.php?M=4');
  }  
   if ($action=='Get_clientes')
  {
    $clientes           = $_POST['get_clientes'];
    $ven_totalClientes  = $_POST['ven_totalClientes'];
    $ID_ven             = $_POST['ID_venClientes'];
    $ID_caj             = $_POST['ID_caj'];
    $num_search = strlen($clientes);
    $get_clientes_byNombreYApellido=$clientesE->get_clientes_byNombreYApellido($clientes);
    $num_get_clientes_byNombreYApellido=mysql_num_rows($get_clientes_byNombreYApellido);

        for ($CountClientes=0; $CountClientes < $num_get_clientes_byNombreYApellido; $CountClientes++) 
        { 
          if ($num_search>=2)
          {
          $assoc_get_clientes_byNombreYApellido=mysql_fetch_assoc($get_clientes_byNombreYApellido);
           echo "<button type='button' class='btn btn-success' id='clientes".$assoc_get_clientes_byNombreYApellido['ID_cli']."' name='clientes' style='height: auto; width: 100%; margin-top: 30px; text-align:center;'> ".$assoc_get_clientes_byNombreYApellido['cli_apellido']. " " .$assoc_get_clientes_byNombreYApellido['cli_nombre']."</button>";

           echo "<div class='cols-md-12' id='mostradorDeDatosDeCliente' style='display:none; text-align:center; margin-top:6%;'>";
            echo "<p><strong>".$assoc_get_clientes_byNombreYApellido['cli_apellido']. " " .$assoc_get_clientes_byNombreYApellido['cli_nombre']."</strong></p>";
             echo '<hr>';
                echo "<div class='col-md-6'>"; 
                echo "DEBE:"; 
                 echo "</div>";
                 echo "<div class='col-md-6'>";
                 echo "$ ".$assoc_get_clientes_byNombreYApellido['cte_monto'];
                 echo "</div>";
                 echo "<div class='col-md-8' style='font-size:50%; text-align:center;'>";
                 echo "Ultima Modificación:"; 
                 echo "</div>";
                 echo "<div class='col-md-4' style='font-size:50%; text-align:center;'>";
                 echo $assoc_get_clientes_byNombreYApellido['cte_fec'];
                echo "</div>";  

                echo "<input hidden type='text' name='ID_cli' value='".$assoc_get_clientes_byNombreYApellido['ID_cli']."'>"; 
                echo "<input hidden type='text' name='ID_cte' value='".$assoc_get_clientes_byNombreYApellido['ID_cte']."'>"; 
                
               
                 echo "<div class='col-md-12'>"; 
                 if ($ven_totalClientes==0)
                 {
                 echo "<form action='accionesExclusivas.php' method='POST'>
                 
                 <br>
                 <input type='text' class='form-control' name='monto' placeholder='00.00'>
                 <input hidden type='text' name='action' value='saldar'>
                 <input hidden type='text' name='ID_cte' value='".$assoc_get_clientes_byNombreYApellido['ID_cte']."'>
                 
                 <button type='submit' class='btn btn-primary' id='SaldarACtaCte".$assoc_get_clientes_byNombreYApellido['ID_cli']."' name='SaldarACtaCte' style='height: auto; width: 100%; margin-top: 30px; text-align:center;'>Saldar</button>
                 </form>";
                 echo "</div>";
                  }
           echo "</div>";
           echo "<form action='accionesExclusivas.php' method='POST'>"; 
           echo "<div class='col-md-12' id='formularioCteMixto".$assoc_get_clientes_byNombreYApellido['ID_cli']."' style='display:none; margin-top: 30px; font-size:80%;'>"; 
            echo "<div class='col-md-7'>"; 
                echo "A PAGAR:"; 
                 echo "</div>";
                 echo "<div class='col-md-5'>";
                 echo "$ ".$ven_totalClientes;
                 echo "</div>";
                 echo "<div class='col-md-7'>"; 
                echo "<hr>"; 
                 echo "</div>";
                  echo "<div class='col-md-12' style='margin-top:20px;'>";  
                echo "<div class='col-md-7'>"; 
                echo "En Efectivo:"; 
                 echo "</div>";
                 echo "<div class='col-md-5'>";
                 echo "<input class='form-control' type='text' name='MixmoCteEfectivo' id='MixmoCteEfectivo' placeholder='00.00' required>";
                 echo "</div>";
                 echo "</div>";
                 echo "<div class='col-md-12' style='margin-top:20px;'>";  
                echo "<div class='col-md-7'>"; 
                echo "En Cta. Cte:"; 
                 echo "</div>";
                 echo "<div class='col-md-5'>";
                 echo "<input class='form-control' type='text' name='MixmoCteCtaCte' id='MixmoCteCtaCte' required>";
                 echo "</div>";
                 echo "</div>";
                   echo "<div class='col-md-12' style='margin-top:20px;' >"; 
                   echo "<input hidden type='text' name='action' value='CtaCteMixto'>";

                   echo "<input hidden type='text' name='ID_cli' value='".$clientes."'>";
                   echo "<input hidden type='text' name='ID_ven' value='".$ID_ven."'>";
                   echo "<input hidden type='text' name='ID_caj' value='".$ID_caj."'>";
                   echo "<input hidden type='text' name='ID_cte' value='".$assoc_get_clientes_byNombreYApellido['ID_cte']."'>";

                 echo " <button class='btn btn-success' type='submit'  id='finalizarVentaEfectivo' ><i class='material-icons' >attach_money</i> Finalizar </button>";
                 echo "</div>";
            echo "</div>";
           
            echo "</form>";
           echo "<script>
           $('#clientes".$assoc_get_clientes_byNombreYApellido['ID_cli']."').click(function(){
            $('#mostradorDeDatosDeCliente').toggle('slow');
            $('#clientes".$assoc_get_clientes_byNombreYApellido['ID_cli']."').toggle('slow');
           });
           </script>";

           echo "<script>
           $('#pagoMixto".$assoc_get_clientes_byNombreYApellido['ID_cli']."').click(function(){
            $('#AgregarACtaCte".$assoc_get_clientes_byNombreYApellido['ID_cli']."').toggle('slow');
            $('#pagoMixto".$assoc_get_clientes_byNombreYApellido['ID_cli']."').toggle('slow');
            $('#formularioCteMixto".$assoc_get_clientes_byNombreYApellido['ID_cli']."').toggle('slow');
           });
           </script>";

           echo "<script>$(document).ready(function(){
            $('#MixmoCteEfectivo').keypress(function(){
             var text = $('input:text[name=MixmoCteEfectivo]').val();
             var monto = ".$ven_totalClientes.";
             var total = monto - text;
             if (total>=1) 
             {
              $('#MixmoCteCtaCte').val(total);
             
             }
            });
          });</script>";

        /* var MixmoCteEfectivo = $('input:text[name=MixmoCteEfectivo]').val();
              var MixmoCteCtaCte = $('input:text[name=MixmoCteCtaCte]').val();
              var montoB = ".$ven_totalClientes.";
              var suma = MixmoCteEfectivo + MixmoCteCtaCte;
              alert(suma);
                if (suma==montoB) 
                {
                  $('#finalizarVentaEfectivo').toggle('slow');
                }*/
           
          }
       } 
  } 

  if ($action=='CtaCteMixto')
  {
    $MixmoCteCtaCte=$_POST['MixmoCteCtaCte'];
    $MixmoCteEfectivo=$_POST['MixmoCteEfectivo'];
    $monto = $MixmoCteCtaCte + $MixmoCteEfectivo;
    $ID_ven           =$_POST['ID_ven'];
    $ID_caj           =$_POST['ID_caj'];
    $ID_cte           =$_POST['ID_cte'];
    //TRAER CTA CTE POR ID
     $get_cuenta_cteById        = $cuenta_cte->get_cuenta_cteById($ID_cte);
     $assoc_get_cuenta_cteById  = mysql_fetch_assoc($get_cuenta_cteById);
     $montoB                    = $assoc_get_cuenta_cteById['cte_monto'];
     $ID_cli                    = $assoc_get_cuenta_cteById['ID_cli'];

    //MODIFICAR CTA CTE 
    $cte_fec            = $fechaDeHoy;
    $cte_monto          = $MixmoCteCtaCte+$montoB;
    $cte_tipo           = 1;
    $ID_fpo             = 2;
    $update_cuenta_cte  = $cuenta_cteE->update_cuenta_cteById($ID_cte, $ID_cli, $cte_fec, $cte_monto, $cte_tipo, $ID_fpo);

    //MODIFICAR CAJA , VENTA EN CTA Y VENTA TOTAL 

    $cja_vctA=$monto;
    //Trae la ultima caja abierta por usuario 
    $get_caja_UltimaByUsu =$cajaE->get_caja_UltimaByUsu($ID_usu);
    $assoc_get_caja_UltimaByUsu=mysql_fetch_assoc($get_caja_UltimaByUsu);
    
    $ID_caj=$assoc_get_caja_UltimaByUsu['ID_caj'];
    $cja_vctB=$assoc_get_caja_UltimaByUsu['cja_vct'];
    $cja_vefB=$assoc_get_caja_UltimaByUsu['cja_vef'];
    $caj_vneB=$assoc_get_caja_UltimaByUsu['caj_vne'];

    $get_mov_caja_netos=$mov_cajaE->get_mov_caja_netos($ID_ven, $ID_caj);
    $assoc_get_mov_caja_netos=mysql_fetch_assoc($get_mov_caja_netos);
    $caj_vneA=$assoc_get_mov_caja_netos['neto'];

    //Suma los montos 
    $cja_vct=$MixmoCteCtaCte+$cja_vctB;
    $cja_vef=$MixmoCteEfectivo+$cja_vefB;
    $caj_vne=$caj_vneB+$caj_vneA;

    //Modifica los montos en la caja solo los montos en efectivo y los totales
    $update_cajaE = $cajaE->update_cajaCtMixto($ID_caj, $cja_vef, $cja_vct, $caj_vne);

    //modifica forma de pago en venta
    $ven_fpo='2,1'; 
    $update_ventaE = $ventaE->update_ventaById($ID_ven, $ven_fpo);

    //Inserta nueva Venta
    $ven_total=0;
    $ven_fpo=1; // Tipo de venta en Efectivo 
    $insert_venta = $venta->insert_venta($ven_total, $ven_fpo, $ID_caj); 

    echo '<script type="text/javascript">
    window.location.assign("cajaSuc.php?M=4");
    </script>';
    //header('Location: cajaSuc.php?M=4');
  }

  if (@$_GET['action']=='agregarActaCte')
  {
    $monto            = $_GET['monto'];
    $ID_cli           = $_GET['ID_cli'];
    $ID_ven           = $_GET['ID_ven'];
    $ID_caj           = $_GET['ID_caj'];
    $ID_cte           = $_GET['ID_cte'];

    //TRAER CTA CTE POR ID
     $get_cuenta_cteById = $cuenta_cte->get_cuenta_cteById($ID_cte);
     $assoc_get_cuenta_cteById = mysql_fetch_assoc($get_cuenta_cteById);
     $montoB=$assoc_get_cuenta_cteById['cte_monto'];
    //MODIFICAR CTA CTE 

    $cte_fec=$fechaDeHoy;
    $cte_monto=$monto+$montoB;
    $cte_tipo=1;
    $ID_fpo=2;

    $update_cuenta_cte = $cuenta_cteE->update_cuenta_cteById($ID_cte, $ID_cli, $cte_fec, $cte_monto, $cte_tipo, $ID_fpo);

    //MODIFICAR CAJA , VENTA EN CTA Y VENTA TOTAL 

    $cja_vctA=$monto;
    //Trae la ultima caja abierta por usuario 
    $get_caja_UltimaByUsu =$cajaE->get_caja_UltimaByUsu($ID_usu);
    $assoc_get_caja_UltimaByUsu=mysql_fetch_assoc($get_caja_UltimaByUsu);
    
    $ID_caj=$assoc_get_caja_UltimaByUsu['ID_caj'];
    $cja_vctB=$assoc_get_caja_UltimaByUsu['cja_vct'];
    $caj_vneB=$assoc_get_caja_UltimaByUsu['caj_vne'];

    $get_mov_caja_netos=$mov_cajaE->get_mov_caja_netos($ID_ven, $ID_caj);
    $assoc_get_mov_caja_netos=mysql_fetch_assoc($get_mov_caja_netos);
    $caj_vneA=$assoc_get_mov_caja_netos['neto'];

    //Suma los montos 
    $cja_vct=$cja_vctA+$cja_vctB;
    $caj_vne=$caj_vneB+$caj_vneA;

    //Modifica los montos en la caja solo los montos en efectivo y los totales
    $update_cajaE = $cajaE->update_cajaCt($ID_caj, $cja_vct, $caj_vne);

    //modifica forma de pago en venta
    $ven_fpo=2; 
    $update_ventaE = $ventaE->update_ventaById($ID_ven, $ven_fpo);

    //Inserta nueva Venta
    $ven_total=0;
    $ven_fpo=1; // Tipo de venta en Efectivo 
    $insert_venta = $venta->insert_venta($ven_total, $ven_fpo, $ID_caj); 

    echo '<script type="text/javascript">
    window.location.assign("cajaSuc.php?M=4");
    </script>';
    // header('Location: cajaSuc.php?M=4');
  } 

    if ($action=='ventaConTarjeta')
  {
  
    $monto            =$_POST['ven_totalTarjeta'];
    $ID_ven           =$_POST['ID_venTarjeta'];
    $ID_caj           =$_POST['ID_cajTarjeta'];
    $ID_tar           =$_POST['ID_tar'];
    $ID_pla           =$_POST['ID_pla'];
    $tar_tipo         =$_POST['tar_tipo'];

    //MODIFICAR CAJA , VENTA EN CTA Y VENTA TOTAL 
          
          //Trae la ultima caja abierta por usuario 
          $get_caja_UltimaByUsu =$cajaE->get_caja_UltimaByUsu($ID_usu);
          $assoc_get_caja_UltimaByUsu=mysql_fetch_assoc($get_caja_UltimaByUsu);
          $ID_caj=$assoc_get_caja_UltimaByUsu['ID_caj'];
          //Venta con tarjeta de credito
          $cja_vtaB=$assoc_get_caja_UltimaByUsu['cja_vta'];
          //Venta neta
          $caj_vneB=$assoc_get_caja_UltimaByUsu['caj_vne'];
          //Venta con tarjeta de debito
          $cja_vtadB=$assoc_get_caja_UltimaByUsu['cja_vtad'];
          //Venta con efectivo
          $cja_vef=$assoc_get_caja_UltimaByUsu['cja_vef'];

          //TRAE EL NETO TOTAL
          $get_mov_caja_netos=$mov_cajaE->get_mov_caja_netos($ID_ven, $ID_caj);
          $assoc_get_mov_caja_netos=mysql_fetch_assoc($get_mov_caja_netos);
          $caj_vneA=$assoc_get_mov_caja_netos['neto'];

            //Venta Neta total + Venta Neta actual
            $caj_vne=$caj_vneB+$caj_vneA;

    if ($_POST['efectivo']) 
    {
       $efectivo=$_POST['efectivo'];
        //Venta con efectivo total + Venta con efectivo actual
       $cja_vef=$cja_vef+$efectivo;
       $monto = $monto-$efectivo;

       //Suma los montos 
          //Venta con tarjeta de credito total + Venta con tarjeta de credito actual
            $cja_vta=$monto+$cja_vtaB;
          
          //Venta con tarjeta de debito total + Venta con tarjeta de debito actual
            $cja_vtad=$monto+$cja_vtadB;

        //SI ES CREDITO MODIFICA LOS TOTALES VENTA NETA Y TARJETA DE CREDITO DE LA CAJA    
        if ($tar_tipo==1) 
        {

          //Modifica los montos en la caja solo los montos en efectivo y los totales
          $update_cajaE = $cajaE->update_cajaTarjeta($ID_caj, $cja_vta, $caj_vne, $cja_vef);
          //Guarda variable para modificar forma de pago en venta
          $ven_fpo='3,1'; 

       }   
       //EN CASO CONTRARIO ES DEBITO POR LO QUE MODIFICA LOS TOTALES DE VENTA NETA Y TARJETA DE DEBITO DE LA CAJA
       else
       {
         //Modifica los montos en la caja solo los montos en efectivo y los totales
          $update_cajaE = $cajaE->update_cajaTarjetaDebito($ID_caj, $cja_vtad, $caj_vne, $cja_vef);
          //Guarda variable para modificar forma de pago en venta
          $ven_fpo='4,1'; 

       } 
    }

    else
    {
          //Suma los montos 
          //Venta con tarjeta de credito total + Venta con tarjeta de credito actual
            $cja_vta=$monto+$cja_vtaB;
          
          //Venta con tarjeta de debito total + Venta con tarjeta de debito actual
            $cja_vtad=$monto+$cja_vtadB;

         //SI ES CREDITO MODIFICA LOS TOTALES VENTA NETA Y TARJETA DE CREDITO DE LA CAJA    
        if ($tar_tipo==1) 
        {

          //Modifica los montos en la caja solo los montos en efectivo y los totales
          $update_cajaE = $cajaE->update_cajaTarjeta($ID_caj, $cja_vta, $caj_vne, $cja_vef);
          //Guarda variable para modificar forma de pago en venta
          $ven_fpo='3'; 

       }   
       //EN CASO CONTRARIO ES DEBITO POR LO QUE MODIFICA LOS TOTALES DE VENTA NETA Y TARJETA DE DEBITO DE LA CAJA
       else
       {
         //Modifica los montos en la caja solo los montos en efectivo y los totales
          $update_cajaE = $cajaE->update_cajaTarjetaDebito($ID_caj, $cja_vtad, $caj_vne);
          //Guarda variable para modificar forma de pago en venta
          $ven_fpo='4'; 

       } 
         
    }

    
      
     
        
       //modifica forma de pago en venta
        $update_ventaE = $ventaE->update_ventaById($ID_ven, $ven_fpo);

        //Inserta nueva Venta
          $ven_total=0;
          $ven_fpo=1; // Tipo de venta en Efectivo 
          $ven_descuento=0;
          $insert_venta = $venta->insert_venta($ven_total, $ven_fpo, $ID_caj, $ven_descuento); 



echo '<script type="text/javascript">
window.location.assign("cajaSuc.php?M=4");
</script>';
   // header('Location: cajaSuc.php?M=4');
    
  }
   if ($action=='saldar')
  {
    $ID_cte       = $_POST['ID_cte'];
    $cte_montoA        = $_POST['monto'];   
    $get_cuenta_cteById = $cuenta_cte->get_cuenta_cteById($ID_cte);
    $assoc_get_cuenta_cteById = mysql_fetch_assoc($get_cuenta_cteById);
    $cte_montoB=$assoc_get_cuenta_cteById['cte_monto'];
    $cte_monto=$cte_montoB-$cte_montoA;
    echo $update_CtaCte = $cuenta_cteE->update_CtaCte($ID_cte, $cte_monto);
    echo '<script type="text/javascript">
    window.location.assign("cajaSuc.php?M=4");
    </script>';
   // header('Location: cajaSuc.php?M=4');
  }
  if ($action=='cerrarCaja')
  {
  
    $caj_cierre           =   $_POST['caj_cierre'];
    $ID_caj               =   $_POST['ID_caj'];
    $caj_efectivoReal     =   $_POST['caj_efectivo'];


          for($i=0; $i<count($_FILES['adj_ruta']['name']); $i++)
         {
            $tmpFilePath = $_FILES['adj_ruta']['tmp_name'][$i];
            $shortname = $_FILES['adj_ruta']['name'][$i];
            $generateRandomString   =   $especiales->generateRandomString();
            $extension        =   end(explode(".", $_FILES['adj_ruta']['name'][$i]));
            $adj_ruta       =   "media/comprobantes_de_gatos/".$generateRandomString."".$i.".".$extension;
            move_uploaded_file($tmpFilePath, $adj_ruta);

            $adj_tablaRel           =    "caja"; 
            $adj_desc               =   "Comprobante de Gasto Nº ".$i." del cierre de caja Nº ".$ID_caj."";
            $adj_fec                = $FechayHora;
            $adj_ID_rel             = $ID_caj;

            $insert_adjuntos = $adjuntos->insert_adjuntos($adj_ID_rel, $adj_fec, $ID_usu, $adj_ruta, $adj_desc, $adj_tablaRel);

          }  
    
    $update_cajaCierre = $cajaE->update_cajaCierre($ID_caj, $caj_cierre, $caj_efectivoReal);
   echo '<script type="text/javascript">
            window.location.assign("inicio.php");
         </script>';
    // header('Location: logout.php');
    
  }
 
  
 if ($action=='updateArticulo')
  {
     $ID_art           = $_POST['ID_art'];
     $art_cod          = $_POST['art_cod'];
     $ID_cat           = $_POST['ID_cat'];
     $ID_sub           = $_POST['ID_sub'];
     $ID_pre           = $_POST['ID_pre'];
     $pre_porcan       = $_POST['pre_porcan'];
     $pre_cant         = $_POST['pre_cantA'].".".$_POST['pre_cantB'];
     $pre_neto         = $_POST['pre_netoA'].".".$_POST['pre_netoB'];
     $ID_pro           = $_POST['ID_pro'];
     $art_desc         = mysql_escape_string($_POST['art_desc']);
     $art_unidad       = $_POST['art_unidad'];
     $pre_iva          = $pre_cant;
     $pre_fec          = $fechaDeHoy;
    
    
    $get_articulosByartCod=$articulosE->get_articulosByartCod($art_cod);
    $assoc_get_articulosByartCod=mysql_fetch_assoc($get_articulosByartCod);

    //INICIO: REVISA PRECIOS 

    if ($pre_neto==0 or $pre_neto=="")
    {
    }
    else
    {
       if ($assoc_get_articulosByartCod['pre_neto']!=$pre_neto or $pre_porcan!=$assoc_get_articulosByartCod['pre_porcan'] or $pre_cant!=$assoc_get_articulosByartCod['pre_cant']) 
    
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
      }
     }  

    //modifica los aritculos 
    $update_articulos = $articulosE->update_articulosById($ID_art, $ID_sub, $ID_pre, $ID_pro, $art_desc, $art_cod, $art_unidad);

    //modifica los precios
    $update_precios = $preciosE->update_preciosById($ID_pre, $pre_cant, $pre_iva, $pre_neto, $pre_fec, $pre_porcan);


    echo '<div class="alert alert-success alert-dismissable" style="margin-bottom: 2%;">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <i class="material-icons">done</i> Cambios Guardados Correctamente
    </div>';

  }

   if (@$_GET['action']=='MarcarComoNoLeido')
   {
      $ID_men    = $_GET['ID_men'];
      $men_visto = 0;
      $update_mensajesVistoById=$mensajesE->update_mensajesVistoById($ID_men, $men_visto);

      echo '<script type="text/javascript">
      window.location.assign("notificaciones.php");
      </script>';
   } 

   if (@$_GET['action']=='CambiarTipoDeMensaje')
   {
      $ID_men                   = $_GET['ID_men'];
      $men_categoria            = $_GET['men_categoria'];
      $update_mensajesTipoById  = $mensajesE->update_mensajesTipoById($ID_men, $men_categoria);

      echo '<script type="text/javascript">
      window.location.assign("notificaciones.php?M=8");
      </script>';
   } 

  if (@$_GET['action']=='dropArticulo')
  {
     $ID_art          =$_GET['ID_art'];
     $ID_pre           =$_GET['ID_pre'];
  
     $drop_articulos = $articulos->drop_articulosById($ID_art);

     $drop_precios = $precios->drop_preciosById($ID_pre);
   
  echo '<script type="text/javascript">
  window.location.assign("articulos.php");
  </script>';
    
  }

  if ($action=='nuevoDescuento')
  {
     $ID_cue          =$_POST['ID_cue'];
     $cti_desc        =$_POST['cti_desc'];
     $cti_credOdeb    =$_POST['cti_credOdeb'];
     $metrica         =$_POST['metrica'];
     
     if ($metrica==0) 
     {
       @$cti_porcentaje    =$_POST['cti_monto'];
       @$cti_monto ="";
     } 
     else
     {
       @$cti_monto       =$_POST['cti_monto'];
       @$cti_porcentaje="";
     } 

     $insert_cuentas_impuestos=$cuentas_impuestos->insert_cuentas_impuestos($ID_cue, $cti_desc, $cti_credOdeb, $cti_monto, $cti_porcentaje);

      echo '<script type="text/javascript">
        window.location.assign("gestionCuentas.php?M=6");
      </script>';
  }   

   if ($action=='EditarDescuento')
  {
     $ID_cue          =$_POST['ID_cue'];
     $ID_cti          =$_POST['ID_cti'];
     $cti_desc        =$_POST['cti_desc'];
     $cti_credOdeb    =$_POST['cti_credOdeb'];
     $metrica         =$_POST['cti_metrica'];
     
     if ($metrica==0) 
     {
       @$cti_porcentaje    =$_POST['cti_monto'];
       @$cti_monto ="";
     } 
     else
     {
       @$cti_monto       =$_POST['cti_monto'];
       @$cti_porcentaje="";
     } 

     $update_cuentas_impuestosById=$cuentas_impuestos->update_cuentas_impuestosById($ID_cti, $ID_cue, $cti_desc, $cti_credOdeb, $cti_monto, $cti_porcentaje);

      echo '<script type="text/javascript">
  window.location.assign("gestionCuentas.php?M=14");
  </script>';
  }   

   if (@$_GET['action']=='dropImpuesto')
  {
      $ID_cti          =$_GET['ID_cti'];

      $drop_cuentas_impuestosById=$cuentas_impuestos->drop_cuentas_impuestosById($ID_cti);   
      
      echo '<script type="text/javascript">
      window.location.assign("gestionCuentas.php?M=8");
      </script>';
      
  }

  if ($action=='nuevoPuntoDeVenta')
  {
     $pdv_numeracion       = $_POST['pdv_numeracion'];
     $pdv_puntoVenta       = $_POST['pdv_puntoVenta'];
     $pdv_cai              = $_POST['pdv_cai'];
     $pdv_fecVencimiento   = $_POST['pdv_fecVencimiento'];
     $ID_tce               = $_POST['ID_tce'];
     
     $insert_puntos_de_ventas=$puntos_de_ventas->insert_puntos_de_ventas($pdv_numeracion, $pdv_puntoVenta, $pdv_cai, $pdv_fecVencimiento, $ID_tce);

      echo '<script type="text/javascript">
    window.location.assign("puntosDeVentas.php?M=6");
    </script>';
  }   


  if ($action=='editaPuntoDeVenta')
  {
     $ID_pdv               = $_POST['ID_pdv'];
     $pdv_numeracion       = $_POST['pdv_numeracion'];
     $pdv_puntoVenta       = $_POST['pdv_puntoVenta'];
     $pdv_cai              = $_POST['pdv_cai'];
     $pdv_fecVencimiento   = $_POST['pdv_fecVencimiento'];
     $ID_tce               = $_POST['ID_tce'];

     $update_cuentasById=$puntos_de_ventas->update_puntos_de_ventasById($ID_pdv, $pdv_numeracion, $pdv_puntoVenta, $pdv_cai, $pdv_fecVencimiento, $ID_tce);

      echo '<script type="text/javascript">
  window.location.assign("puntosDeVentas.php?M=14");
  </script>';
  }   

  if ($action=='nuevaCuenta')
  {
     $cue_desc        =$_POST['cue_desc'];
     $ID_ctp          =$_POST['ID_ctp'];
     $cue_direccion   =$_POST['cue_direccion'];
     $cue_sucursal    =$_POST['cue_sucursal'];
     $cue_cbu         =$_POST['cue_cbu'];
     $cue_cuit        =$_POST['cue_cuit'];
     $cue_num         =$_POST['cue_num'];
     $cue_moneda      =$_POST['cue_moneda'];

     $insert_cuentas=$cuentas->insert_cuentas($cue_desc, $ID_ctp, $cue_direccion, $cue_sucursal, $cue_cbu, $cue_cuit, $cue_num, $cue_moneda);

      echo '<script type="text/javascript">
    window.location.assign("gestionCuentas.php?M=6");
    </script>';
  }   


 if ($action=='editarCuenta')
  {
     $ID_cue          =$_POST['ID_cue'];
     $cue_desc        =$_POST['cue_desc'];
     $ID_ctp          =$_POST['ID_ctp'];
     $cue_direccion   =$_POST['cue_direccion'];
     $cue_sucursal    =$_POST['cue_sucursal'];
     $cue_cbu         =$_POST['cue_cbu'];
     $cue_cuit        =$_POST['cue_cuit'];
     $cue_num         =$_POST['cue_num'];
     $cue_moneda      =$_POST['cue_moneda'];

     $update_cuentasById=$cuentas->update_cuentasById($ID_cue, $cue_desc, $ID_ctp, $cue_direccion, $cue_sucursal, $cue_cbu, $cue_cuit, $cue_num, $cue_moneda);

      echo '<script type="text/javascript">
  window.location.assign("gestionCuentas.php?M=14");
  </script>';
  }   
  if (@$_GET['action']=='dropCuenta')
  {
     $ID_cue          =$_GET['ID_cue'];

     $get_cuentas_movimientosByIdCue=$cuentas_movimientosE->get_cuentas_movimientosByIdCue($ID_cue);
     $num_get_cuentas_movimientosByIdCue=mysql_num_rows($get_cuentas_movimientosByIdCue);

    if ($num_get_cuentas_movimientosByIdCue>=1) 
    {
        echo '<script type="text/javascript">
         window.location.assign("gestionCuentas.php?M=16");
        </script>';
    }
    else
    {
       $drop_cuentasById=$cuentas->drop_cuentasById($ID_cue);
    }  
   
   
  echo '<script type="text/javascript">
  window.location.assign("gestionCuentas.php");
  </script>';
    
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
      
  echo '<script type="text/javascript">
  window.location.assign("stock.php?ID_art='.$ID_art.'&M=11");
  </script>';
    
  }

 if ($action=='quitarStock')
  {
     $ID_art           = $_POST['ID_art'];
     $cantidad         = $_POST['cantidad'];
     $ID_suc           = $_POST['ID_suc'];
     $sto_descB        = $_POST['sto_desc'];

     //INICIO: Inserto nuevo registro en la tabla de movimientos de Stock

    $sto_mov            = 2; // 1=Ingreso de stock / 2=Egreso de stock
    //$ID_art            = ;
    $sto_desc           = "Egreso Manual de Stock con el siguiente motivo: ".$sto_descB."";
    $sto_fec            = $FechayHora;
    //$ID_suc             = ;
    //$ID_usu            = ;
    $sto_cant           = $cantidad;

    //calcula Stock total para guardarlo en la columna sto_total
      //Para ello trae todos los movimientos de stock por articulo y sucursal dentro de un for suma los sto_mov 1, resta los sto_mov 2 y luego resta los totales.
    $get_stockByIdArtUltimo        = $stockE->get_stockByIdArtUltimo($ID_art, $ID_suc);
    $assoc_get_stockByIdArtUltimo  = mysql_fetch_assoc($get_stockByIdArtUltimo);
    $ID_art                         = $assoc_get_stockByIdArtUltimo['ID_art'];
    $ID_suc                         = $assoc_get_stockByIdArtUltimo['ID_suc'];

    $sto_total            = $assoc_get_stockByIdArtUltimo['sto_total']-$sto_cant;
   
   //CAMBIAR EL SIMBOLO SEGUN sto_mov

    $insert_stock         = $stock->insert_stock($sto_mov, $ID_art, $sto_desc, $sto_fec, $ID_suc, $ID_usu, $sto_cant, $sto_total);

    //FIN: Inserto nuevo registro en la tabla de movimientos de Stock

       
      
  echo '<script type="text/javascript">
  window.location.assign("stock.php?ID_art='.$ID_art.'&M=12");
  </script>';
    
  }

 if ($action=='tablaDeSucursales')
  {
    $fechaDesde           = $_POST['fechaDesde']. " 00:00:00";
    $fechaHasta           = $_POST['fechaHasta']. " 23:59:59";
    $ID_suc               = $_POST['ID_suc'];
    
    if ($ID_suc==0) 
    {
      $get_stockByFecBetween=$stockE->get_stockByFecBetween($fechaDesde, $fechaHasta);
    }
    else
    {
      $get_stockByFecBetween=$stockE->get_stockByFecBetweenYId($fechaDesde, $fechaHasta, $ID_suc);
    }  
    
    $num_get_stockByFecBetween=mysql_num_rows($get_stockByFecBetween);

    echo '
      <div class="panel panel-default">
        <div class="panel-body">
          <h5><i class="material-icons">assignment_turned_in</i> Cantidad de Resultados: '.$num_get_stockByFecBetween.'</h5>
        </div>
      </div>'; 

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
         </table> ';
   
 }


  if ($action=='cargarArticulo')
  {
    $cantidad             = $_POST['cantidad'];
    $costo                = $_POST['costo'];
    $codigo               = $_POST['codigoArticulo'];
    $ID_suc               = $_POST['ID_suc'];
    $fac_num              = $_POST['fac_num'];

    $get_articulosByartCod=$articulosE->get_articulosByartCod($codigo);
    $assoc_get_articulosByartCod=mysql_fetch_assoc($get_articulosByartCod);

    //INICIO: REVISA PRECIOS 

    if ($costo==0 or $costo=="")
    {
    }
    else
    {
       if ($assoc_get_articulosByartCod['pre_neto']!=$costo) 
    
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

        $resultadoA=$costo*$assoc_get_articulosByartCod['pre_porcan'];
        $resultadoB=$resultadoA/100;
        $resultadoC=$costo+$resultadoB;

        //se modifica el precio cant de la tabla precios
        $ID_pre      = $assoc_get_articulosByartCod['ID_pre'];
        $pre_cant    = $resultadoC;
        $pre_iva     = $assoc_get_articulosByartCod['pre_iva'];
        $pre_neto    = $costo;
        $pre_fec     = $assoc_get_articulosByartCod['pre_fec'];
        $pre_poresp  = $assoc_get_articulosByartCod['pre_poresp'];
        $pre_porcan  = $assoc_get_articulosByartCod['pre_porcan'];;
        $update_preciosById=$preciosE->update_preciosById($ID_pre, $pre_cant, $pre_iva, $pre_neto, $pre_fec, $pre_porcan);
      }

    }

   


     //INICIO: Inserto nuevo registro en la tabla de movimientos de Stock

    $sto_mov            = 1; // 1=Ingreso de stock / 2=Egreso de stock
    $ID_art             = $assoc_get_articulosByartCod['ID_art'];
    $sto_desc           = "Ingreso manual de Stock Correspondiente a la factura Nº ".$fac_num."";
    $sto_fec            = $FechayHora;
    $ID_suc             = $_POST['ID_suc'];
    //$ID_usu            = ;
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
 
 if ($action=='insert_articulo')
  {
    //CARGA VARIABLES PARA INSERTAR NUEVO PRECIO
    @$pre_cant=$_POST['pre_cant'];
    @$pre_iva=$_POST['pre_cant'];
    @$pre_neto=$_POST['pre_neto'];
    @$pre_fec=$fechaDeHoy;
    @$pre_poresp=$_POST['pre_porcan'];
    @$pre_porcan=$_POST['pre_porcan'];

    //INSERTA EL PRECIO 
    $insert_precios = $precios->insert_precios($pre_cant, $pre_iva, $pre_neto, $pre_fec, $pre_poresp, $pre_porcan);

    //TRAE EL ULTIMO INSERTADO PARA EXTRAER EL ID E INSERTARLO EN EL ARTICULO NUEVO
    $get_preciosUltimo = $preciosE->get_preciosUltimo();
    $assoc_get_preciosUltimo = mysql_fetch_assoc($get_preciosUltimo);

    $ID_pre=$assoc_get_preciosUltimo['ID_pre'];

    //TRAE VARIABLES
    @$ID_sub=$_POST['ID_sub'];
    @$ID_pro=$_POST['ID_pro'];
    @$art_desc=mysql_real_escape_string($_POST['art_desc']);
    @$art_cod=$_POST['art_cod'];
    @$art_unidad=$_POST['art_unidad'];

    //INSERTA EL ARTICULO NUEVO
    $insert_articulos = $articulos->insert_articulos($ID_sub, $ID_pre, $ID_pro, $art_desc, $art_cod, $art_unidad);

    echo '<script type="text/javascript">
    window.location.assign("articulos.php");
    </script>';
  }
  if ($action=='muestraSubCategorias')
  {
    $ID_cat=$_POST['ID_cat'];
    echo '<table class="table table-condensed table-hover table-striped">';
              echo '<thead>';
            echo '<tr id="cabeceraTabla">';
                    echo '<th id="bloqueTabla">';
                    echo 'Nº';
                  echo '</th>';
                    echo '<th id="bloqueTabla">';
                    echo 'Descripción';
                  echo '</th>';
                  echo '<th id="bloqueTabla" colspan="2" >';
                    echo 'Acciones';
                  echo '</th>';
                echo '</tr>';
               echo '</thead>';
    echo "<tbody>";
      echo '<form class="form-horizontal" action="acciones.php" method="POST">';
        echo "<tr>";
          echo "<th style='text-align:center;'>";
            echo "0";
          echo "</th>";
          echo "<th style='text-align:center;'>";
          echo "<input type='text' class='form-control' name='sub_desc' id='sub_desc".$ID_cat."' placeholder='Nueva Sub Categoria'>";
          echo "</th>";
                echo "<th style='text-align:center'>";
                    echo '<input hidden type="text" name="action" value="insert_sub_categorias">';
                     echo '<input hidden type="text" name="ID_cat" value="'.$ID_cat.'">';
                       echo "<button type='button' class='btn btn-success' id='NuevaSubCategoria".$ID_cat."'><i class='material-icons'>add</i> Agregar</button>";
                   echo "</th>";
                echo "</tr>";
            echo "</form>";

          

                echo "<script>$('#NuevaSubCategoria".$ID_cat."').click(function(){

                            var ID_cat   = '".$ID_cat."';   
                            var action   = 'insert_sub_categorias'; 
                            var sub_desc = ($('#sub_desc".$ID_cat."').val());
                              var dataString = 'ID_cat='+ID_cat + '&action='+action + '&sub_desc='+sub_desc;
                              $.ajax(
                              {
                                  type: 'POST',
                                  url: 'accionesExclusivas.php',
                                  data: dataString,
                                  success: function(data)
                                   {
                                      $('#suggestions').fadeIn(1000).html(data);
                                   }
                               });
                       });</script>";

    $get_sub_categoriasByIdCat=$sub_categoriasE->get_sub_categoriasByIdCat($ID_cat);
    $num_get_sub_categoriasByIdCat=mysql_num_rows($get_sub_categoriasByIdCat);
    for ($countSubCategorias=0; $countSubCategorias < $num_get_sub_categoriasByIdCat; $countSubCategorias++) 
    { 
      $assoc_get_sub_categoriasByIdCat=mysql_fetch_assoc($get_sub_categoriasByIdCat);
      $ID_sub=$assoc_get_sub_categoriasByIdCat['ID_sub'];

           /* Inicio Modal Agregar Categoria */                          
          echo '<div class="modal fade" id="eliminarSub'.$assoc_get_sub_categoriasByIdCat['ID_sub'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                     <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Eliminar Sub-Categoría</h4>
                                      </div>
                                      <div class="modal-body">';

                                            $get_articulosByIdSub=$articulosE->get_articulosByIdSub($ID_sub);
                                            $num_get_articulosByIdSub=mysql_num_rows($get_articulosByIdSub);

                                             if ($num_get_articulosByIdSub!=0)
                                            {
                                               echo '<div class="alert alert-dismissible alert-danger">
                                                        <h4>Cuidado!</h4>
                                                        <p>Para lograr eliminar esta Sub-categoría, decida que hacer con los articulos asociadas</p>
                                                         </div>
                                                           <div class="col-md-12" style="margin:2%;">
                                                                         <a href="accionesExclusivas.php?ID_sub='.$ID_sub.'&action=eliminarSubcategoria"><button class="btn btn-danger"><i class="material-icons">delete_forever</i> Eliminar todos los artículos y la subcategoría</button></a>
                                                                       </div>
                                                                        
                                                                       <div class="col-md-12" style="margin:2%;">
                                                                          <button class="btn btn-primary" id="transferir'.$ID_sub.'"><i class="material-icons">compare_arrows</i> Transferir artículos a otra Subcategoría y eliminar esta subcategoría</button>
                                                                          <form class="form-horizontal" name="form'.$ID_sub.'" id="form'.$ID_sub.'" action="accionesExclusivas.php" method="POST">
                                                                          <input  form="form'.$ID_sub.'"  hidden type="text" name="ID_sub" value="'.$ID_sub.'">
                                                                          <input  form="form'.$ID_sub.'"  hidden type="text" name="action" value="eliminarSubYTransferir">
                
                                                                          <select  form="form'.$ID_sub.'"  class="form-control" id="selectorDeSub'.$ID_sub.'" style="display:none" name="ID_subNuevo">
                                                                          <option selected disabled>SELECCIONE EL DESTINO DE LOS ARTÍ CULOS</option>';

                                                                          $get_sub_categorias=$sub_categoriasE->get_sub_categoriasYcat();
                                                                          $num_get_sub_categorias=mysql_num_rows($get_sub_categorias);
                                                                          for ($countSubNuevo=0; $countSubNuevo < $num_get_sub_categorias; $countSubNuevo++) { 
                                                                            $assoc_get_sub_categorias=mysql_fetch_assoc($get_sub_categorias);
                                                                            echo "<option value='".$assoc_get_sub_categorias['ID_sub']."'>".$assoc_get_sub_categorias['cat_desc']." - ".$assoc_get_sub_categorias['sub_desc']."</option>";
                                                                          }
                                                                            
                                                                          echo '</select>

                                                                            <br>
    
                                                                          <button form="form'.$ID_sub.'" id="confirmarTransferencia'.$ID_sub.'" class="btn btn-success" type="submit" style="display:none;"><i class="material-icons">send</i> Transferir y eliminar Subcátegoria </button>
          
                                                                          </form>
                                                                </div>

                                                                <script>$("#transferir'.$ID_sub.'").click(function(){
                                                                  $("#selectorDeSub'.$ID_sub.'").toggle("slow");
                                                                   $("#transferir'.$ID_sub.'").toggle("slow");
                                                                   $("#confirmarTransferencia'.$ID_sub.'").toggle("slow");
                                                                });</script>
                                                                
                                                              <div class="col-md-12" style="margin:2%;">
                                                                  <h4><strong>'.$num_get_articulosByIdSub.' Artículos asociados</strong></h4>';
                                                                      for ($countArt=0; $countArt < $num_get_articulosByIdSub; $countArt++) 
                                                                        { 
                                                                        $assoc_get_articulosByIdSub=mysql_fetch_assoc($get_articulosByIdSub);
                                                                          echo ' <ul>
                                                                                <li>'.$assoc_get_articulosByIdSub['art_desc'].'</li>
                                                                              </ul>';
                                                                        }  
                                                           echo '</div>
                                                                  
                                                                     ';
                                                          }
                                                          else
                                                          {
                                                              echo '<div class="alert alert-dismissible alert-warning">
                                                              <h4>Cuidado!</h4>
                                                              <p>Esta seguro que desea eliminar esta sub-categoría ?</p>
                                                            </div>';
                                                            echo "<a href='accionesExclusivas.php?action=eliminarSubCategoria&ID_sub=".$ID_sub."'><button class='btn btn-danger'><i class='material-icons'>delete_forever</i> Eliminar Sub-Categoria</button></a>";
                                                          } 
                                          

                                      echo '</div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                      
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>';
                            /* Fin Modal Agregar Categoria */
        echo "<tr>";
          echo "<th style='text-align:center;'>";
            echo $assoc_get_sub_categoriasByIdCat['ID_sub'];
          echo "</th>";
          echo "<form action='accionesExclusivas.php' method='POST'>";
            echo "<th style='text-align:center;'>";
            echo "<input type='text' class='form-control' name='sub_desc' id='sub_desc".$assoc_get_sub_categoriasByIdCat['ID_sub']."'  value='".$assoc_get_sub_categoriasByIdCat['sub_desc']."'>";
            echo "</th>";
                echo "<th style='text-align:center;'>";
                  echo "<input hidden type='text' name='action' value='update_sub_categorias'>";
                  echo "<input hidden type='text' name='ID_sub' value='".$assoc_get_sub_categoriasByIdCat['ID_sub']."'>";
                   echo "<button type='button' class='btn btn-primary'  data-placement='top' title='Guardar Modificación' id='ModificarSubCategoria".$assoc_get_sub_categoriasByIdCat['ID_sub']."'><i class='material-icons'>edit</i><i class='material-icons'>save</i></button>";

                            echo "</th>";
                              echo "<th style='text-align:center;'>";
                            echo '<button class="btn btn-danger"  data-placement="top" title="Presione para eliminar la Subcategoria"   data-toggle="modal" data-target="#eliminarSub'.$assoc_get_sub_categoriasByIdCat['ID_sub'].'" ><i class="material-icons">delete_forever</i></button>';
                        echo "</th>";
               echo "</form>";             
        echo "</tr>";

                  echo "<script>$('#ModificarSubCategoria".$assoc_get_sub_categoriasByIdCat['ID_sub']."').click(function(){

                            var ID_cat   = '".$ID_cat."';   
                            var ID_sub   = '".$assoc_get_sub_categoriasByIdCat['ID_sub']."';   
                            var action   = 'update_sub_categorias'; 
                            var sub_desc = ($('#sub_desc".$assoc_get_sub_categoriasByIdCat['ID_sub']."').val());
                              var dataString = 'ID_cat='+ID_cat + '&action='+action + '&sub_desc='+sub_desc + '&ID_sub='+ID_sub;
                              $.ajax(
                              {
                                  type: 'POST',
                                  url: 'accionesExclusivas.php',
                                  data: dataString,
                                  success: function(data)
                                   {
                                      $('#suggestions').fadeIn(1000).html(data);
                                   }
                               });
                       });</script>";

    }
    echo "</tbody>";
     echo '<tfoot>';
            echo '<tr id="cabeceraTabla">';
                    echo '<th id="bloqueTabla">';
                    echo 'Nº';
                  echo '</th>';
                    echo '<th id="bloqueTabla">';
                    echo 'Descripción';
                  echo '</th>';
                  echo '<th id="bloqueTabla" colspan="2" >';
                    echo 'Acciones';
                  echo '</th>';
                echo '</tr>';
             echo '</tfoot>';
            echo '</table>';
  } 
if ($action=='update_categorias')
  {
      $ID_cat=$_POST['ID_cat'];
      $cat_desc=$_POST['cat_desc'];
    $update_categorias = $categoriasE->update_categorias($ID_cat, $cat_desc);

    echo '<script type="text/javascript">
    window.location.assign("categorias.php?M=14");
    </script>';
  } 
  if ($action=='update_sub_categorias')
  {
      $ID_sub=$_POST['ID_sub'];
      $sub_desc=$_POST['sub_desc'];
      $update_subcategorias = $sub_categoriasE->update_sub_categoriasByIdE($ID_sub, $sub_desc);

    echo '<script type="text/javascript">
    window.location.assign("categorias.php?M=15");
    </script>';
  } 
  if ($action=='insert_sub_categorias')
  {
  @$ID_cat=$_POST['ID_cat'];
  @$sub_desc=$_POST['sub_desc'];
  $insert_sub_categorias = $sub_categoriasE->insert_sub_categoriasE($ID_cat, $sub_desc);
  echo '<script type="text/javascript">
  window.location.assign("'.$atras.'");
  </script>';
  }

if ($action=='insert_sub_categorias')
{
  $ID_cat                    = $_POST['ID_cat'];
  $sub_desc                  = $_POST['sub_desc'];
$insert_sub_categorias       = $sub_categorias->insert_sub_categorias($ID_cat, $sub_desc);
echo '<script type="text/javascript">
window.location.assign("'.$atras.'");
</script>';
}

  if ($action=='insert_categorias')
  {
    $cat_desc                  = $_POST['cat_desc'];
    $sub_desc                  = $_POST['sub_desc'];
    $insert_categorias          = $categorias->insert_categorias($cat_desc);
    $get_ultimaCategoria        = $categoriasE->get_ultimaCategoria();
    $assoc_get_ultimaCategoria  = mysql_fetch_assoc($get_ultimaCategoria);
    $ID_cat                     = $assoc_get_ultimaCategoria['ID_cat'];
    @$sub_desc                  = $_POST['sub_desc'];
    $insert_sub_categorias      = $sub_categoriasE->insert_sub_categoriasE($ID_cat, $sub_desc);
    echo '<script type="text/javascript">
    window.location.assign("'.$atras.'");
    </script>';
  }

  if ($action=='update_sub_categorias')
  {
  @$ID_sub=$_POST['ID_sub'];
  @$ID_cat=$_POST['ID_cat'];
  @$sub_desc=$_POST['sub_desc'];
  $update_sub_categorias = $sub_categoriasE->update_sub_categoriasByIdE($ID_sub, $sub_desc);
  echo '<script type="text/javascript">
  window.location.assign("'.$atras.'");
  </script>';
  }
?>

