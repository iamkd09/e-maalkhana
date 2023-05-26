
<?php include "conn.php"; ?>
<?php include "header.php"; ?>

<?php
if (!isset($_SESSION['language']) || $_SESSION['language'] !== true) {
    header("Location: index.php");
    exit;
}
?>

<head>
   <title>
  E-Malkhana Register
  </title>
</head>

<body class="user-profile">
  <div class="wrapper ">
    <?php include "sidebar.php"; ?>
    <div class="main-panel" id="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <?php include "navbar.php"; ?>
        </nav>
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title"><?php echo $lang['select_lang'] ?></h5>
              </div>
              <div class="card-body">
                <form method="POST" action="" autocomplete="off">
                  <div class="row">

                  <div class="col-md-4 pl-1">
                    <div class="form-group">
                        <label><?php echo $lang['bhasha'] ?>:</label>
                        <select class="form-control statetocity" id="translate"      name="under_section"           required>
                        <option value=""><?php echo $lang['select_lang'];?></option>
                        <option value="en">English</option>
                        <option value="hi"><?php echo $lang['hindi'];?></option>
                        </select>
                    </div>
                  </div>
                    
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      
  

  <!--   Core JS Files   -->
  <?php include('./footer.php') ?>
</body>

</html>

<script>
 $('#translate').on('change',function() {
    var en = $(this).find(":selected").val();
    document.cookie= "mal_lang="+en;
    window.location.reload();
 });
 </script>