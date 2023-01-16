<?php
$data = $fn->getDataByID("shopi_contact_us", "contact_id", @$_REQUEST['contact_id']);
//print_r($data);
?>

<section class="panel-body">
    <!-- Content Start -->
    <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="country_name" class="control-label"><?php echo company_name ?> <span style="color: red;">*</span> </label>
                    <input type="text" name="company_name" id="company_name" value="<?php echo $data['company_name']; ?>" class="form-control input-sm required" required>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="country_name" class="control-label"><?php echo address ?> <span style="color: red;">*</span> </label>
                    <textarea name="address" id="address" class="form-control input-sm required" required><?php echo $data['address']; ?></textarea>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="country_name" class="control-label"><?php echo phone_no ?> <span style="color: red;">*</span> </label>
                    <input type="text" name="phone_no" id="phone_no" value="<?php echo $data['phone_no']; ?>" class="form-control input-sm required" required>
                </div>
            </div>	
        </div>    
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="country_name" class="control-label"><?php echo email ?> <span style="color: red;">*</span> </label>
                    <input type="text" name="email" id="email" value="<?php echo $data['email']; ?>" class="form-control input-sm required" required>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="country_name" class="control-label"><?php echo fax ?> <span style="color: red;">*</span> </label>
                    <input type="text" name="fax" id="fax" value="<?php echo $data['fax']; ?>" class="form-control input-sm required" required>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="country_name" class="control-label"><?php echo zipcode ?> <span style="color: red;">*</span> </label>
                    <input type="text" name="zipcode" id="zipcode" value="<?php echo $data['zipcode']; ?>" class="form-control input-sm required" required>
                </div>
            </div>	
        </div>
        <div class="row">
            <div class="col-lg-2"> 
                <div class="form-group">
                    <input type="hidden" name="is_active" value="Y">
                    <?php if (isset($_REQUEST['contact_id'])) { ?>
                        <input type="button" name="update" id="updateButton" value="<?php echo update; ?>" class="btn btn-primary btn-sm " onclick="update_data('<?php echo 'shopi_contact_us'; ?>', 'contact_id', '<?php echo $_REQUEST['contact_id'] ?>', 'view_contact', this.form);" >
                    <?php } else { ?>
                        <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-sm " onclick="insert_data('<?php echo 'shopi_contact_us'; ?>', 'view_contact', this.form);" >
                    <?php } ?>
                    <a class="btn btn-primary btn-sm" href="view_contact"><?php echo cancel; ?></a>
                </div>
            </div>
        </div>
    </form>
</section>