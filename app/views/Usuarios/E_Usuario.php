<div class="modal fade" id="E_Usuario" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Usuario</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
         </button>
      </div>
        <form  id="EformUsuario">
         <input type="hidden" id="eid" >
          <div class="modal-body">
          <div class="row">
          <div class="form-group col-xs-12 col-md-12 col-lg-6">
                 <label>NOMBRES Y APELLIDOS:</label>
                 <input type="text"  class="form-control" id="eunompe" placeholder="NOMBRES Y APELLIDOS" pattern="^[a-zA-Z_ ]*$" value="<?=$use_name;?>" title="Ingrese solo letras y numeros" required>
                 </div> 
                <div class="form-group col-xs-12 col-md-12 col-lg-6">
                  <label>EMAIL:</label>
                  <input type="email" class="form-control col-lg-12" value="<?=$use_email;?>" id="euemail" placeholder="EMAIL" required>
                 </div> 
               
               <div class="form-group col-xs-12 col-md-12 col-lg-6">
                 <label>GRUPO:</label>
                 <select class="form-control select2" style="width:100%;" name="eselgrupo" id="eselgrupo" required>
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
                 <input type="password" pattern="[a-zA-Z0-9 ]+" title="Ingrese solo letras y numeros" class="form-control" id="euclave" value="" placeholder="CLAVE" required>
               </div> 
          </div>
          </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
        <button type="button" id="btnCancel" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>  </form>
      </div>
    </div>
  </div>
</div>


