<?php
include('header.php');
include('conn.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
   header("Location: index.php");
   exit;
}

$user_id = $_SESSION['user_id'];

$start_date = '';
$end_date='';
// Filter date
   if(isset($_POST['filter'])){
      $start_date = $_POST['start_date'];
      $end_date = $_POST['end_date'];
   }
   

// Fetch inventory data for different statuses
$queryInward = "SELECT `category_id`, `sub_category_id`, COUNT(id) as count FROM `inventory` WHERE `status` = 1 AND `Created_By` = '$user_id'  ";


if(!empty($start_date) && !empty($end_date)){
   $queryInward.="AND `Created_at` BETWEEN '$start_date' AND '$end_date' ";
}

$queryInward.= "GROUP BY `category_id`, `sub_category_id` ";
$resultInward = mysqli_query($conn, $queryInward);

$dataInward = array();
while ($row = mysqli_fetch_assoc($resultInward)) {
   $category_id = $row['category_id'];
   $sub_category_id = $row['sub_category_id'];
   $count = intval($row['count']);
   $label = getStatusLabel($category_id, $sub_category_id);
   $dataInward[] = array($label, $count);
}

$queryOutward = "SELECT `category_id`, `sub_category_id`, COUNT(id) as count FROM `inventory` WHERE `status` = 2 AND `Created_By` = '$user_id' ";

if(!empty($start_date) && !empty($end_date)){
   $queryOutward.="AND `Created_at` BETWEEN '$start_date' AND '$end_date' ";
}

$queryOutward.= "GROUP BY `category_id`, `sub_category_id` ";
$resultOutward = mysqli_query($conn, $queryOutward);

$dataOutward = array();
while ($row = mysqli_fetch_assoc($resultOutward)) {
   $category_id = $row['category_id'];
   $sub_category_id = $row['sub_category_id'];
   $count = intval($row['count']);
   $label = getStatusLabel($category_id, $sub_category_id);
   $dataOutward[] = array($label, $count);
}

$queryScrapyard = "SELECT `category_id`, `sub_category_id`, COUNT(id) as count FROM `inventory` WHERE `status` = 3 AND `Created_By` = '$user_id' ";

if(!empty($start_date) && !empty($end_date)){
   $queryScrapyard.="AND `Created_at` BETWEEN '$start_date' AND '$end_date' ";
}

$queryScrapyard.= "GROUP BY `category_id`, `sub_category_id` ";
$resultScrapyard = mysqli_query($conn, $queryScrapyard);
$dataScrapyard = array();
while ($row = mysqli_fetch_assoc($resultScrapyard)) {
   $category_id = $row['category_id'];
   $sub_category_id = $row['sub_category_id'];
   $count = intval($row['count']);
   $label = getStatusLabel($category_id, $sub_category_id);
   $dataScrapyard[] = array($label, $count);
}

$queryAuction = "SELECT `category_id`, `sub_category_id`, COUNT(id) as count FROM `inventory` WHERE `status` = 4 AND `Created_By` = '$user_id' ";

if(!empty($start_date) && !empty($end_date)){
   $queryAuction.="AND `Created_at` BETWEEN '$start_date' AND '$end_date' ";
}

$queryAuction.= "GROUP BY `category_id`, `sub_category_id` ";
$resultAuction = mysqli_query($conn, $queryAuction);
$dataAuction = array();
while ($row = mysqli_fetch_assoc($resultAuction)) {
   $category_id = $row['category_id'];
   $sub_category_id = $row['sub_category_id'];
   $count = intval($row['count']);
   $label = getStatusLabel($category_id, $sub_category_id);
   $dataAuction[] = array($label, $count);
}

// mysqli_close($conn);

// Function to get label based on status value
function getStatusLabel($category_id, $sub_category_id)
{
   switch ($category_id) {
      case 1:
         switch ($sub_category_id) {
            case 1:
               return 'MalMukdamati - Stolen Vehicles';
            case 2:
               return 'MalMukdamati - Accidental case';
            case 3:
               return 'MalMukdamati - Objects other than vehicles';
            default:
               return '';
         }
      case 2:
         // Mapping for category ID 2 (Unclaimed Vehicles)
         return 'Unclaimed Vehicles';
      case 3:
         // Mapping for category ID 3 (Jama Talashi)
         return 'Jama Talashi';
      case 4:
         // Mapping for category ID 4 (MV Act)
         return 'MV Act';
      default:
         return '';
   }
}
?>

<head>
   <title>E-Malkhana Dashboard</title>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', { 'packages': ['corechart'] });
      google.charts.setOnLoadCallback(drawCharts);

      function drawCharts() {
         // Draw Inward Pie chart
         var dataInward = new google.visualization.DataTable();
         dataInward.addColumn('string', 'Category and Subcategory');
         dataInward.addColumn('number', 'Count');
         dataInward.addRows(<?php echo json_encode($dataInward); ?>);

         var optionsInward = {
            title: '',
            legend: {position: 'bottom', alignment: 'start'},
         };

         var chartInward = new google.visualization.PieChart(document.getElementById('piechart-inward'));
         chartInward.draw(dataInward, optionsInward);

         // Draw Outward Pie chart
         var dataOutward = new google.visualization.DataTable();
         dataOutward.addColumn('string', 'Category and Subcategory');
         dataOutward.addColumn('number', 'Count');
         dataOutward.addRows(<?php echo json_encode($dataOutward); ?>);

         var optionsOutward = {
            title: '',
            legend: {position: 'bottom', alignment: 'start'}
         };

         var chartOutward = new google.visualization.PieChart(document.getElementById('piechart-outward'));
         chartOutward.draw(dataOutward, optionsOutward);

         // Draw Scrapyard Pie chart
         var dataScrapyard = new google.visualization.DataTable();
         dataScrapyard.addColumn('string', 'Category and Subcategory');
         dataScrapyard.addColumn('number', 'Count');
         dataScrapyard.addRows(<?php echo json_encode($dataScrapyard); ?>);

         var optionsScrapyard = {
            title: '',
            legend: {position: 'bottom', alignment: 'start'}
         };

         var chartScrapyard = new google.visualization.PieChart(document.getElementById('piechart-scrapyard'));
         chartScrapyard.draw(dataScrapyard, optionsScrapyard);

         // Draw Auction Pie chart
         var dataAuction = new google.visualization.DataTable();
         dataAuction.addColumn('string', 'Category and Subcategory');
         dataAuction.addColumn('number', 'Count');
         dataAuction.addRows(<?php echo json_encode($dataAuction); ?>);

         var optionsAuction = {
            title: '',
            legend: {position: 'bottom', alignment: 'start'}
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
                  <a href="inward.php" class="ct-txt">
                     <button type="button" class="form-control btn btn-lg btn-outline-malkhana"
                        data-mdb-ripple-color="dark">
                        <b>
                           <?php echo $lang['inward_button'] ?>

                        </b>&emsp;<i class='fa fa-compress-arrows-alt icon-new'></i>
                     </button>
                  </a>
               </div>
               <div class="col-md-3">
                  <a href="outward_list.php" class="ct-txt">
                     <button type="button" class="form-control btn btn-lg btn-outline-malkhana"
                        data-mdb-ripple-color="dark">
                        <b>
                           <?php echo $lang['outward_button'] ?>
                        </b>&emsp;<i class='fa fa-arrows-alt icon-new'></i>
                     </button>
                  </a>
               </div>
               <div class="col-md-3">
                  <a href="scrapyard.php" class="ct-txt">
                     <button type="button" class="form-control btn btn-lg btn-outline-malkhana"
                        data-mdb-ripple-color="dark">
                        <b>
                           <?php echo $lang['scrapyard_button'] ?>
                        </b>&emsp;<i class="fa fa-trash icon-new" aria-hidden="true"></i>
                     </button>
                  </a>
               </div>
               <div class="col-md-3">
                  <a href="auction.php" class="ct-txt">
                     <button type="button" class="form-control btn btn-lg btn-outline-malkhana"
                        data-mdb-ripple-color="dark">
                        <b>
                           <?php echo $lang['auction_button'] ?>
                        </b>&emsp; <i class="fa fa-gavel icon-new"></i>
                     </button>
                  </a>

               </div>
            </div>   

            <div class="row">
               <form action="" method="POST">
                  <input type="date" name="start_date" id="" required>
                  <input type="date" name="end_date" id="" required>
                  <button class="btn btn-primary fs-fw" type="submit" name="filter">Filter</button>
               </form>
            </div>

               <!-- Pie chart - Scrapyard -->
               <!-- <div class="container"> -->
                  <div class="row">
                     <div class="col-md-6 mt-3">
                      <div class="card">
                      <div class="card-header"><b><?php echo $lang['inward_cases'] ?></b></div>
                      <div class="card-body">
                        <div id="piechart-inward" style="height: 300px;"></div>
                      </div>  
                      </div>  
                     </div>
                     <div class="col-md-6 mt-3">
                      <div class="card">
                        <div class="card-header"><b><?php echo $lang['outward_cases'] ?></b></div>
                        <div class="card-body">
                        <div id="piechart-outward" style="height: 300px;"></div>
                        </div>
                      </div>  
                     </div>
                 
                     <div class="col-md-6 mt-3">
                      <div class="card">
                        <div class="card-header"><b><?php echo $lang['scrapyard_cases'] ?></b></div>
                        <div class="card-body">
                        <div id="piechart-scrapyard" style="height: 300px;"></div>
                        </div> 
                      </div>
                     </div>
                     <div class="col-md-6 mt-3">
                      <div class="card">
                      <div class="card-header"><b><?php echo $lang['auction_cases'] ?></b></div>
                      <div class="card-body">
                        <div id="piechart-auction" style="height: 300px;"></div>
                      </div>  
                      </div>   
                     </div>
               </div>
      <!-- </div> -->
      <!-- ... -->
   <?php include('footer.php'); ?>
</body>