<?php 
 $fecven = date("Y-m-d"); 
 $anexo =rand(1, 20000000);

 include "functions/BD.php";
 $sqlmone="SELECT * FROM company_office WHERE  com_id='1'  order by off_id";
  $rmone=mysqli_query($con,$sqlmone);

 $sqlcat="SELECT * FROM ticket_category WHERE  com_id='1'  order by cat_id";
  $rcat=mysqli_query($con,$sqlcat);

  $sqlema="SELECT * FROM company_staff WHERE  com_id='1'  order by per_id";
  $rema=mysqli_query($con,$sqlema); 
 
?>

<style type="text/css">
body {
  background: #007bff;
  background: linear-gradient(to right, #e60a0a, #413535);
}

.btn-login {
  font-size: 0.9rem;
  letter-spacing: 0.05rem;
  padding: 0.75rem 1rem;
}

.btn-google {
  color: white !important;
  background-color: #ea4335;
}

.btn-facebook {
  color: white !important;
  background-color: #3b5998;
}
</style>
<div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-10 col-lg-11 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
          <div align="center">
            <a href="#" class="logo"><img src="assets/images/logotipo.png"  alt="logo"></a>
          </div>
           
          <form id="formVenta">
                <div class="row mt-4 ">
                  <div class="form-group col-xs-12 col-md-12 col-lg-3">
                  <label>N° BOLETA:</label>
                  <input class="form-control text-uppercase" style="background-color: #d2d6de;"  placeholder="FF-0001" id="bolnum" value="<?=$anexo;?>" disabled>
                  </div>
                 <div class="form-group col-xs-12 col-md-12 col-lg-6">
                 <label>SOLICITANTE:</label>
                 <input class="form-control text-uppercase" placeholder="" id="solbol">
                 </div>
                
                 <div class="form-group col-xs-12 col-md-12 col-lg-3">
                  <label>F.  EMISI&Oacute;N: </label>
                  <input type="date" class="form-control" style="padding-top:1px;" id="solfech" value="<?=$fecven;?>"  required>
                  </div>   

                  <div class="form-group col-xs-12 col-md-12 col-lg-4 mt-2">
                 <label>EMAIL:</label>
                 <select class="form-control select2" id="selremi" name="selremi">
                 <?php
                       echo "<option value=''>--</option>";
                       if($rowmon=mysqli_fetch_array($rema,MYSQLI_ASSOC)){
                       do{
                       echo '<option value="'.$rowmon['per_id'].'">'.$rowmon['per_email'].'</option>';
                       } while($rowmon=mysqli_fetch_array($rema,MYSQLI_ASSOC));
                       }  
                 ?>
                  </select>
                 </div>
                  <div class="form-group col-xs-12 col-md-12 col-lg-4 mt-2">
                  <label>SUCURSAL:</label>
                  <select class="form-control select2" id="selpre" name="selpre">
                    <?php
                       
                        echo "<option value=''>--</option>";
                        if($rowmon=mysqli_fetch_array($rmone,MYSQLI_ASSOC)){
                        do{
                        echo '<option value="'.$rowmon['off_id'].'">'.$rowmon['off_name'].'</option>';
                        } while($rowmon=mysqli_fetch_array($rmone,MYSQLI_ASSOC));
                        }  
                        
                  ?>
                  </select>
                </div> 
                  <div class="form-group col-xs-12 col-md-12 col-lg-4 mt-2">
                    <label>CLASIFICACION:</label>
                      <select class="form-control blockea" name="selcat" id="selcat" required>
                      <?php
                       echo "<option value=''>--</option>";
                       if($rowcat=mysqli_fetch_array($rcat,MYSQLI_ASSOC)){
                       do{
                       echo '<option value="'.$rowcat['cat_id'].'">'.$rowcat['cat_name'].'</option>';
                       } while($rowcat=mysqli_fetch_array($rcat,MYSQLI_ASSOC));
                       }  
                      ?>
                      </select>
                  </div>
                  
                  <div class="form-group col-md-12 col-xs-12 col-lg-12 mt-2 ">
                      <label>ASUNTO:</label>
                      <input class="form-control number" name="presmonto" id="presmonto" value=""  placeholder="">
                  </div> 
                  <div class="form-group col-xs-12 col-md-12 col-lg-12 mt-2">
                  <label>CUERPO DEL MENSAJE:</label>
                  <textarea class="form-control" id="w3review" name="w3review" rows="2" cols="108"></textarea>
                </div>
                <div class="text-right form-group col-xs-12 col-md-12 col-lg-12" >
                  <button type="submit" id="btnaggre" class="btn btm-sm btn-dark waves-effect waves-light mt-3">Guardar</button>
                  <button type="reset" id="btncancel" class="btn btm-sm btn-danger waves-effect waves-light mt-3">Cancelar</button>
                  <a href="eAdYFPGiXkMGZLLjJzyafTKEinqdGvHzdyqB" class="btn btm-sm btn-info waves-effect waves-light mt-3">Volver a Login</a>
                </div>
              </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>

