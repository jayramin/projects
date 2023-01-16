<?php
$RoleID = $_SESSION['KametSports']['session']['RoleID'];
?>
<div id="content" class="content container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h2>Tournament Management</h2>
                <div class="page-header">
                    <ol class="breadcrumb">
                        <li><a href="home">Dashboard</a></li>
                        <li>Tournament Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php if ($RoleID == '1') { ?>
            <div class="col-sm-4 col-lg-3">
                <a href="view_tournament" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                        <div class="w-content big-box">
                            <div class="w-progress glyphicon glyphicon-map-marker IconFontSize">
                                 <h4 class="text-center TileClass">Tournament</h4>
                            </div>
                        </div>
                        </center>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-lg-3">
                <a href="view_groups" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                        <div class="w-content big-box">
                            <div class="w-progress glyphicon glyphicon-user IconFontSize">
                                 <h4 class="text-center TileClass">Groups</h4>
                            </div>
                        </div>
                        </center>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-lg-3">
                <a href="view_tournament_teams" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                        <div class="w-content big-box">
                            <div class="w-progress glyphicon glyphicon-ok IconFontSize">
                                 <h4 class="text-center TileClass">Team Approval</h4>
                            </div>
                        </div>
                        </center>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-lg-3">
                <a href="view_group_team_relation" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                        <div class="w-content big-box">
                            <div class="w-progress glyphicon glyphicon-retweet IconFontSize">
                                 <h4 class="text-center TileClass">Group Team Relation</h4>
                            </div>
                        </div>
                        </center>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-lg-3">
                <a href="view_rounds" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                        <div class="w-content big-box">
                            <div class="w-progress glyphicon glyphicon-link IconFontSize">
                                <h4 class="text-center TileClass">Rounds</h4>
                            </div>
                        </div>
                        </center>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-lg-3">
                <a href="view_rounds_points" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                        <div class="w-content big-box">
                            <div class="w-progress glyphicon glyphicon-usd IconFontSize">
                                <h4 class="text-center TileClass">Rounds Points</h4>
                            </div>
                        </div>
                        </center>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-lg-3">
                <a href="view_set_master" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                        <div class="w-content big-box">
                            <div class="w-progress glyphicon glyphicon-record IconFontSize">
                                <h4 class="text-center TileClass">Set Master</h4>
                            </div>
                        </div>
                        </center>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-lg-3">
                <a href="view_ground_master" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                        <div class="w-content big-box">
                            <div class="w-progress glyphicon glyphicon-record IconFontSize">
                                <h4 class="text-center TileClass">Ground Master</h4>
                            </div>
                        </div>
                        </center>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-lg-3">
                <a href="view_court_master" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                        <div class="w-content big-box">
                            <div class="w-progress glyphicon glyphicon-record IconFontSize">
                                <h4 class="text-center TileClass">Court Master</h4>
                            </div>
                        </div>
                        </center>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-lg-3">
                <a href="view_match_schedule" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                        <div class="w-content big-box">
                            <div class="w-progress glyphicon glyphicon-record IconFontSize">
                                <h4 class="text-center TileClass">Match Schedule</h4>
                            </div>
                        </div>
                        </center>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-lg-3">
                <a href="view_match_score_entry" class="text-uppercase w-name nounderline">
                    <div class="content-box ultra-widget B">
                        <center>
                        <div class="w-content big-box">
                            <div class="w-progress glyphicon glyphicon-record IconFontSize">
                                <h4 class="text-center TileClass">Match Score</h4>
                            </div>
                        </div>
                        </center>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
