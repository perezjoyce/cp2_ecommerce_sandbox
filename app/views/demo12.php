<!-- LOADCART.PHP -->
<?php session_start(); ?>

<h1>My Cart</h1>
<?php
//Database Info
$servername = "localhost";
$username = "root";
$pw = "";
$dbname = "db_demoStoreNew";

// Create connection
$conn = mysqli_connect($servername, $username, $pw, $dbname);
// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
?>
<?php
$data ='
         <table class="table table-hover">
           <thead>
             <tr>
               <th scope="col">Product</th>
               <th scope="col">Price</th>
               <th scope="col">Quantity</th>
               <th scope="col">Sub-total</th>
             </tr>
           </thead>
           <tbody>
  ';



$grand_total = 0;
foreach($_SESSION['cart'] as $id=> $quantity) {
   $sql = "SELECT * FROM tbl_items where id = '$id' ";
             $result = mysqli_query($conn, $sql);
               if(mysqli_num_rows($result) > 0){
                   while($row = mysqli_fetch_assoc($result)){
                     $name = $row["name"];
                     $description = $row["description"];
                     $price = $row["price"];

                       //For computing the sub total and grand total
                       $subTotal = $quantity * $price;
                       $grand_total += $subTotal;

                       $data .=
                         "<tr>
                             <td><img src='$row[img_path]' width='25%' height='25%'></td>
                             <td id='price$id'> $price</td>
                             <td><input type='number' class ='form-control' value = '$quantity' id='quantity$id'  min='1' size='5'></td>
                             <td class='sub-total' id='subTotal$id'>$subTotal</td>
                             <td><button class='btn btn-danger' >Remove</button></td>
                         </tr>";
                   }
               }
}

$data .="</tbody></table>
             <hr>
             <h3 align='right'>Total: &#x20B1; <span id='grandTotal'>$grand_total </span><br><button class='btn btn-success'>Check Out</button></h3>
             <hr>";
echo $data;
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="script2.js"></script>