<?php
if ((isset($_REQUEST['TeamID']) && $_REQUEST['TeamID'] != '') && (isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != '')) {
$TDataNew = $fn->GetTournamentScoreCardDetailsByTeam('{"TournamentID":"' . $_REQUEST['TournamentID'] . '","TeamID":"' . $_REQUEST['TeamID'] . '"}');
$PData = $TDataNew['ScoreCardEntriesByTeam'];
    
$TournamentNameData = $fn->TournamentStartDateByTournamentID('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$Tournaments = $TournamentNameData['TournamentStartDateData'];
$Tdetal = $fn->DataByID('{"Condition":{"table":"v_teams","Key":"TeamID","value":"'.$_REQUEST['TeamID'].'"}}');
$Tdetails = $Tdetal['GetData'];
}
?>
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-5">
                <div class="page-header">
                    <h2>Team Wise Score Card</h2>
                    <ol class="breadcrumb">
                        <li><a href="home">Dashboard</a></li>
                        <li><a href="reports">Reports</a></li>
                        <li><a href="Team_wise_score_card">Team Wise Score Card</a></li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-7"><br><br>
                <div class='panel-header'>
                    <div class="col-lg-6">
                        <div class="col-lg-5" style="padding-right: 1px;padding-top:5px;">
                            <label for="TournamentName" class="control-label" style="font-weight: 700;"><?php echo SelectTournament; ?> </label>
                        </div>
                        <div class="col-lg-7">
                            <?php
                            $Selected = isset($_REQUEST['TournamentID']) ? $_REQUEST['TournamentID'] : '';
                            $db_array = array("tbl_name" => 'v_tournaments', "condition" => "is_active='Y'");
                            $select_array = array("name" => "TournamentID", "id" => "TournamentIDToSearch", "class" => "required form-control","onchange" => 'GetApprovedTeams(this.value,"TeamIDToSearch")');
                            $option_array = array("value" => "TournamentID", "label" => "TournamentName", "placeholder" => "Search Tournament", 'selected' => $Selected);
                            $fn->dropdown($db_array, $select_array, $option_array);
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="col-lg-5" style="padding-right: 1px;padding-top:5px;">
                            <label for="TeamName" class="control-label" style="font-weight: 700;">Select Team</label>
                        </div>
                        <div class="col-lg-7">
                            <select name="TeamID" id="TeamIDToSearch" class="required form-control">
                                <option value="">Select Team</option> 
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <button class="btn btn-sm btn-primary" onclick="GetScoreCardByTournamentAndTeam('TournamentIDToSearch', 'TeamIDToSearch');">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <h1>Score Card For:-> &nbsp;<span class="text-success"><?php echo $Tdetails['TeamName']; ?></span> &nbsp; IN &nbsp;&nbsp; <span class="text-success"><?php echo $Tournaments['TournamentName']; ?></span></h1>
        </div>
        <div class='panel-body'>
            <?php if(isset($_REQUEST['TeamID']) && $_REQUEST['TeamID'] != ''){ ?>
            <div class="row">
                <div class="col-lg-12">
                    <a href="CreatePDF/examples/Team_wise_score_card_pdf.php?TournamentID=<?php echo $_REQUEST['TournamentID'] ?>&TeamID=<?php echo $_REQUEST['TeamID']; ?>" class="btn btn-sm btn-danger pull-right">Download</a>
                </div>
            </div>
            <br>
            <?php } ?>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed table-bordered table-hover display">
                            <thead>
                                <tr>
                                    <th style="width: 8%"><?php echo SrNo; ?></th>
                                    <th><?php echo MatchDate; ?></th>
                                    <th><?php echo MatchWith; ?></th>
                                    <th><?php echo NumberOfSetsWin; ?></th>
                                    <th><?php echo NumberOfSetsLoose; ?></th>
                                    <th><?php echo MatchResult; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($PData) > 0) {
                                    foreach ($PData AS $Key => $Value) { ?>
                                        <tr>
                                            <td><?php echo ($Key + 1) ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($Value['MatchDate'])); ?></td>
                                            <td><?php echo $Value['TeamWith']; ?></td>
                                            <td><?php echo $Value['SetWin']; ?></td>
                                            <td><?php echo $Value['SetLoss']; ?></td>
                                            <td><?php if ($Value['WinLos'] == 'Win') { ?><span class="text-success">Win</span><?php } else { ?><span style="color:red;">Loss</span><?php } ?></td>
                                        </tr>
                                    <?php
                                    }
                                } else { ?>
                                    <tr><td colspan="6"><center>No record Found!!</center></td></tr>
<?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
<script>
<?php if(isset($_REQUEST['TeamID'])){ ?>
 $(document).ready(function()
 {
   jQuery.ajax({
            type: 'POST',
            url: "ajax/status.php",
            data: {"do":"GetApprovedTeamsByTournament","TournamentID":"<?php echo $_REQUEST['TournamentID'] ?>"},
            success: function (result) {
                $('#TeamIDToSearch').html(result);
                $('#TeamIDToSearch').select2('val','<?php echo $_REQUEST['TeamID'] ?>');
            }
        });  
 });
<?php } ?>
    function GetScoreCardByTournamentAndTeam(TournamentIDID, TeamIDID)
    {
        var TournamentID = $('#' + TournamentIDID).val();
        var TeamID = $('#' + TeamIDID).val();
        if (TournamentID != '' && TeamID != '') {
            window.location = 'Team_wise_score_card&TournamentID=' + TournamentID + '&TeamID=' + TeamID;
        } else {
            alert_message_popup('', 'Please Select Tournament And Team');
        }
    }
    
    function GetApprovedTeams(e,TeamIDID)
    {
        jQuery.ajax({
            type: 'POST',
            url: "ajax/status.php",
            data: {"do":"GetApprovedTeamsByTournament","TournamentID":e},
            success: function (result) {
                $('#'+TeamIDID).html(result);
                $('#'+TeamIDID).select2('val','');
            }
        });
    }
</script>