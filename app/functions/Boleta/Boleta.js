$(document).ready(function() {
  var opcion , empid, bid;
  empid = $.trim($('#bempid').val());
  bid = $.trim($('#bid').val());
   
  
  function listar(){
    opcion =9;
    $('#databanco').DataTable().clear().destroy();
    $.ajax({
         url: "functions/Boleta/Boleta.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,empid:empid},
         success: function(data) {
           //RECORRER OBJETO JS
           let ObjetoJSS = JSON.parse(data);
           for (let itemm of ObjetoJSS){ var listar = itemm.data; }
           if (listar==0) {
           var  databanco = $('#databanco').DataTable({
               "autoWidth" : false,
               "columns":[null,null,null,null,null]
               });
           } else {
             opcion =0;
           var databanco= $('#databanco').DataTable({
                   "ajax":{
                      "url": "functions/Boleta/Boleta.php",
                       "method": 'POST', //usamos el metodo POST
                       "data":{opcion:opcion,empid:empid},
                       "dataSrc":""
                   },
                  "autoWidth"   : false,
                   "columns":[
                    {"data": "typ_id"},
                    {"data": "typ_name"},
                    {"data": "typ_acronym"},
                    {"data": "status2"}, 
                    {"defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-14 btnEdit' data-toggle='tooltip' data-placement='top' title='EDITAR'></button> <button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-14 btnElim' data-toggle='tooltip' 'data-placement='left' title='HABILITAR / DESHABILITAR'></button>"}
                   ],
                   "columnDefs": [
                   {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                      return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.typ_id+'" >'+row.typ_id+'</span>';
                      }
                    }
                 ]
               });
               databanco.on( 'order.dt search.dt', function () {
               databanco.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
               cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                });
               }).draw();
           }
         }
       });
    }
    listar();

/////AGREGAR BANCO
$("#btnNuevo").click(function(){
    $("#formBanco").trigger("reset");
    $('#M_Boleta').modal('show');
 }); 

$('#formBanco').submit(function(e){
  opcion =1;
  bnombre = $.trim($('#bnombre').val());
  bsigla = $.trim($('#bsigla').val());
  e.preventDefault();
  $.ajax({    
         url:  "functions/Boleta/Boleta.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,bnombre:bnombre,empid:empid,bsigla:bsigla,bid:bid},
         success: function(data)
         {
           toastr.success('Se han procesado los datos correctamente','EXITO');
           listar();
         }
       });
   //CERRAR MODAL
   $('#M_Boleta').modal('hide');
  });

///EDITAR 
 $( document).on("click", ".btnEdit", function(){
       fila = $(this).closest("tr");
       eid= fila.find('td:eq(0)').find('span').attr("data-id");
       esnombre = fila.find('td:eq(1)').text();
       esigla = fila.find('td:eq(2)').text();
       $("#eid").val(eid);
       $("#esnombre").val(esnombre);
       $("#esigla").val(esigla);
       //DESPLEGAR EL MODAL CON LOS DATOS
       $('#E_Boleta').modal('show');
 });

$('#formEbanco').submit(function(e){
   opcion =2;
   eid= $.trim($('#eid').val());
   esnombre = $.trim($('#esnombre').val());
   esigla = $.trim($('#esigla').val());
   e.preventDefault();
   $.ajax({
          url: "functions/Boleta/Boleta.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,eid:eid,esnombre:esnombre,esigla:esigla,bid:bid,empid:empid},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar();
          }
        });
    //CERRAR MODAL
    $('#E_Boleta').modal('hide');
   });

 ///ELIMINAR BANCO
 $( document).on("click", ".btnElim", function(){
       fila = $(this).closest("tr");
       buid= fila.find('td:eq(0)').find('span').attr("data-id");
       esnombre = fila.find('td:eq(1)').text();
       //DESPLEGAR EL MODAL CON LOS DATOS
       $("#formDBanco").trigger("reset");
       $("#buid").val(buid);
       $("#bboln").val(esnombre);
       $('#D_Boleta').modal('show');
 });

  $('#formDBanco').submit(function(e){
  opcion =3;
  buid= $.trim($('#buid').val());
  selmod = $.trim($('#selmod').val());
  bboln = $.trim($('#bboln').val());
  e.preventDefault();
  $.ajax({
        url: "functions/Boleta/Boleta.php",
        type: "POST",
        datatype:"json",
        data:  {opcion:opcion,buid:buid,selmod:selmod,bid:bid,bboln:bboln,empid:empid},
        success: function(data) {
          toastr.success('Se han procesado los datos correctamente','EXITO');
          listar();
        }
      });
  //CERRAR MODAL
  $('#D_Boleta').modal('hide');
 });

});

