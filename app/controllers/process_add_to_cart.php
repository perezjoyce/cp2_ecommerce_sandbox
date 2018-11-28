<?php

session_start(); 
require_once "connect.php";

if (isset($_POST['productId'])) {

    $cartSession = $_SESSION['cart_session'];
    $productId = $_POST['productId'];

    $quantity = 1;
    $sql = " SELECT * FROM tbl_carts WHERE cart_session='$cartSession' AND item_id=$productId";
	$result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    
    if($count) {
        $row = mysqli_fetch_assoc($result);
        $quantity = $row['quantity'] + 1;
        $sql = " UPDATE tbl_carts SET quantity=$quantity WHERE cart_session='$cartSession'";
        $result = mysqli_query($conn, $sql);
    } else {
        $sql = " INSERT INTO tbl_carts ( dateCreated, item_id, quantity, cart_session) VALUES (now(), $productId, $quantity, '$cartSession') ";
        $result = mysqli_query($conn, $sql);
    }

    $sql = " SELECT * FROM tbl_carts WHERE cart_session='$cartSession'";
	$result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    // var_dump($count); die();
    echo $count;

    

    // $count = "
    //     <span class='badge badge-primary text-light'>
    //     ". $_SESSION['item_count']."</span>";


	// $sql = " SELECT * FROM tbl_items WHERE id = $id ";
	// $result = mysqli_query($conn, $sql);
	// $count = mysqli_num_rows($result);
 //    $row = mysqli_fetch_assoc($result);
 //    //FETCH PRODUCT DETAILTS
 //    $id = $row['id'];
 //    $name = $row['name'];
 //    $price = $row['price'];
 //    $image = $row['img_path'];

	// $response = [];
	// if($count == 1) {
	// 	// SESSION
        // $sql = " INSERT INTO tbl_carts (item_id, quantity) VALUES ($productId, $quantity) ";
        // $result = mysqli_query($conn, $sql);
        
	// 	$response = ['id' => $productId, 
 //                    'name' => $name, 
 //                    'image' => $image, 
 //                    'price' => $price, 
 //                    'quantity' => $quantity, 
 //                    'count' => $count
 //                    ];



	// } else {
	// 	$response = ['id' => '', 'name' => 'No products added', 'image' => DEFAULT_PRODUCT_IMG, 'quantity' => ''];

	// }

    // echo json_encode($response);
    //echo $count;
} 





