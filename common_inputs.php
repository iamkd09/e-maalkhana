<?php
include('header.php');
// echo '<pre>';
// print_r($data);


if (isset($_FILES['upload'])) {
  $files = $_FILES['upload'];
  $targetFolder = '/home/lenovo/Documents/Upload Files/'; // Replace with the actual destination folder path
  $uploadedFiles = count($files['name']);

  // Check if the number of uploaded files exceeds the limit
  if ($uploadedFiles > 4) {
    echo "You can upload a maximum of 4 files.";
  } else {
    // Iterate through the uploaded files
    for ($i = 0; $i < $uploadedFiles; $i++) {
      $fileName = $files['name'][$i];
      $fileTmp = $files['tmp_name'][$i];

      // Move uploaded file to the target folder
      $destination = $targetFolder . $fileName;
      if (move_uploaded_file($fileTmp, $destination)) {
        // File uploaded successfully
        // Perform further processing or save the file path in the database
      } else {
        // Failed to upload file
        // Handle the error accordingly
      }
    }
  }
}


if (isset($data) && !empty($data)) {
  //
} else {
  $data = [
    'Gd_Number' => '',
    'stolen_date' => '',
    'Date_Of_Recovery' => '',
    'FIR_Reference_Number' => '',
    'Under_Section' => '',
    'Recovered_From' => '',
    'Recovered_By' => '',
    'accident_date' => '',
    'Vehicle_Number' => '',
    'Vehicle_Type' => '',
    'Engine_Number' => '',
    'Chassis_Number' => '',
    'MV_Act' => '',
    'Owner_Name' => '',
    'Vehicle_R_Number' => '',
    'Car_Make' => '',
    'Car_Model' => '',
    'Car_Variant' => '',
    'Car_Color' => '',
    'Item_desc' => '',
    'Pictures' => ''
  ];
}


$name = $_POST['form_heading'] ?? 'na';
$html = '
 <div class="content my-3">
   <div class="row">
     <div class="col-md-12">
       <div class="container">
         <div class="text-center">
           <h5 class="title">';
$html .= $lang[$name] . ' </h5>
         </div>
         <div class="">
           
             <div class="row" id="common_inputs">
               <div class="col-md-4 pl-1">
                 <div class="form-group">
                   <label>' . $lang['gd_number'] . ':</label>
                   <input type="text" class="form-control" name="gd_number" placeholder="' . $lang['gd_number'] . '"  required>
                 </div>
               </div>';

if (isset($_POST['id']) || (isset($data)) && !empty($data)) {
  $id = (isset($_POST['id']) && !empty($_POST['id'])) ? $_POST['id'] : null;
  // echo $id;die;
  if ($id == 2) {
    $html .= '

                        <div class="col-md-4 pl-1">
                          <div class="form-group">
                            <label>' . $lang['recovery_date'] . ':</label>
                            <input type="date" class="form-control" name="recovery_date" placeholder="' . $lang['recovery_date'] . '">
                          </div>
                        </div>

                       <div class="col-md-4 pl-1">
                         <div class="form-group">
                           <label>' . $lang['vehicle_r_number'] . ':</label>
                           <input type="text" class="form-control" style="text-transform:uppercase" name="vehicle_r_number" placeholder="' . $lang['vehicle_r_number'] . '">
                         </div>
                       </div>

                       <div class="col-md-4 pl-1">
                        <div class="form-group">
                           <label>' . $lang['recovered_by'] . ':</label>
                           <input type="text" class="form-control" name="recovered_by" placeholder="' . $lang['recovered_by'] . '">
                        </div>
                       </div>

                       <div class="col-md-4 pl-1">
                         <div class="form-group">
                           <label>' . $lang['vehicle_number'] . ':</label>
                           <input type="text" class="form-control" value="' . $data['Vehicle_Number'] . '" name="vehicle_number" placeholder="' . $lang['vehicle_number'] . '">
                         </div>
                       </div>

                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>' . $lang['vehicle_type'] . ':</label>
                                <select class="form-control statetocity" name="vehicle_type">
                                <option></option>
                                <option>' . $lang['two_wheeler'] . '</option>
                                <option>' . $lang['three_wheeler'] . '</option>
                                <option>' . $lang['four_wheeler'] . '</option>
                                
                                </select>
                            </div>
                        </div>
              
                   <div class="col-md-4 pl-1">
                     <div class="form-group">
                       <label>' . $lang['vehicle_make'] . ':</label>
                       <input type="text" class="form-control" name="car_make" placeholder="' . $lang['vehicle_make'] . '">
                     </div>
                   </div>
              
                   <div class="col-md-4 pl-1">
                     <div class="form-group">
                       <label>' . $lang['vehicle_model'] . ':</label>
                       <input type="text" class="form-control" name="car_model" placeholder="' . $lang['vehicle_model'] . '">
                     </div>
                   </div>

                   <div class="col-md-4 pl-1">
                   <div class="form-group">
                   <label>' . $lang['vehicle_color'] . ':</label>
                   <input type="text" class="form-control" name="car_color" placeholder="' . $lang['vehicle_color'] . '">
                   </div>
                   </div>';
  } elseif ($id == 3) {
    $html .= '
          
                          <div class="col-md-4 pl-1">
                          <div class="form-group">
                            <label>' . $lang['recovery_date'] . ':</label>
                            <input type="date" class="form-control" name="recovery_date" placeholder="' . $lang['recovery_date'] . '">
                          </div>
                        </div>'

                      //   <div class="col-md-4 pl-1">
                      //    <div class="form-group">
                      //      <label>' . $lang['fir_number'] . ':</label>
                      //      <input type="text" class="form-control" name="fir_number" placeholder="' . $lang['fir_number'] . '"  oninput="this.value = this.value.replace(/[^0-9]/g, \'\')">
                      //    </div>
                      //  </div>

                       .'<div class="col-md-4 pl-1">
                         <div class="form-group">
                           <label>' . $lang['under_section'] . ':</label>
                           <input type="text" class="form-control" name="under_section" placeholder="' . $lang['under_section'] . '">
                         </div>
                       </div>';
  } elseif ($id == 4) {
    $html .=
      '<div class="col-md-4 pl-1">
                          <div class="form-group">
                            <label>' . $lang['recovery_date'] . ':</label>
                            <input type="date" class="form-control" name="recovery_date"  placeholder="' . $lang['recovery_date'] . '">
                          </div>
                        </div>'

                      //  <div class="col-md-4 pl-1">
                      //    <div class="form-group">
                      //      <label>' . $lang['fir_number'] . ':</label>
                      //      <input type="text" class="form-control" name="fir_number" placeholder="' . $lang['fir_number'] . '"  oninput="this.value = this.value.replace(/[^0-9]/g, \'\')">
                      //    </div>
                      //  </div>
                      
        
              .'<div class="col-md-4 pl-1">
                <div class="form-group">
                  <label>' . $lang['mv_act'] . ':</label>
                  <input type="text" class="form-control" name="mv_act" placeholder="' . $lang['mv_act'] . '" >
                </div>
              </div>
        
              <div class="col-md-4 pl-1">
                <div class="form-group">
                  <label>' . $lang['vehicle_r_number'] . ':</label>
                  <input type="text" class="form-control" style="text-transform:uppercase" name="vehicle_r_number" placeholder="' . $lang['vehicle_r_number'] . '" >
                </div>
              </div>
        
              <div class="col-md-4 pl-1">
                <div class="form-group">
                  <label>' . $lang['owner_name'] . ':</label>
                  <input type="text" class="form-control" name="owner_name" placeholder="' . $lang['owner_name'] . '" >
                </div>
              </div> 
              
              <div class="col-md-4 pl-1">
                        <div class="form-group">
                           <label>' . $lang['recovered_by'] . ':</label>
                           <input type="text" class="form-control" name="recovered_by" placeholder="' . $lang['recovered_by'] . '">
                        </div>
                       </div>';
  }


  if (isset($_POST['sub_id']) || isset($data['sub_category_id'])) {
    $sub_category = $_POST['sub_id'] ?? $data['sub_category_id'];

    // <div class="col-md-4 pl-1">
    //             <div class="form-group">
    //               <label>' . $lang['fir_number'] . ':</label>
    //               <input type="text" class="form-control" name="fir_number"  placeholder="' . $lang['fir_number'] . '">
    //             </div>
    //           </div>
  
              $html .= '  <div class="col-md-4 pl-1">
                  <div class="form-group">
                  <label>' . $lang['under_section'] . ':</label>
                  <input type="text" class="form-control" name="under_section" placeholder="' . $lang['under_section'] . '" >
                  </div>
                </div>

                <div class="col-md-4 pl-1">
                  <div class="form-group">
                      <label>' . $lang['recovered_by'] . ':</label>
                      <input type="text" class="form-control"name="recovered_by" placeholder="' . $lang['recovered_by'] . '" >
                  </div>
                  </div>';
    if ($sub_category == 1) {
      $html .= '
     <div class="col-md-4 pl-1">
       <div class="form-group">
         <label>' . $lang['stolen_date'] . ':</label>
         <input type="date" class="form-control" name="stolen_date"  placeholder="' . $lang['stolen_date'] . '">
       </div>
     </div>

     <div class="col-md-4 pl-1">
       <div class="form-group">
         <label>' . $lang['vehicle_number'] . ':</label>
         <input type="text" class="form-control" name="vehicle_number" placeholder="' . $lang['vehicle_number'] . '" >
       </div>
     </div>

     <div class="col-md-4 pl-1">
         <div class="form-group">
             <label>' . $lang['vehicle_type'] . ':</label>
             <select class="form-control statetocity" name="vehicle_type">
             <option></option>
             <option>' . $lang['two_wheeler'] . '</option>
             <option>' . $lang['three_wheeler'] . '</option>
             <option>' . $lang['four_wheeler'] . '</option>
             
             </select>
         </div>
     </div>

     <div class="col-md-4 pl-1">
       <div class="form-group">
         <label>' . $lang['vehicle_make'] . ':</label>
         <input type="text" class="form-control" name="car_make" placeholder="' . $lang['vehicle_make'] . '" >
       </div>
     </div>

     <div class="col-md-4 pl-1">
       <div class="form-group">
         <label>' . $lang['vehicle_model'] . ':</label>
         <input type="text" class="form-control" name="car_model" placeholder="' . $lang['vehicle_model'] . '">
       </div>
     </div>

    <div class="col-md-4 pl-1">
        <div class="form-group">
        <label>' . $lang['vehicle_color'] . ':</label>
        <input type="text" class="form-control" name="car_color" placeholder="' . $lang['vehicle_color'] . '">
        </div>
    </div>';
    } else if ($sub_category == 2) {
      $html .= '
 
      <div class="col-md-4 pl-1">
        <div class="form-group">
          <label>' . $lang['recovery_date'] . ':</label>
          <input type="date" class="form-control" name="recovery_date" placeholder="' . $lang['recovery_date'] . '">
        </div>
      </div>

      <div class="col-md-4 pl-1">
          <div class="form-group">
          <label>' . $lang['recovered_from'] . ':</label>
          <input type="text" class="form-control" name="recovered_from" placeholder="' . $lang['recovered_from'] . '">
          </div>
      </div>
      

      <div class="col-md-4 pl-1">
        <div class="form-group">
          <label>' . $lang['accident_date'] . ':</label>
          <input type="date" class="form-control" name="accident_date"  placeholder="' . $lang['accident_date'] . '">
        </div>
      </div>


      <div class="col-md-4 pl-1">
        <div class="form-group">
          <label>' . $lang['vehicle_number'] . ':</label>
          <input type="text" class="form-control" name="vehicle_number" placeholder="' . $lang['vehicle_number'] . '">
        </div>
      </div>
 
      <div class="col-md-4 pl-1">
         <div class="form-group">
             <label>' . $lang['vehicle_type'] . ':</label>
             <select class="form-control statetocity" name="vehicle_type">
             <option></option>
             <option>' . $lang['two_wheeler'] . '</option>
             <option>' . $lang['three_wheeler'] . '</option>
             <option>' . $lang['four_wheeler'] . '</option>
             
             </select>
         </div>
     </div>
 
      <div class="col-md-4 pl-1">
        <div class="form-group">
          <label>' . $lang['vehicle_make'] . ':</label>
          <input type="text" class="form-control" name="car_make"  placeholder="' . $lang['vehicle_make'] . '" >
        </div>
      </div>
 
      <div class="col-md-4 pl-1">
        <div class="form-group">
          <label>' . $lang['vehicle_model'] . ':</label>
          <input type="text" class="form-control" name="car_model"  placeholder="' . $lang['vehicle_model'] . '" >
        </div>
      </div>
 
     <div class="col-md-4 pl-1">
         <div class="form-group">
         <label>' . $lang['vehicle_color'] . ':</label>
         <input type="text" class="form-control" name="car_color"  placeholder="' . $lang['vehicle_color'] . '" >
         </div>
     </div>';
    } else if ($sub_category == 3) {
      $html .= '
 
      <div class="col-md-4 pl-1">
        <div class="form-group">
          <label>' . $lang['recovery_date'] . ':</label>
          <input type="date" class="form-control" name="recovery_date"  placeholder="' . $lang['recovery_date'] . '" >
        </div>
      </div>

      <div class="col-md-4 pl-1">
        <div class="form-group">
            <label>' . $lang['recovered_from'] . ':</label>
            <input type="text" class="form-control" name="recovered_from"  placeholder="' . $lang['recovered_from'] . '">
        </div>
      </div>
      
      <div class="col-md-4 pl-1">
        <div class="form-group">
            <label>' . $lang['recovered_by'] . ':</label>
            <input type="text" class="form-control" name="recovered_by"  placeholder="' . $lang['recovered_by'] . '">
        </div>
      </div>';
    }
  }
}

$html .= '
  <div class="col-md-4 pl-1">
    <div class="form-group">
      <label>' . $lang['item_desc'] . ':</label>
      <textarea type="text" class="form-control desc" name="description" rows="3" cols="50" placeholder="' . $lang['item_desc'] . '"> </textarea>
    </div>
  </div>
  <div class="col-md-12 pl-2">
   <div class="form-group ff-file">
      <label for="file-select">' . $lang['pictures'] . ':</label>
      <input type="file" name="upload[]" multiple="multiple">
   </div>
</div>
</div>
    <div class="col-md-12 text-center">
      <div class="form-group">
        <button type="submit" name="submit" class="btn btn-primary fs-fw">' . $lang['submit'] . '</button>
      </div>
    </div>
  
</div>
</div>
</div>
</div>
</div>';
echo $html;

include('footer.php');
?>