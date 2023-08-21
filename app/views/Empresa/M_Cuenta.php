<div class="modal fade" id="M_Cuenta" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Cuenta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formBank">
            <div class="modal-body">
              <div class="row">
              <div class="form-group col-xs-12 col-md-12 col-lg-12">
              <label>BANCO:</label>
                <div class="input-group">
                  <select class="form-control select2" style="width: 90%;" name="selban" id="selban" required></select>
                  <div class="input-group-append">
                    <button class="btn btn-success" type="button" id="btnAgban">+</button>
                  </div>
                </div> 
             </div>      
               <div class="form-group col-xs-12 col-md-12 col-lg-8">
                 <label>NUM. CUENTA:</label>
                 <input type="text"  class="form-control" id="bscuenta" placeholder="00000000000000" pattern="^[a-zA-Z_0-9 ]*$" title="Ingrese solo letras y numeros" required>
               </div>
                <div class="form-group col-xs-12 col-md-12 col-lg-4">
                <label>MONEDA:</label>
                <select class="form-control select2" id="selmone" name="selmone">
                  <?php
                   $sqlmone="SELECT cur_id,cur_symbol from currency WHERE cur_status='1' AND com_id='$eemp'  
                   order by cur_default DESC";
                      $rmone=mysqli_query($con,$sqlmone);
                      if($rowmon=mysqli_fetch_array($rmone,MYSQLI_ASSOC)){
                      do{
                      echo '<option value="'.$rowmon['cur_id'].'">'.$rowmon['cur_symbol'].'</option>';
                      } while($rowmon=mysqli_fetch_array($rmone,MYSQLI_ASSOC));
                      }  
                 ?>
                </select>
               </div>
                    
            </div>  </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                <button type="button" id="btnCancel" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>  
            </div>
            </form>
        </div>
    </div>
</div>
