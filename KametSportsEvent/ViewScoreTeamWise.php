<?php
require_once './includes/header.php';
$TDataNew = $fn->GetTournamentScoreCardDetailsByTeam('{"TournamentID":"'.$_REQUEST['TournamentID'].'","TeamID":"'.$_REQUEST['TeamID'].'"}');
$PData = $TDataNew['ScoreCardEntriesByTeam'];

$TDataQuery = $fn->TournamentStartDateByTournamentID('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$TData = $TDataQuery['TournamentStartDateData'];

$Tdetal = $fn->TeamDetailsByTeamID('{"TeamID":"'.$_REQUEST['TeamID'].'"}');
$Tdetails = $Tdetal['TeamDetailsByTeamID'];
?>
<br>
<div class='row'>
    <div class='col-lg-12'>
        <center><h2><?php echo ucwords($Tdetails['TeamName']); ?> - <font color="green"><?php echo ucwords($TData['TournamentName']); ?></font></h2></center>
    </div>
</div>
<br><br>
<section>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-5'>
                <figure class="figure">
                    <img src="<?php echo $Tdetails['TeamLogo']; ?>" class="figure-img img-fluid rounded img-thumbnail TournamentImage" alt="<?php echo ucwords($Tdetails['TeamName']); ?>">
                    <figcaption class="figure-caption text-success"><?php echo ucwords($Tdetails['TeamName']); ?></figcaption>
                </figure>
            </div>
            <div class='col-lg-1'></div>
            <div class='col-lg-6'>
                <div class="panel panel-warning">
                    <div class="panel-heading" style='padding: 10px 15px;'><h4 class='text-warning' style='font-weight: bold;'>Team Details</h4></div>
                    <div class='panel-body'>
                        <h4 class='text-warning DesignH4Text'>Team Slogan:</h4>   <br>
                        <div class='col-lg-12'>
                            <span><?php echo $Tdetails['TeamSlogan']; ?></span>
                        </div>
                        <hr>
                        <h4 class='text-warning DesignH4Text'>Team Description:</h4><br>
                        <div class='col-lg-12'>
                            <span><?php echo $Tdetails['TeamDescription']; ?></span>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class='col-lg-12'>
                <div class="panel panel-warning">
                    <div class="panel-heading" style='padding: 10px 15px;'><h4 class='text-warning' style='font-weight: bold;'>Tournament Wise Team ScoreCard</h4></div>
                    <div class="panel-body">
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
                                        foreach ($PData AS $Key => $Value) {
                                            ?>
                                            <tr >
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($Value['MatchDate'])); ?></td>
                                                <td><a href="<?php echo SITE_URL ?>TeamPlayers?TournamentID=<?php echo $_REQUEST['TournamentID']; ?>&TeamID=<?php echo $Value['TeamWithID']; ?>"><?php echo $Value['TeamWith']; ?></a></td>
                                                <td><?php echo $Value['SetWin']; ?></td>
                                                <td><?php echo $Value['SetLoss']; ?></td>
                                                <td><?php if ($Value['WinLos'] == 'Win') { ?><span class="text-success">Win</span><?php } else { ?><span style="color:red;">Loss</span><?php } ?></td>
                                            </tr>
                                    <?php }
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
        <br>
    </div>
</section>
<?php
require_once './includes/footer.php';
?>



