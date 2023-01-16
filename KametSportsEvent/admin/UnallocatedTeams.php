<?php
if(isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != ''){
$data = $fn->GetAllUnallocatedTeamsByTournamentID($_REQUEST['TournamentID']);
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
                    <li class="active">Allocate Teams</li>
                  </ol>
                </div>
            </div>
            <div class="col-lg-2"><br><br>
                <?php if($TournamentStartDate['StartDate'] > date('Y-m-d')){ ?>
                <div class='panel-header'>
                    <a style="margin-top: 5px;" href='#' class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" title="Click here to add record" onclick='SaveSelectedTeams("v_groups_team_relation","<?php echo $_REQUEST['TournamentID']; ?>","<?php echo $_REQUEST['GroupID']; ?>");'><span class="btn-label"><i class="fa fa-plus-square"></i></span>Save Selected Teams</a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <h1>Teams Allocation For <?php echo $Group['GroupName']; ?> <span class="text-danger pull-right" style="font-size: 14px;"><b>Note:</b> Those Team Who Done Their Payment Will only shown here. </span></h1>
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
                                            <th><?php echo SelectTeam; ?></th>
                                            <th><?php echo TeamName; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data['GetTournamentWiseTeamsData'] AS $Key => $Value) { 
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><input type='checkbox' name='TeamForGroup' value='<?php echo $Value['TeamID']; ?>'></td>
                                                <td><?php echo $Value['TeamName']; ?></td>
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
<script>
function SaveSelectedTeams(table_name,TournamentID, GroupID){
    var Teams = '';
        var i = 0;
        $.each($("input[name='TeamForGroup']:checked"), function(){            
                Teams += $(this).val() + ',';
                i++;
            });
        if(i >= 1) {    
        jQuery.ajax({
                type: 'POST',
                url: "../class/class.ajaxRequest.php",
                data: {do: 'InsertSelectedTeamsInGroup', 'Teams': Teams, 'table_name': table_name, 'TournamentID': TournamentID,'GroupID': GroupID},
                success: function (result) {
                    var data = $.parseJSON(result);
                     alert_message_popup('view_group_team_relation&TournamentID=<?php echo $_REQUEST['TournamentID']; ?>',data.Message);
                }
            });
        }else{
        alert_message_popup('','Please Selected atleast one team to create.');
        }
}
</script>
