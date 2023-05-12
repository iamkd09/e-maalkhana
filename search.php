<!DOCTYPE html>
<html lang="en">

<?php include('header.php') ?>
<?php include('conn.php') ?>
<?php include('sidebar.php') ?>
<head>
   <title>
  Project-admin
  </title>
</head>

<?php
if (isset($_POST['gd_search'])) { 
    $gd_search = $_POST['gd_search'];

    $sql = "SELECT `Gd_Number`, `Date_Of_Recovery`, `FIR_Reference_Number`, `Vehicle_R_Number`,`Item_desc` FROM `inventory` WHERE `Gd_Number` LIKE '%$gd_search%'";

    $result = mysqli_query($conn, $sql);
} else {
    $result = [];
}
?>
    
<body class="user-profile">
  <div class="wrapper ">
    <?php include "sidebar.php"; ?>
    <div class="main-panel" id="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <?php include "navbar.php"; ?>

        <form action="" method="post" autocomplete="off">
          <div class="row">
            <div class="col-9">
              <input class="form-control searchbar btn btn-outline-info searchnew" href="search.php" type="search"name="gd_search" data-mdb-ripple-color="dark" placeholder="<?php echo $lang['dashboard_search'] ?>" aria-label="Search"  style="color: #ffffff; height: fit-content; border-radius: 5px!important;" value="<?php echo ($_POST['gd_search']) ? $_POST['gd_search'] : ''?>" >  
            </div>
            <div class="col-3">
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
          
                
                if (!empty($result)) {
                    
                    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    foreach ($rows as $k){
                         ?>  
                        <table>
                            <tbody class="bg-custom-color">
                                <tr>
                                 <td style="margin-left:10px">
                                   <?php echo '<b>'.$lang['gd_number'].':</b>'?>
                                 </td>
                                 <td>
                                    <?php echo $k['Gd_Number']?>
                                 </td> 
                                </tr>
                                <tr>
                                <td><b>'<?php $lang['recovery_date']?>'</b> 
                                </td>
                                <td><?php echo $k['Date_Of_Recovery']?> </td>
                                <br>
                                </tr>
                                <tr>
                                <td><?php echo '<b>'.$lang['fir_number'].':</b>'?></td>
                                <td><?php echo $k['FIR_Reference_Number']?></td>
                                <br>
                                </tr>
                                <tr>
                                <?php if(!empty($k['Vehicle_R_Number'])){ ?>
                                <td><?php echo '<b>'.$lang['vehicle_r_number'].':</b>'?></td>
                                <td><?php echo $k['Vehicle_R_Number']?></td>
                                <?php } ?>
                                <br>
                                </tr>
                                <tr>
                                <td><?php echo '<b>'.$lang['item_desc'].':</b>'?></td>
                                <td><?php echo $k['Item_desc']?></td>
                                <br>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                    }
                } else { ?>   
                    <img src="./assets/img/datanotfound.jpg" width="100%"  alt="" srcset="" />
                    <h3 style="text-align: center;"><?php $lang['no_data'] ?>!</h3>
            <?php }?>
              </div>
          </div>
      </div>
    </div>
 
  <?php include('footer.php') ?>
</body>

</html>