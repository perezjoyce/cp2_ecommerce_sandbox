<?php 
    // TO DISPLAY CURRENT USER DATA
    require_once "../../controllers/connect.php";

    $id = $_GET['id'];
    
    $sql = "SELECT * FROM tbl_items WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){ 
      $name = $row['name'];
      $price = $row['price'];
      $description = $row['description'];
      $image = $row['img_path'];
    }

      echo "$name";
      echo "<br>";
      echo "$price";
      echo "<br>";
      echo "<img src='$image'  style='width:100px;height:100px;'>";
    
  ?>


<form action="../controllers/process_add_to_cart.php" method="POST" id="form_cart">
    
    <label class="my-5">Your Shopping Cart</label>

    <div class="form-group">
        <label>Username</label>
        <!-- change name to id -->
        <input type="text" class="form-control" id="username" name="username" autocomplete="username">
        <p class="validation text-danger"></p>
    </div>

    <div class="form-group mb-5">
        <label>Passworssdsdd</label>
        <input type="password" class="form-control" id="password" name="password" autocomplete="password">
        <p class="validation text-danger"></p>
    </div>

    <p id="error_message"></p>

    <!-- if input type is submit, this will automatically submit input to users.php hence change this to button, type to button and remove value SO THAT you can employ validation -->
    <!-- indicate id for button -->
    <button type="button" class="btn btn-block btn-outline-success mb-5" id="btn_checkout">CHECKOUT</button>

</form>