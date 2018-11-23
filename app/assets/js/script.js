$(document).ready( () => {

	
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


  	
    // REGISTRATION
	$("#btn_register").click(()=>{

		$('#btn_submit').prop('disabled', true); // trial
		
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

		//assess if tama na ang lahat using ajax
		//TASK: VALIDATE EMAIL FIRST LIKE HOW YOU SEARCHED ITEMS AND IF AAVILABLE, PROCEED TO INSERTING OTHER VARIABLES
		if(error_flag == 0) {
			// console.log(email); //variable contains correct value
		
			//EMAIL
			$.ajax({
				"url": "..assets/controllers/process_email.php",
				"data": { "email" : email },
				"type": "POST",
				"success": (dataFromPHP) => {

					

					if (dataFromPHP == "invalidEmail") {
						$("#email").next().css("color", "red");
						$("#email").next().html("Please enter a valid email."); 
						$('#btn_submit').prop('disabled', true); // trial
					 
					} else if (dataFromPHP == "emailExists") {
						$("#email").next().css("color", "red");
						$("#email").next().html("Email address already taken."); 
						$('#btn_submit').prop('disabled', true); // trial

					} else {
						
						$( "btn_register" ).submit(function(event) {
						  
						// let error_flag2 = 0;
						// $('#btn_submit').prop('disabled', false);
						// console.log(fname); //variable contains correct value

							$.ajax({

							"url": "../assets/controllers/process_register.php",
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
									$('#btn_submit').prop('disabled', true); // trial
									event.preventDefault(); // trial
									// error_flag2 = 1;
								} else if (dataFromPHP == "success") {
									// $('#btn_register').prop('disabled', false);
									$("#form_register").submit(); // trial
								} else {
									$("#username").next().css("color", "red");
									$("#username").next().html("Error encountered. Pls try again."); 
									$('#btn_submit').prop('disabled', true); // trial
									event.preventDefault(); // trial
								}	
							}
							});


						});
												
						


					} 
				}
			});

		
				

		}

	});


	

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

});


