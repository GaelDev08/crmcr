<div class="modal fade" id="M_Usuario" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formUsuario">
            <div class="modal-body">
              <div class="row">
              <div class="form-group col-xs-12 col-md-12 col-lg-6">
                 <label>NOMBRES Y APELLIDOS:</label>
                 <input type="text"  class="form-control" id="unompe" placeholder="NOMBRES Y APELLIDOS" pattern="^[a-zA-Z_ ]*$" value="<?=$use_name;?>" title="Ingrese solo letras y numeros" required>
                 </div> 
                <div class="form-group col-xs-12 col-md-12 col-lg-6">
                  <label>EMAIL:</label>
                  <input type="email" class="form-control col-lg-12" value="<?=$use_email;?>" id="uemail" placeholder="EMAIL" required>
                 </div> 
               
               <div class="form-group col-xs-12 col-md-12 col-lg-6">
                 <label>GRUPO:</label>
                 <select class="form-control select2" style="width:100%;" name="selgrupo" id="selgrupo" required>
                     <?php
                       $sqlcat="SELECT gro_id,gro_name from groups where gro_status='1'";                            
                       $rcat=mysqli_query($con,$sqlcat);
                        if ($groid !='') {
                          echo "<option value='".$groid."'>".$grona."</option>";
                          } else {
                          echo "<option value=''>--</option>";
                          }
                        
                        if( $rowcat=mysqli_fetch_array($rcat,MYSQLI_ASSOC)     ){
                        do{
                           echo '<option value="'.$rowcat['gro_id'].'">'.$rowcat['gro_name'].'</option>';
                           } while($rowcat=mysqli_fetch_array($rcat,MYSQLI_ASSOC));
                        }
                      ?>
                   </select>
               </div>
               <div class="form-group col-xs-12 col-md-12 col-lg-6">
                 <label>CLAVE:</label>
                 <input type="password" pattern="[a-zA-Z0-9 ]+" title="Ingrese solo letras y numeros" class="form-control" id="uclave" value="<?=$use_password;?>" placeholder="CLAVE" required>
               </div>
               <div class="col-lg-12">
                  <div class="row tbldepa">
                    <div class="form-group col-xs-12 col-md-12 col-lg-12">
                      <label>SELECCIONE MODULO: </label>
                    </div>
                    <!-- checkbox -->
                    <?php while($rowd=mysqli_fetch_array($resdepar,MYSQLI_ASSOC)){ 
                        $bmoid = $rowd['mod_id'];
                        $migid = "";
                        if ($migid) {
                           $cheked = 'checked';
                        } else {
                          $cheked = '';
                        }
                      ?>
                    <div class="col-md-4">
                      <div class="custom-control custom-checkbox mr-sm-2">
                      <label><input type="checkbox" class="gdepart" name="gdepart[]" value="<?=$rowd['mod_id'];?>" <?=$cheked;?>> <?=$rowd['mod_name'];?> </label>
                      </div>
                    </div>
                     <?php } ?>
                    <!-- End: checkbox -->
                  </div>
                </div>
            </div>  
          </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>  
            </div>
            </form>
        </div>
    </div>
</div>
