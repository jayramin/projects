<?php
$data = $fn->getDataByID("b_agent_book_stock", "AgentBookStockID",@$_REQUEST['AgentBookStockID']);
if(isset($_REQUEST['AgentBookStockMasterID']) && $_REQUEST['AgentBookStockMasterID'] !=''){
    $AgentWiseBookStock = $fn->GetAgentWiseBookStock('{"AgentID":"'.$_REQUEST['AgentID'].'","AgentBookStockMasterID":"'.$_REQUEST['AgentBookStockMasterID'].'"}');
}else{
    $AgentWiseBookStock = $fn->GetAgentOrderPenddingData('{"AgentID":"'.$_REQUEST['AgentID'].'"}');
}


$UserAddressData = $fn->SelectAddressData('{"UserID": "'.$_REQUEST['AgentID'].'"}');

?>
<!--Content-->
<div class="row card" style=" margin: 15px 20px 0 250px;">
    <div class="col-md-12">
        <form action="" id="form" name="form" method="post" enctype="multipart/form-data">
        <div class="row">

            <div class="col-lg-4">
            <div class="form-group">
                <label for="CategoryTitle" class="control-label"><?php echo CategoryTitle; ?> <span style="color: red;">*</span> </label>
                <?php
//                echo "<pre>";
//print_r($AgentWiseBookStock);
//                echo date('Y-m-d h:i:sa');
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
            <div class="col-lg-3">
               
                <div class="form-group">
                    <input type="hidden" name="AgentID" id="AgentID" value="<?php echo $_REQUEST['AgentID']?>">
                    <input type="hidden" name="is_active" value="<?php echo (isset($data['is_active'])) ? $data['is_active'] : "Y"; ?>">
                    <!--<label>Book Price : </label> <span id="BookPriceSpan" name="BookPriceSpan">&nbsp;Select Book</span><br>-->
                    <label>Book Price : </label> &#8377;  <input type="text" style="border: 0px;" readonly=true name="BookPrice" id="BookPrice">
                    <!--<label>Amount : </label><span id="AmountSpan" name="AmountSpan"> &nbsp;Add Quantity</span><br>-->
                    <!--<input type="text" name="Amount" id="Amount">-->
                    
                    <label>Amount : </label> &#8377;  <input type="text" style="border: 0px;" readonly=true name="Amount" id="Amount">
                    <?php if (isset($_REQUEST['BookID']) && $_REQUEST['BookID'] != '') { ?>
                    
                    <input type="button" name="update" id="update" value="<?php echo update; ?>" class="btn btn-primary btn-md" onclick="update_data('<?php echo 'b_stock_master'; ?>', 'StockID', '<?php echo $data['StockID']; ?>', 'view_book_quantity', this.form);" >
                    <?php } else { ?>
                    
                        <input type="button" name="create" id="create" value="<?php echo save; ?>" class="btn btn-primary btn-md" onclick="InsertAgentBookStockData(this.form);">
                    <?php } ?>
                        <a class="btn btn-primary btn-md" href="view_agent_books_orders&method=OrderDetalis&AgentID=<?php echo $_REQUEST['AgentID']?>">Cancel</a>
                </div>
            </div>
        </div>
            
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="cardhome">
                        <?php  if ($AgentWiseBookStock['ResponseCode'] != 0 && $AgentWiseBookStock['Message'] != 'No Record Found' ) { ?>
                        <div class="card-body">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo BookTitle; ?></th>
                                            <th><?php echo BookPrice; ?></th>
                                            <th><?php echo Amount; ?></th>
                                            <th><?php echo Quantity; ?></th>
                                            <th><?php echo Date; ?></th>
                                            <th style="width: 20%;"><?php echo Action; ?></th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        foreach ($AgentWiseBookStock['GetAgentStockData'] AS $Key => $Value) {
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
                                                <td><?php echo $Value['Quantity']; ?></td>
                                                <td><?php echo $Value['EntryDate']; ?> </td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
                                                        <?php
                                                         $QuantityArray[] = $Value['Quantity'];
                                                         $BookArray[] = $Value['BookID'];
                                                         $AgentBookStockIDStringArray[] = $Value['AgentBookStockID'];
                                                         $AmountArray[] = $Value['Amount'];
                                                         
                                                        ?>
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo  'view_agent_books&method=sendbook&AgentBookStockID=' . $Value['AgentBookStockID'] ;?>"><i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'b_agent'; ?>', '<?php echo $Value['AgentID']; ?>', 'D','AgentID', 'is_active','view_agent','b_agent','AgentID,AgentID');"><i class="fa fa-trash-o"></i></button>
                                                            
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }
                                                         $BookIDString = implode(',', $BookArray);
                                                         $AgentBookStockIDString = implode(',', $AgentBookStockIDStringArray);
                                                         $QuantitySum = array_sum($QuantityArray);
                                                         $AmountSum = array_sum($AmountArray);
                                                         
                                        ?>         
                                            <tr>
                                                <td colspan="7">
                                                    <span><b>Total Book Quantity :</b> <?php echo $QuantitySum; ?> </span><br>
                                                    <span><b>Total Payable Amount : </b><?php echo $AmountSum; ?> </span>
                                                    <input type="hidden" name="TotalBookQuantity" id="TotalBookQuantity" value="<?php echo $QuantitySum ;?>">
                                                    <input type="hidden" name="PayableAmount" id="PayableAmount" value="<?php echo $AmountSum;?>">
                                                    <input type="hidden" name="BookIDs" id="BookIDs" value="<?php echo $BookIDString;?>">
                                                    <input type="hidden" name="AgentBookStockID" id="AgentBookStockID" value="<?php echo $AgentBookStockIDString;?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">
                                                    <button type="button" class="btn bt1 btn-primary btn-normal btn-inline pull-right" data-toggle="modal" data-target="#myModal">Procees to Checkout</button>
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
                        <div class="col-lg-3">Address Line1 <span style="color: red"> * </span></div>
                        <div class="col-lg-8"><input type="text" class="form-control required" value="<?php echo $UserAddressData['GetAddressWiseData']['AddressLine1']?>" name="AddressLine1" id="AddressLine1"></div>
                     </div>
          </div>
          <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-3">Address Line2 <span style="color: red"> * </span></div>
                        <div class="col-lg-8"><input type="text" class="form-control required" value="<?php echo $UserAddressData['GetAddressWiseData']['AddressLine2']?>" name="AddressLine2" id="AddressLine2"></div>
                     </div>
          </div>
          <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-3">Area <span style="color: red"> * </span></div>
                        <div class="col-lg-8"><input type="text" class="form-control required" value="<?php echo $UserAddressData['GetAddressWiseData']['Area']?>" name="Area" id="Area" style="margin-bottom: 10px"></div>
                     </div>
          </div>
          <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-3">City</div>
                        <div class="col-lg-8">
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
                        <div class="col-lg-3">Pincode <span style="color: red"> * </span></div>
                        <div class="col-lg-8"><input type="text" class="form-control required" value="<?php echo $UserAddressData['GetAddressWiseData']['Pincode']?>" name="Pincode" id="Pincode" style="margin-top: 10px" maxlength="6"></div>
                     </div>
          </div>
          <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-3">Mobile Number <span style="color: red"> * </span></div>
                        <div class="col-lg-8"><input type="text" class="form-control required" value="<?php echo $UserAddressData['GetAddressWiseData']['MobileNumber']?>" name="MobileNumber" id="MobileNumber" style="margin-top: 10px" maxlength="10"></div>
                     </div>
          </div>

      </div>
      <div class="modal-footer">
          <label class="btn bt1 btn-primary btn-normal btn-inline " onclick="AgentPlaceOrder()"> Place Order</label>
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

</script>