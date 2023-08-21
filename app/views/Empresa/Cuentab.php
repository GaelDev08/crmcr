<?php
error_reporting(1);
include "../../../functions/BD.php";
$idemp = $_POST['idemp'];
if (isset($_POST['idemp'])){
    $sql="SELECT g.ban_name, g.ban_id from banks g WHERE g.com_id='$idemp' AND ban_status='1'";
    $result=mysqli_query($con,$sql);

echo "<option value=''>--</option>";
if ($result->num_rows > 0) {
  if($row1=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    do{
      echo '<option value="'.$row1['ban_id'].'">'.$row1['ban_name'].'</option>';
      } while($row1=mysqli_fetch_array($result,MYSQLI_ASSOC));
    }
  }
  echo $html;
}
?>
