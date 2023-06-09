<?php include('header.php') ?>
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
         <div class="container">
            <form action="" method="post" autocomplete="off">
               <div class="row search-row">
               <div class="card custom-card col-sm-12 col-md-12"><div class="row my-card top-24">
                  <div class="col-9">
                     <input class="form-control searchbar btn btn-outline-info searchnew f-14"  type="search" name="auct_search" data-mdb-ripple-color="dark" placeholder="<?php echo $lang['dashboard_search'] ?>" aria-label="Search" style="height: fit-content; border-radius: 5px!important;" value="<?php echo $gd_search ?? ''; ?>">
                  </div>
                  <div class="col-2">
                     <button name="search" class="btn btn-success"><?php echo $lang['go_button'] ?></button>
                  </div>
                </div></div>  
               </div>
            </form>
         </div>
         <div class="content ck ck2">
         <div class="row" >
            <div class="col-md-12 cr-text">
                  <ul class="nav-custom container-custom container-custom-none">
                     <li class="nav-item nav-item-new">
                        <a class="nav-link active" style="background-color: #1D6AA0; color:white; !important"aria-current="page" href="auction.php"><b><?php echo $lang['scrapped'] ?></b></a>
                     </li>
                     <li class="nav-item nav-item-new">
                        <a class="nav-link" style="color:black; !important" href="auction_already.php"><b><?php echo $lang['scrapped_already'] ?></b></a>
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
               'Pictures' => $lang['pictures'],
               'created'=> $lang['created'],
            ];
            ?>
            <div class="row">
            <?php     
               $currentDate = date('Y-m-d');
               $DaysAgo = date('Y-m-d', strtotime('-365 days'));

               $sql = "SELECT * FROM `inventory` WHERE `Created_at` <= '$DaysAgo' AND `Status` = '1' AND (`category_id` = 2 OR `category_id` = 4)";
               if (isset($_POST['auct_search'])) {
                  $gd_search = $_POST['auct_search'];
                  $sql .= "AND `Gd_Number` LIKE '%$gd_search%'";
               }
               $result_5 = mysqli_query($conn, $sql);
               $null_date = "0000-00-00";
               if (!empty($result_5) && $result_5->num_rows > 0) {
                  $rows = mysqli_fetch_all($result_5, MYSQLI_ASSOC);
                  foreach ($rows as $k) {
                     echo '<div class="card custom-card col-sm-12 col-md-5">
                     <div class="">
                     <div class="my-card">';

                     echo '<table class="table table-responsive">';
                     echo '<tbody class="bg-custom-color">';
                     $gdNumber = "";
                     // $null_date = "0000-00-00";
                     // $default_date = "1970-01-01";
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
                                 echo '<td><div class="scroll-bar-css">';
                                 foreach ($pictures as $picture) {
                                     echo '<span class="spacing"><a href="'.$picture.'" target="_blank"><img src="' . $picture . '" width="100px" height="100px"></a></span>';
                                 }
                                 echo '<div></td>';
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
                     echo '<div class="col-md-12 text-center"><button id="scrap_init" name="scrap" onclick=openModal("'.$gdNumber.'"); class="btn btn-primary fs-fw" >'.$lang['auction_button'].'</button></div>';
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
            ?>
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
         <input type="hidden" value="" name="gd" id="gd_confirm" readonly>
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
    function openModal(id) {
         console.log(id);
        if(id != '' && id != undefined) {
           showConfirmationPopup('Send to Scrapyard', 'Are you sure you want to send '+ id +' it to the Auction?',id);  
        }
      }
   function showConfirmationPopup(title, message,id) {
      $('#gd_confirm').val(id);
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
      window.location.reload();
   }

   // $('#scrap_init').on('click', function () {
   //    showConfirmationPopup('Send to Auction', 'Are you sure you want to send it to the auction?');
   // });

   $('.alert_sh').on('click', function () {
      hideAlertPopup();
   });

   $('#confirmYes').on('click', function () {
      // Perform the action based on scrapyard or auction
      var url = '';
      var successMessage = '';
      var gd_no = $('#gd_confirm').val();


      url = 'auct.php';
      successMessage = 'The item has been sent to the auction.';

      $.ajax({
         url: url,
         type: 'POST',
         data: {
            gd_number: gd_no
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
