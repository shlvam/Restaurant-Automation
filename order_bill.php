<!-- get data about an order -->
<?php
	if(isset($_GET['ti'])){
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
	    $orderid=$_GET['ti'];

	    //fetch all columns with the help of primary key
	    $sql_show="SELECT * FROM `restaurant`.`orders` WHERE `orderid`='$orderid'";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bill generator</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="tab.css">
</head>
<body>
	<div class="container">
        <h1>Apna Restaurant</h1>

        <!-- Customer details -->
        <table>
        <?php
            $custid = $row['custid'];
                $server = "localhost";
                $username = "root";
                $password = "";

                // Create a database connection
                $con = mysqli_connect($server, $username, $password);

                // Check for connection success
                if(!$con){
                    die("connection to this database failed due to" . mysqli_connect_error());
                }        
                $sql_cust="SELECT * FROM `restaurant`.`customer` WHERE `custid`='$custid'";
                $result=$con->query($sql_cust);
                if($result-> num_rows > 0){
                    //print each data row by row
                    $row_cust = $result->fetch_assoc();
                        echo "
                        <tr>
                            <td>Name: </td>
                            <td>". $row_cust["cname"]." ". $row_cust["surname"]."</td>
                        </tr><tr>
                            <td>Contact no.: </td>
                            <td>". $row_cust["mobile"]."</td>
                        </tr><tr>
                            <td>Address: </td>
                            <td>". $row_cust["address"]." ". $row_cust["zipcode"]."</td>
                        </tr>";
                }else{
                    echo "0 result";
                }

                // editbtn -> for button not working
                // Close the database connection
                $con->close();
        ?>    
        </table>

        <!-- Menu detals -->
        <table style="width:100%;">  
            <tr>
                <th>Menu id</th>
                <th>Food name</th>
                <th>price</th>
            </tr>
        <?php
            $id_arr = explode(',', $row['menuid']);
            // print_r($id_arr);

        $server = "localhost";
        $username = "root";
        $password = "";

        // Create a database connection
        $con = mysqli_connect($server, $username, $password);

        // Check for connection success
        if(!$con){
            die("connection to this database failed due to" . mysqli_connect_error());
        }
            $tot=0.00;
            foreach ($id_arr as $x) {
                $sql_qu="SELECT * FROM `restaurant`.`menu` WHERE `menuid`='$x'";
                $result=$con->query($sql_qu);
                if(($result-> num_rows) > 0){
                    while($row1 = $result->fetch_assoc()){
                        $tot=$tot + $row1["price"];
                        echo "<tr>
                                <td>". $row1["menuid"]."</td>
                                <td>". $row1["food_name"]."</td>
                                <td>". $row1["price"]."</td>
                            </tr>";
                    }
                }
            }
            echo "<tr><td>Total price</td><td></td><td>".$tot."</td></tr>";

            // Close the database connection
            $con->close();
        ?>
        </table>
    </div>
	
</body>
</html>

