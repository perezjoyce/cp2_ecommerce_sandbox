<?= session_start(); ?>
<?= require_once "../controllers/connect.php"; ?>

<?php 
  
  if(!isset($_SESSION['id'])) { 
      header("location: index.php"); 
  }
?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Capstone Project 2</title>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script> -->
    
  </head>
  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light fixed-top mb-5">
      <div class="container">
        <a class="navbar-brand font-weight-bold" href="index.php">Demo Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

          <ul class="navbar-nav ml-auto">

            <li class="nav-item mr-5">
              <a class="nav-link text-light" href="catalog2.php">
                <i class="fas fa-envelope"></i>
                Messages
              </a>
            </li>

        
             
              <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle text-light' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                  <i class='fas fa-user'></i>
                  My Account
                </a>

                <div class='dropdown-menu mt-2' aria-labelledby='navbarDropdown'>
                  <a class='dropdown-item' href='profile.php?id=$id'>Profile</a>
                  <a class="dropdown-item" href="orders.php">Manage Orders</a>
                  <a class="dropdown-item" href="manage_products.php">Manage Products</a>
                  <a class="dropdown-item" href="ads.php">Manage Ads</a>
                  <a class="dropdown-item" href="users.php">Manage Users</a>
                  <div class="dropdown-divider mt-2 mb-3"></div>
                  <a class="dropdown-item" href='../controllers/process_logout.php'>
                    <i class='fas fa-sign-in-alt'></i>
                    Log Out
                  <a>
                </div>
              </li>
            
          </ul>
        </div>
        <!-- /NAVBAR COLLAPSE -->
      </div>
      <!-- /CONTAINER -->
    </nav>

    <div class="container">
      <div class="row my-5">
        <div class="col-lg-12">
          <!-- SPACE -->
          <?php if(isset($_GET['uploadError'])): ?>
            <div class="alert alert-info"><?= $_GET['uploadError'] ?></div>
          <?php endif; ?>  
        </div>
      </div>
    </div>
    

