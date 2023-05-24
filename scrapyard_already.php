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
         </nav>
         <div class="panel-header panel-header-sm">
         </div>
        
         <div class="content my-3">

         <div class="row mt-5" >
            <div class="col-md-12">
                  <ul class="nav nav-tabs">
                        <li class="nav-item" >
                           <a class="nav-link nav-item-new" style="color:black; !important" aria-current="page" href="scrapyard.php"><b>Eligible for scrapyard</b></a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link active" style="background-color: #1D6AA0; color:white; !important" href="scrapyard_already.php"><b>Already present in scrapyard</b></a>
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

            $status = 3; // Status for items in the scrapyard

            $sql = "SELECT inventory.*,sa_log.created_at as created FROM `inventory` INNER JOIN `sa_log` ON inventory.id = inward_id WHERE inventory.status = '3' ";
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
                              echo '<td >' . '<b>' . $label . ':</b>' . '</td>';
                              echo '<td >' . $value . '</td>';
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
