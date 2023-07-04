<?php

include("connect.php");
include('functions.php');

$noNavBar = '';
$pageTitle = 'Login';
date_default_timezone_set('Asia/Dubai');

$date_time = date("Y-m-d");
$messageLoginCheck = '';
if (isset($_SESSION['Username'])) {
  
    //header("location:SalesmanIndex.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    

    if ($username && $password) {


        $row = mysqli_fetch_array(mysqli_query($connect, "select * from users where name='$username' and Password='$password'"));
        
        //if count > 0 this user is in my DB
        if ($row['id']) {

            $_SESSION["login"] = $username;
            $_SESSION['Username'] = $username; // Register session name
            $_SESSION['ID'] = $row['id'];   // Register session ID
            
            $_SESSION['Email']  = $row['email'];
          
            
            header('location: index.php');  // redirect to dasboard page
             
        } else {
    
                echo "<script>alert('Username or password is wrong');</script>";
                $hata = 1;
         }}
}
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



<?php include('header.php')?>
<div class="container">




          
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col12">
                            <div>
                                <div class="card-body p-md-5">
                                    <div class="row justify-content-center">
                                        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                            <p class="text-center text-light h1 fw-bold mb-5 mx-1 mx-md-4 mt-4"><?php if($header['langname']=='Ar') echo 'دخول'; else if ($header['langname']=='En') echo 'Login' ?></p>

                                            <form method="post">
                                                <input class="form-control" placeholder="Username" type="text" name="Username" id="Username">
                                                <br>
                                                <input class="form-control" type="password" id="Password" name="Password" placeholder="password" aria-label="Password">
                                                <br> <button class="btn btn-primary" type="submit"><?php if($header['langname']=='Ar') echo 'دخول'; else if ($header['langname']=='En') echo 'Login' ?></button>

                                            </form>

                                        </div>
                                        <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                            <img src="images/assets/logo.png" class="img-fluid" alt="Sample image">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
             
            <!-- Marketing messaging and featurettes
                 ==================================== -->
            <!-- Wrap the rest of the page in another container to center all the content. -->



            <hr class="featurette-divider">

            <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->


    <!-- FOOTER -->
   
    </div>



    </body>
    <?php include('footer.php') ?>

    </html>