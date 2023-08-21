<div class="modal fade" id="F_Remoto" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Buscar Boleta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formDBanco">
            <div class="modal-body">
            <div class="row">
            <div class="form-group col-xs-12 col-md-12 col-lg-5">
              <label>REMITENTE:</label>
                <select class="form-control select2" id="bolrem" name="bolrem">
                 <?php
                       echo "<option value=''>--</option>";
                       if($rowmon=mysqli_fetch_array($rema,MYSQLI_ASSOC)){
                       do{
                       echo '<option value="'.$rowmon['sen_id'].'">'.$rowmon['sen_email'].'</option>';
                       } while($rowmon=mysqli_fetch_array($rema,MYSQLI_ASSOC));
                       }  
                 ?>
               </select>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-4">
              <label># Boleta:</label>
              <input class="form-control text-uppercase" style="background-color: #d2d6de;"  placeholder="M-00000001" id="bbext">      
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-3 mt-3" >
                  <button type="submit" id="btnaggre" class="btn btm-sm btn-primary waves-effect waves-light mt-3"><i class="mdi mdi-email-search"></i> Buscar</button>
                  <button type="reset" id="btncancel" class="btn btm-sm btn-danger waves-effect waves-light mt-3"><i class="mdi mdi-cancel"></i> Cancelar</button>
                </div>
            
            
            
            </div> 
            <div class="mt-2">
                <div class="card bg-success text-white-50">
                    <div class="card-body" style="padding:0.5rem;">
                        <h5 class="mt-0 text-white" align="center"><i class="mdi mdi-alert-circle-outline mr-3"></i>Detalles</h5>
                    </div>
                </div>
              </div>
            
            <div class="col-xs-12 col-md-12 col-lg-12">
            <table class="table table-sm m-0" id="dataitems" style="width: 100%;">
                    <thead class="thead">
                        <tr class="text-center">
                            <th># Boleta</th>
                            <th>Remitente</th>
                            <th>Asunto</th>
                            <th>Usuario</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">   </tbody>
                
                </table>
                </div>
                <br><br><br>
            </div>
            <!--<div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>  
            </div>-->
            </form>
        </div>
    </div>
</div>
