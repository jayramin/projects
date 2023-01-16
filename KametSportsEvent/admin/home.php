<?php
$RoleID = $_SESSION['KametSports']['session']['RoleID'];
$UserID = $_SESSION['KametSports']['session']['UserID'];

if ($RoleID != 1) {
    $CaptainData = $fn->MyCaptainData('{"UserID":"' . $UserID . '"}');
    $CaptainShipStatus = $CaptainData['GetMyCaptainWiseData']['CaptainshipStatus'];
    $datacall = $fn->GetAllTeamData('{"UserID":"' . $UserID . '"}');
    
    $data = $fn->GetAllNotification('{"UserID":"' . $UserID . '","RoleID":"' . $RoleID . '","CaptainShipStatus":"' . $CaptainShipStatus . '"}');
    
    // Check Eligiblity To Pay Amount to captain
    $CheckData = $fn->CheckEligiblityToPay('{"TeamID":"'.$datacall['GetTeamWiseData']['TeamID'].'"}');
}


?>

<!--Content-->
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h2>Dashboard</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <?php
        if ($RoleID == '1') {
            $dataForUpdateTournamentIsactive = $fn->UpdateTournamnetIsActive();
            ?>
            <div class="col-sm-4 col-lg-3">
                <a href="view_location" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                            <div class="w-content big-box">
                                <div class="w-progress glyphicon glyphicon-map-marker IconFontSize">
                                    <h4 class="text-center TileClass">Location Master</h4>
                                </div>
                            </div>
                        </center>
                    </div>
                </a>   
            </div>
            <div class="col-sm-4 col-lg-3">
                <a href="view_cms" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                            <div class="w-content big-box">
                                <div class="w-progress glyphicon glyphicon-list-alt IconFontSize">
                                    <h4 class="text-center TileClass">CMS</h4>
                                </div>
                            </div>
                        </center>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-lg-3">
                <a href="view_attack" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                            <div class="w-content big-box">
                                <div class="w-progress glyphicon glyphicon-screenshot IconFontSize">
                                    <h4 class="text-center TileClass">Attacks</h4>
                                </div>
                            </div>
                        </center>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-lg-3">
                <a href="view_users" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                            <div class="w-content big-box">
                                <div class="w-progress glyphicon glyphicon-user IconFontSize">
                                    <h4 class="text-center TileClass">Users</h4>
                                </div>
                            </div>
                        </center>>
                    </div>
                </a>
            </div>

            <div class="col-sm-4 col-lg-3">
                <a href="Tournament_Management" class="text-uppercase w-name nounderline ">
                    <div class="content-box ultra-widget B">
                        <center>
                            <div class="w-content big-box">
                                <div class="w-progress glyphicon glyphicon-tasks IconFontSize">
                                    <h4 class="text-center TileClass">Tournament Management</h4>
                                </div>
                            </div>
                        </center>
                    </div>
                </a>
            </div>
        
        <div class="col-sm-4 col-lg-3">
                <a href="reports" class="text-uppercase w-name nounderline ">
                    <div class="content-box ultra-widget B">
                        <center>
                            <div class="w-content big-box">
                                <div class="w-progress glyphicon glyphicon-tasks IconFontSize">
                                    <h4 class="text-center TileClass">Reports</h4>
                                </div>
                            </div>
                        </center>
                    </div>
                </a>
            </div>
            
            <?php
        } else if ($RoleID == '2' && $CaptainShipStatus == 'Y') {
            
           $PaymentNotificationData = $fn->GetGeneralNotificationData('{"ReceiverID":"'.$_SESSION['KametSports']['session']['UserID'].'","NotificationType":"MakePaymetForTeam"}');
           
           if(is_array($PaymentNotificationData['GetGenralNotificationData']) && !empty($PaymentNotificationData['GetGenralNotificationData'])){
           ?> 
            
            <div class="alert alert-warning fade in" role="alert">
                <span class="glyphicon " aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <a href="make_payment&NotificationID=<?php echo $PaymentNotificationData['GetGenralNotificationData'][0]['NotificationID']; ?>" class="BlinkText"> <?php echo $PaymentNotificationData['GetGenralNotificationData'][0]['NotificationText']?> </a>
<!--                <h4 class="text-right BlinkText" style="color:tomato;font-size: 17px;">Your account is not verify yet please verify your account</h4>-->
            </div>
            <?php } ?>
            <div class="col-sm-4 col-lg-3">
                <a href="my_profile" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                            <div class="w-content big-box">
                                <div class="w-progress glyphicon glyphicon-tasks IconFontSize">
                                    <h4 class="text-center TileClass">Profile</h4>
                                </div>
                            </div>
                        </center>
                    </div>
                </a>
            </div>        
            <div class="col-sm-4 col-lg-3">
                <a href="view_team" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                            <div class="w-content big-box">
                                <div class="w-progress glyphicon glyphicon-tasks IconFontSize">
                                    <h4 class="text-center TileClass">Team</h4>
                                </div>
                            </div>
                        </center>
                    </div>
                </a>
            </div> 
            <div class="col-sm-4 col-lg-3">
                <a href="view_team_for_tournament" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                            <div class="w-content big-box">
                                <div class="w-progress glyphicon glyphicon-tasks IconFontSize">
                                    <h4 class="text-center TileClass">Tournament Team</h4>
                                </div>
                            </div>
                        </center>
                    </div>
                </a>
            </div> 
            <div class="col-sm-4 col-lg-3">
                <a href="view_tournaments_for_users" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                            <div class="w-content big-box">
                                <div class="w-progress glyphicon glyphicon-tasks IconFontSize">
                                    <h4 class="text-center TileClass">Tournament</h4>
                                </div>
                            </div>
                        </center>
                    </div>
                </a>
            </div>
            <?php if(count($CheckData['ApplyData']) > 0){ ?>
            <div class="col-sm-4 col-lg-3">
                <a href="make_payment&NotificationID=<?php echo $PaymentNotificationData['GetGenralNotificationData'][0]['NotificationID']; ?>" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                            <div class="w-content big-box">
                                <div class="w-progress glyphicon glyphicon-tasks IconFontSize">
                                    <h4 class="text-center TileClass">Make Payment</h4>
                                </div>
                            </div>
                        </center>
                    </div>
                </a>
            </div>
            <?php } ?>
        <?php
        } else if ($RoleID == '2' && $_SESSION['KametSports']['session']['CaptainshipStatus'] == 'N') { ?>
            <div class="col-sm-4 col-lg-3">
                <a href="my_profile" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                            <div class="w-content big-box">
                                <div class="w-progress glyphicon glyphicon-tasks IconFontSize">
                                    <h4 class="text-center TileClass">Profile</h4>
                                </div>
                            </div>
                        </center>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-lg-3">
                <a href="view_team" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                            <div class="w-content big-box">
                                <div class="w-progress glyphicon glyphicon-tasks IconFontSize">
                                    <h4 class="text-center TileClass">Team</h4>
                                </div>
                            </div>
                        </center>
                    </div>
                </a>
            </div> 
            <div class="col-sm-4 col-lg-3">
                <a href="view_team_match_schedule" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                            <div class="w-content big-box">
                                <div class="w-progress glyphicon glyphicon-tasks IconFontSize">
                                    <h4 class="text-center TileClass">Match Schedule</h4>
                                </div>
                            </div>
                        </center>
                    </div>
                </a>
            </div> 
            <div class="col-sm-4 col-lg-3">
                <a href="view_tournaments_for_users" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                            <div class="w-content big-box">
                                <div class="w-progress glyphicon glyphicon-tasks IconFontSize">
                                    <h4 class="text-center TileClass">Tournament</h4>
                                </div>
                            </div>
                        </center>
                    </div>
                </a>
            </div> 

        <?php } ?>
    </div>
</div>
<style>
    .fade {
/*  opacity: 0 !important;
  -webkit-transition: opacity 0.15s linear;
  -moz-transition: opacity 0.15s linear;
  -o-transition: opacity 0.15s linear;
  transition: opacity 0.15s linear;*/
}
.fade.in {
  opacity: 1 !important;
}
    
</style>  
<script>
(function blink() {
    $('.BlinkText').fadeOut(800).fadeIn(1000, blink);
})();
</script>