<?php
// ================= ERROR MESSAGE WHEN INPUT FIELDS ARE LEFT BLANK ===============
// ================= ERROR WHEN REQUIRED LENGHT OF USERNAME IS NOT MET ===============

	include_once "connect.php";


	$lname = $_POST['lname'];
	
	$sql = "INSERT tbl_users (last_name) VALUES ('$lname')";
	$result = mysqli_query($con,$sql);

	if($result) {
		echo "success";
	} else {
		echo "fail";
	}


?>
