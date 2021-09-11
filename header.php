<?php 
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: signin.php");
    exit;
  }
?>


<!doctype html>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Apna Restaurant - Menu</title>
      <link rel = "icon" href = "img/AR.jpg" type = "image/x-icon"> 
  </head>
  <body>
  <h1 style="font-family: serif;font-weight: bold;">APNA RESTAURANT</h1>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <!-- <a class="navbar-brand" href="#"><img src="img/AR.jpg" width="30" height="30" ></a> -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link"  href="Menu_cust.php">Menu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="signout.php">Log out</a>
              </li>
              
             </ul>
             <div> 
             <?php
                $count=0;
             if(isset($_SESSION['cart']))
             {
                  $count=count($_SESSION['cart']);
             }
             ?>
             <a href="Order_cust.php" class="btn btn-outline-success">Order (<?php echo $count ?>)</a>  
             </div>
          </div>
        </div>
      </nav>


    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

   </body>
</html>