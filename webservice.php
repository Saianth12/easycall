<?php
include_once('config.php');
$case = isset($_GET['Case']) ? $_GET['Case'] : $_POST['Case'];
if ($case == null) {
    $case = "Invalidurl";
}
switch ($case) {
    case 'CommonLogin':
        $pval['user_name'] = isset($_GET['user_name']) ? $_GET['user_name'] : $_POST['user_name'];
        $pval['user_password'] = isset($_GET['user_password']) ? $_GET['user_password'] : $_POST['user_password'];
        
        $pval['device_name'] = isset($_GET['device_name']) ? $_GET['device_name'] : $_POST['device_name'];

      
      // $sql = "SELECT * FROM profile_details WHERE employee_phone = '".$pval['user_name']."' and employee_pwd = '".$pval['user_password']."'";

    $sql = "SELECT * FROM profile_details WHERE employee_phone = '".$pval['user_name']."' and employee_pwd = '".$pval['user_password']."' and status=0";
      $result = mysqli_query($conn,$sql);
       
      
      $count = mysqli_num_rows($result);

      
       $array1 = [];    
    	while($final_data= mysqli_fetch_array($result)){
    	    $user = $final_data['Id'];
            array_push($array1, [
            'Id'   => $final_data['Id'],
            'employee_name' => $final_data['employee_name'],
            'employee_email' => $final_data['employee_email'],
            'employee_phone' => $final_data['employee_phone'],
            'employee_position' => $final_data['employee_position'],
            'employee_type' => $final_data['employee_type'],
            'employee_token' => $final_data['employee_token'],
            'status' => $final_data['status']
            ]);
        }

  	 
       if ($count == 1) {
           date_default_timezone_set('Asia/Calcutta');
           $today = date("d-m-Y H:i:s");
           $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
           $randstring = '';
           for ($i = 0; $i < 5; $i++) {
               $randstring = $characters[rand(0, strlen($characters))];
           }
           $six_digit_random_number = mt_rand(100000, 999999);
           $num_str = sprintf("%9d", mt_rand(1, 999999));
           $sql2 = "INSERT INTO login_details(device_name,login_date,user_id,device_token)VALUES('".$pval['device_name']."','".$today."','".$user."','".$num_str."')";
           $result2 = mysqli_query($conn,$sql2);
          
           $sql3 = "UPDATE profile_details set status=1 WHERE Id='".$user."'";
           $result3 = mysqli_query($conn,$sql3);
         
          $string = "response_message.Login success,response_code.1";
				 	$a = explode(',', $string);
				 	foreach ($a as $result) {
				 		$b = explode('.', $result);
				 		$array[$b[0]] = $b[1];
				 	}
				 	$response = $array;
				 	$final_data = array("LoginDetails"=>$array1, "Response" => $response);
         
       }
      
       else {
				 $string = "response_message.Invalid Credential OR already Login,response_code.0";
				 $a = explode(',', $string);
				 foreach ($a as $result) {
				 	$b = explode('.', $result);
				 	$array[$b[0]] = $b[1];
				 }
				 $response = $array;
				 $final_data = array("Response" => $response);
 			}
				
			echo json_encode($final_data);
        exit;
    	break;
    	
    	
    case 'Registration':
    	    
    	$pval['employee_name'] = isset($_GET['employee_name']) ? $_GET['employee_name'] : $_POST['employee_name'];
    	$pval['employee_email'] = isset($_GET['employee_email']) ? $_GET['employee_email'] : $_POST['employee_email'];
    	$pval['employee_phone'] = isset($_GET['employee_phone']) ? $_GET['employee_phone'] : $_POST['employee_phone'];
    	$pval['employee_position'] = isset($_GET['employee_position']) ? $_GET['employee_position'] : $_POST['employee_position'];
    	$pval['employee_type'] = isset($_GET['employee_type']) ? $_GET['employee_type'] : $_POST['employee_type'];
    	$pval['employee_pwd'] = isset($_GET['employee_pwd']) ? $_GET['employee_pwd'] : $_POST['employee_pwd'];
    	$pval['teaml_id'] = isset($_GET['teaml_id']) ? $_GET['teaml_id'] : $_POST['teaml_id'];
    	
    	$sql1 = "SELECT * FROM profile_details WHERE employee_phone='".$pval['employee_phone']."'";
        $result1 = mysqli_query($conn,$sql1);
        $count1 = mysqli_num_rows($result1);
        
    	if($count1==0){
    	    
        $sql2 = "INSERT INTO profile_details(employee_name,employee_email,employee_phone,employee_position,employee_type,employee_pwd,teaml_id) VALUES ('".$pval['employee_name']."','".$pval['employee_email']."','".$pval['employee_phone']."','".$pval['employee_position']."','".$pval['employee_type']."','".$pval['employee_pwd']."','".$pval['teaml_id']."')";
        $result2 = mysqli_query($conn,$sql2);
        }
        
        if($result2)
			{
				$string = "response_message.Profile Inserted,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Mobile already have,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("ProfileInsertion"=>'Profile inserted', "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;	
    	
    	
    	case 'EmployeeList':
    	    
        $sql = "SELECT * FROM profile_details where employee_type='2'";
        $result = mysqli_query($conn,$sql);    
    	$array = [];    
    	while($final_data= mysqli_fetch_array($result)){
            array_push($array, [
            'Id'   => $final_data['Id'],
            'employee_name' => $final_data['employee_name'],
            'employee_email' => $final_data['employee_email'],
            'employee_phone' => $final_data['employee_phone'],
            'employee_position' => $final_data['employee_position'],
            'employee_type' => $final_data['employee_type'],
            'employee_pwd' => $final_data['employee_pwd']
            ]);
        }
        
        if($result)
			{
				$string = "response_message.Employee List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Employee not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("Employees"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;

    case 'AttendanceDetails':

        $pval['employee_id'] = isset($_GET['employee_id']) ? $_GET['employee_id'] : $_POST['employee_id'];
        $today = date("Y-m-d");
        $sql = "SELECT * FROM attendance_details where employee_id=".$pval['employee_id']." and date_time='".$today."'";
        $result = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($result);

        if($count == 1) {
            $checkatt = "SELECT * FROM attendance_details where attendance_status= 1 and employee_id =". $pval['employee_id']." and date_time='".$today."'";
            $statuscheck = mysqli_query($conn,$checkatt);
            $data = mysqli_num_rows($statuscheck);
            if ($data == 1) {
                $att = "UPDATE attendance_details set attendance_status = 0 where employee_id =" . $pval['employee_id']." and date_time='".$today."'";
                $result3 = mysqli_query($conn, $att);
                if ($result3) {
                    $string = "response_message.checkin,response_code.1";
                    $a = explode(',', $string);
                    foreach ($a as $result) {
                        $b = explode('.', $result);
                        $array4[$b[0]] = $b[1];
                    }
                    $response = $array4;
                } else {
                    $string = "response_message.failed1,response_code.-1";
                    $a = explode(',', $string);
                    foreach ($a as $result) {
                        $b = explode('.', $result);
                        $array4[$b[0]] = $b[1];
                    }
                    $response = $array4;
                }
            }
            if ($data == 0) {
                $att1 = "UPDATE attendance_details set attendance_status = 1 where employee_id =" . $pval['employee_id']." and date_time='".$today."'";
                $result4 = mysqli_query($conn, $att1);
                if ($result4) {
                    $string = "response_message.checkout,response_code.0";
                    $a = explode(',', $string);
                    foreach ($a as $result) {
                        $b = explode('.', $result);
                        $array4[$b[0]] = $b[1];
                    }
                    $response = $array4;
                } else {
                    $string = "response_message.failed,response_code.-1";
                    $a = explode(',', $string);
                    foreach ($a as $result) {
                        $b = explode('.', $result);
                        $array4[$b[0]] = $b[1];
                    }
                    $response = $array4;
                }
            }
            $responseS = $response;

        }else {
            $att = "INSERT INTO attendance_details(employee_id, attendance_status, date_time) values (".$pval['employee_id'].", 1 ,'".$today."')";
            $result2 = mysqli_query($conn,$att);
            if ($result2){
                $string = "response_message.ok,response_code.1";
                $a = explode(',', $string);
                foreach ($a as $result) {
                    $b = explode('.', $result);
                    $array4[$b[0]] = $b[1];
                }
                $response = $array4;
            }
            else {
                $string = "response_message.failed,response_code.0";
                $a = explode(',', $string);
                foreach ($a as $result) {
                    $b = explode('.', $result);
                    $array4[$b[0]] = $b[1];
                }
                $response = $array4;

            }
            $responseS = $response;
        }
        $final_data = array("Response" => $response);
        echo json_encode($final_data);
        exit;
        break;
    	
    	case 'LocationSave':
    	    
    	$pval['employee_id'] = isset($_GET['employee_id']) ? $_GET['employee_id'] : $_POST['employee_id'];
    	$pval['employee_lat'] = isset($_GET['employee_lat']) ? $_GET['employee_lat'] : $_POST['employee_lat'];
    	$pval['employee_lang'] = isset($_GET['employee_lang']) ? $_GET['employee_lang'] : $_POST['employee_lang'];
    	$pval['employee_address'] = isset($_GET['employee_address']) ? $_GET['employee_address'] : $_POST['employee_address'];
    	
        $sql2 = "INSERT INTO location_details(employee_id,employee_lat,employee_lang,employee_address) VALUES ('".$pval['employee_id']."','".$pval['employee_lat']."','".$pval['employee_lang']."','".$pval['employee_address']."')";
        $result2 = mysqli_query($conn,$sql2);

        
        if($result2)
			{
				$string = "response_message.Location Inserted,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Location not Inserted,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("LocationInsertion"=>'Location inserted', "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	case 'LocationList':
    	
    	$pval['employee_id'] = isset($_GET['employee_id']) ? $_GET['employee_id'] : $_POST['employee_id'];
    	
        $sql = "SELECT * FROM location_details WHERE employee_id='".$pval['employee_id']."'";
        $result = mysqli_query($conn,$sql);    
    	$array = [];    
    	while($final_data= mysqli_fetch_array($result)){
            array_push($array, [
            'Id'   => $final_data['Id'],
            'employee_id' => $final_data['employee_id'],
            'employee_lat' => $final_data['employee_lat'],
            'employee_lang' => $final_data['employee_lang'],
            'employee_address' => $final_data['employee_address']
            ]);
        }
        
        if($result)
			{
				$string = "response_message.Location List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Location not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("LocationList"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	

    	case 'ExecutiveLocationSave':
    	    
    	$pval['employee_id'] = isset($_GET['employee_id']) ? $_GET['employee_id'] : $_POST['employee_id'];
    	$pval['customer_name'] = isset($_GET['customer_name']) ? $_GET['customer_name'] : $_POST['customer_name'];
    	//$pval['customer_phone'] = isset($_GET['customer_phone']) ? $_GET['customer_phone'] : $_POST['customer_phone'];
    	$pval['customer_accno'] = isset($_GET['customer_accno']) ? $_GET['customer_accno'] : $_POST['customer_accno'];
    	$pval['customer_address'] = isset($_GET['customer_address']) ? $_GET['customer_address'] : $_POST['customer_address'];
    	
    	$pval['end_date'] = isset($_GET['end_date']) ? $_GET['end_date'] : $_POST['end_date'];
    	$pval['emp_type'] = isset($_GET['emp_type']) ? $_GET['emp_type'] : $_POST['emp_type'];
    	
        $sql2 = "INSERT INTO team_leader(employee_id,customer_name,customer_accno,customer_address,end_date,emp_type,status) VALUES ('".$pval['employee_id']."','".$pval['customer_name']."','".$pval['customer_accno']."','".$pval['customer_address']."','".$pval['end_date']."','".$pval['emp_type']."','1')";
        $result2 = mysqli_query($conn,$sql2);
        $last_id = mysqli_insert_id($conn);
        
        if($result2)
			{
			    
			    
				$string = "response_message.ExecutiveLocation Inserted,response_code.".$last_id;
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
 
				$response = $array4;
				
			 
			}
		else
			{
				$string = "response_message.ExecutiveLocation not Inserted,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("ExecutiveLocationInsertion"=>'ExecutiveLocation inserted', "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	

    	case 'ExecutiveLocationList':
    	
    	$pval['employee_id'] = isset($_GET['employee_id']) ? $_GET['employee_id'] : $_POST['employee_id'];
    	
        $sql = "SELECT * FROM team_leader WHERE employee_id='".$pval['employee_id']."'";
        $result = mysqli_query($conn,$sql);    
    	$array = [];    
    	while($final_data= mysqli_fetch_array($result)){
            array_push($array, [
            'Id'   => $final_data['Id'],
            'employee_id' => $final_data['employee_id'],
            'customer_name' => $final_data['customer_name'],
            'customer_phone' => $final_data['customer_phone'],
            'customer_accno' => $final_data['customer_accno'],
            'customer_address' => $final_data['customer_address'],
            'status' => $final_data['status']
            ]);
        }
        
        if($result)
			{
				$string = "response_message.ExecutiveLocation List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.ExecutiveLocation not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("ExecutiveLocationList"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	case 'DispoCodeList':
    	
        $sql = "SELECT * FROM dispo_code";
        $result = mysqli_query($conn,$sql);    
    	$array = [];    
    	while($final_data= mysqli_fetch_array($result)){
            array_push($array, [
            'Id'   => $final_data['Id'],
            'dis_code' => $final_data['dis_code'],
            'dis_desc' => $final_data['dis_desc']
            ]);
        }
        
        if($result)
			{
				$string = "response_message.DispoCode List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.DispoCode not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("DispoCodeList"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	case 'CurrentLocationSave':
    	    
    	$pval['employee_id'] = isset($_GET['employee_id']) ? $_GET['employee_id'] : $_POST['employee_id'];
    	$pval['teamleader_id'] = isset($_GET['teamleader_id']) ? $_GET['teamleader_id'] : $_POST['teamleader_id'];
    	$pval['current_lat'] = isset($_GET['current_lat']) ? $_GET['current_lat'] : $_POST['current_lat'];
    	$pval['current_lang'] = isset($_GET['current_lang']) ? $_GET['current_lang'] : $_POST['current_lang'];
    	$pval['current_address'] = isset($_GET['current_address']) ? $_GET['current_address'] : $_POST['current_address'];
    	
    	$pval['client_id'] = isset($_GET['client_id']) ? $_GET['client_id'] : $_POST['client_id'];
    	date_default_timezone_set('Asia/Calcutta'); 
        $today = date("d-m-Y H:i:s");
        
        $sql2 = "INSERT INTO current_location(employee_id,teamleader_id,current_lat,current_lang,current_address,client_id,date) VALUES ('".$pval['employee_id']."','".$pval['teamleader_id']."','".$pval['current_lat']."','".$pval['current_lang']."','".$pval['current_address']."','".$pval['client_id']."','".$today."')";
        $result2 = mysqli_query($conn,$sql2);

        
        if($result2)
			{
				$string = "response_message.CurrentLocation Inserted,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.CurrentLocation not Inserted,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("CurrentLocationInsertion"=>'CurrentLocation inserted', "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	case 'ExecutiveDetailsSave':
    	
    	$pval['status_id'] = isset($_GET['status_id']) ? $_GET['status_id'] : $_POST['status_id'];    
    	//$pval['team_leader_id'] = isset($_GET['team_leader_id']) ? $_GET['team_leader_id'] : $_POST['team_leader_id'];
    	$pval['employee_id'] = isset($_GET['employee_id']) ? $_GET['employee_id'] : $_POST['employee_id'];
    	$pval['dispo_code'] = isset($_GET['dispo_code']) ? $_GET['dispo_code'] : $_POST['dispo_code'];
    	$pval['executive_summary'] = isset($_GET['executive_summary']) ? $_GET['executive_summary'] : $_POST['executive_summary'];
    	$pval['executive_other'] = isset($_GET['executive_other']) ? $_GET['executive_other'] : $_POST['executive_other'];
    	$pval['executive_location_lat'] = isset($_GET['executive_location_lat']) ? $_GET['executive_location_lat'] : $_POST['executive_location_lat'];
    	$pval['executive_location_long'] = isset($_GET['executive_location_long']) ? $_GET['executive_location_long'] : $_POST['executive_location_long'];
//    	$pval['executive_address'] = isset($_GET['executive_address']) ? $_GET['executive_address'] : $_POST['executive_address'];
//    	$pval['executive_time'] = isset($_GET['executive_time']) ? $_GET['executive_time'] : $_POST['executive_time'];
    	$pval['executive_transtype'] = isset($_GET['executive_transtype']) ? $_GET['executive_transtype'] : $_POST['executive_transtype'];
    	$pval['followup'] = isset($_GET['followup']) ? $_GET['followup'] : $_POST['followup'];
    	
    	date_default_timezone_set('Asia/Calcutta'); 
        $today = date("d-m-Y H:i:s");
        
        $sql5 = "select * from profile_details where Id='".$pval['employee_id']."'";
        $result5 = mysqli_query($conn,$sql5);
        while($row5= mysqli_fetch_array($result5)){
        
         //$pval['team_leader_id'] =  $row5['teaml_id'];   
        }
        
        $sql6 = "select * from executive_details where team_leader_id='".$pval['status_id']."'";
        $result6 = mysqli_query($conn,$sql6);
        $count6 = mysqli_num_rows($result6);
        
    	if($count6 == 0){
            $sql2 = "INSERT INTO executive_details(team_leader_id,employee_id,dispo_code,executive_summary,executive_other,executive_location_lat,executive_location_long,executive_address,executive_time,executive_transtype,follow_up) VALUES ('".$pval['status_id']."','".$pval['employee_id']."','".$pval['dispo_code']."','".$pval['executive_summary']."','".$pval['executive_other']."','".$pval['executive_location_lat']."','".$pval['executive_location_long']."','".$pval['executive_address']."','".$today."','".$pval['executive_transtype']."','".$pval['followup']."')";

            $result2 = mysqli_query($conn,$sql2);
            $last_id = mysqli_insert_id($conn);
			$string = "response_message.ExecutiveDetails Inserted,response_code.1";
			$a = explode(',', $string);
			foreach ($a as $result2) {
				$b = explode('.', $result2);
				$array4[$b[0]] = $b[1];
			}
			$response = $array4;
    	}
    	else{
			$sql2 = "update executive_details set follow_up='".$pval['followup']."', dispo_code='".$pval['dispo_code']."',executive_summary='".$pval['executive_summary']."',executive_other='".$pval['executive_other']."',executive_location_lat='".$pval['executive_location_lat']."',executive_location_long='".$pval['executive_location_long']."', executive_time='".$today."',executive_transtype='".$pval['executive_transtype']."' where team_leader_id='".$pval['status_id']."'";
			$result2 = mysqli_query($conn,$sql2);
			$last_id = $pval['status_id'];
			$string = "response_message.ExecutiveDetails Updated,response_code.1";
			$a = explode(',', $string);
			foreach ($a as $result2) {
				$b = explode('.', $result2);
				$array4[$b[0]] = $b[1];
			}
			$response = $array4;
    	}
        if($pval['dispo_code']=='PAID'){
            $status = 3;
        }
        else{
            $status = 2;
        }

//            $pval['summary'] = isset($_GET['summary']) ? $_GET['summary'] : $_POST['summary'];
    	    $pval['amount'] = isset($_GET['amount']) ? $_GET['amount'] : $_POST['amount'];
    	    $pval['trans_id'] = isset($_GET['trans_id']) ? $_GET['trans_id'] : $_POST['trans_id'];
    	    $pval['bank'] = isset($_GET['bank']) ? $_GET['bank'] : $_POST['bank'];
    	    $pval['cheque_number'] = isset($_GET['cheque_number']) ? $_GET['cheque_number'] : $_POST['cheque_number'];
    	    $pval['date'] = isset($_GET['date']) ? $_GET['date'] : $_POST['date'];

        if ($pval['amount'] != ""){
            $amt = "select * from team_leader where  Id='".$pval['status_id']."'";
            $amtres = mysqli_query($conn, $amt);
            if (mysqli_num_rows($amtres) >= 1) {
                while ($final_data = mysqli_fetch_assoc($amtres)) {
                    $btc = $final_data['BTC'];
                    $tobecollect = $final_data['To_be_collected'];
                }
                if (intval($tobecollect) >= $pval['amount']){
                    $sql4 = "INSERT INTO cash_details(exect_det_id,summary,amount,trans_id,bank,cheque_number,date)VALUES('".$last_id."','".$pval['executive_summary']."','".$pval['amount']."','".$pval['trans_id']."','".$pval['bank']."','".$pval['cheque_number']."','".$pval['date']."')";
                    $result4 = mysqli_query($conn,$sql4);

                    if($result4)
                    {
                        $string = "response_message.ExecutiveDetails Inserted,response_code.1";
                        $a = explode(',', $string);
                        foreach ($a as $result2) {
                            $b = explode('.', $result2);
                            $array4[$b[0]] = $b[1];
                        }
                        $response = $array4;
                    }
                    else
                    {
                        $string = "response_message.ExecutiveDetails not Inserted,response_code.-1";
                        $a = explode(',', $string);
                        foreach ($a as $result2) {
                            $b = explode('.', $result2);
                            $array4[$b[0]] = $b[1];
                        }
                        $response = $array4;
                    }

                    $sql3 = "update team_leader set status='".$status."' where Id='".$pval['status_id']."'";
                    $result3 = mysqli_query($conn,$sql3);

                    if($result3)
                    {
                        $string = "response_message.ExecutiveDetails Updated,response_code.1";
                        $a = explode(',', $string);
                        foreach ($a as $result2) {
                            $b = explode('.', $result2);
                            $array4[$b[0]] = $b[1];
                        }
                        $response = $array4;
                    }
                    else
                    {
                        $string = "response_message.ExecutiveDetails not Updated,response_code.-1";
                        $a = explode(',', $string);
                        foreach ($a as $result2) {
                            $b = explode('.', $result2);
                            $array4[$b[0]] = $b[1];
                        }
                        $response = $array4;
                    }

                    $collect = 0;
                    $collected = "select * from cash_details where  exect_det_id='" . $pval['status_id'] . "'";
                    $collectedres = mysqli_query($conn, $collected);
                    $cou = mysqli_num_rows($collectedres);
                    if (mysqli_num_rows($collectedres) >= 1) {
                        while ($final_data = mysqli_fetch_assoc($collectedres)) {
                            $collect = $final_data['amount'] + $collect;
                        }

                        $sql2 = "update team_leader set To_be_collected='" . ($btc - $collect) . "' where Id='" . $pval['status_id'] . "'";
                        $result2 = mysqli_query($conn, $sql2);
                    }
                } else {
                    $string = "response_message.Payment already collected,response_code.-1";
                    $a = explode(',', $string);
                    foreach ($a as $result2) {
                        $b = explode('.', $result2);
                        $array4[$b[0]] = $b[1];
                    }
                    $response = $array4;
                }
            }
        }

        $final_data = array("ExecutiveDetailsInsertion"=>'CurrentLocation inserted', "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	case 'WholedayTracking':
    	
    	$pval['employee_id'] = isset($_GET['employee_id']) ? $_GET['employee_id'] : $_POST['employee_id'];    
    	$pval['emp_lat'] = isset($_GET['emp_lat']) ? $_GET['emp_lat'] : $_POST['emp_lat'];
    	$pval['emp_lang'] = isset($_GET['emp_lang']) ? $_GET['emp_lang'] : $_POST['emp_lang'];
    	
    	date_default_timezone_set('Asia/Calcutta'); 
        $today = date("d-m-Y H:i:s");
    	
        $sql2 = "INSERT INTO wholeday_tracking(employee_id,emp_lat,emp_lang,cur_date) VALUES ('".$pval['employee_id']."','".$pval['emp_lat']."','".$pval['emp_lang']."','".$today."')";
        $result2 = mysqli_query($conn,$sql2);
        
        if($result2)
			{
				$string = "response_message.WholedayTracking Inserted,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.WholedayTracking not Inserted,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("WholedayTrackingInsertion"=>'CurrentLocation inserted', "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	case 'CurrentLocationListById':
    	
    	$pval['teaml_id'] = isset($_GET['teaml_id']) ? $_GET['teaml_id'] : $_POST['teaml_id'];
    	
        $sql = "SELECT * FROM profile_details WHERE teaml_id='".$pval['teaml_id']."'";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      $array= [];
      for ($i = 1; $i <= $count; $i++) 
      {
        while($final_data= mysqli_fetch_array($result)){
            $array1 = [];
              $Id = $final_data['Id'];
              $sql1 = "SELECT * FROM current_location WHERE employee_id='".$Id."' ORDER BY Id DESC LIMIT 0, 1";
              $result1 = mysqli_query($conn,$sql1);
              
              while($final_data1= mysqli_fetch_array($result1)){
                  array_push($array1, [
                   'Id' => $final_data1['Id'],
                   'employee_id' => $final_data1['employee_id'],
                   'current_lat' => $final_data1['current_lat'],
                   'current_lang' => $final_data1['current_lang'],
                   'client_id' => $final_data1['client_id'],
                   'date' => $final_data1['date'],
            ]);
              }
              
              array_push($array, [
                   'Id'   => $final_data['Id'],
                   'current_location' => $array1
            ]);
          }
      }
        if($result)
			{
				$string = "response_message.Grade List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Grade not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("Grade"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	case 'CustomerExecutiveList':
    	    
       $pval['teaml_id'] = isset($_GET['teaml_id']) ? $_GET['teaml_id'] : $_POST['teaml_id'];
       $pval['exc_date'] = isset($_GET['exc_date']) ? $_GET['exc_date'] : $_POST['exc_date'];
      $sql = "SELECT * FROM profile_details WHERE teaml_id='".$pval['teaml_id']."'";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      $array= [];
      for ($i = 1; $i <= $count; $i++) 
      {
        while($final_data= mysqli_fetch_array($result)){
            $array1 = [];
              $Id = $final_data['Id'];
              if(!empty($pval['exc_date'])){
              $sql1 = "SELECT * FROM team_leader WHERE employee_id='".$Id."' and end_date='".$pval['exc_date']."'";
              }
              if(empty($pval['exc_date'])){
              $sql1 = "SELECT * FROM team_leader WHERE employee_id='".$Id."'";
              }
              $result1 = mysqli_query($conn,$sql1);
              $count1 = mysqli_num_rows($result1);
      $array1= [];
      for ($j = 1; $j <= $count1; $j++) 
      {
              while($final_data1= mysqli_fetch_array($result1)){
                  
                  
                  $array2 = [];
              $customer_name = $final_data1['customer_name'];
              $customer_phone = $final_data1['customer_phone'];
              $customer_accno = $final_data1['customer_accno'];
              $customer_address = $final_data1['customer_address'];
              $employee_id = $final_data1['employee_id'];
              $team_leader_id = $final_data1['Id'];
              $sql2 = "SELECT * FROM executive_details WHERE employee_id='".$employee_id."' and team_leader_id='".$team_leader_id."'";
              $result2 = mysqli_query($conn,$sql2);
                  
                   while($final_data2= mysqli_fetch_array($result2)){
                  array_push($array2, [
                   'employee_id' => $final_data2['employee_id'],
                   'dispo_code' => $final_data2['dispo_code'],
                   'executive_summary' => $final_data2['executive_summary'],
                   'executive_other' => $final_data2['executive_other'],
                   'executive_location_lat' => $final_data2['executive_location_lat'],
                   'executive_location_long' => $final_data2['executive_location_long'],
                   'executive_time' => $final_data2['executive_time'],
                   'executive_transtype' => $final_data2['executive_transtype'],
            ]);
              }
                  
                  
                  
                  array_push($array1, [
                   'Id' => $final_data1['Id'],
                   'customer_name' => $final_data1['customer_name'],
                   'employee_name' => $final_data['employee_name'],
                   'customer_phone' => $final_data1['customer_phone'],
                   'customer_accno' => $final_data1['customer_accno'],
                   'customer_address' => $final_data1['customer_address'],
                   'details_list' => $array2
            ]);
              }
              
              array_push($array, [
                   'Id'   => $final_data['Id'],
                   'list' => $array1
            ]);
        }
          }
      }
        if($result1)
			{
				$string = "response_message.details List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result1) {
					$b = explode('.', $result1);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.details not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result1) {
					$b = explode('.', $result1);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("List"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	case 'CustomerExecutiveList1':
    	
    	$pval['teaml_id'] = isset($_GET['teaml_id']) ? $_GET['teaml_id'] : $_POST['teaml_id'];
    	$pval['exc_date'] = isset($_GET['exc_date']) ? $_GET['exc_date'] : $_POST['exc_date'];
        $sql = "SELECT * FROM profile_details WHERE teaml_id='".$pval['teaml_id']."'";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      $array= [];
      for ($i = 1; $i <= $count; $i++) 
      {
        while($final_data= mysqli_fetch_array($result)){
            $array1 = [];
              $Id = $final_data['Id'];
              if(!empty($pval['exc_date'])){
              $sql1 = "SELECT * FROM team_leader,executive_details WHERE team_leader.Id=executive_details.team_leader_id and executive_details.executive_time LIKE '%".$pval['exc_date']."%' and executive_details.employee_id='".$Id."'";
              }
              if(empty($pval['exc_date'])){
              $sql1 = "SELECT * FROM team_leader,executive_details WHERE team_leader.Id=executive_details.team_leader_id and executive_details.employee_id='".$Id."'";
              }
              $result1 = mysqli_query($conn,$sql1);
              $count1 = mysqli_num_rows($result1);
              $var = 0;
              while($final_data1= mysqli_fetch_array($result1)){
                  array_push($array, [
                   'Id' => $final_data1['Id'],
                   'employee_name' => $final_data['employee_name'],
                   'customer_name' => $final_data1['customer_name'],
                   'customer_phone' => $final_data1['customer_phone'],
                   'customer_accno' => $final_data1['customer_accno'],
                   'dispo_code' => $final_data1['dispo_code'],
                   'executive_summary' => $final_data1['executive_summary'],
                   'executive_other' => $final_data1['executive_other'],
                   'executive_time' => $final_data1['executive_time'],
                   'executive_transtype' => $final_data1['executive_transtype'],
                   
            ]);
                //   print "dfds".$final_data1;
                //   if($final_data1!=''){
                   $var = 1;
                //   }
                //$var++;
              }
              if($var>0){
                  
              
              array_push($array1, [

                   'current_location' => $array1
            ]);
              }
          }
      }
        if($count1>0)
			{
				$string = "response_message.Grade List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result1) {
					$b = explode('.', $result1);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Grade not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result1) {
					$b = explode('.', $result1);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("List"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    case 'MyBaseList1':
    	
    	
    	$pval['teaml_id'] = isset($_GET['teaml_id']) ? $_GET['teaml_id'] : $_POST['teaml_id'];
    	//$pval['exc_date'] = isset($_GET['exc_date']) ? $_GET['exc_date'] : $_POST['exc_date'];
        $sql = "SELECT * FROM profile_details WHERE teaml_id='".$pval['teaml_id']."'";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      $array= [];
      for ($i = 1; $i <= $count; $i++) 
      {
        while($final_data= mysqli_fetch_array($result)){
            $array1 = [];
              $Id = $final_data['employee_name'];
              
             
              $sql1 = "SELECT * FROM mybase where FE_NAME='".$Id."'";
              
              $result1 = mysqli_query($conn,$sql1);
              $count1 = mysqli_num_rows($result1);
              $var = 0;
              while($final_data1= mysqli_fetch_array($result1)){
                  array_push($array, [
                   'Base' => $final_data1['Base'],
            'End_Date' => $final_data1['End_Date'],
            'Account_No' => $final_data1['Account_No'],
            'District' => $final_data1['District'],
            'FE_NAME' => $final_data1['FE_NAME'],
            'City' => $final_data1['City'],
            'To_Be_Paid' => $final_data1['To_Be_Paid'],
            'BILL_ZIP' => $final_data1['BILL_ZIP'],
            'BTC' => $final_data1['BTC'],
            'Today_Status' => $final_data1['Today_Status'],
            'Today_OS' => $final_data1['Today_OS'],
                   
            ]);
                //   print "dfds".$final_data1;
                //   if($final_data1!=''){
                   $var = 1;
                //   }
                //$var++;
              }
              if($var>0){
                  
              
              array_push($array1, [

                   'current_location' => $array1
            ]);
              }
          }
      }
        if($count1>0)
			{
				$string = "response_message.Grade List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result1) {
					$b = explode('.', $result1);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Grade not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result1) {
					$b = explode('.', $result1);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("List"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;	
    	
    	
    	case 'CustomerExecutivePaidlist':
    	
    	$pval['teaml_id'] = isset($_GET['teaml_id']) ? $_GET['teaml_id'] : $_POST['teaml_id'];
    	//$pval['exc_date'] = isset($_GET['exc_date']) ? $_GET['exc_date'] : $_POST['exc_date'];
        $sql = "SELECT * FROM profile_details WHERE Id='".$pval['teaml_id']."'";
      $result = mysqli_query($conn,$sql);
      
      
//       while($final_data= mysqli_fetch_array($result)){
//           $id[] = $final_data['Id'];
//       }
     
//       for($x=0;$x<sizeof($id);$x++){
//           $sql3 = "SELECT * FROM team_leader,executive_details WHERE team_leader.Id=executive_details.team_leader_id and executive_details.employee_id='".$id[$x]."' and executive_details.dispo_code='PAID'";
//           $result3 = mysqli_query($conn,$sql3) or die(mysqli_error());
//           $count[] = mysqli_num_rows($result3);
          
//       }
//       $comt = array_sum($count);
//       $numrows = $comt;

// $rowsperpage = 10;
 

// $totalpages = ceil($numrows / $rowsperpage);
 

// if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
// $currentpage = (int) $_GET['currentpage'];
// } else {
// $currentpage = 1;  // default page number
// }
 

// if ($currentpage > $totalpages) {

// $currentpage = $totalpages;
// }

// if ($currentpage < 1) {

// $currentpage = 1;
// }
//$offset = ($currentpage - 1) * $rowsperpage;

$sql = "SELECT * FROM profile_details WHERE Id='".$pval['teaml_id']."'";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      $array= [];
      for ($i = 1; $i <= $count; $i++) 
      {
        while($final_data= mysqli_fetch_array($result)){
            $array1 = [];
              $Id = $final_data['Id'];
              
             
             $sql1 = "SELECT * FROM team_leader,executive_details WHERE team_leader.Id=executive_details.team_leader_id and executive_details.employee_id='".$Id."' and executive_details.dispo_code='PAID' order by executive_details.Id DESC";
              
              $result1 = mysqli_query($conn,$sql1);
              $count1 = mysqli_num_rows($result1);
              $var = 0;
              while($final_data1= mysqli_fetch_array($result1)){
                  array_push($array, [
                   'Id' => $final_data1['Id'],
                   'employee_name' => $final_data['employee_name'],
                   'customer_name' => $final_data1['customer_name'],
                   'customer_phone' => $final_data1['customer_phone'],
                   'customer_accno' => $final_data1['customer_accno'],
                   'dispo_code' => $final_data1['dispo_code'],
                   'executive_summary' => $final_data1['executive_summary'],
                   'executive_other' => $final_data1['executive_other'],
                   'executive_time' => $final_data1['executive_time'],
                   'executive_transtype' => $final_data1['executive_transtype'],
                   
            ]);
                //   print "dfds".$final_data1;
                //   if($final_data1!=''){
                   $var = 1;
                //   }
                //$var++;
              }
              if($var>0){
                  
              
              array_push($array1, [

                   'current_location' => $array1
            ]);
              }
          }
      }

if($count1>0)
			{
				$string = "response_message.Grade List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result1) {
					$b = explode('.', $result1);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Grade not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result1) {
					$b = explode('.', $result1);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("List"=>$array, "Response" => $response);
		echo json_encode($final_data);
		exit;
    	break;
    	
    	case 'CustomerExecutiveNotPaidlist':
    	
    	$pval['teaml_id'] = isset($_GET['teaml_id']) ? $_GET['teaml_id'] : $_POST['teaml_id'];
    	//$pval['exc_date'] = isset($_GET['exc_date']) ? $_GET['exc_date'] : $_POST['exc_date'];
        $sql = "SELECT * FROM profile_details WHERE Id='".$pval['teaml_id']."'";
      $result = mysqli_query($conn,$sql);
      
      
      while($final_data= mysqli_fetch_array($result)){
          $id[] = $final_data['Id'];
      }
     
//       for($x=0;$x<sizeof($id);$x++){
//           $sql3 = "SELECT * FROM team_leader,executive_details WHERE team_leader.Id=executive_details.team_leader_id and executive_details.employee_id='".$id[$x]."' and executive_details.dispo_code!='PAID'";
//           $result3 = mysqli_query($conn,$sql3) or die(mysqli_error());
//           $count[] = mysqli_num_rows($result3);
          
//       }
//       $comt = array_sum($count);
//       $numrows = $comt;

// $rowsperpage = 10;
 

// $totalpages = ceil($numrows / $rowsperpage);
 

// if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
// $currentpage = (int) $_GET['currentpage'];
// } else {
// $currentpage = 1;  // default page number
// }
 

// if ($currentpage > $totalpages) {

// $currentpage = $totalpages;
// }

// if ($currentpage < 1) {

// $currentpage = 1;
// }
//$offset = ($currentpage - 1) * $rowsperpage;

$sql = "SELECT * FROM profile_details WHERE Id='".$pval['teaml_id']."'";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      $array= [];
      for ($i = 1; $i <= $count; $i++) 
      {
        while($final_data= mysqli_fetch_array($result)){
            $array1 = [];
              $Id = $final_data['Id'];
              
             
              $sql1 = "SELECT * FROM team_leader,executive_details WHERE team_leader.Id=executive_details.team_leader_id and executive_details.employee_id='".$Id."' and executive_details.dispo_code!='PAID' order by executive_details.Id DESC";
              
              $result1 = mysqli_query($conn,$sql1);
              $count1 = mysqli_num_rows($result1);
              $var = 0;
              while($final_data1= mysqli_fetch_array($result1)){
                  array_push($array, [
                   'Id' => $final_data1['team_leader_id'],
                   'employee_name' => $final_data['employee_name'],
                   'customer_name' => $final_data1['customer_name'],
                   'customer_phone' => $final_data1['customer_phone'],
                   'customer_accno' => $final_data1['customer_accno'],
                   'dispo_code' => $final_data1['dispo_code'],
                   'executive_summary' => $final_data1['executive_summary'],
                   'executive_other' => $final_data1['executive_other'],
                   'executive_time' => $final_data1['executive_time'],
                   'executive_transtype' => $final_data1['executive_transtype'],
                   
            ]);
                //   print "dfds".$final_data1;
                //   if($final_data1!=''){
                   $var = 1;
                //   }
                //$var++;
              }
              if($var>0){
                  
              
              array_push($array1, [

                   'current_location' => $array1
            ]);
              }
          }
      }

if($count1>0)
			{
				$string = "response_message.Grade List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result1) {
					$b = explode('.', $result1);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Grade not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result1) {
					$b = explode('.', $result1);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("List"=>$array, "Response" => $response);
		echo json_encode($final_data);
		exit;
    	break;
    	
    	case 'MyBaseList':
    	
    	$pval['teaml_id'] = isset($_GET['teaml_id']) ? $_GET['teaml_id'] : $_POST['teaml_id'];
    	//$pval['exc_date'] = isset($_GET['exc_date']) ? $_GET['exc_date'] : $_POST['exc_date'];
      $sql = "SELECT * FROM profile_details WHERE Id='".$pval['teaml_id']."'";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      $array= [];
      for ($i = 1; $i <= $count; $i++) 
      {
        while($final_data= mysqli_fetch_array($result)){
            $array1 = [];
              $Id = $final_data['Id'];
              
             
             $sql1 = "SELECT * FROM team_leader WHERE employee_id='".$Id."' and status='1'";
              
              $result1 = mysqli_query($conn,$sql1);
              $count1 = mysqli_num_rows($result1);
              $var = 0;
              while($final_data1= mysqli_fetch_array($result1)){
                  array_push($array, [
                   'Id' => $final_data1['Id'],
                   'employee_name' => $final_data['employee_name'],
                   'customer_name' => $final_data1['customer_name'],
                   'customer_phone' => $final_data1['customer_phone'],
                   'customer_accno' => $final_data1['customer_accno'],
                   'dispo_code' => $final_data1['dispo_code'],
                   'executive_summary' => $final_data1['executive_summary'],
                   'executive_other' => $final_data1['executive_other'],
                   'executive_time' => $final_data1['executive_time'],
                   'executive_transtype' => $final_data1['executive_transtype'],
                   
            ]);
                //   print "dfds".$final_data1;
                //   if($final_data1!=''){
                   $var = 1;
                //   }
                //$var++;
              }
              if($var>0){
                  
              
              array_push($array1, [

                   'current_location' => $array1
            ]);
              }
          }
      }
        if($count1>0)
			{
				$string = "response_message.Grade List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result1) {
					$b = explode('.', $result1);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Grade not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result1) {
					$b = explode('.', $result1);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("List"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    case 'MyBaseList4':
    	
    	$pval['teaml_id'] = isset($_GET['teaml_id']) ? $_GET['teaml_id'] : $_POST['teaml_id'];
    	//$pval['exc_date'] = isset($_GET['exc_date']) ? $_GET['exc_date'] : $_POST['exc_date'];
        $sql = "SELECT * FROM profile_details WHERE Id='".$pval['teaml_id']."'";
      $result = mysqli_query($conn,$sql);
      
      
      while($final_data= mysqli_fetch_array($result)){
          $id[] = $final_data['Id'];
      }
     
      for($x=0;$x<sizeof($id);$x++){
          $sql3 = "SELECT * FROM team_leader WHERE employee_id='".$id[$x]."' and status='1'";
          $result3 = mysqli_query($conn,$sql3) or die(mysqli_error());
          $count[] = mysqli_num_rows($result3);
          
      }
      $comt = array_sum($count);
      $numrows = $comt;

$rowsperpage = 10;
 

$totalpages = ceil($numrows / $rowsperpage);
 

if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
$currentpage = (int) $_GET['currentpage'];
} else {
$currentpage = 1;  // default page number
}
 

// if ($currentpage > $totalpages) {

// $currentpage = $totalpages;
// }

// if ($currentpage < 1) {

// $currentpage = 1;
// }
$offset = ($currentpage - 1) * $rowsperpage;

$sql = "SELECT * FROM profile_details WHERE Id='".$pval['teaml_id']."'";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      $array= [];
      for ($i = 1; $i <= $count; $i++) 
      {
        while($final_data= mysqli_fetch_array($result)){
            $array1 = [];
              $Id = $final_data['Id'];
              
             
              print $sql1 = "SELECT * FROM team_leader WHERE employee_id='".$Id."' and status='1' LIMIT $offset, $rowsperpage";
              
              $result1 = mysqli_query($conn,$sql1);
              $count1 = mysqli_num_rows($result1);
              $var = 0;
              while($final_data1= mysqli_fetch_array($result1)){
                  array_push($array, [
                   'Id' => $final_data1['team_leader_id'],
                   'employee_name' => $final_data['employee_name'],
                   'customer_name' => $final_data1['customer_name'],
                   'customer_phone' => $final_data1['customer_phone'],
                   'customer_accno' => $final_data1['customer_accno'],
                   'dispo_code' => $final_data1['dispo_code'],
                   'executive_summary' => $final_data1['executive_summary'],
                   'executive_other' => $final_data1['executive_other'],
                   'executive_time' => $final_data1['executive_time'],
                   'executive_transtype' => $final_data1['executive_transtype'],
                   
            ]);
                //   print "dfds".$final_data1;
                //   if($final_data1!=''){
                   $var = 1;
                //   }
                //$var++;
              }
              if($var>0){
                  
              
              array_push($array1, [

                   'current_location' => $array1
            ]);
              }
          }
      }

if($count1>0)
			{
				$string = "response_message.Grade List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result1) {
					$b = explode('.', $result1);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Grade not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result1) {
					$b = explode('.', $result1);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("List"=>$array, "Response" => $response);
		echo json_encode($final_data);
		exit;
    	break;	
    	
    case 'ForgetPassword':
        //$pval['doctor_id'] = isset($_GET['doctor_id']) ? $_GET['doctor_id'] : $_POST['doctor_id'];
        $pval['employee_phone'] = isset($_GET['employee_phone']) ? $_GET['employee_phone'] : $_POST['employee_phone'];
        $pval['employee_pwd'] = isset($_GET['employee_pwd']) ? $_GET['employee_pwd'] : $_POST['employee_pwd'];
        
    	$sql = "SELECT employee_phone,employee_pwd FROM profile_details where employee_phone='".$pval['employee_phone']."'";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        //$array = [];
        while($final_data= mysqli_fetch_array($result)){
            $email = $final_data['employee_phone'];
            $pwd = $final_data['employee_pwd'];
            $name = $final_data['employee_name'];
        }
           	
           	
           	
           	$to      = 'a_ranjithkumar.r@airtelworld.com';
            $subject = 'Recover Your Password';
            $message = $pwd;
            $message .= $name;
            $headers = 'From: airtelworld@example.com' . "\r\n" .
                'Reply-To: airtelworld@example.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            
           // mail($to, $subject, $message, $headers);
           	
           	
           	
           	
           	
           	
           	
           	
           	
           	
           	
           	
           	//$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            //$randstring = '';
            //for ($i = 0; $i < 5; $i++) {
                //$randstring = $characters[rand(0, strlen($characters))];
            //}
           	
           	
           	/*$ch = curl_init("https://fcm.googleapis.com/fcm/send");
                        $header=array('Content-Type: application/json',
                        "Authorization: key=AAAARYhJr_s:APA91bGcM7Cf4wn35uZSC-sEStrX7_0WJtl0ST5zOJgOSPxFef3Ks07BQWzK7D_AKSe0XWlO9H_A8PGmz4hysnfkVFUJXe9D-Nts0Fpwb6KlMlE0RR2r1tFexh-eh4Fhkm10hOHg8CIF");
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \"notification\": {    \"title\": \"Your booking has been confirmed\",    \"text\": \"$details\"  },    \"to\" : \"$doctor_token\"}");
                        
                        $result = curl_exec ($ch);
                        if($result === FALSE) {
                             //print"hh";
                        }
                        else{
                           // print "ddfgdfgdfg";
                        }
                        curl_close($ch);*/
           	
           	
           	
           	if(mail($to, $subject, $message, $headers))
           	//if($count>0)
				{
				    //$sql1 = "update profile_details set employee_pwd = '".$pval['employee_pwd']."' where employee_phone='".$email."'";
           	        //$result11 = mysqli_query($conn,$sql1);
					
					$string = "response_message.Password updated,response_code.1";
					$a = explode(',', $string);
					foreach ($a as $result) {
						$b = explode('.', $result);
						$array1[$b[0]] = $b[1];
					}
					$response = $array1;
					//$final_data = array("Response" => $response);
				}
				else
				{
					$string = "response_message.Password not updated,response_code.-1";
					$a = explode(',', $string);
					foreach ($a as $result) {
						$b = explode('.', $result);
						$array1[$b[0]] = $b[1];
					}
					$response = $array1;
					//$response = array("Response" => $response);
				}
          
			$final_data = array("Password"=>$array, "Response" => $response);
		//}
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	case 'DeviceLogout':

            $pval['user_id'] = isset($_GET['user_id']) ? $_GET['user_id'] : $_POST['user_id'];

            $sql3 = "UPDATE profile_details set status=0 WHERE Id=".$pval['user_id'];
            $result3 = mysqli_query($conn,$sql3);

            if($result3)
                    {
                        $string = "response_message.Successfully Logout,response_code.1";
                        $a = explode(',', $string);
                        foreach ($a as $result) {
                            $b = explode('.', $result);
                            $array1[$b[0]] = $b[1];
                        }
                        $response = $array1;
                    }
                    else
                    {
                        $string = "response_message.Not Logout,response_code.-1";
                        $a = explode(',', $string);
                        foreach ($a as $result) {
                            $b = explode('.', $result);
                            $array1[$b[0]] = $b[1];
                        }
                        $response = $array1;
                    }

                $final_data = array("Response" => $response);
            echo json_encode($final_data);
            exit;
            break;

    case 'TodayFollowUp':

        $pval['user_id'] = isset($_GET['user_id']) ? $_GET['user_id'] : $_POST['user_id'];
        $today = date("Y-m-d");
        $today1 = date("d-m-Y");
        $sql3 = "SELECT * FROM executive_details where employee_id = ". $pval['user_id'] ." and follow_up='".$today."'";
        $result3 = mysqli_query($conn,$sql3);

        $sql4 = "SELECT * FROM team_leader where employee_id = ". $pval['user_id'] ." and end_date='".$today1."'";
        $result4 = mysqli_query($conn,$sql4);

        if($result3)
        {
            $loop = 0;
            while (mysqli_fetch_assoc($result3)){
                $loop += 1;
            }

            $string = "response_message.Done,response_code.1";
            $a = explode(',', $string);
            foreach ($a as $result) {
                $b = explode('.', $result);
                $array1[$b[0]] = $b[1];
            }
            $response = $array1;
        }
        else
        {
            $string = "response_message.Failed,response_code.-1";
            $a = explode(',', $string);
            foreach ($a as $result) {
                $b = explode('.', $result);
                $array1[$b[0]] = $b[1];
            }
            $response = $array1;
        }

        if($result4)
        {
            $loop1 = 0;
            while (mysqli_fetch_assoc($result4)){
                $loop1 += 1;
            }

            $string = "response_message.Done,response_code.1";
            $a = explode(',', $string);
            foreach ($a as $result) {
                $b = explode('.', $result);
                $array1[$b[0]] = $b[1];
            }
            $response1 = $array1;
        }
        else
        {
            $string = "response_message.Failed,response_code.-1";
            $a = explode(',', $string);
            foreach ($a as $result) {
                $b = explode('.', $result);
                $array1[$b[0]] = $b[1];
            }
            $response1 = $array1;
        }

        $final_data = array("Today" => strval($loop), "End" => strval($loop1), "Response" => $response);
        echo json_encode($final_data);
        exit;
        break;



    case 'EndDate':

        $pval['user_id'] = isset($_GET['user_id']) ? $_GET['user_id'] : $_POST['user_id'];
        // $pval['end_date'] = isset($_GET['end_date']) ? $_GET['end_date'] : $_POST['end_date'];
        $today = date("d-m-Y");
        //$today = date("d-m-Y");

        // SELECT team_leader.*, mybase.To_Be_Paid FROM team_leader JOIN mybase ON team_leader.end_date = mybase.End_Date WHERE team_leader.end_date = "18-06-2019" and team_leader.employee_id = 5
        $sql4 = "SELECT * from team_leader where end_date='". $today ."' and employee_id=". $pval['user_id'];
        $result4 = mysqli_query($conn,$sql4);

        if($result4)
        {
            $arrayend = [];
            while ($final_data1 = mysqli_fetch_assoc($result4)){
                array_push($arrayend, [
                    'employee_id' => $final_data1['Id'],
                    'customer_name' => $final_data1['customer_name'],
                    'customer_phone' => $final_data1['customer_phone'],
                    'customer_accno' => $final_data1['customer_accno'],
                    'customer_address' => $final_data1['customer_address'],
                    'end_location_lat' => $final_data1['end_location_lat'],
                    'end_location_long' => $final_data1['end_location_long'],
                    'end_date' => $final_data1['end_date'],
                    'emp_type' => $final_data1['emp_type'],
                    'status' => $final_data1['status'],
                    'billzip_zip' => $final_data1['billzip_zip'],
                    'BTC' => $final_data1['BTC'],
                    'To_be_collected' => $final_data1['To_be_collected'],
                ]);
            }
            $string = "response_message.Done,response_code.1";
            $a = explode(',', $string);
            foreach ($a as $result) {
                $b = explode('.', $result);
                $array1[$b[0]] = $b[1];
            }
            $response1 = $array1;
        }
        else
        {
            $string = "response_message.Failed,response_code.-1";
            $a = explode(',', $string);
            foreach ($a as $result) {
                $b = explode('.', $result);
                $array1[$b[0]] = $b[1];
            }
            $response1 = $array1;
        }

        $final_data = array("End" => $arrayend, "Response" => $response1);
        echo json_encode($final_data);
        exit;
        break;

    case 'FollowUp':

        $pval['user_id'] = isset($_GET['user_id']) ? $_GET['user_id'] : $_POST['user_id'];
        // $pval['end_date'] = isset($_GET['end_date']) ? $_GET['end_date'] : $_POST['end_date'];
        $today = date("Y-m-d");

        $sql4 = "SELECT executive_details.*, team_leader.To_be_collected, team_leader.customer_address, team_leader.end_date, team_leader.BTC FROM executive_details JOIN team_leader ON executive_details.team_leader_id = team_leader.Id WHERE executive_details.employee_id = ". $pval['user_id'] ." and executive_details.follow_up ='".$today."'";
        $result4 = mysqli_query($conn,$sql4);

        if($result4)
        {
            $arrayend = [];
            while ($final_data1 = mysqli_fetch_assoc($result4)){
                array_push($arrayend, [
                    'team_leader_id' => $final_data1['team_leader_id'],
                    'employee_id' => $final_data1['employee_id'],
                    'dispo_code' => $final_data1['dispo_code'],
                    'executive_summary' => $final_data1['executive_summary'],
                    'executive_other' => $final_data1['end_date'],
                    'executive_location_lat' => $final_data1['customer_address'],
                    'executive_location_long' => $final_data1['executive_location_long'],
                    'executive_time' => $final_data1['executive_time'],
                    'executive_transtype' => $final_data1['executive_transtype'],
                    'follow_up' => $final_data1['follow_up'],
                    'To_be_collect' => $final_data1['To_be_collected'],
                    'BTC' => $final_data1['BTC'],
                ]);
            }

            $string = "response_message.Done,response_code.1";
            $a = explode(',', $string);
            foreach ($a as $result) {
                $b = explode('.', $result);
                $array1[$b[0]] = $b[1];
            }
            $response1 = $array1;
        }
        else
        {
            $string = "response_message.Failed,response_code.-1";
            $a = explode(',', $string);
            foreach ($a as $result) {
                $b = explode('.', $result);
                $array1[$b[0]] = $b[1];
            }
            $response1 = $array1;
        }

        $final_data = array("End" => $arrayend, "Response" => $response1);
        echo json_encode($final_data);
        exit;
        break;

    case 'AttendanceDetail':

        $pval['user_id'] = isset($_GET['user_id']) ? $_GET['user_id'] : $_POST['user_id'];
        $today = date("Y-m-d");

        $sql4 = "SELECT * FROM attendance_details where employee_id = ".$pval['user_id']." and date_time = '". $today ."' and attendance_status =". 1;
        $result4 = mysqli_query($conn,$sql4);
        $count = mysqli_num_rows($result4);

        if($count == 1)
        {
            $status = "1";
            $string = "response_message.Checked in,response_code.1";
            $a = explode(',', $string);
            foreach ($a as $result) {
                $b = explode('.', $result);
                $array1[$b[0]] = $b[1];
            }
            $response = $array1;
        }
        else
        {
            $status = "0";
            $string = "response_message.Checked out,response_code.0";
            $a = explode(',', $string);
            foreach ($a as $result) {
                $b = explode('.', $result);
                $array1[$b[0]] = $b[1];
            }
            $response = $array1;
        }

        $final_data = array("status" => $status, "Response" => $response);
        echo json_encode($final_data);
        exit;
        break;


    case 'AccountNumber':

        $pval['accno'] = isset($_GET['accno']) ? $_GET['accno'] : $_POST['accno'];
        $pval['user_id'] = isset($_GET['user_id']) ? $_GET['user_id'] : $_POST['user_id'];

        $sql4 = "SELECT * FROM team_leader where customer_accno like '%".$pval['accno']."%' and employee_id=". $pval['user_id'];
        $result4 = mysqli_query($conn,$sql4);
        $count = mysqli_num_rows($result4);

        if($count >= 1) {
            $arrayend = [];
            while ($final_data1 = mysqli_fetch_assoc($result4)) {
                array_push($arrayend, [
                    'employee_id' => $final_data1['Id'],
                    'customer_name' => $final_data1['customer_name'],
                    'customer_phone' => $final_data1['customer_phone'],
                    'customer_accno' => $final_data1['customer_accno'],
                    'customer_address' => $final_data1['customer_address'],
                    'end_location_lat' => $final_data1['end_location_lat'],
                    'end_location_long' => $final_data1['end_location_long'],
                    'end_date' => $final_data1['end_date'],
                    'emp_type' => $final_data1['emp_type'],
                    'status' => $final_data1['status'],
                    'billzip_zip' => $final_data1['billzip_zip'],
                    'To_Be_Paid' => $final_data1['To_be_paid'],
                    'BTC' => $final_data1['BTC'],
                    'To_be_collected' => $final_data1['To_be_collected'],
                ]);
            }
            $status = $arrayend;
            $string = "response_message.Success,response_code.1";
            $a = explode(',', $string);
            foreach ($a as $result) {
                $b = explode('.', $result);
                $array1[$b[0]] = $b[1];
            }
            $response = $array1;
        }
        else
        {
            $status = [];
            $string = "response_message.Failed,response_code.0";
            $a = explode(',', $string);
            foreach ($a as $result) {
                $b = explode('.', $result);
                $array1[$b[0]] = $b[1];
            }
            $response = $array1;
        }

        $final_data = array("Data" => $status, "Response" => $response);
        echo json_encode($final_data);
        exit;
        break;


    case 'AccountNumberData':

        $pval['accno_data'] = isset($_GET['accno_data']) ? $_GET['accno_data'] : $_POST['accno_data'];

        $sql4 = "SELECT * FROM team_leader where customer_accno = '".$pval['accno_data']."'";
        $result4 = mysqli_query($conn,$sql4);
        $count = mysqli_num_rows($result4);

        if($count >= 1)
        {
            $arrayend = [];
            while ($final_data1 = mysqli_fetch_assoc($result4)){
                array_push($arrayend, [
                    'employee_id' => $final_data1['Id'],
                    'customer_name' => $final_data1['customer_name'],
                    'customer_phone' => $final_data1['customer_phone'],
                    'customer_accno' => $final_data1['customer_accno'],
                    'customer_address' => $final_data1['customer_address'],
                    'end_location_lat' => $final_data1['end_location_lat'],
                    'end_location_long' => $final_data1['end_location_long'],
                    'end_date' => $final_data1['end_date'],
                    'emp_type' => $final_data1['emp_type'],
                    'status' => $final_data1['status'],
                    'billzip_zip' => $final_data1['billzip_zip'],
                    'To_Be_Paid' => $final_data1['To_be_paid'],
                    'BTC' => $final_data1['BTC'],
                    'To_be_collected' => $final_data1['To_be_collected'],
                ]);
            }
            $status = $arrayend;
            $string = "response_message.Seacrh by Account no.,response_code.1";
            $a = explode(',', $string);
            foreach ($a as $result) {
                $b = explode('.', $result);
                $array1[$b[0]] = $b[1];
            }
            $response = $array1;
        }
        else
        {
            $status = [];
            $string = "response_message.Failed,response_code.0";
            $a = explode(',', $string);
            foreach ($a as $result) {
                $b = explode('.', $result);
                $array1[$b[0]] = $b[1];
            }
            $response = $array1;
        }

        $final_data = array("Data" => $status, "Response" => $response);
        echo json_encode($final_data);
        exit;
        break;

    case 'SearchByDate':

        $pval['user_id'] = isset($_GET['user_id']) ? $_GET['user_id'] : $_POST['user_id'];
        $pval['end_date'] = isset($_GET['end_date']) ? $_GET['end_date'] : $_POST['end_date'];
        //$today = date("d-m-Y");

    // SELECT team_leader.*, mybase.To_Be_Paid FROM team_leader JOIN mybase ON team_leader.end_date = mybase.End_Date WHERE team_leader.end_date = "18-06-2019" and team_leader.employee_id = 5
        $sql4 = "SELECT * from team_leader where end_date = '".$pval['end_date']."'and team_leader.employee_id = ". $pval['user_id'];
        $result4 = mysqli_query($conn,$sql4);

        if($result4)
        {
            $arrayend = [];
            while ($final_data1 = mysqli_fetch_assoc($result4)){
                array_push($arrayend, [
                    'employee_id' => $final_data1['Id'],
                    'customer_name' => $final_data1['customer_name'],
                    'customer_phone' => $final_data1['customer_phone'],
                    'customer_accno' => $final_data1['customer_accno'],
                    'customer_address' => $final_data1['customer_address'],
                    'end_location_lat' => $final_data1['end_location_lat'],
                    'end_location_long' => $final_data1['end_location_long'],
                    'end_date' => $final_data1['end_date'],
                    'emp_type' => $final_data1['emp_type'],
                    'status' => $final_data1['status'],
                    'billzip_zip' => $final_data1['billzip_zip'],
                    'To_Be_Paid' => $final_data1['To_be_paid'],
                    'BTC' => $final_data1['BTC'],
                    'To_be_collected' => $final_data1['To_be_collected'],
                ]);
            }
            $string = "response_message.Done,response_code.1";
            $a = explode(',', $string);
            foreach ($a as $result) {
                $b = explode('.', $result);
                $array1[$b[0]] = $b[1];
            }
            $response1 = $array1;
        }
        else
        {
            $string = "response_message.Failed,response_code.-1";
            $a = explode(',', $string);
            foreach ($a as $result) {
                $b = explode('.', $result);
                $array1[$b[0]] = $b[1];
            }
            $response1 = $array1;
        }

        $final_data = array("End" => $arrayend, "Response" => $response1);
        echo json_encode($final_data);
        exit;
        break;

    case 'TotalReport':

        $pval['user_id'] = isset($_GET['user_id']) ? $_GET['user_id'] : $_POST['user_id'];
        $last_day_this_month = date('t-m-Y');
        $first_day_this_month = date('01-m-Y');
        $today = date("d-m-Y");

        if ($last_day_this_month >= $today){
            $sql4 = "SELECT * from team_leader where (end_date BETWEEN '". $first_day_this_month ."' AND '". $last_day_this_month ."') and team_leader.employee_id = ". $pval['user_id'];
            $result4 = mysqli_query($conn,$sql4);

            if($result4)
            {
                $arrayend = [];
                $btc = 0;
                $To_be_collected = 0;
                while ($final_data1 = mysqli_fetch_assoc($result4)){
                    $btc = intval($final_data1['BTC']) + $btc;
                    $To_be_collected = intval($final_data1['To_be_collected']) + $To_be_collected;
                }
                $collected_amt = $btc - $To_be_collected;

                array_push($arrayend, [
                    'BTC' => $btc,
                    'To_be_collected' => $To_be_collected,
                    'Collected' => $collected_amt,
                ]);
                $string = "response_message.Done,response_code.1";
                $a = explode(',', $string);
                foreach ($a as $result) {
                    $b = explode('.', $result);
                    $array1[$b[0]] = $b[1];
                }
                $response1 = $array1;
            }
            else
            {
                $arrayend = [];
                $string = "response_message.Failed,response_code.-1";
                $a = explode(',', $string);
                foreach ($a as $result) {
                    $b = explode('.', $result);
                    $array1[$b[0]] = $b[1];
                }
                $response1 = $array1;
            }

        } else {
            $arrayend = [];
            $string = "response_message.Failed,response_code.-1";
            $a = explode(',', $string);
            foreach ($a as $result) {
                $b = explode('.', $result);
                $array1[$b[0]] = $b[1];
            }
            $response1 = $array1;
        }
        $final_data = array("TotalReport" => $arrayend, "Response" => $response1);
        echo json_encode($final_data);
        exit;
        break;
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	case 'QuestionPaperList':
    	$pval['onlinecat_id'] = isset($_GET['onlinecat_id']) ? $_GET['onlinecat_id'] : $_POST['onlinecat_id'];    
        $sql = "SELECT * FROM question_papers WHERE onlinecat_id='".$pval['onlinecat_id']."'";
        $result = mysqli_query($conn,$sql);    
    	$array = [];    
    	while($final_data= mysqli_fetch_array($result)){
            array_push($array, [
            'Id'   => $final_data['Id'],
            'onlinecat_id' => $final_data['onlinecat_id'],
            'question_name' => $final_data['question_name']
            ]);
        }
        
        if($result)
			{
				$string = "response_message.QuestionPaper List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.QuestionPaper not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("Fees"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	case 'ExamAttendedDetails':
    	    
    	$pval['student_id'] = isset($_GET['student_id']) ? $_GET['student_id'] : $_POST['student_id'];
    	$pval['question_id'] = isset($_GET['question_id']) ? $_GET['question_id'] : $_POST['question_id'];
    	$pval['right_answers'] = isset($_GET['right_answers']) ? $_GET['right_answers'] : $_POST['right_answers'];
    	$pval['wrong_answers'] = isset($_GET['wrong_answers']) ? $_GET['wrong_answers'] : $_POST['wrong_answers'];
    	$pval['attended_time'] = isset($_GET['attended_time']) ? $_GET['attended_time'] : $_POST['attended_time'];
    	
    	date_default_timezone_set('Asia/Calcutta'); 
        $today = date("d-m-Y");
        
        $sql2 = "INSERT INTO examattended_details(student_id,question_id,right_answers,wrong_answers,attended_date,attended_time)VALUES('".$pval['student_id']."','".$pval['question_id']."','".$pval['right_answers']."','".$pval['wrong_answers']."','".$today."','".$pval['attended_time']."')";
        $result2 = mysqli_query($conn,$sql2);
        
        
        if($result2)
			{
				$string = "response_message.ExamAttendedDetails Added,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.ExamAttendedDetails not Added,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("ExamAttendedDetails"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	case 'ExamAttendedList':
    	$pval['student_id'] = isset($_GET['student_id']) ? $_GET['student_id'] : $_POST['student_id'];    
        $sql = "SELECT * FROM examattended_details WHERE student_id='".$pval['student_id']."'";
        $result = mysqli_query($conn,$sql);    
    	$array = [];    
    	while($final_data= mysqli_fetch_array($result)){
            array_push($array, [
            'Id'   => $final_data['Id'],
            'student_id' => $final_data['student_id'],
            'question_id' => $final_data['question_id'],
            'right_answers' => $final_data['right_answers'],
            'wrong_answers' => $final_data['wrong_answers'],
            'attended_date' => $final_data['attended_date'],
            'attended_time' => $final_data['attended_time']
            ]);
        }
        
        if($result)
			{
				$string = "response_message.QuestionPaper List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.QuestionPaper not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("ExamAttendedList"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	case 'StudentList':
        $sql = "SELECT * FROM student_details";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        $array= [];
        for ($i = 1; $i <= $count; $i++) 
       {
        while($final_data= mysqli_fetch_array($result)){
            
              
              array_push($array, [
                   'Id'   => $final_data['Id'],
                   'student_name' => $final_data['student_name'],
                   'student_email' => $final_data['student_email'],
                   'student_phone' => $final_data['student_phone'],
                   'student_gender' => $final_data['student_gender'],
                   'student_birthdate' => $final_data['student_birthdate'],
                   'student_course' => $final_data['student_course'],
            ]);
          }
      }
      if($result)
			{
				$string = "response_message.StudentList List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.StudentList not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("StudentList"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	
    	
    	case 'ExaminationQuestions':
    	    
    	$pval['question_title'] = isset($_GET['question_title']) ? $_GET['question_title'] : $_POST['question_title'];
    	$pval['class_grade_id'] = isset($_GET['class_grade_id']) ? $_GET['class_grade_id'] : $_POST['class_grade_id'];
    	$pval['board_id'] = isset($_GET['board_id']) ? $_GET['board_id'] : $_POST['board_id'];
    	$pval['subject_id'] = isset($_GET['subject_id']) ? $_GET['subject_id'] : $_POST['subject_id'];
    	    	
    	$sql = "INSERT INTO examination_question(question_title,class_grade_id,board_id,subject_id)values('".$pval['question_title']."','".$pval['class_grade_id']."','".$pval['board_id']."','".$pval['subject_id']."')";
        $result2 = mysqli_query($conn,$sql);
        $last_id = mysqli_insert_id($conn);
        $sql3 = "select * from examination_question where Id='".$last_id."'";
        $result3 = mysqli_query($conn,$sql3);
        $array = [];    
    	while($final_data= mysqli_fetch_array($result3)){
            array_push($array, [
            'Id'   => $final_data['Id'],
            'question_title' => $final_data['question_title'],
            'class_grade_id' => $final_data['class_grade_id'],
            'board_id' => $final_data['board_id'],
            'subject_id' => $final_data['subject_id']
            ]);
        }
        if($result2)
			{
				$string = "response_message.Examination Questions Inserted,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Examination Questions not Inserted,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("ExaminationQuestionsInsertion"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	case 'ExaminationDetails':
    	    
    	$pval['exam_question'] = isset($_GET['exam_question']) ? $_GET['exam_question'] : $_POST['exam_question'];
    	$pval['answer_option1'] = isset($_GET['answer_option1']) ? $_GET['answer_option1'] : $_POST['answer_option1'];
    	$pval['answer_option2'] = isset($_GET['answer_option2']) ? $_GET['answer_option2'] : $_POST['answer_option2'];
    	$pval['answer_option3'] = isset($_GET['answer_option3']) ? $_GET['answer_option3'] : $_POST['answer_option3'];
    	$pval['answer_option4'] = isset($_GET['answer_option4']) ? $_GET['answer_option4'] : $_POST['answer_option4'];
    	$pval['correct_answer'] = isset($_GET['correct_answer']) ? $_GET['correct_answer'] : $_POST['correct_answer'];
    	$pval['question_title_id'] = isset($_GET['question_title_id']) ? $_GET['question_title_id'] : $_POST['question_title_id'];
    	    	
        $sql2 = "INSERT INTO examination_details(exam_question,answer_option1,answer_option2,answer_option3,answer_option4,correct_answer,question_title_id) VALUES ('".$pval['exam_question']."','".$pval['answer_option1']."','".$pval['answer_option2']."','".$pval['answer_option3']."','".$pval['answer_option4']."','".$pval['correct_answer']."','".$pval['question_title_id']."')";
        $result2 = mysqli_query($conn,$sql2);
        $last_id = mysqli_insert_id($conn);
        $sql3 = "select * from examination_details where Id='".$last_id."'";
        $result3 = mysqli_query($conn,$sql3);
        $array = [];    
    	while($final_data= mysqli_fetch_array($result3)){
            array_push($array, [
            'Id'   => $final_data['Id'],
            'exam_question' => $final_data['exam_question']
            ]);
        }
        if($result2)
			{
				$string = "response_message.Examination Details Inserted,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Examination Details not Inserted,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("ExaminationDetailsInsertion"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	case 'ExamAttendedListDate':
    	$pval['exam_date'] = isset($_GET['exam_date']) ? $_GET['exam_date'] : $_POST['exam_date'];    
        $sql = "SELECT * FROM examattended_details,student_details WHERE examattended_details.student_id=student_details.Id and examattended_details.attended_date='".$pval['exam_date']."' ";
        $result = mysqli_query($conn,$sql);    
    	$array = [];    
    	while($final_data= mysqli_fetch_array($result)){
            array_push($array, [
            'Id'   => $final_data['Id'],
            'student_name' => $final_data['student_name'],
            'question_id' => $final_data['question_id'],
            'right_answers' => $final_data['right_answers'],
            'wrong_answers' => $final_data['wrong_answers'],
            'attended_date' => $final_data['attended_date'],
            'attended_time' => $final_data['attended_time']
            ]);
        }
        
        if($result)
			{
				$string = "response_message.QuestionPaper List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.QuestionPaper not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("ExamAttendedList"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	
    	case 'NewsEvents':
    	    
    	$pval['news_title'] = isset($_GET['news_title']) ? $_GET['news_title'] : $_POST['news_title'];
    	$pval['news_content'] = isset($_GET['news_content']) ? $_GET['news_content'] : $_POST['news_content'];
    	date_default_timezone_set('Asia/Calcutta');
    	$date = date('Y-m-d');
    	
        $sql2 = "INSERT INTO news_events(news_title,news_content,news_date) VALUES ('".$pval['news_title']."','".$pval['news_content']."','".$date."')";
        $result2 = mysqli_query($conn,$sql2);
        
        if($result2)
			{
				$string = "response_message.NewsEvents Details Inserted,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.NewsEvents Details not Inserted,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("NewsEventsInsertion"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	case 'NewsEventsList':
    	    
    	
        $sql = "SELECT * FROM news_events";
        $result = mysqli_query($conn,$sql);
        
        
       $array = [];    
    	while($final_data= mysqli_fetch_array($result)){
            array_push($array, [
            'Id'   => $final_data['Id'],
            'news_title' => $final_data['news_title'],
            'news_content' => $final_data['news_content'],
            'news_date' => $final_data['news_date']
            ]);
        }
        
        if($result)
			{
				$string = "response_message.NewsEvents List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.NewsEvents not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("NewsEventsList"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	
    	
    	case 'NewsEventsSend':
    	    
    	$pval['news_id'] = isset($_GET['news_id']) ? $_GET['news_id'] : $_POST['news_id'];    
    	
        $sql2 = "SELECT * FROM news_events WHERE Id='".$pval['news_id']."'";
        $result2 = mysqli_query($conn,$sql2);
        
        	while($final_data= mysqli_fetch_array($result2)){
        	    $title = $final_data['news_title'];
        	    $text = $final_data['news_content'];
        	}
        
        /*PUSH NOTIFICATION*/
                        $sql = "SELECT token_value FROM student_details";
                        $result = mysqli_query($conn,$sql);
        
        	            while($final_data1= mysqli_fetch_array($result)){
                        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
                        $header=array('Content-Type: application/json',
                        "Authorization: key=AAAARYhJr_s:APA91bGcM7Cf4wn35uZSC-sEStrX7_0WJtl0ST5zOJgOSPxFef3Ks07BQWzK7D_AKSe0XWlO9H_A8PGmz4hysnfkVFUJXe9D-Nts0Fpwb6KlMlE0RR2r1tFexh-eh4Fhkm10hOHg8CIF");
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                        $doctor_token1 = $final_data['token_value'];
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \"notification\": {    \"title\": \"$title\",    \"text\": \"$text\"  },    \"to\" : \"$doctor_token1\"}");
                   
                        $result = curl_exec ($ch);
                        if($result === FALSE) {
                            //print"hh";
                        }
                        else{
                            //print "ddfgdfgdfg";
                        }
                        curl_close($ch);
        	}
        
        if($result2)
			{
				$string = "response_message.News Send Successfully,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.News Not Send Successfully,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("NewsEventsSend"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	case 'StudentLists':
        $sql = "SELECT * FROM student_details WHERE login_type='1'";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        
        $array = [];    
    	while($final_data= mysqli_fetch_array($result)){
            array_push($array, [
            'Id'   => $final_data['Id'],
                   'student_name' => $final_data['student_name'],
                   'student_email' => $final_data['student_email'],
                   'student_phone' => $final_data['student_phone'],
                   'student_gender' => $final_data['student_gender'],
                   'student_birthdate' => $final_data['student_birthdate'],
                   'student_course' => $final_data['student_course'],
                   'token_value' => $final_data['token_value']
            ]);
        }
        
        
        
       
      if($result)
			{
				$string = "response_message.StudentList List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.StudentList not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("StudentList"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	
    	case 'PasswordProtect':
    	    
    	$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                     .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                     .'0123456789'); 
    shuffle($seed); 
    $rand = '';
    foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];
        $sql2 = "INSERT INTO password_protect(password_field,password_status) VALUES ('".$rand."','1')";
        $result2 = mysqli_query($conn,$sql2);
        
        if($result2)
			{
				$string = "response_message.Protected Password Inserted,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Protected Password not Inserted,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("Protected Password Insertion"=>$rand, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	case 'InsertAPI':
    	    
        $pval['insert_id'] = isset($_GET['insert_id']) ? $_GET['insert_id'] : $_POST['insert_id'];
        $pval['insert_value'] = isset($_GET['insert_value']) ? $_GET['insert_value'] : $_POST['insert_value'];
        $pval['class_id'] = isset($_GET['class_id']) ? $_GET['class_id'] : $_POST['class_id'];
        $pval['board_id'] = isset($_GET['board_id']) ? $_GET['board_id'] : $_POST['board_id'];
                
        if($pval['insert_value'] == 'class_grade'){
            $sql2 = "INSERT INTO class_grade(class_name) VALUES ('".$pval['insert_id']."')";
            $result2 = mysqli_query($conn,$sql2);
        }
        if($pval['insert_value'] == 'board_lists'){
            $sql2 = "INSERT INTO board_lists(board_name,class_id) VALUES ('".$pval['insert_id']."','".$pval['class_id']."')";
            $result2 = mysqli_query($conn,$sql2);
        }
        if($pval['insert_value'] == 'subject_lists'){
            $sql2 = "INSERT INTO subject_lists(subject_name,id_class,board_id) VALUES ('".$pval['insert_id']."','".$pval['class_id']."','".$pval['board_id']."')";
            $result2 = mysqli_query($conn,$sql2);
        }
        
        
        if($result2)
			{
				$string = "response_message.Data Inserted successfully,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Data not Inserted,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("Data Insertion"=>$rand, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	case 'UpdateAPI':
    	    
        $pval['insert_id'] = isset($_GET['insert_id']) ? $_GET['insert_id'] : $_POST['insert_id'];
        $pval['update_id'] = isset($_GET['update_id']) ? $_GET['update_id'] : $_POST['update_id'];
        $pval['insert_value'] = isset($_GET['insert_value']) ? $_GET['insert_value'] : $_POST['insert_value'];
        
        if($pval['insert_value'] == 'class_grade'){
            $sql2 = "UPDATE class_grade SET class_name='".$pval['insert_id']."' WHERE Id='".$pval['update_id']."'";
            $result2 = mysqli_query($conn,$sql2);
        }
        if($pval['insert_value'] == 'board_lists'){
            $sql2 = "UPDATE board_lists SET board_name='".$pval['insert_id']."' WHERE Id='".$pval['update_id']."'";
            $result2 = mysqli_query($conn,$sql2);
        }
        if($pval['insert_value'] == 'subject_lists'){
            $sql2 = "UPDATE subject_lists SET subject_name='".$pval['insert_id']."' WHERE Id='".$pval['update_id']."'";
            $result2 = mysqli_query($conn,$sql2);
        }
        
        
        if($result2)
			{
				$string = "response_message.Data updated successfully,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Data not updated,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("Data Updation"=>$rand, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	case 'DeleteAPI':
    	    
        $pval['insert_id'] = isset($_GET['insert_id']) ? $_GET['insert_id'] : $_POST['insert_id'];
        $pval['insert_value'] = isset($_GET['insert_value']) ? $_GET['insert_value'] : $_POST['insert_value'];
        
        if($pval['insert_value'] == 'class_grade'){
            $tags = explode('_' , $pval['insert_id']);
            foreach($tags as $i =>$key) {
            $sql2 = "DELETE FROM class_grade WHERE Id='".$key."'";
            $result2 = mysqli_query($conn,$sql2);
            }
        }
        if($pval['insert_value'] == 'board_lists'){
            $tags = explode('_' , $pval['insert_id']);
            foreach($tags as $i =>$key) {
            $sql2 = "DELETE FROM board_lists WHERE Id='".$key."'";
            $result2 = mysqli_query($conn,$sql2);
            }
        }
        if($pval['insert_value'] == 'subject_lists'){
            $tags = explode('_' , $pval['insert_id']);
            foreach($tags as $i =>$key) {
            $sql2 = "DELETE FROM subject_lists WHERE Id='".$key."'";
            $result2 = mysqli_query($conn,$sql2);
            }
        }
        
        
        if($result2)
			{
				$string = "response_message.Data deleted successfully,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Data not deleted,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("Data Deletion"=>$rand, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	case 'AllListAPIs1':
    	    
        	    
      $sql = "SELECT * FROM class_grade";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      $array= [];
      for ($i = 1; $i <= $count; $i++) 
      {
        while($final_data= mysqli_fetch_array($result)){
            $array1 = [];
              $Id = $final_data['Id'];
              $sql1 = "SELECT * FROM board_lists WHERE class_id='".$Id."'";
              $result1 = mysqli_query($conn,$sql1);
              $count1 = mysqli_num_rows($result1);
      $array1= [];
      for ($j = 1; $j <= $count1; $j++) 
      {
              while($final_data1= mysqli_fetch_array($result1)){
                  
                  
                  $array2 = [];
              $Id1 = $final_data1['class_id'];
              $Id2 = $final_data1['Id'];
              $sql2 = "SELECT * FROM subject_lists WHERE id_class='".$Id1."' and board_id='".$Id2."'";
              $result2 = mysqli_query($conn,$sql2);
                  
                   while($final_data2= mysqli_fetch_array($result2)){
                  array_push($array2, [
                   'Id' => $final_data1['Id'],
                   'subject_name' => $final_data2['subject_name'],
                   'id_class' => $final_data2['id_class']
            ]);
              }
                  
                  
                  
                  array_push($array1, [
                   'Id' => $final_data1['Id'],
                   'board_name' => $final_data1['board_name'],
                   'class_id' => $final_data1['class_id'],
                   'sub_list' => $array2
            ]);
              }
              
              array_push($array, [
                   'Id'   => $final_data['Id'],
                   'class_name' => $final_data['class_name'],
                   'board_list' => $array1
            ]);
        }
          }
      }
        if($result)
			{
				$string = "response_message.Grade List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Grade not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("Grade"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	case 'StudyMaterialList':
    	    
        $sql = "SELECT * FROM class_grade";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      $array= [];
      for ($i = 1; $i <= $count; $i++) 
      {
        while($final_data= mysqli_fetch_array($result)){
            $array1 = [];
              $Id = $final_data['Id'];
              $sql1 = "SELECT * FROM board_lists WHERE class_id='".$Id."'";
              $result1 = mysqli_query($conn,$sql1);
              $count1 = mysqli_num_rows($result1);
      $array1= [];
      for ($j = 1; $j <= $count1; $j++) 
      {
              while($final_data1= mysqli_fetch_array($result1)){
                  
                  
                  $array2 = [];
              $Id1 = $final_data1['class_id'];
              $Id2 = $final_data1['Id'];
              $sql2 = "SELECT * FROM subject_lists WHERE id_class='".$Id1."' and board_id='".$Id2."'";
              $result2 = mysqli_query($conn,$sql2);
                  
                  $count2 = mysqli_num_rows($result2);
      $array2= [];
      for ($j = 1; $j <= $count1; $j++) 
      {
                  
                  while($final_data2= mysqli_fetch_array($result2)){
                  
                  
                  $array3 = [];
              $Id3 = $final_data2['class_id'];
              $Id4 = $final_data2['Id'];
              $sql2 = "SELECT * FROM study_materials WHERE class_id='".$Id3."' and board_id='".$Id4."'";
              $result2 = mysqli_query($conn,$sql2);
                  
                      
                  while($final_data2= mysqli_fetch_array($result2)){
                  array_push($array3, [
                   'Id' => $final_data1['Id'],
                   'pdf_name' => $final_data2['pdf_name'],
                   'id_class' => $final_data2['id_class']
            ]);
              }
                  
                  
                   
                  array_push($array2, [
                   'Id' => $final_data1['Id'],
                   'subject_name' => $final_data2['subject_name'],
                   'id_class' => $final_data2['id_class'],
                   'subsss_list' => $array3
            ]);
             
                  
                     
                  
                  array_push($array1, [
                   'Id' => $final_data1['Id'],
                   'board_name' => $final_data1['board_name'],
                   'class_id' => $final_data1['class_id'],
                   'sub_list' => $array2
            ]);
              
              
              array_push($array, [
                   'Id'   => $final_data['Id'],
                   'class_name' => $final_data['class_name'],
                   'board_list' => $array1
            ]);
        }
      }
              }
      }
          }
      }
        if($result)
			{
				$string = "response_message.Grade List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Grade not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("Grade"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	case 'StudyMaterialInsert':
    	    
        $pval['pdf_name'] = isset($_GET['pdf_name']) ? $_GET['pdf_name'] : $_POST['pdf_name'];
    	$pval['class_id'] = isset($_GET['class_id']) ? $_GET['class_id'] : $_POST['class_id'];
    	$pval['board_id'] = isset($_GET['board_id']) ? $_GET['board_id'] : $_POST['board_id'];
    	$pval['subject_id'] = isset($_GET['subject_id']) ? $_GET['subject_id'] : $_POST['subject_id'];
    	
        $sql2 = "INSERT INTO study_materials(pdf_name,class_id,board_id,subject_id)VALUES('".$pval['pdf_name']."','".$pval['class_id']."','".$pval['board_id']."','".$pval['subject_id']."')";
        $result2 = mysqli_query($conn,$sql2);
        
        
        if($result2)
			{
				$string = "response_message.Study Material Added,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Study Material not Added,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("Study Material"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	case 'StudentManage':
    	    
    	$pval['Id'] = isset($_GET['Id']) ? $_GET['Id'] : $_POST['Id'];
    	$pval['student_name'] = isset($_GET['student_name']) ? $_GET['student_name'] : $_POST['student_name'];
    	$pval['student_email'] = isset($_GET['student_email']) ? $_GET['student_email'] : $_POST['student_email'];
    	$pval['student_phone'] = isset($_GET['student_phone']) ? $_GET['student_phone'] : $_POST['student_phone'];
    	$pval['student_gender'] = isset($_GET['student_gender']) ? $_GET['student_gender'] : $_POST['student_gender'];
    	$pval['student_birthdate'] = isset($_GET['student_birthdate']) ? $_GET['student_birthdate'] : $_POST['student_birthdate'];
    	$pval['student_password'] = isset($_GET['student_password']) ? $_GET['student_password'] : $_POST['student_password'];
    	$pval['student_course'] = isset($_GET['student_course']) ? $_GET['student_course'] : $_POST['student_course'];
    	//$pval['login_type'] = isset($_GET['login_type']) ? $_GET['login_type'] : $_POST['login_type'];
    	
    	
    	$sql2 = "UPDATE student_details SET student_name='".$pval['student_name']."',student_email='".$pval['student_email']."',student_phone='".$pval['student_phone']."',student_gender='".$pval['student_gender']."',student_birthdate='".$pval['student_birthdate']."',student_password='".$pval['student_password']."',student_course='".$pval['student_course']."' WHERE Id='".$pval['Id']."'";
        $result2 = mysqli_query($conn,$sql2);
        


        
        if($result2)
			{
				$string = "response_message.Profile updated,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Profile not updated,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("ProfileUpdation"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	case 'StudentDeletion':
    	    
    	$pval['Id'] = isset($_GET['Id']) ? $_GET['Id'] : $_POST['Id'];
    	
    	$tags = explode('_' , $pval['Id']);
            foreach($tags as $i =>$key) {
        $sql2 = "Delete from student_details where Id='".$key."'";
        $result2 = mysqli_query($conn,$sql2);
            }
        


        
        if($result2)
			{
				$string = "response_message.Profile Deletd,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Profile not deleted,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("ProfileDeletion"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	case 'StudymaterialManage':
    	    
    	$pval['Id'] = isset($_GET['Id']) ? $_GET['Id'] : $_POST['Id'];
    	$pval['pdf_name'] = isset($_GET['pdf_name']) ? $_GET['pdf_name'] : $_POST['pdf_name'];
    	$pval['class_id'] = isset($_GET['class_id']) ? $_GET['class_id'] : $_POST['class_id'];
    	$pval['board_id'] = isset($_GET['board_id']) ? $_GET['board_id'] : $_POST['board_id'];
    	$pval['subject_id'] = isset($_GET['subject_id']) ? $_GET['subject_id'] : $_POST['subject_id'];
    	
    	
    	$sql2 = "UPDATE study_materials SET pdf_name='".$pval['pdf_name']."',class_id='".$pval['class_id']."',board_id='".$pval['board_id']."',subject_id='".$pval['subject_id']."' where Id='".$pval['Id']."'";
        $result2 = mysqli_query($conn,$sql2);
        


        
        if($result2)
			{
				$string = "response_message.Studymaterial updated,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Studymaterial not updated,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("StudymaterialUpdation"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	case 'StudymaterialDeletion':
    	    
    	$pval['Id'] = isset($_GET['Id']) ? $_GET['Id'] : $_POST['Id'];
    	
    	$tags = explode('_' , $pval['Id']);
            foreach($tags as $i =>$key) {
        $sql2 = "Delete from study_materials where Id='".$pval['Id']."'";
        $result2 = mysqli_query($conn,$sql2);
            }
        


        
        if($result2)
			{
				$string = "response_message.Studymaterial Deletd,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Studymaterial not deleted,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("StudymaterialDeletion"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	case 'NewsEventsManage':
    	    
    	$pval['Id'] = isset($_GET['Id']) ? $_GET['Id'] : $_POST['Id'];
    	$pval['news_title'] = isset($_GET['news_title']) ? $_GET['news_title'] : $_POST['news_title'];
    	$pval['news_content'] = isset($_GET['news_content']) ? $_GET['news_content'] : $_POST['news_content'];
    	
    	
    	$sql2 = "UPDATE news_events SET news_title='".$pval['news_title']."',news_content='".$pval['news_content']."' where Id='".$pval['Id']."'";
        $result2 = mysqli_query($conn,$sql2);
        


        
        if($result2)
			{
				$string = "response_message.NewsEvent updated,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.NewsEvent not updated,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("NewsEventUpdation"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	case 'NewsEventsDeletion':
    	    
    	$pval['Id'] = isset($_GET['Id']) ? $_GET['Id'] : $_POST['Id'];
    	
    	
        $sql2 = "Delete from news_events where Id='".$pval['Id']."'";
        $result2 = mysqli_query($conn,$sql2);
        


        
        if($result2)
			{
				$string = "response_message.NewsEvent Deletd,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.NewsEvent not deleted,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("NewsEventDeletion"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	case 'OnlineTestDeletion':
    	    
    	$pval['Id'] = isset($_GET['Id']) ? $_GET['Id'] : $_POST['Id'];
    	
    	$tags = explode('_' , $pval['Id']);
            foreach($tags as $i =>$key) {
        $sql2 = "Delete from examattended_details where Id='".$pval['Id']."'";
        $result2 = mysqli_query($conn,$sql2);
            }


        
        if($result2)
			{
				$string = "response_message.OnlineTest Deletd,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.OnlineTest not deleted,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("OnlineTestDeletion"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	case 'QuestionPaperDeletion':
    	    
    	$pval['Id'] = isset($_GET['Id']) ? $_GET['Id'] : $_POST['Id'];
    	
    	$tags = explode('_' , $pval['Id']);
            foreach($tags as $i =>$key) {
        $sql2 = "Delete from examination_details where Id='".$pval['Id']."'";
        $result2 = mysqli_query($conn,$sql2);
            }


        
        if($result2)
			{
				$string = "response_message.QuestionPaper Deletd,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.QuestionPaper not deleted,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("QuestionPaperDeletion"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	case 'QuestionPaperManage':
    	    
    	$pval['Id'] = isset($_GET['Id']) ? $_GET['Id'] : $_POST['Id'];
    	$pval['question_title'] = isset($_GET['question_title']) ? $_GET['question_title'] : $_POST['question_title'];
    	$pval['exam_question'] = isset($_GET['exam_question']) ? $_GET['exam_question'] : $_POST['exam_question'];
    	$pval['answer_option1'] = isset($_GET['answer_option1']) ? $_GET['answer_option1'] : $_POST['answer_option1'];
    	$pval['answer_option2'] = isset($_GET['answer_option2']) ? $_GET['answer_option2'] : $_POST['answer_option2'];
    	$pval['answer_option3'] = isset($_GET['answer_option3']) ? $_GET['answer_option3'] : $_POST['answer_option3'];
    	$pval['answer_option4'] = isset($_GET['answer_option4']) ? $_GET['answer_option4'] : $_POST['answer_option4'];
    	$pval['correct_answer'] = isset($_GET['correct_answer']) ? $_GET['correct_answer'] : $_POST['correct_answer'];
    	$pval['class_grade_id'] = isset($_GET['class_grade_id']) ? $_GET['class_grade_id'] : $_POST['class_grade_id'];
    	$pval['board_id'] = isset($_GET['board_id']) ? $_GET['board_id'] : $_POST['board_id'];
    	$pval['subject_id '] = isset($_GET['subject_id ']) ? $_GET['subject_id '] : $_POST['subject_id '];
    	
    	
    	$sql2 = "UPDATE examination_details SET question_title='".$pval['question_title']."',exam_question='".$pval['exam_question']."',answer_option1='".$pval['answer_option1']."',answer_option2='".$pval['answer_option2']."',answer_option3='".$pval['answer_option3']."',answer_option4='".$pval['answer_option4']."',correct_answer='".$pval['correct_answer']."',class_grade_id='".$pval['class_grade_id']."',board_id='".$pval['board_id']."',subject_id='".$pval['subject_id']."' where Id='".$pval['Id']."'";
        $result2 = mysqli_query($conn,$sql2);
        


        
        if($result2)
			{
				$string = "response_message.QuestionPaper updated,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.QuestionPaper not updated,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result2) {
					$b = explode('.', $result2);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("QuestionPaperUpdation"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	case 'AllListAPIs':
    	    
        	    
      $sql2 = "SELECT * FROM class_grade";
              $result2 = mysqli_query($conn,$sql2);
                  $array = [];
                   while($final_data2= mysqli_fetch_array($result2)){
                       
                     $Id = $final_data2['Id'];  
                     $array2 = []; 
                     $sql1 = "SELECT * FROM board_lists WHERE class_id='".$Id."'";
                     $result1 = mysqli_query($conn,$sql1);  
                      while($final_data1= mysqli_fetch_array($result1)){
                          
                          
                       $Id1 = $final_data1['Id'];  
                       $Id2 = $final_data1['class_id'];
                     $array3 = []; 
                     $sql3 = "SELECT * FROM subject_lists WHERE id_class='".$Id2."' and board_id='".$Id1."'";
                     $result3 = mysqli_query($conn,$sql3);     
                          
                      while($final_data3= mysqli_fetch_array($result3)){    
                        array_push($array3, [
                   'Id' => $final_data3['Id'],
                   'subject_name' => $final_data3['subject_name']
                    ]);
                      }  
                          
                          
                          
                    array_push($array2, [
                   'Id' => $final_data1['Id'],
                   'board_name' => $final_data1['board_name'],
                   'subject_lists' => $array3
                    ]);
                      }
                       
                       
                       
                       
                       
                       
                       
                       
                  array_push($array, [
                   'Id' => $final_data2['Id'],
                   'class_name' => $final_data2['class_name'],
                   'board_lists' => $array2
            ]);
              }
        if($result)
			{
				$string = "response_message.Grade List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Grade not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("Grade"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	case 'PasswordProtectList':
    	    
        $sql = "SELECT * FROM password_protect";
        $result = mysqli_query($conn,$sql);    
    	$array = [];    
    	while($final_data= mysqli_fetch_array($result)){
            array_push($array, [
            'Id'   => $final_data['Id'],
            'password_field' => $final_data['password_field'],
            'password_status' => $final_data['password_status']
            ]);
        }
        
        if($result)
			{
				$string = "response_message.PasswordProtect List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.PasswordProtect not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("Fees"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	case 'QuestionPaperLists':
    	    
        	    
      $sql = "SELECT * FROM examination_question";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      $array= [];
      for ($i = 1; $i <= $count; $i++) 
      {
        while($final_data= mysqli_fetch_array($result)){
            $array1 = [];
              $Id = $final_data['Id'];
              $sql1 = "SELECT * FROM examination_details WHERE question_title_id='".$Id."'";
              $result1 = mysqli_query($conn,$sql1);
              
              while($final_data1= mysqli_fetch_array($result1)){
                  array_push($array1, [
                   'Id' => $final_data1['Id'],
                   'exam_question' => $final_data1['exam_question'],
                   'answer_option1' => $final_data1['answer_option1'],
                   'answer_option2' => $final_data1['answer_option2'],
                   'answer_option3' => $final_data1['answer_option3'],
                   'answer_option4' => $final_data1['answer_option4'],
                   'correct_answer' => $final_data1['correct_answer'],
                   'question_title_id' => $final_data1['question_title_id'],
            ]);
              
            }//2nd
              
              array_push($array, [
                   'Id'   => $final_data['Id'],
                   'question_title' => $final_data['question_title'],
                   'class_grade_id' => $final_data['class_grade_id'],
                   'board_id' => $final_data['board_id'],
                   'subject_id' => $final_data['subject_id'],
                   'QuestionOption' => $array1
            ]);
          
           }//1st
      }//for 1st
        if($result)
			{
				$string = "response_message.Grade List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Grade not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("Grade"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	case 'QuestionPaperListsById':
    	    
      $pval['class_grade_id'] = isset($_GET['class_grade_id']) ? $_GET['class_grade_id'] : $_POST['class_grade_id'];
      $pval['board_id'] = isset($_GET['board_id']) ? $_GET['board_id'] : $_POST['board_id'];
      $pval['subject_id'] = isset($_GET['subject_id']) ? $_GET['subject_id'] : $_POST['subject_id'];
      
      $sql = "SELECT * FROM examination_question where (class_grade_id='".$pval['class_grade_id']."' or board_id='".$pval['board_id']."' or subject_id='".$pval['subject_id']."')";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      $array= [];
      for ($i = 1; $i <= $count; $i++) 
      {
        while($final_data= mysqli_fetch_array($result)){
            $array1 = [];
              $Id = $final_data['Id'];
              $sql1 = "SELECT * FROM examination_details WHERE question_title_id='".$Id."'";
              $result1 = mysqli_query($conn,$sql1);
              
              while($final_data1= mysqli_fetch_array($result1)){
                  array_push($array1, [
                   'Id' => $final_data1['Id'],
                   'exam_question' => $final_data1['exam_question'],
                   'answer_option1' => $final_data1['answer_option1'],
                   'answer_option2' => $final_data1['answer_option2'],
                   'answer_option3' => $final_data1['answer_option3'],
                   'answer_option4' => $final_data1['answer_option4'],
                   'correct_answer' => $final_data1['correct_answer'],
                   'question_title_id' => $final_data1['question_title_id'],
            ]);
              
            }//2nd
              
              array_push($array, [
                   'Id'   => $final_data['Id'],
                   'question_title' => $final_data['question_title'],
                   'class_grade_id' => $final_data['class_grade_id'],
                   'board_id' => $final_data['board_id'],
                   'subject_id' => $final_data['subject_id'],
                   'QuestionOption' => $array1
            ]);
          
           }//1st
      }//for 1st
        if($result)
			{
				$string = "response_message.Grade List,response_code.1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
		else
			{
				$string = "response_message.Grade not listed,response_code.-1";
				$a = explode(',', $string);
				foreach ($a as $result) {
					$b = explode('.', $result);
					$array4[$b[0]] = $b[1];
				}
				$response = $array4;
			}
        $final_data = array("Grade"=>$array, "Response" => $response);
		echo json_encode($final_data);
    	exit;
    	break;
    	
    	
    	
}        
?>
