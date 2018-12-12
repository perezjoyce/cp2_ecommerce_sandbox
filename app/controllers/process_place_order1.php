<?php

    session_start(); 
    
    require_once "connect.php";

    if(isset($_SESSION['cart_session'])) {

        // $_SESSION['transaction_code'] = uniqid('', true);
        $unique_num = str_replace(".","",microtime(true)).rand(000,999);
        $unique_mix = substr(hash('sha256', mt_rand()), 0, 10);
        $_SESSION['transaction_code'] = $unique_num . " - " . $unique_mix;
        $transactionCode = $_SESSION['transaction_code'];

        $cartSession = $_SESSION['cart_session'];
        $shippingAddressId = $_POST['shippingAddressId'];
        $paymentMethod = $_POST['paymentMethod'];
        $userId = $_SESSION['id'];


        $sql = "INSERT INTO tbl_place_orders (payment_mode_id, cart_session, transaction_code, user_id, address_id) VALUES ($paymentMethod, '$cartSession', '$transactionCode', $userId, $shippingAddressId) ";
        $result = mysqli_query($conn, $sql);


        $message = "<form id='form_confirmation'>
                        
                        <label class='my-5'>Confirmation Page</label>

                        <br>

                        <label>Transaction Code</label>
                        <div class='my-5 text-danger'>$transactionCode</div>

                        <div class='mb-5'>Thank you for shopping! Your order is being processed.</div>

                    </form>";


        if($result) {

            require '../../vendor/autoload.php';
            require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
            require '../../vendor/phpmailer/phpmailer/src/Exception.php';

            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            //GET USER'S EMAIL // ===> buhayin email variable instead of querying database
            // $sql = " SELECT * FROM tbl_users WHERE user_id = $userId";
            // $result = mysqli_query($conn, $sql);
            // $row = mysqli_fetch_assoc($result);
            // $email = $row['email'];

            $staff_email = 'jpgarcia.ph@gmail.com'; // where the email is comming from // replace with admin email in the future
            $users_email =  'japerez.ph@gmail.com';//Where the email will go // replace with $email
            $email_subject = 'Order Confirmation';
            $email_body = $message;

            try{
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = $staff_email;
                $mail->Password = '8London*'; // totoong password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->setFrom($staff_email,'Company Name');
                $mail->addAddress($users_email);
                $mail->isHTML(true);
                $mail->Subject = $email_subject;
                $mail->Body = $email_body;
                $mail->send();

                echo $message;


                }catch (Exception $e){
                    echo "Sorry ".$mail->ErrorInfo;
                }

        } else {
             echo "Sorry, email not sent";
        }
        

    }
       
        


    
  