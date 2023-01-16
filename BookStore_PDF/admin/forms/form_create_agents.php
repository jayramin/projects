<?php
error_reporting(0);
$data = $fn->getDataByID("b_user", "UserID", @$_REQUEST['UserID']);
?>
<div class="row card">
    <div class="col-md-12">
        <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-8">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label for="UserName" class="control-label"><?php echo UserName; ?></label>
                            <input type="text" name="UserName" id="UserName" value="<?php echo $data['UserName']; ?>" class="form-control input-sm required">
                        </div>
                    </div>

                    <div class="col-lg-10">
                        <div class="form-group">
                            <label for="Email" class="control-label"><?php echo email; ?></label>
                            <input type="text" name="Email" id="Email" value="<?php echo $data['Email']; ?>" class="form-control input-sm required">
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label for="MobileNumber" class="control-label"><?php echo MobileNumber; ?></label>
                            <input type="text" name="MobileNumber" id="MobileNumber" value="<?php echo $data['MobileNumber']; ?>" class="form-control input-sm required" maxlength="10">
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label for="Gender" class="control-label"><?php echo Gender; ?></label>
                            <input type="radio" name="Gender" value="Male" <?php if ($data['Gender'] == "Male") { ?> checked="checked" <?php } else {
    echo "checked";
} ?> > Male
                            <input type="radio" name="Gender" value="Female"  <?php if ($data['Gender'] == "Male") { ?> checked="checked" <?php } ?> > Female

                        </div>
                    </div>

                    <div class="col-lg-10">
                        <div class="form-group">
                            <label>Profile Picture</label>
                            <div class="featured-service-right-image-area tab-content">
                                <div class="form-group">
                                    <div class="col-lg-8">
                                        <input name="ProfilePicture" id="ProfilePicture" type="hidden" class="inputFile input-md" value="<?php echo (!empty($data['ProfilePicture'])) ? $data['ProfilePicture'] : ""; ?>">
                                        <input name="ProfilePicture" id="ProfilePicture" type="file" class="inputFile input-md" /><br>
                                        <button type="button" class="btn btn-xs btn-primary waves waves-button btnSubmit" onclick="SaveImageFile(this.form, 'ProfilePicture', 'ProfilePicturePreview', 'ProfilePicture', 'ProfilePictureupload', 'ProfilePictureloading', 'ProfilePictureresponse', 'in');">Upload</button>
                                        <span id="ProfilePictureupload" ></span>
                                        <span id="ProfilePictureloading" style="display: none;  color: orange">Uploading Please wait</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <div id="ProfilePictureresponse"></div>
                                        <img id="ProfilePicturePreview" src="<?php echo (!empty($data['ProfilePicture'])) ? SITE_URL . 'admin/uploads/ProfilePicture/' . $data['ProfilePicture'] : SITE_URL . "admin/uploads/placeholder.png"; ?>" alt="ProfilePicture" style="width:100px;height:100px;">
                                    </div>                              
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">

                    <div class="form-group">
                        <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
                        <?php if (isset($_REQUEST['UserID']) && $_REQUEST['UserID'] != '') { ?>

                            <input type="button" name="update" id="update" value="<?php echo update; ?>" class="btn btn-primary btn-md" onclick="update_data('<?php echo 'b_user'; ?>', 'UserID', '<?php echo $_REQUEST['UserID']; ?>', 'view_agents_details', this.form);" >
                        <?php } else { ?>

                            <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-md" onclick="InsertAgentData(this.form);" >
<?php } ?>
                        <a class="btn btn-primary btn-md" href="view_agents_details">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function CheckBookQuantity(e) {
        var MinimumPlayer = $('#BookQuantity').val();
        if (parseInt(MinimumPlayer) > parseInt(e)) {
            $('#MinimumPlayersSpan').text('Maximum Player Should Be Greter Then Minimum Players');
            $('#create').prop('disabled', true);
            return false;
        } else {
            $('#MinimumPlayersSpan').text('');
            $('#create').prop('disabled', false);
        }
    }
</script>