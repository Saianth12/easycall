<?php
	$servername = "localhost";
	$username = "sssdneer_dneers";
	$password = 'DneersCom@123_$';
	$dbname = "sssdneer_mobileapp";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?>
