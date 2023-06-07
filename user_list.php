
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<?php include('conn.php') ?>

<head>
   <title>
      Project-admin
   </title>
</head>


<?php
$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['user_list']) || $_SESSION['user_list'] !== true) {
   header("Location: index.php");
   exit;
}

$fieldLabels = [
   'name' => $lang['station_name'],
   'contact' => $lang['mobile_number'],
   'address' => $lang['address'],
   'state_name' => $lang['state'],
   'city_name' => $lang['city'],
   'role_name' => $lang['role_name'],
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
                              type="search" name="user_search" data-mdb-ripple-color="dark"
                              placeholder="<?php echo $lang['search_mobile'] ?>" aria-label="Search"
                              style="height: fit-content; border-radius: 5px!important;"
                              value="<?php echo $_POST['user_search']; ?>">
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
               $user_id = $_SESSION['user_id'];
               $sql_user = "SELECT users.*,role.name as role_name,state.name as state_name, city.name as city_name FROM `users` left join `state` on state.id = users.state left join `city` on city.id = users.city left join `role` on role.id = users.role_id WHERE users.status = '1' AND `created_by` = $user_id "; 
               if (isset($_POST['user_search'])) {
                  $mobile = $_POST['user_search'];
                  $sql_user .= "AND `contact` LIKE '%$mobile%'";
               }
               $result_user = mysqli_query($conn, $sql_user);
               if (!empty($result_user) && $result_user->num_rows > 0) {
                  $rows_user = mysqli_fetch_all($result_user, MYSQLI_ASSOC);
                  foreach ($rows_user as $k) {
                     echo '<div class="card custom-card col-sm-12 col-md-5">
                           <div class="">
                           <div class="my-card">';

                     echo '<table class="table table-responsive">';
                     echo '<tbody class="bg-custom-color">';

                     foreach ($k as $key => $value) {
                        if (!empty($value) && !in_array($key, ['id', 'role_id', 'status', 'city', 'state', 'user_service_id', 'created_by', 'created_at', 'updated_at', 'token_auth' ])) {
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
   </div>
   </div>

   <?php include('footer.php') ?>
</body>

</html>
