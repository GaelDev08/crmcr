<?php
 include "../functions/BD.php";
 $sqldepar = "SELECT * FROM module where mod_status='1' ORDER BY mod_id";
 $resdepar = mysqli_query($con,$sqldepar);
 include "M_Usuario.php";
 include "D_Usuario.php";
 include "E_Usuario.php";
?>
<div class="row" id="principal">
    <input type="hidden" id="empid" value="1">
    <input type="hidden" id="univel" value="1">
    <input type="hidden" id="actuse" value="1">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <div class="row" style="border-bottom:1px solid #021130;">
                <div class="col-lg-6">
                  <h4 ><i class="fas fa-users"></i>&nbsp;Usuarios </h4>
                </div>
                  <div class="col-lg-6 text-right">
                      <a href="#" class="btn btn-success mb-2" id="btnNuevo"><i class="mdi mdi-plus mr-2"></i> Agregar</a>
                  </div>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table datatable table-striped table-bordered nowrap" id="datausuario" style="width: 100%;">
                        <thead class="thead"  style="background:#343a40; color: white;">
                            <tr class="text-center bg-dark">
                              <th style="color: white;">#</th>
                              <th style="color: white;">Nombres y Apellidos</th>
                              <th style="color: white;">Email</th>
                              <th style="color: white;">Tipo</th>
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
<script type="text/javascript" src="functions/Usuarios/Usuarios.js"></script>

     