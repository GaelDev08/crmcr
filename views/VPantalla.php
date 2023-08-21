<?php  
    ///CERRAR SESSION 
    include "functions/Cierre.php"; 
    ///
    $ip=getVisitorIp();
    $pass_crypt = crypt ($ip, 'fisystm'); 
    $sql0 = "SELECT s.use_id, s.src_ip, CONCAT(u.use_name,' ',u.use_lastname)  as nomc
	FROM user_screen s, user u WHERE s.src_ip='$pass_crypt'
	AND u.use_id = s.use_id";
    $res0 = mysqli_query($con,$sql0);
    $arr0 = mysqli_fetch_array($res0,MYSQLI_ASSOC);
    $nomusu = $arr0['nomc'];
    ///PINCODE

    include "functions/Pin.php";
?>
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Lock screen |FIBSYSTEM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body class="auth-body-bg">
        <div class="home-btn d-none d-sm-block">
            <a href="eAdYFPGiXkMGZLLjJzyafTKEinqdGvHzdyqB"><i class="mdi mdi-home-variant h2 text-white"></i></a>
        </div>
        <div>
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-lg-4">
                        
                        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                            <div class="w-100">
                                <div class="row justify-content-center">
                                    <div class="col-lg-9">
                                        <div>
                                            <div class="text-center">
                                            <div>
                                            <a href="#" class="logo"><img src="assets/images/img-logo.png"  alt="logo"></a>
                                            </div>
                                            <?php if ($nomusu !=''): ?>
                                                <h4 class="font-size-18 mt-4"><i class="fas fa-user"></i> <?=$nomusu;?></h4>
                                             <?php endif; ?>    
                                                <p class="text-muted">¡Ingrese su pin de acceso para desbloquear la pantalla!</p>
                                            </div>

                                            <div class="p-2 mt-1">
                                                <form class="form-horizontal" method="POST" action="A9cHAW9ohnMcgmg8RK8ftjpDySwJSZ6ugaRe">
                                                    <div class="form-group auth-form-group-custom mb-4">
                                                        <i class="ri-lock-2-line auti-custom-input-icon" style="color:#000;"></i>
                                                        <label for="userpassword">PIN</label>
                                                        <input type="password" class="form-control" id="userpincode" name="userpincode" placeholder="Ingrese su pin de acceso">
                                                    </div>

                                                    <div class="mt-2 text-center">
                                                        <button class="btn btn-dark w-md waves-effect waves-light" type="submit">Unlock</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="mt-2 text-center">
                                                <p>No eres tu ? vueleve al <a href="eAdYFPGiXkMGZLLjJzyafTKEinqdGvHzdyqB" class="font-weight-medium text-danger"> Login </a> </p>
                                                <p>© <script>document.write(new Date().getFullYear())</script> FIBSYSTEM. </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="authentication-bg">
                            <!--<div class="bg-overlay"></div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/js/app.js"></script>

    </body>
</html>
<?php 
    function getVisitorIp()
    {
    // Recogemos la IP de la cabecera de la conexion
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   { $ipAdress = $_SERVER['HTTP_CLIENT_IP']; }
    // Caso en que la IP llega a traves de un Proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  { $ipAdress = $_SERVER['HTTP_X_FORWARDED_FOR'];  }
    // Caso en que la IP lleva a traves de la cabecera de conexion remota
    else { $ipAdress = $_SERVER['REMOTE_ADDR']; }
    return $ipAdress;
    }
?>
<?php if ($error =='1'): ?>
  <script type="text/javascript">
   $(document).ready(function() {   
    toastr.error('Lo datos introducidos son incorrectos','ERROR');
    });
  </script>
<?php endif; ?>
<?php if ($error =='2'): ?>
  <script type="text/javascript">
   $(document).ready(function() {   
    toastr.error('Su acceso ha sido desahabilitado','Adverntencia');
    });

    
  </script>
<?php endif; ?>

