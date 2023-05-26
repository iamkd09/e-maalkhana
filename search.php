<?php include('header.php')?>
<?php include('sidebar.php') ?>
<head>
   <title>
      Project-admin
   </title>
</head>

<?php $user_id = $_SESSION['user_id'];?>

<?php
if (isset($_POST['gd_search']) && !empty($_POST['gd_search'])) { 
   $gd_search = $_POST['gd_search'];

   $sqlInv = "SELECT * FROM `inventory` WHERE `Gd_Number` LIKE '%$gd_search%' AND `Created_By` = $user_id";
   $resultInv = mysqli_query($conn, $sqlInv);
   $rowsInv = mysqli_fetch_all($resultInv,MYSQLI_ASSOC);
} else {
   $gd_search = '';
   $rowsInv = [];
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
               <div class="card custom-card col-sm-12 col-md-12"><div class="row my-card top-24">
                  <div class="col-9">
                     <input class="form-control searchbar btn btn-outline-info searchnew f-14" href="search.php" type="search" name="gd_search" data-mdb-ripple-color="dark" placeholder="<?php echo $lang['dashboard_search'] ?>" aria-label="Search" style="height: fit-content; border-radius: 5px!important;" value="<?php echo $gd_search; ?>">
                  </div>
                  <div class="col-2">
                     <button name="search" class="btn btn-success"><?php echo $lang['go_button'] ?></button>
                  </div>
                </div></div>  
               </div>
            </form>
         </div>
         <div class="content ck">
          <div class="row">
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

                  if (!empty($rowsInv)) {
                     $gd_number = $gd_search;
                     foreach ($rowsInv as $k) {
                        echo '<div class="card custom-card col-sm-12 col-md-5"><div class="card-body"><div class="my-card">';

                        echo '<table class="table table-responsive">';
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
                        echo '<div class="buttons" style="display: flex;">';
                        if ($daysDiff > $scrap_day) {
                           echo '<div class="row">';
                           echo '<button id="scrap_init" name="scrap" class="btn btn-primary fs-fw btn-info" >Send to Scrapyard</button><button id="auct_init" name="auct" class="btn btn-primary fs-fw btn-info">Send to Auction</button><button class="btn btn-primary fs-fw btn-info">
                           <a class="no-ui" href="outward.php">Send to Outward</a>
                         </button>';
                           echo '</div>';
                        }
                        echo '</div></div></div></div>';
                     }
                  } else {
                     echo '<div class="card custom-card col-sm-12 col-md-12"><div class="card-body"><div class="my-card">';
                     echo '<img src="assets/img/nodatapolice.jpeg" width="50%" alt="" srcset="" style="margin-left: 23%;"/>';
                     echo '<h3 style="text-align: center;">' . $lang['no_data'] . '!</h3>';
                     echo '</div></div></div>';
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
         url = 'auct.php';
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
