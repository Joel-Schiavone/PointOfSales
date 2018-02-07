<?php
@session_start();
include_once('inc/conectar.php');
include_once('inc/classes.php');
include_once('inc/classesExclusivas.php');
  $ID_usu               = $_SESSION['ID_usu'];
  $usu_usuario          = $_SESSION['usu_usuario'];
  $usu_clave            = $_SESSION['usu_clave'];
  $usu_tipo             = $_SESSION['usu_tipo'];

  $url_actualA = $_SERVER["REQUEST_URI"];
  $url_actualB = explode("?",$url_actualA);
  $url_actualC = explode("/",$url_actualB[0]);
  $pag_url     = $url_actualC[2];

  $usuariosE   = new usuariosE;
  $paginasE    = new paginasE;
  $get_usuariosByUsuarioClave = $usuariosE->get_usuariosByUsuarioClave($usu_usuario, $usu_clave);
  $num_get_usuariosByUsuarioClave=mysql_num_rows($get_usuariosByUsuarioClave);
  $permisosE   = new permisosE;
  $get_permisosByIdUsu = $permisosE->get_permisosE($ID_usu);
  $num_get_permisosByIdUsu = mysql_num_rows($get_permisosByIdUsu);

  $get_permisosByIdUsuYPagUrl = $permisosE->get_permisosByIdUsuYPagUrl($ID_usu, $pag_url);
  $num_get_permisosByIdUsuYPagUrl=mysql_num_rows($get_permisosByIdUsuYPagUrl);

  $mensajesE  = new mensajesE;
  $sucursales = new sucursales;
  $puestos    = new puestos;
  $puestosE   = new puestosE;
  $get_mensajesNoVistos=$mensajesE->get_mensajesNoVistos();
  $num_get_mensajesNoVistos=mysql_num_rows($get_mensajesNoVistos);


  if ($num_get_usuariosByUsuarioClave!=1 or $num_get_permisosByIdUsuYPagUrl!=1)
                      {
                      // echo '<script type="text/javascript">
                       //window.location.assign("index.php?M=2");
                       //</script>';
                         // header('Location: index.php?M=2');
                      }
 
 ?>
 <!-- Inicio: Estilos Generales-->
  <link href="css/generales.css" rel="stylesheet">
  <style type="text/css">@media (min-width: 767px) {
    .navbar-nav .dropdown-menu .caret {
  transform: rotate(-90deg);
    }
}
</style>
<!-- Fin: Estilos Generales-->

 
  <script>
              $(document).ready(function(){
                $( "#get_sucursalesLi" ).load( "accionesExclusivas.php", {action:"get_sucursalesItem"});
              });
  </script>

      <div class="container-fluid" style="margin-bottom: 80px;">
        <div class="navbar navbar-default navbar-fixed-top" role="navigation" >
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">POINT OF SALES</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                         <li>
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="material-icons">domain</i> POS <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                              <?php 
                                $get_sucursales=$sucursales->get_sucursales();
                                $num_get_sucursales=mysql_num_rows($get_sucursales);
                                  for ($countSucursales=0; $countSucursales < $num_get_sucursales; $countSucursales++) 
                                  { 
                                    $assoc_get_sucursales=mysql_fetch_assoc($get_sucursales);
                                      $ID_suc=$assoc_get_sucursales['ID_suc'];  
                                      $get_puestosById=$puestosE->get_puestosById($ID_suc);
                                      $num_get_puestosById=mysql_num_rows($get_puestosById);
                                      echo '<li>
                                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="material-icons">store</i> '.$assoc_get_sucursales['suc_desc'].'<b class="caret"></b></a>
                                                  <ul class="dropdown-menu">';

                                                    for ($countPuestos=0; $countPuestos < $num_get_puestosById; $countPuestos++) 
                                                    { 

                                                      $assoc_get_puestosById=mysql_fetch_assoc($get_puestosById);

                                                      echo '<li><a href="AperturaCaja.php?PUESTO='.$assoc_get_puestosById['ID_pue'].'"><i class="material-icons">shopping_cart</i> '.$assoc_get_puestosById['pue_desc'].'</a></li>';
                                                    }
                                                       
                                              echo '</ul>
                                                </li>';
                                    }
                                        echo '</ul>
                                          </li>';
                          
                             for ($count_get_permisosByIdUsu=0; $count_get_permisosByIdUsu < $num_get_permisosByIdUsu; $count_get_permisosByIdUsu++)
                                { 
                                 $assoc_get_permisosByIdUsu = mysql_fetch_assoc($get_permisosByIdUsu);
                          

                                  if ($assoc_get_permisosByIdUsu['mod_desc']=="NOTIFICACIONES") 
                                  {
                                    echo '<li class="dropdown">
                                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="material-icons">'.$assoc_get_permisosByIdUsu['mod_icono'].'</i> '.$assoc_get_permisosByIdUsu['mod_desc'].' ('.$num_get_mensajesNoVistos.') <span class="caret"></span></a>';
                                  }
                                  else
                                  {
                                    echo '<li class="dropdown">
                                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="material-icons">'.$assoc_get_permisosByIdUsu['mod_icono'].'</i> '.$assoc_get_permisosByIdUsu['mod_desc'].'  <span class="caret"></span></a>';
                                  }  
                               
                                  $ID_mod=$assoc_get_permisosByIdUsu['ID_mod']; 
                                  $get_paginasByIdMod = $paginasE->get_paginasByIdMod($ID_mod);
                                  $num_get_paginasByIdMod = mysql_num_rows($get_paginasByIdMod);

                                  echo '<ul class="dropdown-menu" role="menu">';

                                  for ($count_get_paginasByIdMod=0; $count_get_paginasByIdMod < $num_get_paginasByIdMod; $count_get_paginasByIdMod++)
                                  { 
                                    
                                    $assoc_get_paginasByIdMod = mysql_fetch_assoc($get_paginasByIdMod);
                                    if($assoc_get_paginasByIdMod['pag_icono']==='0')
                                    { 
                                      
                                    }
                                    else
                                    {
                                      if ($assoc_get_paginasByIdMod['pag_desc']=="MENSAJES") 
                                        {
                                           echo '<li><a href="'.$assoc_get_paginasByIdMod['pag_url'].'"><i class="material-icons">'.$assoc_get_paginasByIdMod['pag_icono'].'</i> '.$assoc_get_paginasByIdMod['pag_desc'].' ('.$num_get_mensajesNoVistos.')</a></li>';
                                         
                                        }
                                        else
                                        {
                                           echo '<li><a href="'.$assoc_get_paginasByIdMod['pag_url'].'"><i class="material-icons">'.$assoc_get_paginasByIdMod['pag_icono'].'</i> '.$assoc_get_paginasByIdMod['pag_desc'].'</a></li>';
                                        }  
                                    }   
                                  }
                                echo '</ul></li>';
                              }
                         ?>
                    
                        <li><a href="logout.php"><i class="material-icons" >power_settings_new</i></a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
 </div>
      

        <script type="text/javascript">
          $(document).ready(function() {
    $('.navbar a.dropdown-toggle').on('click', function(e) {
        var $el = $(this);
        var $parent = $(this).offsetParent(".dropdown-menu");
        $(this).parent("li").toggleClass('open');

        if(!$parent.parent().hasClass('nav')) {
            $el.next().css({"top": $el[0].offsetTop, "left": $parent.outerWidth() - 4});
        }

        $('.nav li.open').not($(this).parents("li")).removeClass("open");

        return false;
    });
});

        </script>