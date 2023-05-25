<?php
include('header.php');
include('conn.php');

if (isset($_POST['submit'])) {
  
  $id = $_POST['id'];
  $release_date = $_POST['release_date'];
  $recovery_date = $_POST['recovery_date'];
  $recovered_from = $_POST['recovered_from'];
  $recovered_by = $_POST['recovered_by'];
  $pictures = $_POST['pictures'];
    
  // Check if status is already updated
  $status_query = "SELECT `Status` FROM `inventory` WHERE `id` = '$id'";
  $status_result = mysqli_query($conn, $status_query);
  
  if ($status_result && mysqli_num_rows($status_result) > 0) {
    $row = mysqli_fetch_assoc($status_result);
    $status = $row['Status'];
    
    // Check if status is 1
    if ($status == '1') {
      // Update the status to 2
      $update_query = "UPDATE `inventory` SET `Status` = '2' WHERE `id` = '$id'";
      $update_result = mysqli_query($conn, $update_query);
      
      if (!$update_result) {
        $status_new = 'error_update';
        exit();
      }
      
      // Insert the data into the outward table
      $query = "INSERT INTO `outward` (`recovery_date`, `recovered_from`, `recovered_by`, `attachments`, `release_date`, `inward_id`) VALUES ('$recovery_date', '$recovered_from', '$recovered_by', '$pictures', '$release_date', '$id')";
      $result = $conn->query($query);
      
      if ($result) {
        $status_new = 'success';
        header("Location: outward.php?status_new=$status_new");
        exit();
      } else {
        $status_new = 'error_insert';
        exit();
      }
    } else {
      $status_new = 'invalid_status';
      header("Location: outward.php?status_new=$status_new");
      exit();
    }
  } else {
    $status_new = 'error_retrieve';
    header("Location: outward.php?status_new=$status_new");
    exit();
  }
}

?>
