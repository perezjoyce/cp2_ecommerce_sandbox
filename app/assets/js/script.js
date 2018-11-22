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


  	
  	// REGISTRATION    
	// ================= ERROR MESSAGE WHEN INPUT FIELDS ARE LEFT BLANK ===============

    // REGISTRATION
	$("#btn_register").click(()=>{
		
		//get values
		let fname = $("#fname").val();
		let lname = $("#fname").val();
		let address = $("#fname").val();
		let email = $("#fname").val();
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

			//FIRST NAME
			$.ajax({
				"url": "../controllers/process_fname.php",
				"data": {"fname" : fname},
				"type": "POST",
				"success": (dataFromPHP) => {
					if(dataFromPHP == "success") {
						// proceed to registration
						// window.location = "users.php";
						// $("#fname").next().css("color", "green");
						// $("#fname").next().html("first name is accepted. :)");

						$("#form_register").submit();

					} else {
						$("#fname").next().css("color", "red");
						$("#fname").next().html("Error encountered. Pls try again."); 
					}
				}

			});


			//LASTNAME
			$.ajax({
				"url": "../controllers/process_lname.php",
				"data": {"lname" : lname},
				"type": "POST",
				"success": (dataFromPHP) => {
					if(dataFromPHP == "success") {
						// $("#lname").next().css("color", "green");
						// $("#lname").next().html("last name is accepted. :)");

						$("#form_register").submit();

					} else {
						$("#lname").next().css("color", "red");
						$("#lname").next().html("Error encountered. Pls try again."); 
					}
				}

			});


			//ADDRESS
			$.ajax({
				"url": "../controllers/process_address.php",
				"data": {"address" : address},
				"type": "POST",
				"success": (dataFromPHP) => {
					if(dataFromPHP == "success") {
						// proceed to registration
						// window.location = "users.php";
						// $("#address").next().css("color", "green");
						// $("#address").next().html("Username is accepted. :)");

						$("#form_register").submit();

					} else {
						$("#address").next().css("color", "red");
						$("#address").next().html("Error encountered. Pls try again."); 
					}
				}

			});
			
			//USERNAME
			$.ajax({
				"url": "../controllers/process_uname.php",
				"data": {"username" : username},
				"type": "POST",
				"success": (dataFromPHP) => {
					if(dataFromPHP == "userExists") {
						$("#uname").next().css("color", "red");
						$("#uname").next().html("Username is already taken."); 
						
					} else if (dataFromPHP == "success") {
						// proceed to registration
						// window.location = "users.php";
						// $("#uname").next().css("color", "green");
						// $("#uname").next().html("Username is accepted. :)");

						$("#form_register").submit();

					} else {
						$("#uname").next().css("color", "red");
						$("#uname").next().html("Error encountered. Pls try again."); 
					}
				}

			});


			//EMAIL
			$.ajax({
				"url": "../controllers/process_email.php",
				"data": {"email" : email},
				"type": "POST",
				"success": (dataFromPHP) => {
					if(dataFromPHP == "emailExists") {
						$("#email").next().css("color", "red");
						$("#email").next().html("Email address already taken."); 
						
					} else if (dataFromPHP == "success") {
						// proceed to registration
						// window.location = "users.php";
						// $("#email").next().css("color", "green");
						// $("#email").next().html("Username is accepted. :)");

						$("#form_register").submit();

					} else if (dataFromPHP == "invalidEmail") {
						$("#email").next().css("color", "red");
						$("#email").next().html("Error encountered. Pls try again."); 
					}
				}

			});


			//PASSWORD
			$.ajax({
				"url": "../controllers/process_pass.php",
				"data": {"password" : password},
				"type": "POST",
				"success": (dataFromPHP) => {
					if(dataFromPHP == "success") {
						// proceed to registration
						// window.location = "users.php";
						// $("#password").next().css("color", "green");
						// $("#password").next().html("Username is accepted. :)");

						$("#form_register").submit();

					} else {
						$("#password").next().css("color", "red");
						$("#password").next().html("Error encountered. Pls try again."); 
					}
				}

			});










			// //USERNAME
			// $.ajax({
			// 	"url": "../controllers/process_uname.php",
			// 	"data": {"username" : username, "password" : password},
			// 	"type": "POST",
			// 	"success": (dataFromPHP) => {
			// 		if(dataFromPHP == "userExists") {
			// 			$("#error_message").css("color", "red");
			// 			$("#error_message").html("Username is already taken."); 
						
			// 		} else if (dataFromPHP == "success") {
						

			// 			//FIRST NAME
			// 			$.ajax({
			// 				"url": "../controllers/process_fname.php",
			// 				"data": {"fname" : fname},
			// 				"type": "POST",
			// 				"success": (dataFromPHP) => {
			// 					if(dataFromPHP == "success") {
			// 						// proceed to registration
			// 						// window.location = "users.php";
			// 						// $("#fname").next().css("color", "green");
			// 						// $("#fname").next().html("first name is accepted. :)");

			// 						$("#form_register").submit();

			// 					} else {
			// 						$("#fname").next().css("color", "red");
			// 						$("#fname").next().html("Error encountered. Pls try again."); 
			// 					}
			// 				}

			// 			});


			// 			// LASTNAME
			// 			$.ajax({
			// 				"url": "../controllers/process_lname.php",
			// 				"data": {"lname" : lname},
			// 				"type": "POST",
			// 				"success": (dataFromPHP) => {
			// 					if(dataFromPHP == "success") {
			// 						// $("#lname").next().css("color", "green");
			// 						// $("#lname").next().html("last name is accepted. :)");

			// 						$("#form_register").submit();

			// 					} else {
			// 						$("#lname").next().css("color", "red");
			// 						$("#lname").next().html("Error encountered. Pls try again."); 
			// 					}
			// 				}

			// 			});


			// 			// ADDRESS
			// 			$.ajax({
			// 				"url": "../controllers/process_address.php",
			// 				"data": {"address" : address},
			// 				"type": "POST",
			// 				"success": (dataFromPHP) => {
			// 					if(dataFromPHP == "success") {
			// 						// proceed to registration
			// 						// window.location = "users.php";
			// 						// $("#address").next().css("color", "green");
			// 						// $("#address").next().html("Username is accepted. :)");

			// 						$("#form_register").submit();

			// 					} else {
			// 						$("#address").next().css("color", "red");
			// 						$("#address").next().html("Error encountered. Pls try again."); 
			// 					}
			// 				}

			// 			});

			// 			//EMAIL
			// 			$.ajax({
			// 				"url": "../controllers/process_email.php",
			// 				"data": {"email" : email},
			// 				"type": "POST",
			// 				"success": (dataFromPHP) => {
			// 					if(dataFromPHP == "emailExists") {
			// 						$("#email").next().css("color", "red");
			// 						$("#email").next().html("Email address already taken."); 
									
			// 					} else if (dataFromPHP == "success") {
			// 						// proceed to registration
			// 						// window.location = "users.php";
			// 						// $("#email").next().css("color", "green");
			// 						// $("#email").next().html("Username is accepted. :)");

			// 						$("#form_register").submit();

			// 					} else if (dataFromPHP == "invalidEmail") {
			// 						$("#email").next().css("color", "red");
			// 						$("#email").next().html("Error encountered. Pls try again."); 
			// 					}
			// 				}

			// 			});



			// 			// $("#form_register").submit();

			// 		} else {
			// 			$("#error_message").css("color", "red");
			// 			$("#error_message").html("Error encountered. Pls try again."); 
			// 		}
			// 	}

			// });



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


	// UPDATE USER
	$('.edit_user').on('click', function(){
		const userEditModalUrl = $(this).data('url');
		const userId = $(this).data('id');
		$.get(userEditModalUrl, function(response){
			//put edit_user.php content inside modal-body
			$('#editUserModal .modal-body').html(response);
			$('#editUserModal').modal();
		})
	});

 
 




});