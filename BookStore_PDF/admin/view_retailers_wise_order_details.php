<?php 
error_reporting(0);
//echo "<br>";
//echo "<br>nasdfjkahlsdfjsdhalfjhasgdlfjakhdnasdfjkahlsdfjsdhalfjhasgdlfjakhd";
//echo "<pre>nasdfjkahlsdfjsdhalfjhasgdlfjakhdnasdfjkahlsdfjsdhalfjhasgdlfjakhd";
//print_r($_REQUEST);
//exit; 

//echo "<pre>";
//echo "<br>";
//echo "<br>";
//echo "<br>";
//echo "<br>";
//echo "<br>";
//echo "<br>";
//echo "asdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasd";
//exit;


$PlacedOrderedDetails = $fn->GetRetailerPlacedOrderedDetails('{"OrderNo": "'.$_REQUEST['OrderNo'].'","UserID": "'.$_REQUEST['UserID'].'"}');

//print_r($PlacedOrderedDetails);
//exit;
$PlacedOrderedWiseBookDetails = $fn->GetRetailerOrderedWiseBooksDetails('{"OrderNo": "'.$_REQUEST['OrderNo'].'","UserID": "'.$_REQUEST['UserID'].'"}');
$UserAddressDetails = $fn->SelectAddressData('{"UserID": "'.$_REQUEST['UserID'].'" }'); 
$UserAddress = $UserAddressDetails['GetAddressWiseData'];
//echo "<pre>";
//print_r($_SESSION['BookStore']['session']['UserName']);
?> 

<div class="content-wrapper">
    <div class="page-title">
        <!--<div class="row">-->
            <div class="col-lg-5">
                <div>
                <h1><i class="fa fa-dashboard"></i> Orders List</h1>
            </div>
            <div>
                <ul class="breadcrumb pull-left">
                    
                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="index">Dashboard</a></li>
                    <li class="active">
                        <?php
                    if($_REQUEST['method']=='edit'){
                        echo 'Edit Book List';
                    }else if($_REQUEST['method']=='add'){
                        echo 'New Orders';
                    }else{
                        echo 'View Orders List';
                    } ?>
                        </li>
                </ul>
            </div>
            </div>
            <div class="col-lg-7">
                    <?php
                    if ($_REQUEST['method'] == 'add') {
                        $PageName = 'Add New Record';
                    } else if ($_REQUEST['method'] == 'edit') {
                        $PageName = 'Edit Record';
                    } else {
                        $PageName = 'View Records';
                        $ViewButton = '';
                    } ?>

            </div>
        </div>
    <div class="row" style="background-color: white ">
        <div class="col-lg-12">
                                <table class="table table-hover table-bordered" id="sampleTable" style="margin-top: 15px">
                                    <tr>
                                        <td colspan="5">
                                            <div class="row">
                                         <div class="col-lg-12">
                                <div class="col-lg-3">
                                    <p><b>To: </b><?php // echo $_SESSION['BookStore']['session']['UserName']?></p>
                                    <p><?php echo $UserAddress['AddressLine1']?>,</p>
                                    <p><?php echo $UserAddress['AddressLine2']?>,<?php echo $UserAddress['Area']?>,</p>
                                    <p><?php echo $UserAddress['CityName']?>-<?php echo $UserAddress['Pincode']?>.</p>
                                    <p>Mobile:<?php echo $UserAddress['MobileNumber']?></p>
                                </div>
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6">
                                    <img src="assets/images/Logo/Logo.jpeg" style="height: " height="80px" width="100%"> 
                                    <span style="margin-left: 10px"><b>Invoice Date :</b> <?php echo $PlacedOrderedWiseBookDetails['GetPlacedOrderedWiseDetailData'][0]['PurchaseDate']?></span>
                                    <span style="margin-left: 5px"><b>Invoice No :</b> <?php echo $PlacedOrderedDetails['GetPlacedOrderedWiseData']['OrderNo']?>.</span>
                                    
                                </div>
                                
                                         </div>
                                            </div>
                                        </td>
                                    </tr>   
                                <tr>
                                    <td style="width: 5%"><b>SrNo</b></td>
                                    <td><b>Book Details</b></td>
                                    <td><b>Quantity</b></td>
                                    <td><b>Price</b></td>
                                    <td><b>Amount</b></td>
                                </tr>
                                <tbody>
                                    <?php
//                                    echo "<pre>";
//                                    print_r($PlacedOrderedWiseBookDetails['GetPlacedOrderedWiseDetailData']);
//                                    exit;
                                    ?>
                                    <?php foreach ($PlacedOrderedWiseBookDetails['GetPlacedOrderedWiseDetailData'] AS $key => $Value){  ?>
                                <tr>
                                <td><?php echo ($key + 1) ?></td>    
                                <td><?php echo  $Value['BookTitle']; ?></td>    
                                <td><?php echo  $Value['TotalBookQuantity']; ?></td>    
                                <td><?php echo  $Value['BookPrice']; ?> &#8377;</td>    
                                <td><?php echo  $Value['PayableAmount'] ?> &#8377;</td>    </tr>
                            <?php 
                            $QuantityArray[] = $Value['TotalBookQuantity'];
                                    } 
                                    $QuantitySum = array_sum($QuantityArray);
                                    ?>
                                    <tr>
                                        <td colspan="2">Total: </td>
                                        <td colspan="2"><b><?php echo $QuantitySum?> Items</b></td>
                                        <td><b><?php echo $Value['PayableAmount']?> &#8377;</b></td>
                                </tr>
                            </tbody>
                                </table>
                                    <div class="row">
                                <div class="col-lg-12">
                                <div class="col-lg-8">
                            <address>
                            <p><b>Punahal Law House,</b> </p>
                            <p class="FontStyle">1st Floor above adarsh restaurant,</p>
                            <p class="FontStyle">Opp. Mirzapur court,</p>
                            <p class="FontStyle">Ahmedabad 38001</p>
                        </address>
                                </div>
                                <div class="col-lg-4">
                                    <p><b>Mobile :</b> +91 982 598 6757,</p> <p style="margin-left: 58px;">+91 937 613 3770</p>
                                    <p><b>Email :</b> <a href="http://www.gmail.com">punhallaw@gmail.com</a></p>
                                </div>
                                
                            </div>
                                </div>
                            </div>
</div>
    
    
    
    



        
<!-- Modal -->