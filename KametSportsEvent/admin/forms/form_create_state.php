<?php

    $data = $fn->getDataByID("v_state", "StateID",@$_REQUEST['StateID']);
//    print_r($data);
//exit;

    ?>
<section class="panel-body">
    <!-- Content Start -->
    <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="CountryName" class="control-label"><?php echo CountryName; ?></label>
                    <?php
                    
                    $selected = isset($data['CountryID']) ? $data['CountryID'] : $_REQUEST['CountryID'];
                    $db_array = array("tbl_name" => 'v_country', "condition"=>"is_active='Y'");
                    $select_array = array("name" => "CountryID", "id" => "CountryID", "class" => "form-control chosen-select required");
                    $option_array = array("value" => "CountryID", "label" => "CountryName", "placeholder" => "Select Country", 'selected' => $selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    
                    ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="city_name" class="control-label"><?php echo StateName; ?></label>
                    <input type="text" name="StateName" id="StateName" value="<?php echo $data['StateName']; ?>" class="form-control input-sm required">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
               
                <div class="form-group">
                    <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
                    <?php if (isset($_REQUEST['StateID']) && $_REQUEST['StateID'] != '') { ?>
                    
                    <input type="button" name="update" id="update" value="<?php echo update; ?>" class="btn btn-primary btn-md" onclick="update_data('<?php echo 'v_state'; ?>', 'StateID', '<?php echo $_REQUEST['StateID']; ?>', 'view_state&CountryID=<?php echo $_REQUEST['CountryID']?>', this.form);" >
                    <?php } else { ?>
                    
                        <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-md" onclick="insert_data('<?php echo 'v_state'; ?>', 'view_state&CountryID=<?php echo $_REQUEST['CountryID']?>', this.form);" >
                    <?php } ?>
                        <a class="btn btn-primary btn-md" href="view_state&CountryID=<?php echo $_REQUEST['CountryID']?>"><?php echo cancel; ?></a>
                </div>
            </div>
        </div>
    </form>
</section>