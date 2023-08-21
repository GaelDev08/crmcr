<?php
 $bid=$id;
 $bempid=$ucomid;
 include "M_Categoria.php"; 
 include "E_Categoria.php";
 include "D_Categoria.php";
 ?>
<div class="row">
  <input type="hidden" id="bempid" value="<?=$bempid;?>">
  <input type="hidden" id="bid" value="<?=$bid;?>">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <div class="row" style="border-bottom:1px solid #021130;">
                <div class="col-lg-6">
                  <h4 ><i class="fas fa-list"></i>&nbsp;Categorias </h4>
                </div>
                  <div class="col-lg-6 text-right">
                      <a href="#" class="btn btn-success mb-2" id="btnNuevo"><i class="mdi mdi-plus mr-2"></i> Agregar</a>
                  </div>
              </div>
                <div class="table-responsive mt-3">
                    <table class="table datatable table-striped table-bordered nowrap" id="datacatego" style="width: 100%;">
                        <thead class="thead"  style="background:#343a40; color: white;">
                            <tr class="text-center bg-dark">
                              <th style="color: white;">#</th>
                              <th style="color: white;">Descripci&oacute;n</th>
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
<script type="text/javascript" src="functions/Categoria/Categoria.js"></script>

     