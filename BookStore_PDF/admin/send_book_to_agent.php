<?php
$data = $fn->getDataByID("b_user", "UserID",@$_REQUEST['AgentID']);
?>

<div class="row card">
    <div class="col-md-12">
        <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
        <div class="row">

            <div class="col-lg-4">
            <div class="form-group">
                <label for="CategoryTitle" class="control-label"><?php echo CategoryTitle; ?> <span style="color: red;">*</span> </label>
                <?php
                    $CategoryFilter = "is_active='Y'";
                    $db_array = array("tbl_name" => 'b_category', "condition"=>$CategoryFilter);
                    $select_array = array("name" => "CategoryID", "id" => "CategoryID", "class" => "form-control chosen-select required","onchange" => "GetBook(this.value);");
                    $option_array = array("value" => "CategoryID", "label" => "CategoryTitle", "placeholder" => "Select Category", 'selected' => $data['CategoryID']);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="CategoryTitle" class="control-label"><?php echo BookTitle; ?> <span style="color: red;">*</span> </label>
                <?php
//                       echo "<pre>";
//    print_r($data);
//                    $SelectedState123 = isset($data['StateID']) ? $data['StateID'] : "";
                    $CategoryFilter = "is_active='Y'";
                    $db_array = array("tbl_name" => 'b_bookmaster', "condition"=>$CategoryFilter);
                    $select_array = array("name" => "BookID", "id" => "BookID", "class" => "form-control chosen-select required");
                    $option_array = array("value" => "BookID", "label" => "BookTitle", "placeholder" => "Select Book", 'selected' => $data['BookID']);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
            </div>
        </div>
        <div class="col-lg-4">
                <div class="form-group">
                    <label for="Quantity" class="control-label"><?php echo Quantity; ?></label>
                    <input type="number" min="0" name="Quantity" id="Quantity" value="<?php echo $data['Quantity']; ?>" class="form-control input-sm required" style="padding: 16px">
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-lg-3">
               
                <div class="form-group">
                    <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
                    <?php if (isset($_REQUEST['BookID']) && $_REQUEST['BookID'] != '') { ?>
                    
                    <input type="button" name="update" id="update" value="<?php echo update; ?>" class="btn btn-primary btn-md" onclick="update_data('<?php echo 'b_stock_master'; ?>', 'StockID', '<?php echo $data['StockID']; ?>', 'view_book_quantity', this.form);" >
                    <?php } else { ?>
                    
                        <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-md" onclick="InsertBookQuantityData(this.form);" >
                    <?php } ?>
                        <a class="btn btn-primary btn-md" href="view_book_quantity">Cancel</a>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
<script>
function GetBook(e) {
        var url = "../class/class.ajaxRequest.php";
        $.ajax({
            type: 'POST',
            url: url,
            data: {'do': 'GetBook', 'CategoryID': e},
            success: function (result) {
//                alert(result);
                $('#BookID').html(result);

//                $('#CityID').html(result);
//                $('#AreaID').html('<option value="">Select Area</option>');
//                $("#CityID").select2("val","");
            }
        });
}
</script>