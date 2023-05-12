
<?php include('conn.php'); ?>
<?php include('header.php'); ?>

<?php
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
        <a class="form-control me-2 searchbar btn btn-outline-info" href="search.php" data-mdb-ripple-color="dark"placeholder="Search" aria-label="Search"  style="color: #ffffff; font-size:15px;"><b><?php echo $lang['dashboard_search'] ?></b></a>
        </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content my-3">
      <div class="row" >
        <div class="col-md-4" >
         <button type="button" class="form-control btn btn-lg btn-outline-malkhana" data-mdb-ripple-color="dark"><b>
          <a href="inward.php"class="ct-txt" ><?php echo $lang['inward_button'] ?><?php $_SESSION['inward'] = true ?></a></b>&emsp;<i class='fa fa-compress-arrows-alt icon-new' ></i>
         </button>
        </div>
        <div class="col-md-4"> 
         <button type="button" class="form-control btn btn-lg btn-outline-malkhana" data-mdb-ripple-color="dark"><b><a href="scrapyard.php" class="ct-txt"><?php echo $lang['scrapyard_button'] ?></a></b>
         &emsp;<i class="fa fa-trash icon-new" aria-hidden="true"></i>
        </button>
        </div>
        <div class="col-md-4">
         <button type="button" class="form-control btn btn-lg btn-outline-malkhana" data-mdb-ripple-color="dark"><b><a href="Auction" class="ct-txt"><?php echo $lang['auction_button'] ?></a></b>&emsp; <i class="fa fa-gavel icon-new">

         </i>
        </button>
        </div>

      </div>
     
    </div>
  </div>
  

<?php include('footer.php'); ?>
</body>

</html>