<?php
//echo "Hello";
//exit;
$RetailerList = $fn->GetAllGeneralUserData();
//$AgentPlacedOrderList = $fn->GetAllAgentPlacedOrderData();
?>
<!--Content-->
<div class="content-wrapper">
    <div class="page-title">
        <!--<div class="row">-->
        <div class="col-lg-5">
            <div>
                <h1><i class="fa fa-dashboard"></i> Retailer Stock Management</h1>
            </div>
            <div>
                <ul class="breadcrumb pull-left">

                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="index">Dashboard</a></li>
                    <li class="active">
                        <?php
//                        echo "<pre>";
//                        print_r($RetailerList);
//                        exit;
                        if ($_REQUEST['method'] == 'edit') {
                            echo 'Edit Retailer List';
                        } else if ($_REQUEST['method'] == 'add') {
                            echo 'New Retailer Entry';
                        } else {
                            echo 'View Retailer List';
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
            if ($_REQUEST['method'] == '') {
                ?>
                <!--<a href='view_agent_books&method=add' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New</a>-->
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
            if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'OrderDetalis' || $_REQUEST['method'] == 'edit')) {
                require_once 'forms/form_create_retailer_books_orders.php';
//                  require_once 'view_agent_books_orders.php';
            } else {
                if ($RetailerList['ResponseCode'] != 0 && $RetailerList['Message'] != 'No Record Found') {
                    ?>
                    <div class="cardhome">
                        <div class="card-body">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th><?php echo SrNo; ?></th>
                                        <th><?php echo AgentName; ?></th>
                                        <th><?php echo MobileNumber; ?></th>
                                        <th><?php echo EmailID; ?></th>
                                        <th style="width: 20%;"><?php echo RowAction; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($RetailerList['GetRetailerData'] AS $Key => $Value) {
//                                            echo "<pre>";
//                                            print_r($Value);
                                        $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                        $NewStatus = ($Value['is_active'] == 'Y') ? 'N' : 'Y';
                                        $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                        ?>
                                        <tr>
                                            <td><?php echo ($Key + 1) ?></td>
                                            <td><?php echo $Value['UserName']; ?></td>
                                            <td><?php echo $Value['MobileNumber']; ?></td>
                                            <td><?php echo $Value['Email']; ?></td>
                                            <td>
                                                <div class="btn-group btn-group-justified">
                                                    <div class="btn-group">
                                                        <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo 'view_retailer_books_orders&method=OrderDetalis&RetailerID=' . $Value['UserID']; ?>">Add Books <i class="fa fa-edit"></i></a>
                                                    </div>
                                                </div>
                                            </td>
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
