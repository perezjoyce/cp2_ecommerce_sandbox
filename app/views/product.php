<?php include "../partials/header.php";?>
<?php require_once "../controllers/connect.php";?>


    <!-- PAGE CONTENT -->
   
    <div class="container-fluid">

      <div class="row pt-5 mt-5">
   
        <?php 
            // kunin yung pinasa na value ng catalog2.php
            $id = $_GET['id'];
            

            $sql = "SELECT * FROM tbl_items WHERE id = $id";

            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
               
                $name = $row['name'];     
                $price = $row['price'];
                $description = $row['description'];
                $item_img = $row['img_path'];

                   
            echo "
              <div class='container d-inline-flex'>

               

                  <div class='d-flex flex-row mr-3'>
                      <img src='$item_img'>
                  </div>
               
                  <div class='d-flex flex-row'>
                    <div class='d-flex flex-column'>
                      <h4 class='card-title font-weight-bold'>$name</h4>
                      <h5 class='mb-5'>&#8369; $price</h5>
                      <h5 class='my-5'>$description</h5>
                   
                      <button class='btn btn-primary btn-block font-weight-bold'>
                        <i class='fas fa-cart-plus'></i>
                        Add to Cart
                      </button>
                    </div>
                     
                  </div>

               
              </div>";
             

         

        ?>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

  