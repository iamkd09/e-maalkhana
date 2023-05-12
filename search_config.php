<?php
   include('conn.php');
   include('header.php');
   $gd_number = $_SESSION['gd_number'];
   echo $gd_number;
   die;
   $query = "SELECT * FROM `inventory` WHERE `Gd_Number` = '$gd_number' ";
?>