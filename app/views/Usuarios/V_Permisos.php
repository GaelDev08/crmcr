<?php 
  ///
  $idusu = $_POST['idusu'];
  $empid = $_POST['empid'];
  $actusu = $_POST['actuse'];
  $enombre = $_POST['enombre'];
  $eemail = $_POST['eemail'];
  include "M_Permiso.php";
  include "D_Permiso.php";
 ?>

<div class="row" id="opcion">
    <input type="hidden" id="bempr" value="<?=$empid;?>">
    <input type="hidden" id="bid" value="<?=$idusu;?>">
    <input type="hidden" id="bus" value="<?=$actusu;?>">
    <input type="hidden" id="bmail" value="<?=$eemail;?>">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
               <div class="row" style="border-bottom:1px solid #021130;">
                <div class="col-lg-6">
                  <h4 ><i class="fas fa-users"></i>&nbsp;Usuario: <small><?=$enombre;?></small></h4>
                </div>
                  <div class="col-lg-6 text-right">
                       <a href="#" class="btn btn-success mb-2" id="btnNuev"><i class="mdi mdi-plus mr-2"></i> Agregar</a>
                       <button class="btn btn-warning mb-2" id="btnRegre"><i class="mdi mdi-arrow-left mr-2"></i> Atras</button>
                  </div>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table datatable" id="datapermi" style="width: 100%;">
                        <thead class="thead"  style="background:#343a40; color: white;">
                            <tr class="text-center bg-dark">
                              <th style="color: white;">#</th>
                              <th style="color: white; width:70%;">Menu</th>
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
<script type="text/javascript">
  $(document).ready(function() {
  var bempr, bid, bus, bmail;  
  bempr = $.trim($('#bempr').val());
  bmail = $.trim($('#bmail').val());
  bid = $.trim($('#bid').val());
  bus = $.trim($('#bus').val());
  ///
  $('#almod').load('views/Usuarios/Modulos.php', {"idemp": bid });

  ////
  listar_permisos();
  function listar_permisos(){
    opcion =12;
    $('#datapermi').DataTable().clear().destroy();
    $.ajax({
         url: "functions/Usuarios/Usuarios.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,empid:bempr,bid:bid},
         success: function(data) {
           //RECORRER OBJETO JS
           let ObjetoJSS = JSON.parse(data);
           for (let itemm of ObjetoJSS){ var listar = itemm.data; }
           if (listar==0) {
           var  datapermi = $('#datapermi').DataTable({
               "autoWidth" : false,
               "columns":[null,null,null,null]
               });
           } else {
             opcion =13;
             var datapermi= $('#datapermi').DataTable({
                   "ajax":{
                      "url": "functions/Usuarios/Usuarios.php",
                       "method": 'POST', //usamos el metodo POST
                       "data":{opcion:opcion,empid:bempr,bid:bid},
                       "dataSrc":""
                   },
                  "autoWidth"   : false,
                   "columns":[
                     {"data": "mod_id"},
                     {"data": "mod_name"},
                     {"data": "status"},
                     {"defaultContent": "<button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-14 btnUpt' data-toggle='tooltip' 'data-placement='left' title='ELIMINAR USUARIO'></button>"}
                   ],
                   "columnDefs": [
                   {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                     return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.mod_id+'" >'+row.mod_id+'</span>';
                      }
                    }
                 ]
               });
               datapermi.on( 'order.dt search.dt', function () {
               datapermi.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
               cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                });
               }).draw();
           }
         }
       });
    }

    ///btnUpt
  $(document).on("click", ".btnUpt", function(){
   fila = $(this).closest("tr");
   buid= fila.find('td:eq(0)').find('span').attr("data-id");
   //DESPLEGAR EL MODAL CON LOS DATOS
   $("#formDpermi").trigger("reset");
   $("#dbuid").val(buid);
   $('#D_Permiso').modal('show');
  });

  $('#formDpermi').submit(function(e){
   opcion =14;
   dbuid= $.trim($('#dbuid').val());
   selmod= $.trim($('#lmod').val());
   e.preventDefault();
   $.ajax({
          url: "functions/Usuarios/Usuarios.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,dbuid:dbuid,bid:bid,bus:bus,bempr:bempr,selmod:selmod,bmail:bmail},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar_permisos();
          }
        });
    //CERRAR MODAL
    $('#D_Permiso').modal('hide');
   });

  $(document).on("click", "#btnNuev", function(e){
    $('#almod').load('views/Usuarios/Modulos.php', {"idemp": bid });
    $("#formIpermi").trigger("reset");
    $('#M_Permiso').modal('show');
  }); 

  $('#formIpermi').submit(function(e){
   opcion =15;
   almod= $.trim($('#almod').val());
   e.preventDefault();
   $.ajax({
          url: "functions/Usuarios/Usuarios.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,bid:bid,bus:bus,bempr:bempr,almod:almod,bmail:bmail},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar_permisos();
            
          }
        });
    //CERRAR MODAL
    $('#M_Permiso').modal('hide');
   });


  $("#btnRegre").click(function(e){
     e.preventDefault();
     $("#opcion").hide();
     $('#principal').show();
  });

  function refresh() {
    setTimeout(function () {
        location.reload()
    }, 2500);
  }

  });

</script>