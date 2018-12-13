<?php

	session_start(); 
	require_once "connect.php";

	if (isset($_POST['username'])) {
		$username = $_POST['username'];
		$password = sha1($_POST['password']);

		//CHECK IF USER IS REGISTERED
		$sql = "SELECT * FROM tbl_users WHERE username ='$username' AND `password` = '$password'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		$row = mysqli_fetch_assoc($result);
		$id = $row['id'];
		$username = $row['username'];
		$userType = $row['userType_id'];


		$response =[];
		if($count == 1) {

			//DECLARE USER'S SESSIONS
			$_SESSION['id'] = $id;
			$userId = $_SESSION['id'];

			//CHECK IF USER OR ADMIN
			if($userType == 2) { // 2 = admin
				$response = ['status' => 'adminLoggedIn', 'id' => $id];
			} else {
				$response = ['status' => 'loggedIn', 'id' => $id];

				// CHECK IF CART HAS ITEMS
				$cartSession = $_SESSION['cart_session'];
				$sql = "SELECT * FROM tbl_carts WHERE cart_session = '$cartSession' ";
				$result = mysqli_query($conn, $sql);

				// UPDATE THE CART WITH THE USER'S ID UPON LOGIN
				if($result) {
					$sql = "UPDATE tbl_carts SET user_id = $userId WHERE cart_session= '$cartSession'";
					$result = mysqli_query($conn, $sql);
				}else {
					$sql = "INSERT INTO tbl_carts (user_id, cart_session) VALUES (userId, '$cartSession')";
					$result = mysqli_query($conn, $sql);
				}
			}


		} else {
			$response = ['status' => 'loginFailed', 'message' => 'Login Failed'];
		}

	} else {
		$response = ['status' => 'noUsernameProvided', 'message' => 'Username not provided.'];
	}



	echo json_encode($response);