<?php
//$RetailersBalanceList = $fn->GetAllBookData();
$RetailersBalanceList = $fn->GetRetailersOpBalanceData();
//echo "<pre>";
//print_r($RetailersBalanceList);
//exit;
?>
<!--Content-->
<div class="content-wrapper">
   <div class="row">
    <div class="page-title">
        <!--<div class="row">-->
        
        <div class="col-lg-8">
                <div>
                <h1><i class="fa fa-dashboard"></i> Retailers Opening Balance Management</h1>
            </div>
            <div>
                <ul class="breadcrumb pull-left">
                    
                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="index">Dashboard</a></li>
                    <li class="active">
                        <?php
//                        echo "<pre>";
//                        print_r($RetailersBalanceList);
                    if($_REQUEST['method']=='edit'){
                        echo 'Edit Retailer Balance';
                    }else if($_REQUEST['method']=='add'){
                        echo 'New Retailer Balance Entry';
                    }else{
                        echo 'View Retailer Balance List';
                    } ?>
                        </li>
                </ul>
            </div>
            </div>
            <div class="col-lg-4">
                
                    
                    <?php
//                    print_r($RetailersBalanceList);
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
                <div class="col-lg-12">
                    <a href='view_retailers_opening_balance_details&method=add' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add Opening Balance</a>
                </div>
<!--                <div class="col-lg-6">
                    <a href='view_retailers_balance_details&method=OpeningBalance&RetailerID=' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add opening balance"><span class="btn-label"><i class="fa fa-plus-square"></i></span> Opening Balance</a>
                </div>-->
                
               

                    <?php
                    }
                    if (!isset($_REQUEST['method']) && $_REQUEST['method'] == "") {
                        ?>
                        <div class="col-lg-7 pull-right">
<?php } echo $ViewButton; ?>
                    </div>
            </div>
        </div>
        
           
        </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'add' || $_REQUEST['method'] == 'edit')) {
                  require_once 'forms/form_create_retailers_opening_balance.php';
            } else if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'OpeningBalance' )) {
                  require_once 'forms/form_create_retailers_opening_balance.php';
            } else if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'ViewRetailersBalance' )) {
                  require_once 'forms/form_create_retailers_opening_balance.php';
            }else {
                if ($RetailersBalanceList['ResponseCode'] != 0 && $RetailersBalanceList['Message'] != 'No Record Found') {
//                    echo "<pre>";
//                    print_r($RetailersBalanceList);
                    ?>
                    <div class="cardhome">
                        <div class="card-body">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo RetailersName; ?></th>
                                            <th><?php echo OpeningBalance; ?></th>
                                            <th><?php echo Date; ?></th>
                                            <th style="width: 20%;"><?php echo RowAction; ?></th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        foreach ($RetailersBalanceList['GetRetailersBalanceData'] AS $Key => $Value) {
//                                            echo "<pre>";
//                                            print_r($Value);
                                            $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                            $NewStatus = ($Value['is_active'] == 'Y') ? 'N' : 'Y';
                                            $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['UserName']; ?></td>
                                                <td><?php echo $Value['PayableAmount']; ?> </td>
                                                <td><?php echo date('d-m-Y',strtotime($Value['Date']))  ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
<!--                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to change status of this entry" onclick="ChangeStatus('<?php echo 'b_retailer_balance'; ?>', '<?php echo $Value['RetailerBalanceID']; ?>', '<?php echo $NewStatus; ?>','RetailerBalanceID', 'is_active','view_retailers_balance_details');"><i class="fa <?php echo $ICON; ?>"></i></button> 
                                                        </div>
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo  'view_retailers_balance_details&method=edit&RetailerBalanceID=' . $Value['RetailerBalanceID'] ;?>"><i class="fa fa-edit"></i></a>
                                                        </div>-->
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'b_retailer_invoice_balance_rele'; ?>', '<?php echo $Value['InvoiceBalanceReleID']; ?>', 'D','InvoiceBalanceReleID', 'is_active','view_retailers_opening_balance_details','b_retailer_invoice_balance_rele','InvoiceBalanceReleID,InvoiceBalanceReleID');"><i class="fa fa-trash-o"></i></button>
                                                            
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
