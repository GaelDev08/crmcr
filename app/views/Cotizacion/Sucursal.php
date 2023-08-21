<?php
error_reporting(1);
include "../../../functions/BD.php";
$idemp = $_POST['idemp'];
if (isset($_POST['idemp'])){
    $sql="SELECT * FROM company_office WHERE com_id='$idemp' and off_main='2'";
    $result=mysqli_query($con,$sql);

echo "<option value=''>--</option>";
if ($result->num_rows > 0) {
  if($row1=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    do{
      echo '<option value="'.$row1['off_id'].'">'.$row1['off_name'].'</option>';
      } while($row1=mysqli_fetch_array($result,MYSQLI_ASSOC));
    }
  } 
  echo $html;
}
?>
