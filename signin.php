<?php
  $login=false;
  $err=false;
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Set connection variables
    $server = "localhost";
    $username = "root";
    $password = "";

    // Create a database connection
    $con = mysqli_connect($server, $username, $password);

    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    // echo "Success connecting to the db";

    // Collect post variables
    $custid = $_POST['custid'];
    $pass=$_POST['pass'];

    $sql="SELECT * FROM `restaurant`.`customer` WHERE `custid` ='$custid'";
    $result= mysqli_query($con, $sql);
    if(mysqli_num_rows($result) == 1){
      while($row=mysqli_fetch_assoc($result)){
        if(password_verify($pass, $row['pass'])){
          $login=true;
          session_start();
          $_SESSION['loggedin']=true;
          $_SESSION['custid']=$custid;
          header("location: Menu_cust.php");
        }else{
          $err=true;
        }
      }
      
    }else{
      $err=true;
    }

    // Close the database connection
    $con->close();
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

    <title>sign in</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="homepg.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="signup.php">Customer Signup</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="emp_signin.php">Employee signin</a>
        </li>
        
        
      </ul>
      
    </div>
  </div>
</nav>
<!-- alerts -->
  <?php
  if($login){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You are logged in.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }

  if($err){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error:</strong> Invalid Credentials.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }

  ?>
<!-- form for inputting -->
    <div class="container">
      <h2>Customer details</h2>
      <form action="signin.php" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Customer id</label>
    <input type="int" class="form-control" required name="custid" id="exampleInputEmail1" aria-describedby="emailHelp">
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" required name="pass" id="exampleInputPassword1">
    <div id="emailHelp" class="form-text">Your password is protected.</div>
  </div>
  </div>
  
  <button type="submit" class="btn btn-primary">Login </button>
</form>
    </div>
    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>