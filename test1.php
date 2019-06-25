<?php
//include_once('includes/config.php');
define("API_KEY", "AIzaSyAVESA3O6ilWwM60YmumzwjbWDStUQbN6c");
$sqlnumb = "SELECT * FROM client_location,team_leader WHERE client_location.employee_id=team_leader.employee_id and client_location.team_leader_id=team_leader.Id and client_location.team_leader_id='".$Id."'";
	        $aqs = mysqli_query($conn,$sqlnumb);
	        while($row= mysqli_fetch_array($aqs)){
	            $start_address = $row['start_address'];
	            $current_address = $row['current_address'];
	            $customer_address = $row['customer_address'];
	        }
//$addresses = ["20, point nagar, Annamalai Nagar, Chidambaram, Tamil Nadu 608002, India","66, R.G. Nagar, Ramanathapuram, Coimbatore, Tamil Nadu 641045, India","Unnamed Road, Nagama Naicken Palayam, Tamil Nadu 641016, India"];
$addresses = [".$start_address.", ".$current_address.",".$customer_address."];
?>
<html>
<head>
<title>Draw Path on Google Map using Javascript API</title>
<style>
#map-layer {
	max-width: 900px;
	min-height: 550px;
}
</style>
</head>
<body>
	<div id="map-layer"></div>
	<script>
      	var map;
		var pathCoordinates = Array();
      	function initMap() {
        	  	var countryLength
            	var mapLayer = document.getElementById("map-layer"); 
            	var centerCoordinates = new google.maps.LatLng(10.9683466, 77.0645669);
        		var defaultOptions = { center: centerCoordinates, zoom: 8 }
        		map = new google.maps.Map(mapLayer, defaultOptions);
        		geocoder = new google.maps.Geocoder();
        		
        	    <?php
            if (! empty($addresses)) {
            ?>
            countryLength = <?php echo count($addresses); ?>
            <?php
                foreach ($addresses as $address)
                {
            ?>  
             	geocoder.geocode( { 'address': '<?php echo $address; ?>' }, function(LocationResult, status) {
        				if (status == google.maps.GeocoderStatus.OK) {
        					var latitude = LocationResult[0].geometry.location.lat();
        					var longitude = LocationResult[0].geometry.location.lng();
        					pathCoordinates.push({lat: latitude, lng: longitude});
        					
    						new google.maps.Marker({
                    	        position: new google.maps.LatLng(latitude, longitude),
                    	        map: map,
                    	        title: '<?php echo $address; ?>'
                    	    });
                    	    
        					if(countryLength == pathCoordinates.length) {
            					drawPath();
        					}
        			        
        				} 
        			});
        	    <?php
                }
            }
            ?>	
      	}
        	function drawPath() {
            	new google.maps.Polyline({
                  path: pathCoordinates,
                  geodesic: true,
                  strokeColor: '#FF0000',
                  strokeOpacity: 1,
                  strokeWeight: 4,
                  map: map
            });
        }
	</script>
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=<?php echo API_KEY; ?>&callback=initMap">
    </script>
</body>
</html>