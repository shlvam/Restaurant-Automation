<!-- for done change 0/1 -->
<?php
	if(isset($_GET['dn'])){
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

	    $orderid=$_GET['oid'];
	    $done=$_GET['dn'];
	    if($done == 0){
	    	$done=1;
	    }else{
	    	$done=0;
	    }

	    $sql_qu="UPDATE `restaurant`.`orders` SET `done`='$done' WHERE `orderid`='$orderid'";
		if($con->query($sql_qu) == true){
			// echo "Done successfully";
		}else{
			echo "Failed to updat Record";
		}

	    // Close the database connection
	    $con->close();
	}
?>

<!--php for deleting new row -->
<?php
$dele = false;
//Primary key should be there
if(isset($_POST['orderid']) and !(isset($_POST['custid']))){
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
    $orderid = $_POST['orderid'];
    
    $sql = "DELETE FROM `restaurant`.`orders` WHERE `orderid` = '$orderid'";
    // echo $sql;
    
    // Execute the query
    if($con->query($sql) == true){
        // echo "Successfully deleted";

        // Flag for successful insertion
        $dele = true;
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }

    // Close the database connection
    $con->close();
}
?>


<!--php for inserting new row -->
<?php
$insert = false;
//Primary key should be there
if(isset($_POST['empid'], $_POST['orderid'])){
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
    $orderid = $_POST['orderid'];
    $empid = $_POST['empid'];
    $custid = $_POST['custid'];
    $menuid = $_POST['menuid'];
    $ordate = $_POST['ordate'];
    $ordtime = $_POST['ordtime'];
    $tot_pay = $_POST['tot_pay'];
    $cmnt = $_POST['cmnt'];
    $done = $_POST['done'];
    $sql = "INSERT INTO `restaurant`.`orders`(`orderid`, `empid`, `custid`, `menuid`, `ordate`, `ordtime`, `tot_pay`, `cmnt`, `done`) VALUES ('$orderid', '$empid', '$custid', '$menuid', '$ordate', '$ordtime', '$tot_pay', '$cmnt', '$done')";
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

    // Close the database connection
    $con->close();
}
?>



<?php
  session_start();

  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: emp_signin.php");
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
    <link rel="stylesheet" href="tab.css">

    <title>Apna Restaurant - Orders</title>
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
    <div class="container">
        <h1>ORDERS</h1>
        <!-- for search with a key -->
        <div>
            <form action="order_search.php" method="post">
                <input type="int" name="order_id" id="order_id" placeholder="Order id">
                <button class="btn">Search</button> 
            </form>
        </div>
        <hr>

        <table style="width:100%;">
            <!-- displaying data in table -->
            <tr>
                <th>Order Id</th>
                <th>Employee Id</th>
                <th>Customer Id</th>
                <th>Menu Id</th>
                <th>Date</th>
                <th>Time</th>
                <th>Amount</th>
                <th>Comments</th>
                <th>Status</th>
                <th>Operations</th>
                <th> </th>
                <th> </th>
            </tr>
            <?php
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
                $sql_show="SELECT * FROM `restaurant`.`orders`";
                $result=$con->query($sql_show);
                if($result-> num_rows > 0){
                    //print each data row by row
                    while($row = $result->fetch_assoc()){
                        echo "
                        <tr>
                            <td>". $row["orderid"]."</td>
                            <td>". $row["empid"]."</td>
                            <td>". $row["custid"]."</td>
                            <td>". $row["menuid"]."</td>
                            <td>". $row["ordate"]."</td>
                            <td>". $row["ordtime"]."</td>
                            <td>". $row["tot_pay"]."</td>
                            <td>". $row["cmnt"]."</td>
                            <td>". $row["done"]."</td>
                            <td><a href = 'order.php?oid=$row[orderid] & dn=$row[done]'><input type='submit' value='0/1' class='btn'></td>
                            <td><a href = 'order_edit.php?ti=$row[orderid]'><input type='submit' value='Update  ' class='btn'></td>
                            <td><a href = 'order_bill.php?ti=$row[orderid]'><input type='submit' value='bill ' class='btn'></td>

                        </tr>";
                    }
                    echo "</table>";
                }else{
                    echo "0 result";
                }

                // editbtn -> for button not working
                // Close the database connection
                $con->close();
            ?>
        </table>
        <hr>
        <!-- for new entry -->
        <h1>New Order</h1>
        <?php
            if($insert == true){
                echo "<p class='submitMsg'>Table inserted successful</p>";
            }
        ?>
        <!-- form for insert -->
        <form action="order.php" method="post">
            <input type="int" required name="orderid" id="orderid" placeholder="Order id">
            <input type="int"  name="empid" id="empid" placeholder="Employee id">
            <input type="int" required name="custid" id="custid" placeholder="Customer id">
            <input type="text" required name="menuid" id="menuid" placeholder="Menu id">
            <input type="date" name="ordate" id="ordate" placeholder="Date of order">
            <input type="time" name="ordtime" id="ordtime" placeholder="Time of order">
            <!-- <input type="number" required step="any" name="tot_pay" id="tot_pay" placeholder="Amount"> -->
            <input type="text" name="cmnt" id="cmnt" placeholder="Comments">
            <input type="int" name="done" id="done" placeholder="Status">
            <button class="btn">Submit</button> 
        </form>
        
        <hr>
        
        <!-- delete operation -->
        <h1>Delete an order</h1>
        <p>Enter an Order Id to be deleted</p>
        <?php
            if($dele == true){
                echo "<p class='submitMsg'>Row deleted Successfully</p>";
            }
        ?>
        <form action="order.php" method="post">
            <input type="int" required name="orderid" id="orderid" placeholder="Orderid">
            <button class="btn">Delete</button> 
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
