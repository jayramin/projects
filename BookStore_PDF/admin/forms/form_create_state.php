<?php
error_reporting(E_ALL);
    $data = $fn->getDataByID("b_state", "StateID",@$_REQUEST['StateID']);
//    print_r($data);
//exit;

    ?>
<div class="row card">
    <div class="col-md-12">
        <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
        <div class="row">
          
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="city_name" class="control-label"><?php echo StateName; ?></label>
                    <input type="text" name="StateName" id="StateName" value="<?php echo $data['StateName']; ?>" class="form-control input-sm required">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
               
                <div class="form-group">
                    <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
                    <?php if (isset($_REQUEST['StateID']) && $_REQUEST['StateID'] != '') { ?>
                    
                    <input type="button" name="update" id="update" value="<?php echo update; ?>" class="btn btn-primary btn-md" onclick="update_data('<?php echo 'b_state'; ?>', 'StateID', '<?php echo $_REQUEST['StateID']; ?>', 'view_state', this.form);" >
                    <?php } else { ?>
                    
                        <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-md" onclick="InsertStateData(this.form);" >
                    <?php } ?>
                        <a class="btn btn-primary btn-md" href="view_state&CountryID=<?php echo $_REQUEST['CountryID']?>">Cancel</a>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
<!--<script>
    function insert_data(TableName,Page,Form){
        alert("call");
        return false;
    }
    </script>-->