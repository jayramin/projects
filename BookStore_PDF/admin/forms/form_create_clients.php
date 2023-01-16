<?php
error_reporting(0);
    $data = $fn->getDataByID("b_agent_client", "ClientID",@$_REQUEST['ClientID']);
    ?>
<div class="row card">
    <div class="col-md-12">
        <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="ClientMobileNumber" class="control-label"><?php echo ClientMobileNumber; ?></label>
                    <input type="text" name="ClientMobileNumber" id="AgentName" value="<?php echo $data['ClientMobileNumber']; ?>" class="form-control input-sm required" >
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="ClientName" class="control-label"><?php echo ClientName; ?></label>
                    <input type="text" name="ClientName" id="AgentUserName" value="<?php echo $data['ClientName']; ?>" class="form-control input-sm required">
                </div>
            </div>
            <div class="col-lg-4">
            <div class="form-group">
                <label for="ClientAddressLine1" class="control-label"><?php echo Address1; ?> <span style="color: red;">*</span> </label>
                <input type="text" name="ClientAddressLine1" id="ClientAddressLine1" value="<?php echo $data['ClientAddressLine1']; ?>" class="form-control input-sm required">
            </div>
        </div>
            <div class="col-lg-4">
            <div class="form-group">
                <label for="ClientAddressLine2" class="control-label"><?php echo Address2; ?> <span style="color: red;">*</span> </label>
                <input type="text" name="ClientAddressLine2" id="ClientAddressLine2" value="<?php echo $data['ClientAddressLine2']; ?>" class="form-control input-sm required">
            </div>
        </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="ClientAddressArea" class="control-label"><?php echo ClientAddressArea; ?></label>
                    <input type="text" name="ClientAddressArea" id="ClientAddressArea" value="<?php echo $data['ClientAddressArea']; ?>" class="form-control input-sm required">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="ClientAddressCity" class="control-label"><?php echo ClientAddressCity; ?></label>
                    <input type="text" name="ClientAddressCity" id="ClientAddressCity" value="<?php echo $data['ClientAddressCity']; ?>" class="form-control input-sm required">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="ClientAddressPincode" class="control-label"><?php echo ClientAddressPincode; ?></label>
                    <input type="text" name="ClientAddressPincode" id="ClientAddressPincode" value="<?php echo $data['ClientAddressPincode']; ?>" class="form-control input-sm required">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="ClientEmailID" class="control-label"><?php echo ClientEmailID; ?></label>
                    <input type="text" name="ClientEmailID" id="ClientEmailID" value="<?php echo $data['ClientEmailID']; ?>" class="form-control input-sm required">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
               
                <div class="form-group">
                    <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
                    <input type="hidden" name="AgentID" value="<?php echo (isset($data['AgentID'])) ? $data['AgentID'] : $AgentID; ?>">
                    <?php if (isset($_REQUEST['AgentID']) && $_REQUEST['AgentID'] != '') { ?>
                    
                    <input type="button" name="update" id="update" value="<?php echo update; ?>" class="btn btn-primary btn-md" onclick="update_data('<?php echo 'b_agent'; ?>', 'AgentID', '<?php echo $_REQUEST['AgentID']; ?>', 'view_agent', this.form);" >
                    <?php } else { ?>
                    
                        <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-md" onclick="InsertClientData(this.form);" >
                    <?php } ?>
                        <a class="btn btn-primary btn-md" href="view_agent">Cancel</a>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
<script>
//    function MobileNumberWiseClientData(MobileNumber){
//        alert(MobileNumber);
//    }
</script>