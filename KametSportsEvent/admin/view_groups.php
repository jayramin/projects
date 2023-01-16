<?php
$data = $fn->GetAllGroupsData('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
?>
<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-7">
            <div class="page-header">
                <h2>Tournament</h2>
                <ol class="breadcrumb">
                   <li><a href="home">Dashboard</a></li>
                   <li><a href="Tournament_Management">Tournament Management</a></li>
                   <li><a href="view_groups">Groups</a></li>
                    <li class="active"><?php if($_REQUEST['method']=='edit'){
                        echo 'Edit Group';
                    }else if($_REQUEST['method']=='add'){
                        echo 'Create Group';
                    }else{
                        echo 'View Groups';
                    } ?></li>
                </ol>
            </div>
            </div>
            <div class="col-lg-5"><br><br>
                <div class='panel-header'>
                    <div class="col-lg-9">
                        <div class="col-lg-5" style="padding-right: 1px;padding-top:5px;">
                        <label for="TournamentName" class="control-label"><?php echo SearchTournament; ?> </label>
                        </div>
                        <div class="col-lg-7">
                    <?php
                    $Selected = isset($_REQUEST['TournamentID']) ? $_REQUEST['TournamentID'] :'' ;
                    $db_array = array("tbl_name" => 'v_tournaments', "condition" => "is_active='Y'");
                    $select_array = array("name" => "TournamentID", "id" => "TournamentID", "class" => "required form-control", "onchange" => "GetGroupList(this);");
                    $option_array = array("value" => "TournamentID", "label" => "TournamentName", "placeholder" => "Select Tournament", 'selected' => $Selected);
                    $fn->dropdown($db_array, $select_array, $option_array);
                    
                    ?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        
            <?php
            if($_REQUEST['method'] == ''){ ?>
               <a href='view_groups&method=add&TournamentID=<?php echo $_REQUEST['TournamentID']?>' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add new record"><span class="btn-label"><i class="fa fa-plus-square"></i></span>  Add New</a>
            <?php echo $ViewButton; ?>
          <?php } else{ ?>
               <a href='view_groups' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Back"><span class="btn-label"><i class="fa fa-arrow-left"></i></span>Back</a>
          <?php }?>
               
            <?php echo $ViewButton; ?>
                    </div>
        </div>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <h1>Groups</h1>
        </div>
        <div class='panel-body'>
             <div class="row">
                <div class="col-lg-12">            
                    <?php
                    if (isset($_REQUEST['method']) && ($_REQUEST['method'] == 'add' || $_REQUEST['method'] == 'edit')) {
                        require_once 'forms/form_create_groups.php';
                    } else {
                        if (is_array($data) && !empty($data)) { ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo GroupName; ?></th>
                                            <th><?php echo TournamentName; ?></th>
                                            <th><?php echo TournamentDescription; ?></th>
                                            <th style="width: 20%;"><?php echo ROW_ACTION; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data['GetGroupWiseData'] AS $Key => $Value) {
                                            $TournamentStartDateData = $fn->TournamentStartDateByTournamentID($Value['TournamentID']);
                                            $TournamentStartDate = $TournamentStartDateData['TournamentStartDateData']; 
                                            $ICON = ($Value['is_active'] == 'Y') ? 'fa-thumbs-up' : 'fa-thumbs-down';
                                            $NewStatus = ($Value['is_active'] == 'Y') ? 'N' : 'Y';
                                            $Color = ($Value['is_active'] == 'Y') ? 'success' : 'warning';
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['GroupName']; ?></td>
                                                <td><?php echo $Value['TournamentName']; ?></td>
                                                <td><?php echo $Value['GroupDescription']; ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-<?php echo $Color; ?>" title="Click here to change status of this entry" onclick="ChangeStatus('<?php echo 'v_groups'; ?>', '<?php echo $Value['GroupID']; ?>', '<?php echo $NewStatus; ?>','GroupID', 'is_active','view_groups');"><i class="fa <?php echo $ICON; ?>"></i></button>                            
                                                        </div>
                                                        <?php if($TournamentStartDate['StartDate'] < date('Y-m-d')){ }else{ ?>
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-info" title="Click here to edit this entry" href="<?php echo $_REQUEST['page'] . '&method=edit&GroupID=' . $Value['GroupID']; ?>"><i class="fa fa-edit"></i></a>
                                                        </div>
                                                        <?php } ?>
                                                        <div class="btn-group">
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'v_groups'; ?>', '<?php echo $Value['GroupID']; ?>', 'D','GroupID', 'is_active','view_groups');"><i class="fa fa-trash-o"></i></button>
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
function GetGroupList(e){
        window.location.href='view_groups&TournamentID='+e.value;
    }
</script>