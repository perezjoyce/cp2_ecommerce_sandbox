<?php require_once "../../config.php";?>
<?php require_once "../partials/admin_header.php";?>
<?php require_once "../controllers/connect.php";?>
<?php require_once "../controllers/functions.php";?>

<div class="container border">
	<?php 

	// tbl_place_orders, tbl_carts, tbl_users
	// SELECT t1.title, t2.title, t3.title FROM table1 t1 JOIN table2 t2 JOIN table3 t3 ON t1.foreign_key = t2.primary_key AND t2.foreign_key = t3.primary_key;

		$sql = "SELECT ";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		$
		$count = mysqli_num_rows($result);

		if($count) {
			while($row){

			}
		}
  		
	?>
</div>

<?php require_once "../partials/footer.php";?>
<?php require_once "../partials/modal_container.php";?>