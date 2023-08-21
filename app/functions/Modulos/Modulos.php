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
      $stmt = mysqli_prepare($con, "SELECT *, CONCAT(CurrenMod(mod_id),' ',PrecioMod('P',mod_id)) as preciom,
      (CASE WHEN mod_status = '1' THEN CONCAT('$stylei','Activo','$stylef') 
      ELSE CONCAT('$stylei2','Inactivo','$stylef') END) status2   
      FROM module");
      $exec = mysqli_stmt_execute($stmt);
      $result = get_result($stmt);
      while ($row = array_shift($result)) {
           { $data[] = $row; }
       }
    break;

    case '1': // AGREGAR  MODULO
    $mnombre = ucfirst($_POST['mnombre']); 
    $mselmone = $_POST['mselmone']; 
    $mprecio = $_POST['mprecio']; 
    $status = "1";
    ///
    $stmt = mysqli_prepare($con, "INSERT INTO module(mod_name,mod_status)VALUES(?,?) ");
    mysqli_stmt_bind_param($stmt,'ss',$mnombre,$status);
    mysqli_stmt_execute($stmt);
    ///
    $sql0 = "SELECT MAX(mod_id) AS lastmod FROM module WHERE mod_name='$mnombre'";
    $res0 = mysqli_query($con,$sql0);
    $arr0 = mysqli_fetch_array($res0,MYSQLI_ASSOC);
    $buscap = $arr0['lastmod'];
    if ($buscap !='') {
      $stmt2 = mysqli_prepare($con, "INSERT INTO module_price(prm_price,mod_id,cur_id)VALUES(?, ?, ?) ");
      mysqli_stmt_bind_param($stmt2,'sss',$mprecio,$buscap,$mselmone);
      mysqli_stmt_execute($stmt2);
    }
    $listar = array("data" =>'1');
    $data[] = $listar;
    break;

    case '2': // 
    $eid= $_POST['eid'];
    $emnombre =  ucfirst($_POST['emnombre']); 
    $selmone = $_POST['selmone'];
    $eprecio = $_POST['eprecio'];

    $stmt = mysqli_prepare($con, "UPDATE module set mod_name=? where mod_id=?");
    mysqli_stmt_bind_param($stmt,'ss',$emnombre,$eid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $FilasC=mysqli_stmt_num_rows($stmt);
    $Resulta=mysqli_stmt_store_result($stmt);
    
    $sql0 = "SELECT prm_id FROM module_price WHERE mod_id='$eid'";
    $res0 = mysqli_query($con,$sql0);
    $arr0 = mysqli_fetch_array($res0,MYSQLI_ASSOC);
    $buscap = $arr0['prm_id'];
      if ($buscap !='') {
        $sqlu = "UPDATE module_price SET prm_price='$eprecio', cur_id='$selmone' WHERE prm_id='$buscap' AND mod_id='$eid'";
        $resu = mysqli_query($con,$sqlu);
      } else {
        $stmt2 = mysqli_prepare($con, "INSERT INTO module_price(prm_price,mod_id,cur_id)VALUES(?, ?, ?) ");
        mysqli_stmt_bind_param($stmt2,'sss',$eprecio,$eid,$selmone);
        mysqli_stmt_execute($stmt2);
      }
    ///
    $listar = array("data" =>'1');
    $data[] = $listar;
    break;

 case '3': // 
    $buid = $_POST['buid'];
    $selmod = $_POST['selmod'];
    $stmt = mysqli_prepare($con, "UPDATE module set mod_status=? WHERE mod_id=?");
    mysqli_stmt_bind_param($stmt,'ss',$selmod,$buid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $FilasC=mysqli_stmt_num_rows($stmt);
    $Resulta=mysqli_stmt_store_result($stmt);
    $listar = array("data" =>'1');
    $data[] = $listar;
    break;
 
 case '4':
   $eid = $_POST['eid'];
   $sql0 = "SELECT  PrecioMod('P','$eid') as preciob";
   $res0 = mysqli_query($con,$sql0);
   $arr0 = mysqli_fetch_array($res0,MYSQLI_ASSOC);
   $preciob = $arr0['preciob'];
   ///
   $listar = array("preciob" =>$preciob);
   $data[] = $listar;
   break;   
    
  

case '9': // FILTRAR  CLIENTE
  $sql="SELECT * from module ";
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
