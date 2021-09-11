<?php
  session_start();

  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: emp_signin.php");
    exit;
  }
?>

<?php
	if(isset($_GET['id'])){
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
	    $custid=$_GET['id'];

	    //fetch all columns with the help of primary key
	    $sql_show="SELECT * FROM `restaurant`.`customer` WHERE `custid`='$custid'";
                $result=$con->query($sql_show);
                if(($result-> num_rows) > 0){
                    //print only one row
                    $row = $result->fetch_assoc();
                    
                }else{
                	echo "No such data exist";
                }
	    // Close the database connection
	    $con->close();
	}
?>

<!-- for updating -->
<?php
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

        $custid = $_POST['custid'];
        $cname = $_POST['cname'];
        $surname = $_POST['surname'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $zipcode = $_POST['zipcode'];
		// $sql_qu="UPDATE `restaurant`.`orders` SET `tab_id`='$tab_id',`nchair`='$n_chair' WHERE `tab_id`='$tab_id'";
    	// can not change primary key
		$sql_qu="UPDATE `restaurant`.`customer` SET `custid`='$custid',`cname`='$cname',`surname`='$surname',`mobile`='$mobile',`address`='$address',`zipcode`='$zipcode' WHERE `custid`='$custid'";
		if($con->query($sql_qu) == true){
			?>
			<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/restaurant/customer.php">
			<?php
		}else{
			echo "Failed to updat Record";
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
    <link rel="stylesheet" href="tab.css">

    <title>Information Update - Customers</title>
  </head>
  <body>
  <h1 style="font-family: serif;font-weight: bold;">APNA RESTAURANT</h1>
    <!-- navbar from here -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="admin_home.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="emp.php">Employee</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="tab.php">Table</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="menu.php ">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="order.php ">Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="customer.php ">Customers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="signout.php ">Log out</a>
        </li>       
    </div>
  </div>
</nav>
<!-- navbar till here -->
    
<!-- main code -->
    <form action="cust_edit.php" method="post">
        <tr>   
            <td>Customer ID</td> 
            <td><input type="int" name="custid" id="custid" value="<?php echo "$row[custid]" ?>"></td>
        </tr>
        <tr>   
            <td>Customer Name</td> 
            <td><input type="text" name="cname" id="cname" value="<?php echo "$row[cname]" ?>"></td>
        </tr>
        <tr>   
            <td>Surname</td> 
            <td><input type="text" name="surname" id="surname" value="<?php echo "$row[surname]" ?>"></td>
        </tr>
        <tr>   
            <td>Mobile</td> 
            <td><input type="text" name="mobile" id="mobile" value="<?php echo "$row[mobile]" ?>"></td>
        </tr>
        <tr>   
            <td>Address</td> 
            <td><input type="text" name="address" id="address" value="<?php echo "$row[address]" ?>"></td>
        </tr>
        <tr>   
            <td>Zipcode</td> 
            <td><input type="text" name="zipcode" id="zipcode" value="<?php echo "$row[zipcode]" ?>"></td>
        </tr>
        
        <tr>    
            <button class="btn">Submit</button> 
        </tr>
    </form>
    

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