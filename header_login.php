<?php 
session_start(); 
error_reporting(0);
ini_set('session.gc_maxlifetime', -1);
  include('lang.php');
  include('env.php');
  include "functions.php";

  if(isset($_COOKIE['tokenData'])) {
    
    $userDataDecode = decrypt($_COOKIE['tokenData'],secret_key);
    if($userDataDecode != ''){
      $userDatas = explode("|",$userDataDecode);
      print_r($userDatas);
      $_SESSION['user_id'] = $userDatas[0];
      $_SESSION['role_id'] = $userDatas[1];
      header("Location: dashboard.php");
    }
    
  }
  $lang = $en;
  if(isset($_COOKIE['mal_lang'])){
  
    if($_COOKIE['mal_lang'] == "hi"){
      $lang = $hi;
    }
  }

  $scrap_day = 365;
  $auct_day = 300;
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <!-- <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" /> -->
  <link href="./assets/css/now-ui-dashboard.css" rel="stylesheet" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/custom.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



  

