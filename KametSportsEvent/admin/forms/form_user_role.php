<?php
//$data = $user_role->get_user_rolebyfields(@$_REQUEST['role_id'], '');
$data = $fn->getDataByID('shopi_user_types', 'UserType', @$_REQUEST['UserType']);
?>
<section class="container">
    <!-- Content Start -->
    <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo $lang->lang['select_user_role'] ?> <span style="color: red;">*</span></label>
                    <input type="text" name="name" id="name" value="<?php echo $data->name; ?>" class="form-control input-sm required">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="description" class="control-label"><?php echo $lang->lang['role_description'] ?> <span style="color: red;">*</span></label>
                    <textarea type="text" name="description" id="description" class="form-control input-sm required"><?php echo $data->description; ?></textarea>
                </div>
            </div>
        </div>
        <div class="row col-lg-12">
            <div class="col-lg-2">
                <div class="form-group">
                    <input type="hidden" name="is_active" value="<?php echo isset($data->is_active) ? $data->is_active : 'Y'; ?>">
                    <?php if (isset($_REQUEST['role_id'])) { ?>
                        <input type="button" name="update" id="update" value="<?php echo $lang->lang['update']; ?>" class="btn btn-primary btn-sm " onclick="update_data('<?php echo TBL_ROLES; ?>', 'role_id', '<?php echo $_REQUEST['role_id'] ?>', 'user_role&method=edit&role_id=<?php echo $_REQUEST['role_id']; ?>', this.form)" >
                    <?php } else { ?>
                        <input type="button" name="create" id="create" value="<?php echo $lang->lang['save']; ?>" class="btn btn-primary btn-sm" onclick="insert_data('<?php echo TBL_ROLES; ?>', 'user_role', this.form);" >
                    <?php } ?>
                    <a class="btn btn-primary btn-sm" href="user_role"><?php echo $lang->lang['cancel']; ?></a>
                </div></div>
        </div>
    </form></section>