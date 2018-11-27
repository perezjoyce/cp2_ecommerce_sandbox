<?php
session_start(); 
require_once "connect.php";

$cartSession = $_SESSION['cart_session'];
$quantity = $_POST['quantity'];
$productId = $_POST['productId'];
$sql = " UPDATE tbl_carts SET quantity=$quantity WHERE cart_session='$cartSession' AND item_id=$productId";
$result = mysqli_query($conn, $sql);