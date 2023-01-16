<?php
$RetailerOrderList = $fn->GetAllRetailerOrderData('{"RetailerID":"' . $_REQUEST['RetailerID'] . '"}');
//$AgentPlacedOrderList = $fn->GetAllAgentPlacedOrderData();
?>
<!--Content-->
<div class="content-wrapper">
    <div class="page-title" style="margin-bottom: 0px">
        <!--<div class="row">-->
        <div class="col-lg-5">
            <div>
                <h1><i class="fa fa-dashboard"></i> Book Seller Stock Management</h1>
            </div>
            <div>
                <ul class="breadcrumb pull-left">

                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="index">Dashboard</a></li>
                    <li class="active">
                        <?php
//                        echo "<pre>";
//                        print_r($RetailerOrderList);
//                        exit;
                        if ($_REQUEST['method'] == 'edit') {
                            echo 'Edit Retailer Order List';
                        } else if ($_REQUEST['method'] == 'add') {
                            echo 'New Retailer Entry';
                        } else {
                            echo 'View Retailer Order List';
                        }
                        ?>
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
            }
            if ($_REQUEST['method'] != '') {
                ?>
                <a href='view_retailer_books_orders&method=sendbook&RetailerID=<?php echo $_REQUEST['RetailerID'] ?>' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>   Generate New Bill</a>
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
            if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'sendbook' || $_REQUEST['method'] == 'edit')) {
                require_once 'forms/form_create_send_book_to_retailer.php';
            } else if (isset($_REQUEST['method']) && $_REQUEST['method'] == 'invoice' && $_REQUEST['RetailerBookStockMasterID'] != '' || $_REQUEST['method'] == 'BalanceInfo') {
                require_once 'retailer_invoice.php';
            } else {
                if ($RetailerOrderList['ResponseCode'] != 0 && $RetailerOrderList['Message'] != 'No Record Found') {
                    ?>
                    <div class="content-wrapper" style="margin-top: 0px">
                        <div class="cardhome">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-6 col-lg-offset-4">
                                            <h2>Book Seller Orders List</h2>
                                        </div>
                                        <div class="col-lg-2">
                                            <a class="btn waves waves-effect waves-float btn-lg btn-info pull-right" title="Click here get Balance Info" href="<?php echo 'view_retailer_books_orders&method=BalanceInfo&RetailerID=' . $_REQUEST['RetailerID']; ?>">View Balance Sheet</a>
                                        </div>
                                        
                                
                                    </div>
                                </div>
                                
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo Quantity; ?></th>
                                            <th><?php echo PayableAmount; ?></th>
                                            <th><?php echo BillNo; ?></th>
                                            <th><?php echo Date; ?></th>
                                            <th style="width: 20%;"><?php echo RowAction; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($RetailerOrderList['GetRetailerOrderStockData'] AS $Key => $Value) {
//                                            echo "<pre>";
//                                            print_r($Value);
                                            $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                            $NewStatus = ($Value['is_active'] == 'Y') ? 'N' : 'Y';
                                            $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['TotalBookQuantity']; ?></td>
                                                <td><?php echo $Value['PayableAmount']; ?> &#8377;</td>
                                                <td><?php echo $Value['RetailerBookStockMasterID']; ?> </td>
                                                <td><?php echo date('d-m-Y',  strtotime($Value['EntryDate'])); ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
<!--                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo 'view_agent_books_orders&method=sendbook&RetailerID=' . $Value['RetailerID'] . '&AgentBookStockMasterID=' . $Value['AgentBookStockMasterID']; ?>"><i class="fa fa-edit"></i></a>
                                                        </div>-->
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'b_agent'; ?>', '<?php echo $Value['RetailerID']; ?>', 'D', 'RetailerID', 'is_active', 'view_agent', 'b_agent', 'RetailerID,RetailerID');"><i class="fa fa-trash-o"></i></button>

                                                        </div>
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-primary" title="Click here to print" href="<?php echo 'view_retailer_books_orders&method=invoice&RetailerID=' . $Value['RetailerID'] . '&RetailerBookStockMasterID=' . $Value['RetailerBookStockMasterID']; ?>">View Bill</a>
                                                            
                                                        </div>

                                                        <!--                                                  <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'b_agent'; ?>', '<?php echo $Value['RetailerID']; ?>', 'D','RetailerID', 'is_active','view_agent','b_agent','RetailerID,RetailerID');"><i class="fa fa-trash-o"></i></button>
                                                            
                                                        </div>-->
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>                                    
                                    </tbody>
                                </table>
                            </div>
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
