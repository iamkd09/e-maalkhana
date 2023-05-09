<!DOCTYPE html>
<html lang="en">

<?php include "conn.php"; ?>
<?php include "header.php"; ?>



<?php
$query_city = "SELECT `id`,`name` FROM `city` ORDER BY `city`.`name` ASC";
$result = $conn->query($query_city);
if ($result->num_rows > 0) {
    $options_city = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<?php
$query_state = "SELECT `id`,`name` FROM `state` ORDER BY `state`.`name` ASC";
$result = $conn->query($query_state);
if ($result->num_rows > 0) {
    $options_state = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<?php
$query_role = "SELECT `id`,`name` FROM `role`";
$result = $conn->query($query_role);
if ($result->num_rows > 0) {
    $options_role = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<?php 
if (isset($_POST['submit'])){
  $name = $_POST['userName'];
  $role = $_POST['roleName'];
  $phone = $_POST['phoneName'];
  $address = $_POST['addressName'];
  $state = $_POST['stateName'];
  $city = $_POST['cityName'];

  if(!empty($name) && !empty($role) && !empty($phone) && !empty($address) && !empty($state) && !empty($city)){
    $query = "INSERT INTO `users` (`name`, `role_id`, `contact`, `address`, `state`, `city`) VALUES ( '$name', '$role', '$phone', '$address', '$state', '$city')";
    $result = $conn->query($query);
  
    if($result){
      echo "Registration successfully";
    }
  }
}
?>

<?php
  $state = "SELECT * FROM `state` ";
  $state_query = mysqli_query($conn,$state);
?>
<head>
   <title>
  E-Malkhana Register
  </title>
</head>

<body class="user-profile">
  <div class="wrapper ">
    <?php include "sidebar.php"; ?>
    <div class="main-panel" id="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <?php include "navbar.php"; ?>
        </nav>
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Register Here</h5>
              </div>
              <div class="card-body">
                <form method="POST" action="" autocomplete="off">
                  <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="userName" placeholder="Enter Your Name" required>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Role:</label>
                        <select class="form-control" name="roleName" id="role" aria-label="Default select example" required>
                         <option value="">Select Role</option>
                         <?php foreach ($options_role as $k => $role) {
                             echo "<option value =" .
                                 $role["id"] .
                                 ">" .
                                 $role["name"] .
                                 "</option>";
                         } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Contact Number:</label>
                        <input type="number" class="form-control" name="phoneName"  placeholder="Mobile Number" required>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="addressName" placeholder="Address" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>State:</label>
                        <select class="form-control statetocity" name="stateName" onChange="getcity(this.value);" id="state" aria-label="Default select example" required>
                         <option value="">Select State</option>
                         <?php foreach ($options_state as $state) {
                             echo "<option value = " .
                                 $state["id"] .
                                 ">" .
                                 $state["name"] .
                                 "</option>";
                         } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>City:</label>
                        <select class="form-control" name="cityName" id="city" aria-label="Default select example" required>
                 
                          <option value="">Select City</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      
  
<script>
  function getcity(val) {
    $.ajax({
    type: "POST",
    url: "get_city.php",
    data:'statecode='+val,
    success: function(data){
      //console.log('data' + data);
      $("#city").html(data);
    }
    });
  }
  $("input[required]").parent("label").addClass("required");
</script>
  <!--   Core JS Files   -->
  <?php include('./footer.php') ?>
</body>

</html>