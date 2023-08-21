<div class="modal fade" id="E_Modulos" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Modulo</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
         </button>
      </div>
        <form  id="formEModu">
         <input type="hidden" id="eid" >
        <div class="modal-body">
        <div class="row">
           <div class="form-group col-xs-12 col-md-12 col-lg-12">
             <label>NOMBRE:</label>
             <input type="text"  class="form-control" id="emnombre" placeholder="NOMBRE" pattern="^[a-zA-Z_0-9 ]*$" title="Ingrese solo letras y numeros" required>
           </div>
           <div class="form-group col-xs-12 col-md-12 col-lg-6">
            <label>MONEDA:</label>
            <select class="form-control select2" id="selmone" name="selmone">
              <?php
                 $sqlmone="SELECT cur_id,cur_symbol from currency WHERE cur_status='1' AND com_id='$bempid'  order by cur_id";
                  $rmone=mysqli_query($con,$sqlmone);
                  echo "<option value=''>--</option>";
                  if($rowmon=mysqli_fetch_array($rmone,MYSQLI_ASSOC)){
                  do{
                  echo '<option value="'.$rowmon['cur_id'].'">'.$rowmon['cur_symbol'].'</option>';
                  } while($rowmon=mysqli_fetch_array($rmone,MYSQLI_ASSOC));
                  }  
             ?>
            </select>
           </div>
           <div class="form-group col-md-4 col-xs-12 col-lg-6">
                  <label>PRECIO: <small>Venta</small></label>
                  <input class="form-control number" name="eprecio" id="eprecio" placeholder="0" required>
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
