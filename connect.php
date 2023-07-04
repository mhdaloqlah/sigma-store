<?php

if (count(get_included_files()) == 1) {
    die("It is dangerous and forbidden to enter this area.");
}


// Veritabanı bilgileri
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "storedb";

error_reporting(0);
define('ROOT_DIR', dirname(__FILE__));
ob_start();



$connect = mysqli_connect("$db_host", "$db_username", "$db_password", "$dbname");

mysqli_query($connect, "set names utf8");
date_default_timezone_set('Asia/Dubai');
session_start();

if (!$connect) {
    die("Connection Failed : " . mysqli_connect_error());
}
