<?php 

session_start(); 
require_once "../../controllers/connect.php";
require_once "../../controllers/functions.php";

if(isset($_SESSION['id'])) {

    // $userId = $_SESSION['id'];
	$cartSession = $_SESSION['cart_session'];

    // $sql = " INSERT INTO tbl_carts (user_id, cart_session) VALUES ($userId, '$cartSession') WHERE cart_session = '$cartSession' ";
    // $result = mysqli_query($conn, $sql);
    
    $sql = "SELECT c.*, p.stocks, p.img_path, p.name, p.price, p.id as productId
    FROM tbl_carts c 
    JOIN tbl_items p on p.id=c.item_id 
    WHERE cart_session='" . $cartSession. "'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

} else {
	// direct to login modal
	header("Location: login_modal.php");
}
?>


<form action="../controllers/process_checkout.php" method="POST" id="form_checkout">
    
    <label class="my-5">CHECK OUT PAGE</label>

    <table class="table table-bordered mb-5">

	    <tr id="table-header">
	        <th> Item </th>
	        <th> Unit Price </th>
	        <th> Quantity </th>
	        <th> Final Price </th>

	    </tr>


     <?php
        
        $totalPrice = 0;
      
        if($count) :
            while($row = mysqli_fetch_assoc($result)){ 
                $id =  $row['productId'];
                $name = $row['name'];
                $price = $row['price'];
                money_format('#8369', $price);
                $quantity = $row['quantity'];
                $image = $row['img_path'];
                $totalPrice = $totalPrice + ($price * $quantity);
                money_format('#8369',$totalPrice);
    ?>
     
        <tr>
   
            <td> 
                <?= $name ?>
                <br>
                <img class="unitImage" src="<?= $image ?>" style='width:50px;height:50px;'> 
            </td>
            <td>&#8369; <span class="unitPrice<?= $id ?>"> <?= $price ?> </span> </td>
            <td> <?= $quantity ?> </td>
            <td>&#8369; <span class="totalPrice<?= $id ?>"> <?= $price * $quantity ?> </span> </td>
           
        </tr>
        <?php 
            }
        endif;
        ?>

    </table>

     <table class="table table-bordered mb-5">

        <tr>
            <th>Order Summary</th>
            <td colspan="4"> <span class="subtotalAmount font-weight-bold text-danger"> &#8369; <?= $totalPrice ?></span> </td>
        </tr>

    </table>

    <label class='font-weight-bold'>Shipping Address</label>
     <?php 
        $userId = $_SESSION['id'];
        $sql = "SELECT * FROM tbl_addresses WHERE user_id = $userId "; 
             $result = mysqli_query($conn, $sql);
             $count = mysqli_num_rows($result);

            if(!$count) {
    ?>

            <input type='text' id='shipping_address' class='form-control'>
            <select class="custom-select" id="address_type">
                <option value='home'>home</option>
                <option value='office'>office</option>
            </select>
            
    <?php } else { ?>


            <select class="custom-select mb-5" id="paymentMethod">
    <?php 
             while($row = mysqli_fetch_assoc($result)){ 
                    $id =  $row['id'];
                    $name = $row['name'];
            
            echo "<option class='$addressType' value='$id'>$name .', '. $addressType</option>";
   

    } } ?>
        </select> 



        <label class='font-weight-bold mt-5'>Payment Method</label>
        <select class="custom-select mb-5" id="paymentMethod">

         <?php $sql = "SELECT * FROM tbl_payment_modes "; 
             $result = mysqli_query($conn, $sql);
             while($row = mysqli_fetch_assoc($result)){ 
                    $id =  $row['id'];
                    $name = $row['name'];
    
		      echo "<option value='$id'>$name</option>";

         } ?>
		</select>


	 </div>
       


    <p id="checkout_error_message"></p>

    <!-- if input type is submit, this will automatically submit input to users.php hence change this to button, type to button and remove value SO THAT you can employ validation -->
    <!-- indicate id for button -->
    <!-- upon submission, bawas total quantity to stocks left -->
    <div class='d-flex flex-row'>
    	<a  class="btn btn-outline-success mb-5 mr-3 flex-grow-1" id="btn_place_order" data-userId='<?= $userId ?>' data-id='<?= $cartSession ?>' data-url='#'>SUBMIT</a>

    	<a  class="btn btn-outline-primary modal-link mb-5" id="btn_checkout" data-id='<?= $cartSession ?>' data-url='../partials/templates/cart_modal.php'>BACK</a>
    </div>
    

    <!-- <button type="button" class="btn btn btn-block btn-outline-success mb-5" data-toggle="modal" data-target="#checkout_modal2">CHECK OUT</button> -->

</form>


