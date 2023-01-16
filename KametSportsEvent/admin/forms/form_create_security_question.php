<?php
$data = $fn->getDataByID('v_security_question', 'SecurityQuestionID', $_REQUEST['SecurityQuestionID']);
?>
<!-- Content Start -->
<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="Question" class="control-label"><?php echo Question; ?> <span style="color: red;">*</span> </label>
                <input type="text" class="form-control material required" name="Question" id="Question" value="<?php echo $data['Question']; ?>" placeholder="Enter Question here...">
            </div>
        </div>
    </div>
    <div class="row"><hr>
        </div>
    <div class="form-group">
        <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
        <?php if (isset($_REQUEST['SecurityQuestionID'])) { ?>
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="update_data('<?php echo 'v_security_question'; ?>', 'SecurityQuestionID', '<?php echo $_REQUEST['SecurityQuestionID']; ?>', 'view_security_question', this.form);" ><?php echo update; ?></button>
        <?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="insert_data('<?php echo 'v_security_question'; ?>', 'view_security_question', this.form);" ><?php echo save; ?></button>
        <?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view_security_question"><?php echo cancel; ?></a>
    </div>
</form>