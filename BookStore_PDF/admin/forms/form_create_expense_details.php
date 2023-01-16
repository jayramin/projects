<?php
error_reporting(0);
    $data = $fn->getDataByID("b_expense", "ExpenseID",@$_REQUEST['ExpenseID']);
?>
<div class="row card">
    <div class="col-md-12">
        <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-4">
            <div class="form-group">
                <label for="ExpenseTitle" class="control-label"><?php echo ExpenseTitle; ?> <span style="color: red;">*</span> </label>
                <input type="text" name="ExpenseTitle" id="ExpenseTitle" class="form-control required" value="<?php echo $data['ExpenseTitle']; ?>">
                
            </div>
        </div>
                <div class="col-lg-4">
                <div class="form-group">
                    <label for="ExpenseDate" class="control-label"><?php echo ExpenseDate; ?> <span style="color: red;">*</span></label>
                    <input type="date" name="ExpenseDate" id="ExpenseDate" value="<?php echo $data['ExpenseDate']; ?>" class="form-control input-sm required">
                </div>
            </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="ExpenseDescription" class="control-label"><?php echo ExpenseDescription; ?></label>
                <textarea name="ExpenseDescription" id="ExpenseDescription" class="form-control"><?php echo $data['ExpenseTitle']; ?></textarea>
            </div>
        </div>
        
            </div>
            <div class="col-lg-12">
                <div class="col-lg-4">
                <div class="form-group">
                    <label for="ExpenseAmount" class="control-label"><?php echo ExpenseAmount; ?> <span style="color: red;">*</span></label>
                    <input type="text" name="ExpenseAmount" id="ExpenseAmount" value="<?php echo $data['ExpenseAmount']; ?>" class="form-control input-sm required" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10">
                </div>
            </div>
            </div>
            
            
        
            
        </div>
        <div class="row">
            <div class="col-lg-3">
               
                <div class="form-group">
                    <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
                    <?php if (isset($_REQUEST['ExpenseID']) && $_REQUEST['ExpenseID'] != '') { ?>
                    
                    <input type="button" name="update" id="update" value="<?php echo update; ?>" class="btn btn-primary btn-md" onclick="update_data('<?php echo 'b_expense'; ?>', 'ExpenseID', '<?php echo $data['ExpenseID']; ?>', 'view_expense_details', this.form);" >
                    <?php } else { ?>
                    
                        <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-md" onclick="InsertExpenseData(this.form);" >
                    <?php } ?>
                        <a class="btn btn-primary btn-md" href="view_expense_details">Cancel</a>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>