<?php

session_start();    //start the session
session_unset();    //unset data
session_destroy();
     // destroy the session


 header('location: index.php');


?>