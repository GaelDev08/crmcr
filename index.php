<?php
    error_reporting(E_ERROR | E_PARSE);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Login | Millenium</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- toastr -->        
    <link rel="stylesheet" type="text/css" href="assets/libs/toastr/build/toastr.min.css">
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Recaptcha-->
    <script src="assets/libs/jquery/jquery.min.js"></script>
</head>

    <body class="auth-body-bg">
        <div class="home-btn d-none d-sm-block" >
            <a href="eAdYFPGiXkMGZLLjJzyafTKEinqdGvHzdyqB"><i class="mdi mdi-home-variant h2 text-white"></i></a>
        </div>
        <div>
            <div class="container-fluid p-0">
                <?php
           $url=$_GET['menu'];
           $url=   preg_replace('([^A-Za-z0-9])', '', $url);
            switch ($url){
             case '':
             case 'eAdYFPGiXkMGZLLjJzyafTKEinqdGvHzdyqB':   
             case "''":   
                 include "views/VPrincipal.php"; break;  
             
             case 'fxpiViXiYGvqgnmKkKqNfvKrebPw29MfLVd6':
                 include "views/VRegistro.php"; break;  
             
              default:
                header("Location:/crmcr/");
                
            } 
        ?>
            </div>
        </div>
        <!-- JAVASCRIPT -->
   
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <!-- toastr plugin -->
        <script src="assets/libs/toastr/build/toastr.min.js"></script>
        <!-- toastr init -->
        <script src="assets/js/pages/toastr.init.js"></script>
        <script src="assets/js/app.js"></script>
    </body>
</html>
