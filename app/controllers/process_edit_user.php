<?php
	session_start();
	require_once "connect.php";

	if(isset($_SESSION['id'])) {
	 	
		if (isset($_POST['password'])) :

			$id = $_POST['id'];
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$email = $_POST['email'];
			$username = $_POST['username'];
			$password = sha1($_POST['password']);

			$sql = " SELECT * FROM tbl_users WHERE `password` = '$password' AND id = $id ";

			$result = mysqli_query($conn, $sql);
			$count = mysqli_num_rows($result);

			if($count) {
				$sql = " UPDATE tbl_users SET first_name = '$fname', last_name = '$lname', email = '$email', username = '$username' WHERE id = $id ";
				$result = mysqli_query($conn,$sql);

				if($result) {
					//GET LAST ID TO BE ABLE TO BE DIRECTED TO CORRECT PROFILE PAGE WHEN UPDATE IS SUCCESSFULLY DONE.
					//$last_id = mysqli_insert_id($conn);
					echo json_encode(["id" => $id]);
					//header("Location: ../views/profile.php?id=$id");
				} else {
					echo "fail";
				}
			} else {

				echo "incorrectPassword";

			}
		} else {
			echo "process_edit_user.php did not receive variables";
		}
	endif;

		
