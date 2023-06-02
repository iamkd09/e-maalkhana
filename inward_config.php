<?php
include('header.php');
include('conn.php');
$user_id = $_SESSION['user_id'];
$role_id = $_SESSION['role_id'];


if (isset($_POST['submit'])) {
  if (isset($_FILES['upload'])) {
    $upload = $_FILES['upload'];

    if (!empty($upload['name'][0])) {
      if (isset($upload['name'][0])) {
        $ext = end(explode('.', $upload['name'][0]));
      } else {
        $ext = "jpg";
      }

      $docName = date("YmdHis") . $user_id . "_inward";
      $tmpName = isset($upload['tmp_name'][0]) ? $upload['tmp_name'][0] : null;
      $document = [];
      foreach ($_FILES['upload']['tmp_name'] as $key => $value) {
        $file_name = $_FILES['upload']['name'][$key];
        $uploadPath = 'assets/uploads' . DIRECTORY_SEPARATOR;
        $uploadPath = $uploadPath . $file_name;
        $uploadPath = $uploadPath . time() . $file_name;
        $fp = fopen($_FILES['upload']['tmp_name'][$key], 'r');
        $saveFile = imageSave($_FILES['upload']['tmp_name'][$key], $ext, $docName, $uploadPath, $_FILES['upload']['name'][$key]);
        array_push($document, $saveFile['data']['url']);
      }
    }

    //  die("dd");

    $cat = $_POST['category'];
    $sub_cat = empty($_POST['sub_category']) ? 0 : $_POST['sub_category'];
    $gd_number = $_POST['gd_number'];
    // die("dd");

    $stolen_date = !empty(trim($_POST['stolen_date'])) ? date('Y-m-d', strtotime($_POST['stolen_date'])) : 'null';
    $recovery_date = !empty(trim($_POST['recovery_date'])) ? date('Y-m-d', strtotime($_POST['recovery_date'])) : 'null';
    $accident_date = !empty(trim($_POST['accident_date'])) ? date('Y-m-d', strtotime($_POST['accident_date'])) : 'null';

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
    $date = date('Y-m-d H:i:s');
 
    $docFile = !empty($document) && (count($document) > 0) ? json_encode($document) : null;
  


    // Check if the GD number already exists in the inventory table
    $sql = "SELECT * FROM `inventory` WHERE `Gd_Number` = '$gd_number'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    $check_gd = $row['Gd_Number'];


    if (empty($check_gd)) {

      $sql1 = "INSERT INTO `inventory` (`Gd_Number`, `stolen_date`, `Date_Of_Recovery`, `FIR_Reference_Number`, `Under_Section`, `Recovered_From`, `Recovered_By`, `accident_date`, `Vehicle_Number`, `Vehicle_Type`, `MV_Act`, `Owner_Name`, `Vehicle_R_Number`, `Car_Make`, `Car_Model`, `Car_Color`, `Item_desc`, `Pictures`, `category_id`, `sub_category_id`, `Created_By`) VALUES ('$gd_number',$stolen_date, $recovery_date, '$fir_number', '$under_section',  '$recovered_from', '$recovered_by', $accident_date, '$vehicle_number', '$vehicle_type', '$mv_act', '$owner_name', '$vehicle_r_number', '$car_make', '$car_model', '$car_color','$item_description', '$docFile', '$cat', '" . $sub_cat . "', '$user_id')";

      // echo $sql1;die;
      $result = mysqli_query($conn, $sql1);
    }
    if ($result && !empty($result)) {
      if ($result == 1) {
        $_SESSION['success'] = '<span >Registration Successful.</span>';
      } else {
        $_SESSION['error'] = '<span >Oops! An error occurred.</span>';
      }
      header("Location: inward.php");
      exit;
    } else {
      $_SESSION['error'] = '<span >GD Number already exists.</span>';
      header("Location: inward.php");
      exit;
    }
  }
}
?>