<?php 
    include "functions/BD.php";
    include "functions/Acceso.php";
    include "M_Olvido.php";
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
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
          <div align="center">
            <a href="#" class="logo"><img src="assets/images/logotipo.png"  alt="logo"></a>
          </div>
           
            <form method="POST" action="eAdYFPGiXkMGZLLjJzyafTKEinqdGvHzdyqB">
              <div class="form-floating mb-3">
              <label for="usu_nomusu">Usuario:</label>
                <input type="email" class="form-control" name="usu_nomusu" id="usu_nomusu" placeholder="email">
                
              </div>
              <div class="form-floating mb-3">
                <label for="usu_pass">Password:</label>
                <input type="password" class="form-control" name="usu_pass" id="usu_pass" placeholder="password">
              </div>

              
              <div class="mt-2 text-center">
                  <button class="btn btn-dark btn-block waves-effect waves-light button-register" type="submit">Login</button>
               </div>
              <hr class="my-3">
              <div class="mt-1 text-center">
                  <a class="btn btn-secondary btn-block waves-effect waves-light button-register" id="btnOlvido"> Olvido su contrase&ntilde;a?</a> <a href="fxpiViXiYGvqgnmKkKqNfvKrebPw29MfLVd6" class="btn btn-danger btn-block" style="color:#fff;"> Nueva Boleta</a>
               </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
 $(document).on("click", "#btnOlvido", function(e){
    //DATOS FALTANTES
    e.preventDefault();
    $('#M_Olvido').modal('show');
      
    
 }); 

</script>

<?php if ($error =='1'): ?>
  <script type="text/javascript">
   $(document).ready(function() {   
    toastr.error('Lo datos introducidos son incorrectos','ERROR');
    });
  </script>
<?php endif; ?>
