<?php include "conn.php"; ?>
<?php include "header.php"; ?>

<?php
if (!isset($_SESSION['user']) || $_SESSION['user'] !== true) {
    header("Location: index.php");
    exit;
}
?>

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
$message = ""; // Initialize empty message variable

if (isset($_POST['submit'])) {
  $name = $_POST['userName'];
  $role = $_POST['roleName'];
  $phone = $_POST['phoneName'];
  $address = $_POST['addressName'];
  $state = $_POST['stateName'];
  $city = $_POST['cityName'];

  $serviceRoleQ = $conn->query("select * from role where id = $role");
  $roleRow = $serviceRoleQ->fetch_assoc();
  // Check if user with the same name already exists
  $checkQuery = "SELECT COUNT(*) as count FROM users WHERE `contact` = '$phone'";
  $checkResult = $conn->query($checkQuery);
  $checkRow = $checkResult->fetch_assoc();
  if ($checkRow['count'] > 0) {
      $message = "User already exists.";
      $messageColor = "red";
  } else {

   


      if (isset($roleRow['user_service_role']) && !empty($name) && !empty($role) && !empty($phone) && !empty($address) && !empty($state) && !empty($city)) {
        $url = user_service_url."/api/v1/user/serviceCall/user-account/create/";
        $postData = json_encode([
          "phone_number" => $phone,
          "first_name" => $name,
          "email_id" => "",
          "last_name" => "",
          "role_id" => $roleRow['user_service_role'],
          "source" => "junkyard",
          "project_ids" => [],
          "committed_by_user_id" => 1,
        ]);
        $saveInService = postCurl($url,$postData);
       
        $users = json_decode($saveInService, true);
        $user_service_id = $users['id'] ?? null;


          $query = "INSERT INTO `users` (`name`, `role_id`, `contact`, `address`, `state`, `city`,`user_service_id`) VALUES ('$name', '$role', '$phone', '$address', '$state', '$city','$user_service_id')";
          $result = $conn->query($query);

          if ($result) {
              $message = "Registration successfully";
              $messageColor = "green";
          } else {
              $message = "Error occurred while registering. Please try again.";
              $messageColor = "red";
          }
      } else {
          $message = "All fields are required.";
          $messageColor = "red";
      }
  }
}
?>

<head>
   <title>E-Malkhana Register</title>
</head>

<body class="user-profile">
  <div class="wrapper ">
    <?php include "sidebar.php"; ?>
    <div class="main-panel" id="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute">
        <?php include "navbar.php"; ?>
        </nav>
      <div class="panel-header panel-header-sm"></div>
      <div class="content">
      <?php if(!empty($message)): ?>
        <div class="alert <?php echo ($result) ? 'alert-success' : 'alert-danger'; ?>">
          <?php echo $message; ?>
        </div>
      <?php endif; ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title"><?php echo $lang['register_here'] ?></h5>
              </div>
              
              <div class="card-body">
                <form method="POST" action="" autocomplete="off">
                  <div class="row">
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label><?php echo $lang['station_name'] ?>:</label>
                        <input type="text" class="form-control" name="userName" placeholder="<?php echo $lang['station_name'] ?>" required>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label><?php echo $lang['role_select'] ?>:</label>
                        <select class="form-control" name="roleName" id="role" aria-label="Default select example" required>
                          <option value=""><?php echo $lang['role_select'] ?>:</option>
                          <?php
                          foreach ($options_role as $k => $role) {
                            if ($_SESSION['user_id'] == 1 || ($_SESSION['user_id'] == 2 && $role['id'] >= 2 && $role['id'] <= 3)) {
                              echo "<option value=" . $role['id'] . ">" . $role['name'] . "</option>";
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label><?php echo $lang['mobile_number'] ?>:</label>
                        <input name="phoneName" class="form-control" type="tel" id="phoneNumberInput" pattern="[0-9]{10}" placeholder="<?php echo $lang['mobile_number'] ?>" required
                        oninput="javascript: if (this.value.length > 10) this.value = this.value.slice(0, 10); else this.value = this.value.replace(/\D/g, '');" />
                      </div>
                    </div>

                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label><?php echo $lang['address'] ?>:</label>
                        <input type="text" class="form-control" name="addressName" placeholder="<?php echo $lang['address'] ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label><?php echo $lang['state'] ?>:</label>
                        <select class="form-control statetocity" name="stateName" onChange="getcity(this.value);" id="state" aria-label="Default select example" required>
                          <option value=""><?php echo $lang['select_state'] ?></option>
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
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label><?php echo $lang['city'] ?>:</label>
                        <select class="form-control" name="cityName" id="city" aria-label="Default select example" required>
                          <option value=""><?php echo $lang['select_state'] ?></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary fs-fw"><?php echo $lang['submit'] ?></button>
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
