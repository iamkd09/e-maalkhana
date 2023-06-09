<?php include('header.php') ?>
<?php include('conn.php') ?>

<head>
  <title>
    E-Malkhana otp verification
  </title>
</head>

<body class="user-profile">
  <div class="desk-view">
    <div class="desk-login">
      <div class="pp-logo-icon">
        <img src="./assets/img/police_Logo.png" />
      </div>
      <div>
        <div class="card-new w-395">
          <img src="./assets/img/logo.png" class="card-img-top" alt="Card image">
          <div class="card-body">
            <div class="card-header card-align">
              <h4 class="text-center"><b><span>
                    <?php echo $lang['e'] ?>
                  </span>-<span>
                    <?php echo $lang['malkhana'] ?>
                  </span></b></h4>
            </div>

            <br />
            <h6 style="text-transform:none;text-align: center;">
              <?php echo $lang['enter_otp'] ?>
            </h6>
            <form action="otp_auth.php" method="POST" autocomplete="off">
              <div class="card-body">
                <div id="otp" class="inputs d-flex flex-row justify-content-center otp_new otp-alignment" name="otp">
                  <div class="col-md-12 text-center">
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" placeholder="<?php echo $lang['password']?>" required>
                    </div>
                  </div>

                  <input type="hidden" name="contact" value="<?php echo $_SESSION["contact"] ?>" />
                </div>

                <?php
                if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
                  echo $_SESSION['msg'];
                }
                ?>
                <form action="">
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <button class="btn btn-danger px-4 validate" name="validate">
                        <?php echo $lang['validate'] ?>
                      </button>
                    </div>
                  </div>
              </div>
            </form>
          </div>
        
        </div>
      </div>
    </div>
    <div>
    </div>
</body>
<script>

  function validateInput(input) {
    input.value = input.value.replace(/[^0-9]/g, ''); // Remove any non-numeric characters
  }

  const $inp = $(".ap-otp-input");
  $inp.on({
    paste(ev) {

      const clip = ev.originalEvent.clipboardData.getData('text').trim();
      if (!/\d{6}/.test(clip)) return ev.preventDefault();
      const s = [...clip];
      $inp.val(i => s[i]).eq(5).focus();
    },
    input(ev) {

      const i = $inp.index(this);
      if (this.value) $inp.eq(i + 1).focus();
    },
    keydown(ev) {

      const i = $inp.index(this);
      if (!this.value && ev.key === "Backspace" && i) $inp.eq(i - 1).focus();
    }
  });
</script>