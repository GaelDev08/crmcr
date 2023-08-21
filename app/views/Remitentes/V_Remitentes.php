<?php
  $bid=$id;
  $bempid=$ucomid;
  /**/
  include "M_Remitente.php";
  include "E_Remitente.php";
  include "D_Remitente.php";


  /*
  $sqlrem = "SELECT * from company_sender where com_id='1'";
    $rrem = mysqli_query($con,$sqlrem);
  */
 ?>
<div class="row">
  <input type="hidden" id="bempid" value="1">
  <input type="hidden" id="bid" value="1">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <div class="row" style="border-bottom:1px solid #021130;">
                <div class="col-lg-6">
                  <h4 ><i class="fas fa-user-friends"></i>&nbsp;Remitentes </h4>
                </div>
                  <div class="col-lg-6 text-right">
                      <a href="#" class="btn btn-success mb-2" id="btnNuevo"><i class="mdi mdi-plus mr-2"></i> Agregar</a>
                       
                  </div>
              </div>
               <!-- Nav tabs -->
               <ul class="nav nav-tabs mt-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Internos</span>    
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">Externos</span>    
                        </a>
                    </li>
                </ul>
        
                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="home" role="tabpanel">
                    <div class="table-responsive mt-3">
                    <table class="table datatable table-striped table-bordered nowrap" id="datacli" style="width: 100%;">
                        <thead class="thead bg-dark">
                            <tr class="text-center">
                              <th style="color: white;">#</th>
                              <th style="color: white;">Cedula</th>
                              <th style="color: white; width: 20%;">Raz&oacute;n Social</th>
                              <th style="color: white; width: 20%;">Email</th>
                              <th style="color: white; width: 20%;">Cargo</th>
                              <th style="color: white;">Estatus</th>
                              <th style="color: white;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody  class="text-center"></tbody>
                    </table>
                </div> 
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel">
                    <div class="table-responsive mt-3">
                    <table class="table datatable table-striped table-bordered nowrap" id="dataremi" style="width: 100%;">
                        <thead class="thead bg-dark">
                            <tr class="text-center">
                              <th style="color: white;">#</th>
                              <th style="color: white; ">Email</th>
                              <th style="color: white; ">N° Casos</th>
                              <th style="color: white; ">Fec. Registro</th>
                              <th style="color: white; ">Ult. Caso</th>
                            </tr>
                        </thead>
                        <tbody  class="text-center">
                        </tbody>
                    </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="functions/Remitentes/Remitentes.js"></script>

     