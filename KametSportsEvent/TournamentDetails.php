<?php
require_once './includes/header.php';
$TDataNew = $fn->TournamentStartDateByTournamentID('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$TData = $TDataNew['TournamentStartDateData'];
// Check Teams Available Or Not
$Teams = $fn->GetAllAppliedTeamDataByTournament('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$TeamData = $Teams['GetAllAppliedTeamDataByTournament'];
// Check Score Card Available Or Not
$Tdetal = $fn->GetTournamentScoreCardDetails('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$PData = $Tdetal['ScoreCardEntries'];
?>
<br>
<div class='row'>
    <div class='col-lg-12'>
        <div class='col-lg-7'>
            <h2 class='pull-right'><?php echo ucwords($TData['TournamentName']); ?></h2>   
        </div>
        <div class='col-lg-5'>
            <div class='col-lg-3'></div>
            <div class='col-lg-3'>
                <?php if(count($TeamData) > 0){ ?>
                <a href='ViewTeams?TournamentID=<?php echo $_REQUEST['TournamentID']; ?>' class='btn btn-sm btn-primary pull-right'>VIEW TEAMS</a>  <?php } ?>
            </div>
            <div class='col-lg-1'></div>
            <div class='col-lg-3'>
                <?php if(count($PData) > 0){ ?>
                <a href='ViewScoreCard?TournamentID=<?php echo $_REQUEST['TournamentID']; ?>' class='btn btn-sm btn-primary pull-right'>VIEW SCORECARD</a>  <?php } ?>
            </div>
            <div class='col-lg-2'></div>
            
        </div>
    </div>
</div>
<br><br>
<section class="ReportSection">
    <div class='container'>
        <div class='row'>
            <div class='col-lg-5'>
                <figure class="figure">
                    <img src="<?php echo $TData['TournamentImage']; ?>" class="figure-img img-fluid rounded img-thumbnail" alt="<?php echo ucwords($TData['TournamentName']); ?>">
                    <figcaption class="figure-caption text-success" style="font-size: 16px;"><b><?php echo ucwords($TData['TournamentName']); ?></b></figcaption>
                </figure>
            </div>
            <div class='col-lg-1'></div>
            <div class='col-lg-6'>
                <div class="panel panel-warning">
                    <div class="panel-heading" style='padding: 10px 15px;'><h4 class='text-warning' style='font-weight: bold;'>Tournament Details</h4></div>
                <div class='panel-body'>
                <h4 class='text-warning DesignH4Text'>Tournament:</h4>   <br>
                <div class='col-lg-12'>
                    <div class='col-lg-4'>
                        <label>Start Date:</label>   
                    </div>
                    <div class='col-lg-8'>
                        <span><?php echo date('d-m-Y',strtotime($TData['StartDate'])); ?></span>
                    </div>
                </div>
                
                <div class='col-lg-12'>
                    <div class='col-lg-4'>
                        <label>End Date:</label>   
                    </div>
                    <div class='col-lg-8'>
                        <span><?php echo date('d-m-Y',strtotime($TData['EndDate'])); ?></span>
                    </div>
                </div>
                <hr>
                <h4 class='text-warning DesignH4Text'>Registration:</h4><br>
                <div class='col-lg-12'>
                    <div class='col-lg-4'>
                        <label>Start Date:</label>   
                    </div>
                    <div class='col-lg-8'>
                        <span><?php echo date('d-m-Y',strtotime($TData['RegistrationStartDate'])); ?></span>
                    </div>
                </div>
                
                <div class='col-lg-12'>
                    <div class='col-lg-4'>
                        <label>End Date:</label>   
                    </div>
                    <div class='col-lg-8'>
                        <span><?php echo date('d-m-Y',strtotime($TData['RegistrationEndDate'])); ?></span>
                    </div>
                </div>
                <hr>
                <h4 class='text-warning DesignH4Text'>Player:</h4><br>
                <div class='col-lg-12'>
                    <div class='col-lg-4'>
                        <label>Minimum Players:</label>   
                    </div>
                    <div class='col-lg-8'>
                        <span><?php echo $TData['MinimumPlayers']; ?></span>
                    </div>
                </div>
                
                <div class='col-lg-12'>
                    <div class='col-lg-4'>
                        <label>Maximum Players:</label>   
                    </div>
                    <div class='col-lg-8'>
                        <span><?php echo $TData['MaximumPlayers']; ?></span>
                    </div>
                </div>
                <hr>
                <h4 class='text-warning' style='font-weight: bold;text-decoration: underline;'>Prize:</h4><br>
                <div class='col-lg-12'>
                    <div class='col-lg-4'>
                        <label>Winner:</label>   
                    </div>
                    <div class='col-lg-8'>
                        <span><?php echo $TData['WinnerPrize']; ?></span>
                    </div>
                </div>
                
                <div class='col-lg-12'>
                    <div class='col-lg-4'>
                        <label>Runner Up:</label>   
                    </div>
                    <div class='col-lg-8'>
                        <span><?php echo $TData['RunnerUpsPrize']; ?></span>
                    </div>
                </div>
                
                <div class='col-lg-12'>
                    <div class='col-lg-4'>
                        <label>2nd Runner Up:</label>   
                    </div>
                    <div class='col-lg-8'>
                        <span><?php echo $TData['SecondRunnerUpsPrize']; ?></span>
                    </div>
                </div>
                <hr>
                <h4 class='text-warning DesignH4Text'>Others:</h4><br>
                <div class='col-lg-12'>
                    <div class='col-lg-4'>
                        <label>Tournament For:</label>   
                    </div>
                    <div class='col-lg-8'>
                        <span><?php echo $TData['TournamentFor']; ?></span>
                    </div>
                </div>
                
                <div class='col-lg-12'>
                    <div class='col-lg-4'>
                        <label>Fees:</label>   
                    </div>
                    <div class='col-lg-8'>
                        <span><?php echo $TData['RegistrationFees']; ?></span>
                    </div>
                </div>
                
                <div class='col-lg-12'>
                    <div class='col-lg-4'>
                        <label>City:</label>   
                    </div>
                    <div class='col-lg-8'>
                        <span><?php echo $TData['CityName']; ?></span>
                    </div>
                </div>
                
                <div class='col-lg-12'>
                    <div class='col-lg-4'>
                        <label>State:</label>   
                    </div>
                    <div class='col-lg-8'>
                        <span><?php echo $TData['StateName']; ?></span>
                    </div>
                </div>
                </div>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class='col-lg-12'>
                <div class="panel panel-warning">
                    <div class="panel-heading" style='padding: 10px 15px;'><h4 class='text-warning' style='font-weight: bold;'>Tournament Description</h4></div>
                    <div class="panel-body"><?php echo $TData['Description']; ?></div>
                </div>
            
            </div>
        </div>
        <br>
    </div>
</section>
<?php
require_once './includes/footer.php';
?>



