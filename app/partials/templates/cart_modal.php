<?php 

    session_start(); 
    require_once "../../controllers/connect.php";

    @$id = $_SESSION['id'];
    
    $sql = "SELECT * FROM tbl_items WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    while(@$row = mysqli_fetch_assoc($result)){ 
      $name = $row['name'];
      $price = $row['price'];
      $description = $row['description'];
      $image = $row['img_path'];
    }
    
  ?>


<form action="../controllers/process_add_to_cart.php" method="POST" id="form_cart">
    
    <label class="my-5">Your Shopping Cart</label>

    <table class="table table-bordered">
        <tr id="table-header">
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
                <img class="unitImage" src="<?= $image ?>" style='width:50px;height:50px;'> 
            </td>
            <td>&#8369; <span class="unitPrice"> <?= $price ?> </span> </td>
            <td> <input class='itemQuantity' type="number" style='width:50px;' value="1" min="1" max="99" onKeyUp="if(this.value>99){this.value='99';}else if(this.value<1){this.value='1';}"</td>
            <td>&#8369; <span class="totalPrice"> <?= $price ?> </span> </td>
            <td> Delete </td>
        </tr>

    </table>

    <table class="table table-bordered mb-5">

        <tr>
            <th>Total</th>
            <td colspan="4"> &#8369;<span class="subtotalAmount"></span> </td>
        </tr>

    </table>
    


    <p id="error_message"></p>

    <!-- if input type is submit, this will automatically submit input to users.php hence change this to button, type to button and remove value SO THAT you can employ validation -->
    <!-- indicate id for button -->
    <button type="button" class="btn btn-block btn-outline-success mb-5" id="btn_checkout">CHECKOUT</button>

</form>