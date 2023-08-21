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
      $stmt = mysqli_prepare($con, "SELECT * FROM ticket WHERE com_id='$empid'");
      $exec = mysqli_stmt_execute($stmt);
      $result = get_result($stmt);
      while ($row = array_shift($result)) {
           { $data[] = $row; }
       }
    break;

    case '1': // AGREGAR  MODULO
      $bnombre = ucwords($_POST['bnombre']);
      $empid = $_POST['empid'];
      $status = "1";
      ///
      $stmt = mysqli_prepare($con, "INSERT INTO banks (ban_name, ban_status, com_id) VALUES(?, ?, ?) ");
      mysqli_stmt_bind_param($stmt,'sss',$bnombre,$status,$empid);
      mysqli_stmt_execute($stmt);
      ///
      $listar = array("data" =>'1');
      $data[] = $listar;
    break;

    case '2': // 
      $eid= $_POST['eid'];
      $esnombre =  ucwords($_POST['esnombre']); 
      ///
      $stmt = mysqli_prepare($con, "UPDATE banks set ban_name=? where ban_id=?");
      mysqli_stmt_bind_param($stmt,'ss',$esnombre,$eid);
      mysqli_stmt_execute($stmt);
      ///
      $sql0 = "SELECT * FROM banks WHERE ban_id='$eid'";
      $res0 = mysqli_query($con,$sql0);
      while($row = mysqli_fetch_assoc($res0))
      { $data[] = $row; }
    break;

 case '3': // 
    $buid = $_POST['buid'];
    $selmod = $_POST['selmod'];
    //
    $stmt = mysqli_prepare($con, "UPDATE banks set ban_status=? WHERE ban_id=?");
    mysqli_stmt_bind_param($stmt,'ss',$selmod,$buid);
    mysqli_stmt_execute($stmt);
    ///
    $listar = array("data" =>'1');
    $data[] = $listar;
    break;


  case '6': ///BOLETAS HISTORICO 
    $empid = $_POST['empid'];
    $sql="SELECT * from ticket  WHERE com_id='$empid' AND tick_status='2'";
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



 case '8': ///BOLETAS ABIERTAS 
  $empid = $_POST['empid'];
  $sql="SELECT * from ticket  WHERE com_id='$empid' AND tick_status='1'";
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
  $sql="SELECT * from ticket  WHERE com_id='$empid'";
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
