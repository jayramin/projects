<?php
	$Udata = $fn->getDataByID("shopi_users","user_id",@$_REQUEST['user_id']);
	$Adata = $fn->getDataByID("shopi_address_book","user_id",@$_REQUEST['user_id']);
	$data = array_merge($Udata,$Adata);
?>
<section class="panel-body">
    <!-- Content Start -->
    <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
        <h4>Basic Details</h4><hr>
        <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="first_name" class="control-label"><?php echo Fname ?> <span style="color: red;">*</span> </label>
                        <input type="text" name="first_name" id="first_name" value="<?php echo $data['first_name']; ?>" class="form-control input-sm required">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="mname" class="control-label"><?php echo Mname ?> <span style="color: red;">*</span> </label>
                        <input type="text" name="middle_name" id="middle_name" value="<?php echo $data['middle_name']; ?>" class="form-control input-sm">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="last_name" class="control-label"><?php echo Lname ?> <span style="color: red;">*</span> </label>
                        <input type="text" name="last_name" id="last_name" value="<?php echo $data['last_name']; ?>" class="form-control input-sm required">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="stcode" class="control-label"><?php echo email ?> <span style="color: red;">*</span> </label>
                        <input type="text" name="email" id="email" value="<?php echo $data['email']; ?>" class="form-control input-sm required">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="sex" class="control-label"><?php echo Gender ?></label><br>
                        <input class="radio-inline" type="radio" name="sex" id="sex" value="M" <?php
                        if ($data['sex'] == 'M') {
                            echo "checked";
                        }
                        ?>> Male
                        <input class="radio-inline" type="radio" name="sex" id="sex" value="F" <?php
                        if ($data['sex'] == 'F') {
                            echo "checked";
                        }
                        ?>> Female
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="dob" class="control-label"><?php echo Bdate ?></label>
                        <input type="date" name="dob" id="dob" value="<?php echo $data['dob']; ?>" class="form-control input-sm required">
                    </div>
                </div>
        </div>
        <h4>Contact Details</h4><hr>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="cell_number" class="control-label"><?php echo MobileNumber ?></label>
                    <input type="text" name="MobileNumber" id="MobileNumber" value="<?php echo $data['MobileNumber']; ?>" class="form-control input-sm">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="land_number" class="control-label"><?php echo land_number ?></label>
                    <input type="text" name="land_number" id="land_number" value="<?php echo $data['land_number']; ?>" class="form-control input-sm">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="Bdate" class="control-label"><?php echo ResAddressLine1 ?></label>
                    <textarea name="AddressLine1" id="AddressLine2" class="form-control input-sm"><?php echo $data['AddressLine1']; ?></textarea>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="Bdate" class="control-label"><?php echo ResAddressLine2 ?></label>
                    <textarea name="AddressLine2" id="AddressLine2" class="form-control input-sm"><?php echo $data['AddressLine2']; ?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="CountryName" class="control-label"><?php echo CountryName; ?></label>
                    <?php
                    $selected = isset($data['CountrySrNo']) ? $data['CountrySrNo'] : "";
                    $db_array = array("tbl_name" => 'shopi_countries',"condition"=> "is_active='Y'");
                    $select_array = array("name" => "CountrySrNo", "id" => "CountrySrNo", "class" => "chosen-select form-control","onchange"=>"GetStates(this);");
                    $option_array = array("value" => "CountrySrNo", "label" => "CountryName", "placeholder" => "Select Country", 'selected' => $selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="CityName" class="control-label"><?php echo StateName; ?></label>
                    <?php
                    if($_REQUEST['mode']=='add')
                    {
                        ?>
                    <select id="StateSrNo" name="StateSrNo" class="chosen-select form-control required" onchange="GetCities(this);">
                        
                    </select>
                        <?php
                    }else{
                    $selected = isset($data['StateSrNo']) ? $data['StateSrNo'] : "";
                    $db_array = array("tbl_name" => 'shopi_states', "condition"=>"is_active='Y' AND CountrySrNo='".$data['CountrySrNo']."'");
                    $select_array = array("name" => "StateSrNo", "id" => "StateSrNo", "class" => "chosen-select form-control required","onchange"=>"GetCities(this);");
                    $option_array = array("value" => "StateSrNo", "label" => "StateName", "placeholder" => "Select State", 'selected' => $selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="CityName" class="control-label"><?php echo CityName; ?></label>
                    <?php
                    if($_REQUEST['mode']=='add')
                    {
                        ?>
                    <select id="CitySrNo" name="CitySrNo" class="chosen-select form-control required" onchange="GetAreas(this);">
                        
                    </select>
                        <?php
                    }else{
                    $selected = isset($data['CitySrNo']) ? $data['CitySrNo'] : "";
                    $db_array = array("tbl_name" => 'shopi_cities', "condition"=>"is_active='Y' AND StateSrNo = '".$data['StateSrNo']."'");
                    $select_array = array("name" => "CitySrNo", "id" => "CitySrNo", "class" => "chosen-select form-control required","onchange"=>"GetAreas(this);");
                    $option_array = array("value" => "CitySrNo", "label" => "CityName", "placeholder" => "Select City", 'selected' => $selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="zip_code" class="control-label"><?php echo ZIPCode ?></label>
                    <input type="text" name="ZIPCode" id="ZIPCode" value="<?php echo $data['ZIPCode']; ?>" class="form-control input-sm">
                </div>
            </div>
        </div>
        <div class="row">            
            <div class="col-lg-9">
                <div class="form-group">
                    <label for="Bdate" class="control-label"><?php echo about_me ?></label>
                    <textarea name="about_me" id="about_me" class="form-control input-sm"><?php echo $data['about_me']; ?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "N"; ?>">
					<input type="hidden" id="UserType" name="UserType" value="2">
                    <?php if (isset($_REQUEST['user_id'])) { ?>
                        <input type="button" name="update" id="update" value="<?php echo update; ?>" class="btn btn-primary btn-sm " onclick="update_data('<?php echo 'shopi_users'; ?>', 'user_id', '<?php echo $_REQUEST['user_id'] ?>', 'customer_user&method=edit&user_id=<?php echo $_REQUEST['user_id']; ?>', this.form);">
                    <?php } else { ?>
                        <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-sm " onclick="insert_data('<?php echo 'shopi_users'; ?>', 'customer_user', this.form);">
                    <?php } ?>
                </div>
            </div>
        </div>
    </form>
</section>