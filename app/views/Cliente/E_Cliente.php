<div class="modal fade" id="E_Cliente" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Editar Cliente</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
         </button>
      </div>
        <form  id="formEclien">
         <input type="hidden" id="eid" >
        <div class="modal-body">
          <div class="row">
          <div class="form-group col-xs-12 col-md-12 col-lg-3">
               <label>CEDULA:</label>
               <input class="form-control " name="epced" id="epced"  pattern="[0-9 ].{1,}" title="Ingrese solo numeros" required>
             </div>
             <div class="form-group col-xs-12 col-md-12 col-lg-6">
               <label>NOMBRE COMPLETO:</label>
               <input class="form-control " name="epcnom" id="epcnom"  pattern="[A-z0-9 ].{1,}" title="Ingrese solo letras" required>
             </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-3">
               <label>RUC / NIC:</label>
               <input class="form-control " name="pnum" id="epnum"  pattern="[0-9 ].{1,}" title="Ingrese solo numeros">
             </div>
           
             <div class="form-group col-xs-12 col-md-12 col-lg-6">
               <label>RAZON SOCIAL:</label>
               <input class="form-control " name="pnom" id="epnom"  pattern="[A-z0-9 ].{1,}" title="Ingrese solo letras">
             </div>
             <div class="form-group col-xs-12 col-md-12 col-lg-3">
               <label>ESTADO CIVIL:</label>
               <select class="form-control select2" name="eselcivil" id="eselcivil" required>
                <option value="">--</option>
                <option value="SOLTERO(A)">SOLTERO(A)</option>
                <option value="CASADO(A)">CASADO(A)</option>
                <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                <option value="VIUDO(A)">VIUDO(A)</option>
               </select>                     
             </div>
             <div class="form-group col-md-4 col-xs-12 col-lg-3">
              <label>TELEFONO :</label>
              <input class="form-control " name="eptel1" id="eptel1"  pattern="[0-9._%+-]{1,25}$" placeholder="+000000"  required>
            </div>
            <div class="form-group col-md-4 col-xs-12 col-lg-3">
              <label>EMAIL :</label>
              <input class="form-control" name="epmail" id="epmail"  title="Ingrese correo electronico" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="ejemplo@gmail.com">
            </div>
           
            <div class="form-group col-xs-12 col-md-12 col-lg-3">
              <label>CODIGO <small>POSTAL</small>:</label>
              <input class="form-control " name="epcode" id="epcode"  pattern="[0-9 ].{1,}" title="Ingrese solo numeros">
            </div>
            <div class="form-group col-md-8 col-xs-12 col-lg-6">
              <label>DIRECCION:</label>
              <input class="form-control" name="epdirec" id="epdirec"  placeholder="Ingrese Direccion" pattern="[A-z0-9 ].{1,}"  title="Ingrese solo letras o numeros" required>
            </div>
            
            <div class="form-group col-md-8 col-xs-12 col-lg-3">
              <label>ZONA / RUTA :</label>
              <input class="form-control" name="epruta" id="epruta"  placeholder="Ingrese punto de referencia" pattern="[A-z0-9 ].{1,}"  title="Ingrese solo letras o numeros" required>
            </div>
            <div class="form-group col-md-8 col-xs-12 col-lg-3">
              <label>OCUPACI&Oacute;N :</label>
              <input class="form-control" name="epocupa" id="epocupa"  pattern="[A-z0-9 ].{1,}"  title="Ingrese solo letras o numeros" required>
            </div>
            
            <div class="form-group col-md-8 col-xs-12 col-lg-6" id="dirtrab">
              <label>DIRECCION: <small>Trabajo</small> </label>
              <input class="form-control" name="epdirect" id="epdirect"  placeholder="Ingrese Direccion" title="Ingrese solo letras o numeros" required>
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
