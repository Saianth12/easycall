<?php
session_start();
if(!isset($_SESSION['login_user'])){
      header("location:index.php");
   }
include_once('includes/config.php');
$query = $_REQUEST['q'];
$sql = "SELECT * FROM profile_details where employee_type='2' and teaml_id='".$query."'";
$aqs = mysqli_query($conn,$sql);
?>
<select name="employee_name"  required="" id="employee_name">
					    <option value="">--Employee--</option>
    <?php
    while($row= mysqli_fetch_array($aqs)){
    ?>
    <option value="<?php echo $row['Id']; ?>"><?php echo $row['employee_name']; ?></option>
    <?php } ?>
</select>