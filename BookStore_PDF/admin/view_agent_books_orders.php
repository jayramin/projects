<?php

$AgentOrderList = $fn->GetAllAgentOrderData('{"AgentID":"'.$_REQUEST['AgentID'].'"}');
//$AgentPlacedOrderList = $fn->GetAllAgentPlacedOrderData();
?>
<!--Content-->
<div class="content-wrapper">
    <div class="page-title" style="margin-bottom: 0px">
        <!--<div class="row">-->
            <div class="col-lg-5">
                <div>
                <h1><i class="fa fa-dashboard"></i> Agent Stock Management</h1>
            </div>
            <div>
                <ul class="breadcrumb pull-left">
                    
                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="index">Dashboard</a></li>
                    <li class="active">
                        <?php
//                        echo "<pre>";
//                        print_r($AgentOrderList['GetAgentOrderStockData']);
//                        exit;
                    if($_REQUEST['method']=='edit'){
                        echo 'Edit Agent Order List';
                    }else if($_REQUEST['method']=='add'){
                        echo 'New Agent Entry';
                    }else{
                        echo 'View Agent Order List';
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
                    }
                    if ($_REQUEST['method'] != '') { ?>
                <a href='view_agent_books_orders&method=sendbook&AgentID=<?php echo $_REQUEST['AgentID']?>' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New</a>
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
                  require_once 'forms/form_create_send_book_to_agent.php';
            } else if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'BillInfo')) {
                  require_once 'indivicual_agent_invoice.php';
            }else{
                if ($AgentOrderList['ResponseCode'] != 0 && $AgentOrderList['Message'] != 'No Record Found') {
                    ?>
            <div class="content-wrapper" style="margin-top: 0px">
                        <div class="cardhome">
                            <div class="card-body">
                                <center><h2>Agent Orders List</h2></center>
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo TotalBookQuantity; ?></th>
                                            <th><?php echo PayableAmount; ?></th>
                                            <th><?php echo Date; ?></th>
                                            <th style="width: 20%;"><?php echo Action; ?></th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        foreach ($AgentOrderList['GetAgentOrderStockData'] AS $Key => $Value) {
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
                                                <td><?php echo $Value['EntryDate']; ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo  'view_agent_books_orders&method=BillInfo&AgentID=' .$Value['AgentID'].'&AgentBookStockMasterID='.$Value['AgentBookStockMasterID'];?>"><i class="fa fa-print"></i></a>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'b_agent'; ?>', '<?php echo $Value['AgentID']; ?>', 'D','AgentID', 'is_active','view_agent','b_agent','AgentID,AgentID');"><i class="fa fa-trash-o"></i></button>
                                                            
                                                        </div>
<!--                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to change status of this entry" onclick="ChangeStatus('<?php echo 'b_agent'; ?>', '<?php echo $Value['AgentID']; ?>', '<?php echo $NewStatus; ?>','AgentID', 'is_active','view_agent');"><i class="fa <?php echo $ICON; ?>"></i></button> 
                                                        </div>
                                                        
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'b_agent'; ?>', '<?php echo $Value['AgentID']; ?>', 'D','AgentID', 'is_active','view_agent','b_agent','AgentID,AgentID');"><i class="fa fa-trash-o"></i></button>
                                                            
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
