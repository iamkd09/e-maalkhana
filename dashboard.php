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
while ($row = mysqli_fetch_assoc($result)) {
   $category_id = $row['category_id'];
   $sub_category_id = $row['sub_category_id'];
   $count = intval($row['count']);
   $label = getStatusLabel($category_id, $sub_category_id);
   $data[] = array($label, $count);
}

mysqli_free_result($result);
mysqli_close($conn);

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
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
         var data = new google.visualization.DataTable();
         data.addColumn('string', 'Category and Subcategory');
         data.addColumn('number', 'Count');
         data.addRows(<?php echo json_encode($data); ?>);

         var options = {
            title: 'Inventory Category and Subcategory'
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
            <div class="heading col-md-6"><b><h5>Welcome to
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
               <h5></b></div>

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

            <!-- Pie chart -->
            <div class="row">
               <div class="container mt-5">
                  <div id="piechart" style="width: 800px; height: 500px;"></div>
               </div>
            </div>
         </div>
      </div>
      <?php include('footer.php'); ?>
</body>