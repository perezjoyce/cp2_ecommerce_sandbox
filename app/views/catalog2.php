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
	       
			      	$bool = false;
	                
	               	if(!$id || $result === $bool) {

	                	echo "<h1 class='my-5'>Categories</h1>";
	               	} else {
	               		$row = mysqli_fetch_assoc($result);
	                	$name = $row['name']; 
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
				      				<button class='list-group-item' onclick='showCategories($id) id=$id'>
				      				
				      					<a href='catalog2.php?id=$id'>
				      						$name
				      					</a>

				      				</button>
			      				</div>";

			      		}


			      	}

		     ?>

		     <!-- PRICE INPUT -->
		     	<div class='mt-5'>
		     		<h4 class='mb-2'>PRICE</h4>
		     		<!-- <input type='number' class='form-control'> -->
		     	</div>
			
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
				    <label class="input-group-text" for="inputGroupSelect01">&#8369;</label>
				  </div>
				  <select class="custom-select" id="priceRange">
				    <option selected>......</option>
				 
				    <option value="lowestToHighest"> Lowest to Highest </option>
				    <option value="highestToLowest"> Highest to Lowest </option>
				  
				  </select>
				</div>
			</div>



			
		
			 <!-- END OF LEFT COLUMN -->


			<div class="col-lg-9">

				<div class="row">
				
					<div class="input-group input-group-lg my-5">
					  
					  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" id="search">

					  <div class="input-group-append">
					    <span class="input-group-text" id="inputGroup-sizing-lg">
					    	<i class="fas fa-search"></i>
					    </span>
					  </div>

					</div>
				</div>

	

				<!-- DIPLAYS PRODUCTS -->
				<div class="row" id="products">

   
			        <?php 

			   		  $id = $_GET['id'];
			          //make sql statement to select all columns in tbl_items
			          $sql = "SELECT * FROM tbl_items";

			          //get data and assign to result variable
			          $result = mysqli_query($conn,$sql);

			          //check if may laman and if meron saka ka magloop
			          if(mysqli_num_rows($result) > 0){
			            //put result in associative array and assign to row variable
			            while($row = mysqli_fetch_assoc($result)){
			            	$id = $row['id'];
			              	$name = $row['name'];
			              //test. if it works, proceed to assign other columns to  variables
			              // echo $name . "<br>";
			              $price = $row['price'];
			              $description = $row['description'];
			              $img_path = $row['img_path'];

			              echo "
			              <div class='col-lg-3 col-md-3 mb-5 mx-1 text-center'>
			                <div class = 'card h-700'>
			                  <img src='$img_path'>
			                  <div class='card-body'>
			                    <h4 class='card-title font-weight-bold'>
			                    	<a href='product.php?id=$id'>
			                    		$name
			                    	</a>
			                    </h4>
			                    <h5>&#8369; $price</h5>
			                    
			                  </div>
			                  <div class='card-footer'>

			                  

			                  <button class='btn btn-primary btn-block font-weight-bold'>
			                    <i class='fas fa-search'></i>
			                    View Product
			                  </button>
			                  </div>
			                </div>
			              </div>";
			            }
			          }

			        ?>
  
			    
			    </div>
		      


			</div>
			<!-- /. RIGHT COLUMN -->


		</div>
		<!-- /.row -->
		
	</div>
	<!-- /.container -->

	


<?php include "../partials/footer.php";?>