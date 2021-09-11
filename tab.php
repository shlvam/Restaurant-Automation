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

        $tab_id=$_GET['oid'];
        $bked=$_GET['dn'];
        if($bked == 0){
            $bked=1;
        }else{
            $bked=0;
        }

        $sql_qu="UPDATE `restaurant`.`tab` SET `bked`='$bked' WHERE `tab_id`='$tab_id'";
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
if(isset($_POST['tab_id']) and !(isset($_POST['nchair']))){
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
    $tab_id = $_POST['tab_id'];
    //$sql = "INSERT INTO `restaurant`.`tab`(`tab_id`, `nchair`) VALUES ('$tab_id', '$nchair')";
    $sql = "DELETE FROM `restaurant`.`tab` WHERE `tab_id` = '$tab_id'";
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
if(isset($_POST['nchair'], $_POST['tab_id'])){
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
    $tab_id = $_POST['tab_id'];
    $nchair = $_POST['nchair'];
    $bked = $_POST['bked'];
    $sql = "INSERT INTO `restaurant`.`tab`(`tab_id`, `nchair`,`bked`) VALUES ('$tab_id', '$nchair', '$bked')";
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




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="tab.css">

    <title>Apna Restaurant - Tables</title>
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
        <h1>TABLE</h1>
        <!-- for search with a key -->
        <div>
            <form action="tab_search.php" method="post">
                <input type="int" required name="tab_id" id="tab_id" placeholder="Table id">
                <button class="btn">Search</button> 
            </form>
        </div>
        <hr>

        <table style="width:100%;">
            <!-- displaying data in table -->
            
            <tr>
                <th>Table id</th>
                <th>No of chair</th>
                <th>Booked</th>
                <th>Operations</th>
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
                $sql_show="SELECT * FROM `restaurant`.`tab`";
                $result=$con->query($sql_show);
                if($result-> num_rows > 0){
                    //print each data row by row
                    while($row = $result->fetch_assoc()){
                        echo "
                        <tr>
                            <td>". $row["tab_id"]."</td>
                            <td>". $row["nchair"]."</td>
                            <td>". $row["bked"]."</td>
                            <td><a href = 'tab.php?oid=$row[tab_id] & dn=$row[bked]'><input type='submit' value='0/1' class='btn'></td>
                            <td><a href = 'tabedit.php?ti=$row[tab_id] & nc=$row[nchair]'><input type='submit' value='Update' class='btn'></td>

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
        <h1>New Table</h1>
        <?php
            if($insert == true){
                echo "<p class='submitMsg'>Table inserted successful</p>";
            }
        ?>
        <!-- form for insert -->
        <form action="tab.php" method="post">
            <input type="int" required name="tab_id" id="tab_id" placeholder="New table id">
            <input type="int" required name="nchair" id="nchair" placeholder="No. of chairs">
            <input type="int" name="bked" id="bked" placeholder="Booked">
            <button class="btn">Submit</button> 
        </form>
        
        <hr>
        
        <!-- delete operation -->
        <h1>Remove a table</h1>
        <p>Enter a table id to be removed</p>
        <?php
            if($dele == true){
                echo "<p class='submitMsg'>Row deleted Successfully</p>";
            }
        ?>
        <form action="tab.php" method="post">
            <input type="int" required name="tab_id" id="tab_id" placeholder="Table id">
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





