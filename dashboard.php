<?php
include('conn.php');
include('header.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit;
}

// Fetch inventory data
$query = "SELECT `status`, COUNT(*) as count FROM `malkhana`.`inventory` GROUP BY `status`";
$result = mysqli_query($conn, $query);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $status = getStatusLabel($row['status']); // Function to get label based on status value
    $count = intval($row['count']);
    $data[] = array($status, $count);
}
mysqli_free_result($result);
mysqli_close($conn);

// Function to get label based on status value
function getStatusLabel($status) {
    switch ($status) {
        case 1:
            return 'In Stock';
        case 2:
            return 'Onward';
        case 3:
            return 'Scrapyard';
        case 4:
            return 'Auction';
        default:
            return '';
    }
}
?>

<head>
   <title>E-Malkhana Dashboard</title>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
         var data = new google.visualization.DataTable();
         data.addColumn('string', 'Status');
         data.addColumn('number', 'Count');
         data.addRows(<?php echo json_encode($data); ?>);

         var options = {
            title: 'Inventory Status'
         };

         var chart = new google.visualization.PieChart(document.getElementById('piechart'));

         chart.draw(data, options);
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
            <a class="form-control me-2 searchbar btn btn-outline-info desk-search" href="search.php" data-mdb-ripple-color="dark" placeholder="Search" aria-label="Search"  style="color: #ffffff; font-size:15px;">
               <b class="desk-b"><?php echo $lang['dashboard_search'] ?></b>
            </a>
         </nav>
         <!-- End Navbar -->
         <div class="panel-header panel-header-sm"></div>
         <div class="content my-3">
            <div class="row">
               <!-- Existing code for buttons -->
               <div class="col-md-4">
                  <button type="button" class="form-control btn btn-lg btn-outline-malkhana" data-mdb-ripple-color="dark">
                     <b>
                        <a href="inward.php" class="ct-txt"><?php echo $lang['inward_button'] ?></a>
                     </b>&emsp;<i class='fa fa-compress-arrows-alt icon-new'></i>
                  </button>
               </div>
               <div class="col-md-4">
                  <button type="button" class="form-control btn btn-lg btn-outline-malkhana" data-mdb-ripple-color="dark">
                     <b>
                        <a href="outward.php" class="ct-txt"><?php echo $lang['outward_button'] ?></a>
                     </b>&emsp;<i class='fa fa-arrows-alt icon-new'></i>
                  </button>
               </div>
               <div class="col-md-4"> 
                  <button type="button" class="form-control btn btn-lg btn-outline-malkhana" data-mdb-ripple-color="dark">
                     <b>
                        <a href="scrapyard.php" class="ct-txt"><?php echo $lang['scrapyard_button'] ?></a>
                     </b>&emsp;<i class="fa fa-trash icon-new" aria-hidden="true"></i>
                  </button>
               </div>
               <div class="col-md-4">
                  <button type="button" class="form-control btn btn-lg btn-outline-malkhana" data-mdb-ripple-color="dark">
                     <b>
                        <a href="Auction" class="ct-txt"><?php echo $lang['auction_button'] ?></a>
                     </b>&emsp; <i class="fa fa-gavel icon-new"></i>
                  </button>
               </div>
            </div>

            <!-- Pie chart -->
            <div class="container mt-5">
               <div id="piechart" style="width: 900px; height: 500px;"></div>
            </div>
         </div>
      </div>
   </div>
   <?php include('footer.php'); ?>
</body>
</html>
