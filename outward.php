<?php
include "conn.php";
include "header.php";
include "sidebar.php";
?>

<?php
if (isset($_POST['gd_search'])) {
  $gd_search = $_POST['gd_search'];

  $sql = "SELECT * FROM `inventory` WHERE `Gd_Number` LIKE '%$gd_search%' AND `status` = 1";

  $result = mysqli_query($conn, $sql);
  $data = mysqli_fetch_assoc($result);
} else {
  $gd_search = '';
  $result = [];
}
?>

<head>
  <title>Outward-Form</title>
</head>

<body class="user-profile">
  <div class="wrapper ">
    <div class="main-panel" id="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute">
        <?php include "navbar.php"; ?>

        <form action="" method="post" autocomplete="off">
          <div class="row">
            <div class="col-8">
              <input class="form-control searchbar btn btn-outline-info searchnew" type="search" name="gd_search"
                data-mdb-ripple-color="dark" placeholder="<?php echo $lang['dashboard_search'] ?>"
                aria-label="Search" style="color: #ffffff; height: fit-content; border-radius: 5px!important;"
                value="<?php echo $gd_search; ?>">
            </div>
            <div class="col-2">
              <button name="search" class="btn btn-success">
                <?php echo $lang['go_button'] ?>
              </button>
            </div>
          </div>
        </form>
      </nav>
      <div class="panel-header panel-header-sm">
      </div>

      <div class="content mt-3" <?php $select = 'outward' ?>>
        <div class="row">
          <?php $status_new ?>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">
                  <?php echo $lang['outward_form'] ?>
                </h5>
              </div>
              <div class="card-body">
                <?php
                if (!empty($result)) {
                  include('outward_form.php');
                } else {
                  echo '<img src="./assets/img/datanotfound.jpg" width="50%" alt="" srcset="" style="margin-left: 23%;"/>';
                  echo '<h3 style="text-align: center;">' . $lang['no_data'] . '!</h3>';
                }
                ?>

                <?php
                $status_new = $_GET['status_new'];

                // Display the corresponding message with appropriate CSS class
                if ($status_new == 'success') {
                  echo '<p class="success">Success! Item is outwarded successfully.</p>';
                } elseif ($status_new == 'error_update') {
                  echo '<p class="error">Error in outwarding.</p>';
                } elseif ($status_new == 'error_insert') {
                  echo '<p class="error">Error in outwarding.</p>';
                } elseif ($status_new == 'invalid_status') {
                  echo '<p class="error">Item cannot be outwarded.</p>';
                } elseif ($status_new == 'error_retrieve') {
                  echo '<p class="error">Item cannot be outwarded.</p>';
                } elseif ($status_new == 'already_updated') {
                  echo '<p class="error">Item cannot be outwarded.</p>';
                } else {
                  echo '';
                }
                ?>
              </div>
            </div>
          </div>
        </div>

        <?php include('footer.php') ?>
</body>

</html>
