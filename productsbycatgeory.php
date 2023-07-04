<?php

include("connect.php");
include('functions.php');
$categoryid = $_GET['categoryid'];


$sqlcat = mysqli_query($connect, "SELECT * FROM `categories` where `id` = '$categoryid'");
$cat = mysqli_fetch_assoc($sqlcat);
 


$products = (mysqli_query($connect, "select * from products where category_id='$categoryid'"));

$catgeorynameEn = $_GET['mhd'];
?>

<!DOCTYPE html>
<html dir="<?php echo $header['direction']; ?>">

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


    <!-- end hero section -->
    <div class="productsnew text-light">
      <h3 class="hero-title"><?php  if ($header['langname'] == 'Ar')
             echo $cat['name']; else if ($header['langname'] == 'En') echo $cat['nameEn']; ?></h3>


      <br>
      <div class="row row-cols-1 row-cols-md-4 g-4">

        <?php
        $numOfRows =  mysqli_num_rows($products);
        if ($numOfRows > 0) {
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
        <?php }
        } else {
          echo "<h3>" . $header['search-results-message'] . "</h3>";
        } ?>








      </div>

    </div>









</body>
<?php include('footer.php') ?>

</html>