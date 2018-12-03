<?php
    session_start(); 
    require_once "connect.php";

    if (isset($_POST['productId'])) :

        $cartSession = $_SESSION['cart_session'];
        $productId = $_POST['productId'];

        $sql = " SELECT * FROM tbl_carts WHERE cart_session='$cartSession' AND item_id=$productId ";
    	$result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if($count) {
            $row = mysqli_fetch_assoc($result);
            $sql = " DELETE FROM tbl_carts WHERE cart_session='$cartSession' AND item_id=$productId ";
            $result = mysqli_query($conn, $sql);

            echo $result;
        } 

    endif;