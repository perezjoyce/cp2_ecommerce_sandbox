<?php

	include_once "connect.php";

	if (isset($_POST['email'])) {
        $user_id = $_POST['id'];
        $email = $_POST['email']; 

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		 	echo "invalidEmail";
		} else {

          $sql = "SELECT * FROM tbl_users WHERE email = '$email'";
          
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          $target_id = $row['id'];

		  $count = mysqli_num_rows($result);
				if($count) {
                    if($user_id == $target_id) {
                        echo "sameEmail";
                    } else {
                        echo "emailExists";
                    }
				} else {
					echo "success";
				} 
		}
	} else {
		echo "process_email.php did not receive variable";
		//var_dump($email); die(); //NULL
	}