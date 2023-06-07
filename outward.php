<?php
include "conn.php";
include "header.php";
include "sidebar.php";
?>

<?php
if (isset($_GET['outward_search'])) {
  $gd_search = $_GET['outward_search'];
  $user_id = $_SESSION['user_id'];
  unset($result);
  $sql = "SELECT * FROM `inventory` WHERE `Gd_Number` LIKE '%$gd_search%' AND `Status` = 1 AND `Created_By` = '$user_id' ";

  $result = mysqli_query($conn, $sql);
  $data = mysqli_fetch_assoc($result);
} else {
  unset($result);
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
      </nav>
      <div class="panel-header panel-header-sm">
      </div>
      <div class="container">
            <form action="" method="get" autocomplete="off">
               <div class="row search-row">
               <div class="card custom-card col-sm-12 col-md-12"><div class="row my-card top-24">
                  <div class="col-9">
                     <input class="form-control searchbar btn btn-outline-info searchnew f-14"  type="search" name="outward_search" data-mdb-ripple-color="dark"  aria-label="Search" style="height: fit-content; border-radius: 5px!important;" value="<?php echo $gd_search; ?>">
                  </div>
                  <div class="col-2">
                     <button name="search" class="btn btn-success"><?php echo $lang['go_button'] ?></button>
                  </div>
                </div></div>  
               </div>
            </form>
         </div>
      <div class="content ck ck2" <?php $select = 'outward' ?>>
      
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
                if (!empty($result)  && $result->num_rows > 0 ) {
                  include('outward_form.php');
                } else {
                  echo '<img src="assets/img/nodatapolice.jpeg" width="35%" alt="" srcset="" style="margin-left: 32%;"/>';
                  echo '<h3 style="text-align: center;">' . $lang['no_data'] . '!</h3>';
                }
                ?>

               

              </div>
            </div>
          </div>
        </div>

        <?php include('footer.php') ?>


</body>

</html>
