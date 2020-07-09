<!--Inicio: Documentos requeridos -->
<?php
	include_once("inc/requerido.php"); 
?>
<!--Fin: Documentos requeridos -->
<!--Inicio: classes -->

<!--Fin: classes -->
<!--Inicio: Contenedor principal -->
<div class="container">

<form method="POST" action="register.php">
    	<div class="col-md-12" >

          <div class="col-md-4">

          </div>  

          <div class="col-md-4" id="login">
               <div class="col-md-12" id="camposLoginImasgen">
                <img src='media/logo/logo.jpg' id='logoLogin'>
               </div>  

              <div class="col-md-12" id="camposLoginTitulo">
                <i class="material-icons">supervisor_account</i> Login
                <hr>
              </div>  
              <div class="col-md-12" id="camposLogin">
                  <div class="col-md-2">
                    <i class="material-icons">face</i> 
                  </div> 
                  <div class="col-md-10"> 
                    <input type="text" name="usuario" placeholder="Usuario" class="form-control" required>
                 </div> 
              </div>
              <div class="col-md-12" id="camposLogin">
                  <div class="col-md-2">
                    <i class="material-icons">vpn_key</i> 
                  </div> 
                  <div class="col-md-10"> 
                     <input type="password" name="clave" placeholder="Clave" class="form-control" required>
                 </div> 
              </div> 
               <div class="col-md-12" id="camposLogin"> 
                <button  type="submit" name="Acceder" class="btn btn-success" id="botonAcceder">
                  <i class="material-icons">forward</i> Ingresar</button>
               </div> 

          </div>  

          <div class="col-md-4">

          </div>  
     
    	</div>
</form>

</div>
<!--Fin: Contenedor principal -->
<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>
<!--Fin: Footer -->

 