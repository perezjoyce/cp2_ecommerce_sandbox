<?php 

	session_start(); // INITIATE
	session_destroy(); // Destroys all data registered to a session
	header("Location: ../views/index.php"); // redirected to index.php

?>