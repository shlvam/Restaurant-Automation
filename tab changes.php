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
    $sql = "INSERT INTO `restaurant`.`tab`(`tab_id`, `nchair`) VALUES ('$tab_id', '$nchair')";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New table entry</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="tab.css">
</head>
<body>

    <div class="container">
    	<!-- for search with a key -->
    	<div>
    		<h2>SEARCH</h2>
    		<form action="tab_search.php" method="post">
            	<input type="int" name="tab_id" id="tab_id" placeholder="Enter a table id">
            	<button class="btn">Search</button> 
        	</form>
    	</div>
    	<hr>

        <table>
            <!-- displaying data in table -->
            <h1>TABLE DATA</h1>
            <tr>
                <th>Table id</th>
                <th>No of chair</th>
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
                $sql_show="SELECT * FROM `restaurant`.`tab`";
                $result=$con->query($sql_show);
                if($result-> num_rows > 0){
                    //print each data row by row
                    while($row = $result->fetch_assoc()){
                        echo "
                        <tr>
                        	<td>". $row["tab_id"]."</td>
                        	<td>". $row["nchair"]."</td>
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
            <input type="int" name="tab_id" id="tab_id" placeholder="Enter new table id">
            
            <input type="int" name="nchair" id="nchair" placeholder="Enter no. of chairs">
            <button class="btn">Submit</button> 
        </form>
        
        <hr>
        
        <!-- delete operation -->
        <h1>Delete a table</h1>
        <p>Enter a table id to be deleted</p>
        <?php
            if($dele == true){
                echo "<p class='submitMsg'>Row deleted Successfully</p>";
            }
        ?>
        <form action="tab.php" method="post">
            <input type="int" name="tab_id" id="tab_id" placeholder="Enter a table id">
            <button class="btn">Delete</button> 
        </form>
    </div>
    <script src="index.js"></script>
    
</body>
</html>
