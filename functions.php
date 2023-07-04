<?php


function make_lang(){
  
  if($_POST['ar']){
    $_SESSION['arabic']=true;
    unset($_SESSION['english']);
  }

  if($_POST['en']){
    $_SESSION['english']=true;
    unset($_SESSION['arabic']);
  }
}

function lang_path(){

  if(!isset($_SESSION['english'])){
    $_SESSION['arabic']=true; 
  }

  if(isset($_SESSION['arabic'])){
    $lang='ar';
  }

  if(isset($_SESSION['english'])){
    $lang='en';
  }

  $path = dirname(__FILE__)."/lang/".$lang.".php";
  return $path;
}
make_lang();
$lang_file =lang_path();
include($lang_file);

?>

