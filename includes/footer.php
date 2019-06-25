<!--copy rights start here-->
<div class="copyrights">
	 <p>© 2019 Easy Calls. All Rights Reserved | Design by  <a href="http://ultimatereach.in/" target="_blank">Ultimate Reach PVT LTD</a> </p>
</div>	
<!--COPY rights end here-->
</div>
</div>
<!--slider menu-->
    <div class="sidebar-menu">
		  	<div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span> 
			      <!--<img id="logo" src="" alt="Logo"/>--> 
			  </a> </div>		  
		    <div class="menu">
		      <ul id="menu" >
		        
		        <li><a href="#"><i class="fa fa-users"></i><span>Employee</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul>
		            <li><a href="registration.php">Registration</a></li>
		            <li><a href="profile_list.php">List Employee</a></li>		            
		          </ul>
		        </li>
		        
		        <li><a href="#"><i class="fa fa-cogs"></i><span>Location Details</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul>
		            <li><a href="location_add.php">Location Add</a></li>
		            <li><a href="location_list.php">List Location</a></li>		            
		          </ul>
		        </li>
		        <li><a href="attendance_status.php"><i class="fa fa-clock-o"></i><span>Attendance Status</span></a></li>
		        <li><a href="client_job.php"><i class="fa fa-map-marker"></i><span>Location Status</span></a></li>
		         <li><a href="#"><i class="fa fa-cogs"></i><span>Executive Details</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul>
		            <li><a href="exec_details_add.php">Details Add</a></li>
		            <li><a href="exec_details_list.php">List Details</a></li>		            
		          </ul>
		        </li>
		        <li><a href="exec_details_list.php"><i class="fa fa-file"></i><span>Reports</span></a>
		          
		        </li>
		        <li><!--<a href="map_distance_test.php"><i class="fa fa-file"></i><span>Map Distance</span></a>-->
		          <a href="test_map.php"><i class="fa fa-file"></i><span>Map Distance</span></a>
		        </li>
		        <li><a href="#"><i class="fa fa-cogs"></i><span>MY Base</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul>
		            <li><a href="my_base_upload.php">MY Base Upload</a></li>
		            <li><a href="my_base_list.php">List MY Base</a></li>		            
		          </ul>
		        </li>
		        
		        
		        
		      </ul>
		    </div>
	 </div>
	<div class="clearfix"> </div>
</div>
<!--slide bar menu end here-->
<script>
var toggle = true;
            
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }               
                toggle = !toggle;
            });
</script>
<!--scrolling js-->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!--//scrolling js-->
<script src="js/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html> 