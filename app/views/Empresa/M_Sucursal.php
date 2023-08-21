<div class="modal fade" id="M_Sucursal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Sucursal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formSucur">
            <div class="modal-body">
              <div class="row">
               <div class="form-group col-xs-12 col-md-12 col-lg-12">
                 <label>NOMBRE:</label>
                 <input type="text"  class="form-control" id="snombre" placeholder="NOMBRE" pattern="^[a-zA-Z_0-9 ]*$" title="Ingrese solo letras y numeros" required>
               </div>
                 <div class="form-group col-xs-12 col-md-12 col-lg-12">
                 <label>DIRECCION:</label>
                 <input type="text"  class="form-control" id="sdirecion" placeholder="DIRECCION DE LA SUCURSAL" pattern="^[a-zA-Z_0-9 ]*$" title="Ingrese solo letras y numeros" required>
                </div>
                 <div class="form-group col-xs-12 col-md-12 col-lg-6">
                 <label>TELEFONO:</label>
                 <input type="text"  class="form-control" id="stele" placeholder="TELEFONO" pattern="^[a-zA-Z_0-9 ]*$" title="Ingrese solo letras y numeros">
                </div>
               
                <div class="form-group col-xs-12 col-md-12 col-lg-6">
                  <label>TIPO:</label>
                <select class="form-control" name="stipo" id="stipo" required>
                   <option value="">--</option> 
                   <option value="1">Principal</option>  
                   <option value="2">Sucursal</option>  
                   <option value="3">Almacen</option>  
                </select>
                </div>  
                <div class="form-group col-xs-12 col-md-12 col-lg-12">
                 <label>RESPONSABLE:</label>
                 <input type="text"  class="form-control" id="sresponsa" placeholder="RESPONSABLE" pattern="^[a-zA-Z_0-9/ ]*$" title="Ingrese solo letras y numeros">
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
