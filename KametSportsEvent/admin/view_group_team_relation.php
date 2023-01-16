<?php
if(isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != '')
{
$data = $fn->GetAllGroupsByTournamentID($_REQUEST['TournamentID']);
}
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
                   <li><a href="view_group_team_relation&TournamentID=<?php echo $_REQUEST['TournamentID']; ?>">Group Team Relation</a></li>
                    <li class="active"><?php echo ($_REQUEST['method']=='edit')?'Edit Group':'View Group'; ?></li>
                </ol>
            </div>
            </div>
            <div class="col-lg-5">
             <br><br>
             <div class='panel-header'>
             <div class="row">
                 <div class="col-lg-4">
                 <label style="margin-top: 5px;"><?php echo SelectTournament ?></label>
                 </div>
                 <div class="col-lg-8">
                 <?php
                 $Selected = isset($_REQUEST['TournamentID']) ? $_REQUEST['TournamentID'] : "";
                 $db_array = array("tbl_name" => 'v_tournaments', "condition" => "is_active='Y' AND EndDate >= CURDATE()");
                 $select_array = array("name" => "TournamentID", "id" => "TournamentID", "class" => "form-control required","onchange" => "GetGroupsByTournamentID(this.value)");
                 $option_array = array("value" => "TournamentID", "label" => "TournamentName", "placeholder" => "Select Tournament", 'selected' => $Selected);
                 $fn->dropdown($db_array, $select_array, $option_array);
                 ?>
                 </div>
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
                                        foreach ($data['GetTournamentWiseGroupData'] AS $Key => $Value) {
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
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-success" title="Click here to edit this entry" href="<?php echo 'UnallocatedTeams&TournamentID='.$_REQUEST['TournamentID'].'&GroupID=' . $Value['GroupID']; ?>">ADD TEAM</a>
                                                        </div>
                                                        <div class="btn-group">
                                                            <a class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" href="<?php echo 'AllocatedTeams&TournamentID='.$_REQUEST['TournamentID'].'&GroupID=' . $Value['GroupID']; ?>">VIEW TEAM</a>
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
    function GetGroupsByTournamentID(ele)
    {
        window.location = 'view_group_team_relation&TournamentID='+ele;
    }
</script>