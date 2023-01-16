<?php require_once 'Header.php';
//$data = $fn->getDataByID("b_bookmaster", "BookID",@$_REQUEST['BookID']);
$PlacedOrderedDetails = $fn->GetPlacedOrderedDetails('{"OrderNo": "'.$_REQUEST['OrderNo'].'","UserID": "'.$UserID.'"}');

$PlacedOrderedWiseBookDetails = $fn->GetOrderedWiseBooksDetails('{"OrderNo": "'.$_REQUEST['OrderNo'].'","UserID": "'.$UserID.'"}');
$UserAddressDetails = $fn->SelectAddressData('{"UserID": "'.$UserID.'" }'); 
$UserAddress = $UserAddressDetails['GetAddressWiseData'];
//echo "<pre>";
//print_r($_SESSION['BookStore']['session']['UserName']);
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
                    <div class="col-md-9 content_right" style="padding-left: 25px">

                        <div class="row" style="background-color: white; border: 1px solid;   ">
                            <div class="col-lg-12">
                                <table class="table table-hover table-bordered" id="sampleTable" style="margin-top: 15px">
                                    <tr>
                                        <td colspan="6">
                                            <div class="row">
                                         <div class="col-lg-12">
                                <div class="col-lg-3">
                                    <p><b>To: </b><?php echo $_SESSION['BookStore']['session']['UserName']?></p>
                                    <p><?php echo $UserAddress['AddressLine1']?>,</p>
                                    <p><?php echo $UserAddress['AddressLine2']?>,<?php echo $UserAddress['Area']?>,</p>
                                    <p><?php echo $UserAddress['CityName']?>-<?php echo $UserAddress['Pincode']?>.</p>
                                    <p>Mobile:<?php echo $UserAddress['MobileNumber']?></p>
                                </div>
                                <div class="col-lg-4"></div>
                                <div class="col-lg-5">
                                    <img src="assets/images/Logo/Logo.jpeg" style="margin-left: 7px" height="80px" width="80%"> 
                                    <span style="margin-left: 7px"><b>&nbsp; Invoice Date :</b> <?php echo date('d-m-Y',  strtotime($PlacedOrderedWiseBookDetails['GetPlacedOrderedWiseDetailData'][0]['PurchaseDate']))?></span><br>
                                    <span style="margin-left: 5px"><b> &nbsp; Invoice No :</b> <?php echo $PlacedOrderedDetails['GetPlacedOrderedWiseData']['OrderNo']?>.</span>
                                    
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
                                    <td><b>Discount</b></td>
                                    <td><b>Amount</b></td>
                                </tr>
                                <tbody>
                                    <?php foreach ($PlacedOrderedWiseBookDetails['GetPlacedOrderedWiseDetailData'] AS $key => $Value){ 
//                                        echo "<pre>";
//                                        print_r($Value);
                                        $Percentage = ($Value['BookMRP']-$Value['BookPrice'])/$Value['BookPrice'];
                                        ?>
                                <tr>
                                <td><?php echo ($key + 1) ?></td>    
                                <td><?php echo  $Value['BookTitle']; ?></td>    
                                <td><?php echo  $Value['Quantity']; ?></td>    
                                <td><?php echo  $Value['BookMRP']; ?> &#8377;</td>    
                                <td><?php echo  $Percentage*100; ?> %</td>    
                                <td><?php echo  $Value['Quantity'] * $Value['BookPrice']; ?> &#8377;</td>    </tr>
                            <?php 
                            $QuantityArray[] = $Value['Quantity'];
                                    } 
                                    $QuantitySum = array_sum($QuantityArray);
                                    ?>
                                    <tr>
                                        <td colspan="2">Total: </td>
                                        <td colspan="3"><b><?php echo $QuantitySum?> Items</b></td>
                                        <td><b><?php echo $Value['OrderPrice']?> &#8377;</b></td>
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
                                        <div class="row">
                                            <div class="col-lg-2 pull-right">
                                                <input type="button" class="btn btn-default" value="Print" style="margin-bottom: 20px"></div>
                                        </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>  	    
            </div>
        </div>
<!-- Modal -->
<?php require_once 'Footer.php';?>