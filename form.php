<!DOCTYPE html>
<html lang="en">

<?php include "./conn.php"; ?>
<?php include "./header.php"; ?>

<head>
   <title>
  E-Malkhana Register
  </title>
</head>

<body class="user-profile">
  <div class="wrapper ">
    <?php include "./sidebar.php"; ?>
    <div class="main-panel" id="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <?php include "./navbar.php"; ?>
        </nav>
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Respective Inward Form</h5>
              </div>
              <div class="card-body">
                <form method="POST" action="" autocomplete="off">

                <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>General Dairy Number:</label>
                        <input type="text" class="form-control" name="gd_number" placeholder="GD Number" required>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Date of Recovery:</label>
                        <input type="date" class="form-control" name="date"  placeholder="Date of Recovery" required>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>FIR Reference Number:</label>
                        <input type="number" class="form-control" name="fir_number" placeholder="FIR Reference Number" required>
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 pl-1">
                        <div class="form-group">
                            <label>Under-Section:</label>
                            <input type="text" class="form-control" name="section" placeholder="Under Section" required>

                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Recovered From:</label>
                        <input type="text" class="form-control" name="recovered" placeholder="Recovered From" required>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Vehicle Number:</label>
                        <input type="text" class="form-control" name="vehicle_number" placeholder="Vehicle Number" required>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 pl-1">
                        <div class="form-group">
                            <label>Vehicle Type:</label>
                            <select class="form-control statetocity" name="undersection"  required>
                            <option value="">Under Section</option>
                            <option value="">Two-Wheeler</option>
                            <option value="">Four-Wheeler</option>
                            
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Car Make:</label>
                        <input type="text" class="form-control" name="car_make" placeholder="Car Make" required>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Car Model:</label>
                        <input type="text" class="form-control" name="car_model" placeholder="Car Model" required>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Car Variant:</label>
                        <input type="text" class="form-control" name="car_variant" placeholder="Car Variant" required>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Car Color:</label>
                        <input type="text" class="form-control" name="car_color" placeholder="Car Colour" required>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group desc">
                        <label>Item Description:</label>
                        <textarea type="text" class="form-control" name="description" rows="5" cols="50" placeholder="Item Description" required> </textarea>
                      </div>
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