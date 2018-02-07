<?php
session_start();
include_once('inc/conectar.php');
include_once('inc/classes.php');
?>
       <!-- Inicio: Estilos Generales-->
         <link href="css/generales.css" rel="stylesheet"> 
        <!-- Fin: Estilos Generales-->
<?php
$atras=$_SESSION['actionsBack'];

$action=$_POST['action'];

$alertas = new alertas;

@$ID_ale=$_POST['ID_ale'];
@$ale_desc=$_POST['ale_desc'];

if ($action=='get_alertas')
{
  $get_alertas = $alertas->get_alertas();
  $num_get_alertas = mysql_num_rows($get_alertas);

      $assoc_get_alertas = mysql_fetch_assoc($get_alertas);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_ale';
                    echo '</th>';
                    echo '<th>';
                      echo 'ale_desc';
                    echo '</th>';
           echo '</tr>';
for ($action_get_alertas=0; $action_get_alertas< $num_get_alertas; $action_get_alertas++)
    {
      $assoc_get_alertas = mysql_fetch_assoc($get_alertas);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_ale=$assoc_get_alertas['ID_ale'];
                     echo '</th>';
                     echo '<th>';
                      echo $ale_desc=$assoc_get_alertas['ale_desc'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_alertasById')
{
$get_alertasById = $alertas->get_alertasById($ID_ale);
$assoc_get_alertasById = mysql_fetch_assoc($get_alertasById);
}

if ($action=='insert_alertas')
{
$insert_alertas = $alertas->insert_alertas($ale_desc);
}

if ($action=='update_alertas')
{
$update_alertas = $alertas->update_alertas($ID_ale, $ale_desc);
}

if ($action=='drop_alertas')
{
$drop_alertas = $alertas->drop_alertas($ID_ale);
}


$articulos = new articulos;

@$ID_art=$_POST['ID_art'];
@$ID_sub=$_POST['ID_sub'];
@$ID_pre=$_POST['ID_pre'];
@$ID_pro=$_POST['ID_pro'];
@$art_desc=$_POST['art_desc'];
@$art_cod=$_POST['art_cod'];
@$art_unidad=$_POST['art_unidad'];

if ($action=='get_articulos')
{
  $get_articulos = $articulos->get_articulos();
  $num_get_articulos = mysql_num_rows($get_articulos);

      $assoc_get_articulos = mysql_fetch_assoc($get_articulos);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_art';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_sub';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_pre';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_pro';
                    echo '</th>';
                    echo '<th>';
                      echo 'art_desc';
                    echo '</th>';
                    echo '<th>';
                      echo 'art_cod';
                    echo '</th>';
                    echo '<th>';
                      echo 'art_unidad';
                    echo '</th>';
           echo '</tr>';
for ($action_get_articulos=0; $action_get_articulos< $num_get_articulos; $action_get_articulos++)
    {
      $assoc_get_articulos = mysql_fetch_assoc($get_articulos);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_art=$assoc_get_articulos['ID_art'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_sub=$assoc_get_articulos['ID_sub'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_pre=$assoc_get_articulos['ID_pre'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_pro=$assoc_get_articulos['ID_pro'];
                     echo '</th>';
                     echo '<th>';
                      echo $art_desc=$assoc_get_articulos['art_desc'];
                     echo '</th>';
                     echo '<th>';
                      echo $art_cod=$assoc_get_articulos['art_cod'];
                     echo '</th>';
                     echo '<th>';
                      echo $art_unidad=$assoc_get_articulos['art_unidad'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_articulosById')
{
$get_articulosById = $articulos->get_articulosById($ID_art);
$assoc_get_articulosById = mysql_fetch_assoc($get_articulosById);
}

if ($action=='insert_articulos')
{
$insert_articulos = $articulos->insert_articulos($ID_sub, $ID_pre, $ID_pro, $art_desc, $art_cod, $art_unidad);
}

if ($action=='update_articulos')
{
$update_articulos = $articulos->update_articulos($ID_art, $ID_sub, $ID_pre, $ID_pro, $art_desc, $art_cod, $art_unidad);
}

if ($action=='drop_articulos')
{
$drop_articulos = $articulos->drop_articulos($ID_art);
}


$bancos = new bancos;

@$ID_ban=$_POST['ID_ban'];
@$ban_dir=$_POST['ban_dir'];
@$ban_cuit=$_POST['ban_cuit'];
@$ban_suc=$_POST['ban_suc'];
@$ban_cbu=$_POST['ban_cbu'];

if ($action=='get_bancos')
{
  $get_bancos = $bancos->get_bancos();
  $num_get_bancos = mysql_num_rows($get_bancos);

      $assoc_get_bancos = mysql_fetch_assoc($get_bancos);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_ban';
                    echo '</th>';
                    echo '<th>';
                      echo 'ban_dir';
                    echo '</th>';
                    echo '<th>';
                      echo 'ban_cuit';
                    echo '</th>';
                    echo '<th>';
                      echo 'ban_suc';
                    echo '</th>';
                    echo '<th>';
                      echo 'ban_cbu';
                    echo '</th>';
           echo '</tr>';
for ($action_get_bancos=0; $action_get_bancos< $num_get_bancos; $action_get_bancos++)
    {
      $assoc_get_bancos = mysql_fetch_assoc($get_bancos);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_ban=$assoc_get_bancos['ID_ban'];
                     echo '</th>';
                     echo '<th>';
                      echo $ban_dir=$assoc_get_bancos['ban_dir'];
                     echo '</th>';
                     echo '<th>';
                      echo $ban_cuit=$assoc_get_bancos['ban_cuit'];
                     echo '</th>';
                     echo '<th>';
                      echo $ban_suc=$assoc_get_bancos['ban_suc'];
                     echo '</th>';
                     echo '<th>';
                      echo $ban_cbu=$assoc_get_bancos['ban_cbu'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_bancosById')
{
$get_bancosById = $bancos->get_bancosById($ID_ban);
$assoc_get_bancosById = mysql_fetch_assoc($get_bancosById);
}

if ($action=='insert_bancos')
{
$insert_bancos = $bancos->insert_bancos($ban_dir, $ban_cuit, $ban_suc, $ban_cbu);
}

if ($action=='update_bancos')
{
$update_bancos = $bancos->update_bancos($ID_ban, $ban_dir, $ban_cuit, $ban_suc, $ban_cbu);
}

if ($action=='drop_bancos')
{
$drop_bancos = $bancos->drop_bancos($ID_ban);
}


$caja = new caja;

@$ID_caj=$_POST['ID_caj'];
@$ID_control=$_POST['ID_control'];
@$ID_usu=$_POST['ID_usu'];
@$caj_fec=$_POST['caj_fec'];
@$caj_horaa=$_POST['caj_horaa'];
@$caj_horac=$_POST['caj_horac'];
@$cja_vta=$_POST['cja_vta'];
@$cja_vct=$_POST['cja_vct'];
@$cja_vef=$_POST['cja_vef'];
@$caj_inicio=$_POST['caj_inicio'];
@$caj_cierre=$_POST['caj_cierre'];
@$caj_vne=$_POST['caj_vne'];
@$ID_suc=$_POST['ID_suc'];

if ($action=='get_caja')
{
  $get_caja = $caja->get_caja();
  $num_get_caja = mysql_num_rows($get_caja);

      $assoc_get_caja = mysql_fetch_assoc($get_caja);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_caj';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_control';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_usu';
                    echo '</th>';
                    echo '<th>';
                      echo 'caj_fec';
                    echo '</th>';
                    echo '<th>';
                      echo 'caj_horaa';
                    echo '</th>';
                    echo '<th>';
                      echo 'caj_horac';
                    echo '</th>';
                    echo '<th>';
                      echo 'cja_vta';
                    echo '</th>';
                    echo '<th>';
                      echo 'cja_vct';
                    echo '</th>';
                    echo '<th>';
                      echo 'cja_vef';
                    echo '</th>';
                    echo '<th>';
                      echo 'caj_inicio';
                    echo '</th>';
                    echo '<th>';
                      echo 'caj_cierre';
                    echo '</th>';
                    echo '<th>';
                      echo 'caj_vne';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_suc';
                    echo '</th>';
           echo '</tr>';
for ($action_get_caja=0; $action_get_caja< $num_get_caja; $action_get_caja++)
    {
      $assoc_get_caja = mysql_fetch_assoc($get_caja);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_caj=$assoc_get_caja['ID_caj'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_control=$assoc_get_caja['ID_control'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_usu=$assoc_get_caja['ID_usu'];
                     echo '</th>';
                     echo '<th>';
                      echo $caj_fec=$assoc_get_caja['caj_fec'];
                     echo '</th>';
                     echo '<th>';
                      echo $caj_horaa=$assoc_get_caja['caj_horaa'];
                     echo '</th>';
                     echo '<th>';
                      echo $caj_horac=$assoc_get_caja['caj_horac'];
                     echo '</th>';
                     echo '<th>';
                      echo $cja_vta=$assoc_get_caja['cja_vta'];
                     echo '</th>';
                     echo '<th>';
                      echo $cja_vct=$assoc_get_caja['cja_vct'];
                     echo '</th>';
                     echo '<th>';
                      echo $cja_vef=$assoc_get_caja['cja_vef'];
                     echo '</th>';
                     echo '<th>';
                      echo $caj_inicio=$assoc_get_caja['caj_inicio'];
                     echo '</th>';
                     echo '<th>';
                      echo $caj_cierre=$assoc_get_caja['caj_cierre'];
                     echo '</th>';
                     echo '<th>';
                      echo $caj_vne=$assoc_get_caja['caj_vne'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_suc=$assoc_get_caja['ID_suc'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_cajaById')
{
$get_cajaById = $caja->get_cajaById($ID_caj);
$assoc_get_cajaById = mysql_fetch_assoc($get_cajaById);
}

if ($action=='insert_caja')
{
$insert_caja = $caja->insert_caja($ID_control, $ID_usu, $caj_fec, $caj_horaa, $caj_horac, $cja_vta, $cja_vct, $cja_vef, $caj_inicio, $caj_cierre, $caj_vne, $ID_suc);
}

if ($action=='update_caja')
{
$update_caja = $caja->update_caja($ID_caj, $ID_control, $ID_usu, $caj_fec, $caj_horaa, $caj_horac, $cja_vta, $cja_vct, $cja_vef, $caj_inicio, $caj_cierre, $caj_vne, $ID_suc);
}

if ($action=='drop_caja')
{
$drop_caja = $caja->drop_caja($ID_caj);
}


$categorias = new categorias;

@$ID_cat=$_POST['ID_cat'];
@$cat_desc=$_POST['cat_desc'];

if ($action=='get_categorias')
{
  $get_categorias = $categorias->get_categorias();
  $num_get_categorias = mysql_num_rows($get_categorias);

      $assoc_get_categorias = mysql_fetch_assoc($get_categorias);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_cat';
                    echo '</th>';
                    echo '<th>';
                      echo 'cat_desc';
                    echo '</th>';
           echo '</tr>';
for ($action_get_categorias=0; $action_get_categorias< $num_get_categorias; $action_get_categorias++)
    {
      $assoc_get_categorias = mysql_fetch_assoc($get_categorias);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_cat=$assoc_get_categorias['ID_cat'];
                     echo '</th>';
                     echo '<th>';
                      echo $cat_desc=$assoc_get_categorias['cat_desc'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_categoriasById')
{
$get_categoriasById = $categorias->get_categoriasById($ID_cat);
$assoc_get_categoriasById = mysql_fetch_assoc($get_categoriasById);
}

if ($action=='insert_categorias')
{
$insert_categorias = $categorias->insert_categorias($cat_desc);
echo '<script type="text/javascript">
window.location.assign("'.$atras.'");
</script>';
}

if ($action=='update_categorias')
{
$update_categorias = $categorias->update_categorias($ID_cat, $cat_desc);
}

if ($action=='drop_categorias')
{
$drop_categorias = $categorias->drop_categorias($ID_cat);
}


$cheques = new cheques;

@$ID_che=$_POST['ID_che'];
@$che_num=$_POST['che_num'];
@$ID_ban=$_POST['ID_ban'];
@$che_importe=$_POST['che_importe'];

if ($action=='get_cheques')
{
  $get_cheques = $cheques->get_cheques();
  $num_get_cheques = mysql_num_rows($get_cheques);

      $assoc_get_cheques = mysql_fetch_assoc($get_cheques);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_che';
                    echo '</th>';
                    echo '<th>';
                      echo 'che_num';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_ban';
                    echo '</th>';
                    echo '<th>';
                      echo 'che_importe';
                    echo '</th>';
           echo '</tr>';
for ($action_get_cheques=0; $action_get_cheques< $num_get_cheques; $action_get_cheques++)
    {
      $assoc_get_cheques = mysql_fetch_assoc($get_cheques);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_che=$assoc_get_cheques['ID_che'];
                     echo '</th>';
                     echo '<th>';
                      echo $che_num=$assoc_get_cheques['che_num'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_ban=$assoc_get_cheques['ID_ban'];
                     echo '</th>';
                     echo '<th>';
                      echo $che_importe=$assoc_get_cheques['che_importe'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_chequesById')
{
$get_chequesById = $cheques->get_chequesById($ID_che);
$assoc_get_chequesById = mysql_fetch_assoc($get_chequesById);
}

if ($action=='insert_cheques')
{
$insert_cheques = $cheques->insert_cheques($che_num, $ID_ban, $che_importe);
}

if ($action=='update_cheques')
{
$update_cheques = $cheques->update_cheques($ID_che, $che_num, $ID_ban, $che_importe);
}

if ($action=='drop_cheques')
{
$drop_cheques = $cheques->drop_cheques($ID_che);
}


$clientes = new clientes;

@$ID_cli=$_POST['ID_cli'];
@$cli_nombre=$_POST['cli_nombre'];
@$cli_apellido=$_POST['cli_apellido'];
@$cli_telefono=$_POST['cli_telefono'];
@$cli_direccion=$_POST['cli_direccion'];
@$ID_suc=$_POST['ID_suc'];
@$cli_mail=$_POST['cli_mail'];

if ($action=='get_clientes')
{
  $get_clientes = $clientes->get_clientes();
  $num_get_clientes = mysql_num_rows($get_clientes);

      $assoc_get_clientes = mysql_fetch_assoc($get_clientes);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_cli';
                    echo '</th>';
                    echo '<th>';
                      echo 'cli_nombre';
                    echo '</th>';
                    echo '<th>';
                      echo 'cli_apellido';
                    echo '</th>';
                    echo '<th>';
                      echo 'cli_telefono';
                    echo '</th>';
                    echo '<th>';
                      echo 'cli_direccion';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_suc';
                    echo '</th>';
                    echo '<th>';
                      echo 'cli_mail';
                    echo '</th>';
           echo '</tr>';
for ($action_get_clientes=0; $action_get_clientes< $num_get_clientes; $action_get_clientes++)
    {
      $assoc_get_clientes = mysql_fetch_assoc($get_clientes);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_cli=$assoc_get_clientes['ID_cli'];
                     echo '</th>';
                     echo '<th>';
                      echo $cli_nombre=$assoc_get_clientes['cli_nombre'];
                     echo '</th>';
                     echo '<th>';
                      echo $cli_apellido=$assoc_get_clientes['cli_apellido'];
                     echo '</th>';
                     echo '<th>';
                      echo $cli_telefono=$assoc_get_clientes['cli_telefono'];
                     echo '</th>';
                     echo '<th>';
                      echo $cli_direccion=$assoc_get_clientes['cli_direccion'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_suc=$assoc_get_clientes['ID_suc'];
                     echo '</th>';
                     echo '<th>';
                      echo $cli_mail=$assoc_get_clientes['cli_mail'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_clientesById')
{
$get_clientesById = $clientes->get_clientesById($ID_cli);
$assoc_get_clientesById = mysql_fetch_assoc($get_clientesById);
}

if ($action=='insert_clientes')
{
$insert_clientes = $clientes->insert_clientes($cli_nombre, $cli_apellido, $cli_telefono, $cli_direccion, $ID_suc, $cli_mail);
}

if ($action=='update_clientes')
{
$update_clientes = $clientes->update_clientes($ID_cli, $cli_nombre, $cli_apellido, $cli_telefono, $cli_direccion, $ID_suc, $cli_mail);
}

if ($action=='drop_clientes')
{
$drop_clientes = $clientes->drop_clientes($ID_cli);
}


$comisiones = new comisiones;

@$ID_cos=$_POST['ID_cos'];
@$ID_acr=$_POST['ID_acr'];
@$cos_desc=$_POST['cos_desc'];
@$cos_monto=$_POST['cos_monto'];

if ($action=='get_comisiones')
{
  $get_comisiones = $comisiones->get_comisiones();
  $num_get_comisiones = mysql_num_rows($get_comisiones);

      $assoc_get_comisiones = mysql_fetch_assoc($get_comisiones);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_cos';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_acr';
                    echo '</th>';
                    echo '<th>';
                      echo 'cos_desc';
                    echo '</th>';
                    echo '<th>';
                      echo 'cos_monto';
                    echo '</th>';
           echo '</tr>';
for ($action_get_comisiones=0; $action_get_comisiones< $num_get_comisiones; $action_get_comisiones++)
    {
      $assoc_get_comisiones = mysql_fetch_assoc($get_comisiones);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_cos=$assoc_get_comisiones['ID_cos'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_acr=$assoc_get_comisiones['ID_acr'];
                     echo '</th>';
                     echo '<th>';
                      echo $cos_desc=$assoc_get_comisiones['cos_desc'];
                     echo '</th>';
                     echo '<th>';
                      echo $cos_monto=$assoc_get_comisiones['cos_monto'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_comisionesById')
{
$get_comisionesById = $comisiones->get_comisionesById($ID_cos);
$assoc_get_comisionesById = mysql_fetch_assoc($get_comisionesById);
}

if ($action=='insert_comisiones')
{
$insert_comisiones = $comisiones->insert_comisiones($ID_acr, $cos_desc, $cos_monto);
}

if ($action=='update_comisiones')
{
$update_comisiones = $comisiones->update_comisiones($ID_cos, $ID_acr, $cos_desc, $cos_monto);
}

if ($action=='drop_comisiones')
{
$drop_comisiones = $comisiones->drop_comisiones($ID_cos);
}


$compras = new compras;

@$ID_com=$_POST['ID_com'];
@$ID_pro=$_POST['ID_pro'];
@$com_cod=$_POST['com_cod'];
@$com_ven=$_POST['com_ven'];
@$com_fec=$_POST['com_fec'];
@$ID_per=$_POST['ID_per'];
@$com_tipo=$_POST['com_tipo'];

if ($action=='get_compras')
{
  $get_compras = $compras->get_compras();
  $num_get_compras = mysql_num_rows($get_compras);

      $assoc_get_compras = mysql_fetch_assoc($get_compras);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_com';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_pro';
                    echo '</th>';
                    echo '<th>';
                      echo 'com_cod';
                    echo '</th>';
                    echo '<th>';
                      echo 'com_ven';
                    echo '</th>';
                    echo '<th>';
                      echo 'com_fec';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_per';
                    echo '</th>';
                    echo '<th>';
                      echo 'com_tipo';
                    echo '</th>';
           echo '</tr>';
for ($action_get_compras=0; $action_get_compras< $num_get_compras; $action_get_compras++)
    {
      $assoc_get_compras = mysql_fetch_assoc($get_compras);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_com=$assoc_get_compras['ID_com'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_pro=$assoc_get_compras['ID_pro'];
                     echo '</th>';
                     echo '<th>';
                      echo $com_cod=$assoc_get_compras['com_cod'];
                     echo '</th>';
                     echo '<th>';
                      echo $com_ven=$assoc_get_compras['com_ven'];
                     echo '</th>';
                     echo '<th>';
                      echo $com_fec=$assoc_get_compras['com_fec'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_per=$assoc_get_compras['ID_per'];
                     echo '</th>';
                     echo '<th>';
                      echo $com_tipo=$assoc_get_compras['com_tipo'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_comprasById')
{
$get_comprasById = $compras->get_comprasById($ID_com);
$assoc_get_comprasById = mysql_fetch_assoc($get_comprasById);
}

if ($action=='insert_compras')
{
$insert_compras = $compras->insert_compras($ID_pro, $com_cod, $com_ven, $com_fec, $ID_per, $com_tipo);
}

if ($action=='update_compras')
{
$update_compras = $compras->update_compras($ID_com, $ID_pro, $com_cod, $com_ven, $com_fec, $ID_per, $com_tipo);
}

if ($action=='drop_compras')
{
$drop_compras = $compras->drop_compras($ID_com);
}


$cuenta_cte = new cuenta_cte;

@$ID_cte=$_POST['ID_cte'];
@$ID_cli=$_POST['ID_cli'];
@$cte_fec=$_POST['cte_fec'];
@$cte_monto=$_POST['cte_monto'];
@$cte_tipo=$_POST['cte_tipo'];
@$ID_fpo=$_POST['ID_fpo'];

if ($action=='get_cuenta_cte')
{
  $get_cuenta_cte = $cuenta_cte->get_cuenta_cte();
  $num_get_cuenta_cte = mysql_num_rows($get_cuenta_cte);

      $assoc_get_cuenta_cte = mysql_fetch_assoc($get_cuenta_cte);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_cte';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_cli';
                    echo '</th>';
                    echo '<th>';
                      echo 'cte_fec';
                    echo '</th>';
                    echo '<th>';
                      echo 'cte_monto';
                    echo '</th>';
                    echo '<th>';
                      echo 'cte_tipo';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_fpo';
                    echo '</th>';
           echo '</tr>';
for ($action_get_cuenta_cte=0; $action_get_cuenta_cte< $num_get_cuenta_cte; $action_get_cuenta_cte++)
    {
      $assoc_get_cuenta_cte = mysql_fetch_assoc($get_cuenta_cte);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_cte=$assoc_get_cuenta_cte['ID_cte'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_cli=$assoc_get_cuenta_cte['ID_cli'];
                     echo '</th>';
                     echo '<th>';
                      echo $cte_fec=$assoc_get_cuenta_cte['cte_fec'];
                     echo '</th>';
                     echo '<th>';
                      echo $cte_monto=$assoc_get_cuenta_cte['cte_monto'];
                     echo '</th>';
                     echo '<th>';
                      echo $cte_tipo=$assoc_get_cuenta_cte['cte_tipo'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_fpo=$assoc_get_cuenta_cte['ID_fpo'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_cuenta_cteById')
{
$get_cuenta_cteById = $cuenta_cte->get_cuenta_cteById($ID_cte);
$assoc_get_cuenta_cteById = mysql_fetch_assoc($get_cuenta_cteById);
}

if ($action=='insert_cuenta_cte')
{
$insert_cuenta_cte = $cuenta_cte->insert_cuenta_cte($ID_cli, $cte_fec, $cte_monto, $cte_tipo, $ID_fpo);
}

if ($action=='update_cuenta_cte')
{
$update_cuenta_cte = $cuenta_cte->update_cuenta_cte($ID_cte, $ID_cli, $cte_fec, $cte_monto, $cte_tipo, $ID_fpo);
}

if ($action=='drop_cuenta_cte')
{
$drop_cuenta_cte = $cuenta_cte->drop_cuenta_cte($ID_cte);
}


$cuentas_bancarias = new cuentas_bancarias;

@$ID_cue=$_POST['ID_cue'];
@$cue_num=$_POST['cue_num'];
@$ID_ban=$_POST['ID_ban'];
@$cue_saldo=$_POST['cue_saldo'];

if ($action=='get_cuentas_bancarias')
{
  $get_cuentas_bancarias = $cuentas_bancarias->get_cuentas_bancarias();
  $num_get_cuentas_bancarias = mysql_num_rows($get_cuentas_bancarias);

      $assoc_get_cuentas_bancarias = mysql_fetch_assoc($get_cuentas_bancarias);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_cue';
                    echo '</th>';
                    echo '<th>';
                      echo 'cue_num';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_ban';
                    echo '</th>';
                    echo '<th>';
                      echo 'cue_saldo';
                    echo '</th>';
           echo '</tr>';
for ($action_get_cuentas_bancarias=0; $action_get_cuentas_bancarias< $num_get_cuentas_bancarias; $action_get_cuentas_bancarias++)
    {
      $assoc_get_cuentas_bancarias = mysql_fetch_assoc($get_cuentas_bancarias);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_cue=$assoc_get_cuentas_bancarias['ID_cue'];
                     echo '</th>';
                     echo '<th>';
                      echo $cue_num=$assoc_get_cuentas_bancarias['cue_num'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_ban=$assoc_get_cuentas_bancarias['ID_ban'];
                     echo '</th>';
                     echo '<th>';
                      echo $cue_saldo=$assoc_get_cuentas_bancarias['cue_saldo'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_cuentas_bancariasById')
{
$get_cuentas_bancariasById = $cuentas_bancarias->get_cuentas_bancariasById($ID_cue);
$assoc_get_cuentas_bancariasById = mysql_fetch_assoc($get_cuentas_bancariasById);
}

if ($action=='insert_cuentas_bancarias')
{
$insert_cuentas_bancarias = $cuentas_bancarias->insert_cuentas_bancarias($cue_num, $ID_ban, $cue_saldo);
}

if ($action=='update_cuentas_bancarias')
{
$update_cuentas_bancarias = $cuentas_bancarias->update_cuentas_bancarias($ID_cue, $cue_num, $ID_ban, $cue_saldo);
}

if ($action=='drop_cuentas_bancarias')
{
$drop_cuentas_bancarias = $cuentas_bancarias->drop_cuentas_bancarias($ID_cue);
}


$depositos_bancarios = new depositos_bancarios;

@$ID_dba=$_POST['ID_dba'];
@$dba_num=$_POST['dba_num'];
@$dba_fecdep=$_POST['dba_fecdep'];
@$dba_fecacr=$_POST['dba_fecacr'];
@$dba_efectivo=$_POST['dba_efectivo'];
@$ID_che=$_POST['ID_che'];

if ($action=='get_depositos_bancarios')
{
  $get_depositos_bancarios = $depositos_bancarios->get_depositos_bancarios();
  $num_get_depositos_bancarios = mysql_num_rows($get_depositos_bancarios);

      $assoc_get_depositos_bancarios = mysql_fetch_assoc($get_depositos_bancarios);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_dba';
                    echo '</th>';
                    echo '<th>';
                      echo 'dba_num';
                    echo '</th>';
                    echo '<th>';
                      echo 'dba_fecdep';
                    echo '</th>';
                    echo '<th>';
                      echo 'dba_fecacr';
                    echo '</th>';
                    echo '<th>';
                      echo 'dba_efectivo';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_che';
                    echo '</th>';
           echo '</tr>';
for ($action_get_depositos_bancarios=0; $action_get_depositos_bancarios< $num_get_depositos_bancarios; $action_get_depositos_bancarios++)
    {
      $assoc_get_depositos_bancarios = mysql_fetch_assoc($get_depositos_bancarios);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_dba=$assoc_get_depositos_bancarios['ID_dba'];
                     echo '</th>';
                     echo '<th>';
                      echo $dba_num=$assoc_get_depositos_bancarios['dba_num'];
                     echo '</th>';
                     echo '<th>';
                      echo $dba_fecdep=$assoc_get_depositos_bancarios['dba_fecdep'];
                     echo '</th>';
                     echo '<th>';
                      echo $dba_fecacr=$assoc_get_depositos_bancarios['dba_fecacr'];
                     echo '</th>';
                     echo '<th>';
                      echo $dba_efectivo=$assoc_get_depositos_bancarios['dba_efectivo'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_che=$assoc_get_depositos_bancarios['ID_che'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_depositos_bancariosById')
{
$get_depositos_bancariosById = $depositos_bancarios->get_depositos_bancariosById($ID_dba);
$assoc_get_depositos_bancariosById = mysql_fetch_assoc($get_depositos_bancariosById);
}

if ($action=='insert_depositos_bancarios')
{
$insert_depositos_bancarios = $depositos_bancarios->insert_depositos_bancarios($dba_num, $dba_fecdep, $dba_fecacr, $dba_efectivo, $ID_che);
}

if ($action=='update_depositos_bancarios')
{
$update_depositos_bancarios = $depositos_bancarios->update_depositos_bancarios($ID_dba, $dba_num, $dba_fecdep, $dba_fecacr, $dba_efectivo, $ID_che);
}

if ($action=='drop_depositos_bancarios')
{
$drop_depositos_bancarios = $depositos_bancarios->drop_depositos_bancarios($ID_dba);
}


$modulos = new modulos;

@$ID_mod=$_POST['ID_mod'];
@$mod_desc=$_POST['mod_desc'];
@$mod_icono=$_POST['mod_icono'];

if ($action=='get_modulos')
{
  $get_modulos = $modulos->get_modulos();
  $num_get_modulos = mysql_num_rows($get_modulos);

      $assoc_get_modulos = mysql_fetch_assoc($get_modulos);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_mod';
                    echo '</th>';
                    echo '<th>';
                      echo 'mod_desc';
                    echo '</th>';
                    echo '<th>';
                      echo 'mod_icono';
                    echo '</th>';
           echo '</tr>';
for ($action_get_modulos=0; $action_get_modulos< $num_get_modulos; $action_get_modulos++)
    {
      $assoc_get_modulos = mysql_fetch_assoc($get_modulos);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_mod=$assoc_get_modulos['ID_mod'];
                     echo '</th>';
                     echo '<th>';
                      echo $mod_desc=$assoc_get_modulos['mod_desc'];
                     echo '</th>';
                     echo '<th>';
                      echo $mod_icono=$assoc_get_modulos['mod_icono'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_modulosById')
{
$get_modulosById = $modulos->get_modulosById($ID_mod);
$assoc_get_modulosById = mysql_fetch_assoc($get_modulosById);
}

if ($action=='insert_modulos')
{
$insert_modulos = $modulos->insert_modulos($mod_desc, $mod_icono);
}

if ($action=='update_modulos')
{
$update_modulos = $modulos->update_modulos($ID_mod, $mod_desc, $mod_icono);
}

if ($action=='drop_modulos')
{
$drop_modulos = $modulos->drop_modulos($ID_mod);
}


$mov_caja = new mov_caja;

@$ID_mov=$_POST['ID_mov'];
@$ID_ven=$_POST['ID_ven'];
@$mov_hora=$_POST['mov_hora'];
@$ID_art=$_POST['ID_art'];
@$ID_pre=$_POST['ID_pre'];
@$mov_cantidad=$_POST['mov_cantidad'];
@$mov_sal=$_POST['mov_sal'];

if ($action=='get_mov_caja')
{
  $get_mov_caja = $mov_caja->get_mov_caja();
  $num_get_mov_caja = mysql_num_rows($get_mov_caja);

      $assoc_get_mov_caja = mysql_fetch_assoc($get_mov_caja);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_mov';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_ven';
                    echo '</th>';
                    echo '<th>';
                      echo 'mov_hora';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_art';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_pre';
                    echo '</th>';
                    echo '<th>';
                      echo 'mov_cantidad';
                    echo '</th>';
                    echo '<th>';
                      echo 'mov_sal';
                    echo '</th>';
           echo '</tr>';
for ($action_get_mov_caja=0; $action_get_mov_caja< $num_get_mov_caja; $action_get_mov_caja++)
    {
      $assoc_get_mov_caja = mysql_fetch_assoc($get_mov_caja);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_mov=$assoc_get_mov_caja['ID_mov'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_ven=$assoc_get_mov_caja['ID_ven'];
                     echo '</th>';
                     echo '<th>';
                      echo $mov_hora=$assoc_get_mov_caja['mov_hora'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_art=$assoc_get_mov_caja['ID_art'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_pre=$assoc_get_mov_caja['ID_pre'];
                     echo '</th>';
                     echo '<th>';
                      echo $mov_cantidad=$assoc_get_mov_caja['mov_cantidad'];
                     echo '</th>';
                     echo '<th>';
                      echo $mov_sal=$assoc_get_mov_caja['mov_sal'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_mov_cajaById')
{
$get_mov_cajaById = $mov_caja->get_mov_cajaById($ID_mov);
$assoc_get_mov_cajaById = mysql_fetch_assoc($get_mov_cajaById);
}

if ($action=='insert_mov_caja')
{
$insert_mov_caja = $mov_caja->insert_mov_caja($ID_ven, $mov_hora, $ID_art, $ID_pre, $mov_cantidad, $mov_sal);
}

if ($action=='update_mov_caja')
{
$update_mov_caja = $mov_caja->update_mov_caja($ID_mov, $ID_ven, $mov_hora, $ID_art, $ID_pre, $mov_cantidad, $mov_sal);
}

if ($action=='drop_mov_caja')
{
$drop_mov_caja = $mov_caja->drop_mov_caja($ID_mov);
}




if ($action=='get_ordenes_pagos')
{
  $ordenes_pagos = new ordenes_pagos;

@$ID_odp=$_POST['ID_odp'];
@$odp_desc=$_POST['odp_desc'];
@$ID_com=$_POST['ID_com'];
@$odp_fec=$_POST['odp_fec'];
@$ID_fpo=$_POST['ID_fpo'];
@$odp_tipo=$_POST['odp_tipo'];
@$odp_monto=$_POST['odp_monto'];
@$odp_retencion=$_POST['odp_retencion'];
@$odp_neto=$_POST['odp_neto'];
  $get_ordenes_pagos = $ordenes_pagos->get_ordenes_pagos();
  $num_get_ordenes_pagos = mysql_num_rows($get_ordenes_pagos);

      $assoc_get_ordenes_pagos = mysql_fetch_assoc($get_ordenes_pagos);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_odp';
                    echo '</th>';
                    echo '<th>';
                      echo 'odp_desc';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_com';
                    echo '</th>';
                    echo '<th>';
                      echo 'odp_fec';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_fpo';
                    echo '</th>';
                    echo '<th>';
                      echo 'odp_tipo';
                    echo '</th>';
                    echo '<th>';
                      echo 'odp_monto';
                    echo '</th>';
                    echo '<th>';
                      echo 'odp_retencion';
                    echo '</th>';
                    echo '<th>';
                      echo 'odp_neto';
                    echo '</th>';
           echo '</tr>';
for ($action_get_ordenes_pagos=0; $action_get_ordenes_pagos< $num_get_ordenes_pagos; $action_get_ordenes_pagos++)
    {
      $assoc_get_ordenes_pagos = mysql_fetch_assoc($get_ordenes_pagos);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_odp=$assoc_get_ordenes_pagos['ID_odp'];
                     echo '</th>';
                     echo '<th>';
                      echo $odp_desc=$assoc_get_ordenes_pagos['odp_desc'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_com=$assoc_get_ordenes_pagos['ID_com'];
                     echo '</th>';
                     echo '<th>';
                      echo $odp_fec=$assoc_get_ordenes_pagos['odp_fec'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_fpo=$assoc_get_ordenes_pagos['ID_fpo'];
                     echo '</th>';
                     echo '<th>';
                      echo $odp_tipo=$assoc_get_ordenes_pagos['odp_tipo'];
                     echo '</th>';
                     echo '<th>';
                      echo $odp_monto=$assoc_get_ordenes_pagos['odp_monto'];
                     echo '</th>';
                     echo '<th>';
                      echo $odp_retencion=$assoc_get_ordenes_pagos['odp_retencion'];
                     echo '</th>';
                     echo '<th>';
                      echo $odp_neto=$assoc_get_ordenes_pagos['odp_neto'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_ordenes_pagosById')
{
$get_ordenes_pagosById = $ordenes_pagos->get_ordenes_pagosById($ID_odp);
$assoc_get_ordenes_pagosById = mysql_fetch_assoc($get_ordenes_pagosById);
}

if ($action=='insert_ordenes_pagos')
{
$insert_ordenes_pagos = $ordenes_pagos->insert_ordenes_pagos($odp_desc, $ID_com, $odp_fec, $ID_fpo, $odp_tipo, $odp_monto, $odp_retencion, $odp_neto);
}

if ($action=='update_ordenes_pagos')
{
$update_ordenes_pagos = $ordenes_pagos->update_ordenes_pagos($ID_odp, $odp_desc, $ID_com, $odp_fec, $ID_fpo, $odp_tipo, $odp_monto, $odp_retencion, $odp_neto);
}

if ($action=='drop_ordenes_pagos')
{
$drop_ordenes_pagos = $ordenes_pagos->drop_ordenes_pagos($ID_odp);
}


$paginas = new paginas;

@$ID_pag=$_POST['ID_pag'];
@$pag_desc=$_POST['pag_desc'];
@$ID_mod=$_POST['ID_mod'];
@$pag_icono=$_POST['pag_icono'];
@$pag_url=$_POST['pag_url'];

if ($action=='get_paginas')
{
  $get_paginas = $paginas->get_paginas();
  $num_get_paginas = mysql_num_rows($get_paginas);

      $assoc_get_paginas = mysql_fetch_assoc($get_paginas);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_pag';
                    echo '</th>';
                    echo '<th>';
                      echo 'pag_desc';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_mod';
                    echo '</th>';
                    echo '<th>';
                      echo 'pag_icono';
                    echo '</th>';
                    echo '<th>';
                      echo 'pag_url';
                    echo '</th>';
           echo '</tr>';
for ($action_get_paginas=0; $action_get_paginas< $num_get_paginas; $action_get_paginas++)
    {
      $assoc_get_paginas = mysql_fetch_assoc($get_paginas);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_pag=$assoc_get_paginas['ID_pag'];
                     echo '</th>';
                     echo '<th>';
                      echo $pag_desc=$assoc_get_paginas['pag_desc'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_mod=$assoc_get_paginas['ID_mod'];
                     echo '</th>';
                     echo '<th>';
                      echo $pag_icono=$assoc_get_paginas['pag_icono'];
                     echo '</th>';
                     echo '<th>';
                      echo $pag_url=$assoc_get_paginas['pag_url'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_paginasById')
{
$get_paginasById = $paginas->get_paginasById($ID_pag);
$assoc_get_paginasById = mysql_fetch_assoc($get_paginasById);
}

if ($action=='insert_paginas')
{
$insert_paginas = $paginas->insert_paginas($pag_desc, $ID_mod, $pag_icono, $pag_url);
}

if ($action=='update_paginas')
{
$update_paginas = $paginas->update_paginas($ID_pag, $pag_desc, $ID_mod, $pag_icono, $pag_url);
}

if ($action=='drop_paginas')
{
$drop_paginas = $paginas->drop_paginas($ID_pag);
}


$pagos_bancarios = new pagos_bancarios;

@$ID_pba=$_POST['ID_pba'];
@$pba_desc=$_POST['pba_desc'];
@$ID_cue=$_POST['ID_cue'];
@$cue_imp=$_POST['cue_imp'];
@$cue_fecmov=$_POST['cue_fecmov'];
@$cue_fecvengamiento=$_POST['cue_fecvengamiento'];

if ($action=='get_pagos_bancarios')
{
  $get_pagos_bancarios = $pagos_bancarios->get_pagos_bancarios();
  $num_get_pagos_bancarios = mysql_num_rows($get_pagos_bancarios);

      $assoc_get_pagos_bancarios = mysql_fetch_assoc($get_pagos_bancarios);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_pba';
                    echo '</th>';
                    echo '<th>';
                      echo 'pba_desc';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_cue';
                    echo '</th>';
                    echo '<th>';
                      echo 'cue_imp';
                    echo '</th>';
                    echo '<th>';
                      echo 'cue_fecmov';
                    echo '</th>';
                    echo '<th>';
                      echo 'cue_fecvengamiento';
                    echo '</th>';
           echo '</tr>';
for ($action_get_pagos_bancarios=0; $action_get_pagos_bancarios< $num_get_pagos_bancarios; $action_get_pagos_bancarios++)
    {
      $assoc_get_pagos_bancarios = mysql_fetch_assoc($get_pagos_bancarios);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_pba=$assoc_get_pagos_bancarios['ID_pba'];
                     echo '</th>';
                     echo '<th>';
                      echo $pba_desc=$assoc_get_pagos_bancarios['pba_desc'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_cue=$assoc_get_pagos_bancarios['ID_cue'];
                     echo '</th>';
                     echo '<th>';
                      echo $cue_imp=$assoc_get_pagos_bancarios['cue_imp'];
                     echo '</th>';
                     echo '<th>';
                      echo $cue_fecmov=$assoc_get_pagos_bancarios['cue_fecmov'];
                     echo '</th>';
                     echo '<th>';
                      echo $cue_fecvengamiento=$assoc_get_pagos_bancarios['cue_fecvengamiento'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_pagos_bancariosById')
{
$get_pagos_bancariosById = $pagos_bancarios->get_pagos_bancariosById($ID_pba);
$assoc_get_pagos_bancariosById = mysql_fetch_assoc($get_pagos_bancariosById);
}

if ($action=='insert_pagos_bancarios')
{
$insert_pagos_bancarios = $pagos_bancarios->insert_pagos_bancarios($pba_desc, $ID_cue, $cue_imp, $cue_fecmov, $cue_fecvengamiento);
}

if ($action=='update_pagos_bancarios')
{
$update_pagos_bancarios = $pagos_bancarios->update_pagos_bancarios($ID_pba, $pba_desc, $ID_cue, $cue_imp, $cue_fecmov, $cue_fecvengamiento);
}

if ($action=='drop_pagos_bancarios')
{
$drop_pagos_bancarios = $pagos_bancarios->drop_pagos_bancarios($ID_pba);
}


$periodos_fiscales = new periodos_fiscales;

@$ID_per=$_POST['ID_per'];
@$per_desc=$_POST['per_desc'];
@$per_fecini=$_POST['per_fecini'];
@$per_fecfin=$_POST['per_fecfin'];

if ($action=='get_periodos_fiscales')
{
  $get_periodos_fiscales = $periodos_fiscales->get_periodos_fiscales();
  $num_get_periodos_fiscales = mysql_num_rows($get_periodos_fiscales);

      $assoc_get_periodos_fiscales = mysql_fetch_assoc($get_periodos_fiscales);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_per';
                    echo '</th>';
                    echo '<th>';
                      echo 'per_desc';
                    echo '</th>';
                    echo '<th>';
                      echo 'per_fecini';
                    echo '</th>';
                    echo '<th>';
                      echo 'per_fecfin';
                    echo '</th>';
           echo '</tr>';
for ($action_get_periodos_fiscales=0; $action_get_periodos_fiscales< $num_get_periodos_fiscales; $action_get_periodos_fiscales++)
    {
      $assoc_get_periodos_fiscales = mysql_fetch_assoc($get_periodos_fiscales);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_per=$assoc_get_periodos_fiscales['ID_per'];
                     echo '</th>';
                     echo '<th>';
                      echo $per_desc=$assoc_get_periodos_fiscales['per_desc'];
                     echo '</th>';
                     echo '<th>';
                      echo $per_fecini=$assoc_get_periodos_fiscales['per_fecini'];
                     echo '</th>';
                     echo '<th>';
                      echo $per_fecfin=$assoc_get_periodos_fiscales['per_fecfin'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_periodos_fiscalesById')
{
$get_periodos_fiscalesById = $periodos_fiscales->get_periodos_fiscalesById($ID_per);
$assoc_get_periodos_fiscalesById = mysql_fetch_assoc($get_periodos_fiscalesById);
}

if ($action=='insert_periodos_fiscales')
{
$insert_periodos_fiscales = $periodos_fiscales->insert_periodos_fiscales($per_desc, $per_fecini, $per_fecfin);
}

if ($action=='update_periodos_fiscales')
{
$update_periodos_fiscales = $periodos_fiscales->update_periodos_fiscales($ID_per, $per_desc, $per_fecini, $per_fecfin);
}

if ($action=='drop_periodos_fiscales')
{
$drop_periodos_fiscales = $periodos_fiscales->drop_periodos_fiscales($ID_per);
}


$permisos = new permisos;

@$ID_per=$_POST['ID_per'];
@$ID_usu=$_POST['ID_usu'];
@$ID_mod=$_POST['ID_mod'];

if ($action=='get_permisos')
{
  $get_permisos = $permisos->get_permisos();
  $num_get_permisos = mysql_num_rows($get_permisos);

      $assoc_get_permisos = mysql_fetch_assoc($get_permisos);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_per';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_usu';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_mod';
                    echo '</th>';
           echo '</tr>';
for ($action_get_permisos=0; $action_get_permisos< $num_get_permisos; $action_get_permisos++)
    {
      $assoc_get_permisos = mysql_fetch_assoc($get_permisos);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_per=$assoc_get_permisos['ID_per'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_usu=$assoc_get_permisos['ID_usu'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_mod=$assoc_get_permisos['ID_mod'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_permisosById')
{
$get_permisosById = $permisos->get_permisosById($ID_per);
$assoc_get_permisosById = mysql_fetch_assoc($get_permisosById);
}

if ($action=='insert_permisos')
{
$insert_permisos = $permisos->insert_permisos($ID_usu, $ID_mod);
}

if ($action=='update_permisos')
{
$update_permisos = $permisos->update_permisos($ID_per, $ID_usu, $ID_mod);
}

if ($action=='drop_permisos')
{
$drop_permisos = $permisos->drop_permisos($ID_per);
}


$precios = new precios;

@$ID_pre=$_POST['ID_pre'];
@$pre_cant=$_POST['pre_cant'];
@$pre_iva=$_POST['pre_iva'];
@$pre_neto=$_POST['pre_neto'];
@$pre_fec=$_POST['pre_fec'];

if ($action=='get_precios')
{
  $get_precios = $precios->get_precios();
  $num_get_precios = mysql_num_rows($get_precios);

      $assoc_get_precios = mysql_fetch_assoc($get_precios);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_pre';
                    echo '</th>';
                    echo '<th>';
                      echo 'pre_cant';
                    echo '</th>';
                    echo '<th>';
                      echo 'pre_iva';
                    echo '</th>';
                    echo '<th>';
                      echo 'pre_neto';
                    echo '</th>';
                    echo '<th>';
                      echo 'pre_fec';
                    echo '</th>';
           echo '</tr>';
for ($action_get_precios=0; $action_get_precios< $num_get_precios; $action_get_precios++)
    {
      $assoc_get_precios = mysql_fetch_assoc($get_precios);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_pre=$assoc_get_precios['ID_pre'];
                     echo '</th>';
                     echo '<th>';
                      echo $pre_cant=$assoc_get_precios['pre_cant'];
                     echo '</th>';
                     echo '<th>';
                      echo $pre_iva=$assoc_get_precios['pre_iva'];
                     echo '</th>';
                     echo '<th>';
                      echo $pre_neto=$assoc_get_precios['pre_neto'];
                     echo '</th>';
                     echo '<th>';
                      echo $pre_fec=$assoc_get_precios['pre_fec'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_preciosById')
{
$get_preciosById = $precios->get_preciosById($ID_pre);
$assoc_get_preciosById = mysql_fetch_assoc($get_preciosById);
}

if ($action=='insert_precios')
{
$insert_precios = $precios->insert_precios($pre_cant, $pre_iva, $pre_neto, $pre_fec);
}

if ($action=='update_precios')
{
$update_precios = $precios->update_precios($ID_pre, $pre_cant, $pre_iva, $pre_neto, $pre_fec);
}

if ($action=='drop_precios')
{
$drop_precios = $precios->drop_precios($ID_pre);
}


$proveedores = new proveedores;

@$ID_pro=$_POST['ID_pro'];
@$pro_desc=$_POST['pro_desc'];
@$pro_tel=$_POST['pro_tel'];
@$pro_dir=$_POST['pro_dir'];

if ($action=='get_proveedores')
{
  $get_proveedores = $proveedores->get_proveedores();
  $num_get_proveedores = mysql_num_rows($get_proveedores);

      $assoc_get_proveedores = mysql_fetch_assoc($get_proveedores);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_pro';
                    echo '</th>';
                    echo '<th>';
                      echo 'pro_desc';
                    echo '</th>';
                    echo '<th>';
                      echo 'pro_tel';
                    echo '</th>';
                    echo '<th>';
                      echo 'pro_dir';
                    echo '</th>';
           echo '</tr>';
for ($action_get_proveedores=0; $action_get_proveedores< $num_get_proveedores; $action_get_proveedores++)
    {
      $assoc_get_proveedores = mysql_fetch_assoc($get_proveedores);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_pro=$assoc_get_proveedores['ID_pro'];
                     echo '</th>';
                     echo '<th>';
                      echo $pro_desc=$assoc_get_proveedores['pro_desc'];
                     echo '</th>';
                     echo '<th>';
                      echo $pro_tel=$assoc_get_proveedores['pro_tel'];
                     echo '</th>';
                     echo '<th>';
                      echo $pro_dir=$assoc_get_proveedores['pro_dir'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_proveedoresById')
{
$get_proveedoresById = $proveedores->get_proveedoresById($ID_pro);
$assoc_get_proveedoresById = mysql_fetch_assoc($get_proveedoresById);
}

if ($action=='insert_proveedores')
{
$insert_proveedores = $proveedores->insert_proveedores($pro_desc, $pro_tel, $pro_dir);
echo '<script type="text/javascript">
window.location.assign("'.$atras.'");
</script>';
}

if ($action=='update_proveedores')
{
$update_proveedores = $proveedores->update_proveedores($ID_pro, $pro_desc, $pro_tel, $pro_dir);
}

if ($action=='drop_proveedores')
{
$drop_proveedores = $proveedores->drop_proveedores($ID_pro);
}


$stock = new stock;

@$ID_sto=$_POST['ID_sto'];
@$sto_can=$_POST['sto_can'];
@$ID_suc=$_POST['ID_suc'];
@$ID_art=$_POST['ID_art'];
@$sto_uni=$_POST['sto_uni'];
@$sto_fecing=$_POST['sto_fecing'];
@$sto_fecven=$_POST['sto_fecven'];

if ($action=='get_stock')
{
  $get_stock = $stock->get_stock();
  $num_get_stock = mysql_num_rows($get_stock);

      $assoc_get_stock = mysql_fetch_assoc($get_stock);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_sto';
                    echo '</th>';
                    echo '<th>';
                      echo 'sto_can';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_suc';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_art';
                    echo '</th>';
                    echo '<th>';
                      echo 'sto_uni';
                    echo '</th>';
                    echo '<th>';
                      echo 'sto_fecing';
                    echo '</th>';
                    echo '<th>';
                      echo 'sto_fecven';
                    echo '</th>';
           echo '</tr>';
for ($action_get_stock=0; $action_get_stock< $num_get_stock; $action_get_stock++)
    {
      $assoc_get_stock = mysql_fetch_assoc($get_stock);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_sto=$assoc_get_stock['ID_sto'];
                     echo '</th>';
                     echo '<th>';
                      echo $sto_can=$assoc_get_stock['sto_can'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_suc=$assoc_get_stock['ID_suc'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_art=$assoc_get_stock['ID_art'];
                     echo '</th>';
                     echo '<th>';
                      echo $sto_uni=$assoc_get_stock['sto_uni'];
                     echo '</th>';
                     echo '<th>';
                      echo $sto_fecing=$assoc_get_stock['sto_fecing'];
                     echo '</th>';
                     echo '<th>';
                      echo $sto_fecven=$assoc_get_stock['sto_fecven'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_stockById')
{
$get_stockById = $stock->get_stockById($ID_sto);
$assoc_get_stockById = mysql_fetch_assoc($get_stockById);
}

if ($action=='insert_stock')
{
$insert_stock = $stock->insert_stock($sto_can, $ID_suc, $ID_art, $sto_uni, $sto_fecing, $sto_fecven);
}

if ($action=='update_stock')
{
$update_stock = $stock->update_stock($ID_sto, $sto_can, $ID_suc, $ID_art, $sto_uni, $sto_fecing, $sto_fecven);
}

if ($action=='drop_stock')
{
$drop_stock = $stock->drop_stock($ID_sto);
}


$sub_categorias = new sub_categorias;

@$ID_sub=$_POST['ID_sub'];
@$ID_cat=$_POST['ID_cat'];
@$sub_desc=$_POST['sub_desc'];

if ($action=='get_sub_categorias')
{
  $get_sub_categorias = $sub_categorias->get_sub_categorias();
  $num_get_sub_categorias = mysql_num_rows($get_sub_categorias);

      $assoc_get_sub_categorias = mysql_fetch_assoc($get_sub_categorias);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_sub';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_cat';
                    echo '</th>';
                    echo '<th>';
                      echo 'sub_desc';
                    echo '</th>';
           echo '</tr>';
for ($action_get_sub_categorias=0; $action_get_sub_categorias< $num_get_sub_categorias; $action_get_sub_categorias++)
    {
      $assoc_get_sub_categorias = mysql_fetch_assoc($get_sub_categorias);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_sub=$assoc_get_sub_categorias['ID_sub'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_cat=$assoc_get_sub_categorias['ID_cat'];
                     echo '</th>';
                     echo '<th>';
                      echo $sub_desc=$assoc_get_sub_categorias['sub_desc'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_sub_categoriasById')
{
$get_sub_categoriasById = $sub_categorias->get_sub_categoriasById($ID_sub);
$assoc_get_sub_categoriasById = mysql_fetch_assoc($get_sub_categoriasById);
}

if ($action=='insert_sub_categorias')
{
$insert_sub_categorias = $sub_categorias->insert_sub_categorias($ID_cat, $sub_desc);
echo '<script type="text/javascript">
window.location.assign("'.$atras.'");
</script>';
}

if ($action=='update_sub_categorias')
{
$update_sub_categorias = $sub_categorias->update_sub_categorias($ID_sub, $ID_cat, $sub_desc);
}

if ($action=='drop_sub_categorias')
{
$drop_sub_categorias = $sub_categorias->drop_sub_categorias($ID_sub);
}


$sucursales = new sucursales;

@$ID_suc=$_POST['ID_suc'];
@$suc_desc=$_POST['suc_desc'];
@$suc_dir=$_POST['suc_dir'];
@$suc_tel=$_POST['suc_tel'];
@$suc_color=$_POST['suc_color'];
@$suc_icono=$_POST['suc_icono'];
@$suc_url=$_POST['suc_url'];

if ($action=='get_sucursales')
{
  $get_sucursales = $sucursales->get_sucursales();
  $num_get_sucursales = mysql_num_rows($get_sucursales);

      $assoc_get_sucursales = mysql_fetch_assoc($get_sucursales);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_suc';
                    echo '</th>';
                    echo '<th>';
                      echo 'suc_desc';
                    echo '</th>';
                    echo '<th>';
                      echo 'suc_dir';
                    echo '</th>';
                    echo '<th>';
                      echo 'suc_tel';
                    echo '</th>';
                    echo '<th>';
                      echo 'suc_color';
                    echo '</th>';
                    echo '<th>';
                      echo 'suc_icono';
                    echo '</th>';
                    echo '<th>';
                      echo 'suc_url';
                    echo '</th>';
           echo '</tr>';
for ($action_get_sucursales=0; $action_get_sucursales< $num_get_sucursales; $action_get_sucursales++)
    {
      $assoc_get_sucursales = mysql_fetch_assoc($get_sucursales);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_suc=$assoc_get_sucursales['ID_suc'];
                     echo '</th>';
                     echo '<th>';
                      echo $suc_desc=$assoc_get_sucursales['suc_desc'];
                     echo '</th>';
                     echo '<th>';
                      echo $suc_dir=$assoc_get_sucursales['suc_dir'];
                     echo '</th>';
                     echo '<th>';
                      echo $suc_tel=$assoc_get_sucursales['suc_tel'];
                     echo '</th>';
                     echo '<th>';
                      echo $suc_color=$assoc_get_sucursales['suc_color'];
                     echo '</th>';
                     echo '<th>';
                      echo $suc_icono=$assoc_get_sucursales['suc_icono'];
                     echo '</th>';
                     echo '<th>';
                      echo $suc_url=$assoc_get_sucursales['suc_url'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_sucursalesById')
{
$get_sucursalesById = $sucursales->get_sucursalesById($ID_suc);
$assoc_get_sucursalesById = mysql_fetch_assoc($get_sucursalesById);
}

if ($action=='insert_sucursales')
{
$insert_sucursales = $sucursales->insert_sucursales($suc_desc, $suc_dir, $suc_tel, $suc_color, $suc_icono, $suc_url);
}

if ($action=='update_sucursales')
{
$update_sucursales = $sucursales->update_sucursales($ID_suc, $suc_desc, $suc_dir, $suc_tel, $suc_color, $suc_icono, $suc_url);
}

if ($action=='drop_sucursales')
{
$drop_sucursales = $sucursales->drop_sucursales($ID_suc);
}


$tarjetas = new tarjetas;

@$ID_tar=$_POST['ID_tar'];
@$tar_desc=$_POST['tar_desc'];
@$tar_cue=$_POST['tar_cue'];
@$tar_logo=$_POST['tar_logo'];

if ($action=='get_tarjetas')
{
  $get_tarjetas = $tarjetas->get_tarjetas();
  $num_get_tarjetas = mysql_num_rows($get_tarjetas);

      $assoc_get_tarjetas = mysql_fetch_assoc($get_tarjetas);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_tar';
                    echo '</th>';
                    echo '<th>';
                      echo 'tar_desc';
                    echo '</th>';
                    echo '<th>';
                      echo 'tar_cue';
                    echo '</th>';
                    echo '<th>';
                      echo 'tar_logo';
                    echo '</th>';
           echo '</tr>';
for ($action_get_tarjetas=0; $action_get_tarjetas< $num_get_tarjetas; $action_get_tarjetas++)
    {
      $assoc_get_tarjetas = mysql_fetch_assoc($get_tarjetas);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_tar=$assoc_get_tarjetas['ID_tar'];
                     echo '</th>';
                     echo '<th>';
                      echo $tar_desc=$assoc_get_tarjetas['tar_desc'];
                     echo '</th>';
                     echo '<th>';
                      echo $tar_cue=$assoc_get_tarjetas['tar_cue'];
                     echo '</th>';
                     echo '<th>';
                      echo $tar_logo=$assoc_get_tarjetas['tar_logo'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_tarjetasById')
{
$get_tarjetasById = $tarjetas->get_tarjetasById($ID_tar);
$assoc_get_tarjetasById = mysql_fetch_assoc($get_tarjetasById);
}

if ($action=='insert_tarjetas')
{
$insert_tarjetas = $tarjetas->insert_tarjetas($tar_desc, $tar_cue, $tar_logo);
}

if ($action=='update_tarjetas')
{
$update_tarjetas = $tarjetas->update_tarjetas($ID_tar, $tar_desc, $tar_cue, $tar_logo);
}

if ($action=='drop_tarjetas')
{
$drop_tarjetas = $tarjetas->drop_tarjetas($ID_tar);
}


$tarjetas_acreditaciones = new tarjetas_acreditaciones;

@$ID_acr=$_POST['ID_acr'];
@$acr_fec=$_POST['acr_fec'];
@$ID_lot=$_POST['ID_lot'];
@$lote_neto=$_POST['lote_neto'];

if ($action=='get_tarjetas_acreditaciones')
{
  $get_tarjetas_acreditaciones = $tarjetas_acreditaciones->get_tarjetas_acreditaciones();
  $num_get_tarjetas_acreditaciones = mysql_num_rows($get_tarjetas_acreditaciones);

      $assoc_get_tarjetas_acreditaciones = mysql_fetch_assoc($get_tarjetas_acreditaciones);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_acr';
                    echo '</th>';
                    echo '<th>';
                      echo 'acr_fec';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_lot';
                    echo '</th>';
                    echo '<th>';
                      echo 'lote_neto';
                    echo '</th>';
           echo '</tr>';
for ($action_get_tarjetas_acreditaciones=0; $action_get_tarjetas_acreditaciones< $num_get_tarjetas_acreditaciones; $action_get_tarjetas_acreditaciones++)
    {
      $assoc_get_tarjetas_acreditaciones = mysql_fetch_assoc($get_tarjetas_acreditaciones);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_acr=$assoc_get_tarjetas_acreditaciones['ID_acr'];
                     echo '</th>';
                     echo '<th>';
                      echo $acr_fec=$assoc_get_tarjetas_acreditaciones['acr_fec'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_lot=$assoc_get_tarjetas_acreditaciones['ID_lot'];
                     echo '</th>';
                     echo '<th>';
                      echo $lote_neto=$assoc_get_tarjetas_acreditaciones['lote_neto'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_tarjetas_acreditacionesById')
{
$get_tarjetas_acreditacionesById = $tarjetas_acreditaciones->get_tarjetas_acreditacionesById($ID_acr);
$assoc_get_tarjetas_acreditacionesById = mysql_fetch_assoc($get_tarjetas_acreditacionesById);
}

if ($action=='insert_tarjetas_acreditaciones')
{
$insert_tarjetas_acreditaciones = $tarjetas_acreditaciones->insert_tarjetas_acreditaciones($acr_fec, $ID_lot, $lote_neto);
}

if ($action=='update_tarjetas_acreditaciones')
{
$update_tarjetas_acreditaciones = $tarjetas_acreditaciones->update_tarjetas_acreditaciones($ID_acr, $acr_fec, $ID_lot, $lote_neto);
}

if ($action=='drop_tarjetas_acreditaciones')
{
$drop_tarjetas_acreditaciones = $tarjetas_acreditaciones->drop_tarjetas_acreditaciones($ID_acr);
}


$tarjetas_lotes = new tarjetas_lotes;

@$ID_lot=$_POST['ID_lot'];
@$lot_fec=$_POST['lot_fec'];
@$lot_hor=$_POST['lot_hor'];
@$lot_total=$_POST['lot_total'];

if ($action=='get_tarjetas_lotes')
{
  $get_tarjetas_lotes = $tarjetas_lotes->get_tarjetas_lotes();
  $num_get_tarjetas_lotes = mysql_num_rows($get_tarjetas_lotes);

      $assoc_get_tarjetas_lotes = mysql_fetch_assoc($get_tarjetas_lotes);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_lot';
                    echo '</th>';
                    echo '<th>';
                      echo 'lot_fec';
                    echo '</th>';
                    echo '<th>';
                      echo 'lot_hor';
                    echo '</th>';
                    echo '<th>';
                      echo 'lot_total';
                    echo '</th>';
           echo '</tr>';
for ($action_get_tarjetas_lotes=0; $action_get_tarjetas_lotes< $num_get_tarjetas_lotes; $action_get_tarjetas_lotes++)
    {
      $assoc_get_tarjetas_lotes = mysql_fetch_assoc($get_tarjetas_lotes);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_lot=$assoc_get_tarjetas_lotes['ID_lot'];
                     echo '</th>';
                     echo '<th>';
                      echo $lot_fec=$assoc_get_tarjetas_lotes['lot_fec'];
                     echo '</th>';
                     echo '<th>';
                      echo $lot_hor=$assoc_get_tarjetas_lotes['lot_hor'];
                     echo '</th>';
                     echo '<th>';
                      echo $lot_total=$assoc_get_tarjetas_lotes['lot_total'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_tarjetas_lotesById')
{
$get_tarjetas_lotesById = $tarjetas_lotes->get_tarjetas_lotesById($ID_lot);
$assoc_get_tarjetas_lotesById = mysql_fetch_assoc($get_tarjetas_lotesById);
}

if ($action=='insert_tarjetas_lotes')
{
$insert_tarjetas_lotes = $tarjetas_lotes->insert_tarjetas_lotes($lot_fec, $lot_hor, $lot_total);
}

if ($action=='update_tarjetas_lotes')
{
$update_tarjetas_lotes = $tarjetas_lotes->update_tarjetas_lotes($ID_lot, $lot_fec, $lot_hor, $lot_total);
}

if ($action=='drop_tarjetas_lotes')
{
$drop_tarjetas_lotes = $tarjetas_lotes->drop_tarjetas_lotes($ID_lot);
}


$tarjetas_planes = new tarjetas_planes;

@$ID_pla=$_POST['ID_pla'];
@$pla_desc=$_POST['pla_desc'];
@$pla_cant=$_POST['pla_cant'];
@$ID_tar=$_POST['ID_tar'];
@$plan_tiempoAcre=$_POST['plan_tiempoAcre'];
@$ID_fpo=$_POST['ID_fpo'];
@$pla_recargo=$_POST['pla_recargo'];

if ($action=='get_tarjetas_planes')
{
  $get_tarjetas_planes = $tarjetas_planes->get_tarjetas_planes();
  $num_get_tarjetas_planes = mysql_num_rows($get_tarjetas_planes);

      $assoc_get_tarjetas_planes = mysql_fetch_assoc($get_tarjetas_planes);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_pla';
                    echo '</th>';
                    echo '<th>';
                      echo 'pla_desc';
                    echo '</th>';
                    echo '<th>';
                      echo 'pla_cant';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_tar';
                    echo '</th>';
                    echo '<th>';
                      echo 'plan_tiempoAcre';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_fpo';
                    echo '</th>';
                    echo '<th>';
                      echo 'pla_recargo';
                    echo '</th>';
           echo '</tr>';
for ($action_get_tarjetas_planes=0; $action_get_tarjetas_planes< $num_get_tarjetas_planes; $action_get_tarjetas_planes++)
    {
      $assoc_get_tarjetas_planes = mysql_fetch_assoc($get_tarjetas_planes);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_pla=$assoc_get_tarjetas_planes['ID_pla'];
                     echo '</th>';
                     echo '<th>';
                      echo $pla_desc=$assoc_get_tarjetas_planes['pla_desc'];
                     echo '</th>';
                     echo '<th>';
                      echo $pla_cant=$assoc_get_tarjetas_planes['pla_cant'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_tar=$assoc_get_tarjetas_planes['ID_tar'];
                     echo '</th>';
                     echo '<th>';
                      echo $plan_tiempoAcre=$assoc_get_tarjetas_planes['plan_tiempoAcre'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_fpo=$assoc_get_tarjetas_planes['ID_fpo'];
                     echo '</th>';
                     echo '<th>';
                      echo $pla_recargo=$assoc_get_tarjetas_planes['pla_recargo'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_tarjetas_planesById')
{
$get_tarjetas_planesById = $tarjetas_planes->get_tarjetas_planesById($ID_pla);
$assoc_get_tarjetas_planesById = mysql_fetch_assoc($get_tarjetas_planesById);
}

if ($action=='insert_tarjetas_planes')
{
$insert_tarjetas_planes = $tarjetas_planes->insert_tarjetas_planes($pla_desc, $pla_cant, $ID_tar, $plan_tiempoAcre, $ID_fpo, $pla_recargo);
}

if ($action=='update_tarjetas_planes')
{
$update_tarjetas_planes = $tarjetas_planes->update_tarjetas_planes($ID_pla, $pla_desc, $pla_cant, $ID_tar, $plan_tiempoAcre, $ID_fpo, $pla_recargo);
}

if ($action=='drop_tarjetas_planes')
{
$drop_tarjetas_planes = $tarjetas_planes->drop_tarjetas_planes($ID_pla);
}


$tesoreria = new tesoreria;

@$ID_tes=$_POST['ID_tes'];
@$tes_debe=$_POST['tes_debe'];
@$tes_haber=$_POST['tes_haber'];

if ($action=='get_tesoreria')
{
  $get_tesoreria = $tesoreria->get_tesoreria();
  $num_get_tesoreria = mysql_num_rows($get_tesoreria);

      $assoc_get_tesoreria = mysql_fetch_assoc($get_tesoreria);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_tes';
                    echo '</th>';
                    echo '<th>';
                      echo 'tes_debe';
                    echo '</th>';
                    echo '<th>';
                      echo 'tes_haber';
                    echo '</th>';
           echo '</tr>';
for ($action_get_tesoreria=0; $action_get_tesoreria< $num_get_tesoreria; $action_get_tesoreria++)
    {
      $assoc_get_tesoreria = mysql_fetch_assoc($get_tesoreria);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_tes=$assoc_get_tesoreria['ID_tes'];
                     echo '</th>';
                     echo '<th>';
                      echo $tes_debe=$assoc_get_tesoreria['tes_debe'];
                     echo '</th>';
                     echo '<th>';
                      echo $tes_haber=$assoc_get_tesoreria['tes_haber'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_tesoreriaById')
{
$get_tesoreriaById = $tesoreria->get_tesoreriaById($ID_tes);
$assoc_get_tesoreriaById = mysql_fetch_assoc($get_tesoreriaById);
}

if ($action=='insert_tesoreria')
{
$insert_tesoreria = $tesoreria->insert_tesoreria($tes_debe, $tes_haber);
}

if ($action=='update_tesoreria')
{
$update_tesoreria = $tesoreria->update_tesoreria($ID_tes, $tes_debe, $tes_haber);
}

if ($action=='drop_tesoreria')
{
$drop_tesoreria = $tesoreria->drop_tesoreria($ID_tes);
}


$tipo_operacion = new tipo_operacion;

@$ID_top=$_POST['ID_top'];
@$top_desc=$_POST['top_desc'];

if ($action=='get_tipo_operacion')
{
  $get_tipo_operacion = $tipo_operacion->get_tipo_operacion();
  $num_get_tipo_operacion = mysql_num_rows($get_tipo_operacion);

      $assoc_get_tipo_operacion = mysql_fetch_assoc($get_tipo_operacion);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_top';
                    echo '</th>';
                    echo '<th>';
                      echo 'top_desc';
                    echo '</th>';
           echo '</tr>';
for ($action_get_tipo_operacion=0; $action_get_tipo_operacion< $num_get_tipo_operacion; $action_get_tipo_operacion++)
    {
      $assoc_get_tipo_operacion = mysql_fetch_assoc($get_tipo_operacion);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_top=$assoc_get_tipo_operacion['ID_top'];
                     echo '</th>';
                     echo '<th>';
                      echo $top_desc=$assoc_get_tipo_operacion['top_desc'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_tipo_operacionById')
{
$get_tipo_operacionById = $tipo_operacion->get_tipo_operacionById($ID_top);
$assoc_get_tipo_operacionById = mysql_fetch_assoc($get_tipo_operacionById);
}

if ($action=='insert_tipo_operacion')
{
$insert_tipo_operacion = $tipo_operacion->insert_tipo_operacion($top_desc);
}

if ($action=='update_tipo_operacion')
{
$update_tipo_operacion = $tipo_operacion->update_tipo_operacion($ID_top, $top_desc);
}

if ($action=='drop_tipo_operacion')
{
$drop_tipo_operacion = $tipo_operacion->drop_tipo_operacion($ID_top);
}


$tipos_pagos = new tipos_pagos;

@$ID_fpo=$_POST['ID_fpo'];
@$ID_desc=$_POST['ID_desc'];
@$fpo_icono=$_POST['fpo_icono'];

if ($action=='get_tipos_pagos')
{
  $get_tipos_pagos = $tipos_pagos->get_tipos_pagos();
  $num_get_tipos_pagos = mysql_num_rows($get_tipos_pagos);

      $assoc_get_tipos_pagos = mysql_fetch_assoc($get_tipos_pagos);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_fpo';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_desc';
                    echo '</th>';
                    echo '<th>';
                      echo 'fpo_icono';
                    echo '</th>';
           echo '</tr>';
for ($action_get_tipos_pagos=0; $action_get_tipos_pagos< $num_get_tipos_pagos; $action_get_tipos_pagos++)
    {
      $assoc_get_tipos_pagos = mysql_fetch_assoc($get_tipos_pagos);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_fpo=$assoc_get_tipos_pagos['ID_fpo'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_desc=$assoc_get_tipos_pagos['ID_desc'];
                     echo '</th>';
                     echo '<th>';
                      echo $fpo_icono=$assoc_get_tipos_pagos['fpo_icono'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_tipos_pagosById')
{
$get_tipos_pagosById = $tipos_pagos->get_tipos_pagosById($ID_fpo);
$assoc_get_tipos_pagosById = mysql_fetch_assoc($get_tipos_pagosById);
}

if ($action=='insert_tipos_pagos')
{
$insert_tipos_pagos = $tipos_pagos->insert_tipos_pagos($ID_desc, $fpo_icono);
}

if ($action=='update_tipos_pagos')
{
$update_tipos_pagos = $tipos_pagos->update_tipos_pagos($ID_fpo, $ID_desc, $fpo_icono);
}

if ($action=='drop_tipos_pagos')
{
$drop_tipos_pagos = $tipos_pagos->drop_tipos_pagos($ID_fpo);
}


$transferencias = new transferencias;

@$ID_tra=$_POST['ID_tra'];
@$tra_fec=$_POST['tra_fec'];
@$ID_banA=$_POST['ID_banA'];
@$ID_banB=$_POST['ID_banB'];
@$ID_odp=$_POST['ID_odp'];
@$tra_num=$_POST['tra_num'];

if ($action=='get_transferencias')
{
  $get_transferencias = $transferencias->get_transferencias();
  $num_get_transferencias = mysql_num_rows($get_transferencias);

      $assoc_get_transferencias = mysql_fetch_assoc($get_transferencias);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_tra';
                    echo '</th>';
                    echo '<th>';
                      echo 'tra_fec';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_banA';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_banB';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_odp';
                    echo '</th>';
                    echo '<th>';
                      echo 'tra_num';
                    echo '</th>';
           echo '</tr>';
for ($action_get_transferencias=0; $action_get_transferencias< $num_get_transferencias; $action_get_transferencias++)
    {
      $assoc_get_transferencias = mysql_fetch_assoc($get_transferencias);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_tra=$assoc_get_transferencias['ID_tra'];
                     echo '</th>';
                     echo '<th>';
                      echo $tra_fec=$assoc_get_transferencias['tra_fec'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_banA=$assoc_get_transferencias['ID_banA'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_banB=$assoc_get_transferencias['ID_banB'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_odp=$assoc_get_transferencias['ID_odp'];
                     echo '</th>';
                     echo '<th>';
                      echo $tra_num=$assoc_get_transferencias['tra_num'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_transferenciasById')
{
$get_transferenciasById = $transferencias->get_transferenciasById($ID_tra);
$assoc_get_transferenciasById = mysql_fetch_assoc($get_transferenciasById);
}

if ($action=='insert_transferencias')
{
$insert_transferencias = $transferencias->insert_transferencias($tra_fec, $ID_banA, $ID_banB, $ID_odp, $tra_num);
}

if ($action=='update_transferencias')
{
$update_transferencias = $transferencias->update_transferencias($ID_tra, $tra_fec, $ID_banA, $ID_banB, $ID_odp, $tra_num);
}

if ($action=='drop_transferencias')
{
$drop_transferencias = $transferencias->drop_transferencias($ID_tra);
}


$usuarios = new usuarios;

@$ID_usu=$_POST['ID_usu'];
@$usu_nombre=$_POST['usu_nombre'];
@$usu_apellido=$_POST['usu_apellido'];
@$usu_usuario=$_POST['usu_usuario'];
@$usu_clave=$_POST['usu_clave'];
@$usu_tipo=$_POST['usu_tipo'];

if ($action=='get_usuarios')
{
  $get_usuarios = $usuarios->get_usuarios();
  $num_get_usuarios = mysql_num_rows($get_usuarios);

      $assoc_get_usuarios = mysql_fetch_assoc($get_usuarios);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_usu';
                    echo '</th>';
                    echo '<th>';
                      echo 'usu_nombre';
                    echo '</th>';
                    echo '<th>';
                      echo 'usu_apellido';
                    echo '</th>';
                    echo '<th>';
                      echo 'usu_usuario';
                    echo '</th>';
                    echo '<th>';
                      echo 'usu_clave';
                    echo '</th>';
                    echo '<th>';
                      echo 'usu_tipo';
                    echo '</th>';
           echo '</tr>';
for ($action_get_usuarios=0; $action_get_usuarios< $num_get_usuarios; $action_get_usuarios++)
    {
      $assoc_get_usuarios = mysql_fetch_assoc($get_usuarios);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_usu=$assoc_get_usuarios['ID_usu'];
                     echo '</th>';
                     echo '<th>';
                      echo $usu_nombre=$assoc_get_usuarios['usu_nombre'];
                     echo '</th>';
                     echo '<th>';
                      echo $usu_apellido=$assoc_get_usuarios['usu_apellido'];
                     echo '</th>';
                     echo '<th>';
                      echo $usu_usuario=$assoc_get_usuarios['usu_usuario'];
                     echo '</th>';
                     echo '<th>';
                      echo $usu_clave=$assoc_get_usuarios['usu_clave'];
                     echo '</th>';
                     echo '<th>';
                      echo $usu_tipo=$assoc_get_usuarios['usu_tipo'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_usuariosById')
{
$get_usuariosById = $usuarios->get_usuariosById($ID_usu);
$assoc_get_usuariosById = mysql_fetch_assoc($get_usuariosById);
}

if ($action=='insert_usuarios')
{
$insert_usuarios = $usuarios->insert_usuarios($usu_nombre, $usu_apellido, $usu_usuario, $usu_clave, $usu_tipo);
}

if ($action=='update_usuarios')
{
$update_usuarios = $usuarios->update_usuarios($ID_usu, $usu_nombre, $usu_apellido, $usu_usuario, $usu_clave, $usu_tipo);
}

if ($action=='drop_usuarios')
{
$drop_usuarios = $usuarios->drop_usuarios($ID_usu);
}


$venta = new venta;

@$ID_ven=$_POST['ID_ven'];
@$ven_total=$_POST['ven_total'];
@$ven_fpo=$_POST['ven_fpo'];
@$ID_caj=$_POST['ID_caj'];

if ($action=='get_venta')
{
  $get_venta = $venta->get_venta();
  $num_get_venta = mysql_num_rows($get_venta);

      $assoc_get_venta = mysql_fetch_assoc($get_venta);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_ven';
                    echo '</th>';
                    echo '<th>';
                      echo 'ven_total';
                    echo '</th>';
                    echo '<th>';
                      echo 'ven_fpo';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_caj';
                    echo '</th>';
           echo '</tr>';
for ($action_get_venta=0; $action_get_venta< $num_get_venta; $action_get_venta++)
    {
      $assoc_get_venta = mysql_fetch_assoc($get_venta);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_ven=$assoc_get_venta['ID_ven'];
                     echo '</th>';
                     echo '<th>';
                      echo $ven_total=$assoc_get_venta['ven_total'];
                     echo '</th>';
                     echo '<th>';
                      echo $ven_fpo=$assoc_get_venta['ven_fpo'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_caj=$assoc_get_venta['ID_caj'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_ventaById')
{
$get_ventaById = $venta->get_ventaById($ID_ven);
$assoc_get_ventaById = mysql_fetch_assoc($get_ventaById);
}

if ($action=='insert_venta')
{
$insert_venta = $venta->insert_venta($ven_total, $ven_fpo, $ID_caj);
}

if ($action=='update_venta')
{
$update_venta = $venta->update_venta($ID_ven, $ven_total, $ven_fpo, $ID_caj);
}

if ($action=='drop_venta')
{
$drop_venta = $venta->drop_venta($ID_ven);
}


$ventas_canceladas = new ventas_canceladas;

@$ID_vcd=$_POST['ID_vcd'];
@$ID_caj=$_POST['ID_caj'];
@$ID_art=$_POST['ID_art'];

if ($action=='get_ventas_canceladas')
{
  $get_ventas_canceladas = $ventas_canceladas->get_ventas_canceladas();
  $num_get_ventas_canceladas = mysql_num_rows($get_ventas_canceladas);

      $assoc_get_ventas_canceladas = mysql_fetch_assoc($get_ventas_canceladas);

       echo '<div class="table-responsive">';
        echo '<table class="table">';
           echo '<tr>';
                    echo '<th>';
                      echo 'ID_vcd';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_caj';
                    echo '</th>';
                    echo '<th>';
                      echo 'ID_art';
                    echo '</th>';
           echo '</tr>';
for ($action_get_ventas_canceladas=0; $action_get_ventas_canceladas< $num_get_ventas_canceladas; $action_get_ventas_canceladas++)
    {
      $assoc_get_ventas_canceladas = mysql_fetch_assoc($get_ventas_canceladas);

           echo '<tr>';
                     echo '<th>';
                      echo $ID_vcd=$assoc_get_ventas_canceladas['ID_vcd'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_caj=$assoc_get_ventas_canceladas['ID_caj'];
                     echo '</th>';
                     echo '<th>';
                      echo $ID_art=$assoc_get_ventas_canceladas['ID_art'];
                     echo '</th>';
           echo '</tr>';
    }
        echo '</table>';
      echo '</div>';
}

if ($action=='$assoc_get_ventas_canceladasById')
{
$get_ventas_canceladasById = $ventas_canceladas->get_ventas_canceladasById($ID_vcd);
$assoc_get_ventas_canceladasById = mysql_fetch_assoc($get_ventas_canceladasById);
}

if ($action=='insert_ventas_canceladas')
{
$insert_ventas_canceladas = $ventas_canceladas->insert_ventas_canceladas($ID_caj, $ID_art);
}

if ($action=='update_ventas_canceladas')
{
$update_ventas_canceladas = $ventas_canceladas->update_ventas_canceladas($ID_vcd, $ID_caj, $ID_art);
}

if ($action=='drop_ventas_canceladas')
{
$drop_ventas_canceladas = $ventas_canceladas->drop_ventas_canceladas($ID_vcd);
}
?>


