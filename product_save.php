<?php
include("connect.php");    //Put in init.php  

function upload_image()
{
    if (isset($_FILES["productimage"])) {
        $extension = explode('.', $_FILES['productimage']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = 'images/products/' . $new_name;
        move_uploaded_file($_FILES['productimage']['tmp_name'], $destination);
        return $new_name;
    }
}


if (count($_POST) > 0) {

    if ($_POST['type'] == 1) {

        $name = $_POST['productnameAr'];
        $nameEn = $_POST['productnameEn'];
        $description = $_POST['descriptionAr'];
        $descriptionEn = $_POST['descriptionEn'];
        $addressAr = $_POST['addressAr'];
        $addressEn = $_POST['addressEn'];
        $countryAr = $_POST['countryAr'];
        $countryEn = $_POST['countryEn'];
        $cityAr = $_POST['cityAr'];
        $cityEn = $_POST['cityEn'];
        $price = $_POST['price'];
        $categoryid = $_POST['categoryList'];
        $supplierid = $_POST['supplierList'];
        $createDate = date('Y-m-d H:i:s');

        $image = '';
        if ($_FILES["productimage"]["name"] != '') {
            $image = upload_image();
        }


       
  $sql = "INSERT INTO `products`
  (`name`, `nameEn`, `price`,
   `description`, `descriptionEn`, `image`,
    `country`, `countryEn`, `city`, `cityEn`,
     `address`, `addressEn`, `category_id`, `supplier_id`,
      `created_at`) VALUES
       ('$name','$nameEn','$price',
      '$description','$descriptionEn','$image',
      '$countryAr','$countryEn','$cityAr','$cityEn',
      '$addressAr','$addressEn','$categoryid','$supplierid',
      '$createDate')";
   
        if (mysqli_query($connect, $sql)) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
    }
}


if (count($_POST) > 0) {
    if ($_POST['type'] == 2) {
        $productID = $_POST['id'];
        $name = $_POST['productnameAr'];
        $nameEn = $_POST['productnameEn'];
        $description = $_POST['descriptionAr'];
        $descriptionEn = $_POST['descriptionEn'];
        $addressAr = $_POST['addressAr'];
        $addressEn = $_POST['addressEn'];
        $countryAr = $_POST['countryAr'];
        $countryEn = $_POST['countryEn'];
        $cityAr = $_POST['cityAr'];
        $cityEn = $_POST['cityEn'];
        $price = $_POST['price'];
        $categoryid = $_POST['categoryList'];
        $supplierid = $_POST['supplierList'];

       
        $updateDate = date('Y-m-d H:i:s');

        $image = '';
        if ($_FILES["productimage"]["name"] != '') {
            $image = upload_image();
        } else {
            $image = $_POST["hidden_user_image"];
        }
        $sql = "UPDATE `products`
         SET `name`='$name',`nameEn`='$nameEn',`price`='$price',
         `description`='$description',`descriptionEn`='$descriptionEn',
         `image`='$image',
         `country`='$countryAr',`countryEn`='$countryEn',
         `city`='$cityAr',`cityEn`='$cityEn',
         `address`='$addressAr',`addressEn`='$addressEn',
         `category_id`='$categoryid',`supplier_id`='$supplierid',
         `updated_at`='$updateDate' WHERE `id`='$productID'";
        if (mysqli_query($connect, $sql)) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
        mysqli_close($connect);
    }
}


if (count($_POST) > 0) {
    if ($_POST['type'] == 3) {
        $id = $_POST['id'];
        $sql = "DELETE FROM `products` WHERE `id`=$id ";
        if (mysqli_query($connect, $sql)) {
            echo $id;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
        mysqli_close($connect);
    }
}
if (count($_POST) > 0) {
    if ($_POST['type'] == 4) {
        $id = $_POST['id'];
        $sql = "DELETE FROM `products` WHERE `id` in ($id)";
        if (mysqli_query($connect, $sql)) {
            echo $id;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
        mysqli_close($connect);
    }
}
