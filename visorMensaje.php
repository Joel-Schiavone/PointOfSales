<?php
include_once("inc/requeridoSinCarga.php"); 

	$ID_men=$_POST['ID_men'];
	$mensajes=new mensajes;
	$mensajesE=new mensajesE;
	$get_mensajesById=$mensajesE->get_mensajesById($ID_men);
	$assoc_get_mensajesById=mysql_fetch_assoc($get_mensajesById);
	$men_categoria=11;
	$visto=$assoc_get_mensajesById['men_visto'];

	if($visto==0)
	{	 	
		$men_visto=1;
		$update_mensajesVistoById=$mensajesE->update_mensajesVistoById($ID_men, $men_visto);
	}	

	echo "<div class='col-md-12' style='width:100%; height:100%;' id='imprimir'>";
			    echo '<table id="mensajeVisor'.$ID_men.'" class="table table-hidden" cellspacing="0" width="100%">';
			    echo ' <thead>';
			     echo '<tr>';
                echo '<th>'.$assoc_get_mensajesById['men_asunto'].'</th>';
                echo '</tr>';
		        echo '</thead>';
		        
		        echo '<tbody>';
			     echo '<tr><th style="text-align:center;"><h1>$ '.$assoc_get_mensajesById['pre_cant'].'</h1></th></tr>';
			      echo '<tr><th style="text-align:center;">'.$assoc_get_mensajesById['men_desc'].'</th></tr>';
			      echo '<tr><th style="text-align:center;">'.$assoc_get_mensajesById['men_fec'].'</th></tr>';
			       echo '</tbody>';
			      echo '</table>';
			      echo " <script type='text/javascript'>
																    $('#mensajeVisor".$ID_men."').DataTable({
																        dom: 'Bfrtip',
																        buttons: [
																            'copyHtml5',
																            'excelHtml5',
																            'csvHtml5',
																            'print',
																            {
																                extend: 'pdfHtml5',
																                orientation: 'landscape',
																                pageSize: 'LEGAL',
																                download: 'open'
																            }
																        ],
																        responsive: true,
																    	language: {
																        url: '/dataTables/Spanish.json'
																    	}
																    });

																	 </script>";
			      echo '<hr><br>';

			      echo '
			      	<a href="accionesExclusivas.php?action=MarcarComoNoLeido&ID_men='.$ID_men.'"><button class="btn btn-info" title="Marcar Como No Leido" id="NoImprimir"><i class="material-icons">visibility_off</i></button></a>
			      		<a href="accionesExclusivas.php?action=CambiarTipoDeMensaje&ID_men='.$ID_men.'&men_categoria='.$men_categoria.'"><button class="btn btn-danger" title="Eliminar" id="NoImprimir"><i class="material-icons">delete_forever</i></button></a>';
	echo "</div>";

	



?>
