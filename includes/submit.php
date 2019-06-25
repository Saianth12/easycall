<?php
include_once('config.php');
if (isset($_POST['SignIn'])){
 	$admin_name = mysqli_real_escape_string($conn, $_POST['admin_name']);
	$admin_code = mysqli_real_escape_string($conn, $_POST['password']);
	
	$sql = "SELECT * FROM profile_details WHERE employee_phone = '".$admin_name."' and employee_pwd = '".$admin_code."' and employee_type IN (1,3)";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);
    if($count == 1) {
        session_start();
        $_SESSION['login_user'] = $admin_name;
        echo '<script type="text/javascript">
		   window.location = "../registration.php";
      </script>';
    }
    else {
        echo '<script type="text/javascript">
           alert("Wrong Details");
		   window.location = "../index.php";
      </script>';
    }
}
if (isset($_POST['Registration'])){

    $c_name = mysqli_real_escape_string($conn, $_POST['c_name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$position = mysqli_real_escape_string($conn, $_POST['position']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$teamleader = mysqli_real_escape_string($conn, $_POST['teamleader']);
	
	if($position==2){
	    $employee_type ='Exec';
	}
	if($position==3){
	    $employee_type ='Team Leader';
	}
	$sql = "INSERT INTO profile_details(employee_name,employee_email,employee_phone,employee_position,employee_type,employee_pwd,teaml_id)VALUES('".$c_name."','".$email."','".$phone."','".$employee_type."','".$position."','".$password."','".$teamleader."')";
    $result = mysqli_query($conn,$sql);
    $last_id = mysqli_insert_id($conn);
    
    $sql1 = "INSERT INTO attendance_details(employee_id,attendance_status)VALUES('".$last_id."','1')";
    $result1 = mysqli_query($conn,$sql1);
    
    
    if($result) {
        echo '<script type="text/javascript">
        alert("Inserted Successfully");
		   window.location = "../registration.php";
      </script>';
    }
    else {
        echo '<script type="text/javascript">
           alert("Not inserted");
		   window.location = "../registration.php";
      </script>';
    }
}
if (isset($_POST['RegistrationEdit'])){
    $c_id = mysqli_real_escape_string($conn, $_POST['c_id']);
    $c_name = mysqli_real_escape_string($conn, $_POST['c_name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$position = mysqli_real_escape_string($conn, $_POST['position']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	
	$teaml_id = mysqli_real_escape_string($conn, $_POST['teamleader']);
	
	if($position==2){
	    $employee_type ='Exec';
	}
	if($position==3){
	    $employee_type ='Team Leader';
	}
	$sql = "UPDATE profile_details SET employee_name='".$c_name."',employee_email='".$email."',employee_phone='".$phone."',employee_position='".$employee_type."',employee_type='".$position."',employee_pwd='".$password."',teaml_id='".$teaml_id."' WHERE Id='".$c_id."'";
    $result = mysqli_query($conn,$sql);
    if($result) {
        echo '<script type="text/javascript">
        alert("Updated Successfully");
		   window.location = "../profile_list.php";
      </script>';
    }
    else {
        echo '<script type="text/javascript">
           alert("Not Updated");
		   window.location = "../profile_list.php";
      </script>';
    }
}
if (isset($_POST['LocationDetails'])){

    $employee_name = mysqli_real_escape_string($conn, $_POST['employee_name']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	
	
	$url = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyAVESA3O6ilWwM60YmumzwjbWDStUQbN6c&address=".urlencode($address);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $responseJson = curl_exec($ch);
    curl_close($ch);
      
    $response = json_decode($responseJson);
      
    if ($response->status == 'OK') {
        $latitude = $response->results[0]->geometry->location->lat;
        $longitude = $response->results[0]->geometry->location->lng;
    } else {
        echo $response->status;
    }
    
    date_default_timezone_set('Asia/Calcutta');
    $date_time = date("Y-m-d g:i:s:A");
	$sql = "INSERT INTO location_details(employee_id,employee_lat,employee_lang,employee_address,date_time)VALUES('".$employee_name."','".$latitude."','".$longitude."','".$address."','".$date_time."')";
    $result = mysqli_query($conn,$sql);
    if($result) {
        echo '<script type="text/javascript">
        alert("Inserted Successfully");
		   window.location = "../location_add.php";
      </script>';
    }
    else {
        echo '<script type="text/javascript">
           alert("Not inserted");
		   window.location = "../location_add.php";
      </script>';
    }
}
if (isset($_POST['LocationEdit'])){
    $c_id = mysqli_real_escape_string($conn, $_POST['c_id']);
    $employee_name = mysqli_real_escape_string($conn, $_POST['employee_name']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	
	$url = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyAVESA3O6ilWwM60YmumzwjbWDStUQbN6c&address=".urlencode($address);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $responseJson = curl_exec($ch);
    curl_close($ch);
      
    $response = json_decode($responseJson);
      
    if ($response->status == 'OK') {
        $latitude = $response->results[0]->geometry->location->lat;
        $longitude = $response->results[0]->geometry->location->lng;
    } else {
        echo $response->status;
    }
    
    date_default_timezone_set('Asia/Calcutta');
    $date_time = date("Y-m-d g:i:s:A");
    
	$sql = "UPDATE location_details SET employee_id='".$employee_name."',employee_lat='".$latitude."',employee_lang='".$longitude."',employee_address='".$address."',date_time='".$date_time."' WHERE Id='".$c_id."'";
    $result = mysqli_query($conn,$sql);
    if($result) {
        echo '<script type="text/javascript">
        alert("Updated Successfully");
		   window.location = "../location_list.php";
      </script>';
    }
    else {
        echo '<script type="text/javascript">
           alert("Not Updated");
		   window.location = "../location_list.php";
      </script>';
    }
}
if (isset($_POST['ExecutiveDetails'])){

    $team_leader = mysqli_real_escape_string($conn, $_POST['team_leader']);
    $employee_name = mysqli_real_escape_string($conn, $_POST['employee_name']);
    $dispocode = mysqli_real_escape_string($conn, $_POST['dispocode']);
    $executive_summary = mysqli_real_escape_string($conn, $_POST['executive_summary']);
    $executive_other = mysqli_real_escape_string($conn, $_POST['executive_other']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $paymenttype = mysqli_real_escape_string($conn, $_POST['paymenttype']);
	$end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $bank_det = mysqli_real_escape_string($conn, $_POST['bank_det']);
	
	$url = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyAVESA3O6ilWwM60YmumzwjbWDStUQbN6c&address=".urlencode($address);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $responseJson = curl_exec($ch);
    curl_close($ch);
      
    $response = json_decode($responseJson);
      
    if ($response->status == 'OK') {
        $latitude = $response->results[0]->geometry->location->lat;
        $longitude = $response->results[0]->geometry->location->lng;
    } else {
        echo $response->status;
    }
    
    date_default_timezone_set('Asia/Calcutta');
    //$date_time = date("Y-m-d g:i:s:A");
    $date_time = date("d-m-Y H:i:s");
    
	$sql = "INSERT INTO executive_details(team_leader_id,employee_id,dispo_code,executive_summary,executive_other,executive_location_lat,executive_location_long,executive_address,executive_time,executive_transtype)VALUES('".$team_leader."','".$employee_name."','".$dispocode."','".$executive_summary."','".$executive_other."','".$latitude."','".$longitude."','".$address."','".$date_time."','".$paymenttype."')";
    $result = mysqli_query($conn,$sql);
    $last_id = mysqli_insert_id($conn);
    
    
    $summary = mysqli_real_escape_string($conn, $_POST['summary']);
	$amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $trans_id = mysqli_real_escape_string($conn, $_POST['trans_id']);
    $bank = mysqli_real_escape_string($conn, $_POST['bank']);
    $cheque_num = mysqli_real_escape_string($conn, $_POST['cheque_num']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    
    $sql4 = "INSERT INTO cash_details(exect_det_id,summary,amount,trans_id,bank,cheque_number,date)VALUES('".$last_id."','".$summary."','".$amount."','".$trans_id."','".$bank."','".$cheque_num."','".$date."')";
    $result4 = mysqli_query($conn,$sql4);
    if($result) {
        echo '<script type="text/javascript">
        alert("Inserted Successfully");
		   window.location = "../exec_details_add.php";
      </script>';
    }
    else {
        echo '<script type="text/javascript">
           alert("Not inserted");
		   window.location = "../exec_details_add.php";
      </script>';
    }
}
if (isset($_POST['EditExecutiveDetails'])){
    $exec_id = mysqli_real_escape_string($conn, $_POST['exec_id']);
    $team_leader = mysqli_real_escape_string($conn, $_POST['team_leader']);
    $employee_name = mysqli_real_escape_string($conn, $_POST['employee_name']);
    $dispocode = mysqli_real_escape_string($conn, $_POST['dispocode']);
    $executive_summary = mysqli_real_escape_string($conn, $_POST['executive_summary']);
    $executive_other = mysqli_real_escape_string($conn, $_POST['executive_other']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
	
	
	$url = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyAVESA3O6ilWwM60YmumzwjbWDStUQbN6c&address=".urlencode($address);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $responseJson = curl_exec($ch);
    curl_close($ch);
      
    $response = json_decode($responseJson);
      
    if ($response->status == 'OK') {
        $latitude = $response->results[0]->geometry->location->lat;
        $longitude = $response->results[0]->geometry->location->lng;
    } else {
        echo $response->status;
    }
    
    date_default_timezone_set('Asia/Calcutta');
    $date_time = date("d-m-Y H:i:s");
	$sql = "UPDATE executive_details SET team_leader_id='".$team_leader."',employee_id='".$employee_name."',dispo_code='".$dispocode."',executive_summary='".$executive_summary."',executive_other='".$executive_other."',executive_location_lat='".$latitude."',executive_location_long='".$longitude."',executive_address='".$address."',executive_time='".$date_time."' WHERE Id='".$exec_id."'";
    $result = mysqli_query($conn,$sql);
    
    $summary = mysqli_real_escape_string($conn, $_POST['summary']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $trans_id = mysqli_real_escape_string($conn, $_POST['trans_id']);
    $bank = mysqli_real_escape_string($conn, $_POST['bank']);
    $cheque_num = mysqli_real_escape_string($conn, $_POST['cheque_num']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    
    $sql2 = "UPDATE cash_details SET summary='".$summary."',amount='".$amount."',trans_id='".$trans_id."',bank='".$bank."',cheque_number='".$cheque_num."',date='".$date."' WHERE exect_det_id='".$exec_id."'";
    $result2 = mysqli_query($conn,$sql2);
    
    if($result) {
        echo '<script type="text/javascript">
        alert("Inserted Successfully");
		   window.location = "../exec_details_list.php";
      </script>';
    }
    else {
        echo '<script type="text/javascript">
           alert("Not inserted");
		   window.location = "../exec_details_list.php";
      </script>';
    }
}
if (isset($_POST["import"])) {
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            
            $sql = "select Id from profile_details where employee_name='".$column[4]."'";
            $result1 = mysqli_query($conn, $sql);
            while($final_data1= mysqli_fetch_array($result1)){
            $name = $final_data1['Id'];
            if($column[0]=='MO'){
                $emptype = 'Mobile';
            }
            if($column[0]=='FL'){
                $emptype = 'Landline';
            }
            $sqlInsert = "INSERT into team_leader (employee_id,customer_name,customer_phone,customer_accno,customer_address,end_location_lat,end_location_long,end_date,emp_type,status,billzip_zip, To_be_paid, BTC, Today_OS)
                   values ('" . $name . "','','','" . $column[2] . "','" . $column[3] . "','','','" . $column[1] . "','" . $emptype . "','". $column[9]. "','". $column[7] ."','". $column[6] ."','". $column[8] ."','". $column[10] ."')";
            $result = mysqli_query($conn, $sqlInsert);
            
            if (! empty($result)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
        }
    }
    if($result) {
        echo '<script type="text/javascript">
        alert("Inserted Successfully");
		   window.location = "../my_base_upload.php";
      </script>';
    }
    else {
        echo '<script type="text/javascript">
           alert("Not inserted");
		   window.location = "../my_base_upload.php";
      </script>';
    }
}
?>