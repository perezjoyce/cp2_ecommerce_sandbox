<?php
// ================= ERROR MESSAGE WHEN INPUT FIELDS ARE LEFT BLANK ===============
// ================= ERROR WHEN REQUIRED LENGHT OF USERNAME IS NOT MET ===============

	include_once "connect.php";

	$password = sha1($_POST['password']);

	$sql = "INSERT tbl_users (password) VALUES ('$password')";
	$result = mysqli_query($con,$sql);

	if($result) {
		echo "success";
	} else {
		echo "fail";
	}

?>
