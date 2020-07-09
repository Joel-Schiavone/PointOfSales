<!-- INICIO GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO -->

<?php 

//Inicio recepsion de variables
	$baseDeDatos="supermercados";
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

echo "<br>";
echo "CONTROLADORES";
echo "<br>";
echo "<br>";

echo "$"."action="."$"."_"."POST['action'];";
echo "<br>";
echo "<br>";
//Inicio trae tablas de la base de datos y crea controladores
	$TablasB="SHOW TABLES FROM ".$baseDeDatos."";
	$TablasB	=	mysql_query($TablasB);
	$num_TablasB=mysql_num_rows($TablasB);

	for ($tabB=0; $tabB < $num_TablasB; $tabB++)
	 { 
		$assoc_TablasB=mysql_fetch_assoc($TablasB);
		$NombreDeTablaB=$assoc_TablasB["Tables_in_".$baseDeDatos.""];
		//echo '<br>';	
		$ColumnasB    ="SHOW COLUMNS FROM ".$NombreDeTablaB."";
		$ColumnasB	 = mysql_query($ColumnasB);
		$num_ColumnasB= mysql_num_rows($ColumnasB);

for ($nasB=0; $nasB < $num_ColumnasB; $nasB++)
		 	{ 
				$assoc_ColumnasB=mysql_fetch_assoc($ColumnasB);
				$NombreDeColumnaB = $assoc_ColumnasB["Field"];
				if ($assoc_ColumnasB["Extra"]) 
				{
					$IDDeColumnaB = $assoc_ColumnasB["Field"];
				}

			}

			$sql="$"."sql";

echo "$".$NombreDeTablaB." = new ".$NombreDeTablaB.";";
echo "<br>";
echo "<br>";
	$ColumnasCG   ="SHOW COLUMNS FROM ".$NombreDeTablaB."";
	$ColumnasCG	 = mysql_query($ColumnasCG);
				$num_ColumnasCG= mysql_num_rows($ColumnasCG);

				for ($nasCG=0; $nasCG < $num_ColumnasCG; $nasCG++)
			 	{ 
			 		$assoc_ColumnasCG=mysql_fetch_assoc($ColumnasCG);
			 		
			 		$NombreDeColumnaCG = $assoc_ColumnasCG["Field"];
			 		echo  "@$".$NombreDeColumnaCG."=$"."_"."POST"."['".$NombreDeColumnaCG."'];";
					echo "<br>";
				}
echo "<br>";


$get_NombreDeTabla="get_".$NombreDeTablaB."";
$num_get_NombreDeTabla="$"."num_get_".$NombreDeTablaB."";

echo "if ("."$"."action=='".$get_NombreDeTabla."')";
echo "<br>";
echo "{";
echo "<br>";
echo "&nbsp;&nbsp;$".$get_NombreDeTabla." = $".$NombreDeTablaB."->".$get_NombreDeTabla."();";
echo "<br>";
echo "&nbsp;&nbsp;".$num_get_NombreDeTabla." = mysql_num_rows($".$get_NombreDeTabla.");";
echo "<br>";
echo "<br>";


		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$"."assoc_".$get_NombreDeTabla." = mysql_fetch_assoc("."$"."".$get_NombreDeTabla.");";
		echo "<br>";
		echo "<br>";
				
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; echo '&lt;div class=&quot;table-responsive&quot;&gt;';";
		echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;echo '&lt;table class=&quot;table&quot;&gt;';";
		echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo '&lt;tr&gt;';";
		echo "<br>";

				$ColumnasCJ   ="SHOW COLUMNS FROM ".$NombreDeTablaB."";
		        $ColumnasCJ	   = mysql_query($ColumnasCJ);
				$num_ColumnasCJ= mysql_num_rows($ColumnasCJ);	  
				for ($nasCJ=0; $nasCJ < $num_ColumnasCJ; $nasCJ++)
			 	{ 
			 		$assoc_ColumnasCJ=mysql_fetch_assoc($ColumnasCJ);
			 		$NombreDeColumnaCJ = $assoc_ColumnasCJ["Field"];
			 		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspecho '&lt;th&gt;';";
					echo "<br>";
			 		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp echo '".$NombreDeColumnaCJ."';";
			 		echo "<br>";
			 		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo '&lt;/th&gt;';";
			 		echo "<br>";	
				}

		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo '&lt;/tr&gt;';";
		echo "<br>";
		echo "for ("."$"."action_".$get_NombreDeTabla."=0; "."$"."action_".$get_NombreDeTabla.""."<"." "."$"."num_".$get_NombreDeTabla."; "."$"."action_".$get_NombreDeTabla."++)";
echo "<br>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;{";
echo "<br>";	

echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$"."assoc_".$get_NombreDeTabla." = mysql_fetch_assoc("."$"."".$get_NombreDeTabla.");";
		echo "<br>";
		echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo '&lt;tr&gt;';";
		echo "<br>";
				$ColumnasCH   ="SHOW COLUMNS FROM ".$NombreDeTablaB."";
		        $ColumnasCH	   = mysql_query($ColumnasCH);
				$num_ColumnasCH= mysql_num_rows($ColumnasCH);	  
				for ($nasCH=0; $nasCH < $num_ColumnasCH; $nasCH++)
			 	{ 
			 		$assoc_ColumnasCH=mysql_fetch_assoc($ColumnasCH);
			 		$NombreDeColumnaCH = $assoc_ColumnasCH["Field"];
			 		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo '&lt;th&gt;';";
					echo "<br>";
			 		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspecho $".$NombreDeColumnaCH."="."$"."assoc_".$get_NombreDeTabla."['".$NombreDeColumnaCH."'];";
			 		echo "<br>";
			 		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo '&lt;/th&gt;';";
			 		echo "<br>";
				}
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo '&lt;/tr&gt;';";	
		echo "<br>";		
		echo "&nbsp;&nbsp;&nbsp;&nbsp;}";
		echo "<br>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo '&lt;/table&gt;';";	
		echo "<br>";	
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo '&lt;/div&gt;';";	
		echo "<br>";	

echo "}";
echo "<br>";
echo "<br>";

$get_NombreDeTablaC="get_".$NombreDeTablaB."ById";
$assoc_get_NombreDeTablaC="$"."assoc_get_".$NombreDeTablaB."ById";
echo "if ("."$"."action=='".$assoc_get_NombreDeTablaC."')";
echo "<br>";
echo "{";
echo "<br>";
echo "$".$get_NombreDeTablaC." = $".$NombreDeTablaB."->".$get_NombreDeTablaC."($".$IDDeColumnaB.");";
echo "<br>";
echo $assoc_get_NombreDeTablaC." = mysql_fetch_assoc($".$get_NombreDeTablaC.");";
echo "<br>";
echo "}";
echo "<br>";
echo "<br>";

$insert_NombreDeTablaD="insert_".$NombreDeTablaB."";
echo "if ("."$"."action"."=="."'".$insert_NombreDeTablaD."')";
echo "<br>";
echo "{";
echo "<br>";


echo "$".$insert_NombreDeTablaD." = $".$NombreDeTablaB."->".$insert_NombreDeTablaD."(";
	$ColumnasCD   ="SHOW COLUMNS FROM ".$NombreDeTablaB."";
				$ColumnasCD	 = mysql_query($ColumnasCD);
				$num_ColumnasCD= mysql_num_rows($ColumnasCD);

				for ($nasCD=0; $nasCD < $num_ColumnasCD; $nasCD++)
			 	{ 
			 		$assoc_ColumnasCD=mysql_fetch_assoc($ColumnasCD);
			 		if($assoc_ColumnasCD["Field"]!=$IDDeColumnaB)
			 		{
			 		echo	$NombreDeColumnaCD = "$".$assoc_ColumnasCD["Field"];
						if($nasCD==$num_ColumnasCD-1)
						{
						   echo '';
						}
						else
						{
						   echo ', ';
						}
					}	
				}
echo ");";
echo "<br>";
echo "}";
echo "<br>";
echo "<br>";
$update_NombreDeTablaE="update_".$NombreDeTablaB."";
echo "if ("."$"."action=='".$update_NombreDeTablaE."')";
echo "<br>";
echo "{";
echo "<br>";


echo "$".$update_NombreDeTablaE." = $".$NombreDeTablaB."->".$update_NombreDeTablaE."(";
	$ColumnasCE   ="SHOW COLUMNS FROM ".$NombreDeTablaB."";
				$ColumnasCE	 = mysql_query($ColumnasCE);
				$num_ColumnasCE= mysql_num_rows($ColumnasCE);

				for ($nasCE=0; $nasCE < $num_ColumnasCE; $nasCE++)
			 	{ 
			 		$assoc_ColumnasCE=mysql_fetch_assoc($ColumnasCE);
			 		
			 		echo	$NombreDeColumnaCE = "$".$assoc_ColumnasCE["Field"];
						if($nasCE==$num_ColumnasCE-1)
						{
						   echo '';
						}
						else
						{
						   echo ', ';
						}
				}				

echo ");";
echo "<br>";
echo "}";
echo "<br>";
echo "<br>";
$drop_NombreDeTablaF="drop_".$NombreDeTablaB."";
echo "if ("."$"."action=='".$drop_NombreDeTablaF."')";
echo "<br>";
echo "{";
echo "<br>";

echo "$".$drop_NombreDeTablaF." = $".$NombreDeTablaB."->".$drop_NombreDeTablaF."($".$IDDeColumnaB.');';
echo "<br>";
echo "}";
echo "<br>";
echo "<br>";
echo "<br>";

}
echo "<br>";
echo "<br>";
echo "<hr>";
echo "FUNCIONES";
echo "<br>";
echo "<br>";
//Inicio trae tablas de la base de datos y crea funciones 
	$Tablas="SHOW TABLES FROM ".$baseDeDatos."";
	$Tablas	=	mysql_query($Tablas);
	$num_Tablas=mysql_num_rows($Tablas);

	for ($tab=0; $tab < $num_Tablas; $tab++)
	 { 
		$assoc_Tablas=mysql_fetch_assoc($Tablas);
		$NombreDeTabla=$assoc_Tablas["Tables_in_".$baseDeDatos.""];
		//echo '<br>';	
		$Columnas    ="SHOW COLUMNS FROM ".$NombreDeTabla."";
		$Columnas	 = mysql_query($Columnas);
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

	echo "class ". $NombreDeTabla."";	

			echo "<br>";
			echo "{";
			echo "<br>";
			echo "<br>";
			echo  "//Inicio Funciones para Mostrar Datos";
			echo "<br>";
			echo "<br>";
			echo  "&nbsp;&nbsp;//Inicio Trae todos los datos";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;function get_".$NombreDeTabla."()";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;{";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$"."sql_".$NombreDeTabla." = 'SELECT * FROM ".$NombreDeTabla." ';";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$"."result_".$NombreDeTabla." =mysql_query(".$sql."_".$NombreDeTabla.");";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return";
			echo "&nbsp;$"."result_".$NombreDeTabla.";";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;}";
			echo "<br>";
			echo  "&nbsp;&nbsp;//Fin Trae todos los datos";
			
			echo "<br>";
			echo "<br>";

			echo  "&nbsp;&nbsp;//Inicio Trae todos los datos filtrados por ID";	
			echo "<br>";
			echo "&nbsp;&nbsp;function get_".$NombreDeTabla."ById($".$IDDeColumna.")";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;{";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$"."sql_".$NombreDeTabla." = 'SELECT * FROM ".$NombreDeTabla."  WHERE ".$IDDeColumna."='.$".$IDDeColumna.".' ' ; ";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$"."result_".$NombreDeTabla." =mysql_query(".$sql."_".$NombreDeTabla.");";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return";
			echo "&nbsp;$"."result_".$NombreDeTabla.";";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;}";
			echo "<br>";
			echo  "&nbsp;&nbsp;//Fin Trae todos los datos filtrados por ID";	
			echo "<br>";
			echo "<br>";
			echo  "//Fin Funciones para Mostrar Datos";				
			echo "<br>";
			echo "<br>";

			echo  "//Inicio Funciones para Insertar datos";
			echo "<br>";
			echo "<br>";
			echo  "&nbsp;&nbsp;//Inicio Funcion Insertar todos los datos";
			echo "<br>";
			echo "&nbsp;&nbsp;function insert_".$NombreDeTabla."(";

				$ColumnasB   ="SHOW COLUMNS FROM ".$NombreDeTabla."";
				$ColumnasB	 = mysql_query($ColumnasB);
				$num_ColumnasB= mysql_num_rows($ColumnasB);

				for ($nasB=0; $nasB < $num_ColumnasB; $nasB++)
			 	{ 
			 		$assoc_ColumnasB=mysql_fetch_assoc($ColumnasB);
			 		if($assoc_ColumnasB["Field"]!=$IDDeColumna)
			 		{
			 		echo	$NombreDeColumnaB = "$".$assoc_ColumnasB["Field"];
						if($nasB==$num_ColumnasB-1)
						{
						   echo '';
						}
						else
						{
						   echo ', ';
						}
					}	
				}


			echo ")";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;{";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$"."sql_".$NombreDeTabla." = 'INSERT INTO ".$NombreDeTabla." (";

				$ColumnasC   ="SHOW COLUMNS FROM ".$NombreDeTabla."";
				$ColumnasC	 = mysql_query($ColumnasC);
				$num_ColumnasC= mysql_num_rows($ColumnasC);

				for ($nasC=0; $nasC < $num_ColumnasC; $nasC++)
			 	{ 
			 		$assoc_ColumnasC=mysql_fetch_assoc($ColumnasC);
			 		if($assoc_ColumnasC["Field"]!=$IDDeColumna)
			 		{
					echo $NombreDeColumnaC = $assoc_ColumnasC["Field"];
						if($nasC==$num_ColumnasC-1)
						{
						   echo '';
						}
						else
						{
						   echo ', ';
						}	
					}
					
				}


			echo ") VALUES (";


			$ColumnasD   ="SHOW COLUMNS FROM ".$NombreDeTabla."";
				$ColumnasD	 = mysql_query($ColumnasD);
				$num_ColumnasD= mysql_num_rows($ColumnasD);

				for ($nasD=0; $nasD < $num_ColumnasD; $nasD++)
			 	{ 
			 		$assoc_ColumnasD=mysql_fetch_assoc($ColumnasD);
			 		if($assoc_ColumnasD["Field"]!=$IDDeColumna)
			 		{
						echo $NombreDeColumnaD = "\"'.$".$assoc_ColumnasD["Field"].".'\"";
						if($nasD==$num_ColumnasD-1)
						{
						   echo '';
						}
						else
						{
						   echo ', ';
						}
					}	
				}
			echo ")'; ";	
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$"."result_".$NombreDeTabla." =mysql_query($"."sql_".$NombreDeTabla." );";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return";
			echo "&nbsp;$"."result_".$NombreDeTabla.";";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;}";
			echo "<br>";
			echo  "&nbsp;&nbsp;//Fin Funcion Insertar todos los datos";	
			echo "<br>";
			echo "<br>";

			echo  "//Inicio Funciones para Modificar datos";
			echo "<br>";
			echo "<br>";
			echo  "&nbsp;&nbsp;//Inicio Funcion Modifica todos los datos por ID";

			echo "<br>";
			echo "&nbsp;&nbsp;function update_".$NombreDeTabla."ById(";

			$ColumnasE   ="SHOW COLUMNS FROM ".$NombreDeTabla."";
				$ColumnasE	 = mysql_query($ColumnasE);
				$num_ColumnasE= mysql_num_rows($ColumnasE);

				for ($nasE=0; $nasE < $num_ColumnasE; $nasE++)
			 	{ 
			 		$assoc_ColumnasE=mysql_fetch_assoc($ColumnasE);
					echo $NombreDeColumnaE = "$".$assoc_ColumnasE["Field"];
					if($nasE==$num_ColumnasE-1)
					{
					   echo '';
					}
					else
					{
					   echo ', ';
					}	
				}


			echo ")";
			echo "<br>";

			echo "&nbsp;&nbsp;&nbsp;&nbsp;{";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$"."sql_".$NombreDeTabla." = 'UPDATE ".$NombreDeTabla."  SET ";


				$ColumnasF   ="SHOW COLUMNS FROM ".$NombreDeTabla."";
				$ColumnasF	 = mysql_query($ColumnasF);
				$num_ColumnasF= mysql_num_rows($ColumnasF);

				for ($nasF=0; $nasF < $num_ColumnasF; $nasF++)
			 	{ 
			 		$assoc_ColumnasF=mysql_fetch_assoc($ColumnasF);
			 		if($assoc_ColumnasF["Field"]!=$IDDeColumna)
			 		{
						echo $NombreDeColumnaF =  $assoc_ColumnasF["Field"]." = \"'.$".$assoc_ColumnasF["Field"].".'\" ";
						if($nasF==$num_ColumnasF-1)
						{
						   echo ' ';
						}
						else
						{
						   echo ' , ';
						}
					}

				}

			echo " WHERE ".$IDDeColumna."='.$".$IDDeColumna.".' ';";
			
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$"."result_".$NombreDeTabla." =mysql_query($"."sql_".$NombreDeTabla." );";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return";
			echo "&nbsp;$"."result_".$NombreDeTabla.";";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;}";
			echo "<br>";
			echo  "&nbsp;&nbsp;//Fin Funcion Modifica todos los datos por ID";
			echo "<br>";
			echo "<br>";
			echo  "//Fin Funciones para Modificar datos";
			echo "<br>";
			echo "<br>";

			echo  "//Inicio Funciones para Eliminar datos";
			echo "<br>";
			echo "<br>";
			echo  "&nbsp;&nbsp;//Inicio Funcion Eliminar todos los datos por ID";	
			echo "<br>";
			echo "&nbsp;&nbsp;function drop_".$NombreDeTabla."ById($".$IDDeColumna.")";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;{";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$"."sql_".$NombreDeTabla." = 'DELETE FROM ".$NombreDeTabla."  WHERE ".$IDDeColumna."='.$".$IDDeColumna.".' ' ; ";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$"."result_".$NombreDeTabla." =mysql_query(".$sql."_".$NombreDeTabla.");";
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return";
			echo "&nbsp;$"."result_".$NombreDeTabla.";";
			echo "<br>";

			echo "&nbsp;&nbsp;&nbsp;&nbsp;}";
			echo "<br>";
			echo  "&nbsp;&nbsp;//Fin Funcion Eliminar todos los datos por ID";	
			echo "<br>";
			echo "<br>";
			echo  "//Fin Funciones para Eliminar datos";				
			echo "<br>";
			echo "<br>";


			echo "}";
			echo "<br>";
			echo "<hr>";


 }
//Fin trae tablas de la base de datos
?>
<!-- FIN GENERADOR DE FUNCIONES PHP DESARROLLADO POR SCHIAVONE JOEL LEANDRO -->