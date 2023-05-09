<?php 
$server_name = "localhost";
$user_name = "root";
$password = "";
$database = "malkhana";

$conn = mysqli_connect($server_name,$user_name,$password,$database);

if(!$conn){
    die("Connection Failed!".mysqli_connect_error());
}

?>