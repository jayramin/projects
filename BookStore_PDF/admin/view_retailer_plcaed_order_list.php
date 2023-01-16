<?php
$PlaceOrderList = $fn->SelectAllRetailerPlacedOrdersData();

?>
<!--Content-->
<div class="content-wrapper">
    <div class="page-title">
        <!--<div class="row">-->
            <div class="col-lg-5">
                <div>
                <h1><i class="fa fa-dashboard"></i> Book Seller Orders List</h1>
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
//                    print_r($BookList);
//exit;
                    
                    if ($_REQUEST['method'] == 'add') {
                        $PageName = 'Add New Record';
                    } else if ($_REQUEST['method'] == 'edit') {
                        $PageName = 'Edit Record';
                    } else {
                        $PageName = 'View Records';
                        $ViewButton = '';
                    }

                    if ($_REQUEST['method'] == '') { ?>
                    <!--<a href='view_book_quantity&method=add' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New</a>-->

                    <?php
                    }
                    if (!isset($_REQUEST['method']) && $_REQUEST['method'] == "") {
                        ?>
                        <div class="col-lg-7 pull-right">
<?php } echo $ViewButton; ?>
                    </div>
            </div>
        </div>
    <div class="row">
        <div class="col-md-12">
            <?php
//            echo "<pre>";
//print_r($PlaceOrderList);
            if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'add' || $_REQUEST['method'] == 'edit')) {
//                  require_once 'forms/form_create_book_quantity.php';
            } else {
                if ($PlaceOrderList['ResponseCode'] != 0 && $PlaceOrderList['Message'] != 'No Record Found') {
//                    echo "<pre>";
//print_r($PlaceOrderList['GetPlacedOrderWiseData']);
                    ?>
                    <div class="cardhome">
                        <div class="card-body">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo BookSellerName; ?></th>
                                            <th><?php echo email; ?></th>
                                            <th><?php echo TotalAmount; ?></th>
                                            <th><?php echo MobileNo; ?></th>
                                            <th><?php echo Invoiceno; ?></th>
                                            <th><?php echo OrderDate; ?></th>
                                            <th><?php echo OrderStatus; ?></th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        foreach ($PlaceOrderList['GetPlacedOrderWiseData'] AS $Key => $Value) {
//                                            echo "<pre>";
//                                            print_r($Value);
                                            $ICON = ($Value['OrderDeliveryStatus'] == 'P') ? 'fa-motorcycle' : 'fa-thumbs-up';
                                            $NewStatus = ($Value['OrderDeliveryStatus'] == 'P') ? 'S' : 'P';
                                            $Color = ($Value['OrderDeliveryStatus'] == 'P') ? 'warning' : 'success';
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['UserName']; ?></td>
                                                <td><?php echo $Value['Email']; ?></td>
                                                <td><?php echo $Value['PayableAmount']; ?> &#8377;</td>
                                                <td><?php echo $Value['MobileNumber']; ?></td>
                                                <td><?php echo $Value['RetailerBookStockMasterID']; ?></td>
                                                <td><?php echo date("d-m-Y", strtotime($Value['OrderDate'])); ?></td>
                                                <td><?php if($Value['OrderDeliveryStatus'] == "P"){ ?> 
                                                    <button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to Delived this Order" onclick="ChangeStatus('<?php echo 'b_retailer_book_stock_master'; ?>', '<?php echo $Value['RetailerBookStockMasterID']; ?>', '<?php echo $NewStatus; ?>','RetailerBookStockMasterID', 'OrderDeliveryStatus','view_retailer_plcaed_order_list');"><i class="fa <?php echo $ICON; ?>"></i></button>
                                                    <a class="btn waves waves-effect waves-float btn-sm btn-default" href="view_retailers_wise_order_details&OrderNo=<?php echo $Value['RetailerBookStockMasterID']; ?>&UserID=<?php echo $Value['UserID']?>" class="btn btn-normal">Print</a>
                                                    <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'b_retailer_book_stock_master'; ?>', '<?php echo $Value['RetailerBookStockMasterID']; ?>', 'D','RetailerBookStockMasterID', 'is_active','view_retailer_plcaed_order_list','b_order_master','OrderID,OrderID');"><i class="fa fa-trash-o"></i></button>
                                                    <!--<span style="color: red">Pending</span>-->
 <?php }else { ?><span style="color: green">Delivered</span><?php } ?></td>
                                                
                                            </tr>
                                        <?php } ?>                                    
                                    </tbody>
                            </table>
                        </div>
                    <!--</div>-->
                <?php } else { ?>
                    <center><h4>No Records Found</h4></center>
                    <?php
                }
            }
            ?>

        </div>
    </div>
</div>
