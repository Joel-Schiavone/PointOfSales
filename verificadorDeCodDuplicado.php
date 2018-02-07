<?php
include_once('inc/conectar.php');
include_once('inc/classes.php');
include_once('inc/classesExclusivas.php');
      $art_cod=$_POST['CodigoArticulo'];
      $articulosE=new articulosE;
      $get_articulosCodigos=$articulosE->get_articulosCodigos($art_cod);
      $num_get_articulosCodigos=mysql_num_rows($get_articulosCodigos);
       echo $numero= $num_get_articulosCodigos;
?>