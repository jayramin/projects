<?php
    $data = $fn->getDataByID("b_city", "CityID",@$_REQUEST['CityID']);
//    print_r($data);
?>
<!-- Content Start -->
<div class="row card">
    <div class="col-md-12">
        <form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="state_name" class="control-label"><?php echo StateName; ?> <span style="color: red;">*</span> </label>
                <?php
                    if($data['StateID'] != ''){
                        $SelectedState = $data['StateID']; 
                    }else if($_REQUEST['StateID'] != ''){
                        $SelectedState = $_REQUEST['StateID'];
                    }
//                    $SelectedState123 = isset($data['StateID']) ? $data['StateID'] : "";
                    $StateFilter = isset($data['StateID']) ? "is_active='Y' AND CountryID='".$data['CountryID'] ."'": "is_active='Y'";
                    $db_array = array("tbl_name" => 'b_state', "condition"=>$StateFilter);
                    $select_array = array("name" => "StateID", "id" => "StateID", "class" => "form-control chosen-select required","onchange"=>"LoadCity(this.value,\"".$SelectedState."\",\"CityID\",\"AreaID\",\"IN\");");
                    $option_array = array("value" => "StateID", "label" => "StateName", "placeholder" => "Select State", 'selected' => $SelectedState);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="city_name" class="control-label"><?php echo CityName; ?> <span style="color: red;">*</span> </label>
                <input type="text" class="form-control material required" name="CityName" id="StateName" value="<?php echo $data['CityName']; ?>" placeholder="Enter city name here...">
            </div>
        </div>
    </div>
    <div class="row"><hr>
        </div>
    <div class="form-group">
        <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
        <?php if (isset($_REQUEST['CityID'])) { ?>
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="update_data('<?php echo 'b_city'; ?>', 'CityID', '<?php echo $_REQUEST['CityID']; ?>', 'view_city&StateID=<?php echo $_REQUEST['StateID']?>&CountryID=<?php echo $_REQUEST['CountryID']?>', this.form);" ><?php echo update; ?></button>
        <?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="InsertCityData(this.form);" ><?php echo save; ?></button>
        <?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view_city&StateID=<?php echo $_REQUEST['StateID']?>&CountryID=<?php echo $_REQUEST['CountryID']?>"><?php echo cancel; ?></a>
    </div>
</form>
    </div>
</div>

