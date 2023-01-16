<?php
require_once './includes/header.php';
$TDataNew = $fn->TournamentStartDateByTournamentID('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$TData = $TDataNew['TournamentStartDateData'];

$Tdetal = $fn->GetTournamentScoreCardDetails('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$PData = $Tdetal['ScoreCardEntries'];
?>
<br>
<div class='row'>
    <div class='col-lg-12'>
        <center><h2><?php echo ucwords($TData['TournamentName']); ?></h2></center>
    </div>
</div>
<br><br>
<section style="min-height: 400px;">
    <div class='container'>
        <div class='row'>
            <div class='col-lg-12'>
                <div class="panel panel-warning">
                    <div class="panel-heading" style='padding: 10px 15px;'><h4 class='text-warning' style='font-weight: bold;'>Tournament ScoreCard</h4></div>
                    <div class="panel-body">
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
                                        if(count($PData) > 0){
                                        foreach ($PData AS $Key => $Value) { ?>
                                            <tr>
                                                <td><?php echo ($Key + 1) ?></td>
                                                <td><?php echo ucwords($Value['TeamName']); ?></td>
                                                <td><?php echo $Value['TotalMatch']; ?></td>
                                                <td><?php echo $Value['MatchWinCount']; ?></td>
                                                <td><?php echo $Value['MatchLooseCount']; ?></td>
                                                <td><?php echo $Value['TotalAbandond']; ?></td>
                                                <td><a href="ViewScoreTeamWise?TournamentID=<?php echo $_REQUEST['TournamentID']; ?>&TeamID=<?php echo $Value['TeamID']; ?>" class="btn btn-xs btn-success">View More</a></td>
                                            </tr>
                                        <?php } }else { ?>
                                            <tr><td colspan="7"><center>No record Found!!</center></td></tr>
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



