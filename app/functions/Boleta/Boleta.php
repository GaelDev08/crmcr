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
      $stmt = mysqli_prepare($con, "SELECT *, (CASE WHEN b.typ_status = '1' THEN CONCAT('$stylei','Activo','$stylef') 
      ELSE CONCAT('$stylei2','Inactivo','$stylef') END) status2   
      FROM ticket_type b WHERE b.com_id='$empid'");
      $exec = mysqli_stmt_execute($stmt);
      $result = get_result($stmt);
      while ($row = array_shift($result)) {
           { $data[] = $row; }
       }
    break;

    case '1': // AGREGAR  MODULO
      $bnombre = strtoupper($_POST['bnombre']);
      $bsigla = strtoupper($_POST['bsigla']);
      $empid = $_POST['empid'];
      $status = "1";
      $bid = $_POST['bid'];
      ///
      $stmt = mysqli_prepare($con, "INSERT INTO ticket_type (typ_name, typ_acronym, typ_status, com_id) VALUES(?, ?, ?, ?) ");
      mysqli_stmt_bind_param($stmt,'ssss',$bnombre,$bsigla,$status,$empid);
      mysqli_stmt_execute($stmt);
      ///
      $sqlbit = "SELECT Bitacora('I','INSERTAR','SE AGREGO UN TIPO DE BOLETA','$bid','$hoy','$empid','0')";
      $resbit = mysqli_query($con,$sqlbit);  
      ///
      $listar = array("data" =>'1');
      $data[] = $listar;
      break;

    case '2': // 
      $eid= $_POST['eid'];
      $esnombre =  strtoupper($_POST['esnombre']); 
      $esigla = strtoupper($_POST['esigla']);
      $bid = $_POST['bid'];
      $empid = $_POST['empid'];
      ///
      $stmt = mysqli_prepare($con, "UPDATE ticket_type set typ_name=?, typ_acronym=? where typ_id=?");
      mysqli_stmt_bind_param($stmt,'sss',$esnombre,$esigla,$eid);
      mysqli_stmt_execute($stmt);
      ///
      $detalle = 'SE ACTUALIZO EL TIPO DE BOLETA '.$esnombre;
      $sqlbit = "SELECT Bitacora('I','ACTUALIZAR','$detalle','$bid','$hoy','$empid','0')";
         $resbit = mysqli_query($con,$sqlbit);
      ///
      $listar = array("data" =>'1');
      $data[] = $listar;
      break;

 case '3': // 
    $buid = $_POST['buid'];
    $selmod = $_POST['selmod'];
    $bboln = $_POST['bboln'];
    $bid = $_POST['bid'];
    $empid = $_POST['empid'];
    //
    $stmt = mysqli_prepare($con, "UPDATE ticket_type set typ_status=? WHERE typ_id=?");
    mysqli_stmt_bind_param($stmt,'ss',$selmod,$buid);
    mysqli_stmt_execute($stmt);
    ///
    $detalle = 'SE ACTUALIZO EL STATUS DE LA BOLETA '.$bboln;
    $sqlbit = "SELECT Bitacora('I','ACTUALIZAR','$detalle','$bid','$hoy','$empid','0')";
       $resbit = mysqli_query($con,$sqlbit);
    ///
    $listar = array("data" =>'1');
    $data[] = $listar;
    break;
    
  

case '9': // FILTRAR  CLIENTE
  $empid = $_POST['empid'];
  $sql="SELECT * FROM ticket_type WHERE com_id='$empid'";
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
