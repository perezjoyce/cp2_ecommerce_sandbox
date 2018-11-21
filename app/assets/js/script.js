$(document).ready(()=> {

	
	function showCategories(categoryId) {
			// alert(categoryId);
		$.ajax({
			url: "../controllers/show_items.php",
			method: "POST",
			data: {categoryId:categoryId},
			success: (data) => {
				$('#products').html('');
				$('#products').html(data);
			}
		})
	}

	$("#id").click(function(){
  		let categoryId = $(this).val();

  		//AJAX
  		//parameters: saan ibabato, ano ibabato, what will happen afterwards
  		$.post("../controllers/show_items2.php", {categoryId:categoryId},function(data){
  			$('#products').html('');
  			$("#products").html(data);
  		})
  	});

  	
  	$("#search").keyup(function(){
  		let word = $(this).val();

  		//AJAX
  		//parameters: saan ibabato, ano ibabato, what will happen afterwards
  		$.post("../controllers/search_items.php", {word:word},function(data){
  			$('#products').html('');
  			$("#products").html(data);
  		})
  	});


  	$("#priceRange").click(function(){
  		let value = $(this).val();

  		//AJAX
  		//parameters: saan ibabato, ano ibabato, what will happen afterwards
  		$.post("../controllers/search_price.php", {value:value},function(data){
  			$('#products').html('');
  			$("#products").html(data);
  		})
  	});
 
 




});