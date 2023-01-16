<?php
if (isset($_REQUEST['method']) && $_REQUEST['method'] == 'BillInfo') {
    $RetailerInvoiceData = $fn->GeneralUserInvoiceData('{"UserID": "' . $_REQUEST['UserID'] . '","UserBookStockMasterID":"' . $_REQUEST['UserBookStockMasterID'] . '" }');
}
if (isset($_REQUEST['method']) && $_REQUEST['method'] == 'OrderDetalis') {
    $RetailerBalanceInvoiceData = $fn->GeneralUserBalanceInvoiceData('{"UserID": "' . $_REQUEST['UserID'] . '"}');
}

$UserAddressDetails = $fn->SelectAddressData('{"UserID": "' . $_REQUEST['UserID'] . '" }');
$UserAddress = $UserAddressDetails['GetAddressWiseData'];
$GetRetailerBalanceData = $fn->GeneralUserBalanceData('{"UserID": "' . $_REQUEST['UserID'] . '"}');
?> 
<div class="main card">
    <div class="content_top">
        <div class="container">
            <div class="col-md-1"></div>

            <?php if (isset($_REQUEST['UserBookStockMasterID']) && $_REQUEST['UserBookStockMasterID'] != '') { ?>
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
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-6">
                                                    <img src="assets/images/Logo/Logo.jpeg" style="margin-left: 7px" height="80px" width="80%"> 
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <span style="margin-left: 7px"><b>Invoice Date :</b> <?php echo date('d-m-Y', strtotime($RetailerInvoiceData['GetRetailerInvoiceData']['EntryDate'])) ?></span>
                                                            <span style="margin-left: 5px"><b>Invoice No :</b> <?php echo $_REQUEST['UserBookStockMasterID'] ?></span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>   
                                <tr>
                                    <td style="width: 5%"><b><?php echo SrNo; ?></b></td>
                                    <td><b>Book Details</b></td>
                                    <td><b>Quantity</b></td>
                                    <td><b>Discount</b></td>
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
                                            <td><?php echo $Value['discount']; ?> %</td>    
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
            <?php } else { ?>


                <div class="col-md-9 content_right" style="padding-left: 80px">
                    <div class="row" style="background-color: white; border: 1px solid;   ">

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
                            </div>
                        </div>


                        <!--<div style="border: 1px solid">-->
                        <div class="row">
                            <div class="col-lg-6" style="padding-right: 0px !important; ">
                                <div class="col-lg-12"style="padding-right: 0px !important; ">
                                    <!--<div class="col-lg-2 borderClass"><b> SrNo</b></div>-->
                                    <div class="col-lg-4 borderClass"><b>Date</b></div>
                                    <div class="col-lg-4 borderClass"><b>Cash/Credit</b></div>
                                    <div class="col-lg-4 borderClass"><b>Credit Rs.</b></div>
                                </div>
                               <?php
                               foreach ($RetailerBalanceInvoiceData['GetBalanceInvoiceData'] AS $keyNew123 => $InvoiceValue123) {
                                        $keyNewVal123[] = $keyNew123;
                                    }
                                    foreach ($GetRetailerBalanceData['GetRetailerBalanceData'] AS $keysFCount => $ValueCount) {
                                        $keysForCount[] = $keysFCount;
                                    }
                               
                               
                                    $ArrayValueOfBalanceInvoice = count($RetailerBalanceInvoiceData['GetBalanceInvoiceData']);
                                    $ArrayValueOfBalancecount = count($GetRetailerBalanceData['GetRetailerBalanceData']);
                                    $sr_no123 = 1;
                                    foreach ($GetRetailerBalanceData['GetRetailerBalanceData'] AS $keys => $Value) {
                                        $keys[] = $keys;
//                                        echo $keys;
                                        ?>
                                <div class="col-lg-12" style="padding-right: 0px !important; ">
                                    <!--<div class="col-lg-2 borderClass"><?php // echo ($keys + 1) ?></div>-->
                                    <div class="col-lg-4 borderClass"><?php echo date('d-m-Y', strtotime($Value['Date'])); ?></div>
                                    <div class="col-lg-4 borderClass"><?php
                                                if ($Value['ChequeNo'] == 0) {
                                                    echo "Cash";
                                                } else {
                                                    echo $Value['ChequeNo'];
                                                }
                                                ?></div>
                                    <div class="col-lg-4 borderClass"><?php echo $OpBal[] = $Value['OpeningBalance']; ?>&#8377;</div>
                                            
                                </div>
                                    <?php } 
                                    $totalOpBal = array_sum($OpBal);
                                    $CountNew = count($keys);
                                if ($keyNewVal123 > $keysForCount ) {
                                                $extraclmloop =  count($keyNewVal123)-count($keysForCount);
                                                $clmI = 0;
                                                while( $clmI < $extraclmloop ){
                                                ?>
                                 <div class="col-lg-12" style="padding-right:  0px !important; ">
                                            <div class="col-lg-4 borderClass"></div>
                                                <div class="col-lg-4 borderClass"></div>
                                                <div class="col-lg-4 borderClass"></div>
                                 </div>
                                                <?php $clmI++; } } ?>
                                
                                
                            </div>
                            <div class="col-lg-6" style="padding-left: 0px !important; ">
                                <div class="col-lg-12" style="padding-left: 0px !important; ">
                                    <div class="col-lg-4 borderClass"> <b>Date</b></div>
                                    <div class="col-lg-4 borderClass"><b>BillNo</b></div>
                                    <div class="col-lg-4 borderClass"><b>Debit Rs.</b></div>
                                </div>
                                <?php
                                
                                foreach ($RetailerBalanceInvoiceData['GetBalanceInvoiceData'] AS $key => $InvoiceValue) {
                                    $keyNew[] = $key;
                                    ?>
                                <div class="col-lg-12" style="padding-left: 0px !important; ">
                                
                                    <div class="col-lg-4 borderClass"> <?php echo date('d-m-Y', strtotime($InvoiceValue['Date'])); ?></div>
                                    <div class="col-lg-4 borderClass"><?php echo $InvoiceValue['UserBookStockMasterID']; ?></div>
                                    <div class="col-lg-4 borderClass"><?php echo $PayableAmount[] = $InvoiceValue['PayableAmount']; ?> &#8377;<a href="general_user_invoice&method=BillInfo&UserBookStockMasterID=<?php echo $InvoiceValue['UserBookStockMasterID']; ?>&UserID=<?php echo $InvoiceValue['UserID'] ?>">View</a></div>
                                    
                                </div>
                                <?php } 
                                if (count($keyNewVal123) < $keys ) {
                                                $extraclmloop = count($keysForCount) - count($keyNewVal123);
                                                $clmI = 0;
                                                while( $clmI < $extraclmloop ){
                                                ?>
                                 <div class="col-lg-12" style="padding-left: 0px !important; ">
                                            <div class="col-lg-4 borderClass"></div>
                                                <div class="col-lg-4 borderClass"></div>
                                                <div class="col-lg-4 borderClass"></div>
                                 </div>
                                                <?php $clmI++; } 
                                                
                                            } ?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="col-lg-6  borderClass ">
                                <label class="pull-left">Total Credit Rs: <?php echo $totalOpBal; ?>&#8377;</label>
                            </div>
                            <div class="col-lg-6  borderClass pull-right">
                                <label class="pull-left">  Total Debit Rs: <?php echo $SumOfPayableAmount = array_sum($PayableAmount); ?>&#8377;</label>
                            </div>
                        </div>
                        <div class="col-lg-12 " >
                            <div class="col-lg-12" style="border: 1px solid #c6c6c6;">
                                <label>Balance: <?php echo $totalOpBal - $SumOfPayableAmount; ?> &#8377;</label>
                                            <button name="Reminder" value="Reminder" class="btn btn-default pull-right">Reminder SMS</button>
                                            <button name="Reminder" value="Print" class="btn btn-success pull-right">Print  </button>
                            </div>
                            </div>
<br>

                        <div class="col-lg-12">
                                                <div class="row" style="margin-top: 10px;" >
                                <div class="col-lg-12">
                                    <div class="col-lg-8">
                                        <address>
                                            <p><b>Punahal Law House,</b> </p>
                                            <p class="FontStyle">1st Floor above adarsh restaurant,</p>
                                            <p class="FontStyle">Opp. Mirzapur court,</p>
                                            <p class="FontStyle">Ahmedabad 38001</p>
                                        </address>
                                    </div>
                                    <div class="col-lg-4 pull-right">
                                        <p><b>Mobile :</b> +91 982 598 6757,</p> <p style="margin-left: 58px;">+91 937 613 3770</p>
                                        <p><b>Email :</b> <a href="http://www.gmail.com">punhallaw@gmail.com</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
            
            
            
            
            
            $PDF_Data = '';
              $PDF_Data .= '<form method="post">';
              $PDF_Data .= '<div class="col-md-9 content_right" style="padding-left: 80px">';
              $PDF_Data .= '<div class="row" style="background-color: white; border: 1px solid;   ">';
              $PDF_Data .= '<div class="col-lg-12">';
              $PDF_Data .= '<div class="col-lg-3">';
              $PDF_Data .= '<p><b>To: </b></p>';
              $PDF_Data .= '<p>'.  $UserAddress["AddressLine1"] .',</p>';
              $PDF_Data .= '<p>'. $UserAddress['AddressLine2'] .','. $UserAddress['Area'] .',</p>'; 
              
             $PDF_Data .=  '<input type="submit" value="Submit" name="print">';
             $PDF_Data .= '</form>'; 
             echo $PDF_Data;
             
             if(isset($_REQUEST['print'])){
                 
                 
                 
                 require('pdf/fpdf.php');
//                 echo "call";
                 $pdf = new FPDF();
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',16);
                $pdf->Cell(40,10,"yes");
                $pdf->Output();
             }
              
              ?>
              
              
<!--                                <p><?php echo $UserAddress['CityName'] ?>-<?php echo $UserAddress['Pincode'] ?>.</p>
                                <p>Mobile:<?php echo $UserAddress['MobileNumber'] ?></p>
                            </div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-5">
                                <img src="assets/images/Logo/Logo.jpeg" style="margin-left: 7px" height="80px" width="80%"> 
                            </div>
                        </div>


                        <div style="border: 1px solid">
                        <div class="row">
                            <div class="col-lg-6" style="padding-right: 0px !important; ">
                                <div class="col-lg-12"style="padding-right: 0px !important; ">
                                    <div class="col-lg-2 borderClass"><b> SrNo</b></div>
                                    <div class="col-lg-4 borderClass"><b>Date</b></div>
                                    <div class="col-lg-4 borderClass"><b>Cash/Credit</b></div>
                                    <div class="col-lg-4 borderClass"><b>Credit Rs.</b></div>
                                </div>
                               <?php
                               foreach ($RetailerBalanceInvoiceData['GetBalanceInvoiceData'] AS $keyNew123 => $InvoiceValue123) {
                                        $keyNewVal123[] = $keyNew123;
                                    }
                                    foreach ($GetRetailerBalanceData['GetRetailerBalanceData'] AS $keysFCount => $ValueCount) {
                                        $keysForCount[] = $keysFCount;
                                    }
                               
                               
                                    $ArrayValueOfBalanceInvoice = count($RetailerBalanceInvoiceData['GetBalanceInvoiceData']);
                                    $ArrayValueOfBalancecount = count($GetRetailerBalanceData['GetRetailerBalanceData']);
                                    $sr_no123 = 1;
                                    foreach ($GetRetailerBalanceData['GetRetailerBalanceData'] AS $keys => $Value) {
                                        $keys[] = $keys;
//                                        echo $keys;
                                        ?>
                                <div class="col-lg-12" style="padding-right: 0px !important; ">
                                    <div class="col-lg-2 borderClass"><?php // echo ($keys + 1) ?></div>
                                    <div class="col-lg-4 borderClass"><?php echo date('d-m-Y', strtotime($Value['Date'])); ?></div>
                                    <div class="col-lg-4 borderClass"><?php
                                                if ($Value['ChequeNo'] == 0) {
                                                    echo "Cash";
                                                } else {
                                                    echo $Value['ChequeNo'];
                                                }
                                                ?></div>
                                    <div class="col-lg-4 borderClass"><?php echo $OpBal[] = $Value['OpeningBalance']; ?>&#8377;</div>
                                            
                                </div>
                                    <?php } 
                                    $totalOpBal = array_sum($OpBal);
                                    $CountNew = count($keys);
                                if ($keyNewVal123 > $keysForCount ) {
                                                $extraclmloop =  count($keyNewVal123)-count($keysForCount);
                                                $clmI = 0;
                                                while( $clmI < $extraclmloop ){
                                                ?>
                                 <div class="col-lg-12" style="padding-right:  0px !important; ">
                                            <div class="col-lg-4 borderClass"></div>
                                                <div class="col-lg-4 borderClass"></div>
                                                <div class="col-lg-4 borderClass"></div>
                                 </div>
                                                <?php $clmI++; } } ?>
                                
                                
                            </div>
                            <div class="col-lg-6" style="padding-left: 0px !important; ">
                                <div class="col-lg-12" style="padding-left: 0px !important; ">
                                    <div class="col-lg-4 borderClass"> <b>Date</b></div>
                                    <div class="col-lg-4 borderClass"><b>BillNo</b></div>
                                    <div class="col-lg-4 borderClass"><b>Debit Rs.</b></div>
                                </div>
                                <?php
                                
                                foreach ($RetailerBalanceInvoiceData['GetBalanceInvoiceData'] AS $key => $InvoiceValue) {
                                    $keyNew[] = $key;
                                    ?>
                                <div class="col-lg-12" style="padding-left: 0px !important; ">
                                
                                    <div class="col-lg-4 borderClass"> <?php echo date('d-m-Y', strtotime($InvoiceValue['Date'])); ?></div>
                                    <div class="col-lg-4 borderClass"><?php echo $InvoiceValue['UserBookStockMasterID']; ?></div>
                                    <div class="col-lg-4 borderClass"><?php echo $PayableAmount[] = $InvoiceValue['PayableAmount']; ?> &#8377;<a href="general_user_invoice&method=BillInfo&UserBookStockMasterID=<?php echo $InvoiceValue['UserBookStockMasterID']; ?>&UserID=<?php echo $InvoiceValue['UserID'] ?>">View</a></div>
                                    
                                </div>
                                <?php } 
                                if (count($keyNewVal123) < $keys ) {
                                                $extraclmloop = count($keysForCount) - count($keyNewVal123);
                                                $clmI = 0;
                                                while( $clmI < $extraclmloop ){
                                                ?>
                                 <div class="col-lg-12" style="padding-left: 0px !important; ">
                                            <div class="col-lg-4 borderClass"></div>
                                                <div class="col-lg-4 borderClass"></div>
                                                <div class="col-lg-4 borderClass"></div>
                                 </div>
                                                <?php $clmI++; } 
                                                
                                            } ?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="col-lg-6  borderClass ">
                                <label class="pull-left">Total Credit Rs: <?php echo $totalOpBal; ?>&#8377;</label>
                            </div>
                            <div class="col-lg-6  borderClass pull-right">
                                <label class="pull-left">  Total Debit Rs: <?php echo $SumOfPayableAmount = array_sum($PayableAmount); ?>&#8377;</label>
                            </div>
                        </div>
                        <div class="col-lg-12 " >
                            <div class="col-lg-12" style="border: 1px solid #c6c6c6;">
                                <label>Balance: <?php echo $totalOpBal - $SumOfPayableAmount; ?> &#8377;</label>
                                            <button name="Reminder" value="Reminder" class="btn btn-default pull-right">Reminder SMS</button>
                                            <button name="Reminder" value="Print" class="btn btn-success pull-right">Print  </button>
                            </div>
                            </div>
<br>

                        <div class="col-lg-12">
                                                <div class="row" style="margin-top: 10px;" >
                                <div class="col-lg-12">
                                    <div class="col-lg-8">
                                        <address>
                                            <p><b>Punahal Law House,</b> </p>
                                            <p class="FontStyle">1st Floor above adarsh restaurant,</p>
                                            <p class="FontStyle">Opp. Mirzapur court,</p>
                                            <p class="FontStyle">Ahmedabad 38001</p>
                                        </address>
                                    </div>
                                    <div class="col-lg-4 pull-right">
                                        <p><b>Mobile :</b> +91 982 598 6757,</p> <p style="margin-left: 58px;">+91 937 613 3770</p>
                                        <p><b>Email :</b> <a href="http://www.gmail.com">punhallaw@gmail.com</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
            
            
            
            
            
            
            
            
                                <?php                } ?>
        </div>  	    
    </div>
</div>



