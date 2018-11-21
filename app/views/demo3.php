<input type='text' id='search'>
<p id='products'>Show results here</p>

<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>


  <script type="text/javascript">
  	$("#search").keyup(function(){
  		let word = $(this).val();

  		//AJAX
  		//parameters: saan ibaba, ano ibabato, what will happen afterwards
  		$.post("demo4.php", {word:word},function(data){
  			$("#products").html(data);
  		})
  	});
  </script>

