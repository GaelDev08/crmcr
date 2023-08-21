<?php 
 $fecven = date("Y-m-d"); 
 $anexo =rand(1, 20000000);

 $sqlsucint="SELECT * FROM company_office WHERE  com_id='1'  order by off_id";
  $rsucint=mysqli_query($con,$sqlsucint);

 $sqlcatint="SELECT * FROM ticket_category WHERE  com_id='1'  order by cat_id";
  $rcatint=mysqli_query($con,$sqlcatint);

  $sqlreint="SELECT * FROM company_staff WHERE  com_id='1'  order by per_id";
  $reint=mysqli_query($con,$sqlreint); 
 
?>

<div class="modal fade" id="M_Interna" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar Boleta <small>Interna</small></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
         </button>
      </div>
        <form  id="formRemoto">
         <div class="modal-body">
          <div class="row">
            <div class="form-group col-xs-12 col-md-12 col-lg-4">
              <label>REMITENTE:</label>
                <select class="form-control select2" id="intremi" name="intremi">
                 <?php
                       echo "<option value=''>--</option>";
                       if($rowmon=mysqli_fetch_array($reint,MYSQLI_ASSOC)){
                       do{
                       echo '<option value="'.$rowmon['per_id'].'">'.$rowmon['per_email'].'</option>';
                       } while($rowmon=mysqli_fetch_array($reint,MYSQLI_ASSOC));
                       }  
                 ?>
               </select>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-4">
              <label>SUCURSAL:</label>
                <select class="form-control select2" id="intsuc" name="intsuc">
                 <?php
                       echo "<option value=''>--</option>";
                       if($rowmon=mysqli_fetch_array($rsucint,MYSQLI_ASSOC)){
                       do{
                       echo '<option value="'.$rowmon['off_id'].'">'.$rowmon['off_name'].'</option>';
                       } while($rowmon=mysqli_fetch_array($rsucint,MYSQLI_ASSOC));
                       }  
                 ?>
               </select>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-4">
              <label>CLASIFICACION:</label>
                <select class="form-control select2" id="intclas" name="intclas">
                 <?php
                       echo "<option value=''>--</option>";
                       if($rowmon=mysqli_fetch_array($rcatint,MYSQLI_ASSOC)){
                       do{
                       echo '<option value="'.$rowmon['cat_id'].'">'.$rowmon['cat_name'].'</option>';
                       } while($rowmon=mysqli_fetch_array($rcatint,MYSQLI_ASSOC));
                       }  
                 ?>
               </select>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-12">
              <label>ASUNTO:</label>
              <input class="form-control " name="intasu" id="intasu"  pattern="[A-z0-9 ].{1,}" title="Ingrese solo letras" required>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-12">
              <label for="bolcu">CUERPO:</label>
              <textarea class="form-control" id="intcuer" name="intcuer" rows="3" cols="50" pattern="^[a-zA-Z_0-9 ]*$" title="Ingrese solo letras y numeros" required></textarea> 
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-12">
               <label>ADJUNTOS:</label>
               <input type="file" class="form-control"  name="bolfi" id="bolfi">
            </div>
          </div>
         </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
        <button type="button" id="btnCancel" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>  </form>
      </div>
    </div>
  </div>
</div>
