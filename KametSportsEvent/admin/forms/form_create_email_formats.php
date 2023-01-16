
<?php
$data = $create_email_formats->get_create_email_formatsbyfields(@$_REQUEST['email_id'], "");
if (isset($data['param_id'])) {
    $param_id = $data['param_id'];
} else {
    $param_id = $_REQUEST['param_id'];
}
?><form action="" id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row">

        <div class="col-lg-4">
            <div class="form-group">
                <label for="title" class="control-label">Subject</label>
                <input type="text" name="subject" id="subject" value="<?php echo $data['subject']; ?>" class="form-control input-sm required">
                <input type="hidden" name="param_id" id="param_id" value="<?php echo $param_id; ?>" class="form-control input-sm required">
            </div>
            <div class="form-group">
                <section class="panel">
                    <header class="panel-heading">
                        <h5>Note: You can use following text for this email format.</h5>
                    </header>
                    <?php
                    $param_qry = $db->selectdata(TBL_EMAIL_PARAMETERS, "`is_active` = '1' AND `sr_no` = '" . $param_id . "'");
                    while ($args = mysql_fetch_assoc($param_qry)) {
                        $const[] = $args['constants'];
                        $title = $args['title'];
                    }
                    $arr[] = json_decode($const[0], true);
                    //print_r($arr);
                    $count = count($arr[0]);
                    ?>
                    <div class="col-lg-6" style="display:none;">
                        <div class="form-group">
                            <label for="title" class="control-label">Category</label>
                            <input type="text" name="title" id="title" value="<?php echo $title; ?>" class="form-control input-sm required">
                        </div>
                    </div>
                    <table id="master" class="table table-striped table-bordered table-condensed" data-ride="datatables">
                        <tbody>
                            <?php
                            $srno = 1;
                            for ($i = 0; $i < $count; $i++) {
                                ?>
                                <tr>
                                    <td style="width:10px;"><?php echo $srno; ?></td><td><label><small><?php echo $arr[0]['const' . $srno]; ?></small></label></td>
                                </tr>
                                <?php
                                $srno++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php ?>
                </section>
            </div>
            <div class="form-group">
                <input type="hidden" name="is_active" value="<?php echo isset($data['is_active']) ? $data['is_active'] : 0; ?>">
                <?php if (isset($_REQUEST['email_id'])) { ?>
                    <input type="button" name="update" id="update" value="<?php echo $lang->lang['update']; ?>" class="btn btn-primary btn-sm bg-blue" onclick="update_data('<?php echo TBL_EMAIL_FORMAT; ?>', 'email_id', '<?php echo $_REQUEST['email_id'] ?>', 'email_formats', this.form);" >
                <?php } else { ?>
                    <input type="button" name="create" id="create" value="<?php echo $lang->lang['add']; ?>" class="btn btn-primary btn-sm bg-blue" onclick="insert_data('<?php echo TBL_EMAIL_FORMAT; ?>', 'email_formats', this.form);">
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="form-group">
                <label for="title" class="control-label">Body</label>
                <textarea name="body" id="body" class="form-control input-sm required"><?php echo $data['body']; ?></textarea>            </div>
        </div>
    </div>

</form>
<script>
                        CKEDITOR.replace("body");
</script>