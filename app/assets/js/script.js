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

	
	
	//PUTTING ITEMS ON SHOPPING CART -- not yet working
	$(document).on("click", "#btn_add_to_cart", function(e){
		e.preventDefault();
		addToCart();
	});
	  
	function addToCart() {
		let item_id = $(' #item_id ').val();
		let item_quantity = $(".itemQuantity").val();
		//AJAX
		$.post("../controllers/process_add_to_cart.php", {item_id:item_id, item_quantity: item_quantity },function(data){
			let data = $.parseJSON(dataFromPHP);
			location.href="profile.php?id=" + data.id;
		})
	}


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


	// PRODUCT QUANTITY
	$(document).on("change", ".itemQuantity", function(){
			let price = $(".unitPrice").html();
			let quantity = $(".itemQuantity").val();
			let total = price * quantity; 
			total = round(total,2);
			$(".totalPrice").html(total);

	})

	// SUBTOTAL
	// 	$(document).on("change", ".totalPrice", function(){
	// 		let totalPrice = $(".totalPrice").html();
	// 		totalPrice += totalPrice;
	// 		$(".subtotalAmount").html(totalPrice += totalPrice);

	// })

  	
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
		if (password !== cpass) {
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
	$('.modal-link').on('click', function(){
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

});
