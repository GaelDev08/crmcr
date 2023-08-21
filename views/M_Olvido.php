<div class="modal fade" id="M_Olvido" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Recuperar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmajax1">
              <input type="hidden" id="euidp" value="<?=$id;?>">
            <div class="modal-body">
              <div class="row">
              
                <div class="form-group col-xs-12 col-md-12 col-lg-12">
                 <label><strong>EMAIL:</strong></label>
                 <input class="form-control" id="puemail"  required>
                </div>
                
              </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark waves-effect waves-light">Enviar</button>
                <button type="button" id="btnLimpio" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>  
            </div>
            </form>
        </div>
    </div>
</div>
