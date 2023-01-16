<?php
//$RetailersList = $fn->GetAllBookData();
if (isset($_REQUEST['RoleID']) && !isset($_REQUEST['fromdate'])) {
    $RetailersList = $fn->UserTypeWiseRecord($_REQUEST['RoleID']);
}
if (isset($_REQUEST['fromdate'])) {
    $RetailersList = $fn->UserTypeWiseRecord($_REQUEST['RoleID'],$_REQUEST['fromdate'],$_REQUEST['todate']);
}


//exit;
?>
<!--Content-->
<div class="content-wrapper">
    <div class="page-title">
        <!--<div class="row">-->
        <div class="col-lg-4">
            <div>
                <h1><i class="fa fa-dashboard"></i> Credit Note Management</h1>
            </div>
            <div>
                <ul class="breadcrumb pull-left">

                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="index">Dashboard</a></li>
                    <li class="active">
                        <?php
                        if ($_REQUEST['method'] == 'edit') {
                            echo 'Edit Retailer';
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
        <div class="col-lg-8">
            <?php
//                    print_r($RetailersList);
//exit;

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

                <div class="col-lg-4">
                    <div class="form-group">
                        <select class="form-control chosen-select required" name="Role" id="Role" onchange="GetUserRoleWiseData(this.value)"> 
                            <option value="">Select Role</option>
                            <option value="2" <?php if($_REQUEST['RoleID']==2){ echo "selected" ; } ?>>Agent</option>
                            <option value="3" <?php if($_REQUEST['RoleID']==3){ echo "selected" ; } ?>>Retailer</option>
                            <option value="4" <?php if($_REQUEST['RoleID']==4){ echo "selected" ; } ?>>Internet User</option>
                            <option value="5" <?php if($_REQUEST['RoleID']==5){ echo "selected" ; } ?>>General User</option>
                        </select>
                        
                    </div>
                </div>
             <div class="col-lg-4">
                 <div class="form-group">
                     <input class="form-control" id="fromdate" name="fromdate" placeholder="MM/DD/YYYY" type="date"/>
                 </div>
             </div>
             <div class="col-lg-4">
                 <div class="form-group">
                      <input class="form-control" id="todate" name="todate" placeholder="MM/DD/YYYY" type="date"/>
                 </div>
             </div>
             
                <?php
            }
            if (!isset($_REQUEST['method']) && $_REQUEST['method'] == "") {
                ?>
                <div class="col-lg-7 pull-right">
<?php } echo $ViewButton; ?>
            </div>
        </div>
        <div class="col-lg-1">
                 <div class="form-group">
                     <input class="btn btn-default btn-sm" id="search" value="Search" name="search" type="button" onclick="GetSearchResult()"/>
                     <input type="hidden" value="<?php echo $_REQUEST['RoleID']?>" id="RoleID">
                 </div>
             </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'add' || $_REQUEST['method'] == 'edit')) {
                require_once 'forms/form_create_credite_note.php';
            } else if (isset($_REQUEST['method']) && $_REQUEST['method'] == 'invoice' && $_REQUEST['CreditNoteID'] != '') {
                require_once 'credit_note_invoice.php';
            } else {
                if ($RetailersList['ResponseCode'] != 0 && $RetailersList['Message'] != 'No Record Found') {
                    ?>
                    <div class="cardhome">
                        <div class="card-body">
                            <table class="table table-striped table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th><?php echo SrNo; ?></th>
                                        <th><?php echo RetailersName; ?></th>
                                        <th><?php echo MobileNumber; ?></th>
                                        <th><?php echo email; ?></th>
                                        <th><?php echo Quantity; ?></th>
                                        <th><?php echo Amount; ?></th>
                                        <th><?php echo OrderNo; ?></th>
                                        <th><?php echo date; ?></th>
                                        <!--<th style="width: 20%;"><?php // echo RowAction;  ?></th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($_REQUEST['RoleID'] == 2) {
                                        $KeyName = "AgentBookStockMasterID";
                                    } elseif ($_REQUEST['RoleID'] == 3) {
                                        $KeyName = "RetailerBookStockMasterID";
                                    } elseif ($_REQUEST['RoleID'] == 4) {
                                        $KeyName = "ClientBookStockMasterID";
                                    } elseif ($_REQUEST['RoleID'] == 5) {
                                        $KeyName = "UserBookStockMasterID";
                                    }
                                    foreach ($RetailersList['GetRetailersData'] AS $Key => $Value) {
//                                            echo "<pre>";
//                    print_r($Value);
//                                            echo $Value['UserName'];
//                                            echo $Value[$KeyName];
                                        $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                        $NewStatus = ($Value['is_active'] == 'Y') ? 'N' : 'Y';
                                        $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                        ?>
                                        <tr>
                                            <td><?php echo ($Key + 1) ?></td>

                                            <td><?php echo $Value['UserName']; ?></td>
                                            <td><?php echo $Value['MobileNumber']; ?> </td>
                                            <td><?php echo $Value['Email']; ?></td>
                                            <td><?php echo $Value['TotalBookQuantity']; ?></td>
                                            <td><?php echo $Value['PayableAmount']; ?></td>
                                            <td><?php echo $Value[$KeyName]; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($Value['EntryDate'])); ?></td>
            <!--                                                <td>
                                                <div class="btn-group btn-group-justified">
                                                    <div class="btn-group">
                                                        <button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to change status of this entry" onclick="ChangeStatus('<?php echo 'b_user'; ?>', '<?php echo $Value['UserID']; ?>', '<?php echo $NewStatus; ?>','UserID', 'is_active','view_retailers_details');"><i class="fa <?php echo $ICON; ?>"></i></button> 
                                                        <a class="btn waves waves-effect waves-float btn-sm btn-primary" title="Click here to print" href="<?php echo 'view_credit_note&method=invoice&UserID=' . $Value['UserID'] . '&CreditNoteID=' . $Value['CreditNoteID']; ?>"><i class="fa fa-file"></i></a>
                                                    </div>
                                                    <div class="btn-group">
                                                        <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo 'view_retailers_details&method=edit&UserID=' . $Value['UserID']; ?>"><i class="fa fa-edit"></i></a>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'b_user'; ?>', '<?php echo $Value['UserID']; ?>', 'D','UserID', 'is_active','view_retailers_details','v_users','UserID,UserID');"><i class="fa fa-trash-o"></i></button>
                                                        
                                                    </div>
                                                </div>
                                            </td>-->
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

    <script>
        $(document).ready(function () {
            var date_input = $('input[name="date"]'); //our date input has the name "date"
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'mm/dd/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            })
        })
    </script>
    <script>
        function GetUserRoleWiseData(e) {
            window.location.href = 'view_book_sell_reports&RoleID=' + e;
        }
        function GetSearchResult() {
            var fromdate = $("#fromdate").val();
            var todate = $("#todate").val();
            var RoleID = $("#RoleID").val();
            window.location.href = 'view_book_sell_reports&RoleID=' +RoleID +'&todate='+todate+'&fromdate='+fromdate;
        }
        
    </script>
