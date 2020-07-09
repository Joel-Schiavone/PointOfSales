


    <a href="listarArticulos.php" target="_blank" style="position: fixed; text-align: left; bottom: 1%; left: 1%;"><button class="btn btn-info"><i class="material-icons">content_paste</i></button></a>
    <strong style="position: fixed; text-align: right; bottom: 1%; right: 1%;">V. 1.0.0</strong>

</body>
</html>

<script type="text/javascript">
  /*
	input.oninvalid = function(event) {
    event.target.setCustomValidity('No se permiten caracteres especiales como, por ejemplo, las comillas o los puntos y comas');
}
*/

function imprSelec(muestra)
{
	var ficha=document.getElementById(muestra);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();}

	
// Inicio: barra cargando de ajax
  var cargandoBoton = $("#cargandoBoton");

  $(document).ajaxStart(function() {
    cargandoBoton.show();
  });

  $(document).ajaxSuccess(function() {
    cargandoBoton.hide();
  });
// Fin: barra cargando de ajax 



</script>