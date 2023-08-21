<div class="modal fade" id="M_Remitente" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Remitente <small>Interno</small></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formClient">
            <div class="modal-body">
            <div class="row">
            <div class="form-group col-xs-12 col-md-12 col-lg-4">
               <label>CEDULA:</label>
               <input class="form-control " name="pced" id="pced"  pattern="[0-9 ].{1,}" title="Ingrese solo numeros" required>
             </div>
           
             <div class="form-group col-xs-12 col-md-12 col-lg-8">
               <label>NOMBRES Y APELLIDOS:</label>
               <input class="form-control " name="pcnom" id="pcnom"  pattern="[A-z0-9 ].{1,}" title="Ingrese solo letras" required>
             </div>
             <!--<div class="form-group col-md-4 col-xs-12 col-lg-3">
              <label>TELEFONO :</label>
              <input class="form-control " name="ptel1" id="ptel1"  pattern="[0-9._%+-]{1,25}$" placeholder="+000000">
             </div>-->
            <div class="form-group col-xs-12 col-md-12 col-lg-6">
               <label>CARGO:</label>
               <input class="form-control " name="pcargo" id="pcargo"  pattern="[A-z0-9 ].{1,}" title="Ingrese solo letras" required>
             </div>
            <div class="form-group col-md-4 col-xs-12 col-lg-6">
              <label>EMAIL :</label>
              <input type="email" class="form-control" name="pmail" id="pmail"  title="Ingrese correo electronico" placeholder="ejemplo@gmail.com">
            </div>
            
           
              
            </div>  </div>
            <div class="modal-footer">
                <button type="submit" id="btnClienv" class="btn btn-success waves-effect waves-light">Guardar</button>
                <button type="button" id="btnCancel" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>  
            </div>
            </form>
        </div>
    </div>
</div>
