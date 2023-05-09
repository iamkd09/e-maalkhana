<!DOCTYPE html>
<html lang="en">
<?php include('conn.php'); ?>
<?php include('header.php'); ?>

<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit;
}
?>

<head>
   <title>
  E-Malkhana Dashbard
  </title>
</head>

<body class="user-profile">
  <div class="wrapper ">
    <?php include('sidebar.php') ?>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <?php include("navbar.php") ?>
        
        <input class="form-control me-2 searchbar btn btn-outline-info" type="button" data-mdb-ripple-color="dark"placeholder="Search" aria-label="Search" value="Search Inventory" style="color: #ffffff;">       
        </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content my-3">
      <div class="row" >
        <div class="col-md-4" >
         <button type="button" class="form-control btn btn-lg btn-outline-malkhana" data-mdb-ripple-color="dark"><b>
          <a href="inward.php"> Inward</a></b><i class='fa fa-compress-arrows-alt icon-new' ></i>
         </button>
        </div>
        <div class="col-md-4">
         <button type="button" class="form-control btn btn-lg btn-outline-malkhana" data-mdb-ripple-color="dark"><b>Scrapyard</b><i class="fa fa-trash icon-new" aria-hidden="true"></i></button>
        </div>
        <div class="col-md-4">
         <button type="button" class="form-control btn btn-lg btn-outline-malkhana" data-mdb-ripple-color="dark"><b>Auction</b><i class="fa fa-gavel icon-new"></i>
</button>
        </div>
 
      
      </div>
     
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
 <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="./assets/demo/demo.js"></script>
</body>

</html>