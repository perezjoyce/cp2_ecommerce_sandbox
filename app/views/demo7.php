<h2>Demo 7</h2>


	<input type="text" id="email" placeholder="email">
  <p id="result"></p>
  <button disabled id="btn_submit">Submit</button>


  <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous">
  </script>

  <script type="text/javascript">
  	$("#email").keyup(function(){
  		let email = $(this).val();
  		// console.log(email);
      $.post("demo8.php",{"email":email}, function(data){

        if(data == "emailExists"){
          $("#result").html("Email exists");
          $('#btn_submit').prop('disabled', true);
        }else {
          $("#result").html("");
          $("#result").html("Email is available");
          $('#btn_submit').prop('disabled', false);
        }
        
      })
  	});




  </script>

  <!-- function inside a method is called a callback method -->