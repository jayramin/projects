<?php
$data = $fn->getDataByID('v_attacks', 'AttackID', $_REQUEST['AttackID']);
//echo '<pre>';
//print_r($data);
?>
<!-- Content Start -->
<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="country_name" class="control-label"><?php echo AttackName; ?> <span style="color: red;">*</span> </label><br><br>
                <input type="text" class="form-control material required" name="AttackName" id="AttackName" value="<?php echo $data['AttackName']; ?>" placeholder="Enter attack title here...">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="country_name" class="control-label"><?php echo AttackDescription; ?> <span style="color: red;">*</span> </label>
                <textarea class="form-control material required" name="AttackDescription" id="AttackDescription"  placeholder="Enter Description..."><?php echo $data['AttackDescription']; ?></textarea>
                
            </div>
        </div>
    </div>
    <div class="row"><hr>
        </div>
    <div class="form-group">
        <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
        <?php if (isset($_REQUEST['AttackID'])) { ?>
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="update_data('<?php echo 'v_attacks'; ?>', 'AttackID', '<?php echo $_REQUEST['AttackID']; ?>', 'view_attack', this.form);" ><?php echo update; ?></button>
        <?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="insert_data('<?php echo 'v_attacks'; ?>', 'view_attack', this.form);" ><?php echo save; ?></button>
        <?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view_attack"><?php echo cancel; ?></a>
    </div>
</form>