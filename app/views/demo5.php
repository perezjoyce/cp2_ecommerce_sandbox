<h2>Demo 5</h2>

<select class="custom-select" id="price">
	<option selected="">-----------</option>
	<option value="asc">Highest to Lowest</option>
	<option value="desc">Lowest to Highest</option>

</select>


<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>

  <script type="text/javascript">
  	$("#price").change(function(){
  		let sort = $(this).val();
  		console.log(sort);
  	})


  </script>