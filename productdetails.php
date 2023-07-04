<?php

include("connect.php");    //Put in init.php  
include('functions.php');

$productid = $_GET['productid'];
$sqlproduct = mysqli_query($connect, "SELECT * FROM `products` where `id` = '$productid'");
$product = mysqli_fetch_assoc($sqlproduct);
$supid = $product['supplier_id'];
$sqlsupplier = mysqli_query($connect, "SELECT * FROM `suppliers` where `id` = '$supid'");
$supplier = mysqli_fetch_assoc($sqlsupplier);

?>



<!DOCTYPE html>
<html lang="" dir="<?php echo $header['direction']; ?>">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $header['siteName']; ?></title>

  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" /> <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <link href="./lib/bootstrap/bootstrap.css" rel="stylesheet" />
  <link href="./lib/bootstrap/bootwatch.css" rel="stylesheet" />
  <link href="index.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


<style>
  


.row{
  position: relative;
}

.row::before{
  content: ' ';
  display: block ;
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  opacity: 0.20;
  background-image: url('./images/assets/logo.png');
  background-size: contain;
  background-repeat: no-repeat;
  background-position: 50% 0;
}

</style>


</head>

<body>
  <?php include('header.php') ?>
  <div class="container">


    <!-- end hero section -->
    <div class="productsnew text-light">
      <h3 class="hero-title"></h3>


      <div class="card mb-3">

        <div class="card-body">
          <div class="row" id="aboutus">
            <div class="col-4">
              <img src="images/products/<?php echo $product['image'] ?>" class="card-img-top" alt="...">
            </div>
            <div class="col-8">
              <h3 class="card-title"><?php if ($header['langname'] == 'Ar') echo $product['name'];
                                      else if ($header['langname'] == 'En') echo $product['nameEn']; ?></h3>
              <p style="text-align: justify;" class="card-text"><?php if ($header['langname'] == 'Ar') echo $product['description'];
                                                                else if ($header['langname'] == 'En') echo $product['descriptionEn']; ?></p>
              <h5>
                <span><strong><?php echo $header['suppliername'] ?></strong><?php if ($header['langname'] == 'Ar') echo $supplier['name'];
                                                                else if ($header['langname'] == 'En') echo $supplier['nameEn']; ?></span>
              </h5>
              <h5>
                <span><strong><?php echo $header['productPrice'] ?></strong><?php echo $product['price'] ?></span>
              </h5>
              <h5>
                <span><strong><?php echo $header['productCountry'] ?></strong><?php if ($header['langname'] == 'Ar') echo $product['country'];
                                                                else if ($header['langname'] == 'En') echo $product['countryEn']; ?></span>
              </h5>
              <h5>
                <span><strong><?php echo $header['productCity'] ?></strong><?php if ($header['langname'] == 'Ar') echo $product['city'];
                                                                else if ($header['langname'] == 'En') echo $product['cityEn']; ?></span>
              </h5>
              <h5>
                <span><strong><?php echo $header['productAddress'] ?></strong><?php if ($header['langname'] == 'Ar') echo $product['address'];
                                                                else if ($header['langname'] == 'En') echo $product['addressEn']; ?></span>
              </h5>
            </div>
          </div>

        </div>
      </div>


    </div>

  </div>









</body>
<?php include('footer.php') ?>

</html>