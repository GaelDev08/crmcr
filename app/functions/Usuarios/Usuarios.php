<?php
include "../../../functions/BD.php";
include "../../../functions/GetResult.php";
date_default_timezone_set('America/Costa_Rica');
$opc = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$hoy = date("Y-m-d H:i:s");         
$stylei = '<div class="badge badge-soft-success font-size-12">';
$stylei2 = '<div class="badge badge-soft-danger font-size-12">';
$stylei3 = '<div class="badge badge-soft-info font-size-12">';
$stylef = '</div>';
        
switch ($opc) {

  case '0':
      /* crear una sentencia preparada */
      $stylei = '<div class="badge badge-soft-success font-size-12">';
      $stylei2 = '<div class="badge badge-soft-danger font-size-12">';
      $stylei3 = '<div class="badge badge-soft-info font-size-12">';
      $stylef = '</div>';
      $empid = $_POST['empid'];
      $univel = $_POST['univel'];
    
      $stmt = mysqli_prepare($con, "SELECT u.use_id,u.use_name_lastname,u.use_email,
      (CASE WHEN u.use_status = '1' THEN CONCAT('$stylei','Activo','$stylef') ELSE 
      CONCAT('$stylei2','Inactivo','$stylef') END) status, 
      CONCAT('$stylei3',g.gro_name,'$stylef') grupo 
      from user u, groups g WHERE g.gro_id = u.gro_id  and u.com_id='$empid'");
      
      $exec = mysqli_stmt_execute($stmt);
      $result = get_result($stmt);
      while ($row = array_shift($result)) {
           { $data[] = $row; }
       }
    break;

  case '1': // AGREGAR
    $unompe = ucwords($_POST['unompe']); 
    $unompe_last = $unompe;
    $uemail = $_POST['uemail'];
    $uclave = $_POST['uclave'];
    $selgrupo = $_POST['selgrupo']; 
    $fecusu = date("Y-m-d"); 
    $cadena = $_POST['gdepart'];
    $array = explode(",", $cadena);
    $array_num = count($array);
    $bnivel = $_POST['bnivel'];
    $bempid = $_POST['bempid'];
    $actuse = $_POST['actuse'];
    ///
    $sqle="INSERT INTO user VALUES ('0','$unompe_last','$uemail','$uclave','SG','$hoy','$hoy','1','$bempid','$selgrupo')";    
    $rese = mysqli_query($con,$sqle);
        ///agregar modulos del sistema
          $sqlu = "SELECT use_id from user WHERE use_email='$uemail'";
          $resu = mysqli_query($con,$sqlu);
          $arru = mysqli_fetch_array($resu,MYSQLI_ASSOC);
          $usid = $arru['use_id'];
          ///
          for ($i2 = 0; $i2 < $array_num; ++$i2){ 
            $it = $array[$i2];
            $sqlg="INSERT INTO groups_main VALUES ('0','$usid','$it','$selgrupo','$hoy','1')";   
            $resg = mysqli_query($con,$sqlg);
          }  
          $detalle ='SE AGREGO UN NUEVO USUARIO '.$uemail;
          $sqlbit = "SELECT Bitacora('I','INSERTAR','$detalle','$usid', '$hoy','$bempid','0')";
          $resbit = mysqli_query($con,$sqlbit);
          //
    $listar = array("data" =>"0");
    $data[] = $listar;  
    break;

    case '2': // actualizar
    $unompe = ucwords($_POST['eunompe']); 
    $unompe_last = $unompe;
    $uemail = $_POST['euemail'];
    $uclave = $_POST['euclave'];
    $selgrupo = $_POST['eselgrupo']; 
    $fecusu = date("Y-m-d"); 
    $bnivel = $_POST['bnivel'];
    $bempid = $_POST['bempid'];
    $actuse = $_POST['actuse'];
    $eid = $_POST['eid'];
    ///
    $sqlu = "UPDATE user SET use_name_lastname='$unompe_last', use_email='$uemail', use_password='$uclave' WHERE use_id='$eid'";  
    $resu = mysqli_query($con,$sqlu);
    $detalle ='SE ACTUALIZARON LOS DATOS GENERALES DEL USUARIO '.$uemail;
      ///
      $sqlbit = "SELECT Bitacora('I','ACTUALIZAR','$detalle','$actuse', '$hoy','$bempid','0')";
          $resbit = mysqli_query($con,$sqlbit);
      ///
      $listar = array("data" =>"0");
      $data[] = $listar;  
    break;

case '3':
    $buid= $_POST['buid']; $selmod = $_POST['selmod']; 
    $actuse = $_POST['actuse'];  $bempid = $_POST['empid']; $updusu = $_POST['updusu'];
    $detalle = 'SE ACTUALIZO EL STATUS DEL USUARIO '.$updusu;
    ///
    $sql0 = "UPDATE user SET use_status ='$selmod' WHERE use_id='$buid'";
    $res0 = mysqli_query($con,$sql0);
    ///bitacora
    $sqlbit = "SELECT Bitacora('I','ACTUALIZAR',' $detalle','$actuse', '$hoy','$bempid','0')";
    $resbit = mysqli_query($con,$sqlbit);
    ///
    $listar = array("data" =>'1');
    $data[] = $listar;
    break;  

case '4':
    $buid= $_POST['buid'];
    $sql0 = "SELECT * FROM user WHERE use_id ='$buid'";
    $res0 = mysqli_query($con,$sql0);
    while($row = mysqli_fetch_assoc($res0))
    { $data[] = $row; }
    break;  

 
  case '9': // FILTRAR  user
    $empid = $_POST['empid'];
    if ($empid =='1') {
      $sql="SELECT * from user";
    } else {
      $sql="SELECT * from user where com_id='$empid'";
    }
    
    $result=mysqli_query($con,$sql);
    $nrow = mysqli_num_rows($result);
    if ($nrow>'0') {
      //ENVIAR JSON
      while($row = mysqli_fetch_assoc($result))
      { $data[] = $row; }
      } else {
         $listar = array("data" =>$nrow);
         $data[] = $listar;
       }
    break;

    case '11': ///ACTUALIZAR CONTRASEÑA DEL USUARIO
      $euidp = $_POST['euidp'];
      $punom = $_POST['punom'];
      $puemail = $_POST['puemail'];
      $pupass = $_POST['pupass'];
      $usentp = $_POST['usentp'];
      ///
      $sql0="UPDATE user SET use_name_lastname ='$punom', use_email='$puemail', use_password ='$pupass' WHERE use_id='$euidp'";   
        $res0 = mysqli_query($con,$sql0);
      ///bitacora
      $detalle = 'SE ACTUALIZO LA CONTRASEÑA DEL USUARIO '.$puemail;
      $sqlbit = "SELECT Bitacora('I','ACTUALIZAR',' $detalle','$euidp', '$hoy','$usentp','0')";
        $resbit = mysqli_query($con,$sqlbit);
      $listar = array("data" =>'1');
      $data[] = $listar;
      break;

    case '12':
      $empid = $_POST['empid'];
      $bid = $_POST['bid'];
      $sql="SELECT * from groups_main where use_id='$bid'";
      $result=mysqli_query($con,$sql);
      $nrow = mysqli_num_rows($result);
        if ($nrow>'0') {
        //ENVIAR JSON
        while($row = mysqli_fetch_assoc($result))
        { $data[] = $row; }
        } else {
          $listar = array("data" =>$nrow);
          $data[] = $listar;
        }
      break;  

      case '13':
        $empid = $_POST['empid'];
        $bid = $_POST['bid'];
        $stmt = mysqli_prepare($con, "SELECT gm.mod_id, m.mod_name, 
        (CASE WHEN gm.mgr_status = '1' THEN CONCAT('$stylei','Activo','$stylef') ELSE 
          CONCAT('$stylei2','Inactivo','$stylef') END) status
          FROM groups_main gm, module m 
          WHERE gm.use_id = '$bid' AND m.mod_id = gm.mod_id");
        $exec = mysqli_stmt_execute($stmt);
        $result = get_result($stmt);
        while ($row = array_shift($result)) {
             { $data[] = $row; }
         }
      break; 

      case '14':
        $selmod = $_POST['selmod'];
        $dbuid = $_POST['dbuid']; 
        $bmail = $_POST['bmail'];
        $bid = $_POST['bid'];  
        $bus= $_POST['bus'];
        $bempr = $_POST['bempr'];
        $sql0 = "UPDATE groups_main SET mgr_status='$selmod' WHERE use_id='$bid' AND mod_id='$dbuid'";
          $res0 = mysqli_query($con,$sql0);
         ///bitacora
        $detalle = "SE ACTUALIZO LOS PERMISOS DEL USUARIO ".$bmail; 
          $sqlbit = "SELECT Bitacora('I','ACTUALIZAR',' $detalle','$bus', '$hoy','$bempr','0')";
          $resbit = mysqli_query($con,$sqlbit);
        ///
        $listar = array("data" =>'1');
        $data[] = $listar;
        break;

      case '15':
          $selmod = $_POST['almod'];
          $bmail = $_POST['bmail'];
          $bid = $_POST['bid'];  
          $bus= $_POST['bus'];
          $bempr = $_POST['bempr'];
          /// 
          $sql0 = "SELECT gro_id FROM user WHERE use_id='$bid' AND com_id='$bempr'";
          $res0 = mysqli_query($con,$sql0);
          $arr0 = mysqli_fetch_array($res0,MYSQLI_ASSOC);
          $grui = $arr0['gro_id'];

          $sqlg="INSERT INTO groups_main VALUES ('0','$bid','$selmod','$grui','$hoy','1')";   
          $resg = mysqli_query($con,$sqlg);
           ///bitacora
          $detalle = "SE REGISTRO UN NUEVO PERMISO AL USUARIO ".$bmail; 
            $sqlbit = "SELECT Bitacora('I','INSERTAR',' $detalle','$bus', '$hoy','$bempr','0')";
            //$resbit = mysqli_query($con,$sqlbit);
          ///
          $listar = array("data" =>'1');
          $data[] = $listar;
          break;  
      


    }         
  print json_encode($data);

 ?>
