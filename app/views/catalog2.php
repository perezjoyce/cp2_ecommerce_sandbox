<?php include "../partials/header.php";?>
<?php require_once "../controllers/connect.php";?>


<!-- PAGE CONTENT -->
	<div class="container my-5">

		<div class="row">
			
			<!-- first col -->
			<div class="col-lg-3">
				<!-- <h1 class='mt-3'>Categories</h1> -->

				<?php 

					// DISPLAYING CATEGORY ON TOP OF LIST GROUP
					$id = $_GET['id'];
			      
			      	$sql = "SELECT * FROM tbl_categories WHERE id = $id";
			      	$result = mysqli_query($conn,$sql);
	            	$row = mysqli_fetch_assoc($result);
	               
	                $name = $row['name']; 

	               	if(!$id || $row === true || $row ===false || !$result) {

	                	echo "<h1 class='my-5'>Categories</h1>";
	               	} else {
	               		echo "<h1 class='my-5'>$name</h1>";
	               	}

			      			

		      		// DISPLAYING ALL AVAILABLE CATEGORIES
		      		$sql = "SELECT * FROM tbl_categories";
		      		$result = mysqli_query($conn,$sql);

		      
			      	if(mysqli_num_rows($result) > 0){
			      		
			      		while($row = mysqli_fetch_assoc($result)){
			      			$name = $row['name'];
			      			$id = $row['id'];
			      			
			      				echo 
			      				"<div class='list-group'>
				      				<a href='catalog2.php?id=$id' class='list-group-item' onclick='showCategories($id)'>
				      				
				      					$name

				      				</a>
			      				</div>";

			      		}


			      	}

		     ?>
				
			</div>
			 <!-- END OF LEFT COLUMN -->


			<div class="col-lg-9">
				

				<!-- copy paste from catalog.php -->
				<div class="row" id="products">


		   
			      <?php 
			      	
			      	$id = $_GET['id'];
			      	$sql = "SELECT * FROM tbl_items WHERE category_id = $id";
			      	$result = mysqli_query($conn,$sql);

			       	if(mysqli_num_rows($result) > 0){
			      		//put result in associative array and assign to row variable
			      		while($row = mysqli_fetch_assoc($result)){
			      			$id = $row['id'];
			      			$name = $row['name'];
			      			$price = $row['price'];
			      			$description = $row['description'];
			      			$item_img = $row['img_path'];

			      			echo "
				      			<div class='col-lg-4 col-md-6 mt-5'>
				      				<div class = 'card h-700'>
				      					<img src='$item_img'>
				      					<div class='card-body'>
				      						<h4 class='card-title font-weight-bold'>
				      							<a href='product.php?id=$id'>$name</a>
				      						</h4>
				      						<h5 class='font-weight-bold'>&#8369; $price</h5>
				      						<p>$description</p>
				      					</div>
				      					<div class='card-footer'>

				      					<input type='number' class='form-control mb-3'>

			      						<a href='cart.php?id=$id' type='button' class='btn btn-primary btn-block font-weight-bold'>
			      							<i class='fas fa-cart-plus'></i>
			      							Add to Cart
			      						</a>
				      					</div>
				      				</div>
				      			</div>";


			      		}
			      	} else {
			      		echo "hey";
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
					$('#products').html('');
					// $('#products').html(data);
				}
			})
		}

</script>



<?php include "../partials/footer.php";?>