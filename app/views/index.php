<?php include "../partials/header.php";?>
<?php require_once "../controllers/connect.php";?>


    <!-- Page Content -->
    <div class="container-fluid px-0">

      <!-- Jumbotron Header -->
      <header class="jumbotron my-4">
        <h1 class="display-3">A Warm Welcome!</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
        <a href="#" class="btn btn-primary btn-lg">Call to action!</a>
      </header>

        <!-- Page Content -->
    <div class="container-fluid mt-5">

      <div class="row">
   
        <?php 
          //make sql statement to select all columns in tbl_items
          $sql = "SELECT * FROM tbl_items LIMIT 4";

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
              <div class='col-lg-3 col-md-3 mb-5 text-center'>
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
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark fixed-bottom">
      <div class="container">
        <p class="m-0 text-center text-white font-weight-bold">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
