<?php
  $empid = 1; //ID DE LA EMPRESA 
  $enivel= 1;
  $usuid= 1;
  $sqle ="SELECT c.com_ruc, c.com_name, c.com_direction, c.com_phone, c.com_image  FROM company c WHERE c.com_id='$empid'";
  $rese = mysqli_query($con,$sqle);
  $arre = mysqli_fetch_array($rese,MYSQLI_ASSOC);
  $comruc = $arre['com_ruc'];
  $comnom = $arre['com_name'];
  $comdir = $arre['com_direction'];
  $comtel = $arre['com_phone'];
  $comimg = $arre['com_image'];

?>


<div class="row" id="principal">
   <input type="hidden" id="imgemp" value="">
   <input type="hidden" id="impid" value="1">
   <input type="hidden" id="empid" value="<?=$empid;?>">
   <input type="hidden" id="usuid" value="<?=$usuid;?>">
   <input type="hidden" id="enombr" value="MILLENIUM">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <div class="row" style="border-bottom:1px solid #021130;">
                <div class="col-lg-6">
                  <h4 ><i class="fas fa-city"></i>&nbsp;Empresa </h4>
                </div>
                <div class="col-lg-6 text-right">
                  <a href="#" class="btn btn-success mb-2" id="btnNuevo"><i class="mdi mdi-plus mr-2"></i> Sucursales</a>
                  <a href="#" class="btn btn-info mb-2" id="btnBanco"><i class="mdi mdi-plus mr-2"></i> Departamentos</a>
                </div>
              </div>
              <form id="formEmpresa">
                <input name="action" id="action" type="hidden" value="upload" />
              <div class="row">
               <div class="form-group col-xs-12 col-md-12 col-lg-3">  
                <label class="mt-3">RUC / NIC:</label>
                <input type="text"  class="form-control" id="uruc" placeholder="RUC" pattern="^[a-zA-Z_0-9 ]*$" value="<?=$comruc;?>" title="Ingrese solo letras y numeros">
               </div>
               <div class="form-group col-xs-12 col-md-12 col-lg-6">
                 <label class="mt-3">EMPRESA:</label>
                 <input type="text"  class="form-control" id="uempresa" placeholder="EMPRESA / RAZON SOCIAL" pattern="^[a-zA-Z_0-9 ]*$" value="<?=$comnom;?>" value="" title="Ingrese solo letras y numeros">
                </div>
                <div class="form-group col-xs-12 col-md-12 col-lg-3">
                 <label class="mt-3">TELEFONO:</label>
                 <input type="text"  class="form-control" id="utele" placeholder="TELEFONO" value="<?=$comtel;?>" pattern="^[a-zA-Z_0-9 ]*$" title="Ingrese solo letras y numeros">
                </div>
                 <div class="form-group col-xs-12 col-md-12 col-lg-8">
                 <label>DIRECCION:</label>
                 <input type="text"  class="form-control" id="udirecion" placeholder="DIRECCION DE LA EMPRESA" pattern="^[a-zA-Z_0-9 ]*$" value="<?=$comdir;?>" title="Ingrese solo letras y numeros">
                </div>
                <div class="form-group col-xs-12 col-md-12 col-lg-4">
                 <label>EMAIL:</label>
                 <input type="text"  class="form-control" id="uemail" placeholder="email@gmail.com">
                </div>    
              <div class="mt-2 col-lg-12">
                <div class="card bg-success text-white-50">
                  <div class="card-body" style="padding:0.5rem;">
                      <h5 class="mt-0 text-white" align="center"><i class="mdi mdi-alert-circle-outline mr-3"></i>Datos de Configuraci&oacute;n</h5>
                  </div>
                </div>
              </div>
                <div class="form-group col-xs-12 col-md-12 col-lg-3">
                   <label >NOMBRE <small>Corto</small>:</label>
                   <input type="text"  class="form-control" id="ucorto" placeholder="MILLENIUM" pattern="^[a-zA-Z_0-9 ]*$" value="" title="Ingrese solo letras y numeros">
                </div>
                <div class="form-group col-xs-12 col-md-12 col-lg-6">
                <label>Logo:</label>
                    <input type="file" class="form-control"  name="gafoto1" id="gafoto1">
                </div>
               
                
                

                <div class="form-group col-xs-12 col-md-12 col-lg-3" style="margin-top: 1.8rem !important;">
                <button type="submit" class="btn btm-md btn-primary waves-effect waves-light">Guardar</button>
                <button type="reset" class="btn btm-md btn-danger waves-effect waves-light">Cancelar</button>
                </div> 
               </form>
               </div>
              


            </div>
         </div>
     </div>
</div>
<div id="opciones"></div>
<script type="text/javascript">
  $(document).ready(function() {

  //$('#gafoto1').bootstrapFileInput();
  
  /////////////////////////////////////
  var opcion,imgemp,empid,impid,enivel,enombr, usuid;
  imgemp = $.trim($('#imgemp').val());
  empid  = $.trim($('#empid').val());
  impid  = $.trim($('#impid').val());
  enivel = $.trim($('#enivel').val());
  enombr = $.trim($('#enombr').val());
  usuid  = $.trim($('#usuid').val());
 
  if (imgemp !='') {
    $(".cargaim").attr("src", "../img/empresa/"+imgemp);
  } else {
   $(".cargaim").attr("src", "../img/noimage.png"); 
  }


  $("#formEmpresa").submit(function(e){
   e.preventDefault();
   opcion =1;
   var formData = new FormData();
   var action = $.trim($('#action').val());
   var files = $('#uploadImage1')[0].files[0];
   var uruc = $.trim($('#uruc').val());
   var uempresa = $.trim($('#uempresa').val());
   var udirecion = $.trim($('#udirecion').val()); 
   var utele = $.trim($('#utele').val());
   var impnom = $.trim($('#impnom').val()); 
   var impval = $.trim($('#impval').val()); 
   
   formData.append('file',files);
   formData.append('opcion',opcion);
   formData.append('action',action);
   
   formData.append('uruc',uruc); 
   formData.append('uempresa',uempresa); 
   formData.append('udirecion',udirecion); 
   formData.append('utele',utele); 
   formData.append('impnom',impnom); 
   formData.append('impval',impval); 
   formData.append('imgemp',imgemp); 
   formData.append('empid',empid); 
   formData.append('impid',impid); 

   $.ajax({
         url: "functions/Empresa/Empresa.php",
         type: "POST",
         datatype:"json",
         data:  formData,
         contentType: false,
         processData: false,
         success: function(data) {
           toastr.success('Se han procesado los datos correctamente','EXITO');
         }
       });
    refresh();
  });

  
  
  $(document).on("click", "#btnNuevo", function(e){
     //DATOS FALTANTES
     $("#principal").hide();
     $('#opciones').load('views/Empresa/V_Sucursal.php',{ "eemp": empid, "usuid":usuid, "enom": enombr});
     //$("#opciones").show();
  });  


   $(document).on("click", "#btnBanco", function(e){
     //DATOS FALTANTES
     $("#principal").hide();
     $('#opciones').load('views/Empresa/V_Departamento.php',{ "eemp": empid, "enivel":"1", "enom": enombr, "usuid":usuid});
  });  

  function refresh() {
    setTimeout(function () {
        location.reload()
    }, 1500);
  }

});

function previewImage(nb) {
   var reader = new FileReader();
   reader.readAsDataURL(document.getElementById('uploadImage'+nb).files[0]);
   reader.onload = function (e) {
       document.getElementById('uploadPreview'+nb).src = e.target.result;
   };
 } 
</script>
