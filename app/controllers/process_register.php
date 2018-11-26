<?php

	require_once "connect.php";
	
	//CHECK IF DATA WAS FETCHED
	if (isset($_POST['email'])) {

		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = sha1($_POST['password']);

		$sql = "SELECT * FROM tbl_users WHERE username = '$username'";

		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);

		if($count) {
			echo "userExists";
		} else {

			$sql = "INSERT INTO tbl_users (last_name, first_name, email, username, `password`) 
			VALUES ('$lname', '$fname', '$email', '$username', '$password')";

			$result = mysqli_query($conn,$sql);

			if($result) {
				//GET LAST ID TO BE ABLE TO BE DIRECTED TO CORRECT PROFILE PAGE WHEN REGISTRATION IS SUCCESSFULLY DONE.
				$last_id = mysqli_insert_id($conn);
				echo json_encode(["id" => $last_id]);
			} else {
				echo "fail";
			}

		}
	} else {
		echo "process_register.php did not receive variables";
	}

	
