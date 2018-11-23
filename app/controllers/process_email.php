<?php

	include_once "connect.php";

	if (isset($_POST['email'])) {
	$email = $_POST['email'];
	

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		 	echo "invalidEmail";
		} else {

		  $sql = "SELECT * FROM tbl_users WHERE email = '$email'";
		  $result = mysqli_query($conn, $sql);
		  $count = mysqli_num_rows($result);
				if($count) {
					echo "emailExists";
				} else {
					echo "success";
				} 
		}
	} else {
		echo "process_email.php did not receive variable";
		var_dump($email); die(); //NULL
	}
	


?>


<!-- if($result) {
		header("Location: index.php");
	}
 -->