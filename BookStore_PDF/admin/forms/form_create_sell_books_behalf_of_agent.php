<?php
$AgentID = $_SESSION['BookStore']['session']['UserID'];
$data = $fn->getDataByID("b_agent_book_stock", "AgentBookStockID",@$_REQUEST['AgentBookStockID']);
if(isset($_REQUEST['AgentBookStockMasterID']) && $_REQUEST['AgentBookStockMasterID'] !=''){
    $AgentWiseBookStock = $fn->GetAgentWiseBookStock('{"ClientID":"'.$_REQUEST['ClientID'].'","ClientIDBookStockMasterID":"'.$_REQUEST['AgentBookStockMasterID'].'"}');
}else{
    $AgentWiseBookStock = $fn->GetAgentOrderPenddingData('{"ClientID":"'.$_REQUEST['ClientID'].'"}');
}
?>
<!--Content-->
<div class="row card" style=" margin: 15px 20px 0 0px;">
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
                    $CategoryFilter = "is_active='Y'";
                    $db_array = array("tbl_name" => 'b_bookmaster', "condition"=>$CategoryFilter);
                    $select_array = array("name" => "BookID", "id" => "BookID", "class" => "form-control chosen-select required", "onchange" => "GetBookPrice(this.value);");
                    $option_array = array("value" => "BookID", "label" => "BookTitle", "placeholder" => "Select Book", 'selected' => $data['BookID']);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
            </div>
        </div>
        <div class="col-lg-4">
                <div class="form-group">
                    <label for="Quantity" class="control-label"><?php echo Quantity; ?></label>
                    <input type="number" min="0" name="Quantity" id="Quantity" value="<?php echo $data['Quantity']; ?>" class="form-control input-sm required" style="padding: 16px" onchange="GetAmountPrice(this.value)">
                </div>
        </div>
        </div>
            <div class="row">
        <div class="col-lg-4">
                <div class="form-group">
                    <label for="ClientName" class="control-label"><?php echo ClientName; ?></label>
                    <input type="text" name="ClientName" id="ClientName" value="<?php echo $data['ClientName']; ?>" class="form-control input-sm required" />
                </div>
        </div>
        <div class="col-lg-4">
                <div class="form-group">
                    <label for="ClientAddressLine1" class="control-label"><?php echo Address1; ?></label>
                    <input type="text" name="ClientAddressLine1" id="ClientAddressLine1" value="<?php echo $data['ClientAddressLine1']; ?>" class="form-control input-sm required" />
                </div>
        </div>
        <div class="col-lg-4">
                <div class="form-group">
                    <label for="ClientAddressLine2" class="control-label"><?php echo Address2; ?></label>
                    <input type="text" name="ClientAddressLine2" id="ClientAddressLine2" value="<?php echo $data['ClientAddressLine2']; ?>" class="form-control input-sm required" />
                </div>
        </div>
            </div>
            <div class="row">
        <div class="col-lg-4">
                <div class="form-group">
                    <label for="ClientAddressArea" class="control-label"><?php echo Area; ?></label>
                    <input type="text" name="ClientAddressArea" id="ClientAddressArea" value="<?php echo $data['ClientAddressArea']; ?>" class="form-control input-sm required" />
                </div>
        </div>
        <div class="col-lg-4">
                <div class="form-group">
                    <label for="ClientAddressCity" class="control-label"><?php echo city; ?></label>
                    <input type="text" name="ClientAddressCity" id="ClientAddressCity" value="<?php echo $data['ClientAddressCity']; ?>" class="form-control input-sm required" />
                </div>
        </div>
        <div class="col-lg-4">
                <div class="form-group">
                    <label for="ClientAddressPincode" class="control-label"><?php echo Pincode; ?></label>
                    <input type="text" name="ClientAddressPincode" id="ClientAddressPincode" value="<?php echo $data['ClientAddressPincode']; ?>" class="form-control input-sm required"   onkeypress="return event.charCode > 47 && event.charCode < 58;"  maxlength="6"/>
                </div>
        </div>
        
            </div>
            <div class="row">
                <div class="col-lg-4">
                <div class="form-group">
                    <label for="ClientMobileNumber" class="control-label"><?php echo MobileNo; ?></label>
                    <input type="text" name="ClientMobileNumber" id="ClientMobileNumber" value="<?php echo $data['ClientMobileNumber']; ?>" class="form-control input-sm required"  onkeypress="return event.charCode > 47 && event.charCode < 58;"  maxlength="10"/>
                </div>
        </div>
        <div class="col-lg-4">
                <div class="form-group">
                    <label for="ClientEmailID" class="control-label"><?php echo email; ?></label>
                    <input type="email" name="ClientEmailID" id="ClientEmailID" value="<?php echo $data['ClientEmailID']; ?>" class="form-control input-sm required" />
                </div>
        </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-lg-3">
               
                <div class="form-group">
                    <input type="hidden" name="AgentID" id="AgentID" value="<?php echo $_REQUEST['AgentID']?>">
                    <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
                    <div class="row">
                        <div class="col-lg-12"> 
                    <label>Book Price : </label> &#8377;  <input type="text" style="border: 0px;" readonly=true name="BookPrice" id="BookPrice"><br>
                   
                    <label>Amount : </label> &#8377;  <input type="text" style="border: 0px;" readonly=true name="Amount" id="Amount">
                    <?php if (isset($_REQUEST['BookID']) && $_REQUEST['BookID'] != '') { ?>
                    </div>
                        </div>
                    <input type="button" name="update" id="update" value="<?php echo update; ?>" class="btn btn-primary btn-md" onclick="update_data('<?php echo 'b_stock_master'; ?>', 'StockID', '<?php echo $data['StockID']; ?>', 'view_book_quantity', this.form);" >
                    <?php } else { ?>
                    <div class="row">
                        <div class="col-md-12">
                        <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-md" onclick="InsertOnBehalfOFAgentBookStockData(this.form);">
                    <?php } ?>
                        <a class="btn btn-primary btn-md" href="view_sell_books_behalf_of_agent&AgentID==<?php echo $_REQUEST['AgentID']?>">Cancel</a>
                        </div>
                    </div>
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
                $('#BookID').html(result);
            }
        });
}
function GetBookPrice(e) {
        var url = "../class/class.ajaxRequest.php";
        $.ajax({
            type: 'POST',
            url: url,
            data: {'do': 'GetBookPrice', 'BookID': e},
            success: function (result) {
                $('#BookPrice').val(result);
//                $('#BookPriceSpan').replaceWith("&#8377; ",result);
            }
        });
}
function GetAmountPrice(e) {
    var Price = $('#BookPrice').val();
    var Amount = Price * e;
    $('#Amount').val(Amount);
}

</script>