<?php 
    try{
        
$server_name = "127.0.0.1";
$user_name = "root";
$password = "";
$database = "malkhana";

$conn = mysqli_connect($server_name,$user_name,$password,$database);

if(!$conn){
    die("Connection Failed!".mysqli_connect_error());
}
    } catch(\Exception $e){
        echo "<pre/>";
        print_r($e);
    }
?>