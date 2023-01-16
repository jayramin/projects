<?php require_once 'Header.php';
//$data = $fn->getDataByID("b_bookmaster", "BookID",@$_REQUEST['BookID']);
//$PlacedOrderedData = $fn->GetPlacedOrderedData('{"UserID": "'.$UserID.'"}');
$PlacedOrderedData = $fn->SelectAllPlacedOrdersData('{"UserID": "'.$UserID.'"}');
//echo "<pre>";
//print_r($PlacedOrderedData['GetPlacedOrderWiseData']);
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
                    
                        <table class="table table-hover table-bordered table table-striped table-bordered" id="example">
                            <thead>
                                <tr>
                                    <th style="width: 5%"><?php echo SrNo; ?></th>
                                    <th>Product Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($PlacedOrderedData['GetPlacedOrderWiseData'] AS $Key => $Value) { 
//                                    echo "<pre>";
//                                    print_r($Value);
                                    ?>
                                    <tr>
                                        <td><?php echo ($Key + 1) ?></td>
                                        <td>
                                            <div class="row">
                                                                        <div class="col-lg-12">
                                                                                <div class="col-lg-6">
                                                                             <label>Order No : </label><span><?php echo $Value['OrderNo']; ?></span><br>
                                                            <!--<label>Total Order Quantity : </label><span><?php echo $Value['Quantity']; ?></span><br>-->
                                                            <label>Order Date : </label><span><?php echo $Value['OrderDate']; ?></span><br>
                                                            <label>Total Payable Amount : </label><span><?php echo $Value['OrderPrice']  ; ?> &#8377;</span>
                                                                            </div>
                                                                                <div class="col-lg-6">
                                                                            <label>Address : </label><span><?php echo $Value['AddressLine1']; ?>,</span><br>
                                                            <span><?php echo $Value['AddressLine2']; ?>,</span><br>
                                                            <span><?php echo $Value['Area']; ?>,</span><br>
                                                            <span><?php echo $Value['Pincode']; ?>.</span><br>
                                                                            </div>
                                                                            <a href="OrderWiseDetails.php?OrderNo=<?php echo $Value['OrderNo']?>" class="btn btn-simple pull-right">View Details</a>
                                                                    </div>
                                                
                                                            </div> 
                                            </td>
                                    </tr>
        <?php } ?>                                    
                            </tbody>
                        </table>
                        
                    </div>
                </div>  	    
            </div>
        </div>
<!-- Modal -->
<script>
//$(document).ready(function() {
//    $('#example').DataTable();
//} );
</script>
<?php require_once 'Footer.php';?>