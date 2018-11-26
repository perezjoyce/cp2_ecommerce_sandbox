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
			$id= $row['id'];
			$name = $row['name'];
			$price = $row['price'];
	      	$item_img = $row['img_path'];

			  $data .= "
			  <div class='col-lg-4 col-md-6 mb-5'>
				<a href='product.php?id=$id'>
					<div class = 'card h-700'>
						<img src='$item_img'>
						<div class='card-body'>
							<div class='font-weight-bold'>
									$name
								
							</div>
							<div>&#8369; $row[price]</div>
						</div>
					</div>
				</a>
			</div>";
		}
	}

	echo $data;


?>