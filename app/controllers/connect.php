<?php

	//set values
	$host = "localhost";
	$db_username = "root";
	$db_password = "";
	$db_name = "db_demoStoreNew";


	//establish connection to database
	$conn = mysqli_connect($host, $db_username, $db_password, $db_name);

	//check connection
	if(!$conn) {
		die("Connection failed: " . mysqli_error($conn));
	}