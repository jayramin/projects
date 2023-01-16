
<?php
//require_once 'language/en.php';
//$db = new DataTransaction();
//$lang = new en();
$create_country = new create_country();

//$data = $create_country->get_create_country();
$data = $create_country->get_create_countrybyfields(@$_REQUEST['country_id'], "");
//print_r($data);
?>
<!-- Content Start -->
<form action="" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="country_name" class="control-label"><?php echo $lang->lang['Country_Name'] ?> <span style="color: red;">*</span> </label>
                <input type="text" name="country_name" id="country_name" value="<?php echo $data['country_name']; ?>" class="form-control input-sm required">
            </div>
        </div>
    </div>
    <div class="row col-lg-12">
        <div class="col-lg-1">
            <div class="form-group">
                <input type="hidden" name="is_active" value="1">
                <?php if (isset($_REQUEST['country_id'])) { ?>
                    <input type="button" name="update" id="update" value="<?php echo $lang->lang['update']; ?>" class="btn btn-primary btn-sm " onclick="update_data('<?php echo TBL_COUNTRIES; ?>', 'country_id', '<?php echo $_REQUEST['country_id'] ?>', 'view_country', this.form);" >
                <?php } else { ?>
                    <input type="button" name="create" id="create" value="<?php echo $lang->lang['add']; ?>" class="btn btn-primary btn-sm " onclick="insert_data('<?php echo TBL_COUNTRIES; ?>', 'view_messages', this.form);" >
                <?php } ?>
            </div></div>
        <div class="col-lg-1">
            <a class="btn btn-primary btn-sm pull-right marrig10" href="view_messages"><?php echo $lang->lang['cancel']; ?></a>
        </div>
    </div>
</form>