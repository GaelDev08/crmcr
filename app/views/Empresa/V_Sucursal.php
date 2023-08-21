<?php 
    $eemp = $_POST['eemp'];
    $usuid = $_POST['usuid'];
    $enom = $_POST['enom'];
    /**/
    include "M_Sucursal.php";
    include "E_Sucursal.php";
    include "D_Sucursal.php";
 ?>


<div class="row" id="opcion">
    <input type="hidden" id="empbb" value="<?=$eemp;?>">
    <input type="hidden" id="usubb" value="<?=$usuid;?>">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <div class="row" style="border-bottom:1px solid #021130;">
                <div class="col-lg-6">
                  <h4 ><i class="fas fa-city "></i>&nbsp; <?=$enom;?>  <small>Sucursales</small></h4>
                </div>
                   <div class="col-lg-6 text-right">
                     <a href="#" class="btn btn-success mb-2" id="btnSucur"><i class="mdi mdi-plus mr-2"></i> Agregar</a>
                    <button class="btn btn-warning mb-2" id="btnRegre"><i class="mdi mdi-arrow-left mr-2"></i> Atras</button>
                  </div>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table datatable table-striped table-bordered nowrap" id="datasucur" style="width: 100%;">
                        <thead class="thead"  style="background:#343a40; color: white;">
                            <tr class="text-center">
                              <th style="background:#041043; color: white;">#</th>
                              <th style="background:#041043; color: white;">Nombre</th>
                              <th style="background:#041043; color: white;">Direcci&oacute;n</th>
                              <th style="background:#041043; color: white;">Tel&eacute;fono</th>
                              <th style="background:#041043; color: white;">Tipo</th>
                              <th style="background:#041043; color: white;">Responsable</th>
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
    var opcion, empbb, usubb;
    empbb = $.trim($('#empbb').val());
    usubb = $.trim($('#usubb').val());

    function listar(){
    opcion =10;
    $('#datasucur').DataTable().clear().destroy();
    $.ajax({
         url: "functions/Empresa/Empresa.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,empid:empbb},
         success: function(data) {
           //RECORRER OBJETO JS
           let ObjetoJSS = JSON.parse(data);
           for (let itemm of ObjetoJSS){ var listar = itemm.data; }
           if (listar==0) {
           var  datasucur = $('#datasucur').DataTable({
               "autoWidth" : false,
               "columns":[null,null,null,null,null,null,null,null]
               });
           } else {
             opcion =11;
           var datasucur= $('#datasucur').DataTable({
                   "ajax":{
                      "url": "functions/Empresa/Empresa.php",
                       "method": 'POST', //usamos el metodo POST
                       "data":{opcion:opcion,empid:empbb},
                       "dataSrc":""
                   },
                  "autoWidth"   : false,
                   "columns":[
                     {"data": "off_id"},
                     {"data": "off_name"},
                     {"data": "off_direction"},
                     {"data": "off_phone"},
                     {"data": "tiposuc"},
                     {"data": "off_responsible"},
                     {"data": "statuss"},
                     {"defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-14 btnEdit' data-toggle='tooltip' data-placement='top' title='EDITAR'></button> <button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-14 btnElim' data-toggle='tooltip' 'data-placement='left' title='ELIMINAR SUCURSAL'></button>"}
                   ],
                   "columnDefs": [
                   {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                      //console.log(row.usu_id)
                      return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.off_id+'" >'+row.off_id+'</span>';
                      }
                    }
                 ]
               });
               datasucur.on( 'order.dt search.dt', function () {
               datasucur.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
               cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                });
               }).draw();
           }
         }
       });
    }
  listar();
//////////////////////////////////////////////////////////////////////////////////////
 $("#btnSucur").click(function(){
    $("#formSucur").trigger("reset");
    $('#M_Sucursal').modal('show');
 }); 

 $('#formSucur').submit(function(e){
  opcion =12;
  snombre = $.trim($('#snombre').val());
  sdirecion = $.trim($('#sdirecion').val());
  stele = $.trim($('#stele').val());
  stipo = $.trim($('#stipo').val());
  sresponsa = $.trim($('#sresponsa').val());
  e.preventDefault();
  $.ajax({    
        url: "functions/Empresa/Empresa.php",
        type: "POST",
        datatype:"json",
         data:  {opcion:opcion,empid:empbb,usubb:usubb,snombre:snombre,sdirecion:sdirecion,
          stele:stele,stipo:stipo,sresponsa:sresponsa},
         success: function(data)
      {
       toastr.success('Se han procesado los datos correctamente','EXITO');
       listar();
      }
    });
   //CERRAR MODAL
   $('#M_Sucursal').modal('hide');
  });

  ///EDITAR 
 $( document).on("click", ".btnEdit", function(){
       fila = $(this).closest("tr");
       ceid= fila.find('td:eq(0)').find('span').attr("data-id");
       enom = fila.find('td:eq(1)').text();
       edir = fila.find('td:eq(2)').text();
       etel = fila.find('td:eq(3)').text();
       eres = fila.find('td:eq(5)').text();
       //DESPLEGAR EL MODAL CON LOS DATOS
       $("#formeSucur").trigger("reset");
       $("#eid").val(ceid);
       $("#esnombre").val(enom);
       $("#esdirecion").val(edir);
       $("#estele").val(etel);
       $("#esresponsa").val(eres);
      $('#E_Sucursal').modal('show');
 });

 $('#formeSucur').submit(function(e){
   opcion =13;
   eid= $.trim($('#eid').val());
   esnombre = $.trim($('#esnombre').val());
   esdirecion = $.trim($('#esdirecion').val());
   estele = $.trim($('#estele').val());
   esresponsa = $.trim($('#esresponsa').val());
   estipo = $.trim($('#estipo').val());
   e.preventDefault();
   $.ajax({
          url: "functions/Empresa/Empresa.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,empid:empbb,usubb:usubb,eid:eid,esnombre:esnombre,esdirecion:esdirecion,
            estele:estele,esresponsa:esresponsa,estipo:estipo},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar();
          }
        });
    //CERRAR MODAL
    $('#E_Sucursal').modal('hide');
   });

   ///
   $( document).on("click", ".btnElim", function(){
       fila = $(this).closest("tr");
       ceid= fila.find('td:eq(0)').find('span').attr("data-id");
       enom = fila.find('td:eq(1)').text();
       //DESPLEGAR EL MODAL CON LOS DATOS
       $("#formDessucu").trigger("reset");
       $("#obuid").val(ceid); 
       $("#osucc").val(enom); 
      $('#D_Sucursal').modal('show');
  });

  $('#formDessucu').submit(function(e){
   opcion =14;
   obuid= $.trim($('#obuid').val());
   selmod = $.trim($('#selmod').val());
   osucc = $.trim($('#osucc').val());
   e.preventDefault();
   $.ajax({
          url: "functions/Empresa/Empresa.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,empid:empbb,usubb:usubb,obuid:obuid,selmod:selmod,osucc:osucc},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar();
          }
        });
    //CERRAR MODAL
    $('#D_Sucursal').modal('hide');
   });




 $("#btnRegre").click(function(e){
     e.preventDefault();
     $("#opcion").hide();
     $('#principal').show();
  });

  
  });
</script>