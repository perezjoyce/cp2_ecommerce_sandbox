<?php include_once "../partials/header.php";?>
<?php require_once "../controllers/connect.php";?>

    <!-- PAGE CONTENT -->
    <div class="container">

        <!-- JUMBOTRON -->
        <header class="jumbotron mb-5">
          <h1 class="display-3">A Warm Welcome!</h1>
          <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
          <a href="#" class="btn btn-primary btn-lg">Call to action!</a>
        </header>
        <!-- /JUMBOTRON -->

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
              <img src="<?= $item_img ?>" > 
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