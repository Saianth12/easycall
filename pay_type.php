<?php
session_start();
if(!isset($_SESSION['login_user'])){
      header("location:index.php");
   }
include_once('includes/config.php');
$query = $_REQUEST['q'];
$sql = "SELECT * FROM profile_details where employee_type='3'";
$aqs = mysqli_query($conn,$sql);
if($query=='Cash'){
?>
<input type="text" name="summary" placeholder="Summary">
<input type="text" name="amount" placeholder="Amount">
<input type="text" name="trans_id" placeholder="Transaction Id">
<?php } 
if($query=='Cheque'){
?>
<input type="text" name="summary" placeholder="Summary">
<input type="text" name="bank" placeholder="Bank">
<input type="text" name="amount" placeholder="Amount">
<input type="text" name="cheque_num" placeholder="Cheque Number">
<input type="text" name="date" placeholder="Date">
<?php
}
if($query=='Online Transaction'){
?>
<input type="text" name="summary" placeholder="Summary">
<input type="text" name="amount" placeholder="Amount">
<input type="text" name="trans_id" placeholder="Transaction Id">
<?php
}
?>