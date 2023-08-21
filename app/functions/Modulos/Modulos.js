$(document).ready(function() {
  var opcion , empid, univel;
  empid = $.trim($('#empid').val());
  univel = $.trim($('#univel').val());
  function listar(){
    opcion =9;
    $('#datamodulo').DataTable().clear().destroy();
    $.ajax({
         url: "functions/Modulos/Modulos.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion},
         success: function(data) {
           //RECORRER OBJETO JS
           let ObjetoJSS = JSON.parse(data);
           for (let itemm of ObjetoJSS){ var listar = itemm.data; }
           if (listar==0) {
           var  datamodulo = $('#datamodulo').DataTable({
               "autoWidth" : false,
               "columns":[null,null,null,null]
               });
           } else {
             opcion =0;
           var datamodulo= $('#datamodulo').DataTable({
                   "ajax":{
                      "url": "functions/Modulos/Modulos.php",
                       "method": 'POST', //usamos el metodo POST
                       "data":{opcion:opcion},
                       "dataSrc":""
                   },
                  "autoWidth"   : false,
                   "columns":[
                    {"data": "mod_id"},
                    {"data": "mod_name"},
                    {"data": "preciom"},
                    {"data": "status2"}, 
                    {"defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-playlist-edit font-size-14 btnEdit' data-toggle='tooltip' data-placement='top' title='EDITAR'></button> <button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-14 btnElim' data-toggle='tooltip' 'data-placement='left' title='HABILITAR / DESHABILITAR'></button> <button class='btn btn-info btn-sm mdi mdi-format-list-bulleted font-size-14 btnPerm' data-toggle='tooltip' 'data-placement='left' title='PERMISOS'></button>"}
                   ],
                   "columnDefs": [
                   {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                      //console.log(row.usu_id)
                      return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.mod_id+'" >'+row.mod_id+'</span>';
                      }
                    }
                 ]
               });
               datamodulo.on( 'order.dt search.dt', function () {
               datamodulo.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
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
    $("#formModulo").trigger("reset");
    $('#M_Modulos').modal('show');
 }); 

$('#formModulo').submit(function(e){
  opcion =1;
  mnombre = $.trim($('#mnombre').val());
  mselmone = $.trim($('#mselmone').val()); 
  mprecio = $.trim($('#mprecio').val());
  e.preventDefault();
  $.ajax({    
      url: "functions/Modulos/Modulos.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,mnombre:mnombre,mselmone:mselmone,mprecio:mprecio},
         success: function(data)
         {
           toastr.success('Se han procesado los datos correctamente','EXITO');
           listar();
         }
       });
   //CERRAR MODAL
   $('#M_Modulos').modal('hide');
  });

 /////////////////////////////////////////////////////////////////////////////////////
///EDITAR 
 $( document).on("click", ".btnEdit", function(){
       fila = $(this).closest("tr");
       eid= fila.find('td:eq(0)').find('span').attr("data-id");
       emnombre = fila.find('td:eq(1)').text();
       opcion = 4;
       $.ajax({
        type:"POST",
        url: "functions/Modulos/Modulos.php",
        datatype:"json",
        data:{eid:eid,opcion:opcion},
        success:function(data){
        //CARGAR VALORES
        var cadena = data;
        let ObjetoJS = JSON.parse(cadena);
        //RECORRER OBJETO
        for (let item of ObjetoJS){
            var preciob = item.preciob;
          }
          //DATOS FALTANTES
          $("#eprecio").val(preciob);
          }
        }); 


       $("#eid").val(eid);
       $("#emnombre").val(emnombre);
       //DESPLEGAR EL MODAL CON LOS DATOS
       $('#E_Modulos').modal('show');
 });


$('#formEModu').submit(function(e){
   opcion =2;
   eid= $.trim($('#eid').val());
   emnombre =  $.trim($('#emnombre').val());
   selmone = $.trim($('#selmone').val());
   eprecio = $.trim($('#eprecio').val());
   e.preventDefault();
   $.ajax({
          url: "functions/Modulos/Modulos.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,eid:eid,emnombre:emnombre,selmone:selmone,eprecio:eprecio},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar();
          }
        });
    //CERRAR MODAL
    $('#E_Modulos').modal('hide');
   });

 /////////////////////////////////////////////////////////////////////////////
 ///ELIMINAR
 $( document).on("click", ".btnElim", function(){
       fila = $(this).closest("tr");
       buid= fila.find('td:eq(0)').find('span').attr("data-id");
       $("#buid").val(buid);
       //DESPLEGAR EL MODAL CON LOS DATOS
       $("#formDesModu").trigger("reset");
       $('#D_Modulos').modal('show');

 });

  $('#formDesModu').submit(function(e){
   opcion =3;
   buid= $.trim($('#buid').val());
   selmod = $.trim($('#selmod').val());
   e.preventDefault();
   $.ajax({
          url: "functions/Modulos/Modulos.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,buid:buid,selmod:selmod},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar();
          }
        });
    //CERRAR MODAL
    $('#D_Modulos').modal('hide');
   });

   $(document).on("click", ".btnPerm", function(e){
    //DATOS FALTANTES
    fila = $(this).closest("tr");
    modd= fila.find('td:eq(0)').find('span').attr("data-id");
    emnombre = fila.find('td:eq(1)').text();
    btitulo ="Permisos";
    $("#principal").hide();
    $('#opciones').load('views/Modulos/V_Detalles.php',{ "pname":emnombre,"ftitulo":btitulo , "empid":empid, "univel":univel, "modd":modd});
 }); 

   $(".number").on({
    "focus": function(event) {
      $(event.target).select();
    },
    "keyup": function(event) {
      $(event.target).val(function(index, value) {
        return value.replace(/\D/g, "")
          .replace(/([0-9])([0-9]{2})$/, '$1.$2');
          //.replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
      });
    }
  });


});

