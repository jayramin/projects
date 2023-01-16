<?php
require_once './includes/header.php';
$UserDataQuery = $fn->GetPlayerProfileByPlayerID('{"PlayerID":"'.$_REQUEST['PlayerID'].'"}');
$UserDataRes = $UserDataQuery['PlayerProfileByPlayerID'];
?>
<br>
<div class='row'>
    <div class='col-lg-12'>
        <center><h2><?php echo ucwords($UserDataRes['PlayerName']); ?></h2></center>
    </div>
</div>
<br><br>
<section>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-5'>
                <figure class="figure">
                    <img src="<?php echo $UserDataRes['ProfilePicture']; ?>" class="figure-img img-fluid rounded img-thumbnail TournamentDetailTile" alt="<?php echo ucwords($UserDataRes['PlayerName']); ?>">
                    <figcaption class="figure-caption text-success" style="font-size: 16px;"><b><?php echo ucwords($UserDataRes['PlayerName']); ?></b></figcaption>
                </figure>
            </div>
            <div class='col-lg-1'></div>
            <div class='col-lg-6'>
                <div class="panel panel-warning">
                    <div class="panel-heading" style='padding: 10px 15px;'><h4 class='text-warning' style='font-weight: bold;'>Player Details</h4></div>
                <div class='panel-body'>
                <h4 class='text-warning DesignH4Text'>Player Name:</h4>   <br>
                <div class='col-lg-12'>
                    <span><?php echo $UserDataRes['PlayerName']; ?> <?php if($UserDataRes['CaptainshipStatus'] == 'Y'){ ?> <span class="text-success"> <b>(Captain)</b> </span><?php } ?></span>
                </div>
                <hr>
                <h4 class='text-warning DesignH4Text'>Date Of Birth:</h4><br>
                <div class='col-lg-12'>
                    <span><?php echo date('d-m-Y',strtotime($UserDataRes['DOB'])); ?></span>
                </div>
                <hr>
                <h4 class='text-warning DesignH4Text'>Physical Details:</h4><br>
                <div class='col-lg-12'>
                    <span>Height:&nbsp;<?php echo $UserDataRes['Height']; ?></span><br>
                    <span>Weight:&nbsp;<?php echo $UserDataRes['Weight']; ?>&nbsp;KG</span><br>
                    <span>Body Type:&nbsp;<?php echo $UserDataRes['BodyType']; ?></span>
                </div>
                <hr>
                <h4 class='text-warning DesignH4Text'>Favorite Position In Ground:</h4><br>
                <div class='col-lg-12'>
                    <span><?php echo $UserDataRes['FavoritePosition']; ?></span>
                </div>
                <hr>
                <h4 class='text-warning DesignH4Text'>Player Location:</h4><br>
                <div class='col-lg-12'>
                    <span>State:&nbsp;<?php echo $UserDataRes['StateName']; ?></span><br>
                    <span>City:&nbsp;<?php echo $UserDataRes['CityName']; ?></span>
                </div>
                <hr>
                
                </div>
                </div>
            </div>
        </div>
        <?php if($UserDataRes['AboutMe']!= ''){ ?>
        <div class='row'>
            <div class='col-lg-12'>
                <div class="panel panel-warning">
                    <div class="panel-heading" style='padding: 10px 15px;'><h4 class='text-warning' style='font-weight: bold;'>About Player</h4></div>
                    <div class="panel-body"><?php echo $UserDataRes['AboutMe']; ?></div>
                </div>
            
            </div>
        </div>
        <?php } ?>
        <br>
    </div>
</section>
<?php
require_once './includes/footer.php';
?>





