<?php
// $dele = false;
//Primary key should be there
if(isset($_POST['tab_id'])){
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
