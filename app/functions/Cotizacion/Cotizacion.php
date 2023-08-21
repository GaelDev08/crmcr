<?php
include "../../../functions/BD.php";
include "../../../functions/GetResult.php";

$opc = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch ($opc) {

case '0':
      /* crear una sentencia preparada */
      $stylei = '<div class="badge badge-soft-success font-size-12">';
      $stylei2 = '<div class="badge badge-soft-danger font-size-12">';
      $stylei3 = '<div class="badge badge-soft-info font-size-12">';
      $stylef = '</div>';
      $empid = $_POST['empid'];

    $stmt = mysqli_prepare($con, "SELECT s.quo_id,s.quo_code,c.cli_name,DATE_FORMAT(s.quo_date,'%d/%m/%Y') sell_fecha, u.cur_name,   
    CONCAT(u.cur_symbol,' ',(SELECT SUM((d.qdet_quantity)*(d.qdet_price_out)) FROM quotation_details d WHERE d.quo_id = s.quo_id)) as total,
    (CASE WHEN s.quo_status = '0' THEN CONCAT('$stylei','Activa','$stylef') WHEN s.quo_status = '1' THEN CONCAT('$stylei','Activa','$stylef') WHEN s.quo_status = '2' THEN CONCAT('$stylei','Eliminada','$stylef')  ELSE CONCAT('$stylei2','Inactivo','$stylef') END) status
    FROM quotation s, clients c, currency u 
    WHERE c.cli_id = s.cli_id AND s.com_id='$empid' AND u.cur_id = s.cur_id and (s.quo_status='1' or s.quo_status='0')");
      $exec = mysqli_stmt_execute($stmt);
      $result = get_result($stmt);
      while ($row = array_shift($result)) {
           { $data[] = $row; }
       }
    break;

case '4':
  $confac = $_POST['confac'];
  $selclien = $_POST['selclien'];
  $confecha = $_POST['confecha'];
  $selmone = $_POST['selmone']; 
  $conpag = $_POST['conpag'];
  $selpro = $_POST['selpro'];
  $concant = $_POST['concant'];
  $concvent = $_POST['concvent'];
  $selsucur = $_POST['selsucur'];
  $bempid = $_POST['bempid'];
  $codsh = $_POST['codsh'];
  $bid = $_POST['bid'];

  /// 
   $sqlb = "SELECT quo_id FROM quotation WHERE quo_id='$codsh' AND quo_code='$confac' and com_id='$bempid'";
   $resb = mysqli_query($con,$sqlb);
   $arrb = mysqli_fetch_array($resb,MYSQLI_ASSOC);
   $busv = $arrb['quo_id'];

   if ($busv !='') {
   #existe la factura
   $sqlbp = "SELECT product_id, qdet_quantity  FROM quotation_details WHERE product_id='$selpro' AND com_id='$bempid' AND quo_id='$codsh'";
   $resbp = mysqli_query($con,$sqlbp);
   $arrbp = mysqli_fetch_array($resbp,MYSQLI_ASSOC);
   $buscp = $arrbp['product_id'];
   $canbp = $arrbp['qdet_quantity'];
   if ($buscp !='') {
     $tsalida = $canbp + $concant;
     $sql2 = "UPDATE quotation_details SET qdet_quantity ='$tsalida' WHERE product_id='$selpro' AND com_id='$bempid' AND quo_id='$codsh'";
     if (!mysqli_query ($con,$sql2)) { 
          echo("Error Cotizacion Detalle: " . mysqli_error($con)); 
        }
    } else {
      #DETALLE 
         $sqlp = "SELECT COUNT(product_id)+1 as position2 FROM quotation_details WHERE quo_id='$codsh'";
          $resp = mysqli_query($con,$sqlp);
          $arrp = mysqli_fetch_array($resp,MYSQLI_ASSOC);
          $positi = $arrp['position2'];

        $sql2="INSERT INTO quotation_details VALUES ('0','$concant','$concvent','$selpro','1','$bempid','$codsh','$positi')";
        if (!mysqli_query ($con,$sql2)) { 
          echo("Error Cotizacion Detalle: " . mysqli_error($con)); 
        } 
    }#si el producto no existe   
   } else {
   
    $sql1="INSERT INTO quotation VALUES ('$codsh','$confac','$confecha','$selmone','$selclien','$conpag','0','$bempid','$bid')";
      if (!mysqli_query ($con,$sql1)) { 
        echo("Error Cotizacion: " . mysqli_error($con));
       } else {
        $sqlp = "SELECT COUNT(product_id)+1 as position2 FROM selling_details WHERE sell_id='$codsh'";
        $resp = mysqli_query($con,$sqlp);
        $arrp = mysqli_fetch_array($resp,MYSQLI_ASSOC);
        $positi = $arrp['position2'];
        #DETALLE 
        $sql2="INSERT INTO quotation_details VALUES ('0','$concant','$concvent','$selpro','1','$bempid','$codsh','$positi')";
        if (!mysqli_query ($con,$sql2)) { 
          echo("Error Cotizacion Detalle: " . mysqli_error($con)); 
        }  
      }#error insert venta 
   }#no existe la factura

  $listar = array("data" =>"1");
  $data[] = $listar; 
  break;    

  case '5':
    $selpro=$_POST['id_produ'];
    $bempid = $_POST['bempid'];
    ///
    $sql0 = "SELECT price_out FROM product p, stock s 
    WHERE pro_barcode='$selpro' AND p.com_id='$bempid' AND p.pro_id = s.pro_id";
    $res0 = mysqli_query($con,$sql0);
    $arr0 = mysqli_fetch_array($res0,MYSQLI_ASSOC);
    $vprecio = $arr0['price_out'];
    if ($vprecio =='') {
      $error = 1;
    } else {
     $error = 0;
    }
    ///
    $listar = array("vprecio" =>$vprecio, "error" =>$error);
    $data[] = $listar;    
    break;    


    case '7':
      $empid = $_POST['bempid'];
      $status = "1";
      $pnum = $_POST['pnum'];
      $pnom =  ucwords($_POST['pnom']);
      $ptel1 = $_POST['ptel1'];
      $pmail = $_POST['pmail'];
      $pdirec = ucfirst($_POST['pdirec']);
      $selpais = $_POST['selpais'];
      $selestado = $_POST['selestado'];
      $pruta = ucfirst($_POST['pruta']);
      $selcivil = $_POST['selcivil'];
      $pocupa = ucfirst($_POST['pocupa']);
      $pcode = $_POST['pcode'];
      $pced = $_POST['pced']; 
      $pcnom = $_POST['pcnom']; 
      $tentre = $_POST['tentre'];
      $pdirect = ucfirst($_POST['pdirect']);
        if ($tentre=='SI') {
           $pdirect = $pdirec;
        }
      ///
      $stmt = mysqli_prepare($con, "INSERT INTO clients (cli_ruc, cli_name, cli_phone,cli_direction,cli_email,cli_status,com_id,cco_id,ccs_id,cli_route,cli_occupation,cli_marital_status,cli_zip_code,cli_number,cli_business_name,cli_direction_work) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
      mysqli_stmt_bind_param($stmt,'ssssssssssssssss',$pnum,$pcnom,$ptel1,$pdirec,$pmail,$status,$empid,$selpais,$selestado,$pruta,$pocupa,$selcivil,$pcode,$pced,$pnom,$pdirect);
      mysqli_stmt_execute($stmt);
      ///
      $sqlp = "SELECT MAX(cli_id) AS pidd FROM clients WHERE com_id='$empid' AND cli_ruc ='$pnum' and cli_name='$pnom'";
      $resp = mysqli_query($con,$sqlp);
      $arrp = mysqli_fetch_array($resp,MYSQLI_ASSOC);
      $pidd = $arrp['pidd'];
      ///
      if ($pidd !='') {
         $sql0 = "SELECT CargaCuentas('Clientes','$empid','$pidd')";
         $res0 = mysqli_query($con,$sql0);  
      }
      $listar = array("data" =>'1');
      $data[] = $listar;    
    break;     

case '8': // FILTRAR  user
  $empid = $_POST['bempid'];
  $codsh = $_POST['codsh'];
  $sql="SELECT * from quotation_details where com_id='$empid' and quo_id='$codsh'";
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
  
case '9': // FILTRAR  user
  $empid = $_POST['empid'];
  $sql="SELECT * from quotation where com_id='$empid'";
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
    $empid = $_POST['bempid'];
    $codsh = $_POST['codsh'];
    $sql="SELECT d.qdet_id,d.qdet_quantity,d.qdet_price_out,p.pro_name from quotation_details d, product p 
    WHERE d.com_id='$empid' and d.quo_id='$codsh' and p.pro_id = d.product_id";
    $result=mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($result))
    { $data[] = $row; }
    break;

case '11':
   $puid = $_POST['puid'];
   $codsh = $_POST['codsh'];
   ///
   $sql0 = "SELECT product_id FROM quotation_details WHERE quo_id='$codsh' AND qdet_id='$puid'";
   $res0 = mysqli_query($con,$sql0);
   $arr0 = mysqli_fetch_array($res0,MYSQLI_ASSOC);
   $proid = $arr0['product_id'];
   ///
   $sqld = "DELETE FROM quotation_details WHERE product_id ='$proid' and quo_id='$codsh'";
   $resd = mysqli_query($con,$sqld);

   $listar = array("data" =>"1");
   $data[] = $listar;
  break;



case '12':
    $eprodu = $_POST['eprodu'];
    $ecant = $_POST['ecant'];
    $codsh = $_POST['codsh'];
    $canter = $_POST['canter'];

    $sqlp = "SELECT product_id FROM quotation_details WHERE qdet_id='$eprodu' and quo_id='$codsh'";
    $resp = mysqli_query($con,$sqlp);
    $arrp = mysqli_fetch_array($resp,MYSQLI_ASSOC);
    $proid = $arrp['product_id'];

    /// 
    $sql0 = "UPDATE quotation_details SET qdet_quantity='$ecant' WHERE quo_id='$codsh' AND qdet_id='$eprodu'";
    $res0 = mysqli_query($con,$sql0);   
    
    ///
    $listar = array("data" =>"1");
    $data[] = $listar;
    break;  

case '13':
  $idcomp = $_POST['idcomp'];
  $bempid = $_POST['bempid'];
  ///
  $sql0 = "SELECT SUM((qdet_quantity)*(qdet_price_out)) as subtotal FROM quotation_details WHERE 
  quo_id = '$idcomp' and qdet_status='1' and com_id='$bempid'";
  $res0 = mysqli_query($con,$sql0);
  $arr0 = mysqli_fetch_array($res0,MYSQLI_ASSOC);
  $subtotal = $arr0['subtotal'];
  ///
  $sqliva = "SELECT comp_value,ROUND(comp_value/100,2) as iva   FROM company_param WHERE com_id='$bempid'";
  $resval = mysqli_query($con,$sqliva);
  $arrval = mysqli_fetch_array($resval,MYSQLI_ASSOC);
  $iva = $arrval['comp_value'];
  $biva = $arrval['iva'];
  if ($iva =="") {
    $iva = '16';
    $biva = 0.16;
  }
  ///
  $total = $subtotal + ($subtotal * $biva);
  $total =number_format($total, 2, '.', ',');
  $subtotal =number_format($subtotal, 2, '.', ',');
  ///
  $listar = array("total" =>$total,"subtotal" =>$subtotal, "iva" =>$iva);
  $data[] = $listar;    
  
  break;    

case '14':
   $buid = $_POST['buid'];
   $qcode = $_POST['qcode'];
   $empid = $_POST['empid'];

  $sql1 = "DELETE FROM quotation_details WHERE quo_id='$buid' and com_id='$empid'";
    $res1 = mysqli_query($con,$sql1);
  ///ELIMINAR VENTA
  $sql2 = "DELETE FROM quotation WHERE quo_id='$buid' and com_id='$empid'";
    $res2 = mysqli_query($con,$sql2);
  ///DESHABILITAR CODIGO
  $sql0 = "UPDATE configuration_sku SET conf_use='0' WHERE conf_code='$qcode'";
    $res0 = mysqli_query($con,$sql0);
   
  $listar = array("data" =>'1');
  $data[] = $listar;
 break;

 case '15':
  $bfactu = $_POST['bfactu'];
  $codsh = $_POST['codsh'];
  $bempid = $_POST['bempid'];

  $sql1 = "SELECT count(quo_id) as cuenta FROM quotation_details WHERE quo_id='$codsh' AND com_id='$bempid'";
  $res1 = mysqli_query($con,$sql1);
  $arr1 = mysqli_fetch_array($res1,MYSQLI_ASSOC);
  $cuenta = $arr1['cuenta'];
  ///
  if ($cuenta == 0) {
    $sql0 = "UPDATE configuration_sku SET conf_use='0' WHERE conf_code='$bfactu' AND com_id='$bempid'";
    $res0 = mysqli_query($con,$sql0);
  }
  
  /////
  $listar = array("data" =>'1');
  $data[] = $listar;
  break;





    }         
  print json_encode($data);

 ?>
