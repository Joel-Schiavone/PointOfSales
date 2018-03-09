<?php
session_start();
$paramentros=new paramentros;
$ID_par=1;
$get_paramentrosById=$paramentros->get_paramentrosById($ID_par);
$assoc_get_paramentrosById=mysql_fetch_assoc($get_paramentrosById);

?>
<!DOCTYPE html>
	<html lang="es">
		<head>
			<title><?php echo $assoc_get_paramentrosById['par_razonSocial'];?></title>

			    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
			    <meta http-equiv="X-UA-Compatible" content="IE=edge">
			    <meta name="viewport" content="width=device-width, initial-scale=1">
					<script src="https://unpkg.com/popper.js"></script>
				
				 <!-- Inicio: Bootstrap-->
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
				    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>-->
				    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>-->
			
				<link href="css/bootstrap.min.css" rel="stylesheet">
				<link href="css/bootstrap.min.css" rel="stylesheet" media="print" >

				
				  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
				 <!-- Fin: Bootstrap-->
						

				<!-- Inicio: Material Icons-->
				 <link href="css/material-icons.css" rel="stylesheet">	
				 <link href="css/material-icons.css" rel="stylesheet"  media="print">

				
				<!-- Fin: Material Icons-->

				<!-- Inicio: Estilos Generales-->
				 <link href="css/generales.css" rel="stylesheet">	
					 <link href="css/generales.css" rel="stylesheet" media="print">	
				 
				<!-- Fin: Estilos Generales-->

				<!-- Inicio: Material Icons-->
				<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>    
				<!-- Fin: Material Icons-->

				<!-- Inicio: funcionesScript-->
				<!--<script src="funcionesScript.js"></script>-->
				<!-- Fin: funcionesScript-->

				   <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
				    <link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
				    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>
				    <link href="themes/explorer-fa/theme.css" media="all" rel="stylesheet" type="text/css"/>
				    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
				    <script src="js/plugins/sortable.js" type="text/javascript"></script>
				    <script src="js/fileinput.js" type="text/javascript"></script>
				    <script src="js/locales/fr.js" type="text/javascript"></script>
				    <script src="js/locales/es.js" type="text/javascript"></script>
				    <script src="themes/explorer-fa/theme.js" type="text/javascript"></script>
				    <script src="themes/fa/theme.js" type="text/javascript"></script>
				    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>-->
				  	
<!-- INICIO ADJUNTOS ARRASTRA Y PEGA -->
				  	<!-- bootstrap 4.x is supported. You can also use the bootstrap css 3.3.x versions -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" media="print"/>


<!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
<!-- link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->
<!-- optionally uncomment line below if using a theme or icon set like font awesome (note that default icons used are glyphicons and `fa` theme can override it) -->
<!-- link https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css media="all" rel="stylesheet" type="text/css" /-->

<!-- piexif.min.js is only needed for restoring exif data in resized images and when you 
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/piexif.min.js" type="text/javascript"></script>
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/sortable.min.js" type="text/javascript"></script>
<!-- purify.min.js is only needed if you wish to purify HTML content in your preview for 
    HTML files. This must be loaded before fileinput.min.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/purify.min.js" type="text/javascript"></script>
<!-- popper.min.js below is needed if you use bootstrap 4.x. You can also use the bootstrap js 
   3.3.x versions without popper.min.js. -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<!-- bootstrap.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. bootstrap 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
<!-- the main fileinput plugin file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/fileinput.min.js"></script>
<!-- optionally uncomment line below for loading your theme assets for a theme like Font Awesome (`fa`) -->
<!-- script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/themes/fa/theme.min.js"></script -->
<!-- optionally if you need translation for your language then include  locale file as mentioned below -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/locales/LANG.js"></script>-->
<!-- FIN ADJUNTOS ARRASTRA Y PEGA -->


<!-- INICIO SELECT DE BUSQUEDA -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css" media="print">


<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/i18n/defaults-*.min.js"></script>-->
<!-- FIN SELECT DE BUSQUEDA -->


<!-- Include Required Prerequisites -->
<script type="text/javascript" src="http://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="http://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" media="print"/>



				<!--Inicio motor de herramientas de texto-->
				 <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
				 <!-- <script>tinymce.init({
				  selector: 'textarea',
				  height: 100,
				  theme: 'modern',
				  plugins: [
				    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
				    'searchreplace wordcount visualblocks visualchars code fullscreen',
				    'insertdatetime media nonbreaking save table contextmenu directionality',
				    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
				  ],
				  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
				  toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
				  image_advtab: true,
				  templates: [
				    { title: 'Test template 1', content: 'Test 1' },
				    { title: 'Test template 2', content: 'Test 2' }
				  ],
				  content_css: [
				    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
				    '//www.tinymce.com/css/codepen.min.css'
				  ]
				 });</script>
				Fin motor de herramientas de texto-->

				<!-- Inicio: Declara color de fondo segun la sucursal-->
				<?php 
					if (@$_SESSION['sucursal']==1) 
					{
						echo   "<style type='text/css'>
									body
									{
										background-color: #ea9532;
									}
								</style>";						
					}
					elseif (@$_SESSION['sucursal']==2) 
					{
						echo   "<style type='text/css'>
									body
									{
										background-color: #96c53d;
									}
								</style>";						
					}
					elseif (@$_SESSION['sucursal']==3) 
					{
						echo   "<style type='text/css'>
									body
									{
										background-color: #eee;
									}
								</style>";						
					}
					elseif (@$_SESSION['sucursal']==4) 
					{
						echo   "<style type='text/css'>
									body
									{
										background-color: #e00;
									}
								</style>";						
					}
					else
					{
						echo   "<style type='text/css'>
									body
									{
										background-color: #fefefe;
									}
								</style>";
					}
				?>
				<!-- Fin: Declara color de fondo segun la sucursal-->

				<!-- Inicio: Declara color de fondo segun la sucursal-->
					<link href="https://fonts.googleapis.com/css?family=Anton|Archivo+Black|Francois+One|Poppins|Shrikhand" rel="stylesheet">
				<!-- Fin: Declara color de fondo segun la sucursal-->

						<?php
						//Inicio: Alertas 
							if (@$_GET['M'])
							{
								$ID_ale=$_GET['M'];
								$alertas = new alertas;
								$get_alertasById = $alertas->get_alertasById($ID_ale);
								$assoc_get_alertasById = mysql_fetch_assoc($get_alertasById);
								echo '<div id="mensaje" style="display:none; position:fixed; bottom:0px; width:100%; z-index:3000;">'.$ale_desc=$assoc_get_alertasById['ale_desc'].'</div>';
								echo '<script>$(document).ready(function() {  
						        $("#mensaje").toggle("slow"); });  
						  		</script>';
							}
								
								?>
								<script>$(document).ready(function(){				   
									   setTimeout("$('#mensaje').toggle('slow')", 6000);
									});</script>
						<!--Fin: Alertas--> 	
						
						<!--Inicio: Estilos Imprimir--> 	
						<style type="text/css" media="print">
						@media print {
						#NoImprimir {display:none;}
						#mensaje {display:none;}
						#otraVenta {display:none;}
						#VuelveVenta {display:none;}
						#imprimir {display: block;}
						}
						</style>
						<!--Fin: Estilos Imprimir--> 

						<!--Inicio: Graficos de Google--> 	
						<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 						<!--Fin: Graficos de Google--> 
    					
    					<!--Inicio Script de loading general-->
  						<style type="text/css">
  							 #cargando
							    {
							      position:absolute;
							      width:100%;
							      height:100%;
							      background:#fff url(media/loading/LOADING8.gif) no-repeat center;
							      z-index: 150;
							    }    
							 

  						</style>	
 						
	  						<script type="text/javascript">
						    $(document).ready(function(){
						      $('#cargando').delay( 1500 ).slideUp( 400 );

						    });

						    </script>
						    <div id="cargando">

						    </div>
						<!--Fin Script de loading general-->
  
					 <!-- Inicio: DataTable-->
					<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
					<script type="text/javascript" src="DataTables/datatables.min.js"></script>

					<!-- Inicio capturador de imagen para imprimir -->
					<!-- <script type="text/javascript" src="convertir_imagen_contenido-master/js/jquery.js"></script>-->
					<!-- <script type="text/javascript" src="convertir_imagen_contenido-master/js/filesaver.js"></script>-->
					<!-- <script type="text/javascript" src="convertir_imagen_contenido-master/js/html2canvas.js"></script>-->
					<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
					<!--<script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>-->
		</head>
	<body>


  <img src='media/loading/cargando4.gif' id='cargandoBoton' style="display: none;" >