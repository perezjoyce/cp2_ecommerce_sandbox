<?php
// ================= ERROR MESSAGE WHEN INPUT FIELDS ARE LEFT BLANK ===============
// ================= ERROR WHEN REQUIRED LENGHT OF USERNAME IS NOT MET ===============

	require_once "connect.php";

	if(isset($_POST['username'])) {
		$username = $_POST['username'];
		$password = sha1($_POST['password']);

		$sql = "SELECT * FROM tbl_users WHERE username ='$username'";
		$result = mysqli_query($con, $sql);
		$count = mysqli_num_rows($result);
		
			if($count) {
				echo "userExists";
			} else {
				$sql = "INSERT tbl_users (username) VALUES ('$username')";
				$result = mysqli_query($con,$sql);

				if($result) {
					echo "success";
				} else {
					echo "fail";
				}
			}
		}

	

