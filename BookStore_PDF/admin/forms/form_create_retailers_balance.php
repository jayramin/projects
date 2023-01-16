<?php
error_reporting(0);
$data = $fn->getDataByID("b_retailer_balance", "RetailerBalanceID", @$_REQUEST['RetailerBalanceID']);
?>
<div class="row card">
    <div class="col-md-12">
        <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-12">
                    <?php
//                    echo "<pre>";
//                    print_r($data);
                    ?>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="UserName" class="control-label"> Name of Book Seller <span style="color: red;">*</span> </label>
                            <?php
                            $ConditionFilter = "is_active='Y' AND RoleID='3'";
                            $db_array = array("tbl_name" => 'b_user', "condition" => $ConditionFilter);
                            $select_array = array("name" => "RetailerID", "id" => "RetailerID", "class" => "form-control chosen-select required");
                            $option_array = array("value" => "UserID", "label" => "UserName", "placeholder" => "Select Book Seller", 'selected' => $data['RetailerID']);
                            $fn->dropdown($db_array, $select_array, $option_array);
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="Email" class="control-label"><?php echo Balance; ?></label>
                            <input type="text" name="OpeningBalance" id="OpeningBalance" value="<?php echo $data['OpeningBalance']; ?>" class="form-control input-sm required">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="Date" class="control-label"><?php echo Date; ?></label>
                            <?php if($data['Date'] != ''){ ?>
                            <br><label><?php echo date('d-m-Y', strtotime($data['Date']));?></label>
                           <?php } else{?>
                            <input type="date" name="Date" id="Date" value="<?php echo date('d-m-Y', strtotime($data['Date'])); ?>" class="form-control input-sm required"><?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="Comment" class="control-label"><?php echo Comment; ?></label>
                            <textarea name="Comment" id="Comment" class="form-control input-sm "><?php echo $data['Comment']; ?></textarea>

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!--<label for="BalanceType" class="control-label"><?php echo Type; ?></label>-->
                                </div>
                                <div class="col-lg-4">
                                    
                                    <input type="hidden" name="BalanceType" id="BalanceType" value="Cash" class="" > 
                                </div>
<!--                                <div class="col-lg-5">
                                    <input type="radio" name="BalanceType" id="BalanceType1" value="Cheque" <?php if ($data['BalanceType'] == 'Cheque') { ?> checked="checked"<?php } ?> class="enable_tb" onclick="Call()"> Cheque
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--            <div class="row ">
                <div class="col-lg-12">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="ChequeNo" class="control-label"><?php echo ChequeNo; ?></label>
                            <input type="text" name="ChequeNo" id="ChequeNo" value="<?php echo $data['ChequeNo']; ?>" class="form-control input-sm " disabled="disabled">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="BankName" class="control-label"><?php echo BankName; ?></label>
                            <input type="text" name="BankName" id="BankName" value="<?php echo $data['BankName']; ?>" class="form-control input-sm " disabled="disabled">
                        </div>
                    </div>
                    
                </div>
            </div>  -->
            <div class="row">
                <div class="col-lg-3">

                    <div class="form-group">
                        <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
                        <?php if (isset($_REQUEST['UserID']) && $_REQUEST['UserID'] != '') { ?>

                            <input type="button" name="update" id="update" value="<?php echo update; ?>" class="btn btn-primary btn-md" onclick="update_data('<?php echo 'b_user'; ?>', 'UserID', '<?php echo $_REQUEST['UserID']; ?>', 'view_retailers_details', this.form);" >
                        <?php } else { ?>

                            <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-md" onclick="InsertRetailerOpeningBalanceData(this.form);" >
                        <?php } ?>
                        <a class="btn btn-primary btn-md" href="view_retailers_balance_details">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

