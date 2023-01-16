<?php require_once 'Header.php';
//$data = $fn->getDataByID("b_bookmaster", "BookID",@$_REQUEST['BookID']);
$UserAddressData = $fn->SelectAddressData('{"UserID": "'.$UserID.'"}');
//$AmountForPayment = $fn->GetTotalAmoutForPayment('{"UserID": "'.$UserID.'"}');
//echo "<pre>";
//print_r($UserWiseCartData['GetSelectedCartData']);
//echo $UserID;
?> 
        <div class="column_center">
            <div class="container">
                <div class="search">
                    <div class="stay">Search Product</div>
                    <div class="stay_right">
                        <input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {
                              this.value = '';
                          }">
                        <input type="submit" value="">
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="main">
            <div class="content_top">
                <div class="container">
                    <div class="col-md-3 sidebar_box">
                        <?php 
                        require_once 'SideMenu.php';
                        ?>
                    </div> 
                   
                        <div class="col-md-9 content_right">
                                <div class="row">
                                    <span class="pull-right"><a href="PlacedOrderDetails.php" class="btn btn-normal">My Orders</a></span>
                            </div>
                            
                                     <?php if($UserWiseCartData['GetSelectedCartData'] != ''){ ?>
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th style="width: 5%"><?php echo SrNo; ?></th>
                                    <th>Product Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($UserWiseCartData['GetSelectedCartData'] AS $Key => $Value) { 
                                     $Amount[] = $Value['PayableAmount'];
                                    ?>
                                    <tr>
                                        <td><?php echo ($Key + 1) ?></td>
                                        <td>
                                            <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="col-lg-2">
                                                            <img  src="admin/uploads/BookImage/<?php echo $Value['BookImage']; ?>" class="img-responsive" style="height: 100px" />
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label>Name : </label><span><?php echo $Value['BookTitle']; ?></span><br>
                                                            <label>Quantity : </label><span><?php echo $Value['Quantity']; ?></span><br>
                                                            <label>Author Name : </label><span><?php echo $Value['BookAutherName']; ?></span><br>
                                                            <label>Total Amount : </label><span><?php echo $Value['PayableAmount']; ?></span>

                                                        </div>
                                                        <div class="col-lg-1">
                                                            
                                                            
                                                            <input type="hidden" value="<?php echo $_SESSION['BookStore']['session']['UserID'];?>" name="UserID<?php echo ($Key + 1)?>" id="UserID">
                                                            <input type="hidden" value="<?php echo $Value['CartID'];?>" name="CartID" id="CartID">
                                                            <input type="hidden" value="<?php echo $Value['Quantity'];?>" name="Quantity" id="Quantity">
                                                            <input type="hidden" value="<?php echo $Value['Quantity'];?>" name="Quantity" id="Quantity">
                                                            <!--<input type="text" value="<?php echo $Value['BookID']; ?>" class="BookID" name="BookID123" id="BookID123">-->
                                                            <label style="margin-top: 5px" class="btn bt1 btn-primary btn-normal btn-inline " onclick="RemoveFromCart('<?php echo $Value['BookID'] ?>',<?php echo $Value['CartID'] ?>)"> Remove</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                    </tr>
        <?php }  $PayableAmt =  array_sum($Amount)?>   
                                        <tr>
                                            <td colspan="2" class="">
                                                <span>Total Payable Amount : <?php echo $PayableAmt;?></span>
                                                <input type="hidden" value="<?php echo $PayableAmt  ; ?>"  name="Price" id="Price">
                                            <button type="button" class="btn bt1 btn-primary btn-normal btn-inline pull-right" data-toggle="modal" data-target="#myModal">Procees to Checkout</button>
                                            </td>
                                    </tr>
                            </tbody>
                        </table>
                        
                    </div>
                        <?php }else{ ?>
                        <div class="col-md-9 content_right">
                            <center>No Book Added in Your Cart </center>
                    </div>
                        <?php } ?>
                    
                </div>  	    
            </div>
        </div>


<!-- Modal -->

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
                        <div class="col-lg-2">Address Line1 <span style="color: red"> * </span></div>
                        <div class="col-lg-10"><input type="text" class="form-control required" value="<?php echo $UserAddressData['GetAddressWiseData']['AddressLine1']?>" name="AddressLine1" id="AddressLine1"></div>
                     </div>
          </div>
          <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-2">Address Line2 <span style="color: red"> * </span></div>
                        <div class="col-lg-10"><input type="text" class="form-control required" value="<?php echo $UserAddressData['GetAddressWiseData']['AddressLine2']?>" name="AddressLine2" id="AddressLine2"></div>
                     </div>
          </div>
          <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-2">Area <span style="color: red"> * </span></div>
                        <div class="col-lg-10"><input type="text" class="form-control required" value="<?php echo $UserAddressData['GetAddressWiseData']['Area']?>" name="Area" id="Area" style="margin-bottom: 10px"></div>
                     </div>
          </div>
          <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-2">City</div>
                        <div class="col-lg-10">
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
                        <div class="col-lg-2">Pincode <span style="color: red"> * </span></div>
                        <div class="col-lg-10"><input type="text" class="form-control required" value="<?php echo $UserAddressData['GetAddressWiseData']['Pincode']?>" name="Pincode" id="Pincode" style="margin-top: 10px"></div>
                     </div>
          </div>
          <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-2">Mobile Number <span style="color: red"> * </span></div>
                        <div class="col-lg-10"><input type="text" class="form-control required" value="<?php echo $UserAddressData['GetAddressWiseData']['MobileNumber']?>" name="MobileNumber" id="MobileNumber" style="margin-top: 10px"></div>
                     </div>
          </div>

      </div>
      <div class="modal-footer">
          
  
          <label class="btn bt1 btn-primary btn-normal btn-inline " onclick="PlaceOrder('<?php echo $Value['BookID'] ?>')"> Place Order</label>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php require_once 'Footer.php';?>
<script>


//$(document).ready(function(){
//$(".Price").each(function() {
//           var Price =  $(this).val();
//           
//           alert(Price);      
//     });
//});


function PlaceOrder(BookID){
   var Type = 'Are you sure you want to Place this Order?';
   var UserID = $('#UserID').val(); 
//    alert(UserID);
//    return false;
    var CartID = $('#CartID').val(); 
    var Quantity = $('#Quantity').val();
    var Price = $('#Price').val();
    var AddressLine1 = $('#AddressLine1').val();
    var AddressLine2 = $('#AddressLine2').val();
    var Area = $('#Area').val();
    var CityID = $('#CityID').val();
    var Pincode = $('#Pincode').val();
    var MobileNumber = $('#MobileNumber').val();
        if( UserID != ''){
    BootstrapDialog.show({
        type: BootstrapDialog.TYPE_WARNING,
        title: 'Confirmation',
        message: Type,
        closable: false,
        buttons: [{
                id: 'btn-ok',
                icon: 'glyphicon glyphicon-check',
                label: 'Yes',
                cssClass: 'btn-warning',
                autospin: false,
                action: function (dialogRef) {
                    jQuery.ajax({
                        type: "post",
                        url: "class/class.ajaxRequest.php",
                        data: {BookID:BookID, UserID:UserID, Quantity:Quantity,Price:Price,AddressLine1:AddressLine1,AddressLine2:AddressLine2,Area:Area,CityID:CityID,Pincode:Pincode,MobileNumber:MobileNumber,CartID:CartID,do: 'PlaceOrder'},
                        success: function (result) {
                            window.location = "PlacedOrderDetails.php";
//                            alert(result);
//                            BootstrapDialog.show({
//                                title: 'Punhal Law Book House',
//                                message: result,
//                                closable: false,
//                                buttons: [{
//                                        id: 'btn-ok',
//                                        icon: 'fa fa-check',
//                                        label: 'OK',
//                                        cssClass: 'btn-success',
//                                        autospin: false,
//                                        action: function (dialogRef) {
//                                            dialogRef.close();
//                                            window.location.reload();
//                                        }
//                                    }]
//                            });

                        }
                    });
                }
            }, {
                id: 'btn-cancel',
                label: 'No',
                cssClass: 'btn-warning',
                autospin: false,
                action: function (dialogRef) {
                    dialogRef.close();
                }
            }]
    });
        }
    
}

function RemoveFromCart(BookID,CartID){
//    alert(BookID);
    var UserID = $('#UserID').val(); 
//    var BookID = $('#BookID123').val(); 
//    alert(BookID);
//    var CartID = $('#CartID').val(); 
//    alert(CartID);
    var Quantity = <?php echo $Value['Quantity']?> 
        jQuery.ajax({
        type: 'POST',
        url: "class/class.ajaxRequest.php",
        data: {BookID:BookID, UserID:UserID,CartID:CartID, Quantity:Quantity,do: 'RemoveFromCart'},
        success: function (result) {
//            alert(result);
            window.location = "MyCart.php";
//            alert_message_popup('',result);
        }
    });

    
}

</script>