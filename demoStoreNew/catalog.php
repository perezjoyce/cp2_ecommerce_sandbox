<?php include "partials/header.php";?>

    <!-- Page Content -->
    <div class="container mt-5">

      <div class="row">
   
	      <?php 
	      	//connect to database
	      	require "controllers/connect.php";

	      	//make sql statement to select all columns in tbl_items
	      	$sql = "SELECT * FROM tbl_items";

	      	//get data and assign to result variable
	      	$result = mysqli_query($conn,$sql);

	      	//check if may laman and if meron saka ka magloop
	      	if(mysqli_num_rows($result) > 0){
	      		//put result in associative array and assign to row variable
	      		while($row = mysqli_fetch_assoc($result)){
	      			$name = $row['name'];
	      			//test. if it works, proceed to assign other columns to  variables
	      			// echo $name . "<br>";
	      			$price = $row['price'];
	      			$description = $row['description'];
	      			$item_img = $row['img_path'];

	      			echo "
		      			<div class='col-lg-3 mb-5'>
		      				<div class = 'card h-700'>
		      					<img src='$row[img_path]'>
		      					<div class='card-body'>
		      						<h4 class='card-title'>$row[name]</h4>
		      						<h5>&#8369; $row[price]</h5>
		      						<p>$row[description]</p>
		      					</div>
		      					<div class='card-footer'>

		      					<input type='number' class='form-control mb-3'>

	      						<button class='btn btn-primary btn-block'>Add to Cart</button>
		      					</div>
		      				</div>
		      			</div>";


	      		}
	      	}

	      	?>
	      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

   <!-- Footer -->
    <?php //include "partials/footer.php" ;?>