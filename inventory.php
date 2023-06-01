<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<?php include('conn.php') ?>

<head>
   <title>
      Project-admin
   </title>
</head>

<?php
if (isset($_POST['inven_search'])) {
  $gd_search = $_POST['inven_search'];
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
<?php
$user_id = $_SESSION['user_id'];

// if (!isset($_SESSION['inventory']) || $_SESSION['inventory'] !== true) {
//    header("Location: index.php");
//    exit;
// }

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
    'Pictures' => $lang['pictures'],
    'category_name' => $lang['cat_name'],
    'sub_category_name' => $lang['sub_cat_name'],
];
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
                              type="search" name="inven_search" data-mdb-ripple-color="dark"
                              placeholder="<?php echo $lang['dashboard_search'] ?>" aria-label="Search"
                              style="height: fit-content; border-radius: 5px!important;"
                              value="<?php echo $gd_search; ?>">
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
               <?php

               $sql_user = "SELECT inventory.*, category.name as category_name, sub_category.name as sub_category_name
               FROM `inventory`
               LEFT JOIN `category` ON category.id = inventory.category_id
               LEFT JOIN `sub_category` ON sub_category.id = inventory.sub_category_id
               WHERE inventory.Status = '1' AND inventory.Created_By = '$user_id' "; 
               if (isset($_POST['inven_search'])) {
                  $gd_number = $_POST['inven_search'];
                  $sql_user .= "AND `Gd_Number` LIKE '%$gd_number%'";
               }
               $result_user = mysqli_query($conn, $sql_user);
               if (!empty($result_user) && $result_user->num_rows > 0) {
                  $rows_user = mysqli_fetch_all($result_user, MYSQLI_ASSOC);
                  // echo "<pre>";print_r($rows_user);die;
                  foreach ($rows_user as $k) {
                     echo '<div class="card custom-card col-sm-12 col-md-5">
                           <div class="">
                           <div class="my-card">';

                     echo '<table class="table table-responsive">';
                     echo '<tbody class="bg-custom-color">';

                     // $null_date = "0000-00-00";
                     // $default_date = "1970-01-01";
                     // foreach ($k as $key => $value) {
                     //    $value = trim($value);
                     //    if (!empty($value)  && !in_array($key, ['id', 'Status','category_id','sub_category_id','Pictures', 'Created_By', 'Created_at', 'Updated_at' ])) {
                     //       $label = isset($fieldLabels[$key]) ? $fieldLabels[$key] : $key;
                     //       echo '<tr>';
                     //       echo '<td>' . '<b>' . $label . ':</b>' . '</td>';
                     //       echo '<td>' . $value . '</td>';
                     //       echo '</tr>';
                     //    }
                     //    if($key == 'Gd_Number'){
                     //       $gdNumber = $value;
                           
                     //    }
                     // }

                     foreach ($k as $key => $value) {
                        $value = trim($value);
                        if (!empty($value) && !in_array($key, ['id', 'Status', 'category_id', 'sub_category_id', 'Created_By', 'Created_at', 'Updated_at'])) {
                            $label = isset($fieldLabels[$key]) ? $fieldLabels[$key] : $key;
                            echo '<tr>';
                            echo '<td>' . '<b>' . $label . ':</b>' . '</td>';
                            
                            // Check if the value is a JSON string
                            if ($key === 'Pictures') {
                                $pictures = json_decode($value, true);
                                if (is_array($pictures)) {
                                    foreach ($pictures as $picture) {
                                        echo '<td><img src="' . $picture . '"></td>';
                                    }
                                }
                            } else {
                                echo '<td>' . $value . '</td>';
                            }
                            
                            echo '</tr>';
                        }
                        if ($key === 'Gd_Number') {
                            $gdNumber = $value;
                        }
                    }
                    

                     echo '</tbody>';
                     echo '</table>';
                     echo '<div class="col-md-12 text-center"><a href="outward.php?outward_search='.$gdNumber.'">
                     <button class="btn btn-primary fs-fw">Outward</button> </a> </div>
                     ';
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
   </div>
   </div>

   <?php include('footer.php') ?>
</body>

</html>
