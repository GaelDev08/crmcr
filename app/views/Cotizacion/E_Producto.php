<div class="modal fade" id="E_Producto" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEProducto">
              <input type="hidden" id="eprodu">
              <input type="hidden" id="canter">
            <div class="modal-body">
              <div class="row">
               <div class="form-group col-xs-12 col-md-12 col-lg-12">
                 <label>NOMBRE:</label>
                 <input type="text"  class="form-control" id="enombre" placeholder="NOMBRE" title="Ingrese solo letras y numeros" disabled>
               </div>
               <div class="form-group col-md-4 col-xs-12 col-lg-6">
                <label>CANTIDAD:</label>
                <input class="form-control" name="ecant" id="ecant" pattern="^[0-9]*$" title="Ingrese solo numeros"  placeholder="0"  required>
             </div>
             <div class="form-group col-md-4 col-xs-12 col-lg-6">
                <label>PRECIO: <small>Venta</small></label>
                <input class="form-control number" name="ecvent" id="ecvent"  placeholder="0"  required>
             </div>

            </div>  
          </div>
            <div class="modal-footer">
                <button type="submit" id="btnEnvio2" class="btn btn-primary waves-effect waves-light">Guardar</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>  
            </div>
            </form>
        </div>
    </div>
</div>
