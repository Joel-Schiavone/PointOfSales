  <!--Inicio: Documentos requeridos -->
<?php
	include_once("inc/requerido.php"); 
  include_once("inc/validacion.php");
  $proveedores= new proveedores;
  ?>
<style type="text/css">
  th
  {
    text-align: center;
    vertical-align: middle;
  }
</style>


                        <!--Inicio nuevo proveedor-->                        
                          <div class="modal fade" id="nuevoProveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                   <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <h4 class="modal-title" id="myModalLabel">Alta de Proveedor</h4>
                                    </div>

                                    <div class="modal-body">
                                      <form action="accionesExclusivas.php" method="POST">
                                       <fieldset>
                                          <legend>Datos del Proveedor</legend>  

                                          <div class="form-group">
                                            <label for="Nombre" class="col-lg-2 control-label">Nombre</label>
                                              <input type="text" name="pro_desc" placeholder="Nombre" class="form-control"> 
                                            </div>

                                             <div class="form-group">
                                            <label for="Teléfono" class="col-lg-2 control-label">Teléfono</label>
                                              <input type="text" name="pro_tel" placeholder="Teléfono" class="form-control"> 
                                            </div>

                                            <div class="form-group">
                                            <label for="Cod. Postal" class="col-lg-2 control-label">Cod. Postal</label>
                                              <input type="text" name="pro_codPostal" placeholder="Cod. Postal" class="form-control"> 
                                            </div>

                                            <div class="form-group">
                                            <label for="Provincia" class="col-lg-2 control-label">Provincia</label>
                                              <input type="text" name="pro_provincia" placeholder="Provincia" class="form-control"> 
                                            </div>
                                            
                                             <div class="form-group">
                                            <label for="Localidad" class="col-lg-2 control-label">Localidad</label>
                                              <input type="text" name="pro_localidad" placeholder="Localidad" class="form-control"> 
                                            </div>

                                             <div class="form-group">
                                            <label for="Dirección" class="col-lg-2 control-label">Dirección</label>
                                              <input type="text" name="pro_dir" placeholder="Dirección" class="form-control"> 
                                            </div>
  
                                             <div class="form-group">
                                            <label for="C.U.I.T." class="col-lg-2 control-label">C.U.I.T.</label>
                                              <input type="text" name="pro_cuit" placeholder="C.U.I.T." class="form-control"> 
                                            </div>

                                             <div class="form-group">
                                            <label for="Categoria I.V.A" class="col-lg-2 control-label">Categoria I.V.A</label>
                                              <input type="text" name="pro_catIva" placeholder="Categoria I.V.A" class="form-control"> 
                                            </div>

                                             <div class="form-group">
                                            <label for="Tipo de Proveedor" class="col-lg-2 control-label">Tipo de Proveedor</label>
                                              <input type="text" name="pro_tipo" placeholder="Tipo de Proveedor" class="form-control"> 
                                            </div>

                                             <div class="form-group">
                                            <label for="Cod.Ret. SUSS" class="col-lg-2 control-label">Cod.Ret. SUSS</label>
                                              <input type="text" name="pro_suss" placeholder="Cod.Ret. SUSS" class="form-control"> 
                                            </div>

                                             <div class="form-group">
                                            <label for="Cod.Ret. Ganancias" class="col-lg-2 control-label">Cod.Ret. Ganancias</label>
                                              <input type="text" name="pro_ganancias" placeholder="Cod.Ret. Ganancias" class="form-control"> 
                                            </div>

                                              <div class="form-group">
                                            <label for="Cod.Ret. IIBB" class="col-lg-2 control-label">Cod.Ret. IIBB</label>
                                              <input type="text" name="pro_iibb" placeholder="Cod.Ret. IIBB" class="form-control"> 
                                            </div>

                                              <div class="form-group">
                                            <label for="Cod.Ret. I.V.A" class="col-lg-2 control-label">Cod.Ret. I.V.A</label>
                                              <input type="text" name="pro_iva" placeholder="Cod.Ret. I.V.A" class="form-control"> 
                                            </div>

                                              <div class="form-group">
                                            <label for="Nº IIBB" class="col-lg-2 control-label">Nº IIBB</label>
                                              <input type="text" name="pro_nroIibb" placeholder="Nº IIBB" class="form-control"> 
                                            </div>

                                              <div class="form-group">
                                            <label for="Acum. Pagos del Mes" class="col-lg-2 control-label">Acum. Pagos del Mes</label>
                                              <input type="text" name="pro_acumPagosDelMes" placeholder="Acum. Pagos del Mes" class="form-control"> 
                                            </div>

                                              <div class="form-group">
                                            <label for="Acum. Ret del Mes" class="col-lg-2 control-label">Acum. Ret del Mes</label>
                                              <input type="text" name="pro_retDelMes" placeholder="Acum. Ret del Mes" class="form-control"> 
                                            </div>
  
                                            <div class="form-group">
                                            <label for="Condición de Pago" class="col-lg-2 control-label">Condición de Pago</label>
                                              <input type="text" name="pro_condicionPago" placeholder="Condición de Pago" class="form-control"> 
                                            </div>


                                              <input hidden type="text" name="action" value='altaProveedor'> 
                                          
                                        
                                            <div class="form-group">
                                               <button type="submit" class="btn btn-success" style="width:100%;"><i class="material-icons" style="vertical-align: middle">assignment_ind</i> Confirmar</button>
                                            </div> 
                                          </fieldset> 
                                      </form>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                  </div>
                                </div>
                              </div>';
                          <!--Fin nuevo proveedor-->

                           
<div class="container-fluid">
  <div class="row">  
    <div class="col-md-12" style="text-align: right; margin-bottom: 2%;">
      <button class="btn btn-success" data-toggle='modal' title='Agregar Nuevo Proveedor' data-placement='top' data-target='#nuevoProveedor'><i class='material-icons'>add_box</i> Nuevo Proveedor</button>
    </div>
   <div class="col-md-12" style="overflow-x: auto;">
      <table class='table table-striped table-hover' style="overflow: scroll;">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Cod. Postal</th>
            <th>Provincia</th>
            <th>Localidad</th>
            <th>Dirección</th>
            <th>C.U.I.T.</th>
            <th>Categoria I.V.A</th>
            <th>Tipo de Proveedor</th>
            <th>Cod.Ret. SUSS</th>
            <th>Cod.Ret. Ganancias</th>
            <th>Cod.Ret. IIBB</th>
            <th>Cod.Ret. I.V.A</th>
            <th>Nº IIBB</th>
            <th>Acum. Pagos del Mes</th>
            <th>Acum. Ret del Mes</th>
            <th>Condición de Pago</th>
            <th colspan="2">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $get_proveedores=$proveedores->get_proveedores();
            $num_get_proveedores=mysql_num_rows($get_proveedores);
            for ($CountProv=0; $CountProv < $num_get_proveedores; $CountProv++) 
            { 
              $assoc_get_proveedores=mysql_fetch_assoc($get_proveedores);


               //Inicio editar proveedor-->                       
                    echo '<div class="modal fade" id="editarProveedor'.$assoc_get_proveedores['ID_pro'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                   <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <h4 class="modal-title" id="myModalLabel">Editar Proveedor</h4>
                                    </div>

                                    <div class="modal-body">
                                      <form action="accionesExclusivas.php" method="POST">
                                       <fieldset>
                                          <legend>Datos del Proveedor</legend>  

                                          <div class="form-group">
                                            <label for="Nombre" class="col-lg-2 control-label">Nombre</label>
                                              <input type="text" name="pro_desc" placeholder="Nombre" value="'.$assoc_get_proveedores['pro_desc'].'" class="form-control"> 
                                             
                                            </div>

                                             <div class="form-group">
                                            <label for="Teléfono" class="col-lg-2 control-label">Teléfono</label>
                                              <input type="text" name="pro_tel" placeholder="Teléfono" value="'.$assoc_get_proveedores['pro_tel'].'" class="form-control"> 
                                            </div>

                                            <div class="form-group">
                                            <label for="Cod. Postal" class="col-lg-2 control-label">Cod. Postal</label>
                                              <input type="text" name="pro_codPostal" placeholder="Cod. Postal" value="'.$assoc_get_proveedores['pro_codPostal'].'" class="form-control"> 
                                            </div>

                                            <div class="form-group">
                                            <label for="Provincia" class="col-lg-2 control-label">Provincia</label>
                                              <input type="text" name="pro_provincia" placeholder="Provincia" value="'.$assoc_get_proveedores['pro_provincia'].'"  class="form-control"> 
                                            </div>
                                            
                                             <div class="form-group">
                                            <label for="Localidad" class="col-lg-2 control-label">Localidad</label>
                                              <input type="text" name="pro_localidad" placeholder="Localidad" value="'.$assoc_get_proveedores['pro_localidad'].'"  class="form-control"> 
                                            </div>

                                             <div class="form-group">
                                            <label for="Dirección" class="col-lg-2 control-label">Dirección</label>
                                              <input type="text" name="pro_dir" placeholder="Dirección" value="'.$assoc_get_proveedores['pro_dir'].'"  class="form-control"> 
                                            </div>
  
                                             <div class="form-group">
                                            <label for="C.U.I.T." class="col-lg-2 control-label">C.U.I.T.</label>
                                              <input type="text" name="pro_cuit" placeholder="C.U.I.T." value="'.$assoc_get_proveedores['pro_cuit'].'" class="form-control"> 
                                            </div>

                                             <div class="form-group">
                                            <label for="Categoria I.V.A" class="col-lg-2 control-label">Categoria I.V.A</label>
                                              <input type="text" name="pro_catIva" placeholder="Categoria I.V.A" value="'.$assoc_get_proveedores['pro_catIva'].'" class="form-control"> 
                                            </div>

                                             <div class="form-group">
                                            <label for="Tipo de Proveedor" class="col-lg-2 control-label">Tipo de Proveedor</label>
                                              <input type="text" name="pro_tipo" placeholder="Tipo de Proveedor" value="'.$assoc_get_proveedores['pro_tipo'].'" class="form-control"> 
                                            </div>

                                             <div class="form-group">
                                            <label for="Cod.Ret. SUSS" class="col-lg-2 control-label">Cod.Ret. SUSS</label>
                                              <input type="text" name="pro_suss" placeholder="Cod.Ret. SUSS" value="'.$assoc_get_proveedores['pro_suss'].'" class="form-control"> 
                                            </div>

                                             <div class="form-group">
                                            <label for="Cod.Ret. Ganancias" class="col-lg-2 control-label">Cod.Ret. Ganancias</label>
                                              <input type="text" name="pro_ganancias" placeholder="Cod.Ret. Ganancias" value="'.$assoc_get_proveedores['pro_ganancias'].'" class="form-control"> 
                                            </div>

                                              <div class="form-group">
                                            <label for="Cod.Ret. IIBB" class="col-lg-2 control-label">Cod.Ret. IIBB</label>
                                              <input type="text" name="pro_iibb" placeholder="Cod.Ret. IIBB" value="'.$assoc_get_proveedores['pro_iibb'].'" class="form-control"> 
                                            </div>

                                              <div class="form-group">
                                            <label for="Cod.Ret. I.V.A" class="col-lg-2 control-label">Cod.Ret. I.V.A</label>
                                              <input type="text" name="pro_iva" placeholder="Cod.Ret. I.V.A" value="'.$assoc_get_proveedores['pro_iva'].'" class="form-control"> 
                                            </div>

                                              <div class="form-group">
                                            <label for="Nº IIBB" class="col-lg-2 control-label">Nº IIBB</label>
                                              <input type="text" name="pro_nroIibb" placeholder="Nº IIBB" value="'.$assoc_get_proveedores['pro_nroIibb'].'" class="form-control"> 
                                            </div>

                                              <div class="form-group">
                                            <label for="Acum. Pagos del Mes" class="col-lg-2 control-label">Acum. Pagos del Mes</label>
                                              <input type="text" name="pro_acumPagosDelMes" placeholder="Acum. Pagos del Mes" value="'.$assoc_get_proveedores['pro_acumPagosDelMes'].'" class="form-control"> 
                                            </div>

                                              <div class="form-group">
                                            <label for="Acum. Ret del Mes" class="col-lg-2 control-label">Acum. Ret del Mes</label>
                                              <input type="text" name="pro_retDelMes" placeholder="Acum. Ret del Mes" value="'.$assoc_get_proveedores['pro_retDelMes'].'" class="form-control"> 
                                            </div>
  
                                            <div class="form-group">
                                            <label for="Condición de Pago" class="col-lg-2 control-label">Condición de Pago</label>
                                              <input type="text" name="pro_condicionPago" placeholder="Condición de Pago" value="'.$assoc_get_proveedores['pro_condicionPago'].'" class="form-control"> 
                                            </div>
                                              <input hidden type="text" name="action" value="editarProveedor">
                                              <input hidden type="text" name="ID_pro" value="'.$assoc_get_proveedores['ID_pro'].'"> 
                                          
                                            <div class="form-group">
                                               <button type="submit" class="btn btn-success" style="width:100%;"><i class="material-icons" style="vertical-align: middle">assignment_ind</i> Confirmar</button>
                                            </div> 
                                          </fieldset> 
                                      </form>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                  </div>
                                </div>
                              </div>';
                          //Fin editar proveedor-->


                echo "<tr>";
                  echo "<th>".$assoc_get_proveedores['ID_pro']."</th>";
                  echo "<th>".$assoc_get_proveedores['pro_desc']."</th>";
                  echo "<th>".$assoc_get_proveedores['pro_tel']."</th>";
                  echo "<th>".$assoc_get_proveedores['pro_codPostal']."</th>";
                  echo "<th>".$assoc_get_proveedores['pro_provincia']."</th>";
                  echo "<th>".$assoc_get_proveedores['pro_localidad']."</th>";
                  echo "<th>".$assoc_get_proveedores['pro_dir']."</th>";
                  echo "<th>".$assoc_get_proveedores['pro_cuit']."</th>";
                  echo "<th>".$assoc_get_proveedores['pro_catIva']."</th>";
                  echo "<th>".$assoc_get_proveedores['pro_tipo']."</th>";
                  echo "<th>".$assoc_get_proveedores['pro_suss']."</th>";
                  echo "<th>".$assoc_get_proveedores['pro_ganancias']."</th>";
                  echo "<th>".$assoc_get_proveedores['pro_iibb']."</th>";
                  echo "<th>".$assoc_get_proveedores['pro_iva']."</th>";
                  echo "<th>".$assoc_get_proveedores['pro_nroIibb']."</th>";
                  echo "<th>".$assoc_get_proveedores['pro_acumPagosDelMes']."</th>";
                  echo "<th>".$assoc_get_proveedores['pro_retDelMes']."</th>";
                  echo "<th>".$assoc_get_proveedores['pro_condicionPago']."</th>";
                  echo "<th><button class='btn btn-primary' name='botonEditar".$assoc_get_proveedores['ID_pro']."' id='botonEditar".$assoc_get_proveedores['ID_pro']."' data-toggle='modal' title='Editar Proveedor' data-placement='top' data-target='#editarProveedor".$assoc_get_proveedores['ID_pro']."'><i class='material-icons'>edit</i></button></th>";
                   echo "<th><a href='accionesExclusivas.php?ID_pro=".$assoc_get_proveedores['ID_pro']."&action=BorrarProveedor'><button class='btn btn-danger' name='botonBorrar".$assoc_get_proveedores['ID_pro']."' id='botonBorrar".$assoc_get_proveedores['ID_pro']."'><i class='material-icons'>delete_forever</i></button></a></th>";
               echo "</tr>";
            }
          ?>
        </tbody>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Cod. Postal</th>
            <th>Provincia</th>
            <th>Localidad</th>
            <th>Dirección</th>
            <th>C.U.I.T.</th>
            <th>Categoria I.V.A</th>
            <th>Tipo de Proveedor</th>
            <th>Cod.Ret. SUSS</th>
            <th>Cod.Ret. Ganancias</th>
            <th>Cod.Ret. IIBB</th>
            <th>Cod.Ret. I.V.A</th>
            <th>Nº IIBB</th>
            <th>Acum. Pagos del Mes</th>
            <th>Acum. Ret del Mes</th>
            <th>Condición de Pago</th>
            <th colspan="2">Acciones</th>
          </tr>
        </tfoot>
      </table> 
   </div>
  </div> 
</div>
<!--Fin: Contenedor principal -->
<!--Inicio: Footer -->
<?php
	include("modulos/footer.php"); 
?>
<!--Fin: Footer -->

<!--Inicio: script -->
 
<!--Fin: script -->
