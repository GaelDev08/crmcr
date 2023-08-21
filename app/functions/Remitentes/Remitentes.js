$(document).ready(function() {
  var opcion, empid, bid;
  empid = $.trim($('#bempid').val());
  bid = $.trim($('#bid').val());



  function listar(){
    opcion =9;
    $('#datacli').DataTable().clear().destroy();
    $.ajax({
         url: "functions/Remitentes/Remitentes.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,empid:empid},
         success: function(data) {
           //RECORRER OBJETO JS
           let ObjetoJSS = JSON.parse(data);
           for (let itemm of ObjetoJSS){ var listar = itemm.data; }
           if (listar==0) {
           var  datacli = $('#datacli').DataTable({
               "autoWidth" : false,
               "columns":[null,null,null,null,null,null,null]
               });
           } else {
           opcion =0;
           var datacli= $('#datacli').DataTable({
                   "ajax":{
                      "url": "functions/Remitentes/Remitentes.php",
                       "method": 'POST', //usamos el metodo POST
                       "data":{opcion:opcion,empid:empid},
                       "dataSrc":""
                   },
                  "autoWidth"   : false,
                   "columns":[
                    {"data": "per_id"},
                    {"data": "per_ruc"},
                    {"data": "per_name"},
                    {"data": "per_email"},
                    {"data": "per_occupation"},
                    {"data": "status2"}, 
                    {"defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-14 btnEdit' data-toggle='tooltip' data-placement='top' title='EDITAR'></button> <button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-14 btnElim' data-toggle='tooltip' 'data-placement='left' title='HABILITAR / DESHABILITAR'></button>"}
                   ],
                   "columnDefs": [
                   {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                      return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.per_id+'" >'+row.per_id+'</span>';
                      }
                    }
                 ]
               });
               datacli.on( 'order.dt search.dt', function () {
               datacli.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
               cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                });
               }).draw();
           }
         }
       });
    }
    listar();

  $('.select2').select2();
  ///AGREGAR 
  $("#btnNuevo").click(function(){
      $("#formClient").trigger("reset");
      $('#selcivil').val(null).trigger('change');
      $('#M_Remitente').modal('show');
  });

  //////////////////////////////////////////////////////////////////////////////
  ///NRO DE CEDULA
  /*$('#pced').on('focusout', function(){
    var pced = $(this).val();
    pced = $.trim($('#pced').val());
    opcion = 5;
    if (pced !='') {
      $.ajax({
             url: "functions/Cliente/Cliente.php",
             type: "POST",
             datatype:"json",
             data:  {opcion:opcion,empid:empid,pced:pced },
             success: function(data) {
               var cadena = data;
               let ObjetoJS = JSON.parse(cadena);
               //RECORRER OBJETO
               for (let item of ObjetoJS){
                   var vericed = item.vericed;
               }
               if (vericed ==1) {
                 toastr.error('NUMERO DE CEDULA YA EXISTE','ALERTA');
                 $('#btnClienv').attr("disabled", true); 
               } else {
                 $('#btnClienv').attr("disabled", false); 
               }
               
             }
           });
    }
  });*/

 
    $('#formClient').submit(function(e){
      opcion =1;
      pced = $.trim($('#pced').val()); 
      pcnom = $.trim($('#pcnom').val()); 
      pmail = $.trim($('#pmail').val());
      pcargo = $.trim($('#pcargo').val()); 
      e.preventDefault();
      $.ajax({    
            url: "functions/Remitentes/Remitentes.php",
            type: "POST",
            datatype:"json",
            data:  {opcion:opcion,bid:bid,empid:empid,pced:pced,pcnom:pcnom,pmail:pmail,pcargo:pcargo},
            success: function(data)
            {
              toastr.success('Se han procesado los datos correctamente','EXITO');
              listar();
            }
          });
      //CERRAR MODAL
      $('#M_Remitente').modal('hide');
      });

  var directrab;
///EDITAR 
 $(document).on("click", ".btnEdit", function(){
       fila = $(this).closest("tr");
       eid= fila.find('td:eq(0)').find('span').attr("data-id");
       epced = fila.find('td:eq(1)').text();
       epcnom = fila.find('td:eq(2)').text();
       epmail = fila.find('td:eq(3)').text();
       epcarg = fila.find('td:eq(4)').text();

       $("#eid").val(eid);
       $("#epced").val(epced);
       $("#epcnom").val(epcnom);
       $("#epmail").val(epmail);
       $("#epocupa").val(epcarg);
       
   //DESPLEGAR EL MODAL CON LOS DATOS
   $('#E_Remitente').modal('show');
 });

 

$('#formEclien').submit(function(e){
   opcion =2;
   eid= $.trim($('#eid').val());
   epmail = $.trim($('#epmail').val());
   epced = $.trim($('#epced').val());
   epcnom = $.trim($('#epcnom').val()); 
   epocupa = $.trim($('#epocupa').val()); 
   e.preventDefault();
   $.ajax({
          url: "functions/Remitentes/Remitentes.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,eid:eid,empid:empid,bid:bid,epmail:epmail,epced:epced,epcnom:epcnom,epocupa:epocupa},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar();
          }
        });
    //CERRAR MODAL
    $('#E_Remitente').modal('hide');
   });

 ///ELIMINAR
 $( document).on("click", ".btnElim", function(){
       fila = $(this).closest("tr");
       buid= fila.find('td:eq(0)').find('span').attr("data-id");
       bnombre = fila.find('td:eq(3)').text();
       $("#formDclient").trigger("reset");
       $("#buid").val(buid);
       $("#bnombre").val(bnombre);
       //DESPLEGAR EL MODAL CON LOS DATOS
    
       $('#D_Remitente').modal('show');
 });

  $('#formDclient').submit(function(e){
   opcion =3;
   buid= $.trim($('#buid').val());
   selmod = $.trim($('#selmod').val());
   bnombre = $.trim($('#bnombre').val());
   e.preventDefault();
   $.ajax({
          url: "functions/Remitentes/Remitentes.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,buid:buid,selmod:selmod,empid:empid,bid:bid,bnombre:bnombre},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar();
          }
        });
    //CERRAR MODAL
    $('#D_Remitente').modal('hide');
   });


   //$('#dataremi').DataTable();
   listar_externo();
   function listar_externo(){
    opcion =8;
    $('#dataremi').DataTable().clear().destroy();
    $.ajax({
         url: "functions/Remitentes/Remitentes.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,empid:empid},
         success: function(data) {
           //RECORRER OBJETO JS
           let ObjetoJSS = JSON.parse(data);
           for (let itemm of ObjetoJSS){ var listar = itemm.data; }
           if (listar==0) {
           var  dataremi = $('#dataremi').DataTable({
               "autoWidth" : false,
               "columns":[null,null,null,null,null]
               });
           } else {
           opcion =7;
           var dataremi= $('#dataremi').DataTable({
                   "ajax":{
                      "url": "functions/Remitentes/Remitentes.php",
                       "method": 'POST', //usamos el metodo POST
                       "data":{opcion:opcion,empid:empid},
                       "dataSrc":""
                   },
                  "autoWidth"   : false,
                   "columns":[
                    {"data": "sen_id"},
                    {"data": "sen_email"},
                    {"data": "sen_case"},
                    {"data": "sen_created"},
                    {"data": "sen_updated"}
                   ],
                   "columnDefs": [
                   {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                      return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.sen_id+'" >'+row.sen_id+'</span>';
                      }
                    }
                 ]
               });
               dataremi.on( 'order.dt search.dt', function () {
               dataremi.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
               cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                });
               }).draw();
           }
         }
       });
    }

/**/
});

