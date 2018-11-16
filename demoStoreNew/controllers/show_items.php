<?php
	// connect to database
	include_once "connect.php";

	// receive value and assign to variable
	$categoryId = $_POST['categoryId'];

	// query database using variable
	$sql= "SELECT * FROM tbl_items WHERE category_id = '$categoryId'";

	//get all results and assign to variable
	$result = mysqli_query($conn, $sql);

	$data = '';
	// loop if resuls is >=1
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)){
			$name = $row['name'];
			// $data .= "<p>$name</p>";





			$price = $row['price'];
	      	$description = $row['description'];
	      	$item_img = $row['img_path'];

	      			$data .= "
		      			<div class='col-lg-4 col-md-6 mb-5'>
		      				<div class = 'card h-700'>
		      					<img src='$row[img_path]'>
		      					<div class='card-body'>
		      						<h4 class='card-title font-weight-bold'>$name</h4>
		      						<h5 class='font-weight-bold'>&#8369; $row[price]</h5>
		      						<p>$description</p>
		      					</div>
		      					<div class='card-footer'>

		      					<input type='number' class='form-control mb-3'>

	      						<button class='btn btn-primary btn-block font-weight-bold'>
	      							<i class='fas fa-cart-plus'></i>
	      							Add to Cart
	      						</button>
		      					</div>
		      				</div>
		      			</div>";
		}
	}

	echo $data;


?>