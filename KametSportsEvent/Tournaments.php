<?php require_once './includes/header.php'; ?>
<br>
<div class="col-lg-12">
    <div class="col-lg-7">
       <h2 class="pull-right">Kamet Tournaments</h2> 
    </div>
    <div class="col-lg-5">
        <a href="Tournaments?Type=upcoming" class="btn btn-sm btn-danger btn-labeled text-uppercase waves pull-right waves-effect waves-float" style="margin-top: 7px;margin-left: 10px;margin-right: 10px;padding: 5px 10px !important;">Upcoming</a> 
        <a href="Tournaments?Type=all" class="btn btn-sm btn-success btn-labeled text-uppercase waves pull-right waves-effect waves-float" style="margin-top: 7px;padding: 5px 10px !important;">All</a> 
    </div>
</div>
<br><br><br>
<section class="ReportSection">
    <div class='container'>
        <div class='row'>
            <?php if(count($TournamentDataFront) > 0){
            foreach($TournamentDataFront as $key => $value)
            { ?>
            <div class='col-lg-4'>
                <div class='col-lg-12 TorunamentView'><br>
                    <figure class="figure">
                        <center><a href='TournamentDetails?TournamentID=<?php echo $value['TournamentID']; ?>'><img src="<?php echo $value['TournamentImage']; ?>" class="figure-img img-fluid rounded img-thumbnail TournamentImage" alt="<?php echo ucwords($value['TournamentName']); ?>"></a></center>
                        <figcaption class="figure-caption text-center text-success"><b><?php echo ucwords($value['TournamentName']); ?></b></figcaption>
                    </figure>
                </div>
            </div>
            <?php } } else { ?>
            <br><center><h3 class="text-danger">No Tournament Found!</h3></center> <?php
            } ?>
        </div>
        <br>
    </div>
</section>
<?php
require_once './includes/footer.php'; ?>



