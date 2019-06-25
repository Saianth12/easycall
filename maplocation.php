<?php
 session_start();
$Id = $_REQUEST['Id'];
 if(!isset($_SESSION['login_user'])){
       header("location:index.php");
  }
 include_once('includes/header.php');
 include_once('includes/config.php');
 
 $sqlnumb1 = "SELECT * FROM current_location WHERE Id='".$Id."'";
 $aqs1 = mysqli_query($conn,$sqlnumb1);
 while($row1= mysqli_fetch_array($aqs1)){
     $current_location_lat = $row1['current_lat'];
	 $current_location_long = $row1['current_lang'];
	 $client_id = $row1['client_id'];
	 $emp_id = $row1['employee_id'];
 }
  $sqlnumb2 = "SELECT * FROM client_location WHERE Id='".$client_id."'";
 $aqs2 = mysqli_query($conn,$sqlnumb2);
 while($row2= mysqli_fetch_array($aqs2)){
     $start_location_lat = $row2['start_location_lat'];
	 $start_location_long = $row2['start_location_long'];
 }
   $sqlnumb3 = "SELECT * FROM team_leader WHERE employee_id='".$emp_id."'";
 $aqs3 = mysqli_query($conn,$sqlnumb3);
 while($row3= mysqli_fetch_array($aqs3)){
     $end_location_lat = $row3['end_location_lat'];
	 $end_location_long = $row3['end_location_long'];
 }
 
 
//  $sqlnumb = "SELECT * FROM client_location,team_leader WHERE client_location.employee_id=team_leader.employee_id and client_location.team_leader_id=team_leader.Id and client_location.team_leader_id='".$Id."'";
// 	        $aqs = mysqli_query($conn,$sqlnumb);
// 	        while($row= mysqli_fetch_array($aqs)){
// 	            $start_location_lat = $row['start_location_lat'];
// 	            $start_location_long = $row['start_location_long'];
// 	            $current_location_lat = $row['current_location_lat'];
// 	            $current_location_long = $row['current_location_long'];
// 	            $end_location_lat = $row['end_location_lat'];
// 	            $end_location_long = $row['end_location_long'];
// 	        }
	        
	        $address = "[{lat: ".$start_location_lat.", lng: ".$start_location_long."},{lat: ".$current_location_lat.", lng: ".$current_location_long."},{lat: ".$end_location_lat.", lng: ".$end_location_long."}]";
?>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>

      // This example creates a 2-pixel-wide red polyline showing the path of
      // the first trans-Pacific flight between Oakland, CA, and Brisbane,
      // Australia which was made by Charles Kingsford Smith.

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: 10.9683466, lng: 77.0645669},
          mapTypeId: 'terrain'
        });

        var flightPlanCoordinates = <?php echo $address; ?>;
        var flightPath = new google.maps.Polyline({
          path: flightPlanCoordinates,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        flightPath.setMap(map);
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVESA3O6ilWwM60YmumzwjbWDStUQbN6c&callback=initMap">
    </script>
<?php include_once('includes/footer.php');?> 