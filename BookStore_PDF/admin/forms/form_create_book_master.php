<?php
error_reporting(0);
    $data = $fn->getDataByID("b_bookmaster", "BookID",@$_REQUEST['BookID']);
    ?>

<div class="row card">
    <div class="col-md-12">
        <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="BookTitle" class="control-label"><?php echo BookTitle; ?></label>
                    <input type="text" name="BookTitle" id="BookTitle" value="<?php echo $data['BookTitle']; ?>" class="form-control input-sm required">
                </div>
            </div>
            <div class="col-lg-4">
            <div class="form-group">
                <label for="CategoryTitle" class="control-label"><?php echo CategoryTitle; ?> <span style="color: red;">*</span> </label>
                <?php
                   
//                    $SelectedState123 = isset($data['StateID']) ? $data['StateID'] : "";
                    $CategoryFilter = "is_active='Y'";
                    $db_array = array("tbl_name" => 'b_category', "condition"=>$CategoryFilter);
                    $select_array = array("name" => "CategoryID", "id" => "CategoryID", "class" => "CategoryID form-control chosen-select required");
                    $option_array = array("value" => "CategoryID", "label" => "CategoryTitle", "placeholder" => "Select Category", 'selected' => $data['CategoryID']);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
            </div>
        </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="BookPrice" class="control-label"><?php echo "Discount Price"; ?></label>
                    <input type="text" name="BookPrice" id="BookPrice" value="<?php echo $data['BookPrice']; ?>" class="form-control input-sm required">
                </div>
            </div>
        </div>
           <div class="row">  
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="BookMRP" class="control-label"><?php echo BookMRP; ?></label>
                    <input type="text" name="BookMRP" id="BookMRP" value="<?php echo $data['BookMRP']; ?>" class="form-control input-sm required">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="BookCode" class="control-label"><?php echo BookEdition; ?></label>
                    <input type="text" name="BookCode" id="BookCode" value="<?php echo $data['BookCode']; ?>" class="form-control input-sm required">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="BookAutherName" class="control-label"><?php echo BookAutherName; ?></label>
                    <input type="text" name="BookAutherName" id="BookAutherName" value="<?php echo $data['BookAutherName']; ?>" class="form-control input-sm required">
                </div>
            </div>
           </div>
             <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="BookPublisher" class="control-label"><?php echo BookPublisher; ?></label>
                    <input type="text" name="BookPublisher" id="BookPublisher" value="<?php echo $data['BookPublisher']; ?>" class="form-control input-sm required">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="BookDescription" class="control-label"><?php echo BookDescription; ?></label>
                    <textarea name="BookDescription" id="BookDescription" class="form-control input-sm required"><?php echo $data['BookDescription']; ?></textarea>
                </div>
            </div>
<!--            <div class="col-lg-4">
                <div class="form-group">
                    <label for="BookQuantity" class="control-label"><?php echo BookQuantity; ?> <span style="color: red;">*</span> </label>
                    <input type="number" class="form-control material required" name="BookQuantity" id="BookQuantity" value="<?php echo $data['BookQuantity']; ?>" placeholder="Enter Book Quantity Here..." min="1" onchange="CheckBookQuantity(this.value)">
                    <span id="MinimumPlayersSpan" style="color: red"></span>

                </div>
            </div>-->
            <div class="col-lg-8">
                <div class="form-group">
                    <div class="featured-service-right-image-area tab-content">
                                                    <div class="form-group">
                                                        <div class="col-lg-6">
                                                        <label for="BookImage" class="control-label">Upload <?php echo BookImage ?> :</label><br>
                                                        <input name="BookImage" id="BookImage" type="hidden" class="inputFile input-md" value="<?php echo (!empty($data['BookImage'])) ? $data['BookImage'] : ""; ?>">
                                                        <input name="BookImage" id="BookImage" type="file" class="inputFile input-md" /><br>

                                                        <span id="BookImageupload" ></span>
                                                        <span id="BookImageloading" style="display: none;  color: orange">Uploading Please wait</span>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div id="BookImageresponse"></div>
                                                        <img id="BookImagePreview" src="<?php echo (!empty($data['BookImage'])) ? SITE_URL . 'admin/uploads/BookImage/' . $data['BookImage'] : SITE_URL . "admin/uploads/placeholder.png"; ?>" alt="BookImage" style="width:100px;height:100px;">
                                                        <button type="button" class="btn btn-xs btn-primary waves waves-button btnSubmit" onclick="SaveFile(this.form, 'BookImage', 'BookImagePreview', 'BookImage', 'BookImageupload', 'BookImageloading', 'BookImageresponse','in');">Upload</button>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
               
                <div class="form-group">
                    <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
                    <?php if (isset($_REQUEST['BookID']) && $_REQUEST['BookID'] != '') { ?>
                    
                    <input type="button" name="update" id="update" value="<?php echo update; ?>" class="btn btn-primary btn-md" onclick="update_data('<?php echo 'b_bookmaster'; ?>', 'BookID', '<?php echo $_REQUEST['BookID']; ?>', 'view_book_master', this.form);" >
                    <?php } else { ?>
                    
                        <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-md" onclick="InsertBookData(this.form);" >
                    <?php } ?>
                        <a class="btn btn-primary btn-md" href="view_book_master">Cancel</a>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>

  <!--<script src="select2.js"></script>-->
<script>
//    $(function(){
//      $('#select2').select2();
//    });
//    
function CheckBookQuantity(e){
        var MinimumPlayer = $('#BookQuantity').val();
//        alert(MinimumPlayer);
//        alert(e);
        if(parseInt(MinimumPlayer) > parseInt(e)){
            $('#MinimumPlayersSpan').text('Maximum Player Should Be Greter Then Minimum Players');
            $('#create').prop('disabled',true);
            return false;
        }else{
            $('#MinimumPlayersSpan').text('');
            $('#create').prop('disabled',false);
        }
    }
</script>