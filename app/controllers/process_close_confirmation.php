<?php 

	session_start(); // INITIATE
	unset($_SESSION["cart_session"]);
	header("Location: ../views/index.php?id=$id"); // redirected to index.php

?>