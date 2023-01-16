<?php
//$RetailersList = $fn->GetAllBookData();
$RetailersList = $fn->GetAllCreditNotesData();

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
        <div class="col-lg-6">


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
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <?php
                            $CategoryFilter = "is_active='Y' and RoleID <> 1";
                            $SelectedAgent = isset($_REQUEST['UserID']) ? $_REQUEST['UserID'] : "";
                            $db_array = array("tbl_name" => 'b_user', "condition" => $CategoryFilter);
                            $select_array = array("name" => "UserID", "id" => "UserID", "class" => "form-control chosen-select required", "onchange" => "GetUsersWiseCreditNotes(this);");
                            $option_array = array("value" => "UserID", "label" => "UserName", "placeholder" => "Select User", 'selected' => $SelectedAgent);
                            $fn->dropdown($db_array, $select_array, $option_array);
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <a href='view_credit_note&method=add&UserID=<?php echo $_REQUEST['UserID'] ?>' class="btn btn-sm btn-success btn-labeled text-uppercase waves waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Generate Credit Note</a>
                        </div>
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
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th><?php echo SrNo; ?></th>
                                        <th><?php echo NameOfRetailer; ?></th>
                                        <th><?php echo MobileNumber; ?></th>
                                        <th><?php echo email; ?></th>
                                        <th style="width: 25%;"><?php echo RowAction; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($RetailersList['GetRetailersData'] AS $Key => $Value) {
                                        $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                        $NewStatus = ($Value['is_active'] == 'Y') ? 'N' : 'Y';
                                        $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                        ?>
                                        <tr>
                                            <td><?php echo ($Key + 1) ?></td>
                                            <td><?php echo $Value['UserName']; ?></td>
                                            <td><?php echo $Value['MobileNumber']; ?> </td>
                                            <td><?php echo $Value['Email']; ?></td>
                                            <td>
                                                <div class="btn-group btn-group-justified">
                                                    <div class="btn-group">
                                                        <!--<button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to change status of this entry" onclick="ChangeStatus('<?php echo 'b_user'; ?>', '<?php echo $Value['UserID']; ?>', '<?php echo $NewStatus; ?>','UserID', 'is_active','view_retailers_details');"><i class="fa <?php echo $ICON; ?>"></i></button>--> 
                                                        <a class="btn waves waves-effect waves-float btn-sm btn-primary" title="Click here to print" href="<?php echo 'view_credit_note&method=invoice&UserID=' . $Value['UserID'] . '&CreditNoteID=' . $Value['CreditNoteID']; ?>" >Credit Note</a>
                                                    </div>
<!--                                                    <div class="btn-group">
                                                        <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo 'view_retailers_details&method=edit&UserID=' . $Value['UserID']; ?>"><i class="fa fa-edit"></i></a>
                                                    </div>-->
                                                    <div class="btn-group">
                                                        <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'b_user'; ?>', '<?php echo $Value['UserID']; ?>', 'D', 'UserID', 'is_active', 'view_retailers_details', 'v_users', 'UserID,UserID');"><i class="fa fa-trash-o"></i></button>

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


    <script>
        function GetUsersWiseCreditNotes(e) {
            window.location.href = 'view_credit_note&UserID=' + e.value;
        }
    </script>