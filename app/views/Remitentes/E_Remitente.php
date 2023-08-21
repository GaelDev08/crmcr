<div class="modal fade" id="E_Remitente" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Remitente</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
         </button>
      </div>
        <form  id="formEclien">
         <input type="hidden" id="eid" >
        <div class="modal-body">
          <div class="row">
          <div class="form-group col-xs-12 col-md-12 col-lg-4">
               <label>CEDULA:</label>
               <input class="form-control " name="epced" id="epced"  pattern="[0-9 ].{1,}" title="Ingrese solo numeros" required>
             </div>
             <div class="form-group col-xs-12 col-md-12 col-lg-8">
               <label>NOMBRE COMPLETO:</label>
               <input class="form-control " name="epcnom" id="epcnom"  pattern="[A-z0-9 ].{1,}" title="Ingrese solo letras" required>
             </div>
            <div class="form-group col-md-4 col-xs-12 col-lg-6">
              <label>EMAIL :</label>
              <input type="email" class="form-control" name="epmail" id="epmail"  title="Ingrese correo electronico" placeholder="ejemplo@gmail.com">
            </div>
            <div class="form-group col-md-8 col-xs-12 col-lg-6">
              <label>CARGO :</label>
              <input class="form-control" name="epocupa" id="epocupa"  pattern="[A-z0-9 ].{1,}"  title="Ingrese solo letras o numeros" required>
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
