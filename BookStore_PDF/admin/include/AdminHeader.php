<?php
error_reporting(0);
require_once '../includes/labels.php';
include_once '../config/config.php';
require_once '../class/class.DataTransaction.php';
require_once '../class/class.functions.php';
session_start();

$db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$fn = new functions($db);
$mysql = new DataTransaction($db);
$AllNotesData = json_decode($NotesData, true);
$Notes = $AllNotesData['NotesList'];
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">
        <!--<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
        <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        
        <script src="assets/js/jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/js/selects/cs-select.css"  >
        <link rel="stylesheet" type="text/css" href="assets/js/selects/cs-skin-elastic.css">
        <link rel="stylesheet" type="text/css" href="assets/js/select2/select2.css" />
         <!--<script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>-->
        <script>
            $(document).ready(function () {
                $('#sampleTable').DataTable();
                $.getScript('assets/js/select2/select2.min.js', function () {
                    var select = $('select').select2();
                });
            });
        </script>

        <title>Book Store</title>
    </head>
    <body class="sidebar-mini fixed">
        <div class="wrapper">
            <!-- Navbar-->
            <header class="main-header hidden-print"><a class="logo" href="index.php"><img src="../assets/images/Logo/Logo.jpeg" style="height: 55px; width: 130px "></a>
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
                    <!-- Navbar Right Menu-->
                    <div class="navbar-custom-menu">
                        <ul class="top-nav">
                            <!--Notification Menu-->
                            <li class="dropdown notification-menu"><a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell-o fa-lg"></i></a>
                                <ul class="dropdown-menu">
                                    <li class="not-head">You have 4 new notifications.</li>
                                    <li><a class="media" href="javascript:;"><span class="media-left media-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                                            <div class="media-body"><span class="block">Lisa sent you a mail</span><span class="text-muted block">2min ago</span></div></a></li>
                                    <li><a class="media" href="javascript:;"><span class="media-left media-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                                            <div class="media-body"><span class="block">Server Not Working</span><span class="text-muted block">2min ago</span></div></a></li>
                                    <li><a class="media" href="javascript:;"><span class="media-left media-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                                            <div class="media-body"><span class="block">Transaction xyz complete</span><span class="text-muted block">2min ago</span></div></a></li>
                                    <li class="not-footer"><a href="#">See all notifications.</a></li>
                                </ul>
                            </li>
                            <!-- User Menu-->
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-lg"></i></a>
                                <ul class="dropdown-menu settings-menu" style="margin: 2px 0 0 -115px;">
                                    <li><a href="#"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
                                    <li><a href="#"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                                    <li><a href="Logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Side-Nav-->


