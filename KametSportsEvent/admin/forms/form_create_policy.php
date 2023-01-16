<?php
$data = $fn->getDataByID("shopi_privacy", "privacy_id", @$_REQUEST['privacy_id']);
//print_r($data);
?>
<style>
/*    .nicEdit-main{
        height:300px;
        margin-left: 10px !important;
    }*/
</style>
<script type="text/javascript">
//    bkLib.onDomLoaded(function () {
//        nicEditors.allTextAreas()
//    });
</script>
<section class="panel-body">
    <!-- Content Start -->
    <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
        <div class="row">        
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="country_name" class="control-label"><?php echo privacy_content ?> <span style="color: red;">*</span> </label>
                    <textarea name="" id="privacy_content" class="form-control input-sm required" required><?php echo $data['privacy_content']; ?></textarea>
                </div>
            </div>	
        </div>
        <div class="row">
            <div class="col-lg-2"> 
                <div class="form-group">
<!--                    <input type="hidden" name="is_active" value="Y">-->
                    <?php if (isset($_REQUEST['privacy_id'])) { ?>
                        <input type="button" name="update" id="updateButton" value="<?php echo update; ?>" class="btn btn-primary btn-sm " onclick="update_data('<?php echo 'shopi_privacy'; ?>', 'privacy_id', '<?php echo $_REQUEST['privacy_id'] ?>', 'view_policy', this.form);" >
                    <?php } else { ?>
                        <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-sm " onclick="insert_data('<?php echo 'shopi_privacy'; ?>', 'view_policy', this.form);" >
                    <?php } ?>
                    <a class="btn btn-primary btn-sm" href="view_policy"><?php echo cancel; ?></a>
                </div>
            </div>
        </div>
    </form>
</section>



<script>
    CKEDITOR.replace("privacy_content");
</script>