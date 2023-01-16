<?php
$data = $fn->getDataByID('v_ground_master', 'GroundID', $_REQUEST['GroundID']);
//echo '<pre>';
//print_r($data);
//}
?>
<!-- Content Start -->
<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="GroundName" class="control-label"><?php echo GroundName; ?> <span style="color: red;">*</span> </label>
                    <input type="text" class="form-control material required" name="GroundName" id="GroundName" value="<?php echo $data['GroundName']; ?>" placeholder="Enter Ground Name...">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="state_name" class="control-label"><?php echo StateName; ?> <span style="color: red;">*</span> </label>
                    <?php
                    $SelectedState = isset($data['StateID']) ? $data['StateID'] : "";
//                    $StateFilter = isset($data['StateID']) ? "is_active='Y' AND CountryID='" . $data['CountryID'] . "'" : "is_active='Y'";
                    $db_array = array("tbl_name" => 'v_state', "condition" => "is_active='Y'");
                    $select_array = array("name" => "StateID", "id" => "StateID", "class" => "form-control chosen-select required", "onchange" => "LoadCity(this.value,\"" . $SelectedState . "\",\"CityID\",\"AreaID\",\"IN\");");
                    $option_array = array("value" => "StateID", "label" => "StateName", "placeholder" => "Select State", 'selected' => $SelectedState);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="city_name" class="control-label"><?php echo CityName; ?> <span style="color: red;">*</span> </label>
                    <?php
                    $selected = isset($data['CityID']) ? $data['CityID'] : "";
                    $StateFilter = isset($data['CityID']) ? "is_active='Y' AND CityID='" . $data['CityID'] . "'" : "is_active='Y'";
                    $db_array = array("tbl_name" => 'v_city', "condition" => $StateFilter);
                    $select_array = array("name" => "CityID", "id" => "CityID", "class" => "form-control chosen-select required");
                    $option_array = array("value" => "CityID", "label" => "CityName", "placeholder" => "Select City", 'selected' => $selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                </div>
            </div>

        </div>
    </div>
    <input type="hidden" name="GroundID" id="GroundID" value="<?php echo $data['GroundID']?>" >
    <div class="form-group">
        <?php if (isset($_REQUEST['GroundID'])) { ?>
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="UpdateGroundData(this.form);" ><?php echo update; ?></button>
        <?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="InsertGroundData(this.form);" ><?php echo save; ?></button>
        <?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view_ground_master"><?php echo cancel; ?></a>
    </div>
</form>