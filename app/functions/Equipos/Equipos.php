<?php
include "../../../functions/BD.php";
include "../../../functions/GetResult.php";

$opc = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch ($opc) {

  case '0':
      /* crear una sentencia preparada
          <div class="badge badge-soft-success font-size-12">Paid</div>
       */
      $stylei = '<div class="badge badge-soft-success font-size-12">';
      $stylei2 = '<div class="badge badge-soft-danger font-size-12">';
      $stylef = '</div>';
      $empid = $_POST['empid'];
      $stmt = mysqli_prepare($con, "SELECT *, (CASE WHEN equi_status = '1' THEN CONCAT('$stylei','Activo','$stylef') 
      ELSE CONCAT('$stylei2','Inactivo','$stylef') END) status2   FROM equiments WHERE com_id='$empid'");
      $exec = mysqli_stmt_execute($stmt);
      $result = get_result($stmt);
      while ($row = array_shift($result)) {
           { $data[] = $row; }
       }
    break;

    case '1': // AGREGAR  MODULO
    $mnombre = $_POST['mnombre']; 
    $empid = $_POST['empid'];
    $status = "1";
    ///
    $stmt = mysqli_prepare($con,"INSERT INTO equiments (equi_name, equi_status, com_id) VALUES(?, ?, ?)");
      mysqli_stmt_bind_param($stmt,'sss',$mnombre,$status,$empid);
      mysqli_stmt_execute($stmt);
      //printf("Error: %s.\n", $stmt->error);
      $stmt->close();
    
    ///
    $listar = array("data" =>'1');
    $data[] = $listar;
    break;

    case '2': // 
    $eid= $_POST['eid'];
    $emnombre =  $_POST['emnombre']; 

    $stmt = mysqli_prepare($con, "UPDATE equiments set equi_name=? where equi_id=?");
    mysqli_stmt_bind_param($stmt,'ss',$emnombre,$eid);
    mysqli_stmt_execute($stmt);
    ///
    $listar = array("data" =>'1');
    $data[] = $listar;
    break;

 case '3': // 
    $buid = $_POST['buid'];
    $selmod = $_POST['selmod'];
    $stmt = mysqli_prepare($con, "UPDATE equiments set equi_status=? WHERE equi_id=?");
    mysqli_stmt_bind_param($stmt,'ss',$selmod,$buid);
    mysqli_stmt_execute($stmt);
    ///
    $listar = array("data" =>'1');
    $data[] = $listar;
    break;





    
case '9': // FILTRAR  Categoria
  $empid = $_POST['empid'];
  $sql="SELECT * from equiments WHERE com_id='$empid'";
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
