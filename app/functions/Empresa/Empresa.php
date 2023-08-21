<?php
include "../../../functions/BD.php";
include "../../../functions/GetResult.php";
date_default_timezone_set('America/Costa_Rica');
$opc = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$hoy = date("Y-m-d H:i:s"); 
  /* crear una sentencia preparada */
  $stylei = '<div class="badge badge-soft-success font-size-12">';
  $stylei2 = '<div class="badge badge-soft-danger font-size-12">';
  $stylei3 = '<div class="badge badge-soft-info font-size-12">';
  $stylef = '</div>';
switch ($opc) {

  case '0':
      $stmt = mysqli_prepare($con, "SELECT u.use_id,u.use_name_lastname,u.use_email,(CASE WHEN u.use_status = '1' THEN CONCAT('$stylei','Activo','$stylef') ELSE CONCAT('$stylei2','Inactivo','$stylef') END) status, CONCAT('$stylei3',g.gro_name,'$stylef') grupo from user u, groups g WHERE g.gro_id = u.gro_id ");
      $exec = mysqli_stmt_execute($stmt);
      $result = get_result($stmt);
      while ($row = array_shift($result)) {
           { $data[] = $row; }
       }
    break;

  case '1':
   if ($_POST["action"] == "upload")
      {
        $archivo = $_FILES["file"]["name"];
        if ($archivo !='') {
          $tamano = $_FILES["file"]["size"];
          $tipo = $_FILES["file"]["type"];
          $extension = pathinfo($_FILES["file"]["name"]);
          $extension = ".".$extension["extension"];
        }

       $uruc = $_POST['uruc'];
       $uempresa = ucwords($_POST['uempresa']);
       $udirecion = ucfirst($_POST['udirecion']); 
       $utele = $_POST['utele'];
       $impnom = ucfirst($_POST['impnom']);
       $impval = $_POST['impval'];
       $imgemp =$_POST['imgemp'];
       $empid =$_POST['empid'];
       $impid=$_POST['impid'];
       $anexo =rand(1, 20000); 
       //NOMBRE DEL BANNER
       $nomfoto = 'emp_'.$anexo.$extension;
        // si el archivo es vacio
        if ($archivo != "" and  (!((strpos($tipo, "image/gif") || strpos($tipo, "image/jpeg") || strpos($tipo, "image/png")) && ($tamano  < 50000000))))
            {
              // guardamos el archivo a la carpeta ficheros
              $destino =  "../../../img/empresa/".$nomfoto;
              if ($imgemp !='') {
                unlink("../../../img/empresa/".$nomfoto);
              }
             if (move_uploaded_file($_FILES['file']['tmp_name'],$destino))
                {
                $sql2="UPDATE company SET com_ruc='$uruc', com_name='$uempresa', com_direction ='$udirecion', com_phone='$utele', com_image='$nomfoto'   WHERE com_id='$empid'";
                if (!mysqli_query ($con,$sql2)) { echo("Error description: " . mysqli_error($con)); }

                if ($impid !='') {
                  $sql0 = "UPDATE company_param SET comp_name='$impnom', comp_value ='$impval' WHERE comp_id ='$impid'";  
                  $res0 = mysqli_query($con,$sql0);
                } else { 
                  ///PARAMETROS 
                  $status2 = 1;
                  $stmt = mysqli_prepare($con, "INSERT INTO company_param (comp_name, comp_value, comp_status, com_id) VALUES(?, ?, ?, ?) ");
                  mysqli_stmt_bind_param($stmt,'ssss',$impnom,$impval,$status2,$empid);
                  mysqli_stmt_execute($stmt);
                }                
                

                }
          } else {
            $sql2="UPDATE company SET com_ruc='$uruc', com_name='$uempresa', com_direction ='$udirecion', com_phone='$utele'
              WHERE com_id='$empid'";
            $res2 = mysqli_query($con,$sql2);

            if ($impid !='') {
              $sql0 = "UPDATE company_param SET comp_name='$impnom', comp_value ='$impval' WHERE comp_id ='$impid'";  
              $res0 = mysqli_query($con,$sql0);
              ///CUENTA CONTABLE
              $sqlbu = "SELECT own_id FROM company_ledger_owner WHERE own_type='Impuestos' AND com_id='$empid' AND own_details='$impid'";
              $resbu = mysqli_query($con,$sqlbu);
              $arrbu = mysqli_fetch_array($resbu,MYSQLI_ASSOC);
              $busbu = $arrbu['own_id'];
              if ($busbu =="") {
              $sql1 = "SELECT CargaCuentas('Impuestos','$empid','$impid')";
              $res1 = mysqli_query($con,$sql1);  
              }    
            } else { 
              ///PARAMETROS 
              $status2 = 1;
              $stmt = mysqli_prepare($con, "INSERT INTO company_param (comp_name, comp_value, comp_status, com_id) VALUES(?, ?, ?, ?) ");
              mysqli_stmt_bind_param($stmt,'ssss',$impnom,$impval,$status2,$empid);
              mysqli_stmt_execute($stmt);
              ///
              $sqlp = "SELECT MAX(comp_id) AS pidd FROM company_param WHERE com_id='$empid'";
              $resp = mysqli_query($con,$sqlp);
              $arrp = mysqli_fetch_array($resp,MYSQLI_ASSOC);
              $pidd = $arrp['pidd'];
              
              if ($pidd !='') {
                $sql1 = "SELECT CargaCuentas('Impuestos','$empid','$pidd')";
                $res1 = mysqli_query($con,$sql1);  
              }
            } 
          }
          $listar = array("data" =>'1');
          $data[] = $listar;
      }
    break; 

case '3':
    $bnombre =  ucwords($_POST['bnombre']);
    $status = "1";
    $empbb = $_POST['empbb'];
    ///
    $stmt = mysqli_prepare($con, "INSERT INTO banks (ban_name, ban_status, com_id) VALUES(?, ?, ?) ");
    mysqli_stmt_bind_param($stmt,'sss',$bnombre,$status,$empbb);
    mysqli_stmt_execute($stmt);
    ///
    $listar = array("data" =>'1');
    $data[] = $listar;
  break;

case '4':
   $dbuid = $_POST['dbuid'];
   $selmod = $_POST['selmod'];
   $empbb= $_POST['empbb'];
   $actuse = $_POST['actuse'];
   $unombre = $_POST['unombre'];
   ///
   $stmt = mysqli_prepare($con, "UPDATE company_departament SET det_status=? WHERE det_id=?");
    mysqli_stmt_bind_param($stmt,'ss',$selmod,$dbuid);
    mysqli_stmt_execute($stmt);
    ///
    $detalle ='SE ACTUALIZO EL STATUS DEL DEPARTAMENTO '.$unombre;
    $sqlbit = "SELECT Bitacora('I','ACTUALIZAR','$detalle','$actuse', '$hoy','$empbb','0')";
    $resbit = mysqli_query($con,$sqlbit);

   $listar = array("data" =>'1');
   $data[] = $listar; 
  break;    

  case '5':
   $ceid= $_POST['ceid'];
   $enombre = ucwords($_POST['enombre']);
   $empbb= $_POST['empbb'];
   $actuse = $_POST['actuse'];
   $stmt = mysqli_prepare($con, "UPDATE company_departament SET det_name=? WHERE det_id=?");
    mysqli_stmt_bind_param($stmt,'ss',$enombre,$ceid);
    mysqli_stmt_execute($stmt);
    ///
    $detalle ='SE ACTUALIZO EL DEPARMENTO '.$enombre;
    $sqlbit = "SELECT Bitacora('I','ACTUALIZAR','$detalle','$actuse', '$hoy','$empbb','0')";
    $resbit = mysqli_query($con,$sqlbit);
    ///
  $listar = array("data" =>'1');
  $data[] = $listar;
  break;

  case '6':
    $status = "1";
    $empbb = $_POST['empbb'];
    $bnombre = ucwords($_POST['bnombre']);
    $actuse = $_POST['actuse'];
    ///
    $stmt = mysqli_prepare($con, "INSERT INTO company_departament (det_name, det_status, com_id) VALUES(?, ?, ?) ");
    mysqli_stmt_bind_param($stmt,'sss',$bnombre,$status,$empbb);
    mysqli_stmt_execute($stmt);
    ///
    $detalle ='SE AGREGO UN NUEVO DEPARTAMENTO '.$bnombre;
    $sqlbit = "SELECT Bitacora('I','INSERTAR','$detalle','$actuse', '$hoy','$empbb','0')";
    $resbit = mysqli_query($con,$sqlbit);


    $listar = array("data" =>'1');
    $data[] = $listar;
    break;    

case '7':
      $empid = $_POST['empbb'];
      $stmt = mysqli_prepare($con, "SELECT *, (CASE WHEN det_status = '1' THEN CONCAT('$stylei','Activo','$stylef') 
      ELSE CONCAT('$stylei2','Inactivo','$stylef') END) status from company_departament 
      WHERE com_id='$empid'");
      $exec = mysqli_stmt_execute($stmt);
      $result = get_result($stmt);
      while ($row = array_shift($result)) {
           { $data[] = $row; }
       }
    break;

case '8': // FILTRAR  banco
  $empid = $_POST['empbb'];
  $sql="SELECT * from company_departament WHERE com_id='$empid'";
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
 
case '9': // FILTRAR  CLIENTE
  $empid = $_POST['empid'];
  $sql="SELECT * from user WHERE com_id='$empid'";
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
 
  case '10':
    $empid = $_POST['empid'];
    $sql="SELECT * from company_office WHERE com_id='$empid'";
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

    case '11':
        $empid = $_POST['empid'];
        $stmt = mysqli_prepare($con, "SELECT *,(CASE WHEN off_main = '1' THEN CONCAT('$stylei','Principal','$stylef')
                WHEN off_main = '2' THEN CONCAT('$stylei','Sucursal','$stylef') 
                ELSE CONCAT('$stylei2','Almacen','$stylef') END) as tiposuc,
                (CASE WHEN off_status = '1' THEN CONCAT('$stylei','Activo','$stylef')
                ELSE CONCAT('$stylei2','Inactivo','$stylef') END) as statuss
                from company_office WHERE com_id='$empid'");
        $exec = mysqli_stmt_execute($stmt);
        $result = get_result($stmt);
        while ($row = array_shift($result)) {
             { $data[] = $row; }
         }
      break;

    case '12':
      $snombre = $_POST['snombre'];
      $sdirecion = $_POST['sdirecion'];
      $stele = $_POST['stele'];
      $stipo = $_POST['stipo'];
      $sresponsa = $_POST['sresponsa'];
      $usubb = $_POST['usubb'];
      $empid = $_POST['empid'];
      $status = 1;
      ///
      $stmt = mysqli_prepare($con, "INSERT INTO company_office (off_name, off_direction, off_phone, off_main, off_status,com_id,off_responsible)
       VALUES(?, ?, ?, ?, ?, ?, ?) ");
        mysqli_stmt_bind_param($stmt,'sssssss',$snombre,$sdirecion,$stele,$stipo,$status,$empid,$sresponsa);
        mysqli_stmt_execute($stmt);
      ///
      $detalle ='SE AGREGO UN NUEVA SUCURSAL '.$snombre;
      $sqlbit = "SELECT Bitacora('I','INSERTAR','$detalle','$usubb', '$hoy','$empid','0')";
      $resbit = mysqli_query($con,$sqlbit);
      $listar = array("data" =>"1");
      $data[] = $listar;
      break; 
      
    case '13':
      $eid= $_POST['eid'];
      $esnombre = $_POST['esnombre'];
      $esdirecion = $_POST['esdirecion'];
      $estele = $_POST['estele'];
      $esresponsa = $_POST['esresponsa'];
      $estipo = $_POST['estipo'];
      $usubb = $_POST['usubb'];
      $empid = $_POST['empid'];
      ///
      $stmt = mysqli_prepare($con, "UPDATE company_office SET off_name=?, off_direction=?, off_phone=?, 
          off_main=?, off_responsible=? WHERE off_id=?");
        mysqli_stmt_bind_param($stmt,'ssssss',$esnombre,$esdirecion,$estele,$estipo,$esresponsa,$eid);
        mysqli_stmt_execute($stmt);
        ///
        $detalle ='SE ACTUALIZO LA SUCURSAL '.$esnombre;
        $sqlbit = "SELECT Bitacora('I','ACTUALIZAR','$detalle','$usubb', '$hoy','$empid','0')";
        $resbit = mysqli_query($con,$sqlbit);
        $listar = array("data" =>"1");
        $data[] = $listar;
      break;

    case '14':
      $obuid = $_POST['obuid'];
      $selmod = $_POST['selmod'];
      $usubb = $_POST['usubb'];
      $empid = $_POST['empid'];
      $osucc = $_POST['osucc'];
      ///
      $stmt = mysqli_prepare($con, "UPDATE company_office SET off_status=? WHERE off_id=?");
      mysqli_stmt_bind_param($stmt,'ss',$selmod,$obuid);
      mysqli_stmt_execute($stmt);
      ///
      $detalle ='SE ACTUALIZO EL STATUS DE LA SUCURSAL '.$osucc;
      $sqlbit = "SELECT Bitacora('I','ACTUALIZAR','$detalle','$usubb', '$hoy','$empid','0')";
        $resbit = mysqli_query($con,$sqlbit);
        $listar = array("data" =>"1");
        $data[] = $listar;
      break;  
      
}         
  print json_encode($data);

 ?>
