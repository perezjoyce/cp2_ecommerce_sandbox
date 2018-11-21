<?php
	// connect to database
	include_once "connect.php";

	$value = $_POST['value'];

	if ($value == 'lowestToHighest') {
		$sql = "SELECT * FROM tbl_items ORDER BY price"; 
		$result = mysqli_query($conn,$sql);
		$data = '';

		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
			$name = $row['name'];
		
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

	} else {
		$sql = "SELECT * FROM tbl_items ORDER BY price DESC"; 
		$result = mysqli_query($conn,$sql);
		$data = '';

		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
			$name = $row['name'];
		
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
	}

	

	echo $data;

	// var_dump($result); die();


?>