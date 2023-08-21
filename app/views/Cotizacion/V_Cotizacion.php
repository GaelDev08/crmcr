<?php
 /* */
include "D_Venta.php";
///
$sql0="SELECT Validasku('CT','$ucomid')";
$res0= mysqli_query($con,$sql0);

?>
<div class="row" id="principal">
    <input type="hidden" id="empid" value="<?=$ucomid;?>">
    <input type="hidden" id="univel" value="<?=$Nivel;?>">
    <input type="hidden" id="uid" value="<?=$id;?>">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <div class="row" style="border-bottom:1px solid #021130;">
                <div class="col-lg-6">
                  <h4 ><i class="fas fa-clipboard-list"></i>&nbsp;Cotizaciones </h4>
                </div>
                  <div class="col-lg-6 text-right">
                      <a href="#" class="btn btn-success mb-2" id="btnNuevo"><i class="mdi mdi-plus mr-2"></i> Agregar</a>
                  </div>
                  
                </div>
              
                   <div class="table-responsive mt-3">
                      <table class="table datatable table-striped table-bordered nowrap" id="dataventa" style="width: 100%;">
                          <thead class="thead"  style="background:#343a40; color: white;">
                              <tr class="text-center bg-dark">
                                <th style="color: white;">#</th>
                                <th style="color: white;">Fecha</th>
                                <th style="color: white;">Ref.</th>
                                <th style="color: white; width: 30%;">Cliente</th>
                                <th style="color: white;">Total</th>
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
<div id="opciones"></div>
<script type="text/javascript" src="functions/Cotizacion/Cotizacion.js"></script>

     