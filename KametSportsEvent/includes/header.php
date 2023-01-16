<?php
error_reporting(0);
session_start();
include_once 'includes/labels.php';
include_once 'config/config.php';

include_once '../class/class.DataTransaction.php';
include_once '../class/class.ajaxRequest.php';
include_once '../class/class.functions.php';
$UserType = isset($_SESSION[SESSION_ALIAS]['session']['RoleID']) ? $_SESSION[SESSION_ALIAS]['session']['RoleID'] : 1;
if (isset($_SESSION[SESSION_ALIAS]['session']['RoleID'])) {
    $Profile = $fn->get_profile_data($_SESSION[SESSION_ALIAS]['session']['UserID'], 'v_users');    
}
if(isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'all')
{
$Tournaments = $fn->GetTournaments();
$TournamentDataFront = $Tournaments['GetAllTournamentQueryData'];
}else if(isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'upcoming')
{
$Tournaments = $fn->GetAllTournaments();
$TournamentDataFront = $Tournaments['GetTournamentDateWiseData'];
}else{
$Tournaments = $fn->GetTournaments();
$TournamentDataFront = $Tournaments['GetAllTournamentQueryData'];
}
?>
<head>
    <meta charset="UTF-8">
    <title>KAMET Sports Events</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&amp;subset=devanagari" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/reports.css">
    <link rel="stylesheet" href="assets/css/bootstrap-datepicker3.css"/>
    <link rel="stylesheet" href="assets/css/bootstrap-multiselect.css"/>
</head>
<style>
    html, body {
    max-width: 100%;
    overflow-x: hidden;
}
</style>
<body class="home1">
    <!-- ========================================
            ==Start Preloader==
    ======================================== -->
    <div class="preloader">
        <div class="preloader-inner-area">
            <div class="loader-overlay">
                <div class="l-preloader">
                    <div class="c-preloader"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========================================
            ==Start Preloader==
    ======================================== -->    
    <!--============================================
                ==Start Main Menu==
    ============================================-->
    <div class="main-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xs-7 col-sm-2" style="margin-top: 5px;">
                    <img src="assets/images/Logo/KLogo.png" alt="Logo" height="50px;" class="img-circle pull-left">
                    <div class="brand-area menu-logo">
                        <a href="index">
                            &nbsp;&nbsp;&nbsp;<img src="assets/images/kamet_name1.png" height="30px;" style="margin-top: -4px;">
<!--                            <h3 style="color: #2e374b; margin: -5px;">&nbsp;Kamet Sports Events</h3>-->
                        </a>
                    </div>
                </div>
                <div class="col-md-8 col-xs-5 col-sm-10">
                    <div class="navigation">
                        <nav>
                            <ul class="navbar-right">
                                <li>
                                    <a href="index">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="AboutUs">
                                        About Us
                                    </a>
                                </li>
                                <li>
                                    <a href="Tournaments">
                                        Tournaments
                                    </a>
                                </li>
                                <li>
                                    <a href="ContactUs">
                                        Contact 
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Account
                                        <span>
                                           <i class="fa fa-sort-desc" aria-hidden="true"></i>  
                                        </span>
                                    </a>
                                    <ul class="SubMenuBackGrpund">
                                        <li>
                                            <a href="login">
                                                Login
                                            </a>
                                        </li>
                                        <li>
                                            <a href="Registration">
                                                Register
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                
                            </ul>
                        </nav>
                        <button class="open-nav">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </button>
                        <div id="mySidenav" class="sidenav">
                            <a href="#" class="closebtn">&times;</a>
                            <ul>
                                <li>
                                    <a href="index">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="AboutUs">
                                        About Us
                                    </a>
                                </li>
                                <li>
                                    <a href="Tournaments">
                                        Tournaments
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="ContactUs">
                                        Contact
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Account
                                        <span>
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                    <ul >
                                        <li>
                                            <a href="login">
                                                Login
                                            </a>
                                        </li>
                                        <li>
                                            <a href="Registration">
                                                Register
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--============================================
                ==End Main Menu==
    ============================================-->