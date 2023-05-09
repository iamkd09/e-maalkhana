<?php include('header.php') ?>
<?php include('conn.php') ?>

<?php 
session_start();

?>

<head>
<title>
  E-Malkhana otp verification
</title>
</head>

<body class="user-profile">
<div class="desk-view">

<!-- <div class="desk-login">
 <div class="pp-logo-icon">
  <img src="./assets/img/police_Logo.png" />
 </div> 
<div>    
<div class="card-new">
  <img src="./assets/img/logo.png" class="card-img-top" alt="Card image">
  <div class="card-header">
    <h4 class="text-center"><b><span>E</span>-<span>Malkhana</span></b></h4>
  </div>
</div> -->

<div class="desk-login">
 <div class="pp-logo-icon">
  <img src="./assets/img/police_Logo.png" />
 </div> 
<div> 
<div class="card-new w-395">
  <img src="./assets/img/logo.png" class="card-img-top" alt="Card image">
  <div class="card-body">
  <div class="card-header card-align">
    <h4 class="text-center"><b>E-Malkhana</b></h4>
  </div>
      <div class="card-header custom-padding">
          <?php
          $number = $_SESSION['contact'];
          $last_four_digits = substr($number, -4); 
          $first_six_digits = str_pad('', 6, '*', STR_PAD_LEFT); 
          $dynamic_code = '<div class="green"> <span>4 digit OTP code has been sent to your registered mobile no.</span> <small>' . $first_six_digits . $last_four_digits . '</small> </div>'; 
          echo $dynamic_code; 
        ?>
      <br />
      <h6 style="text-transform:none;">Please enter OTP to verify your account</h6>
      <form action="otp_auth.php" method="POST" autocomplete="off" >
      <div class="card-body">
          <div id="otp" class="inputs d-flex flex-row justify-content-center otp_new otp-alignment" name="otp"> 
            <input class="m-2 text-center form-control rounded ap-otp-input" id="partitioned" type="number" name="otp1" id="first" maxlength="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required /> 
            <input class="m-2 text-center form-control rounded ap-otp-input" id="partitioned" type="number" name="otp2" id="second" maxlength="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required /> 
            <input class="m-2 text-center form-control rounded ap-otp-input" id="partitioned" type="number" name="otp3" id="third" maxlength="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required /> 
            <input class="m-2 text-center form-control rounded ap-otp-input" id="partitioned" type="number" name="otp4" id="fourth" maxlength="1"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required />
            
            <input type="hidden" name="contact" value="<?php echo $_SESSION["contact"]?>" /> 
          </div>
          <?php 
            if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
              echo $_SESSION['msg'];
            }
          ?>
          <div class="mt-4 form-group"> 
          <button class="btn btn-danger px-4 validate" name="validate">Validate</button> 
          </div>
      </div>
      </form>
    </div>
    <div class="card-2">
      <div class="content d-flex justify-content-center align-items-center"> <span>Didn't get the code? </span> <a href="#" class="text-decoration-none  ms-3"> Resend(1/3)</a> </div>
    </div>
</div>
</div>
</div>
<div>
</div>  
</body>

<script>
   const $inp = $(".ap-otp-input");

$inp.on({
  paste(ev) { // Handle Pasting
  
    const clip = ev.originalEvent.clipboardData.getData('text').trim();
    // Allow numbers only
    if (!/\d{6}/.test(clip)) return ev.preventDefault(); // Invalid. Exit here
    // Split string to Array or characters
    const s = [...clip];
    // Populate inputs. Focus last input.
    $inp.val(i => s[i]).eq(5).focus(); 
  },
  input(ev) { // Handle typing
    
    const i = $inp.index(this);
    if (this.value) $inp.eq(i + 1).focus();
  },
  keydown(ev) { // Handle Deleting
    
    const i = $inp.index(this);
    if (!this.value && ev.key === "Backspace" && i) $inp.eq(i - 1).focus();
  }
  
});
</script>

