<?php

	session_start(); 
	require_once "connect.php";

	if (isset($_POST['username'])) {
		$username = $_POST['username'];
		$password = sha1($_POST['password']);

		$sql = "SELECT * FROM tbl_users WHERE username ='$username' AND `password` = '$password'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		$row = mysqli_fetch_assoc($result);
		$id = $row['id'];
		$username = $row['username'];

		$response =[];
		if($count == 1) {
			// SESSION
			$_SESSION['id'] = $id; 
			$response = ['status' => 'loggedIn', 'id' => $id];

		} else {
			$response = ['status' => 'loginFailed', 'message' => 'Login Failed'];
		}

	} else {
		$response = ['status' => 'noUsernameProvided', 'message' => 'Username not provided.'];
	}

	echo json_encode($response);