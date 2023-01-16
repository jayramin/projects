<?php
$UserList = $fn->GetAllUsersDataByRoleID('{"Condition":{"UserID":"'.$_REQUEST['UserID'].'"}}');

if(isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != '')
{
    $TDataNew = $fn->TournamentStartDateByTournamentID('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
    $TData = $TDataNew['TournamentStartDateData'];
}
?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
            <div class="page-header">
                <?php if($_REQUEST['method'] == 'edit' && $_REQUEST['TeamID'] != ''){ ?>
                <h2>Tournament</h2>
                <ol class="breadcrumb">
                   <li><a href="home">Dashboard</a></li>
                   <li><a href="Tournament_Management">Tournament Management</a></li>
                   <li><a href="view_tournament_teams">Team List</a></li>
                   <li><a href="view_tournament_teams&method=edit&TournamentID=<?php echo $_REQUEST['TournamentID'] ?>&TeamID=<?php echo $_REQUEST['TeamID']?>">Teams Player List</a></li>
                    <li class="active"><?php echo ($_REQUEST['method']=='edit')?'Team Players List':'View Team Approval'; ?></li>
                </ol>
                <?php }else{ ?>
                    <h2>User Master</h2>
                <ol class="breadcrumb">
                   <li><a href="home">Dashboard</a></li>
                   <li><a href="view_users">Users</a></li>
                    <li class="active">
                        <?php
                    if($_REQUEST['method']=='edit'){
                        echo 'Edit User';
                    }else if($_REQUEST['method']=='add'){
                        echo 'Create User';
                    }else{
                        echo 'View User';
                    } ?></li>
                </ol>
                <?php  } ?>
                
            </div>
            </div>
            <div class="col-lg-6"><br><br>
                <div class='panel-header pull-right'>
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
                    
                        <a href='view_users&method=add' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New</a>

                    <?php
                    }else if($_REQUEST['method'] == 'edit' && $_REQUEST['TeamID'] != '' && $_REQUEST['Verify'] != 'Yes'){ ?>
                        <button type="button" name="update" id="updateButton" class="btn btn-sm btn-primary text-uppercase waves" onclick="AprroveRequest('&method=edit&TeamID=<?php echo $_REQUEST['TeamID']?>&TournamentID=<?php echo $_REQUEST['TournamentID']?>');" ><?php echo Approve; ?></button>
                
                <button type="button"  id="decline" class="btn btn-danger btn-sm text-uppercase waves"data-toggle="modal" data-target="#myModalDecline" ><?php echo Decline; ?>
                </button>
                        <?php
                    }

                    echo $ViewButton;
                    if (!isset($_REQUEST['method']) && $_REQUEST['method'] == "") { ?>
                        <div class="col-lg-6 ">
                            <?php
                            $SelectedUser = isset($_REQUEST['RoleID']) ? $_REQUEST['RoleID'] : "0";
                            $StateFilter = "is_active='Y' AND RoleID <> 1";
                            $db_array = array("tbl_name" => 'v_roles', "condition" => $StateFilter);
                            $select_array = array("name" => "RoleID", "id" => "RoleID", "class" => "form-control pull-right input-sm chosen-select required", "onchange" => "GetUserList(this);");
                            $option_array = array("value" => "RoleID", "label" => "RoleName", "placeholder" => "Select User Role", 'selected' => $SelectedUser);
                            $fn->dropdown($db_array, $select_array, $option_array);
                        } else {
                            ?>
                            <?php if($_REQUEST['method'] == 'edit' && $_REQUEST['TeamID'] != ''){?>
                                 <a href='view_tournament_teams&method=edit&TeamID=<?php echo $_REQUEST['TeamID']?>&TournamentID=<?php echo $_REQUEST['TournamentID']?>' class="btn btn-sm btn-success btn-labeled text-uppercase waves waves-effect waves-float" title="Back"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>   
                            <?php }else{ ?>
                                 <a href='view_users&RoleID=<?php echo $_REQUEST['RoleID']?>' class="btn btn-sm btn-success btn-labeled text-uppercase waves waves-effect waves-float" title="Back"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
                            <?php }?>                 
<?php } ?>
<?php echo $ViewButton; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='content-box panel-box panel-gray'>        
        <div class='panel-body'>
            <div class="row">
                <div class="col-lg-12">
                    <?php if(isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != '')
{ ?>
                    <center><h2 style="margin-top: 5px;">Player For: <font color="green"><?php echo $TData['TournamentName']; ?></font></h2></center><br>
<?php } ?>
                    <?php
                    if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'add' || $_REQUEST['method'] == 'edit')) {
                        require_once 'forms/form_user_approval.php';
                    } else {
                        if (is_array($UserList) && !empty($UserList)) {
                            ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo UsersName; ?></th>
                                            <th style="width: 20%;"><?php echo ROW_ACTION; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($UserList['GetUserWiseData'] AS $Key => $Value) {
                                            $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                            $NewStatus = ($Value['is_active'] == 'Y') ? 'N' : 'Y';
                                            $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['FullName']; ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to change status of this entry" onclick="ChangeStatus('<?php echo 'v_users'; ?>', '<?php echo $Value['UserID']; ?>', '<?php echo $NewStatus; ?>','UserID', 'is_active','view_users');"><i class="fa <?php echo $ICON; ?>"></i></button>                            
                                                        </div>
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo $_REQUEST['page'] . '&method=edit&UserID=' . $Value['UserID'].'&RoleID='.$_REQUEST['RoleID']; ?>"><i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'v_users'; ?>', '<?php echo $Value['UserID']; ?>', 'D','UserID', 'is_active','view_users');"><i class="fa fa-trash-o"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
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
        </div>
    </div>
</div>
<script>
    function GetUserList(e){
        window.location.href='view_users&RoleID='+e.value;
    }
    </script>