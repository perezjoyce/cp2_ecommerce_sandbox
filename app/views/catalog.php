<?php include "../partials/header.php";?>
<?php require_once "../controllers/connect.php";?>
    <!-- Page Content -->
    <div class="container mt-5">

      <div class="row mt-5 pt-5">
   
	      <?php 
	      	
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
		      			<div class='col-lg-3 col-md-4 mb-5'>
		      				<div class = 'card h-700'>
		      					<img src='$row[img_path]'>
		      					<div class='card-body'>
		      						<h4 class='card-title font-weight-bold'>$name</h4>
		      						<h5 class='font-weight-bold'>&#8369; $row[price]</h5>
		      						<p>$description</p>
		      					</div>
		      					<div class='card-footer'>

	      						<a href='catalog2.php?id='id' type='button' class='btn btn-primary btn-block font-weight-bold'>
	      							View More
	      							<i class='fas fa-angle-right'></i>
	      						</a>
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
    