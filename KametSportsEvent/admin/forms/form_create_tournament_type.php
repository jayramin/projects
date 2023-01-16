<?php
$data = $fn->getDataByID('v_tournament_type', 'SrNo', $_REQUEST['SrNo']);
//echo '<pre>';
//print_r($data);
?>
<!-- Content Start -->
<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="levels_Name" class="control-label"><?php echo TypeName; ?> <span style="color: red;">*</span> </label>
                <input type="text" class="form-control material required" name="TypeName" id="LevelName" value="<?php echo $data['TypeName']; ?>" placeholder="Enter Type name here...">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="levels_Name" class="control-label"><?php echo TypeDescription; ?> <span style="color: red;">*</span> </label>
                <textarea class="form-control material required"  name="TypeDescription" id="TypeDescription" placeholder="Type Description..."><?php echo $data['TypeDescription']; ?></textarea>
                
            </div>
        </div>
    </div>
    <div class="row"><hr>
        </div>
    <div class="form-group">
        <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
        <?php if (isset($_REQUEST['SrNo'])) { ?>
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="update_data('<?php echo 'v_tournament_type'; ?>', 'SrNo', '<?php echo $_REQUEST['SrNo']; ?>', 'view_tournament_type', this.form);" ><?php echo update; ?></button>
        <?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="insert_data('<?php echo 'v_tournament_type'; ?>', 'view_tournament_type', this.form);" ><?php echo save; ?></button>
        <?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view_tournament_type"><?php echo cancel; ?></a>
    </div>
</form>