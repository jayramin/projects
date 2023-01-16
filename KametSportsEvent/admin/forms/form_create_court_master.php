<?php
$data = $fn->getDataByID('v_court_master', 'CourtID', $_REQUEST['CourtID']);
//echo '<pre>';
//print_r($data);
//}
?>
<!-- Content Start -->
<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="CourtName" class="control-label"><?php echo CourtName; ?> <span style="color: red;">*</span> </label>
                    <input type="text" class="form-control material required" name="CourtName" id="CourtName" value="<?php echo $data['CourtName']; ?>" placeholder="Enter Court Name...">
                </div>
            </div>
            <div class="col-lg-3">
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
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="city_name" class="control-label"><?php echo CityName; ?> <span style="color: red;">*</span> </label>
                    <?php
                    $selected = isset($data['CityID']) ? $data['CityID'] : "";
                    $StateFilter = isset($data['CityID']) ? "is_active='Y' AND CityID='" . $data['CityID'] . "'" : "is_active='Y'";
                    $db_array = array("tbl_name" => 'v_city', "condition" => $StateFilter);
                    $select_array = array("name" => "CityID", "id" => "CityID", "class" => "form-control chosen-select required", "onchange" => "LoadGround(this.value,\"GroundID\",\"IN\");");
                    $option_array = array("value" => "CityID", "label" => "CityName", "placeholder" => "Select City", 'selected' => $selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="GroundID" class="control-label"><?php echo GroundName; ?> <span style="color: red;">*</span> </label>
                    <?php
                    $selected = isset($data['GroundID']) ? $data['GroundID'] : "";
//                    $StateFilter = isset($data['GroundID']) ? "is_active='Y' AND CityID='" . $data['CityID'] . "'" : "is_active='Y'";
                    $db_array = array("tbl_name" => 'v_ground_master', "condition" => "is_active='Y'");
                    $select_array = array("name" => "GroundID", "id" => "GroundID", "class" => "form-control chosen-select required");
                    $option_array = array("value" => "GroundID", "label" => "GroundName", "placeholder" => "Select Ground", 'selected' => $selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="CourtID" id="CourtID" value="<?php echo $data['CourtID']?>" >
    <div class="form-group">
        <?php if (isset($_REQUEST['CourtID'])) { ?>
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="UpdateCourtData(this.form);" ><?php echo update; ?></button>
        <?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="InsertCourtData(this.form);" ><?php echo save; ?></button>
        <?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view_court_master"><?php echo cancel; ?></a>
    </div>
</form>