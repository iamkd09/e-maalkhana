<?php include('header.php') ?>
<?php include('conn.php') ?>
<?php include('sidebar.php') ?>

<head>
   <title>
      Project-admin
   </title>
   <style>
      .card-user {
         margin-bottom: 20px;
      }

      .card-body {
         display: flex;
         justify-content: space-between;
         align-items: center !important;
      }

      .card-body table {
         margin: 60px auto;
         width: 50%;
      }

      .card-body table td:first-child {
         font-weight: bold;
         white-space: nowrap;
         padding-right: 10px;
      }
   </style>

</head>

<?php
if (isset($_POST['scrap_already'])) {
  $gd_search = $_POST['scrap_already'];
  $user_id = $_SESSION['user_id'];
  unset($result);
  $sql = "SELECT * FROM `inventory` WHERE `Gd_Number` LIKE '%$gd_search%' AND `Status` = 3 AND `Created_By` = '$user_id' ";

  $result = mysqli_query($conn, $sql);
  $data = mysqli_fetch_assoc($result);
} else {
  unset($result);
  $gd_search = '';
  $result = [];
}
?>


<body class="user-profile">
   <div class="wrapper ">
      <?php include "sidebar.php"; ?>
      <div class="main-panel" id="main-panel">
         <nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute">
            <?php include "navbar.php"; ?>
         </nav>
         <div class="panel-header panel-header-sm">
         </div>
         <div class="container">
            <form action="" method="post" autocomplete="off">
               <div class="row search-row">
                  <div class="card custom-card col-sm-12 col-md-12">
                     <div class="row my-card top-24">
                        <div class="col-9">
                           <input class="form-control searchbar btn btn-outline-info searchnew f-14"
                              type="search" name="out_already" data-mdb-ripple-color="dark"
                              placeholder="<?php echo $lang['dashboard_search'] ?>" aria-label="Search"
                              style="height: fit-content; border-radius: 5px!important;"
                              value="<?php echo $gd_search ?? ''; ?>">
                        </div>
                        <div class="col-2">
                           <button name="search" class="btn btn-success">
                              <?php echo $lang['go_button'] ?>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="content ck ck2">
            <div class="row">
               <div class="col-md-12 cr-text">
                  <ul class="nav-custom container-custom container-custom-none">
                     <li class="nav-item">
                        <a class="nav-link nav-item-new" style="color:black; !important" aria-current="page"
                           href="outward_list.php"><b>
                              <?php echo $lang['scrapped'] ?>
                           </b></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link active" style="background-color: #1D6AA0; color:white; !important"
                           href="outward_already.php"><b>
                              <?php echo $lang['scrapped_already'] ?>
                           </b></a>
                     </li>
                  </ul>
               </div>
            </div>

            <?php
            $fieldLabels = [
               'Gd_Number' => $lang['gd_number'],
               'stolen_date' => $lang['stolen_date'],
               'Date_Of_Recovery' => $lang['recovery_date'],
               'FIR_Reference_Number' => $lang['fir_number'],
               'Under_Section' => $lang['under_section'],
               'release_date' => $lang['release_date'],
               'Recovered_From' => $lang['recovered_from'],
               'Recovered_By' => $lang['recovered_by'],
               'accident_date' => $lang['accident_date'],
               'Vehicle_Number' => $lang['vehicle_number'],
               'Vehicle_Type' => $lang['vehicle_type'],
               'Engine_Number' => $lang['engine_number'],
               'Chassis_Number' => $lang['chassis_number'],
               'MV_Act' => $lang['mv_act'],
               'Owner_Name' => $lang['owner_name'],
               'Vehicle_R_Number' => $lang['vehicle_r_number'],
               'Car_Make' => $lang['vehicle_make'],
               'Car_Model' => $lang['vehicle_model'],
               'Car_Variant' => $lang['vehicle_variant'],
               'Car_Color' => $lang['vehicle_color'],
               'Item_desc' => $lang['item_desc'],
               'Pictures' => $lang['pictures']
            ];
            ?>
            <div class="row">
               <?php
               $user_id = $_SESSION['user_id'];

               $status = 3; // Status for items in the scrapyard
               $sql = "SELECT inventory.*,sa_log.created_at as created FROM `inventory` LEFT JOIN `sa_log` ON inventory.id = inward_id WHERE inventory.status = '2' AND inventory.`Created_By` = '$user_id' ";
               if (isset($_POST['out_already'])) {
                  $gd_search = $_POST['out_already'];
                  $sql .= "AND `Gd_Number` LIKE '%$gd_search%'";
               }
               $result_4 = mysqli_query($conn, $sql);


               if (!empty($result_4) && $result_4->num_rows > 0) {
                  $rows = mysqli_fetch_all($result_4, MYSQLI_ASSOC);
                  foreach ($rows as $k) {
                     echo '<div class="card custom-card col-sm-12 col-md-5">
                  <div class="">
                  <div class="my-card">';

                     echo '<table class="table table-responsive">';
                     echo '<tbody class="bg-custom-color">';
                     $null_date = "0000-00-00";
                     foreach ($k as $key => $value) {
                        if (!empty($value) && $value != $null_date && !in_array($key, ['id', 'Status', 'category_id', 'sub_category_id', 'Created_By', 'Created_at', 'Updated_at'])) {
                           $label = isset($fieldLabels[$key]) ? $fieldLabels[$key] : $key;
                           echo '<tr>';
                           echo '<td>' . '<b>' . $label . ':</b>' . '</td>';
                           echo '<td>' . $value . '</td>';
                           echo '</tr>';
                        }
                     }

                     echo '</tbody>';
                     echo '</table>';
                     echo '</div></div></div>';
                  }
               } else {
                  echo '<div class="card custom-card col-sm-12 col-md-12">
                           <div class="">
                           <div class="my-card">';
                  echo '<img src="assets/img/nodatapolice.jpeg" width="35%" alt="" srcset="" style="margin-left: 32%;"/>';
                  echo '<h3 style="text-align: center;">' . $lang['no_data'] . '!</h3>';
                  echo '</div></div></div>';
               }

               function getFieldLabel($fieldName)
               {
                  global $fieldLabels;
                  return isset($fieldLabels[$fieldName]) ? $fieldLabels[$fieldName] : $fieldName;
               }
               ?>
            </div>
         </div>
      </div>
   </div>



   <?php include('footer.php') ?>
</body>

</html>