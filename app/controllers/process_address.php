<?php
// ================= ERROR MESSAGE WHEN INPUT FIELDS ARE LEFT BLANK ===============
// ================= ERROR WHEN REQUIRED LENGHT OF USERNAME IS NOT MET ===============
	session_start();
	require_once "connect.php";

	if(isset($_SESSION['id'])) :
		
		$address = $_POST['address'];
		// $password = sha1($_POST['password']);

		$sql = "INSERT tbl_users (address) VALUES ('$address')";
		$result = mysqli_query($con,$sql);

		if($result) {
			echo "success";
		} else {
			echo "fail";
		}
	endif;


?>
