<?php
session_start();
//NOTA: Este documento fue apartado de accionesExclusivas.php e incoporpra las clases para aumentar la velocidad de su proceso
include_once('inc/conectar.php');
$ID_usu             = $_SESSION['ID_usu'];
$HoraDeHoy          = date("H:i:s");
$FechayHora         = date("Y-m-d H:i:s");

// ETAPA 1:  RECIBE DATOS Y PREPARA VARIABLES BASICAS

	//Recibe ID de articulo
		$ID_art_ACTUAL 			= $_POST['ID_art'];

	//Recibe ID de cantidad	
  		$mov_cantidad_ACTUAL 	= $_POST['cantidad'];  // CANTIDAD ACTUAL
  		$precio_del_articulo=0;
  	//Trae precio de articulo
		$sql_articulos    		= 'SELECT pre_iva, pre_cant, articulos.ID_pre FROM articulos, precios WHERE  precios.ID_pre=articulos.ID_pre AND ID_art='.$ID_art_ACTUAL.'' ; 
	    $result_articulos 		= mysql_query($sql_articulos);
	    $assoc_result_articulos = mysql_fetch_assoc($result_articulos);
	    $precio_del_articuloA 	= $assoc_result_articulos['pre_cant'];  // PRECIO DEL ARTICULO ACTUAL
	    $ID_pre 			 	= $assoc_result_articulos['ID_pre']; 
	    $pre_iva 				= $assoc_result_articulos['pre_iva']; // IVA DEL ARTICULO ACTUAL
	    $precio_del_articuloB   = ($precio_del_articuloA*$pre_iva)/100;
	    $precio_del_articulo    = $precio_del_articuloA+$precio_del_articuloB;  // PRECIO DEL ARTICULO ACTUAL + IVA DEL ARTICULO ACTUAL
	//Genera Multiplicacion
		
//ETAPA 2: TRAE VENTA A LA QUE PERTENECE EL MOVIMIENTO
		$sql_ventas 			= 'SELECT ID_ven, caja.ID_caj, ven_total, ID_suc, ven_descuento FROM venta, caja where venta.ID_caj=caja.ID_caj AND ID_usu='.$ID_usu.' ORDER BY caja.ID_caj DESC, venta.ID_ven DESC LIMIT 1';
		$result_ventas  		= mysql_query($sql_ventas);
	    $assoc_result_ventas 	= mysql_fetch_assoc($result_ventas);
	    $ID_ven 		 	 	= $assoc_result_ventas['ID_ven'];
	    $ID_caj 		 	 	= $assoc_result_ventas['ID_caj'];
	    $ven_total_ANTERIOR 	= $assoc_result_ventas['ven_total'];
	    $ID_suc 		 	 	= $assoc_result_ventas['ID_suc'];
	    $ven_descuento		 	= $assoc_result_ventas['ven_descuento'];


//ETAPA 3: BUSCA COINCIDENCIA DE ARTICULO EN LOS MOVIMIENTOS

	    //Revisa si exite o no ese articulo en la venta para preparar nuevos totales y cantidades 

	    $sql_movimiento 		= 'SELECT ID_mov, mov_descuento, mov_cantidad, mov_sal FROM mov_caja WHERE ID_art='.$ID_art_ACTUAL.' AND ID_ven='.$ID_ven.'';
	    $result_movimiento  	= mysql_query($sql_movimiento);
	    $assoc_result_movimiento= mysql_fetch_assoc($result_movimiento);
	    $num_result_movimiento  = mysql_num_rows($result_movimiento);
	    $ID_mov 		 	 	= $assoc_result_movimiento['ID_mov'];
	    $mov_descuento 		 	= $assoc_result_movimiento['mov_descuento'];
	    $mov_cantidad_ANTERIOR	= $assoc_result_movimiento['mov_cantidad'];
	    $mov_sal_ANTERIOR		= $assoc_result_movimiento['mov_sal'];
	    $cantidad 				=$mov_cantidad_ANTERIOR+$mov_cantidad_ACTUAL;

	    $Multiplicacion_ACTUAL 	= $precio_del_articulo*$cantidad;
	    // si exite al menos una coincidencia de articulo en los movimientos
	    if ($num_result_movimiento==1) 
	    {
	    	//Si tiene descuento 
	    	if($mov_descuento!=0)
	    	{
	    		//preparo precio para modificar saldo de movimiento

	    			//aplico descuento al total 
	    			$NUEVO_mov_sal=($Multiplicacion_ACTUAL*$mov_descuento)/100;
	    			//$NUEVO_mov_sal=$NUEVO_mov_salB+$total_multiplicacion;
	    			//guarda varibale ConDescuento para etapa de Venta, Indicara si el ultimo importe se agrego con descuento o no
	    			$ConDescuento="si";
	    	}	
	    	//Si no tiene descuento 	
	    	else
	    	{
	    		//preparo precio para modificar saldo de movimiento

	    		//Genero nuevamente la multiplicacion de precio por cantidad del movimiento anterior para quitar descuento
	    		
	    			$NUEVO_mov_sal=$Multiplicacion_ACTUAL;
	    			//guarda varibale ConDescuento para etapa de Venta, Indicara si el ultimo importe se agrego con descuento o no
	    			$ConDescuento="no";
	    	}	

	    	//realiza la modificacion de los valores del movimiento 

	    	$sql_mov_caja_update = 'UPDATE mov_caja SET mov_cantidad = "'.$cantidad.'" , mov_sal = "'.$NUEVO_mov_sal.'" , mov_descuento = "'.$mov_descuento.'" WHERE ID_mov='.$ID_mov.' ';
            $result_mov_caja_update =mysql_query($sql_mov_caja_update );
	 	}
	 	//Si no existe coincidencia Inserta movimiento
	 	else
	 	{	
	 			$ConDescuento="nada";
	 			$NUEVO_mov_sal=$Multiplicacion_ACTUAL;

	 			$sql_mov_caja_insert = 'INSERT INTO mov_caja (ID_ven, mov_hora, ID_art, ID_pre, mov_cantidad, mov_sal, mov_descuento) VALUES ("'.$ID_ven.'", "'.$HoraDeHoy.'", "'.$ID_art_ACTUAL.'", "'.$ID_pre.'", "'.$mov_cantidad_ACTUAL.'", "'.$NUEVO_mov_sal.'", "0")'; 
                $result_sql_mov_caja_insert =mysql_query($sql_mov_caja_insert);
	 	}	

//ETAPA 4: MODIFICA VENTAS TOTALES

	 	//Si el total no tiene descuento 
	 	if($ven_descuento==0)
	 	{
	 		 $sql_mov_cajaFOR = 'SELECT mov_sal FROM mov_caja WHERE ID_ven='.$ID_ven.''; 
			    $get_mov_cajaByIdVen =mysql_query($sql_mov_cajaFOR);
     		 	$num_get_mov_cajaByIdVen = mysql_num_rows($get_mov_cajaByIdVen);
      			$resultadoNuevoVentas=0;

	 		  for ($count=0; $count < $num_get_mov_cajaByIdVen; $count++) 
		      { 
		        $assoc_get_mov_cajaByIdVen = mysql_fetch_assoc($get_mov_cajaByIdVen);
		        $resultadoNuevoVentas=$assoc_get_mov_cajaByIdVen['mov_sal']+$resultadoNuevoVentas;
		      }
	 		
			 	$sql_venta_update = 'UPDATE venta  SET ven_total = "'.$resultadoNuevoVentas.'"  WHERE ID_ven='.$ID_ven.' ';
		        $result_venta_update =mysql_query($sql_venta_update);
	 	}
	 	//Si el total tiene descuento 	
	 	else
	 	{
	 		   $mov_cajaByIdVen = 'SELECT mov_sal FROM mov_caja WHERE ID_ven='.$ID_ven.''; 
			    $get_mov_cajaByIdVen =mysql_query($mov_cajaByIdVen);
		      $num_get_mov_cajaByIdVen = mysql_num_rows($get_mov_cajaByIdVen);
		      $ven_total=0;
		      for ($count=0; $count < $num_get_mov_cajaByIdVen; $count++) 
		      { 
		        $assoc_get_mov_cajaByIdVen = mysql_fetch_assoc($get_mov_cajaByIdVen);
		        $ven_total=$assoc_get_mov_cajaByIdVen['mov_sal']+$ven_total;
		      }

		    $ven_totalB=($ven_total*$ven_descuento)/100;
		    $ven_total=$ven_total-$ven_totalB;
		    $update_ventaByIdDescuento= 'UPDATE venta  SET ven_total = "'.$ven_total.'" , ven_descuento = "'.$ven_descuento.'"  WHERE ID_ven='.$ID_ven.' ';
            $result_update_ventaByIdDescuento =mysql_query($update_ventaByIdDescuento);
	 	}	
     


//ETAPA 5: STOCK
		
		$sto_mov            = 2; // 1=Ingreso de stock / 2=Egreso de stock
	    //$ID_art           = ;
	    $sto_desc           = "" . $_SESSION['usu_nombre'] . " " . $_SESSION['usu_apellido'] . " realizo una venta";
	    $sto_fec            = $FechayHora;
	    //$ID_suc           = ;
	    //$ID_usu           = ;
	    $sto_cant           =$mov_cantidad_ACTUAL;

			//calcula Stock total para guardarlo en la columna sto_total
	      //Para ello trae todos los movimientos de stock por articulo y sucursal dentro de un for suma los sto_mov 1, resta los sto_mov 2 y luego resta los totales.
	    $sql_stock = 'SELECT * FROM stock WHERE ID_art='.$ID_art_ACTUAL.' AND ID_suc='.$ID_suc.' ORDER BY ID_sto DESC LIMIT 1'; 
		$result_stock =mysql_query($sql_stock);
	    $assoc_get_stockByIdArtUltimo  = mysql_fetch_assoc($result_stock);

	    if ($sto_mov==2) 
	    {
	        $sto_total            = $assoc_get_stockByIdArtUltimo['sto_total']-$sto_cant;
	    }
	    else
	    {
	        $sto_total            = $assoc_get_stockByIdArtUltimo['sto_total']+$sto_cant;
	    }  

	   //CAMBIAR EL SIMBOLO SEGUN sto_mov

	   $sql_stockB = 'INSERT INTO stock (sto_mov, ID_art, sto_desc, sto_fec, ID_suc, ID_usu, sto_cant, sto_total) VALUES ("'.$sto_mov.'", "'.$ID_art_ACTUAL.'", "'.$sto_desc.'", "'.$sto_fec.'", "'.$ID_suc.'", "'.$ID_usu.'", "'.$sto_cant.'", "'.$sto_total.'")'; 
        $result_stockB =mysql_query($sql_stockB);

//ETAPA 6: RESPUESTA

       
        	echo "<input hidden type='text' name='respuesta_inseraMovimiento' id='respuesta_inseraMovimiento' value='1'>";
   
        
	