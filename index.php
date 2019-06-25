<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Easy Calls Admin Panel</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--js-->
<script src="js/jquery-2.1.1.min.js"></script> 
<!--icons-css-->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
<!--static chart-->
</head>
<body>	
<div class="login-page">
    <div class="login-main">  	
    	 <div class="login-head">
				<h1>Login</h1>
			</div>
			<div class="login-block">
				<form method="post" action="includes/submit.php">
					<input type="text" name="admin_name" placeholder="Phone number" maxlength="10" onkeypress="return validateQty(event);">
					<input type="password" name="password" class="lock" placeholder="Password">
					
					<input type="submit" name="SignIn" value="Login">	
					
				</form>
				
			</div>
      </div>
</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>© 2019 Shoppy. All Rights Reserved | Design by  <a href="http://ultimatereach.in/" target="_blank">Ultimate Reach PVT LTD</a> </p>
</div>	
<!--COPY rights end here-->

<!--scrolling js-->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!--//scrolling js-->
<script src="js/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
<script>
    function validateQty(event) {
        var key = window.event ? event.keyCode : event.which;
        if (event.keyCode == 8 || event.keyCode == 46
            || event.keyCode == 37 || event.keyCode == 39) {
            return true;
        }
        else if ( key < 48 || key > 57 ) {
            return false;
        }
        else return true;
    };
</script>
</html>


                      
						
