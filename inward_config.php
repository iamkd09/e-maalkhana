<?php
include('header.php');
include('conn.php');
$user_id = $_SESSION['user_id'];
$role_id = $_SESSION['role_id'];


if (isset($_POST['submit'])) {
  $cat = $_POST['category'];
  $sub_cat = empty($_POST['sub_category']) ? 0 : $_POST['sub_category'];
  $gd_number = $_POST['gd_number'];
  $stolen_date = isset($_POST['stolen_date']) ? date('Y-m-d', strtotime($_POST['stolen_date'])) : '0000-00-00';
  $recovery_date = isset($_POST['recovery_date']) ? date('Y-m-d', strtotime($_POST['recovery_date'])) : '0000-00-00';
  $accident_date = isset($_POST['accident_date']) ? date('Y-m-d', strtotime($_POST['accident_date'])) : '0000-00-00';
  $fir_number = $_POST['fir_number'];
  $under_section = $_POST['under_section'];
  $recovered_from = $_POST['recovered_from'];
  $recovered_by = $_POST['recovered_by'];
  $vehicle_number = $_POST['vehicle_number'];
  $vehicle_type = $_POST['vehicle_type'];
  $mv_act = $_POST['mv_act'];
  $owner_name = $_POST['owner_name'];
  $vehicle_r_number = $_POST['vehicle_r_number'];
  $car_make = $_POST['car_make'];
  $car_model = $_POST['car_model'];
  $car_variant = $_POST['car_variant'];
  $car_color = $_POST['car_color'];
  $item_description = $_POST['description'];
  $upload = $_POST['upload'];
  $date = date('Y-m-d H:i:s');

  // Check if the GD number already exists in the inventory table
  $sql = "SELECT * FROM `inventory` WHERE `Gd_Number` = '$gd_number'";
  $res = $conn->query($sql);
  $row = $res->fetch_assoc();
  $check_gd = $row['Gd_Number'];

  if (empty($check_gd)) {
    $sql1 = "INSERT INTO `inventory` (`Gd_Number`, `stolen_date`, `Date_Of_Recovery`, `FIR_Reference_Number`, `Under_Section`, `Recovered_From`, `Recovered_By`, `accident_date`, `Vehicle_Number`, `Vehicle_Type`, `MV_Act`, `Owner_Name`, `Vehicle_R_Number`, `Car_Make`, `Car_Model`, `Car_Color`, `Item_desc`, `Pictures`, `category_id`, `sub_category_id`, `Created_By`) VALUES ('$gd_number', '$stolen_date', '$recovery_date', '$fir_number', '$under_section',  '$recovered_from', '$recovered_by', '$accident_date', '$vehicle_number', '$vehicle_type', '$mv_act', '$owner_name', '$vehicle_r_number', '$car_make', '$car_model', '$car_color','$item_description', '$upload', '$cat', '".$sub_cat."', '$user_id')";
    $result = mysqli_query($conn,$sql1);
  }

    if ($result) {
      $_SESSION['success'] = '<span style="color:green;">Registration Successful.</span>';
      header("Location: inward.php");
      exit;
    } else {
      $_SESSION['error'] = '<span style="color:red;">Oops! An error occurred.</span>';
      header("Location: inward.php");
      exit;
    }
  } else {
    // $_SESSION['error'] = '<span style="color:red;">GD Number already exists.</span>';
    echo '<span style="color:red;">GD Number already exists.</span>';
    // header("Location: inward.php");
    exit;
  }
?>
