<!--php for deleting new row -->
<?php
$dele = false;
//Primary key should be there
if(isset($_POST['menuid']) and !(isset($_POST['price']))){
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
    $menuid = $_POST['menuid'];
    //$sql = "INSERT INTO `restaurant`.`tab`(`tab_id`, `nchair`) VALUES ('$tab_id', '$nchair')";
    $sql = "DELETE FROM `restaurant`.`menu` WHERE `menuid` = '$menuid'";
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
if(isset($_POST['price'], $_POST['menuid'])){
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
    $menuid = $_POST['menuid'];
    $food_name = $_POST['food_name'];
    $food_pic = $_POST['food_pic'];
    $price = $_POST['price'];
    
    $sql="INSERT INTO `restaurant`.`menu`(`menuid`, `food_name`, `food_pic`, `price`) VALUES ('$menuid', '$food_name', '$food_pic', '$price')";
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

    <title>Apna Restaurant - Menu</title>
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
        <h1>Menu</h1>
        <!-- for search with a key -->
        <div>
            <form action="menu_search.php" method="post">
                <input type="int" required name="menu_id" id="menu_id" placeholder="Menu id">
                <button class="btn">Search</button> 
            </form>
        </div>
        <hr>
        
        <table style="width:100%;">
            <!-- displaying data in table -->
            <tr>
                <th>Menu id</th>
                <th>Item name</th>
                <th>Image</th>
                <th>Price</th>
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
                $sql_show="SELECT * FROM `restaurant`.`menu`";
                $result=$con->query($sql_show);
                if($result-> num_rows > 0){
                    //print each data row by row
                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                                <td>". $row["menuid"]."</td>
                                <td>". $row["food_name"]."</td>
                                <td><img src=". $row["food_pic"]." width='120' height='70' class='img_center'></td>                                
                                <td>". $row["price"]."</td>
                                <td><a href = 'menu_edit.php?ti=$row[menuid]'><input type='submit' value='Update  ' class='btn'></td>
                            </tr>";
                    }
                    // echo $row['menuid'];
                    echo "</table>";
                }else{
                    echo "0 result";
                }


                // Close the database connection
                $con->close();
            ?>
        </table>

        <!-- for new entry -->
        <h1>New Item</h1>
        <?php
            if($insert == true){
                echo "<p class='submitMsg'>Food inserted successful</p>";
            }
        ?>
        <form action="menu.php" method="post">
            <input type="int" required name="menuid" id="menuid" placeholder="Menu id">
            <input type="text" required name="food_name" id="food_name" placeholder="Item name">
            <input type="text" name="food_pic" id="food_pic" placeholder="Food Image">
            <input type="text" required name="price" id="price" placeholder="Item price">
            <button class="btn">Submit</button> 
        </form>

        <!-- delete operation -->
        <h1>Delete an Item</h1>
        <p>Menu id to be deleted</p>
        <?php
            if($dele == true){
                echo "<p class='submitMsg'>Row deleted Successfully</p>";
            }
        ?>
        <form action="menu.php" method="post">
            <input type="int" name="menuid" id="menuid" placeholder="Menu id">
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
