$(document).ready( () => {

	// SHOWING ITEMS THAT CORRESPOND TO THE SELECTED CATEGORY
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

	// DISPLAYING WISHLIST
	// prob: can i manipulate the contents of this wishlist since it is just echoed?
	$("#btn_view_wishList").on("click",function(){
		let userId = $(this).attr("data-id");

		$.ajax({
			url: "wishlist.php",
			method: "POST",
			data: {userId:userId},
			success: (data) => {
				$('#main-wrapper').html('');
				$('#main-wrapper').html(data);
			}
		})
			
	});

  	// SEARCH BAR
  	$("#search").keyup(function(){
  		let word = $(this).val();

  		//AJAX
  		//parameters: saan ibabato, ano ibabato, what will happen afterwards
  		$.post("../controllers/search_items.php", {word:word},function(data){
  			$('#products').html('');
  			$("#products").html(data);
  		})
  	});

	
	//ARRANGING ITEMS ACCORDING TO PRICE
  	$(document).on("change", "#priceOrder", function(){
  		let value = $(this).val();

  		//AJAX
  		$.post("../controllers/search_price.php", {value:value},function(data){
  			$("#products").html(data);
  		})
	});

	
	


	// ROUNDING OFF
	function round(value, exp) {
		if (typeof exp === 'undefined' || +exp === 0)
		  return Math.round(value);
	  
		value = +value;
		exp = +exp;
	  
		if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
		  return NaN;
	  
		// Shift
		value = value.toString().split('e');
		value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));
	  
		// Shift back
		value = value.toString().split('e');
		return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
	}



  	
    // REGISTRATION
	$("#btn_register").click(()=>{
		
		//get values
		let fname = $("#fname").val();
		let lname = $("#lname").val();
		let address = $("#address").val();
		let email = $("#email").val();
		let username = $("#username").val();
		let password = $("#password").val();
		let cpass = $("#cpass").val();
		let countU = username.length;
		let countP = password.length;
		

		let error_flag = 0;

		//First name verification
		if(fname == ""){
			$("#fname").next().html("First name is required!");
			error_flag = 1;
		} else {
			$("#fname").next().html("");
		}

		//Last name verification
		if(lname == ""){
			$("#lname").next().html("Last name is required!");
			error_flag = 1;
		} else {
			$("#lname").next().html("");
		}

		//address verification
		if(address == ""){
			$("#address").next().html("Address is required!");
			error_flag = 1;
		} else {
			$("#address").next().html("");
		}

		//email verification
		if(email == ""){
			$("#email").next().html("Email address is required!");
			error_flag = 1;
		} else {
			$("#email").next().html("");
		}

		//username verification
		if(username == ""){
			$("#username").next().html("Username is required!");
			error_flag = 1;
		} else if (countU < 5) {
			$("#username").next().html("Username should at least 5 characters!");
			error_flag = 1;
		} else {
			$("#username").next().html("");
		}

		//password verification
		if(password == ""){
			$("#password").next().html("Password is required!");
			error_flag = 1;
		} else if (countP < 8) {
			$("#password").next().html("Password should have more than 8 characters!");
			error_flag = 1;
		} else {
			$("#password").next().html("");
		}

		//password and cpass verification
		if (password != cpass) {
			$("#cpass").next().html("Password don't match!");
			error_flag = 1;
		} else {
			$("#password").next().html("");
		}

		if(error_flag == 0) {
		
			//EMAIL
			$.ajax({
				"url": "../controllers/process_email.php",
				"data": { "email" : email },
				"type": "POST",
				"success": (dataFromPHP) => {

					if (dataFromPHP == "invalidEmail") {
						$("#email").next().css("color", "red");
						$("#email").next().html("Please enter a valid email."); 
					 
					} else if (dataFromPHP == "emailExists") {
						$("#email").next().css("color", "red");
						$("#email").next().html("Email address already taken."); 

					} else {
						
						$.ajax({

						"url": "../controllers/process_register.php",
						"data": {
								"fname" : fname,
								"lname" : lname,
								"address" : address,
								"email" : email,
								"username" : username,
								"password" : password
								},
						"type": "POST",
						"success": (dataFromPHP) => {
							if (dataFromPHP == "userExists") {
								$("#username").next().css("color", "red");
								$("#username").next().html("User exists."); 
							} else if ($.parseJSON(dataFromPHP)) {
								let data = $.parseJSON(dataFromPHP);
								location.href="profile.php?id=" + data.id;
							} else {
								$("#username").next().css("color", "red");
								$("#username").next().html("Error encountered. Pls try again."); 
							}	
						}
						});

					} 
				}
			});
		}

	});


	// LOGIN
	$(document).on("click", "#btn_login", ()=> {
		
		let username = $("#username").val();
		let password = $("#password").val();

		let error_flag = 0;


		//username verification
		if(username == ""){
			$("#username").next().html("Username is required!");
			error_flag = 1;
		} else {
			$("#username").next().html("");
		}

		//password verification
		if(password == ""){
			$("#password").next().html("Password is required!");
			error_flag = 1;
		} else {
			$("#password").next().html("");
		}


		if(error_flag == 0) {
			
			$.ajax({
				"url": "../controllers/process_login.php",
				"data": {"username" : username,
						  "password" : password},
				"type": "POST",
				"success": (dataFromPHP) => {
					let response = $.parseJSON(dataFromPHP);

					if(response.status == "loggedIn") {
						let data = $.parseJSON(dataFromPHP);
						location.href="profile.php?id=" + data.id;
					} else if (response.status == "loginFailed") {
						$("#error_message").css("color", "red");
						$("#error_message").html(response.message); 
					} else {
						$("#error_message").css("color", "red");
						$("#error_message").html(response.message); 
					}
				}

			});

		} 

	});


	$(document).on('submit', '#form_edit_user', function(e){
		e.preventDefault();
		processEditForm();
	});


	function processEditForm() {
		//get values
		let fname = $("#fname").val();
		let lname = $("#lname").val();
		let email = $("#email").val();
		let username = $("#username").val();
		let password = $("#password").val();
		let id = $("#id").val();
		let countU = username.length;
		let countP = password.length;
		
		// console.log('id');

		let error_flag = 0;

		//First name verification
		if(fname == ""){
			$("#fname").next().html("First name is required!");
			error_flag = 1;
		} else {
			$("#fname").next().html("");
		}

		//Last name verification
		if(lname == ""){
			$("#lname").next().html("Last name is required!");
			error_flag = 1;
		} else {
			$("#lname").next().html("");
		}

		//email verification
		if(email == ""){
			$("#email").next().html("Email address is required!");
			error_flag = 1;
		} else {
			$("#email").next().html("");
		}

		//username verification
		if(username == ""){
			$("#username").next().html("Username is required!");
			error_flag = 1;
		} else {
			$("#username").next().html("");
		}

		//password verification
		if(password == ""){
			$("#password").next().html("Password is required!");
			error_flag = 1;
		} else {
			$("#password").next().html("");
		}


		if(error_flag == 0) {
		
			//CHECK EMAIL VALIDITY AND AVAILABILITY
			//WHERE id != $id coz it might count its current id..u might need SELECT then if else
			$.ajax({
				"url": "../controllers/process_edit_email.php",
				"data": { 
						"email" : email,
						"id": id
					},
				"type": "POST",
				"success": (dataFromPHP) => {

					if (dataFromPHP == "invalidEmail") {
						$("#email").next().css("color", "red");
						$("#email").next().html("Please enter a valid email."); 
					} else if (dataFromPHP == "emailExists") {
						$("#email").next().css("color", "red");
						$("#email").next().html("Email address already taken."); 
					} else if (dataFromPHP == "sameEmail" || dataFromPHP == "success"){
						
						// CHECK USERNAME AVAILABILITY
						$.ajax({
						"url": "../controllers/process_edit_uname.php",
						"data": {
								"username" : username,
								"id": id
								},
						"type": "POST",
						"success": (dataFromPHP) => {
							if (dataFromPHP == "userExists") {
								$("#username").next().css("color", "red");
								$("#username").next().html("User exists."); 
							} else if (dataFromPHP == "success" || dataFromPHP == "sameUser") {
								
								// CHECK CORRECTNESS OF PASSWORD AND IF CORRECT UPDATE DATA
								$.ajax({
									"url": "../controllers/process_edit_user.php",
									"data": { 
											"id" : id,
											"fname" : fname,
											"lname" : lname,
											"email" : email,
											"username" : username,
											"password" : password
											 },
									"type": "POST",
									"success": (dataFromPHP) => {
					
										if (dataFromPHP == "incorrectPassword") {
											$("#password").next().css("color", "red");
											$("#password").next().html("Incorrect password."); 
										 
										} else if ($.parseJSON(dataFromPHP)) {
											let data = $.parseJSON(dataFromPHP);
											location.href="profile.php?id=" + data.id; 
					
										} else {
											$("#edit_user_error").css("color", "red");
											$("#edit_user_error").append("Error in password validation encountered.");	
										} 
									}
								});


							} else {
								$("#edit_user_error").css("color", "red");
								$("#edit_user_error").append("Error in username validation encountered."); 
							}	
						}
						});

					} else {
						$("#edit_user_error").css("color", "red");
						$("#edit_user_error").append("Error in email validation encountered."); 
					}	
				}
			});
		}
	}
	
	


	

	// CLEAR
	$("#btn_clear").click(()=>{

	window.confirm("you sure?"); 

  		if(confirm == "ok") {
  			$("#fname").next().html("");
  			$("#lname").next().html("");
  			$("#adress").next().html("");
  			$("#email").next().html("");
  			$("#username").next().html("");
			$("#password").next().html("");
			$("#cpass").next().html("");
  		}
		

	});


	// MODAL
	$(document).on('click', '.modal-link', function(){
		const url = $(this).data('url');
		const id = $(this).data('id');

		$.get(url, {'id': id},function(response){
			//put edit_user.php content inside modal-body
			$('#modalContainer .modal-body').html("");
			$('#modalContainer .modal-body').html(response);
			$('#modalContainer').modal();
		})
	});



	// UPDATE
	// template for dynamically added element
	$('body').on('click', '#btn_edit', ()=>{
		
		//get values
		let username = $("#username").val();
		let password = $("#password").val();
		let cpass = $("#cpass").val();
		let countU = username.length;
		let countP = password.length;

		let error_flag = 0;


		//username verification
		if(username == ""){
			
			$("#username").next().html("Username is required!");
			error_flag = 1;
		} else if (countU < 5) {
			$("#username").next().html("Username should at least 5 characters!");
			error_flag = 1;
		} else {
			$("#username").next().html("");
		}

		//password verification
		if(password == ""){

			$("#password").next().html("Password is required!");
			error_flag = 1;
		} else if (countP < 8) {
			$("#password").next().html("Password should have more than 8 characters!");
			error_flag = 1;
		} else {
			$("#password").next().html("");
		}

		//password and cpass verification
		if (password !== cpass) {
			$("#cpass").next().html("Password don't match!");
			error_flag = 1;
		} else {
			$("#password").next().html("");
		}

		//assess if tama na ang lahat using ajax
		if(error_flag == 0) {
			
			//ONCE navalidate na walang error  na, ipapasa kay process_login.php
			$.ajax({
				//sino magpprocess ng login data
				"url": "process_update.php",
				"data": {"username" : username,
						  "password" : password},
				"type": "POST",
				//sumasalo sa iniecho ng process_login.php
				"success": (dataFromPHP) => {
					if(dataFromPHP) {

						//submit validated changes
						$("#form_edit").submit();

					} else {
				
						$("#error_message").css("color", "red");
						$("#error_message").html("test"); // Invalid username/password
					}
				}

			});

		} 


	});


	// ADDING ITEMS TO CART
	$("#btn_add_to_cart").on("click",function(){
		let productId = $(this).attr("data-id");
		// let stocks = $('#stocksLeft'+productId).text();
		// stocks = parseInt(stocks) ;

		$.ajax({
			url: "../controllers/process_add_to_cart.php",
			method: "POST",
			data: {
				productId: productId,
				// stocks: stocks
			},
			dataType: "text",
			success: function(data) {
				$("#btn_add_to_cart").replaceWith("<button class=\"btn btn-outline-secondary mt-3 flex-fill mr-2\" disabled><i class=\"fas fa-cart-plus\"></i> Item added to cart!</button>");
				let sum = "";
				sum += data;
				$("#item-count").html("<span class='badge badge-primary text-light'>" + sum + "</span>");

				// let difference = stocks - sum;
				// $('#stocksLeft'+productId).text(difference);
			}
		});

	});


	// DELETING ITEMS IN CART
	$(document).on("click", ".btn_delete_item", function(){
		let productId = $(this).data('productid');

		$.post('../controllers/process_delete_in_cart.php', {
			productId: productId 
			},function(response){
				// reload the modal with the new quantity reflected
				$.get("../partials/templates/cart_modal.php", function(response) {
					$('.modal .modal-body').html(response);
					// $("#btn_add_to_cart").replaceWith("<a class=\"btn btn-outline-primary mt-3 flex-fill mr-2\"><i class=\"fas fa-cart-plus\"></i> Add to Cart</a>");
				});
			});

	});


	//GETTING PRODUCT QUANTITY 
	$(document).on("click", ".itemQuantity", function(){	
		let productId = $(this).attr('data-id');
		let unitPrice = $(".unitPrice"+productId).text();	
		let quantity = $(this).val();
		let totalPrice = unitPrice * quantity;

		$(".totalPrice").text(totalPrice);	
		$.post('../controllers/add_product_quantity.php', {
			quantity: quantity,
			productId: productId
		}, function(response){
			// reload the modal with the new quantity reflected
			$.get("../partials/templates/cart_modal.php", function(response) {
				$('.modal .modal-body').html(response);
			});
		});	
		
	});


	// CHECKOUT
	$(document).on("click", "#btn_place_order", function(){
		let cartSessionId = $(this).attr("data-id");
		let shippingAddress = $("#shipping_address").val();
		let paymentMethod = $('#paymentMethod'+cartSessionId).val();

		if (shippingAddress === "") {
			$("#checkout_error_message").css("color", "red");
			$("#checkout_error_message").text("Shipping Address is required");
		} else {

			$.ajax({
				url: "../controllers/process_place_order.php",
				method: "POST",
				data: {
					cartSessionId: cartSessionId,
					shippingAddress: shippingAddress,
					paymentMethod: paymentMethod

				},
				success: function(response) {

				$.get("../partials/templates/confirmation_modal.php", function(response) {
					$('.modal .modal-body').html(response);
			});
				}
			});

		}

		

	});
	
	

});
