
<?php

	include_once "connect.php";
	// $host = "localhost";
	// $db_username = "root";
	// $db_password = "";
	// $db_name = "db_demoStoreNew";


	// //establish connection to database
	// $conn = mysqli_connect($host, $db_username, $db_password, $db_name);

	// //check connection
	// if(!$conn) {
	// 	die("Connection failed: " . mysqli_error($conn));
	// }

	if (isset($_POST['email'])) {

		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = sha1($_POST['password']);

		$sql = "SELECT * FROM tbl_users WHERE username = '$username'";

		$result = mysqli_query($conn, $sql);

		$count = mysqli_num_rows($result);

		if($count) {
			echo "userExists";
		} else {

			$sql = "INSERT INTO tbl_users (last_name, first_name, email, address, username, password) VALUES ('$lname', '$fname', '$email', '$address', '$username', '$password')";

			$result = mysqli_query($conn,$sql);

			if($result) {
				echo "success";
			} else {
				echo "fail";
			}


		}
	} else {
		echo "process_register.php did not receive variables";
		var_dump($fname); die(); // NULL
	}

	
?>
