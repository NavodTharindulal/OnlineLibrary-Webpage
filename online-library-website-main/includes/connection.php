<?php 
	$connection = mysqli_connect('localhost', 'root', '', 'bookdb');
	// Checking the connection
	if (mysqli_connect_errno()) {
		die('Database connection failed ' . mysqli_connect_error());
	} else {
		echo "";
	}
	//set-system-timezone
	date_default_timezone_set("Asia/Colombo");
?>