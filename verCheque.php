<?php 
$chequesE= new chequeE;
$get_chequesEById=$chequesE->get_chequesEById($ID_che);
$assoc_get_chequesE=mysql_fetch_assoc($get_chequesEById);
/* Inicio Modal nuevo cheque */                          
                        echo '
                                      <div class="col-md-12" style="text-align:center;">
                                      <div class="col-md-12" id="editarCartel'.$assoc_get_chequesE['ID_che'].'" style="display:none;"></div>
                                      <input hidden type="text" name="action" value="modificarCheque">
                                      <input hidden type="text" name="ID_che'.$assoc_get_chequesE['ID_che'].'" id="Input_ID_che'.$assoc_get_chequesE['ID_che'].'" value="'.$assoc_get_chequesE['ID_che'].'">

                                          <div class="col-md-12" style="border: 2px solid #333; text-align:center;">
                                           <div class="col-md-12" style="margin-top:10px;">
                                              <div class="col-md-4">
                                                <img src="'.$assoc_get_chequesE['ban_logo'].'" style="width:160px;" id="ID_ban'.$assoc_get_chequesE['ID_che'].'">
                                              </div>
                                              <div class="col-md-4">
                                                <H3 id="che_fecha'.$assoc_get_chequesE['ID_che'].'">'.$assoc_get_chequesE['che_fecha'].'</H3>
                                                
                                              </div>
                                              <div class="col-md-4">
                                                   <H3 id="che_num'.$assoc_get_chequesE['ID_che'].'">Nº '.$assoc_get_chequesE['che_num'].'</H3>
                                                   
                                              </div>
                                            </div>  
                                            <div class="col-md-12" style="text-align:left; margin-top:10px; border-bottom: 1px solid #000;">
                                              <H4 id="che_beneficiario'.$assoc_get_chequesE['ID_che'].'"><strong>PAGUESE A:</strong> &nbsp&nbsp&nbsp&nbsp';

                                              if($assoc_get_chequesE['che_tipo']=="AL BENEFICIARIO" OR $assoc_get_chequesE['che_tipo']=="DE CAJA" OR $assoc_get_chequesE['che_tipo']=="DE VENTANILLA")
                                              {
                                                echo $assoc_get_chequesE['che_beneficiario'];
                                              }
                                              if ($assoc_get_chequesE['che_tipo']=="DE VIAJERO" OR $assoc_get_chequesE['che_tipo']=="A LA ORDEN") 
                                              {
                                                echo "A LA ORDEN";
                                              }

                                          echo '</H4>
                                            </div>
                                            <div class="col-md-12" style="text-align:left; margin-top:5px; border-bottom: 1px solid #000;">
                                              <H4 id="che_importe'.$assoc_get_chequesE['ID_che'].'"><strong>LA SUMA DE:</strong> &nbsp&nbsp&nbsp&nbsp$ '.$assoc_get_chequesE['che_importe'].'</H4>
                                                
                                            </div>
                                             <div class="col-md-12" style="text-align:right; margin-top:20px; border-bottom: 1px solid #000;">
                                             <div class="col-md-4" style="border: 2px solid #000;">';
                                              echo '<h5 id="che_tipo'.$assoc_get_chequesE['ID_che'].'" >'.$assoc_get_chequesE['che_tipo'].'</h5>';
                                            echo '</div>
                                              <div class="col-md-8">
                                                <H3 id="che_librador'.$assoc_get_chequesE['ID_che'].'">'.$assoc_get_chequesE['che_librador'].'</H3>
                                              </div>
                                            </div>
                                          </div>
                                      ';
                            /* Fin Modal nuevo cheque */

                            ?>