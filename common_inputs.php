<?php
include('header.php');
$name = $_POST['form_heading'];
$html = '
 <div class="content my-3">
   <div class="row">
     <div class="col-md-8">
       <div class="card">
         <div class="card-header">
           <h5 class="title">'; $html  .= $lang[$name].' </h5>
         </div>
         <div class="card-body">
           <form method="POST" action="inward_config.php" autocomplete="off">
             <div class="row" id="common_inputs">
               <div class="col-md-4 pl-1">
                 <div class="form-group">
                   <label>'.$lang['gd_number'].':</label>
                   <input type="text" class="form-control" name="gd_number" placeholder="'.$lang['gd_number'].'" required>
                 </div>
               </div>';



                if(isset($_POST['id'])){
                    $id = $_POST['id'];

                    if ($id == 2) {
                        $html .= '
      
                       <div class="col-md-4 pl-1">
                         <div class="form-group">
                           <label>'.$lang['chassis_number'].':</label>
                           <input type="text" class="form-control" name="'.$lang['chassis_number'].'" placeholder="Chassis Number">
                         </div>
                       </div>
      
                       <div class="col-md-4 pl-1">
                         <div class="form-group">
                           <label>'.$lang['engine_number'].':</label>
                           <input type="text" class="form-control" name="engine_number" placeholder="'.$lang['engine_number'].'">
                         </div>
                       </div>
      
                       <div class="col-md-4 pl-1">
                         <div class="form-group">
                           <label>'.$lang['vehicle_r_number'].':</label>
                           <input type="text" class="form-control" name="vehicle_r_number" placeholder="'.$lang['vehicle_r_number'].'">
                         </div>
                       </div>';
                        } elseif ($id == 3) {
                          $html .= '
          
                       <div class="col-md-4 pl-1">
                         <div class="form-group">
                           <label>'.$lang['under_section'].':</label>
                           <input type="text" class="form-control" name="under_section" placeholder="'.$lang['under_section'].'" required>
                         </div>
                       </div>
      
          
                       <div class="col-md-4 pl-1">
                         <div class="form-group">
                           <label>'.$lang['fir_number'].':</label>
                           <input type="number" class="form-control" name="fir_number" placeholder="'.$lang['fir_number'].'" required>
                         </div>
                       </div>';
                        } elseif ($id == 4) {
                            $html .= '
              <div class="col-md-4 pl-1">
                <div class="form-group">
                  <label>'.$lang['fir_number'].':</label>
                  <input type="number" class="form-control" name="fir_number" placeholder="'.$lang['fir_number'].'" required>
                </div>
              </div>
        
              <div class="col-md-4 pl-1">
                <div class="form-group">
                  <label>'.$lang['recovered_from'].':</label>
                  <input type="text" class="form-control" name="recovered_by" placeholder="'.$lang['recovered_from'].'" required>
                </div>
              </div>
        
              <div class="col-md-4 pl-1">
                <div class="form-group">
                  <label>'.$lang['mv_act'].':</label>
                  <input type="text" class="form-control" name="mv_act" placeholder="'.$lang['mv_act'].'" required>
                </div>
              </div>
        
              <div class="col-md-4 pl-1">
                <div class="form-group">
                  <label>'.$lang['vehicle_r_number'].':</label>
                  <input type="text" class="form-control" name="vehicle_r_number" placeholder="'.$lang['vehicle_r_number'].'" required>
                </div>
              </div>
        
              <div class="col-md-4 pl-1">
                <div class="form-group">
                  <label>'.$lang['owner_name'].':</label>
                  <input type="text" class="form-control" name="owner_name" placeholder="'.$lang['owner_name'].'" required>
                </div>
              </div> ';
                        }


                }else if(isset($_POST['sub_id'])){
                    $sub_category = $_POST['sub_id'];
    
                    $html .= '<div class="col-md-4 pl-1">
                <div class="form-group">
                  <label>'.$lang['fir_number'].':</label>
                  <input type="number" class="form-control" name="fir_number" placeholder="'.$lang['fir_number'].'" required>
                </div>
                </div>
  
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                  <label>'.$lang['under_section'].':</label>
                  <input type="text" class="form-control" name="under_section" placeholder="'.$lang['under_section'].'" required>
                  </div>
                </div>

                <div class="col-md-4 pl-1">
                    <div class="form-group">
                    <label>'.$lang['recovered_from'].':</label>
                    <input type="text" class="form-control" name="recovered_from" placeholder="'.$lang['recovered_from'].'" required>
                    </div>
                </div>

 <div class="col-md-4 pl-1">
  <div class="form-group">
      <label>'.$lang['recovered_by'].':</label>
      <input type="text" class="form-control" name="recovered_by" placeholder="'.$lang['recovered_by'].'" required>
  </div>
  </div>';
    if($sub_category == 1 ){
     $html .= '
     <div class="col-md-4 pl-1">
       <div class="form-group">
         <label>'.$lang['stolen_date'].':</label>
         <input type="text" class="form-control" name="stolen_date" placeholder="'.$lang['stolen_date'].'">
       </div>
     </div>

     <div class="col-md-4 pl-1">
       <div class="form-group">
         <label>'.$lang['vehicle_number'].':</label>
         <input type="text" class="form-control" name="vehicle_number" placeholder="'.$lang['vehicle_number'].'" required>
       </div>
     </div>

     <div class="col-md-4 pl-1">
         <div class="form-group">
             <label>'.$lang['vehicle_type'].':</label>
             <select class="form-control statetocity" name="vehicle_type" required>
             <option value="">'.$lang['vehicle_type'].'</option>
             <option value="">'.$lang['two_wheeler'].'</option>
             <option value="">'.$lang['three_wheeler'].'</option>
             <option value="">'.$lang['four_wheeler'].'</option>
             
             </select>
         </div>
     </div>

     <div class="col-md-4 pl-1">
       <div class="form-group">
         <label>'.$lang['vehicle_make'].':</label>
         <input type="text" class="form-control" name="car_make" placeholder="'.$lang['vehicle_make'].'" required>
       </div>
     </div>

     <div class="col-md-4 pl-1">
       <div class="form-group">
         <label>'.$lang['vehicle_model'].':</label>
         <input type="text" class="form-control" name="car_model" placeholder="'.$lang['vehicle_model'].'" required>
       </div>
     </div>

    <div class="col-md-4 pl-1">
        <div class="form-group">
        <label>'.$lang['vehicle_variant'].':</label>
        <input type="text" class="form-control" name="car_variant" placeholder="'.$lang['vehicle_variant'].'" required>
        </div>
    </div>


    <div class="col-md-4 pl-1">
        <div class="form-group">
        <label>'.$lang['vehicle_color'].':</label>
        <input type="text" class="form-control" name="car_color" placeholder="'.$lang['vehicle_color'].'" required>
        </div>
    </div>';
    } else if($sub_category == 2){
      $html .= '
 
      <div class="col-md-4 pl-1">
        <div class="form-group">
          <label>'.$lang['stolen_date'].':</label>
          <input type="text" class="form-control" name="stolen_date" placeholder="'.$lang['stolen_date'].'">
        </div>
      </div>
 
      <div class="col-md-4 pl-1">
        <div class="form-group">
          <label>'.$lang['vehicle_number'].':</label>
          <input type="text" class="form-control" name="vehicle_number" placeholder="'.$lang['vehicle_number'].'" required>
        </div>
      </div>
 
      <div class="col-md-4 pl-1">
          <div class="form-group">
              <label>'.$lang['vehicle_type'].':</label>
              <select class="form-control statetocity" name="vehicle_type" required>
              <option value="">'.$lang['vehicle_type'].'</option>
              <option value="">'.$lang['two_wheeler'].'</option>
              <option value="">'.$lang['three_wheeler'].'</option>
              <option value="">'.$lang['four_wheeler'].'</option>
              
              </select>
          </div>
      </div>
 
      <div class="col-md-4 pl-1">
        <div class="form-group">
          <label>'.$lang['vehicle_make'].':</label>
          <input type="text" class="form-control" name="car_make" placeholder="'.$lang['vehicle_make'].'" required>
        </div>
      </div>
 
      <div class="col-md-4 pl-1">
        <div class="form-group">
          <label>'.$lang['vehicle_model'].':</label>
          <input type="text" class="form-control" name="car_model" placeholder="'.$lang['vehicle_model'].'" required>
        </div>
      </div>
 
     <div class="col-md-4 pl-1">
         <div class="form-group">
         <label>'.$lang['vehicle_variant'].':</label>
         <input type="text" class="form-control" name="car_variant" placeholder="'.$lang['vehicle_variant'].'" required>
         </div>
     </div>
 
 
     <div class="col-md-4 pl-1">
         <div class="form-group">
         <label>'.$lang['vehicle_color'].':</label>
         <input type="text" class="form-control" name="car_color" placeholder="'.$lang['vehicle_color'].'" required>
         </div>
     </div>';
     }
    
}
  
  $html .= '
  <div class="col-md-4 pl-1">
    <div class="form-group">
      <label>'.$lang['item_desc'].':</label>
      <textarea type="text" class="form-control desc" name="description" rows="5" cols="50" placeholder="'.$lang['item_desc'].'" required> </textarea>
    </div>
  </div>
  
  <div class="col-md-6 pl-2">
    <div class="form-group">
      <label for="file-select">'.$lang['pictures'].':</label>
      <input type="file" name="upload" id="file-select">
    </div>
  </div>
  
    <div class="col-md-4 pl-1">
      <div class="form-group">
        <button type="submit" name="submit" class="btn btn-primary">'.$lang['submit'].'</button>
      </div>
    </div>
  </form>
</div>
</div>
</div>
</div>
</div>';
  
echo $html;
?>

<?php include('footer.php'); ?>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
  } );
  </script>

<!-- <div class="col-md-4 pl-1">
                 <div class="form-group">
                   <label>'.$lang['recovery_date'].':</label>
                   <input type="text" class="form-control" name="date" id="datepicker" placeholder="'.$lang['recovery_date'].'">
                 </div>
               </div> -->