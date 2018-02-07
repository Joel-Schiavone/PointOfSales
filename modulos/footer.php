

<div class='col-md-12' style="text-align: right; position: fixed; bottom: 0px; right: 0px;">
	<strong>V. 0.2</strong>
</div>

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