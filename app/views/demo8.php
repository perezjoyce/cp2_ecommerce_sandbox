<?php

//set values
	$host = "localhost";
	$db_username = "root";
	$db_password = "";
	$db_name = "db_demoStoreNew";


	//establish connection to database
	$conn = mysqli_connect($host, $db_username, $db_password, $db_name);
	if(!$conn){
		die("Connection failed:"  .  mysqli_error($conn));
	}

	$email = $_POST['email'];
	$data = "";

	$sql = "SELECT * FROM tbl_users WHERE email = '$email'";

	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)){
			$data = "emailExists";
		}
	}else {
		$data = "emailAvailable";
	}

	echo $data;

?>