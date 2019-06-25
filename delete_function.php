<?php
include_once('includes/config.php');
if (isset($_REQUEST['delete_profile'])){
    $Id = $_REQUEST['Id'];
	
	$sql = "DELETE FROM profile_details WHERE Id='".$Id."'";
    $result = mysqli_query($conn,$sql);
    $sql1 = "DELETE FROM attendance_details WHERE employee_id='".$Id."'";
    $result1 = mysqli_query($conn,$sql1);
    if($result) {
        echo '<script type="text/javascript">
        alert("Deleted Successfully");
		   window.location = "profile_list.php";
      </script>';
    }
    else {
        echo '<script type="text/javascript">
           alert("Not deleted");
		   window.location = "profile_list.php";
      </script>';
    }
}
if (isset($_REQUEST['atten_status'])){
    $Id = $_REQUEST['Id'];
	$atten_status = $_REQUEST['atten_status'];
	if($atten_status=='search'){
	    $attendance_status = 2;
	}
	if($atten_status=='search1'){
	   $attendance_status = 1; 
	}
	
	$sql = "UPDATE attendance_details SET attendance_status='".$attendance_status."' WHERE Id='".$Id."'";
    $result = mysqli_query($conn,$sql);
    if($result) {
        echo '<script type="text/javascript">
        alert("Updated Successfully");
		   window.location = "attendance_status.php";
      </script>';
    }
    else {
        echo '<script type="text/javascript">
           alert("Not Updated");
		   window.location = "attendance_status.php";
      </script>';
    }
}
if (isset($_REQUEST['client_job_deletion'])){
    $str = $_REQUEST['Id'];
	$ret = (explode(",",$str));
	
	$sql = "DELETE FROM current_location WHERE Id='".$ret[0]."'";
    $result = mysqli_query($conn,$sql);
    //$sql1 = "DELETE FROM team_leader WHERE Id='".$ret[1]."'";
    //$result1 = mysqli_query($conn,$sql1);
    if($result) {
        echo '<script type="text/javascript">
        alert("Deleted Successfully");
		   window.location = "client_job.php";
      </script>';
    }
    else {
        echo '<script type="text/javascript">
           alert("Not Deleted");
		   window.location = "client_job.php";
      </script>';
    }
}
if (isset($_REQUEST['delete_executive_details'])){
    $str = $_REQUEST['Id'];
	
	$sql = "DELETE FROM executive_details WHERE Id='".$str."'";
    $result = mysqli_query($conn,$sql);

    if($result) {
        echo '<script type="text/javascript">
        alert("Deleted Successfully");
		   window.location = "exec_details_list.php";
      </script>';
    }
    else {
        echo '<script type="text/javascript">
           alert("Not Deleted");
		   window.location = "exec_details_list.php";
      </script>';
    }
}

if (isset($_REQUEST['delete_base'])){
    $str = $_REQUEST['Id'];
	
	$sql = "DELETE FROM mybase WHERE Id='".$str."'";
    $result = mysqli_query($conn,$sql);

    if($result) {
        echo '<script type="text/javascript">
        alert("Deleted Successfully");
		   window.location = "my_base_list.php";
      </script>';
    }
    else {
        echo '<script type="text/javascript">
           alert("Not Deleted");
		   window.location = "my_base_list.php";
      </script>';
    }
}
?>