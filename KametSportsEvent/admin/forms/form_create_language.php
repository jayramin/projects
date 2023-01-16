
<?php
$data = $functions->get_data_byid(@$_REQUEST['LangID'], "LangID","shopi_languages");
?>
<section class="panel-body">
<!-- Content Start -->
<form action="" id="form" name="form" method="post" enctype="multipart/form-data"><div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="language_name" class="control-label"><?php echo $lang->lang['Language']; ?></label>
                <input type="text" name="LangName" id="LangName" value="<?php echo $data->LangName; ?>" class="form-control input-sm required">
            </div>
        </div>
</div>
    <div class="row col-lg-12">
        <div class="form-group">
            <input type="hidden" name="is_active" value="1">
            <?php if (isset($_REQUEST['LangID'])) { ?>
                <input type="button" name="update" id="update" value="<?php echo $lang->lang['update']; ?>" class="btn btn-primary btn-sm bg-blue" onclick="update_data('<?php echo TBL_LANGUAGES; ?>', 'LangID', '<?php echo $_REQUEST['LangID'] ?>', 'view_language', this.form)" >
            <?php } else { ?>
                <input type="button" name="create" id="create" value="<?php echo $lang->lang['add']; ?>" class="btn btn-primary btn-sm bg-blue" onclick="insert_data('<?php echo TBL_LANGUAGES; ?>', 'view_language', this.form);" >
            <?php } ?>
        </div>
    </div>
</form>
</section>