$(document).ready(function() {
  var opcion, empid, uid, univel;
  empid = $.trim($('#empid').val());
  univel = $.trim($('#univel').val());
  uid = $.trim($('#uid').val());

    function listar(){
    opcion =9;
    $('#dataventa').DataTable().clear().destroy();
    $.ajax({
         url: "functions/Cotizacion/Cotizacion.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,empid:empid},
         success: function(data) {
           //RECORRER OBJETO JS
           let ObjetoJSS = JSON.parse(data);
           for (let itemm of ObjetoJSS){ var listar = itemm.data; }
           if (listar==0) {
           var  dataventa = $('#dataventa').DataTable({
               "autoWidth" : false,
               "columns":[null,null,null,null,null,null,null,null]
               });
           } else {
             opcion =0;
           var dataventa= $('#dataventa').DataTable({
                   "ajax":{
                      "url": "functions/Cotizacion/Cotizacion.php",
                       "method": 'POST', //usamos el metodo POST
                       "data":{opcion:opcion,empid:empid},
                       "dataSrc":""
                   },
                  "autoWidth"   : false,
                   "columns":[
                     {"data": "quo_id"},
                     {"data": "sell_fecha"},
                     {"data": "quo_code"},
                     {"data": "cli_name"},
                     {"data": "total"},
                     {"data": "status"},
                     {"defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-14 btnEdit' data-toggle='tooltip' data-placement='top' title='EDITAR'></button> <button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-14 btnElim' data-toggle='tooltip' 'data-placement='left' title='ELIMINAR'></button>"}
                   ],
                   "columnDefs": [
                   {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                     return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.quo_id+'" >'+row.quo_id+'</span>';
                      }
                    }
                 ]
               });
               dataventa.on( 'order.dt search.dt', function () {
               dataventa.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
               cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                });
               }).draw();
           }
         }
       });
    }
  listar();

///AGREGAR 
  $(document).on("click", "#btnNuevo", function(e){
     //DATOS FALTANTES
      e.preventDefault();
     $("#principal").hide();
     $('#opciones').load('views/Cotizacion/V_Detalles.php',{ "utipo": "NUEVO", "idusu": uid, "ftitulo": "Nueva Cotizaci&oacute;n", "empid": empid, "univel":univel, "codsh": 0, "otro": 0});
  });

   ///ELIMINAR
 $( document).on("click", ".btnElim", function(){
  fila = $(this).closest("tr");
  buid= fila.find('td:eq(0)').find('span').attr("data-id");
  qcode = fila.find('td:eq(2)').text();
  //DESPLEGAR EL MODAL CON LOS DATOS
  $("#formDshop").trigger("reset");
  $("#buid").val(buid);
  $("#qcode").val(qcode);
   $('#D_Venta').modal('show'); 

});

$('#formDshop').submit(function(e){
  opcion =14;
  buid= $.trim($('#buid').val());
  qcode = $.trim($('#qcode').val());
  e.preventDefault();
  $.ajax({
         url: "functions/Cotizacion/Cotizacion.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,buid:buid,empid:empid,qcode:qcode},
         success: function(data) {
           toastr.success('Se han procesado los datos correctamente','EXITO');
           listar();
         }
       });
   //CERRAR MODAL
   $('#D_Venta').modal('hide');
  });
 
///EDITAR
$(document).on("click", ".btnEdit", function(e){
  //DATOS FALTANTES
  fila = $(this).closest("tr");
  sellid= fila.find('td:eq(0)').find('span').attr("data-id");
  
  otro = 0;
  $("#principal").hide();
  $('#opciones').load('views/Cotizacion/V_Detalles.php',{ "utipo": "EDITAR", "idusu": uid, "ftitulo": "Editar Cotizaci&oacute;n", "empid": empid, "univel":univel, "codsh": sellid, "otro": otro});
});  

});

