<?php
error_reporting(E_ALL);
    $data = $fn->getDataByID("b_category", "CategoryID",@$_REQUEST['CategoryID']);
//    print_r($data);
//exit;

    ?>
<div class="row card">
    <div class="col-md-12">
        <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
        <div class="row">
          
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="city_name" class="control-label"><?php echo CategoryTitle; ?></label>
                    <input type="text" name="CategoryTitle" id="CategoryTitle" value="<?php echo $data['CategoryTitle']; ?>" class="form-control input-sm required">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
               
                <div class="form-group">
                    <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
                    <?php if (isset($_REQUEST['CategoryID']) && $_REQUEST['CategoryID'] != '') { ?>
                    
                    <input type="button" name="update" id="update" value="<?php echo update; ?>" class="btn btn-primary btn-md" onclick="update_data('<?php echo 'b_category'; ?>', 'CategoryID', '<?php echo $_REQUEST['CategoryID']; ?>', 'view_category_master', this.form);" >
                    <?php } else { ?>
                    
                        <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-md" onclick="InsertCategoryData(this.form);" >
                    <?php } ?>
                        <a class="btn btn-primary btn-md" href="view_category_master">Cancel</a>
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