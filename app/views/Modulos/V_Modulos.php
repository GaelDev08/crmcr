<?php
 /* include "M_Eliminar.php"; */
  $bempid=$ucomid;
  include "M_Modulos.php"; 
  include "E_Modulos.php";
  include "D_Modulos.php";
 ?>
<div class="row" id="principal">
    <input type="hidden" id="univel" value="<?=$Nivel;?>">
    <input type="hidden" id="empid" value="<?=$ucomid;?>">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <div class="row" style="border-bottom:1px solid #021130;">
                <div class="col-lg-6">
                  <h4 ><i class="fas fa-cogs"></i>&nbsp;Modulos </h4>
                </div>
                  <div class="col-lg-6 text-right">
                      <a href="#" class="btn btn-success mb-2" id="btnNuevo"><i class="mdi mdi-plus mr-2"></i> Agregar</a>
                  </div>
              </div>
                <div class="table-responsive mt-3">
                    <table class="table datatable table-striped table-bordered nowrap" id="datamodulo" style="width: 100%;">
                        <thead class="thead"  style="background:#343a40; color: white;">
                            <tr class="text-center">
                              <th style="background:#041043; color: white;">#</th>
                              <th style="background:#041043; color: white;">Descripci&oacute;n</th>
                              <th style="background:#041043; color: white;">Precio</th>
                              <th style="background:#041043; color: white;">Estatus</th>
                              <th style="background:#041043; color: white;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody  class="text-center"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="opciones"></div>
<script type="text/javascript" src="functions/Modulos/Modulos.js"></script>

     