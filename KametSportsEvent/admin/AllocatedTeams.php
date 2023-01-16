<?php
if(isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != '' && isset($_REQUEST['GroupID']) && $_REQUEST['GroupID'] != ''){
$data = $fn->GetAllallocatedTeamsByTournamentID($_REQUEST['TournamentID'],$_REQUEST['GroupID']);
$GroupData = $fn->GetGroupNameByGroupID($_REQUEST['GroupID']);
$Group = $GroupData['GetGroupIDWiseGroupData'];

$TournamentStartDateData = $fn->TournamentStartDateByTournamentID('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$TournamentStartDate = $TournamentStartDateData['TournamentStartDateData'];
}
?>
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-10">
            <div class="page-header">
                <h2>Tournament</h2>
                <ol class="breadcrumb">
                   <li><a href="home">Dashboard</a></li>
                   <li><a href="Tournament_Management">Tournament Management</a></li>
                   <li><a href="view_group_team_relation&TournamentID=<?php echo $_REQUEST['TournamentID']; ?>">Group Team Relation</a></li>
                    <li class="active">List Of Allocated Teams</li>
                </ol>
            </div>
            </div>
            <div class="col-lg-2"><br><br>
                <div class='panel-header'>
                    
                </div>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <h1>Team List For <?php echo $Group['GroupName']; ?></h1>
        </div>
        <div class='panel-body'>
             <div class="row">
                <div class="col-lg-12">            
                    <?php
                        if (is_array($data) && !empty($data)) { ?>
                            <div class="table-responsive">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th><?php echo SrNo; ?></th>
                                            <th><?php echo TeamName; ?></th>
                                            <th style="width: 20%;"><?php echo ROW_ACTION; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data['GetTournamentAndGroupWiseAllocatedTeamsData'] AS $Key => $Value) { 
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['TeamName']; ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-justified">
                                                        <div class="btn-group">
                                                            <?php if($TournamentStartDate['StartDate'] > date('Y-m-d')){ ?>
                                                            <button class="btn waves waves-effect waves-float btn-sm btn-danger" title="Click here to remove this entry" onclick="DeleteSingleRecord('<?php echo 'v_groups_team_relation'; ?>', '<?php echo $Value['GroupTeamRelationID']; ?>', 'D','GroupTeamRelationID', 'is_active','AllocatedTeams&TournamentID=<?php echo $_REQUEST['TournamentID']; ?>&GroupID=<?php echo $_REQUEST['GroupID']; ?>');">Remove</button>
                                                            <?php } ?>
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
                    ?>
                </div>        
            </div>  
        </div>
    </div>
</div>