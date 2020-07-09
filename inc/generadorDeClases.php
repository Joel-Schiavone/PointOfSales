
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <?php 

//Inicio recepsion de variables
  $baseDeDatos=$_POST['nombreBaseDeDatos'];
  $Servidor="localhost";
  $Usuario="root";
  $clave="";
//Fin recepsion de variables

//Inicio Conexion
  $link = mysql_connect("".$Servidor."", "".$Usuario."", "".$clave."");
  if (!$link) {
    die('No se puede conectar a la base de datos: ' . mysql_error());
  }
  mysql_select_db("".$baseDeDatos."",$link);  
//Fin Conexion

  //Inicio trae tablas de la base de datos y crea funciones 
  $Tablas="SHOW TABLES FROM ".$baseDeDatos."";
  $Tablas = mysql_query($Tablas);
  $num_Tablas=mysql_num_rows($Tablas);


    /*
     * 1.- Creamos la variable que contiene el archivo que tenemos que crear.
     * 2.- preguntamos si existe el archivo, si el archivo existe "se ha modificado"
       en caso contrario el archivo se ha creado.
     * 3.- Con fopen abrimos un archivo o url, en este caso vamos a abrir un archivo
       pasando como parámetro la variable $nombre_archivo que es la que contiene 
       nuestro archivo y como segundo parámetro como lo vamos a abrir, en este caso "a"
       que nos abre el fichero en solo lectura y sitúa el puntero al final del fichero
       y en el caso de que no exista lo crea.
 
       ******Para terminar*******
 
       4.-Con el fwrite escribimos dentro del archivo la fecha con la hora de Creación 
       o modificación, según el caso, con la variable $mensaje, 
 
    */

    $nombre_archivo = "classes.php"; 
 
    if(file_exists($nombre_archivo))
    {
        $mensaje = "El Archivo $nombre_archivo se ha modificado correctamente"; 
        unlink($nombre_archivo);
    }
 
    else
    {
        $mensaje = "El Archivo $nombre_archivo se ha creado correctamente";
    }
 
    if($archivo = fopen($nombre_archivo, "a"))
    {
        if(fwrite($archivo, "<?php" . "\r\n"))
        { 
                fwrite($archivo, "\r\n");
                fwrite($archivo, "    //".date("d m Y H:m:s"). " ". $mensaje . "\r\n");
                fwrite($archivo, "\r\n");
             for ($tab=0; $tab < $num_Tablas; $tab++)
             { 
              $assoc_Tablas=mysql_fetch_assoc($Tablas);
              $NombreDeTabla=$assoc_Tablas["Tables_in_".$baseDeDatos.""];
              //echo '<br>';  
              $Columnas    ="SHOW COLUMNS FROM ".$NombreDeTabla."";
              $Columnas  = mysql_query($Columnas);
              $num_Columnas= mysql_num_rows($Columnas);

                for ($nas=0; $nas < $num_Columnas; $nas++)
                { 
                  $assoc_Columnas=mysql_fetch_assoc($Columnas);
                  $NombreDeColumna = $assoc_Columnas["Field"];
                  if ($assoc_Columnas["Extra"]) 
                  {
                    $IDDeColumna = $assoc_Columnas["Field"];
                  }
                  
                }

            

                $sql="$"."sql";
              //Inicio Construye funciones
           

                    fwrite($archivo, "    class ". $NombreDeTabla."\r\n");
                    fwrite($archivo, "    {");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "          //Inicio Funciones para Mostrar Datos");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "                        //Inicio: Llama a todas las columnas de la tabla");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "                        function get_".$NombreDeTabla."()");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "                        {");
                    fwrite($archivo, "\r\n");   
                    fwrite($archivo, "                              $"."sql_".$NombreDeTabla." = 'SELECT * FROM ".$NombreDeTabla." ';");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "                              $"."result_".$NombreDeTabla." =mysql_query(".$sql."_".$NombreDeTabla.");");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "                              return");
                    fwrite($archivo, " $"."result_".$NombreDeTabla.";");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "                        }");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "                         //Fin: Llama a todas las columnas de la tabla"); 



                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "\r\n");

                    fwrite($archivo, "          //Inicio Funciones para Mostrar Datos por ID");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "                        function get_".$NombreDeTabla."ById($".$IDDeColumna.")");
    
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "                        {");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "                              $"."sql_".$NombreDeTabla." = 'SELECT * FROM ".$NombreDeTabla."  WHERE ".$IDDeColumna."='.$".$IDDeColumna.".' ' ; ");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "                              $"."result_".$NombreDeTabla." =mysql_query(".$sql."_".$NombreDeTabla.");");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "                              return");
                    fwrite($archivo, " $"."result_".$NombreDeTabla.";");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "                        }");

                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "          //Fin Funciones para Mostrar Datos por ID");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "          //Fin Funciones para Mostrar Datos");     
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "          //Inicio Funciones para Insertar datos"); 
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "\r\n");
                    fwrite($archivo, "                        function insert_".$NombreDeTabla."(");
    

                      $ColumnasB   ="SHOW COLUMNS FROM ".$NombreDeTabla."";
                      $ColumnasB   = mysql_query($ColumnasB);
                      $num_ColumnasB= mysql_num_rows($ColumnasB);

                      for ($nasB=0; $nasB < $num_ColumnasB; $nasB++)
                      { 
                        $assoc_ColumnasB=mysql_fetch_assoc($ColumnasB);
                        if($assoc_ColumnasB["Field"]!=$IDDeColumna)
                        {
                     
                        fwrite($archivo, "".$NombreDeColumnaB = "$".$assoc_ColumnasB["Field"]."");
                          if($nasB==$num_ColumnasB-1)
                          {
                            fwrite($archivo, "");
                          }
                          else
                          {
                            fwrite($archivo, ", ");
                          }
                        } 
                      }
                      fwrite($archivo, ")");
                      fwrite($archivo, "\r\n");
                      fwrite($archivo, "                        {");
                      fwrite($archivo, "\r\n");
                      fwrite($archivo, "                              $"."sql_".$NombreDeTabla." = 'INSERT INTO ".$NombreDeTabla." (");
                      
      
                      $ColumnasC   ="SHOW COLUMNS FROM ".$NombreDeTabla."";
                      $ColumnasC   = mysql_query($ColumnasC);
                      $num_ColumnasC= mysql_num_rows($ColumnasC);

                      for ($nasC=0; $nasC < $num_ColumnasC; $nasC++)
                      { 
                        $assoc_ColumnasC=mysql_fetch_assoc($ColumnasC);
                        if($assoc_ColumnasC["Field"]!=$IDDeColumna)
                        {

                        fwrite($archivo, "".$NombreDeColumnaC = $assoc_ColumnasC["Field"]."");
                          if($nasC==$num_ColumnasC-1)
                          {
                             fwrite($archivo, "");
                          }
                          else
                          {
                             fwrite($archivo, ", ");
                          } 
                        }
                        
                      }


                    fwrite($archivo, ") VALUES (");


                    $ColumnasD   ="SHOW COLUMNS FROM ".$NombreDeTabla."";
                      $ColumnasD   = mysql_query($ColumnasD);
                      $num_ColumnasD= mysql_num_rows($ColumnasD);

                      for ($nasD=0; $nasD < $num_ColumnasD; $nasD++)
                      { 
                        $assoc_ColumnasD=mysql_fetch_assoc($ColumnasD);
                        if($assoc_ColumnasD["Field"]!=$IDDeColumna)
                        {
                          fwrite($archivo, "".$NombreDeColumnaD = "\"'.$".$assoc_ColumnasD["Field"].".'\"");
                          
                          if($nasD==$num_ColumnasD-1)
                          {
                             fwrite($archivo, "");
                          }
                          else
                          {
                             fwrite($archivo, ", ");
                          }
                        } 
                      }
              fwrite($archivo, ")'; ");  
              fwrite($archivo, "\r\n");
              fwrite($archivo, "                              $"."result_".$NombreDeTabla." =mysql_query($"."sql_".$NombreDeTabla." );");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "                              return");
              fwrite($archivo, " $"."result_".$NombreDeTabla.";");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "                        }");

              fwrite($archivo, "\r\n");
              fwrite($archivo, "          //Fin Funcion Insertar todos los datos");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "          //Inicio Funciones para Modificar datos");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "          //Inicio Funcion Modifica todos los datos por ID");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "                        function update_".$NombreDeTabla."ById(");
    
    
              $ColumnasE   ="SHOW COLUMNS FROM ".$NombreDeTabla."";
              $ColumnasE   = mysql_query($ColumnasE);
              $num_ColumnasE= mysql_num_rows($ColumnasE);

              for ($nasE=0; $nasE < $num_ColumnasE; $nasE++)
              { 
                $assoc_ColumnasE=mysql_fetch_assoc($ColumnasE);
                fwrite($archivo, "".$NombreDeColumnaE = "$".$assoc_ColumnasE["Field"]."");
                if($nasE==$num_ColumnasE-1)
                {
                   fwrite($archivo, "");
                }
                else
                {
                   fwrite($archivo, ", ");
                } 
              }

              fwrite($archivo, ")");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "                        {");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "                              $"."sql_".$NombreDeTabla." = 'UPDATE ".$NombreDeTabla."  SET ");

              $ColumnasF   ="SHOW COLUMNS FROM ".$NombreDeTabla."";
              $ColumnasF   = mysql_query($ColumnasF);
              $num_ColumnasF= mysql_num_rows($ColumnasF);

              for ($nasF=0; $nasF < $num_ColumnasF; $nasF++)
              { 
                $assoc_ColumnasF=mysql_fetch_assoc($ColumnasF);
                if($assoc_ColumnasF["Field"]!=$IDDeColumna)
                {
                  fwrite($archivo, "".$NombreDeColumnaF =  $assoc_ColumnasF["Field"]." = \"'.$".$assoc_ColumnasF["Field"].".'\" ");
                  if($nasF==$num_ColumnasF-1)
                  {
                     fwrite($archivo, "");
                  }
                  else
                  {
                     fwrite($archivo, ", ");
                  }
                }

              }

              fwrite($archivo, " WHERE ".$IDDeColumna."='.$".$IDDeColumna.".' ';");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "                              $"."result_".$NombreDeTabla." =mysql_query($"."sql_".$NombreDeTabla." );");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "                              return");
              fwrite($archivo, " $"."result_".$NombreDeTabla.";");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "                        }");

              fwrite($archivo, "\r\n");
              fwrite($archivo, "          //Fin Funcion Modifica todos los datos por ID");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "\r\n");      
              fwrite($archivo, "          //Fin Funciones para Modificar datos");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "\r\n");  
              fwrite($archivo, "          //Inicio Funciones para Eliminar datos");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "\r\n");  
              fwrite($archivo, "          //Inicio Funcion Eliminar todos los datos por ID");
              fwrite($archivo, "\r\n");  
              fwrite($archivo, "                              function drop_".$NombreDeTabla."ById($".$IDDeColumna.")");  
              fwrite($archivo, "\r\n"); 
              fwrite($archivo, "                        {");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "                              $"."sql_".$NombreDeTabla." = 'DELETE FROM ".$NombreDeTabla."  WHERE ".$IDDeColumna."='.$".$IDDeColumna.".' ' ; ");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "                              $"."result_".$NombreDeTabla." =mysql_query(".$sql."_".$NombreDeTabla.");");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "                              return");
              fwrite($archivo, " $"."result_".$NombreDeTabla.";");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "                        }");

              fwrite($archivo, "\r\n");
              fwrite($archivo, "          //Fin Funcion Eliminar todos los datos por ID");   
              fwrite($archivo, "\r\n");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "          //Fin Funciones para Eliminar datos");   
              fwrite($archivo, "\r\n");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "                        }");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "\r\n");
              fwrite($archivo, "   //Fin trae tablas de la base de datos"); 
              fwrite($archivo, "\r\n");
              fwrite($archivo, "\r\n");


              fwrite($archivo, "   //FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO");   


              fwrite($archivo, "\r\n");
              fwrite($archivo, "\r\n");


             }        
                   fwrite($archivo, "?>");
                    echo "Se ha ejecutado correctamente<br>";
        }
        else
        {
            echo "Ha habido un problema al crear el archivo";
        }
 
        fclose($archivo);
    }

       echo '<script type="text/javascript">
        window.location.assign("../interfazGenerador.php");
        </script>';
    

 ?>