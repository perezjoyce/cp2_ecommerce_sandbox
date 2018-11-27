<?php

session_start(); 
require_once "connect.php";

if (isset($_POST['productId'])) {

    $id = $_POST['productId'];
    @$quantity = $_POST['quantity'];

    //UPDATE THE ITEMS FOR SESSION CART VARIABLE
    $_SESSION['cart'][$id] = $quantity;
    $_SESSION['item_count'] = array_sum($_SESSION["cart"]);

    $count = "
        <span class='badge badge-primary text-light'>
        ". $_SESSION['item_count']."</span>";


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
 //        $_SESSION['id'] = $id; 
 //        $sql = " INSERT INTO tbl_carts (item_id, quantity) VALUES ($productId, $quantity) ";
 //        $result = mysqli_query($conn, $sql);
        
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
        echo $count;

} 





