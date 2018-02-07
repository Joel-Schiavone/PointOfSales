

<!--INICIO TRAER ACCIONES POR AJAX-->
		<input id='get_modulos' type='text' name='get_modulos' class='form-control' autocomplete='off' style='height: 50px;>
		 
		 <div id='suggestions' class='suggestions'></div>

		 <script type='text/javascript'>
          $('#get_modulos').keypress(function()
            {
              var get_modulos = $(this).val();    
              var dataString = 'action='+get_modulos;
              $.ajax(
              {
                  type: 'POST',
                  url: 'acciones.php',
                  data: dataString,
                  success: function(data)
                   {
                      $('#suggestions').fadeIn(1000).html(data);
                      $('.suggest-element').on('click', function()
                        {
                          var valorInput = $('#get_modulos').html();
                          $('#action').val(valorInput);
                          $('#suggestions').fadeOut(1000);
                        });              
                   }
               });
           });


      $(window).ready(function(){ 
        $('#selectTiendas').toggle('slow');

      });


            </script> 

<!--FIN TRAER ACCIONES POR AJAX-->