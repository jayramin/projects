<?php
error_reporting(0);
$Newdata = $fn->GetGeneralUserData("UserID", @$_REQUEST['UserID']);
$data = $Newdata['GetAddressWiseData'];


if (isset($_REQUEST['UserBookStockMasterID']) && $_REQUEST['UserBookStockMasterID'] != '') {

    $RetailerWiseBookStock = $fn->GetUserWiseBookStock('{"UserID":"' . $_REQUEST['UserID'] . '","UserBookStockMasterID":"' . $_REQUEST['UserBookStockMasterID'] . '"}');
} else {
    $RetailerWiseBookStock = $fn->GetUserOrderPenddingData('{"UserID":"' . $_REQUEST['UserID'] . '"}');
}

//echo "<pre>";
//print_r($RetailerWiseBookStock);
?>
<form id="form" name="form" method="post" enctype="multipart/form-data">
    <div class="row card">
        <div class="col-md-12">

            <div class="col-md-12">

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="ClientMobileNumber" class="control-label"><?php echo MobileNo; ?></label>
                            <input type="text" name="MobileNumber" id="MobileNumber" value="<?php echo $data['MobileNumber']; ?>" class="form-control input-sm required"  onchange="GetDataByMobileNumber(this.value)" onkeypress="return event.charCode > 47 && event.charCode < 58;"  maxlength="10"/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="ClientName" class="control-label"><?php echo UserName; ?></label>
                            <input type="text" name="UserName" id="UserName" value="<?php echo $data['UserName']; ?>" class="form-control input-sm required" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="AddressLine1" class="control-label"><?php echo Address1; ?></label>
                            <input type="text" name="AddressLine1" id="AddressLine1" value="<?php echo $data['AddressLine1']; ?>" class="form-control input-sm required" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="AddressLine2" class="control-label"><?php echo Address2; ?></label>
                            <input type="text" name="AddressLine2" id="AddressLine2" value="<?php echo $data['AddressLine2']; ?>" class="form-control input-sm required" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="AddressArea" class="control-label"><?php echo Area; ?></label>
                            <input type="text" name="AddressArea" id="AddressArea" value="<?php echo $data['Area']; ?>" class="form-control input-sm required" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <!--<label for="AddressCity" class="control-label"><?php echo city; ?></label>-->
                            <!--<input type="text" name="AddressCity" id="AddressCity" value="<?php echo $data['CityID']; ?>" class="form-control input-sm required" />-->
                            <div class="form-group">
                                <label for="city_name" class="control-label"><?php echo CityName; ?> <span style="color: red;">*</span> </label>
                                <?php
                                $selected = isset($data['CityID']) ? $data['CityID'] : "";
                                $StateFilter = isset($data['CityID']) ? "is_active='Y' AND CityID='" . $data['CityID'] . "'" : "is_active='Y'";
                                $db_array = array("tbl_name" => 'b_city', "condition" => $StateFilter);
                                $select_array = array("name" => "CityID", "id" => "CityID", "class" => "form-control chosen-select required");
                                $option_array = array("value" => "CityID", "label" => "CityName", "placeholder" => "Select City", 'selected' => $selected);
                                $fn->dropdown($db_array, $select_array, $option_array);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="AddressPincode" class="control-label"><?php echo Pincode; ?></label>
                            <input type="text" name="AddressPincode" id="AddressPincode" value="<?php echo $data['Pincode']; ?>" class="form-control input-sm required"   onkeypress="return event.charCode > 47 && event.charCode < 58;"  maxlength="6"/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="EmailID" class="control-label"><?php echo email; ?></label>
                            <input type="email" name="EmailID" id="EmailID" value="<?php echo $data['Email']; ?>" class="form-control input-sm required" />
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="CategoryTitle" class="control-label"><?php echo CategoryTitle; ?> <span style="color: red;">*</span> </label>
                            <?php
                            $CategoryFilter = "is_active='Y'";
                            $db_array = array("tbl_name" => 'b_category', "condition" => $CategoryFilter);
                            $select_array = array("name" => "CategoryID", "id" => "CategoryID", "class" => "form-control chosen-select required", "onchange" => "GetBook(this.value);");
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
                            $db_array = array("tbl_name" => 'b_bookmaster', "condition" => $CategoryFilter);
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
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="Quantity" class="control-label"><?php echo Discount; ?> %</label>
                            <input type="number" min="0" name="Discount" id="Discount" value="<?php echo $data['Discount']; ?>" class="form-control input-sm required" style="padding: 16px" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">

                    <div class="form-group">
                        <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
                        <input type="hidden" name="UserID" id="UserID" value="<?php echo $_REQUEST['UserID']; ?>">
                        
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
                                <!--<input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-md" onclick="InsertGeneralUserSellData(this.form);">-->
                                    <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-md" onclick="InsertUserBookStockData(this.form);">
                                <?php } ?>
                                <a class="btn btn-primary btn-md" href="view_general_user_details">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> 



        <div class="row">
            <div class="col-lg-12">
                <div class="cardhome">
                    <?php if ($RetailerWiseBookStock['ResponseCode'] != 0 && $RetailerWiseBookStock['Message'] != 'No Record Found') { ?>
                        <div class="card-body">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th><?php echo SrNo; ?></th>
                                        <th><?php echo BookTitle; ?></th>
                                        <th><?php echo BookPrice; ?></th>
                                        <th><?php echo Amount; ?></th>
                                        <th><?php echo Discount; ?></th>
                                        <th><?php echo Quantity; ?></th>
                                        <th><?php echo Date; ?></th>
                                        <th style="width: 20%;"><?php echo RowAction; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($RetailerWiseBookStock['GetRetailerStockData'] AS $Key => $Value) {
//                                            echo "<pre>";
//                                            print_r($Value);
                                        $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                        $NewStatus = ($Value['is_active'] == 'Y') ? 'N' : 'Y';
                                        $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                        $UserBookStockIDArray[] = $Value['UserBookStockID'];
                                        ?>
                                        <tr>
                                            <td><?php echo ($Key + 1) ?></td>
                                            <td><?php echo $Value['BookTitle']; ?></td>
                                            <td><?php echo $Value['BookPrice']; ?> &#8377;</td>
                                            <td><?php echo $Value['Amount']; ?> &#8377;</td>
                                            <td><?php echo $Value['discount']; ?> %</td>
                                            <td><?php echo $Value['Quantity']; ?></td>
                                            <td><?php echo $Value['EntryDate']; ?> </td>
                                            <td>
                                                <div class="btn-group btn-group-justified">
                                                    <?php
                                                    $QuantityArray[] = $Value['Quantity'];
                                                    $BookArray[] = $Value['BookID'];
                                                    $RetailerBookStockIDStringArray[] = $Value['RetailerBookStockID'];
                                                    $AmountArray[] = $Value['Amount'];
                                                    ?>
<!--                                                    <div class="btn-group">
                                                        <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo 'view_retailer_books_orders&method=sendbook&RetailerBookStockID=' . $Value['RetailerBookStockID'] . '&RetailerID=' . $_REQUEST['RetailerID']; ?>"><i class="fa fa-edit"></i></a>
                                                    </div>-->
                                                    <div class="btn-group">
                                                        <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="RemoveUserBook('<?php echo 'b_user_book_stock'; ?>', '<?php echo $Value['UserBookStockID']; ?>', 'D', 'UserBookStockID', 'UserOrderStatus', 'view_general_user_details&method=add&UserID=<?php echo $_REQUEST['UserID'] ?>');"><i class="fa fa-trash-o"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
    <?php
    }
    $BookIDString = implode(',', $BookArray);
    $RetailerBookStockIDString = implode(',', $RetailerBookStockIDStringArray);
    $UserBookStockIDs = implode(',', $UserBookStockIDArray);
    $QuantitySum = array_sum($QuantityArray);
    $AmountSum = array_sum($AmountArray);
    ?>         
                                    <tr>
                                        <td colspan="7">

                                            <span><b>Total Book Quantity :</b> <?php echo $QuantitySum; ?> </span><br>
                                            <span><b>Total Payable Amount : </b><?php echo $AmountSum; ?> </span>

                                            <input type="hidden" name="TotalBookQuantity" id="TotalBookQuantity" value="<?php echo $QuantitySum; ?>">
                                            <input type="hidden" name="PalyableAmount" id="PalyableAmount" value="<?php echo $AmountSum; ?>">
                                            <input type="hidden" name="BookIDs" id="BookIDs" value="<?php echo $BookIDString; ?>">
                                            <input type="hidden" name="RetailerBookStockID" id="RetailerBookStockID" value="<?php echo $RetailerBookStockIDString; ?>">
                                            <input type="hidden" name="UserBookStockIDs" id="UserBookStockIDs" value="<?php echo $Value['UserBookStockID']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td colspan="7">
                                            <div class="row">
                            <div class="col-lg-12">
                                <input type="radio" id="TransactionType1" name="TransactionType"  value="Debit" checked=""> Debit
                                <input type="radio" class="TransactionType" name="TransactionType" value="Credit"> Credit
                            </div>
                        </div>
                                            <label class="btn bt1 btn-primary btn-normal btn-inline " onclick="UserPlaceOrder()"> Place Order</label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--</div>-->
                    <?php } else { ?>
                        <center><h4>No Records Found</h4></center>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</form>
</div>
<script>

    function CheckBookQuantity(e) {
        var MinimumPlayer = $('#BookQuantity').val();
        if (parseInt(MinimumPlayer) > parseInt(e)) {
            $('#MinimumPlayersSpan').text('Maximum Player Should Be Greter Then Minimum Players');
            $('#create').prop('disabled', true);
            return false;
        } else {
            $('#MinimumPlayersSpan').text('');
            $('#create').prop('disabled', false);
        }
    }
    function GetAmountPrice(e) {
        var Price = $('#BookPrice').val();
        var Amount = Price * e;
        $('#Amount').val(Amount);
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
    function GetDataByMobileNumber(e) {
//alert("ca");
        jQuery.ajax({
            type: 'POST',
            url: "../class/class.ajaxRequest.php",
            Type: "JSON",
            data: "do=GetDataByMobileNumber&MobileNumber=" + e,
            success: function (result) {
//                alert_message_popup('',result);
//                return false;
                var resultdata = $.parseJSON(result);
                if (resultdata == '') {
//                     alert("call");
                } else {
                    $("#UserName").val(resultdata.UserName);
                    $("#AddressLine1").val(resultdata.AddressLine1);
                    $("#AddressLine2").val(resultdata.AddressLine2);
                    $("#AddressArea").val(resultdata.Area);
//                $("#CityID").val(resultdata.CityName);
                    $("#CityID option:selected").text(resultdata.CityName);
                    $("#AddressPincode").val(resultdata.Pincode);
                    $("#EmailID").val(resultdata.Email);
                    $("#UserID").val(resultdata.UserID);
                    alert_message_popup('view_general_user_details&method=add&UserID=' + resultdata.UserID, 'Data Saved Successfully');
                }

            }
        });
    }

</script>