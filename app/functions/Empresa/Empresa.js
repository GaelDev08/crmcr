$(document).ready(function() {
 
  var opcion, empid;
  empid = $.trim($('#empid').val());
  univel = $.trim($('#univel').val());
 
    function listar(){
    opcion =9;
    $('#datausua').DataTable().clear().destroy();
    $.ajax({
         url: "functions/Usuarios/Usuarios.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,empid:empid,univel:univel},
         success: function(data) {
           //RECORRER OBJETO JS
           let ObjetoJSS = JSON.parse(data);
           for (let itemm of ObjetoJSS){ var listar = itemm.data; }
           if (listar==0) {
           var  datausua = $('#datausua').DataTable({
               "autoWidth" : false,
               "columns":[null,null,null,null,null]
               });
           } else {
             opcion =0;
           var datausua= $('#datausua').DataTable({
                   "ajax":{
                      "url": "functions/Usuarios/Usuarios.php",
                       "method": 'POST', //usamos el metodo POST
                       "data":{opcion:opcion,empid:empid,univel:univel},
                       "dataSrc":""
                   },
                  "autoWidth"   : false,
                   "columns":[
                     {"data": "use_id"},
                     {"data": "use_name_lastname"},
                     {"data": "use_email"},
                     {"data": "grupo"},
                     {"data": "status"}
                     
                   ],
                   "columnDefs": [
                   {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                      //console.log(row.usu_id)
                      return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.use_id+'" >'+row.use_id+'</span>';
                      }
                    }
                 ]
               });
               datausua.on( 'order.dt search.dt', function () {
               datausua.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
               cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                });
               }).draw();
           }
         }
       });
    }
  listar();

  $("#btnClosep").click(function(){
    $("#publicid").hide();
  });
  

});

