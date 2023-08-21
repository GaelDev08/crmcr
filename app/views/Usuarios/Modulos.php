<?php
error_reporting(1);
include "../../../functions/BD.php";
$idemp = $_POST['idemp'];
if (isset($_POST['idemp'])){
    $acum = ""; $contador = 0;
    $sqlfil = "SELECT gm.mod_id FROM groups_main gm WHERE gm.use_id = '$idemp'";
    $resfil = mysqli_query($con,$sqlfil);
    $numrow = mysqli_num_rows($resfil);
    ///
      while ($row = mysqli_fetch_array($resfil)) {
        $contador = $contador + 1;
        if ($contador == $numrow) {
          $acum = $acum.$row['mod_id'];
        } else {
          $acum = $acum.$row['mod_id'].',';
        }
      } 

    if ($acum =="") { $acum = 0; }
    $sql="SELECT * from module WHERE mod_id NOT IN(".$acum.") AND mod_status='1'";
    $result=mysqli_query($con,$sql);
    echo "<option value=''>--</option>";
    if ($result->num_rows > 0) {
      if($row1=mysqli_fetch_array($result,MYSQLI_ASSOC)){
        do{
        echo '<option value="'.$row1['mod_id'].'">'.$row1['mod_name'].'</option>';
        } while($row1=mysqli_fetch_array($result,MYSQLI_ASSOC));
      }
    }
 echo $acum;
}
?>
