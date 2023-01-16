<?php
require_once './includes/header.php';
$Teams = $fn->GetAllAppliedTeamDataByTournament('{"TournamentID":"'.$_REQUEST['TournamentID'].'"}');
$TeamData = $Teams['GetAllAppliedTeamDataByTournament'];
?>
<br>
<center><h2>View Teams</h2></center>
<br>
<section style="min-height: 400px;">
    <div class='container'>
        <div class='row'>
            <?php foreach($TeamData as $key => $value)
            { ?>
            <div class='col-lg-4'>
                <div class='col-lg-12 TorunamentView'>
                    <br>
                    <figure class="figure">
                        <center><a href='TeamPlayers?TournamentID=<?php echo $_REQUEST['TournamentID']; ?>&TeamID=<?php echo $value['TeamID']; ?>'><img src="<?php echo $value['TeamLogoWithPath']; ?>" class="figure-img img-fluid rounded img-thumbnail TournamentImage" alt="<?php echo ucwords($value['TeamName']); ?>"></a></center>
                        <figcaption class="figure-caption text-center text-success"><b><?php echo ucwords($value['TeamName']); ?></b></figcaption>
                    </figure>
                 </div>
                </div>
           <?php }
?>
            
        </div>
        <br>
    </div>
</section>
<?php
require_once './includes/footer.php';
?>



