<?php

include("connect.php");    //Put in init.php  
include('functions.php');

$pricefrom=0;
$priceto=20000;
if (isset($_GET['search'])) {
  $pname = $_GET['name'];
  if($pname==null){
    $pname="";
  }
  $pricefrom = $_GET['pricefrom'];
  $priceto = $_GET['priceto'];
  $country = $_GET['country'];
 
  $categroy = $_GET['category'];


  
 
    $products = (mysqli_query($connect, "select * from products where (name like '%$pname%' or nameEn like '%$pname%') and (`country` like '%$country%' or `countryEn` like '%$country%') and (price between $pricefrom and $priceto) "));

    if($categroy>0){
    
      $products = (mysqli_query($connect, "select * from products where (name like '%$pname%' or nameEn like '%$pname%') and (`country` like '%$country%' or `countryEn` like '%$country%') and (price between $pricefrom and $priceto) and category_id='$categroy'"));
  
     
    }
   
 

}

?>



<!DOCTYPE html>
<html lang="" dir="<?php echo $header['direction']; ?>">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Store</title>

  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" /> <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <link href="./lib/bootstrap/bootstrap.css" rel="stylesheet" />
  <link href="./lib/bootstrap/bootwatch.css" rel="stylesheet" />
  <link href="index.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>






</head>

<body>
  <?php include('header.php') ?>
  <div class="container">


    <!-- end hero section -->
    <div class="productsnew text-light">
      <h3 class="hero-title"><?php echo $header['search-title'] ?></h3>
      <form method="get" action="">
        <fieldset>
          <div class="form-group row mt-4">
            <label for="staticEmail" class="col-sm-2 text-light col-form-label"><?php echo $header['search-product-name'] ?></label>
            <div class="col-sm-10">
              <input value="<?php echo $pname?>" type="text" class="form-control" name="name" id="name">
            </div>
          </div>

          <div class="form-group row mt-4">
            <label for="staticEmail" class="col-sm-2 text-light col-form-label"><?php echo $header['search-price-from'] ?></label>
            <div class="col-sm-4">
              <input type="number" class="form-control" name="pricefrom" id="pricefrom" value="<?php echo $pricefrom?>">
            </div>
            <label for="staticEmail" class="col-sm-2 text-light col-form-label"><?php echo $header['search-price-to'] ?></label>
            <div class="col-sm-4">
              <input type="number" class="form-control" name="priceto" id="priceto" value="<?php echo $priceto?>">
            </div>
          </div>


          <div class="form-group row mt-4">
            <label for="staticEmail" class="col-sm-2 text-light col-form-label"><?php echo $header['search-country'] ?></label>
            <div class="col-sm-4">

              <input value="<?php echo $country?>" type="text" class="form-control" name="country" id="country">
            </div>
            <label for="staticEmail" class="col-sm-2 text-light col-form-label"><?php echo $header['search-category-name'] ?></label>
            <div class="col-sm-4">
              <?php
              $sql = "SELECT * FROM `categories`";
              $result = mysqli_query($connect, $sql);



              ?>
              <select class="form-select bg-black text-light" name="category" id="category">
                <option value="0"><?php if ($header['langname'] == 'Ar') echo 'الكل';
                                  else if ($header['langname'] == 'En') echo 'All'; ?></option>
                <?php while ($row = mysqli_fetch_array($result)) {  ?>
                  <option <?php if($categroy==$row['id']) echo 'selected' ?> value="<?php echo $row['id'] ?>"><?php if ($header['langname'] == 'Ar') echo $row['name'];
                                                            else if ($header['langname'] == 'En') echo $row['nameEn']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group row mt-2">
            <div class="col-2"></div>
            <div class="col-2">
              <input type="submit" name="search" value="<?php echo $header['search-btn-search'] ?>" class="btn btn-primary mt-1">

            </div>
          </div>
        </fieldset>
      </form>
      <br>
      <div class="row row-cols-1 row-cols-md-4 g-4">
        
          <?php 
          $numOfRows =  mysqli_num_rows($products);
          if($numOfRows>0) {
          ?>
      
        <?php while ($product = mysqli_fetch_array($products)) { ?>
          <a href="productdetails.php?productid=<?php echo $product['id']; ?>">
            <div class="col">
              <div class="card bg-light">
                <img src="images/products/<?php echo $product['image'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php if ($header['langname'] == 'Ar') echo $product['name'];
                                          else if ($header['langname'] == 'En') echo $product['nameEn']; ?></h5>
                  <p class="card-text"><strong><?php if ($header['langname'] == 'Ar')
                                                  echo 'الفئة:';
                                                else if ($header['langname'] == 'En')
                                                  echo 'Category:' ?></strong> <span><?php $catid = $product['category_id'];
                                                                                      $sqlcat = mysqli_query($connect, "SELECT * FROM `categories` where `id` = '$catid'");
                                                                                      $cat = mysqli_fetch_assoc($sqlcat);
                                                                                      if ($header['langname'] == 'Ar')
                                                                                        echo $cat['name'];
                                                                                      else if ($header['langname'] == 'En')
                                                                                        echo $cat['nameEn'];
                                                                                      ?></p>
                  <p class="catrd-text"><strong><?php if ($header['langname'] == 'Ar')
                                                  echo 'السعر:';
                                                else if ($header['langname'] == 'En')
                                                  echo 'Price:' ?></strong> <span><?php echo $product['price'] ?></span> </p>
                </div>
              </div>
            </div>
          </a>
        <?php }}else{
          echo "<h3>". $header['search-results-message'] ."</h3>";
        } ?>








      </div>

    </div>









</body>
<?php include('footer.php') ?>

</html>