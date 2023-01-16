<?php
//$GeneralUserList = $fn->GetAllBookData();
$GeneralUserList = $fn->GetAllGeneralUserData();

//exit;
?>
<!--Content-->
<div class="content-wrapper">
    <div class="page-title">
        <!--<div class="row">-->
            <div class="col-lg-5">
                <div>
                <h1><i class="fa fa-dashboard"></i> Retailers Management</h1>
                
            </div>
            <div>
                <ul class="breadcrumb pull-left">
                    
                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="index">Dashboard</a></li>
                    <li class="active">
                        <?php
                    if($_REQUEST['method']=='edit'){
                        echo 'Edit General User';
                    }else if($_REQUEST['method']=='add'){
                        echo 'New General User Entry';
                    }else{
                        echo 'View General User List';
                    } ?>
                        </li>
                </ul>
            </div>
            </div>
            <div class="col-lg-7">
                
                    
                    <?php
//echo "<pre>";
//print_r($GeneralUserList);
                    
                    if ($_REQUEST['method'] == 'add') {
                        $PageName = 'Add New Record';
                    } else if ($_REQUEST['method'] == 'edit') {
                        $PageName = 'Edit Record';
                    } else {
                        $PageName = 'View Records';
                        $ViewButton = '';
                    }

                    if ($_REQUEST['method'] == '') { ?>
                <a href='view_general_user_details&method=add' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New Retailer</a>

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
                  require_once 'forms/form_create_general_users.php';
            } else {
                if ($GeneralUserList['ResponseCode'] != 0 && $GeneralUserList['Message'] != 'No Record Found') {
                    ?>
                    <div class="cardhome">
                        <div class="card-body">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo UserName; ?></th>
                                            <th><?php echo MobileNumber; ?></th>
                                            <th><?php echo email; ?></th>
                                            <th style="width: 20%;"><?php echo RowAction; ?></th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        foreach ($GeneralUserList['GetGeneralUserData'] AS $Key => $Value) {
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
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to change status of this entry" onclick="ChangeStatus('<?php echo 'b_user'; ?>', '<?php echo $Value['UserID']; ?>', '<?php echo $NewStatus; ?>','UserID', 'is_active','view_general_user_details');"><i class="fa <?php echo $ICON; ?>"></i></button> 
                                                        </div>
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo  'view_general_user_details&method=edit&UserID=' . $Value['UserID'] ;?>"><i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'b_user'; ?>', '<?php echo $Value['UserID']; ?>', 'D','UserID', 'is_active','view_general_user_details','v_users','UserID,UserID');"><i class="fa fa-trash-o"></i></button>
                                                            
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
