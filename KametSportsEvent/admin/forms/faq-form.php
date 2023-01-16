<?php
$data = $fn->getDataByID("t4m_faq", "faq_id", @$_REQUEST['faq_id']);
?>
<script type="text/javascript" src="js/nicEdit.js"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function () {
        nicEditors.allTextAreas()
    });
</script>
<style>
    .nicEdit-main{
        height:200px;
    }
</style>
<!-- Content Start -->
<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="faq_question" class="control-label"><?php echo faq_question; ?> <span style="color: red;">*</span> </label>
                <input type="text" class="form-control material required" name="faq_question" id="faq_question" value="<?php echo $data['faq_question']; ?>" placeholder="Enter question here...">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label for="faq_answer" class="control-label"><?php echo faq_answer; ?> <span style="color: red;">*</span> </label>
                <textarea name="faq_answer" id="faq_answer" class="form-control nicEdit-main input-sm required"><?php echo $data['faq_answer']; ?>
                </textarea>
            </div>
        </div>
    </div>
    <div class="row"><hr>
    </div>
    <div class="form-group">
        <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
        <?php if (isset($_REQUEST['faq_id'])) { ?>
            <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="update_data('<?php echo 't4m_faq'; ?>', 'faq_id', '<?php echo $_REQUEST['faq_id']; ?>', 'view-faq', this.form);" ><?php echo update; ?></button>
        <?php } else { ?>
            <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="insert_data('<?php echo 't4m_faq'; ?>', 'view-faq', this.form);" ><?php echo save; ?></button>
        <?php } ?>
        <a class="btn btn-warning text-uppercase waves" href="view-state"><?php echo cancel; ?></a>
    </div>
</form>