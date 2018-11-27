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
    
  ?>


<form action="../controllers/process_add_to_cart.php" method="POST" id="form_cart">
    
    <label class="my-5">Your Shopping Cart</label>

    <table class="table table-bordered">
        <tr>
            <th> Item </th>
            <th> Unit Price </th>
            <th> Quantity </th>
            <th> Total Price </th>
            <th> Action </th>

        </tr>

        <tr>
            <td> 
                <?= $name ?>
                <br>
                <img src="<?= $image ?>" style='width:50px;height:50px;'> 
            </td>
            <td> <?= $price ?> </td>
            <td> <input type="number" style='width:50px;' id='priceQuantity' value='1'></td>
            <td> <?= $price ?> </td>
            <td> Delete </td>
        </tr>

    </table>

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