<?php
  $sqlu = "SELECT * FROM user WHERE use_id='$id'";
  $resu = mysqli_query($con,$sqlu);
  $arru = mysqli_fetch_array($resu,MYSQLI_ASSOC);
  $nombre = $arru['use_name'];
  $apelli = $arru['use_lastname'];
  $emailu =  $arru['use_email'];
 ?>

<div class="modal fade" id="M_Perfil" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Actualizar Contrase&ntilde;a</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmajax1">
              <input type="hidden" id="euidp" value="<?=$id;?>">
              <input type="hidden" id="usentp" value="<?=$ucomid?>">
            <div class="modal-body">
              <div class="row">
                <div class="form-group col-xs-12 col-md-12 col-lg-12">
                 <label><strong>NOMBRES Y APELLIDOS:</strong></label>
                 <input type="text"  class="form-control" id="punom" placeholder="NOMBRES" pattern="^[a-zA-Z_ ]*$" title="Ingrese solo letras y numeros" value="<?=$Usu_usuario;?>" required>
               </div>
                <div class="form-group col-xs-12 col-md-12 col-lg-12">
                 <label><strong>EMAIL:</strong></label>
                 <input class="form-control" id="puemail" style="background:#EAEAEA" value="<?=$emailu; ?>" disabled>
                </div>
                <div class="form-group col-xs-12 col-md-12 col-lg-12">
                 <label><strong>CONTRASEÑA:</strong></label>
                 <input class="form-control" type="password" id="pupass"  pattern="[A-z0-9 ].{1,}" title="Ingrese solo letras o numeros" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Actualizar</button>
                <button type="button" id="btnLimpio" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>  
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
  $("#btnLimpio").click(function(){
      $("#frmajax1").trigger("reset");
  });
  //Autofocus Modal
  $(".modal").on('shown.bs.modal', function(){
      $(this).find('#pupass').focus();
  });

  //
  $('#frmajax1').submit(function(e){
      e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
      opcion = 11;
      euidp= $.trim($('#euidp').val());
      punom = $.trim($('#punom').val());
      puemail = $.trim($('#puemail').val());
      pupass = $.trim($('#pupass').val());
      usentp = $.trim($('#usentp').val());
      $.ajax({
            url:"functions/Usuarios/Usuarios.php",
            type: "POST",
            datatype:"json",
            data:  {euidp:euidp,punom:punom,puemail:puemail,pupass:pupass,opcion:opcion,usentp:usentp},
            success: function(data) {
              toastr.success('Se han procesado los datos correctamente','EXITO');
            }
          });
      $('#M_Perfil').modal('hide');
      $("#frmajax1").trigger("reset");
    });
  });
</script>
