<?php
session_start();
if(!isset($_SESSION['login_user'])){
      header("location:index.php");
   }
include_once('includes/config.php');
$query = $_REQUEST['q'];
$sql = "SELECT * FROM profile_details where employee_type='3'";
$aqs = mysqli_query($conn,$sql);
if($query==2){
?>
<select name="teamleader">
    <option value="">--Select Position--</option>
    <?php
    while($row= mysqli_fetch_array($aqs)){
    ?>
    <option value="<?php echo $row['Id']; ?>"><?php echo $row['employee_name']; ?></option>
    <?php } ?>
</select>
<?php } ?>