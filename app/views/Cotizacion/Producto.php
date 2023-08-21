<?php
error_reporting(1);
include "../../../functions/BD.php";
$idemp = $_POST['idemp'];
if (isset($_POST['idemp'])){
    $sql="SELECT *, pro_name as pro_dispon FROM product WHERE com_id='$idemp' 
    AND pro_quantity >'0'";
    $result=mysqli_query($con,$sql);

echo "<option value=''>--</option>";
if ($result->num_rows > 0) {
  if($row1=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    do{
      echo '<option value="'.$row1['pro_id'].'">'.$row1['pro_dispon'].'</option>';
      } while($row1=mysqli_fetch_array($result,MYSQLI_ASSOC));
    }
  } 
  echo $html;
}
?>
