<?php
include("connect.php");    //Put in init.php  

function upload_image()
{
    if (isset($_FILES["categoryimage"])) {
        $extension = explode('.', $_FILES['categoryimage']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = 'images/categories/' . $new_name;
        move_uploaded_file($_FILES['categoryimage']['tmp_name'], $destination);
        return $new_name;
    }
}


if (count($_POST) > 0) {

    if ($_POST['type'] == 1) {

        $name = $_POST['catgeorynameAr'];
        $nameEn = $_POST['catgeorynameEn'];
        $image = '';
        $createDate = date('Y-m-d H:i:s');

        if ($_FILES["categoryimage"]["name"] != '') {
            $image = upload_image();
        }



        $sql = "INSERT INTO `categories`( `name`, `nameEn`, `image`,`created_at`) 
        VALUES
        ('$name','$nameEn','$image','$createDate')";
        if (mysqli_query($connect, $sql)) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
    }
}


if (count($_POST) > 0) {
    if ($_POST['type'] == 2) {
        $categoryID = $_POST['id'];
        $name = $_POST['catgeorynameAr'];
        $nameEn = $_POST['catgeorynameEn'];
        $image = '';
        $updateDate = date('Y-m-d H:i:s');

        if ($_FILES["categoryimage"]["name"] != '') {
            $image = upload_image();
        } else {
            $image = $_POST["hidden_user_image"];
        }
        $sql = "UPDATE `categories` SET
         `name`='$name',`nameEn`='$nameEn',`image`='$image',`updated_at`='$updateDate'
          WHERE `id`='$categoryID'";
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
        $sql = "DELETE FROM `categories` WHERE `id`=$id ";
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
        $sql = "DELETE FROM `categories` WHERE `id` in ($id)";
        if (mysqli_query($connect, $sql)) {
            echo $id;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
        mysqli_close($connect);
    }
}
