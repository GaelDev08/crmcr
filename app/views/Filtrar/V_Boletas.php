<?php 
    $bempid=$ucomid;
    $bnivel = $Nivel;
?>
<div class="row" id="principal">
    <input type="hidden" id="empid" value="1">
    <input type="hidden" id="univel" value="1">
    <input type="hidden" id="uid" value="1">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <div class="row" style="border-bottom:1px solid #021130;">
                <div class="col-lg-6">
                  <h4 ><i class="fas fa-list"></i>&nbsp;Reportes <small>Boletas</small> </h4>
                </div>
                <div class="col-lg-6 text-right">
                <!-- <a href="#" class="btn btn-success mb-2" id="btnNuevo"><i class="mdi mdi-plus mr-2"></i> Agregar</a> -->
                </div>
              </div>
              <form id="formFiltra">
              <div class="row mt-2">
              <div class="form-group col-md-6 col-xs-12 col-lg-2">
                   &nbsp;
                </div>
                <div class="form-group col-md-6 col-xs-12 col-lg-2">
                   <label><strong>DESDE:</strong></label>
                   <input type="date" class="form-control" name="fecini" id="fecini" required>
                </div>
                <div class="form-group col-md-6 col-xs-12 col-lg-2">
                   <label><strong>HASTA:</strong></label>
                   <input type="date" class="form-control" name="fecfin" id="fecfin" required>
                </div>
              
                <div class="form-group col-xs-12 col-md-12 col-lg-2">
                 <label><strong>ESTATUS: </strong></label>
                 <select class="form-control select2" id="selpago" name="selpago">
                    <option value="">--</option>
                    <option value="R">Revisadas</option>
		                <option value="S">Solucionadas</option>
                    
                 </select>
                </div>
                <div class="form-group col-xs-12 col-md-12 col-lg-2" style="margin-top:0.9rem;" >
                  <button type="submit" id="btnaggre" class="btn btm-sm btn-primary waves-effect waves-light mt-3">Buscar</button>
                  <button type="reset" id="btncancel" class="btn btm-sm btn-danger waves-effect waves-light mt-3">Cancelar</button>
                </div>
                <div class="form-group col-md-6 col-xs-12 col-lg-2">
                   &nbsp;
                </div>
              </div> 
              </form>          
                <div class="table-responsive mt-1">
                <table class="table datatable table-striped table-bordered nowrap" id="databol" style="width: 100%;">
                    <thead class="thead"  style="background:#343a40; color: white;">
                         <tr class="text-center bg-dark">
                            <th style="color: white;">#</th>
                            <th style="color: white;">Fecha</th>
                            <th style="color: white;">Boleta</th>
                            <th style="color: white;">Usuario</th>
                            <th style="color: white;">Dias</th>
                            <th style="color: white;">Horas</th>
                            <th style="color: white;">Casos</th>
                            <th style="color: white;">Detalles</th>
                        </tr>
                    </thead>
                    <tbody class="text-center BusquedaRapida"></tbody>
                    
                </table>	
                </div>
            </div>
        </div>
    </div>
</div>
<div id="opciones"></div>
<script type="text/javascript" src="functions/Filtrar/Filtrar.js"></script>

