<?php
include('conn.php');
include('header.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
   header("Location: index.php");
   exit;
}

// Fetch inventory data
$query = "SELECT `category_id`, `sub_category_id`, COUNT(*) as count FROM `malkhana`.`inventory` GROUP BY `category_id`, `sub_category_id`";
$result = mysqli_query($conn, $query);
$data = array();
if($result && !empty($result)) {
while ($row = mysqli_fetch_assoc($result)) {
   $category_id = $row['category_id'];
   $sub_category_id = $row['sub_category_id'];
   $count = intval($row['count']);
   $label = getStatusLabel($category_id, $sub_category_id);
   $data[] = array($label, $count);
}
mysqli_free_result($result);
}
mysqli_close($conn);

// Fetch inventory data for scrapyard (status = 3)
$queryScrapyard = "SELECT COUNT(*) as count FROM `malkhana`.`inventory` WHERE `status` = 3";
$resultScrapyard = mysqli_query($conn, $queryScrapyard);
$rowScrapyard = mysqli_fetch_assoc($resultScrapyard);
$countScrapyard = intval($rowScrapyard['count']);

// Fetch inventory data for auction (status = 4)
$queryAuction = "SELECT COUNT(*) as count FROM `malkhana`.`inventory` WHERE `status` = 4";
$resultAuction = mysqli_query($conn, $queryAuction);
$rowAuction = mysqli_fetch_assoc($resultAuction);
$countAuction = intval($rowAuction['count']);

mysqli_close($conn);
?>

<head>
   <title>E-Malkhana Dashboard</title>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', { 'packages': ['corechart'] });
      google.charts.setOnLoadCallback(drawCharts);

      function drawCharts() {
         // Data for inward
         var dataInward = google.visualization.arrayToDataTable([
            ['Status', 'Count'],
            ['Inward', <?php echo $countInward; ?>]
         ]);

         var optionsInward = {
            title: 'Inward Inventory'
         };

         var chartInward = new google.visualization.PieChart(document.getElementById('piechart-inward'));
         chartInward.draw(dataInward, optionsInward);

         // Data for outward
         var dataOutward = google.visualization.arrayToDataTable([
            ['Status', 'Count'],
            ['Outward', <?php echo $countOutward; ?>]
         ]);

         var optionsOutward = {
            title: 'Outward Inventory'
         };

         var chartOutward = new google.visualization.PieChart(document.getElementById('piechart-outward'));
         chartOutward.draw(dataOutward, optionsOutward);

         // Data for scrapyard
         var dataScrapyard = google.visualization.arrayToDataTable([
            ['Status', 'Count'],
            ['Scrapyard', <?php echo $countScrapyard; ?>]
         ]);

         var optionsScrapyard = {
            title: 'Scrapyard Inventory'
         };

         var chartScrapyard = new google.visualization.PieChart(document.getElementById('piechart-scrapyard'));
         chartScrapyard.draw(dataScrapyard, optionsScrapyard);

         // Data for auction
         var dataAuction = google.visualization.arrayToDataTable([
            ['Status', 'Count'],
            ['Auction', <?php echo $countAuction; ?>]
         ]);

         var optionsAuction = {
            title: 'Auction Inventory'
         };

         var chartAuction = new google.visualization.PieChart(document.getElementById('piechart-auction'));
         chartAuction.draw(dataAuction, optionsAuction);
      }
   </script>
</head>

<body class="user-profile">
   <div class="wrapper">
      <?php include('sidebar.php') ?>
      <div class="main-panel" id="main-panel">
         <!-- Navbar -->
         <nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute">
            <?php include("navbar.php") ?>
            <div class="heading col-md-6"><b>Welcome to
                  <?php
                  // Fetch the name from the users table based on the logged-in user's ID
                  $user_id = $_SESSION['user_id'];
                  $query = "SELECT `name` FROM `users` WHERE `id` = $user_id";
                  $result = $conn->query($query);
                  if ($result && $result->num_rows > 0) {
                     $row = $result->fetch_assoc();
                     echo $row['name'];
                  } else {
                     echo "User";
                  }
                  ?>
               </b></div>

            <a class="form-control me-2 searchbar btn btn-outline-info desk-search" href="search.php"
               data-mdb-ripple-color="dark" placeholder="Search" aria-label="Search"
               style="color: #ffffff; font-size:15px;">
               <b class="desk-b">
                  <?php echo $lang['dashboard_search'] ?>
               </b>
            </a>
         </nav>
         <!-- End Navbar-->

         <div class="panel-header panel-header-sm"></div>

         <div class="content my-3">
            <div class="row">
               <!-- Existing code for buttons -->
               <div class="col-md-3">
                  <button type="button" class="form-control btn btn-lg btn-outline-malkhana"
                     data-mdb-ripple-color="dark">
                     <b>
                        <a href="inward.php" class="ct-txt">
                           <?php echo $lang['inward_button'] ?>
                        </a>
                     </b>&emsp;<i class='fa fa-compress-arrows-alt icon-new'></i>
                  </button>
               </div>
               <div class="col-md-3">
                  <button type="button" class="form-control btn btn-lg btn-outline-malkhana"
                     data-mdb-ripple-color="dark">
                     <b>
                        <a href="outward.php" class="ct-txt">
                           <?php echo $lang['outward_button'] ?>
                        </a>
                     </b>&emsp;<i class='fa fa-arrows-alt icon-new'></i>
                  </button>
               </div>
               <div class="col-md-3">
                  <button type="button" class="form-control btn btn-lg btn-outline-malkhana"
                     data-mdb-ripple-color="dark">
                     <b>
                        <a href="scrapyard.php" class="ct-txt">
                           <?php echo $lang['scrapyard_button'] ?>
                        </a>
                     </b>&emsp;<i class="fa fa-trash icon-new" aria-hidden="true"></i>
                  </button>
               </div>
               <div class="col-md-3">
                  <button type="button" class="form-control btn btn-lg btn-outline-malkhana"
                     data-mdb-ripple-color="dark">
                     <b>
                        <a href="auction.php" class="ct-txt">
                           <?php echo $lang['auction_button'] ?>
                        </a>
                     </b>&emsp; <i class="fa fa-gavel icon-new"></i>
                  </button>
               </div>
            </div>

            <!-- Pie charts -->
            <div class="container mt-5">
               <div class="row">
                  <div class="col-md-6 mt-2">
                     <div id="piechart-inward" style="width: 330px; height: 300px;"></div>
                  </div>
                  <div class="col-md-6 mt-2">
                     <div id="piechart-outward" style="width: 330px; height: 300px;"></div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 mt-2">
                     <div id="piechart-scrapyard" style="width: 330px; height: 300px;"></div>
                  </div>
                  <div class="col-md-6 mt-2">
                     <div id="piechart-auction" style="width: 330px; height: 300px;"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php include('footer.php'); ?>
</body>