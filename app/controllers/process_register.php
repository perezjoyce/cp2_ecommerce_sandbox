
<?php

	include_once "connect.php";

		// STEP 1: FETCH ALL DATA COMING FROM REGISTER.PHP using global variables
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = sha1($_POST['password']);

		$sql = "SELECT * FROM tbl_users WHERE username ='$username'";

		$result = mysqli_query($con, $sql);

		$count = mysqli_num_rows($result);

		if($count) {
			echo "userExists";
		} else {

			$sql = "INSERT INTO tbl_users (first_name, last_name, email, address, username, password) VALUES ('$fname', '$lname', '$address', '$email', '$username', '$password')";

			$result = mysqli_query($con,$sql);

			if($result) {
				echo "success";
			} else {
				echo "fail";
			}


		}





		

	
?>
