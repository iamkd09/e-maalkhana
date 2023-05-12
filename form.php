
<?php include "header.php"; ?>
      <div class="content my-3">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Stolen Vehicle Form</h5>
              </div>
              <div class="card-body">
                <form method="POST" action="" autocomplete="off">

               


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
                        <label>Recovered By:</label>
                        <input type="text" class="form-control" name="recovered" placeholder="Recovered By" required>
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
                            <select class="form-control statetocity" name="under_section" required>
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
                        <label>MV Act:</label>
                        <input type="text" class="form-control" name="mv_act" placeholder="MV_Act" required>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Name of Owner:</label>
                        <input type="text" class="form-control" name="owner_name" placeholder="Name of Owner" required>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Vehicle R Number :</label>
                        <input type="text" class="form-control" name="vehicle_r_number" placeholder="Vehicle R Number" required>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Engine Number:</label>
                        <input type="text" class="form-control" name="engine_number" placeholder="Engine Number" required>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Chassis Number:</label>
                        <input type="text" class="form-control" name="chassis_number" placeholder="Chassis Number" required>
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
                      <div class="form-group">
                      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                </div>

              </form>
              </div>
            </div>
          </div>
        </div>
      </div>