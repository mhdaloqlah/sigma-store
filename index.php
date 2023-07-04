<?php
include("connect.php");    //Put in init.php  


?>


<?php

include('functions.php');

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






</head>

<body>



  <?php include('header.php') ?>
  <div class="container">

    <!-- begin hero section -->
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">
          <div class="hero-main">
            <div class="row">
              <div class="col-lg-7">
                <div class="hero-text">
                  <h6 class="hero-subtitle"><?php echo $header['hero-subtitle'] ?></h6>
                  <h4 class="hero-title"><em><?php echo $header['hero-title-italic'] ?></em> <?php echo $header['hero-title'] ?></h4>
                  <div class="main-button">
                    <a class="btn btn-primary" href="search.php"><?php echo $header['hero-btn-browse'] ?></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end hero section -->
    <!-- begin new products  section -->

    <div class="productsnew">
      <h3 class="hero-title"><?php echo $header['new-product-section-name'] ?></h3>
      <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php $sqlproduct = "SELECT * FROM `products` order by id desc limit 8";
        $resultproducts = mysqli_query($connect, $sqlproduct);
        $i = 1;
        while ($product = mysqli_fetch_array($resultproducts)) { ?>
          <a href="productdetails.php?productid=<?php echo $product['id']; ?>">
            <div class="col">
              <div class="card bg-light">
                <img src="images/products/<?php echo $product['image'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php if ($header['langname'] == 'Ar') echo $product['name'];
                                          else if ($header['langname'] == 'En') echo $product['nameEn']; ?></h5>
                  <p class="card-text"><?php $catid = $product['category_id'];
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
        <?php } ?>


      </div>

    </div>
    <!-- end new products section -->
    <!-- begin category section -->
    <div class="productsnew">
      <h3 class="hero-title"><?php echo $header['new-category-section-name']  . ' ' .  $_SESSION['lang'] ?></h3>
      <div class="row row-cols-1 row-cols-md-4 g-4">


        <?php $sql = "SELECT * FROM `categories`";
        $result = mysqli_query($connect, $sql);
        $i = 1;
        while ($row = mysqli_fetch_array($result)) { ?>

          <a href="productsbycatgeory.php?categoryid=<?php echo $row['id'] ?>">
            <div class="col">
              <div class="card bg-dark text-white">
                <img src="images/categories/<?php echo $row['image'] ?>" style="border-radius: 10px;" class="card-img" alt="...">
                <div class="card-img-overlay">
                  <h5 style="text-align: center;vertical-align: middle;" class="card-title text-black text-primary">
                    <?php if ($header['langname'] == 'Ar')
                      echo $row['name'];
                    else if ($header['langname'] == 'En')
                      echo $row['nameEn']; ?>

                  </h5>
                 
                </div>
              </div>
            </div>
          </a>
        <?php } ?>

      </div>
      <!-- end new product section -->




    </div>
   
  </div>


  


</body>
<?php include('footer.php') ?>

</html>