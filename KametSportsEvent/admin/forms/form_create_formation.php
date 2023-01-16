<?php
$data = $fn->getDataByID('v_formation', 'FormationID', $_REQUEST['FormationID']);
?>
<!-- Content Start -->
<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="Formation_Name" class="control-label"><?php echo FormationName; ?> <span style="color: red;">*</span> </label>
                <input type="text" class="form-control material required" name="FormationName" id="FormationName" value="<?php echo $data['FormationName']; ?>" placeholder="Enter Formation name here...">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="Formation_Name" class="control-label"><?php echo FormationName; ?> <span style="color: red;">*</span> </label>
                <textarea class="form-control material required"  name="FormationDescription" id="FormationDescription" value="<?php echo $data['FormationDescription']; ?>" placeholder="Formation Description..."></textarea>
                
            </div>
        </div>
    </div>
    <div class="row"><hr>
        </div>
    <div class="form-group">
        <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
        <?php if (isset($_REQUEST['FormationID'])) { ?>
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="update_data('<?php echo 'v_formation'; ?>', 'FormationID', '<?php echo $_REQUEST['FormationID']; ?>', 'view_formation', this.form);" ><?php echo update; ?></button>
        <?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="insert_data('<?php echo 'v_formation'; ?>', 'view_formation', this.form);" ><?php echo save; ?></button>
        <?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view_formation"><?php echo cancel; ?></a>
    </div>
</form>