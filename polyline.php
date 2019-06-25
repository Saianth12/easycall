<?php
 session_start();
$Id = $_REQUEST['Id'];
 if(!isset($_SESSION['login_user'])){
       header("location:index.php");
  }
 include_once('includes/header.php');
 include_once('includes/config.php');
 
 $sqlnumb1 = "SELECT * FROM wholeday_tracking WHERE employee_id='".$Id."'";
 $aqs1 = mysqli_query($conn,$sqlnumb1);
 while($row1= mysqli_fetch_array($aqs1)){
     $current_location_lat = $row1['emp_lat'];
	 $current_location_long = $row1['emp_lang'];
	 
	 $address1 .= "{lat: ".$current_location_lat.", lng: ".$current_location_long."}".",";
 }
	        
	        $address = "[".$address1."]";
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