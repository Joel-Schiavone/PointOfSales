<?php
include_once('inc/conectar.php');
include_once('inc/classes.php');
include_once('inc/classesExclusivas.php');
$ID_cat= $_POST["elegido"];
$sub_categoriasE = new sub_categoriasE;

        $get_sub_categoriasByIdCat = $sub_categoriasE->get_sub_categoriasByIdCat($ID_cat);
        $num_get_sub_categoriasByIdCat = mysql_num_rows($get_sub_categoriasByIdCat);
            for ($countSubCat=0; $countSubCat < $num_get_sub_categoriasByIdCat; $countSubCat++)
            { 
              $assoc_get_sub_categoriasByIdCat = mysql_fetch_assoc($get_sub_categoriasByIdCat);
               echo "<option value='".$assoc_get_sub_categoriasByIdCat['ID_sub']."'>".$assoc_get_sub_categoriasByIdCat['sub_desc']."</option>";
            }
     ?> 
