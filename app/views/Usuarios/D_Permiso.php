<div class="modal fade" id="D_Permiso" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Configurar Permiso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formDpermi">
            <div class="modal-body">
                <input type="text" name="dbuid" id="dbuid">
                <h5 aling="center" class="alert alert-info text-center" role="alert">
                    Esta acción se puede deshacer.
                </h5>
                <select class="form-control mt-4" name="lmod" id="lmod">
                    <option value="">--</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>
            <div class="modal-footer">
                 <button type="submit" class="btn btn-primary waves-effect waves-light">Eliminar</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>  </form>
            </div>
        </div>
    </div>
</div>
