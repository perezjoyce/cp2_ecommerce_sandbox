<?php include_once "../partials/header.php";?>
<?php require_once "../controllers/connect.php";?>

    <!-- PAGE CONTENT -->
    <div class="container">
    
        <div class="jumbotron">
          <h1 class="display-4">Hello, world!</h1>
          <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
          <hr class="my-4">
          <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
          <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </div>
  
    </div>

    <div class="container">
      <!-- PRODUCTS -->
      <div class="row">
        
      <?php 

        $sql = " SELECT * FROM tbl_items LIMIT 12 ";
        $result = mysqli_query($conn,$sql);

        //CHECK IF THERE'S DATA
        if(mysqli_num_rows($result) > 0){
          //CREATE A ROW VARIABLE
          while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $name = $row['name'];
            $price = $row['price'];
            $description = $row['description'];
            $item_img = $row['img_path'];
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
          <a href="product.php?id=<?= $id ?>">
            <div class = 'card h-700'>
              <img class='card-img-top' src="<?= $item_img ?>" > 
              <div class="card-body">
                <div class='font-weight-bold'>
                  <?= $name ?>
                </div>
                <div>&#8369; <?= $price ?> </div>
              </div>
            </div>
          </a>
        </div>
             
      <?php }} ?>

      </div>
      <!-- /.PRODUCTS -->

      <!-- LOAD MORE PRODUCTS -->
      <a href="catalog2.php" class="btn btn-outline-secondary btn-block py-2 mt-5">VIEW MORE PRODUCTS</a>
     
    </div>
    <!-- /.PAGE CONTENT -->

<?php include_once "../partials/footer.php";?>

<!-- MODAL -->
<?php include_once "../partials/modal_container.php"; ?>