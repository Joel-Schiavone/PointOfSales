<?php
  $link = mysql_connect("localhost", "joel", "C0c0dril0");
  if (!$link) {
    die('No se puede conectar a la base de datos: ' . mysql_error());
  }
  mysql_set_charset('utf8',$link);
  mysql_select_db("joel_supermercado",$link); 
$sql_usuarios = 'SELECT * FROM usuarios WHERE usu_usuario="'.$usu_usuario.'" AND usu_clave="'.$usu_clave.'" ' ; 
          $result_usuarios =mysql_query($sql_usuarios);
?>
<?php
  $usu_usuario=$_POST['usuario'];
  $usu_clave=$_POST['clave'];
  $num_get_usuariosByUsuarioClave=mysql_num_rows($result_usuarios);
 ?>
<?php
                      if ($num_get_usuariosByUsuarioClave=='1')
                       {
                          $assoc_get_usuariosByUsuarioClave = mysql_fetch_assoc($result_usuarios);
                          $ID_usu                   = $assoc_get_usuariosByUsuarioClave['ID_usu'];
                          $usu_nombre               = $assoc_get_usuariosByUsuarioClave['usu_nombre'];
                          $usu_apellido             = $assoc_get_usuariosByUsuarioClave['usu_apellido'];
                          $usu_tipo                 = $assoc_get_usuariosByUsuarioClave['usu_tipo'];
                          $_SESSION['ID_usu']       = $ID_usu;
                          $_SESSION['usu_nombre']   = $usu_nombre;
                          $_SESSION['usu_apellido'] = $usu_apellido;
                          $_SESSION['usu_usuario']  = $usu_usuario;
                          $_SESSION['usu_clave']    = $usu_clave;
                          $_SESSION['usu_tipo']     = $usu_tipo;
                          header('Location: inicio.php?M=1');
                      }
                      else
                      {
                       header('Location: index.php?M=2');
                      } 
?>


 