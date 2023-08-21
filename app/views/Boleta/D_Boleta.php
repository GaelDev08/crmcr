<div class="modal fade" id="D_Boleta" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Configurar Boleta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formDBanco">
            <div class="modal-body">
                <input type="hidden" name="buid" id="buid">
                <input type="hidden" name="bboln" id="bboln">
                <h5 aling="center" class="alert alert-info text-center" role="alert">
                    Esta acción se puede deshacer.
                </h5>
                <select class="form-control mt-4" name="selmod" id="selmod">
                    <option value="">--</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>    
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>  </form>
            </div>
        </div>
    </div>
</div>
