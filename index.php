<!DOCTYPE html>
<html lang="en">

<?php include('header.php') ?>
<?php include('conn.php') ?>

<head>
  <title>
  E-Malkhana Login
  </title>
</head>

<?php

  session_start();

  if (isset($_POST['verify'])){ 
    $contact = $_POST['contact'];
    $_SESSION['contact'] = $contact;
    $_SESSION['msg'] = '';
    $otp = rand(1000,9999);

    if(!empty($contact) && !empty($otp)){
      // $_SESSION('generate') = true;
      $mob = "SELECT * FROM `otp-auth` WHERE `contact` = $contact ";
      $res = $conn->query($mob);
      $row = $res->fetch_assoc();
      $check_mob = $row['contact'];

          if(!empty($check_mob)){
            $update = "UPDATE `otp-auth` SET `otp` =  '$otp', `updated_at` = NOW() WHERE `contact` = $contact ";
            $updated_result = $conn->query($update);
            if($updated_result){
              header("Location: otp.php");
            }
          }else{
           $query = "INSERT INTO `otp-auth` (`contact`, `otp`) VALUES ( '$contact', '$otp')";
           $result = $conn->query($query);

      if($result){
        header("Location: otp.php");
      } 
    }
  }
}



// if (isset($_POST['verify'])){
//   $contact = $_POST['contact'];
//   $_SESSION['contact'] = $contact;
//   $_SESSION['msg'] = '';
//   $otp = rand(1000, 9999);

//   if (!empty($contact) && !empty($otp)) {
//     $mob = "SELECT * FROM `users` WHERE contact = $contact";
//     $res = $conn->query($mob);
//     $row = $res->fetch_assoc();
//     $check_mob = $row['contact'];
//     $status = $row['status'];

//     if (!empty($check_mob)) {
//       $_SESSION['loggedin'] = true;
//       $_SESSION['contact'] = $contact;

//       if ($status == 1) {
//         $update = "UPDATE `otp-auth` SET `otp` = '$otp', `updated_at` = NOW() WHERE `contact` = $contact";
//         $updated_result = $conn->query($update);
//       } else {
//         echo "User is not active.";
//       }
//     } else {
//       echo "Not a user.";
//     }
//   }
// }


?>



<body class="user-profile">
<div class="desk-view">  
<div class="desk-login">
 <div class="pp-logo-icon">
  <img src="./assets/img/police_Logo.png" />
 </div> 
<div>    
<div class="card-new">
  <img src="./assets/img/logo.png" class="card-img-top" alt="Card image">
  <div class="card-header">
    <h4 class="text-center"><b><span>E</span>-<span>Malkhana</span></b></h4>
  </div>
  <div class="card-para">
    <h4 class="text-center">Marching Towards<br/> “Smart Policing & Swachh Bharat”</h4>
  </div>
  <div class="card-body">
    <form action="" method="POST" autocomplete="off">
      <div class="form-group">
        <label for="otp-input">Enter Mobile No.</label>
        <input name="contact" class="form-control new_phone" type="tel" pattern="[0-9]{10}" required
       oninput="javascript: if (this.value.length > 10) this.value = this.value.slice(0, 10); else this.value = this.value.replace(/\D/g, '');" />
      </div>
      <button type="submit" name="verify" class="btn btn-primary col-md-12 text-center"> Generate OTP</button>
    </form>
  </div>
</div>
</div>


  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="./assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="./assets/demo/demo.js"></script>
</body>

</html>