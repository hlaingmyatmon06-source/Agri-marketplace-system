<?php
	$conn=mysqli_connect("localhost","root","","tradingsystem")or die("cann't connect to database");

	if (!$conn){
		echo "connection failed!";
		exit();
	}
?>