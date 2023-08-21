$(document).ready(function() {
  var opcion, empid, bid;
  empid = $.trim($('#bempid').val());
  bid = $.trim($('#bid').val());
  function listar(){
    opcion =9;
    $('#datacli').DataTable().clear().destroy();
    $.ajax({
         url: "functions/Cliente/Cliente.php",
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
                      "url": "functions/Cliente/Cliente.php",
                       "method": 'POST', //usamos el metodo POST
                       "data":{opcion:opcion,empid:empid},
                       "dataSrc":""
                   },
                  "autoWidth"   : false,
                   "columns":[
                    {"data": "cli_id"},
                    {"data": "cli_number"},
                    {"data": "cli_name"},
                    {"data": "cli_phone_cell"},
                    {"data": "cli_email"},
                    {"data": "status2"}, 
                    {"defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-14 btnEdit' data-toggle='tooltip' data-placement='top' title='EDITAR'></button> <button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-14 btnElim' data-toggle='tooltip' 'data-placement='left' title='HABILITAR / DESHABILITAR'></button>"}
                   ],
                   "columnDefs": [
                   {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                      return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.cli_id+'" >'+row.cli_id+'</span>';
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
      $('#M_Cliente').modal('show');
  });

  //////////////////////////////////////////////////////////////////////////////
  ///NRO DE CEDULA
  $('#pced').on('focusout', function(){
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
  });

 
    $('#formClient').submit(function(e){
      opcion =1;
      pced = $.trim($('#pced').val()); 
      pcnom = $.trim($('#pcnom').val()); 
      pnum = $.trim($('#pnum').val());
      pnom = $.trim($('#pnom').val());
      ptel1 = $.trim($('#ptel1').val());
      pmail = $.trim($('#pmail').val());
      pdirec = $.trim($('#pdirec').val());
      selcivil = $.trim($('#selcivil').val());
      pocupa = $.trim($('#pocupa').val());
      pruta = $.trim($('#pruta').val());
      pcode = $.trim($('#pcode').val());
      pdirect = $.trim($('#pdirect').val()); 
      e.preventDefault();
      $.ajax({    
            url: "functions/Cliente/Cliente.php",
            type: "POST",
            datatype:"json",
            data:  {opcion:opcion,pnum:pnum,pnom:pnom,ptel1:ptel1,pmail:pmail,pdirec:pdirec,
              pruta:pruta,selcivil:selcivil,pocupa:pocupa,empid:empid,pcode:pcode,pcnom:pcnom,
              pced:pced,pdirect:pdirect,bid:bid},
            success: function(data)
            {
              toastr.success('Se han procesado los datos correctamente','EXITO');
              listar();
            }
          });
      //CERRAR MODAL
      $('#M_Cliente').modal('hide');
      });

  var directrab;
///EDITAR 
 $(document).on("click", ".btnEdit", function(){
       fila = $(this).closest("tr");
       eid= fila.find('td:eq(0)').find('span').attr("data-id");
       epced = fila.find('td:eq(1)').text();
       epcnom = fila.find('td:eq(2)').text();
       eptel1 = fila.find('td:eq(3)').text();
       epmail = fila.find('td:eq(4)').text();
       epruta = fila.find('td:eq(5)').text();
       $("#eid").val(eid);
       $("#epced").val(epced);
       $("#epcnom").val(epcnom);
       $("#eptel1").val(eptel1);
       $("#epmail").val(epmail);
       $("#epruta").val(epruta);
       opcion = 4;
       $.ajax({
        type:"POST",
        url:"functions/Cliente/Cliente.php",
        datatype:"json",
        data:{eid:eid,opcion:opcion},
        success:function(data){
        //CARGAR VALORES
        var cadena = data;
        let ObjetoJS = JSON.parse(cadena);
        //RECORRER OBJETO
        for (let item of ObjetoJS){
            var prov_direccion = item.cli_direction;
            var prov_ocupacion = item.cli_occupation;
            var prov_zipcode = item.cli_zip_code;
            var prov_bussines = item.cli_business_name;
            var prov_ruc = item.cli_ruc;
            var prov_dirt = item.cli_direction_work;
        }
      //DATOS FALTANTES
      $("#epdirec").val(prov_direccion);
      $("#epocupa").val(prov_ocupacion);
      $("#epcode").val(prov_zipcode);
      $("#epnum").val(prov_ruc);
      $("#epnom").val(prov_bussines); 
      $("#epdirect").val(prov_dirt);
      }
    });
   //DESPLEGAR EL MODAL CON LOS DATOS
   $('#E_Cliente').modal('show');
 });

 

$('#formEclien').submit(function(e){
   opcion =2;
   eid= $.trim($('#eid').val());
   epnum = $.trim($('#epnum').val());
   epnom = $.trim($('#epnom').val());
   eptel1 = $.trim($('#eptel1').val());
   epmail = $.trim($('#epmail').val());
   epdirec = $.trim($('#epdirec').val());
   epruta = $.trim($('#epruta').val());
   eselcivil = $.trim($('#eselcivil').val());
   epocupa = $.trim($('#epocupa').val());
   epcode = $.trim($('#epcode').val());
   epced = $.trim($('#epced').val());
   epcnom = $.trim($('#epcnom').val()); 
   epdirect = $.trim($('#epdirect').val()); 
   e.preventDefault();
   $.ajax({
          url: "functions/Cliente/Cliente.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,eid:eid,epnum:epnum,epnom:epnom,eptel1:eptel1,epmail:epmail,epdirec:epdirec,
            epruta:epruta,eselcivil:eselcivil,epocupa:epocupa,epcode:epcode,epced:epced,epcnom:epcnom,
            epdirect:epdirect,empid:empid,bid:bid},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar();
          }
        });
    //CERRAR MODAL
    $('#E_Cliente').modal('hide');
   });

 ///ELIMINAR
 $( document).on("click", ".btnElim", function(){
       fila = $(this).closest("tr");
       buid= fila.find('td:eq(0)').find('span').attr("data-id");
       bnombre = fila.find('td:eq(2)').text();
       $("#buid").val(buid);
       $("#bnombre").val(bnombre);
       //DESPLEGAR EL MODAL CON LOS DATOS
       $("#formDclient").trigger("reset");
       $('#D_Cliente').modal('show');
 });

  $('#formDclient').submit(function(e){
   opcion =3;
   buid= $.trim($('#buid').val());
   selmod = $.trim($('#selmod').val());
   bnombre = $.trim($('#bnombre').val());
   e.preventDefault();
   $.ajax({
          url: "functions/Cliente/Cliente.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,buid:buid,selmod:selmod,empid:empid,bid:bid,bnombre:bnombre},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar();
          }
        });
    //CERRAR MODAL
    $('#D_Cliente').modal('hide');
   });

/**/
});

