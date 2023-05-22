<?php
 include "conn.php";
 include "header.php";
 include "sidebar.php";
?>

<?php
if (isset($_POST['gd_search'])) { 
    $gd_search = $_POST['gd_search'];

    $sql = "SELECT * FROM `inventory` WHERE `Gd_Number` LIKE '%$gd_search%'";

    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);

  } else {
    $gd_search = '';
    $result = [];
  }
?>

<head>
   <title>
   Outward-Form
  </title>
</head>

<body class="user-profile">
  <div class="wrapper ">
    <div class="main-panel" id="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <?php include "navbar.php"; ?>

        <form action="" method="post" autocomplete="off">
          <div class="row">
            <div class="col-8">
              <input class="form-control searchbar btn btn-outline-info searchnew" href="search.php" type="search"name="gd_search" data-mdb-ripple-color="dark" placeholder="<?php echo $lang['dashboard_search'] ?>" aria-label="Search"  style="color: #ffffff; height: fit-content; border-radius: 5px!important;" value="<?php echo $gd_search; ?>" >  
            </div>
            <div class="col-2">
              <button name="search" class="btn btn-success"><?php echo $lang['go_button'] ?></button>
            </div>
          </div>
        </form>  
      </nav>
      <div class="panel-header panel-header-sm">
      </div>
     
      <div class="content" <?php $select = 'outward' ?> >
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title"><?php echo $lang['outward_form'] ?></h5>
              </div>
              <div class="card-body">
              <?php  
                if (!empty($result)) { 
                  $_SESSION['outward'] = $key;
                 include('common_inputs.php');
                    // echo $data;
                    
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