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


<body class="user-profile">
   <div class="wrapper ">
      <?php include "sidebar.php"; ?>
      <div class="main-panel" id="main-panel">
         <nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute">
            <?php include "navbar.php"; ?>

            <form action="" method="post" autocomplete="off">
               <div class="row">
                  <div class="col-8">
                     <input class="form-control searchbar btn btn-outline-info searchnew" href="search.php" type="search" name="gd_search" data-mdb-ripple-color="dark" placeholder="<?php echo $lang['dashboard_search'] ?>" aria-label="Search" style="color: #ffffff; height: fit-content; border-radius: 5px!important;" value="<?php echo $gd_search; ?>">
                  </div>
                  <div class="col-2">
                     <button name="search" class="btn btn-success"><?php echo $lang['go_button'] ?></button>
                  </div>
               </div>
            </form>
         </nav>
         <div class="panel-header panel-header-sm">
         </div>
         <div class="content my-3">
         <div class="row mt-5" >
            <div class="col-md-4">
                  <ul class="nav nav-tabs">
                        <li class="nav-item">
                           <a class="nav-link active" style="background-color: #1D6AA0; color:white; !important"aria-current="page" href="aucti.php"><b>Eligible for auction</b></a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" style="color:black; !important" href="auction_already.php"><b>Already present in auction</b></a>
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


            $currentDate = date('Y-m-d');
            $DaysAgo = date('Y-m-d', strtotime('-365 days'));

            $sql = "SELECT * FROM `inventory` WHERE `Created_at` <= '$DaysAgo' AND `Status` = '1' AND (`category_id` = 2 OR `category_id` = 4)";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
               $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

               foreach ($rows as $k) {
            ?>
                  <div class="card card-user search-card">
                     <div class="card-body search-body">
                        <?php
                        echo '<table>';

                        foreach ($k as $key => $value) {
                           if (!empty($value) && !in_array($key, ['id', 'Status', 'category_id', 'sub_category_id', 'Created_By', 'Created_at', 'Updated_at'])) {
                              $label = isset($fieldLabels[$key]) ? $fieldLabels[$key] : $key;
                              echo '<tr>';
                              echo '<td>' . '<b>' . $label . ':</b>' . '</td>';
                              echo '<td>' . $value . '</td>';
                              echo '</tr>';
                           }
                        }

                        echo '</table>';
                        ?>
                     </div>
                  </div>
            <?php
               }
            } else {
               echo '<img src="./assets/img/datanotfound.jpg" width="100%" alt="" srcset="" />';
               echo '<h3 style="text-align: center;">' . $lang['no_data'] . '!</h3>';
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
   <?php include('footer.php') ?>
</body>

</html>
