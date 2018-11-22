<?php

// ================= ERROR MESSAGE WHEN INPUT FIELDS ARE LEFT BLANK ===============
// ================= ERROR MESSAGE WHEN EMAIL HAS WRONG FORMAT ===============
include_once "connect.php";

$email = $_POST['email'];

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $sql = "SELECT * FROM tbl_users WHERE email ='$email'";
  $result = mysqli_query($con, $sql);
	$count = mysqli_num_rows($result);
		if($count) {
			echo "emailExists";
		} else {
			$sql = "INSERT INTO tbl_users (email) VALUES ('$email)";
			$result = mysqli_query($con,$sql);

			if($result) {
				echo "success";
			} else {
				echo "fail";
			}
		}
} else {
  echo "invalidEmail";
}


?>
