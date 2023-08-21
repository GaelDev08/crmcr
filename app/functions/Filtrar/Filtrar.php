<?php
include "../../../functions/BD.php";
include "../../../functions/GetResult.php";
$opc = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$stylei = '<div class="badge badge-soft-success font-size-12">';
$stylei2 = '<div class="badge badge-soft-danger font-size-12">';
$stylei3 = '<div class="badge badge-soft-info font-size-12">';
$stylef = '</div>';
switch ($opc) {
     #######FILTRAR BITACORA 
      case '1':
        $empid = $_POST['empid'];    $xdesde = $_POST['fini'];  $xhasta = $_POST['ffin'];
        $sql = "SELECT * FROM company_record WHERE  com_id ='$empid' AND (DATE_FORMAT(rec_date,'%Y-%m-%d')>='$xdesde' 
        AND DATE_FORMAT(rec_date,'%Y-%m-%d')<='$xhasta') LIMIT 1";
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
      
    case '2':
      $empid = $_POST['empid'];    $xdesde = $_POST['fini'];  $xhasta = $_POST['ffin'];
      $sql = "SELECT * FROM company_record WHERE  com_id ='$empid' AND (DATE_FORMAT(rec_date,'%Y-%m-%d')>='$xdesde' 
      AND DATE_FORMAT(rec_date,'%Y-%m-%d')<='$xhasta')";
      $result=mysqli_query($con,$sql);
      while($row = mysqli_fetch_assoc($result))
      { $data[] = $row; }
      break;  
      
    case '3':
        $empid = $_POST['empid'];    $xdesde = $_POST['fini'];  $xhasta = $_POST['ffin'];
        $statub = $_POST['statub'];
        $sql = "SELECT * FROM ticket WHERE  com_id ='$empid' AND (DATE_FORMAT(tick_received,'%Y-%m-%d')>='$xdesde' 
        AND DATE_FORMAT(tick_received,'%Y-%m-%d')<='$xhasta') LIMIT 1";
        $result=mysqli_query($con,$sql);
        $nrow = mysqli_num_rows($result);
        if ($nrow>'0') {     
       while($row = mysqli_fetch_assoc($result))  { $data[] = $row; }
       } else {
       $listar = array("data" =>$nrow);
       $data[] = $listar;
       }
     break; 
     
     
     case '5':
      $empid = $_POST['empid'];    $xdesde = $_POST['fini'];  $xhasta = $_POST['ffin']; 
      $sql = "SELECT * FROM ticket WHERE  com_id ='$empid' AND (DATE_FORMAT(tick_received,'%Y-%m-%d')>='$xdesde' 
      AND DATE_FORMAT(tick_received,'%Y-%m-%d')<='$xhasta') AND cat_id=99 LIMIT 1";
      $result=mysqli_query($con,$sql);
      $nrow = mysqli_num_rows($result);
      if ($nrow>'0') {     
     while($row = mysqli_fetch_assoc($result))  { $data[] = $row; }
      } else {
      $listar = array("data" =>$nrow);
      $data[] = $listar;
      }
      break;
         

    }         
  print json_encode($data);

 ?>
