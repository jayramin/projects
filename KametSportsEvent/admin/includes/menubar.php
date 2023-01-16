
<?php
$RoleID = $_SESSION['KametSports']['session']['RoleID'];
$UserID = $_SESSION['KametSports']['session']['UserID'];

$MyCaptainShipStatus = $fn->MyCaptainData('{"UserID":"'.$UserID.'"}');

$CaptainShipStatus = $MyCaptainShipStatus['GetMyCaptainWiseData']['CaptainshipStatus'];
//echo '<pre>';
//print_r($MyCaptainShipStatus);
//exit;
if($RoleID != 1){
//    echo 'asdfasdfasdf';
    $data = $fn->GetNotificationCountData('{"UserID":"'.$UserID.'","CaptainShipStatus":"'.$MyCaptainShipStatus['GetMyCaptainWiseData']['CaptainshipStatus'].'"}');
//    echo '<pre>';
//    print_r($data);
//echo 'asdfasdf';
//exit;    
}
$DataForCaptainRequest = $fn->GetAllTeamCaptainRequest('{"UserID":"'.$UserID.'"}');
//echo '<pre>';
//print_r($DataForCaptainRequest);

?>
<ul id="gn-menu" class="navbar gn-menu-main">
    <li class="gn-trigger">
        <a id="menu-toggle" class="menu-toggle gn-icon gn-icon-menu">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="cross">
                <span></span>
                <span></span>
            </div>
        </a>
        <nav class="gn-menu-wrapper">
            <div class="gn-scroller">
                <?php
                $fn->get_menu('1', '0', 'gn-menu metismenu', 'menu-main-menu');
                ?>
            </div>
            <div class="bottom-bnts">
                <a class="profile" href="#"><i class="mdi mdi-account"></i></a>
                <a class="fix-nav" href="#"><i class="mdi mdi-pin"></i></a>
                <a  href="logout.php"><i class="mdi mdi-power"></i></a>
            </div>
        </nav>
    </li>
    <img src="<?php echo SITE_URL; ?>admin/image/Logo/KLogo.png" alt="Logo" height="50px;" class=" pull-left" style="border-radius:10px; ">
    <li>

        <a href="home" class="logo text-uppercase">Kamet sports events</a>
    </li>

    <li class="top-clock">
        <span  id="DATE" style="font-size: 16px;"></span>
    </li>

    <li class="container-fluid pull-right">
        <ul class="nav navbar-right right-menu">

            <li class="dropdown notifications">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i> 
                    <span class="label label-warning"><?php 
                    if($DataForCaptainRequest['GetBecomeCaptainData'] != ''){
                    echo 1;
}else if($DataForCaptainRequest['GetBecomeCaptainData'] == '' && $data['GetNotificationCountData']['Pending'] !=''){ echo $data['GetNotificationCountData']['Pending']; }
//                    echo $data['GetNotificationCountData']['Pending']; ?></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <h4 class="zero-m text-center">Notifications</h4>
                    </li>
                    <li>
                        <div class="messages"> 
                            <div class="member-info">
                                <?php
                                $NotificationTitleData = $fn->GetTypeTitleData();
                                foreach ($NotificationTitleData['GetNotificationTypeText'] AS $key => $Values){ ?>
                                <a href="GeneralNotifications&Type=<?php echo $Values['NotificationType']; ?>" class="HeaderDropDown nounderline"> <?php echo $Values['NotificationTitle']; ?></a>
                                <?php } ?>
                                
                                <?php 
                                if($CaptainShipStatus == 'N'){ ?>
                                <a href="accept_join_team_request" class="HeaderDropDown nounderline"> Team Request </a>
                                
                                 <?php }else if($CaptainShipStatus == 'Y'){ ?>
                                <a href="RequesToJoinTeam&Status=Pending" class="HeaderDropDown nounderline" >Request To Join A Team &nbsp; <label class="btn btn-primary btn-circle btn-sm"><?php echo $data['GetNotificationCountData']['Pending']?></label> 
                                </a>
                                <?php } ?>
                                
                            </div>
                        </div>
                    </li>
                </ul>
            </li>

            <li class="lang">
                <div class="dropdown">
                    <button class="dropbtn">Hello,<?php echo $_SESSION['KametSports']['session']['FirstName'] . ' ' . $_SESSION['KametSports']['session']['LastName'] ?></button>
                    <div class="dropdown-content">
                        <a href="logout.php" style="width: 98px; font-size: 18px !important">Logout</a>
                    </div>
                </div>
            </li>

        </ul>

    </li>

</ul>

<style>
    .dropbtn {
        background-color: #EF6C00;
        color: #2e374b;
        padding: 5px;
        margin-right: 40px;
        font-size: 16px;
        border: none;
        cursor: pointer;

    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 80px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    }

    .dropdown-content a {
        color: black;
        /*padding: 12px 16px;*/
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {background-color: #f1f1f1}

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: #FF9800;
    }
    .gn-menu-main .navbar-right a {
        padding: 0 0px 0 0;
        /* font-size: 18px; */
    }
    .gn-menu-main .navbar-right-subdrp a {
        padding: 0 0px 0 0;
        /* font-size: 18px; */
    }
</style>