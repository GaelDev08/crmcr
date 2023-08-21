<div class="modal fade" id="M_Cliente" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Cliente</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formClient">
            <div class="modal-body">
            <div class="row">
            <div class="form-group col-xs-12 col-md-12 col-lg-3">
               <label>CEDULA:</label>
               <input class="form-control " name="pced" id="pced"  pattern="[0-9 ].{1,}" title="Ingrese solo numeros" required>
             </div>
           
             <div class="form-group col-xs-12 col-md-12 col-lg-6">
               <label>NOMBRES Y APELLIDOS:</label>
               <input class="form-control " name="pcnom" id="pcnom"  pattern="[A-z0-9 ].{1,}" title="Ingrese solo letras" required>
             </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-3">
               <label>RUC / NIC:</label>
               <input class="form-control " name="pnum" id="pnum"  pattern="[0-9 ].{1,}" title="Ingrese solo numeros">
             </div>
           
             <div class="form-group col-xs-12 col-md-12 col-lg-6">
               <label>RAZON SOCIAL:</label>
               <input class="form-control " name="pnom" id="pnom"  pattern="[A-z0-9 ].{1,}" title="Ingrese solo letras">
             </div>
             <div class="form-group col-xs-12 col-md-12 col-lg-3">
               <label>ESTADO CIVIL:</label>
               <select class="form-control select2" name="selcivil" id="selcivil" required>
                <option value="">--</option>
                <option value="SOLTERO(A)">SOLTERO(A)</option>
                <option value="CASADO(A)">CASADO(A)</option>
                <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                <option value="VIUDO(A)">VIUDO(A)</option>
               </select>                     
             </div>
             <div class="form-group col-md-4 col-xs-12 col-lg-3">
              <label>TELEFONO :</label>
              <input class="form-control " name="ptel1" id="ptel1"  pattern="[0-9._%+-]{1,25}$" placeholder="+000000"  required>
            </div>
            <div class="form-group col-md-4 col-xs-12 col-lg-3">
              <label>EMAIL :</label>
              <input class="form-control" name="pmail" id="pmail"  title="Ingrese correo electronico" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="ejemplo@gmail.com">
            </div>
            
           
            <div class="form-group col-md-8 col-xs-12 col-lg-6">
              <label>DIRECCION: <small>Casa</small> </label>
              <input class="form-control" name="pdirec" id="pdirec"  placeholder="Ingrese Direccion" pattern="[A-z0-9 ].{1,}"  title="Ingrese solo letras o numeros" required>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-3">
              <label>CODIGO <small>POSTAL</small>:</label>
              <input class="form-control " name="pcode" id="pcode"  pattern="[0-9 ].{1,}" title="Ingrese solo numeros">
            </div>
            
            <div class="form-group col-md-8 col-xs-12 col-lg-3">
              <label>ZONA / RUTA :</label>
              <input class="form-control" name="pruta" id="pruta"  placeholder="Ingrese punto de referencia" pattern="[A-z0-9 ].{1,}"  title="Ingrese solo letras o numeros" required>
            </div>
            <div class="form-group col-md-8 col-xs-12 col-lg-3">
              <label>OCUPACI&Oacute;N :</label>
              <input class="form-control" name="pocupa" id="pocupa"  pattern="[A-z0-9 ].{1,}"  title="Ingrese solo letras o numeros" required>
            </div>
            
            <div class="form-group col-md-8 col-xs-12 col-lg-6" id="dirtrab">
              <label>DIRECCION: <small>Trabajo</small> </label>
              <input class="form-control" name="pdirect" id="pdirect"  placeholder="Ingrese Direccion" title="Ingrese solo letras o numeros" required>
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
