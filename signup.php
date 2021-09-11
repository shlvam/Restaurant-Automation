<?php
$insert = false;
//Primary key should be there
if(isset($_POST['custid'])){
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
    $cname = $_POST['cname'];
    $surname = $_POST['surname'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $zipcode = $_POST['zipcode'];
    $ex_sql="SELECT * FROM `restaurant`.`customer` WHERE `custid` ='$custid'";
    $ex_result=mysqli_query($con, $ex_sql);
    $ex_num_row=mysqli_num_rows($ex_result);
    if($ex_num_row >0){
        echo"<script>
            alert('Customer id already exist');            
            </script>";
    }else{
        if($pass == $cpass){
            $hash1=password_hash($pass, PASSWORD_DEFAULT);
            $sql="INSERT INTO `restaurant`.`customer`(`custid`,`pass`, `cname`, `surname`, `mobile`, `address`, `zipcode`) VALUES ('$custid','$hash1', '$cname', '$surname', '$mobile', '$address', '$zipcode')";
            // echo $sql;
            
            // Execute the query
            if($con->query($sql) == true){
                // echo "Successfully inserted";

                // Flag for successful insertion
                $insert = true;
            }
            else{
                echo "ERROR: $sql <br> $con->error";
            }
        }else{
            echo"<script>
            alert('Password mismatch');            
            </script>";

        }
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
    <link href="https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="signup.css">
    <title>Customer signup</title>
  </head>
  <body>
    
    <!-- Top Menu buttons -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="homepg.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="signin.php">Customer Sign-in</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="signup.php">Customer Sign-up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="emp_signin.php">Employee sign-in</a>
        </li>        
      </ul>
    </div>
  </div>
</nav>

<!-- main code -->
    <div class="container">
        <h1>CUSTOMER SIGNUP</h1>
        <p>Enter your details and submit.</p>
        <?php
        if($insert == true){
        echo "<p class='submitMsg'>Account created successful</p>";
        }
    ?>
        <form action="signup.php" method="post">
            <input type="int" name="custid" id="custid" required placeholder="Id">
            <input type="text" name="cname" id="cname" required placeholder="Name">
            <input type="text" name="surname" id="surname" placeholder="Surname">
            <input type="password" name="pass" id="pass" required placeholder="Password">
            <input type="password" name="cpass" id="cpass" required placeholder="Confirm password">
            <input type="email" name="email" id="email" required placeholder="Email">
            <input type="phone" name="mobile" id="mobile" required placeholder="Contact Number">
            <input type="text" name="address" id="address" required placeholder="Address">
            <input type="text" name="zipcode" id="zipcode" placeholder="Zipcode">
            <button class="btn">Submit</button> 
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











<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Signup</title>
    
</head>
<body>
    <script src="index.js"></script>
    
</body>
</html>
