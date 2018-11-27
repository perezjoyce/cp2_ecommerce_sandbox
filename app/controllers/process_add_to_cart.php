<?php

session_start(); 
require_once "connect.php";

if (isset($_POST['id'])) {

    $item_id = $_POST['item_id'];
    $item_quantity = $POST['item_quantity'];

	$sql = " SELECT * FROM tbl_items WHERE id = $item_id ";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    //FETCH PRODUCT DETAILTS
    $id = $row['id'];
    $name = $row['name'];
    $price = $row['price'];
    $image = $row['img_path'];

	$response =[];
	if($count == 1) {
		// SESSION
        $_SESSION['id'] = $item_id; 
        $sql = " INSERT INTO tbl_carts (item_id, quantity) VALUES ($item_id, $item_quantity) ";
        $result = mysqli_query($conn, $sql);
        
		// $response = ['id' => $id, 'name' => $name, 'image' => $image, 'price'];

	} else {
		$response = ['id' => '', 'name' => 'No products added', 'image' => DEFAULT_PRODUCT_IMG ];
	}

} 

echo json_encode($response);