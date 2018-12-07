<?php

// no need fot this. work directly on checkot_modal.php

    session_start(); 
    
    require_once "connect.php";

    if(isset($_SESSION['cart_session'])) {
        $_SESSION['transaction_code'] = uniqid();

        $transactionCode = $_SESSION['transaction_code'];

        // var_dump($transactionCode); die();
        $cartSessionId = $_POST['cartSessionId'];
        $shippingAddress = $_POST['shippingAddress'];
        $paymentMethod = $_POST['paymentMethod'];
        $userId = $_SESSION['id'];


        $sql = " INSERT INTO tbl_place_orders ( purchase_date, payment_method, transaction_code, user_id, cart_id, status_id ) VALUES ( now(), '$paymentMethod', '$transactionCode', $userId, $cartSessionId, 1 ) ";
        $result = mysqli_query($conn, $sql);

        $data = 
        "<form id='form_confirmation'>
    
            <label class='my-5'>Confirmation Page</label>

            <br>

            <label>Transaction Code</label>
            <div class='my-5'>$transactionCode</div>

            <div class='mb-5'>Thank you for shopping!</div>

            <a  class='btn btn-block btn-outline-success modal-link mb-5' data-url='index.php'>CHECK OUT</a>

        </form>";

    }
       
        


    
  