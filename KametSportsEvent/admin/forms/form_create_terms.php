<?php
$data = $fn->getDataByID("shopi_terms", "term_id", @$_REQUEST['term_id']);
?>
<style>
    .nicEdit-main{
        height:200px;
        margin-left: 10px !important;
    }
</style>
<script type="text/javascript">
    bkLib.onDomLoaded(function () {
        nicEditors.allTextAreas()
    });
</script>
<section class="panel-body">
    <!-- Content Start -->
    <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="country_name" class="control-label"><?php echo term_description ?> <span style="color: red;">*</span> </label>
                    <textarea name="" id="term_description" class="form-control input-sm required" required><?php echo $data['term_description']; ?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2"> 
                <div class="form-group">
                    <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
                    <?php if (isset($_REQUEST['term_id'])) { ?>
                        <input type="button" name="update" id="updateButton" value="<?php echo update; ?>" class="btn btn-primary btn-sm " onclick="update_data('<?php echo 'shopi_terms'; ?>', 'term_id', '<?php echo $_REQUEST['term_id'] ?>', 'view_terms', this.form);" >
                    <?php } else { ?>
                        <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-sm " onclick="insert_data('<?php echo 'shopi_terms'; ?>', 'view_terms', this.form);" >
                    <?php } ?>
                    <a class="btn btn-primary btn-sm" href="view_terms"><?php echo cancel; ?></a>
                </div>
            </div>
        </div>
    </form>
</section>