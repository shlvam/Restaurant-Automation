<?php include("header.php");  

?>


<!doctype html>
<html lang="en">
 
  <body>
  
  <div class="container">
	<div class="row">
		<div class="col-lg-12 text-center border rounded bg-light my-5">
		<h1> MY ORDER</h1>
		</div>


		<div class="col-lg-9">
		
            <table class="table text-center">
              <thead>
                <tr>
                  <th scope="col">Serial No.</th>
                  <th scope="col">Item Name</th>
                  <th scope="col">Item Price</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">  </th>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php
                    $total=0;
                    if(isset($_SESSION['cart']))
                    {
                    foreach($_SESSION['cart'] as $key => $value) 
                    {
                        $sr=$key+1;
                        $total=$total+$value['price'];
                        echo"
                        <tr>
                        <td>$sr</td>
                        <td>$value[item_name]</td>
                        <td>$value[price]</td>
                        <td>1</td>
                        <td>
                        <form action='manageorder.php' method='POST'>
                        <button name ='remove_item' class='btn btn-sm btn-outline-danger'>REMOVE</button></td>
                        <input type='hidden' name='item_name' value='$value[item_name]'>
                        
                        </form>
                        </tr>
                        ";
                    }
                    }
                
                
                ?>          
              </tbody>
            </table>
		</div>
        <div class="col-lg-2 ">
         
             <table class="table">
              <thead>
                <tr>
                  <th scope="col">Total</th>
                </tr>
                </thead>
               <tbody >
               <tr>
               <td><?php $_SESSION['total']=$total; echo $total?></td>
               </tr>
               <tr>
               <td>
              
               </td>
               </tr>
               </tbody>
            </div>
            </div>

        <div class="col-lg-1 ">
         
             <table class="table">
              <thead>
                <tr>
                  <th scope="col">Comments</th>
                </tr>
                </thead>
               <tbody >
               <tr>
               <td>
                <form action = "Orderdb.php" method="POST">
               <div class="mb-3">
                  <textarea class="form-control" name="comment" id="comment" rows="5"></textarea>
                </div>
               <button type="submit" name="confirm" class="btn btn-primary btn-block">Confirm</button>
               </form>

               </td>
               </tr>
               </tbody>
            </div>
        </div>

	</div>
  </div>


  </body>
</html>
