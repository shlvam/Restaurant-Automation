<?php
session_start();


if ($_SERVER["REQUEST_METHOD"]=="POST")
 {
 	// Set connection variables
	    $server = "localhost";
	    $username = "root";
	    $password = "";

	    // Create a database connection
	    $con = mysqli_connect($server, $username, $password);

	    // Check for connection success
	    if(!$con)
		{
	        die("connection to this database failed due to" . mysqli_connect_error());
	    }





  if(isset($_POST['confirm']))
  {
		
		


	if(isset($_SESSION['cart']))
	{
		$count=count($_SESSION['cart']);
		if($count=='0')
		{
			echo"<script>
			alert('Please add some items');
			window.location.href='Order_cust.php';
			
			</script>";
		}
		else 
		{
		$mid="";
		foreach($_SESSION['cart']as $k=>$val)
		{
			$mid=$val['menu_id'].', '.$mid;
		}
		// echo $mid;
		// do later
	
		$sql="INSERT INTO `restaurant`.`orders`(`custid`,`menuid`, `tot_pay`,`cmnt`) VALUES ('$_SESSION[custid]','$mid', '$_SESSION[total]','$_POST[comment]')";

		if($con->query($sql) == true){
			echo"<script>
			alert('Done Successfull');
			window.location.href='Order_cust.php';
			
			</script>";
		}else{
			echo "Failed to update Record";
		}

	    // Close the database connection
	    $con->close();

		

			// $_SESSION['menu_id']=$val['menu_id'].",".$_SESSION[]';
			// $query="INSERT INTO orders(menuid) VALUES('$mid')";
			// if(mysqli_query($conn,$query))
			// {
			// 	echo"inserted ";

			// }
			// else
			// {
			// echo"error";
		
			// }

		
		}

	}

}
}



?>