<?php
include_once('config.php');


$pval['teaml_id'] = isset($_GET['teaml_id']) ? $_GET['teaml_id'] : $_POST['teaml_id'];
    	//$pval['exc_date'] = isset($_GET['exc_date']) ? $_GET['exc_date'] : $_POST['exc_date'];
        $sql = "SELECT * FROM profile_details WHERE teaml_id='".$pval['teaml_id']."'";
      $result = mysqli_query($conn,$sql);
      
      
      while($final_data= mysqli_fetch_array($result)){
          $id[] = $final_data['Id'];
      }
     
      for($x=0;$x<sizeof($id);$x++){
          $sql3 = "SELECT * FROM team_leader,executive_details WHERE team_leader.Id=executive_details.team_leader_id and executive_details.employee_id='".$id[$x]."' and executive_details.dispo_code!='PAID'";
          $result3 = mysqli_query($conn,$sql3) or die(mysqli_error());
          $count[] = mysqli_num_rows($result3);
          
      }
      print $comt = array_sum($count);
      $numrows = $comt;

$rowsperpage = 10;
 

$totalpages = ceil($numrows / $rowsperpage);
 

if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
$currentpage = (int) $_GET['currentpage'];
} else {
$currentpage = 1;  // default page number
}
 

if ($currentpage > $totalpages) {

$currentpage = $totalpages;
}

if ($currentpage < 1) {

$currentpage = 1;
}
$offset = ($currentpage - 1) * $rowsperpage;

/*$array= [];
for($x=0;$x<sizeof($id);$x++){
$sql2 = "SELECT * FROM team_leader,executive_details WHERE team_leader.Id=executive_details.team_leader_id and executive_details.employee_id='".$id[$x]."' and executive_details.dispo_code!='PAID' LIMIT $offset, $rowsperpage";
          $result2 = mysqli_query($conn,$sql2) or die(mysqli_error());
           
          while($final_data1= mysqli_fetch_array($result2)){
          array_push($array, [
                   'Id' => $final_data1['Id'],
                   'customer_name' => $final_data1['customer_name'],
                   'customer_phone' => $final_data1['customer_phone'],
                   'customer_accno' => $final_data1['customer_accno'],
                   'dispo_code' => $final_data1['dispo_code'],
                   'executive_summary' => $final_data1['executive_summary'],
                   'executive_other' => $final_data1['executive_other'],
                   'executive_time' => $final_data1['executive_time'],
                   'executive_transtype' => $final_data1['executive_transtype'],
                   
            ]);
      }
}
*/
$sql = "SELECT * FROM profile_details WHERE teaml_id='".$pval['teaml_id']."'";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      $array= [];
      for ($i = 1; $i <= $count; $i++) 
      {
        while($final_data= mysqli_fetch_array($result)){
            $array1 = [];
              $Id = $final_data['Id'];
              
             
              $sql1 = "SELECT * FROM team_leader,executive_details WHERE team_leader.Id=executive_details.team_leader_id and executive_details.employee_id='".$Id."' and executive_details.dispo_code!='PAID' LIMIT $offset, $rowsperpage";
              
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
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
 
 
?>