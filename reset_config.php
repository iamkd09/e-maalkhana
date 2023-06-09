
<?php include "conn.php"; ?>
<?php include "header.php"; ?>


<head>
   <title>
  E-Malkhana Register
  </title>
</head>


<?php 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // die($id);
    $message = '';
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['reset'])) {
    $new_password = base64_encode($_POST['newpassword']);

    $resetQuery = "UPDATE `users` SET `token_auth` = '$new_password' WHERE `users`.`id` = '$id' AND `created_by` = '$user_id' ";
    $resetResult = $conn->query($resetQuery);
    if($resetResult){
        $message =  "Password Reset Successfully!";
       
    }else{
        $message = "Some error occured!";
    }

}
?>
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
      <?php if (!empty($message)): ?>
          <div class="modal" tabindex="-1" id="alertPopup" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content my-model">
                <div class="modal-header my-header" style="padding: 0px 5px 0px 15px;">
                  <h5 class="modal-title">
                    <h4>
                      <?php echo $message; ?>
                    </h4>
                  </h5>
                  <a href="dashboard.php" class="close alert_sh">
                    <span aria-hidden="true">&times;</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title"><?php echo $lang['reset_heading']?></h5>
              </div>
              <div class="card-body">
                <form method="POST" action="" autocomplete="off">
                  <div class="row">

                  <div class="col-md-6 pl-1">
                    <div class="form-group">
                      <label><?php echo $lang['new_password'] ?>:</label>
                      <input type="text" class="form-control" name="newpassword" placeholder="<?php echo $lang['new_password'] ?>" required>
                    </div>
                  </div>
                  </div>

                  <div class="col-md-12 text-center">
                    <button type="submit" name="reset" class="btn btn-primary fs-fw">
                      <?php echo $lang['reset_button'] ?>
                    </button>
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
$(document).ready(function () {
          $('#alertPopup').modal('show');
        });
 </script>