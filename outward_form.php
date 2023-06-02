<?php

$fieldLabels = [
    'Gd_Number' => $lang['gd_number'],
    'stolen_date' => $lang['stolen_date'],
    'Date_Of_Recovery' => $lang['recovery_date'],
    'FIR_Reference_Number' => $lang['fir_number'],
    'Under_Section' => $lang['under_section'],
    'release_date' => $lang['release_date'],
    'Recovered_From' => $lang['recovered_from'],
    'Recovered_By' => $lang['recovered_by'],
    'accident_date' => $lang['accident_date'],
    'Vehicle_Number' => $lang['vehicle_number'],
    'Vehicle_Type' => $lang['vehicle_type'],
    'Engine_Number' => $lang['engine_number'],
    'Chassis_Number' => $lang['chassis_number'],
    'MV_Act' => $lang['mv_act'],
    'Owner_Name' => $lang['owner_name'],
    'Vehicle_R_Number' => $lang['vehicle_r_number'],
    'Car_Make' => $lang['vehicle_make'],
    'Car_Model' => $lang['vehicle_model'],
    'Car_Variant' => $lang['vehicle_variant'],
    'Car_Color' => $lang['vehicle_color'],
    'Item_desc' => $lang['item_desc'],
    'Pictures' => $lang['pictures']
];



$sql = "SELECT * FROM `inventory` WHERE `Gd_Number` LIKE '$gd_search' limit 1";
$result = mysqli_query($conn, $sql);
?>



<div class="row">
    <?php

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        foreach ($row as $key => $value) {
            if (!empty($value) && !in_array($key, ['id', 'Status', 'category_id', 'sub_category_id', 'Created_By', 'Created_at', 'Updated_at'])) {
                $label = isset($fieldLabels[$key]) ? $fieldLabels[$key] : $key;
                ?>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>
                            <?php echo $label ?>:
                        </label>
                        <input type="text" name="<?php echo $key; ?>" class="form-control" value="<?php echo $value; ?>" disabled>
                    </div>
                </div>

                <?php
            }
        }
        $categoryId = $row['category_id'];
        $subcategoryId = $row['sub_category_id'];
        $id = $row['id'];
        ?>
    </div>

    <form action="outward_config.php" method="post">
        
        <div class="row">
            <input type="hidden" class="form-control" name="id" id="id" value="<?= $id ?>">
            <?php

            if ($categoryId == 3 || $categoryId == 2 || $categoryId == 4) { ?>
                <div class="col-md-4 ">
                    <div class="form-group">
                        <label>
                            <?= $lang['release_date'] ?>:
                        </label>
                        <input type="date" class="form-control" name="release_date" id="datepicker"
                            placeholder="<?= $lang['release_date'] ?>">
                    </div>
                </div>
                <?php
            } else { ?>
                <div class="col-md-4" >
                    <div class="form-group">
                        <label>
                            <?= $lang['release_date'] ?>:
                        </label>
                        <input type="date" class="form-control" name="release_date" id="datepicker"
                            placeholder="<?= $lang['release_date'] ?>">
                    </div>
                </div>
                <?php
                if ($subcategoryId == 1) {
                    ?>
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label>
                                <?= $lang['recovery_date'] ?>:
                            </label>
                            <input type="date" class="form-control" name="recovery_date" id="datepicker"
                                placeholder="<?= $lang['recovery_date'] ?>">
                        </div>
                    </div>

                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label>
                                <?= $lang['recovered_from'] ?>:
                            </label>
                            <input type="text" class="form-control" name="recovered_from"
                                placeholder="<?= $lang['recovered_from'] ?>">
                        </div>
                    </div>

                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label>
                                <?= $lang['recovered_by'] ?>:
                            </label>
                            <input type="text" class="form-control" name="recovered_by" placeholder="<?= $lang['recovered_by'] ?>">
                        </div>
                    </div>
                <?php

                }
            } ?>

        </div>
                <!-- <div class="col-md-12 pl-2">
                <div class="form-group ff-file">
                    <label for="file-select"><?= $lang['pictures']?>:</label>
                    <input type="file" name="pictures" id="file-select" multiple="multiple" accept="image/*" max="4">
                </div>
                </div> -->

            <div  class="col-md-12 text-center" style="padding: 10%;">
                <div class="form-group">
                    <button  type="submit" name="submit" class="btn btn-primary fs-fw">
                        <?= $lang['submit'] ?>
                    </button>
                </div>
            </div>

        
    </form>
    <?php
    } ?>




<?php include('footer.php'); ?>
