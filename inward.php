<!DOCTYPE html>
<html lang="en">

<?php include "conn.php"; ?>
<?php include "header.php"; ?>

<?php
$query = "SELECT `id`,`name` FROM `category`";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $category = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<?php
$query = "SELECT `id`,`name` FROM `sub_category`";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $sub_category = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<head>
   <title>
   Inward-Form
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
                <h5 class="title">Inward Form</h5>
              </div>
              <div class="card-body">
              <form method="POST" action="" autocomplete="off">
  <div class="row">
    <div class="col-md-4 pl-1">
      <div class="form-group">
        <select class="form-control" name="category" id="category" aria-label="Default select example" required>
          <option value="">Category</option>
          <?php foreach ($category as $k => $cat) {
              echo "<option value =" .
                  $cat["id"] .
                  ">" .
                  $cat["name"] .
                  "</option>";
          } ?>
        </select>
      </div>
    </div>
  </div>
  
  <div class="row" id="subCategoryRow" style="display: none;">
    <div class="col-md-4 pl-1">
      <div class="form-group">
        <select class="form-control" name="sub_category" id="sub_category" aria-label="Default select example" required>
          <option value="">Sub-category</option>
        </select>
      </div>
    </div>
  </div>
</form>
              </div>
            </div>
          </div>
        </div>
      </div>

<script>
var categorySelect = document.getElementById('category');
  var subCategoryRow = document.getElementById('subCategoryRow');

  // Add an event listener for the category dropdown change event
  categorySelect.addEventListener('change', function() {
    var selectedCategoryId = this.value;
    var subCategorySelect = document.getElementById('sub_category');
    
    // Show/hide the subcategory input based on the selected category
    if (selectedCategoryId === '1') {
      subCategoryRow.style.display = 'block';
      // Perform any additional logic or AJAX calls to populate the subcategory dropdown if needed
    } else {
      subCategoryRow.style.display = 'none';
    }
  });

  $(document).ready(function() {
    $('#category').change(function() {
      var categoryCode = $(this).val();
      $.ajax({
        url: 'get_sub_category.php',
        type: 'POST',
        data: {
          categorycode: categoryCode
        },
        success: function(response) {
          $('#sub_category').html(response);
        }
      });
    });
  });



</script>

  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
 <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
   <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="./assets/demo/demo.js"></script>
</body>

</html>