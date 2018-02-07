<!--Inicio: Documentos requeridos -->
<?php
  include_once("inc/requerido.php"); 
  include_once("inc/validacion.php");
  $usuariosE = new usuariosE; 
  $usuarios  = new usuarios;
  $sucursalesE = new sucursalesE;

                          $get_usuariosForTipo=$usuarios->get_usuarios();
                          $assoc_usuarios=mysql_fetch_assoc($get_usuariosForTipo);

                          /* Inicio editar usuario*/                         
                          echo '<div class="modal fade" id="nuevoUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                   <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <h4 class="modal-title" id="myModalLabel">Agregar Nuevo Usuario</h4>
                                    </div>

                                    <div class="modal-body">
                                      <form action="accionesExclusivas.php" method="POST">
                                       <fieldset>
                                          <legend>Datos de usuarios</legend>  

                                          <div class="form-group">
                                            <label for="Nombre" class="col-lg-2 control-label">Nombre</label>
                                              <input type="text" name="usu_nombre" placeholder="Nombre" class="form-control"> 
                                              <input hidden type="text" name="action" value="nuevoUsuario">
                                            </div>

                                             <div class="form-group">
                                            <label for="Apellido" class="col-lg-2 control-label">Apellido</label>
                                              <input type="text" name="usu_apellido" placeholder="Apellido" class="form-control"> 
                                            </div>

                                            <div class="form-group">
                                            <label for="Usuario" class="col-lg-2 control-label">Usuario</label>
                                              <input type="text" name="usu_usuario" placeholder="Usuario de Ingreso" class="form-control"> 
                                            </div>

                                            <div class="form-group">
                                            <label for="Clave" class="col-lg-2 control-label">Clave</label>
                                              <input type="text" name="usu_clave" placeholder="Clave" class="form-control"> 
                                            </div>


                                            <div class="form-group">
                                            <label for="Clave" class="col-lg-2 control-label">Tipo</label>
                                              <select name="usu_tipo" class="form-control">
                                                <option value="1">Cajero</option>
                                                <option value="3">Admin</option>
                                              </select>
                                            </div>
                                        
                                            <div class="form-group">
                                               <button type="submit" class="btn btn-success" style="width:100%;"><i class="material-icons" style="vertical-align: middle">assignment_ind</i> Confirmar</button>
                                            </div> 
                                          </fieldset> '; 
                                      echo '</form>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                  </div>
                                </div>
                              </div>';
                          /* Fin editar usuario*/


                          /* Inicio editar cliente */                         
                          echo '<div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                   <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <h4 class="modal-title" id="myModalLabel">Agregar Nuevo Cliente</h4>
                                    </div>

                                    <div class="modal-body">
                                      <form action="accionesExclusivas.php" method="POST">
                                       <fieldset>
                                          <legend>Datos de Cliente</legend>  
                                            <div class="form-group">
                                            <label for="Nombre" class="col-lg-2 control-label">Nombre</label>
                                              <input type="text" name="cli_nombre" placeholder="Nombre" class="form-control"> 
                                              <input hidden type="text" name="action" value="nuevoCliente">
                                            </div>

                                             <div class="form-group">
                                            <label for="Apellido" class="col-lg-2 control-label">Apellido</label>
                                              <input type="text" name="cli_apellido" placeholder="Apellido" class="form-control"> 
                                            </div>


                                             <div class="form-group">
                                            <label for="Telefono" class="col-lg-2 control-label">Telefono</label>
                                              <input type="number" name="cli_telefono" placeholder="Telefono" class="form-control"> 
                                            </div>

                                             <div class="form-group">
                                            <label for="Dirección" class="col-lg-2 control-label">Dirección</label>
                                              <input type="text" name="cli_direccion" placeholder="Dirección" class="form-control"> 
                                            </div>

                                            <div class="form-group">
                                            <label for="Mail" class="col-lg-2 control-label">Mail</label>
                                              <input type="mail" name="cli_mail" placeholder="Mail" class="form-control"> 
                                            </div>

                                            <div class="form-group">
                                            <label for="Sucursal" class="col-lg-2 control-label">Sector</label>
                                              <select name="ID_suc" class="form-control">
                                              <option selected>Seleccione un sector</option>';
                                               $get_sucursales = $sucursalesE->get_sucursales();
                                                $num_get_sucursales = mysql_num_rows($get_sucursales);
                                                  for ($sucCount=0; $sucCount < $num_get_sucursales; $sucCount++) 
                                                  { 
                                                     $assoc_get_sucursales = mysql_fetch_assoc($get_sucursales);
                                                     echo "<option value='".$assoc_get_sucursales['ID_suc']."'>".$assoc_get_sucursales['suc_desc']."</option>";
                                                  }
                                          echo '</select>
                                            </div>

                                            <div class="form-group">
                                               <button type="submit" class="btn btn-success" style="width:100%;"><i class="material-icons" style="vertical-align: middle">assignment_ind</i> Confirmar</button>
                                            </div> 
                                          </fieldset>'; 
                                      echo '</form>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                  </div>
                                </div>
                              </div>';
                          /* Fin editar cliente */


  ?>

<div class="container">
  <div class="row">
    <div class='panel panel-default'>
      <div class='panel-body'>
          <div class="col-md-12" style="text-align: center;">
            <div class="col-md-4" style="margin: 2%;">
                <input type="text" name="get_clientes" id="get_clientes" class="form-control" placeholder="Buscar Clientes y usuarios" autofocus="autofocus">
            </div>
             <div class="col-md-3" style="margin: 2%;">
                <button class="btn btn-success" data-toggle='modal' title='Agregar Nuevo Usuario' data-placement='top' data-target='#nuevoUsuario'><i class="material-icons">add</i> Agregar Nuevo Usuario</button>
            </div>
            <div class="col-md-3" style="margin: 2%;">
              <button class="btn btn-success" data-toggle='modal' title='Agregar Nuevo Cliente' data-placement='top' data-target='#nuevoCliente'><i class="material-icons">add</i> Agregar Nuevo Cliente</button>
            </div>
          </div>  
           <div class="col-md-12" style="text-align: center;">
               <div class="col-md-4" style="margin: 2%;">
                  <button class="btn btn-info" title='Listar Todo' id='listarTodo'><i class="material-icons">all_inclusive</i> Listar Todo</button>
              </div>
               <div class="col-md-3" >
                      <label class="control-label" for="focusedInput"><i class="material-icons">account_circle</i> Usuarios</label><br>
                        <label class="switch">
                        <input type="checkbox" checked id="SoloUsuarios" name="SoloUsuarios" value="si">
                        <span class="slider round"></span>
                      </label>
              </div>
               <div class="col-md-3">
                      <label class="control-label" for="focusedInput"><i class="material-icons">account_circle</i> Clientes</label><br>
                        <label class="switch">
                        <input type="checkbox" checked id="SoloClientes" name="SoloClientes" value="si">
                        <span class="slider round"></span>
                      </label>
              </div>
                
            </div>
            <div class="col-md-12">
              <div id='suggestionsClientes' class='suggestions'></div>
            </div> 
      </div> 
     </div>      
  </div>   
</div>
<!--Fin: Contenedor principal -->


<div class="container">
  <div class="row">
    
            <?php
                    if (@$_GET['ID_usu']) {
                          $ID_usu=$_GET['ID_usu'];
                          $get_usuariosForTipo=$usuarios->get_usuariosById($ID_usu);
                          $assoc_usuarios=mysql_fetch_assoc($get_usuariosForTipo);
                           if ( $assoc_usuarios['usu_tipo']==1)
                            {
                              $tipo="Admin";
                            }
                            else
                            {
                              $tipo="Cajero";
                            }  

                                if ($assoc_usuarios['usu_descuento']==1) 
                                {
                                  $Descuento="checked";
                                }
                                 if ($assoc_usuarios['usu_descuento']==0) 
                                {
                                  $Descuento="";
                                }

                                 if ($assoc_usuarios['usu_sobrantes']==1) 
                                {
                                  $Sobrante="checked";
                                }
                                 if ($assoc_usuarios['usu_sobrantes']==0) 
                                {
                                  $Sobrante="";
                                }

                         /* Inicio editar */                         
                          echo '<form action="accionesExclusivas.php" method="POST" class="form-horizontal">';
                               echo '<fieldset>
                                          <legend>Datos de usuarios</legend>  

                                          <div class="form-group">
                                            <label for="Nombre" class="col-lg-2 control-label">Nombre</label>
                                              <input type="text" name="usu_nombre" value="'.$assoc_usuarios['usu_nombre'].'" class="form-control"> 
                                              <input hidden type="text" name="action" value="editarUsuario">
                                               <input hidden type="text" name="ID_usu" value="'.$assoc_usuarios['ID_usu'].'">
                                            </div>

                                             <div class="form-group">
                                            <label for="Apellido" class="col-lg-2 control-label">Apellido</label>
                                              <input type="text" name="usu_apellido" value="'.$assoc_usuarios['usu_apellido'].'" class="form-control"> 
                                            </div>

                                            <div class="form-group">
                                            <label for="Usuario" class="col-lg-2 control-label">Usuario</label>
                                              <input type="text" name="usu_usuario" value="'.$assoc_usuarios['usu_usuario'].'" class="form-control"> 
                                            </div>

                                            <div class="form-group">
                                            <label for="Clave" class="col-lg-2 control-label">Clave</label>
                                              <input type="text" name="usu_clave" value="'.$assoc_usuarios['usu_clave'].'" class="form-control"> 
                                            </div>


                                            <div class="form-group">
                                            <label for="Clave" class="col-lg-2 control-label">Tipo</label>
                                              <select name="usu_tipo" class="form-control">

                                              <option value="'.$assoc_usuarios['usu_tipo'].'">'.$tipo.'</option>
                                                <option value="1">Cajero</option>
                                                <option value="3">Admin</option>
                                              </select>
                                            </div>
                                                
                                             <div class="form-group">
                                               <label class="control-label" for="focusedInput"> Habilitado a realizar Descuentos?</label><br>
                                                  <i class="material-icons" style="vertical-align: top">money_off</i> <label class="switch">
                                                  <input type="checkbox" id="descuentos" name="descuentos" value="1" '.$Descuento.'>
                                                  <span class="slider round"></span>
                                                </label> <i class="material-icons" style="vertical-align: top">attach_money  </i>
                                              </div> 

                                                 <div class="form-group">
                                               <label class="control-label" for="focusedInput"> Habilitado a visualizar al cierre de caja: efectivo, sobrantes y faltantes?</label><br>
                                                  <i class="material-icons"  style="vertical-align: top">visibility_off</i> <label class="switch">
                                                  <input type="checkbox" id="sobrantes" name="sobrantes" value="1" '.$Sobrante.'>
                                                  <span class="slider round"></span>
                                                </label> <i class="material-icons" style="vertical-align: top">visibility</i>
                                              </div>    
                                        
                                            <div class="form-group">
                                               <button type="submit" class="btn btn-success" style="width:100%;"><i class="material-icons">assignment_ind</i> Confirmar</button>
                                            </div> 
                                          </fieldset>'; 
                                       
                                         
                                      echo '</form>';
                          /* Fin editar */

                    }
                      ?>
  </div>   
</div>
<!--Fin: Contenedor principal -->
<!--Inicio: Footer -->
<?php
  include("modulos/footer.php"); 
?>
<!--Fin: Footer -->

<!--Inicio: script -->
 <script type="text/javascript">
   $('#get_clientes').keyup(function()
            {
              var get_clientes = $(this).val();  
              var SoloClientes= $('input:checkbox[name=SoloClientes]:checked').val();  
              var SoloUsuarios= $('input:checkbox[name=SoloUsuarios]:checked').val();  
              var action = 'Get_usuarios';
               var volver = 'usuarios.php';
              var dataString = 'get_clientes='+get_clientes + '&action='+action + '&volver='+volver + '&SoloClientes='+SoloClientes + '&SoloUsuarios='+SoloUsuarios;
              $.ajax(
              {
                  type: 'POST',
                  url: 'accionesExclusivas.php',
                  data: dataString,
                  success: function(data)
                   {
                      $('#suggestionsClientes').fadeIn(1000).html(data);
                   }
               });
           });

      $('#listarTodo').click(function()
            {
              var get_clientes = 'Todos';  
              var SoloClientes= $('input:checkbox[name=SoloClientes]:checked').val();  
              var SoloUsuarios= $('input:checkbox[name=SoloUsuarios]:checked').val();  
              var action = 'Get_usuarios';
               var volver = 'usuarios.php';
              var dataString = 'get_clientes='+get_clientes + '&action='+action + '&volver='+volver + '&SoloClientes='+SoloClientes + '&SoloUsuarios='+SoloUsuarios;
              $.ajax(
              {
                  type: 'POST',
                  url: 'accionesExclusivas.php',
                  data: dataString,
                  success: function(data)
                   {
                      $('#suggestionsClientes').fadeIn(1000).html(data);
                   }
               });
           });

        $('#SoloClientes').change(function()
            {
              var get_clientes = 'Todos';  
              var SoloClientes= $('input:checkbox[name=SoloClientes]:checked').val();  
              var SoloUsuarios= $('input:checkbox[name=SoloUsuarios]:checked').val();  
              var action = 'Get_usuarios';
               var volver = 'usuarios.php';
              var dataString = 'get_clientes='+get_clientes + '&action='+action + '&volver='+volver + '&SoloClientes='+SoloClientes + '&SoloUsuarios='+SoloUsuarios;
              $.ajax(
              {
                  type: 'POST',
                  url: 'accionesExclusivas.php',
                  data: dataString,
                  success: function(data)
                   {
                      $('#suggestionsClientes').fadeIn(1000).html(data);
                   }
               });
           });
        $('#SoloUsuarios').change(function()
            {
              var get_clientes = 'Todos';  
              var SoloClientes= $('input:checkbox[name=SoloClientes]:checked').val();  
              var SoloUsuarios= $('input:checkbox[name=SoloUsuarios]:checked').val();  
              var action = 'Get_usuarios';
               var volver = 'usuarios.php';
              var dataString = 'get_clientes='+get_clientes + '&action='+action + '&volver='+volver + '&SoloClientes='+SoloClientes + '&SoloUsuarios='+SoloUsuarios;
              $.ajax(
              {
                  type: 'POST',
                  url: 'accionesExclusivas.php',
                  data: dataString,
                  success: function(data)
                   {
                      $('#suggestionsClientes').fadeIn(1000).html(data);
                   }
               });
           });
 </script>
<!--Fin: script -->
