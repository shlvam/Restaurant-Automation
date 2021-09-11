<?php include("header.php");  
  include("managemenu.php");
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Apna Restaurant</title>
      <!-- <link rel = "icon" href =  "img/AR.jpg" type = "image/x-icon">  -->
  </head>
  <body>

  <div class="container">
    <div class="row">
        <div class="col-lg-4">
          <div class="card" >
            <img src="<?php echo "$link3";?>" class="card-img-top" >
                <form action = "manageorder.php" method="POST">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo "$food3";?></h5>
                    <p class="card-text"><?php echo "$price3";?></p>
                    <button type="submit" name="add_to_cart"class="btn btn-danger">Add To Cart</button>
                    <input type="hidden" name="menu_id" value="<?php echo "$mid3";?>">
                    <input type="hidden" name="item_name" value="<?php echo "$food3";?>">
                    <input type= "hidden" name="price" value="<?php echo "$price3";?>">
                 </div>
                 </form>
           </div>  
        </div>
        <div class="col-lg-4">
          <div class="card" >
            <img src="<?php echo "$link1";?>" class="card-img-top" >
                <form action = "manageorder.php" method="POST">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo "$food1";?></h5>
                    <p class="card-text"><?php echo "$price1";?></p>
                    <button type="submit" name="add_to_cart" class="btn btn-danger">Add To Cart</button>
                    <input type="hidden" name="menu_id" value="<?php echo "$mid1";?>">
                    <input type="hidden" name="item_name" value="<?php echo "$food1";?>">
                    <input type= "hidden" name="price" value="<?php echo "$price1";?>">
                 </div>
                 </form>
           </div>  
        </div>
        <div class="col-lg-4">
          <div class="card" >
            <img src="<?php echo "$link2";?>" class="card-img-top" >
                <form action = "manageorder.php" method="POST">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo "$food2";?></h5>
                    <p class="card-text"><?php echo "$price2";?></p>
                    <button type="submit" name="add_to_cart" class="btn btn-danger">Add To Cart</button>
                    <input type="hidden" name="menu_id" value="<?php echo "$mid2";?>">
                    <input type="hidden" name="item_name" value="<?php echo "$food2";?>">
                    <input type= "hidden" name="price" value="<?php echo "$price2";?>">
                 </div>
                 </form>
           </div>  
        </div>
        <div class="col-lg-4">
          <div class="card" >
            <img src="<?php echo "$link4";?>"  class="card-img-top" >
                <form action = "manageorder.php" method="POST">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo "$food4";?></h5>
                    <p class="card-text"><?php echo "$price4";?></p>
                    <button type="submit" name="add_to_cart" class="btn btn-danger">Add To Cart</button>
                    <input type="hidden" name="menu_id" value="<?php echo "$mid4";?>">
                    <input type="hidden" name="item_name" value="<?php echo "$food4";?>">
                    <input type= "hidden" name="price" value="<?php echo "$price4";?>">
                </div>
                 </form>
           </div>  
        </div>
        <div class="col-lg-4">
          <div class="card" >
            <img src="<?php echo "$link5";?>"  class="card-img-top" >
                <form action = "manageorder.php" method="POST">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo "$food5";?></h5>
                    <p class="card-text"><?php echo "$price5";?></p>
                    <button type="submit" name="add_to_cart" class="btn btn-danger">Add To Cart</button>
                    <input type="hidden" name="menu_id" value="<?php echo "$mid5";?>">
                    <input type="hidden" name="item_name" value="<?php echo "$food5";?>">
                    <input type= "hidden" name="price" value="<?php echo "$price5";?>">
                </div>
                 </form>
           </div>  
        </div>
        <div class="col-lg-4">
          <div class="card" >
            <img src="<?php echo "$link6";?>"  class="card-img-top" >
                <form action = "manageorder.php" method="POST">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo "$food6";?></h5>
                    <p class="card-text"><?php echo "$price6";?></p>
                    <button type="submit" name="add_to_cart" class="btn btn-danger">Add To Cart</button>
                    <input type="hidden" name="menu_id" value="<?php echo "$mid6";?>">
                    <input type="hidden" name="item_name" value="<?php echo "$food6";?>">
                    <input type= "hidden" name="price" value="<?php echo "$price6";?>">
                </div>
                 </form>
           </div>  
        </div>
    </div>
  </div>
    
  </body>
</html>