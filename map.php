<!DOCTYPE html>
<html>
<head>
	<title>Leaflet mobile example</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<link rel="stylesheet" href="leaflet.css" />

	<script src="leaflet.js"></script>

	<style>
		body {
			padding: 0;
			margin: 0;
		}
		html, body, #map {
			height: 100%;
		}
	</style>
</head>
<body>
	<style>
	
	.css-icon {

	}

	.gps_ring {	
		border: 3px solid #999;
		 -webkit-border-radius: 30px;
		 height: 18px;
		 width: 18px;		
	    -webkit-animation: pulsate 1s ease-out;
	    -webkit-animation-iteration-count: infinite; 
	    /*opacity: 0.0*/
	}
	
	@-webkit-keyframes pulsate {
		    0% {-webkit-transform: scale(0.1, 0.1); opacity: 0.0;}
		    50% {opacity: 1.0;}
		    100% {-webkit-transform: scale(1.2, 1.2); opacity: 0.0;}
	}
	</style>
	<?php
	$address = "[50.5, 30.5]";
	?>
	<div id="map"></div>

	<script>
		var map = L.map('map').setView([51.505, -0.09], 13);

		// create a tile layer sourced from mapbox
		L.tileLayer('https://{s}.tiles.mapbox.com/v4/christianjunk.e3e05ee8/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiY2hyaXN0aWFuanVuayIsImEiOiJkMjIzMzRjNzBlNjc1OWUxYmE0NzBjNzQ3MWNiYTNkMyJ9.q4y4NMEwFYGRZdSEfPBg7A').addTo(map);	

		L.marker(<?php echo $address; ?>).addTo(map);

		map.setView(<?php echo $address; ?>);

		// Define an icon called cssIcon
		var cssIcon = L.divIcon({
		  // Specify a class name we can refer to in CSS.
		  className: 'css-icon',
		  html: '<div class="gps_ring"></div>'
		  // Set marker width and height
		  ,iconSize: [22,22]
		  // ,iconAnchor: [11,11]
		});

		// Create three markers and set their icons to cssIcon
		L.marker(<?php echo $address; ?>, {icon: cssIcon}).addTo(map);
		
              infowindow.setContent('fg');
              infowindow.open(map, this);
            
	</script>
</body>
</html>
