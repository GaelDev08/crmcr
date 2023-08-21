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
      $stmt = mysqli_prepare($con, "SELECT *, (CASE WHEN cat_status = '1' THEN CONCAT('$stylei','Activo','$stylef') 
      ELSE CONCAT('$stylei2','Inactivo','$stylef') END) status2   FROM ticket_category WHERE com_id='$empid'");
      $exec = mysqli_stmt_execute($stmt);
      $result = get_result($stmt);
      while ($row = array_shift($result)) {
           { $data[] = $row; }
       }
    break;

    case '1': // AGREGAR  CATEGORIA
    $mnombre = $_POST['mnombre']; 
    $empid = $_POST['empid'];
    $status = "1";
    $bid = $_POST['bid'];
    ///
    $stmt = mysqli_prepare($con,"INSERT INTO ticket_category (cat_name, cat_status, com_id) VALUES(?, ?, ?)");
      mysqli_stmt_bind_param($stmt,'sss',$mnombre,$status,$empid);
      mysqli_stmt_execute($stmt);
      $stmt->close();
      //printf("Error: %s.\n", $stmt->error);
      $sqlbit = "SELECT Bitacora('I','INSERTAR','SE AGREGO UNA CATEGORIA','$bid','$hoy','$empid','0')";
        $resbit = mysqli_query($con,$sqlbit);
    ///
    $listar = array("data" =>'1');
    $data[] = $listar;
    break;

    case '2': // ACTUALIZAR DATOS GENERALES 
    $eid= $_POST['eid'];
    $emnombre =  $_POST['emnombre']; 
    $bid = $_POST['bid'];
    $empid = $_POST['empid'];

    $stmt = mysqli_prepare($con, "UPDATE ticket_category set cat_name=? where cat_id=?");
    mysqli_stmt_bind_param($stmt,'ss',$emnombre,$eid);
    mysqli_stmt_execute($stmt);
    $stmt->close();
    ///
    $detalle = 'SE ACTUALIZO LA CATEGORIA '.$emnombre;
      $sqlbit = "SELECT Bitacora('I','ACTUALIZAR','$detalle','$bid','$hoy','$empid','0')";
      $resbit = mysqli_query($con,$sqlbit);
    ///     
    $listar = array("data" =>'1');
    $data[] = $listar;
    break;

 case '3': // ACTUALIZAR STATUS
    $buid = $_POST['buid'];     $selmod = $_POST['selmod'];
    $bid = $_POST['bid'];       $empid = $_POST['empid'];
    $bcatnom = $_POST['bcatnom'];
    $stmt = mysqli_prepare($con, "UPDATE ticket_category set cat_status=? WHERE cat_id=?");
      mysqli_stmt_bind_param($stmt,'ss',$selmod,$buid);
      mysqli_stmt_execute($stmt);
    ///
    $detalle = 'SE ACTUALIZO EL STATUS DE LA CATEGORIRA '.$bcatnom;
    $sqlbit = "SELECT Bitacora('I','ACTUALIZAR','$detalle','$bid','$hoy','$empid','0')";
       $resbit = mysqli_query($con,$sqlbit);
    ///   
    $listar = array("data" =>'1');
    $data[] = $listar;
    break;
    
case '9': // FILTRAR  Categoria
  $empid = $_POST['empid'];
  $sql="SELECT * from ticket_category WHERE com_id='$empid'";
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
