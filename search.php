<?php include('header.php')?>
<?php include('conn.php')?>
<?php include('sidebar.php') ?>
<head>
   <title>
      Project-admin
   </title>
</head>

<?php
if (isset($_POST['gd_search'])) { 
   $gd_search = $_POST['gd_search'];

   $sql = "SELECT * FROM `inventory` WHERE `Gd_Number` LIKE '%$gd_search%'";

   $result = mysqli_query($conn, $sql);
} else {
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
         <div class="content my-3 ">
            <div class="card card-user search-card">
               <div class="card-body search-body">

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

                  if (!empty($result)) {
                     $gd_number = $gd_search;
                     $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                     foreach ($rows as $k) {
                        echo '<br>'; 

                        echo '<table>';
                        echo '<tbody class="bg-custom-color">';

                        foreach ($k as $key => $value) {
                           if (!empty($value) && !in_array($key, ['id', 'Status', 'category_id', 'sub_category_id', 'Created_By', 'Created_at', 'Updated_at'])) {
                              $label = isset($fieldLabels[$key]) ? $fieldLabels[$key] : $key;
                              echo '<tr>';
                              echo '<td>' . '<b>' . $label . ':</b>' . '</td>';
                              echo '<td>' . $value . '</td>';
                              echo '</tr>';
                           }
                        }

                        echo '</tbody>';
                        echo '</table>';

                        $creationDate = $k['Created_at'];
                        $currentDate = date('Y-m-d');
                        $daysDiff = floor((strtotime($currentDate) - strtotime($creationDate)) / (60 * 60 * 24));
                        echo '<div class="buttons" style="display: flex; margin-top: 2rem;">';
                        if ($daysDiff > 365) {
                           echo '<button id="scrap_init" name="scrap" class="btn btn-sm btn-info" >Send to Scrapyard</button>';
                           echo '<button id="auct_init" name="auct" class="btn btn-sm btn-malkhana">Send to Auction</button>';
                        }
                        echo '</div>';
                     }
                  } else {
                     echo '<img src="./assets/img/datanotfound.jpg" width="100%" alt="" srcset="" />';
                     echo '<h3 style="text-align: center;">' . $lang['no_data'] . '!</h3>';
                  }

                  function getFieldLabel($fieldName) {
                     global $fieldLabels;
                     return isset($fieldLabels[$fieldName]) ? $fieldLabels[$fieldName] : $fieldName;
                  }
                  ?>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Common modal structure for scrapyard and auction -->
<div class="modal" tabindex="-1" id="confirmationModal" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content my-model">
         <div class="modal-header my-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" id="getCode">
            <p></p>
         </div>
         <div class="text-center">
            <button type="button" class="btn btn-info fs-fw" id="confirmYes">Yes</button>
            <button type="button" class="btn btn-malkhana" data-dismiss="modal">No</button>
         </div>
      </div>
   </div>
</div>

<div class="modal" tabindex="-1" id="alertPopup" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content my-model">
         <div class="modal-header my-header">
            <h5 class="modal-title">Message</h5>
            <button type="button" class="close alert_sh" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" id="getCode">
         </div>
         <div class="text-center">
            <button type="button" class="btn btn-malkhana alert_sh fs-fw" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>
   function showConfirmationPopup(title, message) {
      $('#confirmationModal .modal-title').text(title);
      $('#confirmationModal .modal-body p').text(message);
      $('#confirmationModal').modal('show');
   }

   function hideConfirmationPopup() {
      $('#confirmationModal').modal('hide');
   }

   function showAlertPopup(message) {
      $('#alertPopup .modal-body').text(message);
      $('#alertPopup').modal('show');
   }

   function hideAlertPopup() {
      $('#alertPopup').modal('hide');
   }

   $('#scrap_init').on('click', function () {
      showConfirmationPopup('Send to Scrapyard', 'Are you sure you want to send it to the scrapyard?');
   });

   $('#auct_init').on('click', function () {
      showConfirmationPopup('Send to Auction', 'Are you sure you want to send it to the auction?');
   });

   $('.alert_sh').on('click', function () {
      hideAlertPopup();
   });

   $('#confirmYes').on('click', function () {
      // Perform the action based on scrapyard or auction
      var url = '';
      var successMessage = '';

      if ($('#confirmationModal .modal-title').text() === 'Send to Scrapyard') {
         url = 'scrap.php';
         successMessage = 'The item has been sent to the scrapyard.';
      } else if ($('#confirmationModal .modal-title').text() === 'Send to Auction') {
         url = 'auction.php';
         successMessage = 'The item has been sent to the auction.';
      }

      $.ajax({
         url: url,
         type: 'POST',
         data: {
            gd_number: '<?php echo $gd_number; ?>'
         },
         success: function (response) {
            if (response === 'success') {
               hideConfirmationPopup();
               showAlertPopup(successMessage);
            } else {
               hideConfirmationPopup();
               showAlertPopup('Failed to send the item.');
            }
         },
         error: function () {
            hideConfirmationPopup();
            showAlertPopup('An error occurred while processing your request.');
         }
      });
   });
</script>


   <?php include('footer.php') ?>
</body>
</html>
