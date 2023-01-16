<?php 
error_reporting(0);

$PlacedOrderedDetails = $fn->GetAgentWiseBookSellDetails('{"OrderNo": "'.$_REQUEST['OrderNo'].'","UserID": "'.$_REQUEST['UserID'].'"}');
$PlacedOrderedWiseBookDetails = $fn->GetOrderedWiseBooksDetails('{"OrderNo": "'.$_REQUEST['OrderNo'].'","UserID": "'.$_REQUEST['UserID'].'"}');
$ClientDetails = $fn->AgentClient('{"AgentID": "'.$_REQUEST['AgentID'].'" }'); 
//$ClientAddress = $ClientAddressDetails['GetClientAddressWiseData'];
//echo "<pre>";
//print_r($ClientAddressDetails);
?> 

<div class="content-wrapper">
    <div class="page-title">
        <!--<div class="row">-->
            <div class="col-lg-7">
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
        <div class="col-lg-3">
            <div class="form-group">
                <label for="Agent" class="control-label"><?php echo Agents; ?> <span style="color: red;">*</span> </label>
                <?php
                    $CategoryFilter = "is_active='Y' AND RoleID=2";
                    $SelectedAgent = isset($_REQUEST['AgentID']) ? $_REQUEST['AgentID'] : "1";
                    $db_array = array("tbl_name" => 'b_user', "condition"=>$CategoryFilter);
                    $select_array = array("name" => "UserID", "id" => "UserID", "class" => "form-control chosen-select required","onchange" => "GetAgentWiseBookSellRecord(this);");
                    $option_array = array("value" => "UserID", "label" => "UserName", "placeholder" => "Select Agent", 'selected' => $SelectedAgent);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    ?>
        </div>
        </div>
            <div class="col-lg-1">
                    <?php
                    if ($_REQUEST['method'] == 'add') {
                        $PageName = 'Add New Record';
                    } else if ($_REQUEST['method'] == 'edit') {
                        $PageName = 'Edit Record';
                    } else {
                        $PageName = 'View Records';
                        $ViewButton = '';
                    }
                if ($_REQUEST['method'] == '') { ?>
                <a href='view_sell_books_behalf_of_agent&method=add&AgentID=<?php echo $_REQUEST['AgentID']?>' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Sell Book</a>

                    <?php
                    }
                    if (!isset($_REQUEST['method']) && $_REQUEST['method'] == "") {
                        ?>
                <?php } echo $ViewButton; ?>
<!--                        <div class="col-lg-7 pull-right">

            </div>-->
            </div>
        
        </div>
    <div class="row" style="background-color: white ">
        <div class="col-lg-12">            
            <?php
            if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'add' || $_REQUEST['method'] == 'edit')) {
                require_once 'forms/form_create_sell_books_behalf_of_agent.php';
            } else {
//                echo "<pre>";
//                print_r($ClientDetails['GetClientAddressWiseData']);
                if ($ClientDetails['ResponseCode'] != 0 && $ClientDetails['Message'] != 'No Record Found') {
//                    echo "Hei";
//                    exit;
                    ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr><td colspan="6"><center><h3>Sell Data</h3></center></td></tr>
                                <tr>
                                    <th><?php echo SrNo; ?></th>
                                    <th><?php echo AgentName; ?></th>
                                    <th><?php echo MobileNo; ?></th>
                                    <th><?php echo Quantity; ?></th>
                                    <th><?php echo Amount; ?></th>
                                    <th><?php echo BookTitle; ?></th>
                                    <!--<th style="width: 20%;"><?php echo ROW_ACTION; ?></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                foreach ($ClientDetails['GetClientAddressWiseData'] AS $Key => $Value) {
//                                            echo '<pre>';
//                                            print_r($Value);
                                    $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                    $NewStatus = ($Value['is_active'] == 'Y') ? 'N' : 'Y';
                                    $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                    ?>
                                    <tr>
                                        <td><?php echo ($Key + 1) ?></td>
                                        <td><?php echo $Value['ClientName']; ?></td>
                                        <td><?php echo $Value['ClientMobileNumber']; ?></td>
                                        <td><?php echo $Value['TotalBookQuantity']; ?></td>
                                        <td><?php echo $Value['PayableAmount']; ?></td>
                                        <td><?php echo $Value['BookTitle']; ?></td>
                                    </tr>
        <?php } ?>                                    
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <center><h4>No Records Found</h4></center>
                    <?php
                }
            }
            ?>
        </div> 
</div>
    
    
    
    


<script>
    function GetAgentWiseBookSellRecord(e){
        window.location.href='view_sell_books_behalf_of_agent&AgentID='+e.value;
    }
</script>
        
<!-- Modal -->