$(document).ready(function() {
  var opcion, empid, univel, actuse;
  empid = $.trim($('#empid').val());
  univel = $.trim($('#univel').val());
  actuse = $.trim($('#actuse').val());

  function listar_usuarios(){
    opcion =9;
    $('#datausuario').DataTable().clear().destroy();
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
           var  datausuario = $('#datausuario').DataTable({
               "autoWidth" : false,
               "columns":[null,null,null,null,null,null]
               });
           } else {
             opcion =0;
           var datausuario= $('#datausuario').DataTable({
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
                     {"data": "status"},
                     {"defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-14 btnEdit' data-toggle='tooltip' data-placement='top' title='EDITAR'></button> <button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-14 btnElim' data-toggle='tooltip' 'data-placement='left' title='ELIMINAR USUARIO'></button> <button class='btn btn-info btn-sm mdi mdi-text-box-check-outline font-size-14 btnPermi' data-toggle='tooltip' 'data-placement='left' title='PERMISOS USUARIO'></button>"}
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
               datausuario.on( 'order.dt search.dt', function () {
               datausuario.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
               cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                });
               }).draw();
           }
         }
       });
    }
  listar_usuarios();
  ///////////////////////////////////////////////////////////////////////////////////
  $(document).on("click", "#btnNuevo", function(e){
    $("#formUsuario").trigger("reset");
    $('#M_Usuario').modal('show');
  });       
  //////////////////////////////////////////////////////////////////////////////////
  var listarmod = new Array();
  //FORMULARIO Usuario
 $("#formUsuario").submit(function(e){
   opcion =1;
   e.preventDefault();
   var formData = new FormData();
   var unompe = $.trim($('#unompe').val());
   var uemail = $.trim($('#uemail').val());
   var uclave = $.trim($('#uclave').val());
   var selgrupo = $.trim($('#selgrupo').val());
   listarmod = modlist;
   //
   formData.append('opcion',opcion);
   formData.append('gdepart',listarmod); 
   formData.append('unompe',unompe); 
   formData.append('uemail',uemail); 
   formData.append('uclave',uclave); 
   formData.append('selgrupo',selgrupo); 
   formData.append('actuse',actuse); 
   formData.append('bnivel',univel); 
   formData.append('bempid',empid); 
   //
   //alert(listarmod.length);
   if(modlist.length > 1) {
   $.ajax({
         url: "functions/Usuarios/Usuarios.php",
         type: "POST",
         datatype:"json",
         data:  formData,
         contentType: false,
         processData: false,
         success: function(data) {
           toastr.success('Se han procesado los datos correctamente','EXITO');
           listar_usuarios();
         }
       });
     $('#M_Usuario').modal('hide');
    } else {
      toastr.error('Debe seleccionar los modulos !!!','ERROR');
    }
  });

   $(document).on("click", ".btnElim", function(){
       fila = $(this).closest("tr");
       buid= fila.find('td:eq(0)').find('span').attr("data-id");
       updusu = fila.find('td:eq(2)').text();
       //DESPLEGAR EL MODAL CON LOS DATOS
       $("#formEusu").trigger("reset");
       $("#buid").val(buid);
       $("#updusu").val(updusu);
       $('#D_Usuarios').modal('show');
 });

 
  $('#formEusu').submit(function(e){
   opcion =3;
   buid= $.trim($('#buid').val());
   selmod = $.trim($('#selmod').val());
   updusu = $.trim($('#updusu').val());
   e.preventDefault();
   $.ajax({
          url: "functions/Usuarios/Usuarios.php",
          type: "POST",
          datatype:"json",
          data:  {opcion:opcion,buid:buid,selmod:selmod,empid:empid,actuse:actuse,updusu:updusu},
          success: function(data) {
            toastr.success('Se han procesado los datos correctamente','EXITO');
            listar_usuarios();
          }
        });
    //CERRAR MODAL
    $('#D_Usuarios').modal('hide');
   });

   $(document).on("click", ".btnEdit", function(){
    fila = $(this).closest("tr");
    filusu= fila.find('td:eq(0)').find('span').attr("data-id");
    eunompe = fila.find('td:eq(1)').text();
    euemail = fila.find('td:eq(2)').text();
    
    Filtraclave(filusu);
    $("#eid").val(filusu);
    $("#eunompe").val(eunompe);
    $("#euemail").val(euemail);
    $('#E_Usuario').modal('show');
  });


 //FORMULARIO Usuario
 $("#EformUsuario").submit(function(e){
   opcion =2;
   e.preventDefault();
   var formData = new FormData();
   var eunompe = $.trim($('#eunompe').val());
   var euemail = $.trim($('#euemail').val());
   var euclave = $.trim($('#euclave').val());
   var eselgrupo = $.trim($('#eselgrupo').val());
   var eid = $.trim($('#eid').val());
   //

   formData.append('opcion',opcion);
   formData.append('eunompe',eunompe); 
   formData.append('euemail',euemail); 
   formData.append('euclave',euclave); 
   formData.append('eselgrupo',eselgrupo); 
   formData.append('actuse',actuse); 
   formData.append('bnivel',univel); 
   formData.append('bempid',empid); 
   formData.append('eid',eid); 
   //
   $.ajax({
         url: "functions/Usuarios/Usuarios.php",
         type: "POST",
         datatype:"json",
         data:  formData,
         contentType: false,
         processData: false,
         success: function(data) {
           toastr.success('Se han procesado los datos correctamente','EXITO');
           listar_usuarios();
         }
       });
     $('#E_Usuario').modal('hide');
  });

  $(document).on("click", ".btnPermi", function(e){
    //DATOS FALTANTES
    fila = $(this).closest("tr");
    filusu= fila.find('td:eq(0)').find('span').attr("data-id");
    eunompe = fila.find('td:eq(1)').text();
    eemail = fila.find('td:eq(2)').text();
    $("#principal").hide();
    $('#opciones').load('views/Usuarios/V_Permisos.php',{"idusu": filusu,  "empid": empid, "actuse":actuse, "enombre": eunompe, "eemail":eemail});
 });    

  var modlist;
  $(function () {
    $(".tbldepa").click(function () {
        //Create an Array.
        var selected = new Array();
        //Reference the CheckBoxes and insert the checked CheckBox value in Array.
        $(".tbldepa input[type=checkbox]:checked").each(function () {
            selected.push(this.value);
        });
         //Display the selected CheckBox values.
        if (selected.length > 0) {
            listar = selected.join(",");
            modlist = listar;
            console.log(listar);
            return listar;    
        }
    });
  });

  function Filtraclave(buid){
    opcion = 4;
    $.ajax({
      type:"POST",
      url:"functions/Usuarios/Usuarios.php",
      datatype:"json",
      data:{buid:buid,opcion:opcion},
      success:function(data){
      //CARGAR VALORES
      var cadena = data;
      let ObjetoJS = JSON.parse(cadena);
      //RECORRER OBJETO
      for (let item of ObjetoJS){
          var claveu = item.use_password;
      }
      //DATOS FALTANTES
      $("#euclave").val(claveu);
      } 
    });
  }



});







