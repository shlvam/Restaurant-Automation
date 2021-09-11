<?php
session_start();


if ($_SERVER["REQUEST_METHOD"]=="POST")
 {
  if(isset($_POST['add_to_cart']))
  {
	if(isset($_SESSION['cart']))
	{
		$myitems=array_column($_SESSION['cart'],'menu_id');
		if(in_array($_POST['menu_id'],$myitems))
		{
			echo"<script>
			alert('Item Already Added');
			window.location.href='Menu_cust.php';
			</script>";
		}
		else
		{
		$count=count($_SESSION['cart']);
		$_SESSION['cart'][$count]=array('menu_id'=>$_POST['menu_id'],'price'=>$_POST['price'],'item_name'=>$_POST['item_name'],'Quantity'=>1);
		
		echo"<script>
			alert('Item Added');
			window.location.href='Menu_cust.php';
			</script>";
		}
	}
	else
	{
		$_SESSION['cart'][0]=array('menu_id'=>$_POST['menu_id'],'price'=>$_POST['price'],'item_name'=>$_POST['item_name'],'Quantity'=>1);
			echo"<script>
			alert('Item Added');
			window.location.href='Menu_cust.php';
			</script>";
		
	}
  }
  
  if(isset($_POST['remove_item']))
  {
		foreach($_SESSION['cart']as $key=>$value)
		{
			if($value['item_name']==$_POST['item_name'])
			unset($_SESSION['cart'][$key]);
			$_SESSION['cart']=array_values($_SESSION['cart']);
			echo"<script>
			alert('item removed')
			window.location.href='Order_cust.php';
			</script>";
		}
  }
 }
 ?>