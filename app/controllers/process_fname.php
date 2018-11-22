<?php
// ================= ERROR MESSAGE WHEN INPUT FIELDS ARE LEFT BLANK ===============
// ================= ERROR WHEN REQUIRED LENGHT OF USERNAME IS NOT MET ===============

	include_once "connect.php";


	$fname = $_POST['fname'];

	$sql = "INSERT tbl_users (first_name) VALUES ('$fname')";
	$result = mysqli_query($con,$sql);

	if($result) {
		echo "success";
	} else {
		echo "fail";
	}


?>
