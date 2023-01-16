<?php
//echo "<pre>";
//print_r($_REQUEST);
//exit;
if(isset($_REQUEST['method']) && $_REQUEST['method'] == 'BillInfo'){    
    $RetailerInvoiceData = $fn->AgentInvoiceData('{"UserID": "' . $_REQUEST['AgentID'] . '","AgentBookStockMasterID":"' . $_REQUEST['AgentBookStockMasterID'] . '" }');
//    echo "<pre>";
//    print_r($RetailerInvoiceData);
}   
if(isset($_REQUEST['method']) && $_REQUEST['method'] == 'OrderDetalis'){
    $RetailerInvoiceData = $fn->AgentInvoiceData('{"UserID": "' . $_REQUEST['AgentID'] . '","AgentBookStockMasterID":"' . $_REQUEST['AgentBookStockMasterID'] . '" }');
//    $RetailerBalanceInvoiceData = $fn->GeneralUserBalanceInvoiceData('{"UserID": "' . $_REQUEST['UserID'] . '"}');
//    
    
//    
//    echo "<br>";
//    echo "<pre>";
//    print_r($RetailerBalanceInvoiceData);
}

$UserAddressDetails = $fn->SelectAddressData('{"UserID": "' . $_REQUEST['AgentID'] . '" }');
$UserAddress = $UserAddressDetails['GetAddressWiseData'];
//echo "<pre>";
//print_r($UserAddress);
$GetRetailerBalanceData = $fn->GeneralUserBalanceData('{"UserID": "' . $_REQUEST['UserID'] . '"}');
//echo "<pre>";
//print_r($GetRetailerBalanceData);
//$GetRetailerTransactionBalanceData = $fn->RetailerTransactionBalanceData('{"RetailerID": "' . $_REQUEST['RetailerID'] . '"}');
?> 
<div class="main">
    <div class="content_top">
        <div class="container">
            <div class="col-md-1"></div>
            
            <?php 
            if(isset($_REQUEST['AgentBookStockMasterID']) && $_REQUEST['AgentBookStockMasterID'] != ''){ ?>
                <div class="col-md-9 content_right" style="padding-left: 80px">
                <div class="row" style="background-color: white; border: 1px solid;   ">
                    <div class="col-lg-12">
                        <table class="table table-hover table-bordered" id="sampleTable" style="margin-top: 15px">
                            <tr>
                                <td colspan="5">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-lg-3">
                                                <p><b>To: </b></p>
                                                <p><?php echo $UserAddress['AddressLine1'] ?>,</p>
                                                <p><?php echo $UserAddress['AddressLine2'] ?>,<?php echo $UserAddress['Area'] ?>,</p>
                                                <p><?php echo $UserAddress['CityName'] ?>-<?php echo $UserAddress['Pincode'] ?>.</p>
                                                <p>Mobile:<?php echo $UserAddress['MobileNumber'] ?></p>
                                            </div>
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-5">
                                                <img src="assets/images/Logo/Logo.jpeg" style="margin-left: 7px" height="80px" width="80%"> 
                                                <span style="margin-left: 7px"><b>Invoice Date :</b> <?php echo date('d-m-Y', strtotime($RetailerInvoiceData['GetRetailerInvoiceData']['EntryDate'])) ?></span>
                                                <span style="margin-left: 5px"><b>Invoice No :</b> <?php echo $RetailerInvoiceData['GetRetailerInvoiceData']['RetailerBookStockMasterID'] ?>.</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>   
                            <tr>
                                <td style="width: 5%"><b><?php echo SrNo; ?></b></td>
                                <td><b>Book Details</b></td>
                                <td><b>Quantity</b></td>
                                <td><b>Price</b></td>
                                <td><b>Amount</b></td>
                            </tr>
                            <tbody>
                                <?php
                                $sr_no1 = 1;
                                foreach ($RetailerInvoiceData['GetRetailerBookData'] AS $key => $Value) {
                                    ?>
                                    <tr>
                                        <td><?php echo ($sr_no1) ?></td>    
                                        <td><?php echo $Value['BookTitle']; ?></td>    
                                        <td><?php echo $Value['Quantity']; ?></td>    
                                        <td><?php echo $Value['BookPrice']; ?> &#8377;</td>    
                                        <td><?php echo $Value['Amount']; ?> &#8377;</td>    </tr>
                                    <?php
                                    $QuantityArray[] = $Value['Quantity'];
                                $sr_no1++;
                                    
                                }
                                $QuantitySum = array_sum($QuantityArray);
                                
                                ?>
                                <tr>
                                    <td colspan="2">Total: </td>
                                    <td colspan="2"><b><?php echo $QuantitySum ?> Items</b></td>
                                    <td><b><?php echo $RetailerInvoiceData['GetRetailerInvoiceData']['PayableAmount'] ?> &#8377;</b></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-7">
                                    <address>
                                        <p><b>Punahal Law House,</b> </p>
                                        <p class="FontStyle">1st Floor above adarsh restaurant,</p>
                                        <p class="FontStyle">Opp. Mirzapur court,</p>
                                        <p class="FontStyle">Ahmedabad 38001</p>
                                    </address>
                                </div>
                                <div class="col-lg-5">
                                    <p><b>Mobile :</b> +91 982 598 6757,</p> <p style="margin-left: 58px;">+91 937 613 3770</p>
                                    <p><b>Email :</b> <a href="http://www.gmail.com">punhallaw@gmail.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?> 
        </div>  	    
    </div>
</div>