<!DOCTYPE html>
<?php 	include_once("inc/requerido.php");  ?>
<html>
<head>
	<title>Genera tu codigo</title>
</head>
<body>
	<div class='container'>
		<div class='col-md-12' style="text-align: center;">
			<h3>Generador Automático del archivo clases</h3>
			<form action='inc/generadorDeClases.php' method='POST'>
			<input class="form-control" type="text" name="nombreBaseDeDatos" placeholder="Coloque el nombre de su base de datos" style="margin: 5%;">
				<?php 
				
				 		echo "<button type='submit' class='btn btn-success'><i class='material-icons' style='vertical-align:center'>backup</i> Generar Classes.php</button>";
				 		
				?> 	
			</form>	
		</div>
		
	</div>
</body>
</html>