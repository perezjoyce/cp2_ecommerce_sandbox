<?php include "partials/header.php";?>

<!-- PAGE CONTENT -->
	<div class="container">

		<div class="row">
			
			<!-- first col -->
			<div class="col-lg-3">
				<h1 class="mt-3">Categories</h1>
				<div class="list-group mt-5">
					

			<?php 
		      	//connect to database
		      	require "controllers/connect.php";

		      	//make sql statement to select all columns in tbl_items
		      	$sql = "SELECT * FROM tbl_categories";

		      	//get data and assign to result variable
		      	$result = mysqli_query($conn,$sql);

		      	//check if may laman and if meron saka ka magloop
		      	if(mysqli_num_rows($result) > 0){
		      		//put result in associative array and assign to row variable
		      		while($row = mysqli_fetch_assoc($result)){
		      			$name = $row['name'];
		      			$id = $row['id'];
		      			//test. if it works, proceed to assign other columns to  variables
		      			// echo $name . "<br>";

		      				// $sql2 = "SELECT * FROM tbl_items";
		      				// $result2 = mysqli_query($conn,$sql2);
		      				// $row2 = mysqli_fetch_assoc($result2);
		      				// $id2 = $row2['id'];

		      				echo 
		      				"<a href='#' class='list-group-item' onclick='showCategories($row[id])'>
		      				
		      					<h4>$name</h4>

		      				</a>";

		      		}


		      	}

		     ?>


				</div>
			</div>


			<!-- second col -->
			<div class="col-lg-9">
				<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">

					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					</ol>

				<div class="carousel-inner" role="listbox">
				
					<div class="carousel-item active">
						<img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
					</div>
					
					<div class="carousel-item">
						<img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
					</div>
					
					<div class="carousel-item">
						<img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
					</div>
				
				</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>



			<!-- copy paste from catalog.php -->
			<div class="row" id="products">


	   
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
			      			<div class='col-lg-4 col-md-6 mb-5'>
			      				<div class = 'card h-700'>
			      					<img src='$item_img'>
			      					<div class='card-body'>
			      						<h4 class='card-title font-weight-bold'>$name</h4>
			      						<h5 class='font-weight-bold'>&#8369; $price</h5>
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

		      	?>
		     </div>
	      	<!-- /.row -->




			</div>
			<!-- end of second col -->


		</div>
		<!-- /.row -->
		
	</div>
	<!-- /.container -->


<script type="text/javascript">
	
	function showCategories(categoryId) {
			// alert(categoryId);
			$.ajax({
				url: "controllers/show_items.php",
				method: "POST",
				data: {categoryId:categoryId},
				dataType: "text",
				success: (data) => {
					$('#products').html(data);
				}
			})
		}

</script>



<?php include "partials/footer.php";?>