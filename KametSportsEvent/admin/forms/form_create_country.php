<?php
$data = $fn->getDataByID('v_country', 'CountryID', $_REQUEST['CountryID']);
?>
<!-- Content Start -->
<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="country_name" class="control-label"><?php echo CountryName; ?> <span style="color: red;">*</span> </label>
                <input type="text" class="form-control material required" name="CountryName" id="CountryName" value="<?php echo $data['CountryName']; ?>" placeholder="Enter country name here...">
            </div>
        </div>
    </div>
    <div class="row"><hr>
        </div>
    <div class="form-group">
        <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
        <?php if (isset($_REQUEST['CountryID'])) { ?>
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="update_data('<?php echo 'v_country'; ?>', 'CountryID', '<?php echo $_REQUEST['CountryID']; ?>', 'view_country', this.form);" ><?php echo update; ?></button>
        <?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="insert_data('<?php echo 'v_country'; ?>', 'view_country', this.form);" ><?php echo save; ?></button>
        <?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view_country"><?php echo cancel; ?></a>
    </div>
</form>