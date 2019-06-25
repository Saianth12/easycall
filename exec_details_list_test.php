<?php 
session_start();
include_once('includes/config.php');
//print $_SESSION['login_user'];
$sql = "SELECT * FROM profile_details WHERE employee_phone = '".$_SESSION['login_user']."'";
$result = mysqli_query($conn,$sql);
while($final_data= mysqli_fetch_array($result)){
    $employee_type = $final_data['employee_type'];
    $employee_id = $final_data['Id'];
}
// if(!isset($_SESSION['login_user'])){
//       header("location:index.php");
//   }
//include_once('includes/header.php');

?>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--js-->
<script src="js/jquery-2.1.1.min.js"></script> 
<!--icons-css-->
<link href="css/font-awesome.css" rel="stylesheet">
                <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
        width: 1200px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
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
  <script>
  
  function searchResult(str) {
      //alert(str);
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
        //alert(this.responseText);
      document.getElementById("teaml").value=this.responseText;
    }
  }
  xmlhttp.open("GET","map_dis_disp.php?q="+str,true);
  xmlhttp.send();
}
</script>
<link rel="stylesheet" href="http://localhost/test/leaflet.css" />

	<script src="http://localhost/test/leaflet.js"></script>
<body>	
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
            <!--header start here-->
				<div class="header-main">
					<div class="header-left">
							<div class="logo-name">
									 <a href="#"> <h2>Easy Calls</h2> 
									<!--<img id="logo" src="" alt="Logo"/>--> 
								  </a> 								
							</div>
							<!--search-box-->
								<div class="search-box">
									<form>
										<input type="text" placeholder="Search..." required="">	
										<input type="submit" value="">					
									</form>
								</div><!--//end-search-box-->
							<div class="clearfix"> </div>
						 </div>
						 <div class="header-right">
							<div class="profile_details_left"><!--notifications of menu start -->
								<ul class="nofitications-dropdown">
									<li class="dropdown head-dpdn">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">3</span></a>
										<ul class="dropdown-menu">
											<li>
												<div class="notification_header">
													<h3>You have 3 new messages</h3>
												</div>
											</li>
											<li><a href="#">
											   <div class="user_img"><img src="images/p4.png" alt=""></div>
											   <div class="notification_desc">
												<p>Lorem ipsum dolor</p>
												<p><span>1 hour ago</span></p>
												</div>
											   <div class="clearfix"></div>	
											</a></li>
											<li class="odd"><a href="#">
												<div class="user_img"><img src="images/p2.png" alt=""></div>
											   <div class="notification_desc">
												<p>Lorem ipsum dolor </p>
												<p><span>1 hour ago</span></p>
												</div>
											  <div class="clearfix"></div>	
											</a></li>
											<li><a href="#">
											   <div class="user_img"><img src="images/p3.png" alt=""></div>
											   <div class="notification_desc">
												<p>Lorem ipsum dolor</p>
												<p><span>1 hour ago</span></p>
												</div>
											   <div class="clearfix"></div>	
											</a></li>
											<li>
												<div class="notification_bottom">
													<a href="#">See all messages</a>
												</div> 
											</li>
										</ul>
									</li>
									<li class="dropdown head-dpdn">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">3</span></a>
										<ul class="dropdown-menu">
											<li>
												<div class="notification_header">
													<h3>You have 3 new notification</h3>
												</div>
											</li>
											<li><a href="#">
												<div class="user_img"><img src="images/p5.png" alt=""></div>
											   <div class="notification_desc">
												<p>Lorem ipsum dolor</p>
												<p><span>1 hour ago</span></p>
												</div>
											  <div class="clearfix"></div>	
											 </a></li>
											 <li class="odd"><a href="#">
												<div class="user_img"><img src="images/p6.png" alt=""></div>
											   <div class="notification_desc">
												<p>Lorem ipsum dolor</p>
												<p><span>1 hour ago</span></p>
												</div>
											   <div class="clearfix"></div>	
											 </a></li>
											 <li><a href="#">
												<div class="user_img"><img src="images/p7.png" alt=""></div>
											   <div class="notification_desc">
												<p>Lorem ipsum dolor</p>
												<p><span>1 hour ago</span></p>
												</div>
											   <div class="clearfix"></div>	
											 </a></li>
											 <li>
												<div class="notification_bottom">
													<a href="#">See all notifications</a>
												</div> 
											</li>
										</ul>
									</li>	
									<li class="dropdown head-dpdn">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">9</span></a>
										<ul class="dropdown-menu">
											<li>
												<div class="notification_header">
													<h3>You have 8 pending task</h3>
												</div>
											</li>
											<li><a href="#">
												<div class="task-info">
													<span class="task-desc">Database update</span><span class="percentage">40%</span>
													<div class="clearfix"></div>	
												</div>
												<div class="progress progress-striped active">
													<div class="bar yellow" style="width:40%;"></div>
												</div>
											</a></li>
											<li><a href="#">
												<div class="task-info">
													<span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
												   <div class="clearfix"></div>	
												</div>
												<div class="progress progress-striped active">
													 <div class="bar green" style="width:90%;"></div>
												</div>
											</a></li>
											<li><a href="#">
												<div class="task-info">
													<span class="task-desc">Mobile App</span><span class="percentage">33%</span>
													<div class="clearfix"></div>	
												</div>
											   <div class="progress progress-striped active">
													 <div class="bar red" style="width: 33%;"></div>
												</div>
											</a></li>
											<li><a href="#">
												<div class="task-info">
													<span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
												   <div class="clearfix"></div>	
												</div>
												<div class="progress progress-striped active">
													 <div class="bar  blue" style="width: 80%;"></div>
												</div>
											</a></li>
											<li>
												<div class="notification_bottom">
													<a href="#">See all pending tasks</a>
												</div> 
											</li>
										</ul>
									</li>	
								</ul>
								<div class="clearfix"> </div>
							</div>
							<!--notification menu end -->
							<div class="profile_details">		
								<ul>
									<li class="dropdown profile_details_drop">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<div class="profile_img">	
												<span class="prfil-img"><img src="images/p1.png" alt=""> </span> 
												<div class="user-name">
													
													<span>Administrator</span>
												</div>
												<i class="fa fa-angle-down lnr"></i>
												<i class="fa fa-angle-up lnr"></i>
												<div class="clearfix"></div>	
											</div>	
										</a>
										<ul class="dropdown-menu drp-mnu">
											<li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
											<li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li> 
											<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
										</ul>
									</li>
								</ul>
							</div>
							<div class="clearfix"> </div>				
						</div>
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

<div class="row mb40">
					<div class="col-md-6">
						
							<div class="signup-block">

				<form method="post" action="#">
					<?php
					$sql2 = "SELECT * FROM profile_details WHERE employee_type = '2'";
                    $result2 = mysqli_query($conn,$sql2);
                    ?>
                    <select name="position"  required="" onchange="searchResult(this.value)">
					    <option value="">--Select Employee--</option>
					    <?php
					    while($final_data2 = mysqli_fetch_array($result2)){
					    ?>
					    <option value="<?php echo $final_data2['Id']; ?>"><?php echo $final_data2['employee_name']; ?></option>
                        <?php } ?>
					</select>
					<input type="date" name="datefiled" id="datefiled">
					<input type="hidden" id="teaml" name="teaml">
					<div class="col-md-12">
					    <div class="col-md-3">
					<input type="submit" value="Distance" name="submit">
					</div>
					<div class="col-md-3">
					<input type="submit" value="Live" name="submit1">
					</div>
					</div>
				</form>
					
				<?php
				if (isset($_POST['submit'])){
				    $datef = explode('-',$_POST['datefiled']);
				    $datefil = $datef[2]."-".$datef[1]."-".$datef[0];
				    $sql3 = "SELECT * FROM executive_details WHERE employee_id='".$_POST['teaml']."' and executive_time like '%".$datefil."%' and `executive_location_long` NOT IN ('')";
                    $result3 = mysqli_query($conn,$sql3);
                    while($final_data3 = mysqli_fetch_array($result3)){
                    $executive_location_lat = $final_data3['executive_location_lat'];
                    $executive_location_long = $final_data3['executive_location_long'];
                    $addr = "{lat: ".$executive_location_lat.", lng: ".$executive_location_long."}";
                    $address1 .= "{lat: ".$executive_location_lat.", lng: ".$executive_location_long."},";
                    
                    $rety[] = $executive_location_lat.','.$executive_location_long.',';
                }
                $address2 = "[".$address1."]";
                $address = "[{lat: -33.923036, lng: 151.259052},{lat: -33.890542, lng: 151.274856},{lat: -34.028249, lng: 151.157507},{lat: -33.950198, lng: 151.259302},]";
				
				
				
				for($i=0;$i<count($rety);$i++){
				    
				    $key = array_slice($rety, $i, 2);
				    

				    $kayv = $key[0];
				    $keyval = explode(',',$kayv);
				    $kayval = $key[1];
				    $keyvalue = explode(',',$kayval);
				    $lat1 = $keyval[0];
                    $lon1 = $keyval[1];
                    $lat2 = $keyvalue[0];
                    $lon2 = $keyvalue[1];
                    

                    $theta = $lon1 - $lon2;
                    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                    $dist = acos($dist);
                    $dist = rad2deg($dist);
                    $miles= $dist * 60 * 1.1515;
                    $unit = 'K';
                    $km   = $miles*1.609344;
                    $ret[] = number_format($km,1);
                    
				}
				
				//print_r($ret);
				?>
				<h2>Distance: <?php echo array_sum($ret); ?> KM</h2>
				<div id="map"></div>
                <script>
                    function initMap() {
                        var ger = document.getElementById("teaml").value;
                    var map = new google.maps.Map(document.getElementById('map'), {
                      zoom: 15,
                      center: <?php echo $addr; ?>,
                      mapTypeId: 'terrain'
                    });
            
                    var flightPlanCoordinates = <?php echo $address2; ?>;
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
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVESA3O6ilWwM60YmumzwjbWDStUQbN6c&callback=initMap"></script>
                
				
				<?php } 
				if (isset($_POST['submit1'])){
			$sql2 = "SELECT * FROM current_location WHERE employee_id = '".$_POST['teaml']."' ORDER BY Id desc limit 0,1";
            $result2 = mysqli_query($conn,$sql2);
            while($final_data2 = mysqli_fetch_array($result2)){
              $address1 =   $final_data2['current_lat'];
              $address2 =   $final_data2['current_lang'];
            }
			$address = "[$address1, $address2]";
				}
				?>
				<div id="map"></div>

	<script>
		var map = L.map('map').setView(<?php echo $address; ?>, 13);

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
		
              infowindow.setContent('text');
              infowindow.open(map, this);
            
	</script>
				
				
</div>
						
					</div>
					
</div>








</div>
<!--inner block end here-->
<?php include_once('includes/footer.php');?>