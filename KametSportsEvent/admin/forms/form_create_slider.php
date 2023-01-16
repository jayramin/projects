<?php
$data = $fn->getDataByID('v_sliders', 'SliderID', $_REQUEST['SliderID']);
//$data = $fn->getDataByID("v_sliders", "SliderID", @$_REQUEST['SliderID']);
?>
<!-- Content Start -->
<form class="content-form" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="col-md-2" ><br><br><br><br>
                <label for="SliderTitle" class="control-label"><?php echo SliderTitle?> </label><br><br>
                <input name="SliderTitle" id="SliderTitle" type="text" value="<?php echo $data['SliderTitle']?>" class="form-control material required" >
            </div>
            <div class="col-md-2" ><br><br><br><br>
                <label for="SliderDescription" class="control-label"><?php echo SliderDescription?> </label><br>
                <textarea name="SliderDescription" id="SliderDescription" class="form-control material required"><?php echo $data['SliderDescription']?></textarea>
            </div>
            <div class="col-md-2">
            <div class="featured-service-right-image-area tab-content">
                <div class="form-group">
                    <label for="SliderImage" class="control-label">Upload <?php echo SliderImage ?> </label><br>
                    <input name="SliderImage" id="SliderImage" type="hidden" class="inputFile input-md" >
                    <input name="SliderImage" id="SliderImage" type="file" class="inputFile input-md" /><br>

                    <span id="SliderImageupload" ></span>
                    <span id="SliderImageloading" style="display: none;  color: orange">Uploading Please wait</span>
                    <div id="SliderImageresponse"></div>
                    <img id="SliderImagePreview" src="<?php echo (!empty($data['SliderImage'])) ? SITE_URL . 'admin/uploads/Slider/' . $data['SliderImage'] : SITE_URL . "admin/uploads/placeholder.png"; ?>" alt="SliderImage" style="width:100px;height:100px;">
                    <button type="button" class="btn btn-xs btn-primary waves waves-button btnSubmit" onclick="SaveFile(this.form, 'SliderImage', 'SliderImagePreview', 'Slider', 'SliderImageupload', 'SliderImageloading', 'SliderImageresponse','in');">Upload</button>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="row"><hr>
    </div>
        <div class="form-group">
            <input name="is_active" id="is_active" type="hidden" value="Y">
    <?php if (isset($_REQUEST['SliderID'])) { ?>
                    <button type="button" name="update" id="updateButton" class="btn btn-primary text-uppercase waves" onclick="update_data('<?php echo 'v_sliders'; ?>', 'SliderID', '<?php echo $_REQUEST['SliderID']; ?>', 'view_slider', this.form);" ><?php echo update; ?></button>
    <?php } else { ?>
                    <button type="button" name="create" id="create" class="btn btn-primary text-uppercase waves" onclick="insert_data('<?php echo 'v_sliders'; ?>', 'view_slider', this.form);" ><?php echo save; ?></button>
    <?php } ?>
            <a class="btn btn-warning text-uppercase waves" href="view_slider"><?php echo cancel; ?></a>
        </div>
</form>