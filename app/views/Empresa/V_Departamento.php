<?php 
    include "../../../functions/BD.php";
    $eemp = $_POST['eemp'];
    $enivel = $_POST['enivel'];
    $enom = $_POST['enom'];
    $usuid = $_POST['usuid'];

    include "M_Departamento.php";
    include "E_Departamento.php";
    include "D_Departamento.php";
    //include "M_Cuenta.php";
    
 ?>


<div class="row" id="opcion">
    <input type="hidden" id="empbb" value="<?=$eemp;?>">
    <input type="hidden" id="actuse" value="<?=$usuid;?>">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <div class="row" style="border-bottom:1px solid #021130;">
                <div class="col-lg-6">
                  <h4 ><i class="fas fa-city "></i>&nbsp; <?=$enom;?> <small>Departamentos</small> </h4>
                </div>
                   <div class="col-lg-6 text-right">
                     <a href="#" class="btn btn-success mb-2" id="btnBank"><i class="mdi mdi-plus mr-2"></i> Agregar</a>
                    <button class="btn btn-warning mb-2" id="btnRegre"><i class="mdi mdi-arrow-left mr-2"></i> Atras</button>
                  </div>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table datatable table-striped table-bordered nowrap" id="datadepa" style="width: 100%;">
                        <thead class="thead"  style="background:#343a40; color: white;">
                            <tr class="text-center">
                              <th style="background:#041043; color: white;">#</th>
                              <th style="background:#041043; color: white; width: 60%;">Descripcion</th>
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
<script type="text/javascript">
  $(document).ready(function() {
    var opcion, empbb, actuse;
    empbb = $.trim($('#empbb').val());
    actuse = $.trim($('#actuse').val());
    ///
    function listar_banco(){
    opcion =8;
    $('#datadepa').DataTable().clear().destroy();
    $.ajax({
         url: "functions/Empresa/Empresa.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,empbb:empbb},
         success: function(data) {
           //RECORRER OBJETO JS
           let ObjetoJSS = JSON.parse(data);
           for (let itemm of ObjetoJSS){ var listar = itemm.data; }
           if (listar==0) {
           var  datadepa = $('#datadepa').DataTable({
               "autoWidth" : false,
               "columns":[null,null,null,null]
               });
           } else {
             opcion =7;
           var datadepa= $('#datadepa').DataTable({
                   "ajax":{
                      "url": "functions/Empresa/Empresa.php",
                       "method": 'POST', //usamos el metodo POST
                       "data":{opcion:opcion,empbb:empbb},
                       "dataSrc":""
                   },
                  "autoWidth"   : false,
                   "columns":[
                     {"data": "det_id"},
                     {"data": "det_name"},
                     {"data": "status"},
                     {"defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-14 btnEditb' data-toggle='tooltip' data-placement='top' title='EDITAR'></button> <button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-14 btnElim' data-toggle='tooltip' 'data-placement='left' title='ELIMINAR SUCURSAL'></button>"}
                   ],
                   "columnDefs": [
                   {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                      //console.log(row.usu_id)
                      return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.det_id+'" >'+row.det_id+'</span>';
                      }
                    }
                 ]
               });
               datadepa.on( 'order.dt search.dt', function () {
               datadepa.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
               cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                });
               }).draw();
           }
         }
       });
    }
  listar_banco();

 ///AGREGAR 
 $("#btnBank").click(function(){
    $("#formDepart").trigger("reset");
    $('#M_Departa').modal('show');
 }); 

$('#formDepart').submit(function(e){
  opcion =6;
  bnombre = $.trim($('#bnombre').val());
  e.preventDefault();
  $.ajax({    
       url: "functions/Empresa/Empresa.php",
       type: "POST",
       datatype:"json",
       data:  {opcion:opcion,bnombre:bnombre,empbb:empbb,actuse:actuse},
       success: function(data)
       {
         toastr.success('Se han procesado los datos correctamente','EXITO');
         listar_banco();
       }
    });
   //CERRAR MODAL
   $('#M_Departa').modal('hide');
  });

///EDITAR 
 $( document).on("click", ".btnEditb", function(){
       fila = $(this).closest("tr");
       ceid= fila.find('td:eq(0)').find('span').attr("data-id");
       emnum = fila.find('td:eq(1)').text();
       //DESPLEGAR EL MODAL CON LOS DATOS
       $("#formEdepa").trigger("reset");
       $("#ceid").val(ceid);
       $("#enombre").val(emnum);
       $('#E_Departa').modal('show');
 });


$('#formEdepa').submit(function(e){
   opcion =5;
   ceid= $.trim($('#ceid').val());
   enombre = $.trim($('#enombre').val());
   e.preventDefault();
   $.ajax({
          url: "functions/Empresa/Empresa.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,ceid:ceid,empbb:empbb,enombre:enombre,actuse:actuse},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar_banco();
          }
        });
    //CERRAR MODAL
    $('#E_Departa').modal('hide');
   });


 ///ELIMINAR
  $( document).on("click", ".btnElim", function(){
       fila = $(this).closest("tr");
       dbuid= fila.find('td:eq(0)').find('span').attr("data-id");
       unombre = fila.find('td:eq(1)').text();
       //DESPLEGAR EL MODAL CON LOS DATOS
       $("#formDcuenta").trigger("reset");
       $('#D_Departa').modal('show');
       $("#dbuid").val(dbuid);
       $("#unombre").val(unombre);
       
  });


$('#formDdepa').submit(function(e){
   opcion =4;
   dbuid= $.trim($('#dbuid').val());
   selmod = $.trim($('#selmod').val());
   unombre = $.trim($('#unombre').val());
   e.preventDefault();
   $.ajax({
          url: "functions/Empresa/Empresa.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,dbuid:dbuid,selmod:selmod,empbb:empbb,actuse:actuse,unombre:unombre},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar_banco();
          }
        });
    //CERRAR MODAL
    $('#D_Departa').modal('hide');
 });

/**/

$("#btnAgban").click(function(){
    $("#formBanco").trigger("reset");
    $('#M_Cuenta').modal('hide');
    $('#M_Banco').modal('show');
});


$('#formBanco').submit(function(e){
   opcion =3;
   bnombre= $.trim($('#bnombre').val());
   e.preventDefault();
   $.ajax({
          url: "functions/Empresa/Empresa.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,bnombre:bnombre,empbb:empbb},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar_banco();
             $('#selban').load('views/Empresa/Cuentab.php', {"idemp": empbb });
          }
        });
    //CERRAR MODAL
    $('#M_Banco').modal('hide');
    $('#M_Cuenta').modal('show');
 });


$("#btnCancelb").click(function(){
    $('#M_Banco').modal('hide');
    $('#M_Cuenta').modal('show');
});



 $("#btnRegre").click(function(e){
     e.preventDefault();
     $("#opcion").hide();
     $('#principal').show();
  });


  });
</script>