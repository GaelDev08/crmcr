<?php
  $bid=$id;
  $bempid=$ucomid;
  /**/
  include "M_Cliente.php";
  include "E_Cliente.php";
  include "D_Cliente.php";
 ?>
<div class="row">
  <input type="hidden" id="bempid" value="1">
  <input type="hidden" id="bid" value="1">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <div class="row" style="border-bottom:1px solid #021130;">
                <div class="col-lg-6">
                  <h4 ><i class="fas fa-user-friends"></i>&nbsp;Clientes </h4>
                </div>
                  <div class="col-lg-6 text-right">
                      <a href="#" class="btn btn-success mb-2" id="btnNuevo"><i class="mdi mdi-plus mr-2"></i> Agregar</a>
                       
                  </div>
                  
              </div>
                <div class="table-responsive mt-3">
                    <table class="table datatable table-striped table-bordered nowrap" id="datacli" style="width: 100%;">
                        <thead class="thead bg-dark">
                            <tr class="text-center">
                              <th style="color: white;">#</th>
                              <th style="color: white;">Cedula</th>
                              <th style="color: white; width: 30%;">Raz&oacute;n Social</th>
                              <th style="color: white;">Celular</th>
                              <th style="color: white; width: 20%;">Email</th>
                              <th style="color: white;">Estatus</th>
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
<script type="text/javascript" src="functions/Cliente/Cliente.js"></script>

     