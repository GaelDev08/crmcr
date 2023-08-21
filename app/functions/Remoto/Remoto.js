$(document).ready(function() {
  var opcion , empid, bid;
  empid = $.trim($('#bempid').val());
  bid = $.trim($('#bid').val());
  $('.select2').select2();
    //////LISTAR ONCLICK
    $(function(){ //ready function
      $('#filnew').click(function(){ //click event
        listar_nuevas();
      });
    });
  
  function listar_nuevas(){
    opcion =9;
    $('#datanew').DataTable().clear().destroy();
    $.ajax({
         url: "functions/Remoto/Remoto.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,empid:empid},
         success: function(data) {
           //RECORRER OBJETO JS
           let ObjetoJSS = JSON.parse(data);
           for (let itemm of ObjetoJSS){ var listar = itemm.data; }
           if (listar==0) {
           var  datanew = $('#datanew').DataTable({
               "autoWidth" : false,
               "columns":[null,null,null,null,null,null], 
               "info": false,
               "searching": false,
               "lengthChange": false,
               "paging": false
               });
           } else {
             opcion =0;
           var datanew= $('#datanew').DataTable({
                   "ajax":{
                      "url": "functions/Remoto/Remoto.php",
                       "method": 'POST', //usamos el metodo POST
                       "data":{opcion:opcion,empid:empid},
                       "dataSrc":""
                   },
                  "autoWidth"   : false,
                   "columns":[
                    {"data": "ban_id"},
                    {"data": "ban_name"},
                    {"data": "status2"}, 
                    {"defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-14 btnEdit' data-toggle='tooltip' data-placement='top' title='EDITAR'></button> <button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-14 btnElim' data-toggle='tooltip' 'data-placement='left' title='HABILITAR / DESHABILITAR'></button>"}
                   ],
                   "columnDefs": [
                   {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                      return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.ban_id+'" >'+row.ban_id+'</span>';
                      }
                    }
                 ]
               });
               datanew.on( 'order.dt search.dt', function () {
               datanew.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
               cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                });
               }).draw();
           }
         }
       });
    }
  listar_nuevas();

  
  //////LISTAR ONCLICK
  $(function(){ //ready function
    $('#filopen').click(function(){ //click event
      listar_abiertas();
    });
  });

  function listar_abiertas(){
    opcion =8;
    $('#dataopen').DataTable().clear().destroy();
    $.ajax({
         url: "functions/Remoto/Remoto.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,empid:empid},
         success: function(data) {
           //RECORRER OBJETO JS
           let ObjetoJSS = JSON.parse(data);
           for (let itemm of ObjetoJSS){ var listar = itemm.data; }
           if (listar==0) {
           var  dataopen = $('#dataopen').DataTable({
               "autoWidth" : false,
               "columns":[null,null,null,null,null,null,null,null], 
               "info": false,
               "searching": false,
               "lengthChange": false,
               "paging": false
               });
           } /*else {
             opcion =7;
           var dataopen= $('#dataopen').DataTable({
                   "ajax":{
                      "url": "functions/Remoto/Remoto.php",
                       "method": 'POST', //usamos el metodo POST
                       "data":{opcion:opcion,empid:empid},
                       "dataSrc":""
                   },
                  "autoWidth"   : false,
                   "columns":[
                    {"data": "ban_id"},
                    {"data": "ban_name"},
                    {"data": "status2"}, 
                    {"defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-14 btnEdit' data-toggle='tooltip' data-placement='top' title='EDITAR'></button> <button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-14 btnElim' data-toggle='tooltip' 'data-placement='left' title='HABILITAR / DESHABILITAR'></button>"}
                   ],
                   "columnDefs": [
                   {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                      return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.ban_id+'" >'+row.ban_id+'</span>';
                      }
                    }
                 ]
               });
               dataopen.on( 'order.dt search.dt', function () {
               dataopen.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
               cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                });
               }).draw();
           }*/
         }
       });
    }
    
  //////LISTAR ONCLICK
  $(function(){ //ready function
    $('#filhist').click(function(){ //click event
      listar_historico('0000-00-00','0000-00-00');  
    });
  });
    
  function listar_historico(fini,ffin){
      opcion =6;
      $('#datahisto').DataTable().clear().destroy();
      $.ajax({
           url: "functions/Remoto/Remoto.php",
           type: "POST",
           datatype:"json",
           data:  {opcion:opcion,empid:empid,fini:fini,ffin:ffin},
           success: function(data) {
             //RECORRER OBJETO JS
             let ObjetoJSS = JSON.parse(data);
             for (let itemm of ObjetoJSS){ var listar = itemm.data; }
             if (listar==0) {
             var  datahisto = $('#datahisto').DataTable({
              "autoWidth" : false,
              "info": false,
              "searching": true,
              "lengthChange": false,
              "paging": true,
              "columns":[null,null,null,null,null,null,null],
              buttons: ['excel', 'pdf'],
                 initComplete: function () {
                 this.api().buttons().container()
                     .appendTo( $('.col-md-6:eq(0)', this.api().table().container()));
                 }
              });
             } /*else {
               opcion =5;
             var datahisto= $('#datahisto').DataTable({
                     "ajax":{
                        "url": "functions/Remoto/Remoto.php",
                         "method": 'POST', //usamos el metodo POST
                         "data": {opcion:opcion,empid:empid,fini:fini,ffin:ffin},
                         "dataSrc":""
                     },
                    "autoWidth"   : false,
                     "columns":[
                      {"data": "ban_id"},
                      {"data": "ban_name"},
                      {"data": "status2"}, 
                      {"defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-14 btnEdit' data-toggle='tooltip' data-placement='top' title='EDITAR'></button> <button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-14 btnElim' data-toggle='tooltip' 'data-placement='left' title='HABILITAR / DESHABILITAR'></button>"}
                     ],
                     "columnDefs": [
                     {
                      "targets": 0,
                      "render": function (data, type, row, meta) {
                        return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.ban_id+'" >'+row.ban_id+'</span>';
                        }
                      }
                   ]
                 });
                 datahisto.on( 'order.dt search.dt', function () {
                 datahisto.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                 cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                  });
                 }).draw();
             }*/
           }
         });
    }

  
  /////AGREGAR
  $("#btnNuevo").click(function(){
    $("#formRemoto").trigger("reset");
   // $('#bolremi').select2();
    $('#bolremi').val(null).trigger('change');
    $('#M_Remoto').modal('show');
  });
  ///FILTRAR
  $("#btnBusca").click(function(){
    $('#bolrem').val(null).trigger('change');
    $('#bbext').val('');
    $('#F_Remoto').modal('show');
  });

    /*


$('#formBanco').submit(function(e){
  opcion =1;
  bnombre = $.trim($('#bnombre').val());
  e.preventDefault();
  $.ajax({    
         url:  "functions/Banco/Banco.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,bnombre:bnombre,empid:empid},
         success: function(data)
         {
           toastr.success('Se han procesado los datos correctamente','EXITO');
           listar();
         }
       });
   //CERRAR MODAL
   $('#M_Banco').modal('hide');
  });

///EDITAR 
 $( document).on("click", ".btnEdit", function(){
       fila = $(this).closest("tr");
       eid= fila.find('td:eq(0)').find('span').attr("data-id");
       esnombre = fila.find('td:eq(1)').text();
       $("#eid").val(eid);
       $("#esnombre").val(esnombre);
       //DESPLEGAR EL MODAL CON LOS DATOS
       $('#E_Banco').modal('show');
 });

$('#formEbanco').submit(function(e){
   opcion =2;
   eid= $.trim($('#eid').val());
   esnombre = $.trim($('#esnombre').val());
   e.preventDefault();
   $.ajax({
          url: "functions/Banco/Banco.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,eid:eid,esnombre:esnombre},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar();
          }
        });
    //CERRAR MODAL
    $('#E_Banco').modal('hide');
   });

 ///ELIMINAR BANCO
 $( document).on("click", ".btnElim", function(){
       fila = $(this).closest("tr");
       buid= fila.find('td:eq(0)').find('span').attr("data-id");
       //DESPLEGAR EL MODAL CON LOS DATOS
       $("#formDBanco").trigger("reset");
       $("#buid").val(buid);
       $('#D_Banco').modal('show');
 });

$('#formDBanco').submit(function(e){
 opcion =3;
 buid= $.trim($('#buid').val());
 selmod = $.trim($('#selmod').val());
 e.preventDefault();
 $.ajax({
        url: "functions/Banco/Banco.php",
        type: "POST",
        datatype:"json",
        data:  {opcion:opcion,buid:buid,selmod:selmod},
        success: function(data) {
          toastr.success('Se han procesado los datos correctamente','EXITO');
          listar();
        }
      });
  //CERRAR MODAL
  $('#D_Banco').modal('hide');
 });
*/

});


