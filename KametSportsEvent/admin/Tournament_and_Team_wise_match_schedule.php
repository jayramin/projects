<?php
if((isset($_REQUEST['TeamID']) && $_REQUEST['TeamID'] != '') && (isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != '')){
$MatchScheduleData = $fn->GetMatchScheduleByTeamAndTournamentID('{"TournamentID":"'.$_REQUEST['TournamentID'].'","TeamID":"'.$_REQUEST['TeamID'].'"}');
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
                    <h2>Team Wise Scheduled Matches</h2>
                    <ol class="breadcrumb">
                        <li><a href="home">Dashboard</a></li>
                        <li><a href="reports">Reports</a></li>
                        <li><a href="Tournament_and_Team_wise_match_schedule">Team Wise Scheduled Matches</a></li>
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
                        <button class="btn btn-sm btn-primary" onclick="GetTeamsByTournament('TournamentIDToSearch','TeamIDToSearch');">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <h1>Scheduled Matches For:-> &nbsp;<span class="text-success"><?php echo $Tdetails['TeamName']; ?></span> &nbsp; IN &nbsp;&nbsp; <span class="text-success"><?php echo $Tournaments['TournamentName']; ?></span></h1>
        </div>
        <div class='panel-body'>
            <?php if(isset($_REQUEST['TeamID']) && $_REQUEST['TeamID'] != ''){ ?>
            <div class="row">
                <div class="col-lg-12">
                    <a href="CreatePDF/examples/Tournament_and_Team_wise_match_schedule_pdf.php?TournamentID=<?php echo $_REQUEST['TournamentID'] ?>&TeamID=<?php echo $_REQUEST['TeamID']; ?>" class="btn btn-sm btn-danger pull-right">Download</a>
                </div>
            </div>
            <br>
            <?php } ?>
             <div class="row">
                <div class="col-lg-12">            
                    <?php
                        if (is_array($MatchScheduleData['GetMatchScheduleByTeamAndTournamentID']) && !empty($MatchScheduleData['GetMatchScheduleByTeamAndTournamentID'])) { ?>
                            <div class="table-responsive" style="overflow-x: hidden;">
                                <table id="datatable" class="display">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%"><?php echo SrNo; ?></th>
                                            <th><center><?php echo MatchSchedule; ?></center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($MatchScheduleData['GetMatchScheduleByTeamAndTournamentID'] AS $Key => $Value) { ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="col-lg-3"></div>
                                                            <div class="col-lg-1">
                                                                <img src="<?php echo $Value['FirstTeamLogo']?>" class="img-circle" height="80px" width="80px">
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <center><label><b><h2><?php echo $Value['FirstName'] ?></h2></b></label><span> VS </span><label><b><h2><?php echo $Value['SecondName'] ?></h2></b></label><br>
                                                                            <b>Match Date :</b> <span><?php echo $Value['MatchDate'] ?> </span>
                                                                            <b>Start Time :</b> <span><?php echo $Value['MatchStartTime'] ?> </span><br>
                                                                            <b>Ground :</b> <span><?php echo $Value['GroundName'] ?> </span>
                                                                            <b>Court :</b> <span><?php echo $Value['CourtName'] ?> </span>
                                                                        </center>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <img src="<?php echo $Value['SecondTeamLogo']?>" class="img-circle" height="80px" width="80px">
                                                            </div>
                                                            <div class="col-lg-2"></div>
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

function GetTeamsByTournament(TournamentIDID, TeamIDID)
{
    var TournamentID = $('#'+TournamentIDID).val();
    var TeamID = $('#'+TeamIDID).val();
    if(TournamentID != '' && TeamID != ''){
    window.location = 'Tournament_and_Team_wise_match_schedule&TournamentID='+TournamentID+'&TeamID='+TeamID;
    }else{
    alert_message_popup('','Please Select Tournament And Team');
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