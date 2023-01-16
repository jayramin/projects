<?php
$data = $fn->getDataByID('v_levels', 'LevelID', $_REQUEST['LevelID']);
?>
<!-- Content Start -->
<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="levels_Name" class="control-label"><?php echo LevelName; ?> <span style="color: red;">*</span> </label>
                <input type="text" class="form-control material required" name="LevelName" id="LevelName" value="<?php echo $data['LevelName']; ?>" placeholder="Enter Formation name here...">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="levels_Name" class="control-label"><?php echo LevelDescriptoin; ?> <span style="color: red;">*</span> </label>
                <textarea class="form-control material required"  name="LevelDescription" id="LevelDescription" value="<?php echo $data['LevelDescription']; ?>" placeholder="Levels Description..."></textarea>
                
            </div>
        </div>
    </div>
    <div class="row"><hr>
        </div>
    <div class="form-group">
        <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
        <?php if (isset($_REQUEST['LevelID'])) { ?>
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="update_data('<?php echo 'v_levels'; ?>', 'LevelID', '<?php echo $_REQUEST['LevelID']; ?>', 'view_levels', this.form);" ><?php echo update; ?></button>
        <?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="insert_data('<?php echo 'v_levels'; ?>', 'view_levels', this.form);" ><?php echo save; ?></button>
        <?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view_levels"><?php echo cancel; ?></a>
    </div>
</form>