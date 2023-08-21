<div class="modal fade" id="M_Remoto" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar Boleta <small>Remoto</small></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
         </button>
      </div>
        <form  id="formRemoto">
         <div class="modal-body">
          <div class="row">
            <div class="form-group col-xs-12 col-md-12 col-lg-12">
              <label>CLIENTE:</label>
                <select class="form-control select2" id="bolremi" name="bolremi">
                 <?php
                       echo "<option value=''>--</option>";
                       if($rowmon=mysqli_fetch_array($rema,MYSQLI_ASSOC)){
                       do{
                       echo '<option value="'.$rowmon['sen_id'].'">'.$rowmon['sen_email'].'</option>';
                       } while($rowmon=mysqli_fetch_array($rema,MYSQLI_ASSOC));
                       }  
                 ?>
               </select>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-12">
              <label>ASUNTO:</label>
              <input class="form-control " name="bolasu" id="bolasu"  pattern="[A-z0-9 ].{1,}" title="Ingrese solo letras" required>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-12">
              <label for="bolcu">CUERPO:</label>
              <textarea class="form-control" id="bolcu" name="bolcu" rows="3" cols="50" pattern="^[a-zA-Z_0-9 ]*$" title="Ingrese solo letras y numeros" required></textarea> 
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-12">
               <label>ADJUNTOS:</label>
               <input type="file" class="form-control"  name="bolfi" id="bolfi">
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
<script type="text/javascript">
  $(document).ready(function() {
    //$('.select2').select2();

  });
</script>
