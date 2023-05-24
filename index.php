<?php include('header.php') ?>
<?php include('conn.php') ?>
<head>
  <title>
  E-Malkhana Login
  </title>
</head>
<?php
  if (isset($_POST['verify'])){
    $contact = $_POST['contact'];
    $_SESSION['contact'] = $contact;
    $_SESSION['msg'] = '';
    $otp = rand(1000, 9999);
  if (!empty($contact) && !empty($otp)) {
    $mob = "SELECT * FROM `users` WHERE contact = $contact";
      $res = $conn->query($mob);
      $row = $res->fetch_assoc();
      if(is_array($row) && !empty($res)) {
        $check_mob = $row['contact'];
        $status = $row['status'];
      } else {
        $check_mob = '';
        $status = '';
      }
      
    if (!empty($check_mob)) {
      $_SESSION['contact'] = $contact;
      if ($status == 1) {
                    if(!empty($contact) && !empty($otp)){
                      $url = user_service_url."/api/user/SendLoginOTP/";
                      $postData = json_encode([
                        "phone_number" => $contact
                      ]);
                      $saveInService = postCurl($url,$postData);
       
                      $users = json_decode($saveInService, true);
                      $status = $users['status'] ?? 1;
                      $state = $users['state'] ?? null;
                      $otp = $users['otp'] ?? 0000;

                      $mobile_number = "SELECT * FROM `otp-auth` WHERE `contact` = $contact ";
                      $result = $conn->query($mobile_number);
                      $row = $result->fetch_assoc();
                      $check_contact = $row['contact'] ?? null;
                          if(!empty($check_contact)){
            $update = "UPDATE `otp-auth` SET `otp` =  '$otp', `state` = '$state',`updated_at` = NOW() WHERE `contact` = $contact ";
            $updated_result = $conn->query($update);
                            $_SESSION['resend'] = $updated_result;
            if($updated_result){
              header("Location: otp.php");
            }
          }else{
                           $insert = "INSERT INTO `otp-auth` (`contact`, `otp`,`state`) VALUES ( '$contact', '$otp','$state')";
                           $result_insert = $conn->query($insert);
                              if($result_insert){
        header("Location: otp.php");
      }
    }
  }
}
      else {
        $error ='<span style="color:red;">User is not active, please try again.</span>';
      }
  } else {
    $error ='<span style="color:red;">Invalid User!.</span>';
     }
  }
 }
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
    <h4 class="text-center"><b><span><?php echo $lang['e'] ?></span>-<span><?php echo $lang['malkhana'] ?></span></b></h4>
  </div>
  <div class="card-para">
    <h4 class="text-center"><?php echo $lang['smart'] ?><br/><?php echo $lang['marching'] ?></h4>
  </div>
  <div class="card-body">
    <form action="" method="POST" autocomplete="off">
      <div class="form-group">
        <label for="otp-input"><?php echo $lang['enter_mobile'] ?></label>
        <input name="contact" class="form-control new_phone" type="tel" id="phoneNumberInput" pattern="[0-9]{10}" required
       oninput="javascript: if (this.value.length > 10) this.value = this.value.slice(0, 10); else this.value = this.value.replace(/\D/g, '');" />
      </div>
      <?php echo $error ?? ''; ?>
      <button type="submit" name="verify" id="generateOTPButton" class="btn btn-primary col-md-12 text-center" disabled><?php echo $lang['otp_generate'] ?></button>
    </form>
  </div>
</div>
<script>
const phoneNumberInput = document.getElementById('phoneNumberInput');
const generateOTPButton = document.getElementById('generateOTPButton');
phoneNumberInput.addEventListener('input', function() {
  const phoneNumber = phoneNumberInput.value;
  if (phoneNumber.length == 10) {
    generateOTPButton.style.backgroundColor = 'green';
    generateOTPButton.disabled = false;
  } else {
    generateOTPButton.style.backgroundColor = '';
    generateOTPButton.disabled = true;
  }
});
</script>
<?php include('footer.php'); ?>
</body>
</html>