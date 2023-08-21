<?php
error_reporting(1);
include "../../../functions/BD.php";
$idemp = $_POST['idemp'];
$idcli = $_POST['idcli'];
if (isset($_POST['idemp'])){
	if ($idcli !='0') {
	  $sql="SELECT * FROM clients WHERE com_id='$idemp' and cli_id='$idcli'
	  UNION ALL
	  SELECT * FROM clients WHERE com_id='$idemp' and cli_id<>'$idcli'
	  ";	
	} else {
		$new = $_POST['new'];
		if ($new=='') {
			$sql="SELECT * FROM clients WHERE com_id='$idemp'";	
		} else {
			$sql="SELECT * FROM clients WHERE com_id='$idemp' ORDER BY cli_id DESC";	
		}
	}
    $result=mysqli_query($con,$sql);

if ($idcli =='0') {
		echo "<option value=''>--</option>";
}

if ($result->num_rows > 0) {
  if($row1=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    do{
      echo '<option value="'.$row1['cli_id'].'">'.$row1['cli_name'].'</option>';
      } while($row1=mysqli_fetch_array($result,MYSQLI_ASSOC));
    }
  } 
  echo $html;
}
?>
