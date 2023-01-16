<?php
if(isset($_REQUEST['CreditNoteID']) && $_REQUEST['CreditNoteID'] != ''){
//    $RetailerInvoiceData = $fn->RetailerInvoiceData('{"UserID": "' . $_REQUEST['UserID'] . '"}');
    $RetailerInvoiceData = $fn->CreditNoteInvoiceData('{"UserID": "' . $_REQUEST['UserID'] . '","CreditNoteID":"' . $_REQUEST['CreditNoteID'] . '" }');
//    echo "<pre>";
//print_r($RetailerInvoiceData);
}

$UserAddressDetails = $fn->SelectAddressData('{"UserID": "' . $_REQUEST['UserID'] . '" }');
$UserAddress = $UserAddressDetails['GetAddressWiseData'];
//echo "<pre>";
//print_r($UserAddress);
$GetRetailerBalanceData = $fn->RetailerBalanceData('{"RetailerID": "' . $_REQUEST['UserID'] . '"}');
//$GetRetailerTransactionBalanceData = $fn->RetailerTransactionBalanceData('{"RetailerID": "' . $_REQUEST['RetailerID'] . '"}');
?> 
<div class="main">
    <div class="content_top">
        <div class="container">
            <div class="col-md-1"></div>
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
                                foreach ($RetailerInvoiceData['GetRetailerInvoiceData'] AS $key => $Value) {
//                                    echo "<pre>";
//                                    print_r($Value);
                                    ?>
                                    <tr>
                                        <td><?php echo ($key + 1) ?></td>    
                                        <td><?php echo $Value['BookTitle']; ?></td>    
                                        <td><?php echo $Value['Quantity']; ?></td>    
                                        <td><?php echo $Value['BookPrice']; ?> &#8377;</td>    
                                        <td><?php echo $Value['NetAmount']; ?> &#8377;</td>    </tr>
                                    <?php
                                    $QuantityArray[] = $Value['Quantity'];
                                }
                                $QuantitySum = array_sum($QuantityArray);
                                
                                ?>
                                <tr>
                                    <td colspan="2">Total: </td>
                                    <td colspan="2"><b><?php echo $QuantitySum ?> Items</b></td>
                                    <td><b><?php echo $Value['NetAmount']; ?>  &#8377;</b></td>
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
        </div>  	    
    </div>
</div>