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

	$word = strtolower($_POST['word']);

	$sql = "SELECT * FROM tbl_items WHERE name LIKE '%".$word."%'";
	$result = mysqli_query($conn,$sql);
	$data = '';
	if(mysqli_num_rows($result) > 0){

		while($row = mysqli_fetch_assoc($result)){
			$data .= "$row[name]";
		}
	} else {
		$data = "No records found!";
	}

	echo $data;


?>