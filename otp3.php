<?php include('header.php') ?>
<?php include('conn.php') ?>

<?php 

if(!isset($_SESSION["contact"]) || empty($_SESSION["contact"])) {
   header("Location:index.php");
   exit;
}

?>

<head>
<title>
  E-Malkhana otp verification
</title>
</head>

<body class="user-profile">

<div class="card-new">
  <img src="./assets/img/park.png" class="card-img-top" alt="Card image">
  <div class="card-body">
  <div class="card-header">
    <h4 class="text-center"><b><?php $lang['project_name'] ?></b></h4>
  </div>
            <div class="card-header">
               <h6><?php echo $lang['otp_sent'] ?></h6>
               <?php
                $number = $_SESSION['contact'];
                $last_four_digits = substr($number, -4); 
                $first_six_digits = str_pad('', 6, '*', STR_PAD_LEFT); 
                $dynamic_code = '<div> <span>A code has been sent to</span> <small>' . $first_six_digits . $last_four_digits . '</small> </div>'; 
                echo $dynamic_code; 
              ?>

            <form action="otp_auth.php" method="POST" autocomplete="off" >
            <div class="card-body">
               <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2  otp_new" name="otp"> 
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
                <button class="btn btn-danger px-4 validate" name="validate"><?php echo $lang['otp_validate'] ?></button> 
                <?php $_SESSION['validate'] = $validate?>
               </div>
            </div>
            </form>
         </div>
         <div class="card-2">
            <div class="content d-flex justify-content-center align-items-center"> <span><?php echo $lang['not_got_otp'] ?></span> <a href="" class="text-decoration-none  ms-3"><?php echo $lang['resend_otp'] ?></a> </div>
         </div>
      </div>
      </div>
</div>


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


<script>
  <?php include('footer.php'); ?>
</script>

</body>
</html>

