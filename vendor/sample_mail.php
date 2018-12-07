<?php

//this does not work

session_start();
require 'autoload.php';
require 'phpmailer/phpmailer/src/PHPMailer.php';
require 'phpmailer/phpmailer/src/Exception.php';
require 'autoload.php';

$mail = new PHPMailer\PHPMailer\PHPMailer(true);

$staff_email = 'csp2@gmail.com'; // where the email is comming from
$users_email =  'jldparaiso@gmail.com';//Where the email will go
$email_subject = 'CSP2 Order Confirmation';
$email_body = '<h3>Reference Number: 11122313454654 - 1213135</h3>';

try{
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = $staff_email;
	$mail->Password = 'test_1234';
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;
	$mail->setFrom($staff_email,'Company Name');
	$mail->addAddress($users_email);
	$mail->isHTML(true);
	$mail->Subject = $email_subject;
	$mail->Body = $email_body;
	$mail->send();

	echo "<form id='form_confirmation'>
            
            <label class='my-5'>Confirmation Page</label>

            <br>

            <label>Transaction Code</label>
            <div class='my-5'>$transactionCode</div>

            <div class='mb-5'>Thank you for shopping! Your order is being processed.</div>

            <a  class='btn btn-block btn-outline-success modal-link mb-5' data-url='index.php'>CHECK OUT</a>

        </form>";


}catch(Exception $e){
	echo 'Sorry '.$mail->ErrorInfo;
}



?>