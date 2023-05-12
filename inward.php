
<?php include "conn.php"; ?>
<?php include "header.php"; ?>

<?php

$_SESSION['category'] = 1;
$_SESSION['sub_category'] = 1;

if (!isset($_SESSION['inward']) || $_SESSION['inward'] !== true) {
    header("Location: index.php");
    exit;
}

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
        <?php echo $success ?? ''; ?>
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title"><?php echo $lang['inward_form'] ?></h5>
              </div>
              <div class="card-body">
              <form method="POST" action="" autocomplete="off">
                  <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <select class="form-control" name="category" id="category" aria-label="Default select example" required>
                          <option value=""><?php echo $lang['category'] ?></option>
                          <?php foreach ($category as $k => $cat) {
                            $_SESSION['id'] = $cat_id;                              
                            echo "<option value =". $cat["id"] .">".$cat["name"] ."</option>";
                          } 
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
  
                  <div class="row" id="subCategoryRow" style="display: none;">
                    <div class="col-md-4 pl-1">
                      <div class="form-group" >
                        <select class="form-control" name="sub_category" id="sub_category" aria-label="Default select example" required>
                          <option value=""><?php echo $lang['sub_category'] ?></option>
                        </select>
                      </div>
                    </div>
                  </div>
              </form>
              <?php 
                //  if(isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                //     echo $_SESSION['error'];
                //  }
               ?>
            </div>
          </div>
        </div>
        
     
        <hr class=""> </hr>

        <div class="form-div" id="common_inputs">
          
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
      $('#formDiv').removeClass('custom-hide');
      $('#formDiv').addClass('custom-show');
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

<script>
  $(document).ready(function(){  
	// code to get all records from table via select box
	$("#category").change(function() {    
		var id = $(this).find(":selected").val();
    $('#common_inputs').html('');
    if(id != 1 && id != ''){
      var form_heading = $(this).find(":selected").html();
      // alert(form_heading);
      var data = {
        'id':id,
        'form_heading':form_heading 
      }   
      $.ajax({
        url: 'common_inputs.php',
        data: data, 
        type: 'POST', 
        success: function(data) {
            // console.log('cccc' + data);
            $('#common_inputs').html(data);
        }
      });
    }else{
      $('#common_inputs').html('');
    }
    
 	}) 


   $("#sub_category").change(function() {    
		var id = $(this).find(":selected").val();
    
      var form_heading = $(this).find(":selected").html();
      // alert(form_heading);
      var data = {
        'sub_id':id,
        'form_heading':form_heading 
      }   
      $.ajax({
        url: 'common_inputs.php',
        data: data, 
        type: 'POST', 
        success: function(data) {
            // console.log('cccc' + data);
            $('#common_inputs').html(data);
        }
      });
    
    
 	}) 




});
</script>

  <?php include('footer.php'); ?>


</body>

</html>