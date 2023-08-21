$(document).ready(function() {
  var opcion, empid, bid;
  empid = $.trim($('#bempid').val());
  bid = $.trim($('#bid').val());

  function listar(){
    opcion =9;
    $('#datacatego').DataTable().clear().destroy();
    $.ajax({
         url: "functions/Categoria/Categoria.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,empid:empid},
         success: function(data) {
           //RECORRER OBJETO JS
           let ObjetoJSS = JSON.parse(data);
           for (let itemm of ObjetoJSS){ var listar = itemm.data; }
           if (listar==0) {
           var  datacatego = $('#datacatego').DataTable({
               "autoWidth" : false,
               "columns":[null,null,null,null]
               });
           } else {
           opcion =0;
           var datacatego= $('#datacatego').DataTable({
                   "ajax":{
                      "url": "functions/Categoria/Categoria.php",
                       "method": 'POST', //usamos el metodo POST
                       "data":{opcion:opcion,empid:empid},
                       "dataSrc":""
                   },
                  "autoWidth"   : false,
                   "columns":[
                    {"data": "cat_id"},
                    {"data": "cat_name"},
                    {"data": "status2"}, 
                    {"defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-14 btnEdit' data-toggle='tooltip' data-placement='top' title='EDITAR'></button> <button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-14 btnElim' data-toggle='tooltip' 'data-placement='left' title='HABILITAR / DESHABILITAR'></button> "}
                   ],
                   "columnDefs": [
                   {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                      return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.cat_id+'" >'+row.cat_id+'</span>';
                      }
                    }
                 ]
               });
               datacatego.on( 'order.dt search.dt', function () {
               datacatego.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
               cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                });
               }).draw();
           }
         }
       });
    }
    listar();

////////////////////////////////////////////////////////////////////////////////////
$("#btnNuevo").click(function(){
    $("#formCategoria").trigger("reset");
    $('#M_Categoria').modal('show');
});

$('#formCategoria').submit(function(e){
  opcion =1;
  mnombre = $.trim($('#mnombre').val());
  e.preventDefault();
  $.ajax({    
         url: "functions/Categoria/Categoria.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,mnombre:mnombre,empid:empid,bid:bid},
         success: function(data)
         {
           toastr.success('Se han procesado los datos correctamente','EXITO');
           listar();
         }
       });
   //CERRAR MODAL
   $('#M_Categoria').modal('hide');
  });

/////////////////////////////////////////////////////////////////////////////////////
///EDITAR 
 $( document).on("click", ".btnEdit", function(){
       fila = $(this).closest("tr");
       eid= fila.find('td:eq(0)').find('span').attr("data-id");
       emnombre = fila.find('td:eq(1)').text();
       $("#eid").val(eid);
       $("#emnombre").val(emnombre);
       //DESPLEGAR EL MODAL CON LOS DATOS
       $('#E_Categoria').modal('show');
 });

$('#formECategoria').submit(function(e){
   opcion =2;
   eid= $.trim($('#eid').val());
   emnombre =  $.trim($('#emnombre').val());
   e.preventDefault();
   $.ajax({
          url: "functions/Categoria/Categoria.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,eid:eid,emnombre:emnombre,empid:empid,bid:bid},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar();
          }
        });
    //CERRAR MODAL
    $('#E_Categoria').modal('hide');
   });

 /////////////////////////////////////////////////////////////////////////////
 ///ELIMINAR
 $( document).on("click", ".btnElim", function(){
       fila = $(this).closest("tr");
       buid= fila.find('td:eq(0)').find('span').attr("data-id");
       emnombre = fila.find('td:eq(1)').text(); 
       //DESPLEGAR EL MODAL CON LOS DATOS
       $("#formDCatego").trigger("reset");
       $("#buid").val(buid);
       $("#bcatnom").val(emnombre);
       $('#D_Categoria').modal('show');
 });

  $('#formDCatego').submit(function(e){
   opcion =3;
   buid= $.trim($('#buid').val());
   selmod = $.trim($('#selmod').val());
   bcatnom = $.trim($('#bcatnom').val());
   e.preventDefault();
   $.ajax({
          url: "functions/Categoria/Categoria.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,buid:buid,selmod:selmod,empid:empid,bid:bid,bcatnom:bcatnom},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar();
          }
        });
    //CERRAR MODAL
    $('#D_Categoria').modal('hide');
   });


  $(document).on("click", ".btnSub", function(e){
     //DATOS FALTANTES
     fila = $(this).closest("tr");
     buid= fila.find('td:eq(0)').find('span').attr("data-id");
     catnom = fila.find('td:eq(1)').text();
     $("#principal").hide();
     $('#opciones').load('views/Categoria/V_Subcategoria.php',{ "catid": buid, "bsemp": empid, "catnom": catnom});
  });  

});

