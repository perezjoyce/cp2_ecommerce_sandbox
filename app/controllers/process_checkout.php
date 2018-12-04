<?php

// no need fot this. work directly on checkot_modal.php

    session_start(); 
    require_once "connect.php";

    if (isset($_POST['cartSessionId'])) :

        $cartSession = $_POST['cartSessionId'];
        // $userId = $_SESSION['id'];

        $sql = " SELECT * FROM tbl_carts WHERE cart_session='$cartSession'";
    	$result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        
        if($count) {
            $sql = " SELECT * FROM tbl_carts WHERE cart_session='$cartSession SUM(price)";
            $result = mysqli_query($conn, $sql);
        } 

        // var_dump($count); die();
        // echo $count;


    endif;





