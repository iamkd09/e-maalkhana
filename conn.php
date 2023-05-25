<?php 

$server_name = "localhost";
$user_name = "root";
$password = "12345678";
$database = "malkhana";

$conn = mysqli_connect($server_name,$user_name,$password,$database);

if(!$conn){
    die("Connection Failed!".mysqli_connect_error());
}
?>