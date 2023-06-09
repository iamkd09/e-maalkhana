<?php include('header_login.php') ?>
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
                      header("Location: otp.php");
                      

  }
}
      else {
        $error ='<span style="color:red;">'.$lang['nonactive_user'].'</span>';
      }
  } else {
    $error ='<span style="color:red;">'.$lang['invalid_user'].'</span>';
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
  <a href=""><img src="./assets/img/logo.png" class="card-img-top" alt="Card image"> </a>
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