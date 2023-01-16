<?php
if(isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != ''){
$data = $fn->GetAllTournamentTeamData('{"Flag":"TeamData","TournamentID":"'.$_REQUEST['TournamentID'].'"}');

$TournamentNameData = $fn->TournamentStartDateByTournamentID('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$Tournaments = $TournamentNameData['TournamentStartDateData'];
}
?>
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-7">
                <div class="page-header">
                    <h2>Tournament Wise Approved Teams</h2>
                    <ol class="breadcrumb">
                        <li><a href="home">Dashboard</a></li>
                        <li><a href="reports">Reports</a></li>
                        <li><a href="Tournament_wise_approved_teams">Tournament Wise Approved Teams</a></li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-5"><br><br>
                <div class='panel-header'>
                    <div class="col-lg-12">
                        <div class="col-lg-5" style="padding-right: 1px;padding-top:5px;">
                            <label for="TournamentName" class="control-label" style="font-weight: 700;"><?php echo SelectTournament; ?> </label>
                        </div>
                        <div class="col-lg-7">
                            <?php
                            $Selected = isset($_REQUEST['TournamentID']) ? $_REQUEST['TournamentID'] : '';
                            $db_array = array("tbl_name" => 'v_tournaments', "condition" => "is_active='Y'");
                            $select_array = array("name" => "TournamentID", "id" => "TournamentID", "class" => "required form-control", "onchange" => "GetTeamList(this.value);");
                            $option_array = array("value" => "TournamentID", "label" => "TournamentName", "placeholder" => "Search Tournament", 'selected' => $Selected);
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
            <h1>Approved Teams For Tournament:-> &nbsp;<span class="text-success"><?php echo ucwords($Tournaments['TournamentName']); ?></span></h1>
        </div>
        <div class='panel-body'>
            <?php if(isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != ''){ ?>
            <div class="row">
                <div class="col-lg-12">
                    <a href="CreatePDF/examples/Tournament_wise_approved_teams.php?TournamentID=<?php echo $_REQUEST['TournamentID']; ?>" class="btn btn-sm btn-danger pull-right">Download</a>
                </div>
            </div>
            <br>
            <?php } ?>
            <div class="row">
                <div class="col-lg-12">
                    <?php if (is_array($data) && !empty($data)) { ?>
                        <div class="table-responsive">
                            <table id="datatable" class="display">
                                <thead>
                                    <tr>
                                        <th><?php echo SrNo; ?></th>
                                        <th><?php echo TeamName; ?></th>
                                        <th><?php echo TournamentName; ?></th>
                                        <th><?php echo MaximumPlayers; ?></th>
                                        <th><?php echo MinimumPlayers; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($data['GetTournamentTeamData'] AS $Key => $Value) {
                                        $TeamData = $fn->GetAprrovalTeamData('{"TeamTournamentRelationID":"' . $Value['TeamTournamentRelationID'] . '","TournamentID":"' . $Value['TournamentID'] . '","TeamID":"' . $Value['TeamID'] . '"}');
                                        if ($TeamData['GetTournamentAprrovalWiseData']['AdminStatusCount'] >= $Value['MinimumPlayers']) {
                                            ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo $Value['TeamName']; ?></td>
                                                <td><?php echo $Value['TournamentName']; ?></td>
                                                <td><?php echo $Value['MaximumPlayers']; ?></td>
                                                <td><?php echo $Value['MinimumPlayers']; ?></td>
                                            </tr>
                                        <?php }
                                    }
                                    ?>                                    
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
function GetTeamList(e)
{
    window.location = 'Tournament_wise_approved_teams&TournamentID='+e;
}
</script>