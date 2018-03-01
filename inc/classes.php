<?php

    //01 03 2018 20:03:20 El Archivo classes.php se ha modificado correctamente

    class adjuntos
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_adjuntos()
                        {
                              $sql_adjuntos = 'SELECT * FROM adjuntos ';
                              $result_adjuntos =mysql_query($sql_adjuntos);
                              return $result_adjuntos;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_adjuntosById($ID_adj)
                        {
                              $sql_adjuntos = 'SELECT * FROM adjuntos  WHERE ID_adj='.$ID_adj.' ' ; 
                              $result_adjuntos =mysql_query($sql_adjuntos);
                              return $result_adjuntos;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_adjuntos($adj_ID_rel, $adj_fec, $ID_usu, $adj_ruta, $adj_desc, $adj_tablaRel)
                        {
                              $sql_adjuntos = 'INSERT INTO adjuntos (adj_ID_rel, adj_fec, ID_usu, adj_ruta, adj_desc, adj_tablaRel) VALUES ("'.$adj_ID_rel.'", "'.$adj_fec.'", "'.$ID_usu.'", "'.$adj_ruta.'", "'.$adj_desc.'", "'.$adj_tablaRel.'")'; 
                              $result_adjuntos =mysql_query($sql_adjuntos );
                              return $result_adjuntos;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_adjuntosById($ID_adj, $adj_ID_rel, $adj_fec, $ID_usu, $adj_ruta, $adj_desc, $adj_tablaRel)

                        {
                              $sql_adjuntos = 'UPDATE adjuntos  SET adj_ID_rel = "'.$adj_ID_rel.'" , adj_fec = "'.$adj_fec.'" , ID_usu = "'.$ID_usu.'" , adj_ruta = "'.$adj_ruta.'" , adj_desc = "'.$adj_desc.'" , adj_tablaRel = "'.$adj_tablaRel.'"  WHERE ID_adj='.$ID_adj.' ';
                              $result_adjuntos =mysql_query($sql_adjuntos );
                              return $result_adjuntos;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_adjuntosById($ID_adj)
                        {
                              $sql_adjuntos = 'DELETE FROM adjuntos  WHERE ID_adj='.$ID_adj.' ' ; 
                              $result_adjuntos =mysql_query($sql_adjuntos);
                              return $result_adjuntos;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class alertas
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_alertas()
                        {
                              $sql_alertas = 'SELECT * FROM alertas ';
                              $result_alertas =mysql_query($sql_alertas);
                              return $result_alertas;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_alertasById($ID_ale)
                        {
                              $sql_alertas = 'SELECT * FROM alertas  WHERE ID_ale='.$ID_ale.' ' ; 
                              $result_alertas =mysql_query($sql_alertas);
                              return $result_alertas;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_alertas($ale_desc)
                        {
                              $sql_alertas = 'INSERT INTO alertas (ale_desc) VALUES ("'.$ale_desc.'")'; 
                              $result_alertas =mysql_query($sql_alertas );
                              return $result_alertas;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_alertasById($ID_ale, $ale_desc)

                        {
                              $sql_alertas = 'UPDATE alertas  SET ale_desc = "'.$ale_desc.'"  WHERE ID_ale='.$ID_ale.' ';
                              $result_alertas =mysql_query($sql_alertas );
                              return $result_alertas;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_alertasById($ID_ale)
                        {
                              $sql_alertas = 'DELETE FROM alertas  WHERE ID_ale='.$ID_ale.' ' ; 
                              $result_alertas =mysql_query($sql_alertas);
                              return $result_alertas;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class articulos
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_articulos()
                        {
                              $sql_articulos = 'SELECT * FROM articulos ';
                              $result_articulos =mysql_query($sql_articulos);
                              return $result_articulos;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_articulosById($ID_art)
                        {
                              $sql_articulos = 'SELECT * FROM articulos  WHERE ID_art='.$ID_art.' ' ; 
                              $result_articulos =mysql_query($sql_articulos);
                              return $result_articulos;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_articulos($ID_sub, $ID_pre, $ID_pro, $art_desc, $art_cod, $art_unidad)
                        {
                              $sql_articulos = 'INSERT INTO articulos (ID_sub, ID_pre, ID_pro, art_desc, art_cod, art_unidad) VALUES ("'.$ID_sub.'", "'.$ID_pre.'", "'.$ID_pro.'", "'.$art_desc.'", "'.$art_cod.'", "'.$art_unidad.'")'; 
                              $result_articulos =mysql_query($sql_articulos );
                              return $result_articulos;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_articulosById($ID_art, $ID_sub, $ID_pre, $ID_pro, $art_desc, $art_cod, $art_unidad)

                        {
                              $sql_articulos = 'UPDATE articulos  SET ID_sub = "'.$ID_sub.'" , ID_pre = "'.$ID_pre.'" , ID_pro = "'.$ID_pro.'" , art_desc = "'.$art_desc.'" , art_cod = "'.$art_cod.'" , art_unidad = "'.$art_unidad.'"  WHERE ID_art='.$ID_art.' ';
                              $result_articulos =mysql_query($sql_articulos );
                              return $result_articulos;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_articulosById($ID_art)
                        {
                              $sql_articulos = 'DELETE FROM articulos  WHERE ID_art='.$ID_art.' ' ; 
                              $result_articulos =mysql_query($sql_articulos);
                              return $result_articulos;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class bancos
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_bancos()
                        {
                              $sql_bancos = 'SELECT * FROM bancos ';
                              $result_bancos =mysql_query($sql_bancos);
                              return $result_bancos;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_bancosById($ID_ban)
                        {
                              $sql_bancos = 'SELECT * FROM bancos  WHERE ID_ban='.$ID_ban.' ' ; 
                              $result_bancos =mysql_query($sql_bancos);
                              return $result_bancos;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_bancos($ban_desc, $ban_logo, $ban_habilitado)
                        {
                              $sql_bancos = 'INSERT INTO bancos (ban_desc, ban_logo, ban_habilitado) VALUES ("'.$ban_desc.'", "'.$ban_logo.'", "'.$ban_habilitado.'")'; 
                              $result_bancos =mysql_query($sql_bancos );
                              return $result_bancos;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_bancosById($ID_ban, $ban_desc, $ban_logo, $ban_habilitado)

                        {
                              $sql_bancos = 'UPDATE bancos  SET ban_desc = "'.$ban_desc.'" , ban_logo = "'.$ban_logo.'" , ban_habilitado = "'.$ban_habilitado.'"  WHERE ID_ban='.$ID_ban.' ';
                              $result_bancos =mysql_query($sql_bancos );
                              return $result_bancos;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_bancosById($ID_ban)
                        {
                              $sql_bancos = 'DELETE FROM bancos  WHERE ID_ban='.$ID_ban.' ' ; 
                              $result_bancos =mysql_query($sql_bancos);
                              return $result_bancos;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class cabecera_comprobantes
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_cabecera_comprobantes()
                        {
                              $sql_cabecera_comprobantes = 'SELECT * FROM cabecera_comprobantes ';
                              $result_cabecera_comprobantes =mysql_query($sql_cabecera_comprobantes);
                              return $result_cabecera_comprobantes;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_cabecera_comprobantesById($ID_cte)
                        {
                              $sql_cabecera_comprobantes = 'SELECT * FROM cabecera_comprobantes  WHERE ID_cte='.$ID_cte.' ' ; 
                              $result_cabecera_comprobantes =mysql_query($sql_cabecera_comprobantes);
                              return $result_cabecera_comprobantes;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_cabecera_comprobantes($ID_tce, $cte_asociado, $cte_monto, $cte_asociacion, $ID_caj, $cte_numero, $cte_neto, $cte_retencion, $cte_fec, $cte_metrica_descuento)
                        {
                              $sql_cabecera_comprobantes = 'INSERT INTO cabecera_comprobantes (ID_tce, cte_asociado, cte_monto, cte_asociacion, ID_caj, cte_numero, cte_neto, cte_retencion, cte_fec, cte_metrica_descuento) VALUES ("'.$ID_tce.'", "'.$cte_asociado.'", "'.$cte_monto.'", "'.$cte_asociacion.'", "'.$ID_caj.'", "'.$cte_numero.'", "'.$cte_neto.'", "'.$cte_retencion.'", "'.$cte_fec.'", "'.$cte_metrica_descuento.'")'; 
                              $result_cabecera_comprobantes =mysql_query($sql_cabecera_comprobantes );
                              return $result_cabecera_comprobantes;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_cabecera_comprobantesById($ID_cte, $ID_tce, $cte_asociado, $cte_monto, $cte_asociacion, $ID_caj, $cte_numero, $cte_neto, $cte_retencion, $cte_fec, $cte_metrica_descuento)

                        {
                              $sql_cabecera_comprobantes = 'UPDATE cabecera_comprobantes  SET ID_tce = "'.$ID_tce.'" , cte_asociado = "'.$cte_asociado.'" , cte_monto = "'.$cte_monto.'" , cte_asociacion = "'.$cte_asociacion.'" , ID_caj = "'.$ID_caj.'" , cte_numero = "'.$cte_numero.'" , cte_neto = "'.$cte_neto.'" , cte_retencion = "'.$cte_retencion.'" , cte_fec = "'.$cte_fec.'" , cte_metrica_descuento = "'.$cte_metrica_descuento.'"  WHERE ID_cte='.$ID_cte.' ';
                              $result_cabecera_comprobantes =mysql_query($sql_cabecera_comprobantes );
                              return $result_cabecera_comprobantes;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_cabecera_comprobantesById($ID_cte)
                        {
                              $sql_cabecera_comprobantes = 'DELETE FROM cabecera_comprobantes  WHERE ID_cte='.$ID_cte.' ' ; 
                              $result_cabecera_comprobantes =mysql_query($sql_cabecera_comprobantes);
                              return $result_cabecera_comprobantes;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class caja
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_caja()
                        {
                              $sql_caja = 'SELECT * FROM caja ';
                              $result_caja =mysql_query($sql_caja);
                              return $result_caja;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_cajaById($ID_caj)
                        {
                              $sql_caja = 'SELECT * FROM caja  WHERE ID_caj='.$ID_caj.' ' ; 
                              $result_caja =mysql_query($sql_caja);
                              return $result_caja;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_caja($ID_control, $ID_usu, $caj_fec, $caj_horaa, $caj_horac, $cja_vta, $cja_vtad, $cja_vct, $cja_vef, $caj_inicio, $caj_cierre, $caj_vne, $ID_suc, $caj_efectivoReal)
                        {
                              $sql_caja = 'INSERT INTO caja (ID_control, ID_usu, caj_fec, caj_horaa, caj_horac, cja_vta, cja_vtad, cja_vct, cja_vef, caj_inicio, caj_cierre, caj_vne, ID_suc, caj_efectivoReal) VALUES ("'.$ID_control.'", "'.$ID_usu.'", "'.$caj_fec.'", "'.$caj_horaa.'", "'.$caj_horac.'", "'.$cja_vta.'", "'.$cja_vtad.'", "'.$cja_vct.'", "'.$cja_vef.'", "'.$caj_inicio.'", "'.$caj_cierre.'", "'.$caj_vne.'", "'.$ID_suc.'", "'.$caj_efectivoReal.'")'; 
                              $result_caja =mysql_query($sql_caja );
                              return $result_caja;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_cajaById($ID_caj, $ID_control, $ID_usu, $caj_fec, $caj_horaa, $caj_horac, $cja_vta, $cja_vtad, $cja_vct, $cja_vef, $caj_inicio, $caj_cierre, $caj_vne, $ID_suc, $caj_efectivoReal)

                        {
                              $sql_caja = 'UPDATE caja  SET ID_control = "'.$ID_control.'" , ID_usu = "'.$ID_usu.'" , caj_fec = "'.$caj_fec.'" , caj_horaa = "'.$caj_horaa.'" , caj_horac = "'.$caj_horac.'" , cja_vta = "'.$cja_vta.'" , cja_vtad = "'.$cja_vtad.'" , cja_vct = "'.$cja_vct.'" , cja_vef = "'.$cja_vef.'" , caj_inicio = "'.$caj_inicio.'" , caj_cierre = "'.$caj_cierre.'" , caj_vne = "'.$caj_vne.'" , ID_suc = "'.$ID_suc.'" , caj_efectivoReal = "'.$caj_efectivoReal.'"  WHERE ID_caj='.$ID_caj.' ';
                              $result_caja =mysql_query($sql_caja );
                              return $result_caja;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_cajaById($ID_caj)
                        {
                              $sql_caja = 'DELETE FROM caja  WHERE ID_caj='.$ID_caj.' ' ; 
                              $result_caja =mysql_query($sql_caja);
                              return $result_caja;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class categorias
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_categorias()
                        {
                              $sql_categorias = 'SELECT * FROM categorias ';
                              $result_categorias =mysql_query($sql_categorias);
                              return $result_categorias;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_categoriasById($ID_cat)
                        {
                              $sql_categorias = 'SELECT * FROM categorias  WHERE ID_cat='.$ID_cat.' ' ; 
                              $result_categorias =mysql_query($sql_categorias);
                              return $result_categorias;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_categorias($cat_desc)
                        {
                              $sql_categorias = 'INSERT INTO categorias (cat_desc) VALUES ("'.$cat_desc.'")'; 
                              $result_categorias =mysql_query($sql_categorias );
                              return $result_categorias;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_categoriasById($ID_cat, $cat_desc)

                        {
                              $sql_categorias = 'UPDATE categorias  SET cat_desc = "'.$cat_desc.'"  WHERE ID_cat='.$ID_cat.' ';
                              $result_categorias =mysql_query($sql_categorias );
                              return $result_categorias;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_categoriasById($ID_cat)
                        {
                              $sql_categorias = 'DELETE FROM categorias  WHERE ID_cat='.$ID_cat.' ' ; 
                              $result_categorias =mysql_query($sql_categorias);
                              return $result_categorias;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class cheques
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_cheques()
                        {
                              $sql_cheques = 'SELECT * FROM cheques ';
                              $result_cheques =mysql_query($sql_cheques);
                              return $result_cheques;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_chequesById($ID_che)
                        {
                              $sql_cheques = 'SELECT * FROM cheques  WHERE ID_che='.$ID_che.' ' ; 
                              $result_cheques =mysql_query($sql_cheques);
                              return $result_cheques;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_cheques($che_num, $ID_ban, $che_importe, $che_librador, $che_tipo, $che_fecha, $che_beneficiario, $ID_cue, $che_procedencia, $che_estado)
                        {
                              $sql_cheques = 'INSERT INTO cheques (che_num, ID_ban, che_importe, che_librador, che_tipo, che_fecha, che_beneficiario, ID_cue, che_procedencia, che_estado) VALUES ("'.$che_num.'", "'.$ID_ban.'", "'.$che_importe.'", "'.$che_librador.'", "'.$che_tipo.'", "'.$che_fecha.'", "'.$che_beneficiario.'", "'.$ID_cue.'", "'.$che_procedencia.'", "'.$che_estado.'")'; 
                              $result_cheques =mysql_query($sql_cheques );
                              return $result_cheques;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_chequesById($ID_che, $che_num, $ID_ban, $che_importe, $che_librador, $che_tipo, $che_fecha, $che_beneficiario, $ID_cue, $che_procedencia, $che_estado)

                        {
                              $sql_cheques = 'UPDATE cheques  SET che_num = "'.$che_num.'" , ID_ban = "'.$ID_ban.'" , che_importe = "'.$che_importe.'" , che_librador = "'.$che_librador.'" , che_tipo = "'.$che_tipo.'" , che_fecha = "'.$che_fecha.'" , che_beneficiario = "'.$che_beneficiario.'" , ID_cue = "'.$ID_cue.'" , che_procedencia = "'.$che_procedencia.'" , che_estado = "'.$che_estado.'"  WHERE ID_che='.$ID_che.' ';
                              $result_cheques =mysql_query($sql_cheques );
                              return $result_cheques;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_chequesById($ID_che)
                        {
                              $sql_cheques = 'DELETE FROM cheques  WHERE ID_che='.$ID_che.' ' ; 
                              $result_cheques =mysql_query($sql_cheques);
                              return $result_cheques;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class clientes
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_clientes()
                        {
                              $sql_clientes = 'SELECT * FROM clientes ';
                              $result_clientes =mysql_query($sql_clientes);
                              return $result_clientes;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_clientesById($ID_cli)
                        {
                              $sql_clientes = 'SELECT * FROM clientes  WHERE ID_cli='.$ID_cli.' ' ; 
                              $result_clientes =mysql_query($sql_clientes);
                              return $result_clientes;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_clientes($cli_nombre, $cli_apellido, $cli_telefono, $cli_direccion, $ID_suc, $cli_mail)
                        {
                              $sql_clientes = 'INSERT INTO clientes (cli_nombre, cli_apellido, cli_telefono, cli_direccion, ID_suc, cli_mail) VALUES ("'.$cli_nombre.'", "'.$cli_apellido.'", "'.$cli_telefono.'", "'.$cli_direccion.'", "'.$ID_suc.'", "'.$cli_mail.'")'; 
                              $result_clientes =mysql_query($sql_clientes );
                              return $result_clientes;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_clientesById($ID_cli, $cli_nombre, $cli_apellido, $cli_telefono, $cli_direccion, $ID_suc, $cli_mail)

                        {
                              $sql_clientes = 'UPDATE clientes  SET cli_nombre = "'.$cli_nombre.'" , cli_apellido = "'.$cli_apellido.'" , cli_telefono = "'.$cli_telefono.'" , cli_direccion = "'.$cli_direccion.'" , ID_suc = "'.$ID_suc.'" , cli_mail = "'.$cli_mail.'"  WHERE ID_cli='.$ID_cli.' ';
                              $result_clientes =mysql_query($sql_clientes );
                              return $result_clientes;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_clientesById($ID_cli)
                        {
                              $sql_clientes = 'DELETE FROM clientes  WHERE ID_cli='.$ID_cli.' ' ; 
                              $result_clientes =mysql_query($sql_clientes);
                              return $result_clientes;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class comisiones
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_comisiones()
                        {
                              $sql_comisiones = 'SELECT * FROM comisiones ';
                              $result_comisiones =mysql_query($sql_comisiones);
                              return $result_comisiones;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_comisionesById($ID_cos)
                        {
                              $sql_comisiones = 'SELECT * FROM comisiones  WHERE ID_cos='.$ID_cos.' ' ; 
                              $result_comisiones =mysql_query($sql_comisiones);
                              return $result_comisiones;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_comisiones($ID_acr, $cos_desc, $cos_monto)
                        {
                              $sql_comisiones = 'INSERT INTO comisiones (ID_acr, cos_desc, cos_monto) VALUES ("'.$ID_acr.'", "'.$cos_desc.'", "'.$cos_monto.'")'; 
                              $result_comisiones =mysql_query($sql_comisiones );
                              return $result_comisiones;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_comisionesById($ID_cos, $ID_acr, $cos_desc, $cos_monto)

                        {
                              $sql_comisiones = 'UPDATE comisiones  SET ID_acr = "'.$ID_acr.'" , cos_desc = "'.$cos_desc.'" , cos_monto = "'.$cos_monto.'"  WHERE ID_cos='.$ID_cos.' ';
                              $result_comisiones =mysql_query($sql_comisiones );
                              return $result_comisiones;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_comisionesById($ID_cos)
                        {
                              $sql_comisiones = 'DELETE FROM comisiones  WHERE ID_cos='.$ID_cos.' ' ; 
                              $result_comisiones =mysql_query($sql_comisiones);
                              return $result_comisiones;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class compras
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_compras()
                        {
                              $sql_compras = 'SELECT * FROM compras ';
                              $result_compras =mysql_query($sql_compras);
                              return $result_compras;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_comprasById($ID_com)
                        {
                              $sql_compras = 'SELECT * FROM compras  WHERE ID_com='.$ID_com.' ' ; 
                              $result_compras =mysql_query($sql_compras);
                              return $result_compras;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_compras($ID_pro, $com_cod, $com_ven, $com_fec, $ID_per, $com_tipo)
                        {
                              $sql_compras = 'INSERT INTO compras (ID_pro, com_cod, com_ven, com_fec, ID_per, com_tipo) VALUES ("'.$ID_pro.'", "'.$com_cod.'", "'.$com_ven.'", "'.$com_fec.'", "'.$ID_per.'", "'.$com_tipo.'")'; 
                              $result_compras =mysql_query($sql_compras );
                              return $result_compras;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_comprasById($ID_com, $ID_pro, $com_cod, $com_ven, $com_fec, $ID_per, $com_tipo)

                        {
                              $sql_compras = 'UPDATE compras  SET ID_pro = "'.$ID_pro.'" , com_cod = "'.$com_cod.'" , com_ven = "'.$com_ven.'" , com_fec = "'.$com_fec.'" , ID_per = "'.$ID_per.'" , com_tipo = "'.$com_tipo.'"  WHERE ID_com='.$ID_com.' ';
                              $result_compras =mysql_query($sql_compras );
                              return $result_compras;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_comprasById($ID_com)
                        {
                              $sql_compras = 'DELETE FROM compras  WHERE ID_com='.$ID_com.' ' ; 
                              $result_compras =mysql_query($sql_compras);
                              return $result_compras;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class comprobantes_datos
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_comprobantes_datos()
                        {
                              $sql_comprobantes_datos = 'SELECT * FROM comprobantes_datos ';
                              $result_comprobantes_datos =mysql_query($sql_comprobantes_datos);
                              return $result_comprobantes_datos;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_comprobantes_datosById($ID_cpd)
                        {
                              $sql_comprobantes_datos = 'SELECT * FROM comprobantes_datos  WHERE ID_cpd='.$ID_cpd.' ' ; 
                              $result_comprobantes_datos =mysql_query($sql_comprobantes_datos);
                              return $result_comprobantes_datos;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_comprobantes_datos($ID_cte, $ID_usu, $cpd_fecha, $ID_pdv, $cpd_original, $cpd_copia)
                        {
                              $sql_comprobantes_datos = 'INSERT INTO comprobantes_datos (ID_cte, ID_usu, cpd_fecha, ID_pdv, cpd_original, cpd_copia) VALUES ("'.$ID_cte.'", "'.$ID_usu.'", "'.$cpd_fecha.'", "'.$ID_pdv.'", "'.$cpd_original.'", "'.$cpd_copia.'")'; 
                              $result_comprobantes_datos =mysql_query($sql_comprobantes_datos );
                              return $result_comprobantes_datos;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_comprobantes_datosById($ID_cpd, $ID_cte, $ID_usu, $cpd_fecha, $ID_pdv, $cpd_original, $cpd_copia)

                        {
                              $sql_comprobantes_datos = 'UPDATE comprobantes_datos  SET ID_cte = "'.$ID_cte.'" , ID_usu = "'.$ID_usu.'" , cpd_fecha = "'.$cpd_fecha.'" , ID_pdv = "'.$ID_pdv.'" , cpd_original = "'.$cpd_original.'" , cpd_copia = "'.$cpd_copia.'"  WHERE ID_cpd='.$ID_cpd.' ';
                              $result_comprobantes_datos =mysql_query($sql_comprobantes_datos );
                              return $result_comprobantes_datos;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_comprobantes_datosById($ID_cpd)
                        {
                              $sql_comprobantes_datos = 'DELETE FROM comprobantes_datos  WHERE ID_cpd='.$ID_cpd.' ' ; 
                              $result_comprobantes_datos =mysql_query($sql_comprobantes_datos);
                              return $result_comprobantes_datos;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class cuenta_cte
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_cuenta_cte()
                        {
                              $sql_cuenta_cte = 'SELECT * FROM cuenta_cte ';
                              $result_cuenta_cte =mysql_query($sql_cuenta_cte);
                              return $result_cuenta_cte;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_cuenta_cteById($ID_cte)
                        {
                              $sql_cuenta_cte = 'SELECT * FROM cuenta_cte  WHERE ID_cte='.$ID_cte.' ' ; 
                              $result_cuenta_cte =mysql_query($sql_cuenta_cte);
                              return $result_cuenta_cte;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_cuenta_cte($ID_cli, $cte_fec, $cte_monto, $cte_tipo, $ID_fpo)
                        {
                              $sql_cuenta_cte = 'INSERT INTO cuenta_cte (ID_cli, cte_fec, cte_monto, cte_tipo, ID_fpo) VALUES ("'.$ID_cli.'", "'.$cte_fec.'", "'.$cte_monto.'", "'.$cte_tipo.'", "'.$ID_fpo.'")'; 
                              $result_cuenta_cte =mysql_query($sql_cuenta_cte );
                              return $result_cuenta_cte;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_cuenta_cteById($ID_cte, $ID_cli, $cte_fec, $cte_monto, $cte_tipo, $ID_fpo)

                        {
                              $sql_cuenta_cte = 'UPDATE cuenta_cte  SET ID_cli = "'.$ID_cli.'" , cte_fec = "'.$cte_fec.'" , cte_monto = "'.$cte_monto.'" , cte_tipo = "'.$cte_tipo.'" , ID_fpo = "'.$ID_fpo.'"  WHERE ID_cte='.$ID_cte.' ';
                              $result_cuenta_cte =mysql_query($sql_cuenta_cte );
                              return $result_cuenta_cte;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_cuenta_cteById($ID_cte)
                        {
                              $sql_cuenta_cte = 'DELETE FROM cuenta_cte  WHERE ID_cte='.$ID_cte.' ' ; 
                              $result_cuenta_cte =mysql_query($sql_cuenta_cte);
                              return $result_cuenta_cte;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class cuentas
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_cuentas()
                        {
                              $sql_cuentas = 'SELECT * FROM cuentas ';
                              $result_cuentas =mysql_query($sql_cuentas);
                              return $result_cuentas;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_cuentasById($ID_cue)
                        {
                              $sql_cuentas = 'SELECT * FROM cuentas  WHERE ID_cue='.$ID_cue.' ' ; 
                              $result_cuentas =mysql_query($sql_cuentas);
                              return $result_cuentas;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_cuentas($cue_desc, $ID_ctp, $cue_direccion, $cue_sucursal, $cue_cbu, $cue_cuit, $cue_num, $cue_moneda)
                        {
                              $sql_cuentas = 'INSERT INTO cuentas (cue_desc, ID_ctp, cue_direccion, cue_sucursal, cue_cbu, cue_cuit, cue_num, cue_moneda) VALUES ("'.$cue_desc.'", "'.$ID_ctp.'", "'.$cue_direccion.'", "'.$cue_sucursal.'", "'.$cue_cbu.'", "'.$cue_cuit.'", "'.$cue_num.'", "'.$cue_moneda.'")'; 
                              $result_cuentas =mysql_query($sql_cuentas );
                              return $result_cuentas;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_cuentasById($ID_cue, $cue_desc, $ID_ctp, $cue_direccion, $cue_sucursal, $cue_cbu, $cue_cuit, $cue_num, $cue_moneda)

                        {
                              $sql_cuentas = 'UPDATE cuentas  SET cue_desc = "'.$cue_desc.'" , ID_ctp = "'.$ID_ctp.'" , cue_direccion = "'.$cue_direccion.'" , cue_sucursal = "'.$cue_sucursal.'" , cue_cbu = "'.$cue_cbu.'" , cue_cuit = "'.$cue_cuit.'" , cue_num = "'.$cue_num.'" , cue_moneda = "'.$cue_moneda.'"  WHERE ID_cue='.$ID_cue.' ';
                              $result_cuentas =mysql_query($sql_cuentas );
                              return $result_cuentas;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_cuentasById($ID_cue)
                        {
                              $sql_cuentas = 'DELETE FROM cuentas  WHERE ID_cue='.$ID_cue.' ' ; 
                              $result_cuentas =mysql_query($sql_cuentas);
                              return $result_cuentas;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class cuentas_impuestos
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_cuentas_impuestos()
                        {
                              $sql_cuentas_impuestos = 'SELECT * FROM cuentas_impuestos ';
                              $result_cuentas_impuestos =mysql_query($sql_cuentas_impuestos);
                              return $result_cuentas_impuestos;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_cuentas_impuestosById($ID_cti)
                        {
                              $sql_cuentas_impuestos = 'SELECT * FROM cuentas_impuestos  WHERE ID_cti='.$ID_cti.' ' ; 
                              $result_cuentas_impuestos =mysql_query($sql_cuentas_impuestos);
                              return $result_cuentas_impuestos;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_cuentas_impuestos($ID_cue, $cti_desc, $cti_credOdeb, $cti_monto, $cti_porcentaje)
                        {
                              $sql_cuentas_impuestos = 'INSERT INTO cuentas_impuestos (ID_cue, cti_desc, cti_credOdeb, cti_monto, cti_porcentaje) VALUES ("'.$ID_cue.'", "'.$cti_desc.'", "'.$cti_credOdeb.'", "'.$cti_monto.'", "'.$cti_porcentaje.'")'; 
                              $result_cuentas_impuestos =mysql_query($sql_cuentas_impuestos );
                              return $result_cuentas_impuestos;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_cuentas_impuestosById($ID_cti, $ID_cue, $cti_desc, $cti_credOdeb, $cti_monto, $cti_porcentaje)

                        {
                              $sql_cuentas_impuestos = 'UPDATE cuentas_impuestos  SET ID_cue = "'.$ID_cue.'" , cti_desc = "'.$cti_desc.'" , cti_credOdeb = "'.$cti_credOdeb.'" , cti_monto = "'.$cti_monto.'" , cti_porcentaje = "'.$cti_porcentaje.'"  WHERE ID_cti='.$ID_cti.' ';
                              $result_cuentas_impuestos =mysql_query($sql_cuentas_impuestos );
                              return $result_cuentas_impuestos;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_cuentas_impuestosById($ID_cti)
                        {
                              $sql_cuentas_impuestos = 'DELETE FROM cuentas_impuestos  WHERE ID_cti='.$ID_cti.' ' ; 
                              $result_cuentas_impuestos =mysql_query($sql_cuentas_impuestos);
                              return $result_cuentas_impuestos;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class cuentas_movimientos
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_cuentas_movimientos()
                        {
                              $sql_cuentas_movimientos = 'SELECT * FROM cuentas_movimientos ';
                              $result_cuentas_movimientos =mysql_query($sql_cuentas_movimientos);
                              return $result_cuentas_movimientos;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_cuentas_movimientosById($ID_mcs)
                        {
                              $sql_cuentas_movimientos = 'SELECT * FROM cuentas_movimientos  WHERE ID_mcs='.$ID_mcs.' ' ; 
                              $result_cuentas_movimientos =mysql_query($sql_cuentas_movimientos);
                              return $result_cuentas_movimientos;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_cuentas_movimientos($mcs_movimiento, $mcs_debito, $mcs_credito, $ID_cue, $mcd_fec, $mcs_desc, $mdc_fecDisponibilidad)
                        {
                              $sql_cuentas_movimientos = 'INSERT INTO cuentas_movimientos (mcs_movimiento, mcs_debito, mcs_credito, ID_cue, mcd_fec, mcs_desc, mdc_fecDisponibilidad) VALUES ("'.$mcs_movimiento.'", "'.$mcs_debito.'", "'.$mcs_credito.'", "'.$ID_cue.'", "'.$mcd_fec.'", "'.$mcs_desc.'", "'.$mdc_fecDisponibilidad.'")'; 
                              $result_cuentas_movimientos =mysql_query($sql_cuentas_movimientos );
                              return $result_cuentas_movimientos;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_cuentas_movimientosById($ID_mcs, $mcs_movimiento, $mcs_debito, $mcs_credito, $ID_cue, $mcd_fec, $mcs_desc, $mdc_fecDisponibilidad)

                        {
                              $sql_cuentas_movimientos = 'UPDATE cuentas_movimientos  SET mcs_movimiento = "'.$mcs_movimiento.'" , mcs_debito = "'.$mcs_debito.'" , mcs_credito = "'.$mcs_credito.'" , ID_cue = "'.$ID_cue.'" , mcd_fec = "'.$mcd_fec.'" , mcs_desc = "'.$mcs_desc.'" , mdc_fecDisponibilidad = "'.$mdc_fecDisponibilidad.'"  WHERE ID_mcs='.$ID_mcs.' ';
                              $result_cuentas_movimientos =mysql_query($sql_cuentas_movimientos );
                              return $result_cuentas_movimientos;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_cuentas_movimientosById($ID_mcs)
                        {
                              $sql_cuentas_movimientos = 'DELETE FROM cuentas_movimientos  WHERE ID_mcs='.$ID_mcs.' ' ; 
                              $result_cuentas_movimientos =mysql_query($sql_cuentas_movimientos);
                              return $result_cuentas_movimientos;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class cuentas_tipo
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_cuentas_tipo()
                        {
                              $sql_cuentas_tipo = 'SELECT * FROM cuentas_tipo ';
                              $result_cuentas_tipo =mysql_query($sql_cuentas_tipo);
                              return $result_cuentas_tipo;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_cuentas_tipoById($ID_ctp)
                        {
                              $sql_cuentas_tipo = 'SELECT * FROM cuentas_tipo  WHERE ID_ctp='.$ID_ctp.' ' ; 
                              $result_cuentas_tipo =mysql_query($sql_cuentas_tipo);
                              return $result_cuentas_tipo;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_cuentas_tipo($ctp_desc)
                        {
                              $sql_cuentas_tipo = 'INSERT INTO cuentas_tipo (ctp_desc) VALUES ("'.$ctp_desc.'")'; 
                              $result_cuentas_tipo =mysql_query($sql_cuentas_tipo );
                              return $result_cuentas_tipo;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_cuentas_tipoById($ID_ctp, $ctp_desc)

                        {
                              $sql_cuentas_tipo = 'UPDATE cuentas_tipo  SET ctp_desc = "'.$ctp_desc.'"  WHERE ID_ctp='.$ID_ctp.' ';
                              $result_cuentas_tipo =mysql_query($sql_cuentas_tipo );
                              return $result_cuentas_tipo;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_cuentas_tipoById($ID_ctp)
                        {
                              $sql_cuentas_tipo = 'DELETE FROM cuentas_tipo  WHERE ID_ctp='.$ID_ctp.' ' ; 
                              $result_cuentas_tipo =mysql_query($sql_cuentas_tipo);
                              return $result_cuentas_tipo;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class depositos_bancarios
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_depositos_bancarios()
                        {
                              $sql_depositos_bancarios = 'SELECT * FROM depositos_bancarios ';
                              $result_depositos_bancarios =mysql_query($sql_depositos_bancarios);
                              return $result_depositos_bancarios;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_depositos_bancariosById($ID_dba)
                        {
                              $sql_depositos_bancarios = 'SELECT * FROM depositos_bancarios  WHERE ID_dba='.$ID_dba.' ' ; 
                              $result_depositos_bancarios =mysql_query($sql_depositos_bancarios);
                              return $result_depositos_bancarios;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_depositos_bancarios($dba_num, $dba_fecdep, $dba_fecacr, $dba_efectivo, $ID_che)
                        {
                              $sql_depositos_bancarios = 'INSERT INTO depositos_bancarios (dba_num, dba_fecdep, dba_fecacr, dba_efectivo, ID_che) VALUES ("'.$dba_num.'", "'.$dba_fecdep.'", "'.$dba_fecacr.'", "'.$dba_efectivo.'", "'.$ID_che.'")'; 
                              $result_depositos_bancarios =mysql_query($sql_depositos_bancarios );
                              return $result_depositos_bancarios;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_depositos_bancariosById($ID_dba, $dba_num, $dba_fecdep, $dba_fecacr, $dba_efectivo, $ID_che)

                        {
                              $sql_depositos_bancarios = 'UPDATE depositos_bancarios  SET dba_num = "'.$dba_num.'" , dba_fecdep = "'.$dba_fecdep.'" , dba_fecacr = "'.$dba_fecacr.'" , dba_efectivo = "'.$dba_efectivo.'" , ID_che = "'.$ID_che.'"  WHERE ID_dba='.$ID_dba.' ';
                              $result_depositos_bancarios =mysql_query($sql_depositos_bancarios );
                              return $result_depositos_bancarios;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_depositos_bancariosById($ID_dba)
                        {
                              $sql_depositos_bancarios = 'DELETE FROM depositos_bancarios  WHERE ID_dba='.$ID_dba.' ' ; 
                              $result_depositos_bancarios =mysql_query($sql_depositos_bancarios);
                              return $result_depositos_bancarios;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class detalle_comprobantes
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_detalle_comprobantes()
                        {
                              $sql_detalle_comprobantes = 'SELECT * FROM detalle_comprobantes ';
                              $result_detalle_comprobantes =mysql_query($sql_detalle_comprobantes);
                              return $result_detalle_comprobantes;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_detalle_comprobantesById($ID_dte)
                        {
                              $sql_detalle_comprobantes = 'SELECT * FROM detalle_comprobantes  WHERE ID_dte='.$ID_dte.' ' ; 
                              $result_detalle_comprobantes =mysql_query($sql_detalle_comprobantes);
                              return $result_detalle_comprobantes;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_detalle_comprobantes($ID_tce, $ID_art, $dte_cantidad, $dte_monto, $dte_iva, $dte_metrica, $dte_descuento, $ID_suc)
                        {
                              $sql_detalle_comprobantes = 'INSERT INTO detalle_comprobantes (ID_tce, ID_art, dte_cantidad, dte_monto, dte_iva, dte_metrica, dte_descuento, ID_suc) VALUES ("'.$ID_tce.'", "'.$ID_art.'", "'.$dte_cantidad.'", "'.$dte_monto.'", "'.$dte_iva.'", "'.$dte_metrica.'", "'.$dte_descuento.'", "'.$ID_suc.'")'; 
                              $result_detalle_comprobantes =mysql_query($sql_detalle_comprobantes );
                              return $result_detalle_comprobantes;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_detalle_comprobantesById($ID_dte, $ID_tce, $ID_art, $dte_cantidad, $dte_monto, $dte_iva, $dte_metrica, $dte_descuento, $ID_suc)

                        {
                              $sql_detalle_comprobantes = 'UPDATE detalle_comprobantes  SET ID_tce = "'.$ID_tce.'" , ID_art = "'.$ID_art.'" , dte_cantidad = "'.$dte_cantidad.'" , dte_monto = "'.$dte_monto.'" , dte_iva = "'.$dte_iva.'" , dte_metrica = "'.$dte_metrica.'" , dte_descuento = "'.$dte_descuento.'" , ID_suc = "'.$ID_suc.'"  WHERE ID_dte='.$ID_dte.' ';
                              $result_detalle_comprobantes =mysql_query($sql_detalle_comprobantes );
                              return $result_detalle_comprobantes;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_detalle_comprobantesById($ID_dte)
                        {
                              $sql_detalle_comprobantes = 'DELETE FROM detalle_comprobantes  WHERE ID_dte='.$ID_dte.' ' ; 
                              $result_detalle_comprobantes =mysql_query($sql_detalle_comprobantes);
                              return $result_detalle_comprobantes;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class facturas_de_compras
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_facturas_de_compras()
                        {
                              $sql_facturas_de_compras = 'SELECT * FROM facturas_de_compras ';
                              $result_facturas_de_compras =mysql_query($sql_facturas_de_compras);
                              return $result_facturas_de_compras;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_facturas_de_comprasById($ID_fac)
                        {
                              $sql_facturas_de_compras = 'SELECT * FROM facturas_de_compras  WHERE ID_fac='.$ID_fac.' ' ; 
                              $result_facturas_de_compras =mysql_query($sql_facturas_de_compras);
                              return $result_facturas_de_compras;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_facturas_de_compras($ID_pro, $fac_num, $fac_serie, $fac_fecha, $fac_total)
                        {
                              $sql_facturas_de_compras = 'INSERT INTO facturas_de_compras (ID_pro, fac_num, fac_serie, fac_fecha, fac_total) VALUES ("'.$ID_pro.'", "'.$fac_num.'", "'.$fac_serie.'", "'.$fac_fecha.'", "'.$fac_total.'")'; 
                              $result_facturas_de_compras =mysql_query($sql_facturas_de_compras );
                              return $result_facturas_de_compras;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_facturas_de_comprasById($ID_fac, $ID_pro, $fac_num, $fac_serie, $fac_fecha, $fac_total)

                        {
                              $sql_facturas_de_compras = 'UPDATE facturas_de_compras  SET ID_pro = "'.$ID_pro.'" , fac_num = "'.$fac_num.'" , fac_serie = "'.$fac_serie.'" , fac_fecha = "'.$fac_fecha.'" , fac_total = "'.$fac_total.'"  WHERE ID_fac='.$ID_fac.' ';
                              $result_facturas_de_compras =mysql_query($sql_facturas_de_compras );
                              return $result_facturas_de_compras;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_facturas_de_comprasById($ID_fac)
                        {
                              $sql_facturas_de_compras = 'DELETE FROM facturas_de_compras  WHERE ID_fac='.$ID_fac.' ' ; 
                              $result_facturas_de_compras =mysql_query($sql_facturas_de_compras);
                              return $result_facturas_de_compras;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class flujo_comprobantes
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_flujo_comprobantes()
                        {
                              $sql_flujo_comprobantes = 'SELECT * FROM flujo_comprobantes ';
                              $result_flujo_comprobantes =mysql_query($sql_flujo_comprobantes);
                              return $result_flujo_comprobantes;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_flujo_comprobantesById($ID_fce)
                        {
                              $sql_flujo_comprobantes = 'SELECT * FROM flujo_comprobantes  WHERE ID_fce='.$ID_fce.' ' ; 
                              $result_flujo_comprobantes =mysql_query($sql_flujo_comprobantes);
                              return $result_flujo_comprobantes;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_flujo_comprobantes($fce_desc, $fec_caja, $fec_stock, $fce_asociacion)
                        {
                              $sql_flujo_comprobantes = 'INSERT INTO flujo_comprobantes (fce_desc, fec_caja, fec_stock, fce_asociacion) VALUES ("'.$fce_desc.'", "'.$fec_caja.'", "'.$fec_stock.'", "'.$fce_asociacion.'")'; 
                              $result_flujo_comprobantes =mysql_query($sql_flujo_comprobantes );
                              return $result_flujo_comprobantes;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_flujo_comprobantesById($ID_fce, $fce_desc, $fec_caja, $fec_stock, $fce_asociacion)

                        {
                              $sql_flujo_comprobantes = 'UPDATE flujo_comprobantes  SET fce_desc = "'.$fce_desc.'" , fec_caja = "'.$fec_caja.'" , fec_stock = "'.$fec_stock.'" , fce_asociacion = "'.$fce_asociacion.'"  WHERE ID_fce='.$ID_fce.' ';
                              $result_flujo_comprobantes =mysql_query($sql_flujo_comprobantes );
                              return $result_flujo_comprobantes;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_flujo_comprobantesById($ID_fce)
                        {
                              $sql_flujo_comprobantes = 'DELETE FROM flujo_comprobantes  WHERE ID_fce='.$ID_fce.' ' ; 
                              $result_flujo_comprobantes =mysql_query($sql_flujo_comprobantes);
                              return $result_flujo_comprobantes;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class mensajes
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_mensajes()
                        {
                              $sql_mensajes = 'SELECT * FROM mensajes ';
                              $result_mensajes =mysql_query($sql_mensajes);
                              return $result_mensajes;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_mensajesById($ID_men)
                        {
                              $sql_mensajes = 'SELECT * FROM mensajes  WHERE ID_men='.$ID_men.' ' ; 
                              $result_mensajes =mysql_query($sql_mensajes);
                              return $result_mensajes;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_mensajes($men_asunto, $men_desc, $men_categoria, $men_visto, $men_fec, $men_id_rel, $men_tabla_rel)
                        {
                              $sql_mensajes = 'INSERT INTO mensajes (men_asunto, men_desc, men_categoria, men_visto, men_fec, men_id_rel, men_tabla_rel) VALUES ("'.$men_asunto.'", "'.$men_desc.'", "'.$men_categoria.'", "'.$men_visto.'", "'.$men_fec.'", "'.$men_id_rel.'", "'.$men_tabla_rel.'")'; 
                              $result_mensajes =mysql_query($sql_mensajes );
                              return $result_mensajes;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_mensajesById($ID_men, $men_asunto, $men_desc, $men_categoria, $men_visto, $men_fec, $men_id_rel, $men_tabla_rel)

                        {
                              $sql_mensajes = 'UPDATE mensajes  SET men_asunto = "'.$men_asunto.'" , men_desc = "'.$men_desc.'" , men_categoria = "'.$men_categoria.'" , men_visto = "'.$men_visto.'" , men_fec = "'.$men_fec.'" , men_id_rel = "'.$men_id_rel.'" , men_tabla_rel = "'.$men_tabla_rel.'"  WHERE ID_men='.$ID_men.' ';
                              $result_mensajes =mysql_query($sql_mensajes );
                              return $result_mensajes;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_mensajesById($ID_men)
                        {
                              $sql_mensajes = 'DELETE FROM mensajes  WHERE ID_men='.$ID_men.' ' ; 
                              $result_mensajes =mysql_query($sql_mensajes);
                              return $result_mensajes;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class modulos
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_modulos()
                        {
                              $sql_modulos = 'SELECT * FROM modulos ';
                              $result_modulos =mysql_query($sql_modulos);
                              return $result_modulos;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_modulosById($ID_mod)
                        {
                              $sql_modulos = 'SELECT * FROM modulos  WHERE ID_mod='.$ID_mod.' ' ; 
                              $result_modulos =mysql_query($sql_modulos);
                              return $result_modulos;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_modulos($mod_desc, $mod_icono)
                        {
                              $sql_modulos = 'INSERT INTO modulos (mod_desc, mod_icono) VALUES ("'.$mod_desc.'", "'.$mod_icono.'")'; 
                              $result_modulos =mysql_query($sql_modulos );
                              return $result_modulos;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_modulosById($ID_mod, $mod_desc, $mod_icono)

                        {
                              $sql_modulos = 'UPDATE modulos  SET mod_desc = "'.$mod_desc.'" , mod_icono = "'.$mod_icono.'"  WHERE ID_mod='.$ID_mod.' ';
                              $result_modulos =mysql_query($sql_modulos );
                              return $result_modulos;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_modulosById($ID_mod)
                        {
                              $sql_modulos = 'DELETE FROM modulos  WHERE ID_mod='.$ID_mod.' ' ; 
                              $result_modulos =mysql_query($sql_modulos);
                              return $result_modulos;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class mov_caja
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_mov_caja()
                        {
                              $sql_mov_caja = 'SELECT * FROM mov_caja ';
                              $result_mov_caja =mysql_query($sql_mov_caja);
                              return $result_mov_caja;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_mov_cajaById($ID_mov)
                        {
                              $sql_mov_caja = 'SELECT * FROM mov_caja  WHERE ID_mov='.$ID_mov.' ' ; 
                              $result_mov_caja =mysql_query($sql_mov_caja);
                              return $result_mov_caja;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_mov_caja($ID_ven, $mov_hora, $ID_art, $ID_pre, $mov_cantidad, $mov_sal, $mov_descuento)
                        {
                              $sql_mov_caja = 'INSERT INTO mov_caja (ID_ven, mov_hora, ID_art, ID_pre, mov_cantidad, mov_sal, mov_descuento) VALUES ("'.$ID_ven.'", "'.$mov_hora.'", "'.$ID_art.'", "'.$ID_pre.'", "'.$mov_cantidad.'", "'.$mov_sal.'", "'.$mov_descuento.'")'; 
                              $result_mov_caja =mysql_query($sql_mov_caja );
                              return $result_mov_caja;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_mov_cajaById($ID_mov, $ID_ven, $mov_hora, $ID_art, $ID_pre, $mov_cantidad, $mov_sal, $mov_descuento)

                        {
                              $sql_mov_caja = 'UPDATE mov_caja  SET ID_ven = "'.$ID_ven.'" , mov_hora = "'.$mov_hora.'" , ID_art = "'.$ID_art.'" , ID_pre = "'.$ID_pre.'" , mov_cantidad = "'.$mov_cantidad.'" , mov_sal = "'.$mov_sal.'" , mov_descuento = "'.$mov_descuento.'"  WHERE ID_mov='.$ID_mov.' ';
                              $result_mov_caja =mysql_query($sql_mov_caja );
                              return $result_mov_caja;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_mov_cajaById($ID_mov)
                        {
                              $sql_mov_caja = 'DELETE FROM mov_caja  WHERE ID_mov='.$ID_mov.' ' ; 
                              $result_mov_caja =mysql_query($sql_mov_caja);
                              return $result_mov_caja;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class paginas
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_paginas()
                        {
                              $sql_paginas = 'SELECT * FROM paginas ';
                              $result_paginas =mysql_query($sql_paginas);
                              return $result_paginas;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_paginasById($ID_pag)
                        {
                              $sql_paginas = 'SELECT * FROM paginas  WHERE ID_pag='.$ID_pag.' ' ; 
                              $result_paginas =mysql_query($sql_paginas);
                              return $result_paginas;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_paginas($pag_desc, $ID_mod, $pag_icono, $pag_url)
                        {
                              $sql_paginas = 'INSERT INTO paginas (pag_desc, ID_mod, pag_icono, pag_url) VALUES ("'.$pag_desc.'", "'.$ID_mod.'", "'.$pag_icono.'", "'.$pag_url.'")'; 
                              $result_paginas =mysql_query($sql_paginas );
                              return $result_paginas;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_paginasById($ID_pag, $pag_desc, $ID_mod, $pag_icono, $pag_url)

                        {
                              $sql_paginas = 'UPDATE paginas  SET pag_desc = "'.$pag_desc.'" , ID_mod = "'.$ID_mod.'" , pag_icono = "'.$pag_icono.'" , pag_url = "'.$pag_url.'"  WHERE ID_pag='.$ID_pag.' ';
                              $result_paginas =mysql_query($sql_paginas );
                              return $result_paginas;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_paginasById($ID_pag)
                        {
                              $sql_paginas = 'DELETE FROM paginas  WHERE ID_pag='.$ID_pag.' ' ; 
                              $result_paginas =mysql_query($sql_paginas);
                              return $result_paginas;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class pagos_bancarios
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_pagos_bancarios()
                        {
                              $sql_pagos_bancarios = 'SELECT * FROM pagos_bancarios ';
                              $result_pagos_bancarios =mysql_query($sql_pagos_bancarios);
                              return $result_pagos_bancarios;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_pagos_bancariosById($ID_pba)
                        {
                              $sql_pagos_bancarios = 'SELECT * FROM pagos_bancarios  WHERE ID_pba='.$ID_pba.' ' ; 
                              $result_pagos_bancarios =mysql_query($sql_pagos_bancarios);
                              return $result_pagos_bancarios;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_pagos_bancarios($pba_desc, $ID_cue, $cue_imp, $cue_fecmov, $cue_fecvengamiento)
                        {
                              $sql_pagos_bancarios = 'INSERT INTO pagos_bancarios (pba_desc, ID_cue, cue_imp, cue_fecmov, cue_fecvengamiento) VALUES ("'.$pba_desc.'", "'.$ID_cue.'", "'.$cue_imp.'", "'.$cue_fecmov.'", "'.$cue_fecvengamiento.'")'; 
                              $result_pagos_bancarios =mysql_query($sql_pagos_bancarios );
                              return $result_pagos_bancarios;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_pagos_bancariosById($ID_pba, $pba_desc, $ID_cue, $cue_imp, $cue_fecmov, $cue_fecvengamiento)

                        {
                              $sql_pagos_bancarios = 'UPDATE pagos_bancarios  SET pba_desc = "'.$pba_desc.'" , ID_cue = "'.$ID_cue.'" , cue_imp = "'.$cue_imp.'" , cue_fecmov = "'.$cue_fecmov.'" , cue_fecvengamiento = "'.$cue_fecvengamiento.'"  WHERE ID_pba='.$ID_pba.' ';
                              $result_pagos_bancarios =mysql_query($sql_pagos_bancarios );
                              return $result_pagos_bancarios;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_pagos_bancariosById($ID_pba)
                        {
                              $sql_pagos_bancarios = 'DELETE FROM pagos_bancarios  WHERE ID_pba='.$ID_pba.' ' ; 
                              $result_pagos_bancarios =mysql_query($sql_pagos_bancarios);
                              return $result_pagos_bancarios;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class paramentros
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_paramentros()
                        {
                              $sql_paramentros = 'SELECT * FROM paramentros ';
                              $result_paramentros =mysql_query($sql_paramentros);
                              return $result_paramentros;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_paramentrosById($ID_par)
                        {
                              $sql_paramentros = 'SELECT * FROM paramentros  WHERE ID_par='.$ID_par.' ' ; 
                              $result_paramentros =mysql_query($sql_paramentros);
                              return $result_paramentros;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_paramentros($par_razonSocial, $par_cuil, $par_telefono, $par_direccion, $par_iva, $par_ganancia)
                        {
                              $sql_paramentros = 'INSERT INTO paramentros (par_razonSocial, par_cuil, par_telefono, par_direccion, par_iva, par_ganancia) VALUES ("'.$par_razonSocial.'", "'.$par_cuil.'", "'.$par_telefono.'", "'.$par_direccion.'", "'.$par_iva.'", "'.$par_ganancia.'")'; 
                              $result_paramentros =mysql_query($sql_paramentros );
                              return $result_paramentros;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_paramentrosById($ID_par, $par_razonSocial, $par_cuil, $par_telefono, $par_direccion, $par_iva, $par_ganancia)

                        {
                              $sql_paramentros = 'UPDATE paramentros  SET par_razonSocial = "'.$par_razonSocial.'" , par_cuil = "'.$par_cuil.'" , par_telefono = "'.$par_telefono.'" , par_direccion = "'.$par_direccion.'" , par_iva = "'.$par_iva.'" , par_ganancia = "'.$par_ganancia.'"  WHERE ID_par='.$ID_par.' ';
                              $result_paramentros =mysql_query($sql_paramentros );
                              return $result_paramentros;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_paramentrosById($ID_par)
                        {
                              $sql_paramentros = 'DELETE FROM paramentros  WHERE ID_par='.$ID_par.' ' ; 
                              $result_paramentros =mysql_query($sql_paramentros);
                              return $result_paramentros;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class periodos_fiscales
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_periodos_fiscales()
                        {
                              $sql_periodos_fiscales = 'SELECT * FROM periodos_fiscales ';
                              $result_periodos_fiscales =mysql_query($sql_periodos_fiscales);
                              return $result_periodos_fiscales;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_periodos_fiscalesById($ID_per)
                        {
                              $sql_periodos_fiscales = 'SELECT * FROM periodos_fiscales  WHERE ID_per='.$ID_per.' ' ; 
                              $result_periodos_fiscales =mysql_query($sql_periodos_fiscales);
                              return $result_periodos_fiscales;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_periodos_fiscales($per_desc, $per_fecini, $per_fecfin)
                        {
                              $sql_periodos_fiscales = 'INSERT INTO periodos_fiscales (per_desc, per_fecini, per_fecfin) VALUES ("'.$per_desc.'", "'.$per_fecini.'", "'.$per_fecfin.'")'; 
                              $result_periodos_fiscales =mysql_query($sql_periodos_fiscales );
                              return $result_periodos_fiscales;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_periodos_fiscalesById($ID_per, $per_desc, $per_fecini, $per_fecfin)

                        {
                              $sql_periodos_fiscales = 'UPDATE periodos_fiscales  SET per_desc = "'.$per_desc.'" , per_fecini = "'.$per_fecini.'" , per_fecfin = "'.$per_fecfin.'"  WHERE ID_per='.$ID_per.' ';
                              $result_periodos_fiscales =mysql_query($sql_periodos_fiscales );
                              return $result_periodos_fiscales;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_periodos_fiscalesById($ID_per)
                        {
                              $sql_periodos_fiscales = 'DELETE FROM periodos_fiscales  WHERE ID_per='.$ID_per.' ' ; 
                              $result_periodos_fiscales =mysql_query($sql_periodos_fiscales);
                              return $result_periodos_fiscales;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class permisos
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_permisos()
                        {
                              $sql_permisos = 'SELECT * FROM permisos ';
                              $result_permisos =mysql_query($sql_permisos);
                              return $result_permisos;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_permisosById($ID_per)
                        {
                              $sql_permisos = 'SELECT * FROM permisos  WHERE ID_per='.$ID_per.' ' ; 
                              $result_permisos =mysql_query($sql_permisos);
                              return $result_permisos;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_permisos($ID_usu, $ID_mod)
                        {
                              $sql_permisos = 'INSERT INTO permisos (ID_usu, ID_mod) VALUES ("'.$ID_usu.'", "'.$ID_mod.'")'; 
                              $result_permisos =mysql_query($sql_permisos );
                              return $result_permisos;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_permisosById($ID_per, $ID_usu, $ID_mod)

                        {
                              $sql_permisos = 'UPDATE permisos  SET ID_usu = "'.$ID_usu.'" , ID_mod = "'.$ID_mod.'"  WHERE ID_per='.$ID_per.' ';
                              $result_permisos =mysql_query($sql_permisos );
                              return $result_permisos;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_permisosById($ID_per)
                        {
                              $sql_permisos = 'DELETE FROM permisos  WHERE ID_per='.$ID_per.' ' ; 
                              $result_permisos =mysql_query($sql_permisos);
                              return $result_permisos;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class precios
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_precios()
                        {
                              $sql_precios = 'SELECT * FROM precios ';
                              $result_precios =mysql_query($sql_precios);
                              return $result_precios;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_preciosById($ID_pre)
                        {
                              $sql_precios = 'SELECT * FROM precios  WHERE ID_pre='.$ID_pre.' ' ; 
                              $result_precios =mysql_query($sql_precios);
                              return $result_precios;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_precios($pre_cant, $pre_iva, $pre_neto, $pre_fec, $pre_poresp, $pre_porcan)
                        {
                              $sql_precios = 'INSERT INTO precios (pre_cant, pre_iva, pre_neto, pre_fec, pre_poresp, pre_porcan) VALUES ("'.$pre_cant.'", "'.$pre_iva.'", "'.$pre_neto.'", "'.$pre_fec.'", "'.$pre_poresp.'", "'.$pre_porcan.'")'; 
                              $result_precios =mysql_query($sql_precios );
                              return $result_precios;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_preciosById($ID_pre, $pre_cant, $pre_iva, $pre_neto, $pre_fec, $pre_poresp, $pre_porcan)

                        {
                              $sql_precios = 'UPDATE precios  SET pre_cant = "'.$pre_cant.'" , pre_iva = "'.$pre_iva.'" , pre_neto = "'.$pre_neto.'" , pre_fec = "'.$pre_fec.'" , pre_poresp = "'.$pre_poresp.'" , pre_porcan = "'.$pre_porcan.'"  WHERE ID_pre='.$ID_pre.' ';
                              $result_precios =mysql_query($sql_precios );
                              return $result_precios;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_preciosById($ID_pre)
                        {
                              $sql_precios = 'DELETE FROM precios  WHERE ID_pre='.$ID_pre.' ' ; 
                              $result_precios =mysql_query($sql_precios);
                              return $result_precios;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class proveedores
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_proveedores()
                        {
                              $sql_proveedores = 'SELECT * FROM proveedores ';
                              $result_proveedores =mysql_query($sql_proveedores);
                              return $result_proveedores;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_proveedoresById($ID_pro)
                        {
                              $sql_proveedores = 'SELECT * FROM proveedores  WHERE ID_pro='.$ID_pro.' ' ; 
                              $result_proveedores =mysql_query($sql_proveedores);
                              return $result_proveedores;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_proveedores($pro_desc, $pro_tel, $pro_dir, $pro_codPostal, $pro_provincia, $pro_localidad, $pro_cuit, $pro_catIva, $pro_tipo, $pro_suss, $pro_ganancias, $pro_iibb, $pro_iva, $pro_acumPagosDelMes, $pro_retDelMes, $pro_condicionPago, $pro_nroIibb)
                        {
                              $sql_proveedores = 'INSERT INTO proveedores (pro_desc, pro_tel, pro_dir, pro_codPostal, pro_provincia, pro_localidad, pro_cuit, pro_catIva, pro_tipo, pro_suss, pro_ganancias, pro_iibb, pro_iva, pro_acumPagosDelMes, pro_retDelMes, pro_condicionPago, pro_nroIibb) VALUES ("'.$pro_desc.'", "'.$pro_tel.'", "'.$pro_dir.'", "'.$pro_codPostal.'", "'.$pro_provincia.'", "'.$pro_localidad.'", "'.$pro_cuit.'", "'.$pro_catIva.'", "'.$pro_tipo.'", "'.$pro_suss.'", "'.$pro_ganancias.'", "'.$pro_iibb.'", "'.$pro_iva.'", "'.$pro_acumPagosDelMes.'", "'.$pro_retDelMes.'", "'.$pro_condicionPago.'", "'.$pro_nroIibb.'")'; 
                              $result_proveedores =mysql_query($sql_proveedores );
                              return $result_proveedores;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_proveedoresById($ID_pro, $pro_desc, $pro_tel, $pro_dir, $pro_codPostal, $pro_provincia, $pro_localidad, $pro_cuit, $pro_catIva, $pro_tipo, $pro_suss, $pro_ganancias, $pro_iibb, $pro_iva, $pro_acumPagosDelMes, $pro_retDelMes, $pro_condicionPago, $pro_nroIibb)

                        {
                              $sql_proveedores = 'UPDATE proveedores  SET pro_desc = "'.$pro_desc.'" , pro_tel = "'.$pro_tel.'" , pro_dir = "'.$pro_dir.'" , pro_codPostal = "'.$pro_codPostal.'" , pro_provincia = "'.$pro_provincia.'" , pro_localidad = "'.$pro_localidad.'" , pro_cuit = "'.$pro_cuit.'" , pro_catIva = "'.$pro_catIva.'" , pro_tipo = "'.$pro_tipo.'" , pro_suss = "'.$pro_suss.'" , pro_ganancias = "'.$pro_ganancias.'" , pro_iibb = "'.$pro_iibb.'" , pro_iva = "'.$pro_iva.'" , pro_acumPagosDelMes = "'.$pro_acumPagosDelMes.'" , pro_retDelMes = "'.$pro_retDelMes.'" , pro_condicionPago = "'.$pro_condicionPago.'" , pro_nroIibb = "'.$pro_nroIibb.'"  WHERE ID_pro='.$ID_pro.' ';
                              $result_proveedores =mysql_query($sql_proveedores );
                              return $result_proveedores;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_proveedoresById($ID_pro)
                        {
                              $sql_proveedores = 'DELETE FROM proveedores  WHERE ID_pro='.$ID_pro.' ' ; 
                              $result_proveedores =mysql_query($sql_proveedores);
                              return $result_proveedores;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class puestos
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_puestos()
                        {
                              $sql_puestos = 'SELECT * FROM puestos ';
                              $result_puestos =mysql_query($sql_puestos);
                              return $result_puestos;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_puestosById($ID_pue)
                        {
                              $sql_puestos = 'SELECT * FROM puestos  WHERE ID_pue='.$ID_pue.' ' ; 
                              $result_puestos =mysql_query($sql_puestos);
                              return $result_puestos;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_puestos($ID_suc, $pue_desc, $ID_pdv, $ID_cue)
                        {
                              $sql_puestos = 'INSERT INTO puestos (ID_suc, pue_desc, ID_pdv, ID_cue) VALUES ("'.$ID_suc.'", "'.$pue_desc.'", "'.$ID_pdv.'", "'.$ID_cue.'")'; 
                              $result_puestos =mysql_query($sql_puestos );
                              return $result_puestos;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_puestosById($ID_pue, $ID_suc, $pue_desc, $ID_pdv, $ID_cue)

                        {
                              $sql_puestos = 'UPDATE puestos  SET ID_suc = "'.$ID_suc.'" , pue_desc = "'.$pue_desc.'" , ID_pdv = "'.$ID_pdv.'" , ID_cue = "'.$ID_cue.'"  WHERE ID_pue='.$ID_pue.' ';
                              $result_puestos =mysql_query($sql_puestos );
                              return $result_puestos;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_puestosById($ID_pue)
                        {
                              $sql_puestos = 'DELETE FROM puestos  WHERE ID_pue='.$ID_pue.' ' ; 
                              $result_puestos =mysql_query($sql_puestos);
                              return $result_puestos;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class puntos_de_ventas
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_puntos_de_ventas()
                        {
                              $sql_puntos_de_ventas = 'SELECT * FROM puntos_de_ventas ';
                              $result_puntos_de_ventas =mysql_query($sql_puntos_de_ventas);
                              return $result_puntos_de_ventas;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_puntos_de_ventasById($ID_pdv)
                        {
                              $sql_puntos_de_ventas = 'SELECT * FROM puntos_de_ventas  WHERE ID_pdv='.$ID_pdv.' ' ; 
                              $result_puntos_de_ventas =mysql_query($sql_puntos_de_ventas);
                              return $result_puntos_de_ventas;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_puntos_de_ventas($pdv_numeracion, $pdv_puntoVenta, $pdv_cai, $pdv_fecVencimiento, $ID_tce)
                        {
                              $sql_puntos_de_ventas = 'INSERT INTO puntos_de_ventas (pdv_numeracion, pdv_puntoVenta, pdv_cai, pdv_fecVencimiento, ID_tce) VALUES ("'.$pdv_numeracion.'", "'.$pdv_puntoVenta.'", "'.$pdv_cai.'", "'.$pdv_fecVencimiento.'", "'.$ID_tce.'")'; 
                              $result_puntos_de_ventas =mysql_query($sql_puntos_de_ventas );
                              return $result_puntos_de_ventas;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_puntos_de_ventasById($ID_pdv, $pdv_numeracion, $pdv_puntoVenta, $pdv_cai, $pdv_fecVencimiento, $ID_tce)

                        {
                              $sql_puntos_de_ventas = 'UPDATE puntos_de_ventas  SET pdv_numeracion = "'.$pdv_numeracion.'" , pdv_puntoVenta = "'.$pdv_puntoVenta.'" , pdv_cai = "'.$pdv_cai.'" , pdv_fecVencimiento = "'.$pdv_fecVencimiento.'" , ID_tce = "'.$ID_tce.'"  WHERE ID_pdv='.$ID_pdv.' ';
                              $result_puntos_de_ventas =mysql_query($sql_puntos_de_ventas );
                              return $result_puntos_de_ventas;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_puntos_de_ventasById($ID_pdv)
                        {
                              $sql_puntos_de_ventas = 'DELETE FROM puntos_de_ventas  WHERE ID_pdv='.$ID_pdv.' ' ; 
                              $result_puntos_de_ventas =mysql_query($sql_puntos_de_ventas);
                              return $result_puntos_de_ventas;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class stock
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_stock()
                        {
                              $sql_stock = 'SELECT * FROM stock ';
                              $result_stock =mysql_query($sql_stock);
                              return $result_stock;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_stockById($ID_sto)
                        {
                              $sql_stock = 'SELECT * FROM stock  WHERE ID_sto='.$ID_sto.' ' ; 
                              $result_stock =mysql_query($sql_stock);
                              return $result_stock;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_stock($sto_mov, $ID_art, $sto_desc, $sto_fec, $ID_suc, $ID_usu, $sto_cant, $sto_total)
                        {
                              $sql_stock = 'INSERT INTO stock (sto_mov, ID_art, sto_desc, sto_fec, ID_suc, ID_usu, sto_cant, sto_total) VALUES ("'.$sto_mov.'", "'.$ID_art.'", "'.$sto_desc.'", "'.$sto_fec.'", "'.$ID_suc.'", "'.$ID_usu.'", "'.$sto_cant.'", "'.$sto_total.'")'; 
                              $result_stock =mysql_query($sql_stock );
                              return $result_stock;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_stockById($ID_sto, $sto_mov, $ID_art, $sto_desc, $sto_fec, $ID_suc, $ID_usu, $sto_cant, $sto_total)

                        {
                              $sql_stock = 'UPDATE stock  SET sto_mov = "'.$sto_mov.'" , ID_art = "'.$ID_art.'" , sto_desc = "'.$sto_desc.'" , sto_fec = "'.$sto_fec.'" , ID_suc = "'.$ID_suc.'" , ID_usu = "'.$ID_usu.'" , sto_cant = "'.$sto_cant.'" , sto_total = "'.$sto_total.'"  WHERE ID_sto='.$ID_sto.' ';
                              $result_stock =mysql_query($sql_stock );
                              return $result_stock;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_stockById($ID_sto)
                        {
                              $sql_stock = 'DELETE FROM stock  WHERE ID_sto='.$ID_sto.' ' ; 
                              $result_stock =mysql_query($sql_stock);
                              return $result_stock;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class sub_categorias
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_sub_categorias()
                        {
                              $sql_sub_categorias = 'SELECT * FROM sub_categorias ';
                              $result_sub_categorias =mysql_query($sql_sub_categorias);
                              return $result_sub_categorias;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_sub_categoriasById($ID_sub)
                        {
                              $sql_sub_categorias = 'SELECT * FROM sub_categorias  WHERE ID_sub='.$ID_sub.' ' ; 
                              $result_sub_categorias =mysql_query($sql_sub_categorias);
                              return $result_sub_categorias;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_sub_categorias($ID_cat, $sub_desc)
                        {
                              $sql_sub_categorias = 'INSERT INTO sub_categorias (ID_cat, sub_desc) VALUES ("'.$ID_cat.'", "'.$sub_desc.'")'; 
                              $result_sub_categorias =mysql_query($sql_sub_categorias );
                              return $result_sub_categorias;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_sub_categoriasById($ID_sub, $ID_cat, $sub_desc)

                        {
                              $sql_sub_categorias = 'UPDATE sub_categorias  SET ID_cat = "'.$ID_cat.'" , sub_desc = "'.$sub_desc.'"  WHERE ID_sub='.$ID_sub.' ';
                              $result_sub_categorias =mysql_query($sql_sub_categorias );
                              return $result_sub_categorias;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_sub_categoriasById($ID_sub)
                        {
                              $sql_sub_categorias = 'DELETE FROM sub_categorias  WHERE ID_sub='.$ID_sub.' ' ; 
                              $result_sub_categorias =mysql_query($sql_sub_categorias);
                              return $result_sub_categorias;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class sucursales
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_sucursales()
                        {
                              $sql_sucursales = 'SELECT * FROM sucursales ';
                              $result_sucursales =mysql_query($sql_sucursales);
                              return $result_sucursales;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_sucursalesById($ID_suc)
                        {
                              $sql_sucursales = 'SELECT * FROM sucursales  WHERE ID_suc='.$ID_suc.' ' ; 
                              $result_sucursales =mysql_query($sql_sucursales);
                              return $result_sucursales;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_sucursales($suc_desc, $suc_dir, $suc_tel, $suc_color, $suc_icono, $suc_url)
                        {
                              $sql_sucursales = 'INSERT INTO sucursales (suc_desc, suc_dir, suc_tel, suc_color, suc_icono, suc_url) VALUES ("'.$suc_desc.'", "'.$suc_dir.'", "'.$suc_tel.'", "'.$suc_color.'", "'.$suc_icono.'", "'.$suc_url.'")'; 
                              $result_sucursales =mysql_query($sql_sucursales );
                              return $result_sucursales;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_sucursalesById($ID_suc, $suc_desc, $suc_dir, $suc_tel, $suc_color, $suc_icono, $suc_url)

                        {
                              $sql_sucursales = 'UPDATE sucursales  SET suc_desc = "'.$suc_desc.'" , suc_dir = "'.$suc_dir.'" , suc_tel = "'.$suc_tel.'" , suc_color = "'.$suc_color.'" , suc_icono = "'.$suc_icono.'" , suc_url = "'.$suc_url.'"  WHERE ID_suc='.$ID_suc.' ';
                              $result_sucursales =mysql_query($sql_sucursales );
                              return $result_sucursales;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_sucursalesById($ID_suc)
                        {
                              $sql_sucursales = 'DELETE FROM sucursales  WHERE ID_suc='.$ID_suc.' ' ; 
                              $result_sucursales =mysql_query($sql_sucursales);
                              return $result_sucursales;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class tarjetas
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_tarjetas()
                        {
                              $sql_tarjetas = 'SELECT * FROM tarjetas ';
                              $result_tarjetas =mysql_query($sql_tarjetas);
                              return $result_tarjetas;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_tarjetasById($ID_tar)
                        {
                              $sql_tarjetas = 'SELECT * FROM tarjetas  WHERE ID_tar='.$ID_tar.' ' ; 
                              $result_tarjetas =mysql_query($sql_tarjetas);
                              return $result_tarjetas;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_tarjetas($tar_desc, $tar_cue, $tar_logo, $tar_tipo)
                        {
                              $sql_tarjetas = 'INSERT INTO tarjetas (tar_desc, tar_cue, tar_logo, tar_tipo) VALUES ("'.$tar_desc.'", "'.$tar_cue.'", "'.$tar_logo.'", "'.$tar_tipo.'")'; 
                              $result_tarjetas =mysql_query($sql_tarjetas );
                              return $result_tarjetas;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_tarjetasById($ID_tar, $tar_desc, $tar_cue, $tar_logo, $tar_tipo)

                        {
                              $sql_tarjetas = 'UPDATE tarjetas  SET tar_desc = "'.$tar_desc.'" , tar_cue = "'.$tar_cue.'" , tar_logo = "'.$tar_logo.'" , tar_tipo = "'.$tar_tipo.'"  WHERE ID_tar='.$ID_tar.' ';
                              $result_tarjetas =mysql_query($sql_tarjetas );
                              return $result_tarjetas;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_tarjetasById($ID_tar)
                        {
                              $sql_tarjetas = 'DELETE FROM tarjetas  WHERE ID_tar='.$ID_tar.' ' ; 
                              $result_tarjetas =mysql_query($sql_tarjetas);
                              return $result_tarjetas;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class tarjetas_acreditaciones
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_tarjetas_acreditaciones()
                        {
                              $sql_tarjetas_acreditaciones = 'SELECT * FROM tarjetas_acreditaciones ';
                              $result_tarjetas_acreditaciones =mysql_query($sql_tarjetas_acreditaciones);
                              return $result_tarjetas_acreditaciones;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_tarjetas_acreditacionesById($ID_acr)
                        {
                              $sql_tarjetas_acreditaciones = 'SELECT * FROM tarjetas_acreditaciones  WHERE ID_acr='.$ID_acr.' ' ; 
                              $result_tarjetas_acreditaciones =mysql_query($sql_tarjetas_acreditaciones);
                              return $result_tarjetas_acreditaciones;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_tarjetas_acreditaciones($acr_fec, $ID_lot, $lote_neto)
                        {
                              $sql_tarjetas_acreditaciones = 'INSERT INTO tarjetas_acreditaciones (acr_fec, ID_lot, lote_neto) VALUES ("'.$acr_fec.'", "'.$ID_lot.'", "'.$lote_neto.'")'; 
                              $result_tarjetas_acreditaciones =mysql_query($sql_tarjetas_acreditaciones );
                              return $result_tarjetas_acreditaciones;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_tarjetas_acreditacionesById($ID_acr, $acr_fec, $ID_lot, $lote_neto)

                        {
                              $sql_tarjetas_acreditaciones = 'UPDATE tarjetas_acreditaciones  SET acr_fec = "'.$acr_fec.'" , ID_lot = "'.$ID_lot.'" , lote_neto = "'.$lote_neto.'"  WHERE ID_acr='.$ID_acr.' ';
                              $result_tarjetas_acreditaciones =mysql_query($sql_tarjetas_acreditaciones );
                              return $result_tarjetas_acreditaciones;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_tarjetas_acreditacionesById($ID_acr)
                        {
                              $sql_tarjetas_acreditaciones = 'DELETE FROM tarjetas_acreditaciones  WHERE ID_acr='.$ID_acr.' ' ; 
                              $result_tarjetas_acreditaciones =mysql_query($sql_tarjetas_acreditaciones);
                              return $result_tarjetas_acreditaciones;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class tarjetas_lotes
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_tarjetas_lotes()
                        {
                              $sql_tarjetas_lotes = 'SELECT * FROM tarjetas_lotes ';
                              $result_tarjetas_lotes =mysql_query($sql_tarjetas_lotes);
                              return $result_tarjetas_lotes;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_tarjetas_lotesById($ID_lot)
                        {
                              $sql_tarjetas_lotes = 'SELECT * FROM tarjetas_lotes  WHERE ID_lot='.$ID_lot.' ' ; 
                              $result_tarjetas_lotes =mysql_query($sql_tarjetas_lotes);
                              return $result_tarjetas_lotes;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_tarjetas_lotes($lot_fec, $lot_hor, $lot_total)
                        {
                              $sql_tarjetas_lotes = 'INSERT INTO tarjetas_lotes (lot_fec, lot_hor, lot_total) VALUES ("'.$lot_fec.'", "'.$lot_hor.'", "'.$lot_total.'")'; 
                              $result_tarjetas_lotes =mysql_query($sql_tarjetas_lotes );
                              return $result_tarjetas_lotes;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_tarjetas_lotesById($ID_lot, $lot_fec, $lot_hor, $lot_total)

                        {
                              $sql_tarjetas_lotes = 'UPDATE tarjetas_lotes  SET lot_fec = "'.$lot_fec.'" , lot_hor = "'.$lot_hor.'" , lot_total = "'.$lot_total.'"  WHERE ID_lot='.$ID_lot.' ';
                              $result_tarjetas_lotes =mysql_query($sql_tarjetas_lotes );
                              return $result_tarjetas_lotes;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_tarjetas_lotesById($ID_lot)
                        {
                              $sql_tarjetas_lotes = 'DELETE FROM tarjetas_lotes  WHERE ID_lot='.$ID_lot.' ' ; 
                              $result_tarjetas_lotes =mysql_query($sql_tarjetas_lotes);
                              return $result_tarjetas_lotes;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class tarjetas_planes
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_tarjetas_planes()
                        {
                              $sql_tarjetas_planes = 'SELECT * FROM tarjetas_planes ';
                              $result_tarjetas_planes =mysql_query($sql_tarjetas_planes);
                              return $result_tarjetas_planes;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_tarjetas_planesById($ID_pla)
                        {
                              $sql_tarjetas_planes = 'SELECT * FROM tarjetas_planes  WHERE ID_pla='.$ID_pla.' ' ; 
                              $result_tarjetas_planes =mysql_query($sql_tarjetas_planes);
                              return $result_tarjetas_planes;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_tarjetas_planes($pla_desc, $pla_cant, $ID_tar, $plan_tiempoAcre, $ID_fpo, $pla_recargo)
                        {
                              $sql_tarjetas_planes = 'INSERT INTO tarjetas_planes (pla_desc, pla_cant, ID_tar, plan_tiempoAcre, ID_fpo, pla_recargo) VALUES ("'.$pla_desc.'", "'.$pla_cant.'", "'.$ID_tar.'", "'.$plan_tiempoAcre.'", "'.$ID_fpo.'", "'.$pla_recargo.'")'; 
                              $result_tarjetas_planes =mysql_query($sql_tarjetas_planes );
                              return $result_tarjetas_planes;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_tarjetas_planesById($ID_pla, $pla_desc, $pla_cant, $ID_tar, $plan_tiempoAcre, $ID_fpo, $pla_recargo)

                        {
                              $sql_tarjetas_planes = 'UPDATE tarjetas_planes  SET pla_desc = "'.$pla_desc.'" , pla_cant = "'.$pla_cant.'" , ID_tar = "'.$ID_tar.'" , plan_tiempoAcre = "'.$plan_tiempoAcre.'" , ID_fpo = "'.$ID_fpo.'" , pla_recargo = "'.$pla_recargo.'"  WHERE ID_pla='.$ID_pla.' ';
                              $result_tarjetas_planes =mysql_query($sql_tarjetas_planes );
                              return $result_tarjetas_planes;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_tarjetas_planesById($ID_pla)
                        {
                              $sql_tarjetas_planes = 'DELETE FROM tarjetas_planes  WHERE ID_pla='.$ID_pla.' ' ; 
                              $result_tarjetas_planes =mysql_query($sql_tarjetas_planes);
                              return $result_tarjetas_planes;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class tesoreria
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_tesoreria()
                        {
                              $sql_tesoreria = 'SELECT * FROM tesoreria ';
                              $result_tesoreria =mysql_query($sql_tesoreria);
                              return $result_tesoreria;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_tesoreriaById($ID_tes)
                        {
                              $sql_tesoreria = 'SELECT * FROM tesoreria  WHERE ID_tes='.$ID_tes.' ' ; 
                              $result_tesoreria =mysql_query($sql_tesoreria);
                              return $result_tesoreria;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_tesoreria($tes_debe, $tes_haber)
                        {
                              $sql_tesoreria = 'INSERT INTO tesoreria (tes_debe, tes_haber) VALUES ("'.$tes_debe.'", "'.$tes_haber.'")'; 
                              $result_tesoreria =mysql_query($sql_tesoreria );
                              return $result_tesoreria;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_tesoreriaById($ID_tes, $tes_debe, $tes_haber)

                        {
                              $sql_tesoreria = 'UPDATE tesoreria  SET tes_debe = "'.$tes_debe.'" , tes_haber = "'.$tes_haber.'"  WHERE ID_tes='.$ID_tes.' ';
                              $result_tesoreria =mysql_query($sql_tesoreria );
                              return $result_tesoreria;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_tesoreriaById($ID_tes)
                        {
                              $sql_tesoreria = 'DELETE FROM tesoreria  WHERE ID_tes='.$ID_tes.' ' ; 
                              $result_tesoreria =mysql_query($sql_tesoreria);
                              return $result_tesoreria;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class tipo_comprobantes
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_tipo_comprobantes()
                        {
                              $sql_tipo_comprobantes = 'SELECT * FROM tipo_comprobantes ';
                              $result_tipo_comprobantes =mysql_query($sql_tipo_comprobantes);
                              return $result_tipo_comprobantes;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_tipo_comprobantesById($ID_tce)
                        {
                              $sql_tipo_comprobantes = 'SELECT * FROM tipo_comprobantes  WHERE ID_tce='.$ID_tce.' ' ; 
                              $result_tipo_comprobantes =mysql_query($sql_tipo_comprobantes);
                              return $result_tipo_comprobantes;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_tipo_comprobantes($ID_fce, $tce_desc, $tce_movcaja, $tce_movstock, $tce_predecesor, $tce_fuerzaPredecesor, $tce_numeracionAutomatica, $tce_detalleArticulos, $tce_letra)
                        {
                              $sql_tipo_comprobantes = 'INSERT INTO tipo_comprobantes (ID_fce, tce_desc, tce_movcaja, tce_movstock, tce_predecesor, tce_fuerzaPredecesor, tce_numeracionAutomatica, tce_detalleArticulos, tce_letra) VALUES ("'.$ID_fce.'", "'.$tce_desc.'", "'.$tce_movcaja.'", "'.$tce_movstock.'", "'.$tce_predecesor.'", "'.$tce_fuerzaPredecesor.'", "'.$tce_numeracionAutomatica.'", "'.$tce_detalleArticulos.'", "'.$tce_letra.'")'; 
                              $result_tipo_comprobantes =mysql_query($sql_tipo_comprobantes );
                              return $result_tipo_comprobantes;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_tipo_comprobantesById($ID_tce, $ID_fce, $tce_desc, $tce_movcaja, $tce_movstock, $tce_predecesor, $tce_fuerzaPredecesor, $tce_numeracionAutomatica, $tce_detalleArticulos, $tce_letra)

                        {
                              $sql_tipo_comprobantes = 'UPDATE tipo_comprobantes  SET ID_fce = "'.$ID_fce.'" , tce_desc = "'.$tce_desc.'" , tce_movcaja = "'.$tce_movcaja.'" , tce_movstock = "'.$tce_movstock.'" , tce_predecesor = "'.$tce_predecesor.'" , tce_fuerzaPredecesor = "'.$tce_fuerzaPredecesor.'" , tce_numeracionAutomatica = "'.$tce_numeracionAutomatica.'" , tce_detalleArticulos = "'.$tce_detalleArticulos.'" , tce_letra = "'.$tce_letra.'"  WHERE ID_tce='.$ID_tce.' ';
                              $result_tipo_comprobantes =mysql_query($sql_tipo_comprobantes );
                              return $result_tipo_comprobantes;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_tipo_comprobantesById($ID_tce)
                        {
                              $sql_tipo_comprobantes = 'DELETE FROM tipo_comprobantes  WHERE ID_tce='.$ID_tce.' ' ; 
                              $result_tipo_comprobantes =mysql_query($sql_tipo_comprobantes);
                              return $result_tipo_comprobantes;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class tipo_operacion
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_tipo_operacion()
                        {
                              $sql_tipo_operacion = 'SELECT * FROM tipo_operacion ';
                              $result_tipo_operacion =mysql_query($sql_tipo_operacion);
                              return $result_tipo_operacion;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_tipo_operacionById($ID_top)
                        {
                              $sql_tipo_operacion = 'SELECT * FROM tipo_operacion  WHERE ID_top='.$ID_top.' ' ; 
                              $result_tipo_operacion =mysql_query($sql_tipo_operacion);
                              return $result_tipo_operacion;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_tipo_operacion($top_desc)
                        {
                              $sql_tipo_operacion = 'INSERT INTO tipo_operacion (top_desc) VALUES ("'.$top_desc.'")'; 
                              $result_tipo_operacion =mysql_query($sql_tipo_operacion );
                              return $result_tipo_operacion;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_tipo_operacionById($ID_top, $top_desc)

                        {
                              $sql_tipo_operacion = 'UPDATE tipo_operacion  SET top_desc = "'.$top_desc.'"  WHERE ID_top='.$ID_top.' ';
                              $result_tipo_operacion =mysql_query($sql_tipo_operacion );
                              return $result_tipo_operacion;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_tipo_operacionById($ID_top)
                        {
                              $sql_tipo_operacion = 'DELETE FROM tipo_operacion  WHERE ID_top='.$ID_top.' ' ; 
                              $result_tipo_operacion =mysql_query($sql_tipo_operacion);
                              return $result_tipo_operacion;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class tipos_pagos
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_tipos_pagos()
                        {
                              $sql_tipos_pagos = 'SELECT * FROM tipos_pagos ';
                              $result_tipos_pagos =mysql_query($sql_tipos_pagos);
                              return $result_tipos_pagos;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_tipos_pagosById($ID_fpo)
                        {
                              $sql_tipos_pagos = 'SELECT * FROM tipos_pagos  WHERE ID_fpo='.$ID_fpo.' ' ; 
                              $result_tipos_pagos =mysql_query($sql_tipos_pagos);
                              return $result_tipos_pagos;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_tipos_pagos($ID_desc, $fpo_icono, $fpo_selected)
                        {
                              $sql_tipos_pagos = 'INSERT INTO tipos_pagos (ID_desc, fpo_icono, fpo_selected) VALUES ("'.$ID_desc.'", "'.$fpo_icono.'", "'.$fpo_selected.'")'; 
                              $result_tipos_pagos =mysql_query($sql_tipos_pagos );
                              return $result_tipos_pagos;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_tipos_pagosById($ID_fpo, $ID_desc, $fpo_icono, $fpo_selected)

                        {
                              $sql_tipos_pagos = 'UPDATE tipos_pagos  SET ID_desc = "'.$ID_desc.'" , fpo_icono = "'.$fpo_icono.'" , fpo_selected = "'.$fpo_selected.'"  WHERE ID_fpo='.$ID_fpo.' ';
                              $result_tipos_pagos =mysql_query($sql_tipos_pagos );
                              return $result_tipos_pagos;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_tipos_pagosById($ID_fpo)
                        {
                              $sql_tipos_pagos = 'DELETE FROM tipos_pagos  WHERE ID_fpo='.$ID_fpo.' ' ; 
                              $result_tipos_pagos =mysql_query($sql_tipos_pagos);
                              return $result_tipos_pagos;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class transferencias
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_transferencias()
                        {
                              $sql_transferencias = 'SELECT * FROM transferencias ';
                              $result_transferencias =mysql_query($sql_transferencias);
                              return $result_transferencias;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_transferenciasById($ID_tra)
                        {
                              $sql_transferencias = 'SELECT * FROM transferencias  WHERE ID_tra='.$ID_tra.' ' ; 
                              $result_transferencias =mysql_query($sql_transferencias);
                              return $result_transferencias;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_transferencias($tra_fec, $ID_banA, $ID_banB, $ID_odp, $tra_num)
                        {
                              $sql_transferencias = 'INSERT INTO transferencias (tra_fec, ID_banA, ID_banB, ID_odp, tra_num) VALUES ("'.$tra_fec.'", "'.$ID_banA.'", "'.$ID_banB.'", "'.$ID_odp.'", "'.$tra_num.'")'; 
                              $result_transferencias =mysql_query($sql_transferencias );
                              return $result_transferencias;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_transferenciasById($ID_tra, $tra_fec, $ID_banA, $ID_banB, $ID_odp, $tra_num)

                        {
                              $sql_transferencias = 'UPDATE transferencias  SET tra_fec = "'.$tra_fec.'" , ID_banA = "'.$ID_banA.'" , ID_banB = "'.$ID_banB.'" , ID_odp = "'.$ID_odp.'" , tra_num = "'.$tra_num.'"  WHERE ID_tra='.$ID_tra.' ';
                              $result_transferencias =mysql_query($sql_transferencias );
                              return $result_transferencias;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_transferenciasById($ID_tra)
                        {
                              $sql_transferencias = 'DELETE FROM transferencias  WHERE ID_tra='.$ID_tra.' ' ; 
                              $result_transferencias =mysql_query($sql_transferencias);
                              return $result_transferencias;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class usuarios
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_usuarios()
                        {
                              $sql_usuarios = 'SELECT * FROM usuarios ';
                              $result_usuarios =mysql_query($sql_usuarios);
                              return $result_usuarios;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_usuariosById($ID_usu)
                        {
                              $sql_usuarios = 'SELECT * FROM usuarios  WHERE ID_usu='.$ID_usu.' ' ; 
                              $result_usuarios =mysql_query($sql_usuarios);
                              return $result_usuarios;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_usuarios($usu_nombre, $usu_apellido, $usu_usuario, $usu_clave, $usu_tipo, $usu_descuento, $usu_sobrantes)
                        {
                              $sql_usuarios = 'INSERT INTO usuarios (usu_nombre, usu_apellido, usu_usuario, usu_clave, usu_tipo, usu_descuento, usu_sobrantes) VALUES ("'.$usu_nombre.'", "'.$usu_apellido.'", "'.$usu_usuario.'", "'.$usu_clave.'", "'.$usu_tipo.'", "'.$usu_descuento.'", "'.$usu_sobrantes.'")'; 
                              $result_usuarios =mysql_query($sql_usuarios );
                              return $result_usuarios;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_usuariosById($ID_usu, $usu_nombre, $usu_apellido, $usu_usuario, $usu_clave, $usu_tipo, $usu_descuento, $usu_sobrantes)

                        {
                              $sql_usuarios = 'UPDATE usuarios  SET usu_nombre = "'.$usu_nombre.'" , usu_apellido = "'.$usu_apellido.'" , usu_usuario = "'.$usu_usuario.'" , usu_clave = "'.$usu_clave.'" , usu_tipo = "'.$usu_tipo.'" , usu_descuento = "'.$usu_descuento.'" , usu_sobrantes = "'.$usu_sobrantes.'"  WHERE ID_usu='.$ID_usu.' ';
                              $result_usuarios =mysql_query($sql_usuarios );
                              return $result_usuarios;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_usuariosById($ID_usu)
                        {
                              $sql_usuarios = 'DELETE FROM usuarios  WHERE ID_usu='.$ID_usu.' ' ; 
                              $result_usuarios =mysql_query($sql_usuarios);
                              return $result_usuarios;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class venta
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_venta()
                        {
                              $sql_venta = 'SELECT * FROM venta ';
                              $result_venta =mysql_query($sql_venta);
                              return $result_venta;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_ventaById($ID_ven)
                        {
                              $sql_venta = 'SELECT * FROM venta  WHERE ID_ven='.$ID_ven.' ' ; 
                              $result_venta =mysql_query($sql_venta);
                              return $result_venta;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_venta($ven_total, $ven_fpo, $ID_caj, $ven_descuento)
                        {
                              $sql_venta = 'INSERT INTO venta (ven_total, ven_fpo, ID_caj, ven_descuento) VALUES ("'.$ven_total.'", "'.$ven_fpo.'", "'.$ID_caj.'", "'.$ven_descuento.'")'; 
                              $result_venta =mysql_query($sql_venta );
                              return $result_venta;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_ventaById($ID_ven, $ven_total, $ven_fpo, $ID_caj, $ven_descuento)

                        {
                              $sql_venta = 'UPDATE venta  SET ven_total = "'.$ven_total.'" , ven_fpo = "'.$ven_fpo.'" , ID_caj = "'.$ID_caj.'" , ven_descuento = "'.$ven_descuento.'"  WHERE ID_ven='.$ID_ven.' ';
                              $result_venta =mysql_query($sql_venta );
                              return $result_venta;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_ventaById($ID_ven)
                        {
                              $sql_venta = 'DELETE FROM venta  WHERE ID_ven='.$ID_ven.' ' ; 
                              $result_venta =mysql_query($sql_venta);
                              return $result_venta;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class venta_detalle
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_venta_detalle()
                        {
                              $sql_venta_detalle = 'SELECT * FROM venta_detalle ';
                              $result_venta_detalle =mysql_query($sql_venta_detalle);
                              return $result_venta_detalle;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_venta_detalleById($ID_vde)
                        {
                              $sql_venta_detalle = 'SELECT * FROM venta_detalle  WHERE ID_vde='.$ID_vde.' ' ; 
                              $result_venta_detalle =mysql_query($sql_venta_detalle);
                              return $result_venta_detalle;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_venta_detalle($ID_ven, $ID_fpo, $fpo_monto, $vde_IDasociado, $tarjeta_ID_pla, $tarjeta_pla_desc, $tarjeta_pla_cant, $tarjeta_pla_recargo)
                        {
                              $sql_venta_detalle = 'INSERT INTO venta_detalle (ID_ven, ID_fpo, fpo_monto, vde_IDasociado, tarjeta_ID_pla, tarjeta_pla_desc, tarjeta_pla_cant, tarjeta_pla_recargo) VALUES ("'.$ID_ven.'", "'.$ID_fpo.'", "'.$fpo_monto.'", "'.$vde_IDasociado.'", "'.$tarjeta_ID_pla.'", "'.$tarjeta_pla_desc.'", "'.$tarjeta_pla_cant.'", "'.$tarjeta_pla_recargo.'")'; 
                              $result_venta_detalle =mysql_query($sql_venta_detalle );
                              return $result_venta_detalle;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_venta_detalleById($ID_vde, $ID_ven, $ID_fpo, $fpo_monto, $vde_IDasociado, $tarjeta_ID_pla, $tarjeta_pla_desc, $tarjeta_pla_cant, $tarjeta_pla_recargo)

                        {
                              $sql_venta_detalle = 'UPDATE venta_detalle  SET ID_ven = "'.$ID_ven.'" , ID_fpo = "'.$ID_fpo.'" , fpo_monto = "'.$fpo_monto.'" , vde_IDasociado = "'.$vde_IDasociado.'" , tarjeta_ID_pla = "'.$tarjeta_ID_pla.'" , tarjeta_pla_desc = "'.$tarjeta_pla_desc.'" , tarjeta_pla_cant = "'.$tarjeta_pla_cant.'" , tarjeta_pla_recargo = "'.$tarjeta_pla_recargo.'"  WHERE ID_vde='.$ID_vde.' ';
                              $result_venta_detalle =mysql_query($sql_venta_detalle );
                              return $result_venta_detalle;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_venta_detalleById($ID_vde)
                        {
                              $sql_venta_detalle = 'DELETE FROM venta_detalle  WHERE ID_vde='.$ID_vde.' ' ; 
                              $result_venta_detalle =mysql_query($sql_venta_detalle);
                              return $result_venta_detalle;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

    class ventas_canceladas
    {

          //Inicio Funciones para Mostrar Datos

                        //Inicio: Llama a todas las columnas de la tabla
                        function get_ventas_canceladas()
                        {
                              $sql_ventas_canceladas = 'SELECT * FROM ventas_canceladas ';
                              $result_ventas_canceladas =mysql_query($sql_ventas_canceladas);
                              return $result_ventas_canceladas;
                        }
                         //Fin: Llama a todas las columnas de la tabla

          //Inicio Funciones para Mostrar Datos por ID

                        function get_ventas_canceladasById($ID_vcd)
                        {
                              $sql_ventas_canceladas = 'SELECT * FROM ventas_canceladas  WHERE ID_vcd='.$ID_vcd.' ' ; 
                              $result_ventas_canceladas =mysql_query($sql_ventas_canceladas);
                              return $result_ventas_canceladas;
                        }
          //Fin Funciones para Mostrar Datos por ID

          //Fin Funciones para Mostrar Datos

          //Inicio Funciones para Insertar datos


                        function insert_ventas_canceladas($ID_caj, $ID_art)
                        {
                              $sql_ventas_canceladas = 'INSERT INTO ventas_canceladas (ID_caj, ID_art) VALUES ("'.$ID_caj.'", "'.$ID_art.'")'; 
                              $result_ventas_canceladas =mysql_query($sql_ventas_canceladas );
                              return $result_ventas_canceladas;
                        }
          //Fin Funcion Insertar todos los datos

          //Inicio Funciones para Modificar datos

          //Inicio Funcion Modifica todos los datos por ID
                        function update_ventas_canceladasById($ID_vcd, $ID_caj, $ID_art)

                        {
                              $sql_ventas_canceladas = 'UPDATE ventas_canceladas  SET ID_caj = "'.$ID_caj.'" , ID_art = "'.$ID_art.'"  WHERE ID_vcd='.$ID_vcd.' ';
                              $result_ventas_canceladas =mysql_query($sql_ventas_canceladas );
                              return $result_ventas_canceladas;
                        }
          //Fin Funcion Modifica todos los datos por ID

          //Fin Funciones para Modificar datos

          //Inicio Funciones para Eliminar datos

          //Inicio Funcion Eliminar todos los datos por ID
                              function drop_ventas_canceladasById($ID_vcd)
                        {
                              $sql_ventas_canceladas = 'DELETE FROM ventas_canceladas  WHERE ID_vcd='.$ID_vcd.' ' ; 
                              $result_ventas_canceladas =mysql_query($sql_ventas_canceladas);
                              return $result_ventas_canceladas;
                        }
          //Fin Funcion Eliminar todos los datos por ID

          //Fin Funciones para Eliminar datos

                        }

   //Fin trae tablas de la base de datos

   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO

?>