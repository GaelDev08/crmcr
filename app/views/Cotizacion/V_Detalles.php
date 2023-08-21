<?php 
  include "../../../functions/BD.php";
  $utipo = $_POST['utipo'];
  $ftitulo = $_POST['ftitulo']; 
  $empid = $_POST['empid'];
  if ($utipo=='NUEVO') {    
    $sqlfac = "SELECT SKU('T','$empid') AS nfact, SKU('CT','$empid') AS numf";
    $resfac = mysqli_query($con,$sqlfac);
    //$arrfac = mysqli_fetch_array($resfac,MYSQLI_ASSOC);
    $nfactu = "4656"; 
    $codsh = "1";
    $fecven = date("Y-m-d"); 
    $client = 0;
  } else {
    $codsh = $_POST['codsh'];
    $sqlfac = "SELECT quo_code AS nfact, quo_date AS fecven, cli_id FROM quotation WHERE quo_id='$codsh'";
    $resfac = mysqli_query($con,$sqlfac);
    $arrfac = mysqli_fetch_array($resfac,MYSQLI_ASSOC);
    $nfactu = $arrfac['nfact']; 
    $fecven = $arrfac['fecven']; 
    $client = $arrfac['cli_id']; 
  }

  $otro = $_POST['otro'];
  $idusu = $_POST['idusu'];
  $univel = $_POST['univel'];
  ////
  include "M_Cliente.php";
  include "M_Producto.php";
  include "D_Producto.php";
  include "E_Producto.php";
  

 ?>

<div class="row" id="opcion">
    <input type="hidden" id="bfactu" value="<?=$nfactu;?>">
    <input type="hidden" id="butipo" value="<?=$utipo;?>">
    <input type="hidden" id="bempid" value="<?=$empid;?>"> 
    <input type="hidden" id="bid"    value="<?=$idusu;?>">
    <input type="hidden" id="codsh"  value="<?=$codsh;?>">
    <input type="hidden" id="idcli"  value="<?=$client;?>">
    <input type="hidden" id="otro"   value="<?=$otro;?>">
    <input type="hidden" id="proid">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <div class="row" style="border-bottom:1px solid #021130;">
                <div class="col-lg-6">
                  <h4 ><i class="fas fa-clipboard-list"></i>&nbsp;<?=$ftitulo;?> </h4>
                </div>
                  <div class="col-lg-6 text-right">
                     <button class="btn btn-success mb-1" id="btnProce"><i class="mdi mdi-content-save-outline mr-1"></i> Procesar</button>
                    <button class="btn btn-warning mb-1" id="btnRegre"><i class="mdi mdi-arrow-left mr-1"></i> Atras</button>
                  </div>
                </div>
                <form id="formVenta">
                <div class="row mt-4">
                  <div class="form-group col-xs-12 col-md-12 col-lg-3">
                  <label>N° REF.:</label>
                  <input class="form-control text-uppercase" style="background-color: #d2d6de;" placeholder="FF-0001" id="confac" value="<?=$nfactu;?>" disabled>
                  </div>
                <div class="form-group col-xs-12 col-md-12 col-lg-6">
              <label>CLIENTE:</label>
                <div class="input-group">
              <select class="form-control select2" style="width: 90%;" name="selclien" id="selclien"></select>      
           
               <div class="input-group-append">
                <button class="btn btn-success" type="button" id="btnAgprov">+</button>
                </div>
              </div>
           </div>
           <div class="form-group col-xs-12 col-md-12 col-lg-3">
             <label>FECHA:</label>
             <input type="date" class="form-control" style="padding-top:1px;" id="confecha" value="<?=$fecven;?>"  required>
           </div>
           <div class="form-group col-xs-12 col-md-12 col-lg-2">
            <label>MONEDA:</label>
            <select class="form-control select2" id="selmone" name="selmone">
              <?php
              if ($smone !='') {
                echo '<option value="0">'.$smone.'</option>';
              } else {
                $sqlmone="SELECT cur_id,cur_symbol from currency WHERE cur_status='1' AND com_id='$empid'  
                order by cur_default DESC";
                  $rmone=mysqli_query($con,$sqlmone);
                  if($rowmon=mysqli_fetch_array($rmone,MYSQLI_ASSOC)){
                  do{
                  echo '<option value="'.$rowmon['cur_id'].'">'.$rowmon['cur_symbol'].'</option>';
                  } while($rowmon=mysqli_fetch_array($rmone,MYSQLI_ASSOC));
                  }  
              }
              
             ?>
            </select>
           </div>
           <div class="form-group col-xs-12 col-md-12 col-lg-3">
              <label>TIPO PAGO:</label>
                <select class="form-control select2" style="width:100%;" name="conpag" id="conpag" required>
                  <?php
                  if ($spago !='') {
                    echo "<option value='0'>".$spago."</option>";
                  } else {
                    $sqlpag="SELECT pay_id,pay_name from payment_type where pay_id >'2'
                         order by pay_id";
                    $rpag=mysqli_query($con,$sqlpag);
                    echo "<option value=''>--</option>";
                    if($rowpag=mysqli_fetch_array($rpag,MYSQLI_ASSOC)){
                    do{
                     echo '<option value="'.$rowpag['pay_id'].'">'.$rowpag['pay_name'].'</option>';
                     } while($rowpag=mysqli_fetch_array($rpag,MYSQLI_ASSOC));
                    }  
                  }
                  
                 ?>
               </select>
           </div>
           <div class="form-group col-xs-12 col-md-12 col-lg-7">
            <label> PRODUCTO : <small>COD. BARRAS </small></label>
              <div class="input-group">
              <input type="text"  class="form-control" id="selpro" style="width:90%;" placeholder="0000" pattern="^[a-z0-9-A-Z_ ]*$" title="Ingrese solo letras y numeros" required>
                <div class="input-group-append">
                  <button class="btn btn-success" type="button" id="btnBusca"> <i class="fas fa-search"></i> </button>
                </div>
              </div> 
            </div>
         <div class="form-group col-md-4 col-xs-12 col-lg-2">
            <label>CANTIDAD:</label>
            <input class="form-control" name="concant" id="concant"  placeholder="0"  required>
         </div>
         <div class="form-group col-md-4 col-xs-12 col-lg-2">
            <label>PRECIO: <small>Venta</small></label>
            <input class="form-control" name="concvent" id="concvent"  placeholder="0"  disabled>
         </div> 
         <div class="col-xs-12 col-md-6 col-lg-5">
           <label>SUCURSAL :</label>
            <select class="form-control select2" style="width:100%;" name="selsucur" id="selsucur" required>
              <?php 
                $sqlsuc="SELECT * FROM company_office WHERE com_id='$empid' and off_main='2'";
                    $rsuc=mysqli_query($con,$sqlsuc);
                    echo "<option value=''>--</option>";
                    if($rowsuc=mysqli_fetch_array($rsuc,MYSQLI_ASSOC)){
                    do{
                     echo '<option value="'.$rowsuc['off_id'].'">'.$rowsuc['off_name'].'</option>';
                     } while($rowsuc=mysqli_fetch_array($rsuc,MYSQLI_ASSOC));
                    } 
              ?>


            </select>   
         </div>
         <div class="form-group col-xs-12 col-md-12 col-lg-3 mt-4" >
            <button type="submit" id="btnaggre" class="btn btm-sm btn-primary waves-effect waves-light">Guardar</button>
            <button type="reset" id="btncancel" class="btn btm-sm btn-danger waves-effect waves-light">Cancelar</button>
          </div>
         </div>
        </form>
         <div class="mt-2">
          <div class="card bg-success text-white-50">
              <div class="card-body" style="padding:0.5rem;">
                  <h5 class="mt-0 text-white" align="center"><i class="mdi mdi-alert-circle-outline mr-3"></i>Productos agregados</h5>
              </div>
          </div>
        </div>
            <div class="table-responsive mt-3">
                  <table class="table datatable" id="datadetal" style="width: 100%;">
                      <thead class="thead"  style="background:#343a40; color: white;">
                          <tr class="text-center bg-dark">
                            <th style="color: white;">#</th>
                      
                            <th style="color: white; width: 40%;">Producto</th>
                            <th style="color: white;">Cantidad</th>
                            
                            <th style="color: white;">Precio V.</th>
                            <th style="color: white;">Acciones</th>
                          </tr>
                      </thead>
                      <tbody  class="text-center"></tbody>
                      <tfoot align="center">
                        <tr>
                          <td colspan="4" align="right">Subtotal:</td>
                          <td colspan="1" class="subtotalf"><?='0';?></td>
                        </tr>  
                        <tr>
                          <td colspan="4" align="right">Impuesto (%):</td>
                          <td colspan="1" class="impuestof"><?='0';?></td>
                        </tr>
                        <tr>  
                          <td colspan="4" align="right">Total:</td>
                          <td colspan="1" class="totalff"><?='0';?></td>
                        </tr>
                      </tfoot>
                  </table>
              </div>
        </div> 
     </div> <!--card-->
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
  var butipo, bgrupo, opcion, bid, bnivel, bempid, bmarca,codsh, otro, idcli, bfactu;  
    bempid = $.trim($('#bempid').val());
    butipo = $.trim($('#butipo').val());
    bid = $.trim($('#bid').val());
    codsh = $.trim($('#codsh').val());
    idcli = $.trim($('#idcli').val());
    otro = $.trim($('#otro').val());
    bfactu = $.trim($('#bfactu').val());

  if (butipo =="NUEVO") {
    opcion = 1;
    $("#btnProce").attr("disabled", true);
    $('#selclien').load('views/Cotizacion/Cliente.php', {"idemp": bempid, "idcli":0 });
  } else {
    $('#selclien').load('views/Cotizacion/Cliente.php', {"idemp": bempid, "idcli":idcli });
  }

  if (otro =="1") {
    $("#btnaggre").attr("disabled", true);
    $("#btncancel").attr("disabled", true);
    $("#btnEnvio2").attr("disabled", true);
    $("#btnEnvio1").attr("disabled", true);
    $("#btnProce").attr("disabled", false);
  }

  ///CARGAR LIBRERIAS
  $('.select2').select2();
  $('#selpro2').load('views/Cotizacion/Producto.php', {"idemp": bempid });
  ///CONFIGURACION
   $("#confac").attr("disabled", true);
   $("#concvent").attr("disabled", true);  

    ///AGREGAR CLIENTE
    $("#btnAgprov").click(function(){
      $("#formClient").trigger("reset");
      $('#M_Cliente').modal('show');
      $('#selpais').load('views/Cotizacion/Pais.php', {"idemp": "1" });  
  });

    $("#selpais").on('change', function () {
      $("#selpais option:selected").each(function () {
          var catid = $(this).val();
          $.post("views/Cotizacion/Estado.php", { catid: catid }, function(data) {
              $("#selestado").html(data);
          });
      });
    });

    $( document).on("click", "#tentre", function(){
    var tentre = $('input:radio[name=tentre]:checked').val();
    if (tentre =='SI') {
      //$("#dirtrab").hide();
      $("#pdirect").val("");
      pdirec = $.trim($('#pdirec').val());
      $("#pdirect").val(pdirec);
      $("#pdirect").prop('required',false);  
    } else {
      //$("#dirtrab").show();
      $("#pdirect").val("");
      $("#pdirect").prop('required',true);  
    }
  });

  $('#formClient').submit(function(e){
  opcion =7;
  pced = $.trim($('#pced').val()); 
      pcnom = $.trim($('#pcnom').val()); 
      pnum = $.trim($('#pnum').val());
      pnom = $.trim($('#pnom').val());
      ptel1 = $.trim($('#ptel1').val());
      pmail = $.trim($('#pmail').val());
      pdirec = $.trim($('#pdirec').val());
      selpais = $.trim($('#selpais').val());
      selestado = $.trim($('#selestado').val());
      selcivil = $.trim($('#selcivil').val());
      pocupa = $.trim($('#pocupa').val());
      pruta = $.trim($('#pruta').val());
      pcode = $.trim($('#pcode').val());
      tentre = $('input:radio[name=tentre]:checked').val();
      pdirect = $.trim($('#pdirect').val()); 
      e.preventDefault();
      $.ajax({    
            url: "functions/Cotizacion/Cotizacion.php",
            type: "POST",
            datatype:"json",
            data:  {opcion:opcion,pnum:pnum,pnom:pnom,ptel1:ptel1,pmail:pmail,pdirec:pdirec,
              selpais:selpais,pruta:pruta,selcivil:selcivil,selestado:selestado,pocupa:pocupa,
              empid:empid,pcode:pcode,pcnom:pcnom,pced:pced,tentre:tentre,pdirect:pdirect},
            success: function(data)
            {
              toastr.success('Se han procesado los datos correctamente','EXITO');
              $('#selclien').load('views/Venta/Cliente.php', {"idemp": bempid, "new":1 });
            }
          });
      //CERRAR MODAL
      $('#M_Cliente').modal('hide');
      });

  $("#btnBusca").click(function(){
        $("#formProducto").trigger("reset");
        $('#M_Producto').modal('show');
  });
  
  ///
  $('#formProducto').submit(function(e){
  opcion =18;
  selpro2 = $.trim($('#selpro2').val());
  e.preventDefault();
  $.ajax({    
         url: "functions/Venta/Venta.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,selpro2:selpro2,bempid:bempid},
         success: function(data) {
                   var cadena = data;
                   let ObjetoJS = JSON.parse(cadena);
                   //RECORRER OBJETO
                   for (let item of ObjetoJS){
                       vproid = item.proid;
                       vselpro = item.selpro;
                       verror =item.error;
                       vprice =item.pricep;
                   }    
                   $("#concvent").val(vprice);    
                   $("#selpro").val(vselpro); 
                   $("#proid").val(vproid);   
                   $("#concant").val("");               
                   $("#concant").focus(); 
            }
       });
   //CERRAR MODAL
   $('#M_Producto').modal('hide');
  });

 ///
 var vprecio;
  $("#selpro").keypress(function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code==13){
          opcion = 5;
          id_produ = $.trim($('#selpro').val());
          e.preventDefault();
          if (id_produ !='') {
            $.ajax({
              type:"POST",
              url: "functions/Cotizacion/Cotizacion.php",
              datatype:"json",
              data:  {opcion:opcion,id_produ:id_produ,bempid:bempid},
              success:function(data){
              //CARGAR VALORES
              var cadena = data;
              let ObjetoJS = JSON.parse(cadena);
              //RECORRER OBJETO
              for (let item of ObjetoJS){
                  vprecio = item.vprecio;
                  verror = item.error;
              }
            //DATOS FALTANTES
            if (verror=='0') {
                $("#concvent").val(vprecio);    
                $("#concant").val("");               
                $("#concant").focus();
                proidbuscado (id_produ);
              } else {
                toastr.info('Producto no disponible en sucursal','ADVERTENCIA');
                $("#selpro").focus();
              }
            }
            });
          } else {
            toastr.info('Seleccione producto','ADVERTENCIA');
            $("#selpro").focus();
          }
        }
    });


 ///
 $('#formVenta').submit(function(e){
  opcion =4;
  confac = $.trim($('#confac').val());
  selclien = $.trim($('#selclien').val());
  confecha = $.trim($('#confecha').val());
  selmone = $.trim($('#selmone').val()); 
  conpag = $.trim($('#conpag').val());
  selpro = $.trim($('#selpro').val());
  concant = $.trim($('#concant').val());
  concvent = $.trim($('#concvent').val());
  selsucur = $.trim($('#selsucur').val());
  proid = $.trim($('#proid').val());
  e.preventDefault();
  if (proid !=''){
  $.ajax({    
         url: "functions/Cotizacion/Cotizacion.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,bempid:bempid,confac:confac,selclien:selclien,confecha:confecha,selmone:selmone,conpag:conpag,selpro:selpro,concant:concant,concvent:concvent,selsucur:selsucur,bid:bid,codsh:codsh},
         success: function(data)
         {
          toastr.success('Se han procesado los datos correctamente','EXITO');
          $('#selpro2').load('views/Cotizacion/Producto.php', {"idemp": bempid });
          listarproducto();
          desahabilitar();
          totalesfac(codsh);
         }
       });
      }
  });


 function desahabilitar(){
  $("#confac").attr("disabled", true);
  $("#selclien").attr("disabled", true);
  $("#confecha").attr("disabled", true);
  $("#selmone").attr("disabled", true);
  $("#conpag").attr("disabled", true);
  $('#selpro2').val(null).trigger('change');
  $("#selpro").val('');
  $("#concant").val('');
  $("#concvent").val('');
  $("#selsucur").attr("disabled", true);
  $("#btnProce").attr("disabled", false);
}

function proidbuscado (xbarcode) {
    opcion = 17;
      $.ajax({    
       url: "functions/Venta/Venta.php",
       type: "POST",
       datatype:"json",
       data:  {opcion:opcion,xbarcode:xbarcode,bempid:bempid},
       success: function(data)
       {
        var cadena = data;
        let ObjetoJS = JSON.parse(cadena);
        //RECORRER OBJETO
        for (let item of ObjetoJS){
            var vproid = item.proid;
        }
          $("#proid").val(vproid); 
       }
    });  
  }

////
function listarproducto(){
    opcion =8;
    $('#datadetal').DataTable().clear().destroy();
    $.ajax({
         url: "functions/Cotizacion/Cotizacion.php",
         type: "POST",
         datatype:"json",
         data:  {opcion:opcion,bempid:bempid,codsh:codsh},
         success: function(data) {
           //RECORRER OBJETO JS
           let ObjetoJSS = JSON.parse(data);
           for (let itemm of ObjetoJSS){ var listar = itemm.data; }
           if (listar==0) {
           var  datadetal = $('#datadetal').DataTable({
               "autoWidth" : false,
               "paging": false,
               "info": false,
               "columns":[null,null,null,null,null]
               });
           } else {
             opcion =10;
           var datadetal= $('#datadetal').DataTable({
                   "ajax":{
                      "url": "functions/Cotizacion/Cotizacion.php",
                       "method": 'POST', //usamos el metodo POST
                       "data":{opcion:opcion,bempid:bempid,codsh:codsh},
                       "dataSrc":""
                   },
                  "autoWidth"   : false,
                  "paging": false,
                  "info": false,
                   "columns":[
                     {"data": "qdet_id"},
                     {"data": "pro_name"},
                     {"data": "qdet_quantity"},
                     {"data": "qdet_price_out"},
                     {"defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-14 btnEditP' data-toggle='tooltip' data-placement='top' title='EDITAR'></button> <button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-14 btnElimP' data-toggle='tooltip' 'data-placement='left' title='ELIMINAR'></button>"}
                   ],
                   "columnDefs": [
                   {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                     return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.qdet_id+'" >'+row.qdet_id+'</span>';
                      }
                    }
                 ]
               });
               datadetal.on( 'order.dt search.dt', function () {
               datadetal.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
               cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                });
               }).draw();
           }
         }
       });
    }
  listarproducto();

///ELIMINAR 
 $(document).on("click", ".btnElimP", function(){
     fila = $(this).closest("tr");
     puid= fila.find('td:eq(0)').find('span').attr("data-id");
     //DESPLEGAR EL MODAL CON LOS DATOS
     $("#formDprodu").trigger("reset");
     $("#puid").val(puid);
     $('#D_Producto').modal('show');
 });

$('#formDprodu').submit(function(e){
  opcion =11;
  puid = $.trim($('#puid').val());
  e.preventDefault();
  $.ajax({    
       url: "functions/Cotizacion/Cotizacion.php",
       type: "POST",
       datatype:"json",
       data:  {opcion:opcion,puid:puid,codsh:codsh},
       success: function(data)
       {
         toastr.success('Se han procesado los datos correctamente','EXITO');
          //CARGAR VALORES
          $('#selpro2').load('views/Cotizacion/Producto.php', {"idemp": bempid });
          listarproducto();
          totalesfac(codsh);
       }
    });
   //CERRAR MODAL
   $('#D_Producto').modal('hide');
  });

///EDITAR 
 $( document).on("click", ".btnEditP", function(){
     fila = $(this).closest("tr");
     eprodu= fila.find('td:eq(0)').find('span').attr("data-id");
     enombre = fila.find('td:eq(1)').text();
     ecant = fila.find('td:eq(2)').text();
     ecvent = fila.find('td:eq(3)').text();
     //DESPLEGAR EL MODAL CON LOS DATOS
     $("#formEProducto").trigger("reset");
     $("#eprodu").val(eprodu);
     $("#enombre").val(enombre);
     $("#ecant").val(ecant); 
     $("#canter").val(ecant);

     $("#ecvent").val(ecvent);
     $('#E_Producto').modal('show');
 });

$('#formEProducto').submit(function(e){
  opcion =12;
  eprodu = $.trim($('#eprodu').val());
  enombre = $.trim($('#enombre').val());
  ecant = $.trim($('#ecant').val());
  ecvent = $.trim($('#ecvent').val()); 
  canter = $.trim($('#canter').val()); 
  e.preventDefault();
  $.ajax({    
       url: "functions/Cotizacion/Cotizacion.php",
       type: "POST",
       datatype:"json",
       data:  {opcion:opcion,eprodu:eprodu,ecant:ecant,canter:canter,codsh:codsh},
       success: function(data)
       {
         toastr.success('Se han procesado los datos correctamente','EXITO');
         $('#selpro2').load('views/Cotizacion/Producto.php', {"idemp": bempid });
         listarproducto();
         totalesfac(codsh);
       }
    });
   //CERRAR MODAL
   $('#E_Producto').modal('hide');
  });

///TOTALES 
  totalesfac(codsh);
  function totalesfac(idcomp){
     opcion = 13;
      $.ajax({    
       url: "functions/Cotizacion/Cotizacion.php",
       type: "POST",
       datatype:"json",
       data:  {opcion:opcion,idcomp:idcomp,bempid:bempid},
       success: function(data)
       {
        var cadena = data;
        let ObjetoJS = JSON.parse(cadena);
        //RECORRER OBJETO
        for (let item of ObjetoJS){
            var subtotal = item.subtotal;
            var total = item.total;
            var iva = item.iva;
        }

          $(".subtotalf").text("  "+subtotal);
          $(".impuestof").text(" "+iva);
          $(".totalff").text(" "+total);
       }
    });
  }


///
  $("#btnProce").click(function(){
      ruta ='../PDF/documentos/R_Cotizacion.php?&id='+codsh;
      window.open(ruta, '_blank');
      refresh();
  });  
  
  $("#btnRegre").click(function(e){
     e.preventDefault();
     actualizacod();
     refresh();
  });

  function actualizacod(){
    opcion =15;
    $.ajax({    
       url: "functions/Cotizacion/Cotizacion.php",
       type: "POST",
       datatype:"json",
       data:  {opcion:opcion,bfactu:bfactu,codsh:codsh,bempid:bempid},
       success: function(data)
       {
         var algo = 1;
         
       }
    }); 
  }

  function refresh() {
    setTimeout(function () {
        location.reload()
    }, 1500);
  }

  });
</script>