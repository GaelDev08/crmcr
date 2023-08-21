<?php
include "../../../functions/BD.php";
include "../../../functions/GetResult.php";
date_default_timezone_set('America/Costa_Rica');
$opc = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$hoy = date("Y-m-d H:i:s");  

switch ($opc) {

  case '0':
      /* crear una sentencia preparada */
      $stylei = '<div class="badge badge-soft-success font-size-12">';
      $stylei2 = '<div class="badge badge-soft-danger font-size-12">';
      $stylef = '</div>';
      $empid = $_POST['empid'];
      $stmt = mysqli_prepare($con, "SELECT *, 
      (CASE WHEN per_status = '1' THEN CONCAT('$stylei','Activo','$stylef') 
      ELSE CONCAT('$stylei2','Inactivo','$stylef') END) status2  FROM company_staff WHERE com_id='$empid'");
      $exec = mysqli_stmt_execute($stmt);
      $result = get_result($stmt);
      while ($row = array_shift($result)) {
           { $data[] = $row; }
       }
    break;

    case '1': // AGREGAR
    $empid = $_POST['empid'];
    $status = "1";
    $pnum = $_POST['pced'];
    $pmail = $_POST['pmail'];
    $pced = $_POST['pced']; 
    $pcnom = $_POST['pcnom']; 
    $srtel = "S/R";
    $srdom = "S/R";
    $bid = $_POST['bid'];
    $pcargo = $_POST['pcargo'];
    $acro ='I';


    ///
    $stmt = mysqli_prepare($con, "INSERT INTO company_staff (per_ruc, per_name, per_cell,per_phone,per_direction,
    per_email,per_status,com_id,per_occupation,cli_acronym) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
    mysqli_stmt_bind_param($stmt,'ssssssssss',$pnum,$pcnom,$srtel,$srtel,$srtel,$pmail,$status,$empid,$pcargo,$acro);
    mysqli_stmt_execute($stmt);

    ///
    $sqlp = "SELECT MAX(per_id) AS pidd FROM company_staff WHERE com_id='$empid' AND per_ruc ='$pced' and per_name='$pcnom'";
      $resp = mysqli_query($con,$sqlp);
      $arrp = mysqli_fetch_array($resp,MYSQLI_ASSOC);
      $pidd = $arrp['pidd'];
      ///
      $sqlbit = "SELECT Bitacora('I','INSERTAR','SE AGREGO UN NUEVO REMITENTE INTERNO','$bid','$hoy','$empid','0')";
      $resbit = mysqli_query($con,$sqlbit);   
    $listar = array("data" =>'1');
    $data[] = $listar;  
    break;

 case '2': // 
    $eid= $_POST['eid'];
    $epmail = $_POST['epmail'];
    $epced = $_POST['epced'];
    $epcnom = $_POST['epcnom']; 
    $epocupa = $_POST['epocupa'];
    $empid = $_POST['empid'];
    $bid = $_POST['bid'];   
    //
    $detalle = 'SE ACTUALIZARON LOS DATOS GENERALES DEL REMITENTE INTERNO'.$epmail;
    $stmt = mysqli_prepare($con, "UPDATE company_staff SET per_ruc=?, per_name=?, per_email=?, per_occupation=?
    where per_id=?");
    mysqli_stmt_bind_param($stmt,'sssss',$epced,$epcnom,$epmail,$epocupa,$eid);
    mysqli_stmt_execute($stmt);
     ///bitacora
     $sqlbit = "SELECT Bitacora('I','ACTUALIZAR',' $detalle','$bid', '$hoy','$empid','0')";
     $resbit = mysqli_query($con,$sqlbit);
    ////
    $listar = array("data" =>'1');
    $data[] = $listar;   
    break;

 case '3': // 
    $buid = $_POST['buid'];
    $selmod = $_POST['selmod'];
    $empid = $_POST['empid']; 
    $bid = $_POST['bid'];
    $bnombre = $_POST['bnombre'];
    $detalle = 'SE ACTUALIZO EL STATUS DEL REMITENTE INTERNO '.$bnombre;
    $stmt = mysqli_prepare($con, "UPDATE company_staff set per_status=? WHERE per_id=?");
    mysqli_stmt_bind_param($stmt,'ss',$selmod,$buid);
    mysqli_stmt_execute($stmt);
     ///bitacora
     $sqlbit = "SELECT Bitacora('I','ACTUALIZAR',' $detalle','$bid', '$hoy','$empid','0')";
     $resbit = mysqli_query($con,$sqlbit);
     ////
    $listar = array("data" =>'1');
    $data[] = $listar;
    break;

case '4':
   $eid = $_POST['eid'];
   $sql0 = "SELECT * FROM clients WHERE cli_id='$eid'";
   $res0 = mysqli_query($con,$sql0);
   while($row = mysqli_fetch_assoc($res0))
   { $data[] = $row; }
   break;    

case '5':
   $empid = $_POST['empid'];
   $pced = $_POST['pced'];
   $sql0 = "SELECT cli_number FROM clients WHERE com_id ='$empid' AND cli_number='$pced'";
   $res0 = mysqli_query($con,$sql0);
   $arr0 = mysqli_fetch_array($res0,MYSQLI_ASSOC);
   $vericed = $arr0['cli_number'];
   if ($vericed=='') {
      $vericed = 0;
   } else {
      $vericed = 1;
   }
   ///
   $listar = array("vericed" =>$vericed);
   $data[] = $listar;
   break; 

case '7':
   $empid = $_POST['empid'];
   $stmt = mysqli_prepare($con, "SELECT *  FROM company_sender WHERE com_id='$empid'");
      $exec = mysqli_stmt_execute($stmt);
      $result = get_result($stmt);
      while ($row = array_shift($result)) { { $data[] = $row; } }
   break;

case '8':
   $empid = $_POST['empid'];
   $sql="SELECT * from company_sender WHERE com_id='$empid'";
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

   
case '9': // FILTRAR  Categoria
  $empid = $_POST['empid'];
  $sql="SELECT * from company_staff WHERE com_id='$empid'";
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

    }         
  print json_encode($data);

 ?>
