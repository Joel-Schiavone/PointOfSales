    <?php
    include_once('inc/conectar.php');
    include_once('inc/classes.php');
    include_once('inc/classesExclusivas.php');
        $tipo_comprobantes  = new tipo_comprobantes;
        $tipo_comprobantesE = new tipo_comprobantesE;
        $puntos_de_ventasE  = new puntos_de_ventasE;
        $puntos_de_ventas   = new puntos_de_ventas;
        $ID_tce                                = $_POST['ID_tce'];
        $get_tipo_comprobantesById             = $tipo_comprobantes->get_tipo_comprobantesById($ID_tce);
        $assoc_get_tipo_comprobantesById       = mysql_fetch_assoc($get_tipo_comprobantesById);
        $assoc_tce_numeracionAutomatica        = $assoc_get_tipo_comprobantesById['tce_numeracionAutomatica'];
     
          $get_puntos_de_ventasByIdID_tce=$puntos_de_ventasE->get_puntos_de_ventasByIdID_tce($ID_tce);
          $assoc_get_puntos_de_ventasByIdID_tce=mysql_fetch_assoc($get_puntos_de_ventasByIdID_tce);

          $pdv_numeracion=$assoc_get_puntos_de_ventasByIdID_tce['pdv_numeracion'];
          $pdv_puntoVenta=$assoc_get_puntos_de_ventasByIdID_tce['pdv_puntoVenta'];
          $pdv_fecVencimiento=$assoc_get_puntos_de_ventasByIdID_tce['pdv_fecVencimiento'];
          $pdv_cai=$assoc_get_puntos_de_ventasByIdID_tce['pdv_cai'];

          $ID_fce=$assoc_get_tipo_comprobantesById['ID_fce'];
          $tce_movcaja=$assoc_get_tipo_comprobantesById['tce_movcaja'];
          $tce_movstock=$assoc_get_tipo_comprobantesById['tce_movstock'];
          $tce_predecesor=$assoc_get_tipo_comprobantesById['tce_predecesor'];
          $tce_fuerzaPredecesor=$assoc_get_tipo_comprobantesById['tce_fuerzaPredecesor'];
          $tce_numeracionAutomatica=$assoc_get_tipo_comprobantesById['tce_numeracionAutomatica'];
          $tce_detalleArticulos=$assoc_get_tipo_comprobantesById['tce_detalleArticulos'];
          $tce_letra=$assoc_get_tipo_comprobantesById['tce_letra'];
         
          

          $tce_numeracionAutomatica=$pdv_puntoVenta."-".($pdv_numeracion+1)."/".$ID_fce."/".$tce_movcaja."/".$tce_movstock."/".$tce_predecesor."/".$tce_fuerzaPredecesor."/".$tce_numeracionAutomatica."/".$tce_detalleArticulos."/".$tce_letra."/".$pdv_cai."/".$pdv_fecVencimiento;
        
           echo $tce_numeracionAutomatica;
    ?>