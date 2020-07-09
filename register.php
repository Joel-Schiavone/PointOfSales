<!--Inicio: Documentos requeridos -->
<?php
 @session_start();
  include_once("inc/requerido.php"); 
?>
<!--Fin: Documentos requeridos -->
<!--Inicio: classes -->
<?php
  $usu_usuario=$_POST['usuario'];
  $usu_clave=$_POST['clave'];
  $usuariosE=new usuariosE;
  $get_usuariosByUsuarioClave = $usuariosE->get_usuariosByUsuarioClave($usu_usuario, $usu_clave);
  $num_get_usuariosByUsuarioClave=mysql_num_rows($get_usuariosByUsuarioClave);

                      if ($num_get_usuariosByUsuarioClave=='1')
                       {
                          $assoc_get_usuariosByUsuarioClave = mysql_fetch_assoc($get_usuariosByUsuarioClave);
                          $ID_usu                           = $assoc_get_usuariosByUsuarioClave['ID_usu'];
                          $usu_nombre                       = $assoc_get_usuariosByUsuarioClave['usu_nombre'];
                          $usu_apellido                     = $assoc_get_usuariosByUsuarioClave['usu_apellido'];
                          $usu_tipo                         = $assoc_get_usuariosByUsuarioClave['usu_tipo'];
                          $usu_descuento                    = $assoc_get_usuariosByUsuarioClave['usu_descuento'];
                          $usu_sobrantes                    = $assoc_get_usuariosByUsuarioClave['usu_sobrantes'];
                          $_SESSION['ID_usu']               = $ID_usu;
                          $_SESSION['usu_nombre']           = $usu_nombre;
                          $_SESSION['usu_apellido']         = $usu_apellido;
                          $_SESSION['usu_usuario']          = $usu_usuario;
                          $_SESSION['usu_clave']            = $usu_clave;
                          $_SESSION['usu_tipo']             = $usu_tipo;
                          $_SESSION['usu_descuento']        = $usu_descuento;
                          $_SESSION['usu_sobrantes']        = $usu_sobrantes;
                          echo '<script type="text/javascript">
                                   window.location.assign("inicio.php?M=1");
                               </script>';
                         // header('Location: inicio.php?M=1');
                      }
                      else
                      {
                                            echo '<script type="text/javascript">
                                                     window.location.assign("index.php?M=2");
                                                </script>';
                       //header('Location: index.php?M=2');
                      } 
?>
<?php
  include("modulos/footer.php"); 
?>
<!--Fin: Footer -->

 

 