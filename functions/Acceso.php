<?php

  //error_reporting(1);
  // Iniciar sesi贸n
  session_start();
  header ("Cache-Control: private");
  define("CLAVE_SECRETA", "6Lf9728fAAAAAHiiGguhDmUPfWjHBgq97ohtgv4a");
  // Si se ha enviado el formulario
  $usu_nomusu = $_REQUEST['usu_nomusu'];
  $usu_pass = $_REQUEST['usu_pass'];
  if ($usu_nomusu !='' and $usu_pass!='') { 
    $Validar = mysqli_prepare($con, "SELECT use_id,use_name_lastname as nomc, use_email, com_id, gro_id FROM user where use_email=? and use_password=?");
    mysqli_stmt_bind_param($Validar,'ss',$usu_nomusu,$usu_pass);
    mysqli_stmt_execute($Validar);
    mysqli_stmt_store_result($Validar);
    echo $FilasC=mysqli_stmt_num_rows($Validar);
    $Resulta=mysqli_stmt_store_result($Validar);
    mysqli_stmt_bind_result($Validar,$uid,$usuario,$correo,$ucomid,$ugroid);

    while($rowt =mysqli_stmt_fetch($Validar))
    { 
     $Correo=$_SESSION["use_email"] = $correo;
     $Usu_usuario=$_SESSION["nomc"] = $usuario;
     $Nivel=$_SESSION["gro_id"] = $ugroid;
     $uid=$_SESSION["use_id"] = $uid;
     $ucomid=$_SESSION["com_id"] = $ucomid;
     $_SESSION["usuario_valido"] = $uid;
     ///
     if ($FilasC=="1"){ 
       if ($Nivel !='') {
          #SESION ADMINITRADOR
          header("Location:/crmcr/app/");
        } 
      } 
    }#while
    #ERROR - SESSIONs
    if ($FilasC=="0"){ 
      $error="1";
    }
  } 
?>