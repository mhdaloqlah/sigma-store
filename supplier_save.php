<?php
include("connect.php");    //Put in init.php  

function upload_image()
{
    if (isset($_FILES["supplierimage"])) {
        $extension = explode('.', $_FILES['supplierimage']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = 'images/suppliers/' . $new_name;
        move_uploaded_file($_FILES['supplierimage']['tmp_name'], $destination);
        return $new_name;
    }
}


if (count($_POST) > 0) {

    if ($_POST['type'] == 1) {

        $name = $_POST['suppliernameAr'];
        $nameEn = $_POST['suppliernameEn'];
        $addressAr = $_POST['addressAr'];
        $addressEn = $_POST['addressEn'];
        $countryAr = $_POST['countryAr'];
        $countryEn = $_POST['countryEn'];
        $cityAr = $_POST['cityAr'];
        $cityEn = $_POST['cityEn'];
        $domain = $_POST['domain'];
        $phone = $_POST['phone'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $longitude = $_POST['longitude'];
        $latitude = $_POST['latitude'];
        $createDate = date('Y-m-d H:i:s');

        $image = '';
        if ($_FILES["supplierimage"]["name"] != '') {
            $image = upload_image();
        }



        $sql = "INSERT INTO `suppliers`
        (`name`, `nameEn`, `address`, `addressEn`, `country`, `countryEn`, `city`, `cityEn`, `domain`, `phone`, `mobile`, `email`, `image`, `longitude`, `Latitude`,`created_at`)
         VALUES
          ('$name','$nameEn','$addressAr','$addressEn','$countryAr','$countryEn','$cityAr','$cityEn','$domain','$phone','$mobile','$email','$image','$longitude','$latitude','$createDate')";
        if (mysqli_query($connect, $sql)) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
    }
}


if (count($_POST) > 0) {
    if ($_POST['type'] == 2) {
        $supplierID = $_POST['id'];
        $name = $_POST['suppliernameAr'];
        $nameEn = $_POST['suppliernameEn'];
        $addressAr = $_POST['addressAr'];
        $addressEn = $_POST['addressEn'];
        $countryAr = $_POST['countryAr'];
        $countryEn = $_POST['countryEn'];
        $cityAr = $_POST['cityAr'];
        $cityEn = $_POST['cityEn'];
        $domain = $_POST['domain'];
        $phone = $_POST['phone'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $longitude = $_POST['longitude'];
        $latitude = $_POST['latitude'];
        $updateDate = date('Y-m-d H:i:s');

        $image = '';
        if ($_FILES["supplierimage"]["name"] != '') {
            $image = upload_image();
        } else {
            $image = $_POST["hidden_user_image"];
        }
        $sql = "UPDATE `suppliers` SET `name`='$name',`nameEn`='$nameEn',
        `address`='$addressAr',`addressEn`='$addressEn',
        `country`='$countryAr',`countryEn`='$countryEn',
        `city`='$cityAr',`cityEn`='$cityEn',`domain`='$domain',
        `phone`='$phone',`mobile`='$mobile',`email`='$email',`image`='$image',
        `longitude`='$longitude',`Latitude`='$latitude',
        `updated_at`='$updateDate' WHERE `id`='$supplierID'";
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
        $sql = "DELETE FROM `suppliers` WHERE `id`=$id ";
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
        $sql = "DELETE FROM `suppliers` WHERE `id` in ($id)";
        if (mysqli_query($connect, $sql)) {
            echo $id;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
        mysqli_close($connect);
    }
}
