<?php 

    session_start(); 
    require_once "../../controllers/connect.php";

    $cartSession = $_SESSION['cart_session'];
    
    $sql = " SELECT * FROM tbl_place_orders ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    

    $transactionCode = $row['transaction_code'];
    // $status = $_row['cartSessionId'];
    // $shippingAddress = $_POST['shippingAddress'];
    // $paymentMethod = $_POST['paymentMethod'];
    // $userId = $_SESSION['id'];
?>

<form id="form_confirmation">
    
    <label class="my-5">Confirmation Page</label>

    <br>

    <label>Transaction Code</label>
    <div class="mb-5 text-danger"><?= $transactionCode ?></div>

    <div class="mb-5">Thank you for shopping! Your order is being processed.</div>

    
    <a  class="btn btn-block btn-outline-success modal-link mb-5" data-url='index.php'>CLOSE</a>

</form>

<?php require_once "../modal_container.php"; ?>

<!-- Modal -->
<!-- <div class="modal fade" id="checkout_modal2" role="dialog">
<div class="modal-dialog">

