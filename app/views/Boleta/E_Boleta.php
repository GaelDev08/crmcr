<div class="modal fade" id="E_Boleta" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Boleta</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
         </button>
      </div>
        <form  id="formEbanco">
         <input type="hidden" id="eid" >
        <div class="modal-body">
        <div class="row">
            <div class="form-group col-xs-12 col-md-12 col-lg-8">
                 <label>NOMBRE:</label>
                 <input type="text"  class="form-control" id="esnombre" placeholder="NOMBRE" pattern="^[a-z0-9A-Z_ ]*$" title="Ingrese solo letras y numeros" required>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-4">
                 <label>SIGLAS:</label>
                 <input type="text"  class="form-control" id="esigla" placeholder="AB" pattern="^[a-z0-9A-Z_ ]*$" title="Ingrese solo letras y numeros" required>
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
