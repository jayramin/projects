<?php
//echo "<pre>";
//print_r($_REQUEST);
//echo "asdfasdfasdf";
//exit;
$data = $fn->getDataByID("b_retailer_book_stock", "RetailerBookStockID",@$_REQUEST['RetailerBookStockID']);
if(isset($_REQUEST['RetailerBookStockMasterID']) && $_REQUEST['RetailerBookStockMasterID'] !=''){

    $RetailerWiseBookStock = $fn->GetRetailerWiseBookStock('{"RetailerID":"'.$_REQUEST['RetailerID'].'","RetailerBookStockMasterID":"'.$_REQUEST['RetailerBookStockMasterID'].'"}');
}else{
    $RetailerWiseBookStock = $fn->GetRetailerOrderPenddingData('{"RetailerID":"'.$_REQUEST['RetailerID'].'"}');
}
$GetRetailerBalanceData = $fn->RetailerBalanceData('{"RetailerID": "' . $_REQUEST['RetailerID'] . '"}');
$GetRetailerPurchasedBalanceData = $fn->TotalPurchasedData('{"RetailerID": "' . $_REQUEST['RetailerID'] . '"}');
$UserNamedata = $fn->getDataByID("b_user", "UserID", @$_REQUEST['RetailerID']);
$UserAddressData = $fn->SelectAddressData('{"UserID": "'.$_REQUEST['RetailerID'].'"}');

?>
<!--Content-->
<div class="row card" style=" margin: 15px 20px 0 250px !important;">
    <div class="col-md-12">
        <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-2 col-lg-offset-10 ">
                    <p class="pull-right"><b>Hello:</b> &nbsp;<?php echo $UserNamedata['UserName'];?></p>
                </div>
            </div>
            <div class="row">

            <div class="col-lg-3">
            <div class="form-group">
                <label for="CategoryTitle" class="control-label"><?php echo CategoryTitle; ?> <span style="color: red;">*</span> </label>
                <?php
              
//                echo "<pre>";
//print_r($GetRetailerPurchasedBalanceData['GetTotalPurchasedData']);

foreach ($GetRetailerBalanceData['GetRetailerBalanceData'] AS $key => $Value) {
    $OpBalance[] = $Value['OpeningBalance'];
}
$TotalBalance = array_sum($OpBalance);
foreach ($GetRetailerPurchasedBalanceData['GetTotalPurchasedData'] AS $key => $PurchaseValue) {
    $PurchaseAmount[] = $PurchaseValue['PayableAmount'];
}
$TotalPurchaseAmount = array_sum($PurchaseAmount);
$AvailableBalance = $TotalBalance - $TotalPurchaseAmount;
//exit;
//                echo date('Y-m-d h:i:sa');
                    $CategoryFilter = "is_active='Y'";
                    $db_array = array("tbl_name" => 'b_category', "condition"=>$CategoryFilter);
                    $select_array = array("name" => "CategoryID", "id" => "CategoryID", "class" => "form-control chosen-select required","onchange" => "GetBook(this.value);");
                    $option_array = array("value" => "CategoryID", "label" => "CategoryTitle", "placeholder" => "Select Category", 'selected' => $data['CategoryID']);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="CategoryTitle" class="control-label"><?php echo BookTitle; ?> <span style="color: red;">*</span> </label>
                <?php
//                       echo "<pre>";
//    print_r($data);
//                    $SelectedState123 = isset($data['StateID']) ? $data['StateID'] : "";
                    $CategoryFilter = "is_active='Y'";
                    $db_array = array("tbl_name" => 'b_bookmaster', "condition"=>$CategoryFilter);
                    $select_array = array("name" => "BookID", "id" => "BookID", "class" => "form-control chosen-select required", "onchange" => "GetBookPrice(this.value);");
                    $option_array = array("value" => "BookID", "label" => "BookTitle", "placeholder" => "Select Book", 'selected' => $data['BookID']);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
            </div>
        </div>
        <div class="col-lg-3">
                <div class="form-group">
                    <label for="Quantity" class="control-label"><?php echo Quantity; ?></label>
                    <input type="number" min="0" name="Quantity" id="Quantity" value="<?php echo $data['Quantity']; ?>" class="form-control input-sm required" style="padding: 16px" onchange="GetAmountPrice(this.value)">
                </div>
            </div>
        <div class="col-lg-3">
                <div class="form-group">
                    <label for="Discount" class="control-label"><?php echo Discount; ?> %</label>
                    <input type="number" min="0" name="Discount" id="Discount" value="<?php echo $data['Discount']; ?>" class="form-control input-sm required" style="padding: 16px" >
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-lg-3">
               
                <div class="form-group">
                    <input type="hidden" name="RetailerID" id="RetailerID" value="<?php echo $_REQUEST['RetailerID']?>">
                    <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
                    <!--<label>Book Price : </label> <span id="BookPriceSpan" name="BookPriceSpan">&nbsp;Select Book</span><br>-->
                    <label>Book Price : </label> &#8377;  <input type="text" style="border: 0px;" readonly=true name="BookPrice" id="BookPrice" value="<?php echo $data['BookPrice']?>">
                    <label>Amount : </label> &#8377;  <input type="text" style="border: 0px;" readonly=true name="Amount" id="Amount" value="<?php echo $data['Amount']?>">
                    <?php if (isset($_REQUEST['RetailerBookStockID']) && $_REQUEST['RetailerBookStockID'] != '') { ?>
                    
                    <input type="button" name="update" id="update" value="<?php echo update; ?>" class="btn btn-primary btn-md" onclick="update_data('<?php echo 'b_retailer_book_stock'; ?>', 'RetailerBookStockID', '<?php echo $data['RetailerBookStockID']; ?>', 'view_retailer_books_orders&method=sendbook&RetailerID=<?php echo $_REQUEST['RetailerID']?>', this.form);" >
                    <?php } else { ?>
                    
                        <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-md" onclick="InsertRetailerBookStockData(this.form);">
                    <?php } ?>
                        <a class="btn btn-primary btn-md" href="view_retailer_books_orders&method=OrderDetalis&RetailerID=<?php echo $_REQUEST['RetailerID']?>">Cancel</a>
                </div>
            </div>
        </div>
            
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="cardhome">
                        <?php  if ($RetailerWiseBookStock['ResponseCode'] != 0 && $RetailerWiseBookStock['Message'] != 'No Record Found' ) { ?>
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
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['BookTitle']; ?></td>
                                                <td><?php echo $Value['BookPrice']; ?> &#8377;</td>
                                                <td><?php echo $Value['Amount']; ?> &#8377;</td>
                                                <td><?php echo $Value['Discount']; ?> %</td>
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
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo  'view_retailer_books_orders&method=sendbook&RetailerBookStockID=' . $Value['RetailerBookStockID'].'&RetailerID='. $_REQUEST['RetailerID'];?>"><i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <div class="btn-group">
                                                            <!--<button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'b_retailer_book_stock'; ?>', '<?php echo $Value['RetailerBookStockID']; ?>', 'D','RetailerBookStockID', 'RetailerOrderStatus','view_retailer_books_orders&method=sendbook&RetailerID=<?php echo $_REQUEST['RetailerID']?>','b_retailer_balance','RetailerBalanceID,RetailerBalanceID');"><i class="fa fa-trash-o"></i></button>-->
                                                            
                                                            
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="RemoveRetailerBook('<?php echo 'b_retailer_book_stock'; ?>', '<?php echo $Value['RetailerBookStockID']; ?>', 'D','RetailerBookStockID', 'RetailerOrderStatus','view_retailer_books_orders&method=sendbook&RetailerID=<?php echo $_REQUEST['RetailerID']?>');"><i class="fa fa-trash-o"></i></button>
                                                            <!--<button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'b_retailer_book_stock'; ?>', '<?php echo $Value['RetailerBookStockID']; ?>', 'D','RetailerBookStockID', 'RetailerOrderStatus','view_retailer_books_orders&method=sendbook&RetailerID=<?php echo $_REQUEST['RetailerID']?>','b_retailer_book_stock','RetailerBookStockID,RetailerBookStockID');"><i class="fa fa-trash-o"></i></button>-->
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }
                                                         $BookIDString = implode(',', $BookArray);
                                                         $RetailerBookStockIDString = implode(',', $RetailerBookStockIDStringArray);
                                                         $QuantitySum = array_sum($QuantityArray);
                                                         $AmountSum = array_sum($AmountArray);
                                                         
                                        ?>         
                                            <tr>
                                                <td colspan="8">
                                                    <span><b>Total Book Quantity :</b> <?php echo $QuantitySum; ?> </span><br>
                                                    <span><b>Total Payable Amount : </b><?php echo $AmountSum; ?> </span>
                                                    <input type="hidden" name="TotalBookQuantity" id="TotalBookQuantity" value="<?php echo $QuantitySum ;?>">
                                                    <input type="hidden" name="PalyableAmount" id="PalyableAmount" value="<?php echo $AmountSum;?>">
                                                    <input type="hidden" name="BookIDs" id="BookIDs" value="<?php echo $BookIDString;?>">
                                                    <input type="hidden" name="RetailerBookStockID" id="RetailerBookStockID" value="<?php echo $RetailerBookStockIDString;?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="8">
                                                    <button type="button" class="btn bt1 btn-primary btn-normal btn-inline pull-right" data-toggle="modal" data-target="#myModal">Process to Payment</button>
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
    </form>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Address Details</h4>
      </div>
      <div class="modal-body">
          <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4">Address Line1 <span style="color: red"> * </span></div>
                        <div class="col-lg-6"><input type="text" class="form-control required" value="<?php echo $UserAddressData['GetAddressWiseData']['AddressLine1']?>" name="AddressLine1" id="AddressLine1" style="margin-bottom: 5px"></div>
                     </div>
          </div>
          <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4">Address Line2 <span style="color: red"> * </span></div>
                        <div class="col-lg-6"><input type="text" class="form-control required" value="<?php echo $UserAddressData['GetAddressWiseData']['AddressLine2']?>" name="AddressLine2" id="AddressLine2" style="margin-bottom: 5px"></div>
                     </div>
          </div>
          <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4">Area <span style="color: red"> * </span></div>
                        <div class="col-lg-6"><input type="text" class="form-control required" value="<?php echo $UserAddressData['GetAddressWiseData']['Area']?>" name="Area" id="Area" style="margin-bottom: 5px"></div>
                     </div>
          </div>
          <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4">City</div>
                        <div class="col-lg-6">
                        <?php
                   
                    $SelectedState123 = isset($UserAddressData['GetAddressWiseData']['CityID']) ? $UserAddressData['GetAddressWiseData']['CityID'] : "";
                    $CategoryFilter = "is_active='Y'";
                    $db_array = array("tbl_name" => 'b_city', "condition"=>$CategoryFilter);
                    $select_array = array("name" => "CityID", "id" => "CityID", "class" => "form-control chosen-select required");
                    $option_array = array("value" => "CityID", "label" => "CityName", "placeholder" => "Select City", 'selected' => $UserAddressData['GetAddressWiseData']['CityID']);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
                        </div>
                     </div>
          </div>
          <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4">Pincode <span style="color: red"> * </span></div>
                        <div class="col-lg-6"><input type="text" class="form-control required" value="<?php echo $UserAddressData['GetAddressWiseData']['Pincode']?>" name="Pincode" id="Pincode" style="margin-top: 10px"></div>
                     </div>
          </div>
          <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4">Mobile Number <span style="color: red"> * </span></div>
                        <div class="col-lg-6"><input type="text" class="form-control required" value="<?php echo $UserAddressData['GetAddressWiseData']['MobileNumber']?>" name="MobileNumber" id="MobileNumber" style="margin-top: 10px;margin-bottom: 5px"></div>
                     </div>
          </div>
          <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4">Payment Method<span style="color: red"> * </span></div>
                        <div class="col-lg-6">
                            <select name="Type" id="Type" class="form-control required" style="margin-bottom: 5px" onchange="GetDiv(this.value)">
                                <option value="">Select Payment Type</option>
                                <?php
                                if($AvailableBalance > $AmountSum){ ?> 
                                    <option value="FromOpeningBalance">Deduct From Balance</option>
                                        <?php } ?>
                                <!--<option value="Cash">Cash</option>-->
                                <option value="Cash" selected="">Cash</option>
                                <option value="Credit">On Credit</option>
                            </select> 
                        </div>
                     </div>
          </div>
<!--          <div class="row">
                    <div class="col-lg-12">
                        <div class="ChequeDiv " id="ChequeDiv" style="display: none">
                            <div class="col-lg-4">Cheque No:<span style="color: red"> * </span> </div>
                        <div class="col-lg-6">
                            <input type="text" name="ChequeNo" id="ChequeNo" class="form-control" style="margin-bottom: 5px">
                        </div>
                            <div class="col-lg-4">Bank Name:</div>
                        <div class="col-lg-6">
                            <input type="text" name="BankName" id="BankName" class="form-control">
                        </div>
                        </div>
                     </div>
          </div>-->
          <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4">Your Balance Is:</div>
                        <div class="col-lg-6">
                            <span style="color: green"> <?php echo $AvailableBalance;?></span>
                        </div>
                     </div>
          </div>
      </div>
      <div class="modal-footer">
          <label class="btn bt1 btn-primary btn-normal btn-inline " onclick="RetailerPlaceOrder()"> Generate Bill</label>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

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
function GetDiv(e){
    if(e == 'Cheque'){
    document.getElementById('ChequeDiv').style.display = 'block';
    $('.ChequeDiv').style();        
    }else{
            document.getElementById('ChequeDiv').style.display = 'none';
    $('.ChequeDiv').style();   
    }

}
</script>
