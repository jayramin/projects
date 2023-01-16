<?php
$data = $fn->getDataByID("v_area", "AreaID", @$_REQUEST['AreaID']);
?>
<!-- Content Start -->
<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="country_name" class="control-label"><?php echo CountryName; ?> <span style="color: red;">*</span> </label>
                <?php
                $selected = isset($_REQUEST['CountryID']) ? $_REQUEST['CountryID'] : 4;
                $db_array = array("tbl_name" => 'v_country', "condition" => "is_active='Y'");
                $select_array = array("name" => "CountryID", "id" => "CountryID", "class" => "form-control chosen-select required", "onchange" => "LoadState(this.value,\"\",\"StateID\",\"CityID\",\"AreaID\",\"IN\");");
                $option_array = array("value" => "CountryID", "label" => "CountryName", "placeholder" => "Select Country", 'selected' => $selected);
                $fn->dropdown($db_array, $select_array, $option_array);
                ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="state_name" class="control-label"><?php echo StateName; ?> <span style="color: red;">*</span> </label>
                <?php
                    $SelectedState = isset($_REQUEST['StateID']) ? $_REQUEST['StateID'] : "";
                    $StateFilter = isset($data['StateID']) ? "is_active='Y' AND CountryID='".$data['CountryID'] ."'": "is_active='Y'";
                    $db_array = array("tbl_name" => 'v_state', "condition"=>$StateFilter);
                    $select_array = array("name" => "StateID", "id" => "StateID", "class" => "form-control chosen-select required","onchange"=>"LoadCity(this.value,\"".$SelectedState."\",\"CityID\",\"AreaID\",\"IN\");");
                    $option_array = array("value" => "StateID", "label" => "StateName", "placeholder" => "Select State", 'selected' => $SelectedState);
                    $fn->dropdown($db_array, $select_array, $option_array);
                      ?>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="form-group">
                <label for="city_name" class="control-label"><?php echo CityName; ?> <span style="color: red;">*</span> </label>
                <?php
                $selected = isset($_REQUEST['CityID']) ? $_REQUEST['CityID'] : "";
                $StateFilter = isset($data['CityID']) ? "is_active='Y' AND CityID='" . $data['CityID'] . "'" : "is_active='Y'";
                $db_array = array("tbl_name" => 'v_city', "condition" => $StateFilter);
                $select_array = array("name" => "CityID", "id" => "CityID", "class" => "form-control chosen-select required", "onchange" => "LoadAreas(this.value,\"" . $selected . "\",\"AreaID\",\"IN\");");
                $option_array = array("value" => "CityID", "label" => "CityName", "placeholder" => "Select City", 'selected' => $selected);
                $fn->dropdown($db_array, $select_array, $option_array);
                ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="area_name" class="control-label"><?php echo AreaName; ?> <span style="color: red;">*</span> </label>
                <input type="text" class="form-control material required" name="AreaName" id="StateName" value="<?php echo $data['AreaName']; ?>" placeholder="Enter area name here...">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="zip_name" class="control-label"><?php echo ZIPCode; ?> <span style="color: red;">*</span> </label>
                <input type="text" class="form-control material required" name="ZIPCode" id="ZIPCode" maxlength="7" value="<?php echo $data['ZIPCode']; ?>" placeholder="Enter ZIP Code here...">
            </div>
        </div>
    </div>
    <div class="row"><hr>
    </div>
    <div class="form-group">
        <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
        <?php if (isset($_REQUEST['AreaID'])) { ?>
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="update_data('<?php echo 'v_area'; ?>', 'AreaID', '<?php echo $_REQUEST['AreaID']; ?>', 'view_area', this.form);" ><?php echo update; ?></button>
        <?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="insert_data('<?php echo 'v_area'; ?>', 'view_area&StateID=<?php echo $_REQUEST['StateID'];?>&CityID=<?php echo $_REQUEST['CityID'];?>', this.form);" ><?php echo save; ?></button>
        <?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view_area"><?php echo cancel; ?></a>
    </div>
</form>

<script>  
    jQuery(function ($) {
        $("#ZIPCode").mask("999-999");
              
    });
</script>