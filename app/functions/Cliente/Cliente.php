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
      $stmt = mysqli_prepare($con, "SELECT *, (CASE WHEN cli_status = '1' THEN CONCAT('$stylei','Activo','$stylef') ELSE CONCAT('$stylei2','Inactivo','$stylef') END) status2  FROM clients WHERE com_id='$empid'");
      $exec = mysqli_stmt_execute($stmt);
      $result = get_result($stmt);
      while ($row = array_shift($result)) {
           { $data[] = $row; }
       }
    break;

    case '1': // AGREGAR
    $empid = $_POST['empid'];
    $status = "1";
    $pnum = $_POST['pnum'];
    $pnom =  ucwords($_POST['pnom']);
    $ptel1 = $_POST['ptel1'];
    $pmail = $_POST['pmail'];
    $pdirec = ucfirst($_POST['pdirec']);
    $pruta = ucfirst($_POST['pruta']);
    $selcivil = $_POST['selcivil'];
    $pocupa = ucfirst($_POST['pocupa']);
    $pcode = $_POST['pcode'];
    $pced = $_POST['pced']; 
    $pcnom = $_POST['pcnom']; 
    $pdirect = ucfirst($_POST['pdirect']);
    $srtel = "S/R";
    $srdom = "S/R";
    $bid = $_POST['bid'];
    ///
    $stmt = mysqli_prepare($con, "INSERT INTO clients (cli_ruc, cli_name, cli_phone_home,cli_phone_cell,cli_phone_work,
    cli_direction,cli_email,cli_status,cli_route,cli_occupation,cli_marital_status,cli_zip_code,cli_number,
    cli_business_name,cli_direction_work,cli_domain,com_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
    mysqli_stmt_bind_param($stmt,'sssssssssssssssss',$pnum,$pcnom,$ptel1,$ptel1,$srtel,$pdirec,$pmail,
    $status,$pruta,$pocupa,$selcivil,$pcode,$pced,$pnom,$pdirect,$srdom,$empid);
    mysqli_stmt_execute($stmt);
    ///
    $sqlp = "SELECT MAX(cli_id) AS pidd FROM clients WHERE com_id='$empid' AND cli_number ='$pced' and cli_name='$pcnom'";
      $resp = mysqli_query($con,$sqlp);
      $arrp = mysqli_fetch_array($resp,MYSQLI_ASSOC);
      $pidd = $arrp['pidd'];
      ///
      $sqlbit = "SELECT Bitacora('I','INSERTAR','SE AGREGO UN NUEVO CLIENTE','$bid','$hoy','$empid','0')";
      $resbit = mysqli_query($con,$sqlbit);   
    $listar = array("data" =>'1');
    $data[] = $listar;  
    break;

 case '2': // 
    $eid= $_POST['eid'];
    $epnum = $_POST['epnum'];
    $epnom = ucwords($_POST['epnom']);
    $eptel1 = $_POST['eptel1'];
    $epmail = $_POST['epmail'];
    $epdirec = ucfirst($_POST['epdirec']);
    $epruta = ucfirst($_POST['epruta']);
    $epocupa = ucfirst($_POST['epocupa']);
    $eselcivil = $_POST['eselcivil'];
    $epcode  = $_POST['epcode'];
    $epced = $_POST['epced'];
    $epcnom = $_POST['epcnom']; 
    $epdirect = $_POST['epdirect'];
    $empid = $_POST['empid'];
    $bid = $_POST['bid'];
    //
    $detalle = 'SE ACTUALIZARON LOS DATOS GENERALES DEL CLIENTE '.$epcnom;
    $stmt = mysqli_prepare($con, "UPDATE clients set cli_ruc=?, cli_name=?, cli_phone_home=?, cli_phone_cell=?, cli_direction=?, cli_email=? ,
    cli_route=?, cli_occupation=?, cli_marital_status=?, cli_zip_code=?, cli_number=?, cli_business_name=?,
    cli_direction_work=?
    where cli_id=?");
    mysqli_stmt_bind_param($stmt,'ssssssssssssss',$epnum,$epcnom,$eptel1,$eptel1,$epdirec,$epmail,$epruta,
    $epocupa,$eselcivil,$epcode,$epced,$epnom,$epdirect,$eid);
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
    $detalle = 'SE ACTUALIZO EL STATUS DEL USUARIO '.$bnombre;
    $stmt = mysqli_prepare($con, "UPDATE clients set cli_status=? WHERE cli_id=?");
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

   
case '9': // FILTRAR  Categoria
  $empid = $_POST['empid'];
  $sql="SELECT * from clients WHERE com_id='$empid'";
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
