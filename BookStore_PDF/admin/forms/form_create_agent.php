<?php
error_reporting(0);
    $data = $fn->getDataByID("b_agent", "AgentID",@$_REQUEST['AgentID']);
    ?>
<div class="row card">
    <div class="col-md-12">
        <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="AgentUserName" class="control-label"><?php echo AgentUserName; ?></label>
                    <input type="text" name="AgentUserName" id="AgentUserName" value="<?php echo $data['AgentUserName']; ?>" class="form-control input-sm required">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="AgentName" class="control-label"><?php echo AgentName; ?></label>
                    <input type="text" name="AgentName" id="AgentName" value="<?php echo $data['AgentName']; ?>" class="form-control input-sm required">
                </div>
            </div>
            <div class="col-lg-4">
            <div class="form-group">
                <label for="AgentMobileNumber" class="control-label"><?php echo AgentMobileNumber; ?> <span style="color: red;">*</span> </label>
                <input type="text" name="AgentMobileNumber" id="AgentMobileNumber" value="<?php echo $data['AgentMobileNumber']; ?>" class="form-control input-sm required">
            </div>
        </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="AgentEmail" class="control-label"><?php echo AgentEmail; ?></label>
                    <input type="text" name="AgentEmail" id="AgentEmail" value="<?php echo $data['AgentEmail']; ?>" class="form-control input-sm required">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
               
                <div class="form-group">
                    <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
                    <?php if (isset($_REQUEST['AgentID']) && $_REQUEST['AgentID'] != '') { ?>
                    
                    <input type="button" name="update" id="update" value="<?php echo update; ?>" class="btn btn-primary btn-md" onclick="update_data('<?php echo 'b_agent'; ?>', 'AgentID', '<?php echo $_REQUEST['AgentID']; ?>', 'view_agent', this.form);" >
                    <?php } else { ?>
                    
                        <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-md" onclick="InsertAgentData(this.form);" >
                    <?php } ?>
                        <a class="btn btn-primary btn-md" href="view_agent">Cancel</a>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>