<?php
 $bid=1;  $bempid=1;


 $sqlema="SELECT * FROM company_sender WHERE  com_id='1'  order by sen_email";
  $rema=mysqli_query($con,$sqlema); 
  include "M_Remoto.php";
  include "F_Remoto.php";
 /*
 include "E_Banco.php"; 
 include "D_Banco.php";
 */
 ?>
<div class="row">
  <input type="hidden" id="bempid" value="<?=$bempid;?>">
  <input type="hidden" id="bid" value="<?=$bid;?>">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <div class="row" style="border-bottom:1px solid #021130;">
                <div class="col-lg-6">
                  <h4 ><i class="fas fa-list"></i>&nbsp;Boletas Remoto </h4>
                </div>
                  <div class="col-lg-6 text-right">
                  <!--    <a href="#" class="btn btn-success mb-2" id="btnNuevo"><i class="mdi mdi-plus mr-2"></i> Agregar</a>-->
                  </div>
              </div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs mt-3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#newbol" role="tab" id="filnew">
                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                        <span class="d-none d-sm-block">Boletas Nuevas</span>    
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#openbol" role="tab" id="filopen">
                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                        <span class="d-none d-sm-block">Boletas Abiertas</span>    
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#histbol" role="tab" id="filhist">
                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                        <span class="d-none d-sm-block">Historico</span>    
                    </a>
                </li>
            </ul>
        
                <!-- Tab panes -->
            <div class="tab-content p-3 text-muted">
            <div class="tab-pane active" id="newbol" role="tabpanel">
            <div class="row" >
                <div class="col-lg-6">
                <div class="form-group col-xs-12 col-md-12 col-lg-8">
                 <label># Boleta:</label>
                 <div class="input-group">
                 <input class="form-control text-uppercase" style="background-color: #d2d6de;"  placeholder="M-00000001" id="presfac">     
                  <div class="input-group-append">
                    <button class="btn btn-success" type="button" id="btnAgprov"><i class="mdi mdi-file-excel"></i></button>
                    </div>
                  </div>
                 </div>

                </div>
                  <div class="col-lg-6 text-right mt-4">
                     <a href="#" class="btn btn-primary mb-2" id="btnBusca"><i class="mdi mdi-email-search mr-2"></i> Buscar</a>
                     <a href="#" class="btn btn-warning mb-2" id="btnRefil"><i class="mdi mdi-email-sync-outline mr-2"></i> Refrescar</a>
                     <a href="#" class="btn btn-success mb-2" id="btnNuevo"><i class="mdi mdi-email-plus mr-2"></i> Agregar</a>
                  </div>
              </div>   
                <div class="table-responsive mt-1">
                    <table class="table datatable table-striped table-bordered nowrap" id="datanew" style="width: 100%;">
                        <thead class="thead"  style="background:#343a40; color: white;">
                            <tr class="text-center">
                              <th style="color: white;">#</th>
                              <th style="color: white;">Boleta</th>
                              <th style="color: white;">Remitente</th>
                              <th style="color: white;">Usuario</th>
                              <th style="color: white;">Fecha Incio</th>
                              <th style="color: white;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody  class="text-center"></tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="openbol" role="tabpanel">
            <div class="row" >
                <div class="col-lg-3">&nbsp;</div>
                <div class="col-lg-6">
                <div class="form-group col-xs-12 col-md-12 col-lg-12">
                 <label># Boleta:</label>
                 <div class="input-group">
                 <input class="form-control text-uppercase" style="background-color: #d2d6de;"  placeholder="M-00000001" id="presfac">     
                  <div class="input-group-append">
                    <button class="btn btn-success" type="button" id="btnAgprov"><i class="mdi mdi-file-excel"></i></button>
                    </div>
                  </div>
                 </div>

                </div>
                  <div class="col-lg-3">&nbsp;</div>
              </div> 
                <div class="table-responsive mt-3">
                  <table class="table datatable" id="dataopen" style="width: 100%;">
                        <thead class="thead"  style="background:#343a40; color: white;">
                            <tr class="text-center">
                              <th style="color: white;">#</th>
                              <th style="color: white;">Boleta</th>
                              <th style="color: white;">Remitente</th>
                              <th style="color: white;">Asunto</th>
                              <th style="color: white;">Usuario</th>
                              <th style="color: white;">Tiempo <small>Transcurrido</small></th>
                              <th style="color: white;">Estado <small>Mensajes</small></th>
                              <th style="color: white;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody  class="text-center"></tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="histbol" role="tabpanel">
            <form id="formFiling">
              <div class="row mt-2">
              <div class="col-lg-3">&nbsp;</div>
              <div class="form-group col-md-6 col-xs-12 col-lg-2">
                   <label><strong>FECHA <small>INICIO</small>:</strong></label>
                   <input type="date" class="form-control" name="fecini" id="fecini" required>
                </div>
               
                <div class="form-group col-md-6 col-xs-12 col-lg-2">
                   <label><strong>FECHA <small>FIN</small>:</strong></label>
                   <input type="date" class="form-control" name="fecfin" id="fecfin" required>
                </div>       
                <div class="form-group col-xs-12 col-md-12 col-lg-2" style="margin-top:0.9rem;" >
                  <button type="submit" id="btnaggre" class="btn btm-sm btn-primary waves-effect waves-light mt-3">Buscar</button>
                  <button type="reset" id="btncancel" class="btn btm-sm btn-danger waves-effect waves-light mt-3">Cancelar</button>
                </div>
                <div class="col-lg-3">&nbsp;</div>
              </div> 
              </form>  


            <div class="table-responsive mt-3">
                    <table class="table datatable" id="datahisto" style="width: 100%;">
                        <thead class="thead"  style="background:#343a40; color: white;">
                            <tr class="text-center">
                              <th style="color: white;">#</th>
                              <th style="color: white;">Boleta</th>
                              <th style="color: white;">Remitente</th>
                              <th style="color: white;">Asunto</th>
                              <th style="color: white;">Usuario</th>
                              <th style="color: white;">Fecha <small>Terminada</small></th>
                              <th style="color: white;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody  class="text-center"></tbody>
                    </table>
                </div>
            </div>
            </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="functions/Remoto/Remoto.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2();

  });
</script>


     