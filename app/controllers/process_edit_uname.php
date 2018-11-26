<?php
    session_start();
	require_once "connect.php";

    var_dump($_POST['username']); die(); //gets correct value from edit_user_modal

	if (isset($_POST['username'])) {
        $user_id = $_POST['id'];
        $username = $_POST['username']; 


        $sql = "SELECT * FROM tbl_users WHERE username = '$username'";
        
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $target_id = $row['id'];
        $count = mysqli_num_rows($result);
            if($count) {
                if($user_id == $target_id) {
                    echo "sameUser";
                } else {
                    echo "userExists";
                }
            } else {
                echo "success";
            } 
	}else {
		echo "process_edit_uname.php did not receive variable";
        
    }
    

    
