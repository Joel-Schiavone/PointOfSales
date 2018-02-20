<?php


	class especiales
	{
		function generateRandomString($length = 10)
		{ 
		   return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
		} 

	}

    class chequesE
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_chequesE()
                        {
                              $sql_cheques = 'SELECT * FROM cheques, bancos WHERE cheques.ID_ban=bancos.ID_ban';
                              $result_cheques =mysql_query($sql_cheques);
                              return $result_cheques;
                        }
                         //Fin: Llama a todas las columnas de la tabla

                          //Inicio: Llama a todas las columnas de la tabla
                        function get_chequesELibrador()
                        {
                              $sql_cheques = 'SELECT DISTINCT che_librador FROM cheques';
                              $result_cheques =mysql_query($sql_cheques);
                              return $result_cheques;
                        }
                         //Fin: Llama a todas las columnas de la tabla

                         //Inicio: Llama a todas las columnas de la tabla filtradas
                        function get_chequesFiltrosE($fecDesde, $fecHasta, $ID_ban, $che_librador, $che_tipo, $ID_che)
                        {	
                        	if ($ID_che!='0') 
                        	{
                        		 $sql_cheques = 'SELECT * FROM cheques, bancos WHERE cheques.ID_ban=bancos.ID_ban '.$ID_che.'';
                        	}
                        	else
                        	{
                        		 $sql_cheques = 'SELECT * FROM cheques, bancos WHERE cheques.ID_ban=bancos.ID_ban AND che_fecha BETWEEN "'.$fecDesde.'" AND "'.$fecHasta.'" '.$ID_ban.' '.$che_librador.' '.$che_tipo.' ORDER BY che_fecha DESC';
                        	}	
                              
                              $result_cheques =mysql_query($sql_cheques);
                              return $result_cheques;
                        }
                         //Fin: Llama a todas las columnas de la tabla filtradas

                     
                       
          		
                        
	}

	  class comprobante_numeracionE
    {
    	 function get_comprobante_numeracionById($ID_tce)
                        {
                              $sql_comprobante_numeracion = 'SELECT * FROM comprobante_numeracion WHERE ID_tce='.$ID_tce.''; 
                              $result_comprobante_numeracion =mysql_query($sql_comprobante_numeracion);
                              return $result_comprobante_numeracion;
                        }
    }
    class cuentas_movimientosE
    {	
    					  function get_cuentas_movimientosByFecha($fecDesde, $fecHasta)
                        {
                              $sql_cuentas_movimientos = 'SELECT * from cuentas_movimientos, cuentas where cuentas_movimientos.ID_cue=cuentas.ID_cue AND mcd_fec BETWEEN "'.$fecDesde.'" AND "'.$fecHasta.'" order by mcd_fec DESC'; 
                              $result_cuentas_movimientos =mysql_query($sql_cuentas_movimientos);
                              return $result_cuentas_movimientos;
                        }

                        function get_cuentas_movimientosByIdCueByFecha($ID_cue, $fecDesde, $fecHasta)
                        {
                              $sql_cuentas_movimientos = 'SELECT * from cuentas_movimientos, cuentas where cuentas_movimientos.ID_cue=cuentas.ID_cue AND cuentas_movimientos.ID_cue='.$ID_cue.' AND mcd_fec BETWEEN "'.$fecDesde.'" AND "'.$fecHasta.'" order by mcd_fec DESC' ; 
                              $result_cuentas_movimientos =mysql_query($sql_cuentas_movimientos);
                              return $result_cuentas_movimientos;
                        }

                          function traeSaldo($ID_cue)
                        {
                              $sql_cuentas_movimientos = 'SELECT (SUM(mcs_credito)-SUM(mcs_debito)) AS saldo FROM cuentas_movimientos  WHERE ID_cue='.$ID_cue.' ' ; 
                              $result_cuentas_movimientos =mysql_query($sql_cuentas_movimientos);
                              return $result_cuentas_movimientos;
                        }

                          function traeSaldoPorMovimiento($ID_cue)
                        {
                              $sql_cuentas_movimientos = 'SELECT (SUM(mcs_credito)-SUM(mcs_debito)) AS saldoActual FROM cuentas_movimientos  WHERE ID_cue='.$ID_cue.' ' ; 
                              $result_cuentas_movimientos =mysql_query($sql_cuentas_movimientos);
                              return $result_cuentas_movimientos;
                        }
	}

	  class puestosE
    {

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_puestos()
                        {
                              $sql_puestos = 'SELECT * FROM puestos, sucursales, puntos_de_ventas, cuentas WHERE puestos.ID_suc=sucursales.ID_suc AND puestos.ID_pdv=puntos_de_ventas.ID_pdv AND puestos.ID_cue=cuentas.ID_cue';
                              $result_puestos =mysql_query($sql_puestos);
                              return $result_puestos;
                        }
                         //Fin: Llama a todas las columnas de la tabla


                          //Inicio: Llama a todas las columnas de la tabla
                        function get_puestosByIdB($ID_pue)
                        {
                              $sql_puestos = 'SELECT * FROM puestos, sucursales, puntos_de_ventas, cuentas WHERE puestos.ID_suc=sucursales.ID_suc AND puestos.ID_pdv=puntos_de_ventas.ID_pdv AND puestos.ID_cue=cuentas.ID_cue AND cuentas.ID_ctp=3 AND ID_pue='.$ID_pue.'';
                              $result_puestos =mysql_query($sql_puestos);
                              return $result_puestos;
                        }
                         //Fin: Llama a todas las columnas de la tabla


                        function get_puestosById($ID_suc)
                        {
                              $sql_puestos = 'SELECT * FROM puestos  WHERE ID_suc='.$ID_suc.' ' ; 
                              $result_puestos =mysql_query($sql_puestos);
                              return $result_puestos;
                        }


    }                   
	class cuentas_impuestosE
	{
		 				function get_cuentas_impuestosById($ID_cue)
                        {
                              $sql_cuentas_impuestos = 'SELECT * FROM cuentas_impuestos WHERE ID_cue='.$ID_cue.' ' ; 
                              $result_cuentas_impuestos =mysql_query($sql_cuentas_impuestos);
                              return $result_cuentas_impuestos;
                        }
	}

	class cuentasE
	{
          //Inicio: Llama a todas las columnas de la tabla
                        function get_cuentas()
                        {
                              $sql_cuentas = 'SELECT * FROM cuentas, cuentas_tipo WHERE cuentas.ID_ctp=cuentas_tipo.ID_ctp';
                              $result_cuentas =mysql_query($sql_cuentas);
                              return $result_cuentas;
                        }
           //Fin: Llama a todas las columnas de la tabla


                        //Inicio: Llama a todas las columnas de la tabla
                        function get_cuentasById($ID_cue)
                        {
                              $sql_cuentas = 'SELECT * FROM cuentas, cuentas_tipo WHERE cuentas.ID_ctp=cuentas_tipo.ID_ctp AND ID_cue='.$ID_cue.'';
                              $result_cuentas =mysql_query($sql_cuentas);
                              return $result_cuentas;
                        }
           //Fin: Llama a todas las columnas de la tabla
   }                        
    class mensajesE
    {
    		 //Inicio Funciones para Mostrar Datos por ID

                        function get_mensajesById($ID_men)
                        {
                              $sql_mensajes = 'SELECT * FROM mensajes, articulos, precios WHERE mensajes.men_id_rel=articulos.ID_art AND precios.ID_pre=articulos.ID_pre AND ID_men='.$ID_men.''; 
                              $result_mensajes =mysql_query($sql_mensajes);
                              return $result_mensajes;
                        }
          //Fin Funciones para Mostrar Datos por ID

                        	  //Inicio Funcion Modifica todos los datos por ID
                        function update_mensajesTipoById($ID_men, $men_categoria)

                        {
                              $sql_mensajes = 'UPDATE mensajes  SET men_categoria = "'.$men_categoria.'"  WHERE ID_men='.$ID_men.' ';
                              $result_mensajes =mysql_query($sql_mensajes );
                              return $result_mensajes;
                        }
          //Fin Funcion Modifica todos los datos por ID


    	   //Inicio Funcion Modifica todos los datos por ID
                        function update_mensajesVistoById($ID_men, $men_visto)

                        {
                              $sql_mensajes = 'UPDATE mensajes  SET men_visto = "'.$men_visto.'"  WHERE ID_men='.$ID_men.' ';
                              $result_mensajes =mysql_query($sql_mensajes );
                              return $result_mensajes;
                        }
          //Fin Funcion Modifica todos los datos por ID

    	    //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_mensajes()
                        {
                              $sql_mensajes = 'SELECT * FROM mensajes WHERE men_categoria!=11 ORDER BY men_visto, men_fec DESC';
                              $result_mensajes =mysql_query($sql_mensajes);
                              return $result_mensajes;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_mensajesNoVistos()
                        {
                              $sql_mensajes = 'SELECT * FROM mensajes WHERE men_visto=0';
                              $result_mensajes =mysql_query($sql_mensajes);
                              return $result_mensajes;
                        }
                         //Fin: Llama a todas las columnas de la tabla
     }                    
	class sucursalesE
	{
	 		//Inicio Trae todos los datos
			  function get_sucursales()
				 {
				     $sql_sucursales = 'SELECT * FROM sucursales WHERE suc_desc!="Masterdata" AND suc_desc!="Administración"';
				      $result_sucursales =mysql_query($sql_sucursales);
				      return $result_sucursales;
				  }
		    //Fin Trae todos los datos
				  
	}

		class adjuntosE
	{
	 		//Inicio Trae todos los datos
			  function get_adjuntosBYId_Rel($adj_ID_rel, $adj_tablaRel)
				 {
				     $sql_adjuntos = 'SELECT * FROM adjuntos WHERE adj_ID_rel="'.$adj_ID_rel.'" AND adj_tablaRel="'.$adj_tablaRel.'"';
				      $result_adjuntos =mysql_query($sql_adjuntos);
				      return $result_adjuntos;
				  }
		    //Fin Trae todos los datos

			

				  
	}

  //Inicio Trae todos los usuarios por usuario y clave
	class usuariosE
	{

		//Inicio Trae todos los datos
		    function get_usuarios()
		    {
		      $sql_usuarios = 'SELECT * FROM usuarios ORDER BY usu_apellido ASC';
		      $result_usuarios =mysql_query($sql_usuarios);
		      return $result_usuarios;
		    }
		  //Fin Trae todos los datos


		     function get_clavesAdmin($usu_clave)
		    {
		      $sql_usuarios = 'SELECT * FROM usuarios where usu_clave="'.$usu_clave.'" AND usu_descuento=1';
		      $result_usuarios =mysql_query($sql_usuarios);
		      return $result_usuarios;
		    }

		function get_usuariosByUsuarioClave($usu_usuario, $usu_clave)
		{
			$sql_usuarios = 'SELECT * FROM usuarios WHERE usu_usuario="'.$usu_usuario.'" AND usu_clave="'.$usu_clave.'"'; 
		      $result_usuarios =mysql_query($sql_usuarios);
		       return $result_usuarios;
		}

		function  get_usuariosUsuarios($clientes)
		{
			if ($clientes=="Todos") 
			{
				$sql_usuarios = 'SELECT * FROM usuarios';
			}
			else
			{
				$sql_usuarios = 'SELECT * FROM usuarios WHERE usuarios.usu_nombre LIKE "%'.$clientes.'%" OR usuarios.usu_apellido LIKE "%'.$clientes.'%"';
			}	
			
		      $result_usuarios =mysql_query($sql_usuarios);
		       return $result_usuarios;
		}

		function  get_usuariosUsuariosYclientes($clientes)
		{
			if ($clientes=="Todos") 
			{
				$sql_usuarios = 'SELECT * FROM usuarios, clientes';
			}
			else
			{
				$sql_usuarios = 'SELECT * FROM usuarios, clientes WHERE usuarios.usu_nombre LIKE "%'.$clientes.'%" OR usuarios.usu_apellido LIKE "%'.$clientes.'%" or clientes.cli_nombre LIKE "%'.$clientes.'%" OR clientes.cli_apellido LIKE "%'.$clientes.'%"';
			}	
			
		      $result_usuarios =mysql_query($sql_usuarios);
		       return $result_usuarios;
		}

		function  get_usuariosClientes($clientes)
		{
			if ($clientes=="Todos") 
			{
				$sql_usuarios = 'SELECT * FROM clientes';
			}
			else
			{
				$sql_usuarios = 'SELECT * FROM clientes WHERE clientes.cli_nombre LIKE "%'.$clientes.'%" OR clientes.cli_apellido LIKE "%'.$clientes.'%"';
			}	
			
		      $result_usuarios =mysql_query($sql_usuarios);
		       return $result_usuarios;
		}
			function  get_usuariosUsuariosUltimo()
		{
			$sql_usuarios = 'SELECT * FROM usuarios ORDER BY ID_usu DESC LIMIT 1';
		      $result_usuarios =mysql_query($sql_usuarios);
		       return $result_usuarios;
		}

	}
	//fin Trae todos los usuarios por usuario y clave


	//Inicio stock 
	class stockE
	{


		 //Inicio Trae stock por ID_sub
		function get_stockByIdSub($ID_sub)
		{
			  $sql="SELECT articulos.art_desc, articulos.art_cod, articulos.ID_art FROM articulos, categorias, sub_categorias WHERE articulos.ID_sub=sub_categorias.ID_sub AND sub_categorias.ID_cat=categorias.ID_cat AND articulos.ID_sub=".$ID_sub."";
		   $result_stock =mysql_query($sql);
		      return $result_stock;

		}
		 //Fin  Trae stock por ID_sub

		 //Inicio Trae stock por ID_sub
		function get_stock()
		{
			 $sql="SELECT articulos.art_desc, articulos.art_cod, articulos.ID_art FROM articulos";
			  $result_stock =mysql_query($sql);
		      return $result_stock;
		}
		 //Fin  Trae stock por ID_sub


		 //Inicio Trae ultimo articulo
		function get_stockByIdArtUltimo($ID_art, $ID_suc)
		{
			  $sql_stock = 'SELECT * FROM stock WHERE ID_art='.$ID_art.' AND ID_suc='.$ID_suc.' ORDER BY ID_sto DESC LIMIT 1'; 
		      $result_stock =mysql_query($sql_stock);
		      return $result_stock;

		      //Se utiliza en: accionesExclusivas.php->drop_movimiento 
		}
		 //Fin Trae ultimo articulo

			 //Inicio Trae ultimo articulo
		function get_stockBySoloIdArtUltimo($ID_art)
		{
			
				      $sql_sucursales = 'SELECT * FROM sucursales';
				      $result_sucursales =mysql_query($sql_sucursales);
				      $num_result_sucursales=mysql_num_rows($result_sucursales);
				      $stockTotal=0;
				      for ($countSucursales=0; $countSucursales < $num_result_sucursales; $countSucursales++) 
				      { 
				      	 $assoc_result_sucursales=mysql_fetch_assoc($result_sucursales);
				      	 $ID_suc=$assoc_result_sucursales['ID_suc'];

				      	$sql_stock = 'SELECT ID_sto, sto_total FROM stock WHERE ID_art='.$ID_art.' AND ID_suc='.$ID_suc.' ORDER BY ID_sto DESC LIMIT 1'; 
				        $result_stock =mysql_query($sql_stock);
				        $assoc_result_stock=mysql_fetch_assoc($result_stock);
				        
				        $stockTotal=$stockTotal+$assoc_result_stock['sto_total'];

				      }

					 
				      return $stockTotal;

		}
		 //Fin Trae ultimo articulo

		//Inicio Trae el stock por fecha
		function get_stockByFecBetween($fechaDesde, $fechaHasta)
		{
			  $sql_stock = 'SELECT * FROM stock, usuarios, articulos, sucursales WHERE 
			  stock.ID_usu=usuarios.ID_usu AND
			  stock.ID_art=articulos.ID_art AND
			  stock.ID_suc=sucursales.ID_suc AND
			  (stock.sto_fec BETWEEN "'.$fechaDesde.'" AND "'.$fechaHasta.'") 
			  ORDER BY stock.ID_sto DESC';
		      $result_stock =mysql_query($sql_stock);
		      return $result_stock;
		      //Se utiliza en: accionesExclusivas.php->tablaDeSucursales
		}
		//Fin el stock por fecha

		 //Trae el stock por fecha y por Sucursal
		function get_stockByFecBetweenYId($fechaDesde, $fechaHasta, $ID_suc)
		{
			  $sql_stock = 'SELECT * FROM stock, usuarios, articulos, sucursales WHERE 
			  stock.ID_usu=usuarios.ID_usu AND
			  stock.ID_art=articulos.ID_art AND
			  stock.ID_suc=sucursales.ID_suc AND
			  stock.ID_suc="'.$ID_suc.'" AND
			  (stock.sto_fec BETWEEN "'.$fechaDesde.'" AND "'.$fechaHasta.'") 
			  ORDER BY stock.ID_sto DESC';
		      $result_stock =mysql_query($sql_stock);
		      return $result_stock;                                                                                                                                                                                                                                              

		      //Se utiliza en: accionesExclusivas.php->tablaDeSucursales
		}
		 //Fin el stock por fecha y por Sucursal

		//Trae los ultimos 10 movimientos de stock por sucrusal 
		function get_stockByIdSucUltimos10($ID_suc)
		{
			  $sql_stock = 'SELECT * FROM stock, usuarios, articulos, sucursales WHERE 
			  stock.ID_usu=usuarios.ID_usu AND
			  stock.ID_art=articulos.ID_art AND
			  stock.ID_suc=sucursales.ID_suc 
			  ORDER BY stock.ID_sto DESC LIMIT 0,5';
		      $result_stock =mysql_query($sql_stock);
		      return $result_stock;

		      //Se utiliza en: accionesExclusivas.php->cargarArticulo
		}



	}
	//fin stock 

	  //Inicio Trae todos los permisos por ID de usuario
	class permisosE
	{
		function get_permisosE($ID_usu)
		{
			$sql_permisos = 'SELECT * FROM permisos, modulos WHERE permisos.ID_mod=modulos.ID_mod AND ID_usu="'.$ID_usu.'" ' ; 
		      $result_permisos =mysql_query($sql_permisos);
		       return $result_permisos;
		}

				function get_permisosByIdUsuYPagUrl($ID_usu, $pag_url)
		{
			$sql_permisos = 'SELECT * FROM paginas, permisos WHERE paginas.ID_mod=permisos.ID_mod AND paginas.pag_url="'.$pag_url.'" AND ID_usu="'.$ID_usu.'"' ; 
		      $result_permisos =mysql_query($sql_permisos);
		       return $result_permisos;
		}


	}
	//fin Trae todos los usuarios por usuario y clave

	 //Inicio Trae todos los permisos por ID de usuario
	class paginasE
	{
		function get_paginasByIdMod($ID_mod)
		{
			$sql_paginas = 'SELECT * FROM paginas WHERE ID_mod="'.$ID_mod.'"' ; 
		      $result_paginas =mysql_query($sql_paginas);
		       return $result_paginas;
		}
	}
	//fin Trae todos los usuarios por usuario y clave
	
	//Inicio Trae la ultima caja por usuario
	class cajaE
	{

		function update_cajaControl($ID_caj, $ID_control)
				 {
				   $sql_caja = 'UPDATE caja SET ID_control = "'.$ID_control.'"  WHERE ID_caj="'.$ID_caj.'"';
		 			 $result_sql_caja =mysql_query($sql_caja);
		       			return $result_sql_caja;
				  }



		function get_caja_totalEfectivo($ID_caj)
				 {
				     $sql_totales = 'SELECT ((cja_vef+caj_inicio)-caj_cierre) AS TotalEfectivo FROM caja where ID_caj='.$ID_caj.'';
				     $result_sql_totales =mysql_query($sql_totales);
				      return $result_sql_totales;
				  }

		 function get_caja_abiertasTotales()
				 {
				     $sql_totales = 'SELECT SUM(cja_vtad) AS debito, SUM(cja_vta) AS credito, SUM(cja_vct) AS corriente, SUM(cja_vef) AS efectivo, SUM(caj_vne) AS neto FROM caja WHERE caj_horac="00:00:00"';
				     $result_sql_totales =mysql_query($sql_totales);
				      return $result_sql_totales;
				  }

	 		//Inicio Trae todos los datos
			  function get_caja_abiertaTotal($ID_suc)
				 {
				     $sql_sucursales = 'SELECT sucursales.ID_suc, SUM(caj_vne) AS caj_vne, SUM(caj_cierre) AS caj_cierre, SUM(caj_inicio) AS caj_inicio, SUM(cja_vef) AS cja_vef, SUM(cja_vct) AS cja_vct, SUM(cja_vtad) AS cja_vtad, SUM(cja_vta) AS cja_vta, usuarios.usu_nombre, usuarios.usu_apellido FROM sucursales, caja, usuarios WHERE usuarios.ID_usu=caja.ID_usu AND sucursales.ID_suc=caja.ID_suc AND suc_desc!="Masterdata" AND suc_desc!="Administración" AND sucursales.ID_suc="'.$ID_suc.'" GROUP BY caja.ID_suc';
				      $result_sucursales =mysql_query($sql_sucursales);
				      return $result_sucursales;
				  }
		    //Fin Trae todos los datos

		function get_caja_UltimaByUsu($ID_usu)
		{
			$sql_caja = 'SELECT * FROM caja WHERE ID_usu="'.$ID_usu.'" ORDER BY ID_caj DESC LIMIT 1' ; 
		      $result_caja =mysql_query($sql_caja);
		       return $result_caja;
		}

		function get_caja_abiertaPorSuc($ID_suc)
		{
			$sql_caja = 'SELECT * FROM caja, usuarios WHERE caja.ID_usu=usuarios.ID_usu AND ID_suc="'.$ID_suc.'" AND caj_horac="00:00:00"' ; 
		      $result_caja =mysql_query($sql_caja);
		       return $result_caja;
		}

		function update_caja($ID_caj, $cja_vef, $caj_vne)
		{
			$sql_caja = 'UPDATE caja SET cja_vef = "'.$cja_vef.'" , caj_vne = "'.$caj_vne.'"  WHERE ID_caj="'.$ID_caj.'" ';
		  $result_sql_caja =mysql_query($sql_caja);
		       return $result_sql_caja;
		}    
		function update_cajact($ID_caj, $cja_vct, $caj_vne)
		{
			$sql_caja = 'UPDATE caja SET cja_vct = "'.$cja_vct.'" , caj_vne = "'.$caj_vne.'"  WHERE ID_caj="'.$ID_caj.'" ';
		  $result_sql_caja =mysql_query($sql_caja);
		       return $result_sql_caja;
		}     

		function update_cajaCtMixto($ID_caj, $cja_vef, $cja_vct, $caj_vne)
		{
			$sql_caja = 'UPDATE caja SET cja_vef = "'.$cja_vef.'" , 
			cja_vct = "'.$cja_vct.'" , 
			caj_vne = "'.$caj_vne.'"
			  WHERE ID_caj="'.$ID_caj.'" ';
		  $result_sql_caja =mysql_query($sql_caja);
		       return $result_sql_caja;
		}    

		function update_cajaTarjeta($ID_caj, $cja_vta, $caj_vne, $cja_vef)
		{
			$sql_caja = 'UPDATE caja SET cja_vta = "'.$cja_vta.'" , cja_vef = "'.$cja_vef.'" , caj_vne = "'.$caj_vne.'"  WHERE ID_caj="'.$ID_caj.'"';
		  $result_sql_caja =mysql_query($sql_caja);
		       return $result_sql_caja;
		}     

		function update_cajaTarjetaDebito($ID_caj, $cja_vtad, $caj_vne, $cja_vef)

		{
			$sql_caja = 'UPDATE caja SET cja_vtad = "'.$cja_vtad.'" , cja_vef = "'.$cja_vef.'" , caj_vne = "'.$caj_vne.'"  WHERE ID_caj="'.$ID_caj.'" ';
		  $result_sql_caja =mysql_query($sql_caja);
		       return $result_sql_caja;
		}     
		function update_cajaCierre($ID_caj, $caj_cierre, $caj_efectivoReal)
		{
			$caj_horac=date("H:i:s");
			$sql_caja = 'UPDATE caja SET caj_cierre = "'.$caj_cierre.'" ,
			caj_efectivoReal = "'.$caj_efectivoReal.'" ,
			 caj_horac = "'.$caj_horac.'" 
			  WHERE ID_caj="'.$ID_caj.'" ';
		  $result_sql_caja =mysql_query($sql_caja);
		       return $result_sql_caja;
		}    
		 

	}
	//fin Trae la ultima caja por usuario

	class preciosE
	{
		//Inicio Funciones para Modificar datos

		  //Inicio Funcion Modifica todos los datos por ID
		  function update_preciosById($ID_pre, $pre_cant, $pre_iva, $pre_neto, $pre_fec, $pre_porcan)
		    {

		      $sql_precios = 'UPDATE precios SET pre_cant = "'.$pre_cant.'" , pre_porcan = "'.$pre_porcan.'" ,  pre_poresp = "0" , pre_iva = "'.$pre_iva.'" , pre_neto = "'.$pre_neto.'" , pre_fec = "'.$pre_fec.'" WHERE ID_pre='.$ID_pre.' ';
		      $result_precios =mysql_query($sql_precios );
		      return $result_precios;
		    }
		  //Fin Funcion Modifica todos los datos por ID

		//Fin Funciones para Modificar datos

		     //Inicio Trae todos los datos
		    function get_preciosUltimo()
		    {
		      $sql_precios = 'SELECT * FROM precios ORDER BY ID_pre DESC LIMIT 1';
		      $result_precios =mysql_query($sql_precios);
		      return $result_precios;
		    }
		  //Fin Trae todos los datos

		      //Inicio Trae precio por articulo
		    function get_preciosYarticulosByID_ven($ID_ven)
		    {
		      $sql_precios = 'SELECT * FROM precios, articulos, venta, mov_caja where articulos.ID_pre=precios.ID_pre  AND ID_art='.$ID_art.'';
		      $result_precios =mysql_query($sql_precios);
		      return $result_precios;
		    }
		  //Fin Trae precio por articulo

		       //Inicio Trae precio por articulo
		    function get_preciosYarticulosByID_art($ID_art)
		    {
		      $sql_precios = 'SELECT * FROM precios, articulos where articulos.ID_pre=precios.ID_pre  AND ID_art='.$ID_art.'';
		      $result_precios =mysql_query($sql_precios);
		      return $result_precios;
		    }
		  //Fin Trae precio por articulo

	}

	//Inicio Tarer los articulos, categorias, sub_categorias y precio por ID del articulo 
	class articulosE
	{ 
		 function transfiereArticulos($ID_art, $ID_sub)	
		 {
		 	 $sql_articulos = 'UPDATE articulos  SET ID_sub = "'.$ID_sub.'"  WHERE ID_art='.$ID_art.' ';
                              $result_articulos =mysql_query($sql_articulos );
                              return $result_articulos;

		 }

		 function get_articulosTodos()
		 {
	      $sql_articulos = 'SELECT * FROM articulos, categorias, sub_categorias, precios WHERE articulos.ID_sub=sub_categorias.ID_sub AND sub_categorias.ID_cat=categorias.ID_cat AND precios.ID_pre=articulos.ID_pre' ; 
	       $result_articulos =mysql_query($sql_articulos);
	      return $result_articulos;
	    }

	    function get_articulosTodosConProveedores()
		 {
	      $sql_articulos = 'SELECT articulos.ID_art, articulos.art_cod, articulos.art_desc, categorias.cat_desc, sub_categorias.sub_desc, precios.pre_cant, proveedores.pro_desc, precios.pre_iva, articulos.art_unidad FROM articulos, categorias, sub_categorias, precios, proveedores WHERE articulos.ID_sub=sub_categorias.ID_sub AND sub_categorias.ID_cat=categorias.ID_cat AND precios.ID_pre=articulos.ID_pre AND articulos.ID_pro=proveedores.ID_pro ORDER BY articulos.ID_art DESC LIMIT 0, 10' ; 
	       $result_articulos =mysql_query($sql_articulos);
	      return $result_articulos;
	    }

	       function get_articulosTodosConProveedoresByIDArt($ID_art)
		 {
	      $sql_articulos = 'SELECT articulos.ID_art, articulos.art_cod, articulos.art_desc, categorias.cat_desc, sub_categorias.sub_desc, precios.pre_cant, proveedores.pro_desc, precios.pre_iva, articulos.art_unidad FROM articulos, categorias, sub_categorias, precios, proveedores WHERE articulos.ID_sub=sub_categorias.ID_sub AND sub_categorias.ID_cat=categorias.ID_cat AND precios.ID_pre=articulos.ID_pre AND articulos.ID_pro=proveedores.ID_pro AND ID_art='.$ID_art.' ORDER BY articulos.ID_art DESC' ; 
	       $result_articulos =mysql_query($sql_articulos);
	      return $result_articulos;
	    }


		 function get_articulosCodigos($art_cod)
		 {
	      $sql_articulos = 'SELECT ID_art, art_cod FROM articulos where art_cod="'.$art_cod.'"' ; 
	       $result_articulos =mysql_query($sql_articulos);
	      return $result_articulos;
	    }

	     function get_articulosByIdSub($ID_sub)
		 {
	      $sql_articulos = 'SELECT * FROM articulos where ID_sub="'.$ID_sub.'"' ; 
	       $result_articulos =mysql_query($sql_articulos);
	      return $result_articulos;
	    }

	    function get_articulosById($ID_art)
	    {
	      $sql_articulos = 'SELECT * FROM articulos, categorias, sub_categorias, precios WHERE articulos.ID_sub=sub_categorias.ID_sub AND sub_categorias.ID_cat=categorias.ID_cat AND precios.ID_pre=articulos.ID_pre AND articulos.ID_art='.$ID_art.''; 
	     $result_articulos= mysql_query($sql_articulos);
	      return $result_articulos;
	    }

	        function get_articulosByartCod($art_cod)
	    {
	      $sql_articulos = 'SELECT * FROM articulos, categorias, sub_categorias, precios WHERE articulos.ID_sub=sub_categorias.ID_sub AND sub_categorias.ID_cat=categorias.ID_cat AND precios.ID_pre=articulos.ID_pre AND articulos.art_cod="'.$art_cod.'"'; 
	     $result_articulos= mysql_query($sql_articulos);
	      return $result_articulos;
	    }
	     //Inicio Trae todos los datos
	    function get_articulos($search)
	    {
	      	$query_articulos = "SELECT * FROM articulos, sub_categorias, categorias, precios, proveedores WHERE  articulos.ID_sub=sub_categorias.ID_sub AND sub_categorias.ID_cat=categorias.ID_cat AND precios.ID_pre=articulos.ID_pre AND proveedores.ID_pro=articulos.ID_pro AND (articulos.art_desc like '%".$search."%' OR sub_categorias.sub_desc like '%".$search."%' OR categorias.cat_desc like '%".$search."%' OR articulos.art_cod='".$search."')  ORDER BY art_desc ASC";

	      $result_articulos =mysql_query($query_articulos);
	      return $result_articulos;
	    }
	  //Fin Trae todos los datos

	   function get_articulosByArray($array)
	   {
	   		$CountArray = count($array);
	   		$formula2="";
	   		for ($i=0; $i < $CountArray; $i++) 
	   		{ 
	   			$formula=$array[$i];
	   			$formula2=$formula." ".$formula2;
	   		}

	      	$query_articulos = "SELECT * FROM articulos, sub_categorias, categorias, precios, proveedores WHERE  articulos.ID_sub=sub_categorias.ID_sub AND sub_categorias.ID_cat=categorias.ID_cat AND precios.ID_pre=articulos.ID_pre AND proveedores.ID_pro=articulos.ID_pro AND MATCH (articulos.art_desc) AGAINST ('".$formula2."') ";

	      $result_articulos =mysql_query($query_articulos);
	      return $result_articulos;
	    }

		//Inicio Funciones para Modificar datos

		  //Inicio Funcion Modifica todos los datos por ID
		  function update_articulosById($ID_art, $ID_sub, $ID_pre, $ID_pro, $art_desc, $art_cod, $art_unidad)
		    {
		      $sql_articulos = 'UPDATE articulos SET ID_sub = "'.$ID_sub.'" , ID_pre = "'.$ID_pre.'" , ID_pro = "'.$ID_pro.'" , art_desc = "'.$art_desc.'" , art_cod = "'.$art_cod.'" , art_unidad = "'.$art_unidad.'" WHERE ID_art='.$ID_art.' ';
		      $result_articulos =mysql_query($sql_articulos );
		      return $result_articulos;
		    }
		  //Fin Funcion Modifica todos los datos por ID

		//Fin Funciones para Modificar datos
	 
	}
	//fin Tarer los articulos, categorias, sub_categorias y precio por ID del articulo 

		//Inicio Trae la ultima caja por usuario
	class ventaE
	{
		  function update_ventaByIdDescuento($ID_ven, $ven_total, $ven_descuento)

                        {
                              $sql_venta = 'UPDATE venta  SET ven_total = "'.$ven_total.'" , ven_descuento = "'.$ven_descuento.'"  WHERE ID_ven='.$ID_ven.' ';
                              $result_venta =mysql_query($sql_venta );
                              return $result_venta;
                        }
          //Fin Funcion Modifica to

		 function update_ventaByIdSoloTotal($ID_ven, $ven_total)

                        {
                              $sql_venta = 'UPDATE venta  SET ven_total = "'.$ven_total.'" WHERE ID_ven='.$ID_ven.' ';
                              $result_venta =mysql_query($sql_venta );
                              return $result_venta;
                        }

		function get_venta_UltimaByIdCaja($ID_caj)
		{
			$sql_venta = 'SELECT * FROM venta WHERE ID_caj="'.$ID_caj.'" ORDER BY ID_ven DESC LIMIT 1' ; 
		      $result_venta =mysql_query($sql_venta);
		       return $result_venta;
		}

		function get_venta_penultimaByIdCaja($ID_caj)
		{
			$sql_venta = 'SELECT * FROM venta WHERE ID_caj="'.$ID_caj.'" ORDER BY ID_ven DESC LIMIT 1,1' ; 
		      $result_venta =mysql_query($sql_venta);
		       return $result_venta;
		}
		function get_venta_AntepenultimaByIdCaja($ID_caj)
		{
			$sql_venta = 'SELECT * FROM venta WHERE ID_caj="'.$ID_caj.'" ORDER BY ID_ven DESC LIMIT 2,1' ; 
		      $result_venta =mysql_query($sql_venta);
		       return $result_venta;
		} 

		function get_ventaByIdcaj($ID_caj)
		{
			$sql_venta = 'SELECT * FROM venta WHERE ID_caj="'.$ID_caj.'"' ; 
		      $result_venta =mysql_query($sql_venta);
		       return $result_venta;
		}


				function get_ventaByIdcajUltimosTres($ID_caj)
		{
			$sql_venta = 'SELECT * FROM venta, tipos_pagos WHERE venta.ven_fpo=tipos_pagos.ID_fpo AND ID_caj="'.$ID_caj.'" ORDER BY ID_ven DESC LIMIT 0,3' ; 
		      $result_venta =mysql_query($sql_venta);
		       return $result_venta;
		}

		function get_ventaByIdcajUltimaActual($ID_caj)
		{
			$sql_venta = 'SELECT * FROM venta, tipos_pagos WHERE venta.ven_fpo=tipos_pagos.ID_fpo AND ID_caj="'.$ID_caj.'" AND ven_total<>"0.00" ORDER BY ID_ven DESC LIMIT 0,1' ; 
		      $result_venta =mysql_query($sql_venta);
		       return $result_venta;
		}


		function update_ventaByIdMonto($ID_ven, $resto)
		{
			$sql_venta = 'UPDATE venta SET ven_total='.$resto.' WHERE ID_ven="'.$ID_ven.'"' ; 
		      $result_venta =mysql_query($sql_venta);
		       return $result_venta;
		}

		//Inicio Funcion Modifica todos los datos por ID
		  function update_ventaById($ID_ven, $ven_fpo)
		    {
		      	
		      $sql_venta = 'UPDATE venta SET ven_fpo = "'.$ven_fpo.'"  WHERE ID_ven='.$ID_ven.' ';
		      $result_venta =mysql_query($sql_venta);
		       return $result_venta;
		    }
		  //Fin Funcion Modifica todos los datos por ID
		
	}
	//fin Trae la ultima caja por usuario

	//Inicio Trae la ultima caja por usuario
	class mov_cajaE
	{


                        function get_mov_cajaByIdpre_cant($ID_mov)
                        {
                              $sql_mov_caja = 'SELECT pre_cant, mov_sal FROM mov_caja, precios WHERE mov_caja.ID_pre=precios.ID_pre AND ID_mov='.$ID_mov.' ' ; 
                              $result_mov_caja =mysql_query($sql_mov_caja);
                              return $result_mov_caja;
                        }
		   function update_mov_cajaDescuento($ID_mov, $mov_sal, $mov_descuento)

                        {
                              $sql_mov_caja = 'UPDATE mov_caja  SET  mov_sal = "'.$mov_sal.'" , mov_descuento = "'.$mov_descuento.'" WHERE ID_mov='.$ID_mov.' ';
                              $result_mov_caja =mysql_query($sql_mov_caja );
                              return $result_mov_caja;
                        }

		function get_mov_caja($ID_caj, $ID_ven)
		{
			$get_mov_caja = 'SELECT articulos.ID_art, articulos.art_unidad, sum(mov_cantidad) AS mov_cantidad, articulos.art_desc, sum(pre_cant) AS pre_cant, sum(mov_cantidad*pre_cant) AS multiplicacion, ID_mov, mov_sal, mov_descuento FROM caja, venta, mov_caja, articulos, precios where precios.ID_pre=articulos.ID_pre AND articulos.ID_art=mov_caja.ID_art AND mov_caja.ID_ven=venta.ID_ven AND venta.ID_caj=caja.ID_caj AND caja.ID_caj='.$ID_caj.' AND venta.ID_ven='.$ID_ven.' group by articulos.ID_art'; 
		      $result_venta =mysql_query($get_mov_caja);
		       return $result_venta;
		}


		//Inicio Funcion Eliminar todos los datos por ID
		function drop_mov_cajaById($ID_ven, $ID_art)
		{
		      $sql_mov_caja = 'DELETE FROM mov_caja WHERE ID_ven="'.$ID_ven.'" AND ID_art="'.$ID_art.'"' ; 
		      $result_mov_caja =mysql_query($sql_mov_caja);
		      return $result_mov_caja;
		}
		//Fin Funcion Eliminar todos los datos por ID

		//Inicio Funcion trae los netos de los movimientos correspondientes a una venta y una caja
		function get_mov_caja_netos($ID_ven, $ID_caj)
		{
		$get_mov_caja_netos = "SELECT sum(pre_neto*mov_cantidad) as neto FROM precios, articulos, mov_caja, venta, caja where precios.ID_pre=articulos.ID_pre AND articulos.ID_art=mov_caja.ID_art AND mov_caja.ID_ven=venta.ID_ven AND venta.ID_caj=caja.ID_caj AND caja.ID_caj='".$ID_caj."' AND mov_caja.ID_ven='".$ID_ven."'";
		$result_get_mov_caja_netos =mysql_query($get_mov_caja_netos);
		return $result_get_mov_caja_netos;
		}
		//Inicio Funcion trae los netos de los movimientos correspondientes a una venta y una caja

			  //Inicio Trae todos los datos filtrados por ID
			  function get_mov_cajaByIdVen($ID_ven)
			    {
			      $sql_mov_caja = 'SELECT * FROM mov_caja WHERE ID_ven='.$ID_ven.' ' ; 
			      $result_mov_caja =mysql_query($sql_mov_caja);
			      return $result_mov_caja;
			    }
			  //Fin Trae todos los datos filtrados por ID



			    function get_mov_cajaByIdVenTotalSal($ID_ven)
			      {
			      $sql_mov_caja = 'SELECT sum(mov_sal) AS mov_sal FROM mov_caja WHERE ID_ven='.$ID_ven.''; 
			      $result_mov_caja =mysql_query($sql_mov_caja);
			      return $result_mov_caja;
			    }

			      function get_mov_cajaByIdVenYIdArt($ID_ven, $ID_art)
                        {
                              $sql_mov_caja = 'SELECT * FROM mov_caja, venta WHERE mov_caja.ID_ven=venta.ID_ven AND mov_caja.ID_ven='.$ID_ven.' AND ID_art='.$ID_art.''; 
                              $result_mov_caja =mysql_query($sql_mov_caja);
                              return $result_mov_caja;
                        }


			     //Inicio Trae todos los datos filtrados por ID
			  function get_mov_cajaByIdVenUltimo($ID_ven)
			    {
			      $sql_mov_caja = 'SELECT * FROM mov_caja WHERE ID_ven='.$ID_ven.' ORDER BY ID_ven DESC LIMIT 1' ; 
			      $result_mov_caja =mysql_query($sql_mov_caja);
			      return $result_mov_caja;
			    }
			  //Fin Trae todos los datos filtrados por ID

	}
	//fin Trae la ultima caja por usuario

	//Inicio Trae la ultima caja por usuario
	class clientesE
	{
		function get_clientes_byNombreYApellido($busqueda)
		{
			$query_get_clientes_byNombreYApellido = "SELECT * FROM clientes, cuenta_cte WHERE clientes.ID_cli=cuenta_cte.ID_cli AND (cli_nombre like '%".$busqueda."%' OR cli_apellido like '%".$busqueda."%')  ORDER BY cli_apellido ASC";
			$result_query_get_clientes_byNombreYApellido =mysql_query($query_get_clientes_byNombreYApellido);
			return $result_query_get_clientes_byNombreYApellido;
		}	

				function get_ultimoCliente()
		{ 
			$query_get_ultimoCliente = "SELECT * FROM clientes ORDER BY ID_cli DESC LIMIT 1";
			$result_get_ultimoCliente =mysql_query($query_get_ultimoCliente);
			return $result_get_ultimoCliente;
		}	
	}
	//fin Trae la ultima caja por usuario
class tarjetasE
	{
	 function get_tarjetas()
                        {
                              $sql_tarjetas = 'SELECT * FROM tarjetas, cuentas where tarjetas.tar_cue=cuentas.ID_cue';
                              $result_tarjetas =mysql_query($sql_tarjetas);
                              return $result_tarjetas;
                        }
   }
//Inicio Trae la ultima caja por usuario
	class tarjetas_planesE
	{
					 function get_tarjetas_planes()
                        {
                              $sql_tarjetas_planes = 'SELECT * FROM tarjetas_planes, tarjetas WHERE tarjetas_planes.ID_tar=tarjetas.ID_tar ORDER BY tarjetas_planes.ID_tar DESC';
                              $result_tarjetas_planes =mysql_query($sql_tarjetas_planes);
                              return $result_tarjetas_planes;
                        }

                        function get_tarjetas_planesByIdtarjetas($ID_pla)
                        {
                              $sql_tarjetas_planes = 'SELECT * FROM tarjetas_planes, tarjetas WHERE tarjetas_planes.ID_tar=tarjetas.ID_tar AND ID_pla='.$ID_pla.' ' ; 
                              $result_tarjetas_planes =mysql_query($sql_tarjetas_planes);
                              return $result_tarjetas_planes;
                        }

		function get_tarjetas_planesById($ID_tar, $ven_total)
		{
			echo $ID_tar;
			  $sql_tarjetas_planes = 'SELECT * FROM tarjetas_planes WHERE ID_tar='.$ID_tar.'' ; 
		      $result_tarjetas_planes =mysql_query($sql_tarjetas_planes);
		      $num_result_tarjetas_planes = mysql_num_rows($result_tarjetas_planes);
		      $totalConInteres=0;
		      for ($countTarjetas=0; $countTarjetas < $num_result_tarjetas_planes; $countTarjetas++)
		      { 
		      	$assoc_result_tarjetas_planes = mysql_fetch_assoc($result_tarjetas_planes);
		      	$ven_total=number_format($ven_total,2);
		      	echo $pla_cant=$assoc_result_tarjetas_planes['pla_cant'];
		      	$recargo=$assoc_result_tarjetas_planes['pla_recargo'];
		      	$ID_pla=$assoc_result_tarjetas_planes['ID_pla'];
		      	$totalConInteresA=($ven_total*$recargo)/100;
		      	$totalConInteres=$ven_total+$totalConInteresA;
		      	$totalConInteres=number_format($totalConInteres,2);
		      	$valorDeCuotas=$totalConInteres/$pla_cant;
		      	$valorDeCuotas=number_format($valorDeCuotas,2);
		      	 echo "<div class='col-md-12' style='text-align:left;'>";
		      	echo "<p><input type='radio' name='ID_pla' value='".$assoc_result_tarjetas_planes['ID_pla']."'>
		      			".$assoc_result_tarjetas_planes['pla_desc']." (".$assoc_result_tarjetas_planes['pla_recargo']."%) </p>
		      			<p><h6> Cuotas de $ ".$valorDeCuotas." <h6></p>
		      			<p><h6> Total: $ ".$totalConInteres." <h6></p><hr>";
		      	echo "</div>"; 
		      }


		     echo '<br><br><div id="EfectivoTarjeta'.$assoc_result_tarjetas_planes['ID_tar'].'" style="display:none; margin:3%;" class="input-group">
				    <span class="input-group-addon">Monto En Efectivo $</span>
				    <input type="text" name="efectivo" placeholder="00.00" class="form-control">
				
				  </div>';


		      echo "<button type='submit' class='btn btn-success' style='width:90%; margin:5%'><i class='material-icons'>attach_money</i> Finalizar </button>";

		       echo "<button type='button' id='mostrarEfectivo".$assoc_result_tarjetas_planes['ID_tar']."' class='btn btn-primary' style='width:90%; margin:5%'><i class='material-icons'>attach_money</i> Pagar Parte en efectivo </button>";

		       
		       echo "<script>$('#mostrarEfectivo".$assoc_result_tarjetas_planes['ID_tar']."').click(function(){
		       		$('#EfectivoTarjeta".$assoc_result_tarjetas_planes['ID_tar']."').fadeIn(1000);
		       		$('#mostrarEfectivo".$assoc_result_tarjetas_planes['ID_tar']."').fadeOut(1000);
		       });</script>";

		      return;
		}	

		function getPlanesTarjetasByIdTar($ID_tar)
		{
			$sql='SELECT * FROM tarjetas_planes WHERE ID_tar='.$ID_tar.'';
			$result_sql=mysql_query($sql);
			return $result_sql;
		}
	}
	//fin Trae la ultima caja por usuario

	//Inicio cuenta corriente
	class cuenta_cteE
	{

	  //Inicio Funcion Modifica todos los datos por ID
	  function update_cuenta_cteById($ID_cte, $ID_cli, $cte_fec, $cte_monto, $cte_tipo, $ID_fpo)
	    {
	      $sql_cuenta_cte = 'UPDATE cuenta_cte SET ID_cli = '.$ID_cli.' , cte_fec = "'.$cte_fec.'" , cte_monto = '.$cte_monto.' , cte_tipo = '.$cte_tipo.' , ID_fpo = '.$ID_fpo.' WHERE ID_cte='.$ID_cte.' ';
	      $result_sql_cuenta_cte=mysql_query($sql_cuenta_cte);
			return $result_sql_cuenta_cte;
	    }
	  //Fin Funcion Modifica todos los datos por ID

	     //Inicio Funcion Modifica todos los datos por ID
	  function update_CtaCte($ID_cte, $cte_monto)
	    {
	      $cte_fec=date("Y-m-d");
	      $sql_cuenta_cte = 'UPDATE cuenta_cte SET  cte_fec = "'.$cte_fec.'", 
	      cte_monto = '.$cte_monto.' 
	       WHERE ID_cte='.$ID_cte.' ';
	      $result_sql_cuenta_cte=mysql_query($sql_cuenta_cte);
			return $result_sql_cuenta_cte;
	    }
	  //Fin Funcion Modifica todos los datos por ID
    }
	//fin cuenta corriente

	//Inicio categorias
	class categoriasE
	{		
			 //Inicio Funcion Insertar todos los datos
		  function insert_categoriasE($cat_desc)
		    {
		      $sql_categorias = 'INSERT INTO categorias (cat_desc) VALUES ("'.$cat_desc.'")'; 
		      $result_categorias =mysql_query($sql_categorias );
		      return $result_categorias;
		    }
		  //Fin Funcion Insertar todos los datos

			 //Inicio Trae todos los datos filtrados por ID
		  function get_categoriasById($ID_cat)
		    {
		      $sql_categorias = 'SELECT * FROM categorias WHERE ID_cat!='.$ID_cat.' ' ; 
		      $result_categorias =mysql_query($sql_categorias);
		      return $result_categorias;
		    }
		  //Fin Trae todos los datos filtrados por ID


			 //Inicio Trae todos los datos filtrados por ID
		  	function get_ultimaCategoria()
		    {
		      $sql_categorias  		= 'SELECT * FROM categorias ORDER BY ID_cat DESC LIMIT 1'; 
		      $result_categorias  	= mysql_query($sql_categorias);
		      return $result_categorias;
		    }
		  //Fin Trae todos los datos filtrados por ID


		      //Inicio Funcion Modifica todos los datos por ID
			  function update_categorias($ID_cat, $cat_desc)
			    {
			      $sql_categorias = 'UPDATE categorias SET cat_desc = "'.$cat_desc.'" WHERE ID_cat='.$ID_cat.' ';
			      $result_categorias =mysql_query($sql_categorias );
			      return $result_categorias;
			    }
			  //Fin Funcion Modifica todos los datos por ID

			      //Inicio Funcion Modifica todos los datos por ID
			  function get_categoriasYsub()
			    {
			      $sql_categorias = 'SELECT * FROM categorias, sub_categorias WHERE categorias.ID_cat=sub_categorias.ID_cat ORDER BY cat_desc, sub_desc DESC';  
			      $result_categorias =mysql_query($sql_categorias);
			      return $result_categorias;
			    }
			  //Fin Funcion Modifica todos los datos por ID
			    

    }
    //Fin categorias

    	//Inicio sub_categorias
	class sub_categoriasE
	{	
		 //Inicio: Llama a todas las columnas de la tabla
                        function get_sub_categoriasYcat()
                        {
                              $sql_sub_categorias = 'SELECT * FROM sub_categorias, categorias where sub_categorias.ID_cat=categorias.ID_cat ORDER BY categorias.cat_desc ASC ';
                              $result_sub_categorias =mysql_query($sql_sub_categorias);
                              return $result_sub_categorias;
                        }
                         //Fin: Llama a todas las columnas de la tabla

			 //Inicio Trae todos los datos filtrados por ID
		  function get_sub_categoriasById($ID_sub)
		    {
		      $sql_sub_categorias = 'SELECT * FROM sub_categorias WHERE ID_sub!='.$ID_sub.''; 
		      $result_sub_categorias =mysql_query($sql_sub_categorias);
		      return $result_sub_categorias;
		    }
		  //Fin Trae todos los datos filtrados por ID

		     //Inicio Trae todos los datos filtrados por ID_cat
		  function get_sub_categoriasByIdCat($ID_cat)
		    {
		      $sql_sub_categorias = 'SELECT * FROM sub_categorias WHERE ID_cat='.$ID_cat.''; 
		      $result_sub_categorias =mysql_query($sql_sub_categorias);
		      return $result_sub_categorias;
		    }
		  //Fin Trae todos los datos filtrados por ID_cat

		     //Inicio Funcion Modifica todos los datos por ID
			  function update_sub_categoriasByIdE($ID_sub, $sub_desc)
			     {
			      $sql_sub_categorias = 'UPDATE sub_categorias SET sub_desc = "'.$sub_desc.'" WHERE ID_sub='.$ID_sub.' ';
			      $result_sub_categorias =mysql_query($sql_sub_categorias );
			      return $result_sub_categorias;
			    }
			  //Fin Funcion Modifica todos los datos por ID

			     //Inicio Funcion Modifica todos los datos por ID
			  function update_sub_categoriasById($ID_sub, $sub_desc)
			     {
			      $sql_sub_categorias = 'UPDATE sub_categorias SET sub_desc = "'.$sub_desc.'" WHERE ID_sub='.$ID_sub.' ';
			      $result_sub_categorias =mysql_query($sql_sub_categorias );
			      return $result_sub_categorias;
			    }
			  //Fin Funcion Modifica todos los datos por ID


			   //Inicio Funcion Modifica todos los datos por ID
			  function update_categoriasByIdE($ID_cat, $cat_desc)
			    {
			      $sql_categorias = 'UPDATE categorias SET cat_desc = "'.$cat_desc.'" WHERE ID_cat='.$ID_cat.' ';
			      $result_categorias =mysql_query($sql_categorias );
			      return $result_categorias;
			    }
	 		 //Fin Funcion Modifica todos los datos por ID

			     //Inicio Funcion Insertar todos los datos
			  function insert_sub_categoriasE($ID_cat, $sub_desc)
			    {
			      $sql_sub_categorias = 'INSERT INTO sub_categorias (ID_cat, sub_desc) VALUES ("'.$ID_cat.'", "'.$sub_desc.'")'; 
			      $result_sub_categorias =mysql_query($sql_sub_categorias );
			      return $result_sub_categorias;
			    }
			  //Fin Funcion Insertar todos los datos


    }
    //Fin sub_categorias


    	//Inicio proveedores
	class proveedoresE
	{

			 //Inicio Trae todos los datos filtrados por ID
		  function get_proveedoresById($ID_pro)
		    {
		      $sql_proveedores = 'SELECT * FROM proveedores WHERE ID_pro!='.$ID_pro.''; 
		      $result_proveedores =mysql_query($sql_proveedores);
		      return $result_proveedores;
		    }
		  //Fin Trae todos los datos filtrados por ID

    }
    //Fin proveedores

  	//Inicio tipos_pagos
	class tipos_pagosE
	{
		 //Inicio Trae todos los datos
		    function get_tipos_pagos()
		    {
		      $sql_tipos_pagos = 'SELECT * FROM tipos_pagos where ID_fpo!=4 ';
		      $result_tipos_pagos =mysql_query($sql_tipos_pagos);
		      return $result_tipos_pagos;
		    }
		  //Fin Trae todos los datos

    }
    //Fin tipos_pagos


    	class ventas_canceladasE
	{

   		 function get_venta_canceladasByIdCaj($ID_caj)
					{
						$sql='SELECT articulos.art_unidad, articulos.art_cod, articulos.art_desc, ventas_canceladas.ID_vcd, COUNT(ID_vcd) AS CantidadDeCancelaciones FROM ventas_canceladas, articulos WHERE ventas_canceladas.ID_art=articulos.ID_art AND ventas_canceladas.ID_caj=35 GROUP BY ventas_canceladas.ID_art';
								$result_venta_detalle =mysql_query($sql);
                              return $result_venta_detalle;
					}
	}			

	class comprobantes_datosE
    {	
    				
    				    function get_comprobantes_datosNumeroUltimaCopia($ID_cpd)
                        {
                              $sql_comprobantes_datos = 'SELECT cpd_copia, ID_cpd FROM comprobantes_datos WHERE cpd_original='.$ID_cpd.' ORDER BY cpd_copia DESC LIMIT 0,1'; 
                              $result_comprobantes_datos =mysql_query($sql_comprobantes_datos);
                              return $result_comprobantes_datos;
                        }
					

    					  function get_comprobantes_datosOriginal($ID_cte)
                        {
                              $sql_comprobantes_datos = 'SELECT * FROM comprobantes_datos  WHERE ID_cte="'.$ID_cte.'"'; 
                              $result_comprobantes_datos =mysql_query($sql_comprobantes_datos);
                              return $result_comprobantes_datos;
                        }

                        function get_comprobantes_datosByIdID_cte($ID_cte)
                        {
                              $sql_comprobantes_datos = 'SELECT * FROM comprobantes_datos  WHERE ID_cte='.$ID_cte.'' ; 
                              $result_comprobantes_datos =mysql_query($sql_comprobantes_datos);
                              return $result_comprobantes_datos;
                        }
	}
	class comprobantesE
	{
		                 //Inicio: Llama a todas las columnas de la tabla
                        function get_comprobantes_ultimos()
                        {
                              $sql_cabecera_comprobantes = 'SELECT * FROM cabecera_comprobantes, tipo_comprobantes WHERE tipo_comprobantes.ID_tce=cabecera_comprobantes.ID_tce  order by cabecera_comprobantes.ID_cte DESC limit 0, 10 ';
                              $result_cabecera_comprobantes =mysql_query($sql_cabecera_comprobantes);
                              return $result_cabecera_comprobantes;
                        }
                         //Fin: Llama a todas las columnas de la tabla

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_comprobantes_ultimo()
                        {
                              $sql_cabecera_comprobantes = 'SELECT * FROM cabecera_comprobantes  order by cabecera_comprobantes.ID_cte DESC limit 1 ';
                              $result_cabecera_comprobantes =mysql_query($sql_cabecera_comprobantes);
                              return $result_cabecera_comprobantes;
                        }
                         //Fin: Llama a todas las columnas de la tabla

                                //Inicio: Llama a todas las columnas de la tabla filtrada por la fecha
                        function get_comprobantesByFecha($fecDesde, $fecHasta)
                        {
                              $sql_cabecera_comprobantes = 'SELECT * FROM cabecera_comprobantes, tipo_comprobantes WHERE tipo_comprobantes.ID_tce=cabecera_comprobantes.ID_tce  AND cte_fec BETWEEN "'.$fecDesde.'" AND "'.$fecHasta.'" order by cte_fec DESC';
                              $result_cabecera_comprobantes =mysql_query($sql_cabecera_comprobantes);
                              return $result_cabecera_comprobantes;
                        }
                         //Fin: Llama a todas las columnas de la tabla filtrada por la fecha

                        //Inicio: Llama a todas las columnas de la tabla filtrada por la fecha mas el tipo de comprobante
                        function get_comprobantesByIdCueByFecha($ID_tceB, $fecDesde, $fecHasta)
                         {
                              $sql_cabecera_comprobantes = 'SELECT * FROM cabecera_comprobantes, tipo_comprobantes WHERE tipo_comprobantes.ID_tce=cabecera_comprobantes.ID_tce AND cabecera_comprobantes.ID_tce="'.$ID_tceB.'" AND cte_fec BETWEEN "'.$fecDesde.'" AND "'.$fecHasta.'" order by cte_fec DESC';
                              $result_cabecera_comprobantes =mysql_query($sql_cabecera_comprobantes);
                              return $result_cabecera_comprobantes;
                        }
                         //Fin: Llama a todas las columnas de la tabla filtrada por la fecha mas el tipo de comprobante

                           //Inicio Funciones para Mostrar Datos por ID

                        function get_cabecera_comprobantesById($ID_cte)
                        {
                              $sql_cabecera_comprobantes = 'SELECT * FROM cabecera_comprobantes , tipo_comprobantes WHERE tipo_comprobantes.ID_tce=cabecera_comprobantes.ID_tce AND ID_cte='.$ID_cte.' ' ; 
                              $result_cabecera_comprobantes =mysql_query($sql_cabecera_comprobantes);
                              return $result_cabecera_comprobantes;
                        }
          //Fin Funciones para Mostrar Datos por ID

	}

	class cabecera_comprobantesE
	{
		    //Inicio Funciones para Mostrar Datos por ID

                        function get_cabecera_comprobantesById($ID_cte)
                        {
                              $sql_cabecera_comprobantes = 'SELECT * FROM cabecera_comprobantes, tipo_comprobantes WHERE cabecera_comprobantes.ID_tce=tipo_comprobantes.ID_tce AND  ID_cte='.$ID_cte.' ' ; 
                              $result_cabecera_comprobantes =mysql_query($sql_cabecera_comprobantes);
                              return $result_cabecera_comprobantes;
                        }
          //Fin Funciones para Mostrar Datos por ID

                         //Inicio Funciones para Mostrar Datos por ID

                        function get_cabecera_comprobantesByIdcte_asociado($cte_asociado)
                        {
                              $sql_cabecera_comprobantes = 'SELECT * FROM cabecera_comprobantes, tipo_comprobantes WHERE cabecera_comprobantes.ID_tce=tipo_comprobantes.ID_tce AND ID_cte='.$cte_asociado.' ' ; 
                              $result_cabecera_comprobantes =mysql_query($sql_cabecera_comprobantes);
                              return $result_cabecera_comprobantes;
                        }
          //Fin Funciones para Mostrar Datos por ID

                          function get_cabecera_comprobantesByIdcte_asociadoAtras($ID_cte)
                        {
                              $sql_cabecera_comprobantes = 'SELECT * FROM cabecera_comprobantes, tipo_comprobantes WHERE cabecera_comprobantes.ID_tce=tipo_comprobantes.ID_tce AND cte_asociado='.$ID_cte.' ' ; 
                              $result_cabecera_comprobantes =mysql_query($sql_cabecera_comprobantes);
                              return $result_cabecera_comprobantes;
                        }

	}	            
	
	class tipo_comprobantesE
	{
	   function get_tipo_comprobantes()
                        {
                              $sql_tipo_comprobantes = 'SELECT * FROM tipo_comprobantes, flujo_comprobantes WHERE tipo_comprobantes.ID_fce=flujo_comprobantes.ID_fce ORDER BY tipo_comprobantes.ID_tce DESC';
                              $result_tipo_comprobantes =mysql_query($sql_tipo_comprobantes);
                              return $result_tipo_comprobantes;
                        }
                             function get_tipo_comprobantesByIdUltimo()
                        {
                              $sql_tipo_comprobantes = 'SELECT * FROM tipo_comprobantes ORDER BY ID_tce DESC LIMIT 1'; 
                              $result_tipo_comprobantes =mysql_query($sql_tipo_comprobantes);
                              return $result_tipo_comprobantes;
                        }

                           function get_tipo_comprobantesConNumeracion()
                        {
                              $sql_tipo_comprobantes = 'SELECT * FROM tipo_comprobantes where tce_numeracionAutomatica=1';
                              $result_tipo_comprobantes =mysql_query($sql_tipo_comprobantes);
                              return $result_tipo_comprobantes;
                        }
                         function get_tipo_comprobantesById($ID_tce)
                        {
                              $sql_tipo_comprobantes = 'SELECT * FROM tipo_comprobantes, flujo_comprobantes WHERE flujo_comprobantes.ID_fce=tipo_comprobantes.ID_fce AND ID_tce='.$ID_tce.' ' ; 
                              $result_tipo_comprobantes =mysql_query($sql_tipo_comprobantes);
                              return $result_tipo_comprobantes;
                        }

    }

     class puntos_de_ventasE
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_puntos_de_ventas()
                        {
                              $sql_puntos_de_ventas = 'SELECT * FROM puntos_de_ventas, tipo_comprobantes WHERE puntos_de_ventas.ID_tce=tipo_comprobantes.ID_tce';
                              $result_puntos_de_ventas =mysql_query($sql_puntos_de_ventas);
                              return $result_puntos_de_ventas;
                        }

                                  //Inicio: Llama a todas las columnas de la tabla
                        function get_puntos_de_ventasByIdID_tce($ID_tce)
                        {
                              $sql_puntos_de_ventas = 'SELECT *, DATE_FORMAT(pdv_fecVencimiento, "%d-%m-%Y") as pdv_fecVencimiento FROM puntos_de_ventas, tipo_comprobantes WHERE puntos_de_ventas.ID_tce=tipo_comprobantes.ID_tce AND puntos_de_ventas.ID_tce='.$ID_tce.'';
                              $result_puntos_de_ventas =mysql_query($sql_puntos_de_ventas);
                              return $result_puntos_de_ventas;
                        }
                        //Inicio Funcion Modifica todos los datos por ID
                        function update_puntos_de_ventasById($ID_pdv, $pdv_numeracion)

                        {
                              $sql_puntos_de_ventas = 'UPDATE puntos_de_ventas  SET pdv_numeracion = "'.$pdv_numeracion.'" WHERE ID_pdv='.$ID_pdv.' ';
                              $result_puntos_de_ventas =mysql_query($sql_puntos_de_ventas );
                              return $result_puntos_de_ventas;
                        }
                          function get_puntos_de_ventasByID_pdv($ID_pdv)

                        {
                              $sql_puntos_de_ventas = 'SELECT * FROM puntos_de_ventas WHERE ID_pdv='.$ID_pdv.' ';
                              $result_puntos_de_ventas =mysql_query($sql_puntos_de_ventas );
                              return $result_puntos_de_ventas;
                        }
          //Fin Funcion Modifica todos los datos por ID
        
                     
   
   
     }


  class detalle_comprobantesE
    {

       //Inicio Funciones para Mostrar Datos por ID

                        function get_detalle_comprobantesById($ID_tce)
                        {
                              $sql_detalle_comprobantes = 'SELECT * FROM detalle_comprobantes  WHERE ID_tce='.$ID_tce.' ' ; 
                              $result_detalle_comprobantes =mysql_query($sql_detalle_comprobantes);
                              return $result_detalle_comprobantes;
                        }
          //Fin Funciones para Mostrar Datos por ID


 	}

   	//Inicio venta_detalle
	class venta_detalleE
	{

					function get_venta_detalleByIdCajYIdFpo($ID_caj, $ID_fpo)
					{
						$sql='SELECT tarjetas.tar_logo, venta_detalle.vde_IDasociado, venta_detalle.tarjeta_ID_pla, venta_detalle.tarjeta_pla_desc, venta_detalle.tarjeta_pla_cant, venta_detalle.tarjeta_pla_recargo, SUM(venta_detalle.fpo_monto) AS suma_monto, COUNT(venta_detalle.ID_vde) AS cantidad_de_ventas FROM caja, venta_detalle, venta, tarjetas WHERE venta_detalle.ID_ven=venta.ID_ven AND venta.ID_caj=caja.ID_caj AND caja.ID_caj='.$ID_caj.' AND venta_detalle.ID_fpo='.$ID_fpo.' AND venta_detalle.vde_IDasociado=tarjetas.ID_tar GROUP BY venta_detalle.vde_IDasociado, venta_detalle.tarjeta_ID_pla ORDER BY venta_detalle.vde_IDasociado DESC';
						$result_venta_detalle =mysql_query($sql);
                              return $result_venta_detalle;
					}

					function get_venta_detalleByIdCajYClientes($ID_caj)
					{
						$sql='SELECT clientes.cli_nombre, clientes.cli_apellido, venta_detalle.vde_IDasociado, SUM(venta_detalle.fpo_monto) AS suma_monto, COUNT(venta_detalle.ID_vde) AS cantidad_de_ventas FROM caja, venta_detalle, venta, clientes WHERE venta_detalle.ID_ven=venta.ID_ven AND venta.ID_caj=caja.ID_caj AND caja.ID_caj='.$ID_caj.' AND venta_detalle.ID_fpo=2 AND venta_detalle.vde_IDasociado=clientes.ID_cli GROUP BY venta_detalle.vde_IDasociado ORDER BY clientes.cli_apellido DESC';
						 $result_venta_detalle =mysql_query($sql);
                              return $result_venta_detalle;
					}

			                function get_venta_detalleById($ID_ven)
                        {
                              $sql_venta_detalle = 'SELECT * FROM venta_detalle, tipos_pagos WHERE tipos_pagos.ID_fpo=venta_detalle.ID_fpo AND ID_ven='.$ID_ven.' ' ; 
                              $result_venta_detalle =mysql_query($sql_venta_detalle);
                              return $result_venta_detalle;
                        }
          //Fin Funciones para Mostrar Datos por ID

                        function get_venta_detalleByIdVenYfdp($ID_ven, $FormaDePago)
                         {
                              $sql_venta_detalle = 'SELECT * FROM venta_detalle WHERE ID_ven='.$ID_ven.' AND ID_fpo='.$FormaDePago.''; 
                              $result_venta_detalle =mysql_query($sql_venta_detalle);
                              return $result_venta_detalle;
                        }

                         function get_venta_detalleSumatoria($ID_ven)
                         {
                              $sql_venta_detalle = 'SELECT SUM(fpo_monto) AS resto FROM venta_detalle WHERE ID_ven='.$ID_ven.''; 
                              $result_venta_detalle =mysql_query($sql_venta_detalle);
                              return $result_venta_detalle;
                        }



    }
    //Fin venta_detalle


?>