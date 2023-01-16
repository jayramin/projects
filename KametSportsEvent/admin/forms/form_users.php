<?php
    $data = $fn->getDataByID("v_users", "UserID",@$_REQUEST['UserID']);

    ?>
<!-- Content Start -->
<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="state_name" class="control-label"><?php echo UserName; ?> <span style="color: red;">*</span> </label>
                    <input type="text" class="form-group" name="UserName" id="UserName">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="city_name" class="control-label"><?php echo CityName; ?> <span style="color: red;">*</span> </label>
                    <input type="text" class="form-control material required" name="CityName" id="StateName" value="<?php echo $data['CityName']; ?>" placeholder="Enter city name here...">
                </div>
            </div>
        </div>
    </div>
    <div class="row"><hr>
        </div>
    <div class="form-group">
        <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
        <?php if (isset($_REQUEST['UserID'])) { ?>
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="update_data('<?php echo 'v_users'; ?>', 'UserID', '<?php echo $_REQUEST['UserID']; ?>', 'view_users', this.form);" ><?php echo update; ?></button>
        <?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="insert_data('<?php echo 'v_users'; ?>', 'view_users', this.form);" ><?php echo save; ?></button>
        <?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view_users"><?php echo cancel; ?></a>
    </div>
</form>