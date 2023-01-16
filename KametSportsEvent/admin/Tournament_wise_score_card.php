<?php
if (isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != '') {
$Tdetal = $fn->GetTournamentScoreCardDetails('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$PData = $Tdetal['ScoreCardEntries'];

$TournamentNameData = $fn->TournamentStartDateByTournamentID('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$Tournaments = $TournamentNameData['TournamentStartDateData'];
}
?>
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-7">
                <div class="page-header">
                    <h2>Tournament Wise Score Card</h2>
                    <ol class="breadcrumb">
                        <li><a href="home">Dashboard</a></li>
                        <li><a href="reports">Reports</a></li>
                        <li><a href="Tournament_wise_score_card">Tournament Wise Score Card</a></li>
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
                            $select_array = array("name" => "TournamentID", "id" => "TournamentIDToSearch", "class" => "required form-control", "onchange" => "GetTournament(this.value);");
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
            <h1>Score Card For Tournament:-> &nbsp;<span class="text-success"><?php echo $Tournaments['TournamentName']; ?></span></h1>
        </div>
        <div class='panel-body'>
            <?php if(isset($_REQUEST['TournamentID']) && $_REQUEST['TournamentID'] != ''){ ?>
            <div class="row">
                <div class="col-lg-12">
                    <a href="CreatePDF/examples/Tournament_wise_score_card_pdf.php?TournamentID=<?php echo $_REQUEST['TournamentID'] ?>" class="btn btn-sm btn-danger pull-right">Download</a>
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
                                    <th><?php echo TeamName; ?></th>
                                    <th><?php echo TotalMatchPlayed; ?></th>
                                    <th><?php echo TotalMatchWon; ?></th>
                                    <th><?php echo TotalMatchLoose; ?></th>
                                    <th><?php echo TotalMatchAbandoned; ?></th>
                                    <th><?php echo Action; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($PData) > 0) {
                                    foreach ($PData AS $Key => $Value) {
                                        ?>
                                        <tr>
                                            <td><?php echo ($Key + 1) ?></td>
                                            <td><?php echo ucwords($Value['TeamName']); ?></td>
                                            <td><?php echo $Value['TotalMatch']; ?></td>
                                            <td><?php echo $Value['MatchWinCount']; ?></td>
                                            <td><?php echo $Value['MatchLooseCount']; ?></td>
                                            <td><?php echo $Value['TotalAbandond']; ?></td>
                                            <td><a href="Team_wise_score_card&TournamentID=<?php echo $_REQUEST['TournamentID']; ?>&TeamID=<?php echo $Value['TeamID']; ?>" class="btn btn-xs btn-success">View More</a></td>
                                        </tr>
                                <?php }
                            } else { ?>
                                    <tr><td colspan="7"><center>No record Found!!</center></td></tr>
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
    function GetTournament(e)
    {
        window.location = 'Tournament_wise_score_card&TournamentID=' + e;
    }
</script>