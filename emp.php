<?php
  session_start();

  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: emp_signin.php");
    exit;
  }
?>

<!--php for deleting new row -->
<?php
$dele = false;
//Primary key should be there
if(isset($_POST['empid']) and !(isset($_POST['mobile']))){
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
    $empid = $_POST['empid'];
    //$sql = "INSERT INTO `restaurant`.`tab`(`tab_id`, `nchair`) VALUES ('$tab_id', '$nchair')";
    $sql = "DELETE FROM `restaurant`.`employee` WHERE `empid` = '$empid'";
    // echo $sql;
    
    // Execute the query
    if($con->query($sql) == true){
        // echo "Successfully inserted";

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
if(isset($_POST['mobile'], $_POST['empid'])){
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
    $empid = $_POST['empid'];
    $ename = $_POST['ename'];
    $surname = $_POST['surname'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $role = $_POST['role'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $zipcode = $_POST['zipcode'];
    
    $ex_sql="SELECT * FROM `restaurant`.`employee` WHERE `empid` ='$empid'";
    $ex_result=mysqli_query($con, $ex_sql);
    $ex_num_row=mysqli_num_rows($ex_result);
    if($ex_num_row >0){
    	echo "Employee id already exist";
    	echo"<script>
            alert('Employee id already exist');            
            </script>";
    	// header("location: emp.php");
    }else{
    	if($pass == $cpass){
            $hash1=password_hash($pass, PASSWORD_DEFAULT);
		    $sql="INSERT INTO `restaurant`.`employee`(`empid`, `ename`, `surname`, `pass`, `role`, `mobile`, `address`, `zipcode`) VALUES ('$empid', '$ename', '$surname', '$hash1', '$role', '$mobile', '$address', '$zipcode')";
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
    		echo "Passwords are different";
    		echo"<script>
            alert('Passwords are different');            
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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="emp.css">
    <link rel="stylesheet" href="tab.css">
    <title>Apna Restaurant - Employees</title>
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
    	<h1>Employees</h1>
    	<div>
    		<form action="emp_search.php" method="post">
            	<input type="int" required name="emp_id" id="emp_id" placeholder="Employee id">
            	<button class="btn">Search</button> 
        	</form>
    	</div>
    	<hr>
        <table style="width:100%;">
            <!-- displaying data in table -->
            
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Role</th>
                <th>Mobile no.</th>
                <th>Address</th>
                <th>Zipcode</th>
                <th>Operations</th>
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
                $sql_show="SELECT * FROM `restaurant`.`employee`";
                $result=$con->query($sql_show);
                if($result-> num_rows > 0){
                    //print each data row by row
                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                        		<td>". $row["empid"]."</td>
                        		<td>". $row["ename"]."</td>
                        		<td>". $row["surname"]."</td>
                        		<td>". $row["role"]."</td>
                        		<td>". $row["mobile"]."</td>
                        		<td>". $row["address"]."</td>
                        		<td>". $row["zipcode"]."</td>
                        		<td><a href = 'emp_edit.php?id=$row[empid]'><input type='submit' value='Update ' class='btn'></td>
                        	</tr>";
                    }
                    echo "</table>";
                }else{
                    echo "0 result";
                }


                // Close the database connection
                $con->close();
            ?>
        </table>

        <!-- for new entry -->
        <h1>New Employee</h1>
        <?php
            if($insert == true){
                echo "<p class='submitMsg'>Employee data inserted successful</p>";
            }
        ?>
        <form action="emp.php" method="post">
            <input type="int" required name="empid" id="empid" placeholder="Employee id">
            <input type="text" required name="ename" id="ename" placeholder="Your name">
            <input type="text" name="surname" id="surname" placeholder="Surname">
            <input type="password" required name="pass" id="pass" placeholder="Password">
            <input type="password" required name="cpass" id="cpass" placeholder="Confirm password">
            <input type="text" required name="role" id="role" placeholder="Role">
            <input type="phone" required name="mobile" id="mobile" placeholder="Mobile no.">
            <input type="text" required name="address" id="address" placeholder="Address">
            <input type="text" name="zipcode" id="zipcode" placeholder="Zipcode">
            <button class="btn">Submit</button> 
        </form>

        <!-- delete operation -->
        <h1>Remove an employee</h1>
        <p>Employee id to be deleted</p>
        <?php
            if($dele == true){
                echo "<p class='submitMsg'>Row deleted Successfully</p>";
            }
        ?>
        <form action="emp.php" method="post">
            <input type="int" required name="empid" id="empid" placeholder="Employee id">
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
