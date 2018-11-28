function loadCart(){
	// get because we're going to retrieve something
	// loadCart.php
	$.get("demo12.php", function(data){
		$("#loadCart").html(data);
	});
}

$(document).ready(function(){
	loadCart();
});