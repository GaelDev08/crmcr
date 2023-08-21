$(document).ready(function() {
  var opcion, empid, tipofil, univel, uid,univel;
  empid = $.trim($('#empid').val());
  univel = $.trim($('#univel').val());
  uid = $.trim($('#uid').val());

  function listar_bitacora(fini,ffin,vuid){
    opcion =1;
    $('#datalista').DataTable().clear().destroy();
    $.ajax({
         url: "functions/Filtrar/Filtrar.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,empid:empid,vuid:vuid,fini:fini,ffin:ffin},
         success: function(data) {
           //RECORRER OBJETO JS
           let ObjetoJSS = JSON.parse(data);
           for (let itemm of ObjetoJSS){ var listar = itemm.data; }
           if (listar==0) {
           var  datalista = $('#datalista').DataTable({
               "autoWidth" : false,
               "info": false,
               "searching": true,
               "lengthChange": false,
               "paging": true,
               "columns":[null,null,null,null,null],
               buttons: ['excel', 'pdf'],
                  initComplete: function () {
                  this.api().buttons().container()
                      .appendTo( $('.col-md-6:eq(0)', this.api().table().container()));
                  }
               });
           } else {
           opcion =2;
           var datalista= $('#datalista').DataTable({
                   "ajax":{
                      "url": "functions/Filtrar/Filtrar.php",
                       "method": 'POST', //usamos el metodo POST
                       "data":{opcion:opcion,empid:empid,vuid:vuid,fini:fini,ffin:ffin},
                       "dataSrc":""
                   },
                  "lengthChange": false,
                  "autoWidth"   : false,
                  "searching": true,
                  "info": false,
                  "paging": true,
                  "columns":[
                     {"data": "rec_id"}, 
                     {"data": "rec_date"}, 
                     {"data": "rec_type"},
                     {"data": "rec_describe"},
                     {"data": "rec_user"}
                   ],
                   "columnDefs": [
                   {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                      return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.rec_id+'" >'+row.rec_id+'</span>';
                      }
                    }
                 ],
                 buttons: ['excel', 'pdf'],
                 initComplete: function () {
                 this.api().buttons().container()
                     .appendTo( $('.col-md-6:eq(0)', this.api().table().container()));
                 }
               });
               datalista.on( 'order.dt search.dt', function () {
               datalista.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
               cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                });
               }).draw();
           }
         }
       });
    }

    listar_bitacora('0000-00-00','0000-00-00','0');
    ///cancelar busqueda
    $(document).on("click", "#btncancel", function(e){
      e.preventDefault();
      $("#formFiltra").trigger("reset");
        $('#fecini').val(null).trigger('change');
        $('#fecfin').val(null).trigger('change');
        listar_bitacora('0000-00-00','0000-00-00','0');
    }); 
    
    $('#formFiltra').submit(function(e){
      e.preventDefault();
      fecini= $.trim($('#fecini').val());
      fecfin = $.trim($('#fecfin').val());
      listar_bitacora(fecini,fecfin,uid);
    });

    
    function listar_boleta(fini,ffin,statub){
      opcion =3;
      $('#databol').DataTable().clear().destroy();
      $.ajax({
           url: "functions/Filtrar/Filtrar.php",
           type: "POST",
           datatype:"json",
           data:  {opcion:opcion,empid:empid,statub:statub,fini:fini,ffin:ffin},
           success: function(data) {
             //RECORRER OBJETO JS
             let ObjetoJSS = JSON.parse(data);
             for (let itemm of ObjetoJSS){ var listar = itemm.data; }
             if (listar==0) {
             var  databol = $('#databol').DataTable({
                 "autoWidth" : false,
                 "info": false,
                 "searching": true,
                 "lengthChange": false,
                 "paging": true,
                 "columns":[null,null,null,null,null,null,null,null],
                 buttons: ['excel', 'pdf'],
                    initComplete: function () {
                    this.api().buttons().container()
                        .appendTo( $('.col-md-6:eq(0)', this.api().table().container()));
                    }
                 });
             } /*else {
             opcion =4;
             var databol= $('#databol').DataTable({
                     "ajax":{
                        "url": "functions/Filtrar/Filtrar.php",
                         "method": 'POST', //usamos el metodo POST
                         "data":{opcion:opcion,empid:empid,vuid:vuid,fini:fini,ffin:ffin},
                         "dataSrc":""
                     },
                    "lengthChange": false,
                    "autoWidth"   : false,
                    "searching": true,
                    "info": false,
                    "paging": true,
                    "columns":[
                       {"data": "rec_id"}, 
                       {"data": "rec_date"}, 
                       {"data": "rec_type"},
                       {"data": "rec_describe"},
                       {"data": "rec_user"}
                     ],
                     "columnDefs": [
                     {
                      "targets": 0,
                      "render": function (data, type, row, meta) {
                        return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.rec_id+'" >'+row.rec_id+'</span>';
                        }
                      }
                   ],
                   buttons: ['excel', 'pdf'],
                   initComplete: function () {
                   this.api().buttons().container()
                       .appendTo( $('.col-md-6:eq(0)', this.api().table().container()));
                   }
                 });
                 databol.on( 'order.dt search.dt', function () {
                 databol.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                 cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                  });
                 }).draw();
             }*/
           }
         });
      }
  
      listar_boleta('0000-00-00','0000-00-00',0);


      function listar_cliente(fini,ffin){
        opcion =5;
        $('#datacli').DataTable().clear().destroy();
        $.ajax({
             url: "functions/Filtrar/Filtrar.php",
             type: "POST",
             datatype:"json",
             data:  {opcion:opcion,empid:empid,fini:fini,ffin:ffin},
             success: function(data) {
               //RECORRER OBJETO JS
               let ObjetoJSS = JSON.parse(data);
               for (let itemm of ObjetoJSS){ var listar = itemm.data; }
               if (listar==0) {
               var  datacli = $('#datacli').DataTable({
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
               opcion =4;
               var databol= $('#databol').DataTable({
                       "ajax":{
                          "url": "functions/Filtrar/Filtrar.php",
                           "method": 'POST', //usamos el metodo POST
                           "data":{opcion:opcion,empid:empid,vuid:vuid,fini:fini,ffin:ffin},
                           "dataSrc":""
                       },
                      "lengthChange": false,
                      "autoWidth"   : false,
                      "searching": true,
                      "info": false,
                      "paging": true,
                      "columns":[
                         {"data": "rec_id"}, 
                         {"data": "rec_date"}, 
                         {"data": "rec_type"},
                         {"data": "rec_describe"},
                         {"data": "rec_user"}
                       ],
                       "columnDefs": [
                       {
                        "targets": 0,
                        "render": function (data, type, row, meta) {
                          return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.rec_id+'" >'+row.rec_id+'</span>';
                          }
                        }
                     ],
                     buttons: ['excel', 'pdf'],
                     initComplete: function () {
                     this.api().buttons().container()
                         .appendTo( $('.col-md-6:eq(0)', this.api().table().container()));
                     }
                   });
                   databol.on( 'order.dt search.dt', function () {
                   databol.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                   cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                    });
                   }).draw();
               }*/
             }
           });
        }
    listar_cliente('0000-00-00','0000-00-00');
    
    ////FORMATO DE FECHA
    function convertDateFormat(string) {
      var info = string.split('/');
      return info[2] + '-' + info[1] + '-' + info[0];
     }

});

