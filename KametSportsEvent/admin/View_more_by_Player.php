<?php
if (isset($_REQUEST['PlayerID']) && $_REQUEST['PlayerID'] != '') {
    $Total = $fn->GetPlayerTotalCareerByPlayerID('{"PlayerID":"' . $_REQUEST['PlayerID'] . '"}');
    $TeamWise = $fn->GetPlayerCareerTeamWiseByPlayerID('{"PlayerID":"' . $_REQUEST['PlayerID'] . '"}');
    $User = $fn->PlayerDetailsByPlayer('{"PlayerID":"' . $_REQUEST['PlayerID'] . '"}');
}
?>
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-7">
                <div class="page-header">
                    <h2>Player List</h2>
                    <ol class="breadcrumb">
                        <li><a href="home">Dashboard</a></li>
                        <li><a href="reports">Reports</a></li>
                        <li><a href="player_list">Player List</a></li>
                        <li><a href="View_more_by_Player&PlayerID=<?php echo $_REQUEST['PlayerID'] ?>">Player Career</a></li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-5"><br><br>
                <div class='panel-header'>
                    <a href="player_list" class="btn btn-sm btn-success pull-right">Back</a>  
                </div>
            </div>
        </div>
    </div>
    <div class='content-box big-box box-shadow panel-box panel-gray'>
        <div class='panel-header'>
            <h1>Career Details Of :-> &nbsp;<span class="text-success"><?php echo $User['UserDetailsDataByUserID']['PlayerName']; ?></span></h1>
        </div>
        <div class='panel-body'>
            <?php if (isset($_REQUEST['PlayerID']) && $_REQUEST['PlayerID'] != '') { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="CreatePDF/examples/View_more_player_details_pdf.php?PlayerID=<?php echo $_REQUEST['PlayerID'] ?>" class="btn btn-sm btn-danger pull-right">Download</a>
                    </div>
                </div>
                <br>
            <?php } ?>
            <div class='row'>
                <h3 class="text-success">Total Career</h3>
                <div class='col-lg-12'>
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed table-bordered table-hover display">
                            <thead>
                                <tr>
                                    <th><?php echo SrNo; ?></th>
                                    <th>Total Matches</th>
                                    <th>Matches Played</th>
                                    <th>Abandoned Matches</th>
                                    <th>No Of Times Player Of The Match</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($Total['PlayerTotalCareerByPlayerID']) > 0) { ?>
                                        <tr>
                                            <td>1</td>
                                            <td><?php echo $Total['PlayerTotalCareerByPlayerID']['TotalMatch']; ?></td>
                                            <td><?php echo $Total['PlayerTotalCareerByPlayerID']['Played']; ?></td>
                                            <td><?php echo $Total['PlayerTotalCareerByPlayerID']['Abandoned']; ?></td>
                                            <td><?php echo $Total['PlayerTotalCareerByPlayerID']['PlayerofthMatch']; ?></td>
                                        </tr>
                                    <?php
                                    } else { ?>
                                    <tr><td colspan="5"><center>No record Found!!</center></td></tr>
<?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br><br><br><br>
                <h3 class="text-danger">Total Career Team Wise</h3>
                <div class='col-lg-12'>
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed table-bordered table-hover display">
                            <thead>
                                <tr>
                                    <th><?php echo SrNo; ?></th>
                                    <th>Team Name</th>
                                    <th>Total Match Win</th>
                                    <th>Total Match Lose</th>
                                    <th>Total Match Abandoned</th>
                                    <th>No Of Times Player Of The Match</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($TeamWise['PlayerCareerTeamWiseByPlayerID']) > 0) {
                                    foreach ($TeamWise['PlayerCareerTeamWiseByPlayerID'] AS $Key => $Value) { ?>
                                        <tr>
                                            <td><?php echo ($Key + 1) ?></td>
                                            <td><?php echo $Value['TeamName']; ?></td>
                                            <td><?php if($Value['MatchWin'] != ''){ echo $Value['MatchWin']; } else { echo 0; } ?></td>
                                            <td><?php if($Value['MatchLoss'] != ''){ echo $Value['MatchLoss']; } else { echo 0; } ?></td>
                                            <td><?php if($Value['AbandonedCount'] != ''){ echo $Value['AbandonedCount']; } else { echo 0; } ?></td>
                                            <td><?php if($Value['PlayerOfTheMatch'] != ''){ echo $Value['PlayerOfTheMatch'];}else{ echo 0; } ?></td>
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
