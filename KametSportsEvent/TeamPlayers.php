<?php
require_once './includes/header.php';
$TDataNew = $fn->GetAllAppliedTournamentTeamPlayersData('{"TournamentID":"'.$_REQUEST['TournamentID'].'","TeamID":"'.$_REQUEST['TeamID'].'"}');
$PData = $TDataNew['GetAppliedTeamPlayersData'];
$Tdetal = $fn->DataByID('{"Condition":{"table":"v_teams","Key":"TeamID","value":"'.$_REQUEST['TeamID'].'"}}');
$Tdetails = $Tdetal['GetData'];
?>
<br>
<div class='row'>
    <div class='col-lg-12'>
        <center><h2><?php echo ucwords($Tdetails['TeamName']); ?></h2></center>
    </div>
</div>
<br><br>
<section>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-5'>
                <figure class="figure">
                    <img src="admin/uploads/TeamLogo/<?php if($Tdetails['TeamLogo'] != ''){ echo $Tdetails['TeamLogo']; } else { echo 'team-placeholder.jpg';} ?>" class="figure-img img-fluid rounded img-thumbnail TournamentImage" alt="<?php echo ucwords($Tdetails['TeamName']); ?>">
                    <figcaption class="figure-caption text-success" style="font-size: 16px;"><b><?php echo ucwords($Tdetails['TeamName']); ?></b></figcaption>
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
                    <div class="panel-heading" style='padding: 10px 15px;'><h4 class='text-warning' style='font-weight: bold;'>Team Members</h4></div>
                    <div class="panel-body">
                        <div class="row">
                            <?php foreach ($PData AS $Key => $Value) { ?>
                            <div class="col-lg-3">
                                <figure class="figure">
                                    <a href='PlayerProfile?PlayerID=<?php echo $Value['PlayerID']; ?>'><img src="<?php echo $Value['ProfilePicWithPath']; ?>" class="figure-img img-fluid rounded img-thumbnail TournamentImage" alt="<?php echo ucwords($Value['PlayerName']); ?>"></a>
                                    <figcaption class="figure-caption text-success"><b><?php echo ucwords($Value['PlayerName']); ?>&nbsp;&nbsp;<?php if($Value['CaptainshipStatus'] == 'Y'){ ?> <span class="text-danger"><b>(Captain)</b></span><?php } ?></b></figcaption>
                                </figure>   
                            </div>
                            <?php } ?>
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



