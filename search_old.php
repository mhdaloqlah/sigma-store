<?php

include("connect.php");    //Put in init.php  
include('functions.php');


if(isset($_GET['search'])){
  
  
  //$username = $_POST['Username'];
  $pname = $_POST['name'];
  $pricefrom= $_POST['pricefrom'];
  $priceto= $_POST['priceto'];
   
 // $row = (mysqli_query($connect, "select * from products where (name like '%$pname%' or nameEn like '%$pname%') and (price between $pricefrom and $priceto) "));
  $row = (mysqli_query($connect, "select * from products where (name like '%$pname%' or nameEn like '%$pname%') "));
  




  while ($row1 = mysqli_fetch_array($row)) {  ?>
    <div class="productsnew text-light">
     <option value="<?php echo $row1['id'] ?>"><?php if ($header['langname'] == 'Ar') {
                                                         $MyName = $row1['name'];
                                                         $Desc   = $row1['description'];
                                              } else if ($header['langname'] == 'En') {
                                                         $MyName = $row1['nameEn'];
                                                         $Desc   = $row1['descriptionEn'];
                                              } ?>
     </option>
     <div class="row row-cols-1 row-cols-md-4 g-4">
      <div class="col">
        <div class="card bg-light">
            <img src="images/assets/bg.png" class="card-img-top" alt="...">
            <div class="card-body">
                  <h5 class="card-title"><?php echo $myvalue; ?></h5>
                  <p class="card-text"><?php echo $Desc; ?></p>
            </div>
        </div>
      </div>        
     </div>
    </div>
  <?php } 

 
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
      <form>
        <fieldset>
          <div class="form-group row mt-4">
            <label for="staticEmail" class="col-sm-2 text-light col-form-label"><?php echo $header['search-product-name'] ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control text-light" name="name" id="name">
            </div>
          </div>

          <div class="form-group row mt-4">
            <label for="staticEmail" class="col-sm-2 text-light col-form-label"><?php echo $header['search-price-from'] ?></label>
            <div class="col-sm-4">
              <input type="number" class="form-control text-light" id="pricefrom" name="pricefrom" value="0" >
            </div>
            <label for="staticEmail" class="col-sm-2 text-light col-form-label"><?php echo $header['search-price-to'] ?></label>
            <div class="col-sm-4">
              <input type="number" class="form-control text-light" id="priceto" name="priceto" value="10000">
            </div>
          </div>

          <div class="form-group row mt-4">
            <label for="staticEmail" class="col-sm-2 text-light col-form-label"><?php echo $header['search-country'] ?></label>
            <div class="col-sm-4">

              <select class="form-select bg-black text-light" name="country" id="country">
                <option value="*"><?php if ($header['langname'] == 'Ar') echo 'الكل';
                                  else if ($header['langname'] == 'En') echo 'All'; ?></option>
                <option value="uae">
                  <?php if ($header['langname'] == 'Ar') echo 'الإمارات العربية المتحدة';
                  else if ($header['langname'] == 'En') echo 'UAE'; ?></option>

                <option value="Syria">
                  <?php if ($header['langname'] == 'Ar') echo 'الجمهورية العربية السورية';
                  else if ($header['langname'] == 'En') echo 'Syria'; ?></option>

              </select>
            </div>
            <label for="staticEmail" class="col-sm-2 text-light col-form-label"><?php echo $header['search-category-name'] ?></label>
            <div class="col-sm-4">
              <?php
              $sql = "SELECT * FROM `categories`";
              $result = mysqli_query($connect, $sql);



              ?>
              <select class="form-select bg-black text-light" name="category" id="category">
                <option value="*"><?php if ($header['langname'] == 'Ar') echo 'الكل';
                                  else if ($header['langname'] == 'En') echo 'All'; ?></option>
                <?php while ($row = mysqli_fetch_array($result)) {  ?>
                  <option value="<?php echo $row['id'] ?>"><?php if ($header['langname'] == 'Ar') echo $row['name'];
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
       
    </div>


</body>
<?php include('footer.php') ?>

</html>