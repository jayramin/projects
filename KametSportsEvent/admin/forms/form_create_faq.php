<?php
$data = $fn->getDataByID("shopi_faq", "faq_id", @$_REQUEST['faq_id']);
//print_r($data);
?>
<section class="panel-body">
    <!-- Content Start -->
    <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="country_name" class="control-label"><?php echo faq_question ?> <span style="color: red;">*</span> </label>
                    <input type="text" name="faq_question" id="faq_question" value="<?php echo $data['faq_question']; ?>" class="form-control input-sm required" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="country_name" class="control-label"><?php echo faq_answer ?> <span style="color: red;">*</span> </label>
                    <textarea name="faq_answer" id="faq_answer" class="form-control input-sm required" required><?php echo $data['faq_answer']; ?></textarea>
                </div>
            </div>	
        </div>
        <div class="row">
            <div class="col-lg-2"> 
                <div class="form-group">
                    <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
                    <?php if (isset($_REQUEST['faq_id'])) { ?>
                        <input type="button" name="update" id="updateButton" value="<?php echo update; ?>" class="btn btn-primary btn-sm " onclick="update_data('<?php echo 'shopi_faq'; ?>', 'faq_id', '<?php echo $_REQUEST['faq_id'] ?>', 'view_faq', this.form);" >
                    <?php } else { ?>
                        <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-sm " onclick="insert_data('<?php echo 'shopi_faq'; ?>', 'view_faq', this.form);" >
                    <?php } ?>
                    <a class="btn btn-primary btn-sm" href="view_faq"><?php echo cancel; ?></a>
                </div>
            </div>
        </div>
    </form>
</section>


<script>
    CKEDITOR.replace("faq_answer");
</script>