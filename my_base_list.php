<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.bootstrap.min.css" type="text/css" />
  <style>
      .datatable tfoot {
  display: table-header-group;
}

.datatable tfoot .filter-column {
  width: 100% !important;
}
.collCustomerPhone, .collID, .collCustomerAddress, .collExecutiveSummary, .collExecutiveOther, .collAddress, .collAction{
    display: none;
}
  </style>
<?php 
session_start();
if(!isset($_SESSION['login_user'])){
      header("location:index.php");
   }
include_once('includes/header.php');
include_once('includes/config.php');
$sql = "SELECT * FROM profile_details WHERE employee_phone = '".$_SESSION['login_user']."'";
$result = mysqli_query($conn,$sql);
while($final_data= mysqli_fetch_array($result)){
    $employee_type = $final_data['employee_type'];
    $employee_id = $final_data['Id'];
}
?>  
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

<div class="container">
    
    
    <div class="row">
        <div class="panel panel-primary filterable">
            <table class="datatable table table-hover table-bordered" id="example" data-plugin="dataTable" data-source="data-source" style="display: block;overflow: auto;width: 100%;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Base</th>
          <th>End_Date</th>
          <th>Account_No</th>
          <th>District</th>
          <th>FE_NAME</th>
          <th>City</th>
          <th>To_Be_Paid</th>
          <th>BILL_ZIP</th>
          <th>BTC</th>
          <th>Today_Status</th>
          <th>Today_OS</th>
          <th>Change</th>
        </tr>
      </thead>
      
      <tbody>
          <?php
            $i=0;
            $sqlnumb3 = "SELECT * FROM mybase";
	        $aqs3 = mysqli_query($conn,$sqlnumb3);
	        while($row3= mysqli_fetch_array($aqs3)){
	            $i++;
          ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $row3['Base']; ?></td>
          <td><?php echo $row3['End_Date']; ?></td>
          <td><?php echo $row3['Account_No']; ?></td>
          <td><?php echo $row3['District']; ?></td>
          <td><?php echo $row3['FE_NAME']; ?></td>
          <td><?php echo $row3['City']; ?></td>
          <td><?php echo $row3['To_Be_Paid']; ?></td>
          <td><?php echo $row3['BILL_ZIP']; ?></td>
          <td><?php echo $row3['BTC']; ?></td>
          <td><?php echo $row3['Today_Status']; ?></td>
          <td><?php echo $row3['Today_OS']; ?></td>
          <td><a href="delete_function.php?Id=<?php echo $row3['Id'];?>&delete_base=search"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></a></td>
        </tr>
        <?php
	        }
        ?>
      </tbody>
    </table>
        </div>
    </div>
</div>








</div>
<!--inner block end here-->

<?php include_once('includes/footer.php');?> 
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
  <!-- Responsive extension -->
  <script src="https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"></script>
  <!-- Buttons extension -->
  <script src="//cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
<script>
    var dataTable = $('.datatable').DataTable({
  buttons: [
    {
      extend: 'excel',
      text: 'Export to Excel',
      className: 'btn-sm btn-flat',
    },
  ],
  dom: "<'row'<'col-md-3'l><'col-md-6 text-center'B><'col-md-3'f>>" +
         "<'row'<'col-md-12'tr>>" +
         "<'row'<'col-md-5'i><'col-md-7'p>>",
  drawCallback: function(settings) {
    if (!$('.datatable').parent().hasClass('table-responsive')) {
      $('.datatable').wrap("<div class='table-responsive'></div>");
    }
  }
  
});

dataTable.columns().every(function() {
  var column = this;

  $('.filter-column', this.footer()).on('keyup change', function() {
    if (column.search() !== this.value) {
      column
        .search(this.value)
        .draw();
      this.focus();
    }
  });
  
  
  
});


$(document).ready(function() {
    
    
    
    // Setup - add a text input to each footer cell
    $('#example thead tr').clone(true).appendTo( '#example thead' );
    $('#example thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" class="coll'+title+'" placeholder="Search '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
        
    } );
 

 
     var table = $('#example').DataTable( {
         
         orderCellsTop: true,
         fixedHeader: true
     } );
     
     

   
} );

$.fn.dataTable.ext.errMode = 'none';
</script>