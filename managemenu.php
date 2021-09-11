<?php


$servername ="localhost";
$username="root";
$password="";


$conn = mysqli_connect($servername,$username,$password,"restaurant");

if(!$conn)
{
	die("Failed to connect".mysqli_connect_error());
}




$query="SELECT * FROM menu where menuid= '1'";
if($result=mysqli_query($conn,$query))

{
	$row = mysqli_fetch_array($result);

   $food1= $row[1];
   $mid1=$row[0];
   $link1=$row[2];
   $price1=$row[3];
}
$query3="SELECT * FROM menu where menuid= '2'";
if($result=mysqli_query($conn,$query3))

{
	$row2 = mysqli_fetch_array($result);
   $food2= $row2[1];
   $mid2=$row2[0];
   $link2=$row2[2];
   $price2=$row2[3];
}
   

$query1="SELECT * FROM menu where menuid= '3'";
if($result=mysqli_query($conn,$query1))

{
	$row3 = mysqli_fetch_array($result);
   
   $food3= $row3[1];
   $mid3=$row3[0];
   $link3=$row3[2];
   $price3=$row3[3];


}
$query2="SELECT * FROM menu where menuid= '4'";
if($result=mysqli_query($conn,$query2))

{
	$row4 = mysqli_fetch_array($result);
   $food4= $row4[1];
   $mid4=$row4[0];
   $link4=$row4[2];
   $price4=$row4[3];
}
$query5="SELECT * FROM menu where menuid= '5'";
if($result=mysqli_query($conn,$query5))

{
	$row5 = mysqli_fetch_array($result);
   $food5= $row5[1];
   $mid5=$row5[0];
   $link5=$row5[2];
   $price5=$row5[3];
}
$query6="SELECT * FROM menu where menuid= '6'";
if($result=mysqli_query($conn,$query6))

{
	$row6 = mysqli_fetch_array($result);
   $food6= $row6[1];
   $mid6=$row6[0];
   $link6=$row6[2];
   $price6=$row6[3];
}


$conn->close();
?>
